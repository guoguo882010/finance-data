<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;
use Dotenv\Dotenv;
use Medoo\Medoo;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = new Medoo([
    // required
    'database_type' => 'mysql',
    'database_name' => getenv('DB_DATABASE'),
    'server' => getenv('DB_HOST'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),

    // [optional] Table prefix
    'prefix' => getenv('DB_PREFIX'),


]);

$datas = $database->select("stocks", [
    "prefix",
    "symbol"
]);

$curl = new Curl();

foreach($datas as $data)
{
    $symbol = $data["prefix"] . $data["symbol"];

    $curl->setReferrer('https://xueqiu.com/snowman/S/'.$symbol.'/detail');
    $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36');
    $curl->setCookie('xq_a_token','c23c28d04d8a4aef21f26364f5b826600e7f8c2e');
    $curl->get('https://stock.xueqiu.com/v5/stock/f10/cn/company.json?symbol='.$symbol);
    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        $json = json_decode(json_encode($curl->response));
        if ($json->error_code == 0) {
            $database->update("stocks", [
                "org_name_cn" => $json->data->company->org_name_cn,
                "org_name_en" => $json->data->company->org_name_en,
                "org_website" => $json->data->company->org_website,
                "actual_controller" => $json->data->company->actual_controller,
                "classi_name" => $json->data->company->classi_name,
                "main_operation_business" => $json->data->company->main_operation_business,
                "org_cn_introduction" => $json->data->company->org_cn_introduction,
                "provincial_name" => $json->data->company->provincial_name,
                "reg_address_cn" => $json->data->company->reg_address_cn,
                "established_date" => date('Y-m-d',$json->data->company->established_date/1000),
                "listed_date" => date('Y-m-d',$json->data->company->listed_date/1000),
                "reg_asset" => round($json->data->company->reg_asset),
                "staff_num" => $json->data->company->staff_num,
                "executives_nums" => $json->data->company->executives_nums,
                "actual_issue_vol" => $json->data->company->actual_issue_vol,
                "issue_price" => $json->data->company->issue_price,
                "actual_rc_net_amt" => $json->data->company->actual_rc_net_amt,
                "pe_after_issuing" => $json->data->company->pe_after_issuing,
            ], [
                "prefix" => $data["prefix"],
                "symbol" => $data["symbol"],
            ]);
        }

    }
    var_dump($symbol);
}



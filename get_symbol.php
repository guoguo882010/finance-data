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



$curl = new Curl();
$curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36');
$curl->get('https://xueqiu.com/service/v5/stock/screener/quote/list?page=1&size=4000&order=desc&orderby=market_capital&order_by=market_capital&market=CN&type=sh_sz&_=1580386602556');



if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
} else {
    echo 'Response:' . "\n";
    $json = json_decode(json_encode($curl->response));


    foreach ($json->data->list as $v) {
        $prefix = substr($v->symbol , 0 , 2);
        $symbol = substr($v->symbol , 2);
        $database->insert("stocks", [
            "name" => $v->name,
            "prefix" => $prefix,
            "symbol" => $symbol
        ]);
        echo $v->symbol . PHP_EOL;
    }
    echo '总计：'.$json->data->count . PHP_EOL;
}
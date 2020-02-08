/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1_3306
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : 127.0.0.1:3306
 Source Schema         : finance_data

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 08/02/2020 14:50:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for fd_stocks
-- ----------------------------
DROP TABLE IF EXISTS `fd_stocks`;
CREATE TABLE `fd_stocks`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prefix` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '上海 深圳 前缀',
  `symbol` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '股票代码',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公司股票名称',
  `org_name_cn` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公司名称 中文',
  `org_name_en` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公司名称 英文',
  `org_website` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公司网址',
  `actual_controller` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '实际控制人',
  `classi_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公司性质',
  `main_operation_business` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '主营业务',
  `bigclass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手动分类-大类',
  `org_cn_introduction` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '公司简介',
  `provincial_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '所属省份',
  `reg_address_cn` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '注册地址',
  `established_date` date NULL DEFAULT NULL COMMENT '成立日期',
  `listed_date` date NULL DEFAULT NULL COMMENT '上市日期',
  `reg_asset` bigint(15) UNSIGNED NULL DEFAULT NULL COMMENT '注册资本',
  `staff_num` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '员工人数',
  `executives_nums` int(11) UNSIGNED NULL DEFAULT NULL COMMENT '管理层人数',
  `actual_issue_vol` bigint(15) UNSIGNED NULL DEFAULT NULL COMMENT '股票发行量',
  `issue_price` decimal(10, 2) UNSIGNED NULL DEFAULT NULL COMMENT '发行价格',
  `actual_rc_net_amt` decimal(15, 2) UNSIGNED NULL DEFAULT NULL COMMENT '募集资金',
  `pe_after_issuing` decimal(5, 2) UNSIGNED NULL DEFAULT NULL COMMENT '发行市盈率',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16704 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;

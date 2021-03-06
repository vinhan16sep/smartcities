/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost
 Source Database       : smartcities_db

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : utf-8

 Date: 10/01/2020 22:21:25 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `product2`
-- ----------------------------
DROP TABLE IF EXISTS `product2`;
CREATE TABLE `product2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `service` text,
  `sub_service` text,
  `is_submit` tinyint(1) DEFAULT '0',
  `rating` tinyint(1) DEFAULT '0' COMMENT '0: chua rating; 1: dong y; 2: xem xet; 3: khong dong y',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `information_id` int(11) DEFAULT NULL,
  `identity` varchar(100) DEFAULT NULL,
  `file` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `main_service` varchar(255) NOT NULL,
  `bak_main_service` varchar(255) NOT NULL,
  `year` varchar(4) DEFAULT NULL,
  `field_1` text,
  `field_2` text,
  `field_3` text,
  `field_4` text,
  `field_5` text,
  `field_6` text,
  `field_7` text,
  `field_8` text,
  `field_9` text,
  `field_10` text,
  `field_11` text,
  `field_12` text,
  `field_13` text,
  `field_14` text,
  `field_15` text,
  `field_16` text,
  `field_17` text,
  `field_18` text,
  `field_19` text,
  `field_20` text,
  `field_21` text,
  `field_22` text,
  `field_23` text,
  `field_24` text,
  `field_25` text,
  `field_26` text,
  `field_27` text,
  `field_28` text,
  `field_29` text,
  `field_30` text,
  `field_31` text,
  `field_32` text,
  `field_33` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `product2`
-- ----------------------------
BEGIN;
INSERT INTO `product2` VALUES ('7', '6', null, null, '0', '0', '2020-09-27 23:48:10', 'vinhan16sep4@gmail.com', '2020-09-27 23:48:10', 'vinhan16sep4@gmail.com', null, '11111111116', '', '0', '', '', '2020', 'Data123456', '1', '[\"1\",\"2\"]', '123', '123', '123', '<p>sdca</p>', '<p>&aacute;d</p>', '<p>&aacute;d</p>', '<p>&aacute;d</p>', '23', '123', '2', '2', '123', '<p>sad</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưeqwe</p>', '<p>qưeq</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>', '<p>qưe</p>');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

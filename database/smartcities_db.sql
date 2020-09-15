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

 Date: 09/15/2020 23:29:55 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `ci_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `ci_sessions` VALUES ('028a865127614b5754c39ca7673fc070aafbb708', '::1', '1600185209', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138353230393b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b6d6573736167657c733a32353a224974656d2075706461746564207375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d), ('0a151e1409ecc313e835797736e492dc8c7b56e7', '::1', '1600185996', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138353939363b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b), ('108dac596ff58479ef5cf5fb9ec2c84ec48835cb', '::1', '1599986773', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938363737333b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313539393938353334303b), ('1bbd74350186ddb52350617f7918b0773d9c18cc', '::1', '1599985331', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938353333313b72656769737465725f737563636573737c733a34363a223c703e54c3a069206b686fe1baa36e20c491c3a320c491c6b0e1bba363206bc3ad636820686fe1baa1743c2f703e223b5f5f63695f766172737c613a313a7b733a31363a2272656769737465725f73756363657373223b733a333a226f6c64223b7d), ('1d50f351c7a5acaa33d5e74d576e076959dc83c7', '::1', '1600098087', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303039383038373b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313630303039383038373b), ('3a945324d888aa35686e3a5ad8454d2a047e848a', '::1', '1600184625', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138343632353b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b), ('3d245a5a540381d4cc58278d58c58600a9cf5550', '::1', '1600098058', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303039383035383b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353939393835333430223b6c6173745f636865636b7c693a313630303039363735363b72656769737465725f737563636573737c733a3231383a2243e1baa36d20c6a16e2051c3ba792043c3b46e6720747920c491c3a320c491c4836e67206bc3bd207468616d20676961204368c6b0c6a16e67207472c3ac6e682044616e68206869e1bb87752053616f204b6875c3aa20323032302e0a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020567569206cc3b26e6720747275792063e1baad7020656d61696c20c491e1bb83206bc3ad636820686fe1baa1742074c3a069206b686fe1baa36e2076c3a0206b6861692068e1bb932073c6a12e223b5f5f63695f766172737c613a313a7b733a31363a2272656769737465725f73756363657373223b733a333a226f6c64223b7d), ('3dc8ce371135f164d7d7889ce867fb90dd03f606', '::1', '1599988409', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938383430383b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313539393938353334303b), ('3f6584020102d447b6ca268d182571f6c6417f22', '::1', '1600186693', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138363639333b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b), ('4645e347520e599fc68a6cc642afe81cd5c4e933', '::1', '1600186956', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138363639333b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b), ('55f22fe186a532c055031fde860dd567de7e02ba', '::1', '1600100018', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303130303031383b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313630303039383038373b), ('590b47c3ce774c1cdff3921295dd8dff75315118', '::1', '1599988014', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938383031343b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313539393938353334303b), ('5edb642cb0c62d0464211f03607433157d39d8d8', '::1', '1600185651', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138353635313b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b6d6573736167657c733a32353a224974656d2075706461746564207375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d), ('723dfd2f876df8fd0781485c4bc3fdc1a601a222', '::1', '1599988408', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938383430383b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313539393938353334303b), ('8ca35dd9b8360f3cac1d3e8b2536f147d7ede320', '::1', '1599987108', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938373130383b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313539393938353334303b), ('91a0f380ad6d87faa592dc4bc37413ccdb9d39d6', '::1', '1600183976', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138333937363b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b), ('a4ce01b3ee66000f65300d1b24229c8e9a81b426', '::1', '1600184286', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138343238363b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b), ('a9a236a27d616cc1552935bb3c08a60a9c030c83', '::1', '1600097240', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303039373234303b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353939393835333430223b6c6173745f636865636b7c693a313630303039363735363b), ('b3d3cc1885b0bc0582bbfce5b6ccd9b3fc33bcea', '::1', '1600096756', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303039363735363b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353939393835333430223b6c6173745f636865636b7c693a313630303039363735363b), ('b6827b51a11e1ef23fc8c9e12463953fb7872cad', '::1', '1599987497', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938373439373b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313539393938353334303b), ('b6cb205169bb31fba0ce3c842dca74a1294939ed', '::1', '1599985340', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393938353334303b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313539393938353334303b), ('cc97cc2ef5e0ee9b60e5e1ce8bd53631003a835d', '::1', '1599753732', 0x5f5f63695f6c6173745f726567656e65726174657c693a313539393735333733323b), ('d511c3b07e1a71d0359ffbc9a1ad488ecc38d3e9', '::1', '1600099403', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303039393430333b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313630303039383038373b), ('edfaea141e5612771b0d38a9c25f5bbeb94dd4fc', '::1', '1600100969', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303130303736373b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313630303039383038373b72656769737465725f737563636573737c733a3231383a2243e1baa36d20c6a16e2051c3ba792043c3b46e6720747920c491c3a320c491c4836e67206bc3bd207468616d20676961204368c6b0c6a16e67207472c3ac6e682044616e68206869e1bb87752053616f204b6875c3aa20323032302e0a202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020567569206cc3b26e6720747275792063e1baad7020656d61696c20c491e1bb83206bc3ad636820686fe1baa1742074c3a069206b686fe1baa36e2076c3a0206b6861692068e1bb932073c6a12e223b5f5f63695f766172737c613a313a7b733a31363a2272656769737465725f73756363657373223b733a333a226f6c64223b7d), ('ef898a2c93b933753ca047c999cdbb9d4bf9445a', '::1', '1600099704', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303039393730343b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313630303039383038373b), ('f9bd891a512b55527e08ba48f4c674f958e27b4f', '::1', '1600186374', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303138363337343b6964656e746974797c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b656d61696c7c733a32323a2276696e68616e31367365703140676d61696c2e636f6d223b757365725f69647c733a313a2233223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363030303938303837223b6c6173745f636865636b7c693a313630303138333937363b), ('fb74db7e455f2ccefa6b4c190e1319d562a840e0', '::1', '1600097552', 0x5f5f63695f6c6173745f726567656e65726174657c693a313630303039373535323b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353939393835333430223b6c6173745f636865636b7c693a313630303039363735363b);
COMMIT;

-- ----------------------------
--  Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `member_id` varchar(255) DEFAULT NULL,
  `equity_1` varchar(50) DEFAULT NULL,
  `equity_2` varchar(50) DEFAULT NULL,
  `equity_3` varchar(50) DEFAULT NULL,
  `owner_equity_1` varchar(50) DEFAULT NULL,
  `owner_equity_2` varchar(50) DEFAULT NULL,
  `owner_equity_3` varchar(50) DEFAULT NULL,
  `total_income_1` varchar(50) DEFAULT NULL,
  `total_income_2` varchar(50) DEFAULT NULL,
  `total_income_3` varchar(50) DEFAULT NULL,
  `software_income_1` varchar(50) DEFAULT NULL,
  `software_income_2` varchar(50) DEFAULT NULL,
  `software_income_3` varchar(50) DEFAULT NULL,
  `it_income_1` varchar(50) DEFAULT NULL,
  `it_income_2` varchar(50) DEFAULT NULL,
  `it_income_3` varchar(50) DEFAULT NULL,
  `export_income_1` varchar(50) DEFAULT NULL,
  `export_income_2` varchar(50) DEFAULT NULL,
  `export_income_3` varchar(50) DEFAULT NULL,
  `total_labor_1` varchar(50) DEFAULT NULL,
  `total_labor_2` varchar(50) DEFAULT NULL,
  `total_labor_3` varchar(50) DEFAULT NULL,
  `total_ltv_1` varchar(50) DEFAULT NULL,
  `total_ltv_2` varchar(50) DEFAULT NULL,
  `total_ltv_3` varchar(50) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `main_service` text,
  `main_market` text,
  `is_submit` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `information_id` int(11) NOT NULL,
  `year` int(10) NOT NULL,
  `identity` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `company`
-- ----------------------------
BEGIN;
INSERT INTO `company` VALUES ('1', '2', null, '123', '1', '1', '2', '1', '2', '1', '3', '1', '4', '3', '4', '4', '5', '2', '6', '3', '6', '3', '7', '3', '8', '2', '8', '<p>&aacute;d</p>', '[\"Ch\\u00ednh ph\\u1ee7 \\u0111i\\u1ec7n t\\u1eed\"]', '[\"Th\\u1ecb tr\\u01b0\\u1eddng Ch\\u00ednh ph\\u1ee7\"]', '0', '2020-09-13 15:24:13', 'vinhan16sep@gmail.com', '2020-09-13 15:24:13', 'vinhan16sep@gmail.com', '0', '2020', '11111111112');
COMMIT;

-- ----------------------------
--  Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `groups`
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES ('1', 'admin', 'Administrator'), ('2', 'members', 'General User'), ('3', 'clients', 'Guest User');
COMMIT;

-- ----------------------------
--  Table structure for `information`
-- ----------------------------
DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `legal_representative` varchar(100) DEFAULT NULL,
  `lp_position` varchar(100) DEFAULT NULL,
  `lp_email` varchar(100) DEFAULT NULL,
  `lp_phone` varchar(20) DEFAULT NULL,
  `connector` varchar(100) DEFAULT NULL,
  `c_position` varchar(100) DEFAULT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `c_phone` varchar(20) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `is_submit` tinyint(1) DEFAULT '0' COMMENT '0: haven''t save; 1: saved',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `identity` varchar(100) NOT NULL,
  `avatar` text,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `information`
-- ----------------------------
BEGIN;
INSERT INTO `information` VALUES ('1', '2', 'abccompany.com.vn', 'Nguyễn Văn A', 'asda', 'a@abccompany.com.vn', '12312312312', 'Nguyễn Văn B', 'asd', 'b@abccompany.com.vn', '21312313123', null, '0', '2020-09-13 15:23:53', 'vinhan16sep@gmail.com', '2020-09-13 15:23:53', 'vinhan16sep@gmail.com', '11111111112', null, 'ád'), ('2', '3', 'abccompany.com.vn', 'Nguyễn Văn A', 'asda', 'a@abccompany.com.vn', '12312312312', 'v', 'asd', 'b@abccompany.com.vn', '21312313123', 'google.com', '0', '2020-09-15 22:56:22', 'vinhan16sep1@gmail.com', '2020-09-15 23:02:10', 'vinhan16sep1@gmail.com', '11111111113', null, 'asd');
COMMIT;

-- ----------------------------
--  Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `new_rating`
-- ----------------------------
DROP TABLE IF EXISTS `new_rating`;
CREATE TABLE `new_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` text,
  `is_submit` int(1) DEFAULT '1',
  `total` double(50,2) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `name` text,
  `service` text,
  `sub_service` text,
  `functional` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `process` text,
  `security` text,
  `positive` text,
  `compare` text,
  `income_1` varchar(50) DEFAULT NULL,
  `income_2016` varchar(50) DEFAULT NULL,
  `income_2017` varchar(50) DEFAULT NULL,
  `area` text,
  `open_date` varchar(255) DEFAULT NULL,
  `price` text,
  `customer` text,
  `after_sale` text,
  `team` text,
  `award` text,
  `certificate` varchar(100) DEFAULT NULL,
  `is_submit` tinyint(1) DEFAULT '0',
  `rating` tinyint(1) DEFAULT '0' COMMENT '0: chua rating; 1: dong y; 2: xem xet; 3: khong dong y',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `information_id` int(11) DEFAULT NULL,
  `identity` varchar(100) DEFAULT NULL,
  `file` text NOT NULL,
  `copyright_certificate` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `main_service` varchar(255) NOT NULL,
  `bak_main_service` varchar(255) NOT NULL,
  `year` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `product`
-- ----------------------------
BEGIN;
INSERT INTO `product` VALUES ('1', '3', 'asd123', '[\"C\\u00e1c s\\u1ea3n ph\\u1ea9m, gi\\u1ea3i ph\\u00e1p ph\\u1ea7n m\\u1ec1m m\\u1edbi\"]', null, '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', null, '123', '123', '<p>asd</p>', '12/12/2019', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', null, '1', '0', '2020-09-15 22:40:14', 'vinhan16sep1@gmail.com', '2020-09-15 22:54:31', 'vinhan16sep1@gmail.com', null, '11111111113', '', '123', '0', '', '', '2020'), ('2', '3', 'zxc', 'null', null, '', '', '', '', '', null, '', '', '', '', '', '', '', '', '', null, '0', '0', '2020-09-15 22:54:39', 'vinhan16sep1@gmail.com', '2020-09-15 22:54:39', 'vinhan16sep1@gmail.com', null, '11111111113', '', '', '0', '', '', '2020'), ('3', '3', 'Test', '[\"C\\u00e1c s\\u1ea3n ph\\u1ea9m, gi\\u1ea3i ph\\u00e1p c\\u1ee7a doanh nghi\\u1ec7p kh\\u1edfi nghi\\u1ec7p\"]', null, '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '2017', '2018', '2019', '<p>qwe</p>', '12/12/2019', '<p>asd</p>', '<p>qwe</p>', '<p>qwe</p>', '<p>qwe</p>', '<p>qwe</p>', null, '1', '0', '2020-09-15 23:18:13', 'vinhan16sep1@gmail.com', '2020-09-15 23:19:33', 'vinhan16sep1@gmail.com', '2', '11111111113', '', '123', '0', '', '', '2020');
COMMIT;

-- ----------------------------
--  Table structure for `rating`
-- ----------------------------
DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `client_id` text,
  `precision` text,
  `strong` text,
  `weak` text,
  `rating` text,
  `result` varchar(50) DEFAULT NULL COMMENT '1: dong y; 2: xem xet; 3: khong dong y',
  `is_submit` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `is_information` tinyint(1) DEFAULT '0',
  `is_company` tinyint(1) DEFAULT '0',
  `is_product` tinyint(1) DEFAULT '0',
  `is_final` tinyint(1) DEFAULT '0',
  `year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `status`
-- ----------------------------
BEGIN;
INSERT INTO `status` VALUES ('1', '2', '1', '0', '0', '0', '2020'), ('2', '3', '1', '0', '1', '0', '2020'), ('3', '4', '0', '0', '0', '0', '2020');
COMMIT;

-- ----------------------------
--  Table structure for `team`
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `product_id` text,
  `member_id` text,
  `leader_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `year` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `company_id` text NOT NULL,
  `information_id` int(11) DEFAULT NULL,
  `member_role` varchar(100) DEFAULT NULL,
  `service_type` int(11) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', null, null, null, '1268889823', '1587372264', '1', 'Admin', 'istrator', null, 'ADMIN', '0', null, '', null, null, '99'), ('2', '::1', '11111111112', '$2y$08$wuI9sJtOy4W.3QWkC5UmSOk1O9admnc1Mf4K0hl6sU3BL7k7Z4F2K', null, 'vinhan16sep@gmail.com', null, null, null, null, '1599985307', '1600096756', '1', null, null, null, 'ABC ltd', '1277777777', null, '', '1', null, '99'), ('3', '::1', '11111111113', '$2y$08$jE.j7oA0IOVtnXCQyVK6uu.WiINU0QEfwAVA5u//E.fKiIYtxU0xO', null, 'vinhan16sep1@gmail.com', '687d1660d7b0981859d1b8c336af0825f93b4637', null, null, null, '1600097608', '1600183976', '1', null, null, null, 'ABC ltd', '1234567777', null, '', '2', null, '4'), ('4', '::1', '11111111114', '$2y$08$19y5iF.6vqZ7/m02MDsHKeD4MzmgmN2kJOuzgitEwjJqaWtAzgZIq', null, 'vinhan16sep2@gmail.com', '5158de84b970442b0b61ee9d72d6c7df6ab35980', null, null, null, '1600100963', null, '0', null, null, null, 'ABC ltd', '1277777777', null, '', null, null, '4');
COMMIT;

-- ----------------------------
--  Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=569 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users_groups`
-- ----------------------------
BEGIN;
INSERT INTO `users_groups` VALUES ('565', '1', '1'), ('566', '2', '3'), ('567', '3', '3'), ('568', '4', '3');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

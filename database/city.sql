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

 Date: 10/02/2020 00:41:22 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `member_id` varchar(255) DEFAULT NULL,
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
  `is_submit` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `information_id` int(11) NOT NULL,
  `year` int(10) NOT NULL,
  `identity` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `city`
-- ----------------------------
BEGIN;
INSERT INTO `city` VALUES ('5', '7', null, 'Data123456 9999', '<div class=\"col-sm-3 col-md-3 col-sx-12\"><label for=\"field_2\">Giới thiệu ngắn về Đ&ocirc; thị (Tối đa 500 từ)</label></div>\r\n<div class=\"col-sm-9 col-md-9 col-sx-12\">\r\n<div class=\"row\">\r\n<div id=\"mceu_21\" class=\"mce-tinymce mce-container mce-panel\" tabindex=\"-1\" role=\"application\">\r\n<div id=\"mceu_21-body\" class=\"mce-container-body mce-stack-layout\">\r\n<div id=\"mceu_22\" class=\"mce-top-part mce-container mce-stack-layout-item mce-first\">\r\n<div id=\"mceu_22-body\" class=\"mce-container-body\">\r\n<div id=\"mceu_23\" class=\"mce-container mce-menubar mce-toolbar mce-first\" role=\"menubar\">1</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '<div class=\"col-sm-3 col-md-3 col-sx-12\"><label for=\"field_3\">tr&iacute; địa l&yacute;, diện t&iacute;ch</label></div>\r\n<div class=\"col-sm-9 col-md-9 col-sx-12\">\r\n<div class=\"row\">\r\n<div id=\"mceu_68\" class=\"mce-tinymce mce-container mce-panel\" tabindex=\"-1\" role=\"application\">\r\n<div id=\"mceu_68-body\" class=\"mce-container-body mce-stack-layout\">\r\n<div id=\"mceu_69\" class=\"mce-top-part mce-container mce-stack-layout-item mce-first\">\r\n<div id=\"mceu_69-body\" class=\"mce-container-body\">\r\n<div id=\"mceu_70\" class=\"mce-container mce-menubar mce-toolbar mce-first\" role=\"menubar\">2</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '<p>D&acirc;n số, mật độ d&acirc;n số3</p>', '<div class=\"col-sm-3 col-md-3 col-sx-12\"><label for=\"field_5\">Tổng số quận, huyện, thị trấn, thị x&atilde;&hellip;</label></div>\r\n<div class=\"col-sm-9 col-md-9 col-sx-12\">\r\n<div class=\"row\">\r\n<div id=\"mceu_162\" class=\"mce-tinymce mce-container mce-panel\" tabindex=\"-1\" role=\"application\">\r\n<div id=\"mceu_162-body\" class=\"mce-container-body mce-stack-layout\">\r\n<div id=\"mceu_163\" class=\"mce-top-part mce-container mce-stack-layout-item mce-first\">\r\n<div id=\"mceu_163-body\" class=\"mce-container-body\">\r\n<div id=\"mceu_164\" class=\"mce-container mce-menubar mce-toolbar mce-first\" role=\"menubar\">4</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '<p>GDP/đầu người5</p>', '<p>GRDP6</p>', '<p>C&aacute;c ng&agrave;nh kinh tế mũi nhọn7</p>', '<p>Số lượng c&aacute;c dự &aacute;n bất động sản th&ocirc;ng minh, khu c&ocirc;ng nghiệp, c&ocirc;ng nghệ, c&ocirc;ng nghệ cao, khu chế xuất trong tỉnh/th&agrave;nh phố hiện tại8</p>', '<p>Điểm mạnh/Lợi thế9</p>', '<p>Định hướng ph&aacute;t triển của đ&ocirc; thị đến năm 2025, định hướng 203010</p>', '<p>C&aacute;c văn bản ph&aacute;p l&yacute; li&ecirc;n quan đến ch&iacute;nh s&aacute;ch, chương tr&igrave;nh, dự &aacute;n, đề &aacute;n th&agrave;nh phố th&ocirc;ng minh của tỉnh, th&agrave;nh phố11</p>', '<p>Tổng quan về đề &aacute;n, dự &aacute;n, chương tr&igrave;nh, hoạt động về th&agrave;nh phố, đ&ocirc; thị th&ocirc;ng minh của Tỉnh/th&agrave;nh phố v&agrave; c&aacute;c kết quả đạt được (n&ecirc;u t&oacute;m tắt th&ocirc;ng tin, số liệu v&agrave; gửi k&egrave;m đề &aacute;n12</p>', '<p>Tổng kinh ph&iacute; của th&agrave;nh phố/đ&ocirc; thị cho c&aacute;c chương tr&igrave;nh, dự &aacute;n&hellip; th&agrave;nh phố th&ocirc;ng minh năm 2018, 201913</p>', '114', '215', '316', '417', '<p>C&aacute;c th&ocirc;ng tin kh&aacute;cddd18</p>', '0', '2020-10-01 23:20:41', 'vinhan16sep5@gmail.com', '2020-10-02 00:27:04', 'vinhan16sep5@gmail.com', '0', '2020', '11111111117');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

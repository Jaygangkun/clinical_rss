/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : clinical_rss

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-06-06 21:18:04
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `reports`
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `conditions` varchar(255) DEFAULT NULL,
  `study` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `reporting` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `pubDate` varchar(255) DEFAULT NULL,
  `guids` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reports
-- ----------------------------
INSERT INTO `reports` VALUES ('1', 'test21323323qqq1', 'test3232', 'PReg', 'DZ', '1111qweqwe', null, '2021-05-10 18:09:17', '0', 'no', null, null, null);
INSERT INTO `reports` VALUES ('4', '1wewerwer_duplicate', 'wer', 'Obsr', 'AL', 's', null, '2021-04-05 21:54:31', '0', 'no', null, null, null);
INSERT INTO `reports` VALUES ('6', 'aaa', 'bbb', 'PReg', 'AL', 'asdfasdf', null, null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('7', 'test', '123', 'Intr', 'AS', '123', null, null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('9', 'testasdfwer', '123', 'Intr', 'AT', '123', null, null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('10', 'test21323323qqq', 'test3232', 'PReg', 'DZ', '1111qweqwe', null, null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('11', 'test21323323qqq', 'test3232', 'PReg', 'DZ', '1111qweqwe', null, null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('13', 'tttt', 'asd', 'Obsr', 'AL', 'wer', '2021-05-10 18:08:16', null, '1', 'no', null, null, null);
INSERT INTO `reports` VALUES ('14', 'test21323323qqq1', 'test3232', 'PReg', 'DZ', '1111qweqwe', null, null, '0', 'no', null, null, null);
INSERT INTO `reports` VALUES ('16', 'aaa', 'bbb', 'PReg', 'AL', 'asdfasdf', null, null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('17', '1we', 'Breast Cancer', '', 'US', 's', null, null, '1', 'new', null, null, null);
INSERT INTO `reports` VALUES ('18', '1we', 'wer', 'Intr', 'BD', 's', '2021-05-10 22:43:57', null, '0', 'no', null, null, null);
INSERT INTO `reports` VALUES ('20', 'tttt', 'asd', 'Obsr', 'AL', 'wer', '2021-05-10 22:53:14', null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('21', 'asdf', 'wer', 'Obsr', 'AF', 'wer', '2021-05-10 22:57:36', null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('22', 'aaa', 'bbb', 'PReg', 'AL', 'asdfasdf', '2021-05-10 23:07:55', null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('23', '1wewer', 'wer', 'Intr', 'AL', 's', '2021-05-10 23:14:16', null, '0', 'no', null, null, null);
INSERT INTO `reports` VALUES ('24', '1wewer', 'wer', 'Intr', 'AL', 's', '2021-05-10 23:14:26', null, '0', 'no', null, null, null);
INSERT INTO `reports` VALUES ('25', 'test title', 'Cancer', 'Intr', 'US', '', '2021-05-17 23:51:13', null, '1', 'new', '1', 'Sun, 23 May 2021 10:22:17 EDT', '[\"NCT03752268\",\"NCT03865654\",\"NCT04677413\",\"NCT03489707\",\"NCT00002981\",\"NCT03990012\",\"NCT04887935\",\"NCT03481816\",\"NCT04895761\",\"NCT04808427\"]');
INSERT INTO `reports` VALUES ('26', 'asdf', 'dwe', 'Intr', 'SD', '', '2021-05-19 11:23:49', null, '1', 'no', '1', null, null);
INSERT INTO `reports` VALUES ('27', 'wer', 'cander', 'Obsr', '', '', '2021-05-19 11:26:07', null, null, 'no', '1', null, null);
INSERT INTO `reports` VALUES ('28', 'test', 'asdfwersdower', '', '', '', '2021-05-24 19:40:47', null, '0', 'no', '1', null, null);
INSERT INTO `reports` VALUES ('30', 'wer', 'cander', 'Obsr', '', '', '2021-05-24 19:46:52', null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('31', 'test', 'asdfwersdower', '', '', '', '2021-05-24 19:47:51', null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('32', 'test', 'asdfwersdower', '', '', '', '2021-05-24 19:48:00', null, null, null, null, null, null);
INSERT INTO `reports` VALUES ('34', 'test', 'wer', '', '', '', '2021-05-24 21:34:35', null, null, 'no', '1', null, null);
INSERT INTO `reports` VALUES ('35', 'test', 'wer', '', '', '', '2021-05-24 21:34:51', null, null, 'no', '1', null, null);
INSERT INTO `reports` VALUES ('36', 'test', 'tes', '', '', '', '2021-05-25 04:46:03', null, '1', 'new', '5', 'Sun, 23 May 2021 10:22:17 EDT', '[\"NCT03735004\"]');
INSERT INTO `reports` VALUES ('37', 'test', 'tes', '', '', '', '2021-05-25 04:49:50', null, null, null, '5', null, null);
INSERT INTO `reports` VALUES ('38', 'test', 'tes', '', '', '', '2021-05-25 04:51:03', null, '1', 'new', '5', 'Sun, 23 May 2021 10:22:17 EDT', '[\"NCT03735004\"]');
INSERT INTO `reports` VALUES ('39', 'test', 'tes', '', '', '', '2021-05-25 04:51:17', null, null, null, '5', null, null);
INSERT INTO `reports` VALUES ('40', 'test', 'tes', '', '', '', '2021-05-25 04:52:19', null, null, null, '5', null, null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `is_verify` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `password_reset_code` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'jaygangkun@hotmail.com', '*676243218923905CF94CB52A3C9D3EB30CE8E20D', 'jaygang', 'jay13', 'gang13', '1', '1', null, '', 'admin');
INSERT INTO `users` VALUES ('5', 'kangchengsun@hotmail.com', '*3D3B92F242033365AE5BC6A8E6FC3E1679F4140A', 'kangcheng', 'kang', 'cheng', '1', '1', '', '', 'user');
INSERT INTO `users` VALUES ('8', 'jay@test.com', '*676243218923905CF94CB52A3C9D3EB30CE8E20D', 'test', 'tes1', 'test2', '1', '1', null, null, 'user');
INSERT INTO `users` VALUES ('9', 'admin@admin.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', 'admin@admin.com', 'admin', 'admin', '1', '1', 'ebd9629fc3ae5e9f6611e2ee05a31cef', null, 'admin');

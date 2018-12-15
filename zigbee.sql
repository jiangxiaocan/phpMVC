/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : index

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-12-15 17:35:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `zigbee`
-- ----------------------------
DROP TABLE IF EXISTS `zigbee`;
CREATE TABLE `zigbee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nodeid` varchar(20) DEFAULT NULL,
  `temp` varchar(20) DEFAULT NULL,
  `humi` varchar(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of zigbee
-- ----------------------------
INSERT INTO `zigbee` VALUES ('1', 'test', '10', '20', '1544866377');
INSERT INTO `zigbee` VALUES ('8', 'test1', 'test2', 'test3', '1544866152');
INSERT INTO `zigbee` VALUES ('9', 'test1', 'test2', 'test3', '1544866455');

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : j_money

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-24 17:56:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ims_account
-- ----------------------------
DROP TABLE IF EXISTS `ims_account`;
CREATE TABLE `ims_account` (
  `acid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `hash` varchar(8) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `isconnect` tinyint(4) NOT NULL,
  `isdeleted` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_account
-- ----------------------------
INSERT INTO `ims_account` VALUES ('1', '1', 'uRr8qvQV', '1', '0', '1');
INSERT INTO `ims_account` VALUES ('2', '2', 'mu86IzF4', '1', '1', '0');

-- ----------------------------
-- Table structure for ims_account_wechats
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_wechats`;
CREATE TABLE `ims_account_wechats` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(255) NOT NULL,
  `level` tinyint(4) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `account` varchar(30) NOT NULL,
  `original` varchar(50) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL,
  `province` varchar(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `subscribeurl` varchar(120) NOT NULL,
  `auth_refresh_token` varchar(255) NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `idx_key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_account_wechats
-- ----------------------------
INSERT INTO `ims_account_wechats` VALUES ('1', '1', 'omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP', '', '1', 'we7team', '', '', '', '', '', '', '', '', '0', '', '', '1', '', '');
INSERT INTO `ims_account_wechats` VALUES ('2', '2', 't5DdWD5hhWjdYaYW2y2LhAYlE6yh0h0N', 'TnneLH38TX13LHhnH4ZfL3h212Tnl62z71Q47HXNh44', '4', '福城物业', '', 'gh_0c2d3a9066f5', '', '', '', '', '', '', '0', 'wx8936fa867f2e8043', '499b44f4e049cecabe20d1db61dfea12', '0', '', '');

-- ----------------------------
-- Table structure for ims_account_wxapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_wxapp`;
CREATE TABLE `ims_account_wxapp` (
  `acid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(43) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `account` varchar(30) NOT NULL,
  `original` varchar(50) NOT NULL,
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `appdomain` varchar(255) NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_account_wxapp
-- ----------------------------

-- ----------------------------
-- Table structure for ims_article_category
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_category`;
CREATE TABLE `ims_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_article_category
-- ----------------------------

-- ----------------------------
-- Table structure for ims_article_news
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_news`;
CREATE TABLE `ims_article_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_show_home` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_article_news
-- ----------------------------

-- ----------------------------
-- Table structure for ims_article_notice
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_notice`;
CREATE TABLE `ims_article_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_show_home` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_article_notice
-- ----------------------------

-- ----------------------------
-- Table structure for ims_article_unread_notice
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_unread_notice`;
CREATE TABLE `ims_article_unread_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notice_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `is_new` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `notice_id` (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_article_unread_notice
-- ----------------------------

-- ----------------------------
-- Table structure for ims_basic_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_basic_reply`;
CREATE TABLE `ims_basic_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `content` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_basic_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_business
-- ----------------------------
DROP TABLE IF EXISTS `ims_business`;
CREATE TABLE `ims_business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `industry1` varchar(10) NOT NULL,
  `industry2` varchar(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_lat_lng` (`lng`,`lat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_business
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_attachment
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_attachment`;
CREATE TABLE `ims_core_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_attachment
-- ----------------------------
INSERT INTO `ims_core_attachment` VALUES ('1', '1', '1', 'Lighthouse.jpg', 'images/1/2017/08/Lc7yKr61K57SY79886C15S88A758D7.jpg', '1', '1502186076');
INSERT INTO `ims_core_attachment` VALUES ('2', '2', '1', '微信图片_20170809111825.jpg', 'images/2/2017/08/nHZXZahNKhtBasPhXH29G2e2KKb2nj.jpg', '1', '1502248703');
INSERT INTO `ims_core_attachment` VALUES ('3', '2', '1', '微信图片_20170809111825.jpg', 'images/2/2017/08/feo0D10o04e56Yhv51oE06IHEA15V6.jpg', '1', '1502263176');
INSERT INTO `ims_core_attachment` VALUES ('4', '2', '1', 'Desert.jpg', 'images/2/2017/08/K0obox9z5xAA1DAUyFRLjRyU60rUUr.jpg', '1', '1502263226');
INSERT INTO `ims_core_attachment` VALUES ('5', '2', '1', 'Koala.jpg', 'images/2/2017/08/K5vvluqlK646n58l7E65L778BPTO8e.jpg', '1', '1502263233');
INSERT INTO `ims_core_attachment` VALUES ('6', '2', '1', 'Hydrangeas.jpg', 'images/2/2017/08/pNKhIZunGR2hh2xNNr5h2i2z0H9xHR.jpg', '1', '1502263741');
INSERT INTO `ims_core_attachment` VALUES ('7', '2', '1', 'Jellyfish.jpg', 'images/2/2017/08/H7Bw3bXSbBL1CG13Fbed37Ou5Wckp8.jpg', '1', '1502263742');
INSERT INTO `ims_core_attachment` VALUES ('8', '2', '1', 'Koala.jpg', 'images/2/2017/08/RIhEd6hrfGMg6F54qR350YBfz5R46G.jpg', '1', '1502263742');
INSERT INTO `ims_core_attachment` VALUES ('9', '2', '1', 'Penguins.jpg', 'images/2/2017/08/tBVBqi7SBBxccsxbuv4q9PCYrIvZsR.jpg', '1', '1502264007');
INSERT INTO `ims_core_attachment` VALUES ('10', '2', '1', 'Desert.jpg', 'images/2/2017/08/saAG8H6qQZ0HoUmQ6Gu48gqHX8dHAK.jpg', '1', '1502265257');
INSERT INTO `ims_core_attachment` VALUES ('11', '2', '1', 'Desert.jpg', 'images/2/2017/08/VfU3pz9OwMGVpV9F9Pv3WMMCMUn9gn.jpg', '1', '1502265290');
INSERT INTO `ims_core_attachment` VALUES ('12', '2', '1', 'Chrysanthemum.jpg', 'images/2/2017/08/v2aXhAUw7KJkVqv2wqKwuew2ZhKWxq.jpg', '1', '1502265324');
INSERT INTO `ims_core_attachment` VALUES ('13', '2', '1', 'Tulips.jpg', 'images/2/2017/08/Eepjw1PJyWzBoSjJybwpPppeEEJGeP.jpg', '1', '1502265447');
INSERT INTO `ims_core_attachment` VALUES ('14', '2', '1', 'Jellyfish.jpg', 'images/2/2017/08/Qo7bb46EMCbH64XTQEX6q674EWx914.jpg', '1', '1502265473');
INSERT INTO `ims_core_attachment` VALUES ('15', '2', '1', 'Lighthouse.jpg', 'images/2/2017/08/L955f22ktf1Fdv2vd4t2q9ftNhtH6F.jpg', '1', '1502265486');
INSERT INTO `ims_core_attachment` VALUES ('16', '2', '1', 'Koala.jpg', 'images/2/2017/08/r3m61w0wYtc1wU7guf15y232nyP7cW.jpg', '1', '1502266142');
INSERT INTO `ims_core_attachment` VALUES ('17', '2', '1', 'Jellyfish.jpg', 'images/2/2017/08/VNpEnOWbM2WA55n02B0AzpeWdZhcEa.jpg', '1', '1502266212');
INSERT INTO `ims_core_attachment` VALUES ('18', '2', '1', 'Penguins.jpg', 'images/2/2017/08/dDttp3VzmQUo4luRt3tNtDl4V21uL5.jpg', '1', '1502266239');
INSERT INTO `ims_core_attachment` VALUES ('19', '2', '1', 'Hydrangeas.jpg', 'images/2/2017/08/xBRV6vbbbDlXSejsbdfM1CBV4L1LXB.jpg', '1', '1502266256');
INSERT INTO `ims_core_attachment` VALUES ('20', '2', '1', 'Tulips.jpg', 'images/2/2017/08/qS02iiO2mmyni0ysJ9JGHNOOHjfG9N.jpg', '1', '1502266256');
INSERT INTO `ims_core_attachment` VALUES ('21', '2', '1', 'Penguins.jpg', 'images/2/2017/08/JhmJLXLDRDKFPkEJLLQqpxqDQZZ3Mp.jpg', '1', '1502266256');
INSERT INTO `ims_core_attachment` VALUES ('22', '2', '1', 'Desert.jpg', 'images/2/2017/08/h2g8799k9552kxtdoND7Yo9eKD7rx5.jpg', '1', '1502266274');
INSERT INTO `ims_core_attachment` VALUES ('23', '2', '1', 'Hydrangeas.jpg', 'images/2/2017/08/gzQpn4nnoP2BO8nPnNb24gNpGPNq4V.jpg', '1', '1502266275');
INSERT INTO `ims_core_attachment` VALUES ('24', '2', '1', 'Penguins.jpg', 'images/2/2017/08/JDdfJI8JMFR1A3iIErIsI0D8SpJ6E6.jpg', '1', '1502266275');
INSERT INTO `ims_core_attachment` VALUES ('25', '2', '1', 'Tulips.jpg', 'images/2/2017/08/zil62VUzBg6utyAypyY6yXY2Ay3xBr.jpg', '1', '1502266277');
INSERT INTO `ims_core_attachment` VALUES ('26', '2', '1', 'Penguins.jpg', 'images/2/2017/08/RTiPZrh7IUZPzD3B0B0gigI4Pb47kh.jpg', '1', '1502269700');
INSERT INTO `ims_core_attachment` VALUES ('27', '2', '1', 'Penguins.jpg', 'images/2/2017/08/suKs96Kc6Kk0496iSuIHxEQIfKK6xe.jpg', '1', '1502269801');
INSERT INTO `ims_core_attachment` VALUES ('28', '2', '1', 'Koala.jpg', 'images/2/2017/08/Fx1KkX66FrCg3NuHxlNUD1K6UrDTzn.jpg', '1', '1502269894');
INSERT INTO `ims_core_attachment` VALUES ('29', '2', '1', 'Penguins.jpg', 'images/2/2017/08/lkQKOQkkKtA7MNa45rRKa4mOnnOrB9.jpg', '1', '1502270459');
INSERT INTO `ims_core_attachment` VALUES ('30', '2', '1', 'Lighthouse.jpg', 'images/2/2017/08/vHJ2lJ242Sfv4H4fn6SvLfJxn2hF53.jpg', '1', '1502270474');
INSERT INTO `ims_core_attachment` VALUES ('31', '2', '1', 'Penguins.jpg', 'images/2/2017/08/S991Lo9L3CkRzY1oyoSlih7kp69xCo.jpg', '1', '1502270474');
INSERT INTO `ims_core_attachment` VALUES ('32', '2', '1', 'Tulips.jpg', 'images/2/2017/08/y2K0I13gko0ok8oLZKAA3ak002orU2.jpg', '1', '1502270474');
INSERT INTO `ims_core_attachment` VALUES ('33', '2', '1', 'Hydrangeas.jpg', 'images/2/2017/08/DXAcB0qa0AA0cAa0RazAcQC6Y6aYx8.jpg', '1', '1502332935');
INSERT INTO `ims_core_attachment` VALUES ('34', '2', '1', 'Koala.jpg', 'images/2/2017/08/THSslhlNJQsOgtqxSqQgbUxlTxoqsu.jpg', '1', '1502332984');
INSERT INTO `ims_core_attachment` VALUES ('35', '2', '1', 'Penguins.jpg', 'images/2/2017/08/rnfN4siTpGguUGu2NfE3tguN3ungiU.jpg', '1', '1502333052');
INSERT INTO `ims_core_attachment` VALUES ('36', '2', '1', 'Penguins.jpg', 'images/2/2017/08/c7JX7XtG8LrnFx73NVJq43lTZqJtqh.jpg', '1', '1502333222');
INSERT INTO `ims_core_attachment` VALUES ('37', '2', '1', 'Penguins.jpg', 'images/2/2017/08/uKK60kXXKjexJ9XJ2rKXW26K6i6mmr.jpg', '1', '1502333246');
INSERT INTO `ims_core_attachment` VALUES ('38', '2', '1', 'gKM0Ic6fIc8oEIOcT8B6oOgeIez660.png', 'images/2/2017/08/KnNmMun9k35nL7boc1BQlCmn3K57l8.png', '1', '1502414199');
INSERT INTO `ims_core_attachment` VALUES ('39', '2', '1', 'H23x73AmxH39DSXVnH43GVV1vchxz7.png', 'images/2/2017/08/RzJfJJM3zIW2mKFw2XZIK3c2fjf2JP.png', '1', '1502414224');
INSERT INTO `ims_core_attachment` VALUES ('40', '2', '1', 'iRKw5oT1vru5xM5R2oTYVZCxJRiMwM.jpg', 'images/2/2017/08/dtt20egz10vWl02XZ59DMOaoa011rd.jpg', '1', '1502414252');
INSERT INTO `ims_core_attachment` VALUES ('41', '2', '1', 'RDs3TtC67qJ2VjVTcr7Ndv4mzv66Pv.png', 'images/2/2017/08/R6198MpM1e6dEFU98zD3U8Dzc16YAd.png', '1', '1502414287');
INSERT INTO `ims_core_attachment` VALUES ('42', '2', '1', 'Sz156H350RZ5uy09Ae3u0oaYE16XY3.png', 'images/2/2017/08/kV155PW3GCC23E4mv5hteHM2H2CzEh.png', '1', '1502414361');
INSERT INTO `ims_core_attachment` VALUES ('43', '2', '1', 'Wc00S0VbBvOGvUow0GIWL4bXB44TD3.png', 'images/2/2017/08/c8KbIi8bNnIK0lNQmZnB6nABMZssIL.png', '1', '1502414384');
INSERT INTO `ims_core_attachment` VALUES ('44', '2', '1', '090405711.png', 'images/2/2017/08/C5R8t1rXdP8DTrW8xvXdcb5rWbxtCp.png', '1', '1502414730');
INSERT INTO `ims_core_attachment` VALUES ('45', '2', '1', '063041581.jpg', 'images/2/2017/08/O0IlhM6Himh68l95yc9ZMZD60bPCI9.jpg', '1', '1502414770');
INSERT INTO `ims_core_attachment` VALUES ('46', '2', '1', '072047101.png', 'images/2/2017/08/gwFi6dZNIDWws762i2l6diA144Ll3D.png', '1', '1502414784');
INSERT INTO `ims_core_attachment` VALUES ('47', '2', '1', 'bA5F6QL7FI2po432AYg57J77MJJJJp.jpg', 'images/2/2017/08/S9PdLl24ptTrTKllgfpp6llOL9kK8D.jpg', '1', '1502416122');
INSERT INTO `ims_core_attachment` VALUES ('48', '2', '1', 'H96zMmjk6ZrJHm8K6Kk87HVKgjnGTI.jpg', 'images/2/2017/08/sUsosKo1oujLukyEgSPEikl1p5kwYJ.jpg', '1', '1502416132');
INSERT INTO `ims_core_attachment` VALUES ('49', '2', '1', 'bA5F6QL7FI2po432AYg57J77MJJJJp.jpg', 'images/2/2017/08/O7kafu1F9A3oa7g7FNf2o2aZ8qFO78.jpg', '1', '1502416132');
INSERT INTO `ims_core_attachment` VALUES ('50', '2', '1', 'IS2cYLDys6uT94ZV9yjSvvLt5jJStT.jpg', 'images/2/2017/08/HnLkTUuuNZLDklWaLRK3nDNDTlKZll.jpg', '1', '1502417259');
INSERT INTO `ims_core_attachment` VALUES ('51', '2', '1', 'IS2cYLDys6uT94ZV9yjSvvLt5jJStT.jpg', 'images/2/2017/08/jZPMpC9fuCR3tJRcEP3cqqMFC3rput.jpg', '1', '1502417266');
INSERT INTO `ims_core_attachment` VALUES ('52', '2', '1', 'l6sRsIIf062Nr2SRXPRrpDFazAh926.jpg', 'images/2/2017/08/C4n4040EeH08FEizGVe2048F4G4348.jpg', '1', '1502417289');
INSERT INTO `ims_core_attachment` VALUES ('53', '2', '1', 'timg3.jpg', 'images/2/2017/09/JJ4kcTJ1KT1Jc2c7Kc1rKJ52O0x05X.jpg', '1', '1504526199');
INSERT INTO `ims_core_attachment` VALUES ('54', '2', '1', 'timg.jpg', 'images/2/2017/09/Ff664rFLlevF6F6F8DA66ccw6vA3dc.jpg', '1', '1504526207');
INSERT INTO `ims_core_attachment` VALUES ('55', '2', '1', 'timg2.jpg', 'images/2/2017/09/otOiQfXoStnyNuZ5ZINTFQqnISm9PC.jpg', '1', '1504526214');
INSERT INTO `ims_core_attachment` VALUES ('56', '2', '1', 'timg.jpg', 'images/2/2017/09/AkWJ6lR0ii0bIJ0KEj6B8c10iW7108.jpg', '1', '1504526306');
INSERT INTO `ims_core_attachment` VALUES ('57', '2', '1', '6c0b840b679e17d1c3bd1b.jpg', 'images/2/2017/09/LDCFZ40LF9oo4TX9zXFlh498ajxgLo.jpg', '1', '1504526428');
INSERT INTO `ims_core_attachment` VALUES ('58', '2', '1', 'v79iemYIyEMMUmeImIYIziL7yieE77', 'images/2/2017/09/v79iemYIyEMMUmeImIYIziL7yieE77.jpg', '1', '1504526428');
INSERT INTO `ims_core_attachment` VALUES ('59', '2', '1', 'timg?image&quality=80&size=b9999_10000&sec=1504536535769&di=893f81e605e3b30ab5eeefae955d3fb1&imgtype=0&src=http%3A%2F%2Fimg3sz.centainfo.com%2Fimages%2F20170610%2F051241_bab6948c-2cef-4f15-98b9-c050dbed1abc_450x320_w.jpg', 'images/2/2017/09/iPnD5v9jCBowJBdab6aJ2wWSvPd2Wc.gif', '1', '1504526494');
INSERT INTO `ims_core_attachment` VALUES ('60', '2', '1', 'XIiVWIuw22NXVZ0VFXx1iy1K215xbI', 'images/2/2017/09/XIiVWIuw22NXVZ0VFXx1iy1K215xbI.gif', '1', '1504526495');
INSERT INTO `ims_core_attachment` VALUES ('61', '2', '1', '051241_bab6948c-2cef-4f15-98b9-c050dbed1abc_450x320_w.jpg', 'images/2/2017/09/fh7wyE7zohd4iY2oiwLI4zElwp470l.jpg', '1', '1504526570');
INSERT INTO `ims_core_attachment` VALUES ('62', '2', '1', 'Ec4dMjmceD4Jlm3jjLVHgT4COL4cEj', 'images/2/2017/09/Ec4dMjmceD4Jlm3jjLVHgT4COL4cEj.jpg', '1', '1504526571');

-- ----------------------------
-- Table structure for ims_core_cache
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_cache`;
CREATE TABLE `ims_core_cache` (
  `key` varchar(50) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_cache
-- ----------------------------
INSERT INTO `ims_core_cache` VALUES ('userbasefields', 'a:45:{s:7:\"uniacid\";s:17:\"同一公众号id\";s:7:\"groupid\";s:8:\"分组id\";s:7:\"credit1\";s:6:\"积分\";s:7:\"credit2\";s:6:\"余额\";s:7:\"credit3\";s:19:\"预留积分类型3\";s:7:\"credit4\";s:19:\"预留积分类型4\";s:7:\"credit5\";s:19:\"预留积分类型5\";s:7:\"credit6\";s:19:\"预留积分类型6\";s:10:\"createtime\";s:12:\"加入时间\";s:6:\"mobile\";s:12:\"手机号码\";s:5:\"email\";s:12:\"电子邮箱\";s:8:\"realname\";s:12:\"真实姓名\";s:8:\"nickname\";s:6:\"昵称\";s:6:\"avatar\";s:6:\"头像\";s:2:\"qq\";s:5:\"QQ号\";s:6:\"gender\";s:6:\"性别\";s:5:\"birth\";s:6:\"生日\";s:13:\"constellation\";s:6:\"星座\";s:6:\"zodiac\";s:6:\"生肖\";s:9:\"telephone\";s:12:\"固定电话\";s:6:\"idcard\";s:12:\"证件号码\";s:9:\"studentid\";s:6:\"学号\";s:5:\"grade\";s:6:\"班级\";s:7:\"address\";s:6:\"地址\";s:7:\"zipcode\";s:6:\"邮编\";s:11:\"nationality\";s:6:\"国籍\";s:6:\"reside\";s:9:\"居住地\";s:14:\"graduateschool\";s:12:\"毕业学校\";s:7:\"company\";s:6:\"公司\";s:9:\"education\";s:6:\"学历\";s:10:\"occupation\";s:6:\"职业\";s:8:\"position\";s:6:\"职位\";s:7:\"revenue\";s:9:\"年收入\";s:15:\"affectivestatus\";s:12:\"情感状态\";s:10:\"lookingfor\";s:13:\" 交友目的\";s:9:\"bloodtype\";s:6:\"血型\";s:6:\"height\";s:6:\"身高\";s:6:\"weight\";s:6:\"体重\";s:6:\"alipay\";s:15:\"支付宝帐号\";s:3:\"msn\";s:3:\"MSN\";s:6:\"taobao\";s:12:\"阿里旺旺\";s:4:\"site\";s:6:\"主页\";s:3:\"bio\";s:12:\"自我介绍\";s:8:\"interest\";s:12:\"兴趣爱好\";s:8:\"password\";s:6:\"密码\";}');
INSERT INTO `ims_core_cache` VALUES ('usersfields', 'a:46:{s:8:\"realname\";s:12:\"真实姓名\";s:8:\"nickname\";s:6:\"昵称\";s:6:\"avatar\";s:6:\"头像\";s:2:\"qq\";s:5:\"QQ号\";s:6:\"mobile\";s:12:\"手机号码\";s:3:\"vip\";s:9:\"VIP级别\";s:6:\"gender\";s:6:\"性别\";s:9:\"birthyear\";s:12:\"出生生日\";s:13:\"constellation\";s:6:\"星座\";s:6:\"zodiac\";s:6:\"生肖\";s:9:\"telephone\";s:12:\"固定电话\";s:6:\"idcard\";s:12:\"证件号码\";s:9:\"studentid\";s:6:\"学号\";s:5:\"grade\";s:6:\"班级\";s:7:\"address\";s:12:\"邮寄地址\";s:7:\"zipcode\";s:6:\"邮编\";s:11:\"nationality\";s:6:\"国籍\";s:14:\"resideprovince\";s:12:\"居住地址\";s:14:\"graduateschool\";s:12:\"毕业学校\";s:7:\"company\";s:6:\"公司\";s:9:\"education\";s:6:\"学历\";s:10:\"occupation\";s:6:\"职业\";s:8:\"position\";s:6:\"职位\";s:7:\"revenue\";s:9:\"年收入\";s:15:\"affectivestatus\";s:12:\"情感状态\";s:10:\"lookingfor\";s:13:\" 交友目的\";s:9:\"bloodtype\";s:6:\"血型\";s:6:\"height\";s:6:\"身高\";s:6:\"weight\";s:6:\"体重\";s:6:\"alipay\";s:15:\"支付宝帐号\";s:3:\"msn\";s:3:\"MSN\";s:5:\"email\";s:12:\"电子邮箱\";s:6:\"taobao\";s:12:\"阿里旺旺\";s:4:\"site\";s:6:\"主页\";s:3:\"bio\";s:12:\"自我介绍\";s:8:\"interest\";s:12:\"兴趣爱好\";s:7:\"uniacid\";s:17:\"同一公众号id\";s:7:\"groupid\";s:8:\"分组id\";s:7:\"credit1\";s:6:\"积分\";s:7:\"credit2\";s:6:\"余额\";s:7:\"credit3\";s:19:\"预留积分类型3\";s:7:\"credit4\";s:19:\"预留积分类型4\";s:7:\"credit5\";s:19:\"预留积分类型5\";s:7:\"credit6\";s:19:\"预留积分类型6\";s:10:\"createtime\";s:12:\"加入时间\";s:8:\"password\";s:12:\"用户密码\";}');
INSERT INTO `ims_core_cache` VALUES ('setting', 'a:11:{s:9:\"copyright\";a:2:{s:6:\"status\";s:1:\"0\";s:6:\"reason\";s:15:\"备份数据库\";}s:18:\"module_receive_ban\";a:1:{s:14:\"feng_community\";s:14:\"feng_community\";}s:8:\"authmode\";i:1;s:5:\"close\";a:2:{s:6:\"status\";s:1:\"0\";s:6:\"reason\";s:0:\"\";}s:8:\"register\";a:4:{s:4:\"open\";i:1;s:6:\"verify\";i:0;s:4:\"code\";i:1;s:7:\"groupid\";i:1;}s:4:\"site\";a:6:{s:3:\"key\";s:5:\"99202\";s:5:\"token\";s:32:\"b37028cd06062ddb1aefe69b4a5c4be5\";s:3:\"url\";s:21:\"http://wuye.iot-gj.cn\";s:7:\"version\";s:3:\"1.0\";s:6:\"family\";s:1:\"v\";s:15:\"profile_perfect\";b:1;}s:7:\"cloudip\";a:0:{}s:10:\"module_ban\";a:0:{}s:14:\"module_upgrade\";a:0:{}s:8:\"sms.info\";a:3:{s:3:\"key\";s:5:\"99202\";s:8:\"sms_sign\";a:0:{}s:9:\"sms_count\";i:0;}s:8:\"platform\";a:5:{s:5:\"token\";s:32:\"itKThGnTgGk9gzszSFshShcJhkkgs5tC\";s:14:\"encodingaeskey\";s:43:\"hOq7yAkNrYfPAfqCKYFpofP66N26PkCPFAabY6f7pny\";s:9:\"appsecret\";s:0:\"\";s:5:\"appid\";s:0:\"\";s:9:\"authstate\";i:1;}}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_modules:1', 'a:13:{i:0;s:7:\"j_money\";i:1;s:14:\"feng_community\";i:2;s:6:\"wxcard\";i:3;s:5:\"chats\";i:4;s:5:\"voice\";i:5;s:5:\"video\";i:6;s:6:\"images\";i:7;s:6:\"custom\";i:8;s:8:\"recharge\";i:9;s:7:\"userapi\";i:10;s:5:\"music\";i:11;s:4:\"news\";i:12;s:5:\"basic\";}');
INSERT INTO `ims_core_cache` VALUES ('unisetting:2', 'a:23:{s:7:\"uniacid\";s:1:\"2\";s:8:\"passport\";s:0:\"\";s:5:\"oauth\";a:2:{s:7:\"account\";s:1:\"2\";s:4:\"host\";s:0:\"\";}s:11:\"jsauth_acid\";s:1:\"0\";s:2:\"uc\";s:0:\"\";s:6:\"notify\";s:0:\"\";s:11:\"creditnames\";a:2:{s:7:\"credit1\";a:2:{s:5:\"title\";s:6:\"积分\";s:7:\"enabled\";i:1;}s:7:\"credit2\";a:2:{s:5:\"title\";s:6:\"余额\";s:7:\"enabled\";i:1;}}s:15:\"creditbehaviors\";a:2:{s:8:\"activity\";s:7:\"credit1\";s:8:\"currency\";s:7:\"credit2\";}s:7:\"welcome\";s:0:\"\";s:7:\"default\";s:0:\"\";s:15:\"default_message\";s:0:\"\";s:7:\"payment\";a:3:{s:6:\"alipay\";a:1:{s:6:\"switch\";b:1;}s:6:\"credit\";a:1:{s:6:\"switch\";b:1;}s:8:\"delivery\";a:1:{s:6:\"switch\";b:1;}}s:4:\"stat\";s:0:\"\";s:12:\"default_site\";s:1:\"2\";s:4:\"sync\";s:1:\"1\";s:8:\"recharge\";s:0:\"\";s:9:\"tplnotice\";s:0:\"\";s:10:\"grouplevel\";s:1:\"0\";s:8:\"mcplugin\";s:0:\"\";s:15:\"exchange_enable\";s:1:\"0\";s:11:\"coupon_type\";s:1:\"0\";s:7:\"menuset\";s:0:\"\";s:10:\"statistics\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('uniaccount:2', 'a:34:{s:4:\"acid\";s:1:\"2\";s:7:\"uniacid\";s:1:\"2\";s:5:\"token\";s:32:\"t5DdWD5hhWjdYaYW2y2LhAYlE6yh0h0N\";s:14:\"encodingaeskey\";s:43:\"TnneLH38TX13LHhnH4ZfL3h212Tnl62z71Q47HXNh44\";s:5:\"level\";s:1:\"4\";s:4:\"name\";s:12:\"福城物业\";s:7:\"account\";s:0:\"\";s:8:\"original\";s:15:\"gh_0c2d3a9066f5\";s:9:\"signature\";s:0:\"\";s:7:\"country\";s:0:\"\";s:8:\"province\";s:0:\"\";s:4:\"city\";s:0:\"\";s:8:\"username\";s:0:\"\";s:8:\"password\";s:0:\"\";s:10:\"lastupdate\";s:1:\"0\";s:3:\"key\";s:18:\"wx8936fa867f2e8043\";s:6:\"secret\";s:32:\"499b44f4e049cecabe20d1db61dfea12\";s:7:\"styleid\";s:1:\"0\";s:12:\"subscribeurl\";s:0:\"\";s:18:\"auth_refresh_token\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:9:\"isconnect\";s:1:\"1\";s:9:\"isdeleted\";s:1:\"0\";s:3:\"uid\";N;s:9:\"starttime\";N;s:7:\"endtime\";N;s:6:\"groups\";a:1:{i:2;a:5:{s:7:\"groupid\";s:1:\"2\";s:7:\"uniacid\";s:1:\"2\";s:5:\"title\";s:15:\"默认会员组\";s:6:\"credit\";s:1:\"0\";s:9:\"isdefault\";s:1:\"1\";}}s:7:\"setting\";a:23:{s:7:\"uniacid\";s:1:\"2\";s:8:\"passport\";s:0:\"\";s:5:\"oauth\";a:2:{s:7:\"account\";s:1:\"2\";s:4:\"host\";s:0:\"\";}s:11:\"jsauth_acid\";s:1:\"0\";s:2:\"uc\";s:0:\"\";s:6:\"notify\";s:0:\"\";s:11:\"creditnames\";a:2:{s:7:\"credit1\";a:2:{s:5:\"title\";s:6:\"积分\";s:7:\"enabled\";i:1;}s:7:\"credit2\";a:2:{s:5:\"title\";s:6:\"余额\";s:7:\"enabled\";i:1;}}s:15:\"creditbehaviors\";a:2:{s:8:\"activity\";s:7:\"credit1\";s:8:\"currency\";s:7:\"credit2\";}s:7:\"welcome\";s:0:\"\";s:7:\"default\";s:0:\"\";s:15:\"default_message\";s:0:\"\";s:7:\"payment\";a:3:{s:6:\"alipay\";a:1:{s:6:\"switch\";b:1;}s:6:\"credit\";a:1:{s:6:\"switch\";b:1;}s:8:\"delivery\";a:1:{s:6:\"switch\";b:1;}}s:4:\"stat\";s:0:\"\";s:12:\"default_site\";s:1:\"2\";s:4:\"sync\";s:1:\"1\";s:8:\"recharge\";s:0:\"\";s:9:\"tplnotice\";s:0:\"\";s:10:\"grouplevel\";s:1:\"0\";s:8:\"mcplugin\";s:0:\"\";s:15:\"exchange_enable\";s:1:\"0\";s:11:\"coupon_type\";s:1:\"0\";s:7:\"menuset\";s:0:\"\";s:10:\"statistics\";s:0:\"\";}s:10:\"grouplevel\";s:1:\"0\";s:4:\"logo\";s:62:\"http://wuye.iot-gj.cn/attachment/headimg_2.jpg?time=1508743513\";s:6:\"qrcode\";s:61:\"http://wuye.iot-gj.cn/attachment/qrcode_2.jpg?time=1508743513\";s:9:\"switchurl\";s:51:\"./index.php?c=account&a=display&do=switch&uniacid=2\";s:3:\"sms\";i:0;s:7:\"setmeal\";a:5:{s:3:\"uid\";i:-1;s:8:\"username\";s:9:\"创始人\";s:9:\"timelimit\";s:9:\"未设置\";s:7:\"groupid\";s:2:\"-1\";s:9:\"groupname\";s:12:\"所有服务\";}}');
INSERT INTO `ims_core_cache` VALUES ('upgrade', 'a:3:{s:7:\"upgrade\";b:1;s:4:\"data\";a:11:{s:6:\"family\";s:1:\"v\";s:7:\"version\";s:3:\"1.0\";s:7:\"release\";s:12:\"201711020003\";s:5:\"state\";b:0;s:7:\"message\";b:0;s:7:\"schemas\";a:3:{i:0;a:5:{s:9:\"tablename\";s:11:\"ims_account\";s:7:\"charset\";s:15:\"utf8_general_ci\";s:6:\"engine\";s:6:\"MyISAM\";s:6:\"fields\";a:7:{s:4:\"acid\";a:6:{s:4:\"name\";s:4:\"acid\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:1;}s:7:\"uniacid\";a:6:{s:4:\"name\";s:7:\"uniacid\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:4:\"hash\";a:6:{s:4:\"name\";s:4:\"hash\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:1:\"8\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:4:\"type\";a:6:{s:4:\"name\";s:4:\"type\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"3\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:9:\"isconnect\";a:6:{s:4:\"name\";s:9:\"isconnect\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"4\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:9:\"isdeleted\";a:6:{s:4:\"name\";s:9:\"isdeleted\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"3\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:7:\"endtime\";a:6:{s:4:\"name\";s:7:\"endtime\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}}s:7:\"indexes\";a:2:{s:7:\"PRIMARY\";a:3:{s:4:\"name\";s:7:\"PRIMARY\";s:4:\"type\";s:7:\"primary\";s:6:\"fields\";a:1:{i:0;s:4:\"acid\";}}s:11:\"idx_uniacid\";a:3:{s:4:\"name\";s:11:\"idx_uniacid\";s:4:\"type\";s:5:\"index\";s:6:\"fields\";a:1:{i:0;s:7:\"uniacid\";}}}}i:1;a:5:{s:9:\"tablename\";s:19:\"ims_core_attachment\";s:7:\"charset\";s:15:\"utf8_general_ci\";s:6:\"engine\";s:6:\"MyISAM\";s:6:\"fields\";a:8:{s:2:\"id\";a:6:{s:4:\"name\";s:2:\"id\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:1;}s:7:\"uniacid\";a:6:{s:4:\"name\";s:7:\"uniacid\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:3:\"uid\";a:6:{s:4:\"name\";s:3:\"uid\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:8:\"filename\";a:6:{s:4:\"name\";s:8:\"filename\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:3:\"255\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:10:\"attachment\";a:6:{s:4:\"name\";s:10:\"attachment\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:3:\"255\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:4:\"type\";a:6:{s:4:\"name\";s:4:\"type\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"3\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:10:\"createtime\";a:6:{s:4:\"name\";s:10:\"createtime\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:17:\"module_upload_dir\";a:6:{s:4:\"name\";s:17:\"module_upload_dir\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:3:\"100\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"PRIMARY\";a:3:{s:4:\"name\";s:7:\"PRIMARY\";s:4:\"type\";s:7:\"primary\";s:6:\"fields\";a:1:{i:0;s:2:\"id\";}}}}i:2;a:5:{s:9:\"tablename\";s:17:\"ims_users_profile\";s:7:\"charset\";s:15:\"utf8_general_ci\";s:6:\"engine\";s:6:\"MyISAM\";s:6:\"fields\";a:47:{s:2:\"id\";a:6:{s:4:\"name\";s:2:\"id\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:1;}s:3:\"uid\";a:6:{s:4:\"name\";s:3:\"uid\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:10:\"createtime\";a:6:{s:4:\"name\";s:10:\"createtime\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:8:\"edittime\";a:6:{s:4:\"name\";s:8:\"edittime\";s:4:\"type\";s:3:\"int\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:8:\"realname\";a:6:{s:4:\"name\";s:8:\"realname\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:8:\"nickname\";a:6:{s:4:\"name\";s:8:\"nickname\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"20\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"avatar\";a:6:{s:4:\"name\";s:6:\"avatar\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:3:\"255\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:2:\"qq\";a:6:{s:4:\"name\";s:2:\"qq\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"15\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"mobile\";a:6:{s:4:\"name\";s:6:\"mobile\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"11\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"fakeid\";a:6:{s:4:\"name\";s:6:\"fakeid\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:3:\"vip\";a:6:{s:4:\"name\";s:3:\"vip\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"3\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:6:\"gender\";a:6:{s:4:\"name\";s:6:\"gender\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"1\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:9:\"birthyear\";a:6:{s:4:\"name\";s:9:\"birthyear\";s:4:\"type\";s:8:\"smallint\";s:6:\"length\";s:1:\"6\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:10:\"birthmonth\";a:6:{s:4:\"name\";s:10:\"birthmonth\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"3\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:8:\"birthday\";a:6:{s:4:\"name\";s:8:\"birthday\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"3\";s:4:\"null\";b:0;s:6:\"signed\";b:0;s:9:\"increment\";b:0;}s:13:\"constellation\";a:6:{s:4:\"name\";s:13:\"constellation\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"zodiac\";a:6:{s:4:\"name\";s:6:\"zodiac\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:1:\"5\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:9:\"telephone\";a:6:{s:4:\"name\";s:9:\"telephone\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"15\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"idcard\";a:6:{s:4:\"name\";s:6:\"idcard\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:9:\"studentid\";a:6:{s:4:\"name\";s:9:\"studentid\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"50\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:5:\"grade\";a:6:{s:4:\"name\";s:5:\"grade\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:7:\"address\";a:6:{s:4:\"name\";s:7:\"address\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:3:\"255\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:7:\"zipcode\";a:6:{s:4:\"name\";s:7:\"zipcode\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:11:\"nationality\";a:6:{s:4:\"name\";s:11:\"nationality\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:14:\"resideprovince\";a:6:{s:4:\"name\";s:14:\"resideprovince\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:10:\"residecity\";a:6:{s:4:\"name\";s:10:\"residecity\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:10:\"residedist\";a:6:{s:4:\"name\";s:10:\"residedist\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:14:\"graduateschool\";a:6:{s:4:\"name\";s:14:\"graduateschool\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"50\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:7:\"company\";a:6:{s:4:\"name\";s:7:\"company\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"50\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:9:\"education\";a:6:{s:4:\"name\";s:9:\"education\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:10:\"occupation\";a:6:{s:4:\"name\";s:10:\"occupation\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:8:\"position\";a:6:{s:4:\"name\";s:8:\"position\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:7:\"revenue\";a:6:{s:4:\"name\";s:7:\"revenue\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"10\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:15:\"affectivestatus\";a:6:{s:4:\"name\";s:15:\"affectivestatus\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:10:\"lookingfor\";a:6:{s:4:\"name\";s:10:\"lookingfor\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:3:\"255\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:9:\"bloodtype\";a:6:{s:4:\"name\";s:9:\"bloodtype\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:1:\"5\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"height\";a:6:{s:4:\"name\";s:6:\"height\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:1:\"5\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"weight\";a:6:{s:4:\"name\";s:6:\"weight\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:1:\"5\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"alipay\";a:6:{s:4:\"name\";s:6:\"alipay\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:3:\"msn\";a:6:{s:4:\"name\";s:3:\"msn\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:5:\"email\";a:6:{s:4:\"name\";s:5:\"email\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"50\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:6:\"taobao\";a:6:{s:4:\"name\";s:6:\"taobao\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:4:\"site\";a:6:{s:4:\"name\";s:4:\"site\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"30\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:3:\"bio\";a:6:{s:4:\"name\";s:3:\"bio\";s:4:\"type\";s:4:\"text\";s:6:\"length\";s:0:\"\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:8:\"interest\";a:6:{s:4:\"name\";s:8:\"interest\";s:4:\"type\";s:4:\"text\";s:6:\"length\";s:0:\"\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:8:\"workerid\";a:6:{s:4:\"name\";s:8:\"workerid\";s:4:\"type\";s:7:\"varchar\";s:6:\"length\";s:2:\"64\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}s:21:\"is_send_mobile_status\";a:6:{s:4:\"name\";s:21:\"is_send_mobile_status\";s:4:\"type\";s:7:\"tinyint\";s:6:\"length\";s:1:\"3\";s:4:\"null\";b:0;s:6:\"signed\";b:1;s:9:\"increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"PRIMARY\";a:3:{s:4:\"name\";s:7:\"PRIMARY\";s:4:\"type\";s:7:\"primary\";s:6:\"fields\";a:1:{i:0;s:2:\"id\";}}}}}s:5:\"files\";a:0:{}s:7:\"scripts\";a:1:{i:0;a:4:{s:7:\"version\";s:3:\"1.0\";s:7:\"release\";s:12:\"201711020003\";s:7:\"message\";s:12:\"微擎升级\";s:6:\"script\";s:176:\"PD9waHANCg0KbG9hZCgpLT5tb2RlbCgnc2V0dGluZycpOw0KY2FjaGVfY2xlYW4oKTsNCg0Kc2V0dGluZ191cGdyYWRlX3ZlcnNpb24oSU1TX0ZBTUlMWSwgJzEuNi4xJywgJzIwMTcxMTAyMDAwMycpOw0KcmV0dXJuIHRydWU7DQo=\";}}s:5:\"token\";s:32:\"e1d692139272c604cad3f8d34b9622c8\";s:4:\"task\";i:10;s:7:\"upgrade\";b:1;}s:10:\"lastupdate\";i:1509940059;}');
INSERT INTO `ims_core_cache` VALUES ('system_frame', 'a:8:{s:7:\"account\";a:7:{s:5:\"title\";s:9:\"公众号\";s:4:\"icon\";s:18:\"wi wi-white-collar\";s:3:\"url\";s:41:\"./index.php?c=home&a=welcome&do=platform&\";s:7:\"section\";a:4:{s:13:\"platform_plus\";a:2:{s:5:\"title\";s:12:\"增强功能\";s:4:\"menu\";a:6:{s:14:\"platform_reply\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"自动回复\";s:3:\"url\";s:31:\"./index.php?c=platform&a=reply&\";s:15:\"permission_name\";s:14:\"platform_reply\";s:4:\"icon\";s:11:\"wi wi-reply\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:13:\"platform_menu\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"自定义菜单\";s:3:\"url\";s:30:\"./index.php?c=platform&a=menu&\";s:15:\"permission_name\";s:13:\"platform_menu\";s:4:\"icon\";s:16:\"wi wi-custommenu\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:11:\"platform_qr\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:22:\"二维码/转化链接\";s:3:\"url\";s:28:\"./index.php?c=platform&a=qr&\";s:15:\"permission_name\";s:11:\"platform_qr\";s:4:\"icon\";s:12:\"wi wi-qrcode\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:18:\"platform_mass_task\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"定时群发\";s:3:\"url\";s:30:\"./index.php?c=platform&a=mass&\";s:15:\"permission_name\";s:18:\"platform_mass_task\";s:4:\"icon\";s:13:\"wi wi-crontab\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:17:\"platform_material\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:16:\"素材/编辑器\";s:3:\"url\";s:34:\"./index.php?c=platform&a=material&\";s:15:\"permission_name\";s:17:\"platform_material\";s:4:\"icon\";s:12:\"wi wi-redact\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:13:\"platform_site\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:16:\"微官网-文章\";s:3:\"url\";s:38:\"./index.php?c=site&a=multi&do=display&\";s:15:\"permission_name\";s:13:\"platform_site\";s:4:\"icon\";s:10:\"wi wi-home\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}}}s:15:\"platform_module\";a:3:{s:5:\"title\";s:12:\"应用模块\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:2:\"mc\";a:2:{s:5:\"title\";s:6:\"粉丝\";s:4:\"menu\";a:2:{s:7:\"mc_fans\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"粉丝管理\";s:3:\"url\";s:24:\"./index.php?c=mc&a=fans&\";s:15:\"permission_name\";s:7:\"mc_fans\";s:4:\"icon\";s:16:\"wi wi-fansmanage\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:9:\"mc_member\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"会员管理\";s:3:\"url\";s:26:\"./index.php?c=mc&a=member&\";s:15:\"permission_name\";s:9:\"mc_member\";s:4:\"icon\";s:10:\"wi wi-fans\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:7:\"profile\";a:2:{s:5:\"title\";s:6:\"配置\";s:4:\"menu\";a:2:{s:7:\"profile\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"参数配置\";s:3:\"url\";s:33:\"./index.php?c=profile&a=passport&\";s:15:\"permission_name\";s:15:\"profile_setting\";s:4:\"icon\";s:23:\"wi wi-parameter-setting\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:7:\"payment\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:32:\"./index.php?c=profile&a=payment&\";s:15:\"permission_name\";s:19:\"profile_pay_setting\";s:4:\"icon\";s:17:\"wi wi-pay-setting\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:1;}s:5:\"wxapp\";a:7:{s:5:\"title\";s:9:\"小程序\";s:4:\"icon\";s:19:\"wi wi-small-routine\";s:3:\"url\";s:38:\"./index.php?c=wxapp&a=display&do=home&\";s:7:\"section\";a:3:{s:14:\"wxapp_entrance\";a:3:{s:5:\"title\";s:15:\"小程序入口\";s:4:\"menu\";a:1:{s:20:\"module_entrance_link\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"入口页面\";s:3:\"url\";s:36:\"./index.php?c=wxapp&a=entrance-link&\";s:15:\"permission_name\";s:19:\"wxapp_entrance_link\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:10:\"is_display\";b:1;}s:12:\"wxapp_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:20:\"platform_manage_menu\";a:2:{s:5:\"title\";s:6:\"管理\";s:4:\"menu\";a:3:{s:11:\"module_link\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:42:\"./index.php?c=wxapp&a=module-link-uniacid&\";s:15:\"permission_name\";s:25:\"wxapp_module_link_uniacid\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:13:\"wxapp_profile\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:30:\"./index.php?c=wxapp&a=payment&\";s:15:\"permission_name\";s:13:\"wxapp_payment\";s:4:\"icon\";s:16:\"wi wi-appsetting\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:14:\"front_download\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"上传微信审核\";s:3:\"url\";s:37:\"./index.php?c=wxapp&a=front-download&\";s:15:\"permission_name\";s:20:\"wxapp_front_download\";s:4:\"icon\";s:13:\"wi wi-examine\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:2;}s:6:\"module\";a:7:{s:5:\"title\";s:6:\"应用\";s:4:\"icon\";s:11:\"wi wi-apply\";s:3:\"url\";s:31:\"./index.php?c=module&a=display&\";s:7:\"section\";a:0:{}s:10:\"is_display\";b:1;s:9:\"is_system\";b:1;s:12:\"displayorder\";i:3;}s:6:\"system\";a:7:{s:5:\"title\";s:12:\"系统管理\";s:4:\"icon\";s:13:\"wi wi-setting\";s:3:\"url\";s:39:\"./index.php?c=home&a=welcome&do=system&\";s:7:\"section\";a:6:{s:10:\"wxplatform\";a:2:{s:5:\"title\";s:9:\"公众号\";s:4:\"menu\";a:4:{s:14:\"system_account\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:16:\" 微信公众号\";s:3:\"url\";s:45:\"./index.php?c=account&a=manage&account_type=1\";s:15:\"permission_name\";s:14:\"system_account\";s:4:\"icon\";s:12:\"wi wi-wechat\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:6:{i:0;a:2:{s:5:\"title\";s:21:\"公众号管理设置\";s:15:\"permission_name\";s:21:\"system_account_manage\";}i:1;a:2:{s:5:\"title\";s:15:\"添加公众号\";s:15:\"permission_name\";s:19:\"system_account_post\";}i:2;a:2:{s:5:\"title\";s:15:\"公众号停用\";s:15:\"permission_name\";s:19:\"system_account_stop\";}i:3;a:2:{s:5:\"title\";s:18:\"公众号回收站\";s:15:\"permission_name\";s:22:\"system_account_recycle\";}i:4;a:2:{s:5:\"title\";s:15:\"公众号删除\";s:15:\"permission_name\";s:21:\"system_account_delete\";}i:5;a:2:{s:5:\"title\";s:15:\"公众号恢复\";s:15:\"permission_name\";s:22:\"system_account_recover\";}}}s:13:\"system_module\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"公众号应用\";s:3:\"url\";s:51:\"./index.php?c=module&a=manage-system&account_type=1\";s:15:\"permission_name\";s:13:\"system_module\";s:4:\"icon\";s:14:\"wi wi-wx-apply\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:15:\"system_template\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"微官网模板\";s:3:\"url\";s:32:\"./index.php?c=system&a=template&\";s:15:\"permission_name\";s:15:\"system_template\";s:4:\"icon\";s:17:\"wi wi-wx-template\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:15:\"system_platform\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:19:\" 微信开放平台\";s:3:\"url\";s:32:\"./index.php?c=system&a=platform&\";s:15:\"permission_name\";s:15:\"system_platform\";s:4:\"icon\";s:20:\"wi wi-exploitsetting\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:6:\"module\";a:2:{s:5:\"title\";s:9:\"小程序\";s:4:\"menu\";a:2:{s:12:\"system_wxapp\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"微信小程序\";s:3:\"url\";s:45:\"./index.php?c=account&a=manage&account_type=4\";s:15:\"permission_name\";s:12:\"system_wxapp\";s:4:\"icon\";s:11:\"wi wi-wxapp\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:6:{i:0;a:2:{s:5:\"title\";s:21:\"小程序管理设置\";s:15:\"permission_name\";s:19:\"system_wxapp_manage\";}i:1;a:2:{s:5:\"title\";s:15:\"添加小程序\";s:15:\"permission_name\";s:17:\"system_wxapp_post\";}i:2;a:2:{s:5:\"title\";s:15:\"小程序停用\";s:15:\"permission_name\";s:17:\"system_wxapp_stop\";}i:3;a:2:{s:5:\"title\";s:18:\"小程序回收站\";s:15:\"permission_name\";s:20:\"system_wxapp_recycle\";}i:4;a:2:{s:5:\"title\";s:15:\"小程序删除\";s:15:\"permission_name\";s:19:\"system_wxapp_delete\";}i:5;a:2:{s:5:\"title\";s:15:\"小程序恢复\";s:15:\"permission_name\";s:20:\"system_wxapp_recover\";}}}s:19:\"system_module_wxapp\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"小程序应用\";s:3:\"url\";s:51:\"./index.php?c=module&a=manage-system&account_type=4\";s:15:\"permission_name\";s:19:\"system_module_wxapp\";s:4:\"icon\";s:17:\"wi wi-wxapp-apply\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:4:\"user\";a:2:{s:5:\"title\";s:13:\"帐户/用户\";s:4:\"menu\";a:2:{s:9:\"system_my\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"我的帐户\";s:3:\"url\";s:29:\"./index.php?c=user&a=profile&\";s:15:\"permission_name\";s:9:\"system_my\";s:4:\"icon\";s:10:\"wi wi-user\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:11:\"system_user\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"用户管理\";s:3:\"url\";s:29:\"./index.php?c=user&a=display&\";s:15:\"permission_name\";s:11:\"system_user\";s:4:\"icon\";s:16:\"wi wi-user-group\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:7:{i:0;a:2:{s:5:\"title\";s:12:\"编辑用户\";s:15:\"permission_name\";s:16:\"system_user_post\";}i:1;a:2:{s:5:\"title\";s:12:\"审核用户\";s:15:\"permission_name\";s:17:\"system_user_check\";}i:2;a:2:{s:5:\"title\";s:12:\"店员管理\";s:15:\"permission_name\";s:17:\"system_user_clerk\";}i:3;a:2:{s:5:\"title\";s:15:\"用户回收站\";s:15:\"permission_name\";s:19:\"system_user_recycle\";}i:4;a:2:{s:5:\"title\";s:18:\"用户属性设置\";s:15:\"permission_name\";s:18:\"system_user_fields\";}i:5;a:2:{s:5:\"title\";s:31:\"用户属性设置-编辑字段\";s:15:\"permission_name\";s:23:\"system_user_fields_post\";}i:6;a:2:{s:5:\"title\";s:18:\"用户注册设置\";s:15:\"permission_name\";s:23:\"system_user_registerset\";}}}}}s:10:\"permission\";a:2:{s:5:\"title\";s:12:\"权限管理\";s:4:\"menu\";a:2:{s:19:\"system_module_group\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"应用权限组\";s:3:\"url\";s:29:\"./index.php?c=module&a=group&\";s:15:\"permission_name\";s:19:\"system_module_group\";s:4:\"icon\";s:21:\"wi wi-appjurisdiction\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:3:{i:0;a:2:{s:5:\"title\";s:21:\"添加应用权限组\";s:15:\"permission_name\";s:23:\"system_module_group_add\";}i:1;a:2:{s:5:\"title\";s:21:\"编辑应用权限组\";s:15:\"permission_name\";s:24:\"system_module_group_post\";}i:2;a:2:{s:5:\"title\";s:21:\"删除应用权限组\";s:15:\"permission_name\";s:23:\"system_module_group_del\";}}}s:17:\"system_user_group\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"用户权限组\";s:3:\"url\";s:27:\"./index.php?c=user&a=group&\";s:15:\"permission_name\";s:17:\"system_user_group\";s:4:\"icon\";s:22:\"wi wi-userjurisdiction\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:3:{i:0;a:2:{s:5:\"title\";s:15:\"添加用户组\";s:15:\"permission_name\";s:21:\"system_user_group_add\";}i:1;a:2:{s:5:\"title\";s:15:\"编辑用户组\";s:15:\"permission_name\";s:22:\"system_user_group_post\";}i:2;a:2:{s:5:\"title\";s:15:\"删除用户组\";s:15:\"permission_name\";s:21:\"system_user_group_del\";}}}}}s:7:\"article\";a:2:{s:5:\"title\";s:13:\"文章/公告\";s:4:\"menu\";a:2:{s:14:\"system_article\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"文章管理\";s:3:\"url\";s:29:\"./index.php?c=article&a=news&\";s:15:\"permission_name\";s:19:\"system_article_news\";s:4:\"icon\";s:13:\"wi wi-article\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:21:\"system_article_notice\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"公告管理\";s:3:\"url\";s:31:\"./index.php?c=article&a=notice&\";s:15:\"permission_name\";s:21:\"system_article_notice\";s:4:\"icon\";s:12:\"wi wi-notice\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:5:\"cache\";a:2:{s:5:\"title\";s:6:\"缓存\";s:4:\"menu\";a:1:{s:26:\"system_setting_updatecache\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"更新缓存\";s:3:\"url\";s:35:\"./index.php?c=system&a=updatecache&\";s:15:\"permission_name\";s:26:\"system_setting_updatecache\";s:4:\"icon\";s:12:\"wi wi-update\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:4;}s:4:\"site\";a:8:{s:5:\"title\";s:12:\"站点管理\";s:4:\"icon\";s:17:\"wi wi-system-site\";s:3:\"url\";s:30:\"./index.php?c=cloud&a=upgrade&\";s:7:\"section\";a:4:{s:5:\"cloud\";a:2:{s:5:\"title\";s:9:\"云服务\";s:4:\"menu\";a:4:{s:14:\"system_profile\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"系统升级\";s:3:\"url\";s:30:\"./index.php?c=cloud&a=upgrade&\";s:15:\"permission_name\";s:20:\"system_cloud_upgrade\";s:4:\"icon\";s:11:\"wi wi-cache\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:21:\"system_cloud_register\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"注册站点\";s:3:\"url\";s:30:\"./index.php?c=cloud&a=profile&\";s:15:\"permission_name\";s:21:\"system_cloud_register\";s:4:\"icon\";s:18:\"wi wi-registersite\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:21:\"system_cloud_diagnose\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"云服务诊断\";s:3:\"url\";s:31:\"./index.php?c=cloud&a=diagnose&\";s:15:\"permission_name\";s:21:\"system_cloud_diagnose\";s:4:\"icon\";s:14:\"wi wi-diagnose\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:16:\"system_cloud_sms\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"短信管理\";s:3:\"url\";s:26:\"./index.php?c=cloud&a=sms&\";s:15:\"permission_name\";s:16:\"system_cloud_sms\";s:4:\"icon\";s:13:\"wi wi-message\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:7:\"setting\";a:2:{s:5:\"title\";s:6:\"设置\";s:4:\"menu\";a:6:{s:19:\"system_setting_site\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"站点设置\";s:3:\"url\";s:28:\"./index.php?c=system&a=site&\";s:15:\"permission_name\";s:19:\"system_setting_site\";s:4:\"icon\";s:18:\"wi wi-site-setting\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_setting_menu\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"菜单设置\";s:3:\"url\";s:28:\"./index.php?c=system&a=menu&\";s:15:\"permission_name\";s:19:\"system_setting_menu\";s:4:\"icon\";s:18:\"wi wi-menu-setting\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_attachment\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"附件设置\";s:3:\"url\";s:34:\"./index.php?c=system&a=attachment&\";s:15:\"permission_name\";s:25:\"system_setting_attachment\";s:4:\"icon\";s:16:\"wi wi-attachment\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_systeminfo\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"系统信息\";s:3:\"url\";s:34:\"./index.php?c=system&a=systeminfo&\";s:15:\"permission_name\";s:25:\"system_setting_systeminfo\";s:4:\"icon\";s:17:\"wi wi-system-info\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_setting_logs\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"查看日志\";s:3:\"url\";s:28:\"./index.php?c=system&a=logs&\";s:15:\"permission_name\";s:19:\"system_setting_logs\";s:4:\"icon\";s:9:\"wi wi-log\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:26:\"system_setting_ipwhitelist\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:11:\"IP白名单\";s:3:\"url\";s:35:\"./index.php?c=system&a=ipwhitelist&\";s:15:\"permission_name\";s:26:\"system_setting_ipwhitelist\";s:4:\"icon\";s:8:\"wi wi-ip\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:7:\"utility\";a:2:{s:5:\"title\";s:12:\"常用工具\";s:4:\"menu\";a:5:{s:24:\"system_utility_filecheck\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"系统文件校验\";s:3:\"url\";s:33:\"./index.php?c=system&a=filecheck&\";s:15:\"permission_name\";s:24:\"system_utility_filecheck\";s:4:\"icon\";s:10:\"wi wi-file\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"system_utility_optimize\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"性能优化\";s:3:\"url\";s:32:\"./index.php?c=system&a=optimize&\";s:15:\"permission_name\";s:23:\"system_utility_optimize\";s:4:\"icon\";s:14:\"wi wi-optimize\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"system_utility_database\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"数据库\";s:3:\"url\";s:32:\"./index.php?c=system&a=database&\";s:15:\"permission_name\";s:23:\"system_utility_database\";s:4:\"icon\";s:9:\"wi wi-sql\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_utility_scan\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"木马查杀\";s:3:\"url\";s:28:\"./index.php?c=system&a=scan&\";s:15:\"permission_name\";s:19:\"system_utility_scan\";s:4:\"icon\";s:12:\"wi wi-safety\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:18:\"system_utility_bom\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"检测文件BOM\";s:3:\"url\";s:27:\"./index.php?c=system&a=bom&\";s:15:\"permission_name\";s:18:\"system_utility_bom\";s:4:\"icon\";s:9:\"wi wi-bom\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:9:\"workorder\";a:2:{s:5:\"title\";s:12:\"工单系统\";s:4:\"menu\";a:1:{s:16:\"system_workorder\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"工单系统\";s:3:\"url\";s:44:\"./index.php?c=system&a=workorder&do=display&\";s:15:\"permission_name\";s:16:\"system_workorder\";s:4:\"icon\";s:17:\"wi wi-system-work\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:7:\"founder\";b:1;s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:5;}s:13:\"advertisement\";a:8:{s:5:\"title\";s:12:\"广告联盟\";s:4:\"icon\";s:12:\"wi wi-advert\";s:3:\"url\";s:47:\"./index.php?c=advertisement&a=content-provider&\";s:7:\"section\";a:1:{s:13:\"advertisement\";a:2:{s:5:\"title\";s:18:\"常用系统工具\";s:4:\"menu\";a:2:{s:30:\"advertisement-content-provider\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"流量主\";s:3:\"url\";s:63:\"./index.php?c=advertisement&a=content-provider&do=account_list&\";s:15:\"permission_name\";s:25:\"advertisement_content-use\";s:4:\"icon\";s:10:\"wi wi-flow\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:28:\"advertisement-content-create\";a:9:{s:9:\"is_system\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"广告主\";s:3:\"url\";s:67:\"./index.php?c=advertisement&a=content-provider&do=content_provider&\";s:15:\"permission_name\";s:28:\"advertisement_content-create\";s:4:\"icon\";s:13:\"wi wi-adgroup\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:7:\"founder\";b:1;s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:6;}s:9:\"appmarket\";a:9:{s:5:\"title\";s:12:\"应用市场\";s:4:\"icon\";s:12:\"wi wi-market\";s:3:\"url\";s:15:\"http://s.we7.cc\";s:7:\"section\";a:0:{}s:5:\"blank\";b:1;s:7:\"founder\";b:1;s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:7;}s:4:\"help\";a:8:{s:5:\"title\";s:12:\"帮助系统\";s:4:\"icon\";s:12:\"wi wi-market\";s:3:\"url\";s:29:\"./index.php?c=help&a=display&\";s:7:\"section\";a:0:{}s:5:\"blank\";b:0;s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:8;}}');
INSERT INTO `ims_core_cache` VALUES ('we7:2:site_store_buy_modules', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:m9idM', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:unimodules::', 'a:13:{s:5:\"basic\";a:1:{s:4:\"name\";s:5:\"basic\";}s:4:\"news\";a:1:{s:4:\"name\";s:4:\"news\";}s:5:\"music\";a:1:{s:4:\"name\";s:5:\"music\";}s:7:\"userapi\";a:1:{s:4:\"name\";s:7:\"userapi\";}s:8:\"recharge\";a:1:{s:4:\"name\";s:8:\"recharge\";}s:6:\"custom\";a:1:{s:4:\"name\";s:6:\"custom\";}s:6:\"images\";a:1:{s:4:\"name\";s:6:\"images\";}s:5:\"video\";a:1:{s:4:\"name\";s:5:\"video\";}s:5:\"voice\";a:1:{s:4:\"name\";s:5:\"voice\";}s:5:\"chats\";a:1:{s:4:\"name\";s:5:\"chats\";}s:6:\"wxcard\";a:1:{s:4:\"name\";s:6:\"wxcard\";}s:14:\"feng_community\";a:1:{s:4:\"name\";s:14:\"feng_community\";}s:7:\"j_money\";a:1:{s:4:\"name\";s:7:\"j_money\";}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:basic', 'a:25:{s:3:\"mid\";s:1:\"1\";s:4:\"name\";s:5:\"basic\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本文字回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:24:\"和您进行简单对话\";s:11:\"description\";s:201:\"一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:56:\"http://wuye.iot-gj.cn/addons/basic/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:news', 'a:25:{s:3:\"mid\";s:1:\"2\";s:4:\"name\";s:4:\"news\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:24:\"基本混合图文回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:33:\"为你提供生动的图文资讯\";s:11:\"description\";s:272:\"一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:55:\"http://wuye.iot-gj.cn/addons/news/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:music', 'a:25:{s:3:\"mid\";s:1:\"3\";s:4:\"name\";s:5:\"music\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本音乐回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:39:\"提供语音、音乐等音频类回复\";s:11:\"description\";s:183:\"在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:56:\"http://wuye.iot-gj.cn/addons/music/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:userapi', 'a:25:{s:3:\"mid\";s:1:\"4\";s:4:\"name\";s:7:\"userapi\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:21:\"自定义接口回复\";s:7:\"version\";s:3:\"1.1\";s:7:\"ability\";s:33:\"更方便的第三方接口设置\";s:11:\"description\";s:141:\"自定义接口又称第三方接口，可以让开发者更方便的接入微擎系统，高效的与微信公众平台进行对接整合。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:58:\"http://wuye.iot-gj.cn/addons/userapi/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:recharge', 'a:25:{s:3:\"mid\";s:1:\"5\";s:4:\"name\";s:8:\"recharge\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:24:\"会员中心充值模块\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:24:\"提供会员充值功能\";s:11:\"description\";s:0:\"\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:59:\"http://wuye.iot-gj.cn/addons/recharge/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:custom', 'a:25:{s:3:\"mid\";s:1:\"6\";s:4:\"name\";s:6:\"custom\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:15:\"多客服转接\";s:7:\"version\";s:5:\"1.0.0\";s:7:\"ability\";s:36:\"用来接入腾讯的多客服系统\";s:11:\"description\";s:0:\"\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:17:\"http://bbs.we7.cc\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";a:0:{}s:7:\"handles\";a:6:{i:0;s:5:\"image\";i:1;s:5:\"voice\";i:2;s:5:\"video\";i:3;s:8:\"location\";i:4;s:4:\"link\";i:5;s:4:\"text\";}s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:57:\"http://wuye.iot-gj.cn/addons/custom/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:images', 'a:25:{s:3:\"mid\";s:1:\"7\";s:4:\"name\";s:6:\"images\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本图片回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"提供图片回复\";s:11:\"description\";s:132:\"在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:57:\"http://wuye.iot-gj.cn/addons/images/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:video', 'a:25:{s:3:\"mid\";s:1:\"8\";s:4:\"name\";s:5:\"video\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本视频回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"提供图片回复\";s:11:\"description\";s:132:\"在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:56:\"http://wuye.iot-gj.cn/addons/video/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:voice', 'a:25:{s:3:\"mid\";s:1:\"9\";s:4:\"name\";s:5:\"voice\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本语音回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"提供语音回复\";s:11:\"description\";s:132:\"在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:56:\"http://wuye.iot-gj.cn/addons/voice/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:chats', 'a:25:{s:3:\"mid\";s:2:\"10\";s:4:\"name\";s:5:\"chats\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"发送客服消息\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:77:\"公众号可以在粉丝最后发送消息的48小时内无限制发送消息\";s:11:\"description\";s:0:\"\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:56:\"http://wuye.iot-gj.cn/addons/chats/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:wxcard', 'a:25:{s:3:\"mid\";s:2:\"11\";s:4:\"name\";s:6:\"wxcard\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"微信卡券回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"微信卡券回复\";s:11:\"description\";s:18:\"微信卡券回复\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:57:\"http://wuye.iot-gj.cn/addons/wxcard/icon.jpg?v=1508743514\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:dZM66', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('accesstoken:2', 'a:2:{s:5:\"token\";s:138:\"grXhgaWV3vS9SDvBcsN2zE-FCsLsL95aMX7aVsTMq-bxL013TnizS4HtX2p_g2GEy7GzPce7PH8ZHkFkkGRsH5hOWDG0i4kfFCdNJbqQ4t6OMPrACAvkbflhQqzi8l2ySNHbAEAMHB\";s:6:\"expire\";i:1510130473;}');
INSERT INTO `ims_core_cache` VALUES ('unicount:2', 's:1:\"1\";');
INSERT INTO `ims_core_cache` VALUES ('stat:todaylock:2', 'a:1:{s:6:\"expire\";i:1510118237;}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:xB5OM', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:feng_community', 'a:25:{s:3:\"mid\";s:2:\"12\";s:4:\"name\";s:14:\"feng_community\";s:4:\"type\";s:8:\"business\";s:5:\"title\";s:9:\"微小区\";s:7:\"version\";s:9:\"9.2.8.3.0\";s:7:\"ability\";s:9:\"微小区\";s:11:\"description\";s:9:\"微小区\";s:6:\"author\";s:12:\"蓝牛科技\";s:3:\"url\";s:9:\"we7xq.com\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";a:0:{}s:7:\"handles\";a:0:{}s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"0\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:2:\"N;\";s:13:\"title_initial\";s:1:\"W\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:65:\"http://wuye.iot-gj.cn/addons/feng_community/icon.jpg?v=1508830096\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:3:{i:0;s:25:\"feng_community_plugin_adv\";i:1;s:26:\"feng_community_plugin_lift\";i:2;s:30:\"feng_community_plugin_chinaums\";}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:all_cloud_upgrade_module:', 'a:2:{s:6:\"expire\";i:1508831894;s:4:\"data\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module:all_uninstall', 'a:2:{s:6:\"expire\";i:1511367084;s:4:\"data\";a:4:{s:13:\"cloud_m_count\";N;s:7:\"modules\";a:2:{s:7:\"recycle\";a:0:{}s:11:\"uninstalled\";a:0:{}}s:9:\"app_count\";i:0;s:11:\"wxapp_count\";i:0;}}');
INSERT INTO `ims_core_cache` VALUES ('we7:uni_group', 'a:1:{i:1;a:7:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:18:\"体验套餐服务\";s:7:\"modules\";a:1:{s:14:\"feng_community\";a:25:{s:3:\"mid\";s:2:\"12\";s:4:\"name\";s:14:\"feng_community\";s:4:\"type\";s:8:\"business\";s:5:\"title\";s:9:\"微小区\";s:7:\"version\";s:9:\"9.2.8.3.0\";s:7:\"ability\";s:9:\"微小区\";s:11:\"description\";s:9:\"微小区\";s:6:\"author\";s:12:\"蓝牛科技\";s:3:\"url\";s:9:\"we7xq.com\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";a:0:{}s:7:\"handles\";a:0:{}s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"0\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:2:\"N;\";s:13:\"title_initial\";s:1:\"W\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:65:\"http://wuye.iot-gj.cn/addons/feng_community/icon.jpg?v=1508830096\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:3:{i:0;s:25:\"feng_community_plugin_adv\";i:1;s:26:\"feng_community_plugin_lift\";i:2;s:30:\"feng_community_plugin_chinaums\";}s:11:\"is_relation\";b:0;}}s:9:\"templates\";s:2:\"N;\";s:7:\"uniacid\";s:1:\"0\";s:9:\"owner_uid\";s:1:\"0\";s:5:\"wxapp\";a:0:{}}}');
INSERT INTO `ims_core_cache` VALUES ('cloud:ad:uniaccount:list', 'a:2:{s:6:\"expire\";i:1508901611;s:7:\"setting\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:21', 'a:52:{s:3:\"uid\";s:2:\"21\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:11:\"15007557816\";s:5:\"email\";s:39:\"3bad7aff52f570d90254c98869eb1fe6@we7.cc\";s:8:\"password\";s:32:\"91c67f8cb92e6f9333fc982e866e2660\";s:4:\"salt\";s:8:\"ynA1Z7nC\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1504837963\";s:8:\"realname\";s:9:\"施思华\";s:8:\"nickname\";s:3:\"施\";s:6:\"avatar\";s:134:\"http://wx.qlogo.cn/mmopen/Xu4ibibST7Y3PHK9jlbVJiaXJ0zGkhq2Ua2TvamicR5rqbUbzGMtB13Xic7Cy2L9cZ9iaibfabjfp4WvUXUca8T80Z3GCxGrIiby4kwS/132\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('defaultgroupid:2', 's:1:\"2\";');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:15', 'a:52:{s:3:\"uid\";s:2:\"15\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:11:\"13724303493\";s:5:\"email\";s:39:\"60a7a2fcd524b6241665b12af0a25342@we7.cc\";s:8:\"password\";s:32:\"a0b511c4fab2ca84ec9851ea1a0f4522\";s:4:\"salt\";s:8:\"OreRCUcd\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1504682127\";s:8:\"realname\";s:9:\"段利华\";s:8:\"nickname\";s:3:\"华\";s:6:\"avatar\";s:143:\"http://wx.qlogo.cn/mmopen/PiajxSqBRaEKiaLDIHJic1mRCmxyF6bftktiaQNHZysBCviawbTsYPs6TqDDLeROtQQ47KbIVpoKJmpPu9ETlRyicWGeWgYwTJSbEKqTRoupvQzAM/132\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('module_receive_enable', 'a:6:{s:9:\"subscribe\";a:1:{i:0;s:7:\"j_money\";}s:13:\"user_get_card\";a:1:{i:0;s:7:\"j_money\";}s:17:\"user_consume_card\";a:1:{i:0;s:7:\"j_money\";}s:18:\"update_member_card\";a:1:{i:0;s:7:\"j_money\";}s:14:\"user_view_card\";a:1:{i:0;s:7:\"j_money\";}s:27:\"submit_membercard_user_info\";a:1:{i:0;s:7:\"j_money\";}}');
INSERT INTO `ims_core_cache` VALUES ('jsticket:2', 'a:2:{s:6:\"ticket\";s:86:\"kgt8ON7yVITDhtdwci0qeW-STSPw54pgdqkA5YsTloxN80cYwN3-fbWcnVUWpS7zpfwt4dn3UltUeef8r0hqJg\";s:6:\"expire\";i:1510130473;}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:3', 'a:52:{s:3:\"uid\";s:1:\"3\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:11:\"18018777751\";s:5:\"email\";s:39:\"86fd54160882e764aa9d9592786edb92@we7.cc\";s:8:\"password\";s:32:\"fea83e74f17742bde998fc7d0fc69454\";s:4:\"salt\";s:8:\"dbBFb5vQ\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1502270740\";s:8:\"realname\";s:6:\"刘波\";s:8:\"nickname\";s:0:\"\";s:6:\"avatar\";s:0:\"\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:40', 'a:52:{s:3:\"uid\";s:2:\"40\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:0:\"\";s:5:\"email\";s:39:\"4b4e25732857f944c9e68082823504d2@we7.cc\";s:8:\"password\";s:32:\"3b73a3c850734969ad3859cc2a9959ab\";s:4:\"salt\";s:8:\"Cn1mN555\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1506484043\";s:8:\"realname\";s:0:\"\";s:8:\"nickname\";s:6:\"韦宜\";s:6:\"avatar\";s:130:\"http://wx.qlogo.cn/mmopen/rK1nsTlCD8GMU4slq5OibsiagbMANA0ZLCJWmTsfjdnY4RIxxjjXe8v6rficB5K3gs0lziaD7tZz972xL5fe8UmrpLEvwBawSNRH/132\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:zcfEy', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7::site_store_buy_modules', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:j_money', 'a:25:{s:3:\"mid\";s:2:\"13\";s:4:\"name\";s:7:\"j_money\";s:4:\"type\";s:8:\"services\";s:5:\"title\";s:15:\"捷讯收银台\";s:7:\"version\";s:4:\"2.94\";s:7:\"ability\";s:15:\"捷讯收银台\";s:11:\"description\";s:15:\"捷讯收银台\";s:6:\"author\";s:8:\"ccrenway\";s:3:\"url\";s:22:\"https://www.admincn.cc\";s:8:\"settings\";s:1:\"1\";s:10:\"subscribes\";a:7:{i:0;s:4:\"text\";i:1;s:9:\"subscribe\";i:2;s:13:\"user_get_card\";i:3;s:17:\"user_consume_card\";i:4;s:18:\"update_member_card\";i:5;s:14:\"user_view_card\";i:6;s:27:\"submit_membercard_user_info\";}s:7:\"handles\";a:1:{i:0;s:4:\"text\";}s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"0\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:6:\"a:0:{}\";s:13:\"title_initial\";s:1:\"J\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:9:\"isdisplay\";i:1;s:4:\"logo\";s:64:\"http://web.posapp.my/addons/j_money/icon-custom.jpg?v=1510125361\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:11:\"is_relation\";b:0;}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:jJR1r', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:2', 'a:52:{s:3:\"uid\";s:1:\"2\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:11:\"18577384028\";s:5:\"email\";s:39:\"38ccf0390f052253322706e550ae8913@we7.cc\";s:8:\"password\";s:32:\"5a6d416bef8d8b7810a0bb6bd9a716fe\";s:4:\"salt\";s:8:\"XUo6lvZe\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1507773332\";s:8:\"realname\";s:9:\"祖脉罗\";s:8:\"nickname\";s:0:\"\";s:6:\"avatar\";s:0:\"\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:m94Mb', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:IEe6L', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:48', 'a:52:{s:3:\"uid\";s:2:\"48\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:0:\"\";s:5:\"email\";s:39:\"728032389563d9d4d097db6f66cb6bc9@we7.cc\";s:8:\"password\";s:32:\"d7f90daca15348f1b2d4ba000b96cb32\";s:4:\"salt\";s:8:\"TTxpstSi\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1509338797\";s:8:\"realname\";s:0:\"\";s:8:\"nickname\";s:9:\"毛明中\";s:6:\"avatar\";s:143:\"http://wx.qlogo.cn/mmopen/Q3auHgzwzM5OzOfk8vjACN8DsNbWaLGUaGbWt8mWI3upAwiag0IazwqqN5Uu3QIyXribCiaMVxjtR4ls7P7VoibIxibLloQqXibKvdRJHZtVdyA64/132\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:50', 'a:52:{s:3:\"uid\";s:2:\"50\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:0:\"\";s:5:\"email\";s:39:\"741782dc388815d731de12d56d0af5eb@we7.cc\";s:8:\"password\";s:32:\"23f61c2e233062c0dc2d791a564dedab\";s:4:\"salt\";s:8:\"J7tDg7wl\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1509434405\";s:8:\"realname\";s:0:\"\";s:8:\"nickname\";s:6:\"一艾\";s:6:\"avatar\";s:131:\"http://wx.qlogo.cn/mmopen/DmT7Jv63qj3ncFxD23RFjbEshiclicmpjj77HrfVL4686JSjJiaVmf1wO9tb0OrXsicQKKafO6QhrzY9ibxVhr8O9B2RS1EwxRK8D/132\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:51', 'a:52:{s:3:\"uid\";s:2:\"51\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:0:\"\";s:5:\"email\";s:39:\"98592148c293ac7fbdbb34ad0cda8909@we7.cc\";s:8:\"password\";s:32:\"1983a1a8087216979cb9d3c4dc3256cf\";s:4:\"salt\";s:8:\"zW55nEcR\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1509434640\";s:8:\"realname\";s:0:\"\";s:8:\"nickname\";s:6:\"悟空\";s:6:\"avatar\";s:129:\"http://wx.qlogo.cn/mmopen/0tIQPw8HCrOeG5ra2k9srTaYB1NAf5iadJrA6teAbGm8LQPDqyBWVn1h2yp8MFVdvPgYEGsUXVUSdWeVmiaGQzx61WDiazJUz9s/132\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:5', 'a:52:{s:3:\"uid\";s:1:\"5\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:0:\"\";s:5:\"email\";s:39:\"1d4e0b78c8d337c6fa64258e96d21b76@we7.cc\";s:8:\"password\";s:32:\"d66326397e3bd60c696fe4e4ae6ff56e\";s:4:\"salt\";s:8:\"z1Ob6vKs\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1503454770\";s:8:\"realname\";s:0:\"\";s:8:\"nickname\";s:9:\"Catanlina\";s:6:\"avatar\";s:121:\"http://wx.qlogo.cn/mmopen/ajNVdqHZLLCHoicN0cUiacImvia3qdT1NppdHQSNlxV2EGcwxs4pUpaXwT22N3pRUQiaOziaBcSZ3unjC40woaqngjA/132\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:1', 'a:52:{s:3:\"uid\";s:1:\"1\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:11:\"15240694132\";s:5:\"email\";s:39:\"fdb7b2824b9d173764acb579653d70a4@we7.cc\";s:8:\"password\";s:32:\"89ca75a742af0f2a2f4c76e29930fba7\";s:4:\"salt\";s:8:\"BgBOJpSS\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:9867;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1507773288\";s:8:\"realname\";s:9:\"庞金龙\";s:8:\"nickname\";s:0:\"\";s:6:\"avatar\";s:0:\"\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:memberinfo:4', 'a:52:{s:3:\"uid\";s:1:\"4\";s:7:\"uniacid\";s:1:\"2\";s:6:\"mobile\";s:11:\"13554717055\";s:5:\"email\";s:39:\"d7b96e21d912f927720f722ea3f26310@we7.cc\";s:8:\"password\";s:32:\"53315d47652278f4e382caa8819b480a\";s:4:\"salt\";s:8:\"TjID5ef4\";s:7:\"groupid\";s:1:\"2\";s:7:\"credit1\";d:0;s:7:\"credit2\";d:0;s:7:\"credit3\";d:0;s:7:\"credit4\";d:0;s:7:\"credit5\";d:0;s:7:\"credit6\";d:0;s:10:\"createtime\";s:10:\"1502349686\";s:8:\"realname\";s:6:\"周刚\";s:8:\"nickname\";s:0:\"\";s:6:\"avatar\";s:0:\"\";s:2:\"qq\";s:0:\"\";s:3:\"vip\";s:1:\"0\";s:6:\"gender\";s:1:\"0\";s:9:\"birthyear\";s:1:\"0\";s:10:\"birthmonth\";s:1:\"0\";s:8:\"birthday\";s:1:\"0\";s:13:\"constellation\";s:0:\"\";s:6:\"zodiac\";s:0:\"\";s:9:\"telephone\";s:0:\"\";s:6:\"idcard\";s:0:\"\";s:9:\"studentid\";s:0:\"\";s:5:\"grade\";s:0:\"\";s:7:\"address\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:11:\"nationality\";s:0:\"\";s:14:\"resideprovince\";s:0:\"\";s:10:\"residecity\";s:0:\"\";s:10:\"residedist\";s:0:\"\";s:14:\"graduateschool\";s:0:\"\";s:7:\"company\";s:0:\"\";s:9:\"education\";s:0:\"\";s:10:\"occupation\";s:0:\"\";s:8:\"position\";s:0:\"\";s:7:\"revenue\";s:0:\"\";s:15:\"affectivestatus\";s:0:\"\";s:10:\"lookingfor\";s:0:\"\";s:9:\"bloodtype\";s:0:\"\";s:6:\"height\";s:0:\"\";s:6:\"weight\";s:0:\"\";s:6:\"alipay\";s:0:\"\";s:3:\"msn\";s:0:\"\";s:6:\"taobao\";s:0:\"\";s:4:\"site\";s:0:\"\";s:3:\"bio\";s:0:\"\";s:8:\"interest\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:gQ38j', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:h70vP', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:sc2rO', 'a:1:{s:7:\"account\";i:2;}');
INSERT INTO `ims_core_cache` VALUES ('we7:unimodules:2:', 'a:13:{s:5:\"basic\";a:1:{s:4:\"name\";s:5:\"basic\";}s:4:\"news\";a:1:{s:4:\"name\";s:4:\"news\";}s:5:\"music\";a:1:{s:4:\"name\";s:5:\"music\";}s:7:\"userapi\";a:1:{s:4:\"name\";s:7:\"userapi\";}s:8:\"recharge\";a:1:{s:4:\"name\";s:8:\"recharge\";}s:6:\"custom\";a:1:{s:4:\"name\";s:6:\"custom\";}s:6:\"images\";a:1:{s:4:\"name\";s:6:\"images\";}s:5:\"video\";a:1:{s:4:\"name\";s:5:\"video\";}s:5:\"voice\";a:1:{s:4:\"name\";s:5:\"voice\";}s:5:\"chats\";a:1:{s:4:\"name\";s:5:\"chats\";}s:6:\"wxcard\";a:1:{s:4:\"name\";s:6:\"wxcard\";}s:14:\"feng_community\";a:1:{s:4:\"name\";s:14:\"feng_community\";}s:7:\"j_money\";a:1:{s:4:\"name\";s:7:\"j_money\";}}');
INSERT INTO `ims_core_cache` VALUES ('we7:unimodules:2:1', 'a:13:{s:5:\"basic\";a:1:{s:4:\"name\";s:5:\"basic\";}s:4:\"news\";a:1:{s:4:\"name\";s:4:\"news\";}s:5:\"music\";a:1:{s:4:\"name\";s:5:\"music\";}s:7:\"userapi\";a:1:{s:4:\"name\";s:7:\"userapi\";}s:8:\"recharge\";a:1:{s:4:\"name\";s:8:\"recharge\";}s:6:\"custom\";a:1:{s:4:\"name\";s:6:\"custom\";}s:6:\"images\";a:1:{s:4:\"name\";s:6:\"images\";}s:5:\"video\";a:1:{s:4:\"name\";s:5:\"video\";}s:5:\"voice\";a:1:{s:4:\"name\";s:5:\"voice\";}s:5:\"chats\";a:1:{s:4:\"name\";s:5:\"chats\";}s:6:\"wxcard\";a:1:{s:4:\"name\";s:6:\"wxcard\";}s:14:\"feng_community\";a:1:{s:4:\"name\";s:14:\"feng_community\";}s:7:\"j_money\";a:1:{s:4:\"name\";s:7:\"j_money\";}}');
INSERT INTO `ims_core_cache` VALUES ('unicount:', 's:1:\"0\";');
INSERT INTO `ims_core_cache` VALUES ('we7:lastaccount:Vhy43', 'a:1:{s:7:\"account\";i:2;}');

-- ----------------------------
-- Table structure for ims_core_cron
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_cron`;
CREATE TABLE `ims_core_cron` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cloudid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `lastruntime` int(10) unsigned NOT NULL,
  `nextruntime` int(10) unsigned NOT NULL,
  `weekday` tinyint(3) NOT NULL,
  `day` tinyint(3) NOT NULL,
  `hour` tinyint(3) NOT NULL,
  `minute` varchar(255) NOT NULL,
  `extra` varchar(5000) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createtime` (`createtime`),
  KEY `nextruntime` (`nextruntime`),
  KEY `uniacid` (`uniacid`),
  KEY `cloudid` (`cloudid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_cron
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_cron_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_cron_record`;
CREATE TABLE `ims_core_cron_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `note` varchar(500) NOT NULL,
  `tag` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `tid` (`tid`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_cron_record
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_menu
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_menu`;
CREATE TABLE `ims_core_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `title` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `append_title` varchar(30) NOT NULL,
  `append_url` varchar(255) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_system` tinyint(3) unsigned NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_menu
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_paylog
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_paylog`;
CREATE TABLE `ims_core_paylog` (
  `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `acid` int(10) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `tid` varchar(128) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `tag` varchar(2000) NOT NULL,
  `is_usecard` tinyint(3) unsigned NOT NULL,
  `card_type` tinyint(3) unsigned NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `card_fee` decimal(10,2) unsigned NOT NULL,
  `encrypt_code` varchar(100) NOT NULL,
  PRIMARY KEY (`plid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_tid` (`tid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `uniontid` (`uniontid`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_paylog
-- ----------------------------
INSERT INTO `ims_core_paylog` VALUES ('1', '', '2', '2', '1', '', '20170809161248889688', '10.00', '0', 'feng_community', '', '0', '0', '', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('2', 'alipay', '2', '2', '1', '2017080916134200001242851520', '20170809161385924499', '10.00', '0', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('3', '', '2', '2', '1', '', '20170809172182828242', '1.00', '0', 'feng_community', '', '0', '0', '', '1.00', '');
INSERT INTO `ims_core_paylog` VALUES ('4', 'alipay', '2', '2', '1', '2017080917401400001276700856', '20170809174062234425', '100.00', '0', 'feng_community', '', '0', '0', '0', '100.00', '');
INSERT INTO `ims_core_paylog` VALUES ('5', 'alipay', '2', '2', '1', '2017080917432000001222682498', '20170809174321788884', '100.00', '0', 'feng_community', '', '0', '0', '0', '100.00', '');
INSERT INTO `ims_core_paylog` VALUES ('6', '', '2', '2', '1', '', '20170809175368048361', '10.00', '0', 'feng_community', '', '0', '0', '', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('7', 'alipay', '2', '2', '2', '2017080918130300001296047247', '20170809181291312308', '10.00', '0', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('8', '', '2', '2', '1', '', '20170809184062219762', '1.00', '0', 'feng_community', '', '0', '0', '', '1.00', '');
INSERT INTO `ims_core_paylog` VALUES ('9', 'credit', '2', '2', '1', '2017080918421800001219142672', '20170809184268843810', '1.00', '1', 'feng_community', '', '0', '0', '0', '1.00', '');
INSERT INTO `ims_core_paylog` VALUES ('10', '', '2', '2', 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', '', '20170809184222766629', '100.00', '0', 'feng_community', '', '0', '0', '', '100.00', '');
INSERT INTO `ims_core_paylog` VALUES ('11', 'credit', '2', '2', 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', '2017080918430100001292312124', '20170809184226921402', '100.00', '1', 'feng_community', '', '0', '0', '0', '100.00', '');
INSERT INTO `ims_core_paylog` VALUES ('12', 'credit', '2', '2', '1', '2017080918440300001288126766', '20170809184448066432', '10.00', '1', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('13', 'credit', '2', '2', '1', '2017081010502000001288853204', '20170810104943680846', '10.00', '1', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('14', 'delivery', '2', '2', '2', '2017101210032200001280878668', '20171012100381282129', '10.00', '0', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('15', 'alipay', '2', '2', '37', '2017101221454000001288848184', '20171012214593449449', '21.00', '0', 'feng_community', '', '0', '0', '0', '21.00', '');
INSERT INTO `ims_core_paylog` VALUES ('16', 'credit', '2', '2', '38', '2017101223131400001287222286', '20171012231295410917', '10.00', '0', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('17', '', '2', '2', '38', '', '20171012231363282784', '12.00', '0', 'feng_community', '', '0', '0', '', '12.00', '');
INSERT INTO `ims_core_paylog` VALUES ('18', 'alipay', '2', '2', '37', '2017101223483600001293586276', '20171012234865288031', '21.00', '0', 'feng_community', '', '0', '0', '0', '21.00', '');
INSERT INTO `ims_core_paylog` VALUES ('19', 'credit', '2', '2', '38', '2017101223485100001224263831', '20171012234884763864', '10.00', '0', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('20', 'delivery', '2', '2', '37', '2017101223491400001243384639', '20171012234948623265', '12.00', '0', 'feng_community', '', '0', '0', '0', '12.00', '');
INSERT INTO `ims_core_paylog` VALUES ('21', 'alipay', '2', '2', '38', '2017101223491100001252736246', '20171012234924743542', '10.00', '0', 'feng_community', '', '0', '0', '0', '10.00', '');
INSERT INTO `ims_core_paylog` VALUES ('22', '', '2', '2', '38', '', '20171012234908528638', '21.00', '0', 'feng_community', '', '0', '0', '', '21.00', '');
INSERT INTO `ims_core_paylog` VALUES ('23', 'credit', '2', '2', '1', '2017102417092500001248678442', '20171024170902884838', '12.00', '1', 'feng_community', '', '0', '0', '0', '12.00', '');
INSERT INTO `ims_core_paylog` VALUES ('24', '', '2', '2', '2', '', '20171025112628882620', '21.00', '0', 'feng_community', '', '0', '0', '', '21.00', '');

-- ----------------------------
-- Table structure for ims_core_performance
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_performance`;
CREATE TABLE `ims_core_performance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `runtime` varchar(10) NOT NULL,
  `runurl` varchar(512) NOT NULL,
  `runsql` varchar(512) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_performance
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_queue
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_queue`;
CREATE TABLE `ims_core_queue` (
  `qid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `message` varchar(2000) NOT NULL,
  `params` varchar(1000) NOT NULL,
  `keyword` varchar(1000) NOT NULL,
  `response` varchar(2000) NOT NULL,
  `module` varchar(50) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `uniacid` (`uniacid`,`acid`),
  KEY `module` (`module`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_queue
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_refundlog
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_refundlog`;
CREATE TABLE `ims_core_refundlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `refund_uniontid` varchar(64) NOT NULL,
  `reason` varchar(80) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `refund_uniontid` (`refund_uniontid`),
  KEY `uniontid` (`uniontid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_refundlog
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_resource
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_resource`;
CREATE TABLE `ims_core_resource` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `trunk` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `acid` (`uniacid`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_resource
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_sendsms_log
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_sendsms_log`;
CREATE TABLE `ims_core_sendsms_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_sendsms_log
-- ----------------------------

-- ----------------------------
-- Table structure for ims_core_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_sessions`;
CREATE TABLE `ims_core_sessions` (
  `sid` char(32) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `data` varchar(5000) NOT NULL,
  `expiretime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_sessions
-- ----------------------------
INSERT INTO `ims_core_sessions` VALUES ('8d9690f1dd41c410a4f7ffea9bf7e589', '2', '127.0.0.1', 'acid|s:1:\"2\";uniacid|i:2;token|a:1:{s:4:\"whKw\";i:1510622282;}', '1510625882');
INSERT INTO `ims_core_sessions` VALUES ('470f8fe70a8f5ae43e4f636fc6f5a04c', '2', '127.0.0.1', 'acid|s:1:\"2\";uniacid|i:2;token|a:4:{s:4:\"JU13\";i:1511517302;s:4:\"Q93R\";i:1511517303;s:4:\"YA8g\";i:1511517315;s:4:\"m1UO\";i:1511517365;}', '1511520965');

-- ----------------------------
-- Table structure for ims_core_settings
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_settings`;
CREATE TABLE `ims_core_settings` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_settings
-- ----------------------------
INSERT INTO `ims_core_settings` VALUES ('copyright', 'a:2:{s:6:\"status\";s:1:\"0\";s:6:\"reason\";s:15:\"备份数据库\";}');
INSERT INTO `ims_core_settings` VALUES ('module_receive_ban', 'a:1:{s:14:\"feng_community\";s:14:\"feng_community\";}');
INSERT INTO `ims_core_settings` VALUES ('authmode', 'i:1;');
INSERT INTO `ims_core_settings` VALUES ('close', 'a:2:{s:6:\"status\";s:1:\"0\";s:6:\"reason\";s:0:\"\";}');
INSERT INTO `ims_core_settings` VALUES ('register', 'a:4:{s:4:\"open\";i:1;s:6:\"verify\";i:0;s:4:\"code\";i:1;s:7:\"groupid\";i:1;}');
INSERT INTO `ims_core_settings` VALUES ('site', 'a:6:{s:3:\"key\";s:5:\"99202\";s:5:\"token\";s:32:\"b37028cd06062ddb1aefe69b4a5c4be5\";s:3:\"url\";s:21:\"http://wuye.iot-gj.cn\";s:7:\"version\";s:3:\"1.0\";s:6:\"family\";s:1:\"v\";s:15:\"profile_perfect\";b:1;}');
INSERT INTO `ims_core_settings` VALUES ('cloudip', 'a:0:{}');
INSERT INTO `ims_core_settings` VALUES ('module_ban', 'a:0:{}');
INSERT INTO `ims_core_settings` VALUES ('module_upgrade', 'a:0:{}');
INSERT INTO `ims_core_settings` VALUES ('sms.info', 'a:3:{s:3:\"key\";s:5:\"99202\";s:8:\"sms_sign\";a:0:{}s:9:\"sms_count\";i:0;}');
INSERT INTO `ims_core_settings` VALUES ('platform', 'a:5:{s:5:\"token\";s:32:\"itKThGnTgGk9gzszSFshShcJhkkgs5tC\";s:14:\"encodingaeskey\";s:43:\"hOq7yAkNrYfPAfqCKYFpofP66N26PkCPFAabY6f7pny\";s:9:\"appsecret\";s:0:\"\";s:5:\"appid\";s:0:\"\";s:9:\"authstate\";i:1;}');

-- ----------------------------
-- Table structure for ims_coupon_location
-- ----------------------------
DROP TABLE IF EXISTS `ims_coupon_location`;
CREATE TABLE `ims_coupon_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `province` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `district` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `longitude` varchar(15) NOT NULL,
  `latitude` varchar(15) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `photo_list` varchar(10000) NOT NULL,
  `avg_price` int(10) unsigned NOT NULL,
  `open_time` varchar(50) NOT NULL,
  `recommend` varchar(255) NOT NULL,
  `special` varchar(255) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `offset_type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_coupon_location
-- ----------------------------

-- ----------------------------
-- Table structure for ims_cover_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_cover_reply`;
CREATE TABLE `ims_cover_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL,
  `do` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_cover_reply
-- ----------------------------
INSERT INTO `ims_cover_reply` VALUES ('1', '1', '0', '7', 'mc', '', '进入个人中心', '', '', './index.php?c=mc&a=home&i=1');
INSERT INTO `ims_cover_reply` VALUES ('2', '1', '1', '8', 'site', '', '进入首页', '', '', './index.php?c=home&i=1&t=1');
INSERT INTO `ims_cover_reply` VALUES ('3', '2', '0', '9', 'feng_community', 'home', '嘉洲富苑', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/K5vvluqlK646n58l7E65L778BPTO8e.jpg', './index.php?i=2&c=entry&do=home&m=feng_community');
INSERT INTO `ims_cover_reply` VALUES ('4', '2', '0', '10', 'feng_community', 'home', '嘉洲富苑', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/09/Ec4dMjmceD4Jlm3jjLVHgT4COL4cEj.jpg', './index.php?i=2&c=entry&regionid=1&do=home&m=feng_community');
INSERT INTO `ims_cover_reply` VALUES ('5', '2', '0', '11', 'feng_community', 'business', '多多母婴', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/rnfN4siTpGguUGu2NfE3tguN3ungiU.jpg', './index.php?i=2&c=entry&op=detail&id=1&do=business&m=feng_community');

-- ----------------------------
-- Table structure for ims_custom_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_custom_reply`;
CREATE TABLE `ims_custom_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `start1` int(10) NOT NULL,
  `end1` int(10) NOT NULL,
  `start2` int(10) NOT NULL,
  `end2` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_custom_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_images_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_images_reply`;
CREATE TABLE `ims_images_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_images_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_article
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_article`;
CREATE TABLE `ims_j_money_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `thumb` varchar(300) NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `prizetype` tinyint(1) NOT NULL DEFAULT '0',
  `favorable` varchar(50) NOT NULL DEFAULT '',
  `starttime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `content` text NOT NULL COMMENT '详情',
  `viewcount` int(10) NOT NULL DEFAULT '0',
  `sharecount` int(10) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_article
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_award
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_award`;
CREATE TABLE `ims_j_money_award` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned NOT NULL COMMENT '活动ID',
  `level` varchar(255) DEFAULT NULL COMMENT '奖品等级',
  `thumb` varchar(255) DEFAULT NULL COMMENT '奖品图片',
  `prizetype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '奖品类型，0实物，1红包，2卡券',
  `leavel` int(10) NOT NULL COMMENT '奖品级别',
  `title` varchar(50) NOT NULL COMMENT '奖品名称',
  `isprize` tinyint(1) NOT NULL DEFAULT '0',
  `renum` int(10) NOT NULL DEFAULT '0' COMMENT '数量',
  `total` int(10) NOT NULL DEFAULT '0' COMMENT '数量',
  `probalilty` varchar(5) NOT NULL COMMENT '概率单位%',
  `deg` int(5) NOT NULL COMMENT '角度',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '描述',
  `credit` int(11) NOT NULL COMMENT '奖励积分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_award
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_cardticket
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_cardticket`;
CREATE TABLE `ims_j_money_cardticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `ticket` varchar(600) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_cardticket
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_carduser
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_carduser`;
CREATE TABLE `ims_j_money_carduser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '回复标题',
  `sub_title` varchar(50) NOT NULL COMMENT '回复标题',
  `type` varchar(20) NOT NULL COMMENT '回复标题',
  `extra` varchar(50) NOT NULL COMMENT '回复标题',
  `openid` varchar(50) NOT NULL COMMENT '回复标题',
  `userid` int(10) NOT NULL COMMENT '收银员账号',
  `groupid` int(10) NOT NULL COMMENT '收银员账号',
  `cardid` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(30) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL COMMENT '卡券作用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_carduser
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_extend
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_extend`;
CREATE TABLE `ims_j_money_extend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `btnname` varchar(50) NOT NULL COMMENT '按钮名称',
  `btnurl` varchar(300) NOT NULL COMMENT '连接',
  `jsurl` varchar(300) NOT NULL COMMENT 'js文件',
  `cssurl` varchar(300) NOT NULL COMMENT 'css文件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_extend
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_fans`;
CREATE TABLE `ims_j_money_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `marketid` int(10) unsigned NOT NULL DEFAULT '0',
  `favorabletype` tinyint(1) NOT NULL DEFAULT '0',
  `favorable` varchar(50) NOT NULL COMMENT 'favorable',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `log` varchar(100) NOT NULL COMMENT 'log',
  `createtime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_fans
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_group`;
CREATE TABLE `ims_j_money_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `companyname` varchar(50) NOT NULL COMMENT '公司名称',
  `description` varchar(100) NOT NULL COMMENT '描述',
  `logo` varchar(300) NOT NULL COMMENT 'logo',
  `bg` varchar(300) NOT NULL COMMENT '背景',
  `appid` varchar(50) NOT NULL COMMENT 'appid',
  `app_id` varchar(50) NOT NULL COMMENT 'app_id',
  `appauthtoken` varchar(100) NOT NULL COMMENT 'appauthtoken',
  `sub_appid` varchar(50) NOT NULL COMMENT '背景',
  `sub_mch_id` varchar(30) NOT NULL COMMENT '背景',
  `appsecret` varchar(50) NOT NULL COMMENT '背景',
  `pay_name` varchar(50) NOT NULL COMMENT '背景',
  `pay_mchid` varchar(30) NOT NULL COMMENT '背景',
  `pay_signkey` varchar(50) NOT NULL COMMENT '背景',
  `printpagewidth` varchar(5) NOT NULL COMMENT '背景',
  `printnum` tinyint(1) NOT NULL DEFAULT '0' COMMENT '背景',
  `qrcode` varchar(300) NOT NULL COMMENT '背景',
  `tempid` varchar(100) NOT NULL COMMENT '背景',
  `tempurl` varchar(100) NOT NULL COMMENT '背景',
  `creadit` varchar(10) NOT NULL COMMENT 'creadit',
  `creditbtn` varchar(100) NOT NULL COMMENT '背景',
  `needtable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '背景',
  `refunder` varchar(50) NOT NULL COMMENT '背景',
  `tempid2` varchar(100) NOT NULL COMMENT '背景',
  `rootca` varchar(300) NOT NULL COMMENT '背景',
  `apiclient_cert` varchar(300) NOT NULL COMMENT '背景',
  `apiclient_key` varchar(300) NOT NULL COMMENT '背景',
  `alipay_key` varchar(300) NOT NULL COMMENT '背景',
  `alipay_cert` varchar(1000) NOT NULL COMMENT '背景',
  `token` varchar(600) NOT NULL COMMENT '背景',
  `expire_time` int(10) NOT NULL DEFAULT '0' COMMENT '背景',
  `payreceipt` int(10) NOT NULL DEFAULT '0' COMMENT '背景',
  `couponreceipt` int(10) NOT NULL DEFAULT '0' COMMENT '背景',
  `wxcardid` varchar(50) NOT NULL COMMENT '背景',
  `info` text NOT NULL COMMENT '背景',
  `memberdiscount` varchar(200) NOT NULL COMMENT '会员折扣',
  `qrlink` varchar(100) NOT NULL COMMENT '会员折扣',
  `alipay_store_id` varchar(50) NOT NULL COMMENT 'alipay_store_id',
  `freelimit` decimal(10,2) NOT NULL,
  `servermoney` decimal(10,2) NOT NULL,
  `infoshow` varchar(100) NOT NULL,
  `zfbbaner1` varchar(255) NOT NULL,
  `zfbbaner2` varchar(255) NOT NULL,
  `zfbbaner3` varchar(255) NOT NULL,
  `zfblogo` varchar(255) NOT NULL,
  `logotitle` varchar(100) NOT NULL,
  `zfblogox` varchar(255) NOT NULL,
  `logomes` varchar(100) NOT NULL,
  `transferUrl` varchar(255) NOT NULL,
  `successUrl` varchar(255) NOT NULL,
  `servertypes` varchar(255) NOT NULL,
  `jfconfig` text NOT NULL,
  `sys_service_provider_id` varchar(50) DEFAULT NULL,
  `app_auth_token` varchar(50) DEFAULT NULL,
  `apipay` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_group
-- ----------------------------
INSERT INTO `ims_j_money_group` VALUES ('7', '2', '测试', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '', '', '', '0', '', '0', '', '', '', '', '', '', '', '', '0', '0', '0', '', '', '{\"2\":\"1\"}', 'https://w.url.cn/s/AaQPfTu', '', '20.00', '30.00', '', '', '', '', '', '', '', '', '', '', '[\"0\",\"0\",\"0\",\"0\"]', '', '', '', '0');

-- ----------------------------
-- Table structure for ims_j_money_lottery
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_lottery`;
CREATE TABLE `ims_j_money_lottery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '奖品ID',
  `isprize` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为中奖',
  `prizetype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '奖品类型，0实物，1红包，2卡券',
  `award` varchar(100) NOT NULL DEFAULT '' COMMENT '奖品名称',
  `description` varchar(200) NOT NULL DEFAULT '' COMMENT '中奖信息描述',
  `from_user` varchar(50) NOT NULL COMMENT '用户唯一身份ID',
  `realname` varchar(20) NOT NULL COMMENT '用户名称',
  `mobile` varchar(11) NOT NULL COMMENT '电话号码',
  `status` tinyint(1) NOT NULL COMMENT '0未领奖，1已领奖',
  `sncode` varchar(200) NOT NULL COMMENT '兑奖码，0为兑奖码，1为金额，2卡券ID',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '参与日期',
  `gettime` int(11) NOT NULL DEFAULT '0' COMMENT '领奖日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_lottery
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_lotterygame
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_lotterygame`;
CREATE TABLE `ims_j_money_lotterygame` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `thumb` varchar(200) NOT NULL COMMENT '活动图片',
  `clientpic` varchar(200) NOT NULL COMMENT '活动图片',
  `description` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `zppic` varchar(200) NOT NULL COMMENT '转盘图片',
  `pointer` varchar(200) NOT NULL COMMENT '指针图片',
  `rule` varchar(2000) DEFAULT NULL COMMENT '活动描述',
  `starttime` int(10) NOT NULL,
  `endtime` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启/关闭',
  `sharedes` varchar(50) NOT NULL COMMENT '关注连接',
  `gzurl` varchar(300) NOT NULL COMMENT '关注连接',
  `thumb_bg` varchar(300) NOT NULL COMMENT '活动图片',
  `thumb_pointer` varchar(300) NOT NULL COMMENT '活动图片',
  `bgcolor` varchar(10) NOT NULL COMMENT '活动图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_lotterygame
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_marketing
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_marketing`;
CREATE TABLE `ims_j_money_marketing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `title` varchar(50) NOT NULL COMMENT '活动标题',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属店铺',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `starttime` int(10) NOT NULL COMMENT '开始时间',
  `gameid` int(10) NOT NULL DEFAULT '0' COMMENT '大转盘游戏rid',
  `endtime` int(10) NOT NULL COMMENT '结束时间',
  `hour` varchar(50) NOT NULL COMMENT '活动时间段',
  `num` int(10) NOT NULL COMMENT '人数设置',
  `isint` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `favorabletype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '优惠类别',
  `condition_fee` int(10) NOT NULL DEFAULT '0' COMMENT '满多少元',
  `favorable` varchar(100) NOT NULL COMMENT '优惠',
  `gid` int(10) NOT NULL COMMENT '游戏id',
  `isallnum` tinyint(1) NOT NULL DEFAULT '0' COMMENT '人数设置为每天，还是总人数',
  `condition` tinyint(1) NOT NULL DEFAULT '0' COMMENT '条件',
  `condition_member` varchar(100) NOT NULL COMMENT '优惠',
  `condition_attendtime` int(10) NOT NULL DEFAULT '0' COMMENT '关注天数',
  `displayorder` int(10) NOT NULL DEFAULT '0' COMMENT '优先级',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_marketing
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_memberpaycode
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_memberpaycode`;
CREATE TABLE `ims_j_money_memberpaycode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `cardno` varchar(50) NOT NULL COMMENT '会员卡号',
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT '开卡人',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属团队',
  `code` varchar(10) NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `usetime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_j_money_memberpaycode
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_memebercard
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_memebercard`;
CREATE TABLE `ims_j_money_memebercard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `cardno` varchar(30) NOT NULL COMMENT '会员卡号',
  `useracount` varchar(50) NOT NULL COMMENT '登陆账号',
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT '开卡人',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属团队',
  `gid` int(10) NOT NULL DEFAULT '0' COMMENT '所属团队',
  `cash` int(10) NOT NULL DEFAULT '0' COMMENT '剩余金额',
  `creadit` float(10,2) NOT NULL COMMENT '积分',
  `discount` varchar(5) NOT NULL DEFAULT '1' COMMENT '折扣',
  `realname` varchar(50) NOT NULL COMMENT '姓名',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `headimgurl` varchar(300) NOT NULL COMMENT 'headimgurl',
  `mobile` varchar(20) NOT NULL COMMENT '电话',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `wxcardno` varchar(20) NOT NULL COMMENT '会员卡号',
  `remark` varchar(200) NOT NULL COMMENT '备注',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `bindtime` int(10) NOT NULL DEFAULT '0' COMMENT '绑定时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_memebercard
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_print
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_print`;
CREATE TABLE `ims_j_money_print` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `pcate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '类型',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pagewidth` int(10) NOT NULL DEFAULT '0' COMMENT '标题',
  `pageheight` int(10) NOT NULL DEFAULT '0' COMMENT '标题',
  `content` text COMMENT '打印内容',
  `qrcode` varchar(200) NOT NULL COMMENT '标题',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_print
-- ----------------------------
INSERT INTO `ims_j_money_print` VALUES ('7', '2', '0', '7', '信息产业园', '0', '0', '{\r\n    \"spos\": [\r\n        {	\r\n            \"position\": \"center\",\r\n            \"content\": \"{店铺}\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"1\",  \r\n            \"height\": \"1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{	\r\n            \"position\": \"center\",\r\n            \"content\": \"【商户联】\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"1\",  \r\n            \"height\": \"1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{	\r\n            \"position\": \"center\",\r\n            \"content\": \"--{订单状态}--\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"1\",  \r\n            \"height\": \"1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n			\"position\": \"left\",\r\n			\"content\": \"收银员:{收银员}\",\r\n			\"contenttype\": \"txt\",\r\n			\"bold\": \"0\",\r\n			\"height\": \"-1\",\r\n			\"italic\": \"0\",\r\n			\"offset\": \"0\",\r\n			\"size\": \"2\"\r\n		},\r\n		{\r\n			\"position\": \"left\",\r\n			\"content\": \"收款时间:{收款时间}\",\r\n			\"contenttype\": \"txt\",\r\n			\"bold\": \"0\",\r\n			\"height\": \"-1\",\r\n			\"italic\": \"0\",\r\n			\"offset\": \"0\",\r\n			\"size\": \"2\"\r\n		},\r\n		{\r\n			\"position\": \"left\",\r\n			\"content\": \"付款方式:{付款方式}\",\r\n			\"contenttype\": \"txt\",\r\n			\"bold\": \"0\",\r\n			\"height\": \"-1\",\r\n			\"italic\": \"0\",\r\n			\"offset\": \"0\",\r\n			\"size\": \"2\"\r\n		},\r\n		{\r\n			\"position\": \"left\",\r\n			\"content\": \"{服务类型}\",\r\n			\"contenttype\": \"txt\",\r\n			\"bold\": \"0\",\r\n			\"height\": \"-1\",\r\n			\"italic\": \"0\",\r\n			\"offset\": \"0\",\r\n			\"size\": \"2\"\r\n		},\r\n		{\r\n			\"position\": \"left\",\r\n			\"content\": \" {服务内容}\",\r\n			\"contenttype\": \"txt\",\r\n			\"bold\": \"0\",\r\n			\"height\": \"-1\",\r\n			\"italic\": \"0\",\r\n			\"offset\": \"0\",\r\n			\"size\": \"2\"\r\n		},\r\n		{\r\n            \"position\": \"center\",\r\n            \"content\": \"            \",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n        {\r\n            \"position\": \"center\",\r\n            \"content\": \"----------------------------------\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"left\",\r\n            \"content\": \"账单金额: {账单金额}\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"left\",\r\n            \"content\": \"手续费: {手续费}\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"left\",\r\n            \"content\": \"实付: {实付}\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		\r\n		{\r\n            \"position\": \"center\",\r\n            \"content\": \"----------------------------------\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        }\r\n		{\r\n            \"position\": \"center\",\r\n            \"content\": \"            \",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"center\",\r\n            \"content\": \"{一维码}\",\r\n            \"contenttype\": \"one-dimension\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"center\",\r\n            \"content\": \"            \",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"left\",\r\n            \"content\": \"请妥善保管打印的第{打印份数}份凭证\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"left\",\r\n            \"content\": \"打印时间:{打印时间}\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"center\",\r\n            \"content\": \"            \",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        },\r\n		{\r\n            \"position\": \"center\",\r\n            \"content\": \"--------先服务，后销售--------\",\r\n            \"contenttype\": \"txt\",\r\n            \"bold\": \"0\",\r\n            \"height\": \"-1\",\r\n            \"italic\": \"0\",\r\n            \"offset\": \"0\",\r\n            \"size\": \"3\"\r\n        }\r\n    ]\r\n}', '', '0');

-- ----------------------------
-- Table structure for ims_j_money_printer
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_printer`;
CREATE TABLE `ims_j_money_printer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `shopid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL COMMENT '打印机名称',
  `ptype` smallint(4) unsigned NOT NULL COMMENT '打印机类型- 1:飞鹅',
  `apiaccount` varchar(255) DEFAULT '' COMMENT 'Api账号',
  `apiukey` varchar(255) DEFAULT '' COMMENT 'ApiUkey',
  `printsn` varchar(255) DEFAULT '' COMMENT '打印机编号',
  `apiskey` varchar(255) DEFAULT '' COMMENT '打印机识别码Skey',
  `mobile` varchar(15) NOT NULL DEFAULT '' COMMENT '手机卡号码',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `printtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后打印时间',
  `onlinetime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后在线时间',
  `unprint` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '等待打印订单数',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `isdef` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否默认',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_j_money_printer
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_qrlogin
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_qrlogin`;
CREATE TABLE `ims_j_money_qrlogin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `sncode` varchar(50) NOT NULL COMMENT 'qrcode',
  `userid` varchar(50) NOT NULL COMMENT '登陆账号',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1493 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_qrlogin
-- ----------------------------
INSERT INTO `ims_j_money_qrlogin` VALUES ('1487', '2', '1510125566', '', '', '1510125566', '0');
INSERT INTO `ims_j_money_qrlogin` VALUES ('1488', '2', '1510127581', '', '', '1510127581', '0');
INSERT INTO `ims_j_money_qrlogin` VALUES ('1489', '2', '1510127882', '', '', '1510127882', '0');
INSERT INTO `ims_j_money_qrlogin` VALUES ('1490', '2', '1510200281', '', '', '1510200281', '0');
INSERT INTO `ims_j_money_qrlogin` VALUES ('1491', '2', '1510285846', '', '', '1510285846', '0');
INSERT INTO `ims_j_money_qrlogin` VALUES ('1492', '2', '1511496264', '', '', '1511496264', '0');

-- ----------------------------
-- Table structure for ims_j_money_recharge
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_recharge`;
CREATE TABLE `ims_j_money_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `cardno` varchar(50) NOT NULL COMMENT '会员卡号',
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT '开卡人',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属团队',
  `paytype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0微信，1支付宝，2现金',
  `cash` int(10) NOT NULL DEFAULT '0' COMMENT '剩余金额',
  `out_trade_no` varchar(64) NOT NULL COMMENT '商户订单号',
  `remark` varchar(200) NOT NULL COMMENT '备注',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `createdate` varchar(20) NOT NULL COMMENT '订单日期',
  `log` varchar(200) NOT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_recharge
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_redeemcredit
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_redeemcredit`;
CREATE TABLE `ims_j_money_redeemcredit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `num` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `cardId` varchar(200) NOT NULL,
  `credit` varchar(50) NOT NULL,
  `redeemDate` varchar(255) NOT NULL,
  `decription` varchar(255) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `createtime` varchar(255) NOT NULL,
  `status` int(3) NOT NULL,
  `mes` varchar(255) NOT NULL,
  `shopid` int(10) NOT NULL,
  `user` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `availableCredits` varchar(100) NOT NULL,
  `bumen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9707 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_j_money_redeemcredit
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_reply`;
CREATE TABLE `ims_j_money_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `gameid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL COMMENT '回复标题',
  `cover` varchar(250) NOT NULL COMMENT '图文回复图片',
  `description` varchar(250) NOT NULL COMMENT '图文回复描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_reward
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_reward`;
CREATE TABLE `ims_j_money_reward` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `completed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `out_trade_no` varchar(32) NOT NULL COMMENT '商户订单号',
  `openid` varchar(50) NOT NULL COMMENT '身份辨识号',
  `marketid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `condition` tinyint(1) NOT NULL DEFAULT '0' COMMENT '条件',
  `favorabletype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '优惠类别',
  `favorable` varchar(100) NOT NULL COMMENT '优惠',
  `reward` varchar(50) NOT NULL DEFAULT '0' COMMENT '获得优惠',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '订单时刻',
  `endtime` int(10) NOT NULL DEFAULT '0' COMMENT '订单时刻',
  `gettype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '获取方式',
  `log` varchar(200) NOT NULL COMMENT '日志',
  `marketing_log` varchar(200) NOT NULL COMMENT '营销方案内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_reward
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_statements
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_statements`;
CREATE TABLE `ims_j_money_statements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属团队',
  `createdate` varchar(20) NOT NULL COMMENT '订单日期',
  `trade_time` varchar(30) NOT NULL COMMENT '交易时间',
  `appid` varchar(30) NOT NULL COMMENT '公众账号ID',
  `mch_id` varchar(25) NOT NULL COMMENT '商户号',
  `sub_mch_id` varchar(25) NOT NULL COMMENT '子商户号',
  `device_info` varchar(30) NOT NULL COMMENT '设备号',
  `transaction_id` varchar(50) NOT NULL COMMENT '微信订单号',
  `out_trade_no` varchar(30) NOT NULL COMMENT '商户订单号',
  `openid` varchar(50) NOT NULL COMMENT '用户标识',
  `trade_type` varchar(20) NOT NULL COMMENT '交易类型',
  `status` varchar(20) NOT NULL COMMENT '交易状态',
  `bank_type` varchar(20) NOT NULL COMMENT '付款银行',
  `fee_type` varchar(20) NOT NULL COMMENT '货币种类',
  `total_fee` varchar(10) NOT NULL COMMENT '总金额',
  `repack_fee` varchar(10) NOT NULL COMMENT '企业红包金额',
  `refund_id` varchar(30) NOT NULL COMMENT '微信退款单号',
  `out_refund_no` varchar(30) NOT NULL COMMENT '商户退款单号',
  `refund_fee` varchar(10) NOT NULL COMMENT '退款金额',
  `repack_refund_fee` varchar(10) NOT NULL COMMENT '企业红包退款金额',
  `refund_fee_type` varchar(10) NOT NULL COMMENT '退款类型',
  `refund_status` varchar(10) NOT NULL COMMENT '退款状态',
  `good_tital` varchar(50) NOT NULL COMMENT '商品名称',
  `attech` varchar(50) NOT NULL COMMENT '商户数据包',
  `poundage` varchar(10) NOT NULL COMMENT '手续费',
  `rate` varchar(10) NOT NULL COMMENT '费率',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `ischeck` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_statements
-- ----------------------------

-- ----------------------------
-- Table structure for ims_j_money_trade
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_trade`;
CREATE TABLE `ims_j_money_trade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT '收银员账号',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属店铺',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `paytype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为微信，1为支付宝，2为现金，3为信用卡，4为会员卡，5为其他',
  `openid` varchar(50) NOT NULL COMMENT '身份辨识号',
  `is_subscribe` varchar(1) NOT NULL COMMENT '是否关注',
  `sub_openid` varchar(50) NOT NULL COMMENT '身份辨识号',
  `sub_is_subscribe` varchar(1) NOT NULL COMMENT '是否关注',
  `trade_type` varchar(16) NOT NULL COMMENT '交易类型',
  `bank_type` varchar(16) NOT NULL COMMENT '付款银行',
  `fee_type` varchar(16) NOT NULL COMMENT '货币类型',
  `memberno` varchar(30) NOT NULL COMMENT '会员卡号',
  `order_fee` int(10) NOT NULL COMMENT '订单总金额',
  `total_fee` int(10) NOT NULL COMMENT '实际应付金额',
  `paid_fee` int(10) NOT NULL COMMENT '实际应付金额',
  `change_fee` int(10) NOT NULL COMMENT '实际应付金额',
  `discount` varchar(5) NOT NULL COMMENT '折扣',
  `discount_fee` int(10) NOT NULL COMMENT '优惠金额',
  `discounttype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '优惠类型,0没有优惠，1为满减，2为会员卡折扣，3为微信卡券，4其他优惠',
  `discountid` varchar(20) NOT NULL COMMENT '优惠券',
  `remark` varchar(200) NOT NULL COMMENT '日志',
  `cash_fee` int(10) NOT NULL COMMENT '实际支付金额',
  `cash_fee_type` varchar(10) NOT NULL COMMENT '货币类型',
  `coupon_fee` int(10) NOT NULL COMMENT '代金券或立减优惠金额<=订单总金额，订单总金额-代金券或立减优惠金额=现金支付金额',
  `transaction_id` varchar(64) NOT NULL COMMENT '微信支付订单号',
  `out_trade_no` varchar(64) NOT NULL COMMENT '商户订单号',
  `old_trade_no` varchar(50) NOT NULL COMMENT '商户订单号',
  `attach` varchar(128) NOT NULL COMMENT '商家数据包',
  `time_end` varchar(14) NOT NULL COMMENT '身份辨识号',
  `isconfirm` tinyint(1) NOT NULL DEFAULT '0' COMMENT '二次查询状态',
  `marketing` int(10) NOT NULL DEFAULT '0' COMMENT '营销方案',
  `marketing_log` varchar(200) NOT NULL COMMENT '营销方案内容',
  `market_favorable` varchar(200) NOT NULL COMMENT '营销方案内容',
  `getprizetype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '领取方式，0为即时，1为打印',
  `getmarketing` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否领取奖励状态,0没有领取，1已领取',
  `log` varchar(200) NOT NULL COMMENT '日志',
  `createtime` int(10) NOT NULL COMMENT '订单时刻',
  `createdate` varchar(20) NOT NULL COMMENT '订单日期',
  `credit` float(10,2) NOT NULL COMMENT '积分',
  `isprint` tinyint(1) NOT NULL DEFAULT '0' COMMENT '打印',
  `refund_trade_no` varchar(64) NOT NULL COMMENT '退款订单号',
  `refund_fee` int(10) NOT NULL COMMENT '退款金额',
  `refundstatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0无退款，1部分退款，2全部退款',
  `refundtime` int(10) NOT NULL COMMENT '退款时刻',
  `ischeck` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `servermoney` decimal(10,2) NOT NULL,
  `servertype` varchar(100) NOT NULL,
  `carnumber` varchar(100) NOT NULL,
  `print_order` varchar(255) NOT NULL DEFAULT '',
  `userbak` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=3397 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_trade
-- ----------------------------
INSERT INTO `ims_j_money_trade` VALUES ('3394', '2', '21', '7', '1', '1', '', '', '', '', '', '', '', '', '5600', '5600', '0', '0', '', '0', '0', '', '', '5600', '', '0', '', '1510199869990', '', 'PC', '', '0', '0', '', '', '0', '0', '收款失败：缺少AppID参数', '1510199869', '2017-11-09', '0.00', '0', '', '0', '0', '0', '0', '0.00', '', '', '', '');
INSERT INTO `ims_j_money_trade` VALUES ('3395', '2', '21', '7', '1', '2', '', '', '', '', '', '', '', '', '5600', '5600', '0', '0', '', '0', '0', '', '', '5600', '', '0', '', '1510199881315', '', 'PC', '', '0', '0', '', '', '0', '0', '收款失败：缺少AppID参数', '1510199881', '2017-11-09', '0.00', '0', '', '0', '0', '0', '0', '0.00', '', '', '', '');
INSERT INTO `ims_j_money_trade` VALUES ('3396', '2', '21', '7', '1', '1', '', '', '', '', '', '', '', '', '3600', '3600', '0', '0', '', '0', '0', '', '', '3600', '', '0', '', '1510286046402', '', 'PC', '', '0', '0', '', '', '0', '0', '收款失败：缺少AppID参数', '1510286046', '2017-11-10', '0.00', '0', '', '0', '0', '0', '0', '45.00', '', '', '', '');

-- ----------------------------
-- Table structure for ims_j_money_user
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_user`;
CREATE TABLE `ims_j_money_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `useracount` varchar(50) NOT NULL COMMENT '登陆账号',
  `pcate` int(10) NOT NULL DEFAULT '0' COMMENT '所属团队',
  `permission` tinyint(1) NOT NULL DEFAULT '1' COMMENT '角色',
  `realname` varchar(50) NOT NULL COMMENT '姓名',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `mobile` varchar(20) NOT NULL COMMENT '电话',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `login_pc` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'PC端登录',
  `login_m` tinyint(1) NOT NULL DEFAULT '0' COMMENT '手机端登录',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `lasttime` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `printerid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_user
-- ----------------------------
INSERT INTO `ims_j_money_user` VALUES ('21', '2', 'A001', '7', '1', 'long', '', '', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '1510125762', '1511496268', '1', '0');

-- ----------------------------
-- Table structure for ims_j_money_view
-- ----------------------------
DROP TABLE IF EXISTS `ims_j_money_view`;
CREATE TABLE `ims_j_money_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `aid` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL COMMENT '标题',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `prizetype` tinyint(1) NOT NULL DEFAULT '0',
  `favorable` varchar(50) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ims_j_money_view
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_cash_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_cash_record`;
CREATE TABLE `ims_mc_cash_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `clerk_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `clerk_type` tinyint(3) unsigned NOT NULL,
  `fee` decimal(10,2) unsigned NOT NULL,
  `final_fee` decimal(10,2) unsigned NOT NULL,
  `credit1` int(10) unsigned NOT NULL,
  `credit1_fee` decimal(10,2) unsigned NOT NULL,
  `credit2` decimal(10,2) unsigned NOT NULL,
  `cash` decimal(10,2) unsigned NOT NULL,
  `return_cash` decimal(10,2) unsigned NOT NULL,
  `final_cash` decimal(10,2) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `trade_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_cash_record
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_chats_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_chats_record`;
CREATE TABLE `ims_mc_chats_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `flag` tinyint(3) unsigned NOT NULL,
  `openid` varchar(32) NOT NULL,
  `msgtype` varchar(15) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`acid`),
  KEY `openid` (`openid`),
  KEY `createtime` (`createtime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_chats_record
-- ----------------------------
INSERT INTO `ims_mc_chats_record` VALUES ('1', '2', '0', '1', 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', 'text', 'a:1:{s:7:\"content\";s:9:\"asdfasdfa\";}', '1502248110');

-- ----------------------------
-- Table structure for ims_mc_credits_recharge
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_credits_recharge`;
CREATE TABLE `ims_mc_credits_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `tid` varchar(64) NOT NULL,
  `transid` varchar(30) NOT NULL,
  `fee` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `backtype` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_uid` (`uniacid`,`uid`),
  KEY `idx_tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_credits_recharge
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_credits_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_credits_record`;
CREATE TABLE `ims_mc_credits_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `credittype` varchar(10) NOT NULL,
  `num` decimal(10,2) NOT NULL,
  `operator` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL,
  `clerk_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `clerk_type` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `remark` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_credits_record
-- ----------------------------
INSERT INTO `ims_mc_credits_record` VALUES ('1', '1', '2', 'credit2', '10000.00', '1', 'system', '1', '0', '2', '1502275324', '系统后台: 添加10000元');
INSERT INTO `ims_mc_credits_record` VALUES ('2', '1', '2', 'credit2', '-1.00', '1', '', '0', '0', '1', '1502275338', '消费credit2:1');
INSERT INTO `ims_mc_credits_record` VALUES ('3', '1', '2', 'credit2', '-100.00', '1', '', '0', '0', '1', '1502275381', '消费credit2:100');
INSERT INTO `ims_mc_credits_record` VALUES ('4', '1', '2', 'credit2', '-10.00', '1', '', '0', '0', '1', '1502275443', '消费credit2:10');
INSERT INTO `ims_mc_credits_record` VALUES ('5', '1', '2', 'credit2', '-10.00', '1', '', '0', '0', '1', '1502333420', '消费credit2:10');
INSERT INTO `ims_mc_credits_record` VALUES ('6', '1', '2', 'credit2', '-12.00', '1', '', '0', '0', '1', '1508836178', '消费credit2:12');

-- ----------------------------
-- Table structure for ims_mc_fans_groups
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_fans_groups`;
CREATE TABLE `ims_mc_fans_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `groups` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_fans_groups
-- ----------------------------
INSERT INTO `ims_mc_fans_groups` VALUES ('1', '2', '2', 'a:1:{i:2;a:3:{s:2:\"id\";i:2;s:4:\"name\";s:9:\"星标组\";s:5:\"count\";i:0;}}');

-- ----------------------------
-- Table structure for ims_mc_fans_tag_mapping
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_fans_tag_mapping`;
CREATE TABLE `ims_mc_fans_tag_mapping` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fanid` int(11) unsigned NOT NULL,
  `tagid` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mapping` (`fanid`,`tagid`),
  KEY `fanid_index` (`fanid`),
  KEY `tagid_index` (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_fans_tag_mapping
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_groups
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_groups`;
CREATE TABLE `ims_mc_groups` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `credit` int(10) unsigned NOT NULL,
  `isdefault` tinyint(4) NOT NULL,
  `orderlist` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_groups
-- ----------------------------
INSERT INTO `ims_mc_groups` VALUES ('1', '1', '默认会员组', '0', '1', '0');
INSERT INTO `ims_mc_groups` VALUES ('2', '2', '默认会员组', '0', '1', '0');

-- ----------------------------
-- Table structure for ims_mc_handsel
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_handsel`;
CREATE TABLE `ims_mc_handsel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `touid` int(10) unsigned NOT NULL,
  `fromuid` varchar(32) NOT NULL,
  `module` varchar(30) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `action` varchar(20) NOT NULL,
  `credit_value` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`touid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_handsel
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_mapping_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_mapping_fans`;
CREATE TABLE `ims_mc_mapping_fans` (
  `fanid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `groupid` varchar(30) NOT NULL,
  `salt` char(8) NOT NULL,
  `follow` tinyint(1) unsigned NOT NULL,
  `followtime` int(10) unsigned NOT NULL,
  `unfollowtime` int(10) unsigned NOT NULL,
  `tag` varchar(1000) NOT NULL,
  `updatetime` int(10) unsigned DEFAULT NULL,
  `unionid` varchar(64) NOT NULL,
  PRIMARY KEY (`fanid`),
  UNIQUE KEY `openid_2` (`openid`),
  KEY `acid` (`acid`),
  KEY `uniacid` (`uniacid`),
  KEY `nickname` (`nickname`),
  KEY `updatetime` (`updatetime`),
  KEY `uid` (`uid`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_mapping_fans
-- ----------------------------
INSERT INTO `ims_mc_mapping_fans` VALUES ('1', '2', '2', '1', 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', '龙', '', 'q911S9kc', '1', '1502247963', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cVdCc2dSZDd6b1hEeWg2R2RLNlFqYyI7czo4OiJuaWNrbmFtZSI7czozOiLpvpkiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuahguaelyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWoxRHdMVE1ka2hRNk1yRWlheTlxSmNMNUg5Q0d4b2VLU3lhRVpmaWJ6RmFlaWFKdG9EYXgwdzNDaG1nbzNBTEJoZ05vbmpQRzlvUWJkTkF3Sm5hZXNtSnVsVS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAyMjQ3OTYzO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1503542499', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('2', '2', '2', '2', 'oNjw9wqOZStEvbG6suK3aaeJO2wI', '专注微信开发20年', '', 'Zw56p8wW', '1', '1501734252', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cU9aU3RFdmJHNnN1SzNhYWVKTzJ3SSI7czo4OiJuaWNrbmFtZSI7czoyMzoi5LiT5rOo5b6u5L+h5byA5Y+RMjDlubQiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuaIkOmDvSI7czo4OiJwcm92aW5jZSI7czo2OiLlm5vlt50iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTE2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2FqTlZkcUhaTExDakpuOVdBRm1PQVM4WVMyamJyaWJ4Z1NuZWVHRzFOaWJxYklRUExCVWZYRWdMbHBMeEhzYmNWZnVKdWNrNGtJbGFvZzNBOE5wdmRxNEEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMTczNDI1MjtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1503542499', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('3', '2', '2', '3', 'oNjw9wiHUT24ks-VP5her_QYjGJY', '波波夫', '', 'u3Ulw9i1', '1', '1501732534', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aUhVVDI0a3MtVlA1aGVyX1FZakdKWSI7czo4OiJuaWNrbmFtZSI7czo5OiLms6Lms6LlpKsiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuaIkOmDvSI7czo4OiJwcm92aW5jZSI7czo2OiLlm5vlt50iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTQwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2FqTlZkcUhaTExDNThsa01oeFV0Rm9sWHlOMmVJMjZpYk5nblVId1luWE5JOGhSeEVJbUJVdnd4UDBpYTIyZlN6WlBYVjBoWlE0S0ROQzdPajJsekI0RzBsaWFpYTY3RmRPR0xPcjhONktJYWlhSjAvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMTczMjUzNDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1503563997', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('4', '2', '2', '4', 'oNjw9wsoed-77tdXpJoqpMkFWsdk', '周刚', '', 'h23X1mWJ', '1', '1501732581', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c29lZC03N3RkWHBKb3FwTWtGV3NkayI7czo4OiJuaWNrbmFtZSI7czo2OiLlkajliJoiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JPUDkwRERiQXltVFVDVG5JQmNXUTBRQzdXcHIzSWRmVFV2TkU0Njl1YUlYUkxXY2JWakJkVnFCSGFpYnNhWUh0M0EwUWJuTWhpYUQ0RmJPa3J3aDBWaWFhRi8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAxNzMyNTgxO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1504242615', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('5', '2', '2', '0', 'oNjw9ws7xwK9ukeHBotQtbuxyBzM', 'a玲子', '', 'Yn36n6D4', '0', '1501197194', '1509544199', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3czd4d0s5dWtlSEJvdFF0YnV4eUJ6TSI7czo4OiJuaWNrbmFtZSI7czoyMzoiYfCfjLjnjrLlrZDwn46A8J+SsPCfkosiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IumAmuW3niI7czo4OiJwcm92aW5jZSI7czo2OiLljJfkuqwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0J1eVNjbHJrQkQ0MGlicHlqaGlhaGRiaWI3elFrSmYzTnlVWnppYnlqZHNNTTR2akxjZFluNzZReFVmRkNPWWxrTHAxeWVCSkpraWJiVjdIc1MycVRMMFh1ZDBwY1JpYkJRbm5XdS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAxMTk3MTk0O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1504680645', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('6', '2', '2', '36', 'oNjw9wnOiw4bj-OibdIRKgdUIU5g', '无处诉说的痛', '', 'sxRaCvLL', '1', '1501595704', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bk9pdzRiai1PaWJkSVJLZ2RVSVU1ZyI7czo4OiJuaWNrbmFtZSI7czoxODoi5peg5aSE6K+J6K+055qE55ebIjtzOjM6InNleCI7aTowO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmnJ3pmLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5YyX5LqsIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyOToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi8wdElRUHc4SENyTVFlUXdUWm1Zb25nWElwZW4yaG9COEVpYzNhdWRSVXlyaDRjOEl5TmFjbGNKSWMwME91Rjdza3RzWkppYmtCZmlidU1pYVY3ZmgyblhwdFppYVBUT29JeEJsZS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAxNTk1NzA0O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1504681500', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('7', '2', '2', '0', 'oNjw9wlxBBl2NpAIzPehQby7gZso', '大山阻拦', '', 'CjseeZgU', '1', '1501746199', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bHhCQmwyTnBBSXpQZWhRYnk3Z1pzbyI7czo4OiJuaWNrbmFtZSI7czoxMjoi5aSn5bGx6Zi75oumIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLotLXpmLMiO3M6ODoicHJvdmluY2UiO3M6Njoi6LS15beeIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyODoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9pY0Qyc2oxTXptWFhpYzhCamVIcFJDMW95bFU1QXRIWG52cmpuOGVZVkJLYUs5akpLTnRvbWM4d0VpYXFFNmRXNGFXQ21qeGljcDQwMDVhZnI1S0hKbE03T0NZRFlkRUhFNkcxLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDE3NDYxOTk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504681500', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('8', '2', '2', '0', 'oNjw9wi19-C_7_Jz0NIdzQs4acis', '杜小情', '', 'J241Xq7z', '1', '1501733489', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aTE5LUNfN19KejBOSWR6UXM0YWNpcyI7czo4OiJuaWNrbmFtZSI7czo5OiLmnZzlsI/mg4UiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWHB3aWNaSk1qenlrcTZRamtLdXJoQWN1elY0eEtWdU56aWF3UG13dTBKYmljbHl4WGo0MExQdDhQNmNtSXFaWEllU3FoOWNxMG5Hb1JzbElLaWFwbEJoaGxuLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDE3MzM0ODk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504707717', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('9', '2', '2', '5', 'oNjw9winTARR9vMCTbiDAzGq6jbU', 'Catanlina', '', 'F2MjsoXH', '1', '1503454769', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aW5UQVJSOXZNQ1RiaURBekdxNmpiVSI7czo4OiJuaWNrbmFtZSI7czo5OiJDYXRhbmxpbmEiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czo5OiLlronpgZPlsJQiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTE5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2FqTlZkcUhaTExDSG9pY04wY1VpYWNJbXZpYTNxZFQxTnBwZEhRU05seFYyRUdjd3hzNHBVcGFYd1QyMk4zcFJVUWlhT3ppYUJjU1ozdW5qQzQwd29hcW5nakEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMzQ1NDc2OTtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1504707717', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('10', '2', '2', '6', 'oNjw9wrtMOEERWt6PxFBrRPIQBcg', '吴泽民', '', 'Pu77T60Y', '1', '1503541170', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cnRNT0VFUld0NlB4RkJyUlBJUUJjZyI7czo4OiJuaWNrbmFtZSI7czo5OiLlkLTms73msJEiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0J1eVNjbHJrQkQ2U0J2QVNvdFVNc21aY1JvTTJnZnR0OFpHa2xGdFZVNnhwN0NkU3hjeDdIVnpOVVNEd2tkYVl0T1E2bUxhWDR5Q1lCaWNzbTRDZ1dMaWFJWjJ5TXpxdGhCLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDM1NDExNzA7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504788347', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('11', '2', '2', '7', 'oNjw9wooFsPkakB_3R3OQIz9J10Q', '庄海宏', '', 'jNTHWCqY', '0', '1503542506', '1508246477', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3b29Gc1BrYWtCXzNSM09RSXo5SjEwUSI7czo4OiJuaWNrbmFtZSI7czo5OiLluoTmtbflro8iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTE2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhFNlJUNTVHUkxCYUhlZTZhYnFUR2NJblFtd0V4ZG5reUVZN2hVVGs1SGNZVHJNMEp3ZzZQNGlhSkp1cXNJQjFUaWF3Z202bEhKdkl6MEEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMzU0MjUwNjtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1504788347', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('13', '2', '2', '9', 'oNjw9wr5byzVbkSSx2TJTYYp4-y4', '小石孑', '', 'iURZQroo', '1', '1503564030', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cjVieXpWYmtTU3gyVEpUWVlwNC15NCI7czo4OiJuaWNrbmFtZSI7czo5OiLlsI/nn7PlrZEiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMxOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVWYyOThNQVdKUjRzaWNuVE5aaWJpYTdpYm1pYmRkZHE4dzR2WGduWmJNSWY1S2hLQTZQV0Q1VDg2MnJKQVRVdEJPcXkxMk1haElkcDZWRGs2RGlhTGs0TGNGQ1ovMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMzU2NDAzMDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1504788347', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('12', '2', '2', '8', 'oNjw9wmlIOrwpMwOsZhkKR0gvvPs', '简单', '', 'PyOeZqZ3', '1', '1503542534', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bWxJT3J3cE13T3NaaGtLUjBndnZQcyI7czo4OiJuaWNrbmFtZSI7czo2OiLnroDljZUiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhHTVU0c2xxNU9pYnNnUENkRHU3TTZyN1lZWXN1RWliaWNpY2FORXowQXJNSnEwRDhxaWNZNmZ5a0JTdUlLRWVlOHpoblBkTld2SmlhUVhEZHAyVmxDZjlGSFVJSy8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAzNTQyNTM0O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1504788347', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('14', '2', '2', '10', 'oNjw9wsR1LySJXLVsdy5XhiLnMzw', '鋆', '', 'f9umkG20', '1', '1504242665', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c1IxTHlTSlhMVnNkeTVYaGlMbk16dyI7czo4OiJuaWNrbmFtZSI7czozOiLpi4YiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3cyaHJVSU5LNkwyNzJRTHh4TXV3RldEZkhQdERlQXZQWlNVTlVpYkthNmliVjhXNDRVZkIwZU5ESEQ0bldOZmtiUGlhaWJ3Q2xkY29JNlBHaGNoSWljSDlWdTJHcGdOdW5nNjN0LzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQyNDI2NjU7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504788347', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('15', '2', '2', '12', 'oNjw9woZ5wvXjyLqEK17wVsvYJLU', '天涯客', '', 'jPQz3Qpx', '1', '1504680668', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3b1o1d3ZYanlMcUVLMTd3VnN2WUpMVSI7czo4OiJuaWNrbmFtZSI7czo5OiLlpKnmtq/lrqIiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWEE2R2JNelVPS3lkM0pvQ1UxWng5RVJHejlPbFJRYmRlMVJ3RnlUcERrazg2d1NlR0xuMVNZNTFCZWI1TklqTWVsdkdDSmpodHRRaWNHUFJTZXRpY2dYbi8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0NjgwNjY4O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1504788347', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('16', '2', '2', '14', 'oNjw9wib4rWXgYgeFDu_Wi_ZizSQ', '吴华德', '', 'TVMTZZvM', '1', '1504682086', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aWI0cldYZ1lnZUZEdV9XaV9aaXpTUSI7czo4OiJuaWNrbmFtZSI7czo5OiLlkLTljY7lvrciO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTM2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL1h1NGliaWJTVDdZM1BISzlqbGJWSmlhWEt6Wmljc1lESGliaWJjRjBMaWNXRlhNbm1GdjVpYTE0OHRIczVMTHFFeVlzcDRHYmRJN3dNQ1JpY3BWRVhpYkR0dGlhMWhMV0E4UnVpY0J1TUo3by8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0NjgyMDg2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1504788347', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('18', '2', '2', '16', 'oNjw9wrNcZI4KeFtns3TszYBmgUo', '周峰-南京智慧社区-njzhsq.com', '', 'n7h97189', '0', '1504740964', '1504777674', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3ck5jWkk0S2VGdG5zM1RzellCbWdVbyI7czo4OiJuaWNrbmFtZSI7czozNjoi5ZGo5bOwLeWNl+S6rOaZuuaFp+ekvuWMui1uanpoc3EuY29tIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czoxNToi5YyX5biV6buY5pav6aG/IjtzOjg6InByb3ZpbmNlIjtzOjEyOiLljJfpg6jlnLDljLoiO3M6NzoiY291bnRyeSI7czoxMjoi5r6z5aSn5Yip5LqaIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjExNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9QaWFqeFNxQlJhRUtkVExua1BKdDl4Q2Y0RG1VcEZpYXFsT0p3ZE5zTnFLMlhzRldVSGQ2YkpETzR2SUUyTVlKSTFkYTVLQU13UTZEUERPZ0drUTk1YkNRLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ3NDA5NjQ7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504777629', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('17', '2', '2', '15', 'oNjw9wsCO53_LRoiYXQYyqMZr6lo', '华', '', 'CYz47oXX', '1', '1504682127', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c0NPNTNfTFJvaVlYUVl5cU1acjZsbyI7czo4OiJuaWNrbmFtZSI7czozOiLljY4iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTQxOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL1BpYWp4U3FCUmFFS2lhTERJSEppYzFtUkNteHlGNmJmdGt0aWFRTkhaeXNCQ3ZpYXdiVHNZUHM2VHFERExlUk90UVE0N0tiSVZwb0tKbXBQdTlFVGxSeWljV0dlV2dZd1RKU2JFS3FUUm91cHZRekFNLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ2ODIxMjc7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504842957', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('20', '2', '2', '18', 'oNjw9wkB0gSLtZ0f5W-8AkzQ4Cyg', '五福临門', '', 'RAF87P2X', '1', '1504774926', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3a0IwZ1NMdFowZjVXLThBa3pRNEN5ZyI7czo4OiJuaWNrbmFtZSI7czoxMjoi5LqU56aP5Li06ZaAIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzMToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9iWllpYnlJaWNPOHFoZXNKYmljOHBkUGZpYmFPaWFtbGM0S3dDSzZiRmpkMmR6OEJPVmc5TWlhZnJXaE1vaDdGblJXWHR2WHE0SjBZMzhpYlVMZDd1UkxqZE9keFhIYmQxeE9HQ3BULzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ3NzQ5MjY7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504843083', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('19', '2', '2', '17', 'oNjw9wr3xWO4wEUJfgoK7kBmCzAU', '多面人东东', '', 'LbQXTTEn', '1', '1504742077', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cjN4V080d0VVSmZnb0s3a0JtQ3pBVSI7czo4OiJuaWNrbmFtZSI7czoxNToi5aSa6Z2i5Lq65Lic5LicIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLlhoXmsZ8iO3M6ODoicHJvdmluY2UiO3M6Njoi5Zub5bedIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNzoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9EbVQ3SnY2M3FqMjQyZHl6U1lTT1pqTlR4eko4dGFLTnE1S1BOdFdpY3ExeTcxMklsNGprMXpOZzY3YnhVUllBRk1ZSEFlMGtCcjJwaWFBVHpVRmliUDZnYVU0MUNZc3VaTVIvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDc0MjA3NztzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1504843020', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('21', '2', '2', '19', 'oNjw9wnsemkRyBdHKep_D9Vu-F3o', '周玉軍', '', 'z1IaczHh', '1', '1504836125', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bnNlbWtSeUJkSEtlcF9EOVZ1LUYzbyI7czo4OiJuaWNrbmFtZSI7czo5OiLlkajnjonou40iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWFgwZXdsdWpGMW5ET3NQR2ZhbWZPU3p0aGxDaWE5VFlFRjBGMFlXVzRnc284bWliTlBZNDJHbDdTTG54SkFKMXlsRUIxdEEwaWFadHJpYmZ5b0tCc0diUVlMLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4MzYxMjU7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504843146', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('28', '2', '2', '26', 'oNjw9wuK099swcZEwX-6YPz4Vzdg', '黄小平', '', 'FcWCckW9', '1', '1504842989', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dUswOTlzd2NaRXdYLTZZUHo0VnpkZyI7czo4OiJuaWNrbmFtZSI7czo5OiLpu4TlsI/lubMiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVjJlaWFaZjJES2pDNmliN0NzdGliblplUlVVdjU5eUdwSmIyR0FvZTFoS2cyMUV1UzlqNmdLYm9nUnF0VHFCdkxpYjE3elhKYktQMjZkVTZmYWFDUGNZUFhsLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4NDI5ODk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1505448074', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('22', '2', '2', '20', 'oNjw9wlGmS6BbB5-Tm5EX1BQFlq4', '薰衣草', '', 'ZvShB59b', '1', '1504837899', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bEdtUzZCYkI1LVRtNUVYMUJRRmxxNCI7czo4OiJuaWNrbmFtZSI7czo5OiLolrDooaPojYkiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhHTVU0c2xxNU9pYnN1d0NaOFhGMzE2YjlrUHNxVTlWSUZnb0RaU0VIR3VpYXRJdm9xRldMelBCc0VuU3Zoa0t4Smt3OElqWWFRdkF6RFZ6alRVYXZKSHRiLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4Mzc4OTk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504843650', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('23', '2', '2', '21', 'oNjw9wtUwuYUXvqgicsKCs15UERQ', '施', '', 'PZdchbxf', '1', '1504837962', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dFV3dVlVWHZxZ2ljc0tDczE1VUVSUSI7czo4OiJuaWNrbmFtZSI7czozOiLmlr0iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMyOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL1h1NGliaWJTVDdZM1BISzlqbGJWSmlhWEowekdraHEyVWEyVHZhbWljUjVycWJVYnpHTXRCMTNYaWM3Q3kyTDljWjlpYWliZmFiamZwNFd2VVhVY2E4VDgwWjNHQ3hHcklpYnk0a3dTLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4Mzc5NjI7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504849005', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('24', '2', '2', '22', 'oNjw9wsZI1wztA78UiFblid6aM9Y', '青', '', 'X1ATCCay', '1', '1504838344', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c1pJMXd6dEE3OFVpRmJsaWQ2YU05WSI7czo4OiJuaWNrbmFtZSI7czozOiLpnZIiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWFUxNUxKVEhkbkh1S3N2bWpVc1ZTbWdCRER5WHR6M21qMHpreUd1ZmRvZjA4b0lhWExieEdLWDNnUGh5NTl6WGNXQzk5WEJ3ZGRmMUdseVl3aGliT2xNLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4MzgzNDQ7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1504851148', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('25', '2', '2', '23', 'oNjw9woMXlqbwlCNoK06It-Fwt_4', '张世佐', '', 'FgZ90Jga', '1', '1504840061', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3b01YbHFid2xDTm9LMDZJdC1Gd3RfNCI7czo4OiJuaWNrbmFtZSI7czo5OiLlvKDkuJbkvZAiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI4OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWozbmNGeEQyM1JGalU5dVdkb1lLT2liVnowUkxGRnVuSXduWUpSUzFmeTRoUkQ4dDM5d2ZBMkU3T2liRDE4VElMRW1pYXdWWjhaWkE0aWNFM1A3QXdOM3BESU4vMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg0MDA2MTtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1504851148', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('26', '2', '2', '24', 'oNjw9wihpctdPBhtD0yU_6yf34WA', '益，文武勇仁信', '', 'vvN5UEU4', '1', '1504841790', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aWhwY3RkUEJodEQweVVfNnlmMzRXQSI7czo4OiJuaWNrbmFtZSI7czoyMToi55uK77yM5paH5q2m5YuH5LuB5L+hIjtzOjM6InNleCI7aTowO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czowOiIiO3M6ODoicHJvdmluY2UiO3M6MDoiIjtzOjc6ImNvdW50cnkiO3M6MDoiIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzMDoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9vNDk2NFRSNW0xTjZjZkZrYnUyeG53bXY0bzdXZDB2R3h5V0QzS1FWVGFQNkV6emlicjhROVFyU3lCN3hnRWVOR2lhbHVNMTVUaWJnM2liRWlhN2tlREpwTzFGTWtHQnVDaWJyMjEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg0MTc5MDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1505117859', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('29', '2', '2', '27', 'oNjw9wuURuITTn2OoxXhx63POH7w', '90、刘斯金', '', 'xY7MMeYY', '1', '1504843075', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dVVSdUlUVG4yT294WGh4NjNQT0g3dyI7czo4OiJuaWNrbmFtZSI7czoxNDoiOTDjgIHliJjmlq/ph5EiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuWunOaYpSI7czo4OiJwcm92aW5jZSI7czo2OiLmsZ/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JOTHBiZFF5R3FkQW82V1I3VURwODFpYTE2VmF3T3VNamV0alFuQ285MEhFWUtYbEh0Q1pTbmNqTTRFT0JlZFlXdmpFUDFHY29OWjBaUGxpY3poVGljaEZiay8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQzMDc1O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1505580079', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('27', '2', '2', '25', 'oNjw9wqBwdIFv_ojqe4XnX1YPUrA', '心无挂碍', '', 'Ft5SSPB5', '1', '1504841820', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cUJ3ZElGdl9vanFlNFhuWDFZUFVyQSI7czo4OiJuaWNrbmFtZSI7czoxMjoi5b+D5peg5oyC56KNIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9EbVQ3SnY2M3FqMmg5SzRodWRCUXJRalMyTkJtS083N3h5c3NuZU14R1c0NW1LeElzMXpReGc0S3k0NDY4dEJJa1BKQ3hDY3NpYk1FVURZcDVxRWxpYzRqZDR4WXVwdFNTTy8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQxODIwO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1505448074', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('30', '2', '2', '28', 'oNjw9wgobmanOe9siyw4v6PlzvRI', '不特别但唯一', '', 'qlZh6M6b', '1', '1504843091', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3Z29ibWFuT2U5c2l5dzR2NlBsenZSSSI7czo4OiJuaWNrbmFtZSI7czoxODoi5LiN54m55Yir5L2G5ZSv5LiAIjtzOjM6InNleCI7aToyO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyOToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9pY0Qyc2oxTXptWFdCaWNIaWJyR0FIYkZ5VEhEakFRbEFURHM5QXlQMmJ5dHdTblNaQUJyb0xHamliZHQwbDJOSXhmcldoNEduVEx2blBVSlg1OWE5YTFEWDQxYUtZV2dycGliei8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQzMDkxO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1506345330', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('31', '2', '2', '29', 'oNjw9wg_PO44msxBiNJR_fPZi8wU', 'King', '', 'RcMhBJJA', '1', '1504843194', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3Z19QTzQ0bXN4QmlOSlJfZlBaaTh3VSI7czo4OiJuaWNrbmFtZSI7czo0OiJLaW5nIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNzoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9pY0Qyc2oxTXptWFhBNkdiTXpVT0t5U1VZVmczS0Nxb2RmM1ZOVmhaNU0zVXJtT09UV1FZbXZpYkxxRjFRSGlidm05Y3JUSng4Qk9EcmJCYUtYV092dFVtTGx2czdKUHhNeDYvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg0MzE5NDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1506345330', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('32', '2', '2', '30', 'oNjw9wipgBFKipHYOEolznGlPRq0', '杜君丽', '', 'gzlUSLeq', '1', '1504843692', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aXBnQkZLaXBIWU9Fb2x6bkdsUFJxMCI7czo4OiJuaWNrbmFtZSI7czo5OiLmnZzlkJvkuL0iO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuW5v+W3niI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVjR1WXppY3l2WWFGNWhtOTdJSDR2SlZGUkxWMXkxVkdEZzltUVF2QnphTVlaOXczOG8yaWM3Z0p4aWI3MGh3Mkg1VGpQbnJpY05yWXUyVjZBS1l6aWNwbXBVYS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQzNjkyO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1506345330', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('33', '2', '2', '31', 'oNjw9wt3qdTIbQzTVzMFpci2-qik', '玲珑', '', 'PjmZJ33j', '1', '1504849063', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dDNxZFRJYlF6VFZ6TUZwY2kyLXFpayI7czo4OiJuaWNrbmFtZSI7czo2OiLnjrLnj5EiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuW5v+W3niI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVUJ3RkQ1ZHNLS3g2T25IS3AzbUdJeEozaE5xaWFkV2VOcHRHdWdOemFIR3JEcU9LbVgxRWRwcE5wTk1IZTVlMVlvSzBFMkVtYUFWcjZkMHBrV1VjMXFuLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4NDkwNjM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1506345330', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('34', '2', '2', '32', 'oNjw9wpcXWPyS2Mbql8MAUJltYw8', '胡', '', 'YkZc1RDo', '1', '1504851902', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cGNYV1B5UzJNYnFsOE1BVUpsdFl3OCI7czo4OiJuaWNrbmFtZSI7czozOiLog6EiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWoyZmdPdnJ5cmliaGw4b3gwUFF0TlBpYlUyM0NqbkRYSEM3TldQOVBJYnFCanhiWDdLM0ZpYjNBaWFpYlFuMkNZeDl3NkZHY0RSVGthOWYzOGRrdDVSTG1QNmlieC8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODUxOTAyO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1506345330', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('37', '2', '2', '35', 'oNjw9wvY0SSNOC1UNR2J-G3K-gW8', '心灵驿站：周付林', '', 'Oo2et21h', '1', '1505146477', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dlkwU1NOT0MxVU5SMkotRzNLLWdXOCI7czo4OiJuaWNrbmFtZSI7czo2Njoi5b+D54G16am/56uZ77yaICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg5ZGo5LuY5p6XIjtzOjM6InNleCI7aTowO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czowOiIiO3M6ODoicHJvdmluY2UiO3M6MDoiIjtzOjc6ImNvdW50cnkiO3M6MDoiIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9EbVQ3SnY2M3FqMUp4VGtTWEZXZUFEMU1aVXFGdDJJVG9oYlFtbDJEVlVOeThDaWJzMElwM3BmcUZCNXU2cTdvOXdpY2hIdmxrcXd5OHBiMFRROVNNWTBPbzRjZDZqb0tqUS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1MTQ2NDc3O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('35', '2', '2', '33', 'oNjw9wna-JuWdDqOa4FewAGQW4CA', 'ALEIER', '', 'g455r0P4', '1', '1504856054', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bmEtSnVXZERxT2E0RmV3QUdRVzRDQSI7czo4OiJuaWNrbmFtZSI7czo4OiJBIExFSSBFUiI7czozOiJzZXgiO2k6MjtzOjg6Imxhbmd1YWdlIjtzOjU6InpoX0NOIjtzOjQ6ImNpdHkiO3M6Njoi5rex5ZyzIjtzOjg6InByb3ZpbmNlIjtzOjY6IuW5v+S4nCI7czo3OiJjb3VudHJ5IjtzOjY6IuS4reWbvSI7czoxMDoiaGVhZGltZ3VybCI7czoxMTc6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vcksxbnNUbENEOEZtTGZsNHdMVFFlcnd2R3JrOTVCejNzY1lpYlN6SWZVdU5RaWNJTEhQSmdOSlFzRkhOZFlHeDB6elVDUlNpYWJuRHVWQkpNVEdQS3o5S2cvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg1NjA1NDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('36', '2', '2', '34', 'oNjw9whhmG9OodRiQNUiQPtbUhyc', '静静', '', 'Kmhmm085', '0', '1504858443', '1504858858', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aGhtRzlPb2RSaVFOVWlRUHRiVWh5YyI7czo4OiJuaWNrbmFtZSI7czo2OiLpnZnpnZkiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuacnemYsyI7czo4OiJwcm92aW5jZSI7czo2OiLljJfkuqwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JPZUc1cmEyazlzclk1eEpZaGljbGFGZmtOMDNDR0pTejJKSUpQNmtwWURDUGhlUVdCMDI4VDFueUE1UUxlRkdZVHpYTW1PeWlhaWNMREFrR3dGa1hIWkZNWS8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4NTg0NDM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjY6ImF2YXRhciI7czoxMjk6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vMHRJUVB3OEhDck9lRzVyYTJrOXNyWTV4SlloaWNsYUZma04wM0NHSlN6MkpJSlA2a3BZRENQaGVRV0IwMjhUMW55QTVRTGVGR1lUelhNbU95aWFpY0xEQWtHd0ZrWEhaRk1ZLzEzMiI7fQ==', null, '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('38', '2', '2', '37', 'oNjw9wgT3PmexxhTKxz_hz2pG44U', '叶赛', '', 'PMzZ6jfy', '1', '1505574721', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3Z1QzUG1leHhoVEt4el9oejJwRzQ0VSI7czo4OiJuaWNrbmFtZSI7czo2OiLlj7botZsiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI0OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JPZUc1cmEyazlzclVDRFliTFl0UzNacklHbFNVQzBBYWNjc3IzeTUwVVpSclBKVjBXM25qblg5RkNadWF0cEI3QTE4ZU9qV21EQXRaY3VoakJjSG00Ri8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1NTc0NzIxO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('40', '2', '2', '39', 'oNjw9wqzHNUYHWvFcavv8IQ2oaIE', '简质生活', '', 'mp2bXQQ4', '1', '1505978746', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cXpITlVZSFd2RmNhdnY4SVEyb2FJRSI7czo4OiJuaWNrbmFtZSI7czoxMjoi566A6LSo55Sf5rS7IjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjE0MToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9RM2F1SGd6d3pNN1J3TERxYmtoUnl0VkZKRFFubFFkUlh6dXhYa3R2blBRdXZNajlWWGlhZmplU2ljWm5oS2pPVG9EaWM0MnV0RE5MUnNFVGRGUkVUUDNpY0pBalRyaHd6TmFUQlNoNXpwaWNzU2ljUS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1OTc4NzQ2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('39', '2', '2', '38', 'oNjw9wrTnkinoSkdRx7nsRYBKxZQ', '海星之梦', '', 'O6202nmQ', '0', '1505577518', '1508668424', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3clRua2lub1NrZFJ4N25zUllCS3haUSI7czo4OiJuaWNrbmFtZSI7czoxMjoi5rW35pif5LmL5qKmIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyOToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9vVmpQMGFYWXA3UGhsaWE4YUo5aWFSVktUbzVsRmljVHBDTjNMb1pqZU03bjNtckgxNmxhNHhwS3ZDRG54VkVLaG90Vk0yQlRlUHFLaWFwYVcwbDY5N0YwMEl0cGliS0VWREFzdS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1NTc3NTE4O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1508666083', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('41', '2', '2', '40', 'oNjw9wudU1CEemzjLgdikVeYy1Zs', '韦宜', '', 'MuY44SAZ', '1', '1506484043', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dWRVMUNFZW16akxnZGlrVmVZeTFacyI7czo4OiJuaWNrbmFtZSI7czo2OiLpn6blrpwiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iuays+axoCI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI4OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhHTVU0c2xxNU9pYnNpYWdiTUFOQTBaTENKV21Uc2ZqZG5ZNFJJeHhqalhlOHY2cmZpY0I1SzNnczBsemlhRDd0Wno5NzJ4TDVmZThVbXJwTEV2d0Jhd1NOUkgvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNjQ4NDA0MztzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('47', '2', '2', '46', 'oNjw9wiax-OX32qvPinz639NGDME', '简单快乐王学英', '', 'G4o1H1LI', '1', '1508231546', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aWF4LU9YMzJxdlBpbno2MzlOR0RNRSI7czo4OiJuaWNrbmFtZSI7czoyMToi566A5Y2V5b+r5LmQ546L5a2m6IuxIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi8wdElRUHc4SENyTnhGdmhTZjcyQkRBc2FMYW1kTDR3NTc3WHVqYlNOdHF3dHVqZUpacUlmcE9sVklNbkR0SlJOOXIxUzU3NjBKMjJpYnRDdnhZWWliUVBaSnVIbDNUejhIWS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA4MjMxNTQ2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('42', '2', '2', '41', 'oNjw9wswvtoVJb3Rd3CmZ2YRgV6Y', '雨江', '', 'SogMiKyr', '1', '1506484248', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c3d2dG9WSmIzUmQzQ21aMllSZ1Y2WSI7czo4OiJuaWNrbmFtZSI7czo2OiLpm6jmsZ8iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuWNl+WugSI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI4OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWHJrS2NXQUpDMURkd1hoUmpsMXRNZUlGOUM2a1loRDhoQnZ5SXlPaWNKaWJDMkNlRkMwWWxvdlZ6dnhwelVNQ0lpYllhZENTSW1CRFpCZGNRdTlwNXplbHcvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNjQ4NDI0ODtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('43', '2', '2', '42', 'oNjw9wujimSesPD6LJA-ESkKPL_g', '河池网展【负责人秦Mr】', '', 'DYkiniZS', '1', '1506485053', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dWppbVNlc1BENkxKQS1FU2tLUExfZyI7czo4OiJuaWNrbmFtZSI7czozMjoi5rKz5rGg572R5bGV44CQ6LSf6LSj5Lq656emTXLjgJEiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iuays+axoCI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWowMzlKTGliM05sMW41eVJLelMyaWMxYUx2SkJEQlhJNlBXWmpkSjBjM2JFQmU2N0pocWdITUY4WlVsV2xWSUlVc2VzZXk4NDNMMndDSWZCZ2NNRVE0ajRhLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDY0ODUwNTM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('44', '2', '2', '43', 'oNjw9wnJEd8jrJykb2pSqwpuRbrQ', '黄钰喹', '', 'Jo5FO155', '1', '1506562539', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bkpFZDhqckp5a2IycFNxd3B1UmJyUSI7czo4OiJuaWNrbmFtZSI7czo5OiLpu4TpkrDllrkiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3cyaHJVSU5LNkwzQ2tHQ1NQQW81ZUdzblVwUW5DeEhnTmliQXZzdzc0QTNTaWJleFRSdDR2Rmo2Y3J3b29kV2xtRFNZVkxkb0V1Umg1T25BRWliNE9FS0kzakVqQnZuNTVKcy8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA2NTYyNTM5O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('45', '2', '2', '44', 'oNjw9wmhe-9UYD9FcKi1kT0v3KpI', 'KK', '', 'y44R2S1S', '1', '1506563045', '0', 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bWhlLTlVWUQ5RmNLaTFrVDB2M0twSSI7czo4OiJuaWNrbmFtZSI7czoyOiJLSyI7czozOiJzZXgiO2k6MTtzOjg6Imxhbmd1YWdlIjtzOjU6InpoX0NOIjtzOjQ6ImNpdHkiO3M6Njoi5rex5ZyzIjtzOjg6InByb3ZpbmNlIjtzOjY6IuW5v+S4nCI7czo3OiJjb3VudHJ5IjtzOjY6IuS4reWbvSI7czoxMDoiaGVhZGltZ3VybCI7czoxMjk6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vaWNEMnNqMU16bVhYQTZHYk16VU9LeVNsNEV3OU1DNUZqcDFoZGYwaWFOQWczSUNrVU43QkJ3QmliZHppYkFUdDZHZlUyaWF4azRCYnVnc3BhRnFZelBiQmdlV0FSZTZRT2ZJb1cvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNjU2MzA0NTtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', '1508830729', '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('49', '2', '2', '48', 'oNjw9wtyn3_JNvcCnKsZCmRbWaI4', '毛明中', '', 'k1LXqIZK', '1', '1509338796', '0', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dHluM19KTnZjQ25Lc1pDbVJiV2FJNCI7czo4OiJuaWNrbmFtZSI7czo5OiLmr5vmmI7kuK0iO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTQzOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL1EzYXVIZ3p3ek01T3pPZms4dmpBQ044RHNOYldhTEdVYUdiV3Q4bVdJM3VwQXdpYWcwSWF6d3FxTjVVdTNRSXlYcmliQ2lhTVZ4anRSNGxzN1A3Vm9pYkl4aWJMbG9RcVhpYkt2ZFJKSFp0VmR5QTY0LzEzMiI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwOTMzODc5NjtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fXM6NjoiYXZhdGFyIjtzOjE0MzoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9RM2F1SGd6d3pNNU96T2ZrOHZqQUNOOERzTmJXYUxHVWFHYld0OG1XSTN1cEF3aWFnMElhendxcU41VXUzUUl5WHJpYkNpYU1WeGp0UjRsczdQN1ZvaWJJeGliTGxvUXFYaWJLdmRSSkhadFZkeUE2NC8xMzIiO30=', null, '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('46', '2', '2', '45', 'oNjw9wmjrakAO-8zA9Ke2fpxSYZQ', 'huijiutian1001', '', 'U84443E5', '0', '1507009766', '1507009779', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bWpyYWtBTy04ekE5S2UyZnB4U1laUSI7czo4OiJuaWNrbmFtZSI7czoxNDoiaHVpaml1dGlhbjEwMDEiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuacnemYsyI7czo4OiJwcm92aW5jZSI7czo2OiLljJfkuqwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWEE2R2JNelVPS3lXemw0azY0bjFmM1BnVjFadFNWSEJLb1J4MzR6TnJocGxkMVdFbEtHUmVNQXoyQW9zT1N4UXJwYUFzWEFJbjVwZG1YZ0pLaFZFQ3UvMTMyIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA3MDA5NzY2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czo2OiJhdmF0YXIiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWEE2R2JNelVPS3lXemw0azY0bjFmM1BnVjFadFNWSEJLb1J4MzR6TnJocGxkMVdFbEtHUmVNQXoyQW9zT1N4UXJwYUFzWEFJbjVwZG1YZ0pLaFZFQ3UvMTMyIjt9', null, '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('48', '2', '2', '47', 'oNjw9wr0Y83uqbRfOXuVb_brrz-A', '娜福', '', 'ITHXIH3P', '0', '1509257374', '1509257386', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cjBZODN1cWJSZk9YdVZiX2JycnotQSI7czo4OiJuaWNrbmFtZSI7czo2OiLlqJznpo8iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czo2OiLmmrnnspIiO3M6NzoiY291bnRyeSI7czo5OiLmn6zln5Tlr6giO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWozbmNGeEQyM1JGamI2VmJEMmtLYmliM2ttM0RhRUY3SnE4aGlhUGljSWMzRG83UG9pYXd6SG50dUw2UTFiT1BTSlNmWm9VR0ZabXlKSEZyTDQ0dDVWVkdkcHYvMTMyIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA5MjU3Mzc0O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czo2OiJhdmF0YXIiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWozbmNGeEQyM1JGamI2VmJEMmtLYmliM2ttM0RhRUY3SnE4aGlhUGljSWMzRG83UG9pYXd6SG50dUw2UTFiT1BTSlNmWm9VR0ZabXlKSEZyTDQ0dDVWVkdkcHYvMTMyIjt9', null, '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('50', '2', '2', '49', 'oNjw9wm_-VRlv1leFbGum-gJ0LsE', '忠祥', '', 'uzSWm4mz', '0', '1509410009', '1509410048', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bV8tVlJsdjFsZUZiR3VtLWdKMExzRSI7czo4OiJuaWNrbmFtZSI7czo2OiLlv6DnpaUiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czo5OiLlronpgZPlsJQiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTE3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2FqTlZkcUhaTExEb1lNOVBFQ3ZTVU9rTmFXRGZLcHVhNmpZaWE4SUd4MjFiWVVmcHM3TlRXMGxxejZrY2hSUzE1d2gyM2JyUXVQMUt5bVFmcFV1QTJGZy8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDk0MTAwMDk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjY6ImF2YXRhciI7czoxMTc6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vYWpOVmRxSFpMTERvWU05UEVDdlNVT2tOYVdEZktwdWE2allpYThJR3gyMWJZVWZwczdOVFcwbHF6NmtjaFJTMTV3aDIzYnJRdVAxS3ltUWZwVXVBMkZnLzEzMiI7fQ==', null, '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('51', '2', '2', '50', 'oNjw9wpU2oVsUgAPV1VaJyAl_XO8', '一艾', '', 'b1rz4W94', '1', '1509434405', '0', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cFUyb1ZzVWdBUFYxVmFKeUFsX1hPOCI7czo4OiJuaWNrbmFtZSI7czo2OiLkuIDoib4iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czoyOiJlbiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czoxMjoi6Zi/5aGe5ouc55aGIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzMToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9EbVQ3SnY2M3FqM25jRnhEMjNSRmpiRXNoaWNsaWNtcGpqNzdIcmZWTDQ2ODZKU2pKaWFWbWYxd085dGIwT3JYc2ljUUtLYWZPNlFocnpZOWlieFZocjhPOUIyUlMxRXd4Uks4RC8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDk0MzQ0MDU7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjY6ImF2YXRhciI7czoxMzE6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vRG1UN0p2NjNxajNuY0Z4RDIzUkZqYkVzaGljbGljbXBqajc3SHJmVkw0Njg2SlNqSmlhVm1mMXdPOXRiME9yWHNpY1FLS2FmTzZRaHJ6WTlpYnhWaHI4TzlCMlJTMUV3eFJLOEQvMTMyIjt9', null, '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('52', '2', '2', '51', 'oNjw9wg9J3_KuIelCay978tC1gR4', '悟空', '', 'uH6XpHP6', '1', '1509434639', '0', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3ZzlKM19LdUllbENheTk3OHRDMWdSNCI7czo4OiJuaWNrbmFtZSI7czo2OiLmgp/nqboiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czoyOiJlbiI7czo0OiJjaXR5IjtzOjY6IuaIkOmDvSI7czo4OiJwcm92aW5jZSI7czo2OiLlm5vlt50iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JPZUc1cmEyazlzclRhWUIxTkFmNWlhZEpyQTZ0ZUFiR204TFFQRHF5QldWbjFoMnlwOE1GVmR2UGdZRUdzVVhWVVNkV2VWbWlhR1F6eDYxV0RpYXpKVXo5cy8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDk0MzQ2Mzk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjY6ImF2YXRhciI7czoxMjk6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vMHRJUVB3OEhDck9lRzVyYTJrOXNyVGFZQjFOQWY1aWFkSnJBNnRlQWJHbThMUVBEcXlCV1ZuMWgyeXA4TUZWZHZQZ1lFR3NVWFZVU2RXZVZtaWFHUXp4NjFXRGlhekpVejlzLzEzMiI7fQ==', null, '');
INSERT INTO `ims_mc_mapping_fans` VALUES ('53', '2', '2', '52', 'oNjw9wjj1As4cGEs1g58ouOMiuhA', '小猴子', '', 'KAva66BK', '0', '1509618451', '1509618475', 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3amoxQXM0Y0dFczFnNThvdU9NaXVoQSI7czo4OiJuaWNrbmFtZSI7czo5OiLlsI/njLTlrZAiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuacnemYsyI7czo4OiJwcm92aW5jZSI7czo2OiLljJfkuqwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTIxOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JNZGJacVcyNGNya09zaWJoM2dJMGlhcEF0cTlLc3FJOENyRWljblgzaWNvTk5TNmpwMHFjT3ZOaEc1aWE0dTlMRTFxSnpSZ21Icng0c1h4d1EvMTMyIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA5NjE4NDUxO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czo2OiJhdmF0YXIiO3M6MTIxOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JNZGJacVcyNGNya09zaWJoM2dJMGlhcEF0cTlLc3FJOENyRWljblgzaWNvTk5TNmpwMHFjT3ZOaEc1aWE0dTlMRTFxSnpSZ21Icng0c1h4d1EvMTMyIjt9', null, '');

-- ----------------------------
-- Table structure for ims_mc_mapping_ucenter
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_mapping_ucenter`;
CREATE TABLE `ims_mc_mapping_ucenter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `centeruid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_mapping_ucenter
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_mass_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_mass_record`;
CREATE TABLE `ims_mc_mass_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `fansnum` int(10) unsigned NOT NULL,
  `msgtype` varchar(10) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `group` int(10) NOT NULL,
  `attach_id` int(10) unsigned NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `cron_id` int(10) unsigned NOT NULL,
  `sendtime` int(10) unsigned NOT NULL,
  `finalsendtime` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_mass_record
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_members
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_members`;
CREATE TABLE `ims_mc_members` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(8) NOT NULL,
  `groupid` int(11) NOT NULL,
  `credit1` decimal(10,2) unsigned NOT NULL,
  `credit2` decimal(10,2) unsigned NOT NULL,
  `credit3` decimal(10,2) unsigned NOT NULL,
  `credit4` decimal(10,2) unsigned NOT NULL,
  `credit5` decimal(10,2) unsigned NOT NULL,
  `credit6` decimal(10,2) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `realname` varchar(10) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) unsigned NOT NULL,
  `birthday` tinyint(3) unsigned NOT NULL,
  `constellation` varchar(10) NOT NULL,
  `zodiac` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idcard` varchar(30) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `resideprovince` varchar(30) NOT NULL,
  `residecity` varchar(30) NOT NULL,
  `residedist` varchar(30) NOT NULL,
  `graduateschool` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `education` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `revenue` varchar(10) NOT NULL,
  `affectivestatus` varchar(30) NOT NULL,
  `lookingfor` varchar(255) NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `msn` varchar(30) NOT NULL,
  `taobao` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `interest` text NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `groupid` (`groupid`),
  KEY `uniacid` (`uniacid`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_members
-- ----------------------------
INSERT INTO `ims_mc_members` VALUES ('1', '2', '15240694132', 'fdb7b2824b9d173764acb579653d70a4@we7.cc', '89ca75a742af0f2a2f4c76e29930fba7', 'BgBOJpSS', '2', '0.00', '9867.00', '0.00', '0.00', '0.00', '0.00', '1507773288', '庞金龙', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('2', '2', '18577384028', '38ccf0390f052253322706e550ae8913@we7.cc', '5a6d416bef8d8b7810a0bb6bd9a716fe', 'XUo6lvZe', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1507773332', '祖脉罗', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('3', '2', '18018777751', '86fd54160882e764aa9d9592786edb92@we7.cc', 'fea83e74f17742bde998fc7d0fc69454', 'dbBFb5vQ', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1502270740', '刘波', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('4', '2', '13554717055', 'd7b96e21d912f927720f722ea3f26310@we7.cc', '53315d47652278f4e382caa8819b480a', 'TjID5ef4', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1502349686', '周刚', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('5', '2', '', '1d4e0b78c8d337c6fa64258e96d21b76@we7.cc', 'd66326397e3bd60c696fe4e4ae6ff56e', 'z1Ob6vKs', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1503454770', '', 'Catanlina', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCHoicN0cUiacImvia3qdT1NppdHQSNlxV2EGcwxs4pUpaXwT22N3pRUQiaOziaBcSZ3unjC40woaqngjA/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('6', '2', '', '2dd7897e325458f40e366510eb948035@we7.cc', 'f89159433327bb078bce2b4c34233aea', 'M20Ma0X7', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1503541171', '', '吴泽民', 'http://wx.qlogo.cn/mmopen/BuySclrkBD6SBvASotUMsmZcRoM2gftt8ZGklFtVU6xp7CdSxcx7HVzNUSDwkdaYtOQ6mLaX4yCYBicsm4CgWLiaIZ2yMzqthB/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('7', '2', '', 'f65cbe5126c8c47e2f96482570bf806a@we7.cc', '900a19e2ef3d79228b34fb91360bc857', 'b7rHYn7Z', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1503542506', '', '庄海宏', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8E6RT55GRLBaHee6abqTGcInQmwExdnkyEY7hUTk5HcYTrM0Jwg6P4iaJJuqsIB1Tiawgm6lHJvIz0A/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('8', '2', '', '27a920bb980d33dac76f7b2fcfe6999a@we7.cc', '6f6433da5eb06bc5559f07daf82947d7', 'pvyuO0Ii', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1503542535', '', '简单', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8GMU4slq5OibsgPCdDu7M6r7YYYsuEibicicaNEz0ArMJq0D358mr496XiastUVLthPCQfgmrDJYyWF5p3sdpm7zz3Xic/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('9', '2', '', '7610dac5ad71ea70032b284cc56c1be7@we7.cc', '30669afc0ec8ca07da03f176ae9b538c', 'JJ7j3IJL', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1503564031', '', '小石孑', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXUf298MAWJR4sicnTNZibia7ibmibdddq8w4vXgnZbMIf5KhKA6PWD5T862rJATUtBOqy12MahIdp6VDk6DiaLk4LcFCZ/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('10', '2', '', '16fb13bcec716d65f5a2a8ffebc4586d@we7.cc', '12e63f18405e8608a34769e1e1946d0b', 'x283FfVR', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504242665', '', '鋆', 'http://wx.qlogo.cn/mmopen/w2hrUINK6L272QLxxMuwFWDfHPtDeAvPZSUNUibKa6ibV8W44UfB0eNDHD4nWNfkbPiaibwCldcoI6PGhchIicH9Vu2GpgNung63t/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('11', '2', '13554717088', '', '', 'xb52SnP2', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504526816', '周刚', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('12', '2', '18980408001', '0a0a5c3318f1da9e42ad861d8b289bc5@we7.cc', '129a3051ab9c3f966f32e1608049fbc4', 'GQShRbqB', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504680668', '天涯客', '天涯客', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKyd3JoCU1Zx9ERGz9OlRQbde1RwFyTpDkk86wSeGLn1SY51Beb5NIjMelvGCJjhttQicGPRSeticgXn/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('13', '2', '13540491005', '', '', 'Oon8aANb', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504680938', '天涯客', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('14', '2', '13692203997', '0c95ef2047bf6690e01e7619d7bd7464@we7.cc', '8a5bbc178a41f02a19fc62fbef5316d5', 'KU4bVfDH', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504682087', '吴华德', '吴华德', 'http://wx.qlogo.cn/mmopen/Xu4ibibST7Y3PHK9jlbVJiaXKzZicsYDHibibcF0LicWFXMnmFv5ia148tHs5LLqEyYsp4GbdI7wMCRicpVEXibDttia1hLWA8RuicBuMJ7o/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('15', '2', '13724303493', '60a7a2fcd524b6241665b12af0a25342@we7.cc', 'a0b511c4fab2ca84ec9851ea1a0f4522', 'OreRCUcd', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504682127', '段利华', '华', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKiaLDIHJic1mRCmxyF6bftktiaQNHZysBCviawbTsYPs6TqDDLeROtQQ47KbIVpoKJmpPu9ETlRyicWGeWgYwTJSbEKqTRoupvQzAM/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('16', '2', '17715272440', 'e128a2582c5ea697e03aa0560c850ffc@we7.cc', 'ead6661cd9c0496d616fa27879839673', 'b668dqiq', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504740964', '周峰', '周峰-南京智慧社区-njzhsq.com', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKdTLnkPJt9xCf4DmUpFiaqlOJwdNsNqK2XsFWUHd6bJDO4vIE2MYJI1da5KAMwQ6DPDOgGkQ95bCQ/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('17', '2', '18244914511', 'f88b0b85d5499897ff2e6e4bddf15154@we7.cc', 'd9cc2b0513cf4fa68ce7a752223e49e1', 'jLbH4SlS', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504742077', '钟卫东', '多面人东东', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj242dyzSYSOZjNTxzJ8taKNq5KPNtWicq1y712Il4jk1zNg67bxURYAFMYHAe0kBr2piaATzUFibP6gaU41CYsuZMR/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('18', '2', '13530368684', '4ba0c35a36861dde7be1042ed7353c36@we7.cc', 'dc7b14732a7bb2c8ba9308275c9d7e08', 'SmXOll2N', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504774927', '詹文明', '五福临門', 'http://wx.qlogo.cn/mmopen/bZYibyIicO8qhesJbic8pdPfibaOiamlc4KwCK6bFjd2dz8BOVg9MiafrWhMoh7FnRWXtvXq4J0Y38ibULd7uRLjdOdxXHbd1xOGCpT/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('19', '2', '13714288680', 'a48bd90f3bf7d9766f6ada30cfab52a2@we7.cc', '18c521c589732a4109340d196e1775f7', 'W82CAMMM', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504836126', '周玉军', '周玉軍', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXX0ewlujF1nDOsPGfamfOSzthlCia9TYEF0F0YWW4gso8mibNPY42Gl7SLnxJAJ1ylEB1tA0iaZtribfyoKBsGbQYL/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('20', '2', '13902919898', '375c8adaf009a848f8fa580afda31253@we7.cc', '8d2e4532fed90f6ca81fd883242baf7c', 'Lc27u72v', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504837899', '蔡飞', '薰衣草', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8GMU4slq5OibsuwCZ8XF316b9kPsqU9VIFgoDZSEHGuiatIvoqFWLzPBsEnSvhkKxJkw8IjYaQvAzDVzjTUavJHtb/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('21', '2', '15007557816', '3bad7aff52f570d90254c98869eb1fe6@we7.cc', '91c67f8cb92e6f9333fc982e866e2660', 'ynA1Z7nC', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504837963', '施思华', '施', 'http://wx.qlogo.cn/mmopen/Xu4ibibST7Y3PHK9jlbVJiaXJ0zGkhq2Ua2TvamicR5rqbUbzGMtB13Xic7Cy2L9cZ9iaibfabjfp4WvUXUca8T80Z3GCxGrIiby4kwS/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('22', '2', '13662664188', '7f87c6e8f2dc348cbac54a909a317a32@we7.cc', '1f08476f311cd9a82c1a96587ad0d927', 'U6Ll87jX', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504838345', '何小青', '青', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXU15LJTHdnHuKsvmjUsVSmgBDDyXtz3mj0zkyGufdof08oIaXLbxGKX3gPhy59zXcWC99XBwddf1GlyYwhibOlM/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('23', '2', '13798495355', 'a616afa3b39b4e3e5d0a20270ebd5e87@we7.cc', '4826bfc8c04dac3f6a88f8f0bc8b1af0', 'tfNB8z9g', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504840062', '张世佐', '张世佐', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj3ncFxD23RFjU9uWdoYKOibVz0RLFFunIwnYJRS1fy4hRD8t39wfA2E7OibD18TILEmiawVZ8ZZA4icE3P7AwN3pDIN/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('24', '2', '', '2974297059cf71bb6ff72de92b264ee9@we7.cc', '90655d669beab48f5b2bce12ab5fdbdb', 'z3u2mMOm', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504841790', '', '益，文武勇仁信', 'http://wx.qlogo.cn/mmopen/o4964TR5m1N6cfFkbu2xnwmv4o7Wd0vGxyWD3KQVTaP6Ezzibr8Q9QrSyB7xgEeNGialuM15Tibg3ibEia7keDJpO1FMkGBuCibr21/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('25', '2', '13923887685', '457277ddd7cb8976fd3455e8602b9146@we7.cc', 'edf3e835647c829a49c86f5518fbde07', 'MjCjJMAN', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504841821', '邓承力', '心无挂碍', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj2h9K4hudBQrQjS2NBmKO77xyssneMxGW45mKxIs1zQxiaemicNl0jqSE9624tKicSmSef5UiaOo5P9spYoic8FVXL5j/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('26', '2', '13544115623', '9818703538ad15be1e706b10f08d3227@we7.cc', '57d0632c8bce02672af16ab5e99d7eda', 'hg38HsmB', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504842990', '黄小平', '黄小平', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXV2eiaZf2DKjC6ib7CstibnZeRUUv59yGpJb2GAoe1hKg21EuS9j6gKbogRqtTqBvLib17zXJbKP26dU6faaCPcYPXl/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('27', '2', '', '80473bc0a8617a25415aaf4fdfa5392c@we7.cc', 'f60b7ea6756243b0e329dbfa378f7b49', 'M6BwIcc0', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504843075', '', '90、刘斯金', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrNLpbdQyGqdAo6WR7UDp81ia16VawOuMjetjQnCo90HEYKXlHtCZSncjM4EOBedYWvjEP1GcoNZ0ZPliczhTichFbk/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('28', '2', '', '50ba1f7b029371f5ead81b80d6f52a44@we7.cc', 'c8b92456a578631cc415022f0c3f0b8a', 'FyLb5lb8', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504843092', '', '不特别但唯一', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrPxftiaoKB15plKgaicTkBjWUfc4IzaAm7u6zicibmErLgLvQ6HWuEjCFtNDjicGmXtGCsdhe8uwFOlbzdYNllCXeQqK/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('29', '2', '', 'bd87127b849021ab9aed67ec9a1c96ed@we7.cc', 'c12629c9f870671bac06f3c9f91860aa', 'pCeJHeQe', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504843194', '', 'King', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKySUYVg3KCqodf3VNVhZ5M3UrmOOTWQYmvibLqF1QHibvm9crTJx8BODrbBaKXWOvtUmLlvs7JPxMx6/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('30', '2', '', 'a4d2e98ad8c76b96c5eb11f33a64df5c@we7.cc', '25c610801a2665f19dc93c55155dfd50', 'LW0gbRRh', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504843693', '', '杜君丽', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXV4uYzicyvYaF5hm97IH4vJVFRLV1y1VGDg9mQQvBzaMYZ9w38o2ic7gJxib70hw2H5TjPnricNrYu2V6AKYzicpmpUa/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('31', '2', '', 'e891fc7341f36a6749652ba1bb4e0807@we7.cc', 'd2d853be8f7e0ca4b9c9ef91b17fd30d', 'ISFvCdcQ', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504849064', '', '玲珑', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXUBwFD5dsKKx6OnHKp3mGIxJ3hNqiadWeNptGugNzaHGrDqOKmX1EdppNpNMHe5e1YoK0E2EmaAVr6d0pkWUc1qn/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('32', '2', '', '46f29c18a3c089e73356319eac5ca101@we7.cc', 'e2ee2c741975e9d4caf262ed48d5c2e5', 'jPBTn35u', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504851903', '', '胡', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj2fgOvryribhl8ox0PQtNPibU23CjnDXHC7NWP9PIbqBjxbX7K3Fib3AiaibQn2CYx9w6FGcDRTka9f38dkt5RLmP6ibx/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('33', '2', '', '257a5beefdbdabb6d41fb68a457046ef@we7.cc', '2c9d44788ab36bd0b96d5b4b0f7ed7ed', 's9YiWuYs', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504856055', '', 'ALEIER', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLDa3FlEJrnQSo4xeicRwr8ugU4fdTT62uI4FsN4cSbeicS5obfxULlsGd7yKtO7akexZQTyvwsyrMUQ/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('34', '2', '', '928c3e84ab3377d5f0771e161393f5c1@we7.cc', '90e72b60470852ac6678b3655a118e53', 'OBNNhfX2', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504858285', '', '静静', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrOeG5ra2k9srY5xJYhiclaFfkN03CGJSz2JIJP6kpYDCPheQWB028T1nyA5QLeFGYTzXMmOyiaicLDAkGwFkXHZFMY/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('35', '2', '', '0223febdbe1f7c598341ef39bb55f029@we7.cc', '7303baf38c8d44b1c8029cfc486dae5a', 'XX7xEbeZ', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1505146477', '', '心灵驿站：周付林', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj1JxTkSXFWeAD1MZUqFt2ITohbQml2DVUNy8Cibs0Ip3pfqFB5u6q7o9wichHvlkqwy8pb0TQ9SMY0Oo4cd6joKjQ/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('36', '2', '', 'a434b7824282275e7c79c497f4b1c0d9@we7.cc', '820a1740ec6df3944b03a3cc2c797710', 'IczMR3wB', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1505197495', '', '', '', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('37', '2', '15555555555', '9f13d98f39863afa9ba9b4953dbf03f9@we7.cc', 'ca821f950b2bbfceac9191fc5e6c59e8', 'wlES91SL', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1507815841', '李先生', '叶赛', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrOeG5ra2k9srUCDYbLYtS3ZrIGlSUC0Aaccsr3y50UZRrPJV0W3njnX9FCZuatpB7A18eOjWmDAtZcuhjBcHm4F/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('38', '2', '18098972608', 'b5735e46edb2a445d3cafc08172efd10@we7.cc', '73adb2de68339b3eba79e7a44fa76718', 'Ml88DrCR', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1507820631', '沈剑', '海星之梦', 'http://wx.qlogo.cn/mmopen/oVjP0aXYp7Phlia8aJ9iaRVKTo5lFicTpCN3LoZjeM7n3mrH16la4xpKvCDnxVEKhotVM2BTePqKiapaW0l697F00ItpibKEVDAsu/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('39', '2', '', 'c441036f49b6a5900231ad319224ef11@we7.cc', '4f3dda978f012fd6abf35fd587e1f8d9', 'nl1lq4by', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1505978746', '', 'Simple简质生活', 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM7RwLDqbkhRytVFJDQnlQdRXzuxXktvnPQuvMj9VXiafjeSicZnhKjOToDic42utDNLRsETdFRETP3icJAjTrhwzNaTBSh5zpicsSicQ/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('40', '2', '15677886209', '4b4e25732857f944c9e68082823504d2@we7.cc', '3b73a3c850734969ad3859cc2a9959ab', 'Cn1mN555', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1508902085', '韦宜', '韦宜', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8GMU4slq5OibsiagbMANA0ZLCJWmTsfjdnY4RIxxjjXe8v6rficB5K3gs0lziaD7tZz972xL5fe8UmrpLEvwBawSNRH/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('41', '2', '', 'c6ca2adaf5d547b5913cec002aefdf3d@we7.cc', 'd6c5b80d15a316171f1b824b279f0598', 'xAG7lnua', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1506484249', '', '雨江', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXrkKcWAJC1DdwXhRjl1tMeIF9C6kYhD8hBvyIyOicJibC2CeFC0YlovVzvxpzUMCIibYadCSImBDZBdcQu9p5zelw/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('42', '2', '', 'fa427995977fa5df42f9fee26ff8127d@we7.cc', '896d12537e6e615033a3ed9a019f5d15', 'fvc8Qs2Z', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1506485054', '', '河池网展【负责人秦Mr】', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj039JLib3Nl1n5yRKzS2ic1aLvJBDBXI6PWZjdJ0c3bEBe67JhqgHMF8ZUlWlVIIUsesey843L2wCIfBgcMEQ4j4a/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('43', '2', '13612999152', 'c2834d2d3a919032ee77e6e496e0041f@we7.cc', 'a98d794470d9a7c0d68e5d8e908eb07d', 'd77efCeF', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1506562798', '黄玉奎', '黄钰喹', 'http://wx.qlogo.cn/mmopen/w2hrUINK6L3CkGCSPAo5eGsnUpQnCxHgNibAvsw74A3SibexTRt4vFj6crwoodWlmDSYVLdoEuRh5OnAEib4OEKI3jEjBvn55Js/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('44', '2', '13692186370', 'f8608b739d055de12ea25a1f7443e306@we7.cc', 'f0cb6ec4e98fc2cfa38a17ead252c401', 'TcLr1PCm', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1506563148', '张爱军', 'KK', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKySl4Ew9MC5Fjp1hdf0iaNAg3ICkUN7BBwBibdzibATt6GfU2iaxk4BbugspaFqYzPbBgeWARe6QOfIoW/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('45', '2', '', 'e23041a2fdd2a17e0e05770ab925f1ab@we7.cc', '5d23db1c76d201256bd4f697d5191aba', 'tCxRbC9n', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1507009767', '', 'huijiutian1001', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKyWzl4k64n1f3PgV1ZtSVHBKoRx34zNrhpld1WElKGReMAz2AosOSxQrpaAsXAIn5pdmXgJKhVECu/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('46', '2', '', '7fef100109ae1d4aa5147d4c4b91c082@we7.cc', 'f72eb9145f789f299ec61b39e5381f8d', 'Zu1WUB48', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1508231547', '', '简单快乐王学英', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrNxFvhSf72BDAsaLamdL4w577XujbSNtqwtujeJZqIfpOlVIMnDtJRN9r1S5760J22ibtCvxYYibQPZJuHl3Tz8HY/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('47', '2', '', '3d6de9fbbb6b1a6e8fdbd285579fc02f@we7.cc', '1256140d85536b3d7cb6efe71791af5e', 'EUM2c1f8', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1509257374', '', '娜福', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj3ncFxD23RFjb6VbD2kKbib3km3DaEF7Jq8hiaPicIc3Do7PoiawzHntuL6Q1bOPSJSfZoUGFZmyJHFrL44t5VVGdpv/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('48', '2', '', '728032389563d9d4d097db6f66cb6bc9@we7.cc', 'd7f90daca15348f1b2d4ba000b96cb32', 'TTxpstSi', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1509338797', '', '毛明中', 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM5OzOfk8vjACN8DsNbWaLGUaGbWt8mWI3upAwiag0IazwqqN5Uu3QIyXribCiaMVxjtR4ls7P7VoibIxibLloQqXibKvdRJHZtVdyA64/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('49', '2', '', 'ae514b7e91e5dd61509422275207dacb@we7.cc', '002a42aafc05d1d1a7429355b6edde67', 'cTTF2T2T', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1509410010', '', '忠祥', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLDoYM9PECvSUOkNaWDfKpua6jYia8IGx21bYUfps7NTW0lqz6kchRS15wh23brQuP1KymQfpUuA2Fg/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('50', '2', '', '741782dc388815d731de12d56d0af5eb@we7.cc', '23f61c2e233062c0dc2d791a564dedab', 'J7tDg7wl', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1509434405', '', '一艾', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj3ncFxD23RFjbEshiclicmpjj77HrfVL4686JSjJiaVmf1wO9tb0OrXsicQKKafO6QhrzY9ibxVhr8O9B2RS1EwxRK8D/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('51', '2', '', '98592148c293ac7fbdbb34ad0cda8909@we7.cc', '1983a1a8087216979cb9d3c4dc3256cf', 'zW55nEcR', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1509434640', '', '悟空', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrOeG5ra2k9srTaYB1NAf5iadJrA6teAbGm8LQPDqyBWVn1h2yp8MFVdvPgYEGsUXVUSdWeVmiaGQzx61WDiazJUz9s/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ims_mc_members` VALUES ('52', '2', '', '7decca1ec6e90f582bfd1b9e0d2db629@we7.cc', 'a4497e553ab6c0cc53af326fc862b2ff', 'x92cFscK', '2', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1509618452', '', '小猴子', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrMdbZqW24crkOsibh3gI0iapAtq9KsqI8CrEicnX3icoNNS6jp0qcOvNhG5ia4u9LE1qJzRgmHrx4sXxwQ/132', '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for ims_mc_member_address
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_member_address`;
CREATE TABLE `ims_mc_member_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(50) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `province` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `district` varchar(32) NOT NULL,
  `address` varchar(512) NOT NULL,
  `isdefault` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uinacid` (`uniacid`),
  KEY `idx_uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_member_address
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_member_fields
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_member_fields`;
CREATE TABLE `ims_mc_member_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `fieldid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_fieldid` (`fieldid`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_member_fields
-- ----------------------------
INSERT INTO `ims_mc_member_fields` VALUES ('1', '2', '1', '真实姓名', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('2', '2', '2', '昵称', '1', '1');
INSERT INTO `ims_mc_member_fields` VALUES ('3', '2', '3', '头像', '1', '1');
INSERT INTO `ims_mc_member_fields` VALUES ('4', '2', '4', 'QQ号', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('5', '2', '5', '手机号码', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('6', '2', '6', 'VIP级别', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('7', '2', '7', '性别', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('8', '2', '8', '出生生日', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('9', '2', '9', '星座', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('10', '2', '10', '生肖', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('11', '2', '11', '固定电话', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('12', '2', '12', '证件号码', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('13', '2', '13', '学号', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('14', '2', '14', '班级', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('15', '2', '15', '邮寄地址', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('16', '2', '16', '邮编', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('17', '2', '17', '国籍', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('18', '2', '18', '居住地址', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('19', '2', '19', '毕业学校', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('20', '2', '20', '公司', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('21', '2', '21', '学历', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('22', '2', '22', '职业', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('23', '2', '23', '职位', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('24', '2', '24', '年收入', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('25', '2', '25', '情感状态', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('26', '2', '26', ' 交友目的', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('27', '2', '27', '血型', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('28', '2', '28', '身高', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('29', '2', '29', '体重', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('30', '2', '30', '支付宝帐号', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('31', '2', '31', 'MSN', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('32', '2', '32', '电子邮箱', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('33', '2', '33', '阿里旺旺', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('34', '2', '34', '主页', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('35', '2', '35', '自我介绍', '1', '0');
INSERT INTO `ims_mc_member_fields` VALUES ('36', '2', '36', '兴趣爱好', '1', '0');

-- ----------------------------
-- Table structure for ims_mc_member_property
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_member_property`;
CREATE TABLE `ims_mc_member_property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `property` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_member_property
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mc_oauth_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_oauth_fans`;
CREATE TABLE `ims_mc_oauth_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oauth_openid` varchar(50) NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_oauthopenid_acid` (`oauth_openid`,`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_oauth_fans
-- ----------------------------

-- ----------------------------
-- Table structure for ims_menu_event
-- ----------------------------
DROP TABLE IF EXISTS `ims_menu_event`;
CREATE TABLE `ims_menu_event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `picmd5` varchar(32) NOT NULL,
  `openid` varchar(128) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `picmd5` (`picmd5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_menu_event
-- ----------------------------

-- ----------------------------
-- Table structure for ims_mobilenumber
-- ----------------------------
DROP TABLE IF EXISTS `ims_mobilenumber`;
CREATE TABLE `ims_mobilenumber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mobilenumber
-- ----------------------------

-- ----------------------------
-- Table structure for ims_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules`;
CREATE TABLE `ims_modules` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `version` varchar(15) NOT NULL,
  `ability` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `author` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `settings` tinyint(1) NOT NULL,
  `subscribes` varchar(500) NOT NULL,
  `handles` varchar(500) NOT NULL,
  `isrulefields` tinyint(1) NOT NULL,
  `issystem` tinyint(1) unsigned NOT NULL,
  `target` int(10) unsigned NOT NULL,
  `iscard` tinyint(3) unsigned NOT NULL,
  `permissions` varchar(5000) NOT NULL,
  `title_initial` varchar(1) NOT NULL,
  `wxapp_support` tinyint(1) NOT NULL,
  `app_support` tinyint(1) NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `idx_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_modules
-- ----------------------------
INSERT INTO `ims_modules` VALUES ('1', 'basic', 'system', '基本文字回复', '1.0', '和您进行简单对话', '一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('2', 'news', 'system', '基本混合图文回复', '1.0', '为你提供生动的图文资讯', '一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('3', 'music', 'system', '基本音乐回复', '1.0', '提供语音、音乐等音频类回复', '在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('4', 'userapi', 'system', '自定义接口回复', '1.1', '更方便的第三方接口设置', '自定义接口又称第三方接口，可以让开发者更方便的接入微擎系统，高效的与微信公众平台进行对接整合。', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('5', 'recharge', 'system', '会员中心充值模块', '1.0', '提供会员充值功能', '', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '0', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('6', 'custom', 'system', '多客服转接', '1.0.0', '用来接入腾讯的多客服系统', '', 'WeEngine Team', 'http://bbs.we7.cc', '0', 'a:0:{}', 'a:6:{i:0;s:5:\"image\";i:1;s:5:\"voice\";i:2;s:5:\"video\";i:3;s:8:\"location\";i:4;s:4:\"link\";i:5;s:4:\"text\";}', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('7', 'images', 'system', '基本图片回复', '1.0', '提供图片回复', '在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('8', 'video', 'system', '基本视频回复', '1.0', '提供图片回复', '在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('9', 'voice', 'system', '基本语音回复', '1.0', '提供语音回复', '在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('10', 'chats', 'system', '发送客服消息', '1.0', '公众号可以在粉丝最后发送消息的48小时内无限制发送消息', '', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '0', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('11', 'wxcard', 'system', '微信卡券回复', '1.0', '微信卡券回复', '微信卡券回复', 'WeEngine Team', 'http://www.we7.cc/', '0', '', '', '1', '1', '0', '0', '', '', '1', '2');
INSERT INTO `ims_modules` VALUES ('12', 'feng_community', 'business', '微小区', '9.2.8.3.0', '微小区', '微小区', '蓝牛科技', 'we7xq.com', '0', 'a:0:{}', 'a:0:{}', '0', '0', '0', '0', 'N;', 'W', '1', '2');
INSERT INTO `ims_modules` VALUES ('13', 'j_money', 'services', '捷讯收银台', '2.94', '捷讯收银台', '捷讯收银台', 'ccrenway', 'https://www.admincn.cc', '1', 'a:7:{i:0;s:4:\"text\";i:1;s:9:\"subscribe\";i:2;s:13:\"user_get_card\";i:3;s:17:\"user_consume_card\";i:4;s:18:\"update_member_card\";i:5;s:14:\"user_view_card\";i:6;s:27:\"submit_membercard_user_info\";}', 'a:1:{i:0;s:4:\"text\";}', '1', '0', '0', '0', 'a:0:{}', 'J', '1', '2');

-- ----------------------------
-- Table structure for ims_modules_bindings
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_bindings`;
CREATE TABLE `ims_modules_bindings` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `entry` varchar(10) NOT NULL,
  `call` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `do` varchar(30) NOT NULL,
  `state` varchar(200) NOT NULL,
  `direct` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `displayorder` tinyint(255) unsigned NOT NULL,
  PRIMARY KEY (`eid`),
  KEY `idx_module` (`module`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_modules_bindings
-- ----------------------------
INSERT INTO `ims_modules_bindings` VALUES ('1', 'feng_community', 'cover', '', '主页入口', 'home', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('2', 'feng_community', 'cover', '', '小区通知入口', 'announcement', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('3', 'feng_community', 'cover', '', '小区活动入口', 'activity', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('4', 'feng_community', 'cover', '', '周边商家入口', 'business', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('5', 'feng_community', 'cover', '', '二手市场入口', 'fled', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('6', 'feng_community', 'cover', '', '物业缴费入口', 'cost', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('7', 'feng_community', 'cover', '', '小区家政入口', 'homemaking', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('8', 'feng_community', 'cover', '', '房屋租赁入口', 'houselease', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('9', 'feng_community', 'cover', '', '手机开门入口', 'opendoor', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('10', 'feng_community', 'cover', '', '便民号码入口', 'phone', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('11', 'feng_community', 'cover', '', '小区建议入口', 'report', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('12', 'feng_community', 'cover', '', '小区报修入口', 'repair', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('13', 'feng_community', 'cover', '', '便民查询入口', 'search', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('14', 'feng_community', 'cover', '', '小区拼车入口', 'car', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('15', 'feng_community', 'cover', '', '小区超市入口', 'shopping', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('16', 'feng_community', 'cover', '', '个人中心入口', 'member', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('17', 'feng_community', 'cover', '', '手机端管理入口', 'xqsys', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('18', 'feng_community', 'menu', '', '管理中心', 'manage', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('19', 'j_money', 'cover', '', '收银台入口', 'index', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('20', 'j_money', 'menu', '', '抽奖设置', 'lottery', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('21', 'j_money', 'menu', '', '文章营销', 'artcle', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('22', 'j_money', 'menu', '', '小票打印模板', 'print', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('23', 'j_money', 'menu', '', '收银记录', 'history', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('24', 'j_money', 'menu', '', '营销活动', 'function', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('25', 'j_money', 'menu', '', '收银员管理', 'member', '', '0', '', '', '0');
INSERT INTO `ims_modules_bindings` VALUES ('26', 'j_money', 'menu', '', '店铺管理', 'group', '', '0', '', '', '0');

-- ----------------------------
-- Table structure for ims_modules_plugin
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_plugin`;
CREATE TABLE `ims_modules_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `main_module` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `main_module` (`main_module`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_modules_plugin
-- ----------------------------
INSERT INTO `ims_modules_plugin` VALUES ('1', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('2', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('3', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('4', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('5', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('6', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('7', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('8', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('9', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('10', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('11', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('12', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('13', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('14', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('15', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('16', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('17', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('18', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('19', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('20', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('21', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('22', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('23', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('24', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('25', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('26', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('27', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('28', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('29', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('30', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('31', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('32', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('33', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('34', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('35', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('36', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('37', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('38', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('39', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('40', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('41', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('42', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('43', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('44', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('45', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('46', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('47', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('48', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('49', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('50', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('51', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('52', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('53', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('54', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('55', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('56', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('57', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('58', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('59', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('60', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('61', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('62', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('63', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('64', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('65', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('66', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('67', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('68', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('69', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('70', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('71', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('72', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('73', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('74', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('75', 'feng_community_plugin_adv', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('76', 'feng_community_plugin_lift', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('77', 'feng_community_plugin_chinaums', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('78', 'feng_community_plugin_chinaums', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('79', 'feng_community_plugin_chinaums', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('80', 'feng_community_plugin_chinaums', 'feng_community');
INSERT INTO `ims_modules_plugin` VALUES ('81', 'feng_community_plugin_chinaums', 'feng_community');

-- ----------------------------
-- Table structure for ims_modules_recycle
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_recycle`;
CREATE TABLE `ims_modules_recycle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modulename` (`modulename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_modules_recycle
-- ----------------------------

-- ----------------------------
-- Table structure for ims_music_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_music_reply`;
CREATE TABLE `ims_music_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(300) NOT NULL,
  `hqurl` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_music_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_news_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_news_reply`;
CREATE TABLE `ims_news_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `parent_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(500) NOT NULL,
  `content` mediumtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `displayorder` int(10) NOT NULL,
  `incontent` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `media_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_news_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_profile_fields
-- ----------------------------
DROP TABLE IF EXISTS `ims_profile_fields`;
CREATE TABLE `ims_profile_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `unchangeable` tinyint(1) NOT NULL,
  `showinregister` tinyint(1) NOT NULL,
  `field_length` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_profile_fields
-- ----------------------------
INSERT INTO `ims_profile_fields` VALUES ('1', 'realname', '1', '真实姓名', '', '0', '1', '1', '1', '0');
INSERT INTO `ims_profile_fields` VALUES ('2', 'nickname', '1', '昵称', '', '1', '1', '0', '1', '0');
INSERT INTO `ims_profile_fields` VALUES ('3', 'avatar', '1', '头像', '', '1', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('4', 'qq', '1', 'QQ号', '', '0', '0', '0', '1', '0');
INSERT INTO `ims_profile_fields` VALUES ('5', 'mobile', '1', '手机号码', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('6', 'vip', '1', 'VIP级别', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('7', 'gender', '1', '性别', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('8', 'birthyear', '1', '出生生日', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('9', 'constellation', '1', '星座', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('10', 'zodiac', '1', '生肖', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('11', 'telephone', '1', '固定电话', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('12', 'idcard', '1', '证件号码', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('13', 'studentid', '1', '学号', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('14', 'grade', '1', '班级', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('15', 'address', '1', '邮寄地址', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('16', 'zipcode', '1', '邮编', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('17', 'nationality', '1', '国籍', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('18', 'resideprovince', '1', '居住地址', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('19', 'graduateschool', '1', '毕业学校', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('20', 'company', '1', '公司', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('21', 'education', '1', '学历', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('22', 'occupation', '1', '职业', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('23', 'position', '1', '职位', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('24', 'revenue', '1', '年收入', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('25', 'affectivestatus', '1', '情感状态', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('26', 'lookingfor', '1', ' 交友目的', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('27', 'bloodtype', '1', '血型', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('28', 'height', '1', '身高', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('29', 'weight', '1', '体重', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('30', 'alipay', '1', '支付宝帐号', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('31', 'msn', '1', 'MSN', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('32', 'email', '1', '电子邮箱', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('33', 'taobao', '1', '阿里旺旺', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('34', 'site', '1', '主页', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('35', 'bio', '1', '自我介绍', '', '0', '0', '0', '0', '0');
INSERT INTO `ims_profile_fields` VALUES ('36', 'interest', '1', '兴趣爱好', '', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for ims_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `ims_qrcode`;
CREATE TABLE `ims_qrcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `extra` int(10) unsigned NOT NULL,
  `qrcid` bigint(20) NOT NULL,
  `scene_str` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `model` tinyint(1) unsigned NOT NULL,
  `ticket` varchar(250) NOT NULL,
  `url` varchar(256) NOT NULL,
  `expire` int(10) unsigned NOT NULL,
  `subnum` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_qrcid` (`qrcid`),
  KEY `uniacid` (`uniacid`),
  KEY `ticket` (`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_qrcode
-- ----------------------------

-- ----------------------------
-- Table structure for ims_qrcode_stat
-- ----------------------------
DROP TABLE IF EXISTS `ims_qrcode_stat`;
CREATE TABLE `ims_qrcode_stat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `qid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `qrcid` bigint(20) unsigned NOT NULL,
  `scene_str` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_qrcode_stat
-- ----------------------------

-- ----------------------------
-- Table structure for ims_rule
-- ----------------------------
DROP TABLE IF EXISTS `ims_rule`;
CREATE TABLE `ims_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `containtype` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_rule
-- ----------------------------
INSERT INTO `ims_rule` VALUES ('1', '0', '城市天气', 'userapi', '255', '1', '');
INSERT INTO `ims_rule` VALUES ('2', '0', '百度百科', 'userapi', '255', '1', '');
INSERT INTO `ims_rule` VALUES ('3', '0', '即时翻译', 'userapi', '255', '1', '');
INSERT INTO `ims_rule` VALUES ('4', '0', '今日老黄历', 'userapi', '255', '1', '');
INSERT INTO `ims_rule` VALUES ('5', '0', '看新闻', 'userapi', '255', '1', '');
INSERT INTO `ims_rule` VALUES ('6', '0', '快递查询', 'userapi', '255', '1', '');
INSERT INTO `ims_rule` VALUES ('7', '1', '个人中心入口设置', 'cover', '0', '1', '');
INSERT INTO `ims_rule` VALUES ('8', '1', '微擎团队入口设置', 'cover', '0', '1', '');
INSERT INTO `ims_rule` VALUES ('9', '2', '主页入口', 'cover', '0', '1', '');
INSERT INTO `ims_rule` VALUES ('10', '2', '嘉洲富苑', 'cover', '0', '1', '');
INSERT INTO `ims_rule` VALUES ('11', '2', '多多母婴', 'cover', '0', '1', '');

-- ----------------------------
-- Table structure for ims_rule_keyword
-- ----------------------------
DROP TABLE IF EXISTS `ims_rule_keyword`;
CREATE TABLE `ims_rule_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_content` (`content`),
  KEY `rid` (`rid`),
  KEY `idx_rid` (`rid`),
  KEY `idx_uniacid_type_content` (`uniacid`,`type`,`content`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_rule_keyword
-- ----------------------------
INSERT INTO `ims_rule_keyword` VALUES ('1', '1', '0', 'userapi', '^.+天气$', '3', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('2', '2', '0', 'userapi', '^百科.+$', '3', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('3', '2', '0', 'userapi', '^定义.+$', '3', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('4', '3', '0', 'userapi', '^@.+$', '3', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('5', '4', '0', 'userapi', '日历', '1', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('6', '4', '0', 'userapi', '万年历', '1', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('7', '4', '0', 'userapi', '黄历', '1', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('8', '4', '0', 'userapi', '几号', '1', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('9', '5', '0', 'userapi', '新闻', '1', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('10', '6', '0', 'userapi', '^(申通|圆通|中通|汇通|韵达|顺丰|EMS) *[a-z0-9]{1,}$', '3', '255', '1');
INSERT INTO `ims_rule_keyword` VALUES ('11', '7', '1', 'cover', '个人中心', '1', '0', '1');
INSERT INTO `ims_rule_keyword` VALUES ('12', '8', '1', 'cover', '首页', '1', '0', '1');
INSERT INTO `ims_rule_keyword` VALUES ('16', '9', '2', 'cover', '高新信息产业园', '1', '0', '1');
INSERT INTO `ims_rule_keyword` VALUES ('14', '10', '2', 'cover', '嘉洲富苑', '1', '0', '1');
INSERT INTO `ims_rule_keyword` VALUES ('15', '11', '2', 'cover', 'd1', '1', '0', '1');

-- ----------------------------
-- Table structure for ims_site_article
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_article`;
CREATE TABLE `ims_site_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `iscommend` tinyint(1) NOT NULL,
  `ishot` tinyint(1) unsigned NOT NULL,
  `pcate` int(10) unsigned NOT NULL,
  `ccate` int(10) unsigned NOT NULL,
  `template` varchar(300) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `incontent` tinyint(1) NOT NULL,
  `source` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  `linkurl` varchar(500) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `edittime` int(10) NOT NULL,
  `click` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `credit` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_iscommend` (`iscommend`),
  KEY `idx_ishot` (`ishot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_article
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_category
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_category`;
CREATE TABLE `ims_site_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `nid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `parentid` int(10) unsigned NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `icon` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `linkurl` varchar(500) NOT NULL,
  `ishomepage` tinyint(1) NOT NULL,
  `icontype` tinyint(1) unsigned NOT NULL,
  `css` varchar(500) NOT NULL,
  `multiid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_category
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_multi
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_multi`;
CREATE TABLE `ims_site_multi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `site_info` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `bindhost` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `bindhost` (`bindhost`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_multi
-- ----------------------------
INSERT INTO `ims_site_multi` VALUES ('1', '1', '微擎团队', '1', '', '1', '');
INSERT INTO `ims_site_multi` VALUES ('2', '2', '福城物业', '2', '', '1', '');

-- ----------------------------
-- Table structure for ims_site_nav
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_nav`;
CREATE TABLE `ims_site_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `section` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `displayorder` smallint(5) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `position` tinyint(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(500) NOT NULL,
  `css` varchar(1000) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `categoryid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `multiid` (`multiid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_nav
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_page
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_page`;
CREATE TABLE `ims_site_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `params` longtext NOT NULL,
  `html` longtext NOT NULL,
  `multipage` longtext NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `goodnum` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `multiid` (`multiid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_page
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_slide
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_slide`;
CREATE TABLE `ims_site_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `displayorder` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `multiid` (`multiid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_slide
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_store_goods
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_goods`;
CREATE TABLE `ims_site_store_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `title` varchar(100) NOT NULL,
  `module` varchar(50) NOT NULL,
  `account_num` int(10) NOT NULL,
  `wxapp_num` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `slide` varchar(1000) NOT NULL,
  `category_id` int(10) NOT NULL,
  `title_initial` varchar(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `synopsis` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `module_group` int(10) NOT NULL,
  `api_num` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module` (`module`),
  KEY `category_id` (`category_id`),
  KEY `price` (`price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_store_goods
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_store_order
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_order`;
CREATE TABLE `ims_site_store_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` varchar(28) NOT NULL,
  `goodsid` int(10) NOT NULL,
  `duration` int(10) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `buyerid` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `changeprice` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `endtime` int(15) NOT NULL,
  `wxapp` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `goodid` (`goodsid`),
  KEY `buyerid` (`buyerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_store_order
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_styles
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_styles`;
CREATE TABLE `ims_site_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `templateid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_styles
-- ----------------------------
INSERT INTO `ims_site_styles` VALUES ('1', '1', '1', '微站默认模板_gC5C');
INSERT INTO `ims_site_styles` VALUES ('2', '2', '1', '微站默认模板_iwMA');

-- ----------------------------
-- Table structure for ims_site_styles_vars
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_styles_vars`;
CREATE TABLE `ims_site_styles_vars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `templateid` int(10) unsigned NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `variable` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_styles_vars
-- ----------------------------

-- ----------------------------
-- Table structure for ims_site_templates
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_templates`;
CREATE TABLE `ims_site_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `version` varchar(64) NOT NULL,
  `description` varchar(500) NOT NULL,
  `author` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `sections` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_templates
-- ----------------------------
INSERT INTO `ims_site_templates` VALUES ('1', 'default', '微站默认模板', '', '由微擎提供默认微站模板套系', '微擎团队', 'http://we7.cc', '1', '0');

-- ----------------------------
-- Table structure for ims_stat_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_fans`;
CREATE TABLE `ims_stat_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `new` int(10) unsigned NOT NULL,
  `cancel` int(10) unsigned NOT NULL,
  `cumulate` int(10) NOT NULL,
  `date` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`date`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_fans
-- ----------------------------
INSERT INTO `ims_stat_fans` VALUES ('1', '1', '0', '0', '0', '20170806');
INSERT INTO `ims_stat_fans` VALUES ('2', '1', '0', '0', '0', '20170805');
INSERT INTO `ims_stat_fans` VALUES ('3', '1', '0', '0', '0', '20170804');
INSERT INTO `ims_stat_fans` VALUES ('4', '1', '0', '0', '0', '20170803');
INSERT INTO `ims_stat_fans` VALUES ('5', '1', '0', '0', '0', '20170802');
INSERT INTO `ims_stat_fans` VALUES ('6', '1', '0', '0', '0', '20170801');
INSERT INTO `ims_stat_fans` VALUES ('7', '1', '0', '0', '0', '20170731');
INSERT INTO `ims_stat_fans` VALUES ('8', '1', '0', '0', '0', '20170807');
INSERT INTO `ims_stat_fans` VALUES ('9', '1', '0', '0', '0', '20170808');
INSERT INTO `ims_stat_fans` VALUES ('10', '2', '1', '0', '8', '20170809');
INSERT INTO `ims_stat_fans` VALUES ('11', '2', '0', '0', '7', '20170808');
INSERT INTO `ims_stat_fans` VALUES ('12', '2', '0', '0', '7', '20170807');
INSERT INTO `ims_stat_fans` VALUES ('13', '2', '0', '0', '7', '20170806');
INSERT INTO `ims_stat_fans` VALUES ('14', '2', '0', '0', '7', '20170805');
INSERT INTO `ims_stat_fans` VALUES ('15', '2', '1', '1', '7', '20170804');
INSERT INTO `ims_stat_fans` VALUES ('16', '2', '5', '0', '7', '20170803');
INSERT INTO `ims_stat_fans` VALUES ('17', '2', '0', '0', '2', '20170802');
INSERT INTO `ims_stat_fans` VALUES ('18', '2', '0', '0', '8', '20170810');
INSERT INTO `ims_stat_fans` VALUES ('19', '2', '0', '0', '8', '20170813');
INSERT INTO `ims_stat_fans` VALUES ('20', '2', '0', '0', '8', '20170812');
INSERT INTO `ims_stat_fans` VALUES ('21', '2', '0', '0', '8', '20170811');
INSERT INTO `ims_stat_fans` VALUES ('22', '2', '0', '0', '8', '20170814');
INSERT INTO `ims_stat_fans` VALUES ('23', '2', '0', '0', '8', '20170815');
INSERT INTO `ims_stat_fans` VALUES ('24', '2', '0', '0', '8', '20170816');
INSERT INTO `ims_stat_fans` VALUES ('25', '2', '0', '0', '8', '20170817');
INSERT INTO `ims_stat_fans` VALUES ('26', '2', '0', '0', '8', '20170818');
INSERT INTO `ims_stat_fans` VALUES ('27', '2', '0', '0', '8', '20170820');
INSERT INTO `ims_stat_fans` VALUES ('28', '2', '0', '0', '8', '20170819');
INSERT INTO `ims_stat_fans` VALUES ('29', '2', '0', '0', '8', '20170821');
INSERT INTO `ims_stat_fans` VALUES ('30', '2', '1', '0', '9', '20170823');
INSERT INTO `ims_stat_fans` VALUES ('31', '2', '0', '0', '8', '20170822');
INSERT INTO `ims_stat_fans` VALUES ('32', '2', '5', '0', '14', '20170824');
INSERT INTO `ims_stat_fans` VALUES ('33', '2', '0', '1', '13', '20170825');
INSERT INTO `ims_stat_fans` VALUES ('34', '2', '0', '1', '13', '20170825');
INSERT INTO `ims_stat_fans` VALUES ('35', '2', '0', '0', '13', '20170827');
INSERT INTO `ims_stat_fans` VALUES ('36', '2', '0', '0', '13', '20170826');
INSERT INTO `ims_stat_fans` VALUES ('37', '2', '0', '0', '13', '20170828');
INSERT INTO `ims_stat_fans` VALUES ('38', '2', '0', '0', '13', '20170829');
INSERT INTO `ims_stat_fans` VALUES ('39', '2', '0', '0', '13', '20170830');
INSERT INTO `ims_stat_fans` VALUES ('40', '2', '0', '0', '13', '20170831');
INSERT INTO `ims_stat_fans` VALUES ('41', '2', '1', '0', '14', '20170901');
INSERT INTO `ims_stat_fans` VALUES ('42', '2', '0', '0', '14', '20170903');
INSERT INTO `ims_stat_fans` VALUES ('43', '2', '0', '0', '14', '20170902');
INSERT INTO `ims_stat_fans` VALUES ('44', '2', '0', '0', '14', '20170904');
INSERT INTO `ims_stat_fans` VALUES ('45', '2', '0', '0', '14', '20170905');
INSERT INTO `ims_stat_fans` VALUES ('46', '2', '0', '0', '14', '20170905');
INSERT INTO `ims_stat_fans` VALUES ('47', '2', '3', '0', '17', '20170906');
INSERT INTO `ims_stat_fans` VALUES ('48', '2', '3', '1', '19', '20170907');
INSERT INTO `ims_stat_fans` VALUES ('49', '2', '16', '1', '34', '20170908');
INSERT INTO `ims_stat_fans` VALUES ('50', '2', '0', '0', '34', '20170910');
INSERT INTO `ims_stat_fans` VALUES ('51', '2', '0', '0', '34', '20170909');
INSERT INTO `ims_stat_fans` VALUES ('52', '2', '1', '1', '35', '20170912');
INSERT INTO `ims_stat_fans` VALUES ('53', '2', '0', '0', '35', '20170914');
INSERT INTO `ims_stat_fans` VALUES ('54', '2', '0', '0', '35', '20170913');
INSERT INTO `ims_stat_fans` VALUES ('55', '2', '1', '0', '35', '20170911');
INSERT INTO `ims_stat_fans` VALUES ('56', '2', '2', '0', '37', '20170916');
INSERT INTO `ims_stat_fans` VALUES ('57', '2', '0', '0', '35', '20170915');
INSERT INTO `ims_stat_fans` VALUES ('58', '2', '1', '0', '0', '20170921');
INSERT INTO `ims_stat_fans` VALUES ('59', '2', '3', '0', '0', '20170927');
INSERT INTO `ims_stat_fans` VALUES ('60', '2', '2', '0', '0', '20170928');
INSERT INTO `ims_stat_fans` VALUES ('61', '2', '1', '1', '43', '20171003');
INSERT INTO `ims_stat_fans` VALUES ('62', '2', '0', '0', '43', '20171005');
INSERT INTO `ims_stat_fans` VALUES ('63', '2', '0', '0', '43', '20171004');
INSERT INTO `ims_stat_fans` VALUES ('64', '2', '0', '0', '43', '20171002');
INSERT INTO `ims_stat_fans` VALUES ('65', '2', '0', '0', '43', '20171001');
INSERT INTO `ims_stat_fans` VALUES ('66', '2', '0', '0', '43', '20170930');
INSERT INTO `ims_stat_fans` VALUES ('67', '2', '0', '0', '43', '20170929');
INSERT INTO `ims_stat_fans` VALUES ('68', '2', '0', '0', '43', '20171006');
INSERT INTO `ims_stat_fans` VALUES ('69', '2', '0', '0', '43', '20171011');
INSERT INTO `ims_stat_fans` VALUES ('70', '2', '0', '0', '43', '20171010');
INSERT INTO `ims_stat_fans` VALUES ('71', '2', '0', '0', '43', '20171009');
INSERT INTO `ims_stat_fans` VALUES ('72', '2', '0', '0', '43', '20171008');
INSERT INTO `ims_stat_fans` VALUES ('73', '2', '0', '0', '43', '20171007');
INSERT INTO `ims_stat_fans` VALUES ('74', '2', '0', '0', '43', '20171012');
INSERT INTO `ims_stat_fans` VALUES ('75', '2', '0', '0', '43', '20171015');
INSERT INTO `ims_stat_fans` VALUES ('76', '2', '0', '0', '43', '20171014');
INSERT INTO `ims_stat_fans` VALUES ('77', '2', '0', '0', '43', '20171013');
INSERT INTO `ims_stat_fans` VALUES ('78', '2', '1', '1', '43', '20171017');
INSERT INTO `ims_stat_fans` VALUES ('79', '2', '0', '0', '43', '20171016');
INSERT INTO `ims_stat_fans` VALUES ('80', '2', '0', '0', '43', '20171021');
INSERT INTO `ims_stat_fans` VALUES ('81', '2', '0', '0', '43', '20171020');
INSERT INTO `ims_stat_fans` VALUES ('82', '2', '0', '0', '43', '20171019');
INSERT INTO `ims_stat_fans` VALUES ('83', '2', '0', '0', '43', '20171018');
INSERT INTO `ims_stat_fans` VALUES ('84', '2', '0', '1', '42', '20171022');
INSERT INTO `ims_stat_fans` VALUES ('85', '2', '0', '0', '42', '20171023');
INSERT INTO `ims_stat_fans` VALUES ('86', '2', '0', '0', '42', '20171024');
INSERT INTO `ims_stat_fans` VALUES ('87', '2', '1', '1', '42', '20171029');
INSERT INTO `ims_stat_fans` VALUES ('88', '2', '1', '0', '43', '20171030');
INSERT INTO `ims_stat_fans` VALUES ('89', '2', '3', '1', '45', '20171031');
INSERT INTO `ims_stat_fans` VALUES ('90', '2', '0', '1', '44', '20171101');
INSERT INTO `ims_stat_fans` VALUES ('91', '2', '1', '1', '44', '20171102');
INSERT INTO `ims_stat_fans` VALUES ('92', '2', '0', '0', '42', '20171028');
INSERT INTO `ims_stat_fans` VALUES ('93', '2', '0', '0', '42', '20171027');
INSERT INTO `ims_stat_fans` VALUES ('94', '2', '0', '0', '44', '20171105');
INSERT INTO `ims_stat_fans` VALUES ('95', '2', '0', '0', '44', '20171104');
INSERT INTO `ims_stat_fans` VALUES ('96', '2', '0', '0', '44', '20171103');
INSERT INTO `ims_stat_fans` VALUES ('97', '2', '0', '0', '44', '20171106');
INSERT INTO `ims_stat_fans` VALUES ('98', '2', '0', '0', '44', '20171107');

-- ----------------------------
-- Table structure for ims_stat_keyword
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_keyword`;
CREATE TABLE `ims_stat_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` varchar(10) NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `hit` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for ims_stat_msg_history
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_msg_history`;
CREATE TABLE `ims_stat_msg_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `type` varchar(10) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_msg_history
-- ----------------------------

-- ----------------------------
-- Table structure for ims_stat_rule
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_rule`;
CREATE TABLE `ims_stat_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `hit` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_rule
-- ----------------------------

-- ----------------------------
-- Table structure for ims_stat_visit
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_visit`;
CREATE TABLE `ims_stat_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `module` varchar(100) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `module` (`module`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_visit
-- ----------------------------

-- ----------------------------
-- Table structure for ims_uni_account
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account`;
CREATE TABLE `ims_uni_account` (
  `uniacid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `default_acid` int(10) unsigned NOT NULL,
  `rank` int(10) DEFAULT NULL,
  `title_initial` varchar(1) NOT NULL,
  PRIMARY KEY (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_account
-- ----------------------------
INSERT INTO `ims_uni_account` VALUES ('1', '-1', '微擎团队', '一个朝气蓬勃的团队', '1', '1', 'W');
INSERT INTO `ims_uni_account` VALUES ('2', '0', '福城物业', '', '2', '3', 'F');

-- ----------------------------
-- Table structure for ims_uni_account_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_group`;
CREATE TABLE `ims_uni_account_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `groupid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_account_group
-- ----------------------------
INSERT INTO `ims_uni_account_group` VALUES ('1', '2', '-1');

-- ----------------------------
-- Table structure for ims_uni_account_menus
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_menus`;
CREATE TABLE `ims_uni_account_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `menuid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL,
  `group_id` int(10) NOT NULL,
  `client_platform_type` tinyint(3) unsigned NOT NULL,
  `area` varchar(50) NOT NULL,
  `data` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `isdeleted` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `menuid` (`menuid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_account_menus
-- ----------------------------
INSERT INTO `ims_uni_account_menus` VALUES ('1', '2', '0', '1', '基本服务', '0', '-1', '0', '', 'YToxOntzOjY6ImJ1dHRvbiI7YTozOntpOjA7YToyOntzOjQ6Im5hbWUiO3M6MTI6IueJqeS4mueuoeeQhiI7czoxMDoic3ViX2J1dHRvbiI7YTo1OntpOjA7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuWwj+WMuuS4u+mhtSI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjUzOiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MSI7fWk6MTthOjM6e3M6NDoibmFtZSI7czoxMjoi5omL5py65byA6ZeoIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD05Ijt9aToyO2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLniankuJrnvLTotLkiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTYiO31pOjM7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuaKpeS6i+aKpeS/riI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjU0OiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MTIiO31pOjQ7YTozOntzOjQ6Im5hbWUiO3M6MTI6IueJqeS4mueuoeeQhiI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjU0OiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MTciO319fWk6MTthOjI6e3M6NDoibmFtZSI7czoxMjoi5pm66IO95YGc6L2mIjtzOjEwOiJzdWJfYnV0dG9uIjthOjU6e2k6MDthOjM6e3M6NDoibmFtZSI7czoxMjoi6L2m5L2N5p+l6K+iIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xIjt9aToxO2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLmn6XnnIvotLnnlKgiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTEiO31pOjI7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuWcqOe6v+e8tOi0uSI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjUzOiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MSI7fWk6MzthOjM6e3M6NDoibmFtZSI7czoxMjoi5pyI5Y2h57ut56efIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xIjt9aTo0O2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLovabovobnrqHnkIYiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTEiO319fWk6MjthOjI6e3M6NDoibmFtZSI7czoxMjoi55Sf5rS7566h5a62IjtzOjEwOiJzdWJfYnV0dG9uIjthOjU6e2k6MDthOjM6e3M6NDoibmFtZSI7czoxMjoi5a625pS/5pyN5YqhIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD03Ijt9aToxO2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLmiL/lsYvnp5/otYEiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTgiO31pOjI7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuWRqOi+ueWVhuWutiI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjUzOiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9NCI7fWk6MzthOjM6e3M6NDoibmFtZSI7czoxMjoi5bCP5Yy66LaF5biCIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xNSI7fWk6NDthOjM6e3M6NDoibmFtZSI7czoxMjoi5ou86L2m5pyN5YqhIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xNCI7fX19fX0=', '1', '1504924581', '0');

-- ----------------------------
-- Table structure for ims_uni_account_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_modules`;
CREATE TABLE `ims_uni_account_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `settings` text NOT NULL,
  `shortcut` tinyint(1) unsigned NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_module` (`module`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_account_modules
-- ----------------------------

-- ----------------------------
-- Table structure for ims_uni_account_users
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_users`;
CREATE TABLE `ims_uni_account_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `role` varchar(255) NOT NULL,
  `rank` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_memberid` (`uid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_account_users
-- ----------------------------
INSERT INTO `ims_uni_account_users` VALUES ('1', '2', '2', 'clerk', '0');
INSERT INTO `ims_uni_account_users` VALUES ('2', '2', '3', 'operator', '0');
INSERT INTO `ims_uni_account_users` VALUES ('3', '2', '4', 'operator', '0');
INSERT INTO `ims_uni_account_users` VALUES ('4', '2', '5', 'clerk', '0');

-- ----------------------------
-- Table structure for ims_uni_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_group`;
CREATE TABLE `ims_uni_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `modules` varchar(15000) NOT NULL,
  `templates` varchar(5000) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `owner_uid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_group
-- ----------------------------
INSERT INTO `ims_uni_group` VALUES ('1', '体验套餐服务', 'a:1:{i:0;s:14:\"feng_community\";}', 'N;', '0', '0');

-- ----------------------------
-- Table structure for ims_uni_settings
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_settings`;
CREATE TABLE `ims_uni_settings` (
  `uniacid` int(10) unsigned NOT NULL,
  `passport` varchar(200) NOT NULL,
  `oauth` varchar(100) NOT NULL,
  `jsauth_acid` int(10) unsigned NOT NULL,
  `uc` varchar(500) NOT NULL,
  `notify` varchar(2000) NOT NULL,
  `creditnames` varchar(500) NOT NULL,
  `creditbehaviors` varchar(500) NOT NULL,
  `welcome` varchar(60) NOT NULL,
  `default` varchar(60) NOT NULL,
  `default_message` varchar(2000) NOT NULL,
  `payment` text NOT NULL,
  `stat` varchar(300) NOT NULL,
  `default_site` int(10) unsigned DEFAULT NULL,
  `sync` tinyint(3) unsigned NOT NULL,
  `recharge` varchar(500) NOT NULL,
  `tplnotice` varchar(1000) NOT NULL,
  `grouplevel` tinyint(3) unsigned NOT NULL,
  `mcplugin` varchar(500) NOT NULL,
  `exchange_enable` tinyint(3) unsigned NOT NULL,
  `coupon_type` tinyint(3) unsigned NOT NULL,
  `menuset` text NOT NULL,
  `statistics` varchar(100) NOT NULL,
  PRIMARY KEY (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_settings
-- ----------------------------
INSERT INTO `ims_uni_settings` VALUES ('1', 'a:3:{s:8:\"focusreg\";i:0;s:4:\"item\";s:5:\"email\";s:4:\"type\";s:8:\"password\";}', 'a:2:{s:6:\"status\";s:1:\"0\";s:7:\"account\";s:1:\"0\";}', '0', 'a:1:{s:6:\"status\";i:0;}', 'a:1:{s:3:\"sms\";a:2:{s:7:\"balance\";i:0;s:9:\"signature\";s:0:\"\";}}', 'a:5:{s:7:\"credit1\";a:2:{s:5:\"title\";s:6:\"积分\";s:7:\"enabled\";i:1;}s:7:\"credit2\";a:2:{s:5:\"title\";s:6:\"余额\";s:7:\"enabled\";i:1;}s:7:\"credit3\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}s:7:\"credit4\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}s:7:\"credit5\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}}', 'a:2:{s:8:\"activity\";s:7:\"credit1\";s:8:\"currency\";s:7:\"credit2\";}', '', '', '', 'a:4:{s:6:\"credit\";a:1:{s:6:\"switch\";b:0;}s:6:\"alipay\";a:4:{s:6:\"switch\";b:0;s:7:\"account\";s:0:\"\";s:7:\"partner\";s:0:\"\";s:6:\"secret\";s:0:\"\";}s:6:\"wechat\";a:5:{s:6:\"switch\";b:0;s:7:\"account\";b:0;s:7:\"signkey\";s:0:\"\";s:7:\"partner\";s:0:\"\";s:3:\"key\";s:0:\"\";}s:8:\"delivery\";a:1:{s:6:\"switch\";b:0;}}', '', '1', '0', '', '', '0', '', '0', '0', '', '');
INSERT INTO `ims_uni_settings` VALUES ('2', '', 'a:2:{s:7:\"account\";s:1:\"2\";s:4:\"host\";s:0:\"\";}', '0', '', '', 'a:2:{s:7:\"credit1\";a:2:{s:5:\"title\";s:6:\"积分\";s:7:\"enabled\";i:1;}s:7:\"credit2\";a:2:{s:5:\"title\";s:6:\"余额\";s:7:\"enabled\";i:1;}}', 'a:2:{s:8:\"activity\";s:7:\"credit1\";s:8:\"currency\";s:7:\"credit2\";}', '', '', '', 'a:3:{s:6:\"alipay\";a:1:{s:6:\"switch\";b:1;}s:6:\"credit\";a:1:{s:6:\"switch\";b:1;}s:8:\"delivery\";a:1:{s:6:\"switch\";b:1;}}', '', '2', '1', '', '', '0', '', '0', '0', '', '');

-- ----------------------------
-- Table structure for ims_uni_verifycode
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_verifycode`;
CREATE TABLE `ims_uni_verifycode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `verifycode` varchar(6) NOT NULL,
  `total` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_verifycode
-- ----------------------------

-- ----------------------------
-- Table structure for ims_userapi_cache
-- ----------------------------
DROP TABLE IF EXISTS `ims_userapi_cache`;
CREATE TABLE `ims_userapi_cache` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_userapi_cache
-- ----------------------------

-- ----------------------------
-- Table structure for ims_userapi_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_userapi_reply`;
CREATE TABLE `ims_userapi_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `description` varchar(300) NOT NULL,
  `apiurl` varchar(300) NOT NULL,
  `token` varchar(32) NOT NULL,
  `default_text` varchar(100) NOT NULL,
  `cachetime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_userapi_reply
-- ----------------------------
INSERT INTO `ims_userapi_reply` VALUES ('1', '1', '\"城市名+天气\", 如: \"北京天气\"', 'weather.php', '', '', '0');
INSERT INTO `ims_userapi_reply` VALUES ('2', '2', '\"百科+查询内容\" 或 \"定义+查询内容\", 如: \"百科姚明\", \"定义自行车\"', 'baike.php', '', '', '0');
INSERT INTO `ims_userapi_reply` VALUES ('3', '3', '\"@查询内容(中文或英文)\"', 'translate.php', '', '', '0');
INSERT INTO `ims_userapi_reply` VALUES ('4', '4', '\"日历\", \"万年历\", \"黄历\"或\"几号\"', 'calendar.php', '', '', '0');
INSERT INTO `ims_userapi_reply` VALUES ('5', '5', '\"新闻\"', 'news.php', '', '', '0');
INSERT INTO `ims_userapi_reply` VALUES ('6', '6', '\"快递+单号\", 如: \"申通1200041125\"', 'express.php', '', '', '0');

-- ----------------------------
-- Table structure for ims_users
-- ----------------------------
DROP TABLE IF EXISTS `ims_users`;
CREATE TABLE `ims_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(10) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `joindate` int(10) unsigned NOT NULL,
  `joinip` varchar(15) NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL,
  `lastip` varchar(15) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  `owner_uid` int(10) NOT NULL,
  `founder_groupid` tinyint(4) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users
-- ----------------------------
INSERT INTO `ims_users` VALUES ('1', '0', 'admin', 'abd3539bc8ebae4d999258b9226fb4c447a0fdae', 'fb6fdf17', '1', '0', '1502070134', '', '1511363483', '127.0.0.1', '', '0', '0', '0', '1');
INSERT INTO `ims_users` VALUES ('2', '0', 'wuye', '8cbe48a87b33be00922a0a7953a678be2cad2785', 'bUvKdEPu', '3', '2', '1504924983', '116.1.4.48', '1508666054', '116.1.116.243', '', '0', '0', '0', '0');
INSERT INTO `ims_users` VALUES ('3', '1', '15880089917', '8904b28f22ec4f0b6745b491bea7280a77b182eb', 'x1j316Ff', '1', '2', '1504925606', '116.1.4.48', '1505117524', '14.25.62.207', '', '0', '0', '0', '0');
INSERT INTO `ims_users` VALUES ('4', '1', '13540491005', 'ee4ce55478a8e12a352d2a8b56feeb6ad5761e59', 'U9Jq2M09', '1', '2', '1504945881', '14.20.91.248', '1505117919', '14.25.62.207', '', '0', '0', '0', '0');
INSERT INTO `ims_users` VALUES ('5', '0', 'long', '49fde0ff9f772ec18f4a8a5818b3341a16c9fcef', 'HYmKGlQz', '3', '2', '1510125612', '127.0.0.1', '1510125612', '127.0.0.1', '', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for ims_users_failed_login
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_failed_login`;
CREATE TABLE `ims_users_failed_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `username` varchar(32) NOT NULL,
  `count` tinyint(1) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_username` (`ip`,`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users_failed_login
-- ----------------------------
INSERT INTO `ims_users_failed_login` VALUES ('7', '127.0.0.1', 'A001', '1', '1511363476');

-- ----------------------------
-- Table structure for ims_users_founder_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_founder_group`;
CREATE TABLE `ims_users_founder_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `package` varchar(5000) NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxsubaccount` int(10) unsigned NOT NULL,
  `timelimit` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users_founder_group
-- ----------------------------

-- ----------------------------
-- Table structure for ims_users_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_group`;
CREATE TABLE `ims_users_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `package` varchar(5000) NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxsubaccount` int(10) unsigned NOT NULL,
  `timelimit` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL,
  `owner_uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users_group
-- ----------------------------

-- ----------------------------
-- Table structure for ims_users_invitation
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_invitation`;
CREATE TABLE `ims_users_invitation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `fromuid` int(10) unsigned NOT NULL,
  `inviteuid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users_invitation
-- ----------------------------

-- ----------------------------
-- Table structure for ims_users_permission
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_permission`;
CREATE TABLE `ims_users_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(100) NOT NULL,
  `permission` varchar(10000) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users_permission
-- ----------------------------
INSERT INTO `ims_users_permission` VALUES ('1', '2', '2', 'feng_community', 'feng_community_permissions|feng_community_cover_home|feng_community_cover_announcement|feng_community_cover_activity|feng_community_cover_business|feng_community_cover_fled|feng_community_cover_cost|feng_community_cover_homemaking|feng_community_cover_houselease|feng_community_cover_opendoor|feng_community_cover_phone|feng_community_cover_report|feng_community_cover_repair|feng_community_cover_search|feng_community_cover_car|feng_community_cover_shopping|feng_community_cover_member|feng_community_cover_xqsys|feng_community_menu_manage', '');
INSERT INTO `ims_users_permission` VALUES ('2', '2', '3', 'feng_community', 'all', '');
INSERT INTO `ims_users_permission` VALUES ('3', '2', '4', 'feng_community', 'all', '');
INSERT INTO `ims_users_permission` VALUES ('4', '2', '5', 'j_money', 'j_money_permissions|j_money_settings|j_money_rule|j_money_cover_index|j_money_menu_lottery|j_money_menu_artcle|j_money_menu_print|j_money_menu_history|j_money_menu_function|j_money_menu_member|j_money_menu_group', '');

-- ----------------------------
-- Table structure for ims_users_profile
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_profile`;
CREATE TABLE `ims_users_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `edittime` int(10) NOT NULL,
  `realname` varchar(10) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `fakeid` varchar(30) NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) unsigned NOT NULL,
  `birthday` tinyint(3) unsigned NOT NULL,
  `constellation` varchar(10) NOT NULL,
  `zodiac` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idcard` varchar(30) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `resideprovince` varchar(30) NOT NULL,
  `residecity` varchar(30) NOT NULL,
  `residedist` varchar(30) NOT NULL,
  `graduateschool` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `education` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `revenue` varchar(10) NOT NULL,
  `affectivestatus` varchar(30) NOT NULL,
  `lookingfor` varchar(255) NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `msn` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `taobao` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `interest` text NOT NULL,
  `workerid` varchar(64) NOT NULL,
  `is_send_mobile_status` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users_profile
-- ----------------------------

-- ----------------------------
-- Table structure for ims_video_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_video_reply`;
CREATE TABLE `ims_video_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_video_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_voice_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_voice_reply`;
CREATE TABLE `ims_voice_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_voice_reply
-- ----------------------------

-- ----------------------------
-- Table structure for ims_wechat_attachment
-- ----------------------------
DROP TABLE IF EXISTS `ims_wechat_attachment`;
CREATE TABLE `ims_wechat_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `media_id` varchar(255) NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `model` varchar(25) NOT NULL,
  `tag` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `module_upload_dir` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `media_id` (`media_id`),
  KEY `acid` (`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_wechat_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for ims_wechat_news
-- ----------------------------
DROP TABLE IF EXISTS `ims_wechat_news`;
CREATE TABLE `ims_wechat_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned DEFAULT NULL,
  `attach_id` int(10) unsigned NOT NULL,
  `thumb_media_id` varchar(60) NOT NULL,
  `thumb_url` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `digest` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `content_source_url` varchar(200) NOT NULL,
  `show_cover_pic` tinyint(3) unsigned NOT NULL,
  `url` varchar(200) NOT NULL,
  `displayorder` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `attach_id` (`attach_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_wechat_news
-- ----------------------------

-- ----------------------------
-- Table structure for ims_wxapp_general_analysis
-- ----------------------------
DROP TABLE IF EXISTS `ims_wxapp_general_analysis`;
CREATE TABLE `ims_wxapp_general_analysis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `session_cnt` int(10) NOT NULL,
  `visit_pv` int(10) NOT NULL,
  `visit_uv` int(10) NOT NULL,
  `visit_uv_new` int(10) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `stay_time_uv` varchar(10) NOT NULL,
  `stay_time_session` varchar(10) NOT NULL,
  `visit_depth` varchar(10) NOT NULL,
  `ref_date` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `ref_date` (`ref_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_wxapp_general_analysis
-- ----------------------------

-- ----------------------------
-- Table structure for ims_wxapp_versions
-- ----------------------------
DROP TABLE IF EXISTS `ims_wxapp_versions`;
CREATE TABLE `ims_wxapp_versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `version` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `modules` varchar(1000) NOT NULL,
  `design_method` tinyint(1) NOT NULL,
  `template` int(10) NOT NULL,
  `quickmenu` varchar(2500) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version` (`version`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_wxapp_versions
-- ----------------------------

-- ----------------------------
-- Table structure for ims_wxcard_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_wxcard_reply`;
CREATE TABLE `ims_wxcard_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `brand_name` varchar(30) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `success` varchar(255) NOT NULL,
  `error` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_wxcard_reply
-- ----------------------------

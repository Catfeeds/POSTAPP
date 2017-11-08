-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 11 月 08 日 14:55
-- 服务器版本: 5.5.40
-- PHP 版本: 5.4.33

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `we7`
--

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_article`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_article` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_award`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_award` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_cardticket`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_cardticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `ticket` varchar(600) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_carduser`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_carduser` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_extend`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_extend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `btnname` varchar(50) NOT NULL COMMENT '按钮名称',
  `btnurl` varchar(300) NOT NULL COMMENT '连接',
  `jsurl` varchar(300) NOT NULL COMMENT 'js文件',
  `cssurl` varchar(300) NOT NULL COMMENT 'css文件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_fans`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_fans` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_group`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_group` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_lottery`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_lottery` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_lotterygame`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_lotterygame` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_marketing`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_marketing` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_memebercard`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_memebercard` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_print`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_print` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_printer`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_printer` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_qrlogin`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_qrlogin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `sncode` varchar(50) NOT NULL COMMENT 'qrcode',
  `userid` varchar(50) NOT NULL COMMENT '登陆账号',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1487 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_recharge`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_recharge` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_redeemcredit`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_redeemcredit` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9707 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_reply`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `gameid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL COMMENT '回复标题',
  `cover` varchar(250) NOT NULL COMMENT '图文回复图片',
  `description` varchar(250) NOT NULL COMMENT '图文回复描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_reward`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_reward` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_statements`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_statements` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_trade`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_trade` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3394 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_user`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_user` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- 表的结构 `ims_j_money_view`
--

CREATE TABLE IF NOT EXISTS `ims_j_money_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `aid` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL COMMENT '标题',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `prizetype` tinyint(1) NOT NULL DEFAULT '0',
  `favorable` varchar(50) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '生成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

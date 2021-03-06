<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_j_money_award` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_j_money_carduser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '回复标题',
  `sub_title` varchar(50) NOT NULL COMMENT '回复标题',
  `type` varchar(20) NOT NULL COMMENT '回复标题',
  `extra` varchar(50) NOT NULL COMMENT '回复标题',
  `openid` varchar(50) NOT NULL COMMENT '回复标题',
  `userid` int(10) NOT NULL COMMENT '收银员账号',
  `cardid` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(30) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL COMMENT '卡券作用',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属组别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_j_money_extend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `btnname` varchar(50) NOT NULL COMMENT '按钮名称',
  `btnurl` varchar(300) NOT NULL COMMENT '连接',
  `jsurl` varchar(300) NOT NULL COMMENT 'js文件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_j_money_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `companyname` varchar(50) NOT NULL COMMENT '公司名称',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_j_money_marketing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `title` varchar(50) NOT NULL COMMENT '活动标题',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_j_money_print` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `pcate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pagewidth` int(10) NOT NULL DEFAULT '0' COMMENT '标题',
  `pageheight` int(10) NOT NULL DEFAULT '0' COMMENT '标题',
  `content` text COMMENT '打印内容',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_j_money_trade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `userid` int(10) NOT NULL COMMENT '收银员账号',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `paytype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `openid` varchar(50) NOT NULL COMMENT '身份辨识号',
  `is_subscribe` varchar(1) NOT NULL COMMENT '是否关注',
  `trade_type` varchar(16) NOT NULL COMMENT '交易类型',
  `bank_type` varchar(16) NOT NULL COMMENT '付款银行',
  `fee_type` varchar(16) NOT NULL COMMENT '货币类型',
  `total_fee` int(10) NOT NULL COMMENT '总金额',
  `cash_fee_type` varchar(10) NOT NULL COMMENT '货币类型',
  `cash_fee` int(10) NOT NULL COMMENT '实际支付金额',
  `coupon_fee` int(10) NOT NULL COMMENT '代金券或立减优惠金额<=订单总金额，订单总金额-代金券或立减优惠金额=现金支付金额',
  `transaction_id` varchar(64) NOT NULL COMMENT '微信支付订单号',
  `out_trade_no` varchar(64) NOT NULL COMMENT '商户订单号',
  `old_trade_no` varchar(50) NOT NULL COMMENT '商户订单号',
  `attach` varchar(128) NOT NULL COMMENT '商家数据包',
  `time_end` varchar(14) NOT NULL COMMENT '身份辨识号',
  `isconfirm` tinyint(1) NOT NULL DEFAULT '0' COMMENT '二次查询状态',
  `marketing` int(10) NOT NULL DEFAULT '0' COMMENT '营销方案',
  `marketing_log` varchar(200) NOT NULL COMMENT '营销方案内容',
  `log` varchar(200) NOT NULL COMMENT '日志',
  `createtime` int(10) NOT NULL COMMENT '订单时刻',
  `createdate` varchar(20) NOT NULL COMMENT '订单日期',
  `isprint` tinyint(1) NOT NULL DEFAULT '0' COMMENT '打印',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '所属组别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_j_money_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `useracount` varchar(50) NOT NULL COMMENT '登陆账号',
  `pcate` int(10) NOT NULL DEFAULT '0' COMMENT '所属团队',
  `realname` varchar(50) NOT NULL COMMENT '姓名',
  `openid` varchar(50) NOT NULL COMMENT 'openid',
  `mobile` varchar(20) NOT NULL COMMENT '电话',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `login_pc` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'PC端登录',
  `login_m` tinyint(1) NOT NULL DEFAULT '0' COMMENT '手机端登录',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `lasttime` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `weid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'gid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `gid` int(10) unsigned NOT NULL   COMMENT '活动ID';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'level')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `level` varchar(255)    COMMENT '奖品等级';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `thumb` varchar(255)    COMMENT '奖品图片';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'prizetype')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `prizetype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '奖品类型，0实物，1红包，2卡券';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'leavel')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `leavel` int(10) NOT NULL   COMMENT '奖品级别';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'title')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `title` varchar(50) NOT NULL   COMMENT '奖品名称';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'isprize')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `isprize` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'renum')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `renum` int(10) NOT NULL  DEFAULT 0 COMMENT '数量';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'total')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `total` int(10) NOT NULL  DEFAULT 0 COMMENT '数量';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'probalilty')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `probalilty` varchar(5) NOT NULL   COMMENT '概率单位%';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'deg')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `deg` int(5) NOT NULL   COMMENT '角度';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'description')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `description` varchar(100) NOT NULL   COMMENT '描述';");
	}	
}
if(pdo_tableexists('j_money_award')) {
	if(!pdo_fieldexists('j_money_award',  'credit')) {
		pdo_query("ALTER TABLE ".tablename('j_money_award')." ADD `credit` int(11) NOT NULL   COMMENT '奖励积分';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `weid` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'title')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `title` varchar(50) NOT NULL   COMMENT '回复标题';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'sub_title')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `sub_title` varchar(50) NOT NULL   COMMENT '回复标题';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'type')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `type` varchar(20) NOT NULL   COMMENT '回复标题';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'extra')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `extra` varchar(50) NOT NULL   COMMENT '回复标题';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `openid` varchar(50) NOT NULL   COMMENT '回复标题';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'userid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `userid` int(10) NOT NULL   COMMENT '收银员账号';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'cardid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `cardid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'code')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `code` varchar(30) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `createtime` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'description')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `description` varchar(200) NOT NULL   COMMENT '卡券作用';");
	}	
}
if(pdo_tableexists('j_money_carduser')) {
	if(!pdo_fieldexists('j_money_carduser',  'groupid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_carduser')." ADD `groupid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属组别';");
	}	
}
if(pdo_tableexists('j_money_extend')) {
	if(!pdo_fieldexists('j_money_extend',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_extend')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_extend')) {
	if(!pdo_fieldexists('j_money_extend',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_extend')." ADD `weid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_extend')) {
	if(!pdo_fieldexists('j_money_extend',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_extend')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_extend')) {
	if(!pdo_fieldexists('j_money_extend',  'btnname')) {
		pdo_query("ALTER TABLE ".tablename('j_money_extend')." ADD `btnname` varchar(50) NOT NULL   COMMENT '按钮名称';");
	}	
}
if(pdo_tableexists('j_money_extend')) {
	if(!pdo_fieldexists('j_money_extend',  'btnurl')) {
		pdo_query("ALTER TABLE ".tablename('j_money_extend')." ADD `btnurl` varchar(300) NOT NULL   COMMENT '连接';");
	}	
}
if(pdo_tableexists('j_money_extend')) {
	if(!pdo_fieldexists('j_money_extend',  'jsurl')) {
		pdo_query("ALTER TABLE ".tablename('j_money_extend')." ADD `jsurl` varchar(300) NOT NULL   COMMENT 'js文件';");
	}	
}
if(pdo_tableexists('j_money_group')) {
	if(!pdo_fieldexists('j_money_group',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_group')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_group')) {
	if(!pdo_fieldexists('j_money_group',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_group')." ADD `weid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_group')) {
	if(!pdo_fieldexists('j_money_group',  'companyname')) {
		pdo_query("ALTER TABLE ".tablename('j_money_group')." ADD `companyname` varchar(50) NOT NULL   COMMENT '公司名称';");
	}	
}
if(pdo_tableexists('j_money_group')) {
	if(!pdo_fieldexists('j_money_group',  'description')) {
		pdo_query("ALTER TABLE ".tablename('j_money_group')." ADD `description` varchar(100) NOT NULL   COMMENT '描述';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `weid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'gid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `gid` int(10) unsigned NOT NULL   COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'aid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `aid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '奖品ID';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'isprize')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `isprize` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '1为中奖';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'prizetype')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `prizetype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '奖品类型，0实物，1红包，2卡券';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'award')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `award` varchar(100) NOT NULL   COMMENT '奖品名称';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'description')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `description` varchar(200) NOT NULL   COMMENT '中奖信息描述';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `from_user` varchar(50) NOT NULL   COMMENT '用户唯一身份ID';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `realname` varchar(20) NOT NULL   COMMENT '用户名称';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `mobile` varchar(11) NOT NULL   COMMENT '电话号码';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `status` tinyint(1) NOT NULL   COMMENT '0未领奖，1已领奖';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'sncode')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `sncode` varchar(200) NOT NULL   COMMENT '兑奖码，0为兑奖码，1为金额，2卡券ID';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `createtime` int(11) NOT NULL  DEFAULT 0 COMMENT '参与日期';");
	}	
}
if(pdo_tableexists('j_money_lottery')) {
	if(!pdo_fieldexists('j_money_lottery',  'gettime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lottery')." ADD `gettime` int(11) NOT NULL  DEFAULT 0 COMMENT '领奖日期';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `weid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `thumb` varchar(200) NOT NULL   COMMENT '活动图片';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'clientpic')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `clientpic` varchar(200) NOT NULL   COMMENT '活动图片';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'description')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `description` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'title')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `title` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'zppic')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `zppic` varchar(200) NOT NULL   COMMENT '转盘图片';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'pointer')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `pointer` varchar(200) NOT NULL   COMMENT '指针图片';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'rule')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `rule` varchar(2000)    COMMENT '活动描述';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `starttime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `endtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '开启/关闭';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'sharedes')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `sharedes` varchar(50) NOT NULL   COMMENT '关注连接';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'gzurl')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `gzurl` varchar(300) NOT NULL   COMMENT '关注连接';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'thumb_bg')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `thumb_bg` varchar(300) NOT NULL   COMMENT '活动图片';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'thumb_pointer')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `thumb_pointer` varchar(300) NOT NULL   COMMENT '活动图片';");
	}	
}
if(pdo_tableexists('j_money_lotterygame')) {
	if(!pdo_fieldexists('j_money_lotterygame',  'bgcolor')) {
		pdo_query("ALTER TABLE ".tablename('j_money_lotterygame')." ADD `bgcolor` varchar(10) NOT NULL   COMMENT '活动图片';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `weid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'title')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `title` varchar(50) NOT NULL   COMMENT '活动标题';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `starttime` int(10) NOT NULL   COMMENT '开始时间';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'gameid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `gameid` int(10) NOT NULL  DEFAULT 0 COMMENT '大转盘游戏rid';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `endtime` int(10) NOT NULL   COMMENT '结束时间';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'hour')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `hour` varchar(50) NOT NULL   COMMENT '活动时间段';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'num')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `num` int(10) NOT NULL   COMMENT '人数设置';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'isint')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `isint` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'favorabletype')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `favorabletype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '优惠类别';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'condition_fee')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `condition_fee` int(10) NOT NULL  DEFAULT 0 COMMENT '满多少元';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'favorable')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `favorable` varchar(100) NOT NULL   COMMENT '优惠';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'gid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `gid` int(10) NOT NULL   COMMENT '游戏id';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'isallnum')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `isallnum` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '人数设置为每天，还是总人数';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'condition')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `condition` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '条件';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'condition_member')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `condition_member` varchar(100) NOT NULL   COMMENT '优惠';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'condition_attendtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `condition_attendtime` int(10) NOT NULL  DEFAULT 0 COMMENT '关注天数';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `displayorder` int(10) NOT NULL  DEFAULT 0 COMMENT '优先级';");
	}	
}
if(pdo_tableexists('j_money_marketing')) {
	if(!pdo_fieldexists('j_money_marketing',  'description')) {
		pdo_query("ALTER TABLE ".tablename('j_money_marketing')." ADD `description` varchar(100) NOT NULL   COMMENT '描述';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `weid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'pcate')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `pcate` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '类型';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'title')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `title` varchar(50) NOT NULL   COMMENT '标题';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'pagewidth')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `pagewidth` int(10) NOT NULL  DEFAULT 0 COMMENT '标题';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'pageheight')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `pageheight` int(10) NOT NULL  DEFAULT 0 COMMENT '标题';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'content')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `content` text    COMMENT '打印内容';");
	}	
}
if(pdo_tableexists('j_money_print')) {
	if(!pdo_fieldexists('j_money_print',  'isdefault')) {
		pdo_query("ALTER TABLE ".tablename('j_money_print')." ADD `isdefault` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '默认模板';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `weid` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `rid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'gameid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `gameid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'title')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `title` varchar(200) NOT NULL   COMMENT '回复标题';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'cover')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `cover` varchar(250) NOT NULL   COMMENT '图文回复图片';");
	}	
}
if(pdo_tableexists('j_money_reply')) {
	if(!pdo_fieldexists('j_money_reply',  'description')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reply')." ADD `description` varchar(250) NOT NULL   COMMENT '图文回复描述';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `weid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'completed')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `completed` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'out_trade_no')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `out_trade_no` varchar(32) NOT NULL   COMMENT '商户订单号';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `openid` varchar(50) NOT NULL   COMMENT '身份辨识号';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'marketid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `marketid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'condition')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `condition` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '条件';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'favorabletype')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `favorabletype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '优惠类别';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'favorable')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `favorable` varchar(100) NOT NULL   COMMENT '优惠';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'reward')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `reward` varchar(50) NOT NULL  DEFAULT 0 COMMENT '获得优惠';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `createtime` int(10) NOT NULL  DEFAULT 0 COMMENT '订单时刻';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `endtime` int(10) NOT NULL  DEFAULT 0 COMMENT '订单时刻';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'gettype')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `gettype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '获取方式';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'log')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `log` varchar(200) NOT NULL   COMMENT '日志';");
	}	
}
if(pdo_tableexists('j_money_reward')) {
	if(!pdo_fieldexists('j_money_reward',  'marketing_log')) {
		pdo_query("ALTER TABLE ".tablename('j_money_reward')." ADD `marketing_log` varchar(200) NOT NULL   COMMENT '营销方案内容';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `weid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'userid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `userid` int(10) NOT NULL   COMMENT '收银员账号';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'paytype')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `paytype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `openid` varchar(50) NOT NULL   COMMENT '身份辨识号';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'is_subscribe')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `is_subscribe` varchar(1) NOT NULL   COMMENT '是否关注';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'trade_type')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `trade_type` varchar(16) NOT NULL   COMMENT '交易类型';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'bank_type')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `bank_type` varchar(16) NOT NULL   COMMENT '付款银行';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'fee_type')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `fee_type` varchar(16) NOT NULL   COMMENT '货币类型';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'total_fee')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `total_fee` int(10) NOT NULL   COMMENT '总金额';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'cash_fee_type')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `cash_fee_type` varchar(10) NOT NULL   COMMENT '货币类型';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'cash_fee')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `cash_fee` int(10) NOT NULL   COMMENT '实际支付金额';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'coupon_fee')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `coupon_fee` int(10) NOT NULL   COMMENT '代金券或立减优惠金额<=订单总金额，订单总金额-代金券或立减优惠金额=现金支付金额';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'transaction_id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `transaction_id` varchar(64) NOT NULL   COMMENT '微信支付订单号';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'out_trade_no')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `out_trade_no` varchar(64) NOT NULL   COMMENT '商户订单号';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'old_trade_no')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `old_trade_no` varchar(50) NOT NULL   COMMENT '商户订单号';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'attach')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `attach` varchar(128) NOT NULL   COMMENT '商家数据包';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'time_end')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `time_end` varchar(14) NOT NULL   COMMENT '身份辨识号';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'isconfirm')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `isconfirm` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '二次查询状态';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'marketing')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `marketing` int(10) NOT NULL  DEFAULT 0 COMMENT '营销方案';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'marketing_log')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `marketing_log` varchar(200) NOT NULL   COMMENT '营销方案内容';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'log')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `log` varchar(200) NOT NULL   COMMENT '日志';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `createtime` int(10) NOT NULL   COMMENT '订单时刻';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'createdate')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `createdate` varchar(20) NOT NULL   COMMENT '订单日期';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'isprint')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `isprint` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '打印';");
	}	
}
if(pdo_tableexists('j_money_trade')) {
	if(!pdo_fieldexists('j_money_trade',  'groupid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_trade')." ADD `groupid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属组别';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'id')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `weid` int(10) NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'useracount')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `useracount` varchar(50) NOT NULL   COMMENT '登陆账号';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'pcate')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `pcate` int(10) NOT NULL  DEFAULT 0 COMMENT '所属团队';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `realname` varchar(50) NOT NULL   COMMENT '姓名';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `openid` varchar(50) NOT NULL   COMMENT 'openid';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `mobile` varchar(20) NOT NULL   COMMENT '电话';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'password')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `password` varchar(50) NOT NULL   COMMENT '密码';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'login_pc')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `login_pc` tinyint(1) NOT NULL  DEFAULT 0 COMMENT 'PC端登录';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'login_m')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `login_m` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '手机端登录';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `createtime` int(10) NOT NULL  DEFAULT 0 COMMENT '添加时间';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'lasttime')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `lasttime` int(10) NOT NULL  DEFAULT 0 COMMENT '最后登录时间';");
	}	
}
if(pdo_tableexists('j_money_user')) {
	if(!pdo_fieldexists('j_money_user',  'status')) {
		pdo_query("ALTER TABLE ".tablename('j_money_user')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}

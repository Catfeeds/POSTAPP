<?php

global  $_W,$_GPC;

//echo "33321";
//die();

$kwd = trim($_GPC['keyword']);
$params = array();
$params[':uniacid'] = $_W['uniacid'];
$condition = " and f.uniacid=:uniacid";
if (!empty($kwd)) {
	$condition .= " AND ( m.nickname LIKE :keyword or m.realname LIKE :keyword or m.mobile LIKE :keyword )";
	$params[':keyword'] = "%{$kwd}%";
}
$ds = pdo_fetchall('SELECT m.uid,m.avatar,m.nickname,f.openid,m.realname,m.mobile FROM ' . tablename('mc_mapping_fans') . ' f left join  ' . tablename('mc_members') . " m on f.uid=m.uid WHERE 1 {$condition} order by f.uid desc", $params);

foreach($ds as &$item){
	if(substr($item["avatar"],0,7)!="http://"){
	   $item["avatar"]=$_W["attachurl"].$item["avatar"];
	}
}
include $this->template('web/memberquery');
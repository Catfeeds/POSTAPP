<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;

mload()->classs('eleme');

$app = new Eleme();
$url = imurl('wmall/channel/ele', array(), true);
$url = $app->getOauthCodeUrl($url);
if(empty($_GPC['code'])) {
	header('Location: ' . $url);
}
else {
	echo $_GPC['code'];die;
}
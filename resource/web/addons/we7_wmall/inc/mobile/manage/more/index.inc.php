<?php
//dezend by http://www.yunlu99.com/ QQ:270656184
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
$ta = (trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index');

if ($ta == 'index') {
	$_W['page']['title'] = '商户中心';
	$sid = intval($_GPC['__mg_sid']);
	$store = pdo_get('tiny_wmall_store', array('uniacid' => $_W['uniacid'], 'id' => $sid), array('title'));
}

include itemplate('more/index');

?>

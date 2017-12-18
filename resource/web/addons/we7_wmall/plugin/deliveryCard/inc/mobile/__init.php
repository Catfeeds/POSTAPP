<?php
//dezend by http://www.yunlu99.com/ QQ:270656184
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;

if ($_config_plugin['card_apply_status'] != 1) {
	imessage('平台未开启配送会员卡功能', referer(), 'error');
}

?>

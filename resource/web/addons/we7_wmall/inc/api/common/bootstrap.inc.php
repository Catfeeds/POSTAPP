<?php
//dezend by http://www.yunlu99.com/ QQ:270656184
defined('IN_IA') || exit('Access Denied');
global $_W;
global $_GPC;
global $_POST;
mload()->model('store');
mload()->model('order');
load()->func('logging');
$_W['we7_wmall']['config'] = sys_config();

?>

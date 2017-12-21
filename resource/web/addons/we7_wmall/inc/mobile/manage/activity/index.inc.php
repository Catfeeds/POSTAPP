<?php
/**
 * 外送系统
 * @author 灯火阑珊
 * @QQ 2471240272
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
mload()->model('activity');
global $_W, $_GPC;
$_W['page']['title'] = '新建活动';
$sid = intval($_GPC['__mg_sid']);

$activity = activity_getall($sid, -1);

include itemplate('activity/index');


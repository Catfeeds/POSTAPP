<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

if ($action != 'display') {
	checkwxapp();
}

if (($action == 'version' && ($do == 'home' || $do == 'module_link_uniacid')) || ($action == 'payment')) {
	define('FRAME', 'wxapp');
}

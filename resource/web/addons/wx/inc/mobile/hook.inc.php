<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doMobileHook extends Superman
{
	public function __construct()
	{
		parent::__construct(true);
	}

	public function exec()
	{
		global $_W;
	}
}

$obj = new Superman_creditmall_doMobileHook;
$obj->exec();
<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doWebCreditmanage extends Superman_creditmallModuleSite
{
	public function __construct()
	{
		parent::__construct(true);
	}

	public function exec()
	{
		@header('Location: ' . url('mc/creditmanage'));
		exit;
	}
}

$obj = new Superman_creditmall_doWebCreditmanage;
$obj->exec();
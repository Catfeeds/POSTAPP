<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doMobileHelp extends Superman_creditmallModuleSite
{
	public function __construct()
	{
		parent::__construct(true);
	}

	public function exec()
	{
		global $_W, $_GPC, $do;
		$_share = $this->_share;
		$title = '积分商城';
		$act = in_array($_GPC['act'], array('display')) ? $_GPC['act'] : 'display';
		if ($act == 'display') {
			$header_title = '使用帮助';
		}
		include $this->template('help');
	}
}

$obj = new Superman_creditmall_doMobileHelp;
$obj->exec();
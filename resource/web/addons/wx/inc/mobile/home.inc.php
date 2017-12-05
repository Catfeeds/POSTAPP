<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doMobileHome extends Superman_creditmallModuleSite
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
		$do = $do ? $do : 'home';
		$act = in_array($_GPC['act'], array('display')) ? $_GPC['act'] : 'display';
		if ($act == 'display') {
			$header_title = '首页';
			$filter = array('uniacid' => $_W['uniacid'], 'isshow' => 1, 'ishome' => 1,);
			$product_types = superman_product_type(0, true);
			$list = array();
			foreach ($product_types as $type) {
				$filter['type'] = $type['id'];
				$result = superman_product_fetchall($filter, 'order by sales desc', 0,6);
				if ($result) {
					foreach ($result as &$item) {
						superman_product_set($item);
					}
					unset($item);
					$list[$type['id']] = $result;
				}
			}
			$filter = array('uniacid' => $_W['uniacid'], 'isshow' => 1, 'time' => TIMESTAMP, 'position_id' => 1,);
			$adlist = superman_ad_fetchall_posid($filter);
			if (isset($list[5])) {
				$subscribe = $this->init_subscribe_variable();
			}
		}
		include $this->template('home');
	}
}

$obj = new Superman_creditmall_doMobileHome;
$obj->exec();
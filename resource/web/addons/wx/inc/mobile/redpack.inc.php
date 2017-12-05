<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doMobileRedpack extends Superman_creditmallModuleSite
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
		$act = in_array($_GPC['act'], array('confirm', 'display')) ? $_GPC['act'] : 'display';
		if ($act == 'display') {
			$this->checkauth();
			$header_title = '微信红包';
			$order_id = intval($_GPC['orderid']);
			$order = superman_order_fetch($order_id);
			if (!$order) {
				message('订单不存在或已删除', '', 'warning');
			}
			if ($order['uid'] != $_W['member']['uid']) {
				message('非法请求', '', 'warning');
			}
			superman_order_set($order);
			$back_url = $this->createMobileUrl('list', array('type' => 5));
			$_share['link'] = $_W['siteroot'] . 'app/' . $back_url;
			include $this->template('detail-redpack');
		} else if ($act == 'confirm') {
			$total = 1;
			if (!defined('LOCAL_DEVELOPMENT')) {
				if ($_W['container'] != 'wechat' || !IN_MOBILE) {
					$this->json_output(ERRNO::NOT_IN_WECHAT);
				}
			}
			if (!$_W['member']['uid']) {
				$this->json_output(ERRNO::NOT_LOGIN);
			}
			if (!checksubmit('token')) {
				$this->json_output(ERRNO::INVALID_REQUEST);
			}
			if ($this->module['config']['subscribe']['check'] && (!isset($_W['fans']['follow']) || !$_W['fans']['follow'])) {
				$this->json_output(ERRNO::UNSUBSCRIBE_NOT_EXCHANGE);
			}
			$id = intval($_GPC['id']);
			$product = superman_product_fetch($id);
			if (!$product) {
				$this->json_output(ERRNO::PRODUCT_NOT_FOUND);
			}
			if ($product['start_time'] > 0 && $product['start_time'] > TIMESTAMP) {
				$this->json_output(ERRNO::PRODUCT_EXCHANGE_NOT_BEGIN, '兑换未开始(' . date('Y-m-d H:i:s', $product['start_time']) . ')');
			}
			if ($product['end_time'] > 0 && $product['end_time'] < TIMESTAMP) {
				$this->json_output(ERRNO::PRODUCT_EXCHANGE_END, '兑换已结束(' . date('Y-m-d H:i:s', $product['end_time']) . ')');
			}
			if ($product['total'] <= 0) {
				$this->json_output(ERRNO::PRODUCT_NOT_TOTAL, '已被抢光，下次早点来哦~');
			}
			if ($product['groupid'] && $product['groupid'] != $_W['member']['groupid']) {
				$this->json_output(ERRNO::PRODUCT_GROUP_LIMIT);
			}
			superman_product_set($product);
			if (!superman_is_redpack($product['type'])) {
				$this->json_output(ERRNO::PARAM_ERROR);
			}
			$order_count = superman_order_count_status($_W['member']['uid'], $id, 0);
			if ($order_count > 0) {
				unset($ret);
				$ret = array('url' => $this->createMobileUrl('order', array('status' => 'no_pay')),);
				$this->json_output(ERRNO::ORDER_EXIST_NOT_PAY, '有未支付订单，跳转中...', $ret);
			}
			if ($product['today_limit'] > 0) {
				$filter = array('uid' => $_W['member']['uid'], 'more_status' => 0, 'product_id' => $product['id'], 'start_time' => strtotime(date('0:0:0')));
				$today_total = superman_order_sum('total', $filter);
				if ($today_total >= $product['today_limit']) {
					$this->json_output(ERRNO::PRODUCT_EXCHANGE_LIMIT);
				}
			}
			if ($product['max_buy_num'] > 0) {
				$filter = array('uid' => $_W['member']['uid'], 'more_status' => 0, 'product_id' => $product['id'],);
				$buy_total = superman_order_count($filter);
				if ($buy_total >= $product['max_buy_num']) {
					$this->json_output(ERRNO::PRODUCT_EXCHANGE_LIMIT);
				}
			}
			$mycredit = superman_mycredit($_W['member']['uid'], $product['credit_type'], true);
			if (!$mycredit) {
				$this->json_output(ERRNO::SYSTEM_ERROR);
			}
			if ($mycredit['value'] < $product['credit']) {
				$this->json_output(ERRNO::CREDIT_NOT_ENOUGH, $product['credit_title'] . '不足');
			}
			$setting = uni_setting($_W['uniacid'], array('payment', 'creditbehaviors'));
			$payment = array();
			if ($setting && isset($setting['payment']) && is_array($setting['payment'])) {
				$payment = $setting['payment'];
			}
			$data = array('uniacid' => $_W['uniacid'], 'ordersn' => date('ymd') . random(6, 1), 'uid' => $_W['member']['uid'], 'product_id' => $id, 'total' => $total, 'price' => $product['price'], 'credit_type' => $product['credit_type'], 'credit' => $product['credit'], 'status' => 0, 'extend' => iserializer(array('redpack_amount' => $product['extend']['redpack_amount'])), 'dateline' => TIMESTAMP,);
			pdo_insert('superman_creditmall_order', $data);
			$order_id = pdo_insertid();
			if (!$order_id) {
				$this->json_output(ERRNO::SYSTEM_ERROR);
			}
			if ($product['minus_total'] == 2) {
				$new_total = $product['total'] - $total;
				pdo_update('superman_creditmall_product', array('total' => $new_total >= 0 ? $new_total : 0,), array('id' => $product['id'],));
			}
			$url = $this->createMobileUrl('pay', array('orderid' => $order_id));
			$this->json_output(ERRNO::OK, '', array('url' => $url));
		}
	}
}

$obj = new Superman_creditmall_doMobileRedpack;
$obj->exec();
<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doMobileAuction extends Superman_creditmallModuleSite
{
	public function __construct()
	{
		parent::__construct(true);
	}

	public function exec()
	{
		global $_W, $_GPC, $do;
		$_share = array();
		$title = '积分商城';
		$act = in_array($_GPC['act'], array('display', 'bid')) ? $_GPC['act'] : 'display';
		$uid = $_W['member']['uid'];
		if ($act == 'display') {
			$header_title = '竞拍出价';
			$id = intval($_GPC['id']);
			if (empty($id)) {
				$this->json_output(ERRNO::INVALID_REQUEST);
			}
			$back_url = $this->createMobileUrl('detail', array('id' => $id));
			$product = superman_product_fetch($id);
			if (!$product) {
				$this->json_output(ERRNO::PRODUCT_NOT_FOUND);
			}
			superman_product_set($product);
			$finished = false;
			if ($product['end_time'] > 0 && $product['end_time'] < TIMESTAMP) {
				$finished = true;
			}
			$this->check_auction($product);
			$bid_url = $this->createMobileUrl('auction', array('act' => 'bid', 'id' => $id,));
			$pindex = max(1, intval($_GPC['page']));
			$pagesize = 20;
			$start = ($pindex - 1) * $pagesize;
			$filter = array('product_id' => $id,);
			if (isset($_GPC['last_id'])) {
				$filter['last_id'] = intval($_GPC['last_id']);
			}
			$list = superman_product_log_fetchall($filter, 'ORDER BY credit DESC, dateline DESC, millisecond DESC', $start, $pagesize);
			if ($list) {
				$members = array();
				foreach ($list as $k => &$item) {
					$item['first'] = false;
					if ($start == 0 && $k == 0) {
						$item['first'] = true;
						if ($item['status'] == 1) {
							$finished = true;
						}
					}
					if (!isset($members[$item['uid']])) {
						$members[$item['uid']] = mc_fetch($item['uid'], array('avatar', 'nickname'));
					}
					$item['member'] = $members[$item['uid']];
					superman_product_log_set($item);
				}
				unset($item);
			}
			if ($_W['isajax'] && $_GPC['load'] == 'infinite') {
				if ($finished) {
					$this->json_output(ERRNO::AUCTION_HAS_ENDED, '', $list);
				} else {
					$this->json_output(ERRNO::OK, '', $list);
				}
			}
			$subscribe = $this->init_subscribe_variable();
			include $this->template('auction');
		} else if ($act == 'bid') {
			if (!$_W['member']['uid']) {
				$this->json_output(ERRNO::NOT_LOGIN);
			}
			if ($this->module['config']['subscribe']['check'] && (!isset($_W['fans']['follow']) || !$_W['fans']['follow'])) {
				$this->json_output(ERRNO::UNSUBSCRIBE_NOT_EXCHANGE);
			}
			$id = intval($_GPC['id']);
			if (empty($id)) {
				$this->json_output(ERRNO::INVALID_REQUEST);
			}
			$credit = floatval($_GPC['credit']);
			if ($credit <= 0) {
				$this->json_output(ERRNO::PARAM_ERROR);
			}
			$product = superman_product_fetch($id);
			if (!$product) {
				$this->json_output(ERRNO::PRODUCT_NOT_FOUND);
			}
			superman_product_set($product);
			if ($product['start_time'] > 0 && $product['start_time'] > TIMESTAMP) {
				$this->json_output(ERRNO::AUCTION_NOT_START);
			}
			$this->check_auction($product);
			if ($product['end_time'] > 0 && $product['end_time'] < TIMESTAMP) {
				$this->json_output(ERRNO::AUCTION_HAS_ENDED);
			}
			if ($product['total'] == 0) {
				$this->json_output(ERRNO::PRODUCT_NOT_TOTAL);
			}
			if ($product['groupid'] && $product['groupid'] != $_W['member']['groupid']) {
				$this->json_output(ERRNO::PRODUCT_GROUP_LIMIT);
			}
			superman_product_set($product);
			$mycredit = superman_mycredit($_W['member']['uid'], $product['credit_type'], true);
			if (!$mycredit) {
				$this->json_output(ERRNO::SYSTEM_ERROR);
			}
			if ($mycredit['value'] < $credit) {
				$this->json_output(ERRNO::CREDIT_NOT_ENOUGH, $product['credit_title'] . '不足');
			}
			$sql = "SELECT * FROM " . tablename('superman_creditmall_product_log') . " WHERE product_id=:product_id ORDER BY id DESC";
			$params = array(':product_id' => $id,);
			$log = pdo_fetch($sql, $params);
			if ($log) {
				if ($credit <= $log['credit']) {
					$this->json_output(ERRNO::AUCTION_CREDIT_INVALID, '出价不合法，未大于最高出价');
				}
				if (isset($product['extend']['auction_credit']) && $product['extend']['auction_credit'] > 0) {
					if ($credit - $log['credit'] < $product['extend']['auction_credit']) {
						$min = $product['extend']['auction_credit'] + $log['credit'];
						$this->json_output(ERRNO::AUCTION_CREDIT_INVALID, '出价不合法，最少出价' . $min . $product['credit_title']);
					}
				}
				if ($_W['member']['uid'] == $log['uid'] && TIMESTAMP - $log['dateline'] <= 2) {
					$this->json_output(ERRNO::INVALID_REQUEST, '非法出价');
				}
			} else {
				if ($product['credit'] > 0 && $credit < $product['credit']) {
					$this->json_output(ERRNO::AUCTION_CREDIT_INVALID, '出价不合法，起拍价为' . $product['credit'] . $product['credit_title']);
				}
			}
			if ($product['today_limit'] > 0) {
				$filter = array('uid' => $_W['member']['uid'], 'product_id' => $product['id'], 'status' => 1, 'start_time' => strtotime(date('0:0:0')));
				$today_total = superman_product_log_count($filter);
				if ($today_total >= $product['today_limit']) {
					$this->json_output(ERRNO::PRODUCT_EXCHANGE_LIMIT);
				}
			}
			if ($product['max_buy_num'] > 0) {
				$filter = array('uid' => $_W['member']['uid'], 'product_id' => $product['id'], 'status' => 1,);
				$buy_total = superman_product_log_count($filter);
				if ($buy_total >= $product['max_buy_num']) {
					$this->json_output(ERRNO::PRODUCT_EXCHANGE_LIMIT);
				}
			}
			$t = microtime(true);
			$millisecond = sprintf("%06d", ($t - floor($t)) * 1000000);
			$data = array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid'], 'product_id' => $id, 'credit_type' => $product['credit_type'], 'credit' => $credit, 'status' => 0, 'dateline' => TIMESTAMP, 'millisecond' => $millisecond,);
			pdo_insert('superman_creditmall_product_log', $data);
			$new_id = pdo_insertid();
			if (!$new_id) {
				WeUtility::logging('fatal', 'insert `superman_creditmall_product_log` failed, data=' . var_export($data, true));
				$this->json_output(ERRNO::SYSTEM_ERROR);
			}
			superman_product_update_count($product['id'], 'joined_total');
			$this->json_output(ERRNO::OK, '出价成功');
		}
	}

	private function check_auction($product)
	{
		global $_W;
		if ($product['end_time'] > 0 && $product['end_time'] > TIMESTAMP) {
			return;
		}
		$filter = array('product_id' => $product['id'], 'status' => 1,);
		$log = M::t('superman_creditmall_product_log')->fetch($filter);
		if ($log) {
			return;
		}
		$over = true;
		$start = 0;
		$params = array(':product_id' => $product['id'],);
		do {
			$sql = "SELECT * FROM " . tablename('superman_creditmall_product_log');
			$sql .= " WHERE product_id=:product_id ORDER BY credit DESC, dateline DESC, millisecond DESC LIMIT {$start}, 1";
			$log = pdo_fetch($sql, $params);
			if (!$log) {
				break;
			}
			superman_product_log_set($log);
			if ($log['status'] == 1) {
				break;
			}
			$mycredit = superman_mycredit($log['uid'], $log['credit_type'], true);
			if (!$mycredit) {
				break;
			}
			if ($mycredit['value'] < $log['credit']) {
				WeUtility::logging('trace', '会员积分不足查找下一个出价人,mycredit=' . var_export($mycredit, true) . ', log=' . var_export($log, true));
				$start += 1;
				$over = false;
				continue;
			}
			$credit_log = array($_W['member']['uid'], '竞拍' . $product['title'], 'superman_creditmall',);
			$result = mc_credit_update($_W['member']['uid'], $product['credit_type'], -$log['credit'], $credit_log);
			if (is_error($result)) {
				WeUtility::logging('fatal', 'mc_credit_update failed, message=' . var_export($result, true) . ', log=' . var_export($log, true));
				break;
			}
			$ret = pdo_update('superman_creditmall_product_log', array('status' => 1,), array('id' => $log['id'],));
			if ($ret !== false) {
				$pickup_info = '';
				$dispatch = superman_dispatch_fetch($product['dispatch_id']);
				if ($dispatch) {
					if (!$dispatch['need_address']) {
						$pickup_info = isset($dispatch['extend']['pickup_info']) ? $dispatch['extend']['pickup_info'] : '';
					}
				}
				$order_data = array('uniacid' => $_W['uniacid'], 'ordersn' => date('ymd') . random(6, 1), 'uid' => $log['uid'], 'product_id' => $product['id'], 'total' => 1, 'price' => 0, 'credit_type' => $product['credit_type'], 'credit' => $log['credit'], 'remark' => '', 'username' => '', 'mobile' => '', 'zipcode' => '', 'address' => '', 'express_title' => '', 'express_fee' => '', 'pickup_info' => $pickup_info, 'status' => 1, 'pay_type' => 1, 'pay_credit' => 1, 'dateline' => TIMESTAMP,);
				pdo_insert('superman_creditmall_order', $order_data);
				$order_id = pdo_insertid();
				if (!$order_id) {
					WeUtility::logging('fatal', 'insert superman_creditmall_order failed, data=' . var_export($order_data, true));
				}
				superman_product_update_sales($product['id'], 1);
				$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('order', array('act' => 'detail', 'orderid' => $order_id,));
				$vars = array('{商品标题}' => $product['title'], '{商品价格}' => $log['credit'] . $log['credit_title'],);
				if ($_W['account']['level'] == 4 && $this->module['config']['template_message']['auction_success_id'] && $this->module['config']['template_message']['auction_success_content']) {
					$message = array('uniacid' => $_W['uniacid'], 'template_id' => $this->module['config']['template_message']['auction_success_id'], 'template_variable' => $this->module['config']['template_message']['auction_success_content'], 'vars' => $vars, 'receiver_uid' => $log['uid'], 'url' => $url,);
					$this->sendTemplateMessage($message);
				} elseif ($_W['account']['level'] == 3 || $_W['account']['level'] == 4) {
					$vars['{title}'] = '竞拍成功通知';
					$this->send_auction_svcmsg($vars, superman_uid2openid($log['uid']), $url);
				}
			} else {
				WeUtility::logging('fatal', 'update superman_creditmall_product_log failed, log=' . var_export($log, true));
			}
			$over = true;
		} while (!$over);
	}
}

$obj = new Superman_creditmall_doMobileAuction;
$obj->exec();
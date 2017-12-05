<?php

defined("IN_IA") or die("Access Denied");
require IA_ROOT . "/addons/superman_creditmall/common.func.php";
require IA_ROOT . "/addons/superman_creditmall/model.func.php";
require IA_ROOT . "/addons/superman_creditmall/errno.class.php";
require IA_ROOT . "/addons/superman_creditmall/WxpayAPI.class.php";
require IA_ROOT . "/addons/superman_creditmall/task.class.php";
require IA_ROOT . "/addons/superman_creditmall/table.class.php";
require IA_ROOT . "/addons/superman_creditmall/apiofmember.class.php";
class Superman_creditmallModuleSite extends WeModuleSite
{
	protected $member = array();
	public function __construct($allowInit = false)
	{
		if (!$allowInit) {
			return;
		}
		global $_W, $_GPC, $do;
		load()->func("tpl");
		load()->func("file");
		load()->model("mc");
		load()->model("module");
		$this->modulename = 'superman_creditmall';
		$this->__define = MODULE_ROOT . '/module.php';
		$this->module = module_fetch($this->modulename);
		$this->inMobile = defined('IN_MOBILE');
		if ($this->inMobile) {
			if ($this->module['config']['base']['wechat'] && $_W['container'] != 'wechat' && !$_W['uid']) {
				message('请在微信中打开！', '', 'warning');
			}
			$_version = str_replace('.', '', $this->module['version']);
			if (defined("LOCAL_DEVELOPMENT") && !strexists(file_get_contents($this->__define), '/* PHP Encode by  http://www.we7.cc */')) {
				$this->superman_css = '<link rel="stylesheet" href="' . MODULE_URL . '/min/index.php?g=css&debug=1&' . $_version . '">';
				$this->superman_global_js = '<script src="' . MODULE_URL . '/min/index.php?g=global-js&debug=1&' . $_version . '"></script>';
				$this->superman_main_js = '<script src="' . MODULE_URL . '/min/index.php?g=main-js&debug=1&' . $_version . '"></script>';
			} else {
				if (file_exists(MODULE_ROOT . "/template/mobile/cache/css.css") && !file_exists(IA_ROOT . "/online-dev.lock")) {
					$this->superman_css = '<link rel="stylesheet" href="' . MODULE_URL . '/template/mobile/cache/css.css?' . $_version . '">';
					$this->superman_global_js = '<script src="' . MODULE_URL . '/template/mobile/cache/global.js?' . $_version . '"></script>';
					$this->superman_main_js = '<script src="' . MODULE_URL . '/template/mobile/cache/main.js?' . $_version . '"></script>';
				} else {
					$this->superman_css = '<link rel="stylesheet" href="' . MODULE_URL . '/min/index.php?g=css&' . $_version . '">';
					$this->superman_global_js = '<script src="' . MODULE_URL . '/min/index.php?g=global-js&' . $_version . '"></script>';
					$this->superman_main_js = '<script src="' . MODULE_URL . '/min/index.php?g=main-js&' . $_version . '"></script>';
				}
			}
			if ($_W['member']['uid']) {
				$this->member = mc_fetch($_W['member']['uid']);
				if ($this->member) {
					$this->member['avatar'] = tomedia($this->member['avatar']);
					$this->member['big_avatar'] = rtrim($this->member['avatar'], '132');
				}
				$this->member['group'] = superman_mc_groups_fetch($this->member['groupid']);
			} else {
				$this->member = array('uid' => '0', 'avatar' => '', 'nickname' => '您的昵称', 'group' => array('title' => ''));
			}
			$this->check_debug();
			if (!isset($_GPC['do']) && isset($_GPC['eid']) && $_GPC['eid']) {
				$eid = intval($_GPC['eid']);
				$sql = "SELECT `do` FROM " . tablename('modules_bindings') . " WHERE eid=:eid";
				$params = array(':eid' => $eid);
				$do = pdo_fetchcolumn($sql, $params);
			}
			$this->_share = array();
			$share_params = $this->module['config']['share'];
			if (!empty($share_params)) {
				$this->_share = array('title' => $share_params['title'], 'link' => $_W['siteurl'], 'imgUrl' => tomedia($share_params['imgurl']), 'content' => $share_params['desc']);
			}
			unset($share_params);
		} else {
			if ($_W['isfounder'] && !$this->module['config']['_init']) {
				$this->module['config'] = superman_setting_data();
				superman_setting_init($_W['uniacid'], $this->module['config']);
			}
		}
	}
	public function json_output($errno, $errmsg = '', $data = array(), $redirect = false)
	{
		global $_W;
		ob_clean();
		if ($errmsg == '') {
			$errmsg = ERRNO::$ERRMSG[$errno];
		}
		$result = array('errno' => $errno, 'errmsg' => $errmsg, 'data' => $data);
		if ($redirect && $result['data']['url']) {
			@header("Location: {$result['data']['url']}#wechat_redirect");
			die;
		}
		if ($_W['isajax']) {
			@header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			$msg = "{$errmsg}({$errno})";
			message($msg, $this->createMobileUrl('home'), 'info');
		}
		die;
	}
	public function checkauth()
	{
		global $_W;
		
		$subscribe = $this->init_subscribe_variable();
		if ($subscribe['exchange'] == 0 && $_W['container'] == 'wechat') {
			$this->message($subscribe['tips'], $subscribe['url'], 'info');
		} else {
			checkauth();
		}
	}
	public function message($msg, $redirect = '', $type = '')
	{
		global $_W, $_GPC;
		if ($redirect == 'refresh') {
			$redirect = $_W['script_name'] . '?' . $_SERVER['QUERY_STRING'];
		}
		if ($redirect == 'referer') {
			$redirect = referer();
		}
		$type = in_array($type, array('success', 'warn', 'info', 'waiting', 'safe_success', 'safe_warn')) ? $type : 'info';
		if (empty($msg) && !empty($redirect) && $redirect != 'close') {
			@header('Location: ' . $redirect);
		}
		include $this->template('message', TEMPLATE_INCLUDEPATH);
		die;
	}
	
	public function doMobileTest()
	{
		global $_W;
		
		$product=array(
			"couponid"=>"1|66|12",
				
		);
		$order=array(
			"cardid"=>"23720",
			"total"=>1,	
		);
		$coupon_arr=explode("|",$product["couponid"]);
		$expiredDate=empty($coupon_arr[2])?-1:intval($coupon_arr[2]);
		if($expiredDate!=-1)
		{
			$expiredDate=date("Y-m-d",strtotime('+'.$expiredDate.' month'));
		}
		echo $expiredDate;die();
		$updata["itemIds"]=$coupon_arr[1];
		$memberApi=$this->initApi();
		$updata=array(
				"appid"=>$_W['account']['key'],
				"cardId"=>$order["cardid"],
				"itemIds"=>$coupon_arr[1],
				"itemTimes"=>$order["total"],
				"payAmount"=>0,
				"billed"=>'false',
				"expiredDate"=>$expiredDate,
				"comments"=>"测试购买"
		);
		
		if($coupon_arr[0]==1) /*填写格式 ：类型+id用“|”分割， 卡券为2项目为1。例如 2|25 */
		{
			$questResturn=$memberApi->saveService($updata);
		}else{
			$questResturn=$memberApi->saveVoucher($updata);
		}
		
		
	}
	public function payResult($params)
	{
		global $_W, $_GPC;
		$order_id = $params['tid'];
		$order = superman_order_fetch($order_id);
		if (!$order) {
			$this->json_output(ERRNO::ORDER_NOT_EXIST);
		}
		superman_order_set($order);
		$product = superman_product_fetch($order['product_id'], array('type', 'isvirtual', 'title','remote_id','couponid','credit'));
		if (!$product) {
			$this->json_output(ERRNO::PRODUCT_NOT_FOUND);
		}
		$order_data = array('status' => $params['result'] == 'success' ? 1 : 0);
		if (superman_is_redpack($product['type'])) {
			$order_data['status'] = 2;
		}
		if (superman_is_virtual($product)) {
			$order_data['status'] = 2;
		}
		if ($params['result'] == 'success' && ($params['from'] == 'notify' || $params['from'] == 'return' && $params['type'] == 'credit' || $params['from'] == 'return' && $params['type'] == 'wechat') && $order['status'] == 0) {
			$paytype = array('credit' => '1', 'wechat' => '2');
			$order['pay_type'] = $order_data['pay_type'] = $paytype[$params['type']];
			if ($params['type'] == 'wechat') {
				$order_data['payment_no'] = $params['tag']['transaction_id'];
			}
			$order_data['pay_time'] = TIMESTAMP;
			$credit_title = superman_credit_type($order['credit_type']);
			$order_url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('order', array('act' => 'detail', 'orderid' => $order['id']));
			$redpack_url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('redpack', array('id' => $order['product_id'], 'orderid' => $order_id));
			
			if($product['type']==7)/*秒杀商品*/
			{
				if(!empty($product["couponid"])) 
				{
					/*卡券或者项目  这里直接把订单状态标记为已发货*/
					$order_data['status'] = 3;
					$coupon_arr=explode("|",$product["couponid"]);
					$expiredDate=empty($coupon_arr[2])?-1:intval($coupon_arr[2]);
					if($expiredDate!=-1)
					{
						$expiredDate=date("Y-m-d",strtotime('+'.$expiredDate.' month'));
					}
					$updata["itemIds"]=$coupon_arr[1];
					$memberApi=$this->initApi();
					$comments="兑换".$product["title"];
					$updata=array(
							"appid"=>$_W['account']['key'],
							"cardId"=>$order["cardid"],
							"itemIds"=>$coupon_arr[1],
							"itemTimes"=>$order["total"],
							"payAmount"=>0,
							"billed"=>'false',
							"expiredDate"=>$expiredDate,
							"comments"=>$comments
					);
					
					if($coupon_arr[0]==1) /*填写格式 ：类型+id用“|”分割， 卡券为2项目为1。例如 2|25 */
					{
						$questResturn=$memberApi->saveService($updata);	
					}else{
						$questResturn=$memberApi->saveVoucher($updata);
					}	
					/*获取会员的积分*/
					$creditsResult=$memberApi->memberCardAboutInfo($order["cardid"],"credits");
						
					if(is_error($creditsResult))
					{
						$availableCredits="__";
					}else{	
						$availableCredits=$creditsResult['message'][0]['availableCredits'];
					}
					$vars = array('{兑换礼品}' => $product['title'], '{消耗积分}' => $product['credit'], '{剩余积分}' => $availableCredits, '{发生时间}' => date('Y-m-d H:i:s',time()));
					$jumpurl=murl("entry//mobile",array('r'=>'blind','m'=>'rlong_car'));
					$message = array('uniacid' => $_W['uniacid'], 'template_id' => $this->module['config']['template_message']['sendquan_id'], 'template_variable' => $this->module['config']['template_message']['sendquan_content'], 'vars' => $vars, 'receiver_uid' => $order['uid'], 'url' => $jumpurl);
					$this->sendTemplateMessage($message);
					unset($message);

				}
			}
			if (superman_is_redpack($product['type'])) {
				$redpack = array('amount' => $order['extend']['redpack_amount'], 'wishing' => superman_redpack_wishing(), 'act_name' => $credit_title . '兑换红包');
				$ret = $this->sendRedpack($order['uid'], $redpack);
				$new_data = array();
				$new_data['extend'] = $order['extend'];
				$new_data['extend']['redpack_result'] = $ret;
				$new_data['extend'] = iserializer($new_data['extend']);
				$aa = pdo_update('superman_creditmall_order', $new_data, array('id' => $order_id));
				if ($ret['success'] !== true) {
					$ret = $this->returnCredit($order, '发红包失败');
					if ($ret !== true) {
						WeUtility::logging('fatal', '发红包退积分失败, order=' . var_export($order, true));
					}
					$this->json_output(ERRNO::SYSTEM_ERROR, '发红包失败，跳转中...', array('url' => $order_url));
				}
			}
			if (superman_is_virtual($product)) {
				$res = array();
				pdo_begin();
				$filter = array('product_id' => $order['product_id'], 'status' => 0);
				$orderby = ' ORDER BY `id` ASC ';
				$rows = superman_virtual_fetchall($filter, $orderby, 0, $order['total']);
				if (count($rows) != $order['total']) {
					WeUtility::logging('fatal', '虚拟物品库存不足, filter=' . var_export($filter, true));
					pdo_rollback();
					$ret = $this->returnCredit($order, '库存不足');
					if ($ret !== true) {
						WeUtility::logging('fatal', '发虚拟物品退积分失败, order=' . var_export($order, true));
					}
					$this->json_output(ERRNO::SYSTEM_ERROR, '库存不足，跳转中...', array('url' => $order_url));
				}
				foreach ($rows as $v) {
					$condition = array('id' => $v['id'], 'status' => 0);
					$new_data = array('status' => 1, 'uid' => $order['uid'], 'get_time' => TIMESTAMP, 'extend' => iserializer(array('ordersn' => $order['ordersn'])));
					$result = pdo_update('superman_creditmall_virtual_stuff', $new_data, $condition);
					if ($result !== false) {
						$res['errno'] += 0;
						$res['key'] .= $v['key'] . "\n";
					} else {
						WeUtility::logging("fatal", "虚拟物品更新失败, new_data=" . var_export($new_data, true), ', condition=' . var_export($condition, true));
						$res['errno'] += -1;
						$res['key'] .= '更新虚拟物品表失败，data=' . var_export($new_data, true) . "\n";
					}
				}
				if (isset($result) && $result != false) {
					pdo_commit();
				} else {
					pdo_rollback();
				}
				unset($_data);
				$_data = array();
				$_data['extend'] = $order['extend'];
				$_data['extend']['virtual_result'] = $res;
				$_data['extend'] = iserializer($_data['extend']);
				pdo_update("superman_creditmall_order", $_data, array('id' => $order_id));
				unset($_data);
			}
			$ret = pdo_update('superman_creditmall_order', $order_data, array('id' => $order_id));
				if($order_data["status"]==1){
            /* 支付成功 回调接口 */
            	$sql = 'SELECT openid FROM ' . tablename('mc_mapping_fans') . ' WHERE `uniacid`=:uniacid AND `uid`=:uid';
				$pars = array();
				$pars[':uniacid'] = $_W['uniacid'];
				$pars[':uid'] = $order["uid"];
				$openid = pdo_fetchcolumn($sql, $pars);
            	$bind=pdo_fetch("select * from ".tablename("rlongcar_user")." where openid=:openid and weid=:weid",array(":openid"=>$openid,":weid"=>$_W["uniacid"]));

				$boutiqueItemId=$product["remote_id"];
            	$exchangeCount=$order["total"];
	            $siteid=$this->module['config']['base']['order_siteid'];
	            $wxPay=$order["price"];
            	if( empty($bind) || ($bind && $bind["type"]==1)){
		           	$vinCode=$this->module['config']['base']['vincode'];
					$cardnum="";
	            }else{
		           	$url=$this->module['config']['base']['user_url'].$bind["value"].".json";
		           	$userinfo=json_decode(file_get_contents($url),true);
		           	$url=$this->module['config']['base']['car_url'].$bind["value"].".json";
					$carinfo=json_decode(file_get_contents($url),true);
		           	$vinCode=$carinfo[0]["vinCode"];
					$cardnum=$userinfo[0]["cardNumber"];
            	}

            	$url=$this->module['config']['base']['apihost']."/{$openid}/{$boutiqueItemId}/{$exchangeCount}/{$wxPay}/{$vinCode}/{$siteid}.json?cardNumber={$cardnum}";
            	 load()->func('communication');
            	 ihttp_get($url);
			}
            /* end */
			if ($ret === false) {
				WeUtility::logging('fatal', '订单状态更新失败, id=' . $order_id . ', data=' . var_export($order_data, true));
				$this->json_output(ERRNO::SYSTEM_ERROR, '订单状态更新失败，请联系管理员');
			}
			if ($order && $order['product_id']) {
				superman_product_update_sales($order['product_id'], $order['total']);
			}
			if ($_W['account']['level'] == 4 && $this->module['config']['template_message']['order_pay_id'] && $this->module['config']['template_message']['order_pay_content']) {
				if ($order['price'] > 0) {
					$order_amount = $order['credit'] . $credit_title . '+' . $order['price'] . '元';
				} else {
					$order_amount = $order['credit'] . $credit_title;
				}
				$vars = array('{订单编号}' => $order['ordersn'], '{订单商品}' => $product['title'], '{订单金额}' => $order_amount);
				$message = array('uniacid' => $_W['uniacid'], 'template_id' => $this->module['config']['template_message']['order_pay_id'], 'template_variable' => $this->module['config']['template_message']['order_pay_content'], 'vars' => $vars, 'receiver_uid' => $order['uid'], 'url' => $order_url);
				$this->sendTemplateMessage($message);
					/*增加发送模板消息*/
				
				if($product['type']==7)
				{
					$userlList=$this->module['config']['newset']['openid2'];
				}else{
					$userlList=$this->module['config']['base']['openid'];
				}
				
				
				if(!empty($userlList)){
					$message["url"]="";
					$first="积分商城有新的订单兑换成功";
					$remark="请到后台查看订单并及时安排发货";
					$sendids = explode(",",$userlList);
					foreach($sendids as $uitem){
						$message["receiver_uid"]=$uitem;
						$this->sendTemplateMessage($message,$first,$remark);
					}
				}
			} elseif ($_W['account']['level'] == 3 || $_W['account']['level'] == 4) {
				$this->sendCustomerStatusNotice($order['uid'], $order['ordersn'], $order['status'], $order_url);
			}
		}
		if ($params['result'] == 'success' && $params['from'] == 'return') {
			if (superman_is_redpack($product['type'])) {
				$this->json_output(ERRNO::OK, '支付成功，跳转中...', array('redirect_url' => $redpack_url));
			} else {
				$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('order', array('status' => 'no_receive'));
				$this->json_output(ERRNO::OK, '支付成功，跳转中...', array('url' => $url));
			}
		}
	}
	public function returnCredit($order, $return_msg = '')
	{
		global $_W;
		if ($order['credit'] > 0 && $order['pay_credit']) {
			$credit_title = superman_credit_type($order['credit_type']);
			$back_credit = "+{$order['credit']}{$credit_title}";
			$log = array($order['uid'], "{$return_msg}退" . $credit_title, $this->modulename);
			$ret = mc_credit_update($order['uid'], $order['credit_type'], $order['credit'], $log);
			if (is_error($ret)) {
				WeUtility::logging('fatal', 'mc_credit_update failed: ret=' . var_export($ret, true));
				return false;
			}
			pdo_update("superman_creditmall_order", array("status" => 0, "pay_credit" => 0), array("id" => $order['id']));
		}
		if ($order['price'] > 0 && $order['pay_price']) {
			$setting = uni_setting($_W['uniacid'], array('payment', 'creditbehaviors'));
			$payment = array();
			if ($setting && isset($setting['payment']) && is_array($setting['payment'])) {
				$payment = $setting['payment'];
			}
			if (empty($payment['credit']['switch'])) {
				WeUtility::logging('fatal', '退余额失败，未开启余额支付开关');
				return false;
			}
			$credit_type = $setting['creditbehaviors']['currency'];
			$credit_title = superman_credit_type($credit_type);
			$back_credit = "+{$order['price']}" . $credit_title;
			$log = array($order['uid'], "{$return_msg}退余额", $this->modulename);
			$ret = mc_credit_update($order['uid'], $credit_type, $order['price'], $log);
			if (is_error($ret)) {
				WeUtility::logging('fatal', 'mc_credit_update failed: ret=' . var_export($ret, true));
				return false;
			}
			pdo_update("superman_creditmall_order", array("status" => 0, "pay_price" => 0), array("id" => $order['id']));
			$condition = array('uniacid' => $_W['uniacid'], 'module' => $this->module['name'], 'tid' => $order['id']);
			pdo_update("core_paylog", array("status" => 0), $condition);
		}
		return true;
	}
	public function sendRedpack($uid, $redpack = array())
	{
		global $_W;
		if ($uid <= 0 || $redpack['amount'] <= 0 || $redpack['wishing'] == '' || $redpack['act_name'] == '') {
			$msg = "红包发送失败：uid={$uid}, amount={$redpack['amount']}";
			WeUtility::logging("fatal", $msg);
			return $msg;
		}
		$setting = uni_setting($_W['uniacid'], array('payment'));
		$pay = $setting['payment'];
		if (!$pay) {
			$msg = '红包发送失败：未配置微信支付参数';
			WeUtility::logging("fatal", $msg);
			return $msg;
		}
		if (!isset($pay['wechat']['signkey']) || $pay['wechat']['signkey'] == '') {
			$msg = '红包发送失败：未配置微信支付参数, signkey is null';
			WeUtility::logging("fatal", $msg);
			return $msg;
		}
		if (empty($this->module['config']['wxpay']['apiclient_cert'])) {
			$msg = '红包发送失败：未配置微信支付证书, apiclient_cert is null';
			WeUtility::logging("fatal", $msg);
			return $msg;
		}
		if (empty($this->module['config']['wxpay']['apiclient_key'])) {
			$msg = '红包发送失败：未配置微信支付证书, apiclient_key is null';
			WeUtility::logging("fatal", $msg);
			return $msg;
		}
		if (empty($this->module['config']['wxpay']['rootca'])) {
			$msg = '红包发送失败：未配置微信支付证书, rootca is null';
			WeUtility::logging("fatal", $msg);
			return $msg;
		}
		$order_no = date('Ymd') . random(6, 1);
		$params = array('nonce_str' => random(32), 'mch_billno' => $order_no, 'mch_id' => $this->module['config']['wxpay']['mchid'], 'wxappid' => $this->module['config']['wxpay']['mch_appid'], 'send_name' => $_W['account']['name'], 're_openid' => $_W['fans']['openid'], 'total_amount' => $redpack['amount'], 'total_num' => 1, 'wishing' => $redpack['wishing'], 'client_ip' => CLIENT_IP, 'act_name' => $redpack['act_name'], 'remark' => $redpack['wishing']);
		$extra = array();
		$extra['sign_key'] = $pay['wechat']['signkey'];
		$attach_path = superman_attachment_root();
		$extra['apiclient_cert'] = $attach_path . $this->module['config']['wxpay']['apiclient_cert'];
		$extra['apiclient_key'] = $attach_path . $this->module['config']['wxpay']['apiclient_key'];
		$extra['rootca'] = $attach_path . $this->module['config']['wxpay']['rootca'];
		$ret = WxpayAPI::sendredpack($params, $extra);
		if (!is_array($ret) || !isset($ret['success'])) {
			WeUtility::logging('fatal', 'WxpayAPI::sendredpack failed, params=' . var_export($params, true) . ', ret=' . var_export($ret, true));
		}
		return $ret;
	}
	public function sendTemplateMessage($message_info,$first="",$remark="")
	{
		global $_W;
		$template_id = $message_info['template_id'];
		$template_variable = $message_info['template_variable'];
		if (!$_W['acid']) {
			$accounts = uni_accounts();
			foreach ($accounts as $k => $v) {
				$_W['account'] = $v;
				$_W['acid'] = $_W['account']['acid'];
				break;
			}
		}
		if (!$_W['uniacid']) {
			$_W['uniacid'] = $message_info['uniacid'];
		}
		$fans = mc_fansinfo($message_info['receiver_uid']);
		if ($fans) {
			if ($fans['follow']) {
				$account = WeAccount::create($_W['acid']);
				$message = array('template_id' => $template_id, 'postdata' => array(), 'url' => $message_info['url'], 'topcolor' => '#008000');
				$template_variable = explode("\n", $template_variable);
				foreach ($template_variable as $line) {
					$arr = explode("=", trim($line));
					$message['postdata'][trim($arr[0])] = array('value' => $this->replaceTemplateMessageVariable(trim($arr[1]), $message_info['vars']), 'color' => '#173177');
				}
	if($first!=""){
					$message['postdata']["first"]['value']=$first;
					}
					if($remark!=""){
					$message['postdata']["Remark"]['value']=$remark;
					}
				$ret = $account->sendTplNotice($fans['openid'], $message['template_id'], $message['postdata'], $message['url'], $message['topcolor']);
				if ($ret !== true) {
					WeUtility::logging("fatal", "模板消息发送失败：openid={$fans['openid']}, ret=" . var_export($ret, true) . ", message=" . var_export($message, true));
				}
				WeUtility::logging("trace", "模板消息发送成功：template_id={$message['template_id']}, openid={$fans['openid']}, message=" . var_export($message, true));
			} else {
				WeUtility::logging("warning", "模板消息发送失败：粉丝已取消关注, fans=" . var_export($fans, true));
			}
		} else {
			WeUtility::logging("warning", "模板消息发送失败：没有找到粉丝信息, uid={$message_info['receiver_uid']}");
		}
	}
	public function sendCustomerStatusNotice($uid, $ordersn, $status, $url = '', $update_time = TIMESTAMP)
	{
		global $_W;
		$account = $this->initAccount();
		if (is_error($account)) {
			WeUtility::logging('fatal', 'sendCustomMessage failed: account=' . var_export($account, true));
			return $account;
		}
		$update_time = date('Y-m-d H:i:s', $update_time);
		$fans = mc_fansinfo($uid);
		$nickname = $fans['nickname'] == '' ? $uid : $fans['nickname'];
		if ($status == 0) {
			$statusname = '提交';
		} elseif ($status == 1) {
			$statusname = '支付';
		} else {
			$statusname = '发货';
		}
		$text = "{$nickname}，您好！\n您的订单已{$statusname}成功！\n订单号：{$ordersn}\n{$update_time}";
		$message = array('msgtype' => 'news', 'news' => array('articles' => array(array('title' => urlencode('订单状态变更通知'), 'description' => urlencode($text), 'url' => urlencode($url), 'picurl' => ''))), 'touser' => $fans['openid']);
		$result = $account->sendCustomNotice($message);
		if (is_error($result)) {
			WeUtility::logging('fatal', 'sendCustomMessage failed: result=' . var_export($result, true));
		}
		return $result;
	}
	public function send_auction_svcmsg($vars, $openid, $url)
	{
		global $_W;
		if (!isset($_W['account']) || empty($_W['account'])) {
			$_W['account'] = account_fetch($_W['acid']);
		}
		if (!in_array($_W['account']['level'], array(3, 4))) {
			WeUtility::logging('fatal', '非认证公众号没有客服消息权限, name=' . $_W['account']['name'] . ', level=' . $_W['account']['level']);
			return false;
		}
		if (!$openid) {
			WeUtility::logging('fatal', '非法参数，openid is null');
			return false;
		}
		$account = $this->initAccount();
		if (is_error($account)) {
			WeUtility::logging('fatal', 'sendCustomMessage failed: account=' . var_export($account, true));
			return $account;
		}
		$content = "恭喜，您已竞拍成功！\n拍卖商品：{$vars['{商品标题}']}\n拍卖价：{$vars['{商品价格}']}\n请尽快领取，点击查看详情";
		$message = array('msgtype' => 'news', 'news' => array('articles' => array(array('title' => urlencode($vars['{title}']), 'description' => urlencode($content), 'url' => urlencode($url), 'picurl' => ''))), 'touser' => $openid);
		$ret = $account->sendCustomNotice($message);
		if (is_error($ret)) {
			WeUtility::logging("fatal", "客服消息发送失败：openid={$openid}, ret=" . var_export($ret, true) . ", message=" . var_export($message, true));
			return false;
		}
		if (file_exists(IA_ROOT . "/online-dev.lock")) {
			WeUtility::logging("trace", "客服消息发送成功：openid={$openid}, message=" . var_export($message, true) . ', title=' . $vars['{title}'] . ', content=' . $content . ', url=' . $url);
		}
		return true;
	}
	public function initAccount()
	{
		global $_W;
		static $account = null;
		if (!is_null($account)) {
			return $account;
		}
		if (empty($_W['account'])) {
			$_W['account'] = uni_fetch($_W['uniacid']);
		}
		if (empty($_W['account'])) {
			return error(-1, '创建公众号操作类失败');
		}
		if ($_W['account']['level'] < 3) {
			return error(-1, '公众号没有经过认证');
		}
		$account = WeAccount::create();
		if (is_null($account)) {
			return error(-1, '创建公众号操作对象失败');
		}
		return $account;
	}
	public function init_subscribe_variable()
	{
		global $_W;
		$subscribe = array('exchange' => 1, 'url' => $_W['account']['subscribeurl'], 'tips' => $this->module['config']['subscribe']['tips']);
		if ($this->module['config']['subscribe']['check'] && (!isset($_W['fans']['follow']) || !$_W['fans']['follow'])) {
			$subscribe['exchange'] = 0;
		}
		return $subscribe;
	}
	private function check_debug()
	{
		global $_W;
		$config = $this->module['config'];
		if ($config['base']['debug']) {
			if (!$_W['member']['uid'] && !$_W['uid']) {
				checkauth();
			}
			if ($_W['member']['uid'] && $config['base']['debug_uids'] && !in_array($_W['member']['uid'], $config['base']['debug_uids'])) {
				$message = $config['base']['debug_message'] != '' ? $config['base']['debug_message'] : '系统升级中...';
				message($message, '', 'info');
			}
		}
	}
	private function replaceTemplateMessageVariable($str, $vars)
	{
		if (!$vars) {
			return $str;
		}
		foreach ($vars as $k => $v) {
			if (strpos($str, $k) !== false) {
				$str = str_replace($k, $v, $str);
			}
		}
		return $str;
	}
	
	public function initApi()
	{
		global $_W, $_GPC;
		$apiurl=$this->module['config']['newset']['apiurl'];
		$apiusername=$this->module['config']['newset']['apiusername'];
		$apipassword=$this->module['config']['newset']['apipassword'];
		$memberApi=new member($apiusername,$apipassword,$apiurl);
		return $memberApi;
	}

	public function getApi()
	{
		global $_W, $_GPC;
		if(empty($_W["openid"]))
		{
			load()->model("mc");
			$userinfo=mc_oauth_userinfo();
			if(empty($userinfo)||is_error($userinfo)) message("请用微信登陆");
			$_W["openid"]=$userinfo["openid"];
		}
		$userinfo=pdo_fetch("select * from ".tablename("rlongcar_user")." where weid=:weid and openid=:openid",array(":weid"=>$_W["uniacid"],":openid"=>$_W["openid"]));
		$memberApi=$this->initApi();
		
		$mobile=$userinfo["value"];
		
		$result=$memberApi->mobile2carid($mobile);
			
		if(is_error($result)||empty($result["message"]))  $userinfo=array();
		$cards=$result["message"];
		return array("userinfo"=>$userinfo,"cards"=>$cards,"api"=>$memberApi);
	}
	
	
	
}
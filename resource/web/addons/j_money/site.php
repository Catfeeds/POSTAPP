<?php

//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or die('Access Denied');
include "../addons/j_money/jetsum_function.php";
class J_moneyModuleSite extends WeModuleSite
{
	
	public function doMobileCexchange()
	{
		global $_GPC, $_W;
		$this->__mobile(__FUNCTION__);
	}
	
	public function doMobileApp()
	{
		global $_GPC, $_W;
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileSoftprint()
	{
		global $_GPC, $_W;
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileSoft()
	{
		global $_GPC, $_W;
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileAyard()
	{
		global $_GPC, $_W;
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileMemberhistory()
	{
		global $_GPC, $_W;
		$this->__mobile(__FUNCTION__);
	}
	public function doMobileMembercharge()
	{
		global $_GPC, $_W;
		$this->__mobile(__FUNCTION__);
	}
	public function doWebMembercharge()
	{
		global $_GPC, $_W;
		$this->__web(__FUNCTION__);
	}
	public function doWebWeisrc_dish()
	{
		global $_GPC, $_W;
		$this->__web(__FUNCTION__);
	}
	
	
	public function doWebMember_select_print()
	{
		global $_GPC, $_W;
		$this->__web(__FUNCTION__);
	}
	
	
	
	public function doMobileAjax()
	{
		global $_GPC, $_W;
		if (!$_W['isajax']) {
			// long 2017-11-10
			// die(json_encode(array('success' => false, 'msg' => "错误！")));
		}
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		if ($operation == "login") {
			$userid = $_GPC['userid'];
			$pwd = $_GPC['pwd'];
			if (!$userid || !$pwd) {
				die(json_encode(array("success" => false, "msg" => "用户名或者密码错误")));
			}
			$pwd = md5($_GPC['pwd']);
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and useracount=:a and password=:b limit 1", array(":a" => $userid, ":b" => $pwd));
			if (!$item) {
				die(json_encode(array("success" => false, "msg" => "用户不存在或者密码错误")));
			}
			if (!$item['status']) {
				die(json_encode(array("success" => false, "msg" => "该用户还没有审核，请联系管理员")));
			}
			//long 2017-11-13
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $item['pcate']));
			isetcookie('islogin', $item['id'], 36000 * $cfg['cookiehold']);
			isetcookie('siteuniacid', $_W['uniacid'], 36000 * $cfg['cookiehold']);
			pdo_update("j_money_user", array('lasttime' => TIMESTAMP), array('id' => $item['id']));
			//long 2017-11-22 添加返回user
			die(json_encode(array("success" => true,'shop'=>$shop,'user'=>$item)));
		} elseif ($operation == "logout") {
			isetcookie('islogin', '', -1);
			isetcookie('siteuniacid', '', -1);
			die(json_encode(array("success" => true)));
		} elseif ($operation == "checklogin") {
			$qrcode = $_GPC['qrcodes'];
			if (!$qrcode) {
				$qrcode = TIMESTAMP;
				$data = array("weid" => $_W['uniacid'], "sncode" => $qrcode, "createtime" => TIMESTAMP);
				pdo_insert("j_money_qrlogin", $data);
				isetcookie('qrcodes', $qrcode, 300);
				die(json_encode(array("success" => false, "msg" => "二维码过期", "reload" => true)));
			}
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_qrlogin') . " WHERE weid='{$_W['uniacid']}' and sncode=:a ", array(":a" => $qrcode));
			if (!$item) {
				die(json_encode(array("success" => false, "msg" => "登陆方式错误", "reload" => true)));
			}
			if ($item['status'] == 0) {
				die(json_encode(array("success" => false, "msg" => "", "reload" => false)));
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $item['userid']));
			isetcookie('islogin', $user['id'], 36000 * $cfg['cookiehold']);
			isetcookie('siteuniacid', $_W['uniacid'], 36000 * $cfg['cookiehold']);
			pdo_update("j_money_user", array('lasttime' => TIMESTAMP), array('id' => $user['id']));
			//long 2017-11-22 添加返回user,$shop
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			die(json_encode(array("success" => true,'shop'=>$shop,'user'=>$user)));
		} elseif ($operation == "pay_all") {
			$qrcode = $_GPC["qrcode"];
			$fee = $_GPC["fee"] ? $_GPC["fee"] : 1;
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
				
			
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			load()->func('communication');
			
			$fee=$fee*100;
			
			$fee = intval(strval($fee));
			
			//die(json_encode(array("success" => false, "msg" => strval($fee))));
			
			$totalfee = ($fee);
			if (!$totalfee) {
				die(json_encode(array("success" => false, "msg" => "金额不能为空")));
			}

				
			$userinfo = $this->authcode2openid($qrcode, $deviceinfo);
			$market = $this->MarketingTest($totalfee, $shop['id'], $deviceinfo, $userinfo['openid']);
			$coupon_fee = $market['coupon_fee'];
			
			
			$marketid = $market['marketid'];
			if (substr($qrcode, 0, 1) == 1) {
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "outTradeNo" => TIMESTAMP . mt_rand(100, 999), "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
				$pay_signkey = trim($shop['pay_signkey']) ? trim($shop['pay_signkey']) : trim($cfg['pay_signkey']);
				$pageparama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "mch_id" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "device_info" => $deviceinfo, "nonce_str" => getNonceStr(), "body" => $shop["companyname"], "detail" => "微支付收款", "attach" => $user['id'], "out_trade_no" => $payParama['outTradeNo'], "total_fee" => $totalfee - $coupon_fee, "fee_type" => "CNY", "spbill_create_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "goods_tag" => "000001", "auth_code" => $qrcode);
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				$data = array("weid" => $_W['uniacid'], "userid" => $deviceinfo, "groupid" => $user['pcate'], "attach" => $_GPC['attach'] ? $_GPC['attach'] : 'PC', "out_trade_no" => $payParama['outTradeNo'], "order_fee" => $totalfee, "total_fee" => $totalfee - $coupon_fee, "discount_fee" => $coupon_fee,"cash_fee" => $totalfee - $coupon_fee, "marketing" => $marketid, "createtime" => TIMESTAMP, "createdate" => date('Y-m-d'), "old_trade_no" => $_GPC['old_trade_no']);
				if ($marketid) {
					$data['marketing_log'] = $marketing['description'];
				}
				pdo_insert("j_money_trade", $data);
				$sign = MakeSign($pageparama, $pay_signkey);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
				$result = FromXml($response);
				if ($result['result_code'] != 'SUCCESS') {
					if ($result['err_code'] == 'USERPAYING') {
						die(json_encode(array("success" => true, "paywait" => true, "out_trade_no" => $payParama['outTradeNo'])));
					}
					die(json_encode(array("success" => false, "msg" => $result['trade_state_desc'] . $result['err_code_des'] . $result['return_msg'], "out_trade_no" => $payParama['outTradeNo'])));
				}
				$insertInfo = array("openid" => $result['openid'], "is_subscribe" => $result['is_subscribe'] == "Y" ? 1 : 0, "sub_openid" => isset($result['sub_openid']) ? $result['sub_openid'] : "", "sub_is_subscribe" => isset($result['sub_is_subscribe']) && $result['sub_is_subscribe'] == "Y" ? 1 : 0, "trade_type" => $result['trade_type'], "bank_type" => $result['bank_type'], "fee_type" => $result['CNY'], "isconfirm" => 1, "status" => 1, "coupon_fee" => intval($result['coupon_fee']), "cash_fee" => intval(strval($result['cash_fee'])), "transaction_id" => $result['transaction_id'], "time_end" => strtotime($result['time_end']));
				pdo_update("j_money_trade", $insertInfo, array("out_trade_no" => $payParama['outTradeNo']));
				$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a", array(":a" => $payParama['outTradeNo']));
				die(json_encode(array("success" => true, "items" => $trade, "out_trade_no" => $payParama['outTradeNo'])));
			} elseif (substr($qrcode, 0, 1) == 2) {
				$payParama = array("outTradeNo" => TIMESTAMP . mt_rand(100, 999), "app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
				$auth_code = trim($qrcode);
				$total_amount = $fee;
				$subject = "支付宝收款";
				$data = array("weid" => $_W['uniacid'], "userid" => $deviceinfo, "groupid" => $user['pcate'], "attach" => $_GPC['attach'] ? $_GPC['attach'] : "PC", "paytype" => 1, "out_trade_no" => $payParama['outTradeNo'], "order_fee" => $totalfee, "total_fee" => $totalfee - $coupon_fee, "discount_fee" => $coupon_fee, "cash_fee" => $totalfee - $coupon_fee, "createtime" => TIMESTAMP, "createdate" => date('Y-m-d'), "marketing" => $marketid, "old_trade_no" => $_GPC['old_trade_no']);

				
				if ($marketid) {
					$data['marketing_log'] = $marketing['description'];
				}
				pdo_insert("j_money_trade", $data);
				$postfee = sprintf('%.2f', $fee * 0.01);
//				die(json_encode(array("success" => false, "msg" => strval($postfee))));
				
				require_once '../addons/j_money/F2fpay.php';
				$f2fpay = new F2fpay();
				$response = $f2fpay->barpay($payParama['outTradeNo'], $auth_code, $postfee, $subject, $payParama);
				$temp = (array) $response;
				$result = (array) $temp['alipay_trade_pay_response'];
				if ($result['code'] == "10003") {
					die(json_encode(array("success" => true, "paywait" => true, "out_trade_no" => $payParama['outTradeNo'])));
				} elseif ($result['code'] == "10000") {
					$insertdata = array("status" => 1, "isconfirm" => 1,"remark" => $temp["buyer_logon_id"],"bank_type" => $temp["fund_bill_list"][0]["fundChannel"], "transaction_id" => $result['trade_no'], "cash_fee" => intval(floatval(strval($result['receipt_amount'])) * 100), "time_end" => strtotime($result['gmt_payment']));
					pdo_update("j_money_trade", $insertdata, array("out_trade_no" => $payParama['outTradeNo']));
					$item = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE out_trade_no=:a", array(":a" => $payParama['outTradeNo']));
					
					/*$payParama1 = array("app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
					//require_once '../addons/j_money/F2fpay.php';
					$cfg = $this->module['config'];
					//$f2fpay = new F2fpay();
					$response = $f2fpay->query($payParama['outTradeNo'], $payParama1);
					$results = @json_decode(json_encode($response), true);
						*/
					
					
					
					die(json_encode(array("success" => true, "items" => $item, "out_trade_no" => $payParama['outTradeNo'])));
				} else {
					pdo_update("j_money_trade", array("log" => "收款失败：" . $result['sub_msg']), array("out_trade_no" => $payParama['outTradeNo']));
					die(json_encode(array("success" => false, "msg" => $result['sub_msg'], "out_trade_no" => $payParama['outTradeNo'])));
				}
				die(json_encode(array("success" => false, "msg" => "未知错误", "out_trade_no" => $payParama['outTradeNo'])));
			} else {
				die(json_encode(array("success" => false, "msg" => "支付码错误", "out_trade_no" => 0)));
			}
		} elseif ($operation == "pay_member") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$cardno = $_GPC["cardno"];
			$outTradeNo = TIMESTAMP . mt_rand(100, 999);
			$paycode = mt_rand(1000, 9999);
			$totalfee = $_GPC['fee'] * 100;
			$membercard = pdo_fetch("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' and wxcardno=:a ", array(":a" => $cardno));
			if (!$membercard) {
				die(json_encode(array("success" => false, "msg" => "会员卡不存在")));
			}
			if ($membercard['cash'] < $totalfee) {
				die(json_encode(array("success" => false, "msg" => "会员卡余额不足")));
			}
			if ($membercard['password']) {
				if ($membercard['password'] != md5($_GPC['password'])) {
					die(json_encode(array("success" => false, "msg" => "支付密码错误")));
				}
			}
			if ($membercard['groupid'] && $membercard['groupid'] != $shop['id']) {
				die(json_encode(array("success" => false, "msg" => "该卡不能在本店使用")));
			}
			$market = $this->MarketingTest($totalfee, $shop['id'], $deviceinfo, $membercard['openid']);
			$coupon_fee = $market['coupon_fee'];
			$marketid = $market['marketid'];
			$data = array("weid" => $_W['uniacid'], "userid" => $deviceinfo, "groupid" => $user['pcate'], "attach" => $_GPC['attach'] ? $_GPC['attach'] : 'PC', "out_trade_no" => $outTradeNo, "order_fee" => $totalfee, "total_fee" => $totalfee - $coupon_fee, "discount_fee" => $coupon_fee, "marketing" => $marketid, "createtime" => TIMESTAMP, "createdate" => date('Y-m-d'), "paytype" => 4, "openid" => $membercard['openid'], "memberno" => $cardno, "status" => 0, "paycode" => $paycode, "old_trade_no" => $_GPC['old_trade_no']);
			pdo_insert("j_money_trade", $data);
			$temp = array("first" => array("value" => "尊敬的顾客", "color" => "#000000"), "number" => array("value" => $paycode, "color" => "#FF0000"), "remark" => array("value" => "该验证码有效期3分钟可输入1次，转发无效", "color" => "#333333"));
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$acc->sendTplNotice($membercard['openid'], $cfg["paycodetempmsg"], $temp, "", "#FF0000");
			die(json_encode(array("success" => true, "items" => $trade, "out_trade_no" => $outTradeNo)));
		} elseif ($operation == "pay_memberpaycode") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$ordersn = $_GPC["ordersn"];
			$paycode = $_GPC["paycode"];
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a and paycode=:b ", array(":a" => $ordersn, ":b" => $paycode));
			if ($trade) {
				pdo_update("j_money_trade", array("status" => 1, "time_end" => TIMESTAMP), array("id" => $trade['id']));
				$membercard = pdo_fetch("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' and wxcardno=:a ", array(":a" => $trade['memberno']));
				pdo_update("j_money_memebercard", array("cash" => $membercard['cash'] - $trade["total_fee"]), array("id" => $membercard['id']));
				die(json_encode(array("success" => true, "items" => $trade, "out_trade_no" => $ordersn)));
			}
			die(json_encode(array("success" => false, "msg" => "验证码错误", "out_trade_no" => $ordersn)));
		} elseif ($operation == "paysuccess") {
			$userid = $_GPC['islogin'];
			if (!$userid) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $userid));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$orderid = $_GPC['out_trade_no'];
			$a = $this->jetSumpay($orderid);
			die(json_encode(array("success" => true, "msg" => $a)));
		} elseif ($operation == "pay_waitpassword") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(":a" => $user['pcate']));
			$out_trade_no = $_GPC["out_trade_no"];
			load()->func('communication');
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $out_trade_no));
			if ($trade['paytype'] == 0) {
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
				$pageparama = array("appid" => $payParama['appid'], "mch_id" => strval($payParama['pay_mchid']), "out_trade_no" => $out_trade_no, "nonce_str" => getNonceStr());
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				$sign = MakeSign($pageparama, $payParama['pay_signkey']);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/orderquery", 10);
				$result = FromXml($response);
				if ($result['result_code'] == 'SUCCESS') {
					if ($result['trade_state'] == 'USERPAYING') {
						die(json_encode(array("success" => true, "paywait" => true, "out_trade_no" => $out_trade_no)));
					} elseif ($result['trade_state'] == 'REFUND') {
						die(json_encode(array("success" => false, "msg" => "订单己退款")));
					} elseif ($result['trade_state'] == 'NOTPAY') {
						die(json_encode(array("success" => false, "msg" => "没有支付")));
					} elseif ($result['trade_state'] == 'CLOSED') {
						die(json_encode(array("success" => false, "msg" => "已关闭")));
					} elseif ($result['trade_state'] == 'REVOKED') {
						die(json_encode(array("success" => false, "msg" => "已撤销")));
					} elseif ($result['trade_state'] == 'PAYERROR') {
						die(json_encode(array("success" => false, "msg" => "支付失败(银行返回失败)")));
					} elseif ($result['trade_state'] == 'SUCCESS') {
						$data = array("openid" => $result['openid'], "is_subscribe" => $result['is_subscribe'] == "Y" ? 1 : 0, "sub_openid" => isset($result['sub_openid']) ? $result['sub_openid'] : "", "sub_is_subscribe" => isset($result['sub_is_subscribe']) && $result['sub_is_subscribe'] == "Y" ? 1 : 0, "trade_type" => $result['trade_type'], "bank_type" => $result['bank_type'], "fee_type" => $result['CNY'], "isconfirm" => 1, "status" => 1, "coupon_fee" => intval($result['coupon_fee']), "transaction_id" => $result['transaction_id'], "time_end" => strtotime($result['time_end']));
					    //$data = array("openid" => $result['openid'], "is_subscribe" => $result['is_subscribe'] == "Y" ? 1 : 0, "sub_openid" => isset($result['sub_openid']) ? $result['sub_openid'] : "", "sub_is_subscribe" => isset($result['sub_is_subscribe']) && $result['sub_is_subscribe'] == "Y" ? 1 : 0, "trade_type" => $result['trade_type'], "bank_type" => $result['bank_type'], "fee_type" => $result['CNY'], "isconfirm" => 1, "status" => 1, "coupon_fee" => intval($result['coupon_fee']), "cash_fee" => intval(strval($result['cash_fee'])), "transaction_id" => $result['transaction_id'], "time_end" => strtotime($result['time_end']));
						pdo_update("j_money_trade", $data, array("id" => $trade['id']));
						if ($trade['status'] == 0) {
							die(json_encode(array("success" => true, "paywait" => false, "isnew" => true, "out_trade_no" => $out_trade_no)));
						}
						die(json_encode(array("success" => true, "paywait" => false, "isnew" => false, "out_trade_no" => $out_trade_no)));
					}
				}
				die(json_encode(array("success" => false, "msg" => $result['trade_state_desc'] . $result['err_code_des'] . $result['return_msg'])));
			} else {
				$payParama = array("app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
				require_once '../addons/j_money/F2fpay.php';
				$cfg = $this->module['config'];
				$f2fpay = new F2fpay();
				$response = $f2fpay->query($out_trade_no, $payParama);
				$results = @json_decode(json_encode($response), true);
				$result = $results['alipay_trade_query_response'];
				if ($result['code'] == 10003) {
					die(json_encode(array("success" => true, "paywait" => true, "msg" => "等待客户支付密码", "out_trade_no" => $out_trade_no)));
				} elseif ($result['code'] == 10000) {
					if ($result['trade_status'] == "TRADE_SUCCESS") {
						//$data = array("status" => 1, "transaction_id" => $result['trade_no'], "cash_fee" => intval(floatval(strval($result['receipt_amount'])) * 100), "time_end" => strtotime($result['gmt_payment']));
						$data = array("status" => 1, "transaction_id" => $result['trade_no'],"time_end" => strtotime($result['gmt_payment']));
						pdo_update("j_money_trade", $data, array("out_trade_no" => $out_trade_no));
						$isnew = false;
						if ($trade["status"] == 0) {
							$isnew = true;
						}
						die(json_encode(array("success" => true, "paywait" => false, "isnew" => $isnew, "out_trade_no" => $out_trade_no)));
					} elseif ($result['trade_status'] == "WAIT_BUYER_PAY") {
						die(json_encode(array("success" => true, "paywait" => true, "msg" => "等待客户付款", "out_trade_no" => $out_trade_no,"other" =>json_encode($response) )));
						//die(json_encode(array("success" => false, "msg" => "等待客户付款")));
					} elseif ($result['trade_status'] == "TRADE_CLOSED") {
						die(json_encode(array("success" => false, "msg" => "订单已关闭，是超时后没支付")));
					} else {
						die(json_encode(array("success" => false, "msg" => $result['trade_status'])));
					}
				}
				die(json_encode(array("success" => false, "msg" => $result['sub_msg'])));
			}
			
			
			
			
		} elseif ($operation == "checkcard") {
			$islogin = $_GPC['islogin'];
			if (!$islogin) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $islogin));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$code = $_GPC['code'];
			if (!$code) {
				die(json_encode(array("success" => false, "msg" => "卡券ID不能为空")));
			}
			$cfg = $this->module['config'];
			load()->func('communication');
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['groupid']));
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$tokens = $acc->fetch_token();
			$pageparama = json_encode(array("code" => $code));
			$resp = ihttp_request("https://api.weixin.qq.com/card/code/get?access_token=" . $tokens, $pageparama, $xml);
			if (is_error($resp)) {
				$procResult = $resp;
			}
			$result = @json_decode($resp['content'], true);
			if ($result['errcode']) {
				die(json_encode(array("success" => false, "msg" => "卡券查询失败，原因：" . $result['errmsg'])));
			}
			$cardid = $result['card']['card_id'];
			$begin_time = $result['card']['begin_time'];
			$end_time = $result['card']['end_time'];
			$can_consume = $result['can_consume'];
			$user_card_status = $result['user_card_status'];
			$openid = $result['openid'];
			if ($begin_time > TIMESTAMP || $end_time < TIMESTAMP) {
				die(json_encode(array("success" => false, "msg" => "该卡券不可用，原因：该卡券使用时间为：" . date("y-m-d H:i", $begin_time) . "-" . date("y-m-d H:i", $end_time))));
			}
			$cardstatus = array("CONSUMED" => "已使用", "EXPIRE" => "已过期", "GIFT_TIMEOUT" => "转赠超时", "DELETE" => "已删除", "UNAVAILABLE" => "已失效", "invalid serial code" => "已被朋友使用");
			if (!$can_consume) {
				die(json_encode(array("success" => false, "msg" => $cardstatus[$user_card_status])));
			}
			$pageparama = json_encode(array("card_id" => $cardid));
			$resp = ihttp_request("https://api.weixin.qq.com/card/get?access_token=" . $tokens, $pageparama, $xml);
			if (is_error($resp)) {
				die(json_encode(array("success" => false, "msg" => $resp)));
			}
			$cardinfo = @json_decode($resp['content'], true);
			$coupon = array();
			$coupon['type'] = strtolower($cardinfo['card']['card_type']);
			switch ($coupon['type']) {
				case "discount":
					$coupon["typestr"] = "折扣券";
					$coupon["discount"] = $cardinfo['card']['discount']['discount'];
					$coupon["msg"] = 100 - $coupon["discount"] . "%折扣券";
					break;
				case "cash":
					$coupon["typestr"] = "代金券";
					$coupon["least_cost"] = isset($cardinfo['card']['cash']['least_cost']) ? $cardinfo['card']['cash']['least_cost'] : 0;
					$coupon["discount"] = $cardinfo['card']['cash']['reduce_cost'];
					$coupon["msg"] = $coupon["least_cost"] ? "满" . sprintf('%.2f', $coupon["least_cost"] * 0.01) . "元减" . sprintf('%.2f', $coupon["discount"] * 0.01) . "元" : "直减" . sprintf('%.2f', $coupon["discount"] * 0.01) . "元";
					break;
				case "gift":
					$coupon["typestr"] = "礼品券";
					$coupon["msg"] = $cardinfo['card']['gift']['gift'];
					break;
				case "groupon":
					$coupon["typestr"] = "团购券";
					$coupon["msg"] = $cardinfo['card']['groupon']['deal_detail'];
					break;
				case "general_coupon":
					$coupon["typestr"] = "优惠券";
					$coupon["msg"] = $cardinfo['card']['general_coupon']['default_detail'];
					break;
			}
			$coupon['openid'] = $openid;
			$coupon['code'] = $code;
			die(json_encode(array("success" => true, "item" => $coupon)));
		} elseif ($operation == "cardcheck") {
			$islogin = $_GPC['islogin'];
			if (!$islogin) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $islogin));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$code = $_GPC['code'];
			if (!$code) {
				die(json_encode(array("success" => false, "msg" => "卡券ID不能为空")));
			}
			$cfg = $this->module['config'];
			load()->func('communication');
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['groupid']));
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$tokens = $acc->fetch_token();
			$pageparama = json_encode(array("code" => $code));
			$resp = ihttp_request("https://api.weixin.qq.com/card/code/consume?access_token=" . $tokens, $pageparama, $xml);
			if (is_error($resp)) {
				$procResult = $resp;
			}
			$arr = @json_decode($resp['content'], true);
			if ($arr['errcode']) {
				die(json_encode(array("success" => false, "msg" => "核销失败。失败原因：" . json_encode($arr))));
			}
			$cardid = $arr['card']['card_id'];
			$openid = $arr['openid'];
			if (!$cardid || !$openid) {
				die(json_encode(array("success" => false, "msg" => "核销失败。失败原因：" . json_encode($arr))));
			}
			$pageparama = json_encode(array("card_id" => $cardid));
			$resp = ihttp_request("https://api.weixin.qq.com/card/get?access_token=" . $tokens, $pageparama, $xml);
			if (is_error($resp)) {
				die(json_encode(array("success" => false, "msg" => $resp)));
			}
			$coupon = array();
			$cardinfo = @json_decode($resp['content'], true);
			$coupon['type'] = strtolower($cardinfo['card']['card_type']);
			switch ($coupon['type']) {
				case "discount":
					$coupon["typestr"] = "折扣券";
					$coupon["discount"] = $cardinfo['card']['discount']['discount'];
					$coupon["title"] = $cardinfo['card']['discount']['base_info']['title'];
					$coupon["sub_title"] = $cardinfo['card']['discount']['base_info']['sub_title'];
					$coupon["description"] = $cardinfo['card']['discount']['base_info']['description'];
					$coupon["extra"] = 100 - intval($coupon["discount"]);
					break;
				case "cash":
					$coupon["typestr"] = "代金券";
					$coupon["least_cost"] = isset($cardinfo['card']['cash']['least_cost']) ? $cardinfo['card']['cash']['least_cost'] : 0;
					$coupon["discount"] = $cardinfo['card']['cash']['reduce_cost'];
					$coupon["title"] = $cardinfo['card']['cash']['base_info']['title'];
					$coupon["sub_title"] = $cardinfo['card']['cash']['base_info']['sub_title'];
					$coupon["description"] = $coupon["least_cost"] ? "满" . sprintf('%.2f', $coupon["least_cost"] * 0.01) . "元减" . sprintf('%.2f', $coupon["discount"] * 0.01) . "元" : "直减" . sprintf('%.2f', $coupon["discount"] * 0.01) . "元";
					break;
				case "gift":
					$coupon["typestr"] = "礼品券";
					$coupon["msg"] = $cardinfo['card']['gift']['gift'];
					$coupon["title"] = $cardinfo['card']['gift']['base_info']['title'];
					$coupon["sub_title"] = $cardinfo['card']['gift']['base_info']['sub_title'];
					$coupon["description"] = $cardinfo['card']['gift']['base_info']['description'];
					$coupon["extra"] = $cardinfo['card']['gift']['gift'];
					break;
				case "groupon":
					$coupon["typestr"] = "团购券";
					$coupon["title"] = $cardinfo['card']['groupon']['base_info']['title'];
					$coupon["sub_title"] = $cardinfo['card']['groupon']['base_info']['sub_title'];
					$coupon["description"] = $cardinfo['card']['groupon']['base_info']['description'];
					$coupon["extra"] = $cardinfo['card']['groupon']['deal_detail'];
					break;
				case "general_coupon":
					$coupon["typestr"] = "优惠券";
					$coupon["title"] = $cardinfo['card']['general_coupon']['base_info']['title'];
					$coupon["sub_title"] = $cardinfo['card']['general_coupon']['base_info']['sub_title'];
					$coupon["description"] = $cardinfo['card']['general_coupon']['base_info']['description'];
					$coupon["extra"] = $cardinfo['card']['general_coupon']['deal_detail'];
					break;
			}
			$cardtype = strtolower($cardinfo['card']['card_type']);
			$c_info = $cardinfo['card'][$cardtype]['base_info'];
			$data = array("weid" => $_W['uniacid'], "openid" => $openid, "userid" => $islogin, "groupid" => $user['pcate'], "cardid" => $cardid, "code" => $code, "createtime" => TIMESTAMP, "type" => $coupon['type'], "title" => $coupon['title'], "sub_title" => $coupon['sub_title'], "description" => $coupon['description'], "extra" => $coupon['extra']);
			pdo_insert("j_money_carduser", $data);
			$data['id'] = pdo_insertid();
			die(json_encode(array("success" => true, "item" => $data)));
		} elseif ($operation == "getcounterrecord") {
			$islogin = $_GPC['islogin'];
			if (!$islogin) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $islogin));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and userid=:a and createdate=:c and status=1 order by id desc", array(":a" => $user['id'], ":c" => date("Y-m-d")));
			$cash_fee_wechat = 0;
			$cash_fee_ali = 0;
			$i = 0;
			$templist = array();
			foreach ($list as $row) {
				if ($row['status']) {
					if ($row['paytype']) {
						$cash_fee_ali = $cash_fee_ali + $row['cash_fee'];
					} else {
						$cash_fee_wechat = $cash_fee_wechat + $row['cash_fee'];
					}
				}
				if ($i < 5) {
					$templist[$i] = $row;
					$templist[$i]['paytype'] = $row['paytype'];
					$templist[$i]['createtime'] = date("H:i", $row['createtime']);
					$templist[$i]['total_fee'] = sprintf('%.2f', $row['total_fee'] / 100);
					$templist[$i]['discount_fee'] = sprintf('%.2f', $row['discount_fee'] / 100);
					$templist[$i]['cash_fee'] = sprintf('%.2f', $row['cash_fee'] / 100);
				}
				$i++;
			}
			$num = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_carduser') . " WHERE weid='{$_W['uniacid']}' and userid=:a and createtime>=:b and createtime<=:c", array(':a' => $userid, ":b" => $user['lasttime'], ":c" => TIMESTAMP));
			die(json_encode(array("success" => true, "num" => $num, "item" => $templist, "fee1" => sprintf('%.2f', $cash_fee_wechat / 100), "fee2" => sprintf('%.2f', $cash_fee_ali / 100))));
		} elseif ($operation == "refundorder") {
			$orderid = $_GPC["orderid"];
			$reason = $_GPC["reason"];
			$userOpenid = intval($_GPC['islogin']);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $userOpenid));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			if (!$orderid) {
				die(json_encode(array("success" => false, "msg" => "订单号不能为空1")));
			}
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
			if (!$trade) {
				die(json_encode(array("success" => false, "msg" => "订单号不能为空2")));
			}
			if (!$trade['status']) {
				die(json_encode(array("success" => false, "msg" => "该订单没有付款")));
			}
			if ($trade['refundstatus']) {
				die(json_encode(array("success" => false, "msg" => "该订单已退款")));
			}
			$cfg = $this->module['config'];
			$refunderlongtime=intval($cfg["refunderlongtime"]);
			if($refunderlongtime>0)
			{	
				if(($trade["createtime"]+$refunderlongtime*3600)<time())
				{
					die(json_encode(array("success" => false, "msg" => "该订单已超过退款时效")));
				}	
			}

			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['groupid']));
			$refund_trade_no = TIMESTAMP;
			pdo_update("j_money_trade", array("refund_fee" => $trade['cash_fee'], "refund_trade_no" => $refund_trade_no), array("out_trade_no" => $orderid));
			$isRefunded = false;
			if ($user['permission'] > 1) {
				$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? strval($shop['sub_mch_id']) : strval($cfg['sub_mch_id']), "apiclient_cert" => $shop['apiclient_cert'] ? '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $trade['groupid'] . "/" . $shop['apiclient_cert'] : '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $cfg['apiclient_cert'], "apiclient_key" => $shop['apiclient_key'] ? '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $trade['groupid'] . "/" . $shop['apiclient_key'] : '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $cfg['apiclient_key'], "app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
				$pageparama = array("appid" => $payParama['appid'], "mch_id" => $payParama['pay_mchid'], "device_info" => $trade['userid'], "nonce_str" => getNonceStr(), "out_trade_no" => $orderid, "out_refund_no" => $trade['refund_trade_no'], "total_fee" => $trade['cash_fee'], "refund_fee" => $trade['refund_fee'], "op_user_id" => $trade['userid'], "app_id" => $payParama['app_id'], "appauthtoken" => $payParama['appauthtoken'], "alipay_cert" => $payParama['alipay_cert']);
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				if ($trade['paytype'] == 1) {
					$postfee = sprintf('%.2f', $trade['cash_fee'] * 0.01);
					require_once '../addons/j_money/F2fpay.php';
					$f2fpay = new F2fpay();
					$response = $f2fpay->refund($orderid, $postfee, $pageparama);
					$temp = (array) $response;
					$result = (array) $temp['alipay_trade_refund_response'];
					if ($result['code'] == "10000") {
						pdo_update("j_money_trade", array("refundstatus" => 1, "refundtime" => TIMESTAMP, "status" => 2), array("out_trade_no" => $orderid));
					} else {
						pdo_update("j_money_trade", array("log" => "退款失败：" . $result['sub_msg']), array("out_trade_no" => $orderid));
						die(json_encode(array("success" => false, "msg" => "退款失败:" . $result['sub_msg'])));
					}
				} else {
					unset($pageparama['alipay_cert']);
					unset($pageparama['appauthtoken']);
					unset($pageparama['app_id']);
					$sign = MakeSign($pageparama, $payParama['pay_signkey']);
					$pageparama['sign'] = $sign;
					$xml = ToXml($pageparama);
					$pemary = array("cert" => $payParama['apiclient_cert'], "key" => $payParama['apiclient_key']);
					$response = postXmlAndPemCurl($xml, "https://api.mch.weixin.qq.com/secapi/pay/refund", $pemary);
					$result = FromXml($response);
					if ($result['result_code'] != 'SUCCESS') {
						pdo_update("j_money_trade", array("log" => "退款失败：" . $result['return_msg']), array("out_trade_no" => $orderid));
						die(json_encode(array("success" => false, "msg" => "退款失败:" . $result['return_msg'] . $result['err_code_des'])));
					}
					pdo_update("j_money_trade", array("refundstatus" => 1, "refundtime" => TIMESTAMP, "status" => 2), array("out_trade_no" => $orderid));
				}
				$url = "";
				$temp = array("first" => array("value" => "【" . $shop['companyname'] . "】【" . $user['realname'] . "】发起退款", "color" => "#FF0000"), "orderProductPrice" => array("value" => sprintf('%.2f', $trade['cash_fee'] / 100), "color" => "#FF0000"), "orderProductName" => array("value" => "电脑端退款申请", "color" => "#333333"), "orderName" => array("value" => $orderid, "color" => "#333333"), "remark" => array("value" => "时间：" . date("Y-m-d H:i:s") . "\n退款原因：" . $reason . "\n", "color" => "#333333"));
				$isRefunded = true;
			} else {
				$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=refund&m=j_money&orderid=" . $orderid;
				$temp = array("first" => array("value" => "【" . $shop['companyname'] . "】【" . $user['realname'] . "】发起退款申请", "color" => "#FF0000"), "orderProductPrice" => array("value" => sprintf('%.2f', $trade['cash_fee'] / 100), "color" => "#FF0000"), "orderProductName" => array("value" => "电脑端退款申请", "color" => "#333333"), "orderName" => array("value" => $orderid, "color" => "#333333"), "remark" => array("value" => "时间：" . date("Y-m-d H:i:s") . "\n退款原因：" . $reason . "\n请点击此信息进行退款操作", "color" => "#333333"));
				if (!$cfg['refunder'] && !$shop['refunder']) {
					die(json_encode(array("success" => false, "msg" => "无退款处理人")));
				}
			}
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$data = $acc->sendTplNotice($shop['refunder'] ? $shop['refunder'] : $cfg['refunder'], $cfg["tempid2"], $temp, $url, "#FF0000");
			$result = @json_decode($data, true);
			die(json_encode(array("success" => true, "isrefunded" => $isRefunded)));
		} elseif ($operation == "refundexcute") {
			$orderid = $_GPC["orderid"];
			if (!$orderid) {
				die(json_encode(array("success" => false, "msg" => "订单号不能为空")));
			}
			if (!$_W['openid']) {
				die(json_encode(array("success" => false, "msg" => "无退款处理人")));
			}
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
			if (!$trade) {
				die(json_encode(array("success" => false, "msg" => "订单号不能为空")));
			}
			if (!$trade['status']) {
				die(json_encode(array("success" => false, "msg" => "该订单没有付款")));
			}
			if ($trade['refundstatus']) {
				die(json_encode(array("success" => false, "msg" => "该订单已退款")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['groupid']));
			$refunder = $shop['refunder'] ? $shop['refunder'] : $cfg['refunder'];
			if (!$refunder) {
				die(json_encode(array("success" => false, "msg" => "无退款处理人")));
			}
			if ($refunder != $_W['openid']) {
				die(json_encode(array("success" => false, "msg" => "非法登陆")));
			}
			$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? strval($shop['sub_mch_id']) : strval($cfg['sub_mch_id']), "apiclient_cert" => $shop['apiclient_cert'] ? '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $trade['groupid'] . "/" . $shop['apiclient_cert'] : '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $cfg['apiclient_cert'], "apiclient_key" => $shop['apiclient_key'] ? '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $trade['groupid'] . "/" . $shop['apiclient_key'] : '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $cfg['apiclient_key'], "app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert']);
			$pageparama = array("appid" => $payParama['appid'], "mch_id" => $payParama['pay_mchid'], "device_info" => $trade['userid'], "nonce_str" => getNonceStr(), "out_trade_no" => $orderid, "out_refund_no" => $trade['refund_trade_no'], "total_fee" => $trade['cash_fee'], "refund_fee" => $trade['refund_fee'], "op_user_id" => $trade['userid'], "app_id" => $payParama['app_id'], "appauthtoken" => $payParama['appauthtoken'], "alipay_cert" => $payParama['alipay_cert']);
			if ($payParama['sub_appid']) {
				$pageparama['sub_appid'] = $payParama['sub_appid'];
			}
			if ($payParama['sub_mch_id']) {
				$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
			}
			if ($trade['paytype'] == 1) {
				$postfee = sprintf('%.2f', $trade['cash_fee'] * 0.01);
				require_once '../addons/j_money/F2fpay.php';
				$f2fpay = new F2fpay();
				$response = $f2fpay->refund($orderid, $postfee, $pageparama);
				$temp = (array) $response;
				$result = (array) $temp['alipay_trade_refund_response'];
				if ($result['code'] == "10000") {
					pdo_update("j_money_trade", array("refundstatus" => 1, "refundtime" => TIMESTAMP, "status" => 2), array("out_trade_no" => $orderid));
					die(json_encode(array("success" => true)));
				} else {
					pdo_update("j_money_trade", array("log" => "退款失败：" . $result['sub_msg']), array("out_trade_no" => $orderid));
					die(json_encode(array("success" => false, "msg" => $result['sub_msg'])));
				}
			} else {
				unset($pageparama['alipay_cert']);
				unset($pageparama['appauthtoken']);
				unset($pageparama['app_id']);
				$sign = MakeSign($pageparama, $payParama['pay_signkey']);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$pemary = array("cert" => $payParama['apiclient_cert'], "key" => $payParama['apiclient_key']);
				$response = postXmlAndPemCurl($xml, "https://api.mch.weixin.qq.com/secapi/pay/refund", $pemary);
				$result = FromXml($response);
				if ($result['return_code'] != 'SUCCESS') {
					pdo_update("j_money_trade", array("log" => "退款失败：" . $result['return_msg']), array("out_trade_no" => $orderid));
					die(json_encode(array("success" => false, "msg" => $result['return_msg'])));
				}
				pdo_update("j_money_trade", array("refundstatus" => 1, "refundtime" => TIMESTAMP, "status" => 2), array("out_trade_no" => $orderid));
				die(json_encode(array("success" => true)));
			}
			die(json_encode(array("success" => false)));
		} elseif ($operation == "gettradelist") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$keyword = trim($_GPC['keyword']);
			$ds = strtotime($_GPC['ds'] ? $_GPC['ds'] . " 00:00:00" : date("Y-m-d") . " 00:00:00");
			$de = strtotime($_GPC['de'] ? $_GPC['de'] . " 23:59:59" : date("Y-m-d") . " 23:59:59");
			$where = " and groupid='" . $user['pcate'] . "' ";
			$where2 = '';
			if ($user['permission'] == 1) {
				$where .= " and userid='" . $deviceinfo . "'";
			}
			if ($ds) {
				$where2 = " and createtime>=" . $ds . " and createtime<=" . $de . "";
			}
			if ($keyword) {
				$where2 = " and out_trade_no='" . $keyword . "' ";
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
			$psize = intval($_GPC['psize']) ? intval($_GPC['psize']) : 10;
			$start = ($pindex - 1) * $psize;

			//long 2017-11-11
			$all = $_GPC['all'];
			if(empty($all)){
				$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} order by id desc LIMIT " . $start . "," . $psize);
			}else{
				//获取全部
				$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} order by id desc ");
				$pay_total = pdo_fetchall("SELECT paytype, sum(total_fee-servermoney) as total from ".tablename('j_money_trade'). " WHERE weid='{$_W['uniacid']}' and status=1 and createdate=:createdate {$where} group by paytype",array(':createdate'=>date('Y-m-d')));
				$all_total = 0;
				foreach($pay_total as &$row){
					$row['total'] = sprintf('%.2f',$row['total'] * 0.01);
					$all_total = $all_total + $row['total'];
				}
				$listCount = pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE status=1 and weid='{$_W['uniacid']}' {$where} {$where2}");
				unset($row);
				$outPostData = [
					'date' => date('Y年m月d日'),
					'listCount' => $listCount,
					'allTotal'  => $all_total,
					'payListTotal' => $pay_total
				];
			}
			
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE weid='" . $_W['uniacid'] . "' {$where} {$where2}");
			$allpage = $total <= $psize ? 1 : ($total % $psize == 0 ? $total / $psize : intval($total / $psize) + 1);
			$user = pdo_fetchall("SELECT id,realname FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
			$userList = array();
			foreach ($user as $row) {
				$userList[$row['id']] = $row['realname'];
			}
			$outPutAry = array();
			foreach ($list as $row) {
				$temp = array(
						 "out_trade_no" => $row['out_trade_no'],
						 "order_fee" => sprintf('%.2f', ($row['order_fee']-$row['servermoney'] )* 0.01),
						 
						 "total_fee" => sprintf('%.2f', ($row['total_fee']-$row['servermoney'] ) * 0.01),
						 "discount_fee" => sprintf('%.2f', $row['discount_fee'] * 0.01),
						 /*
						 	这里因为用户使用了优惠抵扣 操作返回数据金额不正确
						 "cash_fee" => sprintf('%.2f', $row['cash_fee'] * 0.01),
						 */
						 "cash_fee" => sprintf('%.2f', $row['total_fee'] * 0.01),

						"paytype" => $row['paytype'],
						 "status" => $row['status'],
						 "userid" => $row['userid'],
						 "time" => date("m-d H:i:s", $row['createtime']),
						 "servermoney"=> sprintf('%.2f', $row['servermoney'] * 0.01),  //服务费
						 "servertype" => $row['servertype'],
						 "carnumber" => $row['carnumber'],
						 "userbak" => $row['userbak'],
						 "isprint"=>$row['isprint'],
				);
				$outPutAry[] = $temp;
			}
			die(json_encode(array("success" => true, "list" => $outPutAry, "allpage" => $allpage, "pindex" => $pindex, "userlist" => $userList,'outPostData'=>$outPostData)));
		} elseif ($operation == "getchargelist") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$keyword = trim($_GPC['keyword']);
			$ds = strtotime($_GPC['ds'] ? $_GPC['ds'] . " 00:00:00" : date("Y-m-d") . " 00:00:00");
			$de = strtotime($_GPC['de'] ? $_GPC['de'] . " 23:59:59" : date("Y-m-d") . " 23:59:59");
			$where = " and groupid='" . $user['pcate'] . "' ";
			$where2 = '';
			if ($ds) {
				$where2 = " and createtime>=" . $ds . " and createtime<=" . $de . "";
			}
			if ($keyword) {
				$where2 = " and (out_trade_no='" . $keyword . "' or cardno='" . $keyword . "') ";
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
			$psize = intval($_GPC['psize']) ? intval($_GPC['psize']) : 10;
			$start = ($pindex - 1) * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_recharge') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} order by id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_recharge') . " WHERE weid='" . $_W['uniacid'] . "' {$where} {$where2}");
			$allpage = $total <= $psize ? 1 : ($total % $psize == 0 ? $total / $psize : intval($total / $psize) + 1);
			$user = pdo_fetchall("SELECT id,realname FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
			$userList = array();
			foreach ($user as $row) {
				$userList[$row['id']] = $row['realname'];
			}
			$outPutAry = array();
			foreach ($list as $row) {
				$temp = array("out_trade_no" => $row['out_trade_no'], "fee" => sprintf('%.2f', $row['cash'] * 0.01), "paytype" => $row['paytype'], "cardno" => $row['cardno'], "status" => $row['status'], "username" => $userList[$row['userid']], "time" => date("m-d H:i", $row['createtime']), "isprint" => $row['isprint'].'份');
				$outPutAry[] = $temp;
			}
			die(json_encode(array("success" => true, "list" => $outPutAry, "allpage" => $allpage, "pindex" => $pindex)));
		} elseif ($operation == "game") {
			$rid = intval($_GPC['id']);
			$openid = $_W['openid'] ? $_W['openid'] : $_GPC['from_user_oauth'];
			if (!$openid) {
				die(json_encode(array('err' => 1, 'msg' => '微信登陆才能玩游戏哦~')));
			}
			$play_count = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_lottery') . " WHERE gid=:a and createtime=0 and from_user=:b ", array(":a" => $rid, ":b" => $openid));
			if (!$play_count) {
				die(json_encode(array('err' => 1, 'msg' => '您已经没有抽奖机会了哦')));
			}
			$gameid = pdo_fetchcolumn("SELECT id FROM " . tablename('j_money_lottery') . " WHERE gid=:a and createtime=0 and from_user=:b order by id asc limit 1", array(":a" => $rid, ":b" => $openid));
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_lotterygame') . " WHERE id=:a ", array(":a" => $rid));
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_award') . " WHERE gid=:a and renum>0 ORDER BY id asc", array(":a" => $rid));
			if ($item['status'] != 1) {
				die(json_encode(array('err' => 1, 'msg' => '游戏已结束了哦')));
			}
			if ($item['starttime'] > TIMESTAMP) {
				die(json_encode(array('err' => 1, 'msg' => '游戏还没有开始哦')));
			}
			if ($item['endtime'] < TIMESTAMP) {
				die(json_encode(array('err' => 1, 'msg' => '游戏已结束了哦')));
			}
			$prize_arr = array();
			$i = 1;
			foreach ($list as $row) {
				$data = array("id" => $i, "sid" => $row['id'], "title" => $row['level'], "is" => $row['isprize'], "deg" => $row['deg'], "probalilty" => $row['probalilty']);
				array_push($prize_arr, $data);
				$i++;
			}
			$arr = array();
			foreach ($prize_arr as $key => $val) {
				$arr[$val['id']] = $val['probalilty'];
			}
			$proSum = array_sum($arr);
			$result = "";
			foreach ($arr as $key => $proCur) {
				$randNum = mt_rand(1, $proSum);
				if ($randNum <= $proCur) {
					$result = $key;
					break;
				} else {
					$proSum -= $proCur;
				}
			}
			$res = $prize_arr[$result - 1];
			$prizeItem = pdo_fetch("SELECT * FROM " . tablename('j_money_award') . " WHERE id = '" . $res['sid'] . "' ");
			if ($res['is'] == 1 && $prizeItem['leavel'] > 0) {
				$countman = pdo_fetchcolumn("select count(*) FROM " . tablename('j_money_lottery') . " WHERE gid=:a and createtime>0", array(":a" => $rid));
				$countPrize = pdo_fetchcolumn("select count(*) FROM " . tablename('j_money_lottery') . " where gid=:a and aid='" . $res['sid'] . "' ", array(":a" => $rid));
				if ($countman < $prizeItem['leavel'] * ($countPrize + 1)) {
					$other = pdo_fetch("SELECT * FROM " . tablename('j_money_award') . " WHERE gid = '" . $rid . "' and isprize=0 order by probalilty desc limit 1");
					$res['sid'] = $other['id'];
					$res['level'] = $other['level'];
					$res['title'] = $other['title'];
					$res['deg'] = $other['deg'];
					$res['credit'] = $other['credit'];
					$res['is'] = 0;
				}
			}
			$data = array('aid' => $res['sid'], 'award' => $res['title'], "isprize" => $res['is'], 'createtime' => TIMESTAMP);
			$res['msg'] = "抱歉，没有抽奖奖品哦~";
			if ($res['is'] == 1) {
				pdo_update('j_money_award', array('renum' => $prizeItem['renum'] - 1), array('id' => $res['sid']));
				$cfg = $this->module['config'];
				if (strpos($prizeItem['description'], "|#红包#|")) {
					$temp = str_replace("[|#红包#|", "", $prizeItem['description']);
					$temp = str_replace("]", "", $temp);
					$favorAry = explode("-", $temp);
					$fee = 0;
					if (count($favorAry) == 2) {
						$favorAry1 = intval($favorAry[0] * 100);
						$favorAry2 = intval($favorAry[1] * 100);
						if ($favorAry1 >= $favorAry2) {
							$fee = $favorAry1;
						} else {
							$fee = mt_rand($favorAry1, $favorAry2);
						}
						$fee = $fee >= 100 ? $fee : 100;
						$result = $this->_sendpack2($openid, $fee, $cfg);
						$data['prizetype'] = 1;
						$data['award'] = "微信现金红包";
						$data['status'] = 1;
						$data['sncode'] = $fee;
						if (!$result || $result['errno'] != 0) {
							$res['msg'] = "恭喜您获得微信现金红包一个<br>" . json_encode($result);
						} else {
							$res['msg'] = "恭喜您获得微信现金红包一个";
							$data['gettime'] = TIMESTAMP;
						}
					}
				} elseif (strpos($prizeItem['description'], "|#卡券#|")) {
					$temp = str_replace("[|#卡券#|", "", $prizeItem['description']);
					$temp = str_replace("]", "", $temp);
					$favorAry = strpos($temp, ",") ? explode(",", $temp) : array($temp);
					shuffle($favorAry);
					$cardkey = $favorAry[0];
					$wxcard = json_decode($cfg['wxcard'], true);
					if ($wxcard[$cardkey]) {
						$result = $this->sendCard($openid, $wxcard[$cardkey]);
						$data['prizetype'] = 2;
						$data['award'] = "卡券一张";
						$data['gettime'] = TIMESTAMP;
						$data['status'] = 1;
						$data['sncode'] = $wxcard[$cardkey];
						$res['msg'] = "恭喜您获得卡券一张";
						if ($result['errno'] != 0) {
							$res['prizetype'] = 2;
							$res['sncode'] = $wxcard[$cardkey];
							$res['cardary'] = $this->getCardTicket($wxcard[$cardkey], $openid);
						}
					}
				} else {
					$res['msg'] = "恭喜您,抽中了" . $res['title'] . " " . $prizeItem['description'] . "";
					$data['prizetype'] = 0;
					$data['sncode'] = $gameid . '-' . getNonceStr(5);
				}
			}
			pdo_update('j_money_lottery', $data, array('id' => $gameid));
			var_dump($data);
			die(json_encode($res));
		} elseif ($operation == "share2friend") {
			$id = $_GPC['id'];
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_article') . " WHERE id =:id and weid=:a", array(':id' => $id, ':a' => $_W['uniacid']));
			if (!$item) {
				die(json_encode(array("success" => false, "msg" => "error")));
			}
			pdo_update("j_money_article", array("sharecount" => $item['sharecount'] + 1), array("id" => $id));
			if (!$item['status']) {
				die(json_encode(array("success" => false, "msg" => "活动已关闭或暂停")));
			}
			if (TIMESTAMP < $item['starttime']) {
				die(json_encode(array("success" => false, "msg" => "活动还没有开始")));
			}
			if (TIMESTAMP > $item['endtime']) {
				die(json_encode(array("success" => false, "msg" => "活动已结束了哦")));
			}
			$openid = $_W["openid"] ? $_W["openid"] : $_GPC["from_user_oauth"];
			if (!$openid) {
				die(json_encode(array("success" => false, "msg" => "openid error")));
			}
			$isGet = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_view') . " WHERE aid=:id and openid=:a", array(':id' => $id, ':a' => $openid));
			if ($isGet) {
				die(json_encode(array("success" => false, "msg" => "您已经领取过了哦")));
			}
			$data = array("weid" => $_W['uniacid'], "aid" => $id, "openid" => $openid, "status" => 1, "prizetype" => $item['prizetype'], "favorable" => $item['favorable'], "createtime" => TIMESTAMP);
			pdo_insert("j_money_view", $data);
			die(json_encode(array("success" => true)));
		} elseif ($operation == "getmemberlist") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$keyword = trim($_GPC['keyword']);
			$where = " and (groupid=" . $user['pcate'] . " or groupid=0) ";
			$where2 = '';
			if ($keyword) {
				$where2 = " and (cardno like '%" . $keyword . "%' or realname like '%" . $keyword . "%' or mobile like '%" . $keyword . "%' or wxcardno like '%" . $keyword . "%' ) ";
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
			$psize = intval($_GPC['psize']) ? intval($_GPC['psize']) : 10;
			$start = ($pindex - 1) * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} order by id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_memebercard') . " WHERE weid='" . $_W['uniacid'] . "' {$where} {$where2}");
			$allpage = $total <= $psize ? 1 : ($total % $psize == 0 ? $total / $psize : intval($total / $psize) + 1);
			die(json_encode(array("success" => true, "keyword" => $keyword, "list" => $list, "allpage" => $allpage, "pindex" => $pindex)));
		} elseif ($operation == "getmemberview") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$cardno = trim($_GPC['cardno']);
			$membercard = pdo_fetch("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' and (cardno=:a or wxcardno=:a)", array(":a" => $cardno));
			if (!$membercard) {
				die(json_encode(array("success" => false, "msg" => "没有此会员卡")));
			}
			if ($membercard['groupid'] && $membercard['groupid'] != $shop['id'] && !$cfg['wxcardid']) {
				die(json_encode(array("success" => false, "msg" => "该会员卡不能本店使用")));
			}
			die(json_encode(array("success" => true, "item" => $membercard)));
		} elseif ($operation == "payqrcode") {
			$userOpenid = $_W['openid'] ? $_W['openid'] : die(json_encode(array("success" => false, "msg" => "请先登录")));
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and openid=:a ", array(":a" => $userOpenid));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			load()->func('communication');
			$fee = $_GPC["fee"];
			$fee = intval($fee * 100);
			$totalfee = intval($fee);
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$paytype = intval($_GPC["paytype"]);
			$code_url = "";
			if ($paytype == 0) {
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "outTradeNo" => TIMESTAMP . mt_rand(100, 999), "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
				$pageparama = array("appid" => $payParama['appid'], "mch_id" => $payParama['pay_mchid'], "device_info" => "WEB", "nonce_str" => getNonceStr(), "body" => $shop['companyname'], "detail" => "微支付收款", "attach" => "mobile-qrcode", "out_trade_no" => $payParama['outTradeNo'], "total_fee" => $fee, "fee_type" => "CNY", "spbill_create_ip" => $payParama['spbill_create_ip'], "time_start" => date("YmdHis"), "time_expire" => date("YmdHis", TIMESTAMP + 600), "notify_url" => $cfg['notify_url'], "trade_type" => "NATIVE", "product_id" => "01");
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				$data = array("weid" => $_W['uniacid'], "userid" => $user['id'], "groupid" => $user['pcate'], "attach" => "mobile-qrcode", "out_trade_no" => $payParama['outTradeNo'], "order_fee" => $totalfee, "total_fee" => $totalfee, "createtime" => TIMESTAMP, "createdate" => date('Y-m-d'), "old_trade_no" => $_GPC['old_trade_no']);
				pdo_insert("j_money_trade", $data);
				$sign = MakeSign($pageparama, $payParama['pay_signkey']);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/unifiedorder", 10);
				$result = FromXml($response);
				if ($result['return_code'] != 'SUCCESS') {
					die(json_encode(array("success" => false, "msg" => $result['return_msg'])));
				}
				if ($result['code_url']) {
					$code_url = $result['code_url'];
				} else {
					die(json_encode(array("success" => false, "msg" => "生成失败")));
				}
			} else {
				$payParama = array("app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'], "outTradeNo" => TIMESTAMP . mt_rand(100, 999), "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert']);
				$total_amount = $fee;
				$subject = $shop['companyname'];
				$data = array("weid" => $_W['uniacid'], "userid" => $user['id'], "attach" => "mobile-qrcode", "groupid" => $user['pcate'], "paytype" => 1, "out_trade_no" => $payParama['outTradeNo'], "total_fee" => $totalfee, "order_fee" => $totalfee, "createtime" => TIMESTAMP, "createdate" => date('Y-m-d'), "old_trade_no" => $_GPC['old_trade_no']);
				pdo_insert("j_money_trade", $data);
				$postfee = sprintf('%.2f', $fee * 0.01);
				require_once '../addons/j_money/F2fpay.php';
				$f2fpay = new F2fpay();
				$response = $f2fpay->qrpay($payParama['outTradeNo'], $postfee, $subject, $payParama);
				$temp = (array) $response;
				$result = (array) $temp['alipay_trade_precreate_response'];
				if ($result['code'] == "10000") {
					if (isset($result['qr_code'])) {
						$code_url = $result['qr_code'];
					} else {
						die(json_encode(array("success" => false, "msg" => "生成失败")));
					}
				} else {
					die(json_encode(array("success" => false, "msg" => $result['sub_msg'])));
				}
			}
			if (isset($code_url) && $code_url) {
				include '../addons/j_money/phpqrcode.php';
				load()->func('file');
				$dir_url = "../attachment/j_money/" . $_W['uniacid'] . "/";
				mkdirs($dir_url);
				$codename = $userOpenid . "_" . TIMESTAMP . "_.png";
				$value = $code_url;
				if (file_exists($dir_url . $codename)) {
					@unlink($dir_url . $codename);
				}
				QRcode::png($value, $dir_url . $codename, "L", 10);
				die(json_encode(array("success" => true, "qrcode" => $dir_url . $codename . "?v=" . TIMESTAMP, "orderid" => $payParama['outTradeNo'])));
			}
			die(json_encode(array("success" => false, "msg" => "生成失败")));
		} elseif ($operation == "rechargecard") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			load()->func('communication');
			$cardno = trim($_GPC['cardno']);
			$fee = intval($_GPC['fee']) * 100;
			$paytype = trim($_GPC['paytype']);
			$code = trim($_GPC['code']);
			if (!$cardno || !$fee) {
				die(json_encode(array("success" => false, "msg" => "输入字段缺失")));
			}
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' and wxcardno=:a ", array(":a" => $cardno));
			if (!$item) {
				die(json_encode(array("success" => false, "msg" => "卡号不存在")));
			}
			$outTradeNo = strval(date("ymdHis"));
			$insert = array("weid" => $_W['uniacid'], "userid" => $deviceinfo, "groupid" => $user['pcate'], "out_trade_no" => $outTradeNo, "cardno" => $cardno, "remark" => $code, "paytype" => $paytype, "cash" => $fee, "createtime" => TIMESTAMP, "createdate" => date("Y-m-d"), "status" => 0);
			pdo_insert('j_money_recharge', $insert);
			if ($paytype == 2) {
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "outTradeNo" => $outTradeNo, "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
				$pay_signkey = trim($shop['pay_signkey']) ? trim($shop['pay_signkey']) : trim($cfg['pay_signkey']);
				$pageparama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "mch_id" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "device_info" => $deviceinfo, "nonce_str" => getNonceStr(), "body" => $shop['companyname'] . "-充值", "detail" => "微信充值", "attach" => "PC", "out_trade_no" => $payParama['outTradeNo'], "total_fee" => $fee, "fee_type" => "CNY", "spbill_create_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "goods_tag" => "000001", "auth_code" => $code);
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				$sign = MakeSign($pageparama, $pay_signkey);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
				$result = FromXml($response);
				if ($result['result_code'] != 'SUCCESS') {
					if ($result['err_code'] == 'USERPAYING') {
						pdo_update('j_money_recharge', array("status" => 0, "log" => "收款失败：客户未输入支付密码"), array("out_trade_no" => $outTradeNo));
						die(json_encode(array("success" => true, "paywait" => true, "out_trade_no" => $payParama['outTradeNo'])));
					} else {
						pdo_update('j_money_recharge', array("status" => 0, "log" => "收款失败：" . $result['return_msg']), array("out_trade_no" => $outTradeNo));
						die(json_encode(array("success" => false, "msg" => $result['return_msg'])));
					}
				}
			} elseif ($paytype == 3) {
				$payParama = array("outTradeNo" => strval(date("ymdHis")), "app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
				$auth_code = trim($code);
				$total_amount = $fee;
				$subject = $shop['companyname'];
				$postfee = sprintf('%.2f', $insert['cash'] * 0.01);
				require_once '../addons/j_money/F2fpay.php';
				$f2fpay = new F2fpay();
				$response = $f2fpay->barpay($payParama['outTradeNo'], $auth_code, $postfee, $subject, $payParama);
				$temp = (array) $response;
				$result = (array) $temp['alipay_trade_pay_response'];
				if ($result['code'] == "10003") {
					pdo_update("j_money_recharge", array("log" => "收款失败：客户未输入支付密码"), array("out_trade_no" => $payParama['outTradeNo']));
					die(json_encode(array("success" => true, "paywait" => true, "out_trade_no" => $payParama['outTradeNo'])));
				} elseif ($result['code'] != "10000") {
					pdo_update("j_money_recharge", array("log" => "收款失败：" . $result['sub_msg']), array("out_trade_no" => $payParama['outTradeNo']));
					die(json_encode(array("success" => false, "msg" => $result['sub_msg'])));
				}
			}
			pdo_update('j_money_recharge', array("status" => 1), array("out_trade_no" => $outTradeNo));
			$creaditper = $shop['creadit'] ? $shop['creadit'] : $cfg['creadit'];
			$creadit = sprintf('%.2f', $creaditper * $fee);
			pdo_update('j_money_memebercard', array("cash" => $item['cash'] + $fee, "creadit" => $item['creadit'] + $creadit), array("id" => $item['id']));
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(":a" => $item['id']));
			die(json_encode(array("success" => true, "item" => $item, "ordersn" => $outTradeNo)));
		} elseif ($operation == "recharge_waitpass") {
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(":a" => $user['pcate']));
			$out_trade_no = $_GPC["out_trade_no"];
			load()->func('communication');
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_recharge') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $out_trade_no));
			if ($trade['paytype'] == 2) {
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
				$pageparama = array("appid" => $payParama['appid'], "mch_id" => strval($payParama['pay_mchid']), "out_trade_no" => $out_trade_no, "nonce_str" => getNonceStr());
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				$sign = MakeSign($pageparama, $payParama['pay_signkey']);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/orderquery", 10);
				$result = FromXml($response);
				if ($result['result_code'] == 'SUCCESS') {
					if ($result['trade_state'] == 'USERPAYING') {
						die(json_encode(array("success" => true, "paywait" => true, "out_trade_no" => $out_trade_no)));
					} elseif ($result['trade_state'] == 'SUCCESS') {
						$data = array("status" => 1);
						pdo_update("j_money_recharge", $data, array("id" => $trade['id']));
						if ($trade['status'] == 0) {
							die(json_encode(array("success" => true, "paywait" => false, "isnew" => true, "out_trade_no" => $out_trade_no)));
						}
						die(json_encode(array("success" => true, "paywait" => false, "isnew" => false, "out_trade_no" => $out_trade_no)));
					}
				}
				die(json_encode(array("success" => false, "msg" => $result['trade_state_desc'] . $result['err_code_des'])));
			} else {
				$payParama = array("app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'], "appauthtoken" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
				require_once '../addons/j_money/F2fpay.php';
				$cfg = $this->module['config'];
				$f2fpay = new F2fpay();
				$response = $f2fpay->query($out_trade_no, $payParama);
				$results = @json_decode(json_encode($response), true);
				$result = $results['alipay_trade_query_response'];
				if ($result['code'] == 10003) {
					die(json_encode(array("success" => true, "paywait" => true, "msg" => "等待客户支付密码", "out_trade_no" => $orderid)));
				} elseif ($result['code'] == 10000) {
					if ($result['trade_status'] == "TRADE_SUCCESS") {
						$data = array("status" => 1);
						pdo_update("j_money_recharge", $insertdata, array("out_trade_no" => $orderid));
						$isnew = false;
						if ($trade["status"] == 0) {
							$isnew = true;
						}
						die(json_encode(array("success" => true, "paywait" => false, "isnew" => $isnew, "out_trade_no" => $out_trade_no)));
					} elseif ($result['trade_status'] == "TRADE_CLOSED") {
						die(json_encode(array("success" => false, "msg" => "订单已退款或已关闭")));
					} elseif ($result['trade_status'] == "WAIT_BUYER_PAY") {
						die(json_encode(array("success" => true, "paywait" => true, "msg" => "等待客户支付密码", "out_trade_no" => $orderid)));
					} else {
						die(json_encode(array("success" => false, "msg" => $result['trade_status'])));
					}
				}
				die(json_encode(array("success" => false, "msg" => $result['sub_msg'])));
			}
		} elseif ($operation == "closeqrcodewechat") {
			$orderid = $_GPC["orderid"];
			$groupid = pdo_fetchcolumn("SELECT groupid FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $groupid));
			$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "outTradeNo" => strval(date("YmdHis")), "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
			$pageparama = array("appid" => $payParama['appid'], "mch_id" => $payParama['pay_mchid'], "out_trade_no" => $orderid, "nonce_str" => getNonceStr());
			$sign = MakeSign($pageparama, $payParama['pay_signkey']);
			$pageparama['sign'] = $sign;
			$xml = ToXml($pageparama);
			$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/closeorder", 10);
			$result = FromXml($response);
			if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
				pdo_update("j_money_trade", array("log" => "取消订单："), array("out_trade_no" => $orderid));
				die(json_encode(array("success" => true, "orderid" => $outTradeNo)));
			}
			pdo_update("j_money_trade", array("log" => "取消订单失败：" . $result['return_msg']), array("out_trade_no" => $orderid));
			die(json_encode(array("success" => false, "msg" => $result['return_msg'])));
		} elseif ($operation == "checktradestatus") {
			$orderid = $_GPC["orderid"];
			if (!$orderid) {
				die(json_encode(array("success" => false, "msg" => "订单编号不能为空")));
			}
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
			if (!$trade) {
				die(json_encode(array("success" => false, "msg" => "交易不存在")));
			}
			if ($trade['refundtime']) {
				die(json_encode(array("success" => false, "msg" => "订单在" . date("Y-m-d H:i", $trade['refundtime']) . "退款成功")));
			}
			if ($trade['status']) {
				die(json_encode(array("success" => false, "msg" => "交易成功")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['groupid']));
			if ($trade['paytype'] == 1) {
				$payParama = array("outTradeNo" => $orderid, "app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
				require_once '../addons/j_money/F2fpay.php';
				$cfg = $this->module['config'];
				$f2fpay = new F2fpay();
				$response = $f2fpay->query($orderid, $payParama);
				$results = @json_decode(json_encode($response), true);
				$result = $results['alipay_trade_query_response'];
				if ($result['code'] == 10000) {
					if ($result['trade_status'] == "TRADE_SUCCESS") {
						$insertdata = array("status" => 1, "isconfirm" => 1, "transaction_id" => $result['trade_no'], "time_end" => strtotime($result['gmt_payment']));
						pdo_update("j_money_trade", $insertdata, array("out_trade_no" => $orderid));
						die(json_encode(array("success" => false, "msg" => "交易成功")));
					} elseif ($result['trade_status'] == "TRADE_CLOSED") {
						die(json_encode(array("success" => false, "msg" => "订单已退款或已关闭")));
					} else {
						die(json_encode(array("success" => false, "msg" => $result['trade_status'])));
					}
				} else {
					pdo_update("j_money_trade", array("log" => "收款失败：" . $result['sub_msg']), array("out_trade_no" => $orderid));
					die(json_encode(array("success" => false, "msg" => "交易失败:" . $result['sub_msg'])));
				}
			} else {
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "outTradeNo" => strval(date("YmdHis")), "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
				$pageparama = array("appid" => $payParama['appid'], "mch_id" => strval($payParama['pay_mchid']), "out_trade_no" => $orderid, "nonce_str" => getNonceStr());
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				$sign = MakeSign($pageparama, $payParama['pay_signkey']);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/orderquery", 10);
				$result = FromXml($response);
				if ($result['trade_state'] == 'SUCCESS' && $trade['status'] == 0) {
					$insertInfo = array("openid" => $result['openid'], "is_subscribe" => $result['is_subscribe'] == "Y" ? 1 : 0, "trade_type" => $result['trade_type'], "bank_type" => $result['bank_type'], "fee_type" => $result['CNY'], "transaction_id" => $result['transaction_id'], "time_end" => strtotime($result['time_end']), "isconfirm" => 1, "status" => 1);
					if ($result['total_fee'] == $trade['total_fee'] && $result['coupon_fee'] && $result['coupon_count']) {
						$insertInfo['cash_fee'] = $result['total_fee'];
					}
					pdo_update("j_money_trade", $insertInfo, array("id" => $trade['id']));
					$this->jetSumpay($orderid);
					die(json_encode(array("success" => true, "msg" => "交易成功")));
				}
				die(json_encode(array("success" => true, "msg" => "交易失败")));
			}
			die(json_encode(array("success" => true, "msg" => "交易失败")));
		} elseif ($operation == "checkrefundorder") {
			$orderid = $_GPC["orderid"];
			if (!$orderid) {
				die(json_encode(array("success" => false, "msg" => "订单号不能为空")));
			}
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
			if (!$trade) {
				die(json_encode(array("success" => false, "msg" => "订单号不能为空")));
			}
			$pageparama = array("appid" => $cfg['appid'], "mch_id" => strval($cfg['pay_mchid']), "device_info" => $trade['userid'], "nonce_str" => getNonceStr(), "out_trade_no" => $orderid);
			if ($cfg['sub_appid']) {
				$pageparama['sub_appid'] = $cfg['sub_appid'];
			}
			if ($cfg['sub_mch_id']) {
				$pageparama['sub_mch_id'] = $cfg['sub_mch_id'];
			}
			$sign = MakeSign($pageparama, $cfg['pay_signkey']);
			$pageparama['sign'] = $sign;
			$xml = ToXml($pageparama);
			$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/refundquery", 10);
			$result = FromXml($response);
			if ($result['return_code'] != 'SUCCESS') {
				pdo_update("j_money_trade", array("log" => "退款失败：" . $result['return_msg']), array("out_trade_no" => $orderid));
				die(json_encode(array("success" => false, "msg" => $result['return_msg'])));
			}
			if ($result['result_code'] == 'SUCCESS') {
				pdo_update("j_money_trade", array("refundstatus" => 1, "refundtime" => TIMESTAMP, "status" => 2), array("out_trade_no" => $orderid));
				die(json_encode(array("success" => true, "status" => 1)));
			} else {
				die(json_encode(array("success" => true, "status" => 0)));
			}
		} else if($operation == 'getLoginUrl'){
			// long 2017-11-13
			isetcookie('islogin', '', -1);
			$cfg["login_pc_type"]==1&&$_GPC['logintype']=1;
			$qrcode = $_GPC['qrcodes'];
			if (!$qrcode) {
				$qrcode = TIMESTAMP;
				$data = array("weid" => $_W['uniacid'], "sncode" => $qrcode, "createtime" => TIMESTAMP);
				pdo_insert("j_money_qrlogin", $data);
				isetcookie('qrcodes', $qrcode, 300);
			}
			$url = urlencode($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=login&m=j_money&qrcode=" . $qrcode);
			echo $url;
		} else if($operation == 'getOrderDetail'){
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$out_trade_no = $_GPC["out_trade_no"];
			if (!$out_trade_no) {
				die(json_encode(array("success" => false, "msg" => "订单号不能为空")));
			}
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $out_trade_no));
			if (!$trade) {
				die(json_encode(array("success" => false, "msg" => "找不到订单")));
			}
			$trade['time'] = date('Y/m/d H:i',$trade['createtime']);
			$tradeUser = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $trade['userid']));
			$trade['total_fee'] = sprintf('%.2f', $trade['total_fee'] * 0.01);
			$trade['order_fee'] = sprintf('%.2f', $trade['order_fee'] * 0.01);
			echo json_encode(array('success'=>true,'trade'=>$trade,'tradeUser'=>$tradeUser));
			die;
		} else if($operation == 'getPrintTemplate'){
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(-2);
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(":a" => $user['pcate']));
			if (!$shop) {
				die(-2);
			}
			
			$template = pdo_fetch("SELECT * FROM " . tablename('j_money_print') . " WHERE weid = :uniacid and groupid=:shopid and pcate=6 ",array(':uniacid'=>$_W['uniacid'],':shopid'=>$shop['id']));
			 // var_dump($template['content']);die;
			if (!$template) {
				die(-1);
			}
			$data = '{
    "spos": [
        {	
            "position": "center",
            "content": "{店铺}",
            "contenttype": "txt",
            "bold": "1",  
            "height": "1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{	
            "position": "center",
            "content": "【商户联】",
            "contenttype": "txt",
            "bold": "1",  
            "height": "1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{	
            "position": "center",
            "content": "--{订单状态}--",
            "contenttype": "txt",
            "bold": "1",  
            "height": "1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{
			"position": "left",
			"content": "收银员:{收银员}",
			"contenttype": "txt",
			"bold": "0",
			"height": "-1",
			"italic": "0",
			"offset": "0",
			"size": "2"
		},
		{
			"position": "left",
			"content": "收款时间:{收款时间}",
			"contenttype": "txt",
			"bold": "0",
			"height": "-1",
			"italic": "0",
			"offset": "0",
			"size": "2"
		},
		{
			"position": "left",
			"content": "付款方式:{付款方式}",
			"contenttype": "txt",
			"bold": "0",
			"height": "-1",
			"italic": "0",
			"offset": "0",
			"size": "2"
		},
		{
			"position": "left",
			"content": "{服务类型} {服务内容}",
			"contenttype": "txt",
			"bold": "0",
			"height": "-1",
			"italic": "0",
			"offset": "0",
			"size": "2"
		},
		{
            "position": "center",
            "content": "            ",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "2"
        },
        {
            "position": "center",
            "content": "--------------------------------",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{
            "position": "left",
            "content": "账单金额: {账单金额}",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "2"
        },
		{
            "position": "left",
            "content": "手续费: {手续费}",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "2"
        },
		{
            "position": "left",
            "content": "实付: {实付}",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "2"
        },
		
		{
            "position": "center",
            "content": "--------------------------------",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{
            "position": "center",
            "content": "            ",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{
            "position": "center",
            "content": "{一维码}",
            "contenttype": "one-dimension",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
        {
            "position": "center",
            "content": "{一维码}",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "1"
        },
		{
            "position": "center",
            "content": "            ",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{
            "position": "left",
            "content": "请妥善保管打印的第{打印份数}份凭证",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "2"
        },
		{
            "position": "left",
            "content": "打印时间:{打印时间}",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "2"
        },
		{
            "position": "center",
            "content": "            ",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "3"
        },
		{
            "position": "center",
            "content": "--------先服务，后销售--------",
            "contenttype": "txt",
            "bold": "0",
            "height": "-1",
            "italic": "0",
            "offset": "0",
            "size": "2"
        }
    ]
}';
			$printTemplate = $template['content'];
			$out_trade_no = $_GPC["out_trade_no"];
			// pdo_update('j_money_print',array('pcate'=>6),array('id'=>$template['id']));
			// echo $data;die;
			if(!empty($out_trade_no)){
				$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $out_trade_no));
				if (!$trade) {
					die(json_encode(array("success" => false, "msg" => "找不到订单")));
				}
				$trade['time'] = date('Y-m-d H:i:s',$trade['createtime']);
				$tradeUser = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $trade['userid']));
				$trade['total_fee'] = sprintf('%.2f', $trade['total_fee'] * 0.01);
				$trade['order_fee'] = sprintf('%.2f', $trade['order_fee'] * 0.01);
				$trade['servermoney'] = sprintf('%.2f', $trade['servermoney'] * 0.01);

				$statusStr = "";
				if($trade['status'] == 1){
					$statusStr = '已支付';
				}else if($trade['status'] == 0){
					$statusStr = '已支付';
				}else if($trade['status'] == 2){
					$statusStr = '已退款';
				}
				$paystr = "微信支付";
				if ($trade['paytype'] == 1) {
					$paystr = "支付宝支付";
				} else {
					if ($trade['paytype'] == 2) {
						$paystr = "现金支付";
					} else {
						if ($trade['paytype'] == 3) {
							$paystr = "银行卡支付";
						} else {
							if ($trade['paytype'] == 4) {
								$paystr = "会员卡余额";
							}
						}
					}
				}
				$isprint = intval($trade['isprint']) + 1;
				//替换
				$printTemplate = str_replace("{店铺}", $shop['companyname'], $printTemplate);
				$printTemplate = str_replace("{订单状态}", $statusStr, $printTemplate);
				$printTemplate = str_replace("{收银员}", $tradeUser['realname'], $printTemplate);
				$printTemplate = str_replace("{收款时间}", $trade['time'], $printTemplate);
				$printTemplate = str_replace("{付款方式}", $paystr, $printTemplate);
				$printTemplate = str_replace("{服务类型}", '', $printTemplate);
				$printTemplate = str_replace("{服务内容}", '', $printTemplate);
				$printTemplate = str_replace("{账单金额}", $trade['order_fee'], $printTemplate);
				$printTemplate = str_replace("{手续费}", $trade['servermoney'], $printTemplate);
				$printTemplate = str_replace("{实付}", $trade['total_fee'], $printTemplate);
				$printTemplate = str_replace("{一维码}", $trade['out_trade_no'], $printTemplate);
				$printTemplate = str_replace("{打印份数}",$isprint , $printTemplate);
				$printTemplate = str_replace("{打印时间}", date('Y-m-d H:i:s'), $printTemplate);
				pdo_update('j_money_trade',array('isprint'=>$isprint),array('out_trade_no'=>$out_trade_no));
			}

			echo $printTemplate;die;
		}else if($operation == 'checkVersion'){
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$version = file_get_contents('../addons/j_money/version.txt');
			if($version){
				die(json_encode(array("success" => true, "version" => json_decode($version,true))));
			}else{
				die(json_encode(array("success" => false, "msg" => '获取版本失败')));
			}
		}else if($operation == 'modifPassword'){
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$password = $_GPC["password"];
			if(empty($password)){
				die(json_encode(array("success" => false, "msg" => "请输入密码")));
			}
			$result = pdo_update('j_money_user',array('password'=>md5($password)),array('id'=>$user['id']));
			if($result){
				die(json_encode(array("success" => true)));
			}else{
				die(json_encode(array("success" => false, "msg" => "修改错误")));
			}
		}else if($operation == 'checkPrintOrder'){
			$deviceinfo = intval($_GPC["islogin"]);
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
			if (!$user) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(":a" => $user['pcate']));
			if (!$shop) {
				die(json_encode(array("success" => false, "msg" => "请先登录")));
			}

			// $sql = "DROP TABLE IF EXISTS `ims_j_money_print_log`;
			// 		CREATE TABLE `ims_j_money_print_log` (
			// 		  `id` int(10) NOT NULL,
			// 		  `uniacid` int(10) NOT NULL,
			// 		  `shopid` int(10) NOT NULL,
			// 		  `out_trade_no` int(10) NOT NULL,
			// 		  `isprint` int(10) DEFAULT '0',
			// 		  `createtime` int(11) DEFAULT NULL,
			// 		  `printtime` int(11) DEFAULT NULL,
			// 		  PRIMARY KEY (`id`)
			// 		) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			// pdo_run($sql);
			$list = pdo_fetchall('SELECT a.id as userid, a.useracount,a.realname,a.openid,b.id as shopid,b.companyname FROM '.tablename('j_money_user').' a left join '.tablename('j_money_group').' b on a.pcate=b.id WHERE a.weid=:weid',array(':weid'=>$_W['uniacid']));
			$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=loginbyuserid&m=j_money&openid=" . $openid."&qrcode=".$qrcode;
			// var_dump($list);
			include $this->template('user-list');
		}
	}
	public function authcode2openid($qrcode = '', $userid = '')
	{
		global $_GPC, $_W;
		if (!$qrcode) {
			return false;
		}
		if (!$userid) {
			return false;
		}
		$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $userid));
		load()->func('communication');
		$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
		$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
		$pay_signkey = trim($shop['pay_signkey']) ? trim($shop['pay_signkey']) : trim($cfg['pay_signkey']);
		$pageparama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "mch_id" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "auth_code" => $qrcode, "nonce_str" => getNonceStr());
		if ($payParama['sub_appid']) {
			$pageparama['sub_appid'] = $payParama['sub_appid'];
		}
		if ($payParama['sub_mch_id']) {
			$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
		}
		$sign = MakeSign($pageparama, $pay_signkey);
		$pageparama['sign'] = $sign;
		$xml = ToXml($pageparama);
		$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/tools/authcodetoopenid", 10);
		$result = FromXml($response);
		if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
			$openid = $result['openid'];
			load()->model('mc');
			$uid = mc_openid2uid($openid);
			$userinfo = mc_fetch($openid);
			$userinfo['openid'] = $openid;
			return $userinfo;
		}
		return false;
	}
	public function jetSumpay($orderid = '')
	{
		global $_GPC, $_W;
		if (!$orderid) {
			return "订单号不能为空";
		}
		$cfg = $this->module['config'];
		$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
		if (!$trade || !$trade['status']) {
			return "订单异常";
		}
		$useropenid = pdo_fetchcolumn("SELECT openid FROM " . tablename('j_money_user') . " WHERE  id=:a ", array(":a" => $trade['userid']));
		$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE  id=:a ", array(":a" => $trade['groupid']));
		load()->func('communication');
		$result = @ihttp_get($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=app&m=j_money&orderid=" . $orderid . "&op=printorder");
		$temstr = urldecode($cfg['tempparama']);
		$tempstr = str_replace("|#单号#|", $trade['out_trade_no'], $temstr);
		$tempstr = str_replace("|#店铺#|", $shop['companyname'], $tempstr);
		$tempstr = str_replace("|#时间#|", date("y-m-d H:i", $trade['createtime']), $tempstr);
		$tempstr = str_replace("|#总金额#|", "￥" . sprintf('%.2f', $trade['total_fee'] / 100) . "元", $tempstr);
		$tempstr = str_replace("|#优惠金额#|", "￥" . sprintf('%.2f', $trade['coupon_fee'] / 100) . "元", $tempstr);
		$tempstr = str_replace("|#实付金额#|", "￥" . sprintf('%.2f', $trade['cash_fee'] / 100) . "元", $tempstr);
		$paystr = "微信支付";
		if ($trade['paytype'] == 1) {
			$paystr = "支付宝支付";
		} else {
			if ($trade['paytype'] == 2) {
				$paystr = "现金支付";
			} else {
				if ($trade['paytype'] == 3) {
					$paystr = "银行卡支付";
				} else {
					if ($trade['paytype'] == 4) {
						$paystr = "会员卡余额";
					}
				}
			}
		}
		$tempstr = str_replace("|#支付方式#|", $paystr, $tempstr);
		$itemary = json_decode($tempstr, true);
		$temp = array();
		foreach ($itemary as $key => $val) {
			$temp[$key] = array("value" => $val['value'], "color" => $val['color'] ? $val['color'] : "#333333");
		}
		$temp['remark']["value"] = "详细收款情况请登录后台查看";
		$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		$acc = WeAccount::create($acid);
		if ($useropenid) {
			$acc->sendTplNotice($useropenid, $cfg["tempid"], $temp, "", "#FF0000");
		}
		if ($shop['refunder']) {
			$data = $acc->sendTplNotice($shop['refunder'], $cfg["tempid"], $temp, "", "#FF0000");
		} else {
			$data = $acc->sendTplNotice($cfg['refunder'], $cfg["tempid"], $temp, "", "#FF0000");
		}
		$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['userid']));
		if ($trade['paytype']) {
			return "支付宝订单没有后续方案";
		}
		$openid = $trade['sub_openid'] ? $trade['sub_openid'] : $trade['openid'];
		$creaditper = $shop['creadit'] ? $shop['creadit'] : $cfg['creadit'];
		$creadit = sprintf('%.2f', $creaditper * $trade["total_fee"]);
		if ($creadit > 0) {
			load()->model('mc');
			$uid = mc_openid2uid($openid);
			if ($uid) {
				$isget = mc_credit_update($uid, "credit1", $creadit, array("", "收银台消费￥" . sprintf('%.2f', $trade['cash_fee'] / 100) . "元获得积分,OrderID：" . $trade['out_trade_no']));
				if ($isget) {
					pdo_update("j_money_trade", array("credit" => $creadit), array("id" => $trade['id']));
				}
			} else {
				$memberCard = pdo_fetch("SELECT * FROM " . tablename("j_money_memebercard") . " WHERE openid=:a", array(":a" => $openid));
				if ($memberCard) {
					pdo_update("j_money_memebercard", array("creadit" => $memberCard['creadit'] + $creadit), array("id" => $memberCard['id']));
				}
			}
		}
		if ($trade['marketing']) {
			goto sendtouser;
		}
		$marketlist = pdo_fetchall("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and groupid=:d and starttime<=:a and endtime>=:b and status=1 and favorabletype>1 and condition_fee<=:c order by displayorder asc,id desc", array(":a" => $trade['time_end'], ":b" => $trade['time_end'], ":c" => $trade['cash_fee'], ":d" => $user['pcate']));
		if (!count($marketlist) || !$marketlist) {
			goto sendtouser;
		}
		$openid = $trade['sub_openid'] ? $trade['sub_openid'] : $trade['openid'];
		$data = array("weid" => $_W['uniacid'], "out_trade_no" => $orderid, "createtime" => TIMESTAMP, "openid" => $openid);
		pdo_insert("j_money_reward", $data);
		$markid = 0;
		foreach ($marketlist as $row) {
			if ($markid) {
				break;
			}
			$flag = false;
			switch ($row['condition']) {
				case 1:
					$flag = true;
					break;
				case 4:
					$flag = true;
					break;
				case 2:
					load()->model('mc');
					$uid = mc_openid2uid($openid);
					if ($uid) {
						$u_groupid = mc_fetch($openid, "groupid");
						$groupary = strpos($row['condition_member'], ",") ? explode(",", $row['condition_member']) : array($row['condition_member']);
						if (!in_array($u_groupid, $groupary)) {
							$flag = true;
						}
					}
					break;
				case 3:
					$isAdd = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE openid=:a", array(":a" => $openid));
					if (!$isAdd) {
						$flag = true;
					}
					break;
				case 5:
					$followtime = pdo_fetchcolumn("SELECT followtime FROM " . tablename('mc_mapping_fans') . " WHERE openid=:a", array(":a" => $openid));
					if ($followtime) {
						if (TIMESTAMP - $followtime >= $row['condition_attendtime'] * 86400) {
							$flag = true;
						}
					}
					break;
			}
			if (!$flag) {
				continue;
			}
			if ($row['num']) {
				$where = $row["isallnum"] ? "" : " and createtime>='" . strtotime(date("Y-m-d") . " 00:00") . "' and createtime<='" . strtotime(date("Y-m-d") . " 23:59") . "'";
				$hadfavorCount = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_reward') . " WHERE weid=:a and favorabletype=:b {$where}", array(":a" => $_W['uniacid'], ":b" => $row['favorabletype']));
				if ($hadfavorCount >= $row['num']) {
					continue;
				}
			}
			pdo_update("j_money_reward", array("favorabletype" => $row['favorabletype'], "favorable" => $row['favorable'], "marketid" => $row["id"], "marketing_log" => $row["description"]), array("out_trade_no" => $orderid));
			pdo_update("j_money_trade", array("marketing" => $row["id"], "marketing_log" => $row["description"]), array("id" => $trade['id']));
			$markid = $row['id'];
			$favorable = $row['favorable'];
			switch ($row['favorabletype']) {
				case 2:
					if (strpos($favorable, "|#红包#|")) {
						$temp = str_replace("[|#红包#|", "", $favorable);
						$temp = str_replace("]", "", $temp);
						$favorAry = explode("-", $temp);
						$fee = 0;
						if (count($favorAry) == 2) {
							$favorAry1 = intval($favorAry[0] * 100);
							$favorAry2 = intval($favorAry[1] * 100);
							if ($favorAry1 >= $favorAry2) {
								$fee = $favorAry1;
							} else {
								$fee = mt_rand($favorAry1, $favorAry2);
							}
							if ($fee >= 100) {
								$this->_sendpack($openid, $orderid, $fee, $cfg);
							} else {
								pdo_update("j_money_reward", array("favorabletype" => "2", "favorable" => $row['favorable'], 'condition' => $row['condition'], "reward" => $fee, "log" => "金额不足1元，不发送红包"), array("out_trade_no" => $orderid));
							}
						}
					}
					break;
				case 3:
					if (strpos($favorable, "|#卡券#|")) {
						$temp = str_replace("[|#卡券#|", "", $favorable);
						$temp = str_replace("]", "", $temp);
						$favorAry = strpos($temp, ",") ? explode(",", $temp) : array($temp);
						shuffle($favorAry);
						$cardkey = $favorAry[0];
						$wxcard = json_decode($cfg['wxcard'], true);
						if ($wxcard[$cardkey]) {
							$markid = $row['id'];
							$updateData = array('marketid' => $markid, 'favorabletype' => 3, 'favorable' => $row['favorable'], 'condition' => $row['condition'], 'reward' => $wxcard[$cardkey], 'status' => 0, 'gettype' => 1, 'log' => '获得卡券');
							pdo_update("j_money_reward", $updateData, array("out_trade_no" => $orderid));
							if ($trade['is_subscribe']) {
								$result = $this->sendCard($openid, $wxcard[$cardkey]);
								if ($result['errcode'] == 0) {
									pdo_update("j_money_reward", array("status" => 1, "completed" => 1, "gettype" => 0, "endtime" => TIMESTAMP), array("out_trade_no" => $orderid));
								}
							}
						}
					}
					break;
				case 4:
					if (strpos($row['favorable'], "|#抽奖#|")) {
						$temp = str_replace("[|#抽奖#|", "", $favorable);
						$temp = str_replace("]", "", $temp);
						$favorAry = intval($temp);
						if ($favorAry) {
							$markid = $row['id'];
							$updateData = array('marketid' => $markid, 'favorabletype' => 4, 'condition' => $row['condition'], 'favorable' => $row['favorable'], 'reward' => $favorAry, 'status' => 1, 'gettype' => 1, 'log' => '获得' . $favorAry . '次抽奖机会');
							pdo_update("j_money_reward", $updateData, array("out_trade_no" => $orderid));
							$insert = array('weid' => $_W['uniacid'], 'gid' => $row['gid'], 'from_user' => $openid);
							for ($i = 0; $i < $favorAry; $i++) {
								pdo_insert("j_money_lottery", $insert);
							}
						}
					}
					break;
			}
		}
		sendtouser:
		$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
		if ($trade['sub_openid']) {
			if (!$trade['sub_is_subscribe']) {
				return '没有关注，发送失败';
			}
		} else {
			if (!$trade['is_subscribe']) {
				return '没有关注，发送失败';
			}
		}
		if (TIMESTAMP - $trade['createtime'] > 60 * 60 * 12) {
			return '超过24小时，不再发送';
		}
		$tempstr = "";
		$temstr1 = urldecode($cfg['tempparama']);
		$tempstr = str_replace("|#单号#|", $trade['out_trade_no'], $temstr1);
		$tempstr = str_replace("|#店铺#|", $shop['companyname'], $tempstr);
		$tempstr = str_replace("|#时间#|", date("y-m-d H:i", $trade['createtime']), $tempstr);
		$tempstr = str_replace("|#总金额#|", "￥" . sprintf('%.2f', $trade['total_fee'] / 100) . "元", $tempstr);
		$tempstr = str_replace("|#优惠金额#|", "￥" . sprintf('%.2f', $trade['coupon_fee'] / 100) . "元", $tempstr);
		$tempstr = str_replace("|#实付金额#|", "￥" . sprintf('%.2f', $trade['cash_fee'] / 100) . "元", $tempstr);
		$tempstr = str_replace("|#支付方式#|", $paystr, $tempstr);
		if ($trade['marketing']) {
			$marking = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE id=:a ", array(":a" => $trade['marketing']));
			if ($marking['description']) {
				$tempstr = str_replace("|#优惠#|", $marking['description'], $tempstr);
			}
		}
		$tempstr = str_replace("|#优惠#|", '', $tempstr);
		$itemary = json_decode($tempstr, true);
		$temp = array();
		foreach ($itemary as $key => $val) {
			$temp[$key] = array("value" => $val['value'], "color" => $val['color'] ? $val['color'] : "#333333");
		}
		$url = $cfg["tempurl"];
		if ($marking['favorabletype'] == 4) {
			$gamestatus = pdo_fetchcolumn("SELECT status FROM " . tablename('j_money_lotterygame') . " WHERE id=:a ", array(":a" => $marking['gid']));
			if ($gamestatus == 1) {
				$temp['remark']["value"] = "您获得抽奖机会哦，请点击本详情进入抽奖";
				$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&id=" . $marking['gid'] . "&do=game&m=j_money";
			}
		}
		$acc = WeAccount::create($acid);
		$data = $acc->sendTplNotice($openid, $cfg["tempid"], $temp, $url, "#FF0000");
		$result = json_decode($data, true);
		if ($result['errcode'] != 0) {
			pdo_update("j_money_trade", array("log" => $data), array("out_trade_no" => $orderid));
		}
		return $openid . $data;
	}
	public function doMobileRefund()
	{
		global $_GPC, $_W;
		$orderid = $_GPC["orderid"];
		$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
		if (!$trade) {
			die(json_encode(array("success" => false, "msg" => "订单号不能为空")));
		}
		if ($trade['refundstatus']) {
			die(json_encode(array("success" => false, "msg" => "该订单已退款")));
		}
		$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['groupid']));
		if (!$_W['openid']) {
			message("非法登陆,请使用微信登录");
		}
		$cfg = $this->module['config'];
		$openid = $shop['refunder'] ? $shop['refunder'] : $cfg['refunder'];
		if ($openid != $_W['openid']) {
			message("非法操作");
		}
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
		include $this->template('refund');
	}
	
	public function doMobileIndex()
	{
		global $_GPC, $_W;
		
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg=$this->module['config'];
		$islogin=$_GPC["islogin"];
		if(intval($islogin)>0) $operation="in";
		
		
		if ($operation == 'display') {
			isetcookie('islogin', '', -1);
				$cfg["login_pc_type"]==1&&$_GPC['logintype']=1;
				$qrcode = $_GPC['qrcodes'];
				if (!$qrcode) {
					$qrcode = TIMESTAMP;
					$data = array("weid" => $_W['uniacid'], "sncode" => $qrcode, "createtime" => TIMESTAMP);
					pdo_insert("j_money_qrlogin", $data);
					isetcookie('qrcodes', $qrcode, 300);
				}
				$url = urlencode($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=login&m=j_money&qrcode=" . $qrcode);
		
		} else {
			$islogin = $_GPC['islogin'];
			if (!$islogin) {
				header("Location:" . $this->createMobileUrl("index"));
				die;
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $islogin));
			if (!$user || !$user['status']) {
				message("用户不存在或没有权限");
			}
			if (!$user['login_pc'] || !$user['login_m']) {
				if (!$user['login_pc']) {
					if (!$ismobile) {
						message("您的账号禁止在电脑端登录！");
					}
				}
				if (!$user['login_m']) {
					if ($ismobile) {
						message("您的账号禁止在移动端登录！");
					}
				}
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$group = pdo_fetchcolumn("SELECT companyname FROM " . tablename('j_money_group') . " WHERE id=:a", array(":a" => $user['pcate']));
			$marketing = pdo_fetchall("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and groupid=:c and status=1 and starttime<=:a and endtime>=:b order by displayorder asc ,id desc", array(":a" => TIMESTAMP, ":b" => TIMESTAMP, ":c" => $user['pcate']));
			$printDoc = $shop['payreceipt'] ? $shop['payreceipt'] : pdo_fetchcolumn("SELECT id FROM " . tablename('j_money_print') . " WHERE weid='{$_W['uniacid']}' and pcate=0 order by isdefault desc,id desc limit 1 ");
			$printDoc2 = $shop['couponreceipt'] ? $shop['couponreceipt'] : pdo_fetchcolumn("SELECT id FROM " . tablename('j_money_print') . " WHERE weid='{$_W['uniacid']}' and pcate=1 order by isdefault desc,id desc limit 1 ");
			$btnlist = pdo_fetchall("SELECT * FROM " . tablename('j_money_extend') . " WHERE weid='{$_W['uniacid']}' and status=1 order by id asc ");
		}
		
		if ($operation == 'display') {
			include $this->template('login');
			die();
		}
	
			include $this->template('index');

		
		
	}
	public function doMobileIndexold()
	{
		global $_GPC, $_W;
		$ismobile = isMobile();
		if ($ismobile || $_W['openid']) {
			header("location:" . $this->createMobileUrl("mobile"));
			die;
		}
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		if ($operation == 'display') {
			isetcookie('islogin', '', -1);
			if ($_GPC['logintype'] == 1) {
				$qrcode = $_GPC['qrcodes'];
				if (!$qrcode) {
					$qrcode = TIMESTAMP;
					$data = array("weid" => $_W['uniacid'], "sncode" => $qrcode, "createtime" => TIMESTAMP);
					pdo_insert("j_money_qrlogin", $data);
					isetcookie('qrcodes', $qrcode, 300);
				}
				$url = urlencode($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=login&m=j_money&qrcode=" . $qrcode);
			 } 
		} else {
			$islogin = $_GPC['islogin'];
			if (!$islogin) {
				header("Location:" . $this->createMobileUrl("index"));
				die;
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $islogin));
			if (!$user || !$user['status']) {
				message("用户不存在或没有权限");
			}
			if (!$user['login_pc'] || !$user['login_m']) {
				if (!$user['login_pc']) {
					if (!$ismobile) {
						message("您的账号禁止在电脑端登录！");
					}
				}
				if (!$user['login_m']) {
					if ($ismobile) {
						message("您的账号禁止在移动端登录！");
					}
				}
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $user['pcate']));
			$group = pdo_fetchcolumn("SELECT companyname FROM " . tablename('j_money_group') . " WHERE id=:a", array(":a" => $user['pcate']));
			$marketing = pdo_fetchall("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and groupid=:c and status=1 and starttime<=:a and endtime>=:b order by displayorder asc ,id desc", array(":a" => TIMESTAMP, ":b" => TIMESTAMP, ":c" => $user['pcate']));
			$printDoc = $shop['payreceipt'] ? $shop['payreceipt'] : pdo_fetchcolumn("SELECT id FROM " . tablename('j_money_print') . " WHERE weid='{$_W['uniacid']}' and pcate=0 order by isdefault desc,id desc limit 1 ");
			$printDoc2 = $shop['couponreceipt'] ? $shop['couponreceipt'] : pdo_fetchcolumn("SELECT id FROM " . tablename('j_money_print') . " WHERE weid='{$_W['uniacid']}' and pcate=1 order by isdefault desc,id desc limit 1 ");
			$btnlist = pdo_fetchall("SELECT * FROM " . tablename('j_money_extend') . " WHERE weid='{$_W['uniacid']}' and status=1 order by id asc ");
		}

		
		if ($_GPC['small'] == 1) {
			include $this->template('indexsmall');
		} elseif ($_GPC['small'] == 2) {
			include $this->template('indexmin');
		} else {
			include $this->template('index');
		}
	}
	public function MarketingTest($fee = 0, $shopid = 0, $userid = 0, $openid = "")
	{
		global $_W;
		$marketid = 0;
		$coupon_fee = 0;
		$marketing = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and groupid=:d and starttime<=:a and endtime>=:b and status=1 and condition_fee<=:c order by displayorder asc ,id desc limit 1", array(":a" => TIMESTAMP, ":b" => TIMESTAMP, ":c" => $fee, ":d" => $shopid));
		if ($marketing && $marketing['favorabletype'] == 1) {
			if ($marketing['condition'] > 1 && $openid) {
				$flag = false;
				switch ($marketing['condition']) {
					case 4:
						$flag = true;
						break;
					case 2:
						load()->model('mc');
						$uid = mc_openid2uid($openid);
						if ($uid) {
							$u_groupid = mc_fetch($openid);
							$groupary = strpos($marketing['condition_member'], ",") ? explode(",", $marketing['condition_member']) : array($marketing['condition_member']);
							if (!in_array($u_groupid['groupid'], $groupary)) {
								$flag = true;
							}
						}
						break;
					case 3:
						$isAdd = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE openid=:a", array(":a" => $openid));
						if (!$isAdd) {
							$flag = true;
						}
						break;
					case 5:
						$followtime = pdo_fetchcolumn("SELECT followtime FROM " . tablename('mc_mapping_fans') . " WHERE openid=:a", array(":a" => $openid));
						if ($followtime) {
							if (TIMESTAMP - $followtime >= $marketing['condition_attendtime'] * 86400) {
								$flag = true;
							}
						}
						break;
				}
				if (!$flag) {
					return array("marketid" => 0, "coupon_fee" => 0);
				}
			}
			if ($marketing['hour']) {
				$hourary = strpos($marketing['hour'], ",") ? explode(",", $marketing['hour']) : array($marketing['hour']);
				if (!in_array(date("H"), $hourary)) {
					return array("marketid" => 0, "coupon_fee" => 0);
				}
			}
			if ($marketing['num']) {
				$numuser = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and status>0 and marketing=:a and createdate =:b ", array(":a" => $marketing['id'], ":b" => date('Y-m-d')));
				if ($marketing['isallnum']) {
					$numuser = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and status>0 and marketing=:a ", array(":a" => $marketing['id']));
				}
				if ($numuser >= $marketing['num']) {
					return array("marketid" => 0, "coupon_fee" => 0);
				}
			}
			$favorable = $marketing['favorable'];
			if (strpos($favorable, "|#满减#|")) {
				$temp = str_replace("[|#满减#|", "", $favorable);
				$temp = str_replace("]", "", $temp);
				$favorAry = explode("-", $temp);
				if (count($favorAry) > 1) {
					$favorAry1 = strpos($favorAry[0], "%") ? intval(str_replace("%", "", $favorAry[0]) * 0.01 * $fee) : $favorAry[0] * 100;
					$favorAry2 = strpos($favorAry[1], "%") ? intval(str_replace("%", "", $favorAry[1]) * 0.01 * $fee) : $favorAry[1] * 100;
					if ($favorAry1 >= $favorAry2) {
						$coupon_fee = $favorAry1;
					} else {
						$coupon_fee = mt_rand($favorAry1, $favorAry2);
					}
					if ($marketing['isint']) {
						$coupon_fee = intval(sprintf('%.2f', $coupon_fee * 0.01)) * 100;
					}
					if (count($favorAry) == 3) {
						if ($coupon_fee > $favorAry[2] * 100) {
							$coupon_fee = $favorAry[2] * 100;
						}
					}
					if ($coupon_fee >= $fee) {
						$coupon_fee = 0;
					}
					$fee = $fee - $coupon_fee;
					$marketid = $marketing['id'];
				}
			}
		}
		return array("marketid" => $marketid, "coupon_fee" => $coupon_fee);
	}
	public function doMobileExplode()
	{
		global $_GPC, $_W;
		$deviceinfo = intval($_GPC["islogin"]);
		$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
		if (!$user) {
			message("请先登录");
		}
		if ($user['permission'] < 2) {
			message("您的权限不足！");
		}
		$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(":a" => $user['pcate']));
		$keyword = trim($_GPC['keyword']);
		$ds = strtotime($_GPC['ds'] . " 00:00:00");
		$de = strtotime($_GPC['de'] . " 23:59:59");
		$users = pdo_fetchall("SELECT id,realname FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
		$userList = array();
		foreach ($users as $row) {
			$userList[$row['id']] = $row['realname'];
		}
		if (!intval($_GPC['op'])) {
			$where = " and groupid=:g ";
			$ary = array(':g' => $user['pcate']);
			if ($ds) {
				$where .= " and createtime>=:a";
				$ary[':a'] = $ds;
			}
			if ($de) {
				$where .= " and createtime<=:b";
				$ary[':b'] = $de;
			}
			if ($keyword) {
				$where .= " and (out_trade_no=:c)";
				$ary[':c'] = $keyword;
			}
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' {$where} order by id desc ", $ary);
			if (!$list) {
				message("没有数据");
			}
			$discountAry = array("", "系统满减", "会员卡折扣", "微信卡券", "其他");
			$paytypAry = array("微信", "支付宝", "现金", "银行卡", "会员卡");
			$tableheader = array('单号', '店铺', '收银员', '订单金额','服务类型/车牌号/备注', '优惠金额', '应付金额','手续费', '实付金额', '结算金额', '优惠', '支付方式', '备注', '状态', '时间');
			foreach ($parama as $index => $row) {
				array_push($tableheader, $index);
			}
			$html = "\xEF\xBB\xBF";
			foreach ($tableheader as $value) {
				$html .= $value . "\t ,";
			}
			$html .= "\n";
			foreach ($list as $row) {
				$html .= $row['out_trade_no'] . "\t ,";
				$html .= addslashes($shop['companyname']) . "\t ,";
				$html .= addslashes($userList[$row['userid']]) . "\t ,";
				$html .=(sprintf('%.2f', ($row['order_fee']-$row['servermoney']) / 100)).",";

				if(!empty($row["servertype"]))
				{
					$html .= $row['servertype'] . "/";
				}
				if(!empty($row["carnumber"]))
				{
					$html .= $row['carnumber'] . "/";
				}
				if(!empty($row["userbak"]))
				{
					$html .= $row['userbak'];
				}
				$html .= "\t,";
				
				$html .=sprintf('%.2f', $row['discount_fee'] / 100).",";
				$html .=sprintf('%.2f', $row['total_fee'] / 100).",";
				
				$html .=sprintf('%.2f', $row['servermoney'] / 100).",";
				
				$html .=sprintf('%.2f', $row['cash_fee'] / 100).",";
				$html .=($row['paytype'] != 4 ?sprintf('%.2f', $row['total_fee'] / 100) : 0 ).",";
				$html .= addslashes($discountAry[$row['discounttype']]) . "\t ,";
				$html .= addslashes($paytypAry[$row['paytype']]) . "\t ,";
				$html .= addslashes($row['remark']) . "\t ,";
				$html .= ($row['status'] ? $row['status'] == 1 ? "成功" : "退款" : "-") . "\t ,";
				$html .= addslashes(date("Y-m-d H:i", $row['createtime'])) . "\t ,";
				$html .= "\n";
			}
			header("Content-type:text/csv");
			header("Content-Disposition:attachment; filename=收银情况_" . $_GPC['ds'] . "--" . $_GPC['de'] . ".csv");
			echo $html;
			die;
		} else {
			$where = " and groupid=:g ";
			$ary = array(':g' => $user['pcate']);
			if ($ds) {
				$where .= " and createtime>=:a";
				$ary[':a'] = $ds;
			}
			if ($de) {
				$where .= " and createtime<=:b";
				$ary[':b'] = $de;
			}
			if ($keyword) {
				$where .= " and (out_trade_no=:c or or cardno =:c)";
				$ary[':c'] = $keyword;
			}
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_recharge') . " WHERE weid='{$_W['uniacid']}' {$where} order by id desc ", $ary);
			if (!$list) {
				message("没有数据");
			}
			$paytype = array("现金", "银行卡", "微信", "支付宝");
			$tableheader = array('单号', '卡号', '充值金额', '支付方式', '处理人', '店铺', '时间', '状态');
			foreach ($parama as $index => $row) {
				array_push($tableheader, $index);
			}
			$html = "\xEF\xBB\xBF";
			foreach ($tableheader as $value) {
				$html .= $value . "\t ,";
			}
			$html .= "\n";
			foreach ($list as $row) {
				$html .= $row['out_trade_no'] . "\t ,";
				$html .= addslashes($row['cardno']) . "\t ,";
				$html .= addslashes(sprintf('%.2f', $row['cash'] / 100)) . "\t ,";
				$html .= addslashes($paytype[$row['paytype']]) . "\t ,";
				$html .= addslashes($userList[$row['userid']]) . "\t ,";
				$html .= addslashes($shop['companyname']) . "\t ,";
				$html .= date('Y-m-d H:i', $row['createtime']) . "\t ,";
				$html .= ($row['status'] ? $row['status'] == 1 ? "成功" : "已退款" : "失败") . "\t ,";
				$html .= "\n";
			}
			header("Content-type:text/csv");
			header("Content-Disposition:attachment; filename=" . $_GPC['ds'] . "至" . $_GPC['de'] . "充值记录.csv");
			echo $html;
			die;
		}
	}
	public function doMobileCounthistory()
	{
		global $_GPC, $_W;
		$islogin = $_GPC['islogin'];
		if (!$islogin) {
			header("Location:" . $this->createMobileUrl("index"));
			die;
		}
		$userinfo = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $islogin));
		$groupname = pdo_fetchcolumn("SELECT companyname FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:id ", array(":id" => $userinfo['pcate']));
		$where2 = " and groupid='" . $userinfo['pcate'] . "' ";
		$where = $_GPC['date'] ? " and createdate='" . $_GPC['date'] . "'" : " and createdate like '%" . date('Y-m') . "%'";
		if ($_GPC['userid']) {
			$where .= " and userid='" . intval($_GPC['userid']) . "'";
		}
		$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
		$psize = 10;
		$start = ($pindex - 1) * $psize;
		$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}'  {$where} {$where2} order by id desc LIMIT " . $start . "," . $psize);
		$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE weid='" . $_W['uniacid'] . "'  {$where} {$where2}");
		$pager = pagination($total, $pindex, $psize);
		$allItem = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}'  {$where} {$where2} ");
		foreach ($allItem as $row) {
			if ($row['status'] == 1) {
				if ($row['total_fee']) {
					if (!$row['paytype']) {
						$payAry['wechart']['all'] = $payAry['wechart']['all'] + $row['total_fee'];
						$payAry['wechart']['all-count'] = $payAry['wechart']['all-count'] + 1;
					} else {
						$payAry['alipay']['all'] = $payAry['alipay']['all'] + $row['total_fee'];
						$payAry['alipay']['all-count'] = $payAry['alipay']['all-count'] + 1;
					}
				}
				if ($row['coupon_fee']) {
					if (!$row['paytype']) {
						$payAry['wechart']['coupon'] = $payAry['wechart']['coupon'] + $row['coupon_fee'];
						$payAry['wechart']['coupon-count'] = $payAry['wechart']['coupon-count'] + 1;
					} else {
						$payAry['alipay']['coupon'] = $payAry['alipay']['coupon'] + $row['coupon_fee'];
						$payAry['alipay']['coupon-count'] = $payAry['alipay']['coupon-count'] + 1;
					}
				}
				if ($row['cash_fee']) {
					if (!$row['paytype']) {
						$payAry['wechart']['cash_fee'] = $payAry['wechart']['cash_fee'] + $row['cash_fee'];
						$payAry['wechart']['cash_fee-count'] = $payAry['wechart']['cash_fee-count'] + 1;
					} else {
						$payAry['alipay']['cash_fee'] = $payAry['alipay']['cash_fee'] + $row['cash_fee'];
						$payAry['alipay']['cash_fee-count'] = $payAry['alipay']['cash_fee-count'] + 1;
					}
				}
			}
		}
		$datelist = pdo_fetchall("SELECT createdate FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}'  group by createdate order by id desc  ");
		$user = pdo_fetchall("SELECT * FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' and pcate=:a order by id desc", array(":a" => $userinfo['pcate']));
		$userList = array();
		foreach ($user as $row) {
			$userList[$row['id']] = $row['realname'];
		}
		$data = array("CFT" => "零钱包", "ICBC_DEBIT" => "工商银行(借记卡)", "ICBC_CREDIT" => "工商银行(信用卡)", "ABC_DEBIT" => "农业银行(借记卡)", "ABC_CREDIT" => "农业银行(信用卡)", "PSBC_DEBIT" => "邮政储蓄银行(借记卡)", "PSBC_CREDIT" => "邮政储蓄银行(信用卡)", "CCB_DEBIT" => "建设银行(借记卡)", "CCB_CREDIT" => "建设银行(信用卡)", "CMB_DEBIT" => "招商银行(借记卡)", "CMB_CREDIT" => "招商银行(信用卡)", "BOC_DEBIT" => "中国银行(借记卡)", "BOC_CREDIT" => "中国银行(信用卡)", "COMM_DEBIT" => "交通银行(借记卡)", "SPDB_DEBIT" => "浦发银行(借记卡)", "SPDB_CREDIT" => "浦发银行(信用卡)", "GDB_DEBIT" => "广发银行(借记卡)", "GDB_CREDIT" => "广发银行(信用卡)", "CMBC_DEBIT" => "民生银行(借记卡)", "CMBC_CREDIT" => "民生银行(信用卡)", "PAB_DEBIT" => "平安银行(借记卡)", "PAB_CREDIT" => "平安银行(信用卡)", "CEB_DEBIT" => "光大银行(借记卡)", "CEB_CREDIT" => "光大银行(信用卡)", "CIB_DEBIT" => "兴业银行(借记卡)", "CIB_CREDIT" => "兴业银行(信用卡)", "CITIC_DEBIT" => "中信银行(借记卡)", "CITIC_CREDIT" => "中信银行(信用卡)", "BOSH_DEBIT" => "上海银行(借记卡)", "BOSH_CREDIT" => "上海银行(信用卡)", "CRB_DEBIT" => "华润银行(借记卡)", "HZB_DEBIT" => "杭州银行(借记卡)", "HZB_CREDIT" => "杭州银行(信用卡)", "BSB_DEBIT" => "包商银行(借记卡)", "BSB_CREDIT" => "包商银行(信用卡)", "CQB_DEBIT" => "重庆银行(借记卡)", "SDEB_DEBIT" => "顺德农商行(借记卡)", "SZRCB_DEBIT" => "深圳农商银行(借记卡)", "HRBB_DEBIT" => "哈尔滨银行(借记卡)", "BOCD_DEBIT" => "成都银行(借记卡)", "GDNYB_DEBIT" => "南粤银行(借记卡)", "GDNYB_CREDIT" => "南粤银行(信用卡)", "GZCB_DEBIT" => "广州银行(借记卡)", "GZCB_CREDIT" => "广州银行(信用卡)", "JSB_DEBIT" => "江苏银行(借记卡)", "JSB_CREDIT" => "江苏银行(信用卡)", "NBCB_DEBIT" => "宁波银行(借记卡)", "NBCB_CREDIT" => "宁波银行(信用卡)", "NJCB_DEBIT" => "南京银行(借记卡)", "JZB_DEBIT" => "晋中银行(借记卡)", "KRCB_DEBIT" => "昆山农商(借记卡)", "LJB_DEBIT" => "龙江银行(借记卡)", "LNNX_DEBIT" => "辽宁农信(借记卡)", "LZB_DEBIT" => "兰州银行(借记卡)", "WRCB_DEBIT" => "无锡农商(借记卡)", "ZYB_DEBIT" => "中原银行(借记卡)", "ZJRCUB_DEBIT" => "浙江农信(借记卡)", "WZB_DEBIT" => "温州银行(借记卡)", "XAB_DEBIT" => "西安银行(借记卡)", "JXNXB_DEBIT" => "江西农信(借记卡)", "NCB_DEBIT" => "宁波通商银行(借记卡)", "NYCCB_DEBIT" => "南阳村镇银行(借记卡)", "NMGNX_DEBIT" => "内蒙古农信(借记卡)", "SXXH_DEBIT" => "陕西信合(借记卡)", "SRCB_CREDIT" => "上海农商银行(信用卡)", "SJB_DEBIT" => "盛京银行(借记卡)", "SDRCU_DEBIT" => "山东农信(借记卡)", "SRCB_DEBIT" => "上海农商银行(借记卡)", "SCNX_DEBIT" => "四川农信(借记卡)", "QLB_DEBIT" => "齐鲁银行(借记卡)", "QDCCB_DEBIT" => "青岛银行(借记卡)", "PZHCCB_DEBIT" => "攀枝花银行(借记卡)", "ZJTLCB_DEBIT" => "浙江泰隆银行(借记卡)", "TJBHB_DEBIT" => "天津滨海农商行(借记卡)", "WEB_DEBIT" => "微众银行(借记卡)", "YNRCCB_DEBIT" => "云南农信(借记卡)", "WFB_DEBIT" => "潍坊银行(借记卡)", "WHRC_DEBIT" => "武汉农商行(借记卡)", "ORDOSB_DEBIT" => "鄂尔多斯银行(借记卡)", "XJRCCB_DEBIT" => "新疆农信银行(借记卡)", "ORDOSB_CREDIT" => "鄂尔多斯银行(信用卡)", "CSRCB_DEBIT" => "常熟农商银行(借记卡)", "JSNX_DEBIT" => "江苏农商行(借记卡)", "GRCB_CREDIT" => "广州农商银行(信用卡)", "GLB_DEBIT" => "桂林银行(借记卡)", "GDRCU_DEBIT" => "广东农信银行(借记卡)", "GDHX_DEBIT" => "广东华兴银行(借记卡)", "FJNX_DEBIT" => "福建农信银行(借记卡)", "DYCCB_DEBIT" => "德阳银行(借记卡)", "DRCB_DEBIT" => "东莞农商行(借记卡)", "CZCB_DEBIT" => "稠州银行(借记卡)", "CZB_DEBIT" => "浙商银行(借记卡)", "CZB_CREDIT" => "浙商银行(信用卡)", "GRCB_DEBIT" => "广州农商银行(借记卡)", "CSCB_DEBIT" => "长沙银行(借记卡)", "CQRCB_DEBIT" => "重庆农商银行(借记卡)", "CBHB_DEBIT" => "渤海银行(借记卡)", "BOIMCB_DEBIT" => "内蒙古银行(借记卡)", "BOD_DEBIT" => "东莞银行(借记卡)", "BOD_CREDIT" => "东莞银行(信用卡)", "BOB_DEBIT" => "北京银行(借记卡)", "BNC_DEBIT" => "江西银行(借记卡)", "BJRCB_DEBIT" => "北京农商行(借记卡)", "AE_CREDIT" => "AE(信用卡)", "GYCB_CREDIT" => "贵阳银行(信用卡)", "JSHB_DEBIT" => "晋商银行(借记卡)", "JRCB_DEBIT" => "江阴农商行(借记卡)", "JNRCB_DEBIT" => "江南农商(借记卡)", "JLNX_DEBIT" => "吉林农信(借记卡)", "JLB_DEBIT" => "吉林银行(借记卡)", "JJCCB_DEBIT" => "九江银行(借记卡)", "HXB_DEBIT" => "华夏银行(借记卡)", "HXB_CREDIT" => "华夏银行(信用卡)", "HUNNX_DEBIT" => "湖南农信(借记卡)", "HSB_DEBIT" => "徽商银行(借记卡)", "HSBC_DEBIT" => "恒生银行(借记卡)", "HRXJB_DEBIT" => "华融湘江银行(借记卡)", "HNNX_DEBIT" => "河南农信(借记卡)", "HKBEA_DEBIT" => "东亚银行(借记卡)", "HEBNX_DEBIT" => "河北农信(借记卡)", "HBNX_DEBIT" => "湖北农信(借记卡)", "HBNX_CREDIT" => "湖北农信(信用卡)", "GYCB_DEBIT" => "贵阳银行(借记卡)", "GSNX_DEBIT" => "甘肃农信(借记卡)", "JCB_CREDIT" => "JCB(信用卡)", "MASTERCARD_CREDIT" => "MASTERCARD(信用卡)", "VISA_CREDIT" => "VISA(信用卡)");
		include $this->template('history');
	}
	public function doMobileMobile()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		$isLogin = $_GPC['islogin'];
		if ($operation == "paysuccess") {
			$tradeid = $out_trade_no = $_GPC['tradeid'];
			if (!$tradeid) {
				message("无数据请求", $this->createMobileUrl('mobile'));
			}
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $tradeid));
			if (!$trade) {
				message("无数据请求", $this->createMobileUrl('mobile'));
			}
			include $this->template('mobilepayseccess');
			die;
		} elseif ($operation == "history") {
			$userOpenid = $_W['openid'] ? $_W['openid'] : message("非法登陆");
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and openid=:openid ", array(":openid" => $userOpenid));
			$date = $_GPC['date'] ? $_GPC['date'] : date("Y-m-d");
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and userid=:a and createdate=:b and attach<>'-' and attach<>'PC' order by id desc limit 0,5", array(":a" => $user['id'], ":b" => $date));
			$num = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and userid=:a and createdate=:b and attach<>'-' and attach<>'PC' ", array(":a" => $user['id'], ":b" => $date));
			include $this->template('mobilehistory');
			die;
		} elseif ($operation == "login") {
			if ($isLogin) {
				header("location:" . $this->createMobileUrl("mobile"));
				die;
			}
			$userOpenid = $_W['openid'] ? $_W['openid'] : message("非法登陆");
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and openid=:a and status=1", array(":a" => $userOpenid));
			if (!$user['login_m']) {
				message("您的账号禁止在移动端登录！0x001");
			}
			isetcookie('islogin', $user['id'], 3600 * $cfg['cookiehold']);
			header("location:" . $this->createMobileUrl("mobile"));
			die;
		} else {
			if (!$isLogin) {
				header("location:" . $this->createMobileUrl("mobile", array("op" => "login")));
				die;
			}
			$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:id and status=1", array(":id" => $isLogin));
			if (!$user || !$user['status']) {
				message("抱歉您的账号暂时无法使用");
			}
			isetcookie('islogin', $user['id'], 3600 * $cfg['cookiehold']);
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id=:a", array(":a" => $user['pcate']));
		}
		include $this->template('mobile');
	}
	public function doMobilePrinter() // Mango 
	{
		global $_GPC, $_W;
		include_once 'include/mobile/printer.php';
	}
	
	public function doMobileJfprinter() // Mango
	{
		global $_GPC, $_W;
		include_once 'include/mobile/jfprinter.php';
	}
	
	public function doMobilePrinter_ocx()
	{
		global $_GPC, $_W;
		$userid = $_GPC['islogin'];
		if (!$userid) {
			die("请先登录");
		}
		$id = $_GPC['id'];
		$printtype = intval($_GPC['printtype']);
		$tradeid = $_GPC['ordersn'];
		$cfg = $this->module['config'];
		include $this->template('print');
	}
	public function doMobileOauthcredit()
	{
		global $_W, $_GPC;
		$code = $_GPC['code'];
		$shopid = $_GPC['shopid'];
		$pagetpye = intval($_GPC['pagetpye']);
		$mobile = intval($_GPC['mobile']);
		$cfg = $this->module['config'];
		if (!empty($code)) {
			load()->func('communication');
			$url = "https://api.weixin.qq.com/card/user/getcardlist?access_token=TOKEN";
			$ret = ihttp_get($url);
			if (!is_error($ret)) {
				$auth = @json_decode($ret['content'], true);
				if (is_array($auth) && !empty($auth['openid'])) {
					$openid = $auth['openid'];
					isetcookie('openid_' . $_W['uniacid'], $openid, 86400);
					$forward = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=getcredit&m=j_money&mobile=" . $mobile . "&wxref=mp.weixin.qq.com#wechat_redirect";
					if ($pagetpye == 2) {
						$forward = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=membercharge&m=j_money&shopid=" . $shopid . "&wxref=mp.weixin.qq.com#wechat_redirect";
					} elseif ($pagetpye == 3) {
						$forward = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=memberhistory&m=j_money&wxref=mp.weixin.qq.com#wechat_redirect";
					}
					header('location:' . $forward);
					die;
				} else {
					die('抱歉，微信授权失败');
				}
			} else {
				die('微信授权失败');
			}
		}
		die('微信授权失败');
	}
	public function doMobileGetcredit()
	{
		global $_W, $_GPC;
		$qrcode = $_GPC['qrcode'] ? $_GPC['qrcode'] : $_GPC['j_money_qrcode' . $_W['uniacid']];
		$qrcode1 = base64_decode(urldecode(urldecode(strval($qrcode))));
		$cfg = $this->module['config'];
		$orderid = encrypt(trim($qrcode1), 'D', trim($cfg['encryptcode']));
		if (!$orderid) {
			message("抱歉，编码错误0x001");
		}
		$openid = $_W['openid'] ? $_W['openid'] : $_GPC['openid_' . $_W['uniacid']];
		if (!$openid) {
			isetcookie('j_money_qrcode' . $_W['uniacid'], $orderid, 86400);
			$callback = urlencode($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=oauthcredit&m=j_money&qrcode=" . $qrcode);
			$forward = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $_W['account']['key'] . "&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
			header('location:' . $forward);
		}
		$fans = pdo_fetch("SELECT * FROM " . tablename('mc_mapping_fans') . " WHERE uniacid='{$_W['uniacid']}' and openid=:a ", array(":a" => $openid));
		if (!$fans || $fans['follow'] == 0) {
			include $this->template('creditpage');
			die;
		}
		$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a and status=1", array(":a" => $orderid));
		if (!$trade) {
			message("抱歉，编码错误0x002");
		}
		if (TIMESTAMP - $trade['createtime'] > 86400 * 2) {
			message("抱歉，交易时间超过2天，无法获得奖励!");
			die;
		}
		$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE  id=:a ", array(":a" => $trade['groupid']));
		$credit = $shop['creadit'] ? $shop['creadit'] * $trade['total_fee'] : $cfg['creadit'] * $trade['total_fee'];
		if ($credit && $trade['credit'] == 0) {
			load()->model('mc');
			$uid = $fans['uid'];
			if (!$uid) {
				$uid = mc_update($openid, array('nickname' => $fansinfo['nickname']));
				if (!$uid) {
					message("系统异常，请联系管理员");
				}
			}
			mc_credit_update($uid, "credit1", $credit, array("", "收银台消费" . sprintf('%.2f', $trade['total_fee'] * 0.01) . "扫码获得积分,ID：" . $trade['id']));
			pdo_update("j_money_trade", array("credit" => $credit), array("id" => $trade['id']));
		}
		if ($trade['getmarketing'] || $trade['marketing']) {
			$market = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['marketing']));
			if ($market['favorabletype'] == 4) {
				$gstatus = pdo_fetchcolumn("SELECT status FROM " . tablename('j_money_lotterygame') . " WHERE id=:a ", array(":a" => $market['gid']));
				$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&id=" . $market['gid'] . "&do=game&m=j_money";
				header("Location:" . $url);
				die;
			}
			message("奖励不能重复领取哦", $cfg['creditbtn'], "error");
		}
		$marketlist = pdo_fetchall("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and groupid=:d and starttime<=:a and endtime>=:b and status=1 and favorabletype>1 and condition_fee<=:c order by displayorder asc,id desc", array(":a" => $trade['createtime'], ":b" => $trade['createtime'], ":c" => $trade['total_fee'], ":d" => $trade['groupid']));
		$markid = 0;
		load()->model('mc');
		$uid = mc_openid2uid($openid);
		$member = mc_fetch($uid);
		$u_groupid = $member['groupid'];
		$favorabletype = 0;
		if ($marketlist) {
			foreach ($marketlist as $row) {
				$flag = false;
				if ($markid) {
					break;
				}
				switch ($row['condition']) {
					case 1:
						$flag = true;
						break;
					case 2:
						$groupary = strpos($row['condition_member'], ",") ? explode(",", $row['condition_member']) : array($row['condition_member']);
						if (!in_array($u_groupid, $groupary)) {
							$flag = true;
						}
						break;
				}
				if (!$flag) {
					continue;
				}
				if ($row['num']) {
					$where = $row["isallnum"] ? "" : " and createtime>='" . strtotime(date("Y-m-d") . " 00:00") . "' and createtime<='" . strtotime(date("Y-m-d") . " 23:59") . "'";
					$hadfavorCount = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_reward') . " WHERE weid=:a and favorabletype=:b {$where}", array(":a" => $_W['uniacid'], ":b" => $row['favorabletype']));
					if ($hadfavorCount >= $row['num']) {
						continue;
					}
				}
				pdo_update("j_money_reward", array("favorabletype" => $row['favorabletype'], "favorable" => $row['favorable'], "marketid" => $row["id"], "marketing_log" => $row["description"]), array("out_trade_no" => $orderid));
				$table = "j_money_trade";
				pdo_update($table, array("marketing" => $row["id"], "marketing_log" => $row["description"], "market_favorable" => $row["favorable"]), array("id" => $trade['id']));
				$markid = $row['id'];
				$favorabletype = $row['favorabletype'];
				$favorable = $row['favorable'];
				switch ($row['favorabletype']) {
					case 2:
						if (strpos($favorable, "|#红包#|")) {
							$temp = str_replace("[|#红包#|", "", $favorable);
							$temp = str_replace("]", "", $temp);
							$favorAry = explode("-", $temp);
							$fee = 0;
							if (count($favorAry) == 2) {
								$favorAry1 = intval($favorAry[0] * 100);
								$favorAry2 = intval($favorAry[1] * 100);
								if ($favorAry1 >= $favorAry2) {
									$fee = $favorAry1;
								} else {
									$fee = mt_rand($favorAry1, $favorAry2);
								}
								if ($fee >= 100) {
									$this->_sendpack($openid, $orderid, $fee, $cfg);
								} else {
									$table = "j_money_trade";
									pdo_update($table, array("log" => "金额不足1元，不发送红包"), array("id" => $trade['id']));
								}
							}
						}
						break;
					case 3:
						if (strpos($favorable, "|#卡券#|")) {
							$temp = str_replace("[|#卡券#|", "", $favorable);
							$temp = str_replace("]", "", $temp);
							$favorAry = strpos($temp, ",") ? explode(",", $temp) : array($temp);
							shuffle($favorAry);
							$cardkey = $favorAry[0];
							$wxcard = json_decode($cfg['wxcard'], true);
							if ($wxcard[$cardkey]) {
								$cardArry = $this->getCardTicket($wxcard[$cardkey], $openid);
								$markid = $row['id'];
								$updateData = array('marketid' => $markid, 'favorabletype' => 3, 'favorable' => $row['favorable'], 'condition' => $row['condition'], 'reward' => $wxcard[$cardkey], 'status' => 0, 'gettype' => 1, 'log' => '获得卡券');
								pdo_update("j_money_reward", $updateData, array("out_trade_no" => $orderid));
							}
						}
						break;
					case 4:
						if (strpos($row['favorable'], "|#抽奖#|")) {
							$temp = str_replace("[|#抽奖#|", "", $favorable);
							$temp = str_replace("]", "", $temp);
							$favorAry = intval($temp);
							if ($favorAry) {
								$updateData = array('marketid' => $markid, 'favorabletype' => 4, 'condition' => $row['condition'], 'favorable' => $row['favorable'], 'reward' => $favorAry, 'status' => 1, 'gettype' => 1, 'log' => '获得' . $favorAry . '次抽奖机会');
								pdo_update("j_money_reward", $updateData, array("out_trade_no" => $orderid));
								$insert = array('weid' => $_W['uniacid'], 'gid' => $row['gid'], 'from_user' => $openid);
								for ($i = 0; $i < $favorAry; $i++) {
									pdo_insert("j_money_lottery", $insert);
								}
								$gstatus = pdo_fetchcolumn("SELECT status FROM " . tablename('j_money_lotterygame') . " WHERE id=:a ", array(":a" => $row['gid']));
								if ($gstatus == 1) {
									$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&id=" . $row['gid'] . "&do=game&m=j_money";
								}
							}
						}
						break;
					default:
						break;
				}
			}
		}
		pdo_update("j_money_trade", array("getmarketing" => 1), array("id" => $trade['id']));
		include $this->template('creditpage');
	}
	public function doMobileOauthlogin()
	{
		global $_W, $_GPC;
		$code = $_GPC['code'];
		$qrcode = intval($_GPC['qrcode']);
		$cfg = $this->module['config'];
		if (!empty($code)) {
			load()->func('communication');
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $_W['account']['key'] . "&secret=" . $_W['account']['secret'] . "&code={$code}&grant_type=authorization_code";
			$ret = ihttp_get($url);
			if (!is_error($ret)) {
				$auth = @json_decode($ret['content'], true);
				if (is_array($auth) && !empty($auth['openid'])) {
					$openid = $auth['openid'];

					$users = pdo_fetchall("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and openid=:a ", array(":a" => $openid));
					$list = pdo_fetchall('SELECT a.id as userid, a.useracount,a.realname,a.openid,b.id as shopid,b.companyname FROM '.tablename('j_money_user').' a left join '.tablename('j_money_group').' b on a.pcate=b.id WHERE a.weid=:weid and a.openid=:openid',array(':weid'=>$_W['uniacid'],':openid'=>$openid));
					if(count($users) > 1){
						
						$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=loginbyuserid&m=j_money&openid=" . $openid."&qrcode=".$qrcode;
						include $this->template('user-list');
						return;
					}else{
						$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=loginbyuserid&m=j_money&openid=" . $openid."&qrcode=".$qrcode."&userid=".$list[0]['userid'];
						$flag = 1;
						$companyname = $list[0]['companyname'];
						include $this->template('user-list');
						return;
					}
					$user = $users[0];
					if (!$user) {
						message("您没权使用本系统！");
					}
					if (!$user['login_pc']) {
						message("您的账号禁止在电脑端登录！");
					}
					$item = pdo_fetch("SELECT * FROM " . tablename('j_money_qrlogin') . " WHERE sncode=:a and status=0 and openid='' and userid='' ", array(':a' => $qrcode));
					if (!$item) {
						message("抱歉，该二维码已过期！");
					}
					if (TIMESTAMP - $item['createtime'] > 60 * 5) {
						message("抱歉，该二维码已过期！");
					}
					pdo_update('j_money_qrlogin', array("status" => 1, "openid" => $openid, "userid" => $user['id']), array("id" => $item['id']));
					message("登陆成功");
					die;
				} else {
					die('抱歉，微信授权失败');
				}
			} else {
				die('微信授权失败');
			}
		}
		die('微信授权失败');
	}

	public function doMobileLoginbyuserid(){
		global $_W, $_GPC;
		$userid = $_GPC['userid'];
		$openid = $_GPC['openid'];
		$qrcode = $_GPC['qrcode'];
		$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and openid=:openid", array(":a" => $userid,':openid'=>$openid));
		if (!$user) {
			message("您没权使用本系统！");
		}
		if (!$user['login_pc']) {
			message("您的账号禁止在电脑端登录！");
		}
		$item = pdo_fetch("SELECT * FROM " . tablename('j_money_qrlogin') . " WHERE sncode=:a and status=0 and openid='' and userid='' ", array(':a' => $qrcode));
		if (!$item) {
			message("抱歉，该二维码已过期！");
		}
		if (TIMESTAMP - $item['createtime'] > 60 * 5) {
			message("抱歉，该二维码已过期！");
		}
		pdo_update('j_money_qrlogin', array("status" => 1, "openid" => $openid, "userid" => $user['id']), array("id" => $item['id']));
		message("登陆成功",'success');
	}

	public function doMobileLogin()
	{
		global $_W, $_GPC;
		$qrcode = strval($_GPC['qrcode']);
		$reply = pdo_fetchcolumn("SELECT * FROM " . tablename('account_wechats') . " WHERE uniacid=:a ", array(':a' => $_W['uniacid']));
		$callback = urlencode($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=oauthlogin&m=j_money&qrcode=" . $qrcode);
		$forward = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $_W['account']['key'] . "&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
		header('location:' . $forward);
		die;
	}
	public function doMobileGame()
	{
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		if (empty($id)) {
			message('活动已经删除！');
		}
		$item = pdo_fetch("SELECT * FROM " . tablename('j_money_lotterygame') . " WHERE id =:id ", array(':id' => $id));
		if (empty($item)) {
			message('活动已经删除！');
		}
		$openid = $_W['openid'] ? $_W['openid'] : $_GPC['from_user_oauth'];
		$cfg = $this->module['config'];
		if (empty($openid)) {
			$callback = urlencode($_W['siteroot'] . 'app' . str_replace("./", "/", $this->createMobileurl('oauth', array('id' => $id))));
			$forward = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $cfg['appid'] . "&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
			header('location:' . $forward);
		}
		$isfollow = pdo_fetchcolumn("SELECT follow FROM " . tablename('mc_mapping_fans') . " WHERE openid =:openid ", array(":openid" => $openid));
		if (!$isfollow) {
			message("请先关注我们的公众号哦", $item['gzurl'], "error");
		}
		$prizelist = pdo_fetchall("SELECT * FROM " . tablename('j_money_award') . " WHERE gid =:id and isprize=1 order by id desc", array(':id' => $id));
		$prizeary = array();
		foreach ($prizelist as $row) {
			$prizeary[$row['id']] = $row['level'];
		}
		$isGetPrize = pdo_fetchall("SELECT * FROM " . tablename('j_money_lottery') . " WHERE gid =:id and from_user=:f and isprize=1 order by id asc", array(':id' => $id, ':f' => $openid));
		$flag = 1;
		$gamecount = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_lottery') . " WHERE gid =:id and createtime=0", array(':id' => $id));
		if (!$gamecount) {
			$flag = 0;
		}
		include $this->template('game');
	}
	public function doMobileOauth()
	{
		global $_W, $_GPC;
		$code = $_GPC['code'];
		load()->func('communication');
		$id = intval($_GPC['id']);
		$cfg = $this->module['config'];
		if (!empty($code)) {
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $cfg['appid'] . "&secret=" . $cfg['secret'] . "&code={$code}&grant_type=authorization_code";
			$ret = ihttp_get($url);
			if (!is_error($ret)) {
				$auth = @json_decode($ret['content'], true);
				if (is_array($auth) && !empty($auth['openid'])) {
					$url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $auth['access_token'] . '&openid=' . $auth['openid'] . '&lang=zh_CN';
					$ret = ihttp_get($url);
					$auth = @json_decode($ret['content'], true);
					isetcookie('from_user_oauth', $auth['openid'], 86400);
					isetcookie('nickname', $auth['nickname'], 86400);
					isetcookie('headimgurl', $auth['headimgurl'], 86400);
					$forward = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=game&m=j_money&id=" . $id . "&wxref=mp.weixin.qq.com#wechat_redirect";
					header('location:' . $forward);
					die;
				} else {
					die('抱歉，微信授权失败');
				}
			} else {
				die('微信授权失败');
			}
		} else {
			$forward = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=game&m=j_money&id=" . $id . "&wxref=mp.weixin.qq.com#wechat_redirect";
			header('location: ' . $forward);
			die;
		}
	}
	public function doMobileShareoauth()
	{
		global $_W, $_GPC;
		$code = $_GPC['code'];
		load()->func('communication');
		$id = intval($_GPC['id']);
		$cfg = $this->module['config'];
		if (!empty($code)) {
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $cfg['appid'] . "&secret=" . $cfg['secret'] . "&code={$code}&grant_type=authorization_code";
			$ret = ihttp_get($url);
			if (!is_error($ret)) {
				$auth = @json_decode($ret['content'], true);
				if (is_array($auth) && !empty($auth['openid'])) {
					$url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $auth['access_token'] . '&openid=' . $auth['openid'] . '&lang=zh_CN';
					$ret = ihttp_get($url);
					$auth = @json_decode($ret['content'], true);
					isetcookie('from_user_oauth', $auth['openid'], 86400);
					isetcookie('nickname', $auth['nickname'], 86400);
					isetcookie('headimgurl', $auth['headimgurl'], 86400);
					$forward = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=share&m=j_money&id=" . $id . "&wxref=mp.weixin.qq.com#wechat_redirect";
					header('location:' . $forward);
					die;
				} else {
					die('抱歉，微信授权失败');
				}
			} else {
				die('微信授权失败');
			}
		} else {
			$forward = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=share&m=j_money&id=" . $id . "&wxref=mp.weixin.qq.com#wechat_redirect";
			header('location: ' . $forward);
			die;
		}
	}
	public function doMobileShare()
	{
		global $_W, $_GPC;
		$id = strval($_GPC['id']);
		if (!$id) {
			die;
		}
		$openid = $_W["openid"] ? $_W["openid"] : $_GPC["from_user_oauth"];
		$cfg = $this->module['config'];
		if (!$openid) {
			$callback = urlencode($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=shareoauth&m=j_money&id=" . $id);
			$forward = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $cfg['appid'] . "&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
			header('location:' . $forward);
			die;
		}
		$item = pdo_fetch("SELECT * FROM " . tablename('j_money_article') . " WHERE id =:id and weid=:a", array(':id' => $id, ':a' => $_W['uniacid']));
		if (!$item) {
			message("活动不存在或者已删除");
		}
		if (!$item['status']) {
			message("活动已关闭");
		}
		if (TIMESTAMP < $item['starttime']) {
			message("活动还没有开始哦，开始时间：" . date("Y-m-d H:i", $item['starttime']));
		}
		if (TIMESTAMP > $item['endtime']) {
			message("活动已在" . date("Y-m-d H:i", $item['starttime']) . "结束了哦");
		}
		pdo_update("j_money_article", array("viewcount" => $item['viewcount'] + 1), array("id" => $id));
		$cardArry = $this->getCardTicket($item['favorable'], $openid);
		include $this->template('share');
	}
	public function jetSumSoftpay($orderid = '')
	{
		global $_GPC, $_W;
		if (!$orderid) {
			return "订单号不能为空";
		}
		$cfg = $this->module['config'];
		$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
		if (!$trade || !$trade['status']) {
			return "订单异常";
		}
		$useropenid = pdo_fetchcolumn("SELECT openid FROM " . tablename('j_money_user') . " WHERE  id=:a ", array(":a" => $trade['userid']));
		$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE  id=:a ", array(":a" => $trade['groupid']));
		load()->func('communication');
		$temstr = urldecode($cfg['tempparama']);
		$tempstr = str_replace("|#单号#|", $trade['out_trade_no'], $temstr);
		$tempstr = str_replace("|#店铺#|", $shop['companyname'], $tempstr);
		$tempstr = str_replace("|#时间#|", date("y-m-d H:i", $trade['time_end']), $tempstr);
		$tempstr = str_replace("|#总金额#|", "￥" . sprintf('%.2f', $trade['total_fee'] / 100) . "元", $tempstr);
		$tempstr = str_replace("|#优惠金额#|", "￥" . sprintf('%.2f', $trade['coupon_fee'] / 100) . "元", $tempstr);
		$tempstr = str_replace("|#实付金额#|", "￥" . sprintf('%.2f', $trade['cash_fee'] / 100) . "元", $tempstr);
		$paytype = "微信";
		if ($trade['paytype'] == 1) {
			$paytype = "支付宝";
		} elseif ($trade['paytype'] == 2) {
			$paytype = "现金";
		} elseif ($trade['paytype'] == 3) {
			$paytype = "银行卡";
		} elseif ($trade['paytype'] == 4) {
			$paytype = "会员卡";
		}
		$tempstr = str_replace("|#支付方式#|", $paytype, $tempstr);
		$itemary = json_decode($tempstr, true);
		$temp = array();
		foreach ($itemary as $key => $val) {
			$temp[$key] = array("value" => $val['value'], "color" => $val['color'] ? $val['color'] : "#333333");
		}
		$temp['remark']["value"] = "详细收款情况请登录后台查看";
		$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		$acc = WeAccount::create($acid);
		if (TIMESTAMP - $trade['createtime'] < 60 * 60 * 12) {
			if ($useropenid) {
				$acc->sendTplNotice($useropenid, $cfg["tempid"], $temp, "", "#FF0000");
			}
			$userlist = pdo_fetchall("SELECT openid FROM " . tablename('j_money_user') . " WHERE  pcate=:a and permission>3 ", array(":a" => $trade['pcate']));
			if (count($userlist)) {
				foreach ($userlist as $row) {
					if ($row["openid"] == $useropenid) {
						continue;
					}
					$data = $acc->sendTplNotice($row["openid"], $cfg["tempid"], $temp, "", "#FF0000");
				}
			}
		}
		$creaditper = $shop['creadit'] ? $shop['creadit'] : $cfg['creadit'];
		$creadit = sprintf('%.2f', $creaditper * $trade["total_fee"]);
		$openid = "";
		if ($trade['paytype'] == 0) {
			$openid = $trade['sub_openid'] ? $trade['sub_openid'] : $trade['openid'];
		} elseif ($trade['paytype'] == 4) {
			$openid = pdo_fetchcolumn("SELECT openid FROM " . tablename('j_money_memebercard') . " WHERE  wxcardno=:a ", array(":a" => $trade['memberno']));
		}
		if ($creadit > 0 && $openid && $trade['credit'] == 0) {
			load()->model('mc');
			$uid = mc_openid2uid($openid);
			if ($uid) {
				$isget = mc_credit_update($uid, "credit1", $creadit, array("", "收银台消费￥" . sprintf('%.2f', $trade['cash_fee'] / 100) . "元获得积分,OrderID：" . $trade['out_trade_no']));
				if ($isget) {
					pdo_update("j_money_trade", array("credit" => $creadit), array("id" => $trade['id']));
				}
			}
		}
		if (!$trade['marketing']) {
			$marketlist = pdo_fetchall("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and groupid=:d and starttime<=:a and endtime>=:b and status=1 and favorabletype>1 and condition_fee<=:c order by displayorder asc,id desc", array(":a" => $trade['time_end'], ":b" => $trade['time_end'], ":c" => $trade['cash_fee'], ":d" => $user['pcate']));
			if (!count($marketlist) || !$marketlist) {
				goto sendtouser2;
			}
			$data = array("weid" => $_W['uniacid'], "out_trade_no" => $orderid, "createtime" => TIMESTAMP, "openid" => $openid);
			pdo_insert("j_money_reward", $data);
			$markid = 0;
			foreach ($marketlist as $row) {
				if ($markid) {
					break;
				}
				if ($row['num']) {
					$where = $row["isallnum"] ? "" : " and createtime>='" . strtotime(date("Y-m-d") . " 00:00") . "' and createtime<='" . strtotime(date("Y-m-d") . " 23:59") . "'";
					$hadfavorCount = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_reward') . " WHERE weid=:a and favorabletype=:b {$where}", array(":a" => $_W['uniacid'], ":b" => $row['favorabletype']));
					if ($hadfavorCount >= $row['num']) {
						continue;
					}
				}
				pdo_update("j_money_reward", array("favorabletype" => $row['favorabletype'], "favorable" => $row['favorable'], "marketid" => $row["id"], "marketing_log" => $row["description"]), array("out_trade_no" => $orderid));
				pdo_update("j_money_trade", array("marketing" => $row["id"], "marketing_log" => $row["description"]), array("id" => $trade['id']));
				$markid = $row['id'];
				$favorable = $row['favorable'];
				switch ($row['favorabletype']) {
					case 2:
						if (strpos($favorable, "|#红包#|")) {
							$temp = str_replace("[|#红包#|", "", $favorable);
							$temp = str_replace("]", "", $temp);
							$favorAry = explode("-", $temp);
							$fee = 0;
							if (count($favorAry) == 2) {
								$favorAry1 = intval($favorAry[0] * 100);
								$favorAry2 = intval($favorAry[1] * 100);
								if ($favorAry1 >= $favorAry2) {
									$fee = $favorAry1;
								} else {
									$fee = mt_rand($favorAry1, $favorAry2);
								}
								if ($fee >= 100) {
									$this->_sendpack($openid, $orderid, $fee, $cfg);
								} else {
									pdo_update("j_money_reward", array("favorabletype" => "2", "favorable" => $row['favorable'], 'condition' => $row['condition'], "reward" => $fee, "log" => "金额不足1元，不发送红包"), array("out_trade_no" => $orderid));
								}
							}
						}
						break;
					case 3:
						if (strpos($favorable, "|#卡券#|")) {
							$temp = str_replace("[|#卡券#|", "", $favorable);
							$temp = str_replace("]", "", $temp);
							$favorAry = strpos($temp, ",") ? explode(",", $temp) : array($temp);
							shuffle($favorAry);
							$cardkey = $favorAry[0];
							$wxcard = json_decode($cfg['wxcard'], true);
							if ($wxcard[$cardkey]) {
								$markid = $row['id'];
								$updateData = array('marketid' => $markid, 'favorabletype' => 3, 'favorable' => $row['favorable'], 'condition' => $row['condition'], 'reward' => $wxcard[$cardkey], 'status' => 0, 'gettype' => 1, 'log' => '获得卡券');
								pdo_update("j_money_reward", $updateData, array("out_trade_no" => $orderid));
								if ($trade['is_subscribe']) {
									$result = $this->sendCard($openid, $wxcard[$cardkey]);
									if ($result['errcode'] == 0) {
										pdo_update("j_money_reward", array("status" => 1, "completed" => 1, "gettype" => 0, "endtime" => TIMESTAMP), array("out_trade_no" => $orderid));
									}
								}
							}
						}
						break;
					case 4:
						if (strpos($row['favorable'], "|#抽奖#|")) {
							$temp = str_replace("[|#抽奖#|", "", $favorable);
							$temp = str_replace("]", "", $temp);
							$favorAry = intval($temp);
							if ($favorAry) {
								$markid = $row['id'];
								$updateData = array('marketid' => $markid, 'favorabletype' => 4, 'condition' => $row['condition'], 'favorable' => $row['favorable'], 'reward' => $favorAry, 'status' => 1, 'gettype' => 1, 'log' => '获得' . $favorAry . '次抽奖机会');
								pdo_update("j_money_reward", $updateData, array("out_trade_no" => $orderid));
								$insert = array('weid' => $_W['uniacid'], 'gid' => $row['gid'], 'from_user' => $openid);
								for ($i = 0; $i < $favorAry; $i++) {
									pdo_insert("j_money_lottery", $insert);
								}
							}
						}
						break;
				}
			}
		}
		sendtouser2:
		if ($openid && TIMESTAMP - $trade['createtime'] < 60 * 60 * 12) {
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $orderid));
			$tempstr = "";
			$temstr1 = urldecode($cfg['tempparama']);
			$tempstr = str_replace("|#单号#|", $trade['out_trade_no'], $temstr1);
			$tempstr = str_replace("|#店铺#|", $shop['companyname'], $tempstr);
			$tempstr = str_replace("|#时间#|", date("y-m-d H:i", $trade['time_end']), $tempstr);
			$tempstr = str_replace("|#总金额#|", "￥" . sprintf('%.2f', $trade['total_fee'] / 100) . "元", $tempstr);
			$tempstr = str_replace("|#优惠金额#|", "￥" . sprintf('%.2f', $trade['coupon_fee'] / 100) . "元", $tempstr);
			$tempstr = str_replace("|#实付金额#|", "￥" . sprintf('%.2f', $trade['cash_fee'] / 100) . "元", $tempstr);
			$tempstr = str_replace("|#支付方式#|", $trade['paytype'] ? "会员卡" : "微信", $tempstr);
			if ($trade['marketing']) {
				$marking = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE id=:a ", array(":a" => $trade['marketing']));
				if ($marking['description']) {
					$tempstr = str_replace("|#优惠#|", $marking['description'], $tempstr);
				}
			}
			$tempstr = str_replace("|#优惠#|", '', $tempstr);
			$itemary = json_decode($tempstr, true);
			$temp = array();
			foreach ($itemary as $key => $val) {
				$temp[$key] = array("value" => $val['value'], "color" => $val['color'] ? $val['color'] : "#333333");
			}
			$url = $cfg["tempurl"];
			if ($marking['favorabletype'] == 4) {
				$gamestatus = pdo_fetchcolumn("SELECT status FROM " . tablename('j_money_lotterygame') . " WHERE id=:a ", array(":a" => $marking['gid']));
				if ($gamestatus == 1) {
					$temp['remark']["value"] = "您获得抽奖机会哦，请点击本详情进入抽奖";
					$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&id=" . $marking['gid'] . "&do=game&m=j_money";
				}
			}
			$acc = WeAccount::create($acid);
			$data = $acc->sendTplNotice($openid, $cfg["tempid"], $temp, $url, "#FF0000");
			$result = json_decode($data, true);
			if ($result['errcode'] != 0) {
				pdo_update("j_money_trade", array("log" => $data), array("out_trade_no" => $orderid));
			}
		}
		return $openid . $data;
	}
	public function doWebMember()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		if ($operation == "display") {
			$where = "";
			if ($_GPC['groupid']) {
				$where .= " and pcate='" . $_GPC['groupid'] . "' ";
			}
			if ($_GPC['keyword']) {
				$where .= " and (useracount like '%" . $_GPC['keyword'] . "%' or realname like '%" . $_GPC['keyword'] . "%' or mobile like '%" . $_GPC['keyword'] . "%' )";
			}
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' {$where} order by id desc");
			$grouplist = pdo_fetchall("SELECT * FROM " . tablename("j_money_group") . " WHERE weid = '" . $_W['uniacid'] . "' ORDER BY id asc");
			$groupary = array();
			foreach ($grouplist as $row) {
				$groupary[$row['id']] = $row['companyname'];
			}
		} elseif ($operation == 'post') {
			$id = $_GPC['id'];
			if ($id) {
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE id = :id ", array(':id' => $id));
			} else {
				if ($cfg['usernum']) {
					$allgroup = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}'");
					if ($allgroup >= $cfg['usernum']) {
						message("只能添加" . $cfg['usernum'] . "个坐席，增加请联系服务商");
					}
				}
			}
		

			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' order by id desc");
			if (checksubmit('submit')) {
				$data = array('useracount' => $_GPC['useracount'], 'weid' => $_W['uniacid'], 'realname' => $_GPC['realname'], 'openid' => $_GPC['openid'], 'mobile' => $_GPC['mobile'], 'password' => $_GPC['password'] ? md5($_GPC['password']) : '', 'login_pc' => intval($_GPC['login_pc']), 'login_m' => intval($_GPC['login_m']), 'status' => intval($_GPC['status']), 'pcate' => intval($_GPC['pcate']), 'permission' => intval($_GPC['permission']));
				$data["printerid"]=$_GPC["printerid"];
				if (!$data['pcate']) {
					message("请选择所属店铺");
				}
				if ($id) {
					if (!$data['password']) {
						unset($data['password']);
					}
					unset($data['useracount']);
					pdo_update("j_money_user", $data, array("id" => $id));
				} else {
					if ($cfg['usernum']) {
						$allgroup = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}'");
						if ($allgroup >= $cfg['usernum']) {
							message("只能添加" . $cfg['usernum'] . "个坐席，增加请联系服务商");
						}
					}
					$isUsed = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' and useracount=:a", array(":a" => $data['useracount']));
					if ($isUsed) {
						message("【" . $data['useracount'] . "】已经被使用，请更换其他工号");
					}
					$data['createtime'] = TIMESTAMP;
					pdo_insert("j_money_user", $data);
					$id = pdo_insertid();
				}
				message("修改完成", $this->createWebUrl('member', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				pdo_delete('j_money_user', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('member'), 'success');
		}
		include $this->template('member');
	}
	public function doWebMsgmanage()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		if (!$_W["isfounder"]) {
			message("本功能仅开放给管理员");
		}
		if ($operation == "display") {
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' order by id desc ");
			$user = pdo_fetchall("SELECT id,pcate FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
			$userList = array();
			foreach ($user as $row) {
				if (!isset($userList[$row['pcate']])) {
					$userList[$row['pcate']] = array();
				}
				$userList[$row['pcate']][] = $row['id'];
			}
		}
		include $this->template('msgmanage');
	}
	public function doWebGroup()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		if ($operation == "display") {
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' order by id desc ");
			$user = pdo_fetchall("SELECT pcate FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
			$userList = array();
			foreach ($user as $row) {
				if (!isset($userList[$row['pcate']])) {
					$userList[$row['pcate']] = 0;
				}
				$userList[$row['pcate']] = intval($userList[$row['pcate']]) + 1;
			}
		} elseif ($operation == 'post') {
			$id = $_GPC['id'];
			if ($id) {
				$category = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));
				/*配置*/
				$serverTypes=empty($category["servertypes"])?array():json_decode($category["servertypes"]);
				
			} else {
				if ($cfg['groupnum']) {
					$allgroup = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}'");
					if ($allgroup >= $cfg['groupnum']) {
						message("只能添加" . $cfg['groupnum'] . "个店铺，增加请联系服务商");
					}
				}
			}
			$groupdiscount = strlen($category['memberdiscount']) > 5 ? json_decode($category['memberdiscount'], true) : array();
			load()->model('mc');
			$grouplist = mc_groups();
			if (checksubmit('submit')) {
			    $apipay=0;
			    if(isset($_GPC['apipay']))
			        $apipay=1;
			    
			   // 'appid' => trim($_GPC['appid']);
			    
				$data = array('weid' => $_W['uniacid'], 'logo' => trim($_GPC['logo']), 'bg' => trim($_GPC['bg']), 'companyname' => $_GPC['companyname'], 'description' => $_GPC['description'], 'appid' => trim($_GPC['appid']), 'apipay' => $apipay,'app_id' => trim($_GPC['app_id']),"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'], 'sys_service_provider_id' => trim($_GPC['sys_service_provider_id']), 'sub_appid' => trim($_GPC['sub_appid']), 'sub_mch_id' => trim($_GPC['sub_mch_id']), 'appsecret' => trim($_GPC['appsecret']), 'pay_name' => $_GPC['pay_name'], 'pay_mchid' => $_GPC['pay_mchid'], 'pay_signkey' => $_GPC['pay_signkey'], 'app_id' => trim($_GPC['app_id']), 'pay_signkey' => $_GPC['pay_signkey'], 'needtable' => intval($_GPC['needtable']), 'refunder' => trim($_GPC['refunder']), 'tempid' => trim($_GPC['tempid']), 'tempid2' => trim($_GPC['tempid2']), 'tempurl' => trim($_GPC['tempurl']), 'qrcode' => trim($_GPC['qrcode']), 'creadit' => trim($_GPC['creadit']), 'creditbtn' => trim($_GPC['creditbtn']), 'printpagewidth' => trim($_GPC['printpagewidth']), 'printnum' => trim($_GPC['printnum']), 'payreceipt' => intval($_GPC['payreceipt']), 'couponreceipt' => intval($_GPC['couponreceipt']), 'wxcardid' => trim($_GPC['wxcardid']), 'info' => htmlspecialchars_decode($_GPC['info']), 'alipay_key' => trim($_GPC['alipay_key']), "alipay_store_id" => $_GPC['alipay_store_id'], 'alipay_cert' => trim($_GPC['alipay_cert']), 'appauthtoken' => trim($_GPC['appauthtoken']));
				
				
				$data["freelimit"]=trim($_GPC["freelimit"]);
				$data["servermoney"]=trim($_GPC["servermoney"]);
				
				/*配置*/
				
				$serverTypes=$_GPC["serverTypes"];
				$data["servertypes"]=json_encode($serverTypes);
				/*配置*/
				
				$data["transferUrl"]=trim($_GPC["transferUrl"]);
				$data["successUrl"]=trim($_GPC["successUrl"]);
				
				
				$data["infoshow"]=trim($_GPC["infoshow"]);
				$data["zfbbaner1"]=trim($_GPC["zfbbaner1"]);
				$data["zfbbaner2"]=trim($_GPC["zfbbaner2"]);
				$data["zfbbaner3"]=trim($_GPC["zfbbaner3"]);
				$data["zfblogo"]=trim($_GPC["zfblogo"]);
				$data["logotitle"]=trim($_GPC["logotitle"]);
				$data["zfblogox"]=trim($_GPC["zfblogox"]);
				$data["logomes"]=trim($_GPC["logomes"]);
				
				
				if ($_GPC['gid']) {
					$memberdiscount = array();
					foreach ($_GPC['gid'] as $index => $row) {
						$memberdiscount[$index] = $row;
					}
				}
				$data['memberdiscount'] = json_encode($memberdiscount);
				if (!$id) {
					if ($cfg['groupnum']) {
						$allgroup = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}'");
						if ($allgroup >= $cfg['groupnum']) {
							message("只能添加" . $cfg['groupnum'] . "个店铺，增加请联系服务商");
						}
					}
					$isUsed = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' and companyname=:a", array(":a" => $data['companyname']));
					if ($isUsed) {
						message("【" . $data['companyname'] . "】已经被使用");
					}
					pdo_insert("j_money_group", $data);
					$id = pdo_insertid();
				}
				if (!$category['qrlink']) {
					$data['qrlink'] = trueUrl2Shorturl($_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&do=ayard&m=j_money&shopid=" . $id);
				}
				load()->func('file');
				$dir_url = '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/" . $id . "/";
				mkdirs($dir_url);
				if ($_FILES["apiclient_cert"]["name"]) {
					if (file_exists($dir_url . "apiclient_cert.pem")) {
						@unlink($dir_url . "apiclient_cert.pem");
					}
					$data['apiclient_cert'] = "apiclient_cert.pem";
					move_uploaded_file($_FILES["apiclient_cert"]["tmp_name"], $dir_url . "apiclient_cert.pem");
				}
				if ($_FILES["apiclient_key"]["name"]) {
					if (file_exists($dir_url . "apiclient_key.pem")) {
						@unlink($dir_url . "apiclient_key.pem");
					}
					$data['apiclient_key'] = "apiclient_key.pem";
					move_uploaded_file($_FILES["apiclient_key"]["tmp_name"], $dir_url . "apiclient_key.pem");
				}
				pdo_update("j_money_group", $data, array("id" => $id));
				message("修改完成", $this->createWebUrl('group', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'updatecard') {
			$id = $_GPC['id'];
			$memberid = pdo_fetchcolumn("SELECT wxcardid FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));
			if (!$memberid) {
				message("请先填写会员卡的ID");
			}
			load()->func('communication');
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$tokens = $acc->fetch_token();
			$url = "https://api.weixin.qq.com/card/update?access_token=" . $tokens;
			$data = array("card_id" => $memberid, "member_card" => array("base_info" => array("code_type" => "CODE_TYPE_BARCODE", "pay_info" => array("swipe_card" => array("is_swipe_card" => true)))));
			$content = ihttp_post($url, json_encode($data));
			$result = @json_decode($content['content'], true);
			if ($result['errcode']) {
				message("错误提示：" . $result['errmsg']);
			}
			if ($result['send_check']) {
				message("申请成功,内容需要微信审核", $this->createWebUrl('group', array('op' => 'post', 'id' => $id)), 'error');
			} else {
				message("申请成功", $this->createWebUrl('group', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'updatecard2') {
			$id = $_GPC['id'];
			$memberid = pdo_fetchcolumn("SELECT wxcardid FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));
			if (!$memberid) {
				message("请先填写会员卡的ID");
			}
			load()->func('communication');
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$tokens = $acc->fetch_token();
			$url = "https://api.weixin.qq.com/card/update?access_token=" . $tokens;
			$data = array("card_id" => $memberid, "member_card" => array("supply_balance" => true, "custom_field1" => array("name_type" => "FIELD_NAME_TYPE_LEVEL", "url" => "")));
			$content = ihttp_post($url, json_encode($data));
			$result = @json_decode($content['content'], true);
			if ($result['errcode']) {
				message("错误提示：" . $result['errmsg']);
			}
			if ($result['send_check']) {
				message("申请成功,内容需要微信审核", $this->createWebUrl('group', array('op' => 'post', 'id' => $id)), 'error');
			} else {
				message("申请成功", $this->createWebUrl('group', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'download') {
			$id = $_GPC['id'];
			if (!$id) {
				message("id不能为空");
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));
		} elseif ($operation == 'dodownload') {
			$id = $_GPC['id'];
			if (!$id) {
				die(json_encode(array("success" => false, "msg" => "id不能为空")));
			}
			$date = date("Ymd", strtotime($_GPC['date']));
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));
			$pageparama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "mch_id" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "device_info" => "web", "sign_type" => "MD5", "nonce_str" => getNonceStr(), "bill_date" => $date, "bill_type" => "ALL");
			$pay_signkey = $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'];
			$sign = MakeSign($pageparama, $pay_signkey);
			$pageparama['sign'] = $sign;
			$xml = ToXml($pageparama);
			$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/downloadbill", 10);
			$result = explode("\n", $response);
			unset($result[0]);
			$temp = "INSERT INTO " . tablename('j_money_statements') . " (`weid`,`groupid`,`createdate`,`createtime`,`trade_time`,`appid`,`mch_id`,`sub_mch_id`,`device_info`,`transaction_id`,`out_trade_no`,`openid`,`trade_type`,`status`,`bank_type`,`fee_type`,`total_fee`,`repack_fee`,`refund_id`,`out_refund_no`,`refund_fee`,`repack_refund_fee`,`refund_fee_type`,`refund_status`,`good_tital`,`attech`,`poundage`,`rate`) VALUES ";
			$sqlAry = array();
			foreach ($result as $row) {
				if ($row == "") {
					continue;
				}
				if (strpos($row, "总交易单数") > -1) {
					break;
				}
				$tmp = explode(",", $row);
				if (count($tmp) < 20) {
					continue;
				}
				$tmp1 = array($_W['uniacid'], $shop['id'], "'" . date("Y-m-d", strtotime($date)) . "'", TIMESTAMP);
				foreach ($tmp as $row2) {
					$tmp1[] = "'" . str_replace("`", "", $row2) . "'";
				}
				$sqlAry[] = "(" . implode(",", $tmp1) . ")";
			}
			if (count($sqlAry) == 0) {
				die(json_encode(array("success" => true)));
			}
			$sql = $temp . implode(",", $sqlAry);
			pdo_run($sql);
			pdo_run("delete from " . tablename('j_money_statements') . " where id not in (select maxid from (select max(id) as maxid from " . tablename('j_money_statements') . " group by out_trade_no) b);");
			die(json_encode(array("success" => true)));
		} elseif ($operation == 'dotrade') {
			$id = $_GPC['id'];
			if (!$id) {
				message("id不能为空");
			}
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));
			pdo_run("update " . tablename('j_money_trade') . " set ischeck=1 where out_trade_no in(SELECT out_trade_no FROM " . tablename('j_money_statements') . "  as b WHERE b.groupid='" . $id . "' and b.ischeck=0 ) and ischeck=0 ");
			pdo_run("update " . tablename('j_money_statements') . " set ischeck=1 where out_trade_no in(SELECT out_trade_no FROM " . tablename('j_money_trade') . " WHERE groupid='" . $id . "' ) and ischeck=0 ");
			message("下载成功", $this->createWebUrl('group'), 'success');
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				$isUsed = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' and pcate=:a", array(":a" => $id));
				if ($isUsed) {
					message("该店铺下还有人员，不能直接删除！");
				}
				pdo_delete('j_money_group', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('group'), 'success');
		} elseif ($operation == 'printer') { // Mango
			
			include_once 'include/web/group_printer.php';
		} elseif($operation=="cexchange")
		{
			$id=intval($_GPC["shopid"]);
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));
			if(empty($shop)) message("店铺不存在");
			$data=empty($shop["jfconfig"])?array():unserialize($shop["jfconfig"]);
			
			$url=$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=cexchange&m=j_money&shopid=".$id;
 			$templist=pdo_fetchall("select * from ".tablename("j_money_print")." where weid=:weid and groupid=:groupid ",array(
 				":weid"=>$_W["weid"],
 				":groupid"=>$id,
 			));
			
			if($_W["ispost"])
			{
				$data=$_GPC["data"];
				if(empty($data["printerid"])) message("请选择使用的打印机");
				if(empty($data["printertem"])) message("请选择使用的打印小票");
				if(empty($data["creditsnum"])) message("请配置对应积分");
				$updata=array(
					"jfconfig"=>serialize($data),
				);
				$result=pdo_update("j_money_group",$updata,array("id"=>$id));
				$result?message("配置成功","refresh","success"):message("配置不成功");
			}	
			include $this->template('cexchange'); die();
		}
		include $this->template('category');
	}
	public function doWebPrint()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$shopid = $_GPC['shopid'];
		$shoplist = pdo_fetchall("SELECT id,companyname FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' order by id desc");
		$shopAry = array();
		foreach ($shoplist as $row) {
			$shopAry[$row['id']] = $row['companyname'];
		}
		if ($operation == "display") {
			$where = $shopid ? " and groupid ='" . $shopid . "' " : "";
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_print') . " WHERE weid = '{$_W['uniacid']}' {$where} order by id desc");
			if (checksubmit('submit')) {
				$id = $_GPC['id'];
				if (!$id) {
					message("请选择要导入的模板内容");
				}
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_print') . " WHERE weid = '{$_W['uniacid']}' and id = :id ", array(':id' => $id));
				if (!$item) {
					message("请选择要导入的模板内容");
				}
				if (!$_FILES["printtxt"]["name"]) {
					message("请选择要导入的文件");
				}
				load()->func('file');
				$dir_url = IA_ROOT . '/attachment/j_money/temp/' . $_W['uniacid'] . "/";
				mkdirs($dir_url);
				if (file_exists($dir_url . "print.txt")) {
					@unlink($dir_url . "print.txt");
				}
				$filename = "print.txt";
				$a = move_uploaded_file($_FILES["printtxt"]["tmp_name"], $dir_url . $filename);
				$txt = file_get_contents($dir_url . $filename);
				pdo_update("j_money_print", array("content" => $txt), array("id" => $id));
				message("导入完成", $this->createWebUrl('print', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'output') {
			$id = $_GPC['id'];
			if (!$id) {
				message("请选择要导出的模板内容");
			}
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_print') . " WHERE weid = '{$_W['uniacid']}' and id = :id ", array(':id' => $id));
			if (!$item) {
				message("请选择要导出的模板内容");
			}
			header("Content-type:application/octet-stream ");
			header("Accept-Ranges:bytes");
			header("Content-Disposition:attachment;filename=" . $item['title'] . ".txt ");
			header("Expires:0 ");
			header("Cache-Control:must-revalidate,post-check=0,pre-check=0 ");
			header("Pragma:public");
			echo $item['content'];
			die;
		} elseif ($operation == 'input') {
		} elseif ($operation == 'post') {
			$id = $_GPC['id'];
			if ($id) {
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_print') . " WHERE id = :id ", array(':id' => $id));
			}
			if (checksubmit('submit')) {
				$content = htmlspecialchars_decode($_GPC['content']);
				$data = array('content' => $content, 'weid' => $_W['uniacid'], 'title' => $_GPC['title'], 'groupid' => intval($_GPC['groupid']), 'pcate' => intval($_GPC['pcate']), 'qrcode' => trim($_GPC['qrcode']));
				if ($id) {
					pdo_update("j_money_print", $data, array("id" => $id));
				} else {
					pdo_insert("j_money_print", $data);
					$id = pdo_insertid();
				}
				message("修改完成", $this->createWebUrl('print', array('op' => 'post', 'id' => $id)), 'success');
			}
			include $this->template('print-edit');
			die;
		} elseif ($operation == 'isdefault') {
			$id = intval($_GPC['id']);
			if ($id) {
				$item = pdo_fetchcolumn("SELECT * FROM " . tablename('j_money_print') . " WHERE id = :id ", array(':id' => $id));
				pdo_update("j_money_print", array("isdefault" => 0), array("weid" => $_W['uniacid'], "pcate" => $item["pcate"], "groupid" => $item["groupid"]));
				pdo_update("j_money_print", array("isdefault" => 1), array("id" => $id));
			}
			message("修改完成", $this->createWebUrl('print'), 'success');
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				pdo_delete('j_money_print', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('print'), 'success');
		}
		include $this->template('print');
	}
	public function doWebArtcle()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == "display") {
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_article') . " WHERE weid = '{$_W['uniacid']}' order by id desc");
		} elseif ($operation == 'post') {
			$id = $_GPC['id'];
			if ($id) {
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_article') . " WHERE id = :id ", array(':id' => $id));
			} else {
				$item = array("starttime" => strtotime(date("Y-m-d H:i")), "endtime" => strtotime(date("Y-m-d H:i")));
			}
			if (checksubmit('submit')) {
				$data = array('weid' => $_W['uniacid'], 'title' => $_GPC['title'], 'status' => $_GPC['status'], 'description' => strval($_GPC['description']), 'thumb' => $_GPC['thumb'], 'prizetype' => $_GPC['prizetype'], 'favorable' => $_GPC['favorable'], 'starttime' => strtotime($_GPC['gametime']['start']), 'endtime' => strtotime($_GPC['gametime']['end']), 'content' => htmlspecialchars_decode($_GPC['content']), 'favorable' => $_GPC['favorable']);
				if ($id) {
					pdo_update("j_money_article", $data, array("id" => $id));
				} else {
					$data['createtime'] = TIMESTAMP;
					pdo_insert("j_money_article", $data);
					$id = pdo_insertid();
				}
				message("修改完成", $this->createWebUrl('artcle', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				pdo_delete('j_money_article', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('artcle'), 'success');
		}
		include $this->template('article');
	}
	public function doWebCard()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == "display") {
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_card') . " WHERE weid = '{$_W['uniacid']}' order by id desc");
		} elseif ($operation == 'post') {
			$id = $_GPC['id'];
			if ($id) {
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_card') . " WHERE id = :id ", array(':id' => $id));
			}
			if (checksubmit('submit')) {
				$data = array('weid' => $_W['uniacid'], 'title' => $_GPC['title'], 'cardid' => $_GPC['cardid'], 'description' => strval($_GPC['description']));
				if ($id) {
					pdo_update("j_money_card", $data, array("id" => $id));
				} else {
					$ishad = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_card') . " WHERE cardid = :a ", array(':a' => $data['cardid']));
					if ($ishad) {
						message("该卡券已经存在，不能重复添加！");
					}
					pdo_insert("j_money_card", $data);
					$id = pdo_insertid();
				}
				message("修改完成", $this->createWebUrl('card', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				pdo_delete('j_money_card', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('card'), 'success');
		}
		include $this->template('card');
	}
	public function doWebFunction()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if (!pdo_fieldexists('mc_groups', 'orderlist')) {
			pdo_query("ALTER TABLE " . tablename('mc_groups') . " ADD `orderlist` int(10) DEFAULT '0' NOT NULL;");
		}
		if ($operation == "display") {
			$where = '';
			if ($_GPC['groupid']) {
				$where .= " and groupid='" . $_GPC['groupid'] . "' ";
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) - 1 : 0;
			$psize = 20;
			$start = $pindex * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' {$where} order by groupid asc, status desc,displayorder asc,id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_marketing') . " WHERE weid='" . $_W['uniacid'] . "' {$where} ");
			$pager = pagination($total, $pindex, $psize);
			$grouplist = pdo_fetchall("SELECT * FROM " . tablename("j_money_group") . " WHERE weid = '" . $_W['uniacid'] . "' ORDER BY id asc");
			$groupary = array();
			foreach ($grouplist as $row) {
				$groupary[$row['id']] = $row['companyname'];
			}
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
			if ($id) {
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(':a' => $id));
			}
			$item['starttime'] = $item['starttime'] ? $item['starttime'] : TIMESTAMP;
			$item['endtime'] = $item['endtime'] ? $item['endtime'] : TIMESTAMP;
			$hourlist = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23);
			$group = pdo_fetchall("SELECT * FROM " . tablename("j_money_group") . " WHERE weid = '" . $_W['uniacid'] . "' ORDER BY id asc");
			$grouplist = pdo_fetchall("SELECT * FROM " . tablename("mc_groups") . " WHERE uniacid = '" . $_W['uniacid'] . "' ORDER BY `orderlist` asc");
			$groupary = array();
			$groupary2 = array();
			foreach ($grouplist as $row) {
				$groupary2[] = $row['groupid'];
				$groupary[$row['groupid']] = $row['title'];
			}
			$gamelist = pdo_fetchall("SELECT * FROM " . tablename('j_money_lotterygame') . " WHERE weid='{$_W['uniacid']}' and status=1 order by id desc ");
			$cfg = $this->module['config'];
			if (checksubmit('submit')) {
				$data = array('displayorder' => intval($_GPC['displayorder']), 'weid' => $_W['uniacid'], 'groupid' => intval($_GPC['groupid']), 'status' => intval($_GPC['status']), 'isint' => intval($_GPC['isint']), 'title' => $_GPC['title'], 'starttime' => strtotime($_GPC['gametime']['start']), 'endtime' => strtotime($_GPC['gametime']['end']), 'hour' => implode(",", $_GPC['hour']), 'num' => intval($_GPC['num']), 'favorabletype' => intval($_GPC['favorabletype']), 'gid' => intval($_GPC['gid']), 'condition_fee' => intval($_GPC['condition_fee'] * 100), 'favorable' => $_GPC['favorable'], 'isallnum' => intval($_GPC['isallnum']), 'condition' => intval($_GPC['condition']), 'condition_attendtime' => intval($_GPC['condition_attendtime']), 'condition_member' => implode(",", $_GPC['condition_member']), 'description' => $_GPC['description']);
				if ($id) {
					unset($data['favorabletype']);
					pdo_update("j_money_marketing", $data, array("id" => $id));
				} else {
					pdo_insert("j_money_marketing", $data);
					$id = pdo_insertid();
				}
				message("修改完成", $this->createWebUrl('function'), 'success');
			}
		} elseif ($operation == 'statistical') {
			$id = intval($_GPC['id']);
			if ($id) {
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(':a' => $id));
			}
			$list = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE marketing=:a order by id desc", array(':a' => $id));
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				if (!$_W['isfounder']) {
					message('删除订单必须是管理员方能删除！');
				}
				pdo_delete('j_money_marketing', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('function'), 'success');
		}
		include $this->template('function');
	}
	public function doWebMembercard()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		if ($operation == "display") {
			$where = '';
			$groupid = $_GPC['groupid'];
			if ($groupid) {
				$where .= " and groupid='" . $groupid . "' ";
			}
			if ($_GPC["keyword"]) {
				$where .= " and (cardno like '%" . $_GPC["keyword"] . "%' or realname like '%" . $_GPC["keyword"] . "%' or mobile like '%" . $_GPC["keyword"] . "%' or wxcardno like '%" . $_GPC["keyword"] . "%' ) ";
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) - 1 : 0;
			$psize = 20;
			$start = $pindex * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' {$where} order by groupid asc,id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_memebercard') . " WHERE weid='" . $_W['uniacid'] . "' {$where} ");
			$pager = pagination($total, $pindex, $psize);
			$grouplist = pdo_fetchall("SELECT * FROM " . tablename("j_money_group") . " WHERE weid = '" . $_W['uniacid'] . "' ORDER BY id asc");
			$groupary = array();
			foreach ($grouplist as $row) {
				$groupary[$row['id']] = $row['companyname'];
			}
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
			if ($id) {
				$item = pdo_fetch("SELECT * FROM " . tablename('j_money_memebercard') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(':a' => $id));
			}
			if (checksubmit('submit')) {
				$data = array('displayorder' => intval($_GPC['displayorder']), 'weid' => $_W['uniacid'], 'groupid' => intval($_GPC['groupid']), 'status' => intval($_GPC['status']), 'isint' => intval($_GPC['isint']));
				if ($id) {
					unset($data['favorabletype']);
					pdo_update("j_money_memebercard", $data, array("id" => $id));
				}
				message("修改完成", $this->createWebUrl('membercard'), 'success');
			}
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				pdo_delete('j_money_memebercard', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('membercard'), 'success');
		}
		include $this->template('membercard');
	}
	public function doWebHistory()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == "display") {
			$where = $where2 = "";
			if ($_GPC['userid']) {
				$where2 .= " and userid='" . $_GPC['userid'] . "'";
			}
			$starttime = $_GPC["gametime"]["start"] ? $_GPC["gametime"]["start"] : date("Y-m-d H:i:s");
			$endtime = $_GPC["gametime"]["end"] ? $_GPC["gametime"]["end"] : date("Y-m-d H:i:s");
			$where .= " and createtime>='" . strtotime($starttime) . "' and createtime<='" . strtotime($endtime) . "' ";
			if ($_GPC['shopid']) {
				$where2 .= " and groupid='" . $_GPC['shopid'] . "' ";
			}
			if ($_GPC['paytype'] > -1) {
				$where2 .= " and paytype='" . ($_GPC['paytype'] - 1) . "' ";
			}
			if ($_GPC['status'] > -1) {
				$where2 .= " and status='" . ($_GPC['status'] - 1) . "' ";
			}
			if ($_GPC['keyword']) {
				$where2 .= " and (out_trade_no='" . $_GPC['keyword'] . "' or old_trade_no ='" . $_GPC['keyword'] . "')";
			}
			if ($_GPC['isexplode']) {
				$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} order by id desc ");
				$user = pdo_fetchall("SELECT * FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
				$grouplist = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' order by id asc ");
				$marklist = pdo_fetchall("SELECT id,description FROM " . tablename('j_money_marketing') . " WHERE weid = '{$_W['uniacid']}' order by id asc ");
				$userList = array();
				$groupids = array();
				$markary = array();
				foreach ($marklist as $row) {
					$markary[$row['id']] = $row['description'];
				}
				foreach ($grouplist as $row) {
					$groupids[$row['id']] = $row['companyname'];
				}
				foreach ($user as $row) {
					$userList[$row['id']]['name'] = $row['useracount'] . '(' . $row['realname'] . ')';
					$userList[$row['id']]['group'] = $groupids[$row['pcate']];
				}
				$tableheader = array('单号', '原单号', '时间', '支付方式', '收银员', '所在店铺', '订单金额', '优惠金额', '实际支付', '优惠方案', '状态', '备注');
				foreach ($parama as $index => $row) {
					array_push($tableheader, $index);
				}
				$html = "\xEF\xBB\xBF";
				foreach ($tableheader as $value) {
					$html .= $value . "\t ,";
				}
				$html .= "\n";
				foreach ($list as $row) {
					$html .= $row['out_trade_no'] . "\t ,";
					$html .= $row['old_trade_no'] . "\t ,";
					$html .= addslashes(date("Y-m-d H:i", $row['createtime'])) . "\t ,";
					$paytype = "";
					if ($row['paytype'] == 0) {
						$paytype = "微信";
					} elseif ($row['paytype'] == 1) {
						$paytype = "支付宝";
					} elseif ($row['paytype'] == 2) {
						$paytype = "现金";
					} elseif ($row['paytype'] == 3) {
						$paytype = "银行卡";
					} elseif ($row['paytype'] == 4) {
						$paytype = "会员卡";
					}
					$html .= $paytype . "\t ,";
					$html .= addslashes($userList[$row['userid']]['name']) . "\t ,";
					$html .= addslashes($userList[$row['userid']]['group']) . "\t ,";
					$html .= addslashes("￥" . sprintf('%.2f', $row['total_fee'] / 100)) . "\t ,";
					$html .= addslashes("￥" . sprintf('%.2f', $row['coupon_fee'] / 100)) . "\t ,";
					$html .= addslashes("￥" . sprintf('%.2f', $row['cash_fee'] / 100)) . "\t ,";
					$html .= addslashes($row['marketing_log']) . "\t ,";
					$html .= ($row['status'] ? $row['status'] == 1 ? "成功" : "已退款" : "失败") . "\t ,";
					$html .= addslashes($row['memberno']) . "\t ,";
					$html .= "\n";
				}
				header("Content-type:text/csv");
				header("Content-Disposition:attachment; filename=收银情况_" . TIMESTAMP . ".csv");
				echo $html;
				die;
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
			$psize = 10;
			$start = ($pindex - 1) * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}'  {$where} {$where2} order by id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " WHERE weid='" . $_W['uniacid'] . "' {$where} {$where2}");
			$pager = pagination($total, $pindex, $psize);
			$allItem = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} ");
			$payAry = array();
			$payAry['wechart']['all'] = 0;
			$payAry['wechart']['all-count'] = 0;
			$payAry['wechart']['coupon'] = 0;
			$payAry['wechart']['coupon-count'] = 0;
			$payAry['wechart']['fee'] = 0;
			$payAry['wechart']['fee-count'] = 0;
			$payAry['alipay']['all'] = 0;
			$payAry['alipay']['all-count'] = 0;
			$payAry['alipay']['coupon'] = 0;
			$payAry['alipay']['coupon-count'] = 0;
			$payAry['alipay']['fee'] = 0;
			$payAry['alipay']['fee-count'] = 0;
			foreach ($allItem as $row) {
				if ($row['status'] == 1) {
					if ($row['total_fee']) {
						if (!$row['paytype']) {
							$payAry['wechart']['all'] = $payAry['wechart']['all'] + $row['total_fee'];
							$payAry['wechart']['all-count'] = $payAry['wechart']['all-count'] + 1;
						} else {
							$payAry['alipay']['all'] = $payAry['alipay']['all'] + $row['total_fee'];
							$payAry['alipay']['all-count'] = $payAry['alipay']['all-count'] + 1;
						}
					}
					if ($row['coupon_fee']) {
						if (!$row['paytype']) {
							$payAry['wechart']['coupon'] = $payAry['wechart']['coupon'] + $row['coupon_fee'];
							$payAry['wechart']['coupon-count'] = $payAry['wechart']['coupon-count'] + 1;
						} else {
							$payAry['alipay']['coupon'] = $payAry['alipay']['coupon'] + $row['coupon_fee'];
							$payAry['alipay']['coupon-count'] = $payAry['alipay']['coupon-count'] + 1;
						}
					}
					if ($row['cash_fee']) {
						if (!$row['paytype']) {
							$payAry['wechart']['cash_fee'] = $payAry['wechart']['cash_fee'] + $row['cash_fee'];
							$payAry['wechart']['cash_fee-count'] = $payAry['wechart']['cash_fee-count'] + 1;
						} else {
							$payAry['alipay']['cash_fee'] = $payAry['alipay']['cash_fee'] + $row['cash_fee'];
							$payAry['alipay']['cash_fee-count'] = $payAry['alipay']['cash_fee-count'] + 1;
						}
					}
				}
			}
			$user = pdo_fetchall("SELECT id,useracount,realname,pcate FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
			$userList = array();
			$groupids = array();
			$grouplist = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' order by id asc ");
			foreach ($grouplist as $row) {
				$groupids[$row['id']] = $row['companyname'];
			}
			foreach ($user as $row) {
				$userList[$row['id']] = $groupids[$row['pcate']] . "-" . $row['useracount'] . '(' . $row['realname'] . ')';
			}
			$data = array("COUPON"=>"支付宝红包","ALIPAYACCOUNT"=>"支付宝余额","FINANCEACCOUNT"=>"余额宝","CFT" => "零钱包", "ICBC_DEBIT" => "工商银行(借记卡)", "ICBC_CREDIT" => "工商银行(信用卡)", "ABC_DEBIT" => "农业银行(借记卡)", "ABC_CREDIT" => "农业银行(信用卡)", "PSBC_DEBIT" => "邮政储蓄银行(借记卡)", "PSBC_CREDIT" => "邮政储蓄银行(信用卡)", "CCB_DEBIT" => "建设银行(借记卡)", "CCB_CREDIT" => "建设银行(信用卡)", "CMB_DEBIT" => "招商银行(借记卡)", "CMB_CREDIT" => "招商银行(信用卡)", "BOC_DEBIT" => "中国银行(借记卡)", "BOC_CREDIT" => "中国银行(信用卡)", "COMM_DEBIT" => "交通银行(借记卡)", "SPDB_DEBIT" => "浦发银行(借记卡)", "SPDB_CREDIT" => "浦发银行(信用卡)", "GDB_DEBIT" => "广发银行(借记卡)", "GDB_CREDIT" => "广发银行(信用卡)", "CMBC_DEBIT" => "民生银行(借记卡)", "CMBC_CREDIT" => "民生银行(信用卡)", "PAB_DEBIT" => "平安银行(借记卡)", "PAB_CREDIT" => "平安银行(信用卡)", "CEB_DEBIT" => "光大银行(借记卡)", "CEB_CREDIT" => "光大银行(信用卡)", "CIB_DEBIT" => "兴业银行(借记卡)", "CIB_CREDIT" => "兴业银行(信用卡)", "CITIC_DEBIT" => "中信银行(借记卡)", "CITIC_CREDIT" => "中信银行(信用卡)", "BOSH_DEBIT" => "上海银行(借记卡)", "BOSH_CREDIT" => "上海银行(信用卡)", "CRB_DEBIT" => "华润银行(借记卡)", "HZB_DEBIT" => "杭州银行(借记卡)", "HZB_CREDIT" => "杭州银行(信用卡)", "BSB_DEBIT" => "包商银行(借记卡)", "BSB_CREDIT" => "包商银行(信用卡)", "CQB_DEBIT" => "重庆银行(借记卡)", "SDEB_DEBIT" => "顺德农商行(借记卡)", "SZRCB_DEBIT" => "深圳农商银行(借记卡)", "HRBB_DEBIT" => "哈尔滨银行(借记卡)", "BOCD_DEBIT" => "成都银行(借记卡)", "GDNYB_DEBIT" => "南粤银行(借记卡)", "GDNYB_CREDIT" => "南粤银行(信用卡)", "GZCB_DEBIT" => "广州银行(借记卡)", "GZCB_CREDIT" => "广州银行(信用卡)", "JSB_DEBIT" => "江苏银行(借记卡)", "JSB_CREDIT" => "江苏银行(信用卡)", "NBCB_DEBIT" => "宁波银行(借记卡)", "NBCB_CREDIT" => "宁波银行(信用卡)", "NJCB_DEBIT" => "南京银行(借记卡)", "JZB_DEBIT" => "晋中银行(借记卡)", "KRCB_DEBIT" => "昆山农商(借记卡)", "LJB_DEBIT" => "龙江银行(借记卡)", "LNNX_DEBIT" => "辽宁农信(借记卡)", "LZB_DEBIT" => "兰州银行(借记卡)", "WRCB_DEBIT" => "无锡农商(借记卡)", "ZYB_DEBIT" => "中原银行(借记卡)", "ZJRCUB_DEBIT" => "浙江农信(借记卡)", "WZB_DEBIT" => "温州银行(借记卡)", "XAB_DEBIT" => "西安银行(借记卡)", "JXNXB_DEBIT" => "江西农信(借记卡)", "NCB_DEBIT" => "宁波通商银行(借记卡)", "NYCCB_DEBIT" => "南阳村镇银行(借记卡)", "NMGNX_DEBIT" => "内蒙古农信(借记卡)", "SXXH_DEBIT" => "陕西信合(借记卡)", "SRCB_CREDIT" => "上海农商银行(信用卡)", "SJB_DEBIT" => "盛京银行(借记卡)", "SDRCU_DEBIT" => "山东农信(借记卡)", "SRCB_DEBIT" => "上海农商银行(借记卡)", "SCNX_DEBIT" => "四川农信(借记卡)", "QLB_DEBIT" => "齐鲁银行(借记卡)", "QDCCB_DEBIT" => "青岛银行(借记卡)", "PZHCCB_DEBIT" => "攀枝花银行(借记卡)", "ZJTLCB_DEBIT" => "浙江泰隆银行(借记卡)", "TJBHB_DEBIT" => "天津滨海农商行(借记卡)", "WEB_DEBIT" => "微众银行(借记卡)", "YNRCCB_DEBIT" => "云南农信(借记卡)", "WFB_DEBIT" => "潍坊银行(借记卡)", "WHRC_DEBIT" => "武汉农商行(借记卡)", "ORDOSB_DEBIT" => "鄂尔多斯银行(借记卡)", "XJRCCB_DEBIT" => "新疆农信银行(借记卡)", "ORDOSB_CREDIT" => "鄂尔多斯银行(信用卡)", "CSRCB_DEBIT" => "常熟农商银行(借记卡)", "JSNX_DEBIT" => "江苏农商行(借记卡)", "GRCB_CREDIT" => "广州农商银行(信用卡)", "GLB_DEBIT" => "桂林银行(借记卡)", "GDRCU_DEBIT" => "广东农信银行(借记卡)", "GDHX_DEBIT" => "广东华兴银行(借记卡)", "FJNX_DEBIT" => "福建农信银行(借记卡)", "DYCCB_DEBIT" => "德阳银行(借记卡)", "DRCB_DEBIT" => "东莞农商行(借记卡)", "CZCB_DEBIT" => "稠州银行(借记卡)", "CZB_DEBIT" => "浙商银行(借记卡)", "CZB_CREDIT" => "浙商银行(信用卡)", "GRCB_DEBIT" => "广州农商银行(借记卡)", "CSCB_DEBIT" => "长沙银行(借记卡)", "CQRCB_DEBIT" => "重庆农商银行(借记卡)", "CBHB_DEBIT" => "渤海银行(借记卡)", "BOIMCB_DEBIT" => "内蒙古银行(借记卡)", "BOD_DEBIT" => "东莞银行(借记卡)", "BOD_CREDIT" => "东莞银行(信用卡)", "BOB_DEBIT" => "北京银行(借记卡)", "BNC_DEBIT" => "江西银行(借记卡)", "BJRCB_DEBIT" => "北京农商行(借记卡)", "AE_CREDIT" => "AE(信用卡)", "GYCB_CREDIT" => "贵阳银行(信用卡)", "JSHB_DEBIT" => "晋商银行(借记卡)", "JRCB_DEBIT" => "江阴农商行(借记卡)", "JNRCB_DEBIT" => "江南农商(借记卡)", "JLNX_DEBIT" => "吉林农信(借记卡)", "JLB_DEBIT" => "吉林银行(借记卡)", "JJCCB_DEBIT" => "九江银行(借记卡)", "HXB_DEBIT" => "华夏银行(借记卡)", "HXB_CREDIT" => "华夏银行(信用卡)", "HUNNX_DEBIT" => "湖南农信(借记卡)", "HSB_DEBIT" => "徽商银行(借记卡)", "HSBC_DEBIT" => "恒生银行(借记卡)", "HRXJB_DEBIT" => "华融湘江银行(借记卡)", "HNNX_DEBIT" => "河南农信(借记卡)", "HKBEA_DEBIT" => "东亚银行(借记卡)", "HEBNX_DEBIT" => "河北农信(借记卡)", "HBNX_DEBIT" => "湖北农信(借记卡)", "HBNX_CREDIT" => "湖北农信(信用卡)", "GYCB_DEBIT" => "贵阳银行(借记卡)", "GSNX_DEBIT" => "甘肃农信(借记卡)", "JCB_CREDIT" => "JCB(信用卡)", "MASTERCARD_CREDIT" => "MASTERCARD(信用卡)", "VISA_CREDIT" => "VISA(信用卡)");
		} elseif ($operation == 'post') {
			$where = $where2 = "";
			$where .= " and a.paytype=0 ";
			if ($_GPC['shopid']) {
				$where2 .= " and a.groupid='" . $_GPC['shopid'] . "')";
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
			$psize = 10;
			$start = ($pindex - 1) * $psize;
			$list = pdo_fetchall("SELECT a.*,b.poundage,b.rate,(b.refund_status) as rstatus,(b.refund_fee) as rfee FROM " . tablename('j_money_trade') . " a LEFT JOIN " . tablename('j_money_statements') . " b ON a.out_trade_no=b.out_trade_no WHERE a.weid='{$_W['uniacid']}' {$where} {$where2} order by a.id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_trade') . " a LEFT JOIN " . tablename('j_money_statements') . " b ON a.out_trade_no=b.out_trade_no WHERE a.weid='{$_W['uniacid']}' {$where} {$where2}");
			$pager = pagination($total, $pindex, $psize);
		} elseif ($operation == 'update') {
			if (checksubmit('submit')) {
				$id_ary = $_GPC['select'];
				if (!count($id_ary)) {
					message("请选择要处理的订单");
				}
				$ids = implode(",", $id_ary);
				pdo_run("update " . tablename('j_money_trade') . " set `cash_fee`=`total_fee` WHERE id in(" . $ids . ")");
				message("修改", $this->createWebUrl('history', array("op" => "update")), 'success');
			}
			$user = pdo_fetchall("SELECT id,useracount,realname,pcate FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
			$userList = array();
			$groupids = array();
			$grouplist = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' order by id asc ");
			foreach ($grouplist as $row) {
				$groupids[$row['id']] = $row['companyname'];
			}
			foreach ($user as $row) {
				$userList[$row['id']] = $groupids[$row['pcate']] . "-" . $row['useracount'] . '(' . $row['realname'] . ')';
			}
			$time1 = strtotime("2016-08-08 00:00:00");
			$time2 = strtotime("2016-08-09 00:00:00");
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and coupon_fee>0 and total_fee<>cash_fee and createtime>=" . $time1 . " and createtime<=" . $time2);
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				if (!$_W['isfounder']) {
					message('删除订单必须是管理员方能删除！');
				}
				pdo_delete('j_money_trade', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('history'), 'success');
		}
		include $this->template('history');
	}
	public function doWebCharge()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == "display") {
			$where = $where2 = "";
			if ($_GPC['userid']) {
				$where2 .= " and userid='" . $_GPC['userid'] . "'";
			}
			$starttime = $_GPC["search"]["start"] ? $_GPC["search"]["start"] . " 00:00:00" : date("Y-m-d") . " 00:00:00";
			$endtime = $_GPC["search"]["end"] ? $_GPC["search"]["end"] . " 23:59:59" : date("Y-m-d") . " 23:59:59";
			$where .= " and createtime>='" . strtotime($starttime) . "' and createtime<='" . strtotime($endtime) . "' ";
			if ($_GPC['shopid']) {
				$where2 .= " and groupid='" . $_GPC['shopid'] . "' ";
			}
			if ($_GPC['paytype'] > -1) {
				$where2 .= " and paytype='" . ($_GPC['paytype'] - 1) . "' ";
			}
			if ($_GPC['status'] > -1) {
				$where2 .= " and status='" . ($_GPC['status'] - 1) . "' ";
			}
			if ($_GPC['keyword']) {
				$where2 .= " and (out_trade_no='" . $_GPC['keyword'] . "' or old_trade_no ='" . $_GPC['keyword'] . "')";
			}
			if ($_GPC['isexplode']) {
				$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_recharge') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} order by id desc ");
				$user = pdo_fetchall("SELECT * FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
				$grouplist = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' order by id asc ");
				$userList = array();
				$groupids = array();
				foreach ($grouplist as $row) {
					$groupids[$row['id']] = $row['companyname'];
				}
				foreach ($user as $row) {
					$userList[$row['id']]['name'] = $row['useracount'] . '(' . $row['realname'] . ')';
					$userList[$row['id']]['group'] = $groupids[$row['pcate']];
				}
				$tableheader = array('单号', '时间', '卡号', '支付方式', '收银员', '所在店铺', '订单金额', '状态');
				foreach ($parama as $index => $row) {
					array_push($tableheader, $index);
				}
				$html = "\xEF\xBB\xBF";
				foreach ($tableheader as $value) {
					$html .= $value . "\t ,";
				}
				$html .= "\n";
				$payTypeAry = array("0" => "现金", "1" => "微信", "2" => "支付宝");
				foreach ($list as $row) {
					$html .= $row['out_trade_no'] . "\t ,";
					$html .= addslashes(date("Y-m-d H:i", $row['createtime'])) . "\t ,";
					$html .= addslashes($row['cardno']) . "\t ,";
					$html .= addslashes($payTypeAry[$row['paytype']]) . "\t ,";
					$html .= addslashes($userList[$row['userid']]['name']) . "\t ,";
					$html .= addslashes($userList[$row['userid']]['group']) . "\t ,";
					$html .= addslashes("￥" . sprintf('%.2f', $row['cash'] / 100)) . "\t ,";
					$html .= ($row['status'] ? $row['status'] == 1 ? "成功" : "已退款" : "失败") . "\t ,";
					$html .= "\n";
				}
				header("Content-type:text/csv");
				header("Content-Disposition:attachment; filename=充值_" . TIMESTAMP . ".csv");
				echo $html;
				die;
			}
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
			$psize = 10;
			$start = ($pindex - 1) * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_recharge') . " WHERE weid='{$_W['uniacid']}'  {$where} {$where2} order by id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_recharge') . " WHERE weid='" . $_W['uniacid'] . "' {$where} {$where2}");
			$pager = pagination($total, $pindex, $psize);
			$allItem = pdo_fetchall("SELECT * FROM " . tablename('j_money_recharge') . " WHERE weid='{$_W['uniacid']}' {$where} {$where2} ");
			$payAry = array();
			$payAry['wechart']['all'] = 0;
			$payAry['wechart']['all-count'] = 0;
			$payAry['wechart']['coupon'] = 0;
			$payAry['wechart']['coupon-count'] = 0;
			$payAry['wechart']['fee'] = 0;
			$payAry['wechart']['fee-count'] = 0;
			$payAry['alipay']['all'] = 0;
			$payAry['alipay']['all-count'] = 0;
			$payAry['alipay']['coupon'] = 0;
			$payAry['alipay']['coupon-count'] = 0;
			$payAry['alipay']['fee'] = 0;
			$payAry['alipay']['fee-count'] = 0;
			foreach ($allItem as $row) {
				if ($row['status'] == 1) {
					if ($row['total_fee']) {
						if (!$row['paytype']) {
							$payAry['wechart']['all'] = $payAry['wechart']['all'] + $row['total_fee'];
							$payAry['wechart']['all-count'] = $payAry['wechart']['all-count'] + 1;
						} else {
							$payAry['alipay']['all'] = $payAry['alipay']['all'] + $row['total_fee'];
							$payAry['alipay']['all-count'] = $payAry['alipay']['all-count'] + 1;
						}
					}
					if ($row['coupon_fee']) {
						if (!$row['paytype']) {
							$payAry['wechart']['coupon'] = $payAry['wechart']['coupon'] + $row['coupon_fee'];
							$payAry['wechart']['coupon-count'] = $payAry['wechart']['coupon-count'] + 1;
						} else {
							$payAry['alipay']['coupon'] = $payAry['alipay']['coupon'] + $row['coupon_fee'];
							$payAry['alipay']['coupon-count'] = $payAry['alipay']['coupon-count'] + 1;
						}
					}
					if ($row['cash_fee']) {
						if (!$row['paytype']) {
							$payAry['wechart']['cash_fee'] = $payAry['wechart']['cash_fee'] + $row['cash_fee'];
							$payAry['wechart']['cash_fee-count'] = $payAry['wechart']['cash_fee-count'] + 1;
						} else {
							$payAry['alipay']['cash_fee'] = $payAry['alipay']['cash_fee'] + $row['cash_fee'];
							$payAry['alipay']['cash_fee-count'] = $payAry['alipay']['cash_fee-count'] + 1;
						}
					}
				}
			}
			$user = pdo_fetchall("SELECT id,useracount,realname,pcate FROM " . tablename('j_money_user') . " WHERE weid = '{$_W['uniacid']}' order by id desc ");
			$userList = array();
			$groupids = array();
			$grouplist = pdo_fetchall("SELECT * FROM " . tablename('j_money_group') . " WHERE weid = '{$_W['uniacid']}' order by id asc ");
			foreach ($grouplist as $row) {
				$groupids[$row['id']] = $row['companyname'];
			}
			foreach ($user as $row) {
				$userList[$row['id']] = $groupids[$row['pcate']] . "-" . $row['useracount'] . '(' . $row['realname'] . ')';
			}
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				if (!$_W['isfounder']) {
					message('删除订单必须是管理员方能删除！');
				}
				pdo_delete('j_money_recharge', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('charge'), 'success');
		}
		include $this->template('charge');
	}
	public function doWebWajax()
	{
		global $_GPC, $_W;
		if (!$_W['isajax']) {
			die(json_encode(array('success' => false, 'msg' => "错误！")));
		}
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		$cfg = $this->module['config'];
		if ($operation == "cheackwechatpay") {
			load()->func('communication');
			$id = $_GPC["id"];
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $id));
			$orderid = $trade['out_trade_no'];
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['groupid']));
			$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "outTradeNo" => strval(date("YmdHis")), "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
			$pageparama = array("appid" => $payParama['appid'], "mch_id" => strval($payParama['pay_mchid']), "out_trade_no" => $orderid, "nonce_str" => getNonceStr());
			if ($payParama['sub_appid']) {
				$pageparama['sub_appid'] = $payParama['sub_appid'];
			}
			if ($payParama['sub_mch_id']) {
				$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
			}
			$sign = MakeSign($pageparama, $payParama['pay_signkey']);
			$pageparama['sign'] = $sign;
			$xml = ToXml($pageparama);
			$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/orderquery", 10);
			$result = FromXml($response);
			if ($result['trade_state'] == 'SUCCESS') {
				$insertInfo = array("openid" => $result['openid'], "is_subscribe" => $result['is_subscribe'] == "Y" ? 1 : 0, "sub_openid" => isset($result['sub_openid']) ? $result['sub_openid'] : "", "sub_is_subscribe" => isset($result['sub_is_subscribe']) && $result['sub_is_subscribe'] == "Y" ? 1 : 0, "trade_type" => $result['trade_type'], "bank_type" => $result['bank_type'], "fee_type" => $result['CNY'], "cash_fee" => $result['cash_fee'], "transaction_id" => $result['transaction_id'], "time_end" => strtotime($result['time_end']), "isconfirm" => 1, "status" => 1);
				if ($result['total_fee'] == $trade['total_fee'] && $result['coupon_fee'] && $result['coupon_count']) {
					$insertInfo['cash_fee'] = $result['total_fee'];
				}
				pdo_update("j_money_trade", $insertInfo, array("id" => $trade['id']));
				if ($trade['status'] == 0) {
					$this->jetSumpay($orderid);
				}
				die(json_encode(array("success" => true, "paystatus" => true)));
			}
			die(json_encode(array("success" => false, "msg" => $result['trade_state_desc'] . $result['err_code_des'])));
		} elseif ($operation == "cheackalipay") {
			load()->func('communication');
			$id = $_GPC["id"];
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $id));
			$orderid = $trade["out_trade_no"];
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['groupid']));
			$payParama = array("outTradeNo" => $orderid, "app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
			require_once '../addons/j_money/F2fpay.php';
			$cfg = $this->module['config'];
			$f2fpay = new F2fpay();
			$response = $f2fpay->query($orderid, $payParama);
			$results = @json_decode(json_encode($response), true);
			$result = $results['alipay_trade_query_response'];
			if ($result['code'] == 10003) {
				pdo_update("j_money_trade", array("log" => "等待客户支付密码"), array("out_trade_no" => $orderid));
				die(json_encode(array("success" => true, "msg" => "等待客户支付密码")));
			} elseif ($result['code'] == 10000) {
				if ($result['trade_status'] == "TRADE_SUCCESS") {
					$insertdata = array("status" => 1, "isconfirm" => 1, "transaction_id" => $result['trade_no'], "cash_fee" => intval($result['receipt_amount'] * 100), "time_end" => strtotime($result['gmt_payment']));
					pdo_update("j_money_trade", $insertdata, array("out_trade_no" => $orderid));
					if ($trade["status"] == 0) {
						$this->jetSumpay($orderid);
					}
					$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a", array(":a" => $orderid));
					die(json_encode(array("success" => true, "items" => $trade)));
				} elseif ($result['trade_status'] == "TRADE_CLOSED") {
					die(json_encode(array("success" => false, "msg" => "订单已退款或关闭")));
				} elseif ($result['trade_status'] == "WAIT_BUYER_PAY") {
					die(json_encode(array("success" => false, "msg" => "等待客户付款")));
				} else {
					die(json_encode(array("success" => false, "msg" => "订单已完结")));
				}
			} else {
				pdo_update("j_money_trade", array("log" => "收款失败：" . $result['sub_msg']), array("id" => $trade['id']));
				die(json_encode(array("success" => false, "msg" => $result['sub_msg'])));
			}
			die(json_encode(array("success" => false, "msg" => "未知错误！")));
		} elseif ($operation == "checkpay") {
			$id = $_GPC["id"];
			$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_recharge') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $id));
			$orderid = $trade["out_trade_no"];
			$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE weid='{$_W['uniacid']}' and id=:a ", array(":a" => $trade['groupid']));
			load()->func('communication');
			if ($trade['paytype'] == 2) {
				$payParama = array("appid" => $shop['appid'] ? $shop['appid'] : $cfg['appid'], "pay_mchid" => strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']), "pay_signkey" => $shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'], "outTradeNo" => strval(date("YmdHis")), "pay_ip" => $shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'], "sub_appid" => $shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'], "sub_mch_id" => $shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id']);
				$pageparama = array("appid" => $payParama['appid'], "mch_id" => strval($payParama['pay_mchid']), "out_trade_no" => $orderid, "nonce_str" => getNonceStr());
				if ($payParama['sub_appid']) {
					$pageparama['sub_appid'] = $payParama['sub_appid'];
				}
				if ($payParama['sub_mch_id']) {
					$pageparama['sub_mch_id'] = $payParama['sub_mch_id'];
				}
				$sign = MakeSign($pageparama, $payParama['pay_signkey']);
				$pageparama['sign'] = $sign;
				$xml = ToXml($pageparama);
				$response = postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/orderquery", 10);
				$result = FromXml($response);
				if ($result['trade_state'] == 'SUCCESS') {
					$insertInfo = array("status" => 1);
					if ($result['total_fee'] == $trade['total_fee'] && $result['coupon_fee'] && $result['coupon_count']) {
						$insertInfo['cash_fee'] = $result['total_fee'];
					}
					pdo_update("j_money_recharge", $insertInfo, array("id" => $trade['id']));
					die(json_encode(array("success" => true, "paystatus" => true)));
				}
				die(json_encode(array("success" => false, "msg" => $result['trade_state_desc'] . $result['err_code_des'])));
			} elseif ($trade['paytype'] == 3) {
				$payParama = array("outTradeNo" => $orderid, "app_id" => $shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],"sys_service_provider_id" => $shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'],"app_auth_token" => $shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'], "appauthtoken" => $shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'], "alipay_cert" => $shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'], "alipay_key" => $shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'], "alipay_store_id" => $shop['alipay_store_id']);
				require_once '../addons/j_money/F2fpay.php';
				$cfg = $this->module['config'];
				$f2fpay = new F2fpay();
				$response = $f2fpay->query($orderid, $payParama);
				$results = @json_decode(json_encode($response), true);
				$result = $results['alipay_trade_query_response'];
				if ($result['code'] == 10003) {
					die(json_encode(array("success" => true, "msg" => "等待客户支付密码")));
				} elseif ($result['code'] == 10000) {
					if ($result['trade_status'] == "TRADE_SUCCESS") {
						$insertdata = array("status" => 1);
						pdo_update("j_money_recharge", $insertdata, array("out_trade_no" => $orderid));
						die(json_encode(array("success" => true, "items" => $trade)));
					} elseif ($result['trade_status'] == "TRADE_CLOSED") {
						die(json_encode(array("success" => false, "msg" => "订单已退款或关闭")));
					} elseif ($result['trade_status'] == "WAIT_BUYER_PAY") {
						die(json_encode(array("success" => false, "msg" => "等待客户付款")));
					} else {
						die(json_encode(array("success" => false, "msg" => "订单已完结")));
					}
				} else {
					die(json_encode(array("success" => false, "msg" => $result['sub_msg'])));
				}
				die(json_encode(array("success" => false, "msg" => "未知错误！")));
			}
		}
	}
	public function doWebStatistical()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == "display") {
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) - 1 : 0;
			$psize = 20;
			$start = $pindex * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' order by status desc,displayorder asc,id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_marketing') . " WHERE weid='" . $_W['uniacid'] . "'  ");
			$pager = pagination($total, $pindex, $psize);
		}
	}
	public function doWebLottery()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == "display") {
			$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
			$psize = 10;
			$start = ($pindex - 1) * $psize;
			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_lotterygame') . " WHERE weid='{$_W['uniacid']}' order by id desc LIMIT " . $start . "," . $psize);
			$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_lotterygame') . " WHERE weid='" . $_W['uniacid'] . "' ");
			$pager = pagination($total, $pindex, $psize);
			$prizelist = array();
			$list2 = pdo_fetchall("SELECT * FROM " . tablename('j_money_award') . " WHERE weid='{$_W['uniacid']}' and isprize=1 order by id asc");
			foreach ($list2 as $row) {
				$prizelist[$row['gid']][] = $row;
			}
		} elseif ($operation == 'post') {
			$id = $_GPC['id'];
			if ($id) {
				$reply = pdo_fetch("SELECT * FROM " . tablename('j_money_lotterygame') . " WHERE id = :id ", array(':id' => $id));
				$list = pdo_fetchall("SELECT * FROM " . tablename("j_money_award") . " WHERE gid = :gid ORDER BY `id` asc", array(':gid' => $id));
			}
			$reply['zppic'] = $reply['zppic'] ? $reply['zppic'] : '../addons/j_money/template/img/6prize.png';
			$reply['thumb_pointer'] = $reply['thumb_pointer'] ? $reply['thumb_pointer'] : '../addons/j_money/template/img/pointer.gif';
			if (checksubmit('submit')) {
				$insert = array('weid' => $_W['uniacid'], 'thumb' => $_GPC['thumb'], 'clientpic' => $_GPC['clientpic'], 'pointer' => $_GPC['pointer'], 'description' => $_GPC['description'], 'title' => $_GPC['title'], 'zppic' => $_GPC['zppic'], 'rule' => htmlspecialchars_decode($_GPC['rule']), 'starttime' => strtotime($_GPC['acttime']['start']), 'endtime' => strtotime($_GPC['acttime']['end']), 'status' => intval($_GPC['status']), 'gzurl' => strval($_GPC['gzurl']), 'sharedes' => strval($_GPC['sharedes']), 'thumb_bg' => strval($_GPC['thumb_bg']), 'thumb_pointer' => strval($_GPC['thumb_pointer']), 'bgcolor' => strval($_GPC['bgcolor']));
				if ($id) {
					pdo_update("j_money_lotterygame", $insert, array("id" => $id));
					foreach ($_GPC['award-level'] as $index => $row) {
						$data = array('level' => $_GPC['award-level'][$index], 'title' => $_GPC['award-title'][$index], 'total' => $_GPC['award-total'][$index], 'renum' => $_GPC['award-renum'][$index], 'description' => $_GPC['award-description'][$index], 'thumb' => $_GPC['award-thumb'][$index], 'credit' => intval($_GPC['award-credit'][$index]), 'isprize' => intval($_GPC['award-isprize'][$index]), 'leavel' => intval($_GPC['award-leavel'][$index]), 'probalilty' => $_GPC['award-probalilty'][$index], 'deg' => $_GPC['award-deg'][$index]);
						pdo_update('j_money_award', $data, array('id' => $index));
					}
				} else {
					$insert['status'] = 1;
					pdo_insert("j_money_lotterygame", $insert);
					$id = pdo_insertid();
					foreach ($_GPC['award-level-new'] as $index => $row) {
						$data = array('gid' => $id, 'weid' => $_W['uniacid'], 'level' => $_GPC['award-level-new'][$index], 'leavel' => intval($_GPC['award-leavel-new'][$index]), 'thumb' => $_GPC['award-thumb-new'][$index], 'credit' => intval($_GPC['award-credit-new'][$index]), 'title' => $_GPC['award-title-new'][$index], 'description' => $_GPC['award-description-new'][$index], 'isprize' => intval($_GPC['award-isprize-new'][$index]), 'total' => $_GPC['award-total-new'][$index], 'renum' => $_GPC['award-total-new'][$index], 'probalilty' => $_GPC['award-probalilty-new'][$index], 'deg' => $_GPC['award-deg-new'][$index]);
						pdo_insert('j_money_award', $data);
					}
				}
				message("修改完成", $this->createWebUrl('lottery', array('op' => 'post', 'id' => $id)), 'success');
			}
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			if ($id) {
				pdo_delete('j_money_award', array('gid' => $id));
				pdo_delete('j_money_lotterygame', array('id' => $id));
			}
			message("删除成功", $this->createWebUrl('lottery'), 'success');
		}
		include $this->template('lottery');
	}
	public function doWebJoiner()
	{
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if (checksubmit('getprize')) {
			pdo_query("update " . tablename('j_money_lottery') . " set status=1,gettime='" . TIMESTAMP . "' where id  IN  ('" . implode("','", $_GPC['select']) . "')");
			message('标记成功！', $this->createWebUrl('joiner', array('id' => $id, 'page' => $_GPC['page'])));
		}
		if (!empty($_GPC['wid'])) {
			$wid = intval($_GPC['wid']);
			pdo_update('j_money_lottery', array('status' => intval($_GPC['status']), 'gettime' => TIMESTAMP), array('id' => $wid));
			message('标识成功！', $this->createWebUrl('joiner', array('id' => $id, 'page' => $_GPC['page'])));
		}
		if ($operation == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 50;
			$where = "";
			if ($_GPC['prizeid']) {
				$where .= " and aid = '" . $_GPC['prizeid'] . "' ";
			}
			if ($_GPC['sncode']) {
				$where .= " and sncode = '" . $_GPC['sncode'] . "' ";
			}
			$item = pdo_fetch("SELECT * FROM " . tablename('j_money_lotterygame') . " WHERE id = '{$id}' limit 1");
			$prizelist = pdo_fetchall("SELECT * FROM " . tablename('j_money_award') . " WHERE gid = '{$id}' and isprize=1 order by id asc");
			$sql = "SELECT * FROM " . tablename('j_money_lottery') . "  WHERE gid = '{$id}' and weid='{$_W['uniacid']}' and isprize=1 {$where} order by id desc LIMIT " . ($pindex - 1) * $psize . ",{$psize}";
			$list = pdo_fetchall($sql);
			if (!empty($list)) {
				$total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('j_money_lottery') . " WHERE gid = '{$id}' and isprize=1 and weid='{$_W['uniacid']}' {$where}");
				$pager = pagination($total, $pindex, $psize);
			}
			$alljoin = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('j_money_lottery') . "  WHERE gid = '{$id}' and weid='{$_W['uniacid']}' and aid>0");
		}
		include $this->template('joiner');
	}
	public function _sendpack($openid, $orderid = 0, $fee = 0, $cfg = array())
	{
		global $_W;
		if ($fee < 100) {
			return false;
		}
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		$pars = array();
		$pars['nonce_str'] = random(32);
		$pars['mch_billno'] = $cfg['mchid'] . date('YmdHis') . rand(1000, 9999);
		$pars['mch_id'] = $cfg['pay_mchid'];
		$pars['wxappid'] = $cfg['appid'];
		$pars['send_name'] = $cfg['pay_name'];
		$pars['re_openid'] = $openid;
		$pars['total_amount'] = $fee;
		$pars['total_num'] = 1;
		$pars['wishing'] = "微信支付，便捷生活";
		$pars['client_ip'] = $cfg['pay_ip'];
		$pars['act_name'] = $cfg['pay_name'];
		$pars['remark'] = $cfg['pay_name'];
		ksort($pars, SORT_STRING);
		$string1 = '';
		foreach ($pars as $k => $v) {
			$string1 .= "{$k}={$v}&";
		}
		$string1 .= "key=" . $cfg['pay_signkey'];
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);
		$extras = array();
		$extras['CURLOPT_CAINFO'] = IA_ROOT . '/attachment/j_money/cert_2/' . $_W['uniacid'] . '/' . $cfg['rootca'];
		$extras['CURLOPT_SSLCERT'] = IA_ROOT . '/attachment/j_money/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_cert'];
		$extras['CURLOPT_SSLKEY'] = IA_ROOT . '/attachment/j_money/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_key'];
		$procResult = null;
		load()->func('communication');
		$resp = ihttp_request($url, $xml, $extras);
		if (is_error($resp)) {
			$procResult = $resp;
		} else {
			$arr = json_decode(json_encode((array) simplexml_load_string($resp['content'])), true);
			$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
			$dom = new \DOMDocument();
			if ($dom->loadXML($xml)) {
				$xpath = new \DOMXPath($dom);
				$code = $xpath->evaluate('string(//xml/return_code)');
				$ret = $xpath->evaluate('string(//xml/result_code)');
				if (strtolower($code) == 'success' && strtolower($ret) == 'success') {
					$procResult = array('errno' => 0, 'error' => 'success');
				} else {
					$error = $xpath->evaluate('string(//xml/err_code_des)');
					$procResult = array('errno' => -2, 'error' => $error);
				}
			} else {
				$procResult = array('errno' => -1, 'error' => '未知错误');
			}
		}
		$rec = array();
		$rec['log'] = $error;
		$rec['reward'] = $fee;
		$rec['completed'] = $rec['status'] = $procResult['errno'] != 0 ? $procResult['errno'] : 1;
		if ($rec['completed'] == 1) {
			$rec['endtime'] = TIMESTAMP;
		}
		pdo_update('j_money_reward', $rec, array('out_trade_no' => $orderid));
		return $procResult;
	}
	public function _sendpack2($openid, $fee = 0, $cfg = array())
	{
		global $_W;
		if ($fee < 100) {
			return false;
		}
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		$pars = array();
		$pars['nonce_str'] = random(32);
		$pars['mch_billno'] = $cfg['mchid'] . date('YmdHis') . rand(1000, 9999);
		$pars['mch_id'] = $cfg['pay_mchid'];
		$pars['wxappid'] = $cfg['appid'];
		$pars['send_name'] = $cfg['pay_name'];
		$pars['re_openid'] = $openid;
		$pars['total_amount'] = $fee;
		$pars['total_num'] = 1;
		$pars['wishing'] = "微信支付，便捷生活";
		$pars['client_ip'] = $cfg['pay_ip'];
		$pars['act_name'] = $cfg['pay_name'];
		$pars['remark'] = $cfg['pay_name'];
		ksort($pars, SORT_STRING);
		$string1 = '';
		foreach ($pars as $k => $v) {
			$string1 .= "{$k}={$v}&";
		}
		$string1 .= "key=" . $cfg['pay_signkey'];
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);
		$extras = array();
		$extras['CURLOPT_CAINFO'] = IA_ROOT . '/attachment/j_money/cert_2/' . $_W['uniacid'] . '/' . $cfg['rootca'];
		$extras['CURLOPT_SSLCERT'] = IA_ROOT . '/attachment/j_money/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_cert'];
		$extras['CURLOPT_SSLKEY'] = IA_ROOT . '/attachment/j_money/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_key'];
		$procResult = null;
		load()->func('communication');
		$resp = ihttp_request($url, $xml, $extras);
		if (is_error($resp)) {
			$procResult = $resp;
		} else {
			$arr = json_decode(json_encode((array) simplexml_load_string($resp['content'])), true);
			$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
			$dom = new \DOMDocument();
			if ($dom->loadXML($xml)) {
				$xpath = new \DOMXPath($dom);
				$code = $xpath->evaluate('string(//xml/return_code)');
				$ret = $xpath->evaluate('string(//xml/result_code)');
				if (strtolower($code) == 'success' && strtolower($ret) == 'success') {
					$procResult = array('errno' => 0, 'error' => 'success');
				} else {
					$error = $xpath->evaluate('string(//xml/err_code_des)');
					$procResult = array('errno' => -2, 'error' => $error);
				}
			} else {
				$procResult = array('errno' => -1, 'error' => '未知错误');
			}
		}
		return $procResult;
	}
	public function sendCard($openid, $cardid)
	{
		global $_W;
		if (strlen($cardid) < 5) {
			return false;
		}
		$acid = $_W['account']['acid'];
		if (!$acid) {
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		}
		$acc = WeAccount::create($acid);
		$ticket = $this->getCard();
		$pars['nonce_str'] = random(32);
		$pars['code'] = "";
		$pars['openid'] = $openid;
		$pars['timestamp'] = TIMESTAMP;
		$pars['signature'] = "";
		$string1 = $pars['timestamp'] . $pars['nonce_str'] . $pars['code'] . $ticket . $cardid;
		$pars['signature'] = sha1($string1);
		$sendata = array("card_id" => $cardid, "card_ext" => array("code" => $pars['code'], "openid" => $pars['openid'], "timestamp" => $pars['timestamp'], "signature" => $pars['signature']));
		$data = $acc->sendCustomNotice(array('touser' => $openid, 'msgtype' => 'wxcard', 'wxcard' => $sendata));
		return $data;
	}
	public function getCard()
	{
		global $_W;
		load()->func('cache');
		$wxcard = cache_load("wxcard");
		if (!$wxcard || $wxcard['extime'] < TIMESTAMP) {
			load()->func('communication');
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$tokens = $acc->fetch_token();
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $tokens . "&type=wx_card";
			$content = ihttp_get($url);
			if (is_error($content)) {
				return false;
			}
			$token = @json_decode($content['content'], true);
			if (empty($token) || !is_array($token)) {
				$errorinfo = substr($content['meta'], strpos($content['meta'], '{'));
				$errorinfo = @json_decode($errorinfo, true);
				return false;
			}
			$record = array();
			$record['ticket'] = $token['ticket'];
			$record['expire'] = TIMESTAMP + $token['expires_in'];
			cache_write("wxcard", array("ticket" => $record['ticket'], "expire" => $record['expire']));
			return $record['ticket'];
		}
		return $wxcard['ticket'];
	}
	public function __mobile($f_name)
	{
		global $_W, $_GPC;
		include_once 'include/mobile/' . strtolower(substr($f_name, 8)) . '.php';
	}
	public function __web($f_name)
	{
		global $_W, $_GPC;
		include_once 'include/web/' . strtolower(substr($f_name, 5)) . '.php';
	}
	public function getCardTicket($card_id, $openid)
	{
		global $_W, $_GPC;
		$data = pdo_fetch("SELECT * FROM " . tablename('j_money_cardticket') . " WHERE weid='" . $_W['uniacid'] . "' ");
		load()->func('communication');
		if ($data['createtime'] < time()) {
			$tokens = WeAccount::token();
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $tokens . "&type=wx_card";
			$res = json_decode($this->httpGet($url));
			$now = TIMESTAMP;
			$now = intval($now) + 7200;
			$ticket = $res->ticket;
			$insert = array('weid' => $_W['uniacid'], 'createtime' => $now, 'ticket' => $ticket);
			if (empty($data)) {
				pdo_insert('j_money_cardticket', $insert);
			} else {
				pdo_update('j_money_cardticket', $insert, array('id' => $data['id']));
			}
		} else {
			$ticket = $data['ticket'];
		}
		$now = time();
		$timestamp = $now;
		$nonceStr = getNonceStr();
		$card_id = $card_id;
		$openid = $openid;
		$string = "card_id={$card_id}&jsapi_ticket={$ticket}&noncestr={$nonceStr}{$openid}={$openid}&timestamp={$timestamp}";
		$arr = array($card_id, $ticket, $nonceStr, $openid, $timestamp);
		asort($arr, SORT_STRING);
		$sortString = "";
		foreach ($arr as $temp) {
			$sortString = $sortString . $temp;
		}
		$signature = sha1($sortString);
		$cardArry = array('code' => "", 'openid' => $openid, 'timestamp' => $now, 'signature' => $signature, 'cardId' => $card_id, 'ticket' => $ticket, 'nonceStr' => $nonceStr);
		return $cardArry;
	}
	private function httpGet($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		$res = curl_exec($curl);
		curl_close($curl);
		return $res;
	}
	private function httpPost($url, $post_data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_URL, $url);
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}
	public function MakeBankSign($config = array(), $paykey = "")
	{
		$tempary = array();
		foreach ($config as $index => $row) {
			$tempary[] = $index . "=" . $row;
		}
		$signStr = implode("&", $tempary) . "&" . $paykey;
		$sign = strtolower(md5($signStr));
		return $sign;
	}
	
	public function doWebTest() { // Mango TEST print
		global $_GPC, $_W;
		include_once 'include/web/test.php';
	}
	
	public function doMobileCexchange_daochu()
	{
		global $_GPC, $_W;
		$deviceinfo = intval($_GPC["islogin"]);
		$user = pdo_fetch("SELECT * FROM " . tablename('j_money_user') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1", array(":a" => $deviceinfo));
		if (!$user) {
			message("请先登录");
		}
		if ($user['permission'] < 2) {
			message("您的权限不足！");
		}

		$keyword = trim($_GPC['keyword']);
		$ds = strtotime($_GPC['ds'] . " 00:00:00");
		$de = strtotime($_GPC['de'] . " 23:59:59");
		$where = " and shopid={$user['pcate']} ";
		if ($ds) {
			$where.= " and createtime>=" . $ds . " and createtime<=" . $de . "";
		}

			$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_redeemcredit') . " WHERE uniacid='{$_W['uniacid']}' {$where}  order by id desc");
			if (!$list) {
				message("没有数据");
			}
			$tableheader = array('会员名称', '部门', '会员卡号', '兑换数量', '消耗积分',  '时间', '状态');
			foreach ($parama as $index => $row) {
				array_push($tableheader, $index);
			}
			$html = "\xEF\xBB\xBF";
			foreach ($tableheader as $value) {
				$html .= $value . "\t ,";
			}
			$html .= "\n";
			foreach ($list as $row) {
				
				$html .= $row['user'] . "\t ,";
				$html .= $row['bumen'] . "\t ,";
				$html .= $row['cardId']."\t ,";
				$html.=intval($row['num']).",";
				$html.=floatval($row['credit']).",";
		
				$html .= date('Y-m-d H:i', $row['createtime']) . "\t ,";

				$html .= $row['status'] == 1 ? "兑换成功" : "兑换失败|".$row["mes"]."\t ,";
				$html .= "\n";
			}

			header("Content-type:text/csv");
			header("Content-Disposition:attachment; filename=" . $_GPC['ds'] . "至" . $_GPC['de'] . "兑换记录.csv");
			echo $html;
			die;
	
	}
	
	
	
	
	
	
}
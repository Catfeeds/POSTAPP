<?php 
//软件使用
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$settings = pdo_fetchcolumn('SELECT `settings` FROM ' . tablename('uni_account_modules') . ' WHERE `uniacid` = :uniacid AND `module` = :module', array(':uniacid' => $_W['uniacid'], ':module' => 'j_money'));
$cfg = iunserializer($settings);
if($operation=="getprice"){
	$orderid=$_GPC["orderid"];
	$items=pdo_fetchall("SELECT * FROM ".tablename('weisrc_dish_order')." WHERE id in(".$orderid.") and ispay=0 ");
	$total=0;
	$idary=array();
	foreach($items as $row){
		$total = $total+$row['totalprice'];
		$idary[]=$row['id'];
	}
	die(json_encode(array("success"=>true,"total"=>$total,"uniacid"=>$_W['uniacid'],"idary"=>implode(",",$idary))));
}elseif($operation=="payall"){
	$orderid=$_GPC["idary"];
	$fee=intval($_GPC["fee"]*100);
	$paytype=$_GPC["paytype"];
	$code=$_GPC["code"];
	$cardno=$_GPC["cardno"];
	$items=pdo_fetchall("SELECT * FROM ".tablename('weisrc_dish_order')." WHERE id in(".$orderid.") and ispay=0 order by id desc");
	$moduleshop=json_decode($cfg['moduleshop'],true);
	$shopid=$moduleshop['weisrc_dish'][$items[0]['storeid']];
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$shopid));
	if(!$shop)die(json_encode(array("success"=>false,"msg"=>"未配置店铺")));	
	$payall=true;
	foreach($items as $row){
		$hadexits=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE old_trade_no=:a and status=1",array(":a"=>$row['ordersn']));
		if($hadexits)continue;
		$payall=false;
	}
	if($payall)die(json_encode(array("success"=>false,"msg"=>"订单已付款")));	
	//1余额，2微信支付，3到付，4现金，5银行卡，6会员卡，7微信，8支付宝
	if($paytype==0 || $paytype==1){
		foreach($items as $row){
			$hadexits=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE old_trade_no=:a ",array(":a"=>$row['ordersn']));
			if($hadexits)continue;
			$data=array(
				"weid"=>$_W['uniacid'],
				"groupid"=>$shop['id'],
				"attach"=>'码上点餐',
				"out_trade_no"=>TIMESTAMP.mt_rand(100,999),
				"order_fee"=>intval($row['goodsprice']*100),
				"total_fee"=>intval($row['totalprice']*100),
				"cash_fee"=>intval($row['totalprice']*100),
				"createtime"=>TIMESTAMP,
				"createdate"=>date('Y-m-d'),
				"status"=>1,
				"paytype"=>$paytype+2,
				"time_end"=>TIMESTAMP,
				"remark"=>$code,
				"old_trade_no"=>$row['ordersn'],
			);
			pdo_insert("j_money_trade",$data);
		}
		pdo_update("weisrc_dish_order",array("ispay"=>1,"paytype"=>$paytype+4)," id in (".$orderid.")");
	}elseif($paytype==2){
		$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and wxcardno=:a ",array(":a"=>$cardno));
		if(!$membercard)die(json_encode(array("success"=>false,"msg"=>"无此会员卡")));
		if($fee>$membercard['cash'])die(json_encode(array("success"=>false,"msg"=>"余额不足，当前余额".sprintf('%.2f',($membercard["cash"]*0.01)))));
		if(!$code){
			$paycode=mt_rand(1000,9999);
			foreach($items as $row){
				$hadexits=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE old_trade_no=:a ",array(":a"=>$row['ordersn']));
				if($hadexits)continue;
				$data=array(
					"weid"=>$_W['uniacid'],
					"groupid"=>$shop['id'],
					"attach"=>'码上点餐',
					"out_trade_no"=>TIMESTAMP.mt_rand(100,999),
					"order_fee"=>intval($row['goodsprice']*100),
					"total_fee"=>intval($row['totalprice']*100),
					"createtime"=>TIMESTAMP,
					"createdate"=>date('Y-m-d'),
					"status"=>0,
					"paytype"=>4,
					"paycode"=>$paycode,
					"memberno"=>$cardno,
					"old_trade_no"=>$row['ordersn'],
				);
				pdo_insert("j_money_trade",$data);
			}
			$temp=array(
				"first"=>array(
					"value"=>"尊敬的顾客",
					"color"=>"#000000"
				),
				"number"=>array(
					"value"=>$paycode,
					"color"=>"#FF0000"
				),
				"remark"=>array(
					"value"=>"该验证码有效期3分钟可输入1次，转发无效",
					"color"=>"#333333"
				)
			);
			$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
			$acc = WeAccount::create($acid);
			$acc->sendTplNotice($membercard['openid'],$cfg["paycodetempmsg"],$temp,"","#FF0000");
			die(json_encode(array("success"=>true,"waitcode"=>true)));
		}else{
			$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE memberno=:a and paycode=:b and ".TIMESTAMP."-createtime<180 ");
			if(!$list)die(json_encode(array("success"=>false,"msg"=>"验证码错误")));
			$ary=array();
			foreach($list as $row){
				$ary[]=$row["id"];
			}
			$data=array(
				"status"=>2,
				"time_end"=>TIMESTAMP,
			);
			pdo_update("j_money_trade",$data,"id in (".implode(",",$ary).")");
			pdo_update("weisrc_dish_order",array("ispay"=>1,"paytype"=>$paytype+4)," id in (".$orderid.")");
		}
	}elseif($paytype==3){
		$qrcode=$code;
		load()->func('communication');
		$totalfee=intval($fee);
		if(!$totalfee)die(json_encode(array("success"=>false,"msg"=>"金额不能为空")));
		$userinfo=$this->authcode2openid($qrcode,$deviceinfo);
		if(substr($qrcode,0,1)==1){
			$payParama=array(
				"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
				"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
				"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
				"outTradeNo"=>TIMESTAMP.mt_rand(100,999),
				"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
				"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
				"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
			);
			$pay_signkey=trim($shop['pay_signkey']) ? trim($shop['pay_signkey']) : trim($cfg['pay_signkey']);
			$pageparama=array(
				"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
				"mch_id"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
				"device_info"=>$shop['id'],
				"nonce_str"=>getNonceStr(),
				"body"=>$shop["companyname"],
				"detail"=>"微支付收款",
				"attach"=>"0",
				"out_trade_no"=>$payParama['outTradeNo'],
				"total_fee"=>$totalfee,
				"fee_type"=>"CNY",
				"spbill_create_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
				"auth_code"=>$qrcode,
			);
			if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
			if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
			//插入数据
			foreach($items as $row){
				$hadexits=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE old_trade_no=:a ",array(":a"=>$row['ordersn']));
				if($hadexits)continue;
				$data=array(
					"weid"=>$_W['uniacid'],
					"groupid"=>$shop['id'],
					"attach"=>'码上点餐',
					"out_trade_no"=>$payParama['outTradeNo'],
					"order_fee"=>intval($row['goodsprice']*100),
					"total_fee"=>intval($row['totalprice']*100),
					"createtime"=>TIMESTAMP,
					"createdate"=>date('Y-m-d'),
					"paytype"=>0,
					"old_trade_no"=>$row['ordersn'],
				);
				pdo_insert("j_money_trade",$data);
			}
			$sign=MakeSign($pageparama,$pay_signkey);
			$pageparama['sign']=$sign;
			$xml = ToXml($pageparama);
			$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
			$result=FromXml($response);
			if($result['result_code']!='SUCCESS'){
				if($result['err_code']=='USERPAYING'){
					die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'])));
				}
				die(json_encode(array("success"=>false,"msg"=>$result['trade_state_desc'].$result['err_code_des'].$result['return_msg'],"a"=>$pageparama)));
			}
			$insertInfo=array(
				"openid"=>$result['openid'],
				"is_subscribe"=>$result['is_subscribe']=="Y" ? 1 : 0,
				"sub_openid"=>isset($result['sub_openid']) ? $result['sub_openid'] : "",
				"sub_is_subscribe"=>isset($result['sub_is_subscribe']) && $result['sub_is_subscribe']=="Y" ? 1 : 0,
				"trade_type"=>$result['trade_type'],
				"bank_type"=>$result['bank_type'],
				"fee_type"=>$result['CNY'],
				"isconfirm"=>1,
				"status"=>1,
				"coupon_fee"=>intval($result['coupon_fee']),
				"cash_fee"=>intval($result['cash_fee']),
				"transaction_id"=>$result['transaction_id'],
				"time_end"=>strtotime($result['time_end']),
			);
			pdo_update("j_money_trade",$insertInfo,array("out_trade_no"=>$payParama['outTradeNo']));
			pdo_update("weisrc_dish_order",array("ispay"=>1,"paytype"=>7,"transid"=>$result['transaction_id'])," id in (".$orderid.")");
			die(json_encode(array("success"=>true)));
		}elseif(substr($qrcode,0,1)==2){
			$payParama=array(
				"outTradeNo"=>TIMESTAMP.mt_rand(100,999),
				"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
				"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
				"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
				"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
				"alipay_store_id"=>$shop['alipay_store_id'] ,
			);
			$auth_code = trim($qrcode);
			$total_amount = $fee;
			$subject = "支付宝收款";
			foreach($items as $row){
				$data=array(
					"weid"=>$_W['uniacid'],
					"groupid"=>$shop['id'],
					"attach"=>'码上点餐',
					"out_trade_no"=>$payParama['outTradeNo'],
					"order_fee"=>intval($row['goodsprice']*100),
					"total_fee"=>intval($row['totalprice']*100),
					"createtime"=>TIMESTAMP,
					"createdate"=>date('Y-m-d'),
					"paytype"=>1,
					"old_trade_no"=>$row['ordersn'],
				);
				pdo_insert("j_money_trade",$data);
			}
			
			$postfee=sprintf('%.2f',($fee*0.01));
			require_once '../addons/j_money/F2fpay.php';
			$f2fpay = new F2fpay();
			$response = $f2fpay->barpay($payParama['outTradeNo'],$auth_code,$postfee,$subject,$payParama);
			$temp=(array)$response;
			$result=(array)$temp['alipay_trade_pay_response'];
			if($result['code']=="10003"){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'])));
			}elseif($result['code']=="10000"){
				$insertdata=array(
					"status"=>1,
					"isconfirm"=>1,
					"transaction_id"=>$result['trade_no'],
					"cash_fee"=>intval($result['receipt_amount']*100),
					"time_end"=>strtotime($result['gmt_payment']),
				);
				pdo_update("j_money_trade",$insertdata,array("out_trade_no"=>$payParama['outTradeNo']));
				pdo_update("weisrc_dish_order",array("ispay"=>1,"paytype"=>8,"transid"=>$result['trade_no'])," id in (".$orderid.")");
				die(json_encode(array("success"=>true)));
			}else{
				pdo_update("j_money_trade",array("log"=>"收款失败：".$result['sub_msg']),array("out_trade_no"=>$payParama['outTradeNo']));
				die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
			}
			die(json_encode(array("success"=>false,"msg"=>"未知错误")));
		}else{
			die(json_encode(array("success"=>false,"msg"=>"支付码错误")));
		}
	}
	die(json_encode(array("success"=>true)));
}elseif($operation=="paywaitpassword"){
	$out_trade_no=$_GPC["out_trade_no"];
	load()->func('communication');
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a order by id desc limit 1",array(":a"=>$out_trade_no));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$trade['groupid']));
	
	if($trade['paytype']==0){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
		);
		$pageparama=array(
			"appid"=>$payParama['appid'],
			"mch_id"=>strval($payParama['pay_mchid']),
			"out_trade_no"=>$out_trade_no,
			"nonce_str"=>getNonceStr(),
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		$sign=MakeSign($pageparama,$payParama['pay_signkey']);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/orderquery", 10);
		$result=FromXml($response);
		//var_dump($payParama);
		if($result['result_code']=='SUCCESS'){
			if($result['trade_state']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$out_trade_no)));
			}elseif($result['trade_state']=='REFUND'){
				die(json_encode(array("success"=>false,"msg"=>"已退款")));
			}elseif($result['trade_state']=='NOTPAY'){
				die(json_encode(array("success"=>false,"msg"=>"没有支付")));
			}elseif($result['trade_state']=='CLOSED'){
				die(json_encode(array("success"=>false,"msg"=>"已关闭")));
			}elseif($result['trade_state']=='REVOKED'){
				die(json_encode(array("success"=>false,"msg"=>"已撤销")));
			}elseif($result['trade_state']=='PAYERROR'){
				die(json_encode(array("success"=>false,"msg"=>"支付失败(银行返回失败)")));
			}elseif($result['trade_state']=='SUCCESS'){
				$data=array(
					"openid"=>$result['openid'],
					"is_subscribe"=>$result['is_subscribe']=="Y" ? 1 : 0,
					"sub_openid"=>isset($result['sub_openid']) ? $result['sub_openid'] : "",
					"sub_is_subscribe"=>isset($result['sub_is_subscribe']) && $result['sub_is_subscribe']=="Y" ? 1 : 0,
					"trade_type"=>$result['trade_type'],
					"bank_type"=>$result['bank_type'],
					"fee_type"=>$result['CNY'],
					"isconfirm"=>1,
					"status"=>1,
					"coupon_fee"=>intval($result['coupon_fee']),
					"cash_fee"=>intval($result['cash_fee']),
					"transaction_id"=>$result['transaction_id'],
					"time_end"=>strtotime($result['time_end']),
				);
				pdo_update("j_money_trade",$data,array("out_trade_no"=>$out_trade_no));
				$list=pdo_fetchall("SELECT old_trade_no FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
				$idary=array();
				foreach($list as $row){
					$idary[]=$row['old_trade_no'];
				}
				pdo_update("weisrc_dish_order",array("ispay"=>1,"paytype"=>7,"transid"=>$result['transaction_id'])," ordersn in ('".implode("','",$idary)."')");
				die(json_encode(array("success"=>true,"paywait"=>false,"ok"=>true)));
			}
		}
		die(json_encode(array("success"=>false,"msg"=>$result['trade_state_desc'].$result['err_code_des'].$result['return_msg'])));
	}else{
		$payParama=array(
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		require_once '../addons/j_money/F2fpay.php';
		$cfg = $this->module['config'];
		$f2fpay = new F2fpay();
		$response = $f2fpay->query($out_trade_no,$payParama);
		$results=@json_decode(json_encode($response),true);
		$result=$results['alipay_trade_query_response'];
		
		if($result['code']==10003){
			die(json_encode(array("success"=>true,"paywait"=>true,"msg"=>"等待客户支付密码","out_trade_no"=>$out_trade_no)));
		}elseif($result['code']==10000){
			if($result['trade_status']=="TRADE_SUCCESS"){
				$data=array(
					"status"=>1,
					"transaction_id"=>$result['trade_no'],
					"cash_fee"=>intval($result['receipt_amount']*100),
					"time_end"=>strtotime($result['gmt_payment']),
				);
				pdo_update("j_money_trade",$data,array("out_trade_no"=>$out_trade_no));
				$list=pdo_fetchall("SELECT old_trade_no FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
				$idary=array();
				foreach($list as $row){
					$idary[]=$row['old_trade_no'];
				}
				pdo_update("weisrc_dish_order",array("ispay"=>1,"paytype"=>7,"transid"=>$result['transaction_id'])," ordersn in ('".implode("','",$idary)."')");
				die(json_encode(array("success"=>true,"paywait"=>false,"ok"=>true)));
				
			}elseif($result['trade_status']=="WAIT_BUYER_PAY"){
				die(json_encode(array("success"=>false,"msg"=>"等待客户付款")));
			}elseif($result['trade_status']=="TRADE_CLOSED"){
				die(json_encode(array("success"=>false,"msg"=>"订单已退款或已关闭")));
			}else{
				die(json_encode(array("success"=>false,"msg"=>$result['trade_status'])));
			}
		}
		die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
	}
}

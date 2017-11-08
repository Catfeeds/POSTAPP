<?php 
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
if($operation=="login"){
	//用户登录
	$userid=$_GPC["userid"];
	$pwd=$_GPC["pwd"];
	$openid=$_POST["openid"];
	if($openid){
		$item=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and openid=:b limit 1",array(":b"=>$openid));
		if(!$item)die(json_encode(array("success"=>false,"msg"=>"用户不存在或者密码错误")));
		if(!$item['status'])die(json_encode(array("success"=>false,"msg"=>"该用户还没有审核，请联系管理员")));
		pdo_update("j_money_user",array('lasttime'=>TIMESTAMP),array('id'=>$item['id']));
		die(json_encode(array("success"=>true,"islogin"=>$item['id'])));
	}else{
		
		if(!$userid || !$pwd)die(json_encode(array("success"=>false,"msg"=>"用户名或者密码错误")));
		$pwd=md5($_GPC['pwd']);
		$item=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and useracount=:a and password=:b limit 1",array(":a"=>$userid,":b"=>$pwd));
		if(!$item)die(json_encode(array("success"=>false,"msg"=>"用户不存在或者密码错误")));
		if(!$item['status'])die(json_encode(array("success"=>false,"msg"=>"该用户还没有审核，请联系管理员")));
		pdo_update("j_money_user",array('lasttime'=>TIMESTAMP),array('id'=>$item['id']));
		die(json_encode(array("success"=>true,"islogin"=>$item['id'],"user"=>$item)));
	}
}elseif($operation=="getshop"){
	$islogin=$_GPC['islogin'];
	if(!$islogin)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$islogin));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	die(json_encode(array("success"=>true,"shop"=>$shop)));
}elseif($operation=="getsocket"){
	$islogin=$_GPC['islogin'];
	if(!$islogin)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$islogin));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	die(json_encode(array("success"=>true,"socketurl"=>$cfg['socketurl'])));
}elseif($operation=="scanpay"){
	$qrcode=$_GPC["qrcode"];
	$fee=$_GPC["fee"] ? $_GPC["fee"] : 1;
	$deviceinfo=intval($_GPC["userid"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录","a"=>$_GPC)));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	load()->func('communication');
	$totalfee=intval($fee);
	if(!$totalfee)die(json_encode(array("success"=>false,"msg"=>"金额不能为空")));
	$userinfo=$this->authcode2openid($qrcode,$deviceinfo);
	$market=$this->MarketingTest($totalfee,$shop['id'],$deviceinfo,$userinfo['openid']);
	$coupon_fee=$market['coupon_fee'];
	$marketid=$market['marketid'];
	if(substr($qrcode,0,1)==1){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"outTradeNo"=>TIMESTAMP,
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
		);
		$pay_signkey=trim($shop['pay_signkey']) ? trim($shop['pay_signkey']) : trim($cfg['pay_signkey']);
		$pageparama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"mch_id"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"device_info"=>$deviceinfo,
			"nonce_str"=>getNonceStr(),
			"body"=>$shop["companyname"],
			"detail"=>"微支付收款",
			"attach"=>$user['id'],
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$totalfee-$coupon_fee,
			"fee_type"=>"CNY",
			"spbill_create_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"goods_tag"=>"000001",
			"auth_code"=>$qrcode,
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		//插入数据
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$deviceinfo,
			"groupid"=>$user['pcate'],
			"attach"=>$_GPC['attach'] ? $_GPC['attach'] :'PC',
			"out_trade_no"=>$payParama['outTradeNo'],
			"order_fee"=>$totalfee,
			"total_fee"=>$totalfee-$coupon_fee,
			"discount_fee"=>$coupon_fee,
			"marketing"=>$marketid,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		if($marketid)$data['marketing_log']=$marketing['description'];
		pdo_insert("j_money_trade",$data);
		$sign=MakeSign($pageparama,$pay_signkey);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
		$result=FromXml($response);
		//var_dump($result);
		if($result['result_code']!='SUCCESS'){
			if($result['err_code']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'])));
			}
			die(json_encode(array("success"=>false,"msg"=>$result['err_code_des'].$result["return_msg"])));
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
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$payParama['outTradeNo']));
		die(json_encode(array("success"=>true,"items"=>$trade,"out_trade_no"=>$payParama['outTradeNo'])));
	}elseif(substr($qrcode,0,1)==2){
		$payParama=array(
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"outTradeNo"=>TIMESTAMP,
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		$auth_code = trim($qrcode);
		$total_amount = $fee;
		$subject = "支付宝收款";
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$deviceinfo,
			"groupid"=>$user['pcate'],
			"attach"=>$_GPC['attach'] ? $_GPC['attach'] :"PC",
			"paytype"=>1,
			"out_trade_no"=>$payParama['outTradeNo'],
			"order_fee"=>$totalfee,
			"total_fee"=>$totalfee-$coupon_fee,
			"discount_fee"=>$coupon_fee,
			"cash_fee"=>$totalfee-$coupon_fee,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"marketing"=>$marketid,
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		if($marketid)$data['marketing_log']=$marketing['description'];
		pdo_insert("j_money_trade",$data);
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
			$item=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE out_trade_no=:a",array(":a"=>$payParama['outTradeNo']));
			die(json_encode(array("success"=>true,"items"=>$item,"out_trade_no"=>$payParama['outTradeNo'])));
		}else{
			pdo_update("j_money_trade",array("log"=>"收款失败：".$result['sub_msg']),array("out_trade_no"=>$payParama['outTradeNo']));
			die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
		}
		die(json_encode(array("success"=>false,"msg"=>"未知错误")));
	}
	die(json_encode(array("success"=>false,"msg"=>"支付码错误")));
}elseif($operation=="pay_waitpassword"){
	$deviceinfo=intval($_GPC["userid"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$user['pcate']));
	$out_trade_no=$_GPC["out_trade_no"];
	load()->func('communication');
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
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
		if($result['result_code']=='SUCCESS'){
			if($result['trade_state']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$out_trade_no)));
			}elseif($result['trade_state']!='SUCCESS'){
				die(json_encode(array("success"=>false,"msg"=>$result['trade_state_desc'].$result['err_code_des'])));
			}
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
			pdo_update("j_money_trade",$data,array("id"=>$trade['id']));
			if($trade['status']==0){
				die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>true,"out_trade_no"=>$out_trade_no)));
			}
			die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>false,"out_trade_no"=>$out_trade_no)));
		}
		die(json_encode(array("success"=>false,"msg"=>$result['trade_state_desc'].$result['err_code_des'])));
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
			die(json_encode(array("success"=>true,"paywait"=>true,"msg"=>"等待客户支付密码","out_trade_no"=>$orderid)));
		}elseif($result['code']==10000){
			if($result['trade_status']=="TRADE_SUCCESS"){
				$data=array(
					"status"=>1,
					"paid_fee"=>$trade['total_fee'],
					"transaction_id"=>$result['trade_no'],
					"cash_fee"=>intval($result['receipt_amount']*100),
					"time_end"=>strtotime($result['gmt_payment']),
				);
				pdo_update("j_money_trade",$data,array("out_trade_no"=>$orderid));
				$isnew=false;
				if($trade["status"]==0)$isnew=true;
				die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>$isnew,"out_trade_no"=>$out_trade_no)));
			}elseif($result['trade_status']=="TRADE_CLOSED"){
				die(json_encode(array("success"=>false,"msg"=>"订单已退款或已关闭")));
			}else{
				die(json_encode(array("success"=>false,$result['trade_status'])));
			}
		}
		die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
	}
}elseif($operation=="paysuccess"){
	$userid=$_GPC['userid'];
	if(!$userid)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$userid));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$orderid=$_GPC['out_trade_no'];
	$a=$this->jetSumpay($orderid);
	die(json_encode(array("success"=>true,"msg"=>$a)));
}elseif($operation=="payqrcode"){
	$deviceinfo=intval($_GPC["userid"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	load()->func('communication');
	$fee=$_GPC["fee"];
	$fee=intval($fee*100);
	$totalfee=intval($fee);
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$paytype=intval($_GPC["paytype"]);
	$code_url="";
	
	if($paytype==0){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"outTradeNo"=>TIMESTAMP,
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
		);
		$pageparama=array(
			"appid"=>$payParama['appid'],
			"mch_id"=>$payParama['pay_mchid'],
			"device_info"=>"WEB",
			"nonce_str"=>getNonceStr(),
			"body"=>$shop['companyname'],
			"detail"=>"微支付收款",
			"attach"=>"mobile-qrcode",
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$fee,
			"fee_type"=>"CNY",
			"spbill_create_ip"=>$payParama['spbill_create_ip'],
			"time_start"=>date("YmdHis"),
			/*"time_expire"=>date("YmdHis",TIMESTAMP+600),*/
			"time_expire"=>600,
			"notify_url"=>$cfg['notify_url'],
			"trade_type"=>"NATIVE",
			"product_id"=>"01",
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		//插入数据
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$user['id'],
			"groupid"=>$user['pcate'],
			"attach"=>"mobile-qrcode",
			"out_trade_no"=>$payParama['outTradeNo'],
			"order_fee"=>$totalfee,
			"total_fee"=>$totalfee,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		pdo_insert("j_money_trade",$data);
		$sign=MakeSign($pageparama,$payParama['pay_signkey']);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/unifiedorder", 10);
		$result=FromXml($response);
		//var_dump($result);
		if($result['return_code']!='SUCCESS'){
			die(json_encode(array("success"=>false,"msg"=>$result['return_msg'])));
		}
		if($result['code_url']){
			$code_url=$result['code_url'];
		}else{
			die(json_encode(array("success"=>false,"msg"=>"生成失败")));
		}
	}else{
		$payParama=array(
			"outTradeNo"=>TIMESTAMP,
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		$total_amount = $fee;
		$subject = $shop['companyname'];
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$user['id'],
			"attach"=>"mobile-qrcode",
			"groupid"=>$user['pcate'],
			"paytype"=>1,
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$totalfee,
			"order_fee"=>$totalfee,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		pdo_insert("j_money_trade",$data);
		$postfee=sprintf('%.2f',($fee*0.01));
		require_once '../addons/j_money/F2fpay.php';
		$f2fpay = new F2fpay();
		$response = $f2fpay->qrpay($payParama['outTradeNo'], $postfee, $subject,$payParama);
		$temp=(array)$response;
		$result=(array)$temp['alipay_trade_precreate_response'];
		if($result['code']=="10000"){
			if(isset($result['qr_code'])){
				$code_url=$result['qr_code'];
			}else{
				die(json_encode(array("success"=>false,"msg"=>"生成失败")));
			}
		}else{
			die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
		}
	}
	
	if(isset($code_url) && $code_url){
		include('../addons/j_money/phpqrcode.php');
		load()->func('file');
		$dir_url="../attachment/j_money/".$_W['uniacid']."/";
		$dir_url2=$_W['siteroot']."attachment/j_money/".$_W['uniacid']."/";
		mkdirs($dir_url);
		$codename=$userOpenid."_".TIMESTAMP."_.png";
		$value = $code_url;
		if(file_exists($dir_url.$codename))@unlink ($dir_url.$codename);
		QRcode::png($value, $dir_url.$codename, "L", 10);
		die(json_encode(array("success"=>true,"qrcode"=>$dir_url2.$codename."?v=".TIMESTAMP,"orderid"=>$payParama['outTradeNo'])));
	}
	die(json_encode(array("success"=>false,"msg"=>"生成失败")));
	
}elseif($operation=="getorderdetail"){
	$orderid=$_GPC["orderid"];
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$orderid));
	if(!$trade)die(json_encode(array("success"=>false,"msg"=>"订单不存在")));
	die(json_encode(array("success"=>true,"items"=>$trade)));
}elseif($operation=="softmore"){
	$userOpenid=intval($_GPC['userid']);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$userOpenid));
	$date=$_GPC['date'] ? $_GPC['date'] : date("Y-m-d");
	$date=date("Y-m-d",strtotime($date));
	$where= $_GPC['orderid'] ? " and out_trade_no='".$_GPC['orderid']."' " : " and createdate='".$date."' " ;
	
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a $where order by id desc  " , array(":a"=>$user['pcate']));
	
	if(count($list)){
		die(json_encode(array("success"=>true,"item"=>$list)));
	}else{
		die(json_encode(array("success"=>false,"msg"=>"没有记录")));
	}
}elseif($operation=="mobilemore"){
	$userOpenid=intval($_GPC['userid']);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id and status=1",array(":id"=>$userOpenid));
	$date=$_GPC['date'] ? $_GPC['date'] : date("Y-m-d");
	$date=date("Y-m-d",strtotime($date));
	$pindex=intval($_GPC['page']) ? intval($_GPC['page'])-1 :0;
	$psize = 10;
	$start = $pindex * $psize;
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b order by id desc LIMIT ".$start.",".$psize , array(":a"=>$user['pcate'],":b"=>$date));
	$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b  ",array(":a"=>$user['pcate'],":b"=>$date));
	if($pindex==0){
		$feetotal=pdo_fetchcolumn("SELECT sum(cash_fee) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b and status>0 ",array(":a"=>$user['pcate'],":b"=>$date));
		$feerefound=pdo_fetchcolumn("SELECT sum(cash_fee) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b and refundstatus>0 ",array(":a"=>$user['pcate'],":b"=>$date));
	}
	$allpage=0;
	if($total < $psize){
		$allpage = 1;
	}else{
		$allpage = $total % $psize == 0 ? $total / $psize : $total / $psize + 1;
	}
	if(count($list)){
		die(json_encode(array("success"=>true,"item"=>$list,"allpage"=>$allpage,"total"=>$total,"feetotal"=>$feetotal,"feerefound"=>$feerefound)));
	}else{
		die(json_encode(array("success"=>false,"msg"=>"没有记录")));
	}
}elseif($operation=="checkcard"){
	$islogin=$_GPC['islogin'];
	if(!$islogin)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$islogin));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$code=$_GPC['code'];
	if(!$code)die(json_encode(array("success"=>false,"msg"=>"卡券ID不能为空")));
	$cfg = $this->module['config'];
	load()->func('communication');
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['groupid']));
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$tokens=$acc->fetch_token();
	$pageparama=json_encode(array("code"=>$code));
	$resp = ihttp_request("https://api.weixin.qq.com/card/code/get?access_token=".$tokens,$pageparama, $xml);
	if(is_error($resp))$procResult = $resp;
	$result=@json_decode($resp['content'],true);
	
	if($result['errcode'])die(json_encode(array("success"=>false,"msg"=>"卡券查询失败，原因：".$result['errmsg'])));
	$cardid=$result['card']['card_id'];
	$begin_time=$result['card']['begin_time'];
	$end_time=$result['card']['end_time'];
	$can_consume=$result['can_consume'];
	$user_card_status=$result['user_card_status'];
	$openid=$result['openid'];
	if($begin_time>TIMESTAMP || $end_time<TIMESTAMP)die(json_encode(array("success"=>false,"msg"=>"该卡券不可用，原因：该卡券使用时间为：".date("y-m-d H:i",$begin_time)."-".date("y-m-d H:i",$end_time))));
	$cardstatus=array(
		"CONSUMED"=>"已使用",
		"EXPIRE"=>"已过期",
		"GIFT_TIMEOUT"=>"转赠超时",
		"DELETE"=>"已删除",
		"UNAVAILABLE"=>"已失效",
		"invalid serial code"=>"已被朋友使用",
	);
	if(!$can_consume){
		die(json_encode(array("success"=>false,"msg"=>$cardstatus[$user_card_status])));
	}
	$pageparama=json_encode(array("card_id"=>$cardid));
	$resp = ihttp_request("https://api.weixin.qq.com/card/get?access_token=".$tokens,$pageparama, $xml);
	if(is_error($resp))die(json_encode(array("success"=>false,"msg"=>$resp)));
	$cardinfo=@json_decode($resp['content'],true);
	$coupon=array();
	$coupon['type']=strtolower($cardinfo['card']['card_type']);
	switch($coupon['type']){
		case "discount":
			$coupon["typestr"]="折扣券";
			$coupon["discount"]=$cardinfo['card']['discount']['discount'];
			$coupon["msg"]=(100-$coupon["discount"])."%折扣券";
			$coupon["content"]=$cardinfo['card']['discount'];
		break;
		case "cash":
			$coupon["typestr"]="代金券";
			$coupon["least_cost"]=isset($cardinfo['card']['cash']['least_cost']) ? $cardinfo['card']['cash']['least_cost'] : 0;
			$coupon["discount"]=$cardinfo['card']['cash']['reduce_cost'];
			$coupon["msg"]=$coupon["least_cost"] ? "满".sprintf('%.2f',($coupon["least_cost"]*0.01))."元减".sprintf('%.2f',($coupon["discount"]*0.01))."元": "直减".sprintf('%.2f',($coupon["discount"]*0.01))."元";
			$coupon["content"]=$cardinfo['card']['cash'];
		break;
		case "gift":
			$coupon["typestr"]="礼品券";
			$coupon["msg"]=$cardinfo['card']['gift']['gift'];
			$coupon["content"]=$cardinfo['card']['gift'];
		break;
		case "groupon":
			$coupon["typestr"]="团购券";
			$coupon["msg"]=$cardinfo['card']['groupon']['deal_detail'];
			$coupon["content"]=$cardinfo['card']['groupon'];
		break;
		case "general_coupon":
			$coupon["typestr"]="优惠券";
			$coupon["msg"]=$cardinfo['card']['general_coupon']['default_detail'];
			$coupon["content"]=$cardinfo['card']['general_coupon'];
		break;
	}
	$coupon['openid']=$openid;
	$coupon['code']=$code;
	die(json_encode(array("success"=>true,"item"=>$coupon)));
	
}elseif($operation=="cardcheck"){
	$islogin=$_GPC['islogin'];
	if(!$islogin)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$islogin));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$code=$_GPC['code'];
	if(!$code)die(json_encode(array("success"=>false,"msg"=>"卡券ID不能为空")));
	$cfg = $this->module['config'];
	load()->func('communication');
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['groupid']));
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$tokens=$acc->fetch_token();
	$pageparama=json_encode(array("code"=>$code));
	$resp = ihttp_request("https://api.weixin.qq.com/card/code/consume?access_token=".$tokens,$pageparama, $xml);
	if(is_error($resp)) {
		$procResult = $resp;
	}
	$arr=@json_decode($resp['content'],true);
	if($arr['errcode'])die(json_encode(array("success"=>false,"msg"=>"核销失败。失败原因：".json_encode($arr))));
	$cardid=$arr['card']['card_id'];
	$openid=$arr['openid'];
	if(!$cardid || !$openid)die(json_encode(array("success"=>false,"msg"=>"核销失败。失败原因：".json_encode($arr))));
	$pageparama=json_encode(array("card_id"=>$cardid));
	$resp = ihttp_request("https://api.weixin.qq.com/card/get?access_token=".$tokens,$pageparama, $xml);
	if(is_error($resp))die(json_encode(array("success"=>false,"msg"=>$resp)));
	$coupon=array();
	$cardinfo=@json_decode($resp['content'],true);
	$coupon['type']=strtolower($cardinfo['card']['card_type']);
	switch($coupon['type']){
		case "discount":
			$coupon["typestr"]="折扣券";
			$coupon["discount"]=$cardinfo['card']['discount']['discount'];
			$coupon["title"]=$cardinfo['card']['discount']['base_info']['title'];
			$coupon["sub_title"]=$cardinfo['card']['discount']['base_info']['sub_title'];
			$coupon["description"]=$cardinfo['card']['discount']['base_info']['description'];
			$coupon["extra"]=100-intval($coupon["discount"]);
		break;
		case "cash":
			$coupon["typestr"]="代金券";
			$coupon["least_cost"]=isset($cardinfo['card']['cash']['least_cost']) ? $cardinfo['card']['cash']['least_cost'] : 0;
			$coupon["discount"]=$cardinfo['card']['cash']['reduce_cost'];
			$coupon["title"]=$cardinfo['card']['cash']['base_info']['title'];
			$coupon["sub_title"]=$cardinfo['card']['cash']['base_info']['sub_title'];
			$coupon["description"]=$coupon["least_cost"] ? "满".sprintf('%.2f',($coupon["least_cost"]*0.01))."元减".sprintf('%.2f',($coupon["discount"]*0.01))."元": "直减".sprintf('%.2f',($coupon["discount"]*0.01))."元";
		break;
		case "gift":
			$coupon["typestr"]="礼品券";
			$coupon["msg"]=$cardinfo['card']['gift']['gift'];
			$coupon["title"]=$cardinfo['card']['gift']['base_info']['title'];
			$coupon["sub_title"]=$cardinfo['card']['gift']['base_info']['sub_title'];
			$coupon["description"]=$cardinfo['card']['gift']['base_info']['description'];
			$coupon["extra"]=$cardinfo['card']['gift']['gift'];
		break;
		case "groupon":
			$coupon["typestr"]="团购券";
			$coupon["title"]=$cardinfo['card']['groupon']['base_info']['title'];
			$coupon["sub_title"]=$cardinfo['card']['groupon']['base_info']['sub_title'];
			$coupon["description"]=$cardinfo['card']['groupon']['base_info']['description'];
			$coupon["extra"]=$cardinfo['card']['groupon']['deal_detail'];
		break;
		case "general_coupon":
			$coupon["typestr"]="优惠券";
			$coupon["title"]=$cardinfo['card']['general_coupon']['base_info']['title'];
			$coupon["sub_title"]=$cardinfo['card']['general_coupon']['base_info']['sub_title'];
			$coupon["description"]=$cardinfo['card']['general_coupon']['base_info']['description'];
			$coupon["extra"]=$cardinfo['card']['general_coupon']['deal_detail'];
		break;
	}
	$cardtype=strtolower($cardinfo['card']['card_type']);
	$c_info=$cardinfo['card'][$cardtype]['base_info'];
	$data=array(
		"weid"=>$_W['uniacid'],
		"openid"=>$openid,
		"userid"=>$islogin,
		"groupid"=>$user['pcate'],
		"cardid"=>$cardid,
		"code"=>$code,
		"createtime"=>TIMESTAMP,
		"type"=>$coupon['type'],
		"title"=>$coupon['title'],
		"sub_title"=>$coupon['sub_title'],
		"description"=>$coupon['description'],
		"extra"=>$coupon['extra'],
	);
	pdo_insert("j_money_carduser",$data);
	$data['id']=pdo_insertid();
	$num=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_carduser')." WHERE userid=:a and createtime>=:b and createtime<=:c",array(':a'=>$islogin,':b'=>strtotime(date("Y-m-d 00:00:00")),':c'=>strtotime(date("Y-m-d 23:59:59"))));
	die(json_encode(array("success"=>true,"item"=>$data,"num"=>$num)));
	
}elseif($operation=="refundorder"){
	$orderid=$_GPC["orderid"];
	$reason=$_GPC["reason"];
	$userOpenid=intval($_GPC['userid']);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id and status=1",array(":id"=>$userOpenid));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	if(!$orderid)die(json_encode(array("success"=>false,"msg"=>"订单号不能为空")));
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$orderid));
	if(!$trade)die(json_encode(array("success"=>false,"msg"=>"订单号不能为空")));
	if(!$trade['status'])die(json_encode(array("success"=>false,"msg"=>"该订单没有付款")));
	if($trade['refundstatus'])die(json_encode(array("success"=>false,"msg"=>"该订单已退款")));
	if($trade['paytype']>1)die(json_encode(array("success"=>false,"msg"=>"会员卡付款不能退款")));
	
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$trade['groupid']));
	$refund_trade_no=TIMESTAMP;
	pdo_update("j_money_trade",array("refund_fee"=>$trade['cash_fee'],"refund_trade_no"=>TIMESTAMP),array("out_trade_no"=>$orderid));
	
	if($user['permission']>1){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? strval($shop['sub_mch_id']) : strval($cfg['sub_mch_id']),
			"apiclient_cert"=>$shop['apiclient_cert'] ? '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$trade['groupid']."/".$shop['apiclient_cert'] : '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$cfg['apiclient_cert'],
			"apiclient_key"=>$shop['apiclient_key'] ? '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$trade['groupid']."/".$shop['apiclient_key'] : '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$cfg['apiclient_key'],
			
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		$pageparama=array(
			"appid"=>$payParama['appid'],
			"mch_id"=>$payParama['pay_mchid'],
			"device_info"=>$trade['userid'],
			"nonce_str"=>getNonceStr(),
			"out_trade_no"=>$orderid,
			"out_refund_no"=>$trade['refund_trade_no'],
			"total_fee"=>$trade['cash_fee'],
			"refund_fee"=>$trade['refund_fee'],
			"op_user_id"=>$trade['userid'],
			"app_id"=>$payParama['app_id'],
			"alipay_cert"=>$payParama['alipay_cert'],
		);
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		//--------
		if($trade['paytype']==1){
			$postfee=sprintf('%.2f',($trade['cash_fee']*0.01));
			require_once '../addons/j_money/F2fpay.php';
			$f2fpay = new F2fpay();
			$response = $f2fpay->refund($orderid,$postfee,$pageparama);
			$temp=(array)$response;
			$result=(array)$temp['alipay_trade_refund_response'];
			if($result['code']=="10000"){
				pdo_update("j_money_trade",array("refundstatus"=>1,"refundtime"=>TIMESTAMP,"status"=>2),array("out_trade_no"=>$orderid));
			}else{
				pdo_update("j_money_trade",array("log"=>"退款失败：".$result['sub_msg']),array("out_trade_no"=>$orderid));
				die(json_encode(array("success"=>false,"msg"=>"退款失败:".$result['sub_msg'])));
			}
		}else{
			unset($pageparama['alipay_cert']);
			unset($pageparama['appauthtoken']);
			unset($pageparama['alipay_key']);
			unset($pageparama['alipay_store_id']);
			
			unset($pageparama['app_id']);
			$sign=MakeSign($pageparama,$payParama['pay_signkey']);
			$pageparama['sign']=$sign;
			$xml = ToXml($pageparama);
			$pemary=array("cert"=>$payParama['apiclient_cert'],"key"=>$payParama['apiclient_key'],);
			$response =postXmlAndPemCurl($xml, "https://api.mch.weixin.qq.com/secapi/pay/refund", $pemary);
			$result=FromXml($response);
			//var_dump($result);
			if($result['result_code']!='SUCCESS'){
				pdo_update("j_money_trade",array("log"=>"退款失败：".$result['return_msg']),array("out_trade_no"=>$orderid));
				die(json_encode(array("success"=>false,"msg"=>"退款失败:".$result['return_msg'])));
			}
			pdo_update("j_money_trade",array("refundstatus"=>1,"refundtime"=>TIMESTAMP,"status"=>2),array("out_trade_no"=>$orderid));
		}
		$url="";
		$temp=array(
			"first"=>array(
				"value"=>"【".$shop['companyname']."】【".$user['realname']."】发起退款",
				"color"=>"#FF0000"
			),
			"orderProductPrice"=>array(
				"value"=>sprintf('%.2f',($trade['cash_fee']/100)),
				"color"=>"#FF0000"
			),
			"orderProductName"=>array(
				"value"=>"电脑端退款申请",
				"color"=>"#333333"
			),
			"orderName"=>array(
				"value"=>$orderid,
				"color"=>"#333333"
			),
			"remark"=>array(
				"value"=>"时间：".date("Y-m-d H:i:s")."\n退款原因：".$reason."\n",
				"color"=>"#333333"
			)
		);
		
	}else{
		$url=$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=refund&m=j_money&orderid=".$orderid;
		$temp=array(
			"first"=>array(
				"value"=>"【".$shop['companyname']."】【".$user['realname']."】发起退款申请",
				"color"=>"#FF0000"
			),
			"orderProductPrice"=>array(
				"value"=>sprintf('%.2f',($trade['cash_fee']/100)),
				"color"=>"#FF0000"
			),
			"orderProductName"=>array(
				"value"=>"电脑端退款申请",
				"color"=>"#333333"
			),
			"orderName"=>array(
				"value"=>$orderid,
				"color"=>"#333333"
			),
			"remark"=>array(
				"value"=>"时间：".date("Y-m-d H:i:s")."\n退款原因：".$reason."\n请点击此信息进行退款操作",
				"color"=>"#333333"
			)
		);
		if(!$cfg['refunder'] && !$shop['refunder'])die(json_encode(array("success"=>false,"msg"=>"无退款处理人")));
	}
	
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$data = $acc->sendTplNotice($shop['refunder'] ? $shop['refunder'] : $cfg['refunder'],$cfg["tempid2"],$temp,$url,"#FF0000");
	$result=json_decode($data,true);
	die(json_encode(array("success"=>true)));
	
}elseif($operation=="refundordlist"){
	$islogin=$_GPC["islogin"];
	if(!$islogin)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$islogin));
	$pindex=intval($_GPC['page']) ? intval($_GPC['page'])-1 :0;
	$psize = 10;
	$start = $pindex * $psize;
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a and refundtime<>0 order by id desc LIMIT ".$start.",".$psize , array(":a"=>$user['pcate']));
	$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a and refundtime<>0  ", array(":a"=>$user['pcate']));
	$allpage=0;
	if($total < $psize){
		$allpage = 1;
	}else{
		$allpage = $total % $psize == 0 ? $total / $psize : $total / $psize + 1;
	}
	
	if(count($list)){
		die(json_encode(array("success"=>true,"item"=>$list,"allpage"=>$allpage)));
	}else{
		die(json_encode(array("success"=>false,"msg"=>"没有记录")));
	}
}elseif($operation=="deleteorder"){
	$orderid=$_GPC["orderid"];
	if($orderid){
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$orderid));
		if($trade['status'])die(json_encode(array("success"=>false,"msg"=>"已付款订单不能删除")));
		pdo_delete('j_money_trade',array('id'=>$trade['id']));
		die(json_encode(array("success"=>true)));
	}
	die(json_encode(array("success"=>false,"msg"=>"订单编号不能为空")));
}elseif($operation=="cardlist"){
	$userOpenid=intval($_GPC['userid']);
	$cardtype=$_GPC['cardtype'];
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$userOpenid));
	if(!$cardtype){
		$list=pdo_fetchall("SELECT count(*) as num,`type` FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and groupid=:a group by `type` order by `type` desc " , array(":a"=>$user['pcate']));
		die(json_encode(array("success"=>true,"item"=>$list)));
	}
	$pindex=intval($_GPC['page']) ? intval($_GPC['page'])-1 :0;
	$psize = 10;
	$start = $pindex * $psize;
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b order by id desc LIMIT ".$start.",".$psize , array(":a"=>$user['pcate'],":b"=>$date));
	$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b  ",array(":a"=>$user['pcate'],":b"=>$date));
	if($pindex==0){
		$feetotal=pdo_fetchcolumn("SELECT sum(cash_fee) FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b and status>0 ",array(":a"=>$user['pcate'],":b"=>$date));
		$feerefound=pdo_fetchcolumn("SELECT sum(cash_fee) FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate=:b and refundstatus>0 ",array(":a"=>$user['pcate'],":b"=>$date));
	}
	
	$allpage=0;
	if($total < $psize){
		$allpage = 1;
	}else{
		$allpage = $total % $psize == 0 ? $total / $psize : $total / $psize + 1;
	}
	if(count($list)){
		die(json_encode(array("success"=>true,"item"=>$list,"allpage"=>$allpage,"total"=>$total,"feetotal"=>$feetotal,"feerefound"=>$feerefound)));
	}else{
		die(json_encode(array("success"=>false,"msg"=>"没有记录")));
	}
}elseif($operation=="getcounterrecord"){
	$islogin=$_GPC['islogin'];
	if(!$islogin)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$islogin));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and userid=:a and createdate=:c and status=1 order by id desc",array(":a"=>$user['id'],":c"=>date("Y-m-d")));
	$cash_fee_wechat=0;
	$cash_fee_ali=0;
	$i=0;
	$templist=array();
	foreach($list as $row){
		if($row['status']){
			if($row['paytype']){
				$cash_fee_ali=$cash_fee_ali+$row['cash_fee'];
			}else{
				$cash_fee_wechat=$cash_fee_wechat+$row['cash_fee'];
			}
		}
		if($i<10){
			$templist[$i]=$row;
			$templist[$i]['tradeno']=substr($row['out_trade_no'],-1,4);
			$templist[$i]['paytype']=$row['paytype'];
			$templist[$i]['createtime']=date("H:i",$row['createtime']);
			$templist[$i]['total_fee']=sprintf('%.2f',($row['total_fee']/100));
			$templist[$i]['cash_fee']=sprintf('%.2f',($row['cash_fee']/100));
		}
		$i++;
	}
	$num=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and userid=:a and createtime>=:b and createtime<=:c",array(':a'=>$userid,":b"=>$user['lasttime'],":c"=>TIMESTAMP));
	die(json_encode(array("success"=>true,"num"=>$num,"item"=>$templist,"fee1"=>sprintf('%.2f',($cash_fee_wechat/100)),"fee2"=>sprintf('%.2f',($cash_fee_ali/100)))));
	
}elseif($operation=="printorder"){
	$userid=$_GPC['userid'];
	$tradeid=$_GPC['orderid'];
	$type=$_GPC['type'];
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id and status=1",array(":id"=>$userid));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	
	$cfg = $this->module['config'];
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$tradeid));
	$printid=$shop['payreceipt'];
	if($type!=0){
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$tradeid));
		$printid=$shop['couponreceipt'];
	}
	if(!$trade)die(json_encode(array("success"=>false,"msg"=>"交易为空")));
	
	$print=pdo_fetch("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and pcate=:a order by isdefault desc,id desc",array(":a"=>$type));
	if($printid){
		$print=pdo_fetch("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$printid));
	}
	if(!$print)die(json_encode(array("success"=>false,"msg"=>"没有打印模板")));
	
	if(!$type){
		$data=array("CFT"=>"零钱包","ICBC_DEBIT"=>"工商银行(借记卡)","ICBC_CREDIT"=>"工商银行(信用卡)","ABC_DEBIT"=>"农业银行(借记卡)","ABC_CREDIT"=>"农业银行(信用卡)","PSBC_DEBIT"=>"邮政储蓄银行(借记卡)","PSBC_CREDIT"=>"邮政储蓄银行(信用卡)","CCB_DEBIT"=>"建设银行(借记卡)","CCB_CREDIT"=>"建设银行(信用卡)","CMB_DEBIT"=>"招商银行(借记卡)","CMB_CREDIT"=>"招商银行(信用卡)","BOC_DEBIT"=>"中国银行(借记卡)","BOC_CREDIT"=>"中国银行(信用卡)","COMM_DEBIT"=>"交通银行(借记卡)","SPDB_DEBIT"=>"浦发银行(借记卡)","SPDB_CREDIT"=>"浦发银行(信用卡)","GDB_DEBIT"=>"广发银行(借记卡)","GDB_CREDIT"=>"广发银行(信用卡)","CMBC_DEBIT"=>"民生银行(借记卡)","CMBC_CREDIT"=>"民生银行(信用卡)","PAB_DEBIT"=>"平安银行(借记卡)","PAB_CREDIT"=>"平安银行(信用卡)","CEB_DEBIT"=>"光大银行(借记卡)","CEB_CREDIT"=>"光大银行(信用卡)","CIB_DEBIT"=>"兴业银行(借记卡)","CIB_CREDIT"=>"兴业银行(信用卡)","CITIC_DEBIT"=>"中信银行(借记卡)","CITIC_CREDIT"=>"中信银行(信用卡)","BOSH_DEBIT"=>"上海银行(借记卡)","BOSH_CREDIT"=>"上海银行(信用卡)","CRB_DEBIT"=>"华润银行(借记卡)","HZB_DEBIT"=>"杭州银行(借记卡)","HZB_CREDIT"=>"杭州银行(信用卡)","BSB_DEBIT"=>"包商银行(借记卡)","BSB_CREDIT"=>"包商银行(信用卡)","CQB_DEBIT"=>"重庆银行(借记卡)","SDEB_DEBIT"=>"顺德农商行(借记卡)","SZRCB_DEBIT"=>"深圳农商银行(借记卡)","HRBB_DEBIT"=>"哈尔滨银行(借记卡)","BOCD_DEBIT"=>"成都银行(借记卡)","GDNYB_DEBIT"=>"南粤银行(借记卡)","GDNYB_CREDIT"=>"南粤银行(信用卡)","GZCB_DEBIT"=>"广州银行(借记卡)","GZCB_CREDIT"=>"广州银行(信用卡)","JSB_DEBIT"=>"江苏银行(借记卡)","JSB_CREDIT"=>"江苏银行(信用卡)","NBCB_DEBIT"=>"宁波银行(借记卡)","NBCB_CREDIT"=>"宁波银行(信用卡)","NJCB_DEBIT"=>"南京银行(借记卡)","JZB_DEBIT"=>"晋中银行(借记卡)","KRCB_DEBIT"=>"昆山农商(借记卡)","LJB_DEBIT"=>"龙江银行(借记卡)","LNNX_DEBIT"=>"辽宁农信(借记卡)","LZB_DEBIT"=>"兰州银行(借记卡)","WRCB_DEBIT"=>"无锡农商(借记卡)","ZYB_DEBIT"=>"中原银行(借记卡)","ZJRCUB_DEBIT"=>"浙江农信(借记卡)","WZB_DEBIT"=>"温州银行(借记卡)","XAB_DEBIT"=>"西安银行(借记卡)","JXNXB_DEBIT"=>"江西农信(借记卡)","NCB_DEBIT"=>"宁波通商银行(借记卡)","NYCCB_DEBIT"=>"南阳村镇银行(借记卡)","NMGNX_DEBIT"=>"内蒙古农信(借记卡)","SXXH_DEBIT"=>"陕西信合(借记卡)","SRCB_CREDIT"=>"上海农商银行(信用卡)","SJB_DEBIT"=>"盛京银行(借记卡)","SDRCU_DEBIT"=>"山东农信(借记卡)","SRCB_DEBIT"=>"上海农商银行(借记卡)","SCNX_DEBIT"=>"四川农信(借记卡)","QLB_DEBIT"=>"齐鲁银行(借记卡)","QDCCB_DEBIT"=>"青岛银行(借记卡)","PZHCCB_DEBIT"=>"攀枝花银行(借记卡)","ZJTLCB_DEBIT"=>"浙江泰隆银行(借记卡)","TJBHB_DEBIT"=>"天津滨海农商行(借记卡)","WEB_DEBIT"=>"微众银行(借记卡)","YNRCCB_DEBIT"=>"云南农信(借记卡)","WFB_DEBIT"=>"潍坊银行(借记卡)","WHRC_DEBIT"=>"武汉农商行(借记卡)","ORDOSB_DEBIT"=>"鄂尔多斯银行(借记卡)","XJRCCB_DEBIT"=>"新疆农信银行(借记卡)","ORDOSB_CREDIT"=>"鄂尔多斯银行(信用卡)","CSRCB_DEBIT"=>"常熟农商银行(借记卡)","JSNX_DEBIT"=>"江苏农商行(借记卡)","GRCB_CREDIT"=>"广州农商银行(信用卡)","GLB_DEBIT"=>"桂林银行(借记卡)","GDRCU_DEBIT"=>"广东农信银行(借记卡)","GDHX_DEBIT"=>"广东华兴银行(借记卡)","FJNX_DEBIT"=>"福建农信银行(借记卡)","DYCCB_DEBIT"=>"德阳银行(借记卡)","DRCB_DEBIT"=>"东莞农商行(借记卡)","CZCB_DEBIT"=>"稠州银行(借记卡)","CZB_DEBIT"=>"浙商银行(借记卡)","CZB_CREDIT"=>"浙商银行(信用卡)","GRCB_DEBIT"=>"广州农商银行(借记卡)","CSCB_DEBIT"=>"长沙银行(借记卡)","CQRCB_DEBIT"=>"重庆农商银行(借记卡)","CBHB_DEBIT"=>"渤海银行(借记卡)","BOIMCB_DEBIT"=>"内蒙古银行(借记卡)","BOD_DEBIT"=>"东莞银行(借记卡)","BOD_CREDIT"=>"东莞银行(信用卡)","BOB_DEBIT"=>"北京银行(借记卡)","BNC_DEBIT"=>"江西银行(借记卡)","BJRCB_DEBIT"=>"北京农商行(借记卡)","AE_CREDIT"=>"AE(信用卡)","GYCB_CREDIT"=>"贵阳银行(信用卡)","JSHB_DEBIT"=>"晋商银行(借记卡)","JRCB_DEBIT"=>"江阴农商行(借记卡)","JNRCB_DEBIT"=>"江南农商(借记卡)","JLNX_DEBIT"=>"吉林农信(借记卡)","JLB_DEBIT"=>"吉林银行(借记卡)","JJCCB_DEBIT"=>"九江银行(借记卡)","HXB_DEBIT"=>"华夏银行(借记卡)","HXB_CREDIT"=>"华夏银行(信用卡)","HUNNX_DEBIT"=>"湖南农信(借记卡)","HSB_DEBIT"=>"徽商银行(借记卡)","HSBC_DEBIT"=>"恒生银行(借记卡)","HRXJB_DEBIT"=>"华融湘江银行(借记卡)","HNNX_DEBIT"=>"河南农信(借记卡)","HKBEA_DEBIT"=>"东亚银行(借记卡)","HEBNX_DEBIT"=>"河北农信(借记卡)","HBNX_DEBIT"=>"湖北农信(借记卡)","HBNX_CREDIT"=>"湖北农信(信用卡)","GYCB_DEBIT"=>"贵阳银行(借记卡)","GSNX_DEBIT"=>"甘肃农信(借记卡)","JCB_CREDIT"=>"JCB(信用卡)","MASTERCARD_CREDIT"=>"MASTERCARD(信用卡)","VISA_CREDIT"=>"VISA(信用卡)");
		$content=$print['content'];
		$printDoc=str_replace("|#收银员姓名#|",$user['realname'],$content);
		$printDoc=str_replace("|#店铺名称#|",$shop['companyname'],$printDoc);
		$printDoc=str_replace("|#收银时间#|",$trade['time_end'] ? date("Y-m-d H:i:s",$trade['time_end']) : 0,$printDoc);
		$printDoc=str_replace("|#总金额#|",sprintf('%.2f',($trade['total_fee']/100)),$printDoc);
		$printDoc=str_replace("|#优惠金额#|",sprintf('%.2f',($trade['coupon_fee']/100)),$printDoc);
		$printDoc=str_replace("|#实收金额#|",sprintf('%.2f',($trade['cash_fee']/100)),$printDoc);
		$printDoc=str_replace("|#付款银行#|",$trade['paytype'] ? "支付宝" : "微信".$data[$trade['bank_type']],$printDoc);
		$printDoc=str_replace("|#付款终端#|",$trade['attach']=='-' || $trade['attach']=='PC' ? "电脑端" : "移动端",$printDoc);
		$printDoc=str_replace("|#单号#|",$trade['out_trade_no'],$printDoc);
		$printDoc=str_replace("|#原单号#|",$trade['old_trade_no'],$printDoc);
		$qrcode1=encrypt($tradeid, 'E', $cfg['encryptcode']);
		$qrcode=urlencode(base64_encode($qrcode1));
		$uniacid=$cfg['creadit_uniacid'] ? $cfg['creadit_uniacid'] : $_W['uniacid'];
		$url=trueUrl2Shorturl($_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=getcredit&m=j_money&qrcode=".$qrcode);
		$printDoc=str_replace("|#积分二维码#|",$url,$printDoc);
	}else{
		$cardtype=array("discount"=>"折扣券","cash"=>"代金券","gift"=>"礼品券","groupon"=>"团购券","general_coupon"=>"优惠券",);
		$content=$print['content'];
		$printDoc=str_replace("|#收银员姓名#|",$user['realname'],$content);
		$printDoc=str_replace("|#店铺名称#|",$shop['companyname'],$printDoc);
		$printDoc=str_replace("|#兑换时间#|",date("Y-m-d H:i:s",$trade['createtime']),$printDoc);
		$printDoc=str_replace("|#卡券内容#|",$trade['description'],$printDoc);
		$printDoc=str_replace("|#卡券标题#|",$trade['title'],$printDoc);
		$printDoc=str_replace("|#卡券副标题#|",$trade['sub_title'],$printDoc);
		$printDoc=str_replace("|#卡券类型#|",$cardtype[$trade['type']],$printDoc);
		switch($trade['type']){
			case "gift":
			case "groupon":
			case "general_coupon":
				$trade1["typestr"]=$trade['extra'];
			break;
			case "discount":
				$trade1["typestr"]="".sprintf('%.2f',($trade['extra']/100))."折";
			break;
			case "cash":
				$extra=iunserializer($trade['extra']);
				$trade1["typestr"]="满".$extra['least_cost']."减".$extra['reduce_cost'];
			break;
		}
		$printDoc=str_replace("|#卡券优惠#|",$trade1["typestr"],$printDoc);
	}
	$pagewidth=$shop['printpagewidth'] ? $shop['printpagewidth'] : $cfg['printpagewidth'] ? intval($cfg['printpagewidth'])*100 : 5700 ;
	die(json_encode(array("success"=>true,"printdoc"=>$printDoc,"pagewidth"=>$pagewidth)));
}elseif($operation=="getupdate"){
	$version=pdo_fetchcolumn("SELECT version FROM ".tablename("modules")." WHERE `name` ='j_money' limit 1");
	die(json_encode(array("version"=>$version,"fileurl"=>$cfg['softupdate'])));
}elseif($operation=="soft_pay"){
	$qrcode=$_GPC["qrcode"];
	$fee=$_GPC["fee"] ? $_GPC["fee"] : 1;
	$deviceinfo=intval($_GPC["userid"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	load()->func('communication');
	$fee=intval($fee*100);
	$totalfee=intval($fee);
	$coupon_fee=0;
	$marketid=0;
	$marketing=pdo_fetch("SELECT * FROM ".tablename('j_money_marketing')." WHERE weid='{$_W['uniacid']}' and groupid=:d and starttime<=:a and endtime>=:b and status=1 and condition_fee<=:c order by displayorder asc ,id desc limit 1",array(":a"=>TIMESTAMP,":b"=>TIMESTAMP,":c"=>$fee,":d"=>$user['pcate']));
	$userinfo=$this->authcode2openid($qrcode,$deviceinfo);
	if($marketing && $marketing['favorabletype']==1){
		if($marketing['condition']>1 && $userinfo['openid']){
			$flag=false;
			switch($marketing['condition']){
				case 4://首次关注
					$flag=true;
				break;
				case 2:
					//指定级别会员
					load()->model('mc');
					$uid=mc_openid2uid($userinfo['openid']);
					if($uid){
						$u_groupid=mc_fetch($userinfo['openid']);
						$groupary=strpos($marketing['condition_member'],",") ? explode(",",$marketing['condition_member']):array($marketing['condition_member']);
						if(!in_array($u_groupid['groupid'],$groupary))$flag=true;
					}
				break;
				case 3:
					//首次使用微支付
					$isAdd=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE openid=:a",array(":a"=>$userinfo['openid']));
					if(!$isAdd)$flag=true;
				break;
				case 5:
					//关注公众号时长
					$followtime=pdo_fetchcolumn("SELECT followtime FROM ".tablename('mc_mapping_fans')." WHERE openid=:a",array(":a"=>$userinfo['openid']));
					if($followtime){
						if(TIMESTAMP-$followtime>=$marketing['condition_attendtime']*86400){
							$flag=true;
						}
					}
				break;
			}
			if(!$flag)goto scan2tpay;
		}
		//小时判断
		if($marketing['hour']){
			$hourary=strpos($marketing['hour'],",") ? explode(",",$marketing['hour']):array($marketing['hour']);
			if(!in_array(date("H"),$hourary))goto scan2tpay;
		}
		//人数判断
		if($marketing['num']){
			$numuser=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and status>0 and marketing=:a and createdate =:b ",array(":a"=>$marketing['id'],":b"=>date('Y-m-d')));
			if($marketing['isallnum']){
				$numuser=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and status>0 and marketing=:a ",array(":a"=>$marketing['id']));
			}
			if($numuser>=$marketing['num'])goto scan2tpay;
		}
		$favorable=$marketing['favorable'];
		if(strpos($favorable,"|#满减#|")){
			$temp=str_replace("[|#满减#|","",$favorable);
			$temp=str_replace("]","",$temp);
			$favorAry=explode("-",$temp);
			if(count($favorAry)>1){
				$favorAry1=strpos($favorAry[0],"%") ? intval(str_replace("%","",$favorAry[0])*0.01*$fee) : $favorAry[0]*100;
				$favorAry2=strpos($favorAry[1],"%") ? intval(str_replace("%","",$favorAry[1])*0.01*$fee) : $favorAry[1]*100;
				if($favorAry1>=$favorAry2){
					$coupon_fee=$favorAry1;
				}else{
					$coupon_fee=mt_rand($favorAry1,$favorAry2);
				}
				if($marketing['isint']){
					$coupon_fee=intval(sprintf('%.2f',($coupon_fee*0.01)))*100;
				}
				if(count($favorAry)==3){
					if($coupon_fee>$favorAry[2]*100)$coupon_fee=$favorAry[2]*100;
				}
				if($coupon_fee>=$fee)$coupon_fee=0;
				$fee=$fee-$coupon_fee;
				$marketid=$marketing['id'];
			}
		}
	}
	scan2tpay:	
	if(substr($qrcode,0,1)==1){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"outTradeNo"=>strval(date("YmdHis")),
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
		);
		$pay_signkey=trim($shop['pay_signkey']) ? trim($shop['pay_signkey']) : trim($cfg['pay_signkey']);
		$pageparama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"mch_id"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"device_info"=>$deviceinfo,
			"nonce_str"=>getNonceStr(),
			"body"=>"微支付收款",
			"detail"=>"微支付收款",
			"attach"=>"-",
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$fee,
			"fee_type"=>"CNY",
			"spbill_create_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"goods_tag"=>"000001",
			"auth_code"=>$qrcode,
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		//插入数据
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$deviceinfo,
			"groupid"=>$user['pcate'],
			"attach"=> isset($_GPC['attach']) ? $_GPC['attach'] : 'mobile',
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$totalfee,
			"coupon_fee"=>$coupon_fee,
			"cash_fee"=>$fee,
			"marketing"=>$marketid,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		if($marketid)$data['marketing_log']=$marketing['description'];
		pdo_insert("j_money_trade",$data);
		$sign=MakeSign($pageparama,$pay_signkey);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
		$result=FromXml($response);
		if($result['result_code']!='SUCCESS'){
			pdo_update("j_money_trade",array("log"=>"收款失败：".$result['err_code_des']),array("out_trade_no"=>$payParama['outTradeNo']));
			if($result['err_code']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'],"items"=>$data)));
			}
			die(json_encode(array("success"=>false,"msg"=>$result['err_code_des'])));
		}
		$insertInfo=array(
			"openid"=>$result['openid'],
			"is_subscribe"=>$result['is_subscribe']=="Y" ? 1 : 0,
			"sub_openid"=>isset($result['sub_openid']) ? $result['sub_openid'] : "",
			"sub_is_subscribe"=>isset($result['sub_is_subscribe']) && $result['sub_is_subscribe']=="Y" ? 1 : 0,
			"trade_type"=>$result['trade_type'],
			"bank_type"=>$result['bank_type'],
			"fee_type"=>$result['CNY'],
			"transaction_id"=>$result['transaction_id'],
			"time_end"=>strtotime($result['time_end']),
		);
		if(!intval($data['total_fee']))$insertInfo["total_fee"]=intval($result['total_fee']);
		if(intval($result['cash_fee']))$insertInfo["cash_fee"]=intval($result['cash_fee']);
		if(intval($result['settlement_total_fee']))$insertInfo['cash_fee']=$result['settlement_total_fee'];
		$insertInfo['isconfirm']=1;
		$insertInfo['status']=1;
		if($result['cash_fee']>intval($data['total_fee'])){
			$insertInfo['status']=0;
			die(json_encode(array("success"=>false,"msg"=>"未知异常")));
		}
		pdo_update("j_money_trade",$insertInfo,array("out_trade_no"=>$payParama['outTradeNo']));
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$payParama['outTradeNo']));
		die(json_encode(array("success"=>true,"out_trade_no"=>$payParama['outTradeNo'],"items"=>$trade)));
	
	}else{
		$payParama=array(
			"outTradeNo"=>strval(date("YmdHis")),
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		$auth_code = trim($qrcode);
		$total_amount = $fee;
		$subject = $shop["companyname"];
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$deviceinfo,
			"groupid"=>$user['pcate'],
			"attach"=>"mobile",
			"paytype"=>1,
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$totalfee,
			"coupon_fee"=>$coupon_fee,
			"cash_fee"=>$fee,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"marketing"=>$marketid,
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		if($marketid)$data['marketing_log']=$marketing['description'];
		pdo_insert("j_money_trade",$data);
		$postfee=sprintf('%.2f',($fee*0.01));
		require_once '../addons/j_money/F2fpay.php';
		$f2fpay = new F2fpay();
		$response = $f2fpay->barpay($payParama['outTradeNo'],$auth_code,$postfee,$subject,$payParama);
		$temp=(array)$response;
		$result=(array)$temp['alipay_trade_pay_response'];
		if($result['code']=="10003"){
			die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'],"items"=>$data)));
		}elseif($result['code']=="10000"){
			$insertdata=array(
				"status"=>1,
				"isconfirm"=>1,
				"transaction_id"=>$result['trade_no'],
				"time_end"=>strtotime($result['gmt_payment']),
			);
			pdo_update("j_money_trade",$insertdata,array("out_trade_no"=>$payParama['outTradeNo']));
			$item=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE out_trade_no=:a",array(":a"=>$payParama['outTradeNo']));
			die(json_encode(array("success"=>true,"out_trade_no"=>$payParama['outTradeNo'],"items"=>$item)));
		}else{
			pdo_update("j_money_trade",array("log"=>"收款失败：".$result['sub_msg']),array("out_trade_no"=>$payParama['outTradeNo']));
			die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
		}
		die();
	}
}elseif($operation=="soft_paywaitpassword"){
	$userid=$_GPC['userid'];
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id and status=1",array(":id"=>$userid));
	$orderid=$_GPC["out_trade_no"];
	load()->func('communication');
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$orderid));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$trade['groupid']));
	if($trade['paytype']==0){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"outTradeNo"=>$orderid,
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
		);
		$pageparama=array(
			"appid"=>$payParama['appid'],
			"mch_id"=>strval($payParama['pay_mchid']),
			"out_trade_no"=>$orderid,
			"nonce_str"=>getNonceStr(),
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		$sign=MakeSign($pageparama,$payParama['pay_signkey']);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/orderquery", 10);
		$result=FromXml($response);
		//var_dump($trade);
		if($result['result_code']=='SUCCESS'){
			if($result['trade_state']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$orderid)));
			}elseif($result['trade_state']=='SUCCESS'){
				$insertInfo=array(
					"openid"=>$result['openid'],
					"cash_fee"=>$result['cash_fee'],
					"is_subscribe"=>$result['is_subscribe']=="Y" ? 1 : 0,
					"sub_openid"=>isset($result['sub_openid']) ? $result['sub_openid'] : "",
					"sub_is_subscribe"=>isset($result['sub_is_subscribe']) && $result['sub_is_subscribe']=="Y" ? 1 : 0,
					"trade_type"=>$result['trade_type'],
					"bank_type"=>$result['bank_type'],
					"fee_type"=>$result['CNY'],
					"transaction_id"=>$result['transaction_id'],
					"time_end"=>strtotime($result['time_end']),
					"isconfirm"=>1,
					"status"=>1,
				);
				pdo_update("j_money_trade",$insertInfo,array("id"=>$trade['id']));
				die(json_encode(array("success"=>true,"out_trade_no"=>$orderid)));
			}
		}
		die(json_encode(array("success"=>false,"msg"=>$result['return_msg'].$result['err_code_des'])));
		
	}else{
		$payParama=array(
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"outTradeNo"=>$orderid,
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		require_once '../addons/j_money/F2fpay.php';
		$cfg = $this->module['config'];
		$f2fpay = new F2fpay();
		$response = $f2fpay->query($orderid,$payParama);
		$results=@json_decode(json_encode($response),true);
		$result=$results['alipay_trade_query_response'];
		if($result['code']==10003){
			pdo_update("j_money_trade",array("log"=>"等待客户支付密码"),array("out_trade_no"=>$orderid));
			die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$orderid)));
		}elseif($result['code']==10000){
			if($result['trade_status']=="TRADE_SUCCESS"){
				$insertdata=array(
					"status"=>1,
					"isconfirm"=>1,
					"transaction_id"=>$result['trade_no'],
					"time_end"=>strtotime($result['gmt_payment']),
				);
				pdo_update("j_money_trade",$insertdata,array("out_trade_no"=>$orderid));
				die(json_encode(array("success"=>true,"out_trade_no"=>$orderid)));
			}elseif($result['trade_status']=="TRADE_CLOSED"){
				die(json_encode(array("success"=>false,"msg"=>"订单已退款或已关闭")));
			}
			die(json_encode(array("success"=>false,"msg"=>$result['trade_status'])));
		}else{
			pdo_update("j_money_trade",array("log"=>"收款失败：".$result['sub_msg']),array("out_trade_no"=>$orderid));
			die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
		}
		die(json_encode(array("success"=>false,"msg"=>"未知错误")));
	}
	die();
}elseif($operation=="soft_success"){
	$deviceinfo=intval($_GPC["userid"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	load()->func('communication');
	$this->jetSumpay($_GPC['out_trade_no']);
	die();
}elseif($operation=="getorderlist"){
	$userid=$_GPC['islogin'];
	$date=$_GPC['date'] ? date("Y-m-d",strtotime($_GPC['date'])) : date('Y-m-d');
	$starttime=$_GPC['starttime'] ? strtotime($_GPC['starttime']." 00:00:00") : strtotime(date('Y-m-d')." 00:00:00");
	$endtime=$_GPC['endtime'] ? strtotime($_GPC['endtime']." 23:59:59") : strtotime(date('Y-m-d')." 23:59:59");
	$keyword=isset($_GPC['keyword']) ? $_GPC['keyword'] : "";
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$userid));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	if($keyword){
		$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:c and out_trade_no=:a order by id desc",array(":c"=>$user['pcate'],":a"=>$keyword));	
	}else{
		$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:c and createtime>=:a and createtime<=:b order by id desc",array(":c"=>$user['pcate'],":a"=>$starttime,":b"=>$endtime));
	}
	$templist=array();
	$i=0;
	foreach($list as $row){
		$templist[$i]=$row;
		$templist[$i]['createtime']=date("H:i",$row['createtime']);
		$templist[$i]['total_fee']=sprintf('%.2f',($row['total_fee']/100));
		$templist[$i]['coupon_fee']=sprintf('%.2f',($row['coupon_fee']/100));
		$templist[$i]['cash_fee']=sprintf('%.2f',($row['cash_fee']/100));
		$i++;
	}
	die(json_encode(array("success"=>true,"num"=>count($list),"list"=>$templist)));
}elseif($operation=="getmemberlist"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$keyword=trim($_GPC['keyword']);
	$where=" and (groupid='".$user['pcate']."' or groupid=0)";
	$where2='';
	if($keyword)$where2=" and wxcardno='".$keyword."' ";
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' $where $where2  order by id desc ");
	
	/*$OpenidList=array();
	foreach($list as $row){
		$OpenidList[]=$row["openid"];
	}
	array_unique($OpenidList);
	$list2=pdo_fetchall("SELECT uid,credit1 FROM ".tablename('mc_members')." WHERE weid='{$_W['uniacid']}' (select uid from ".tablename('mc_mapping_fans')." where openid in('".implode("','",$OpenidList)."') and openid<>'' )  order by id desc ");*/
	
	die(json_encode(array("success"=>true,"list"=>$list,"num"=>count($list))));
}elseif($operation=="getchargelist"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$keyword=trim($_GPC['keyword']);
	$starttime=$_GPC['starttime'] ? strtotime($_GPC['starttime']." 00:00:00") : strtotime(date('Y-m-d')." 00:00:00");
	$endtime=$_GPC['endtime'] ? strtotime($_GPC['endtime']." 23:59:59") : strtotime(date('Y-m-d')." 23:59:59");
	$where=" and groupid='".$user['pcate']."' ";
	$where2='';
	if($ds)$where2=" and createtime>=".$starttime." and createtime<=".$endtime."";
	if($keyword)$where2=" and (out_trade_no='".$keyword."' or cardno='".$keyword."') ";
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' $where $where2 order by id desc ");
	die(json_encode(array("success"=>true,"list"=>$list,"num"=>count($list))));	
}elseif($operation=="recharge_waitpass"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$user['pcate']));
	$out_trade_no=$_GPC["out_trade_no"];
	load()->func('communication');
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
	if($trade['paytype']<2)die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>false,"out_trade_no"=>$out_trade_no)));
	if($trade['paytype']==2){
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
		if($result['result_code']=='SUCCESS'){
			if($result['trade_state']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$out_trade_no)));
			}
			$data=array(
				"status"=>1,
			);
			pdo_update("j_money_recharge",$data,array("id"=>$trade['id']));
			if($trade['status']==0){
				die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>true,"out_trade_no"=>$out_trade_no)));
			}
			die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>false,"out_trade_no"=>$out_trade_no)));
		}
		die(json_encode(array("success"=>false,"msg"=>$result['trade_state_desc'].$result['err_code_des'])));
	}else{
		$payParama=array(
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
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
			die(json_encode(array("success"=>true,"paywait"=>true,"msg"=>"等待客户支付密码","out_trade_no"=>$orderid)));
		}elseif($result['code']==10000){
			if($result['trade_status']=="TRADE_SUCCESS"){
				$data=array(
					"status"=>1,
				);
				pdo_update("j_money_recharge",$insertdata,array("out_trade_no"=>$orderid));
				$isnew=false;
				if($trade["status"]==0)$isnew=true;
				die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>$isnew,"out_trade_no"=>$out_trade_no)));
			}elseif($result['trade_status']=="TRADE_CLOSED"){
				die(json_encode(array("success"=>false,"msg"=>"订单已退款或已关闭")));
			}elseif($result['trade_status']=="WAIT_BUYER_PAY"){
				die(json_encode(array("success"=>true,"paywait"=>true,"msg"=>"等待客户支付密码","out_trade_no"=>$orderid)));
			}else{
				die(json_encode(array("success"=>false,"msg"=>$result['trade_status'])));
			}
		}
		die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
	}
}elseif($operation=="pay_member"){
	//var_dump($_GPC);
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$cardno=$_GPC["cardno"];
	$outTradeNo=TIMESTAMP;
	$totalfee=$_GPC['fee']*100;
	$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and wxcardno=:a ",array(":a"=>$cardno));
	if(!$membercard)die(json_encode(array("success"=>false,"msg"=>"会员卡不存在")));
	if($membercard['cash']<$totalfee)die(json_encode(array("success"=>false,"msg"=>"会员卡余额不足")));
	if($membercard['password']){
		if($membercard['password']!=md5($_GPC['password']))die(json_encode(array("success"=>false,"msg"=>"支付密码错误")));
	}
	if($membercard['groupid'] && $membercard['groupid']!=$shop['id'])die(json_encode(array("success"=>false,"msg"=>"该卡不能在本店使用")));
	$market=$this->MarketingTest($totalfee,$shop['id'],$deviceinfo,$membercard['openid']);
	$coupon_fee=$market['coupon_fee'];
	$marketid=$market['marketid'];
	$data=array(
		"weid"=>$_W['uniacid'],
		"userid"=>$deviceinfo,
		"groupid"=>$user['pcate'],
		"attach"=>$_GPC['attach'] ? $_GPC['attach'] :'PC',
		"out_trade_no"=>$outTradeNo,
		"order_fee"=>$totalfee,
		"total_fee"=>$totalfee-$coupon_fee,
		"discount_fee"=>$coupon_fee,
		"marketing"=>$marketid,
		"createtime"=>TIMESTAMP,
		"createdate"=>date('Y-m-d'),
		"paytype"=>4,
		"openid"=>$membercard['openid'],
		"memberno"=>$cardno,
		"status"=>1,
		"old_trade_no"=>$_GPC['old_trade_no'],
		"time_end"=>TIMESTAMP,
	);
	pdo_insert("j_money_trade",$data);
	pdo_update("j_money_memebercard",array("cash"=>$membercard['cash']-$data["total_fee"]),array("id"=>$membercard['id']));
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$payParama['outTradeNo']));
	die(json_encode(array("success"=>true,"items"=>$trade,"out_trade_no"=>$outTradeNo)));
	
}elseif($operation=="rechargecard"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	load()->func('communication');
	$cardno=trim($_GPC['cardno']);
	$fee=floatval($_GPC['fee'])*100;
	$paytype=trim($_GPC['paytype']);
	$code=trim($_GPC['code']);
	if(!$cardno || !$fee)die(json_encode(array("success"=>false,"msg"=>"输入字段缺失")));
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and wxcardno=:a ",array(":a"=>$cardno));
	if(!$item)die(json_encode(array("success"=>false,"msg"=>"卡号不存在")));
	$outTradeNo=strval(date("ymdHis"));
	$insert=array(
		"weid"=>$_W['uniacid'],
		"userid"=>$deviceinfo,
		"groupid"=>$user['pcate'],
		"out_trade_no"=>$outTradeNo,
		"cardno"=>$cardno,
		"remark"=>$code,
		"paytype"=>$paytype,
		"cash"=>$fee,
		"createtime"=>TIMESTAMP,
		"createdate"=>date("Y-m-d"),
		"status"=>0,
	);
	pdo_insert('j_money_recharge',$insert);
	if($paytype<2)goto payChargeEnd;
	if($paytype==2){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"outTradeNo"=>$outTradeNo,
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
		);
		$pay_signkey=trim($shop['pay_signkey']) ? trim($shop['pay_signkey']) : trim($cfg['pay_signkey']);
		$pageparama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"mch_id"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"device_info"=>$deviceinfo,
			"nonce_str"=>getNonceStr(),
			"body"=>$shop['companyname']."-充值",
			"detail"=>"微信充值",
			"attach"=>"PC",
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$fee,
			"fee_type"=>"CNY",
			"spbill_create_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"goods_tag"=>"000001",
			"auth_code"=>$code,
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		$sign=MakeSign($pageparama,$pay_signkey);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
		$result=FromXml($response);
		#var_dump($result);
		if($result['result_code']!='SUCCESS'){
			if($result['err_code']=='USERPAYING'){
				pdo_update('j_money_recharge',array("status"=>0,"log"=>"收款失败：客户未输入支付密码"),array("out_trade_no"=>$outTradeNo));
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'])));
			}
			pdo_update('j_money_recharge',array("status"=>0,"log"=>"收款失败：".$result['err_code_des']),array("out_trade_no"=>$outTradeNo));
			die(json_encode(array("success"=>false,"msg"=>$result['err_code_des'])));
		}
	}elseif($paytype==3){
		$payParama=array(
			"outTradeNo"=>strval(date("ymdHis")),
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		$auth_code = trim($code);
		$total_amount = $fee;
		$subject = $shop['companyname'];
		$postfee=sprintf('%.2f',($insert['cash']*0.01));
		require_once '../addons/j_money/F2fpay.php';
		$f2fpay = new F2fpay();
		$response = $f2fpay->barpay($payParama['outTradeNo'],$auth_code,$postfee,$subject,$payParama);
		$temp=(array)$response;
		$result=(array)$temp['alipay_trade_pay_response'];
		if($result['code']=="10003"){
			pdo_update("j_money_recharge",array("log"=>"收款失败：客户未输入支付密码"),array("out_trade_no"=>$payParama['outTradeNo']));
			die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'])));
		}elseif($result['code']!="10000"){
			pdo_update("j_money_recharge",array("log"=>"收款失败：".$result['sub_msg']),array("out_trade_no"=>$payParama['outTradeNo']));
			die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
		}
	}
	payChargeEnd:
	pdo_update('j_money_recharge',array("status"=>1),array("out_trade_no"=>$outTradeNo));
	$creaditper=$shop['creadit'] ? $shop['creadit'] : $cfg['creadit'];
	$creadit=sprintf('%.2f',$creaditper*$fee);
	pdo_update('j_money_memebercard',array("cash"=>$item['cash']+$fee,"creadit"=>$item['creadit']+$creadit),array("id"=>$item['id']));
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$item['id']));
	die(json_encode(array("success"=>true,"item"=>$item,"ordersn"=>$outTradeNo)));
}elseif($operation=="recharge_waitpass"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$user['pcate']));
	$out_trade_no=$_GPC["out_trade_no"];
	load()->func('communication');
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
	if($trade['paytype']==2){
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
		if($result['result_code']=='SUCCESS'){
			if($result['trade_state']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$out_trade_no)));
			}
			$data=array(
				"status"=>1,
			);
			pdo_update("j_money_recharge",$data,array("id"=>$trade['id']));
			if($trade['status']==0){
				die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>true,"out_trade_no"=>$out_trade_no)));
			}
			die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>false,"out_trade_no"=>$out_trade_no)));
		}
		die(json_encode(array("success"=>false,"msg"=>$result['trade_state_desc'].$result['err_code_des'])));
	}else{
		$payParama=array(
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
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
			die(json_encode(array("success"=>true,"paywait"=>true,"msg"=>"等待客户支付密码","out_trade_no"=>$orderid)));
		}elseif($result['code']==10000){
			if($result['trade_status']=="TRADE_SUCCESS"){
				$data=array(
					"status"=>1,
				);
				pdo_update("j_money_recharge",$insertdata,array("out_trade_no"=>$orderid));
				$isnew=false;
				if($trade["status"]==0)$isnew=true;
				die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>$isnew,"out_trade_no"=>$out_trade_no)));
			}elseif($result['trade_status']=="TRADE_CLOSED"){
				die(json_encode(array("success"=>false,"msg"=>"订单已退款或已关闭")));
			}elseif($result['trade_status']=="WAIT_BUYER_PAY"){
				die(json_encode(array("success"=>true,"paywait"=>true,"msg"=>"等待客户支付密码","out_trade_no"=>$orderid)));
			}else{
				die(json_encode(array("success"=>false,"msg"=>$result['trade_status'])));
			}
		}
		die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
	}
	
}elseif($operation=="checkupdate"){
	$softzip="";
	$printzip="";
	$dir_url='../attachment/j_money/cert_2/'.$_W['uniacid']."/";
	if($cfg['soft_update']){
		if(file_exists($dir_url.$cfg['soft_update'])){
			$softzip=$_W['siteroot']."attachment/j_money/cert_2/".$_W['uniacid']."/".$cfg['soft_update'];
			$softzipMd5 = md5_file($softzip);
		}
	}
	if($cfg['print_update']){
		if(file_exists($dir_url.$cfg['print_update'])){
			$printzip=$_W['siteroot']."attachment/j_money/cert_2/".$_W['uniacid']."/".$cfg['print_update'];
			$printzipMd5 = md5_file($printzip);
		}
	}
	die(json_encode(array("success"=>true,"softzip"=>$softzip,"smd5"=>$softzipMd5,"printzip"=>$printzip,"pmd5"=>$printzipMd5,)));
}elseif($operation=="download_print"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$printList=pdo_fetchall("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and groupid=:a order by isdefault desc,id desc",array(":a"=>$shop['id']));
	die(json_encode(array("success"=>true,"item"=>$printList)));
}elseif($operation=="getonemember"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and wxcardno=:a",array(":a"=>$_GPC['cardno']));
	load()->model('mc');
	$uid=mc_openid2uid($item['openid']);
	$credit=$item["creadit"];
	if($uid){
		$credit2=mc_credit_fetch($uid,array('credit1'));
		$credit=$credit2['credit1']+$credit;
	}
	die(json_encode(array("success"=>true,"realname"=>$item["realname"],"mobile"=>$item["mobile"],"cash"=>sprintf('%.2f',$item['cash']),"credit"=>$credit)));
}elseif($operation=="getuserlist"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$userlist=pdo_fetchall("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and pcate=:a ",array(":a"=>$user['pcate']));
	$list=array();
	foreach($userlist as $row){
		$list[$row['id']]=$row["realname"];
	}
	die(json_encode(array("success"=>true,"list"=>$list)));
}elseif($operation=="update_pay"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	if(!$_GPC['status'])die(json_encode(array("success"=>true)));
	$insert=array(
		"weid"=>$_W['uniacid'],
		"userid"=>$_GPC['userid'],
		"groupid"=>$_GPC['groupid'],
		"out_trade_no"=>$_GPC['out_trade_no'],
		"attach"=>"PC",
		"total_fee"=>$_GPC['total_fee'],
		"order_fee"=>$_GPC['order_fee'],
		"cash_fee"=>$_GPC['cash_fee'],
		"createtime"=>$_GPC['createtime'],
		"status"=>$_GPC['status'],
		"time_end"=>$_GPC['time_end'],
		"isconfirm"=>$_GPC['isconfirm'],
		"memberno"=>$_GPC['memberno'],
		"openid"=>$_GPC['openid'],
		"is_subscribe"=>$_GPC['is_subscribe'],
		"sub_openid"=>$_GPC['sub_openid'],
		"sub_is_subscribe"=>$_GPC['sub_is_subscribe'],
		"trade_type"=>$_GPC['trade_type'],
		"bank_type"=>$_GPC['bank_type'],
		"fee_type"=>$_GPC['fee_type'],
		"createdate"=>$_GPC['createdate'],
		"credit"=>$_GPC['credit'],
		"paytype"=>$_GPC['paytype'],
	);
	$isHad=pdo_fetch("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$_GPC['out_trade_no']));
	if($isHad){
		pdo_update('j_money_trade',$insert,array("out_trade_no"=>$_GPC['out_trade_no']));
	}else{
		pdo_insert('j_money_trade',$insert);
	}
	if($_GPC['paytype']==4){
		$member=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE wxcardno=:a",array(":a"=>$insert['memberno']));
		if($member['cash']<$_GPC['total_fee'])die(json_encode(array("success"=>true,"msg"=>"会员余额不足")));
		pdo_update('j_money_memebercard',array("cash"=>$member['cash']-$_GPC['total_fee']),array("id"=>$member['id']));
		load()->func('communication');
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$tokens=$acc->fetch_token();
		$data=array(
			"card_id"=>$shop["wxcardid"] ?  $shop["wxcardid"] : $cfg["wxcardid"],
			"code"=>$member['wxcardno'],
			"balance"=>$memberCard['cash'],
		);
		$pageparama=urldecode(json_encode($data));
		$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/updateuser?access_token=".$tokens,$pageparama, $xml);
	}
	die(json_encode(array("success"=>true)));
	
}elseif($operation=="update_charge"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	if(!$_GPC['status'])die(json_encode(array("success"=>true)));
	$insert=array(
		"weid"=>$_W['uniacid'],
		"userid"=>$_GPC['userid'],
		"groupid"=>$_GPC['groupid'],
		"out_trade_no"=>$_GPC['out_trade_no'],
		"cardno"=>$_GPC['cardno'],
		"remark"=>$_GPC['remark'],
		"paytype"=>$_GPC['paytype'],
		"cash"=>$_GPC['cash'],
		"createtime"=>$_GPC['createtime'],
		"createdate"=>$_GPC['createdate'],
		"status"=>$_GPC['status'],
	);
	pdo_insert('j_money_recharge',$insert);
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and wxcardno=:a",array(":a"=>$insert['cardno']));
	$creaditper=$shop['creadit'] ? $shop['creadit'] : $cfg['creadit'];
	$creadit=sprintf('%.2f',$creaditper*$insert['cash']);
	pdo_update('j_money_memebercard',array("cash"=>$item['cash']+$insert['cash'],"creadit"=>$item['creadit']+$creadit),array("id"=>$item['id']));
	//---
	$memberCard=pdo_fetch("SELECT * FROM ".tablename("j_money_memebercard")." WHERE id=:a",array(":a"=>$item['id']));
	if($memberCard){
		load()->model('mc');
		$uid=mc_openid2uid($openid);
		if($uid){
			$flag=mc_credit_update($uid,"credit1",$memberCard['creadit'],array("","收银台消费积分转移"));
			if($flag)pdo_update("j_money_memebercard",array("creadit"=>0),array("id"=>$memberCard['id']));
			$creditAry=mc_credit_fetch($uid,array('credit1'));
			$credit=$creditAry['credit1'];
			$user=mc_fetch($uid);
			$menberGid=$user['groupid'];
			if($memberCard['gid']!=$user['groupid']){
				pdo_update("j_money_memebercard",array("gid"=>$user['groupid']),array("id"=>$memberCard['id']));
			}
		}else{
			$credit=$memberCard['creadit'];
		}
	}
	if($credit || $memberCard['cash']){
		$where=" and isdefault=1 ";
		if($menberGid!=0)$where=" and groupid = ".$menberGid."";
		$groupname=pdo_fetchcolumn("SELECT title FROM ".tablename("mc_groups")." WHERE uniacid='".$_W['uniacid']."' $where ");
		load()->func('communication');
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$tokens=$acc->fetch_token();
		$data=array(
			"card_id"=>$shop["wxcardid"] ?  $shop["wxcardid"] : $cfg["wxcardid"],
			"code"=>$memberCard['wxcardno'],
			"bonus"=>intval($credit),
			"balance"=>$memberCard['cash'],
			"custom_field_value1"=>urlencode($groupname),
		);
		$pageparama=urldecode(json_encode($data));
		$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/updateuser?access_token=".$tokens,$pageparama, $xml);
	}
	die(json_encode(array("success"=>true)));
}elseif($operation=="get_token"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$tokens=$acc->fetch_token();
	die(json_encode(array("success"=>true,"tokens"=>$tokens))); 
}
?>
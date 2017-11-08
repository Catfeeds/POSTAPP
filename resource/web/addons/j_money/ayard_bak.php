<?php 
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$shopid = !empty($_GPC['shopid']) ? $_GPC['shopid'] : message("请确认店铺");
$userid = $_GPC['islogin'];
$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$shopid));
if(!$shop)message("请确认店铺");
$cfg = $this->module['config'];
$payType=checkWebBowser();


if(empty($_GPC['op']))
{	
	if($payType==2&& empty($_GPC["alipay_pre"]))	
	{
		include $this->template("pay/store");die();
	}
}

if($operation=="alibuyer"){
	$auth_code=$_GPC['auth_code'];
	if($auth_code){
		load()->func('communication');
		$payParama=array(
			"app_id"=>$_GPC['app_id'],
			//"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		require_once '../addons/j_money/F2fpay.php';
		$f2fpay = new F2fpay();
		$response = $f2fpay->authToken($auth_code,$payParama);
		$temp=(array)$response;
		$result=(array)$temp['alipay_system_oauth_token_response'];
		$app_id=$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'];
		isetcookie('buyer_id_'.$app_id, $result['user_id'], 86400*30);
		
		header("location:".$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=ayard&m=j_money&shopid=".$shopid);
	}
}elseif($operation=="createorder"){
	$fee=$_GPC["fee"]*100;
	if(!$fee)die(json_encode(array("success"=>false,"msg"=>"付款金额不能为空")));
	if(!$payType)die(json_encode(array("success"=>false,"msg"=>"请用微信/支付宝登陆")));
	
	$money=$_GPC["fee"];
	$TotalMoney=sumServerMoney();
	$overtop=$shop['freelimit']-$TotalMoney;
	$serverMoney=0;
	if($overtop>0)
	{
		if($overtop<$money) $serverMoney=($money-$overtop)*$shop['servermoney']/1000;
	}else{
		$serverMoney=$money*$shop['servermoney']/1000;
	}	
	$serverMoney=round($serverMoney,2);
	
	$addition=array(
		"servermoney"=>$serverMoney*100,
		"servertype"=>$_GPC['servertype'],
		"carnumber"=>$_GPC['carnumber'],		
		"userbak"  =>$_GPC['userbak'],
	);
	$fee+=$serverMoney*100;
	
	if($payType==1){
		$openid=$_W['openid'] ? $_W['openid']:$_GPC["openid"."_".$_W['uniacid']];

		$apipay=0;
		if( isset($shop['alipay']) && $shop['apipay']==1)
		    $apipay=1;
		
		if(!$openid)die(json_encode(array("success"=>false,"msg"=>"请使用微信登陆")));
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
			"attach"=>"一码付",
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$fee,
			"fee_type"=>"CNY",
			"spbill_create_ip"=>$payParama['spbill_create_ip'],
			"time_start"=>date("YmdHis"),
			"time_expire"=>date("YmdHis",TIMESTAMP+600),
			"notify_url"=>"http://paysdk.weixin.qq.com/example/notify.php",
			"trade_type"=>"JSAPI",
			"sub_openid"=>$openid,
			"product_id"=>"01",
		);
		
		
		if($apipay==0)
		    $pageparama['trade_type']='NATIVE';
		
		
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		//插入数据
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$user['id'],
			"groupid"=>$shopid,
			"attach"=>"一码付",
			"out_trade_no"=>$payParama['outTradeNo'],
			"cash_fee"=>$fee,
			"order_fee"=>$fee,
			"total_fee"=>$fee,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		$data["openid"]=$openid;
		$data=array_merge($data,$addition);
		pdo_insert("j_money_trade",$data);
		$sign=MakeSign($pageparama,$payParama['pay_signkey']);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/unifiedorder", 10);
		$result=FromXml($response);
		if($result['return_code']!='SUCCESS'){
			die(json_encode(array("success"=>false,"msg"=>$result['return_msg'])));
		}
		if($result['result_code']!='SUCCESS'){
			die(json_encode(array("success"=>false,"msg"=>$result['err_code_des'])));
		}
		
		
		
		if($apipay==1)
		{
		$jsapiParama=array();
		$jsapiParamap['appId']=$result["appid"];
		$jsapiParamap['nonceStr']=$result["nonce_str"];
		$jsapiParamap['package']="prepay_id=" . $result['prepay_id'];
		$jsapiParamap['signType']="MD5";
		$time=time();
		$jsapiParamap['timeStamp']="$time";
		$jsapiParamap['paySign']=MakeSign($jsapiParamap,$payParama['pay_signkey']);
		
		
		die(json_encode(array("success"=>true,"param"=>$jsapiParamap,"out_trade_no"=>$payParama['outTradeNo'])));
		}
		else 
		{
    		//die(json_encode($result));
		       die(json_encode(array("success"=>true,"param"=>$result['code_url'],"isurl"=>"1")));
		}
		
	}elseif($payType==2){
		$payParama=array(
			"outTradeNo"=>TIMESTAMP,
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
		    "sys_service_provider_id"=>$shop['sys_service_provider_id'] ? $shop['sys_service_provider_id'] : $cfg['sys_service_provider_id'],
		    "app_auth_token"=>$shop['app_auth_token'] ? $shop['app_auth_token'] : $cfg['app_auth_token'],
		    "appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'],
		);
//		$_GPC['buyer_id_'.$app_id]
		$openid=$_GPC['buyer_id_'.$payParama['app_id']];
		$data=array(
			"weid"=>$_W['uniacid'],
			"userid"=>$deviceinfo,
			"groupid"=>$shopid,
			"attach"=>"一码付",
			"paytype"=>1,
			"out_trade_no"=>$payParama['outTradeNo'],
			"cash_fee"=>$fee,
			"total_fee"=>$fee,
			"order_fee"=>$fee,
			"createtime"=>TIMESTAMP,
			"createdate"=>date('Y-m-d'),
			"old_trade_no"=>$_GPC['old_trade_no'],
		);
		$data["openid"]=$openid;
		$data=array_merge($data,$addition);
		pdo_insert("j_money_trade",$data);
		
		$postfee=sprintf('%.2f',($fee*0.01));
		require_once '../addons/j_money/F2fpay.php';
		$f2fpay = new F2fpay();
		$response = $f2fpay->creatpay($payParama['outTradeNo'],$postfee,$openid,$shop['companyname'],$payParama);
		//var_dump($response);
		
		
		
		$temp=(array)$response;
		$result=(array)$temp['alipay_trade_create_response'];
		if($result['code']!="10000")die($result['msg']);
		$trade_no=$result['trade_no'];
		die(json_encode(array("success"=>true,"tradeno"=>$result['trade_no'],"out_trade_no"=>$payParama['outTradeNo'])));
	}else{
		die(json_encode(array("success"=>false,"msg"=>"请用微信/支付宝登陆")));
	}
}elseif($operation=="paysuccess"){
	$out_trade_no=$_GPC["ordersn"];
	if(!$out_trade_no)message("单号不能为空");
	load()->func('communication');
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
	if($trade['status']==1)
	{	
		if($_W['ispost'])
		{
			 message("订单已支付成功","","success");
		}else{
			if(!empty($shop["successUrl"]))
			{
				header("Location: ".$shop["successUrl"]);
			
			}else{
				header("Location: ".$this->createmobileurl("ayard",array('shopid'=>$shopid)));
			}
		}	
		die();
	}
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
			if($result['trade_state']=='SUCCESS'){
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
					$this->jetSumpay($out_trade_no);
				}
				$printer_url = $this->createmobileurl('printer',array('ordersn'=>$out_trade_no,'printtype'=>0, 'islogin'=>$userid ));
				$printer_url = $_W['siteroot'] . 'app/' . substr($printer_url, 2);
				//var_dump($printer_url);echo '支付成功';exit;
				ihttp_get($printer_url); // For Printer By Mango QQ 12733166
				
				if($_W['ispost']) message("订单已支付成功","","success");
				
				
				if(!empty($shop["successUrl"]))
				{
					header("Location: ".$shop["successUrl"]);

				}else{
					header("Location: ".$this->createmobileurl("ayard",array('shopid'=>$shopid)));
				}
				die();
				//message("支付成功","","success");
			}
		}
		message($result['trade_state_desc'].$result['err_code_des'].$result['return_msg'],"","error");
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
		if($result['code']==10000){
			if($result['trade_status']=="TRADE_SUCCESS"){
				$data=array(
					"status"=>1,
					"transaction_id"=>$result['trade_no'],
					"cash_fee"=>intval($result['receipt_amount']*100),
					"time_end"=>strtotime($result['send_pay_date']),
				);
				pdo_update("j_money_trade",$data,array("id"=>$trade['id']));
				//pdo_update("j_money_trade",$data,array("out_trade_no"=>$orderid));
				if($trade["status"]==0){
					$this->jetSumpay($out_trade_no);
				}
				$printer_url = $this->createmobileurl('printer',array('ordersn'=>$out_trade_no,'printtype'=>0, 'islogin'=>$userid ));
				$printer_url = $_W['siteroot'] . 'app/' . substr($printer_url, 2);
				ihttp_get($printer_url); // For Printer By Mango QQ 12733166
				//message("支付成功","","success");
				if($_W['ispost']) message("订单已支付成功","","success");
				if(!empty($shop["successUrl"]))
				{
					header("Location: ".$shop["successUrl"]);

				}else{
					header("Location: ".$this->createmobileurl("ayard",array('shopid'=>$shopid)));
				}
				die();
			}
		}
		message("支付失败","","error");
	}
	exit();
}elseif($operation=="calculateServerMoney")
{
    
	$money=$_GPC["money"];
	$TotalMoney=sumServerMoney();
	$overtop=$shop['freelimit']-$TotalMoney;
	$serverMoney=0;
	if($overtop>0)
	{
		if($overtop<$money) $serverMoney=($money-$overtop)*$shop['servermoney']/1000;
	}else{
		$serverMoney=$money*$shop['servermoney']/1000;
	}	
	if($serverMoney>0) 	$money+=round($serverMoney,2);
	message(array("servermoney"=>round($serverMoney,2),"totalmoney"=>$money,"aliid" => $aliid),"","success");
}



if($payType==2){
	$app_id=$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'];
	$openid=$_GPC['buyer_id_'.$app_id];
	if(!$openid){
		$backUrl=$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=ayard&op=alibuyer&m=j_money&shopid=".$shopid;
		$url="https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=".$app_id."&scope=auth_base&redirect_uri=".urlencode($backUrl);
		header("location:".$url);
		exit();
	}
}

die();
//$TotalMoney=sumServerMoney();
$TotalMoney=100;


include $this->template('pay/pay');

function sumServerMoney()
{
	global $_W,$_GPC;
	
	global $shop;
	global $cfg;
	//当日消费金额
	$openid=$_W['openid'] ? $_W['openid']:$_GPC["openid"."_".$_W['uniacid']];
	
	$TotalMoney=0;
	
	if($openid!="")
	{
	   $TotalMoney=pdo_fetchcolumn("select SUM(total_fee) from ".tablename("j_money_trade")." where weid=:weid and sub_openid=:openid and createtime >:starttime and createtime<:endtime and status=1",array(
			":weid"=>$_W['uniacid'],
			":openid"=>$openid,
			":starttime"=>strtotime(date("Y-m-d")),
			":endtime"=>time(),
    	));
	}
	$appid=$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'];
	
	
	if(!empty($_GPC['buyer_id_'.$appid]))
	{
	    $openid=$_GPC['buyer_id_'.$appid];
	
	$TotalMoney1=pdo_fetchcolumn("select SUM(total_fee) from ".tablename("j_money_trade")." where weid=:weid and sub_openid=:openid and createtime >:starttime and createtime<:endtime and status=1",array(
	    ":weid"=>$_W['uniacid'],
	    ":openid"=>$openid,
	    ":starttime"=>strtotime(date("Y-m-d")),
	    ":endtime"=>time(),
	));
	$TotalMoney=$TotalMoney+$TotalMoney1;
	}
	return empty($TotalMoney)?0:$TotalMoney/100;
}

function isInt($m)
{
	$num=intval($m);
	return  floor($m)==$num?$num:$m;

}




?>
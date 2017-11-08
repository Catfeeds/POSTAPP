<?php 
global $_GPC, $_W;
$shopid = !empty($_GPC['shopid']) ? $_GPC['shopid'] : message("请确认店铺");
$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$shopid));
if(!$shop)message("请确认店铺");
$cfg = $this->module['config'];
$openid=$_W['openid'] ? $_W['openid'] : $_GPC['openid_'.$_W['uniacid']];
if(!$openid){
	$callback = urlencode($_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=oauthcredit&m=j_money&pagetpye=2&shopid=".$shopid);
	$forward = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$_W['account']['key']."&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
	header('location:'.$forward);
}
$operation = !empty($_GPC['op']) ? $_GPC['op'] : "display";

if($operation=="display"){
	$card_id=$shop['wxcardid'] ? $shop['wxcardid']:$cfg['wxcardid'];
	$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and openid=:a ",array(":a"=>$openid));
	if(!$membercard){
		load()->func('communication');
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$tokens=$acc->fetch_token();
		$url="https://api.weixin.qq.com/card/user/getcardlist?access_token=".$tokens;
		$data=array("openid"=>$openid,"card_id"=>$card_id,);
		$content = ihttp_post($url,json_encode($data));
		if(is_error($content))return false;
		$result = @json_decode($content['content'], true);
		if($result["errcode"])message($result["errmsg"]);
		$cardno=$result["card_list"][0]['code'];
		$data=array(
			"weid"=>$_W['uniacid'],
			"groupid"=>intval($shopid),
			"openid"=>$openid,
			"wxcardno"=>$cardno,
			"status"=>1,
			"createtime"=>TIMESTAMP,
		);
		pdo_insert("j_money_memebercard",$data);
		$membercard=$data;
	}
	if(!$membercard['wxcardno'])message("您还没有会员卡哦");
	
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' and cardno=:a order by id desc ",array(":a"=>$membercard['wxcardno']));
	
}elseif($operation=="createorder"){
	$price=$_GPC["fee"];
	$cardno=pdo_fetchcolumn("SELECT wxcardno FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and openid=:a ",array(":a"=>$openid));
	if(!$cardno)die(json_encode(array("success"=>false,"msg"=>"卡号不能为空")));
	$temp=explode("|",$price);
	$fee=$temp[0]*100;
	if(!$fee)die(json_encode(array("success"=>false,"msg"=>"付款金额不能为空")));
	$payParama=array(
		"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
		"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
		"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
		"outTradeNo"=>TIMESTAMP.mt_rand(100,999),
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
		"detail"=>"微支付充值",
		"attach"=>"会员充值",
		"out_trade_no"=>$payParama['outTradeNo'],
		"total_fee"=>$fee,
		"fee_type"=>"CNY",
		"spbill_create_ip"=>$payParama['spbill_create_ip'],
		"time_start"=>date("YmdHis"),
		"time_expire"=>date("YmdHis",TIMESTAMP+600),
		"notify_url"=>"http://paysdk.weixin.qq.com/example/notify.php",
		"trade_type"=>"JSAPI",
		"openid"=>$openid,
		"product_id"=>"01",
	);
	if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
	if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
	//插入数据
	$insert=array(
		"weid"=>$_W['uniacid'],
		"groupid"=>$shopid,
		"cardno"=>$cardno,
		"paytype"=>1,
		"cash"=>intval($fee+($temp[1]*100)),
		"gift"=>$temp[1]*100,
		"out_trade_no"=>$payParama['outTradeNo'],
		"remark"=>$price,
		"createtime"=>TIMESTAMP,
		"createdate"=>date("Y-m-d"),
		"status"=>0,
	);
	$insertStatus=pdo_insert('j_money_recharge',$insert);
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
	$jsapiParama=array();
	$jsapiParamap['appId']=$result["appid"];
	$jsapiParamap['nonceStr']=$result["nonce_str"];
	$jsapiParamap['package']="prepay_id=" . $result['prepay_id'];
	$jsapiParamap['signType']="MD5";
	$time=time();
	$jsapiParamap['timeStamp']="$time";
	$jsapiParamap['paySign']=MakeSign($jsapiParamap,$payParama['pay_signkey']);
	die(json_encode(array("success"=>true,"param"=>$jsapiParamap,"out_trade_no"=>$payParama['outTradeNo'])));
	
}elseif($operation=="paysuccess"){
	$out_trade_no=$_GPC["ordersn"];
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
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
	if($result['result_code']!='SUCCESS')message("支付异常:".$result['trade_state_desc'].$result['err_code_des'].$result['return_msg']);
	if($result['trade_state']!='SUCCESS')message("支付异常:".$result['trade_state']);
	pdo_update("j_money_recharge",array("status"=>1),array("out_trade_no"=>$out_trade_no));
	$card_id=$shop['wxcardid'] ? $shop['wxcardid']:$cfg['wxcardid'];
	$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and openid=:a ",array(":a"=>$openid));
	if($trade['status']==0){
		pdo_update("j_money_memebercard",array("cash"=>$membercard['cash']+$trade['cash']),array("id"=>$membercard['id']));
		$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and openid=:a ",array(":a"=>$openid));
		load()->func('communication');
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$tokens=$acc->fetch_token();
		$data=array(
			"card_id"=>$card_id,
			"code"=>$membercard['wxcardno'],
			"balance"=>$membercard['cash'],
		);
		$pageparama=urldecode(json_encode($data));
		$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/updateuser?access_token=".$tokens,$pageparama, $xml);
		$result=@json_decode($resp['content'],true);
	}
}elseif($operation=="checkpay"){
	$out_trade_no=$_GPC["ordersn"];
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
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
	if($result['result_code']!='SUCCESS')die(json_encode(array("success"=>false,"msg"=>"支付异常:".$result['trade_state_desc'].$result['err_code_des'].$result['return_msg'])));
	if($result['trade_state']!='SUCCESS')die(json_encode(array("success"=>false,"msg"=>"支付异常:".$result['trade_state'])));
	pdo_update("j_money_recharge",array("status"=>1),array("out_trade_no"=>$out_trade_no));
	$card_id=$shop['wxcardid'] ? $shop['wxcardid']:$cfg['wxcardid'];
	$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and openid=:a ",array(":a"=>$openid));
	if($trade['status']==0){
		pdo_update("j_money_memebercard",array("cash"=>$membercard['cash']+$trade['cash']),array("id"=>$membercard['id']));
		$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and openid=:a ",array(":a"=>$openid));
		load()->func('communication');
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$tokens=$acc->fetch_token();
		$data=array(
			"card_id"=>$card_id,
			"code"=>$membercard['wxcardno'],
			"balance"=>$membercard['cash'],
		);
		$pageparama=urldecode(json_encode($data));
		$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/updateuser?access_token=".$tokens,$pageparama, $xml);
		$result=@json_decode($resp['content'],true);
	}
	die(json_encode(array("success"=>true)));
}
include $this->template('membercharge');
?>
<?php 
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
$shopid=$_GPC["shopid"];
$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and docking=:a order by id desc limit 1",array(":a"=>$shopid));
if($operation=="api_wechatqr"){
	$qrcode=$_GPC["qrcode"];
	$shopid=$_GPC["shopid"];
	$oldtradeno=$_GPC['oldtradeno'];
	$fee=$_GPC["fee"] ? $_GPC["fee"] : 0;
	load()->func('communication');
	if(!$qrcode || !$shopid || !$fee)die(json_encode(array('success'=>false,'msg'=>"参数不完整！")));
	$fee=intval($fee*100);
	$totalfee=intval($fee);
	$coupon_fee=0;
	$marketid=0;
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$shopid));
	if(!$shop)die(json_encode(array('success'=>false,'msg'=>"店铺不存在！")));
	
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
		"device_info"=>$shopid,
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
		"groupid"=>$shopid,
		"attach"=>'PC',
		"out_trade_no"=>$payParama['outTradeNo'],
		"total_fee"=>$totalfee,
		"coupon_fee"=>$coupon_fee,
		"cash_fee"=>$fee,
		"marketing"=>$marketid,
		"createtime"=>TIMESTAMP,
		"createdate"=>date('Y-m-d'),
		"old_trade_no"=>$oldtradeno,
	);
	pdo_insert("j_money_trade",$data);
	$sign=MakeSign($pageparama,$pay_signkey);
	$pageparama['sign']=$sign;
	$xml = ToXml($pageparama);
	$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
	$result=FromXml($response);
	if($result['result_code']!='SUCCESS'){
		pdo_update("j_money_trade",array("log"=>"收款失败：".$result['return_msg']),array("out_trade_no"=>$payParama['outTradeNo']));
		die(json_encode(array("success"=>false,"msg"=>$result['return_msg'])));
	}
	$insertInfo=array(
		"openid"=>$result['openid'],
		"is_subscribe"=>$result['is_subscribe']=="Y" ? 1 : 0,
		"sub_openid"=>isset($result['sub_openid']) ? $result['sub_openid'] : "",
		"sub_is_subscribe"=>isset($result['sub_is_subscribe']) && $result['sub_is_subscribe']=="Y" ? 1 : 0,
		"trade_type"=>$result['trade_type'],
		"coupon_fee"=>$result['coupon_fee'],
		"bank_type"=>$result['bank_type'],
		"fee_type"=>$result['CNY'],
		"transaction_id"=>$result['transaction_id'],
		"time_end"=>strtotime($result['time_end']),
		"status"=>1,
	);
	if(!intval($data['total_fee']))$insertInfo["total_fee"]=intval($result['total_fee']);
	if(intval($result['cash_fee']))$insertInfo["cash_fee"]=intval($result['cash_fee']);
	if($result["coupon_fee"]){
		$insertInfo["cash_fee"]=$insertInfo["total_fee"];
	}
	pdo_update("j_money_trade",$insertInfo,array("out_trade_no"=>$payParama['outTradeNo']));
	die(json_encode(array("success"=>true,"item"=>$result,"orderid"=>$payParama['outTradeNo'])));
}elseif($operation=="api_searchorder"){
	if(!$shop)die(json_encode(array("success"=>false,"msg"=>"店铺ID缺失0x001")));
	$ordersn=$_GPC['ordersn'];
	if(!$ordersn)die(json_encode(array("success"=>false,"msg"=>"关键字不能为空0x002")));
	$tradeCount=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:b and (out_trade_no=:a || old_trade_no=:a) ",array(":a"=>$ordersn,":b"=>$shop['id']));
	if($tradeCount>1)die(json_encode(array("success"=>false,"msg"=>"该订单号多次付款")));
	if($tradeCount==1){
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:b and (out_trade_no=:a || old_trade_no=:a) ",array(":a"=>$ordersn,":b"=>$shop['id']));
		if($trade['status']>0){
			die(json_encode(array("success"=>false,"msg"=>"该订单已付款","item"=>$trade)));
		}else{
			pdo_delete('j_money_trade',array("id"=>$trade['id']));
			die(json_encode(array("success"=>true)));
		}
	}
	die(json_encode(array("success"=>true)));
	
}elseif($operation=="api_checkmodal"){
	die(json_encode(array('success'=>true)));
}elseif($operation=="api_seachmembercard"){
	if(!$shop)die(json_encode(array("success"=>false,"msg"=>"店铺ID缺失0x001")));
	load()->func('communication');
	$keyword=trim($_GPC['keyword']);
	$id=intval($_GPC['id']);
	$password=trim($_GPC['password']);
	if(!$keyword && !$id)die(json_encode(array("success"=>false,"msg"=>"请输入内容")));
	if($keyword){
		$where="and (cardno like :b or mobile like :b or wxcardno like :b or openid like :b)";
		if(!$cfg['isglobalcard'])$where.=" and groupid='".$shop['id']."'";
		$item=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' $where order by id desc limit 1",array(":b"=>'%'.$keyword.'%'));
	}
	if($id){
		$item=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$id));
	}
	if(!$item)die(json_encode(array("success"=>false,"msg"=>"没有找到此会员卡信息")));
	if($password){
		if(md5($password)==$item['password']){
			die(json_encode(array("success"=>true)));
		}else{
			die(json_encode(array("success"=>false,"msg"=>"密码错误")));
		}
	}
	$gid=$item['gid'];
	if(!$gid){
		$gid=pdo_fetchcolumn("SELECT groupid FROM ".tablename("mc_groups")." WHERE uniacid = '".$_W['uniacid']."' and isdefault=1");
		pdo_update("j_money_memebercard",array('gid'=>$gid),array('id'=>$item['id']));
	}
	$title=pdo_fetchcolumn("SELECT title FROM ".tablename("mc_groups")." WHERE uniacid = '".$_W['uniacid']."' and groupid=:a",array(':a'=>$gid));
	$discount=pdo_fetchcolumn("SELECT discount FROM ".tablename("j_money_memeberlevel")." WHERE weid='{$_W['uniacid']}' and gid=:a",array(':a'=>$gid));
	$item['discount']=$discount ? $discount : 1;
	$item['cash']=sprintf('%.2f',($item['cash']*0.01));
	$credit=$item['creadit'];
	if($item['openid']){
		$uid=mc_openid2uid($item['openid']);
		if($uid){
			$credit2=mc_credit_fetch($uid,array('credit1'));
			$credit=$credit2['credit1']+$credit;
		}
	}
	$item['leveltxt']=$title;
	$item['credit']=$credit;
	$item['no']=$item['cardno'] ? $item['cardno'] : $item['wxcardno'];
	die(json_encode(array("success"=>true,"item"=>$item)));
}elseif($operation=="api_checkcard"){
	if(!$shop)die(json_encode(array("success"=>false,"msg"=>"店铺ID缺失0x001")));
	$code=$_GPC['code'];
	if(!$code)die(json_encode(array("success"=>false,"msg"=>"卡券ID不能为空")));
	$cfg = $this->module['config'];
	load()->func('communication');
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
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
		break;
		case "cash":
			$coupon["typestr"]="代金券";
			$coupon["least_cost"]=isset($cardinfo['card']['cash']['least_cost']) ? $cardinfo['card']['cash']['least_cost'] : 0;
			$coupon["discount"]=$cardinfo['card']['cash']['reduce_cost'];
			$coupon["msg"]=$coupon["least_cost"] ? "满".sprintf('%.2f',($coupon["least_cost"]*0.01))."元减".sprintf('%.2f',($coupon["discount"]*0.01))."元": "直减".sprintf('%.2f',($coupon["discount"]*0.01))."元";
		break;
		case "gift":
			$coupon["typestr"]="礼品券";
			$coupon["msg"]=$cardinfo['card']['gift']['gift'];
		break;
		case "groupon":
			$coupon["typestr"]="团购券";
			$coupon["msg"]=$cardinfo['card']['groupon']['deal_detail'];
		break;
		case "general_coupon":
			$coupon["typestr"]="优惠券";
			$coupon["msg"]=$cardinfo['card']['general_coupon']['default_detail'];
		break;
	}
	$coupon['openid']=$openid;
	$coupon['code']=$code;
	die(json_encode(array("success"=>true,"item"=>$coupon)));
}elseif($operation=="api_pay"){
	if(!$shop)die(json_encode(array("success"=>false,"msg"=>"店铺ID缺失0x001")));
	$out_trade_no=TIMESTAMP;
	load()->func('communication');
	$data=array(
		"weid"=>$_W['uniacid'],
		"userid"=>intval($shop['docking_userid']),
		"groupid"=>$shop['id'],
		"out_trade_no"=>$out_trade_no,
		"createtime"=>TIMESTAMP,
		"createdate"=>date("Y-m-d"),
		"order_fee"=>intval($_GPC['orderfee']*100),
		"old_trade_no"=>trim($_GPC['ordersn']),
		"total_fee"=>intval($_GPC['totalfee']*100),
		"paid_fee"=>intval($_GPC['paidfee']*100),
		"change_fee"=>intval($_GPC['change']*100),
		"discount"=>trim($_GPC['discount']),
		"discount_fee"=>intval($_GPC['couponfee']*100),
		"discounttype"=>intval($_GPC['discounttype']),
		"paytype"=>intval($_GPC['paytype']),
		"discountid"=>trim($_GPC['cardid']),
		"cardno"=>intval($_GPC['cardno']),
		"remark"=>trim($_GPC['remark']),
	);			
	if($data['discounttype']==3 && $data['discountid']){
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$tokens=$acc->fetch_token();
		$pageparama=json_encode(array("code"=>$data['discountid']));
		$resp = ihttp_request("https://api.weixin.qq.com/card/code/consume?access_token=".$tokens,$pageparama, $xml);
		$arr=@json_decode($resp['content'],true);
		if($arr['errcode'])die(json_encode(array("success"=>false,"msg"=>"卡券核销失败。失败原因：".json_encode($arr))));
		$cardid=$arr['card']['card_id'];
		$openid=$arr['openid'];
		if(!$cardid || !$openid)die(json_encode(array("success"=>false,"msg"=>"卡券核销失败。失败原因：".json_encode($arr))));
	}
	pdo_insert("j_money_trade",$data);
	$paytype=$_GPC["paytype"];
	if($paytype==0){
		$qrcode=$_GPC['code'];
		$userinfo=$this->authcode2openid($qrcode,$shop['id'],true);
		if(!$data['memberno']){
			$memcard=_openid2card($userinfo['openid']);
			$data['memberno']=$memcard['cardno'];
		}
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"outTradeNo"=>strval($data['out_trade_no']),
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
			"body"=>$shop['companyname'],
			"detail"=>$shop['companyname'],
			"attach"=>$shop['id'],
			"out_trade_no"=>$payParama['outTradeNo'],
			"total_fee"=>$data['total_fee'],
			"fee_type"=>"CNY",
			"spbill_create_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"goods_tag"=>"000001",
			"auth_code"=>$qrcode,
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		$sign=MakeSign($pageparama,$pay_signkey);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/micropay", 10);
		$result=FromXml($response);
		if($result['return_code']!='SUCCESS'){
			if($result['err_code']=='USERPAYING'){
				die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'])));
			}
			die(json_encode(array("success"=>false,"msg"=>$result['return_msg'])));
		}
		$data["openid"]=$result['openid'];
		$data["sub_openid"]=$result['sub_openid'];
		$data["paid_fee"]=$data['total_fee'];
		$data["cash_fee"]=$result['cash_fee'];
		$data["coupon_fee"]=$result['coupon_fee'];
		$data["transaction_id"]=$result['transaction_id'];
		$data["time_end"]=strtotime($result['time_end']);
		$data["status"]=1;
	}elseif($paytype==1){
		$payParama=array(
			"app_id"=>$cfg['app_id'] ? $cfg['app_id'] : $shop['app_id'],
			"sub_app_id"=>$shop['app_id'],
			"outTradeNo"=>strval($data['out_trade_no']),
			"pemurl"=>$cfg['pemurl'],
			"merchant_private_key_file"=>$cfg['merchant_private_key_file'],
			"alipay_public_key_file"=>$cfg['alipay_public_key_file'],
		);
		if($payParama['app_id']==$payParama['sub_app_id'])unset($payParama['sub_app_id']);
		$auth_code = trim($_GPC['code']);
		$total_amount = $data['total_fee'];
		$postfee=sprintf('%.2f',($fee*0.01));
		require_once '../addons/j_money/F2fpay.php';
		$f2fpay = new F2fpay();
		$response = $f2fpay->barpay($payParama['outTradeNo'],$auth_code,$postfee,$shop['companyname'],$payParama);
		$temp=(array)$response;
		$result=(array)$temp['alipay_trade_pay_response'];
		if($result['code']=="10003"){
			die(json_encode(array("success"=>true,"paywait"=>true,"out_trade_no"=>$payParama['outTradeNo'])));
		}elseif($result['code']=="10000"){
			$data["paid_fee"]=$data['total_fee'];
			$data["transaction_id"]=$result['trade_no'];
			$data["cash_fee"]=intval($result['receipt_amount']*100);
			$data["time_end"]=strtotime($result['gmt_payment']);
			$data["status"]=1;
		}else{
			die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
		}
	}elseif($paytype==2 || $paytype==3){
		$data['status']=1;
		$data['time_end']=TIMESTAMP;
	}elseif($paytype==4){
		if(!$data['memberno'])die(json_encode(array("success"=>false,'msg'=>"请输入会员卡号")));
		$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$data['memberno']));
		if(!$membercard)die(json_encode(array("success"=>false,"msg"=>"没有找到此会员卡信息")));
		if($membercard['password']){
			if($membercard['password']!=md5($_GPC['password']))die(json_encode(array("success"=>false,"msg"=>"密码错误")));
		}
		if($membercard['cash']-$data['total_fee']<0)die(json_encode(array("success"=>false,"msg"=>"余额不足")));
		pdo_update("j_money_memebercard",array("cash"=>$membercard['cash']-$data['total_fee']),array("id"=>$membercard['id']));
		$data['paid_fee']=0;
		$data['status']=1;
		$data['time_end']=TIMESTAMP;
	}
	pdo_update("j_money_trade",$data,array("out_trade_no"=>$out_trade_no));
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
	die(json_encode(array("success"=>true,"item"=>$item)));
}elseif($operation=="api_paywaitpassword"){
	if(!$shop)die(json_encode(array("success"=>false,"msg"=>"店铺ID缺失0x001")));
	$out_trade_no=$_GPC["out_trade_no"];
	load()->func('communication');
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$out_trade_no));
	if($trade['paytype']==0){
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
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
				"openid"=>$result['openid'],
				"paid_fee"=>$trade['total_fee'],
				"cash_fee"=>$result['cash_fee'],
				"coupon_fee"=>$result['coupon_fee'],
				"transaction_id"=>$result['transaction_id'],
				"time_end"=>strtotime($result['time_end']),
				"status"=>1,
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
			"app_id"=>$cfg['app_id'] ? $cfg['app_id'] : $shop['app_id'],
			"sub_app_id"=>$shop['app_id'],
			"pemurl"=>$cfg['pemurl'],
			"merchant_private_key_file"=>$cfg['merchant_private_key_file'],
			"alipay_public_key_file"=>$cfg['alipay_public_key_file'],
		);
		if($payParama['app_id']==$payParama['sub_app_id'])unset($payParama['sub_app_id']);
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
				pdo_update("j_money_trade",$insertdata,array("out_trade_no"=>$orderid));
				$isnew=false;
				if($trade["status"]==0)$isnew=true;
				die(json_encode(array("success"=>true,"paywait"=>false,"isnew"=>$isnew,"out_trade_no"=>$out_trade_no)));
			}
		}
		die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
	}
}elseif($operation=="api_success"){
	$out_trade_no=$_GPC['out_trade_no'];
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$user['pcate']));
	
	$this->sendOrderMsg($out_trade_no);
	$totalOrder=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and groupid=:a and createdate='".date('Y-m-d')."'",array(":a"=>$user['pcate']));
	
	$totalOrder=$totalOrder+1;
	$temp='';
	for($i=0;$i<(3-strlen($totalOrder));$i++){
		$temp.="0";
	}
	$totalOrder=$temp.$totalOrder;
	die(json_encode(array("success"=>true,'ordernum'=>$totalOrder)));
}
<?php 
//软件使用
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
if($operation=="login"){
	//用户登录
	$userid=$_GPC["userid"];
	$pwd=$_GPC["pwd"];
	if(!$userid || !$pwd)die(json_encode(array("success"=>false,"msg"=>"用户名或者密码错误")));
	$pwd=md5($_GPC['pwd']);
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and useracount=:a and password=:b limit 1",array(":a"=>$userid,":b"=>$pwd));
	if(!$item)die(json_encode(array("success"=>false,"msg"=>"用户不存在或者密码错误")));
	if(!$item['status'])die(json_encode(array("success"=>false,"msg"=>"该用户还没有审核，请联系管理员")));
	pdo_update("j_money_user",array('lasttime'=>TIMESTAMP),array('id'=>$item['id']));
	die(json_encode(array("success"=>true,"islogin"=>$item['id'],"user"=>$item)));
}elseif($operation=="getshop"){
	$islogin=$_GPC['islogin'];
	if(!$islogin)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$islogin));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	die(json_encode(array("success"=>true,"shop"=>$shop)));
}elseif($operation=="checkupdateversion"){
	if(!$cfg['soft_update'])die(json_encode(array("success"=>false)));
	$file=$_W['siteroot'].'attachment/j_money/cert_2/'.$_W['uniacid']."/".$cfg['soft_update'];
	$version=md5_file($file);
	die(json_encode(array("success"=>true,"softversion"=>$version,"soft"=>$file)));
}elseif($operation=="getmemberlist"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$keyword=trim($_GPC['keyword']);
	$where= $cfg['wxcardid'] ? "" : " and (groupid='".$user['pcate']."' or groupid=0)";
	$where2='';
	if($keyword)$where2=" and (cardno like '%".$keyword."%' or realname like '%".$keyword."%' or mobile like '%".$keyword."%' or wxcardno like '%".$keyword."%')";
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' $where $where2  order by id desc ");
	
	die(json_encode(array("success"=>true,"list"=>$list,"num"=>count($list))));
}elseif($operation=="getonemember"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$keyword=trim($_GPC['keyword']);
	$where=" and wxcardno='".$keyword."' ";
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' $where ");
	$uid=mc_openid2uid($item['openid']);
	$credit=$item["creadit"];
	if($uid){
		$credit2=mc_credit_fetch($uid,array('credit1'));
		$credit=$credit2['credit1']+$credit;
	}
	$item["creadit"]=$credit;
	die(json_encode(array("success"=>true,"item"=>$item)));
}elseif($operation=="sendpaycode"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$paycode=$_GPC["paycode"];
	$cardno=$_GPC["cardno"];
	$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and wxcardno=:a ",array(":a"=>$cardno));
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
	die(json_encode(array("success"=>true)));
}elseif($operation=="pay_ali"){
	$qrcode=$_GPC["qrcode"];
	$fee=$_GPC["fee"] ? $_GPC["fee"] : 0;
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录","a"=>$_GPC)));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	load()->func('communication');
	$totalfee=intval($fee);
	if(!$totalfee)die(json_encode(array("success"=>false,"msg"=>"金额不能为空")));
	$payParama=array(
		"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
		"outTradeNo"=>$_GPC["out_trade_no"],
		"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
		"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
		"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
		"alipay_store_id"=>$shop['alipay_store_id'] ,
	);
	$auth_code = trim($qrcode);
	$total_amount = $fee;
	$subject = "支付宝收款";
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
			"transaction_id"=>$result['trade_no'],
			"cash_fee"=>intval($result['receipt_amount']*100),
			"time_end"=>strtotime($result['gmt_payment']),
		);
		die(json_encode(array("success"=>true,"paywait"=>false,"item"=>$insertdata,"out_trade_no"=>$payParama['outTradeNo'])));
	}else{
		die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
	}
	die(json_encode(array("success"=>false,"msg"=>"未知错误")));
}elseif($operation=="check_ali"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$user['pcate']));
	$out_trade_no=$_GPC["out_trade_no"];

	load()->func('communication');
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
				"transaction_id"=>$result['trade_no'],
				"cash_fee"=>intval($result['receipt_amount']*100),
				"time_end"=>strtotime($result['send_pay_day']),
			);
			die(json_encode(array("success"=>true,"paywait"=>false,"item"=>$data,"result"=>$result,"out_trade_no"=>$out_trade_no)));
		}elseif($result['trade_status']=="TRADE_CLOSED"){
			die(json_encode(array("success"=>false,"msg"=>"订单已退款或已关闭")));
		}else{
			die(json_encode(array("success"=>false,"msg"=>$result['trade_status'])));
		}
	}
	die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
}elseif($operation=="update_pay"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
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
		"transaction_id"=>$_GPC['transaction_id'],
		"fee_type"=>$_GPC['fee_type'],
		"createdate"=>date("Y-m-d",strtotime($_GPC['createdate'])),
		"credit"=>$_GPC['credit'],
		"paytype"=>$_GPC['paytype'],
	);
	$trade=pdo_fetchcolumn("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$_GPC['out_trade_no']));
	if($trade){
		pdo_update('j_money_trade',$insert,array("out_trade_no"=>$_GPC['out_trade_no']));
		if(!$trade['status'])$a=$this->jetSumSoftpay($_GPC['out_trade_no']);
	}else{
		$insertStatus=pdo_insert('j_money_trade',$insert);
		$a=$this->jetSumSoftpay($_GPC['out_trade_no']);
	}
	die(json_encode(array("success"=>true,"msg"=>$a)));
}elseif($operation=="update_memberpay"){
	$memberno=$_GPC['memberno'];
	$fee=$_GPC['fee'];
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	
	$member=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE wxcardno=:a",array(":a"=>$memberno));
	if($member['cash']<$fee)die(json_encode(array("success"=>false,"msg"=>"会员余额不足")));
	pdo_update('j_money_memebercard',array("cash"=>$member['cash']-$fee),array("id"=>$member['id']));
	load()->func('communication');
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$tokens=$acc->fetch_token();
	$data=array(
		"card_id"=>$shop["wxcardid"] ?  $shop["wxcardid"] : $cfg["wxcardid"],
		"code"=>$member['wxcardno'],
		"balance"=>intval($member['cash']),
	);
	$pageparama=urldecode(json_encode($data));
	$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/updateuser?access_token=".$tokens,$pageparama, $xml);
	die();
}elseif($operation=="update_charge"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$insert=array(
		"weid"=>$_W['uniacid'],
		"userid"=>$_GPC['userid'],
		"groupid"=>$_GPC['groupid'],
		"cardno"=>$_GPC['cardno'],
		"paytype"=>$_GPC['paytype'],
		"cash"=>$_GPC['cash'],
		"out_trade_no"=>$_GPC['out_trade_no'],
		"remark"=>$_GPC['remark'],
		"createtime"=>$_GPC['createtime'],
		"createdate"=>date("Y-m-d",strtotime($_GPC['createdate'])),
		"status"=>$_GPC['status'],
		
	);
	$isHad=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$_GPC['out_trade_no']));
	if($isHad){
		pdo_update('j_money_recharge',$insert,array("out_trade_no"=>$_GPC['out_trade_no']));
	}else{
		$insertStatus=pdo_insert('j_money_recharge',$insert);
	}
	$member=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE wxcardno=:a",array(":a"=>$insert['cardno']));
	pdo_update('j_money_memebercard',array("cash"=>$member['cash']+$_GPC['cash']),array("id"=>$member['id']));
	$cash=intval($member['cash']+$_GPC['cash']);
	load()->func('communication');
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$tokens=$acc->fetch_token();
	$data=array(
		"card_id"=>$shop["wxcardid"] ?  $shop["wxcardid"] : $cfg["wxcardid"],
		"code"=>$member['wxcardno'],
		"balance"=>$cash,
	);
	$pageparama=urldecode(json_encode($data));
	$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/updateuser?access_token=".$tokens,$pageparama, $xml);
	
	die(json_encode(array("success"=>true,"msg"=>$insertStatus)));
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
	$orderid=$_GPC["ordersn"];
	$orderfee=$_GPC["orderfee"];
	$userOpenid=intval($_GPC['islogin']);
	$fee=intval($_GPC['fee']);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id and status=1",array(":id"=>$userOpenid));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	if(!$orderid)die(json_encode(array("success"=>false,"msg"=>"订单号不能为空")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$refund_trade_no=TIMESTAMP.mt_rand(1000,9999);
	
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$orderid));
	if(!$trade)die(json_encode(array("success"=>false,"msg"=>"请先上传订单")));
	if(!$trade['status'])die(json_encode(array("success"=>false,"msg"=>"该订单没有付款")));
	if($trade['refundstatus'])die(json_encode(array("success"=>false,"msg"=>"该订单已退款")));
	pdo_update("j_money_trade",array("refund_fee"=>$trade['cash_fee'],"refund_trade_no"=>$refund_trade_no),array("out_trade_no"=>$orderid));
	
	$isRefunded=false;
	if($user['permission']>1){
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$orderid));
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? strval($shop['sub_mch_id']) : strval($cfg['sub_mch_id']),
			"apiclient_cert"=>$shop['apiclient_cert'] ? '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$user['pcate']."/".$shop['apiclient_cert'] : '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$cfg['apiclient_cert'],
			"apiclient_key"=>$shop['apiclient_key'] ? '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$user['pcate']."/".$shop['apiclient_key'] : '../attachment/j_money/cert_2/'.$_W['uniacid']."/".$cfg['apiclient_key'],
			
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		$pageparama=array(
			"appid"=>$payParama['appid'],
			"mch_id"=>$payParama['pay_mchid'],
			"device_info"=>$userOpenid,
			"nonce_str"=>getNonceStr(),
			"out_trade_no"=>$orderid,
			"out_refund_no"=>$refund_trade_no,
			"total_fee"=>$trade['cash_fee'],
			"refund_fee"=>$trade['cash_fee'],
			"op_user_id"=>$userOpenid,
			"app_id"=>$payParama['app_id'],
			"appauthtoken"=>$payParama['appauthtoken'],
			"alipay_cert"=>$payParama['alipay_cert'],
		);
		if($payParama['sub_appid'])$pageparama['sub_appid']=$payParama['sub_appid'];
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
				pdo_update("j_money_trade",array("log"=>"失败：".$result['sub_msg']),array("out_trade_no"=>$orderid));
				die(json_encode(array("success"=>false,"msg"=>"失败:".$result['sub_msg'])));
			}
		}else{
			unset($pageparama['alipay_cert']);
			unset($pageparama['appauthtoken']);
			unset($pageparama['app_id']);
			$sign=MakeSign($pageparama,$payParama['pay_signkey']);
			$pageparama['sign']=$sign;
			$xml = ToXml($pageparama);
			$pemary=array("cert"=>$payParama['apiclient_cert'],"key"=>$payParama['apiclient_key'],);
			$response =postXmlAndPemCurl($xml, "https://api.mch.weixin.qq.com/secapi/pay/refund", $pemary);
			$result=FromXml($response);
			if($result['result_code']!='SUCCESS'){
				pdo_update("j_money_trade",array("log"=>"退款失败：".$result['return_msg']),array("out_trade_no"=>$orderid));
				die(json_encode(array("success"=>false,"msg"=>"退款失败:".$result['return_msg'].$result['err_code_des'])));
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
		$isRefunded=true;
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
	$result=@json_decode($data,true);
	die(json_encode(array("success"=>true,"refund_trade_no"=>$refund_trade_no,"isrefunded"=>$isRefunded,"refundtime"=>date("Y-m-d H:i:s"))));
	
}elseif($operation=="check_refund"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$refundno=$_GPC["refundno"];
	$outtradeno=$_GPC["outtradeno"];
	$paytype=$_GPC["paytype"];
	
	load()->func('communication');
	if($paytype){
		$payParama=array(
			"app_id"=>$shop['app_id'] ? $shop['app_id'] : $cfg['app_id'],
			"appauthtoken"=>$shop['appauthtoken'] ? $shop['appauthtoken'] : $cfg['appauthtoken'],
			"alipay_cert"=>$shop['alipay_cert'] ? $shop['alipay_cert'] : $cfg['alipay_cert'],
			"alipay_key"=>$shop['alipay_key'] ? $shop['alipay_key'] : $cfg['alipay_key'],
			"alipay_store_id"=>$shop['alipay_store_id'] ,
		);
		require_once '../addons/j_money/F2fpay.php';
		$f2fpay = new F2fpay();
		$response = $f2fpay->refundcheck($outtradeno,$refundno,$payParama);
		$results=@json_decode(json_encode($response),true);
		var_dump($results);
		die();
		$result=$results['alipay_trade_fastpay_refund_query_response'];
		if($result['code']==10000){
			die(json_encode(array("success"=>true)));
		}else{
			die(json_encode(array("success"=>true,"msg"=>$result['sub_msg'])));
		}
		die(json_encode(array("success"=>false,"msg"=>$result['sub_msg'])));
	}else{
		$payParama=array(
			"appid"=>$shop['appid'] ? $shop['appid'] : $cfg['appid'],
			"pay_mchid"=>strval($shop['pay_mchid']) ? strval($shop['pay_mchid']) : strval($cfg['pay_mchid']),
			"pay_signkey"=>$shop['pay_signkey'] ? $shop['pay_signkey'] : $cfg['pay_signkey'],
			"pay_ip"=>$shop['pay_ip'] ? $shop['pay_ip'] : $cfg['pay_ip'],
			"sub_appid"=>$shop['sub_appid'] ? $shop['sub_appid'] : $cfg['sub_appid'],
			"sub_mch_id"=>$shop['sub_mch_id'] ? $shop['sub_mch_id'] : $cfg['sub_mch_id'],
		);
		$pageparama=array(
			"appid"=>$payParama['appid'],
			"mch_id"=>$payParama['pay_mchid'],
			"nonce_str"=>getNonceStr(),
			"out_trade_no"=>$outtradeno,
			"transaction_id"=>"",
			"out_refund_no"=>"",
			"refund_id"=>"",
		);
		if($payParama['sub_mch_id'])$pageparama['sub_mch_id']=$payParama['sub_mch_id'];
		$sign=MakeSign($pageparama,$payParama['pay_signkey']);
		$pageparama['sign']=$sign;
		$xml = ToXml($pageparama);
		$response =postXmlCurl($xml, "https://api.mch.weixin.qq.com/pay/refundquery", 10);
		$result=FromXml($response);
		if($result['return_code']!='SUCCESS'){
			die(json_encode(array("success"=>false,"msg"=>$result['return_msg'])));
		}
		if($result['result_code']!='SUCCESS'){
			die(json_encode(array("success"=>false,"msg"=>$result['err_code_des'])));
		}
		if($result['refund_status_0']!="SUCCESS"){
			$msg="";
			if($result['refund_status_0']=="REFUNDCLOSE"){
				$msg="退款关闭";
			}elseif($result['refund_status_0']=="PROCESSING"){
				$msg="退款处理中";
			}elseif($result['refund_status_0']=="CHANGE"){
				$msg="退款异常，请到交易中心手动退款";
			}
			die(json_encode(array("success"=>false,"msg"=>$msg)));
		}
		die(json_encode(array("success"=>true)));
	}
	die();
}elseif($operation=="download_print"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$printList=pdo_fetchall("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and groupid=:a ",array(":a"=>$shop['id']));
	die(json_encode(array("success"=>true,"item"=>$printList)));
}elseif($operation=="getupdate"){
	$version=pdo_fetchcolumn("SELECT version FROM ".tablename("modules")." WHERE `name` ='j_money' limit 1");
	die(json_encode(array("version"=>$version,"fileurl"=>$cfg['softupdate'])));
}elseif($operation=="checktradeupdate"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$ordersn=$_GPC["ordersn"];
	$isHad=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$ordersn));
	if(!$isHad)die(json_encode(array("success"=>true)));
	die(json_encode(array("success"=>false)));
}elseif($operation=="getqrcodelink"){
	$deviceinfo=intval($_GPC["islogin"]);
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:a and status=1",array(":a"=>$deviceinfo));
	if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
	$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$user['pcate']));
	$ordersn=$_GPC["ordersn"];
	$qrcode1=encrypt($ordersn, 'E', $cfg['encryptcode']);
	$qrcode=urlencode(base64_encode($qrcode1));
	$uniacid=$cfg['creadit_uniacid'] ? $cfg['creadit_uniacid'] : $_W['uniacid'];
	$url=trueUrl2Shorturl($_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=getcredit&m=j_money&qrcode=".$qrcode);
	die(json_encode(array("success"=>true,"url"=>$url)));
}

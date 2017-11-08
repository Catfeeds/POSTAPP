<?php 
global $_GPC, $_W;
$userid = $_GPC['islogin'];
/*if (!$userid) {
	die("请先登录");
}*/
$printDoc = '';
$tradeid = $_GPC['ordersn'];
$type = intval($_GPC['printtype']);
if ($userid) {
	$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id and status=1",array(":id"=>$userid));
}
if (empty($user)) {
	$user['realname'] = '';
}
//if(!$user)die(json_encode(array("success"=>false,"msg"=>"请先登录")));
$cfg = $this->module['config'];
$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$tradeid));
$printid=$shop['payreceipt'];


if(empty($trade['time_end']))
{
	$trade["time_end"]=time()-5;
	pdo_update("j_money_trade",array("time_end"=>$trade["time_end"]),array("out_trade_no"=>$tradeid));
}	


$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$trade['groupid']));

if($type!=0){
	$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$tradeid));
	$printid=$shop['couponreceipt'];
}
if(!$trade)die(json_encode(array("success"=>false,"msg"=>"交易为空")));

$print=pdo_fetch("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and groupid=:groupid  and pcate=:a order by isdefault desc,id desc",array(":groupid"=>$shop["id"],":a"=>$type));

if($printid){
	$print=pdo_fetch("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$printid));
}
if(empty($print))
{
	$print=pdo_fetch("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and  pcate=:a order by isdefault desc,id desc",array(":a"=>$type));
}

if(!$print)die(json_encode(array("success"=>false,"msg"=>"没有打印模板")));

if(!$type){
	$data=array("CFT"=>"零钱包","ICBC_DEBIT"=>"工商银行(借记卡)","ICBC_CREDIT"=>"工商银行(信用卡)","ABC_DEBIT"=>"农业银行(借记卡)","ABC_CREDIT"=>"农业银行(信用卡)","PSBC_DEBIT"=>"邮政储蓄银行(借记卡)","PSBC_CREDIT"=>"邮政储蓄银行(信用卡)","CCB_DEBIT"=>"建设银行(借记卡)","CCB_CREDIT"=>"建设银行(信用卡)","CMB_DEBIT"=>"招商银行(借记卡)","CMB_CREDIT"=>"招商银行(信用卡)","BOC_DEBIT"=>"中国银行(借记卡)","BOC_CREDIT"=>"中国银行(信用卡)","COMM_DEBIT"=>"交通银行(借记卡)","SPDB_DEBIT"=>"浦发银行(借记卡)","SPDB_CREDIT"=>"浦发银行(信用卡)","GDB_DEBIT"=>"广发银行(借记卡)","GDB_CREDIT"=>"广发银行(信用卡)","CMBC_DEBIT"=>"民生银行(借记卡)","CMBC_CREDIT"=>"民生银行(信用卡)","PAB_DEBIT"=>"平安银行(借记卡)","PAB_CREDIT"=>"平安银行(信用卡)","CEB_DEBIT"=>"光大银行(借记卡)","CEB_CREDIT"=>"光大银行(信用卡)","CIB_DEBIT"=>"兴业银行(借记卡)","CIB_CREDIT"=>"兴业银行(信用卡)","CITIC_DEBIT"=>"中信银行(借记卡)","CITIC_CREDIT"=>"中信银行(信用卡)","BOSH_DEBIT"=>"上海银行(借记卡)","BOSH_CREDIT"=>"上海银行(信用卡)","CRB_DEBIT"=>"华润银行(借记卡)","HZB_DEBIT"=>"杭州银行(借记卡)","HZB_CREDIT"=>"杭州银行(信用卡)","BSB_DEBIT"=>"包商银行(借记卡)","BSB_CREDIT"=>"包商银行(信用卡)","CQB_DEBIT"=>"重庆银行(借记卡)","SDEB_DEBIT"=>"顺德农商行(借记卡)","SZRCB_DEBIT"=>"深圳农商银行(借记卡)","HRBB_DEBIT"=>"哈尔滨银行(借记卡)","BOCD_DEBIT"=>"成都银行(借记卡)","GDNYB_DEBIT"=>"南粤银行(借记卡)","GDNYB_CREDIT"=>"南粤银行(信用卡)","GZCB_DEBIT"=>"广州银行(借记卡)","GZCB_CREDIT"=>"广州银行(信用卡)","JSB_DEBIT"=>"江苏银行(借记卡)","JSB_CREDIT"=>"江苏银行(信用卡)","NBCB_DEBIT"=>"宁波银行(借记卡)","NBCB_CREDIT"=>"宁波银行(信用卡)","NJCB_DEBIT"=>"南京银行(借记卡)","JZB_DEBIT"=>"晋中银行(借记卡)","KRCB_DEBIT"=>"昆山农商(借记卡)","LJB_DEBIT"=>"龙江银行(借记卡)","LNNX_DEBIT"=>"辽宁农信(借记卡)","LZB_DEBIT"=>"兰州银行(借记卡)","WRCB_DEBIT"=>"无锡农商(借记卡)","ZYB_DEBIT"=>"中原银行(借记卡)","ZJRCUB_DEBIT"=>"浙江农信(借记卡)","WZB_DEBIT"=>"温州银行(借记卡)","XAB_DEBIT"=>"西安银行(借记卡)","JXNXB_DEBIT"=>"江西农信(借记卡)","NCB_DEBIT"=>"宁波通商银行(借记卡)","NYCCB_DEBIT"=>"南阳村镇银行(借记卡)","NMGNX_DEBIT"=>"内蒙古农信(借记卡)","SXXH_DEBIT"=>"陕西信合(借记卡)","SRCB_CREDIT"=>"上海农商银行(信用卡)","SJB_DEBIT"=>"盛京银行(借记卡)","SDRCU_DEBIT"=>"山东农信(借记卡)","SRCB_DEBIT"=>"上海农商银行(借记卡)","SCNX_DEBIT"=>"四川农信(借记卡)","QLB_DEBIT"=>"齐鲁银行(借记卡)","QDCCB_DEBIT"=>"青岛银行(借记卡)","PZHCCB_DEBIT"=>"攀枝花银行(借记卡)","ZJTLCB_DEBIT"=>"浙江泰隆银行(借记卡)","TJBHB_DEBIT"=>"天津滨海农商行(借记卡)","WEB_DEBIT"=>"微众银行(借记卡)","YNRCCB_DEBIT"=>"云南农信(借记卡)","WFB_DEBIT"=>"潍坊银行(借记卡)","WHRC_DEBIT"=>"武汉农商行(借记卡)","ORDOSB_DEBIT"=>"鄂尔多斯银行(借记卡)","XJRCCB_DEBIT"=>"新疆农信银行(借记卡)","ORDOSB_CREDIT"=>"鄂尔多斯银行(信用卡)","CSRCB_DEBIT"=>"常熟农商银行(借记卡)","JSNX_DEBIT"=>"江苏农商行(借记卡)","GRCB_CREDIT"=>"广州农商银行(信用卡)","GLB_DEBIT"=>"桂林银行(借记卡)","GDRCU_DEBIT"=>"广东农信银行(借记卡)","GDHX_DEBIT"=>"广东华兴银行(借记卡)","FJNX_DEBIT"=>"福建农信银行(借记卡)","DYCCB_DEBIT"=>"德阳银行(借记卡)","DRCB_DEBIT"=>"东莞农商行(借记卡)","CZCB_DEBIT"=>"稠州银行(借记卡)","CZB_DEBIT"=>"浙商银行(借记卡)","CZB_CREDIT"=>"浙商银行(信用卡)","GRCB_DEBIT"=>"广州农商银行(借记卡)","CSCB_DEBIT"=>"长沙银行(借记卡)","CQRCB_DEBIT"=>"重庆农商银行(借记卡)","CBHB_DEBIT"=>"渤海银行(借记卡)","BOIMCB_DEBIT"=>"内蒙古银行(借记卡)","BOD_DEBIT"=>"东莞银行(借记卡)","BOD_CREDIT"=>"东莞银行(信用卡)","BOB_DEBIT"=>"北京银行(借记卡)","BNC_DEBIT"=>"江西银行(借记卡)","BJRCB_DEBIT"=>"北京农商行(借记卡)","AE_CREDIT"=>"AE(信用卡)","GYCB_CREDIT"=>"贵阳银行(信用卡)","JSHB_DEBIT"=>"晋商银行(借记卡)","JRCB_DEBIT"=>"江阴农商行(借记卡)","JNRCB_DEBIT"=>"江南农商(借记卡)","JLNX_DEBIT"=>"吉林农信(借记卡)","JLB_DEBIT"=>"吉林银行(借记卡)","JJCCB_DEBIT"=>"九江银行(借记卡)","HXB_DEBIT"=>"华夏银行(借记卡)","HXB_CREDIT"=>"华夏银行(信用卡)","HUNNX_DEBIT"=>"湖南农信(借记卡)","HSB_DEBIT"=>"徽商银行(借记卡)","HSBC_DEBIT"=>"恒生银行(借记卡)","HRXJB_DEBIT"=>"华融湘江银行(借记卡)","HNNX_DEBIT"=>"河南农信(借记卡)","HKBEA_DEBIT"=>"东亚银行(借记卡)","HEBNX_DEBIT"=>"河北农信(借记卡)","HBNX_DEBIT"=>"湖北农信(借记卡)","HBNX_CREDIT"=>"湖北农信(信用卡)","GYCB_DEBIT"=>"贵阳银行(借记卡)","GSNX_DEBIT"=>"甘肃农信(借记卡)","JCB_CREDIT"=>"JCB(信用卡)","MASTERCARD_CREDIT"=>"MASTERCARD(信用卡)","VISA_CREDIT"=>"VISA(信用卡)");
	$content=$print['content'];
	$printDoc=str_replace("|#收银员#|",$user['realname'],$content);
	$printDoc=str_replace("|#店铺#|",$shop['companyname'],$printDoc);
	$printDoc=str_replace("|#收银时间#|",$trade['time_end'] ? date("Y-m-d H:i:s",$trade['time_end']) : 0,$printDoc);
	$printDoc=str_replace("|#总金额#|",sprintf('%.2f',(($trade['total_fee']-$trade['servermoney'])/100)),$printDoc);
	$printDoc=str_replace("|#优惠金额#|",sprintf('%.2f',($trade['coupon_fee']/100)),$printDoc);
	
	/* 这里存在用户使用抵用券的情况。实际支付金额和订单
	$printDoc=str_replace("|#实收金额#|",sprintf('%.2f',($trade['cash_fee']/100)),$printDoc);
	*/
	$printDoc=str_replace("|#实收金额#|",sprintf('%.2f',($trade['total_fee']/100)),$printDoc);
	
	
	
	$printDoc=str_replace("|#付款方式#|",$trade['paytype'] ? "支付宝" : "微信".$data[$trade['bank_type']],$printDoc);
	$printDoc=str_replace("|#付款终端#|",$trade['attach']=='-' || $trade['attach']=='PC' ? "电脑端" : "移动端",$printDoc);
	$printDoc=str_replace("|#单号#|",$trade['out_trade_no'],$printDoc);
	
	$printDoc=str_replace("|#需付金额#|",sprintf('%.2f',(($trade['total_fee']-$trade['servermoney'])/100)),$printDoc);
	
	$printDoc=str_replace("|#手续费#|",sprintf('%.2f',($trade['servermoney']/100)),$printDoc);
	
	$printDoc=str_replace("|#服务类型#|",$trade['servertype'],$printDoc);	
	
	$printDoc=str_replace("|#服务内容#|",empty($trade['carnumber'])?$trade['userbak']:$trade['carnumber'],$printDoc);
	
	$printDoc=str_replace("|#打印时间#|",date("Y-m-d H:i:s",time()),$printDoc);
	
	$printDoc=str_replace("|#原单号#|",$trade['old_trade_no'],$printDoc);
	$printDoc=str_replace("|#订单状态#|",_mango_getStatusName($trade['status']),$printDoc);
	$qrcode1=encrypt($tradeid, 'E', $cfg['encryptcode']);
	$qrcode=urlencode(base64_encode($qrcode1));
	$uniacid=$cfg['creadit_uniacid'] ? $cfg['creadit_uniacid'] : $_W['uniacid'];
	$url=trueUrl2Shorturl($_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=getcredit&m=j_money&qrcode=".$qrcode);
	$printDoc=str_replace("|#积分二维码#|",$url,$printDoc);
	$yiweicode = code128x($trade['out_trade_no']);
	$printDoc=str_replace("|#一维码#|",$yiweicode,$printDoc);
	$printDoc=str_replace("|#打印份数#|",$trade['isprint']+1,$printDoc);
}else{
	$cardtype=array("discount"=>"折扣券","cash"=>"代金券","gift"=>"礼品券","groupon"=>"团购券","general_coupon"=>"优惠券",);
	$content=$print['content'];
	$printDoc=str_replace("|#收银员#|",$user['realname'],$content);
	$printDoc=str_replace("|#店铺名称#|",$shop['companyname'],$printDoc);
	$printDoc=str_replace("|#兑换时间#|",date("Y-m-d H:i:s",$trade['createtime']),$printDoc);
	$printDoc=str_replace("|#卡券内容#|",$trade['description'],$printDoc);
	$printDoc=str_replace("|#卡券标题#|",$trade['title'],$printDoc);
	$printDoc=str_replace("|#卡券副标题#|",$trade['sub_title'],$printDoc);
	$printDoc=str_replace("|#卡券类型#|",$cardtype[$trade['type']],$printDoc);
	$printDoc=str_replace("|#订单状态#|",_mango_getStatusName($trade['status']),$printDoc);
	$printDoc=str_replace("|#打印份数#|",$trade['isprint']+1,$printDoc);
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

// 获取默认打印机
$printer = pdo_fetch("SELECT * FROM ".tablename('j_money_printer')." WHERE weid='{$_W['uniacid']}' and shopid=:a ORDER BY isdef DESC",array(":a"=>$shop['id']));

if($user["printerid"]>0)
{
	$userPrinter=pdo_fetch("SELECT * FROM ".tablename('j_money_printer')." WHERE weid=:weid and shopid=:a and id=:id ",array(
	":a"=>$shop['id'],
	":weid"=>$_W["uniacid"],
	":id"=>$user["printerid"],
	));
	if(!empty($userPrinter)) $printer=$userPrinter;	
}

if ($printer && $printDoc && $shop['printnum']) {
	include_once IA_ROOT."/addons/j_money/inc/Feieyun.class.php";

	$feyObj = new Feieyun($printer['apiaccount'], $printer['apiukey'], $printer['printsn']);
	$return = $feyObj->doPrint($printer['printsn'], $printDoc, $shop['printnum']);
	@file_put_contents(IA_ROOT.'/data/print.log', "\r\n----".date('Y-m-d H:i:s')."----\r\nPrinter info:\r\n".var_export($printer,true)."\r\nContent:\r\n".$printDoc."\r\nReturn:\r\n".$return, FILE_APPEND);
	//$return = json_decode($return, TRUE);
	if ($return && $return['code']==0) {
		$up_data = array('isprint +=' => $shop['printnum'], 'print_order' => $return['data']['data']);
		pdo_update("j_money_trade", $up_data, array("out_trade_no" => $trade['out_trade_no']));
	}
}

function _mango_getStatusName($status) {
	$statusName = '';
	if ($status == 0) {
		$statusName = '未付款';
	} elseif ($status == 1) {
		$statusName = '已付款';
	} else {
		$statusName = '退款';
	}
	return $statusName;
}

function code128x($strnum) {
	$bs = array("\x30","\x31","\x32","\x33","\x34","\x35","\x36","\x37","\x38","\x39");
	$length = strlen($strnum);
	$b=array();
	//打印走纸
	$b[0] = "\x1b";
	$b[1] = "\x64";
	$b[2] = "\x02";//

	//条码位置
	$b[3] = "\x1d";
	$b[4] = "\x48";
	$b[5] = "\x32";//

	//高度
	$b[6] = "\x1d";
	$b[7] = "\x68";
	$b[8] = "\x50";//

	//宽度	
	$b[9] = "\x1d";
	$b[10] = "\x77";
	$b[11] = "\x02";//2-6

	//类型
	$b[12] = "\x1d";
	$b[13] = "\x6b";
	$b[14] = "\x49";//code128
	
	$b[15] = chr(strlen($strnum)+'2');//内容大小，字节数
	$b[16] = "\x7b";
	$b[17] = "\x42";//字符集b
	
	for ($i = 0; $i < $length; $i++){
			$temp = substr($strnum,$i,1);
			$iindex = intval($temp);
			$b[18 + $i] = $bs[$iindex];
	}
	$str = implode("",$b);
	return $str;
}
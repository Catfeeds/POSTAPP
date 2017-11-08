<?php 
global $_GPC, $_W;
$printDoc = '';

$id=intval($_GPC['id']);
$credit_log= pdo_fetch("SELECT * FROM " . tablename('j_money_redeemcredit') . " WHERE uniacid=:uniacid and  id = :id ", array(
		':id' => $id,
		':uniacid'=>$_W["uniacid"],
));

if(empty($credit_log)) die(json_encode(array("success"=>false,"msg"=>"积分兑换记录不存在")));
if($credit_log['status']!=1)  die(json_encode(array("success"=>false,"msg"=>"积分兑换未成功")));

if(empty($credit_log['shopid']))  die(json_encode(array("success"=>false,"msg"=>"未配置对应店铺信息")));

$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$credit_log['shopid']));
$jfconfig=empty($shop["jfconfig"])?array():unserialize($shop["jfconfig"]);
if(empty($jfconfig)) die(json_encode(array("success"=>false,"msg"=>"未配置积分兑换")));
//获取打印小票
$print=pdo_fetch("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(
		":id"=>$jfconfig['printertem'],
));

if(!$print)die(json_encode(array("success"=>false,"msg"=>"没有打印模板")));
$content=$print['content'];
$printDoc=str_replace("|#店铺#|",$shop['companyname'],$content);
$printDoc=str_replace("|#用户姓名#|",$credit_log['user'],$printDoc);
$printDoc=str_replace("|#用户电话#|",$credit_log['mobile'],$printDoc);

$printDoc=str_replace("|#兑换数量#|",$credit_log['num'],$printDoc);

$printDoc=str_replace("|#扣除积分#|",$credit_log['credit'],$printDoc);

$printDoc=str_replace("|#部门#|",$credit_log['bumen'],$printDoc);


$printDoc=str_replace("|#剩余积分#|",$credit_log['availableCredits']-$credit_log['credit'],$printDoc);

$printDoc=str_replace("|#兑换时间#|",$credit_log['createtime'] ? date("Y-m-d H:i:s",$credit_log['createtime']) :date("Y-m-d H:i:s"),$printDoc);
/*具体部门 待定*/
$printDoc=str_replace("|#打印时间#|",date("Y-m-d H:i:s",time()),$printDoc);
	
$printDoc=str_replace("|#状态#|",_mango_getStatusName($credit_log['status']),$printDoc);

$printer=pdo_fetch("SELECT * FROM ".tablename('j_money_printer')." WHERE weid=:weid and shopid=:a and id=:id ",array(
	":a"=>$shop['id'],
	":weid"=>$_W["uniacid"],
	":id"=>$jfconfig["printerid"],
));


if ($printer && $printDoc && $shop['printnum']) {
	include_once IA_ROOT."/addons/j_money/inc/Feieyun.class.php";

	$feyObj = new Feieyun($printer['apiaccount'], $printer['apiukey'], $printer['printsn']);
	$return = $feyObj->doPrint($printer['printsn'], $printDoc, $shop['printnum']);
	@file_put_contents(IA_ROOT.'/data/print.log', "\r\n----".date('Y-m-d H:i:s')."----\r\nPrinter info:\r\n".var_export($printer,true)."\r\nContent:\r\n".$printDoc."\r\nReturn:\r\n".$return, FILE_APPEND);
	//$return = json_decode($return, TRUE);
	if ($return && $return['code']==0) {
		 die(json_encode(array("success"=>true,"msg"=>"打印成功")));
	}
}

function _mango_getStatusName($status) {
	$statusName = '';
	if ($status == 0) {
		$statusName = '兑换失败';
	} elseif ($status == 1) {
		$statusName = '兑换成功';
	} else {
		$statusName = '失败';
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
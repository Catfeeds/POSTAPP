<?php
global $_GPC, $_W;
include_once IA_ROOT."/addons/j_money/inc/Feieyun.class.php";

$user = 'alexbenq@163.com';
$ukey = 'E7rhrydFI6d9QI8k';
$sn = '217500245';

$orderInfo = '<CB>测试打印</CB><BR>';
$orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
$orderInfo .= '--------------------------------<BR>';
$orderInfo .= '饭　　　　　 　10.0   10  10.0<BR>';
$orderInfo .= '炒饭　　　　　 10.0   10  10.0<BR>';
$orderInfo .= '蛋炒饭　　　　 10.0   100 100.0<BR>';
$orderInfo .= '鸡蛋炒饭　　　 100.0  100 100.0<BR>';
$orderInfo .= '西红柿炒饭　　 1000.0 1   100.0<BR>';
$orderInfo .= '西红柿蛋炒饭　 100.0  100 100.0<BR>';
$orderInfo .= '西红柿鸡蛋炒饭 15.0   1   15.0<BR>';
$orderInfo .= '备注：加辣<BR>';
$orderInfo .= '--------------------------------<BR>';
$orderInfo .= '合计：xx.0元<BR>';
$orderInfo .= code128x('1498235609807').'<BR>';
$orderInfo .= '送货地点：广州市南沙区xx路xx号<BR>';
$orderInfo .= '联系电话：13888888888888<BR>';
$orderInfo .= '订餐时间：2014-08-08 08:08:08<BR>';
$orderInfo .= '<QR>http://www.dzist.com</QR>';//把二维码字符串用标签套上即可自动生成二维码

$obj = new Feieyun($user, $ukey, $sn);
$return = $obj->doPrint($sn, $orderInfo, 1);
var_dump($return);

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
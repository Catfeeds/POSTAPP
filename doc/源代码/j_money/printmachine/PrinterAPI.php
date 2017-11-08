<?php
header("Content-type: text/html; charset=utf-8");
include 'HttpClient.class.php';
define('HOSTNAME','/FeieServer');
function wp_print($orderInfo,$confing=array()){
	$content = array(
		'sn'=>$confing['no'],  
		'printContent'=>$orderInfo,
		'key'=>$confing['key'],
		'times'=>1
	);
	$client = new HttpClient($Url,$confing['port']);
	if(!$client->post(HOSTNAME.'/printOrderAction',$content)){
		echo 'error';
	}
	else{
		echo $client->getContent();
	}
}
function queryPrinterStatus($confing=array()){
	$msgInfo = array(
		'sn'=>$confing['no'],  
		'key'=>$confing['key'],
	);
	$client = new HttpClient($Url,$confing['port']);
	if(!$client->post(HOSTNAME.'/queryPrinterStatusAction',$msgInfo)){
		return 'error';
	}
	else{
		$result = $client->getContent();
		return $result;
	}
}
/*
 *  方法2
	根据订单索引,去查询订单是否打印成功,订单索引由方法1返回
*/
function queryOrderState($printer_sn,$key,$index){
		$msgInfo = array(
			'sn'=>$printer_sn,  
			'key'=>$key,
			'index'=>$index
		);
	
	$client = new HttpClient(IP,PORT);
	if(!$client->post(HOSTNAME.'/queryOrderStateAction',$msgInfo)){
		echo 'error';
	}
	else{
		$result = $client->getContent();
		echo $result;
	}
	
}
/*
 *  方法3
	查询指定打印机某天的订单详情
*/
function queryOrderInfoByDate($printer_sn,$key,$date){
		$msgInfo = array(
	        'sn'=>$printer_sn,  
			'key'=>$key,
			'date'=>$date
		);
	
	$client = new HttpClient(IP,PORT);
	if(!$client->post(HOSTNAME.'/queryOrderInfoAction',$msgInfo)){ 
		echo 'error';
	}
	else{
		$result = $client->getContent();
		echo $result;
	}
	
}
?>

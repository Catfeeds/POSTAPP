<?php

include IA_ROOT."/addons/j_money/inc/HttpClient.class.php";

class Feieyun {
	
	public $C_USER;
	public $C_UKEY;
	public $C_SN;
	public $C_IP = 'api.feieyun.cn';
	public $C_PORT = 80;
	public $C_PATH = '/Api/Open/';
	public $C_STIME;
	public $C_SIG;
	
	public function __construct($user, $ukey, $sn) {
		$this->Feieyun($user, $ukey, $sn);
	}
	
    public function Feieyun($user, $ukey, $sn) {
        $this->C_USER = $user;
        $this->C_UKEY = $ukey;
        $this->C_SN = $sn;
        $this->C_STIME = time();
        $this->C_SIG = sha1($this->C_USER.$this->C_UKEY.$this->C_STIME);
    }
	
	//===========添加打印机接口（支持批量）=============
	//***接口返回值说明***
	//正确例子：{"msg":"ok","ret":0,"data":{"ok":["sn#key#remark#carnum","316500011#abcdefgh#快餐前台"],"no":["316500012#abcdefgh#快餐前台#13688889999  （错误：识别码不正确）"]},"serverExecutedTime":3}
	//错误：{"msg":"参数错误 : 该帐号未注册.","ret":-2,"data":null,"serverExecutedTime":37}
	
	//打开注释可测试
	//提示：打印机编号(必填) # 打印机识别码(必填) # 备注名称(选填) # 流量卡号码(选填)，多台打印机请换行（\n）添加新打印机信息，每次最多100行(台)。
	//$snlist = "sn1#key1#remark1#carnum1\nsn2#key2#remark2#carnum2";
	//addPrinter($snlist);
	public function addPrinter($snlist){
		
		$content = array(
			'user'			=>	$this->C_USER,
			'stime'			=>	$this->C_STIME,
			'sig'			=>	$this->C_SIG,
			'apiname'		=>	'Open_printerAddlist',
			'printerContent'=>$snlist
		);
		
		$client = new HttpClient($this->C_IP,$this->C_PORT);
		if(!$client->post($this->C_PATH,$content)){
			return $this->json_return(array(), 100, 'error');
		} else {
			$result = $client->getContent();
			return $this->json_return($result);
		}
	}	

	//==================方法1.打印订单==================
	//***接口返回值说明***
	//正确例子：{"msg":"ok","ret":0,"data":"316500004_20160823165104_1853029628","serverExecutedTime":6}
	//错误：{"msg":"错误信息.","ret":非零错误码,"data":null,"serverExecutedTime":5}
			
	
	//标签说明：
	//单标签:
	//"<BR>"为换行,"<CUT>"为切刀指令(主动切纸,仅限切刀打印机使用才有效果)
	//"<LOGO>"为打印LOGO指令(前提是预先在机器内置LOGO图片),"<PLUGIN>"为钱箱或者外置音响指令
	//成对标签：
	//"<CB></CB>"为居中放大一倍,"<B></B>"为放大一倍,"<C></C>"为居中,<L></L>字体变高一倍
	//<W></W>字体变宽一倍,"<QR></QR>"为二维码,"<BOLD></BOLD>"为字体加粗,"<RIGHT></RIGHT>"为右对齐
	//拼凑订单内容时可参考如下格式
	//根据打印纸张的宽度，自行调整内容的格式，可参考下面的样例格式

	/*$orderInfo = '<CB>测试打印</CB><BR>';
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
	$orderInfo .= '送货地点：广州市南沙区xx路xx号<BR>';
	$orderInfo .= '联系电话：13888888888888<BR>';
	$orderInfo .= '订餐时间：2014-08-08 08:08:08<BR>';
	$orderInfo .= '<QR>http://www.dzist.com</QR>';//把二维码字符串用标签套上即可自动生成二维码
	*/
	//打开注释可测试
	//doPrint(SN,$orderInfo,1);
	public function doPrint($printer_sn,$orderInfo,$times){
		
		$content = array(			
			'user'			=>	$this->C_USER,
			'stime'			=>	$this->C_STIME,
			'sig'			=>	$this->C_SIG,
			'apiname'		=>	'Open_printMsg',
			'sn'			=>	$printer_sn,
			'content'		=>	$orderInfo,
			'times'			=>	$times//打印次数
		);
		
		$client = new HttpClient($this->C_IP,$this->C_PORT);
		if (!$client->post($this->C_PATH,$content)) {
			return $this->json_return(array(), 100, 'error');
		} else {
			//服务器返回的JSON字符串，建议要当做日志记录起来
			$result = $client->getContent();
			return $this->json_return($result);
		}
	}
	// 这个要放外部
	public function makeContent($row, $tpl) {
		$content = '';
		$toarr = $row;
		return str_replace($row, $toarr, $tpl);
	}
			
	//===========方法2.查询某订单是否打印成功=============
	//***接口返回值说明***
	//正确例子：
	//已打印：{"msg":"ok","ret":0,"data":true,"serverExecutedTime":6}
	//未打印：{"msg":"ok","ret":0,"data":false,"serverExecutedTime":6}
	
	//打开注释可测试
	//$orderid = "xxxxxxxx_xxxxxxxxxx_xxxxxxxx";//订单ID，从方法1返回值中获取
	//queryOrderState($orderid);
	public function queryOrderState($index){
		
		$msgInfo = array(
			'user'			=>	$this->C_USER,
			'stime'			=>	$this->C_STIME,
			'sig'			=>	$this->C_SIG,	 
			'apiname'		=>	'Open_queryOrderState',
			'orderid'		=>	$index
		);
	
		$client = new HttpClient($this->C_IP,$this->C_PORT);
		if (!$client->post($this->C_PATH,$msgInfo)) {
			return $this->json_return(array(), 100, 'error');
		} else {
			$result = $client->getContent();
			return $this->json_return($result);
		}
	}

	//===========方法3.查询指定打印机某天的订单详情============
	//***接口返回值说明***
	//正确例子：{"msg":"ok","ret":0,"data":{"print":6,"waiting":1},"serverExecutedTime":9}
	
	//打开注释可测试
	//$date = "2017-04-02";//注意时间格式为"yyyy-MM-dd",如2016-08-27
	//queryOrderInfoByDate(SN,$date);
	public function queryOrderInfoByDate($printer_sn, $date){
		$msgInfo = array(
			'user'		=>	$this->C_USER,
			'stime'		=>	$this->C_STIME,
			'sig'		=>	$this->C_SIG,			
			'apiname'	=>	'Open_queryOrderInfoByDate',
			'sn'		=>	$printer_sn,
			'date'		=>	$date
		);
		
		$client = new HttpClient($this->C_IP,$this->C_PORT);
		if (!$client->post($this->C_PATH,$msgInfo)) { 
			return $this->json_return(array(), 100, 'error');
		} else {
			$result = $client->getContent();
			return $this->json_return($result);
		}
	}

	//===========方法4.查询打印机的状态==========================
	//***接口返回值说明***
	//正确例子：
	//{"msg":"ok","ret":0,"data":"离线","serverExecutedTime":9}
	//{"msg":"ok","ret":0,"data":"在线，工作状态正常","serverExecutedTime":9}
	//{"msg":"ok","ret":0,"data":"在线，工作状态不正常","serverExecutedTime":9}
	//打开注释可测试
	//queryPrinterStatus(SN);
	public function queryPrinterStatus($printer_sn) {
		
		$msgInfo = array(
			'user'		=>	$this->C_USER,
			'stime'		=>	$this->C_STIME,
			'sig'		=>	$this->C_SIG,	
			'apiname'	=>	'Open_queryPrinterStatus',
			'sn'		=>	$printer_sn
		);
		
		$client = new HttpClient($this->C_IP,$this->C_PORT);
		if (!$client->post($this->C_PATH,$msgInfo)) {
			return $this->json_return(array(), 100, 'error');
		} else {
			$result = $client->getContent();
			return $this->json_return($result);
		}
	}
	
	public function json_return($data,$code=0, $msg='') {
		return array(
			'code'	=> 0,
			'msg'	=> $msg,
			'data'	=> $data,
		);
	}

}
<?php
class member
{
	private $hosturl;
	private $token;
	function __construct($username,$password,$host="")
	{
		if(empty($host)) message("请先配置接口基础地址");
	
		$this->hosturl=$host;
		$this->getToken($username,$password);
	}

	private function getToken($username,$password)
	{
		global $_W;
		$token=$_COOKIE[$username."tokenCookie_".md5($this->hosturl)];
	
		if(empty($token))
		{
			$url = sprintf($this->hosturl.'/token/get-token?user=%s&password=%s',$username,$password);
			$rs =  json_decode(file_get_contents($url),true);
			$data=$this->checkRs($rs);
			if(is_error($data)) message($data["message"]);
			$token=$data["message"][0]["token"];
		
			setcookie($username."tokenCookie_".md5($this->hosturl),$token,$data["message"][0]["expireDate"]/1000);
		}
		$this->token=$token;
	}


	public function _common($car_id,$type)
	{

		$url = sprintf($this->hosturl.'/member/'.$type.'?cardId=%s&token='.$this->token,$car_id);
		$rs =  json_decode(file_get_contents($url),true);
		return $this->checkRs($rs);

	}
	private function checkRs($rs)
	{
		if($rs["code"]==0&&$rs["msg"]=="success") return error(0,$rs["data"]);
		return error(1,$rs["msg"]);
	}

	public function memberCardAboutInfo($card_id,$type)
	{
		$typeArr=array(
				"balance"=>"get-card-balance-total-by-cardId", /*卡片余额*/
				"credits"=>"get-credits-by-cardId",/*卡片积分*/
				"bindingService"=>"get-binding-service-by-cardId", /*绑定服务*/
				"bindingVoucher"=>"get-binding-voucher-by-cardId", /*代金卷*/
				"bindingCustomerHistory"=>"get-customer-consume-history-by-cardId", /*历史记录*/
		);
		if(!isset($typeArr[$type])) return false;
		return $this->_common($card_id, $typeArr[$type]);
	}
	
	public function getCommon($type,$token=true)
	{
		if($token)
		{		
			 $url =$this->hosturl.'/member/'.$type.'&token='.$this->token;
		}else{
			 $url =	$this->hosturl.'/'.$type;	
			
		}
		$rs =  json_decode(file_get_contents($url),true);
	
		if(empty($rs)) return error(1,"未获取到信息");
		return $this->checkRs($rs);
		
	}
	public function openid2carid($openid)
	{ 
		static $location=array();
		if(isset($location[md5($openid)])) return $location[md5($openid)]; 
		$type="get-card-info-by-openId";
		$type.="?openid=".$openid;
		$result=$this->getCommon($type);
		if(!is_error($result)) $location[md5($openid)]=$result;
		return $result;
	}
	public function mobile2carid($mobile)
	{
		static $location=array();
		if(isset($location[md5($mobile)])) return $location[md5($mobile)];
		$type="get-card-info-by-mobile";
		$type.="?mobile=".$mobile;
		$result=$this->getCommon($type);
		if(!is_error($result)) $location[md5($mobile)]=$result;
		return $result;
	}
	/*
	 * 积分兑换
	 * @cardId   会员卡id
	 * @credit    消耗的积分
	 * @redeemDate 兑换日期
	 * @decription 描述
	 * 
	 * */
	public function redeemCredit($data)
	{
		$type="integral/weixin/redeem-credit?";
		$data["description"]=$data["decription"];
		unset($data["decription"]);		
		$type.=http_build_query($data);
		return $this->getCommon($type,false);	
	}
	/*
	 * 卡片积分变更
	 * @appid  公众号id
	 * @cardId 会员卡id
	 * @credit 积分（变更积分（减少是为负数））
	 * @comments  备注内容，可以写活动内容
	 * @return json
	 * */
	public function saveCredit($data)
	{
		$type="save-card-credit-record?";
		$type.=http_build_query($data);
		return $this->getCommon($type,true);
	}
	
	


}

<?php  /*捷讯设计*/
/**
 * ALIPAY API: alipay.user.validate request
 *
 * @author auto create
 * @since 1.0, 2014-06-12 17:15:32
 */
class AlipayUserValidateRequest
{
	/** 
	 * 用户的支付宝登陆号
	 **/
	private $logonId;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	
	public function setLogonId($logonId)
	{
		$this->logonId = $logonId;
		$this->apiParas["logon_id"] = $logonId;
	}

	public function getLogonId()
	{
		return $this->logonId;
	}

	public function getApiMethodName()
	{
		return "alipay.user.validate";
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function getTerminalType()
	{
		return $this->terminalType;
	}

	public function setTerminalType($terminalType)
	{
		$this->terminalType = $terminalType;
	}

	public function getTerminalInfo()
	{
		return $this->terminalInfo;
	}

	public function setTerminalInfo($terminalInfo)
	{
		$this->terminalInfo = $terminalInfo;
	}

	public function getProdCode()
	{
		return $this->prodCode;
	}

	public function setProdCode($prodCode)
	{
		$this->prodCode = $prodCode;
	}

	public function setApiVersion($apiVersion)
	{
		$this->apiVersion=$apiVersion;
	}

	public function getApiVersion()
	{
		return $this->apiVersion;
	}

}

<?php  /*捷讯设计*/
/**
 * ALIPAY API: alipay.app.token.get request
 *
 * @author auto create
 * @since 1.0, 2016-01-14 17:02:44
 */
class AlipayAppTokenGetRequest
{
	/** 
	 * 应用安全码
	 **/
	private $secret;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;

	
	public function setSecret($secret)
	{
		$this->secret = $secret;
		$this->apiParas["secret"] = $secret;
	}

	public function getSecret()
	{
		return $this->secret;
	}

	public function getApiMethodName()
	{
		return "alipay.app.token.get";
	}

	public function setNotifyUrl($notifyUrl)
	{
		$this->notifyUrl=$notifyUrl;
	}

	public function getNotifyUrl()
	{
		return $this->notifyUrl;
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
<?php  
/*捷讯设计*/
//转换编码
function characet($data) {
	if (! empty ( $data )) {
		$fileType = mb_detect_encoding ( $data, array (
				'UTF-8',
				'GBK',
				'GB2312',
				'LATIN1',
				'BIG5' 
		) );
		if ($fileType != 'UTF-8') {
			$data = mb_convert_encoding ( $data, 'UTF-8', $fileType );
		}
	}
	return $data;
}

/**
 * 使用SDK执行接口请求
 * @param unknown $request
 * @param string $token
 * @return Ambigous <boolean, mixed>
 */
function aopclient_request_execute($request,$config=array(),$token = NULL) {
 //   return;
    if($config['app_auth_token'] && $config['app_auth_token']!="")
        $token=$config['app_auth_token'];
    
   // $token="201708BB97e2634b68e0475b96105998bf61fX08";
	$aop = new AopClient ();
	$aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
	$aop->appId = $config['app_id'];
	$aop->appInfoAuthtoken = $config['appauthtoken'];
	if($config['alipay_key'])$aop->rsaPublicKeyFilePath = $config['alipay_key'];
	$aop->rsaPrivateKeyFilePath = $config['alipay_cert'];
	$aop->apiVersion = "1.0";
	$result = $aop->execute($request,$token);
	return $result;
}
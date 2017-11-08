<?php
require_once '../addons/j_money/alipay/AopSdk.php';
require_once '../addons/j_money/alipay/function.inc.php';

class F2fpay {
	
	public function barpay($out_trade_no, $auth_code, $total_amount, $subject,$config) {
		$biz_content="{\"out_trade_no\":\"" . $out_trade_no . "\",";
		$biz_content.="\"scene\":\"bar_code\",";
		$biz_content.="\"auth_code\":\"" . $auth_code . "\",";
		$biz_content.="\"total_amount\":\"" . $total_amount. "\",\"discountable_amount\":\"0.00\",";
		$biz_content.="\"subject\":\"" . $subject . "\",\"body\":\"goodpay\",";
		if($config['alipay_store_id'])$biz_content.="\"alipay_store_id\":\"".$config['alipay_store_id']."\",";
		$biz_content.="\"timeout_express\":\"5m\"}";
		$request = new AlipayTradePayRequest();
		$request->setBizContent ($biz_content);
		$response = aopclient_request_execute ( $request,$config);
		return $response;
	}
	public function authToken($code,$config) {
		$request = new AlipaySystemOauthTokenRequest();
		$request->setGrantType("authorization_code");
		$request->setCode($code);
		$response=aopclient_request_execute($request,$config);
		return $response;
	}

	public function creatpay($out_trade_no, $total_amount,$buyer_id, $subject,$config) {
		$biz_content="{\"out_trade_no\":\"" . $out_trade_no . "\",";
		$biz_content.="\"sys_service_provider_id\":\"2088721109731155\",";
		$biz_content.="\"buyer_id\":\"" . $buyer_id . "\",";
		$biz_content.="\"total_amount\":\"" . $total_amount. "\",\"discountable_amount\":\"0.00\",";
		$biz_content.="\"subject\":\"" . $subject . "\",\"body\":\"goodpay\",";
		if($config['alipay_store_id'])$biz_content.="\"alipay_store_id\":\"".$config['alipay_store_id']."\",";
		$biz_content.="\"timeout_express\":\"90m\"}";
		$request = new AlipayTradeCreateRequest();
		$request->setBizContent ($biz_content);
		$response = aopclient_request_execute ($request,$config);
		return $response;
	}
	
	public function qrpay($out_trade_no,  $total_amount, $subject,$config) {
		$biz_content="{\"out_trade_no\":\"" . $out_trade_no . "\",";
		$biz_content.="\"total_amount\":\"" . $total_amount
		. "\",\"discountable_amount\":\"0.00\",";
		$biz_content.="\"subject\":\"" . $subject . "\",\"body\":\"支付宝扫码付款\",";
		if($config['alipay_store_id'])$biz_content.="\"alipay_store_id\":\"".$config['alipay_store_id']."\",";
		$biz_content.="\"timeout_express\":\"5m\"}";
		$request = new AlipayTradePrecreateRequest();
		$request->setBizContent ( $biz_content );
		$response = aopclient_request_execute ( $request,$config);
		return $response;
	}
	
	
	public function query($out_trade_no,$config) {	
		$biz_content="{\"out_trade_no\":\"" . $out_trade_no . "\"}";
		$request = new AlipayTradeQueryRequest();
		$request->setBizContent ( $biz_content );
		$response = aopclient_request_execute ( $request,$config);
		return $response;
	}
	
	
	public function cancel($out_trade_no,$config) {
		$biz_content="{\"out_trade_no\":\"" . $out_trade_no . "\"}";
		$request = new AlipayTradeCancelRequest();
		$request->setBizContent ( $biz_content );
		$response = aopclient_request_execute ( $request,$config);
		return $response;
	}
	
	public function refund($trade_no,$refund_amount,$config) {
		$biz_content = "{\"out_trade_no\":\"". $trade_no . "\",\"refund_amount\":\""
						. $refund_amount
						. "\",\"out_request_no\":\"\",\"refund_reason\":\"退款\",\"store_id\":\"\",\"terminal_id\":\"\"}";
		
		$request = new AlipayTradeRefundRequest();
		$request->setBizContent ( $biz_content );
		$response = aopclient_request_execute ( $request,$config);
		return $response;
	}
	
	public function refundcheck($trade_no,$out_request_no,$config) {
		$biz_content = "{\"out_trade_no\":\"". $trade_no . "\",\"trade_no\":\"\",\"out_request_no\":\"".$out_request_no."\"}";
		$request = new AlipayTradeFastpayRefundQueryRequest();
		$request->setBizContent ( $biz_content );
		$response = aopclient_request_execute ( $request,$config);
		return $response;
	}
}
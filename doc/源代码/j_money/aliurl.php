<?php
$appid=$_GET['app_id'];
if($appid){
	$aop = new AopClient ();
	$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
	$aop->appId = $appid;
	$aop->rsaPrivateKeyFilePath = 'merchant_private_key_file';
	$aop->alipayPublicKey='alipay_public_key_file';
	$aop->apiVersion = '1.0';
	$aop->format='json';
	$request = new AlipayOfflineMarketShopCreateRequest ();
	$request->setBizContent("{" .
	"    \"store_id\":\"shop_0001\"," .
	"    \"category_id\":\"2016062900190081\"," .
	"    \"brand_name\":\"肯德基\"," .
	"    \"brand_logo\":\"1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC\"," .
	"    \"main_shop_name\":\"揭阳自助洗衣\"," .
	"    \"province_code\":\"440000\"," .
	"    \"city_code\":\"445200\"," .
	"    \"district_code\":\"445202\"," .
	"    \"address\":\"仙桥镇紫泰路美西路段\"," .
	"    \"longitude\":116.3617274135," .
	"    \"latitude\":\"23.5111706945\"," .
	"    \"contact_number\":\"13612344321,021-12336754\"," .
	"    \"notify_mobile\":\"13867498729\"," .
	"    \"main_image\":\"1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC\"," .
	"    \"audit_images\":\"1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC,4Q8Pp00AT7eo9NoAJkMR3AAAACMAAUYT\"," .
	"    \"business_time\":\"09:00-11:00,13:00-15:00\"," .
	"    \"wifi\":\"T\"," .
	"    \"parking\":\"F\"," .
	"    \"value_added\":\"免费茶水、免费糖果\"," .
	"    \"avg_price\":\"35.83\"," .
	"    \"isv_uid\":\"2088001969784501\"," .
	"    \"licence\":\"1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC\"," .
	"    \"licence_code\":\"H001232\"," .
	"    \"licence_name\":\"来伊份上海分公司\"," .
	"    \"business_certificate\":\"1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC\"," .
	"    \"business_certificate_expires\":\"2020-03-20\"," .
	"    \"auth_letter\":\"1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC\"," .
	"    \"is_operating_online\":\"T\"," .
	"    \"online_url\":\"http://www.******.com/shop/21831830\"," .
	"    \"operate_notify_url\":\"http://abc.com\"," .
	"    \"implement_id\":\"HU002,HT002\"," .
	"    \"no_smoking\":\"T\"," .
	"    \"box\":\"T\"," .
	"    \"request_id\":\"2015123235324534\"," .
	"    \"other_authorization\":\"1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC,1T8Pp00AT7eo9NoAJkMR3AAAACMAAQEC\"," .
	"    \"licence_expires\":\"2020-10-20\"," .
	"    \"op_role\":\"ISV\"," .
	"    \"biz_version\":\"2.0\"" .
	"  }");
	$result = $aop->execute ( $request); 
	 
	$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
	$resultCode = $result->$responseNode->code;
	if(!empty($resultCode)&&$resultCode == 10000){
	echo "成功";
	} else {
	echo "失败";
	}
}
echo "授权成功";
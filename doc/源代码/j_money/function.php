<?php 
function _fun_customer($trade,$cfg,$shop){
	/*global $_W;
	$openid=$trade["openid"];
	$fee=$trade['cash_fee'];//1元=100
	$creadit=0;//这个是积分数值
	load()->func('communication');
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$tokens= WeAccount::token();
	$url="https://api.weixin.qq.com/card/membercard/updateuser?access_token=".$tokens;
	$postAttr=array(
		"code"=>"",
		"card_id"=>"",
		"record_bonus"=>"",//增加积分的原因
		"add_bonus"=>"",//积分的增量，请输入整数
	);
	$data = urldecode(json_encode($postAttr));
	$response = ihttp_post($url, $data);
	if(!is_error($result)){
		$result = @json_decode($response['content'], true);
		if($result['errcode']==0){
			//增加积分成功后，修改交易记录
			pdo_update("j_money_trade",array("credit"=>$creadit),array("id"=>$trade['id']));
		}
	}*/
}
?>
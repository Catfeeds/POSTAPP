<?php 
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$shopid = !empty($_GPC['shopid']) ? $_GPC['shopid'] : message("请确认店铺");
$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:a ",array(":a"=>$shopid));
if(!$shop)message("请选择店铺");
$cfg = $this->module['config'];
if(!pdo_fieldexists('j_money_group', 'chargefun')) {
	pdo_query("ALTER TABLE ".tablename('j_money_group')." ADD `chargefun` varchar(300) NOT NULL COMMENT '充值活动';");
}
if(!pdo_fieldexists('j_money_recharge', 'gift')) {
	pdo_query("ALTER TABLE ".tablename('j_money_recharge')." ADD `gift` int(10) NOT NULL default '0' COMMENT '赠送金额';");
}
if($operation=="display"){
	$fun=json_decode($shop['chargefun'],true);
	if(checksubmit('submit')){
		$temp=array();
		if($_GPC['funkey']){
			foreach($_GPC['funkey'] as $index=>$val){
				$temp[]=$val."|".$_GPC['funval'][$index];
			}
		}
		pdo_update("j_money_group",array("chargefun"=>json_encode($temp)),array("id"=>$shopid));
		message("修改完成", $this->createWebUrl('membercharge',array('shopid'=>$shopid)), 'success');
	}
}elseif($operation=="post"){
	$memberid=pdo_fetchcolumn("SELECT wxcardid FROM ".tablename('j_money_group')." WHERE id = :id ",array(':id'=>$shopid));
	if(!$shop['wxcardid'])message("请先填写会员卡的ID");
	load()->func('communication');
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$tokens=$acc->fetch_token();
	$url = "https://api.weixin.qq.com/card/update?access_token=".$tokens;
	$data=array(
		"card_id"=>$shop['wxcardid'],
		"member_card"=>array(
			"custom_cell1"=>array(
				"name"=>urlencode("在线充值"),
				"tips"=>urlencode("会员线充值"),
				"url"=>$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=membercharge&m=j_money&shopid=".$shopid,
			),
		),
	);
	$content = ihttp_post($url,urldecode(json_encode($data)));
	$result = @json_decode($content['content'], true);
	if($result['errcode']){
		message("错误提示：".$result['errmsg']);
	}
	if($result['send_check']){
		message("修改成功,内容需要微信审核", $this->createWebUrl('membercharge',array('shopid'=>$shopid)), 'error');
	}else{
		message("修改成功", $this->createWebUrl('membercharge',array('shopid'=>$shopid)), 'success');
	}
}
include $this->template('membercharge');
?>
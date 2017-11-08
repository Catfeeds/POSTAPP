<?php 
global $_GPC, $_W;
$openid=$_W['openid'] ? $_W['openid'] : $_GPC['openid_'.$_W['uniacid']];

if(!$openid){
	$callback = urlencode($_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=oauthcredit&m=j_money&pagetpye=3");
	$forward = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$_W['account']['key']."&redirect_uri={$callback}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
	header('location:'.$forward);
}
$cfg = $this->module['config'];
$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and openid=:a ",array(":a"=>$openid));
$card_id=$shop['wxcardid'] ? $shop['wxcardid']:$cfg['wxcardid'];
if(!$membercard){
	load()->func('communication');
	$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
	$acc = WeAccount::create($acid);
	$tokens=$acc->fetch_token();
	$url="https://api.weixin.qq.com/card/user/getcardlist?access_token=".$tokens;
	$data=array("openid"=>$openid,"card_id"=>$card_id,);
	$content = ihttp_post($url,json_encode($data));
	if(is_error($content))return false;
	$result = @json_decode($content['content'], true);
	if($result["errcode"])message($result["errmsg"]);
	$cardno=$result["card_list"][0]['code'];
	$data=array(
		"weid"=>$_W['uniacid'],
		"groupid"=>"0",
		"openid"=>$openid,
		"wxcardno"=>$cardno,
		"status"=>1,
		"createtime"=>TIMESTAMP,
	);
	pdo_insert("j_money_memebercard",$data);
	$membercard=$data;
}

if(!$membercard['wxcardno'])message("您还没有会员卡哦");
$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and (memberno=:a or openid=:b) and paytype=4 order by id desc ",array(":a"=>$membercard['wxcardno'],":b"=>$openid));

include $this->template('mobile_memberhistory');
?>
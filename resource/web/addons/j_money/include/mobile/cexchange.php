<?php 
global $_GPC, $_W;
include dirname(dirname(dirname(__FILE__)))."/apiofmember.class.php";
$op=empty($_GPC["op"])?"index":trim($_GPC["op"]);

$id=intval($_GPC["shopid"]);
$shop = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $id));


if($op=="list")
{
	if(empty($shop)) die(json_encode(array("success" => false)));
	$ds = strtotime($_GPC['ds'] ? $_GPC['ds'] . " 00:00:00" : date("Y-m-d") . " 00:00:00");
	$de = strtotime($_GPC['de'] ? $_GPC['de'] . " 23:59:59" : date("Y-m-d") . " 23:59:59");
	$where = " and shopid={$id} ";
	
	if ($ds) {
		$where.= " and createtime>=" . $ds . " and createtime<=" . $de . "";
	}
	
	$pindex = intval($_GPC['page']) ? intval($_GPC['page']) : 1;
	$psize = intval($_GPC['psize']) ? intval($_GPC['psize']) : 10;
	$start = ($pindex - 1) * $psize;
	$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_redeemcredit') . " WHERE uniacid='{$_W['uniacid']}' {$where}  order by id desc LIMIT " . $start . "," . $psize);
	$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_redeemcredit') . " WHERE uniacid='" . $_W['uniacid'] . "' {$where} ");
	$allpage = $total <= $psize ? 1 : ($total % $psize == 0 ? $total / $psize : intval($total / $psize) + 1);
	
	$outPutAry = array();
	foreach ($list as &$row) {
		$row["time"] = date("m-d H:i", $row['createtime']);
	}
	unset($row);
	die(json_encode(array("success" => true, "list" => $list, "allpage" => $allpage, "pindex" => $pindex)));


}		
$openid=$_W['openid'];
if(empty($shop)) message("店铺不存在");
$jfconfig=empty($shop["jfconfig"])?array():unserialize($shop["jfconfig"]);
if(empty($jfconfig)) message("请先配置积分兑换数据");	

if(empty($openid))
{
	load()->model("mc");
	$userinfo=mc_oauth_userinfo();
	if(empty($userinfo)||is_error($userinfo))
	{
		message("请用微信登陆");
	}
}

$userinfo=pdo_fetch("select * from ".tablename("rlongcar_user")." where weid=:weid and openid=:openid",array(":weid"=>$_W["uniacid"],":openid"=>$openid));

if(empty($userinfo)) message("请先绑定会员信息",murl("entry//mobile",array('r'=>'blind','m'=>'rlong_car')),"warning");
$mobile=$userinfo["value"];

$config=$this->module["config"];
$configApi=$config["memberApi"];
$api=new member($configApi["username"],$configApi["password"],$configApi["url"]);

$result=$api->mobile2carid($mobile);
if(is_error($result)||empty($result["message"])) message("请先绑定会员信息",murl("entry//mobile",array('r'=>'blind','m'=>'rlong_car')),"warning");
$cards=$result["message"];

$k=intval($_GPC["k"]);
$carid=$cards[$k]["id"];


$creditsResult=$api->memberCardAboutInfo($carid,"credits");
if(is_error($creditsResult)) message("获取会员积分失败");
$availableCredits=$creditsResult['message'][0]['availableCredits'];

if($op=="index")
{
	include $this->template("cexchange/index");
}elseif($op=="exchange")
{
	load()->func('communication');
	$num=intval($_GPC["num"]);
	$des=trim($_GPC["des"]);
	$bumen=trim($_GPC["bumen"]);

	if(empty($carid)||!is_numeric($carid)) message("会员卡不存在");
	if($num<=0) message("请选择兑换份数");
	$credit=$num*intval($jfconfig['creditsnum']);
	
	$data=array(
		"cardId"=>$cards[$k]["cardNumber"],
		"credit"=>$credit,
		"redeemDate"=>date("Y-m-d"),
		"decription"=>$des,			
	);
	/*积分兑换接口*/
	/*
	$res=$api->redeemCredit($data);
	*/
	$res=$api->saveCredit(array(
		"appid"=>$_W['account']['key'],
		"cardId"=>$carid,
		"credit"=>-$credit,
		"comments"=>$des,
	));
	$data["uniacid"]=$_W["uniacid"];
	$data["openid"]=$openid;
	$data["num"]=$num;
	$data["user"]=$cards[$k]['holderContact']['conatctName'];
	$data["mobile"]=$cards[$k]['holderContact']['mobile'];
	$data["shopid"]=$id;
	$data["availableCredits"]=$availableCredits;
	$data["createtime"]=time();
	$data["bumen"]=$bumen;
	if(is_error($res))
	{	
	  $data["status"]=0;
	  $data["mes"]=$res["message"];
	}else{
	  $data["status"]=1;
	}
	pdo_insert("j_money_redeemcredit",$data);
	$printer_url = $this->createmobileurl('jfprinter',array('id'=>pdo_insertid()));
	$printer_url = $_W['siteroot'] . 'app/' . substr($printer_url, 2);
	ihttp_get($printer_url); 
	is_error($res)?message($res["message"]):message("兑换成功","","success");
}	









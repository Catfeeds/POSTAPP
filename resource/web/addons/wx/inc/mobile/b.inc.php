<?php
/**
 * 【超人】积分商城模块定义
 *
 * @author 超人
 * @url http://bbs.we7.cc/
 */


defined('IN_IA') or exit('Access Denied');
class Superman_creditmall_doMobileB extends Superman_creditmallModuleSite {


	public function getprice($price){
		$result=array("point"=>0,"money"=>0);
		switch ($price){
			case ($price <=1000):
				$result["point"]=intval($price*0.5,0);
				$result["money"]=intval($price*0.5,0);
				break;
			case ($price >1000):
				$result["point"]=intval($price*0.3,0);
				$result["money"]=intval($price*0.7,0);
				break;

		}

		return $result;
	}

    public function exec() {
        global $_W, $_GPC;


        	load()->model('module');
			$module=module_fetch("superman_creditmall");
			$cfg=$module['config'];

			//var_dump($module);
			$gurl=$cfg['base']['goods_url'];
        	$nurl=$cfg['base']['qiniu_url'];
        	if(empty($gurl)||empty($nurl)){
	        	echo "请先设置远程获取商品地址和商品图片地址";
	        	die();
        	}

	        $url=$gurl;
	        $products=json_decode(file_get_contents($url),true);
	        $uniacid=$_W['uniacid'];


	        foreach($products as $p){
				$myprice=$this->getprice($p["salePrice"]);
				$exp=pdo_fetch("select id,cover from ".tablename("superman_creditmall_product")." where uniacid=".$uniacid." and remote_id=".$p["id"]);
	        	if($exp){
	        		$data=array("market_price"=>$p["salePrice"],
						"price"=>$myprice["money"],
						"credit"=>$myprice["point"]);
	        		if($p["overSold"]==1){
		        		$data["total"]=100;
	        		}else{
		        		$data["total"]=$p["stockQuantity"];
	        		}

	        		if((empty($exp['cover']) || empty($exp["album"])) && $p["pictureUrl"]){
	        			$cover=file_fetch($nurl.$p["pictureUrl"]);
	        			if(!is_error($cover)){
			        		$data["cover"]=$cover;
			        		$data["album"]=serialize(array($cover));
			        	}
	        		}

	        		pdo_update("superman_creditmall_product",$data,array("id"=>$exp["id"]));

	        	}else{

	        		$data=array(
	        			"remote_id"=>$p["id"],
	        			"market_price"=>$p["salePrice"],
						"price"=>$myprice["money"],
						"credit"=>$myprice["point"],
						"type"=>1,
						"uniacid"=>$uniacid,
						"title"=>$p["name"],
						"dispatch_id"=>0,
						"credit_type"=>"credit1",
						"share_credit"=>0,
						"share_credit_type"=>"credit1",
						"description"=>$p["number"],
						"isshow"=>1,
						"ishome"=>1,
						"ishot"=>1,
						"minus_total"=>1,
						"dateline"=>time(),
	        	"extend"=>'a:2:{s:5:"share";a:3:{s:5:"title";s:0:"";s:6:"imgurl";s:0:"";s:4:"desc";s:0:"";}s:8:"checkout";a:2:{s:4:"user";a:1:{i:0;s:1:"1";}s:4:"code";a:1:{i:0;s:1:"1";}}}'
	        		);

	        		if($p["overSold"]==1){
		        		$data["total"]=100;
	        		}else{
		        		$data["total"]=$p["stockQuantity"];
	        		}

	        		if($p["pictureUrl"]){

	        			$cover=file_fetch($nurl.$p["pictureUrl"]);

	        			if(!is_error($cover)){
			        		$data["cover"]=$cover;
			        		$data["album"]=serialize(array($cover));
			        	}
		        	}
	        		pdo_insert("superman_creditmall_product",$data);

	        	}

	        }

	        echo "done";



    }
}
$obj = new Superman_creditmall_doMobileB;
$obj->exec();

<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doWebProduct extends Superman_creditmallModuleSite
{
	public function __construct()
	{
		parent::__construct(true);
		//print_r(unserialize('a:2:{s:5:"share";a:3:{s:5:"title";s:0:"";s:6:"imgurl";s:0:"";s:4:"desc";s:0:"";}s:8:"checkout";a:2:{s:4:"user";a:1:{i:0;s:1:"1";}s:4:"code";a:1:{i:0;s:1:"1";}}}'));
	}

	public function getprice($price,$bl=100){
		//$price=intval($price);
		$result=array("point"=>0,"money"=>0);
		$bl=abs(intval($bl));
		$bl=empty($bl)?100:$bl;
		$bl=$bl>100?100:$bl;
		$result["money"]=round($price*$bl/100,2);
		$result["point"]=$price-$result["money"];
		return $result;
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
		/*
		switch ($price){
			case ($price <=100):
				$result["point"]=number_format($price*0.5,0);
				$result["money"]=number_format($price*0.5,0);
				break;
			case ($price > 100 && $price <=300):
				$result["point"]=number_format($price*0.4,0);
				$result["money"]=number_format($price*0.6,0);
				break;
			case ($price > 300 && $price <=600):
				$result["point"]=number_format($price*0.3,0);
				$result["money"]=number_format($price*0.7,0);
				break;
			case ($price > 600 && $price <=2000):
				$result["point"]=number_format($price*0.2,0);
				$result["money"]=number_format($price*0.8,0);
				break;
			case ($price >2000):
				$result["point"]=number_format($price*0.1,0);
				$result["money"]=number_format($price*0.9,0);
				break;

		}
		*/

		return $result;
	}

	public function exec()
	{
		global $_W, $_GPC;
		$title = '商品管理';
		$eid = intval($_GPC['eid']);
		$act = in_array($_GPC['act'], array('display', 'post', 'delete','sync', 'setattr','syncjf','virtual')) ? $_GPC['act'] : 'display';
		$product_types = superman_product_type();
		if ($act == 'display') {
			if (checksubmit('submit')) {
				$displayorder = $_GPC['displayorder'];
				if ($displayorder) {
					foreach ($displayorder as $id => $val) {
						pdo_update('superman_creditmall_product', array('displayorder' => $val), array('id' => $id));
					}
					message('操作成功！', referer(), 'success');
				}
			}
			$pindex = max(1, intval($_GPC['page']));
			$pagesize = 20;
			$start = ($pindex - 1) * $pagesize;
			$filter['uniacid'] = $_W['uniacid'];
			if (trim($_GPC['title']) != '') {
				$filter['title'] = trim($_GPC['title']);
			}
			if ($_GPC['type'] > 0) {
				$filter['type'] = intval($_GPC['type']);
			}
			$sort = $_GPC['sort'];
			$orderby = isset($_GPC['orderby']) && $_GPC['orderby'] == 'ASC' ? 'ASC' : 'DESC';
			$order_by = '';
			if (in_array($sort, array('total', 'sales'))) {
				$order_by = ' ORDER BY ' . $sort . ' ' . $orderby;
				$orderby = $orderby == 'ASC' ? 'DESC' : 'ASC';
			}
			$list = superman_product_fetchall($filter, $order_by, $start, $pagesize);
			$total = superman_product_count($filter);
			$pager = pagination($total, $pindex, $pagesize);
			if ($list) {
				foreach ($list as &$p) {
					superman_product_set($p);
					$p['prices'] = '';
					$p['credit_type'] = superman_credit_type($p['credit_type']);
					if ($p['price'] && $p['credit']) {
						$p['prices'] = $p['price'] . '元+' . $p['credit'] . $p['credit_type'];
					} else if ($p['price']) {
						$p['prices'] = $p['price'] . '元';
					} else if ($p['credit']) {
						$p['prices'] = $p['credit'] . $p['credit_type'];
					} else {
						if ($p['type'] == 2) {
							$p['prices'] = '0' . $p['credit_type'];
						} else {
							$p['prices'] = '免费';
						}
					}
				}
				unset($p);
			}
		} elseif($act=="sync"){

        	$gurl=$this->module['config']['base']['goods_url'];
        	$nurl=$this->module['config']['base']['qiniu_url'];
        	$bili=$this->module['config']['newset']['sfprice'];
        	if(empty($gurl)||empty($nurl)){
	        	message("请先设置远程获取商品地址和商品图片地址",'','error');
        	}

	        $url=$gurl;
	        $products=json_decode(file_get_contents($url),true);
	        $uniacid=$_W['uniacid'];


	        foreach($products as $p){
	        	//echo $p["salePrice"];
				$myprice=$this->getprice($p["salePrice"],$bili);
				//print_r($myprice);

				$exp=pdo_fetch("select id,cover from ".tablename("superman_creditmall_product")." where uniacid=".$uniacid." and type=1 and remote_id=".$p["id"]);
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
	        //die();
//	        print_r($products);
	       message("商品同步成功");

        } else if ($act == 'post') {
			$minus_total = superman_product_minus_total();
			$credit_type = superman_credit_type();
			$filter = array('uniacid' => $_W['uniacid'],);
			$dispatch = superman_dispatch_fetchall($filter);
			if (!$dispatch) {
				$dispatch = superman_dispatch_init($_W['uniacid']);
			}
			$id = intval($_GPC['id']);
			$item = superman_product_fetch($id);
			if ($item) {
				superman_product_set($item);
				if (superman_is_virtual($item)) {
					$filter = array('status' => 0, 'product_id' => $item['id']);
					$item['virtual_total'] = superman_virtual_count($filter);
					pdo_update('superman_creditmall_product', array('total' => $item['virtual_total']), array('id' => $item['id']));
				}
			} else {
				$item['isvirtual'] = 0;
				$item['isshow'] = 1;
				$item['ishome'] = 1;
				$item['ishot'] = 1;
				$item['minus_total'] = 1;
				$item['order_buy_num'] = 0;
				$item['today_limit'] = 0;
				$item['max_buy_num'] = 0;
				$item['activity_time'] = array('start' => date('Y-m-d H:i:s'), 'end' => date('Y-m-d H:i:s', strtotime('+1 months')),);
				$item['share_credit_type'] = 'credit1';
				$item['share_credit'] = 0;
				$item['extend']['auction_rule'] = '';
			}
			$filter = array('uniacid' => $_W['uniacid'],);
			$groups = superman_mc_groups_fetchall($filter, '', 0, -1);
			$filter = array('uniacid' => $_W['uniacid']);
			$checkout_user = superman_checkout_user_fetchall($filter, '', 0, -1);
			if ($checkout_user) {
				foreach ($checkout_user as &$user) {
					if (isset($item['extend']['checkout']['user']) && in_array($user['id'], $item['extend']['checkout']['user'])) {
						$user['selected'] = 1;
					}
					$member_info = mc_fetch($user['uid'], array('nickname'));
					$user['nickname'] = $member_info['nickname'];
					unset($user, $member_info);
				}
			}
			$checkout_code = superman_checkout_code_fetchall($filter, '', 0, -1);
			if ($checkout_code) {
				foreach ($checkout_code as &$code) {
					if (isset($item['extend']['checkout']['code']) && in_array($code['id'], $item['extend']['checkout']['code'])) {
						$code['selected'] = 1;
					}
					unset($code);
				}
			}
			if (checksubmit('submit')) {
				$extend = $_GPC['extend'];
				$extend['checkout'] = $_GPC['checkout'];
				$type = $item['type'] ? $item['type'] : intval($_GPC['type']);
				if ($type == 2) {
					$start_time = strtotime($_GPC['activity_time2']['start']);
					$end_time = strtotime($_GPC['activity_time2']['end']);
					$credit = $_GPC['credit2'];
				} else if (superman_is_redpack($type)) {
					if ($_GPC['isvirtual']) {
						message('微信红包不可选虚拟商品类型', referer(), 'error');
					}
					$credit = $_GPC['credit'];
				} else {
					$start_time = !isset($_GPC['activity_time_limit']) ? strtotime($_GPC['activity_time']['start']) : 0;
					$end_time = !isset($_GPC['activity_time_limit']) ? strtotime($_GPC['activity_time']['end']) : 0;
					$credit = $_GPC['credit'];
					unset($extend['auction_credit']);
					unset($extend['auction_rule']);
					unset($extend['redpack_amount']);
				}
				$cover = superman_fix_path($_GPC['cover']);
				$cover=str_replace('attachment/', '', $cover);
				if ($cover) {
					$attachment_path = superman_attachment_root();
					$img_path = superman_cover_share_filename($cover);
					if (!file_exists($attachment_path . $img_path)) {
						file_image_thumb($attachment_path . $cover, $attachment_path . $img_path, 200);
					}
				}
				$data = array('uniacid' => $_W['uniacid'], 'title' => $_GPC['title'], 'market_price' => $_GPC['market_price'], 'price' => $_GPC['price'], 'credit_type' => $_GPC['credit_type'], 'credit' => $credit, 'total' => intval($_GPC['total']), 'sales' => intval($_GPC['sales']), 'start_time' => $start_time, 'end_time' => $end_time, 'cover' => $cover, 'view_count' => intval($_GPC['view_count']), 'share_count' => intval($_GPC['share_count']), 'comment_count' => intval($_GPC['comment_count']), 'description' => $_GPC['description'], 'joined_total' => $_GPC['joined_total'], 'displayorder' => $_GPC['displayorder'], 'dateline' => TIMESTAMP, 'minus_total' => $_GPC['minus_total'], 'isshow' => $_GPC['isshow'], 'ishome' => $_GPC['ishome'], 'ishot' => $_GPC['ishot'], 'isvirtual' => $_GPC['isvirtual'] == 'on' ? 1 : 0, 'extend' => isset($extend) && $extend ? iserializer($extend) : '', 'order_buy_num' => $_GPC['order_buy_num'], 'today_limit' => $_GPC['today_limit'], 'max_buy_num' => $_GPC['max_buy_num'], 'dispatch_id' => $_GPC['dispatch_id'], 'share_credit_type' => $_GPC['share_credit_type'], 'share_credit' => $_GPC['share_credit'], 'groupid' => $_GPC['groupid'],);
				if($type==7)
				{
					$data["couponid"]=$_GPC["couponid"];
				}	
	
				$album = $_GPC['album'];
				if (is_array($album) && !empty($album)) {
					$data['album'] = serialize($album);
				}
				if (empty($id)) {
					$data['type'] = $type;
					if (superman_is_virtual($data)) {
						unset($data['total']);
					}
					if (superman_is_redpack($type) && $cover == '') {
						$data['cover'] = './addons/superman_creditmall/template/mobile/images/redpack_bg.jpg';
					}
					pdo_insert('superman_creditmall_product', $data);
					$new_id = pdo_insertid();
					if ($new_id && superman_is_virtual($data) && $_GPC['virtual_keys']) {
						$virtual_keys = trim($_GPC['virtual_keys']);
						if (empty($virtual_keys)) {
							message('无添加数据', referer());
						}
						$virtual_keys = explode("\n", $virtual_keys);
						$_data = array('uniacid' => $_W['uniacid'], 'product_id' => $new_id, 'dateline' => TIMESTAMP,);
						foreach ($virtual_keys as $key => $v) {
							if ($v == '') {
								unset($virtual_keys['key']);
								continue;
							}
							$_data['key'] = $v;
							pdo_insert('superman_creditmall_virtual_stuff', $_data);
						}
						unset($_data);
						pdo_update('superman_creditmall_product', array('total' => count($virtual_keys)), array('id' => $new_id));
					}
				} else {
					if (superman_is_redpack($item['type'])) {
						if (stripos($data['cover'], 'addons/') !== false && substr($data['cover'], 0, 2) != './') {
							$data['cover'] = './' . $data['cover'];
						}
						if ($data['cover'] == '') {
							$data['cover'] = './addons/superman_creditmall/template/mobile/images/redpack_bg.jpg';
						}
					}
					unset($data['type']);
					unset($data['dateline']);
					unset($data['isvirtual']);
					if (superman_is_virtual($item)) {
						unset($data['total']);
					}
					pdo_update('superman_creditmall_product', $data, array('id' => $id));
				}
				message('操作成功！', $this->createWebUrl('product'), 'success');
			}
		} else if ($act == 'delete') {
			$id = intval($_GPC['id']);
			$item = superman_product_fetch($id);
			if (empty($item)) {
				message('商品不存在或是已被删除！', referer(), 'error');
			}
			if (!empty($item['album'])) {
				$arr = unserialize($item['album']);
				if ($arr) {
					foreach ($arr as $v) {
						file_delete($v);
					}
				}
			}
			if ($item['cover']) {
				file_delete($item['cover']);
			}
			pdo_delete('superman_creditmall_product', array('id' => $id));
			message('操作成功！', referer(), 'success');
		} else if ($act == 'setattr') {
			$id = intval($_GPC['id']);
			if (!$id) {
				echo '非法请求！';
				exit;
			}
			$field = $_GPC['field'];
			$value = $_GPC['value'];
			if (!in_array($field, array('isshow'))) {
				echo '非法请求！';
				exit;
			}
			$data = array($field => $value == 1 ? 0 : 1);
			$condition = array('id' => $id,);
			pdo_update('superman_creditmall_product', $data, $condition);
			echo 'success';
			exit;
		}else if($act=="syncjf")
		{
			$geturl=$this->module['config']['newset']['updata'];
			$default_img=$this->module['config']['newset']['imgurl'];
			$default_kcnum=$this->module['config']['newset']['kcnum'];
			$default_kcnum=empty($default_kcnum)?100:$default_kcnum;
			$default_dispatchid=$this->module['config']['newset']['dispatchid'];
			
			if(empty($geturl)){
				message("积分商品接口未配置",'','error');
			}
			$products=json_decode(file_get_contents($geturl),true);
			$uniacid=$_W['uniacid'];

			foreach($products as $p){

				$exp=pdo_fetch("select id,cover from ".tablename("superman_creditmall_product")." where uniacid=".$uniacid." and type=7 and remote_id=".$p["id"]);
				$data=array(
						"credit"=>$p["credits"],
						"total"=>$default_kcnum,
						"dispatch_id"=>intval($default_dispatchid),
				);

				if(empty($exp['cover']))
				{
					$data["cover"]=$default_img;
					$data["album"]=serialize(array($default_img));
				}

				if($exp){
					pdo_update("superman_creditmall_product",$data,array("id"=>$exp["id"]));
			
				}else{
					$insetdata=array(
							"remote_id"=>$p["id"],
							"market_price"=>0,
							"price"=>0,
							"type"=>7,
							"uniacid"=>$uniacid,
							"title"=>$p["name"],
							"dispatch_id"=>0,
							"credit_type"=>"credit1",
							"share_credit"=>0,
							"share_credit_type"=>"credit1",
							"description"=>$p["description"],
							"isshow"=>1,
							"ishome"=>1,
							"ishot"=>1,
							"minus_total"=>1,
							"dateline"=>time(),
							"extend"=>'a:2:{s:5:"share";a:3:{s:5:"title";s:0:"";s:6:"imgurl";s:0:"";s:4:"desc";s:0:"";}s:8:"checkout";a:2:{s:4:"user";a:1:{i:0;s:1:"1";}s:4:"code";a:1:{i:0;s:1:"1";}}}'
					);
					$data=array_merge($data,$insetdata);
					pdo_insert("superman_creditmall_product",$data);
				}

			}
		
			message("同步积分兑换商品成功",$this->createWebUrl("product"),"success");

		} else if ($act == 'virtual') {
			$product_id = intval($_GPC['product_id']);
			if ($product_id > 0) {
				$product = superman_product_fetch($product_id);
				if (empty($product)) {
					message('商品不存在或已删除', $this->createWebUrl('product'), 'error');
				}
			}
			if ($_GPC['delete'] == 1 && $_GPC['id'] != '') {
				pdo_delete('superman_creditmall_virtual_stuff', array('id' => $_GPC['id']));
				message('删除成功', referer(), 'success');
			}
			$pindex = max(1, intval($_GPC['page']));
			$pagesize = 20;
			$start = ($pindex - 1) * $pagesize;
			$filter = array('product_id' => $product_id);
			$list = superman_virtual_fetchall($filter, '', $start, $pagesize);
			if ($list) {
				foreach ($list as &$item) {
					superman_virtual_set($item);
				}
				unset($item);
			}
			$total = superman_virtual_count($filter);
			$pager = pagination($total, $pindex, $pagesize);
			if (checksubmit('submit')) {
				$virtual_keys = trim($_GPC['virtual_keys']);
				if (empty($virtual_keys)) {
					message('无添加数据', referer());
				}
				$virtual_keys = explode("\n", $virtual_keys);
				$_data = array('uniacid' => $_W['uniacid'], 'product_id' => $product_id, 'dateline' => TIMESTAMP,);
				foreach ($virtual_keys as $key => $item) {
					if ($item == '') {
						unset($virtual_keys['key']);
						continue;
					}
					$_data['key'] = $item;
					pdo_insert('superman_creditmall_virtual_stuff', $_data);
				}
				$filter = array('product_id' => $product_id, 'status' => 0);
				$count = superman_virtual_count($filter);
				pdo_update('superman_creditmall_product', array('total' => $count), array('id' => $product_id));
				message('添加成功', referer(), 'success');
			}
		}
		include $this->template('web/product');
	}
}

$obj = new Superman_creditmall_doWebProduct;
$obj->exec();

<?php 
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if($operation=="display"){
	$pindex=intval($_GPC['page']) ? intval($_GPC['page']) :1;
	$psize = 10;
	$start = ($pindex-1) * $psize;
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_lotterygame')." WHERE weid='{$_W['uniacid']}' order by id desc LIMIT ".$start.",".$psize);
	$total=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_lotterygame')." WHERE weid='".$_W['uniacid']."' ");
	$pager=pagination($total, $pindex, $psize);
	
	$prizelist=array();
	$list2=pdo_fetchall("SELECT * FROM ".tablename('j_money_award')." WHERE weid='{$_W['uniacid']}' and isprize=1 order by id asc" );
	foreach($list2 as $row){
		
		$prizelist[$row['gid']][]=$row;
	}
	
	
} elseif ($operation == 'post') {
	$id=$_GPC['id'];
	if($id){
		$reply=pdo_fetch("SELECT * FROM ".tablename('j_money_lotterygame')." WHERE id = :id ",array(':id'=>$id));
		$list= pdo_fetchall("SELECT * FROM ".tablename("j_money_award")." WHERE gid = :gid ORDER BY `id` asc", array(':gid' => $id));
	}
	$reply['zppic']= $reply['zppic']? $reply['zppic']:'../addons/j_money/template/img/6prize.png';
	$reply['thumb_pointer']=$reply['thumb_pointer']? $reply['thumb_pointer']: '../addons/j_money/template/img/pointer.gif';
	if (checksubmit('submit')){
		
		$insert=array(
			'weid'=> $_W['uniacid'],
			'thumb' => $_GPC['thumb'],
			'clientpic' => $_GPC['clientpic'],
			'pointer' => $_GPC['pointer'],
			'description' => $_GPC['description'],
			'title' => $_GPC['title'],
			'zppic' => $_GPC['zppic'],
			'rule' => htmlspecialchars_decode($_GPC['rule']),
			'starttime' => strtotime($_GPC['acttime']['start']),
			'endtime' => strtotime($_GPC['acttime']['end']),
			'status'=>intval($_GPC['status']),
			'gzurl'=>strval($_GPC['gzurl']),
			'sharedes'=>strval($_GPC['sharedes']),
			'thumb_bg'=>strval($_GPC['thumb_bg']),
			'thumb_pointer'=>strval($_GPC['thumb_pointer']),
			'bgcolor'=>strval($_GPC['bgcolor']),
		);
		
		if($id){
			pdo_update("j_money_lotterygame",$insert,array("id"=>$id));
			foreach ($_GPC['award-level'] as $index => $row) {
				$data = array(
					'level' => $_GPC['award-level'][$index],
					'title' => $_GPC['award-title'][$index],
					'total' => $_GPC['award-total'][$index],
					'renum' => $_GPC['award-renum'][$index],
					'description' => $_GPC['award-description'][$index],
					'thumb' => $_GPC['award-thumb'][$index],
					'credit' => intval($_GPC['award-credit'][$index]),
					'isprize' => intval($_GPC['award-isprize'][$index]),
					'leavel' => intval($_GPC['award-leavel'][$index]),
					'probalilty' => $_GPC['award-probalilty'][$index],
					'deg' => $_GPC['award-deg'][$index],
				);
				pdo_update('j_money_award', $data, array('id' => $index));
			}
		}else{
			$insert['status']=1;
			pdo_insert("j_money_lotterygame", $insert);
			$id=pdo_insertid();
			foreach ($_GPC['award-level-new'] as $index => $row) {
				$data = array(
					'gid' => $id,
					'weid' => $_W['uniacid'],
					'level' => $_GPC['award-level-new'][$index],
					'leavel' => intval($_GPC['award-leavel-new'][$index]),
					'thumb' => $_GPC['award-thumb-new'][$index],
					'credit' => intval($_GPC['award-credit-new'][$index]),
					'title' => $_GPC['award-title-new'][$index],
					'description' => $_GPC['award-description-new'][$index],
					'isprize' => intval($_GPC['award-isprize-new'][$index]),
					'total' => $_GPC['award-total-new'][$index],
					'renum' => $_GPC['award-total-new'][$index],
					'probalilty' => $_GPC['award-probalilty-new'][$index],
					'deg' => $_GPC['award-deg-new'][$index],
				);
				pdo_insert('j_money_award', $data);
			}
		}
		message("修改完成", $this->createWebUrl('lottery',array('op'=>'post','id'=>$id)), 'success');
	}
} elseif ($operation == 'delete') {
	//待完善，删除已兑奖和木有使用的人
	$id=intval($_GPC['id']);
	if($id){
		pdo_delete('j_money_award',array('gid'=>$id));
		pdo_delete('j_money_lotterygame',array('id'=>$id));
	}
	message("删除成功", $this->createWebUrl('lottery'), 'success');
}
include $this->template('lottery');
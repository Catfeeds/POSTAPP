<?php 
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if($operation=="display"){
	$list=pdo_fetchall("SELECT * FROM ".tablename('j_money_extend')." WHERE weid='{$_W['uniacid']}' order by id desc ");
	
} elseif ($operation == 'post') {
	$id=$_GPC['id'];
	if($id)$category=pdo_fetch("SELECT * FROM ".tablename('j_money_extend')." WHERE id = :id ",array(':id'=>$id));
	if (checksubmit('submit')){
		$data=array(
			'weid'=>$_W['uniacid'],
			'status'=>intval($_GPC['status']),
			'btnname'=>$_GPC['btnname'],
			'btnurl'=>$_GPC['btnurl'],
			'jsurl'=>$_GPC['jsurl2'],
			'cssurl'=>$_GPC['cssurl2'],
		);
		load()->func('file');
		$dir_url='../attachment/j_money/js/'.$_W['uniacid']."/";
		mkdirs($dir_url);
		if ($_FILES["jsurl"]["name"]){
			if(file_exists($dir_url.$category["jsurl"]))@unlink ($dir_url.$category["jsurl"]);
			$data['jsurl']=TIMESTAMP.".js";
			move_uploaded_file($_FILES["jsurl"]["tmp_name"],$dir_url.$data['jsurl']);
		}
		if ($_FILES["cssurl"]["name"]){
			if(file_exists($dir_url.$category["cssurl"]))@unlink ($dir_url.$category["cssurl"]);
			$data['cssurl']=TIMESTAMP.".css";
			move_uploaded_file($_FILES["cssurl"]["tmp_name"],$dir_url.$data['cssurl']);
		}
		if($id){
			pdo_update("j_money_extend",$data,array("id"=>$id));
		}else{
			pdo_insert("j_money_extend",$data);
			$id=pdo_insertid();
		}
		message("修改完成", $this->createWebUrl('extendbtn',array('op'=>'post','id'=>$id)), 'success');
	}
}elseif ($operation == 'delete') {
	$id=intval($_GPC['id']);
	if($id){
		$category=pdo_fetch("SELECT * FROM ".tablename('j_money_extend')." WHERE id = :id ",array(':id'=>$id));
		load()->func('file');
		$dir_url='../attachment/j_money/js/'.$_W['uniacid']."/";
		if(file_exists($dir_url.$category["jsurl"]))@unlink ($dir_url.$category["jsurl"]);
		pdo_delete('j_money_extend',array('id'=>$id));
	}
	message("删除成功", $this->createWebUrl('extendbtn'), 'success');
}
include $this->template('extendbtn');
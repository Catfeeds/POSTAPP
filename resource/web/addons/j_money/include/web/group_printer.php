<?php 
global $_GPC, $_W;
$weid = $_W['uniacid'];
$shopid = $_GPC['shopid'];
$pid = $_GPC['pid'];
$shopitem = pdo_fetch("SELECT * FROM " . tablename('j_money_group') . " WHERE id = :id ", array(':id' => $shopid));
if ($pid) {
	$printerItem = pdo_fetch("SELECT * FROM " . tablename('j_money_printer') . " WHERE id = :id ", array(':id' => $pid));
}
$domore = !empty($_GPC['domore']) ? $_GPC['domore'] : 'list';

if (checksubmit('submit')) {
	
	$common_data = array(
		'title'			=> trim($_GPC["title"]), // 打印机名称
		'ptype'			=> intval($_GPC["ptype"]), // 打印机类型
		'apiaccount'	=> trim($_GPC["account"]), // Api账号
		'apiukey'		=> trim($_GPC["ukey"]), // ApiUkey
		'printsn'		=> trim($_GPC["printsn"]), // 打印机编号
		'apiskey'		=> trim($_GPC["apiskey"]), // 打印机识别码
		'mobile'		=> trim($_GPC["mobile"]), // 对应gprs手机号
		'remark'		=> trim($_GPC["remark"]), // 备注
		'isdef'			=> intval($_GPC["isdef"]), // 是否默认打印机
	);
	
	if ($domore == 'add') {
		include_once IA_ROOT."/addons/j_money/inc/Feieyun.class.php";
		// do write data
		$data = array(
			'weid'		=> $weid,
			'shopid'	=> $shopid,
			'addtime'	=> time(),
			'printtime'	=> 0,
			'onlinetime'=> 0,
			'unprint'	=> 0,
		);
		$data = array_merge($data, $common_data);
		//注册飞鹅 - 打印机编号(必填) # 打印机识别码(必填) # 备注名称(选填) # 流量卡号码(选填)，多台打印机请换行（\n）添加新打印机信息，每次最多100行(台)。
		$printer_str = sprintf("%s#%s#%s#%s", $data['printsn'], $data['apiskey'], $data['title'], $data['mobile']);
		$feyObj = new Feieyun($data['apiaccount'], $data['apiukey'], $data['printsn']);
		$feyObj->addPrinter($printer_str);
		
		pdo_insert("j_money_printer", $data);
		$pid = pdo_insertid();
		message("打印机添加完成", $this->createWebUrl('group', array('op' => 'printer', 'domore' => 'edit', 'shopid' => $shopid, 'pid' => $pid)), 'success');
		
	} elseif ($domore == 'edit') {
		
		$data = $common_data;
		pdo_update("j_money_printer", $data, array("id" => $pid));
		message("修改完成", $this->createWebUrl('group', array('op' => 'printer', 'domore' => 'edit', 'shopid' => $shopid, 'pid' => $pid)), 'success');
		
	}
	
	message("无权操作！");
	
} elseif ($domore == 'delete') {
	
	pdo_delete('j_money_printer', array('id' => $pid, 'weid' => $weid, 'shopid' => $shopid));
	message("删除完成", $this->createWebUrl('group', array('op' => 'printer', 'shopid' => $shopid)), 'success');
	
} else {
	
	if ($domore == 'list') {
		$list = pdo_fetchall("SELECT * FROM " . tablename('j_money_printer') . " WHERE weid='{$weid}' AND shopid='{$shopid}' order by id desc ");
	}
	
	include $this->template('group_printer');exit;
	
}
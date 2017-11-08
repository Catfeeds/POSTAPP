<?php 
global $_GPC, $_W;
$id = intval($_GPC['id']);
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if (checksubmit('getprize')) {
	pdo_query("update ".tablename('j_money_lottery')." set status=1,gettime='".TIMESTAMP."' where id  IN  ('".implode("','", $_GPC['select'])."')");
	message('标记成功！', $this->createWebUrl('joiner', array('id' => $id,'page' => $_GPC['page'])));
}
if (!empty($_GPC['wid'])) {
	$wid = intval($_GPC['wid']);
	pdo_update('j_money_lottery', array('status'=>intval($_GPC['status']),'gettime' => TIMESTAMP), array('id' => $wid));
	message('标识成功！', $this->createWebUrl('joiner', array('id' => $id,'page' => $_GPC['page'])));
}
if($operation=='display'){
	$pindex = max(1, intval($_GPC['page']));
	$psize = 50;
	$where="";
	if($_GPC['prizeid'])$where .= " and aid = '".$_GPC['prizeid']."' ";
	if($_GPC['sncode'])$where .= " and sncode = '".$_GPC['sncode']."' ";
	$item=pdo_fetch("SELECT * FROM ".tablename('j_money_lotterygame')." WHERE id = '$id' limit 1");
	$prizelist=pdo_fetchall("SELECT * FROM ".tablename('j_money_award')." WHERE gid = '$id' and isprize=1 order by id asc");
	$sql = "SELECT * FROM ".tablename('j_money_lottery')."  WHERE gid = '$id' and weid='{$_W['uniacid']}' and isprize=1 $where order by id desc LIMIT ".($pindex - 1) * $psize.",{$psize}";
	$list = pdo_fetchall($sql);
	if (!empty($list)) {
		$total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('j_money_lottery')." WHERE gid = '$id' and isprize=1 and weid='{$_W['uniacid']}' $where");
		$pager = pagination($total, $pindex, $psize);
	}
	$alljoin=pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('j_money_lottery')."  WHERE gid = '$id' and weid='{$_W['uniacid']}' and aid>0");
}
include $this->template('joiner');
<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');
include IA_ROOT . '/addons/superman_creditmall/install.php';
$module_version = pdo_fetchcolumn("SELECT version FROM " . tablename('modules') . " WHERE name = :name", array(':name' => $_GPC['m']));
if (!pdo_fieldexists('superman_creditmall_product', 'share_credit_type')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product') . " ADD `share_credit_type` VARCHAR(10) NOT NULL DEFAULT '' AFTER `extend`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_product', 'share_credit')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product') . " ADD `share_credit` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `extend`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_order', 'extend')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_order') . " ADD `extend` TEXT NULL AFTER `isread`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_order', 'pay_price')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_order') . " ADD `pay_price` TINYINT NOT NULL DEFAULT '0' AFTER `pay_credit`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_order', 'updatetime')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_order') . " ADD `updatetime` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `extend`";
	pdo_query($sql);
}
if ($module_version < 2.1) {
	$sql = "SELECT * FROM " . tablename('superman_creditmall_order') . " WHERE price>0 AND status>0 AND pay_time>0 AND pay_type>0";
	$list = pdo_fetchall($sql, $params);
	if ($list) {
		foreach ($list as $order) {
			pdo_update('superman_creditmall_order', array('pay_price' => 1), array('id' => $order['id']));
			WeUtility::logging('trace', "update pay_price, id={$order['id']}, ordersn={$order['ordersn']}");
		}
	}
}
if (!pdo_fieldexists('superman_creditmall_product', 'today_limit')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product') . " ADD `today_limit` INT NOT NULL DEFAULT '0' AFTER `max_buy_num`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_product', 'groupid')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product') . " ADD `groupid` INT NOT NULL DEFAULT '0' AFTER `share_credit`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_task', 'showdata')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_task') . " ADD `showdata` TINYINT NOT NULL DEFAULT '0' COMMENT '前台是否显示任务数据,0:否,1:是' AFTER `displayorder`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_mytask', 'extend')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_mytask') . " ADD `extend` TEXT NULL COMMENT '扩展内容' AFTER `progress`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_mytask', 'credit_type')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_mytask') . " ADD `credit_type` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '积分类型' AFTER `status`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_mytask', 'credit')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_mytask') . " ADD `credit` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '积分' AFTER `status`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_product_log', 'millisecond')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product_log') . " ADD `millisecond` INT NOT NULL DEFAULT '0' COMMENT '毫秒数' AFTER `dateline`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_product_log', 'pay_credit')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product_log') . " ADD `pay_credit` TINYINT NOT NULL DEFAULT '0' COMMENT '是否支付积分,0:否,1:是' AFTER `status`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_product_log', 'pay_price')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product_log') . " ADD `pay_price` TINYINT NOT NULL DEFAULT '0' COMMENT '是否支付现金,0:否,1:是' AFTER `status`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_product_log', 'pay_time')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_product_log') . " ADD `pay_time` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '支付时间戳' AFTER `status`";
	pdo_query($sql);
}
if (!pdo_fieldexists('superman_creditmall_checkout_log', 'checkout')) {
	$sql = 'ALTER TABLE ' . tablename('superman_creditmall_checkout_log') . " ADD `checkout` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'type为1是核销员,为2是验证码' AFTER `ordersn`";
	pdo_query($sql);
}
if (version_compare($module_version, '3.0', '<')) {
	superman_drop_column('superman_creditmall_checkout_log', 'checkout_id');
	$list = pdo_fetchall("SELECT * FROM " . tablename('superman_creditmall_task'));
	if ($list) {
		foreach ($list as $task) {
			$sql = "SELECT * FROM " . tablename('mc_credits_record') . " WHERE module=:module AND remark=:remark";
			$params = array(':remark' => "【{$task['title']}】任务奖励", ':module' => 'superman_creditmall',);
			$logs = pdo_fetchall($sql, $params);
			if ($logs) {
				foreach ($logs as $v) {
					$data = array('credit_type' => $v['credittype'], 'credit' => $v['num'],);
					$condition = array('uniacid' => $v['uniacid'], 'uid' => $v['uid'], 'task_id' => $task['id'],);
					pdo_update('superman_creditmall_mytask', $data, $condition);
				}
			}
		}
	}
	$menu_data = array('stat' => array('icon' => 'fa fa-bar-chart-o', 'displayorder' => 1,), 'creditmanage' => array('icon' => 'fa fa-users', 'displayorder' => 2,), 'creditrank' => array('icon' => 'fa fa-sort-amount-desc', 'displayorder' => 3,), 'exchangerank' => array('icon' => 'fa fa-sort-amount-desc', 'displayorder' => 4,), 'checkout' => array('icon' => 'fa fa-check-square-o', 'displayorder' => 5,), 'ad' => array('icon' => 'fa fa-puzzle-piece', 'displayorder' => 6,), 'task' => array('icon' => 'fa fa-tasks', 'displayorder' => 7,), 'dispatch' => array('icon' => 'fa fa-cogs', 'displayorder' => 8,), 'order' => array('icon' => 'fa fa-bars', 'displayorder' => 9,), 'product' => array('icon' => 'fa fa-gift', 'displayorder' => 10,),);
	superman_init_modules_bindings('superman_creditmall', $menu_data);
}
function superman_init_modules_bindings($module, $menu_data)
{
	$list = pdo_fetchall("SELECT * FROM " . tablename('modules_bindings') . " WHERE module=:module AND entry=:entry", array(':module' => $module, ':entry' => 'menu',));
	if ($list) {
		foreach ($list as $item) {
			if (isset($menu_data[$item['do']])) {
				$entry = $menu_data[$item['do']];
				$data = array('icon' => $entry['icon'], 'displayorder' => $entry['displayorder'],);
				$condition = array('eid' => $item['eid'],);
				pdo_update('modules_bindings', $data, $condition);
			}
		}
	}
}

function superman_drop_table($tablename)
{
	$sql = "DROP TABLE IF EXISTS " . tablename($tablename);
	pdo_query($sql);
}

function superman_drop_column($tablename, $field)
{
	if (pdo_fieldexists($tablename, $field)) {
		$sql = 'ALTER TABLE ' . tablename($tablename) . ' DROP COLUMN `' . $field . '`';
		pdo_query($sql);
	}
}

function superman_drop_index($tablename, $index)
{
	if (pdo_indexexists($tablename, $index)) {
		$sql = 'DROP INDEX `' . $index . '` ON ' . tablename($tablename);
		pdo_query($sql);
	}
}

function superman_add_index($tablename, $index, $fields, $index_type = 'INDEX')
{
	if (!pdo_indexexists($tablename, $index)) {
		$sql = 'ALTER TABLE ' . tablename($tablename) . ' ADD ' . $index_type . ' `' . $index . '` (`';
		$sql .= implode('`,`', $fields);
		$sql .= '`)';
		pdo_query($sql);
	}
}
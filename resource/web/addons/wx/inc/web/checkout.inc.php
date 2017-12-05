<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doWebCheckout extends Superman_creditmallModuleSite
{
	public function __construct()
	{
		parent::__construct(true);
	}

	public function exec()
	{
		global $_W, $_GPC;
		$title = '任务中心';
		$act = in_array($_GPC['act'], array('display', 'qrcode', 'oneself')) ? $_GPC['act'] : 'display';
		if ($act == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$pagesize = isset($_GPC['export']) ? -1 : 20;
			$start = ($pindex - 1) * $pagesize;
			$filter = array('uniacid' => $_W['uniacid']);
			$orderby = ' ORDER BY dateline DESC';
			$list = superman_checkout_log_fetchall($filter, $orderby, $start, $pagesize);
			if ($list) {
				foreach ($list as &$li) {
					$li['member'] = mc_fetch($li['uid'], array('avatar', 'nickname'));
					$li['dateline'] = date('Y-m-d H:i:s', $li['dateline']);
					if ($li['type'] == 1) {
						$li['type'] = '扫码核销';
						$li['user'] = mc_fetch($li['checkout'], array('nickname', 'avatar'));
					} else {
						$li['type'] = '自助核销';
						$li['code'] = $li['checkout'];
					}
					unset($li, $checkout);
				}
			}
			$total = superman_checkout_log_count($filter);
			$pager = pagination($total, $pindex, $pagesize);
		} else if ($act == 'qrcode') {
			if ($_GPC['op'] == 'post') {
				if (checksubmit('submit')) {
					$openid = $_GPC['openid'];
					$remark = $_GPC['remark'];
					$filter = array('openid' => $openid);
					$count = superman_checkout_user_count($filter);
					if ($count > 0) {
						message('该用户已添加为核销员，请勿重复添加', referer(), 'info');
					}
					if ($openid) {
						$member = mc_fansinfo($openid);
					}
					if (isset($member['follow']) && $member['follow'] == 1) {
						$data = array('uniacid' => $_W['uniacid'], 'uid' => $member['uid'], 'openid' => $openid, 'remark' => $remark, 'dateline' => TIMESTAMP);
						pdo_insert('superman_creditmall_checkout_user', $data);
						$new_id = pdo_insertid();
						if ($new_id) {
							message('操作成功！', $this->createWebUrl('checkout', array('act' => 'qrcode')), 'success');
						} else {
							message('数据库出错，请稍后重试', referer(), 'error');
						}
					} else {
						message('粉丝编号输入有误，请重新输入', referer(), 'error');
					}
				}
			} else if ($_GPC['op'] == 'delete') {
				$id = intval($_GPC['id']);
				if ($id > 0) {
					$ret = pdo_delete('superman_creditmall_checkout_user', array('id' => $id));
					if ($ret !== false) {
						message('删除成功！', referer(), 'success');
					} else {
						message('删除失败！请返回重试', referer(), 'error');
					}
				} else {
					message('该核销员不存在或已删除');
				}
			} else {
				$pindex = max(1, intval($_GPC['page']));
				$pagesize = isset($_GPC['export']) ? -1 : 20;
				$start = ($pindex - 1) * $pagesize;
				$filter = array('uniacid' => $_W['uniacid']);
				$orderby = ' ORDER BY dateline DESC';
				$list = superman_checkout_user_fetchall($filter, $orderby, $start, $pagesize);
				if ($list) {
					foreach ($list as &$li) {
						$member = mc_fetch($li['uid'], array('nickname', 'avatar'));
						$li['nickname'] = $member['nickname'];
						$li['avatar'] = $member['avatar'];
						unset($li, $member);
					}
				}
				$total = superman_checkout_user_count($filter);
				$pager = pagination($total, $pindex, $pagesize);
			}
		} else if ($act == 'oneself') {
			if ($_GPC['op'] == 'post') {
				$id = intval($_GPC['id']);
				if ($id > 0) {
					$row = superman_checkout_code_fetch($id);
					if (!$row) {
						$id = 0;
					}
				}
				if (checksubmit('submit')) {
					$title = trim($_GPC['title']);
					$code = trim($_GPC['code']);
					$remark = $_GPC['remark'];
					if ($title != '' && $code != '') {
						$data = array('title' => $title, 'code' => $code, 'remark' => $remark,);
						if ($id > 0) {
							$ret = pdo_update('superman_creditmall_checkout_code', $data, array('id' => $id));
						} else {
							$data['uniacid'] = $_W['uniacid'];
							$data['dateline'] = TIMESTAMP;
							pdo_insert('superman_creditmall_checkout_code', $data);
							$new_id = pdo_insertid();
							if ($new_id) {
								$ret = true;
							} else {
								$ret = false;
							}
						}
						if ($ret !== false) {
							message('操作成功！', $this->createWebUrl('checkout', array('act' => 'oneself')), 'success');
						} else {
							message('数据库出错，请稍后重试', referer(), 'error');
						}
					} else {
						message('标题或验证码不能为空或0', referer(), 'error');
					}
				}
			} else if ($_GPC['op'] == 'delete') {
				$id = intval($_GPC['id']);
				if ($id > 0) {
					$ret = pdo_delete('superman_creditmall_checkout_code', array('id' => $id));
					if ($ret !== false) {
						message('删除成功！', referer(), 'success');
					} else {
						message('删除失败！请返回重试', referer(), 'error');
					}
				} else {
					message('该验证码不存在或已删除');
				}
			} else {
				$pindex = max(1, intval($_GPC['page']));
				$pagesize = isset($_GPC['export']) ? -1 : 20;
				$start = ($pindex - 1) * $pagesize;
				$filter = array('uniacid' => $_W['uniacid']);
				$orderby = ' ORDER BY dateline DESC';
				$list = superman_checkout_code_fetchall($filter, $orderby, $start, $pagesize);
				if ($list) {
					foreach ($list as &$li) {
						$li['dateline'] = date('Y-m-d H:i:s', $li['dateline']);
						unset($li);
					}
				}
				$total = superman_checkout_code_count($filter);
				$pager = pagination($total, $pindex, $pagesize);
			}
		}
		include $this->template('web/checkout');
	}
}

$obj = new Superman_creditmall_doWebCheckout;
$obj->exec();
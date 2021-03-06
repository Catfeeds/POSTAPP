<?php
//dezend by http://www.yunlu99.com/ QQ:270656184
defined('IN_IA') || exit('Access Denied');
mload()->model('activity');
global $_W;
global $_GPC;
$ta = (trim($_GPC['ta']) ? trim($_GPC['ta']) : 'index');

if ($ta == 'index') {
	$_W['page']['title'] = '自提优惠';

	if ($_W['ispost']) {
		$starttime = trim($_GPC['starttime']);

		if (empty($starttime)) {
			imessage(error(-1, '活动开始时间不能为空'), '', 'ajax');
		}

		$endtime = trim($_GPC['endtime']);

		if (empty($endtime)) {
			imessage(error(-1, '活动结束时间不能为空'), '', 'ajax');
		}

		$starttime = strtotime($starttime);
		$endtime = strtotime($endtime);

		if ($endtime <= $starttime) {
			imessage(error(-1, '活动开始时间不能大于结束时间'), '', 'ajax');
		}

		$data = array();
		$title = array();

		if (!empty($_GPC['condition'])) {
			foreach ($_GPC['condition'] as $key => $value) {
				$condition = intval($value);
				$back = trim($_GPC['back'][$key]);
				if ($condition && $back) {
					$data[$condition] = array('condition' => $condition, 'back' => $back);
					$title[] = '满' . $condition . '元打' . $back . '折';
				}
			}
		}

		if (empty($data)) {
			imessage(error(-1, '自提优惠不能为空'), '', 'ajax');
		}

		$title = implode(',', $title);
		$activity = array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'title' => $title, 'starttime' => $starttime, 'endtime' => $endtime, 'type' => 'selfDelivery', 'status' => 1, 'data' => iserializer($data));
		$status = activity_set($sid, $activity);

		if (is_error($status)) {
			imessage($status, '', 'ajax');
		}

		imessage(error(0, '设置自提优惠成功'), referer(), 'ajax');
	}

	$activity = activity_get($sid, 'selfDelivery');

	if (!empty($activity)) {
		foreach ($activity['data'] as &$row) {
			if (!is_array($row)) {
				continue;
			}

			$data[] = $row;
		}

		$activity['data'] = $data;
	}

	$count = count($activity['data']);
	$i = 0;

	while ($i < (4 - $count)) {
		$activity['data'][] = array('condition' => '', 'back' => '');
		++$i;
	}
}

if ($ta == 'del') {
	activity_del($sid, 'selfDelivery');
	imessage(error(0, '撤销活动成功'), referer(), 'ajax');
}

include itemplate('store/activity/selfDelivery');

?>

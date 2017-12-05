<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

class Superman_creditmall_doMobileAddress extends Superman_creditmallModuleSite
{
	public function __construct()
	{
		parent::__construct(true);
		$this->checkauth();
	}

	public function exec()
	{
		global $_W, $_GPC, $do;
		$_share = array();
		$title = '积分商城';
		$act = in_array($_GPC['act'], array('display', 'post', 'delete', 'wechat_address')) ? $_GPC['act'] : 'display';
		$uid = $_W['member']['uid'];
		if ($act == 'display') {
			$header_title = '收货地址';
			if ($_GPC['isdefault'] == 1) {
				$id = intval($_GPC['id']);
				$row = superman_mc_address_fetch($id);
				if (!$row) {
					message('地址不存在或已删除！', referer(), 'error');
				}
				$condition = array('uid' => $uid, 'isdefault' => '1',);
				pdo_update('mc_member_address', array('isdefault' => 0), $condition);
				pdo_update('mc_member_address', array('isdefault' => 1), array('id' => $id));
				if (isset($_GPC['forward']) && $_GPC['forward']) {
					message('更新成功！', base64_decode($_GPC['forward']), 'success');
				}
				message('更新成功！', referer(), 'success');
			}
			$list = superman_mc_address_fetchall_uid($uid);
			if ($list) {
				foreach ($list as &$ad) {
					$ad['mobile'] = superman_hide_mobile($ad['mobile']);
					if ($ad['province'] == $ad['city']) {
						$ad['address'] = $ad['city'] . $ad['district'] . $ad['address'];
					} else {
						$ad['address'] = $ad['province'] . $ad['city'] . $ad['district'] . $ad['address'];
					}
				}
				unset($ad);
			}
			$allowShareAddress = Agent::getAgent();
			preg_match('/MicroMessenger\\/([\\d\\.]+)/i', $allowShareAddress, $wechatInfo);
			$wechat_addr_switch = true;
			$setting = uni_setting($_W['uniacid'], array('payment'));
			if (!isset($_GPC['forward']) || $_GPC['forward'] == '' || !$wechatInfo || (isset($wechatInfo[1]) && $wechatInfo[1] < '5.0') || (isset($_GPC['wechat_addr_switch']) && $_GPC['wechat_addr_switch'] == 0) || !isset($setting['payment']) || !$setting['payment']['wechat']['switch'] || $_W['account']['level'] != 4) {
				$wechat_addr_switch = false;
			}
		} else if ($act == 'post') {
			$id = intval($_GPC['id']);
			if ($id > 0) {
				$header_title = '编辑地址';
				$item = superman_mc_address_fetch($id);
				if ($item && $item['uid'] == $uid) {
					if ($item['province'] == $item['city']) {
						$item['city'] = $item['city'] . ' ' . $item['district'];
					} else {
						$item['city'] = $item['province'] . ' ' . $item['city'] . ' ' . $item['district'];
					}
				} else {
					$this->json_output(ERRNO::INVALID_REQUEST);
				}
			} else {
				$header_title = '添加地址';
			}
			if (checksubmit('submit')) {
				$username = trim($_GPC['username']);
				if ($username == '') {
					$this->json_output(ERRNO::USERNAME_NULL);
				}
				$mobile = $_GPC['mobile'];
				if ($mobile == '') {
					$this->json_output(ERRNO::MOBILE_NULL);
				}
				if (!preg_match('/^([0-9]{11})?$/', $mobile)) {
					$this->json_output(ERRNO::MOBILE_INVALID);
				}
				$address = trim($_GPC['address']);
				$data = array('uniacid' => $_W['uniacid'], 'uid' => $uid, 'username' => $username, 'mobile' => $mobile, 'address' => $address, 'isdefault' => $_GPC['isdefault'] == 'on' ? 1 : 0);
				if ($data['isdefault'] == 1) {
					pdo_update('mc_member_address', array('isdefault' => 0), array('uid' => $uid, 'uniacid' => $_W['uniacid'], 'isdefault' => 1));
				}
				$city = trim($_GPC['city']);
				if (!$city) {
					$this->json_output(ERRNO::CITY_NULL);
				}
				$city = explode(' ', $city);
				if (count($city) == 3) {
					$data['province'] = $city[0];
					$data['city'] = $city[1];
					$data['district'] = $city[2];
				} elseif (count($city) == 2) {
					$data['province'] = $city[0];
					$data['city'] = $city[0];
					$data['district'] = $city[1];
				} else {
					$this->json_output(ERRNO::CITY_INVALID);
				}
				if ($id) {
					$ret = pdo_update('mc_member_address', $data, array('id' => $id));
				} else {
					$ret = pdo_insert('mc_member_address', $data);
				}
				if ($ret === false) {
					$this->json_output(ERRNO::SYSTEM_ERROR, '系统错误，请稍后重试');
				}
				if (isset($_GPC['forward']) && $_GPC['forward']) {
					$this->json_output(ERRNO::OK, '更新成功，跳转中...', array('url' => base64_decode($_GPC['forward'])));
				}
				$this->json_output(ERRNO::OK, '更新成功，跳转中...', array('url' => $this->createMobileUrl('address', array('act' => 'display'))));
			}
		} else if ($act == 'delete') {
			if ($uid) {
				$id = intval($_GPC['id']);
				if (!$id) {
					$this->json_output(ERRNO::INVALID_REQUEST);
				}
				$address = superman_mc_address_fetch($id);
				if (!$address || $address['uid'] != $uid) {
					$this->json_output(ERRNO::ADDRESS_NOT_EXIST);
				}
				$ret = pdo_delete('mc_member_address', array('id' => $id));
				if ($ret === false) {
					$this->json_output(ERRNO::SYSTEM_ERROR);
				}
				$this->json_output(ERRNO::OK, '删除成功！');
			}
		} else if ($act == 'wechat_address') {
			if (!isset($_GPC['forward']) || $_GPC['forward'] == '') {
				$this->json_output(ERRNO::INVALID_REQUEST);
			}
			$state = 'superman_creditmall';
			$code = $_GPC['code'];
			$oauth_account = WeAccount::create($_W['oauth_account']);
			if (empty($code)) {
				$callback = urlencode($_W['siteurl']);
				$forward = $oauth_account->getOauthCodeUrl($callback, $state);
				@header('Location:' . $forward);
				exit();
			} else {
				$OauthInfo = $oauth_account->getOauthInfo($code);
				if (!isset($OauthInfo['access_token'])) {
					WeUtility::logging('fatal', 'code未获取到accesstoken，错误原因' . var_export($OauthInfo, true));
					$url = $this->createMobileUrl('address', array('act' => 'display', 'forward' => $_GPC['forward'], 'wechat_addr_switch' => 0));
					$this->json_output(ERRNO::SYSTEM_ERROR, '获取微信地址失败，请添加新地址', array('url' => $url));
				}
				$accessToken = $OauthInfo['access_token'];
				$timeStamp = $_W['timestamp'];
				$timeStamp = "$timeStamp";
				$nonceStr = random(16);
				$String1 = "accesstoken={$accessToken}&appid={$_W['account']['key']}&noncestr={$nonceStr}&timestamp={$timeStamp}&url={$_W['siteurl']}";
				$addrSign = SHA1($String1);
			}
		}
		include $this->template('address');
	}
}

$obj = new Superman_creditmall_doMobileAddress;
$obj->exec();
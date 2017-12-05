<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');
require IA_ROOT . '/addons/superman_creditmall/common.func.php';
require IA_ROOT . '/addons/superman_creditmall/model.func.php';

class Superman_CreditmallModule extends WeModule
{
	private $_data = array();

	public function settingsDisplay($settings)
	{
		global $_W, $_GPC;
		load()->func('tpl');
		load()->func('file');
		if (checksubmit('reset_submit')) {
			$data = superman_setting_data();
			$this->saveSettings($data);
			message('更新成功！', referer(), 'success');
		}
		$credits = superman_credit_type();
		if (!$this->module['config']['_init']) {
			$setting = uni_setting($_W['uniacid'], array('payment'));
			$pay = $setting['payment'];
			$accs = uni_accounts();
			$accounts = array();
			if (!empty($accs)) {
				foreach ($accs as $acc) {
					if ($acc['type'] == '1' && $acc['level'] >= '3') {
						$accounts[$acc['acid']] = array_elements(array('name', 'acid', 'key', 'secret'), $acc);
					}
				}
				if ($pay && isset($pay['wechat']['account'])) {
					$pay['wechat']['account_setting'] = $accounts[$pay['wechat']['account']];
				}
			}
			$this->_data = superman_setting_data();
			$mch_appid = $this->module['config']['wxpay']['mch_appid'];
			$mchid = $this->module['config']['wxpay']['mchid'];

			$sub_appid = $this->module['config']['wxpay']['sub_appid'];
			$sub_mch_id = $this->module['config']['wxpay']['sub_mch_id'];
				
			
			$this->_data['wxpay']['mch_appid'] = $mch_appid ? $mch_appid : $pay && isset($pay['wechat']['account_setting']['key']) ? $pay['wechat']['account_setting']['key'] : '';
			$this->_data['wxpay']['mchid'] = $mchid ? $mchid : $pay && isset($pay['wechat']['mchid']) ? $pay['wechat']['mchid'] : '';
			$this->_data['wxpay']['sub_appid'] = $sub_appid ? $sub_appid : $pay && isset($pay['wechat']['sub_appid']) ? $pay['wechat']['sub_appid'] : '';
			$this->_data['wxpay']['sub_mch_id'] = $sub_mch_id ? $sub_mch_id : $pay && isset($pay['wechat']['sub_mch_id']) ? $pay['wechat']['sub_mch_id'] : '';
				
			
			$this->saveSettings($this->_data);
			load()->model('module');
			$this->module = module_fetch('superman_creditmall');
		} else {
			$this->_data = array('_init' => 1, 'base' => $this->module['config']['base'], 'template_message' => $this->module['config']['template_message'], 'wxpay' => $this->module['config']['wxpay'], 'share' => $this->module['config']['share'], 'redpack' => $this->module['config']['redpack'], 'help' => $this->module['config']['help'], 'service' => $this->module['config']['service'], 'subscribe' => $this->module['config']['subscribe']);
		}
		$update_data = false;
		if ($this->module['config']['template_message']['order_submit_content'] == '') {
			$this->module['config']['template_message']['order_submit_content'] = "first=您的订单已提交成功，请尽快支付！\nkeyword1={订单编号}\nkeyword2={订单时间}\nkeyword3={订单金额}\nremark=若有疑问，请联系客服";
			$update_data = true;
		}
		if ($this->module['config']['template_message']['order_pay_content'] == '') {
			$this->module['config']['template_message']['order_pay_content'] = "first=您的订单已支付成功！\nkeyword1={订单编号}\nkeyword2={订单商品}\nkeyword3={订单金额}\nremark=点击查看订单详情";
			$update_data = true;
		}
		if ($this->module['config']['template_message']['auction_success_content'] == '') {
			$this->module['config']['template_message']['auction_success_content'] = "first=恭喜，您已竞拍成功！\nkeyword1={商品标题}\nkeyword2={商品价格}\nremark=请尽快领取，点击查看详情";
			$update_data = true;
		}
		if ($update_data) {
			$this->saveSettings($this->module['config']);
		}
		if (checksubmit('submit')) {
			$this->_setting_base();
			$this->_setting_template_message();
			$this->_setting_wxpay();
			$this->_setting_help();
			$this->_setting_redpack();
			$this->_setting_share();
			$this->_setting_service();
			$this->_setting_subscribe();
			$this->_newsset();
			$this->saveSettings($this->_data);
			message('更新成功！', referer(), 'success');
		}
            $salers = array();
			if (isset($this->module['config']['base']["openid"])) {
				if (!empty($this->module['config']['base']["openid"])) {
					$openids     = array();
					$strsopenids = explode(",", $this->module['config']['base']["openid"]);
					foreach ($strsopenids as $openid) {
						$openids[] = "'" . $openid . "'";
					}
					$salers = pdo_fetchall("select m.uid,m.avatar,m.nickname,f.openid from " . tablename('mc_mapping_fans') .  'f left join  ' . tablename('mc_members') . ' m on f.uid=m.uid  where f.openid in (' . implode(",", $openids) . ") and m.uniacid={$_W['uniacid']}");
				}
			}
			
			foreach($salers as &$item){
				if(substr($item["avatar"],0,7)!="http://"){
				   $item["avatar"]=$_W["attachurl"].$item["avatar"];
				}
			}
			
			/*处理积分消息接收人*/
			$salersList = array();
			$openid2=$this->module['config']['newset']["openid2"];
			
			if (!empty($openid2)) {
				$openids2     = array();
				$strsopenids2 = explode(",",$openid2);
				foreach ($strsopenids2 as $openid) {
					$openids2[] = "'" . $openid . "'";
				}
				$salersList = pdo_fetchall("select m.uid,m.avatar,m.nickname,f.openid from " . tablename('mc_mapping_fans') .  'f left join  ' . tablename('mc_members') . ' m on f.uid=m.uid  where f.openid in (' . implode(",", $openids2) . ") and m.uniacid={$_W['uniacid']}");
			}
		
			foreach($salersList as &$ListSa){
				if(substr($ListSa["avatar"],0,7)!="http://"){
					$ListSa["avatar"]=$_W["attachurl"].$ListSa["avatar"];
				}
			}
			unset($ListSa);

			
		include $this->template('web/setting');
	}

	private function _setting_base()
	{
		global $_W, $_GPC;
		$this->_data['base'] = $_GPC['base'];
		if ($_GPC['base']['debug_uids']) {
			$this->_data['base']['debug_uids'] = explode(',', trim($_GPC['base']['debug_uids']));
		}
		$this->_data['base']["openid"]=implode(",",$_GPC["openids"]);
		
		
	}

	private function _setting_template_message()
	{
		global $_W, $_GPC;
		$this->_data['template_message'] = $_GPC['template_message'];
	}
	
	private function _newsset()
	{
		global $_W,$_GPC;
		$this->_data["newset"]=$_GPC["newset"];
		/*积分配置后台接收人*/
		$this->_data['newset']["openid2"]=implode(",",$_GPC["openids2"]);
	}

	private function _setting_wxpay()
	{
		global $_W, $_GPC;
		$wxpay = $_GPC['wxpay'];
		$attach_path = superman_attachment_root();
		$apiclient_cert_path = $attach_path . $this->module['config']['wxpay']['apiclient_cert'];
		$apiclient_key_path = $attach_path . $this->module['config']['wxpay']['apiclient_key'];
		$rootca_path = $attach_path . $this->module['config']['wxpay']['rootca'];
		if ($wxpay['del_apiclient_cert']) {
			if (file_exists($apiclient_cert_path)) {
				@unlink($apiclient_cert_path);
			}
			$this->module['config']['wxpay']['apiclient_cert'] = '';
		}
		if ($wxpay['del_apiclient_key']) {
			if (file_exists($apiclient_key_path)) {
				@unlink($apiclient_key_path);
			}
			$this->module['config']['wxpay']['apiclient_key'] = '';
		}
		if ($wxpay['del_rootca']) {
			if (file_exists($rootca_path)) {
				@unlink($rootca_path);
			}
			$this->module['config']['wxpay']['rootca'] = '';
		}
		$_W['setting']['upload']['image']['limit'] = 1000;
		$_W['setting']['upload']['image']['extentions'][] = 'pem';
		if (!empty($_FILES['wxpay']['tmp_name']['apiclient_cert'])) {
			$file = array('name' => $_FILES['wxpay']['name']['apiclient_cert'], 'tmp_name' => $_FILES['wxpay']['tmp_name']['apiclient_cert'], 'type' => $_FILES['wxpay']['type']['apiclient_cert'], 'error' => $_FILES['wxpay']['error']['apiclient_cert'], 'size' => $_FILES['wxpay']['size']['apiclient_cert']);
			$upload = file_upload($file, 'image');
			if (!$upload['success']) {
				message($upload['errno'] . ':' . $upload['message']);
			}
			if (file_exists($apiclient_cert_path)) {
				@unlink($apiclient_cert_path);
			}
			$wxpay['apiclient_cert'] = $upload['path'];
		} else {
			$wxpay['apiclient_cert'] = $this->module['config']['wxpay']['apiclient_cert'];
		}
		if (!empty($_FILES['wxpay']['tmp_name']['apiclient_key'])) {
			$file = array('name' => $_FILES['wxpay']['name']['apiclient_key'], 'tmp_name' => $_FILES['wxpay']['tmp_name']['apiclient_key'], 'type' => $_FILES['wxpay']['type']['apiclient_key'], 'error' => $_FILES['wxpay']['error']['apiclient_key'], 'size' => $_FILES['wxpay']['size']['apiclient_key']);
			$upload = file_upload($file, 'image');
			if (!$upload['success']) {
				message($upload['errno'] . ':' . $upload['message']);
			}
			if (file_exists($apiclient_key_path)) {
				@unlink($apiclient_key_path);
			}
			$wxpay['apiclient_key'] = $upload['path'];
		} else {
			$wxpay['apiclient_key'] = $this->module['config']['wxpay']['apiclient_key'];
		}
		if (!empty($_FILES['wxpay']['tmp_name']['rootca'])) {
			$file = array('name' => $_FILES['wxpay']['name']['rootca'], 'tmp_name' => $_FILES['wxpay']['tmp_name']['rootca'], 'type' => $_FILES['wxpay']['type']['rootca'], 'error' => $_FILES['wxpay']['error']['rootca'], 'size' => $_FILES['wxpay']['size']['rootca']);
			$upload = file_upload($file, 'image');
			if (!$upload['success']) {
				message($upload['errno'] . ':' . $upload['message']);
			}
			if (file_exists($rootca_path)) {
				@unlink($rootca_path);
			}
			$wxpay['rootca'] = $upload['path'];
		} else {
			$wxpay['rootca'] = $this->module['config']['wxpay']['rootca'];
		}
		$this->_data['wxpay'] = $wxpay;
	}

	private function _setting_redpack()
	{
		global $_W, $_GPC;
		$this->_data['redpack'] = $_GPC['redpack'];
	}

	private function _setting_help()
	{
		global $_W, $_GPC;
		$this->_data['help'] = $_GPC['help'];
	}

	private function _setting_share()
	{
		global $_W, $_GPC;
		$this->_data['share'] = $_GPC['share'];
	}

	private function _setting_service()
	{
		global $_W, $_GPC;
		$this->_data['service'] = $_GPC['service'];
	}

	private function _setting_subscribe()
	{
		global $_W, $_GPC;
		$this->_data['subscribe'] = $_GPC['subscribe'];
	}
}
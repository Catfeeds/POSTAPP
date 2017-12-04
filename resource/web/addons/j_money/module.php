<?php

//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or die('Access Denied');
class J_moneyModule extends WeModule
{
	public function fieldsFormDisplay($rid = 0)
	{
		global $_W;
		if (!empty($rid)) {
			$reply = pdo_fetch("SELECT * FROM " . tablename("j_money_reply") . " WHERE rid = :rid limit 1", array(':rid' => $rid));
		}
		if (!pdo_fieldexists('mc_groups', 'orderlist')) {
			pdo_query("ALTER TABLE " . tablename('mc_groups') . " ADD `orderlist` int(10) DEFAULT '0' NOT NULL;");
		}
		$list = pdo_fetchall("SELECT * FROM " . tablename("j_money_marketing") . " WHERE weid=:a and `condition` in(3,4,5) order by displayorder asc,id asc ", array(':a' => $_W['uniacid']));
		load()->func('tpl');
		include $this->template('form');
	}
	public function fieldsFormValidate($rid = 0)
	{
		return '';
	}
	public function fieldsFormSubmit($rid)
	{
		global $_W, $_GPC;
		$reply_id = $_GPC["reply_id"];
		$insert = array('weid' => $_W['uniacid'], 'gameid' => $_GPC['gameid'], 'status' => $_GPC['status'], 'title' => $_GPC['title']);
		if (!$_GPC['gameid']) {
			message("请选择营销活动");
		}
		if (empty($reply_id)) {
			$insert['rid'] = $rid;
			$insert['status'] = 1;
			pdo_insert("j_money_reply", $insert);
		} else {
			pdo_update("j_money_reply", $insert, array('rid' => $rid));
		}
	}
	public function ruleDeleted($rid)
	{
		pdo_delete("j_money_reply", array('id' => $rid));
	}
	
	
	public function settingsDisplay($settings)
	{
		global $_W, $_GPC;
		if (!pdo_fieldexists('mc_groups', 'orderlist')) {
			pdo_query("ALTER TABLE " . tablename('mc_groups') . " ADD `orderlist` int(10) DEFAULT '0' NOT NULL;");
		}
		$blist = pdo_fetchall("SELECT id,companyname FROM " . tablename("j_money_group") . " WHERE weid=:a order by id asc ", array(':a' => $_W['uniacid']));
		if (checksubmit()) {
		    
			$wxcard = array();
			if (isset($_GPC['wxcard-key'])) {
				foreach ($_GPC['wxcard-key'] as $index => $row) {
					if (empty($row)) {
						continue;
					}
					$wxcard[$row] = $_GPC['wxcard-val'][$index];
				}
			}
			if (isset($_GPC['wxcard-key-new'])) {
				foreach ($_GPC['wxcard-key-new'] as $index => $row) {
					if (empty($row)) {
						continue;
					}
					$wxcard[$row] = $_GPC['wxcard-val-new'][$index];
				}
			}
			$parama = array();
			if (isset($_GPC['parama-key'])) {
				foreach ($_GPC['parama-key'] as $index => $row) {
					if (empty($row)) {
						continue;
					}
					$parama[$row]['value'] = urlencode($_GPC['parama-val'][$index]);
					$parama[$row]['color'] = $_GPC['parama-color'][$index];
				}
			}
			$moduleshop = array();
			$tempary = $_GPC['module_b'];
			foreach ($tempary as $index => $row) {
				$moduleshop['weisrc_dish'][$index] = $_GPC['module_b'][$index];
			}
			$settings["cookiehold"]=$_GPC["cookiehold"];
			$cfg = array('debug' => trim($_GPC['debug']), 'copyright' => trim($_GPC['copyright']), 'appid' => trim($_GPC['appid']),'sys_service_provider_id' => trim($_GPC['sys_service_provider_id']),'app_auth_token' => trim($_GPC['app_auth_token']), 'sub_appid' => trim($_GPC['sub_appid']), 'sub_mch_id' => trim($_GPC['sub_mch_id']), 'cookiehold' => intval($settings["cookiehold"]) ? intval($settings["cookiehold"]) : 8, 'logo' => trim($_GPC['logo']), 'printpagewidth' => trim($_GPC['printpagewidth']), 'appsecret' => trim($_GPC['appsecret']), 'pay_name' => $_GPC['pay_name'], 'pay_mchid' => $_GPC['pay_mchid'], 'pay_signkey' => $_GPC['pay_signkey'], 'pay_ip' => $_GPC['pay_ip'], 'notify_url' => $_GPC['notify_url'], 'openidcheck' => intval($_GPC['openidcheck']), 'wxcard' => json_encode($wxcard), 'bg' => $_GPC['bg'], 'login_pc_type' => intval($_GPC['login_pc_type']), 'login_m_type' => intval($_GPC['login_m_type']), 'app_id' => trim($_GPC['app_id']), 'charset' => "GBK", 'gatewayUrl' => trim($_GPC['gatewayUrl']) ? trim($_GPC['gatewayUrl']) : "https://openapi.alipay.com/gateway.do", 'alipay_key' => trim($_GPC['alipay_key']), 'alipay_cert' => trim($_GPC['alipay_cert']), 'appauthtoken' => trim($_GPC['appauthtoken']), 'tempid' => trim($_GPC['tempid']), 'tempcontent' => htmlspecialchars_decode($_GPC['tempcontent']), 'tempurl' => trim($_GPC['tempurl']), 'tempparama' => urldecode(json_encode($parama)), 'groupnum' => intval($_GPC['groupnum']), 'usernum' => intval($_GPC['usernum']), 'qrcode' => strval($_GPC['qrcode']), 'creadit' => floatval($_GPC['creadit']), 'creadittype' => strval($_GPC['creadittype']), 'creditbtn' => strval($_GPC['creditbtn']), 'tempid2' => trim($_GPC['tempid2']), 'refunder' => trim($_GPC['refunder']), 'encryptcode' => trim($_GPC['encryptcode']) ? trim($_GPC['encryptcode']) : "jetsum_money", 'creadit_uniacid' => intval($_GPC['creadit_uniacid']), 'wxcardid' => trim($_GPC['wxcardid']), 'paycodetempmsg' => trim($_GPC['paycodetempmsg']), 'moduleshop' => json_encode($moduleshop), 'card_pay_switch' => trim($_GPC['card_pay_switch']), 'pos_member_switch' => trim($_GPC['pos_member_switch']));
			// var_dump($_GPC['card_pay_switch']);die;
			$cfg["refunderlongtime"]=$_GPC["refunderlongtime"];
			
				/*会员接口名称*/
			$cfg["memberApi"]=$_GPC["memberApi"];
			
			
			load()->func('file');
			$dir_url = '../attachment/j_money/cert_2/' . $_W['uniacid'] . "/";
			mkdirs($dir_url);
			$cfg['apiclient_cert'] = $_GPC['apiclient_cert2'];
			$cfg['apiclient_key'] = $_GPC['apiclient_key2'];
			if ($_FILES["apiclient_cert"]["name"]) {
				if (file_exists($dir_url . $settings["apiclient_cert"])) {
					@unlink($dir_url . $settings["apiclient_cert"]);
				}
				$cfg['apiclient_cert'] = "cert" . TIMESTAMP . ".pem";
				move_uploaded_file($_FILES["apiclient_cert"]["tmp_name"], $dir_url . $cfg['apiclient_cert']);
			}
			if ($_FILES["apiclient_key"]["name"]) {
				if (file_exists($dir_url . $settings["apiclient_key"])) {
					@unlink($dir_url . $settings["apiclient_key"]);
				}
				$cfg['apiclient_key'] = "key" . TIMESTAMP . ".pem";
				move_uploaded_file($_FILES["apiclient_key"]["tmp_name"], $dir_url . $cfg['apiclient_key']);
			}
			$cfg['soft_update'] = $_GPC['soft_update2'];
			$cfg['print_update'] = $_GPC['print_update2'];
			if ($_FILES["soft_update"]["name"]) {
				if (file_exists($dir_url . $settings["soft_update"])) {
					@unlink($dir_url . $settings["soft_update"]);
				}
				$cfg['soft_update'] = "soft" . TIMESTAMP . ".zip";
				move_uploaded_file($_FILES["soft_update"]["tmp_name"], $dir_url . $cfg['soft_update']);
			}
			if ($_FILES["print_update"]["name"]) {
				if (file_exists($dir_url . $settings["print_update"])) {
					@unlink($dir_url . $settings["print_update"]);
				}
				$cfg['print_update'] = "print" . TIMESTAMP . ".zip";
				move_uploaded_file($_FILES["print_update"]["tmp_name"], $dir_url . $cfg['print_update']);
			}
			if ($this->saveSettings($cfg)) {
				message('保存成功', 'refresh');
			}
		}
		$version = pdo_fetchcolumn("SELECT version FROM " . tablename("modules") . " WHERE `name` ='j_money' limit 1");
		load()->func('tpl');
		include $this->template('setting');
	}
}
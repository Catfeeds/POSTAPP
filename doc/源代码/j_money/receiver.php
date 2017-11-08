<?php

//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or die('Access Denied');
class J_moneyModuleReceiver extends WeModuleReceiver
{
	public function receive()
	{
		global $_W;
		$openid = $this->message['from'];
		$card_id = $this->message['cardid'];
		$code = $this->message['usercardcode'];
		$eventType = $this->message['msgtype'];
		$event = $this->message['event'];
		if ($event == 'subscribe') {
			$trade = pdo_fetch("SELECT * FROM " . tablename("j_money_trade") . " WHERE weid =:a and openid=:b and createtime>='" . (TIMESTAMP - 86400 * 3) . "' and getmarketing=0 and status=1 order by id desc limit 1", array(":a" => $_W['uniacid'], ":b" => $openid));
			if ($trade && $trade['paytype'] == 0 && $trade['marketing']) {
				$marketlist = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and id=:a and status=1 and favorabletype>1 ", array(":a" => $trade['marketing']));
				if ($marketlist) {
					$favorable = $marketlist['favorable'];
					switch ($marketlist['favorabletype']) {
						case 3:
							if (strpos($favorable, "|#卡券#|")) {
								$temp = str_replace("[|#卡券#|", "", $favorable);
								$temp = str_replace("]", "", $temp);
								$favorAry = strpos($temp, ",") ? explode(",", $temp) : array($temp);
								shuffle($favorAry);
								$cardkey = $favorAry[0];
								$wxcard = json_decode($cfg['wxcard'], true);
								if ($wxcard[$cardkey]) {
									$markid = $row['id'];
									$result = $this->sendCard($openid, $wxcard[$cardkey]);
									if ($result['errcode'] == 0) {
										pdo_update("j_money_trade", array("getmarketing" => 1), array("id" => $trade['id']));
									}
								}
							}
							break;
						case 4:
							$gamestatus = pdo_fetchcolumn("SELECT status FROM " . tablename('j_money_lotterygame') . " WHERE id=:a ", array(":a" => $marketlist['gid']));
							if ($gamestatus == 1) {
								$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&id=" . $marking['gid'] . "&do=game&m=j_money";
								$txt = '您获得抽奖机会哦\n<a href="' . $url . '>马上去抽奖</a>';
								$this->sendText($openid, $txt);
							}
							break;
					}
				}
			}
			load()->model('mc');
			$uid = mc_openid2uid($openid);
			if (!$uid) {
				return;
			}
			$list = pdo_fetchall("SELECT sum(total_fee) as tfee,groupid FROM " . tablename("j_money_trade") . " WHERE weid =:a and openid=:b and createtime>='" . (TIMESTAMP - 86400 * 15) . "' and status=1 and credit=0 group by groupid ", array(":a" => $_W['uniacid'], ":b" => $openid));
			if ($list) {
				$grouplist = pdo_fetchall("SELECT id,creadit FROM " . tablename("j_money_group") . " WHERE weid = '" . $_W['uniacid'] . "' ORDER BY id asc");
				$groupary = array();
				foreach ($grouplist as $row) {
					$groupary[$row['id']] = $row['creadit'];
				}
				$allcreadit = 0;
				$groupary2 = array();
				foreach ($list as $row) {
					$allcreadit += $row['tfee'] * $groupary[$row['groupid']];
					$groupary2[] = $row['groupid'];
				}
				if (count($groupary2)) {
					pdo_run("update " . tablename("j_money_trade") . " set `credit`=`cash_fee`*" . $groupary[0] . " where groupid in (" . implode(",", $groupary2) . ") and openid='" . $openid . "' and credit=0 and status=1");
				}
				mc_credit_update($uid, "credit1", $allcreadit, array("", "收银台累计消费获得积分"));
			}
			return;
		}
		if (!$card_id) {
			return;
		}
		$cfg = $this->module['config'];
		$shopid = 0;
		$wxcardid = pdo_fetchcolumn("SELECT count(*) FROM " . tablename("j_money_group") . " WHERE wxcardid =:a", array(":a" => $card_id));
		if (!$wxcardid) {
			if (!$cfg['wxcardid'] || $cfg['wxcardid'] != $card_id) {
				return;
			}
		} else {
			$shop = pdo_fetch("SELECT * FROM " . tablename("j_money_group") . " WHERE wxcardid=:a order by id asc limit 1", array(":a" => $card_id));
			if (!$shop) {
				return;
			}
			$shopid = $shop['id'];
		}
		if ($event == 'user_get_card') {
			load()->model('mc');
			$uid = mc_openid2uid($openid);
			if ($uid) {
				pdo_update("mc_members", array("msn" => $code), array("uid" => $uid));
			}
			$memberCard = pdo_fetch("SELECT * FROM " . tablename("j_money_memebercard") . " WHERE openid=:a", array(":a" => $openid));
			if ($memberCard) {
				if (!$memberCard['wxcardno']) {
					pdo_update("j_money_memebercard", array("wxcardno" => $code), array("id" => $memberCard['id']));
				}
			} else {
				$data = array("weid" => $_W['uniacid'], "groupid" => intval($shopid), "openid" => $openid, "wxcardno" => $code, "status" => 1, "createtime" => TIMESTAMP);
				pdo_insert("j_money_memebercard", $data);
			}
			return;
		} elseif ($event == 'submit_membercard_user_info') {
			$memberCard = pdo_fetch("SELECT * FROM " . tablename("j_money_memebercard") . " WHERE openid=:a", array(":a" => $openid));
			if (!$memberCard) {
				return;
			}
			load()->func('communication');
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$tokens = $acc->fetch_token();
			$pageparama = json_encode(array("card_id" => $card_id, "code" => $code));
			$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/userinfo/get?access_token=" . $tokens, $pageparama, $xml);
			$result = @json_decode($resp['content'], true);
			if ($result['errcode']) {
				return;
			}
			$info = $result['user_info']['common_field_list'];
			$data = array();
			foreach ($info as $index => $row) {
				if ($row['name'] == 'USER_FORM_INFO_FLAG_MOBILE') {
					$data['mobile'] = $row['value'];
				} elseif ($row['name'] == 'USER_FORM_INFO_FLAG_NAME') {
					$data['realname'] = $row['value'];
				}
			}
			if (count($data)) {
				pdo_update("j_money_memebercard", $data, array("id" => $memberCard['id']));
			}
			return;
		} elseif ($event == 'update_member_card') {
			return;
		} elseif ($event == 'user_view_card') {
			viewcard:
			$credit = 0;
			$menberGid = 0;
			$memberCard = pdo_fetch("SELECT * FROM " . tablename("j_money_memebercard") . " WHERE openid=:a", array(":a" => $openid));
			if ($memberCard) {
				load()->model('mc');
				$uid = mc_openid2uid($openid);
				if ($uid) {
					$flag = mc_credit_update($uid, "credit1", $memberCard['creadit'], array("", "收银台消费积分转移"));
					if ($flag) {
						pdo_update("j_money_memebercard", array("creadit" => 0), array("id" => $memberCard['id']));
					}
					$creditAry = mc_credit_fetch($uid, array('credit1'));
					$credit = $creditAry['credit1'];
					$user = mc_fetch($uid);
					$menberGid = $user['groupid'];
					if ($memberCard['gid'] != $user['groupid']) {
						pdo_update("j_money_memebercard", array("gid" => $user['groupid']), array("id" => $memberCard['id']));
					}
				} else {
					$credit = $memberCard['creadit'];
				}
				if (!$memberCard['headimgurl']) {
					$userInfo = $this->getUserInfo($openid);
					if ($userInfo['subscribe']) {
						$data = array("headimgurl" => $userInfo['headimgurl']);
						pdo_update("j_money_memebercard", $data, array("openid" => $openid));
					}
				}
				if (!$memberCard['realname']) {
					$usercard = $this->getCardInfo($card_id, $code);
					$info = $usercard['user_info']['common_field_list'];
					$data = array();
					foreach ($info as $index => $row) {
						if ($row['name'] == 'USER_FORM_INFO_FLAG_MOBILE') {
							$data['mobile'] = $row['value'];
						} elseif ($row['name'] == 'USER_FORM_INFO_FLAG_NAME') {
							$data['realname'] = $row['value'];
						}
					}
					if (count($data)) {
						pdo_update("j_money_memebercard", $data, array("openid" => $openid));
					}
				}
			} else {
				$data = array("weid" => $_W['uniacid'], "groupid" => "0", "openid" => $openid, "status" => 1, "wxcardno" => $code, "createtime" => TIMESTAMP);
				$userInfo = $this->getUserInfo($openid);
				if ($userInfo['subscribe']) {
					$data["headimgurl"] = $userInfo['headimgurl'];
				}
				$usercard = $this->getCardInfo($card_id, $code);
				$info = $usercard['user_info']['common_field_list'];
				foreach ($info as $index => $row) {
					if ($row['name'] == 'USER_FORM_INFO_FLAG_MOBILE') {
						$data['mobile'] = $row['value'];
					} elseif ($row['name'] == 'USER_FORM_INFO_FLAG_NAME') {
						$data['realname'] = $row['value'];
					}
				}
				pdo_insert("j_money_memebercard", $data);
				goto viewcard;
			}
			if (intval($credit) || $memberCard['cash']) {
				$where = " and isdefault=1 ";
				if ($menberGid != 0) {
					$where = " and groupid = " . $menberGid . "";
				}
				$groupname = pdo_fetchcolumn("SELECT title FROM " . tablename("mc_groups") . " WHERE uniacid='" . $_W['uniacid'] . "' {$where} ");
				load()->func('communication');
				$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
				$acc = WeAccount::create($acid);
				$tokens = $acc->fetch_token();
				$data = array("card_id" => $card_id, "code" => $code, "bonus" => intval($credit), "balance" => $memberCard['cash'], "custom_field_value1" => urlencode($groupname));
				$pageparama = urldecode(json_encode($data));
				$resp = ihttp_request("https://api.weixin.qq.com/card/membercard/updateuser?access_token=" . $tokens, $pageparama, $xml);
				$result = @json_decode($resp['content'], true);
				if ($result['errcode']) {
					return;
				}
			}
			return;
		}
		return;
	}
	private function sendText($openid, $txt)
	{
		global $_W;
		$acid = $_W['account']['acid'];
		if (!$acid) {
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		}
		$acc = WeAccount::create($acid);
		$data = $acc->sendCustomNotice(array('touser' => $openid, 'msgtype' => 'text', 'text' => array('content' => urlencode($txt))));
		return $data;
	}
	private function getUserInfo($openid)
	{
		global $_W;
		$acid = $_W['account']['acid'];
		if (!$acid) {
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		}
		$acc = WeAccount::create($acid);
		$tokens = $acc->fetch_token();
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $tokens . "&openid=" . $openid . "&lang=zh_CN ";
		$content = ihttp_get($url);
		if (is_error($content)) {
			return false;
		}
		$result = @json_decode($content['content'], true);
		return $result;
	}
	private function getCardInfo($cardid, $code)
	{
		global $_W;
		$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		$acc = WeAccount::create($acid);
		$tokens = $acc->fetch_token();
		$url = "https://api.weixin.qq.com/card/membercard/userinfo/get?access_token=" . $tokens;
		$data = array("card_id" => $cardid, "code" => $code);
		$content = ihttp_post($url, json_encode($data));
		if (is_error($content)) {
			return false;
		}
		$result = @json_decode($content['content'], true);
		return $result;
	}
	public function sendCard($openid, $cardid)
	{
		global $_W;
		if (strlen($cardid) < 5) {
			return false;
		}
		$acid = $_W['account']['acid'];
		if (!$acid) {
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		}
		$acc = WeAccount::create($acid);
		$ticket = $this->getCard();
		$pars['nonce_str'] = random(32);
		$pars['code'] = "";
		$pars['openid'] = $openid;
		$pars['timestamp'] = TIMESTAMP;
		$pars['signature'] = "";
		$string1 = $pars['timestamp'] . $pars['nonce_str'] . $pars['code'] . $ticket . $cardid;
		$pars['signature'] = sha1($string1);
		$sendata = array("card_id" => $cardid, "card_ext" => array("code" => $pars['code'], "openid" => $pars['openid'], "timestamp" => $pars['timestamp'], "signature" => $pars['signature']));
		$data = $acc->sendCustomNotice(array('touser' => $openid, 'msgtype' => 'wxcard', 'wxcard' => $sendata));
		return $data;
	}
	public function getCard()
	{
		global $_W;
		load()->func('cache');
		$wxcard = cache_load("wxcard");
		if (!$wxcard || $wxcard['extime'] < TIMESTAMP) {
			load()->func('communication');
			$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
			$acc = WeAccount::create($acid);
			$tokens = $acc->fetch_token();
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $tokens . "&type=wx_card";
			$content = ihttp_get($url);
			if (is_error($content)) {
				return false;
			}
			$token = @json_decode($content['content'], true);
			if (empty($token) || !is_array($token)) {
				$errorinfo = substr($content['meta'], strpos($content['meta'], '{'));
				$errorinfo = @json_decode($errorinfo, true);
				return false;
			}
			$record = array();
			$record['ticket'] = $token['ticket'];
			$record['expire'] = TIMESTAMP + $token['expires_in'];
			cache_write("wxcard", array("ticket" => $record['ticket'], "expire" => $record['expire']));
			return $record['ticket'];
		}
		return $wxcard['ticket'];
	}
}
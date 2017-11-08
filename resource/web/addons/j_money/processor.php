<?php

//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or die('Access Denied');
class J_moneyModuleProcessor extends WeModuleProcessor
{
	public function respond()
	{
		global $_W;
		$openid = $this->message['from'];
		$rid = $this->rule;
		$event = $this->message['event'];
		$cfg = $this->module['config'];
		if ($event == "subscribe") {
			$rewardList = pdo_fetchall("SELECT * FROM " . tablename('j_money_reward') . " WHERE weid='{$_W['uniacid']}' and openid=:a and " . TIMESTAMP . "-createtime < 60*60*24*3 and status=0 ", array(":a" => $openid));
			if ($rewardList) {
				foreach ($rewardList as $row) {
					switch ($row['favorabletype']) {
						case 3:
							$result = $this->sendCard($openid, $row["reward"]);
							if ($result['errcode'] == 0) {
								pdo_update("j_money_reward", array("status" => 1, "completed" => 1, "gettype" => 0, "endtime" => TIMESTAMP), array("id" => $row['id']));
							}
					}
					$trade = pdo_fetch("SELECT * FROM " . tablename('j_money_trade') . " WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ", array(":a" => $row['out_trade_no']));
					$tempstr = "";
					$temstr1 = urldecode($cfg['tempparama']);
					$tempstr = str_replace("|#单号#|", $trade['out_trade_no'], $temstr1);
					$tempstr = str_replace("|#时间#|", date("y-m-d H:i", $trade['time_end']), $tempstr);
					$tempstr = str_replace("|#总金额#|", "￥" . sprintf('%.2f', $trade['total_fee'] / 100) . "元", $tempstr);
					$tempstr = str_replace("|#优惠金额#|", "￥" . sprintf('%.2f', $trade['coupon_fee'] / 100) . "元", $tempstr);
					$tempstr = str_replace("|#实付金额#|", "￥" . sprintf('%.2f', $trade['cash_fee'] / 100) . "元", $tempstr);
					$tempstr = str_replace("|#支付方式#|", $trade['paytype'] ? "支付宝支付" : "微信支付", $tempstr);
					$tempstr = str_replace("|#优惠#|", '', $tempstr);
					$itemary = json_decode($tempstr, true);
					$temp = array();
					foreach ($itemary as $key => $val) {
						$temp[$key] = array("value" => $val['value'], "color" => $val['color'] ? $val['color'] : "#333333");
					}
					$url = $cfg["tempurl"];
					$gametimes = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_lottery') . " WHERE from_user=:a ", array(":a" => $openid));
					if ($gametimes) {
						$gametimes = pdo_fetchcolumn("SELECT gid FROM " . tablename('j_money_lottery') . " WHERE from_user=:a and status=0 order by id desc limit 1", array(":a" => $openid));
						$gamestatus = pdo_fetchcolumn("SELECT status FROM " . tablename('j_money_lotterygame') . " WHERE id=:a ", array(":a" => $gametimes));
						if ($gamestatus == 1) {
							$temp['remark']["value"] = "您获得抽奖机会哦，请点击本详情进入抽奖";
							$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&id=" . $marking['gid'] . "&do=game&m=j_money";
						}
					}
					$acc = WeAccount::create($acid);
					$data = $acc->sendTplNotice($openid, $cfg["tempid"], $temp, $url, "#FF0000");
					$result = json_decode($data, true);
					if ($result['errcode'] != 0) {
						pdo_update("j_money_trade", array("log" => $data), array("out_trade_no" => $orderid));
					}
				}
			}
			$reStr = "";
			$reply = pdo_fetch("SELECT * FROM " . tablename('j_money_reply') . " WHERE weid='{$_W['uniacid']}' and rid=:a", array(":a" => $rid));
			if (!$reply || !$reply['status']) {
				return $this->respText("活动不存在或已结束");
			}
			$marketing = pdo_fetch("SELECT * FROM " . tablename('j_money_marketing') . " WHERE weid='{$_W['uniacid']}' and id=:a", array(":a" => $reply['gameid']));
			if (!$marketing || !$marketing['status']) {
				return $this->respText("活动不存在或已结束");
			}
			$isget = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_fans') . " WHERE marketid=:b and openid=:a", array(":a" => $openid, ":b" => $reply['gameid']));
			if ($isget) {
				return $this->respText("您已经领取过奖励了哦");
			}
			if (TIMESTAMP < $marketing['starttime']) {
				return $this->respText("活动在" . date("Y-m-d H:i", $marketing['starttime']) . "开始哦");
			}
			if (TIMESTAMP > $marketing['endtime']) {
				return $this->respText("活动已结束了哦");
			}
			if ($marketing['hour']) {
				$hourary = strpos($marketing['hour'], ",") ? explode(",", $marketing['hour']) : array($marketing['hour']);
				if (!in_array(date("H"), $hourary)) {
					return $this->respText("活动在" . implode(",", $hourary) . "时进行");
				}
			}
			if ($marketing['num']) {
				if ($marketing['isallnum']) {
					$numuser = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_fans') . " WHERE weid='{$_W['uniacid']}' and status>0 and marketing=:a ", array(":a" => $marketing['id']));
					if ($numuser >= $marketing['num']) {
						return $this->respText("抱歉，前" . $marketing['num'] . "才能获得奖励哦");
					}
				} else {
					$numuser = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('j_money_fans') . " WHERE weid='{$_W['uniacid']}' and status>0 and marketing=:a and createdate =:b ", array(":a" => $marketing['id'], ":b" => date('Y-m-d')));
					if ($numuser >= $marketing['num']) {
						return $this->respText("抱歉，每天前" . $marketing['num'] . "才能获得奖励哦");
					}
				}
			}
			switch ($marketing['condition']) {
				case 4:
					$fans = pdo_fetch("SELECT * FROM " . tablename('mc_mapping_fans') . " WHERE uniacid='{$_W['uniacid']}' and openid=:a ", array(":a" => $openid));
					if ($fans) {
						return $this->respText("再次感谢您关注我们");
					}
					break;
				case 5:
					$fans = pdo_fetch("SELECT * FROM " . tablename('mc_mapping_fans') . " WHERE uniacid='{$_W['uniacid']}' and openid=:a ", array(":a" => $openid));
					$fansTime = TIMESTAMP - $fans["followtime"];
					if ($fansTime >= 86400 * $marketing['condition_attendtime']) {
						goto prize;
					} else {
						$fansDate = intval($fansTime / 86400);
						return $this->respText("抱歉哦，活动要求关注时长为" . $marketing['condition_attendtime'] . "天。您目前关注时长为" . $fansDate . "天。温馨提示：如果中途有取消关注的，时间将从重新关注的时间开始计算哦");
					}
					break;
			}
			prize:
			$cfg = $this->module['config'];
			switch ($marketing['favorabletype']) {
				case 3:
					if (strpos($marketing['favorable'], "|#卡券#|")) {
						$temp = str_replace("[|#卡券#|", "", $marketing['favorable']);
						$temp = str_replace("]", "", $temp);
						$favorAry = strpos($temp, ",") ? explode(",", $temp) : array($temp);
						shuffle($favorAry);
						$cardkey = $favorAry[0];
						$wxcard = json_decode($cfg['wxcard'], true);
						if ($wxcard[$cardkey]) {
							$data = array('marketid' => $marketing['id'], 'rid' => $rid, 'favorabletype' => 3, 'weid' => $_W['uniacid'], "openid" => $openid, 'favorable' => $wxcard[$cardkey], 'status' => 1, "createtime" => TIMESTAMP, 'log' => '获得卡券');
							pdo_insert("j_money_fans", $data);
							$this->sendCard($openid, $wxcard[$cardkey]);
							return $this->respText("感谢您一路以来的支持，送您一张卡券，希望您能继续支持我们哦");
						}
					}
					break;
				case 4:
					if (strpos($marketing['favorable'], "|#抽奖#|")) {
						$temp = str_replace("[|#抽奖#|", "", $marketing['favorable']);
						$temp = str_replace("]", "", $temp);
						$favorAry = intval($temp);
						if ($favorAry) {
							$data = array('marketid' => $marketing['id'], 'rid' => $rid, 'favorabletype' => 4, 'weid' => $_W['uniacid'], "openid" => $openid, 'favorable' => $marketing['favorable'], 'status' => 1, "createtime" => TIMESTAMP, 'log' => '获得抽奖机会');
							pdo_insert("j_money_fans", $data);
							$insert = array('weid' => $_W['uniacid'], 'gid' => $marketing['gid'], 'from_user' => $openid);
							for ($i = 0; $i < $favorAry; $i++) {
								pdo_insert("j_money_lottery", $insert);
							}
							$rid = $this->rule;
							$response[] = array('title' => "恭喜您获得抽奖机会哦", 'description' => "为答谢您一路来的支持和信任，我们为您准备了抽奖机会，希望您能中大奖哦", 'picurl' => "", 'url' => $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&id=" . $marketing['gid'] . "&do=game&m=j_money");
							return $this->respNews($response);
						}
					}
					break;
			}
			ends:
			return $this->respText("再次感谢您关注我们");
		}
	}
	public function _sendText($openid, $txt)
	{
		global $_W;
		$acid = pdo_fetchcolumn("SELECT acid FROM " . tablename('account') . " WHERE uniacid=:uniacid ", array(':uniacid' => $_W['uniacid']));
		$acc = WeAccount::create($acid);
		$data = $acc->sendCustomNotice(array('touser' => $openid, 'msgtype' => 'text', 'text' => array('content' => urlencode($txt))));
		return $data;
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
		$pars['nonce_str'] = $this->getNonceStr();
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
	public function getNonceStr($length = 32)
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
}
<?php 
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
if(intval($_GPC['printtype'])==99){
	die(json_encode(array("success"=>true,"content"=>$_GPC['content'],"qrcode"=>$_GPC['qrcode'])));
}
$userid=$_GPC['userid'];
if(!$userid)die(json_encode(array("success"=>false,"msg"=>"请先登录0x001")));
$user=pdo_fetch("SELECT * FROM ".tablename('j_money_user')." WHERE weid='{$_W['uniacid']}' and id=:id and status=1",array(":id"=>$userid));
$shop=pdo_fetch("SELECT * FROM ".tablename('j_money_group')." WHERE weid='{$_W['uniacid']}' and id=:id ",array(":id"=>$user['pcate']));
if(!$user || !$shop)die(json_encode(array("success"=>false,"msg"=>"请先登录0x002")));

if($operation=="print_getprintdoc"){
	$printtype=intval($_GPC['printtype']);
	$orderid=trim($_GPC['ordersn']);
	$print=pdo_fetch("SELECT * FROM ".tablename('j_money_print')." WHERE weid='{$_W['uniacid']}' and pcate=:a and groupid=:b order by isdefault desc ,id desc limit 1",array(':a'=>$printtype,':b'=>$shop['id']));
	$content=$print['content'];
	if(!$printtype){
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$orderid));
		if(!$trade)die(json_encode(array("success"=>false,"msg"=>"交易为空0x001","orderid"=>$orderid)));
		$data=array("CFT"=>"零钱包","ICBC_DEBIT"=>"工商银行(借记卡)","ICBC_CREDIT"=>"工商银行(信用卡)","ABC_DEBIT"=>"农业银行(借记卡)","ABC_CREDIT"=>"农业银行(信用卡)","PSBC_DEBIT"=>"邮政储蓄银行(借记卡)","PSBC_CREDIT"=>"邮政储蓄银行(信用卡)","CCB_DEBIT"=>"建设银行(借记卡)","CCB_CREDIT"=>"建设银行(信用卡)","CMB_DEBIT"=>"招商银行(借记卡)","CMB_CREDIT"=>"招商银行(信用卡)","BOC_DEBIT"=>"中国银行(借记卡)","BOC_CREDIT"=>"中国银行(信用卡)","COMM_DEBIT"=>"交通银行(借记卡)","SPDB_DEBIT"=>"浦发银行(借记卡)","SPDB_CREDIT"=>"浦发银行(信用卡)","GDB_DEBIT"=>"广发银行(借记卡)","GDB_CREDIT"=>"广发银行(信用卡)","CMBC_DEBIT"=>"民生银行(借记卡)","CMBC_CREDIT"=>"民生银行(信用卡)","PAB_DEBIT"=>"平安银行(借记卡)","PAB_CREDIT"=>"平安银行(信用卡)","CEB_DEBIT"=>"光大银行(借记卡)","CEB_CREDIT"=>"光大银行(信用卡)","CIB_DEBIT"=>"兴业银行(借记卡)","CIB_CREDIT"=>"兴业银行(信用卡)","CITIC_DEBIT"=>"中信银行(借记卡)","CITIC_CREDIT"=>"中信银行(信用卡)","BOSH_DEBIT"=>"上海银行(借记卡)","BOSH_CREDIT"=>"上海银行(信用卡)","CRB_DEBIT"=>"华润银行(借记卡)","HZB_DEBIT"=>"杭州银行(借记卡)","HZB_CREDIT"=>"杭州银行(信用卡)","BSB_DEBIT"=>"包商银行(借记卡)","BSB_CREDIT"=>"包商银行(信用卡)","CQB_DEBIT"=>"重庆银行(借记卡)","SDEB_DEBIT"=>"顺德农商行(借记卡)","SZRCB_DEBIT"=>"深圳农商银行(借记卡)","HRBB_DEBIT"=>"哈尔滨银行(借记卡)","BOCD_DEBIT"=>"成都银行(借记卡)","GDNYB_DEBIT"=>"南粤银行(借记卡)","GDNYB_CREDIT"=>"南粤银行(信用卡)","GZCB_DEBIT"=>"广州银行(借记卡)","GZCB_CREDIT"=>"广州银行(信用卡)","JSB_DEBIT"=>"江苏银行(借记卡)","JSB_CREDIT"=>"江苏银行(信用卡)","NBCB_DEBIT"=>"宁波银行(借记卡)","NBCB_CREDIT"=>"宁波银行(信用卡)","NJCB_DEBIT"=>"南京银行(借记卡)","JZB_DEBIT"=>"晋中银行(借记卡)","KRCB_DEBIT"=>"昆山农商(借记卡)","LJB_DEBIT"=>"龙江银行(借记卡)","LNNX_DEBIT"=>"辽宁农信(借记卡)","LZB_DEBIT"=>"兰州银行(借记卡)","WRCB_DEBIT"=>"无锡农商(借记卡)","ZYB_DEBIT"=>"中原银行(借记卡)","ZJRCUB_DEBIT"=>"浙江农信(借记卡)","WZB_DEBIT"=>"温州银行(借记卡)","XAB_DEBIT"=>"西安银行(借记卡)","JXNXB_DEBIT"=>"江西农信(借记卡)","NCB_DEBIT"=>"宁波通商银行(借记卡)","NYCCB_DEBIT"=>"南阳村镇银行(借记卡)","NMGNX_DEBIT"=>"内蒙古农信(借记卡)","SXXH_DEBIT"=>"陕西信合(借记卡)","SRCB_CREDIT"=>"上海农商银行(信用卡)","SJB_DEBIT"=>"盛京银行(借记卡)","SDRCU_DEBIT"=>"山东农信(借记卡)","SRCB_DEBIT"=>"上海农商银行(借记卡)","SCNX_DEBIT"=>"四川农信(借记卡)","QLB_DEBIT"=>"齐鲁银行(借记卡)","QDCCB_DEBIT"=>"青岛银行(借记卡)","PZHCCB_DEBIT"=>"攀枝花银行(借记卡)","ZJTLCB_DEBIT"=>"浙江泰隆银行(借记卡)","TJBHB_DEBIT"=>"天津滨海农商行(借记卡)","WEB_DEBIT"=>"微众银行(借记卡)","YNRCCB_DEBIT"=>"云南农信(借记卡)","WFB_DEBIT"=>"潍坊银行(借记卡)","WHRC_DEBIT"=>"武汉农商行(借记卡)","ORDOSB_DEBIT"=>"鄂尔多斯银行(借记卡)","XJRCCB_DEBIT"=>"新疆农信银行(借记卡)","ORDOSB_CREDIT"=>"鄂尔多斯银行(信用卡)","CSRCB_DEBIT"=>"常熟农商银行(借记卡)","JSNX_DEBIT"=>"江苏农商行(借记卡)","GRCB_CREDIT"=>"广州农商银行(信用卡)","GLB_DEBIT"=>"桂林银行(借记卡)","GDRCU_DEBIT"=>"广东农信银行(借记卡)","GDHX_DEBIT"=>"广东华兴银行(借记卡)","FJNX_DEBIT"=>"福建农信银行(借记卡)","DYCCB_DEBIT"=>"德阳银行(借记卡)","DRCB_DEBIT"=>"东莞农商行(借记卡)","CZCB_DEBIT"=>"稠州银行(借记卡)","CZB_DEBIT"=>"浙商银行(借记卡)","CZB_CREDIT"=>"浙商银行(信用卡)","GRCB_DEBIT"=>"广州农商银行(借记卡)","CSCB_DEBIT"=>"长沙银行(借记卡)","CQRCB_DEBIT"=>"重庆农商银行(借记卡)","CBHB_DEBIT"=>"渤海银行(借记卡)","BOIMCB_DEBIT"=>"内蒙古银行(借记卡)","BOD_DEBIT"=>"东莞银行(借记卡)","BOD_CREDIT"=>"东莞银行(信用卡)","BOB_DEBIT"=>"北京银行(借记卡)","BNC_DEBIT"=>"江西银行(借记卡)","BJRCB_DEBIT"=>"北京农商行(借记卡)","AE_CREDIT"=>"AE(信用卡)","GYCB_CREDIT"=>"贵阳银行(信用卡)","JSHB_DEBIT"=>"晋商银行(借记卡)","JRCB_DEBIT"=>"江阴农商行(借记卡)","JNRCB_DEBIT"=>"江南农商(借记卡)","JLNX_DEBIT"=>"吉林农信(借记卡)","JLB_DEBIT"=>"吉林银行(借记卡)","JJCCB_DEBIT"=>"九江银行(借记卡)","HXB_DEBIT"=>"华夏银行(借记卡)","HXB_CREDIT"=>"华夏银行(信用卡)","HUNNX_DEBIT"=>"湖南农信(借记卡)","HSB_DEBIT"=>"徽商银行(借记卡)","HSBC_DEBIT"=>"恒生银行(借记卡)","HRXJB_DEBIT"=>"华融湘江银行(借记卡)","HNNX_DEBIT"=>"河南农信(借记卡)","HKBEA_DEBIT"=>"东亚银行(借记卡)","HEBNX_DEBIT"=>"河北农信(借记卡)","HBNX_DEBIT"=>"湖北农信(借记卡)","HBNX_CREDIT"=>"湖北农信(信用卡)","GYCB_DEBIT"=>"贵阳银行(借记卡)","GSNX_DEBIT"=>"甘肃农信(借记卡)","JCB_CREDIT"=>"JCB(信用卡)","MASTERCARD_CREDIT"=>"MASTERCARD(信用卡)","VISA_CREDIT"=>"VISA(信用卡)");
		$printDoc=str_replace("|#收银员#|",$user['realname'],$content);
		$printDoc=str_replace("|#收银时间#|",$trade['time_end'] ? date("Y-m-d H:i:s",$trade['time_end']) : 0,$printDoc);
		$printDoc=str_replace("|#总金额#|",sprintf('%.2f',($trade['order_fee']/100)),$printDoc);
		$printDoc=str_replace("|#应收金额#|",sprintf('%.2f',($trade['total_fee']/100)),$printDoc);
		$printDoc=str_replace("|#系统优惠#|",sprintf('%.2f',($trade['coupon_fee']/100)),$printDoc);
		$printDoc=str_replace("|#店铺优惠#|",sprintf('%.2f',($trade['discount_fee']/100)),$printDoc);
		$printDoc=str_replace("|#实付金额#|",sprintf('%.2f',($trade['cash_fee']/100)),$printDoc);
		$printDoc=str_replace("|#付款方式#|",$trade['paytype'] ? "支付宝" : "微信".$data[$trade['bank_type']],$printDoc);
		$printDoc=str_replace("|#付款终端#|",$trade['attach']=='-' ||$trade['attach']=='PC' ? "电脑端" : "移动端",$printDoc);
		$printDoc=str_replace("|#单号#|",$trade['out_trade_no'],$printDoc);
		$printDoc=str_replace("|#原单号#|",$trade['old_trade_no'],$printDoc);
		$printDoc=str_replace("|#店铺#|",$shop['companyname'],$printDoc);
		$printDoc=str_replace("|#时间#|",date("Y-m-d H:i:s"),$printDoc);
		$status="未支付";
		if($trade['status']==1){
			$status="已支付";
		}elseif($trade['status']==2){
			$status="已退款";
		}
		$printDoc=str_replace("|#状态#|",$status,$printDoc);
		if($print['qrcode']!=0){
			$qrcode1=encrypt($orderid, 'E', $cfg['encryptcode']);
			$qrcode=urlencode(base64_encode($qrcode1));
			$uniacid=$cfg['creadit_uniacid'] ? $cfg['creadit_uniacid'] : $_W['uniacid'];
			$url=trueUrl2Shorturl($_W['siteroot']."app/index.php?i=".$uniacid."&c=entry&do=getcredit&m=j_money&qrcode=".$qrcode);
		}
		pdo_update("j_money_trade",array("isprint"=>$trade['isprint']+1),array("id"=>$trade['id']));
	}elseif($printtype==1){
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_carduser')." WHERE weid='{$_W['uniacid']}' and id=:a",array(":a"=>$orderid));
		if(!$trade)die(json_encode(array("success"=>false,"msg"=>"交易为空0x002","orderid"=>$orderid)));
		$cardtype=array("discount"=>"折扣券","cash"=>"代金券","gift"=>"礼品券","groupon"=>"团购券","general_coupon"=>"优惠券",);
		$printDoc=str_replace("|#收银员姓名#|",$user['realname'],$content);
		$printDoc=str_replace("|#兑换时间#|",date("Y-m-d H:i:s",$trade['createtime']),$printDoc);
		$printDoc=str_replace("|#卡券内容#|",$trade['description'],$printDoc);
		$printDoc=str_replace("|#卡券标题#|",$trade['title'],$printDoc);
		$printDoc=str_replace("|#卡券副标题#|",$trade['sub_title'],$printDoc);
		$printDoc=str_replace("|#卡券类型#|",$cardtype[$trade['type']],$printDoc);
		switch($coupon['type']){
			case "gift":
			case "groupon":
			case "general_coupon":
				$trade["typestr"]=$coupon['extra'];
			break;
			case "discount":
				$trade["typestr"]="".sprintf('%.2f',($coupon['extra']/100))."折";
			break;
			case "cash":
				$extra=iunserializer($coupon['extra']);
				$trade["typestr"]="满".$extra['least_cost']."减".$extra['reduce_cost'];
			break;
		}
		$printDoc=str_replace("|#卡券优惠#|",$trade["typestr"],$printDoc);
		if($print['qrcode'])$url=$print['qrcode'];
	}elseif($printtype==2){
		if(!$orderid)die(json_encode(array("success"=>false,"msg"=>"订单编号为空")));
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_recharge')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a ",array(":a"=>$orderid));
		if(!$trade)die(json_encode(array("success"=>false,"msg"=>"交易为空","orderid"=>$orderid)));
		$membercard=pdo_fetch("SELECT * FROM ".tablename('j_money_memebercard')." WHERE weid='{$_W['uniacid']}' and cardno=:a ",array(":a"=>$trade['cardno']));
		$payTypeAry=array("现金","银行卡","微信钱包","支付宝");
		$printDoc=str_replace("|#收银员#|",$user['realname'],$content);
		$printDoc=str_replace("|#店铺#|",$shop['companyname'],$printDoc);
		$printDoc=str_replace("|#卡号#|",$membercard['cardno'],$printDoc);
		$printDoc=str_replace("|#余额#|",sprintf('%.2f',($membercard['cash']*0.01)),$printDoc);
		$printDoc=str_replace("|#姓名#|",$membercard['realname'],$printDoc);
		$printDoc=str_replace("|#电话#|",$membercard['mobile'],$printDoc);
		$printDoc=str_replace("|#充值金额#|",sprintf('%.2f',($trade['cash']*0.01)),$printDoc);
		$printDoc=str_replace("|#充值方式#|",$payTypeAry[$trade['paytype']],$printDoc);
		$printDoc=str_replace("|#充值时间#|",date("Y-m-d H:i",$trade['createtime']),$printDoc);
		$printDoc=str_replace("|#时间#|",date('Y-m-d H:i'),$printDoc);
		$credit=$membercard['creadit'];
		if($membercard['openid']){
			$uid=mc_openid2uid($membercard['openid']);
			if($uid){
				$credit2=mc_credit_fetch($uid,array('credit1'));
				$credit=$credit2['credit1']+$credit;
			}
		}
		$printDoc=str_replace("|#积分#|",$credit,$printDoc);
		die(json_encode(array("success"=>true,"content"=>$printDoc,"qrcode"=>$url)));
		if($print['qrcode'])$url=$print['qrcode'];
	}elseif($printtype==3){
		$startTime=$user['lasttime'];
		$endTime=TIMESTAMP;
		$tradeList=pdo_fetchall("SELECT count(*) as nums,paytype,sum(total_fee) as totalfee FROM ".tablename('j_money_trade')." WHERE weid='".$_W['uniacid']."' and status=1 and userid=:a and createtime>=:b and  createtime<=:c group by paytype " ,array(":a"=>$user['id'],":b"=>$startTime,":c"=>$endTime));
		$feeAry=array();
		$feeAry['all']['fee']=$feeAry['all']['count']=0;
		foreach($tradeList as $row){
			if(!isset($feeAry[$row['paytype']])){
				$feeAry[$row['paytype']]['fee']=0;
				$feeAry[$row['paytype']]['count']=0;
			}
			$feeAry[$row['paytype']]['fee']=$row['totalfee'];
			$feeAry[$row['paytype']]['count']=$row['nums'];
			$feeAry['all']['fee']=$feeAry['all']['fee']+$row['totalfee'];
			$feeAry['all']['count']=$feeAry['all']['count']+$row['nums'];
		}
		$chargeList=pdo_fetchall("SELECT count(*) as nums,paytype,sum(cash) as totalfee FROM ".tablename('j_money_recharge')." WHERE weid='".$_W['uniacid']."' and status=1 and userid=:a and createtime>=:b and  createtime<=:c group by paytype " ,array(":a"=>$user['id'],":b"=>$startTime,":c"=>$endTime));
		$chargeAry=array();
		$chargeAry['all']['fee']=$chargeAry['all']['count']=0;
		foreach($chargeList as $row){
			if(!isset($chargeAry[$row['paytype']])){
				$chargeAry[$row['paytype']]['fee']=0;
				$chargeAry[$row['paytype']]['count']=0;
			}
			$chargeAry[$row['paytype']]['fee']=$row['totalfee'];
			$chargeAry[$row['paytype']]['count']=$row['nums'];
			$chargeAry['all']['fee']=$chargeAry['all']['fee']+$row['totalfee'];
			$chargeAry['all']['count']=$chargeAry['all']['count']+$row['nums'];
		}
		$cardnum=pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_carduser')." WHERE weid='".$_W['uniacid']."' and userid=:a and createtime>=:b and  createtime<=:c" ,array(":a"=>$user['id'],":b"=>$startTime,":c"=>$endTime));
		$printDoc=str_replace("|#收银员#|",$user['realname'],$content);
		$printDoc=str_replace("|#店铺#|",$shop['companyname'],$printDoc);
		$temp_allfee=$feeAry['all']['fee']+$chargeAry['all']['fee'];
		$printDoc=str_replace("|#总销售额#|",sprintf('%.2f',($temp_allfee*0.01)),$printDoc);
		$printDoc=str_replace("|#交易笔数#|",$feeAry['all']['count']+$chargeAry['all']['count'],$printDoc);
		$printDoc=str_replace("|#微信#|",sprintf('%.2f',($feeAry[0]['fee']*0.01)),$printDoc);
		$printDoc=str_replace("|#支付宝#|",sprintf('%.2f',($feeAry[1]['fee']*0.01)),$printDoc);
		$printDoc=str_replace("|#余额#|",sprintf('%.2f',($feeAry[4]['fee']*0.01)),$printDoc);
		
		$temp_fee1=$feeAry[0]['fee']+$feeAry[1]['fee'];
		$printDoc=str_replace("|#总充值#|",sprintf('%.2f',($chargeAry['all']['fee']*0.01)),$printDoc);
		$printDoc=str_replace("|#电子支付#|",sprintf('%.2f',($temp_fee1*0.01)),$printDoc);
		$printDoc=str_replace("|#充现金#|",sprintf('%.2f',($chargeAry[0]['fee']*0.01)),$printDoc);
		$printDoc=str_replace("|#充银行卡#|",sprintf('%.2f',($chargeAry[1]['fee']*0.01)),$printDoc);
		$printDoc=str_replace("|#充微信#|",sprintf('%.2f',($chargeAry[2]['fee']*0.01)),$printDoc);
		$printDoc=str_replace("|#充支付宝#|",sprintf('%.2f',($chargeAry[3]['fee']*0.01)),$printDoc);
		
		$printDoc=str_replace("|#总现金#|",sprintf('%.2f',($temp_fee3*0.01)),$printDoc);
		$temp_fee4=$feeAry[3]['fee']+$chargeAry[1]['fee'];
		$printDoc=str_replace("|#总银行卡#|",sprintf('%.2f',($temp_fee4*0.01)),$printDoc);
		$temp_fee5=$feeAry[0]['fee']+$chargeAry[2]['fee'];
		$printDoc=str_replace("|#总微信#|",sprintf('%.2f',($temp_fee5*0.01)),$printDoc);
		$temp_fee6=$feeAry[1]['fee']+$chargeAry[3]['fee'];
		$printDoc=str_replace("|#总支付宝#|",sprintf('%.2f',($temp_fee6*0.01)),$printDoc);
		$printDoc=str_replace("|#卡券数量#|",$cardnum,$printDoc);
		$printDoc=str_replace("|#银行卡单据#|",$feeAry[3]['count']+$chargeAry[1]['count'],$printDoc);
		$printDoc=str_replace("|#日期#|",date('Y-m-d'),$printDoc);
		$printDoc=str_replace("|#时间#|",date('H:i'),$printDoc);
		$printDoc=str_replace("|#交班时间#|",date("m/d H:i",$startTime).'/'.date('H:i'),$printDoc);
		die(json_encode(array("success"=>true,"content"=>$printDoc,"qrcode"=>$url)));
		if($print['qrcode'])$url=$print['qrcode'];
	}elseif($printtype==4){
		if(!$orderid)die(json_encode(array("success"=>false,"msg"=>"订单编号为空")));
		$trade=pdo_fetch("SELECT * FROM ".tablename('j_money_trade')." WHERE weid='{$_W['uniacid']}' and out_trade_no=:a",array(":a"=>$orderid));
		if(!$trade)die(json_encode(array("success"=>false,"msg"=>"交易为空","orderid"=>$orderid)));
		
		$payTypeAry=array("微信钱包","支付宝","现金","银行卡","会员卡余额");
		$printDoc=str_replace("|#退款员#|",$user['realname'],$content);
		$printDoc=str_replace("|#店铺#|",$shop['companyname'],$printDoc);
		$printDoc=str_replace("|#收银时间#|",$trade['createtime'] ? date("Y-m-d H:i",$trade['createtime']) : 0,$printDoc);
		$printDoc=str_replace("|#退款时间#|",$trade['createtime'] ? date("Y-m-d H:i",$trade['createtime']) : 0,$printDoc);
		$printDoc=str_replace("|#时间#|",date("Y-m-d H:i"),$printDoc);
		$printDoc=str_replace("|#应收金额#|",sprintf('%.2f',($trade['order_fee']/100)),$printDoc);
		$printDoc=str_replace("|#合计金额#|",sprintf('%.2f',($trade['total_fee']/100)),$printDoc);
		$printDoc=str_replace("|#店铺优惠#|",sprintf('%.2f',($trade['discount_fee']/100)),$printDoc);
		$printDoc=str_replace("|#系统优惠#|",sprintf('%.2f',($trade['coupon_fee']/100)),$printDoc);
		$printDoc=str_replace("|#退款金额#|",sprintf('%.2f',($refund['refund_fee']/100)),$printDoc);
		$printDoc=str_replace("|#退款方式#|",$payTypeAry[$trade['paytype']],$printDoc);
		$printDoc=str_replace("|#单号#|",$trade['out_trade_no'],$printDoc);
		$printDoc=str_replace("|#付款状态#|",$trade['status']==2 ? '已退款' : '未退款' ,$printDoc);
		die(json_encode(array("success"=>true,"content"=>$printDoc,"qrcode"=>"")));
		if($print['qrcode'])$url=$print['qrcode'];
	}elseif($printtype==5){
		$printDoc='测试打印功能<BR>店铺：'.$shop['companyname'].'<BR>收银员：'.$user['realname'].'<BR>打印功能正常<BR>'.date("Y-m-d H:i:s").'<BR>';
		die(json_encode(array("success"=>true,"content"=>$printDoc,"qrcode"=>"")));
	}
	die(json_encode(array("success"=>true,"content"=>$printDoc,"qrcode"=>$url)));
}
<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title><?php  echo $shop['companyname'];?>-收银台</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no, address=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<link href="./resource/css/bootstrap.min.css" rel="stylesheet">
<link href="./resource/css/font-awesome.min.css" rel="stylesheet">
<link href="./resource/css/common.css" rel="stylesheet">
<script src="<?php echo MODULE_URL;?>template/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo MODULE_URL;?>image/js/lib/bootstrap.min.js" type="text/javascript" charset="utf-8" ></script>
<script src="<?php echo MODULE_URL;?>template/js/sweetalert.min2.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo MODULE_URL;?>template/js/sweetalert.css"/>
<script src="<?php echo MODULE_URL;?>template/js/JKeyboard.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo MODULE_URL;?>template/js/JKeyboard.css"/>
<script src="<?php echo MODULE_URL;?>template/mobile/jetsum.min.js?v=<?php echo TIMESTAMP;?>"></script>
<script src="<?php echo MODULE_URL;?>template/js/datetimepicker.min.js"></script>
<link href="<?php echo MODULE_URL;?>template/js/datetimepicker.min.css" rel="stylesheet">
<script>
//checkBrowser();
</script>
</head>
<body>
<?php  if($operation=='display') { ?>
<style>
html{ height:100%;}
body{height:100%; overflow:hidden; background:url(<?php  echo tomedia($cfg['bg'])?>); background-size:100% 100%;}
.login_body{ display:table; width:80%; margin:0 auto; max-width:300px;height:100%;}
.jrow{ display:table-row;}
.cell{ display:table-cell; width:100%;vertical-align:middle; text-align:center}
.cell .input-group-addon{ background:#FFF;}
.form-control{ margin-bottom:10px;}
.keyboardbtn{ position:absolute; z-index:33; border:1px solid #CCC; box-shadow:0px 0px 2px #FFF; padding:10px; border-radius:8px;right:20px; bottom:20px;background:#FFF; color:#09F;}
.keyboardon{color:#FFF; background:#09F;}
</style>
<!--登录-->
<?php  if($_GPC['logintype']) { ?>
<div id="qrbox" style="width:300px; height:300px; margin:0 auto;"><img src="http://qr.liantu.com/api.php?text=<?php  echo $url?>" style="width:100%; margin-bottom:20px"/>
    <div style="text-align:center">
    	<button class="btn btn-warning" type="button" onClick="location.href='<?php  echo $this->createMobileUrl('index',array('logintype'=>'0'))?>'"><i class="fa fa-sign-in"></i> 账号登陆</button>
    </div>
</div>
<script>
var timer=0;
$(document).ready(function(e) {
    var _h=$(document).height();
	$("#qrbox").css('margin-top',(_h-300)*0.5);
	setTimeout("checkIslogin()",5000);
});
function checkIslogin(){
	timer++;
	console.log(timer);
	$.ajax({ 
		url: "<?php  echo $this->createMobileUrl('ajax',array('op'=>'checklogin'))?>",
		type: "POST",
		dataType:'json', 
		success: function(data){
    		if(data.success){
				location.href="<?php  echo $this->createMobileUrl('index',array('op'=>'in'))?>";
			}else{
				if(data.msg){
					swal({
						title:data.msg,
						timer:2000,
					}, function(isConfirm){
							if(data.reload){
								location.reload();
							}
						}
					);
				};
				if(data.reload){
					location.reload();
				}
				setTimeout("checkIslogin()",5000);
			}
		},
		error:function(event,request,settings){
    		alert("error");
		}
	})
}
</script>
<?php  } else { ?>
<div class="login_body">
  <div class="jrow">
    <div class="cell">
      <form  onSubmit="return false;">
        <div class="input-group" style="margin-bottom:10px;"> <span class="input-group-addon" style="background:#FFF"><i class="fa fa-user" style="width:40px"></i></span>
          <input type="text" name="userid" class="form-control" placeholder="用户名" required autofocus autocomplete="off" style="cursor:auto;">
          <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
        </div>
        <div class="input-group" style="margin-bottom:10px;"> <span class="input-group-addon" ><i class="fa fa-key" style="width:40px"></i></span>
          <input type="password" name="pwd" class="form-control" placeholder="密码" required autocomplete="off">
          <span class="input-group-addon" ><i class="fa fa-keyboard-o"></i></span>
        </div>
        <div class="row">
            <div class="col-sm-6"><button class="btn btn-success btn-block" type="button" onClick="location.href='<?php  echo $this->createMobileUrl('index',array('logintype'=>'1'))?>'"><i class="fa fa-qrcode"></i> 扫码登陆</button></div>
            <div class="col-sm-6"><button class="btn btn-warning btn-block" type="submit" onClick="return checkUpdate();return false;"><i class="fa fa-sign-in"></i> 登录</button></div>
        </div>
        
      </form>
    </div>
  </div>
</div>
<div class="keyboardbtn"><i class="fa fa-keyboard-o fa-2x"></i></div>
<script language="javascript">
$(document).ready(function(e) {
    var _h=$(document).height();
	$(".cell").height(_h*0.8);
	$("input[name='userid']").focus();
});
$(".keyboardbtn").on('click',function(){
	if($(this).hasClass('keyboardon')){
		$(this).removeClass('keyboardon');
		$('input[name="username"]').unbind('click');
		$('input[name="pwd"]').unbind('click');
		$(this).JKeyboard({'show':false})
	}else{
		$(this).addClass('keyboardon');
		$('input[name="userid"]').bind('click',function(){
			$('input[name="userid"]').JKeyboard({'type':1,'val':'','tips':'请输入账号'});
		})
		$('input[name="pwd"]').bind('click',function(){
			$('input[name="pwd"]').JKeyboard({'type':1,'val':'','tips':'请输入密码'});
		})
	}
})
function checkUpdate(){
	var userid=$("input[name='userid']").val();
	var pwd=$("input[name='pwd']").val();
	if(userid.length<1){
		swal("用户名不能为空");
		return false;
	}
	if(pwd.length<6){
		swal("密码长度不正确");
		return false;
	}
	$.ajax({ 
		url: "<?php  echo $this->createMobileUrl('ajax',array('op'=>'login'))?>",
		type: "POST",
		data: {"userid":userid,"pwd":pwd},
		dataType:'json', 
		success: function(data){
    		if(data.success){
				location.href="<?php  echo $this->createMobileUrl('index',array('op'=>'in'))?>";
			}else{
				swal(data.msg);
			}
		},
		error:function(event,request,settings){
    		alert("error");
		}
	})
	return false;
}
</script> 
<?php  } ?>
<?php  } else { ?>
 
<!--登录成功-->
<style>
ul,li{ margin:0; padding:0;}
.jrow{ display:table-row;}
.jcell{ display:table-cell}
.valignM{ vertical-align:middle;}
.main_top{height:50px; background:#18BB9C; display:table; width:100%;}
.top_logo{width:180px; text-indent:30px; background:#1F232C; line-height:40px; padding:5px;}
.top_menu{line-height:50px;text-align:right; padding:0 30px 0 0;color:#FFF;}
.top_menu a{color:#FFF; display:inline-block; text-decoration:none; line-height:50px; padding:0 10px}
.top_menu a:hover{ background:#FFF; color:#18BB9C}
.main_body{display:table;width:100%;}
.body_left{width:180px;vertical-align:top;color:#FFF;background:#2F3541;}
.body_left_userinfobox{ background:#2F3541; padding:5px;}
.body_left_menu{ background:#2F3541;}
.body_left_menu ul,.body_left_menu ul li{ list-style:none; margin:0; padding:0;}
.body_left_menu ul li{padding:10px; line-height:24px; cursor:pointer;}
.body_left_menu ul li:hover{ background:#18BB9C}
.body_left_menu ul li.jlabel{background:#18BB9C}
.body_left_menu ul li span{ float:right;}
.body_left_menu ul li b{ margin-right:10px;}
.body_right{vertical-align:top;padding:20px;}
.body_right_meneybox{ text-align:center;}
.body_right_meneybox h2{ border-top-left-radius:4px;border-top-right-radius:4px;color:#FFF; font-size:40px; line-height:70px; margin:0}
.body_right_moneybox_btm{border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#FFF;border:1px solid #CCC;border-top:none;color:#999; padding:10px 0;}
.body_right_moneybox_btm .col-md-6:first-child{ border-right:1px solid #CCC;}
.body_right_moneybox_btm span{ font-size:22px; color:#666; display:block}
.body_right_main{ margin-top:20px;}
.bg_yellow{background:#F5AB35}
.bg_green{background:#2ECC71}
.bg_red{background:#F22613}
.bg_blue{background:#3498DB}
.bg_black{background:#2F3541}
.color_grade{color:#999}
.btn_sumitcss{line-height:40px; font-size:20px;}
#j_counter_btn input[type='button']{line-height:40px; font-size:20px;}
#j_counter_btn .row{ margin-bottom:15px;}
#j_counter_btn .row:last-child{margin-bottom:0;}
.extend_box{position:absolute; background:rgba(0,0,0,0.6); left:0; top:0; right:0; bottom:0; display:none; z-index:2}
.extend_innerbox{ width:80%; margin:0 auto; padding-top:120px;max-width:700px;}
.extendbtn_innerbox{width:80%; margin:0 auto; padding-top:120px;}
.pointer{ cursor:pointer}
.cardbox{ line-height:24px;}
.cardbox span{ color:#F00;}
#sysmsgbox{width:250px;position:absolute;z-index:99999; right:0;bottom:0;}
.mainbody{display:none;}
#history_page btn{margin:0 5px;}

.hiden{ display:none;}
.sweet-counter-box{ text-align:left;}
.sweet-counter-box ul { position:relative;}
.sweet-counter-box ul li{display:inline-block;width:24.3%; margin:2px 0.2%; text-align:center; line-height:40px; border:1px solid #CCC; border-radius:4px; font-size:18px; cursor:pointer;}
.sweet-counter-box .sweet-counter-c{position:absolute; z-index:2; height:134px;padding-top:46px}
.sweet-counter-box .sweet-counter-0{width:48.8%}
.sweet-counter-box ul li:hover,.sweet-counter-box ul li:active{ background:#CCC;}
ul.radio li{ display:inline-block; padding:5px 0; width:74px; text-align:center; margin:0 10px 10px 0;border:1px solid #CCC; border-radius:4px; cursor:pointer}
ul.radio li i{ font-size:30px;}
ul.radio li.checked{ border-color:#ffc107; background:#ffc107; color:#FFF;}
</style>

<div class="main_top">
  <div class="jrow">
    <div class="jcell top_logo"><img src="<?php  echo tomedia($cfg['logo'])?>" style="max-height:40px; max-width:136px;" onerror="this.style.display='none'"/></div>
    <div class="jcell top_menu"><a href="javascript:membercharge()"><i class="fa fa-asterisk"></i>充值</a> <a href="javascript:testprint()"><i class="fa fa-print"></i>测试打印</a><a href="javascript:logout()"><i class="fa fa-sign-out"></i> 退出</a></div>
  </div>
</div>
<!---->
<div class="main_body">
  <div class="jrow">
    <div class="jcell body_left">
      <div class="body_left_userinfobox">
        <div class="row">
          <div class="col-md-4 text-center"><img src="<?php echo MODULE_URL;?>template/img/head.jpg"  style="width:100%" class="img-circle img-thumbnail"/></div>
          <div class="col-md-8">
            <div>ID：<?php  echo $user['realname'];?></div>
            <div><span class="label label-info"><?php  echo $shop['companyname'];?></span></div>
          </div>
        </div>
      </div>
      <div class="body_left_menu">
        <ul>
          <li class="jlabel" onClick="extendFun(0);"><span><i class="fa fa-angle-right"></i></span><b><i class="fa fa-file-text-o"></i></b> 收款</li>
          <li onClick="extendFun(1);"><span><i class="fa fa-angle-right"></i></span><b><i class="fa fa-file-text-o"></i></b> 收款记录</li>
          <li onClick="extendFun(2);"><span><i class="fa fa-angle-right"></i></span><b><i class="fa fa-file-text-o"></i></b> 会员</li>
          <li onClick="extendFun(3);"><span><i class="fa fa-angle-right"></i></span><b><i class="fa fa-file-text-o"></i></b> 充值记录
		  
		    <li onClick="extendFun(4);"><span><i class="fa fa-angle-right"></i></span><b><i class="fa fa-file-text-o"></i></b> 积分兑换记录</li>
		  
		  </li>
        </ul>
      </div>
    </div>
    <div class="jcell body_right">
      <div class="mainbody" style="display:block;">
        <div class="body_right_menu row">
          <div class="col-md-3">
            <div class="body_right_meneybox">
              <h2 class="bg_yellow"><img src="<?php echo MODULE_URL;?>template/img/pay_0.png" height="50"/></h2>
              <div class="body_right_moneybox_btm row">
                <div class="col-md-12" id="wechat_cash"><span>￥0.00</span>今天已收款</div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <?php  if($shop['app_id']) { ?>
            <div class="body_right_meneybox">
              <h2 class="bg_green"><img src="<?php echo MODULE_URL;?>template/img/pay_1.png" height="50"/></h2>
              <div class="body_right_moneybox_btm row">
                <div class="col-md-12" id="ali_cash"><span>￥0.00</span>今天已收款</div>
              </div>
            </div>
           <?php  } ?>
          </div>
          <div class="col-md-3">
            <div class="body_right_meneybox">
              <h2 class="bg_green"><img src="<?php echo MODULE_URL;?>template/img/pay_3.png" height="50"/></h2>
              <div class="body_right_moneybox_btm row">
                <div class="col-md-12" id="wechat_card"><span>0</span>今天核销</div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-info" style="margin-bottom:0">
              <div class="panel-body table-responsive">
              <?php  echo $shop["info"];?>
              </div>
            </div>
          </div>
        </div>
        <!---->
        <div class="body_right_main row">
          <div class="body_right_main_left col-md-6">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="input-group"> <span class="input-group-addon" id="sizing-addon2">￥</span>
                  <input type="text" name="fee" id="fee" value="0" maxlength="8" class="form-control" style="line-height:60px; height:60px; font-size:40px; padding-top:10px; text-align:right" readonly/>
                  <span class="input-group-addon" id="sizing-addon2">元</span> </div>
              </div>
              <div class="panel-body" id="j_counter_btn">
                <div class="row">
                  <div class="col-md-4">
                    <input type="button" value="7" class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="8" class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="9" class="btn btn-info btn-block"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <input type="button" value="4" class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="5" class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="6" class="btn btn-info btn-block"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <input type="button" value="1" class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="2" class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="3" class="btn btn-info btn-block"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <input type="button" value="0" class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="." class="btn btn-info btn-block"/>
                  </div>
                  <div class="col-md-4">
                    <input type="button" value="清除" class="btn btn-block btn-danger"/>
                  </div>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row" >
                  <div class="col-md-3">
                    <button type="button" class="btn btn-danger btn-block btn_sumitcss" onClick="refundorder();">退款</button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-info btn-block btn_sumitcss" onClick="checkCard()">卡券</button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-warning btn-block btn_sumitcss" onClick="paymember();">会员卡</button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" id="paybtn" class="btn btn-success btn-block btn_sumitcss" onClick="payall()">收款</button>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="body_right_main_right col-md-6">
            
            <div class="panel panel-success">
              <div class="panel-heading">消费记录(最近5条记录)-点击状态可复查订单</div>
              <div class="panel-body table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width:96px;">#</th>
                      <th>消费方式</th>
                      <th>金额</th>
                      <th>实付</th>
                      <th>状态</th>
                    </tr>
                  </thead>
                  <tbody id="j_getrecord">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="mainbody">
        <div class="panel panel-default">
          <div class="panel-body form-inline">
            <div class="input-group"> <span class="input-group-addon">搜索</span>
              <input type="text" placeholder="请输入单号" id="keyword" class="form-control"/>
              <span class="input-group-addon" onclick="$('#keyword').JKeyboard({'type':1,'tips':'请输入单号'});"><i class="fa fa-keyboard-o"></i></span> </div>
            <div class="input-group"> <span class="input-group-addon">时间</span>
              <input class="form-control" id="datestart" type="text" style="width:120px" placeholder="请选择时间" readonly value="<?php  echo date('Y-m-d')?>"/>
              <span class="input-group-addon">至</span>
              <input class="form-control" id="dateend" style="width:120px" type="text" placeholder="请选择时间" readonly  value="<?php  echo date('Y-m-d')?>"/>
              <span class="input-group-addon"></span> </div>
            <input type="button" class="btn btn-info" style="line-height:26px;" onClick="history_search()" value="搜索"/>
            <?php  if($user['permission']>1) { ?>
            <input type="button" class="btn btn-danger" style="line-height:26px;" onClick="history_explort()" value="导出"/>
            <?php  } ?> </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>单号</th>
                  <th>总金额</th>
                  <th>优惠</th>
                  <th>应收</th>
				  <th>手续费</th>
                  <th>实付</th>
                  <th>时间</th>
                  <th>状态</th>
                  <th>已打印量</th>
                  <th style="text-align:right">操作</th>
                </tr>
              </thead>
              <tbody id="history_listbox">
              	
              </tbody>
              <tr><td colspan="8" align="center" id="history_page"></td></tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mainbody">
        <div class="panel panel-default">
          <div class="panel-body form-inline">
            <div class="input-group"> <span class="input-group-addon">搜索</span>
              <input type="text" placeholder="请输入会员卡号" id="mkeyword" class="form-control"/>
              <span class="input-group-addon" onclick="$('#mkeyword').JKeyboard({'type':1,'tips':'请输入会员卡号'});"><i class="fa fa-keyboard-o"></i></span> </div>
              <input type="button" class="btn btn-info" style="line-height:26px;" onClick="member_search()" value="搜索"/>
              <?php  if($user['permission']>1) { ?>
              <input type="button" class="btn btn-danger" style="line-height:26px;" onClick="member_explort()" value="导出"/>
              <?php  } ?> 
            </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>卡号</th>
                  <th>头像</th>
                  <th>姓名</th>
                  <th>余额</th>
                  <th>卡内积分</th>
                  <th>状态</th>
                  <th style="text-align:right">操作</th>
                </tr>
              </thead>
              <tbody id="member_listbox">
              	
              </tbody>
              <tr><td colspan="8" align="center" id="member_page"></td></tr>
            </table>
          </div>
        </div>
      </div>
      <div class="mainbody">
      	<div class="panel panel-default">
          <div class="panel-body form-inline">
            <div class="input-group"> <span class="input-group-addon">搜索</span>
              <input type="text" placeholder="请输入单号" id="charge_keyword" class="form-control"/>
              <span class="input-group-addon" onClick="$('#charge_keyword').JKeyboard({'type':1,'tips':'请输入单号'});"><i class="fa fa-keyboard-o"></i></span> </div>
            <div class="input-group"> <span class="input-group-addon">时间</span>
              <input class="form-control" id="datestart2" type="text" style="width:120px" readonly value="<?php  echo date('Y-m-d')?>"/>
              <span class="input-group-addon">至</span>
              <input class="form-control" id="dateend2" style="width:120px" type="text" readonly value="<?php  echo date('Y-m-d')?>"/>
              <span class="input-group-addon"></span> </div>
            <input type="button" class="btn btn-info" style="line-height:26px;" onClick="charge_search()" value="搜索"/>
            <?php  if($user['permission']>1) { ?>
            <input type="button" class="btn btn-danger" style="line-height:26px;" onClick="charge_explort()" value="导出"/>
            <?php  } ?> </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>单号</th>
                  <th>充值金额</th>
                  <th>充值方式</th>
                  <th>卡号</th>
                  <th>时间</th>
                  <th>状态</th>
                  <th>已打印量</th>
                  <th style="text-align:right">操作</th>
                </tr>
              </thead>
              <tbody id="charge_listbox">
              </tbody>
              <tr>
                <td colspan="8" align="center" id="charge_page"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
	  
	  
	    <div class="mainbody">
      	<div class="panel panel-default">
          <div class="panel-body form-inline">
              <div class="input-group"> <span class="input-group-addon">时间</span>
              <input class="form-control" id="datestart4" type="text" style="width:120px" readonly value="<?php  echo date('Y-m-d')?>"/>
              <span class="input-group-addon">至</span>
              <input class="form-control" id="dateend4" style="width:120px" type="text" readonly value="<?php  echo date('Y-m-d')?>"/>
              <span class="input-group-addon"></span> </div>
            <input type="button" class="btn btn-info" style="line-height:26px;" onClick="jfgetdata()" value="搜索"/>
           	 <?php  if($user['permission']>1) { ?>
            <input type="button" class="btn btn-danger" style="line-height:26px;" onClick="jf_explort()" value="导出"/>
            <?php  } ?>
		   </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                
				   <th>会员名称</th>
				  <th>部门</th>
				  <th>会员卡号</th>
                  <th>兑换数量</th>
				  <th>消耗积分</th>

                  <th>时间</th>
                  <th>状态</th>
         
                
                </tr>
              </thead>
              <tbody id="jf_listbox">
              </tbody>
              <tr>
                <td colspan="8" align="center" id="jfgetdata"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
	  
	  
	  
	  
	  
	  
	  
    </div>
  </div>
</div>
<iframe src="" id="print_iframe" name="print_iframe" style="width:1px; height:1px;"></iframe>
<div class="modal fade" id="modal_memberrecharge" tabindex="-1" role="dialog" aria-hidden="true">
  <form method="post" id="form_memberrecharge" onSubmit="return false;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        会员卡充值<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
         <div class="form-group">
         	<label class="col-xs-12 col-sm-3 col-md-2 control-label">卡号</label>
            <div class="col-sm-9">
            	<input type="text" id="recharge_cardno" class="form-control"/>
            </div>
            <div class="help-block"></div>
         </div>
         <div class="form-group">
         	<label class="col-xs-12 col-sm-3 col-md-2 control-label">充值金额</label>
            <div class="col-sm-9">
            	<div class="input-group"><input type="text" id="recharge_totalfee" class="form-control"/><span class="input-group-addon" onClick="$('#recharge_totalfee').JKeyboard({'type':0,'tips':'请输入充值金额'});"><i class="fa fa-keyboard-o"></i></span></div>
             <div>&nbsp;</div>
            </div>
            <div class="help-block"></div>
         </div>
         <div class="form-group">
         	<label class="col-xs-12 col-sm-3 col-md-2 control-label">支付方式</label>
            <div class="col-sm-9 form-inline">
            <input type="hidden" id="recharge_paytype" value="0" class="form-control" />
            <ul class="radio">
            	<li class="checked">现金支付</li><li>银行卡</li><li>微信</li><li>支付宝</li>
            </ul>
            </div>
            <div class="help-block"></div>
         </div>
         <div class="form-group" id="recharge_other">
         	<label class="col-xs-12 col-sm-3 col-md-2 control-label">银行卡后四位</label>
            <div class="col-sm-9">
            <div class="input-group"><input type="text" id="recharge_code" class="form-control"/><span class="input-group-addon" onClick="$('#recharge_code').JKeyboard({'type':0});"><i class="fa fa-keyboard-o"></i></span></div>
            <div>&nbsp;</div>
            </div>
            <div class="help-block"></div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary" id="newcard_submitbtn" onClick="return recharge_submit();">充值</button>
      </div>
    </div>
  </div>
  </form>
</div>
<script type="text/javascript">
var keyCodeAry1=[96,97,98,99,100,101,102,103,104,105,110];
var keyCodeAry2=["0","1","2","3","4","5","6","7","8","9","."];
var keyCodeAry=[];
var isPaying=false;
var printNum=parseInt("<?php  echo $shop['printnum'];?>");
var needtable=parseInt("<?php  echo $cfg['needtable']?>");
var uniacid="<?php  echo $_W['uniacid'];?>";
var siteroot="<?php  echo $_W['siteroot'];?>";
for(i=0;i<keyCodeAry1.length;i++){
	keyCodeAry[keyCodeAry1[i]]=keyCodeAry2[i];
}
$(document).ready(function(e){
	$("#fullscreen").click();
	if($(document).width()<1100){
		location.href='<?php  echo $this->createMobileUrl(index,array("small"=>1,"op"=>"login"))?>';
	}
    var _dh=$(document).height()>=$(window).height() ? $(document).height():$(window).height();
	var _wh=$(window).height();
	_h=_wh>=_dh ? _wh :_dh;
	$(".body_left").css('height',(_h-50)+"px");
	getCounterRecord();
	$('#datestart').datetimepicker({minView:'month',format:'yyyy-mm-dd',autoclose:true,todayBtn:true});
	$('#dateend').datetimepicker({minView:'month',format:'yyyy-mm-dd',autoclose:true,todayBtn:true});
	$('#datestart2').datetimepicker({minView:'month',format:'yyyy-mm-dd',autoclose:true,todayBtn:true});
	$('#dateend2').datetimepicker({minView:'month',format:'yyyy-mm-dd',autoclose:true,todayBtn:true});
	
	
	$('#datestart4').datetimepicker({minView:'month',format:'yyyy-mm-dd',autoclose:true,todayBtn:true});
	$('#dateend4').datetimepicker({minView:'month',format:'yyyy-mm-dd',autoclose:true,todayBtn:true});

	

});

function logout(){
	if(confirm("确认退出登录？")){
		$.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'logout'))?>","",function(data){
			location.href="<?php  echo $this->createMobileUrl('index',array('op'=>''))?>";
		});
	}
}
function testprint(){
	jetsumpay.printOrder({"printtype":5});
}

$(document).keydown(function(event){
	if (event.keyCode == 8) { 
		if (document.activeElement.type == "text") {
			if (document.activeElement.readOnly == false)
			return true; 
		} 
		return false;
	}
	if($(".showSweetAlert:visible").size() || $(".mainbody:eq(0)").is(":hidden"))return;
	switch(event.keyCode){
		case 96 : case 97 : case 98 : case 99 : case 100 : case 101 : case 102 : case 103 : case 104 : case 105 : case 110 :
			if(isPaying)return;
			Counter(keyCodeAry[event.keyCode]);
			$("#paybtn").focus();
		break;
		case 81://q
		case 109://-
			checkCard();
		break;
		case 111://0
			refundorder();
		break;
		case 27://0
			$("#fee").val(0);
		break;
	}
});
function extendFun(id){
	$(".mainbody").eq(id).show().siblings().hide();
	$(".body_left_menu li").eq(id).addClass("jlabel").siblings().removeClass("jlabel");
	if(id>0)
	{
		$(".mainbody").eq(id).find("input[type='button']").eq(0).click();
	}
	
}
$("#j_counter_btn input").on('click',function(){
	var vTecla=$(this).val();
	Counter(vTecla);
});
function payall(){
	var temp=parseFloat($("#fee").val());
	if(temp*100==0){
		swal("请输入金额");
		return;
	}
	if(needtable && arguments.length==0){
		swal({ 
			title: "请输入原订单号/台号", 
			type: "input",
			html:true,
			showLoaderOnConfirm: true,
			showCancelButton: true,   
			closeOnConfirm: false,
			confirmButtonText: "确认",
			cancelButtonText: "关闭",
			inputPlaceholder: "可扫描或者手动输入" 
			}, function(inputValue){
				payall(inputValue);
			}
		);
		return;
	}
	var oldtradeno=arguments.length>0 ? arguments[0]: "";
	swal({ 
		title: "刷卡支付",   
		text: "收款金额为<span style='color:#F00'>￥"+temp+"元</span>",   
		type: "input",
		html:true,
		showCancelButton: true,   
		closeOnConfirm: false,
		confirmButtonText: "确认收款",
		cancelButtonText: "关闭",  
		inputPlaceholder: "请扫描客户的付款二维码" 
		}, function(inputValue){
		if (inputValue === false) return false;      
		if (inputValue === "") {
			swal.showInputError("请扫描客户的付款二维码");     
			return false
		}
		swal({title:"请稍后",showConfirmButton:false });
		jetsumpay.payAll({"fee":temp,"password":"","qrcode":inputValue,"old_trade_no":oldtradeno,"success":function(ordsn){
			swal("收款成功");
			if(printNum)jetsumpay.printOrder({"printtype":0,"ordersn":ordsn});
			$("#fee").val(0);
			jetsumpay.paySuccess({"out_trade_no":ordsn,"success":function(){
				getCounterRecord();
			}});
		}})
	});
}
function paymember(){
	var temp=parseFloat($("#fee").val());
	if(temp*100==0){
		swal("请输入金额");
		return;
	}
	if(arguments.length==0){
		swal({ 
			title: "请输入会员卡号",
			type: "input",
			html:true,
			showLoaderOnConfirm: true,
			showCancelButton: true,   
			closeOnConfirm: false,
			confirmButtonText: "确认",
			cancelButtonText: "关闭",
			inputPlaceholder: "请输入会员卡号" 
			}, function(inputValue){
				if(inputValue.length==0)return;
				paymember(inputValue);
			}
		);
		return;
	}
	var memberno="";
	var password="";
	if(arguments.length==1)memberno=arguments[0];
	if(arguments.length==2)password=arguments[1];
	if(!memberno)return;
	swal({title:"请稍后",showConfirmButton:false });
	jetsumpay.getOneMember({"cardno":memberno,"success":function(card){
		jetsumpay.payMember({"fee":temp,"cardno":memberno,"password":password,"success":function(ordersn){
			swal({ 
				title: "请输入支付验证码",
				type: "input",
				html:true,
				showLoaderOnConfirm: true,
				showCancelButton: true,   
				closeOnConfirm: false,
				confirmButtonText: "确认",
				cancelButtonText: "关闭",
				inputPlaceholder: "请输入支付验证码" 
				}, function(inputValue){
					if(inputValue.length==0)return;
					paymember_paycode(ordersn,inputValue);
				}
			);
		}});
	}});
}
function paymember_paycode(ordersn,paycode){
	jetsumpay.payMemberPaycode({"ordersn":ordersn,"paycode":paycode,"success":function(result){
		if(result.success){
			swal("收款成功");
			if(printNum)jetsumpay.printOrder({"printtype":0,"ordersn":ordersn});
			$("#fee").val(0);
			jetsumpay.paySuccess({"out_trade_no":ordersn,"success":function(){
				getCounterRecord();
			}});
		}else{
			swal({ 
				title: "请输入支付验证码",
				type: "input",
				html:true,
				showLoaderOnConfirm: true,
				showCancelButton: true,   
				closeOnConfirm: false,
				confirmButtonText: "确认",
				cancelButtonText: "关闭",
				inputPlaceholder: "请输入支付验证码" 
				}, function(inputValue){
					if(inputValue.length==0)return;
					paymember_paycode(ordersn,inputValue);
				}
			);
		}
		
	}});
}
function getCounterRecord(){
	jetsumpay.getUserCount({"success":function(feedback){
		$("#wechat_cash span").text("￥"+(feedback.fee1));
		$("#ali_cash span").text("￥"+(feedback.fee2));
		$("#wechat_card span").text(feedback.num);
		if($("#j_getrecord").size()==0)return;
		$("#j_getrecord").empty();
		var record =feedback.item
		for(i in record){
			var paytype=parseInt(record[i]['paytype']);
			var payImg='<img src="<?php echo MODULE_URL;?>template/img/pay_0.png" height="21"/>';
			if(paytype==1){
				payImg='<img src="<?php echo MODULE_URL;?>template/img/pay_1.png" height="21"/>';
			}else if(paytype==4){
				payImg='<img src="<?php echo MODULE_URL;?>template/img/pay_4.png" height="21"/>';
			}
			var temp='<tr><td scope="row"><span class="label label-info">'+record[i]['out_trade_no']+'</span><br><span style="font-size:11px;">'+record[i]['createdate']+" "+record[i]['createtime']+'</span></td><td>'+payImg+' '+(record[i]['attach']=='-' || record[i]['attach']=='PC' ? '<span class="label label-info"><i class="fa fa-desktop"/></i></span>':'<span class="label label-danger"><i class="fa fa-mobile"/></i></span>')+'</td><td>'+record[i]['total_fee']+'</td><td>'+record[i]['cash_fee']+'</td><td>';
			
			temp+='<span style="cursor:pointer" onclick="recheckpay(\''+record[i]['out_trade_no']+'\')">';
			temp+=parseInt(record[i]['status']) ? parseInt(record[i]['status'])==1 ? '<span class="label label-success"><i class="fa fa-check"></i></span>' : '<span class="label label-danger"><i class="fa fa-recycle"></i></span>': '<span class="label label-danger pointer" onclick="doubleCheckpay(\''+record[i]['paytype']+'\','+record[i]['out_trade_no']+')"><i class="fa fa-times"></i></span>';
			temp+='</span>';
			if(parseInt(record[i]['status'])){
				temp+=parseInt(record[i]['isprint']) ? '' : ' <a href="javascript:reprint(\''+record[i]["out_trade_no"]+'\')"><i class="fa fa-print"></i></a>';
			}
			temp+='</td></tr>';
			$("#j_getrecord").append(temp);
		}
	}});
}

function checkCard(){
	swal({   
		title: "卡券核销查询<img src='../addons/j_money/template/img/bank.png' onload='showCounter()'/>",   
		text: "请扫描或者输入卡券的编码",   
		type: "input",
		html:true,
		showLoaderOnConfirm: true,
		showCancelButton: true,   
		closeOnConfirm: false,
		confirmButtonText: "确认核销",
		cancelButtonText: "关闭",  
		inputPlaceholder: "请扫描或者输入卡券的编码" 
		}, function(inputValue){
		$('.sweet-counter-box').addClass("hide");
		if (inputValue === false) {
			return false;
		}
		if (inputValue === "") {
			swal.showInputError("请扫描或者输入卡券的编码");
			$('.sweet-counter-box').removeClass("hide");
			return false
		}
		swal({title:"查询中",text: "卡券查询中",showConfirmButton: false});
		jetsumpay.checkCard({"code":inputValue,"success":function(coupon){
			jconfirm({"title":"卡券核销","text":"<div class='cardbox'>卡券类型:"+coupon['typestr']+"<br>优惠<span>:"+coupon['msg']+"</span><br>是否使用此卡券?</div>","success":function(){
				swal({title:"处理中",text: "卡券查询中",showConfirmButton: false});
				jetsumpay.cardConsume({"cardid":inputValue,"success":function(coupon2){
					swal("核销成功");
					if(printNum)jetsumpay.printOrder({"printtype":1,"ordersn":coupon2['id']});
				}});
			}});
		}});
	});
}
function refundorder(){
	swal({   
		title: "退款申请",   
		text: "请扫描或者输入客户的退款码",   
		type: "input",
		html:true,
		showCancelButton: true,
		closeOnConfirm: false,
		confirmButtonText: "确认退款",
		cancelButtonText: "关闭",  
		inputPlaceholder: "请扫描或者输入客户的退款码" 
		}, function(inputValue){
			if (inputValue === false)return false;
			if (inputValue === "") {
				swal.showInputError("请扫描或者输入客户的退款码");     
				return false
			}
			swal({title:"处理中",showConfirmButton:false});

			jetsumpay.getRefund({"ordersn":inputValue,"success":function(status){
				if(status){
					swal("退款成功");
				}else{
					swal({title:"等待财务处理退款",text:"请通知财务退款",showConfirmButton:false});
				}
			}});
		}
	);
}
function reprint(ordersn){
	jconfirm({"title":"确认重打印订单?","text":"","success":function(){
		jetsumpay.printOrder({"printtype":0,"ordersn":ordersn});
	}});
}
function reprintcharge(ordersn){
	jconfirm({"title":"确认重打印?","text":"","success":function(){
		jetsumpay.printOrder({"printtype":2,"ordersn":ordersn});
	}});
}
//---//
function history_search(){
	var _keyword=$('#keyword').val();
	var _ds=parseInt($('#datestart').val().split("-").join(""));
	var _de=parseInt($('#dateend').val().split("-").join(""));
	if(_de<_ds){
		swal("结束时间不能小于开始时间");
		return;
	}
	_ds=$('#datestart').val();
	_de=$('#dateend').val();
	jetsumpay.getOrder({"keyword":_keyword,'ds':_ds,'de':_de,'success':function(data){
		var result=eval("("+data+")");
		if(result.success){
			var list=result.list;
			var userlist=result.userlist;
			$("#history_listbox").empty();
			for(i in list){
				var status=parseInt(list[i].status);
				var paytype=parseInt(list[i].paytype);
				var temp='<tr><td><span class="label label-info">'+list[i].out_trade_no+'</span></td>'
				temp+='</td>';
				temp+='<td>'+list[i].order_fee;
				/*添加服务类型*/
				if(list[i].servertype!="")
				{
					temp+='<br>'+list[i].servertype;
				}
				if(list[i].carnumber!="")
				{
					temp+='<br>车牌号：'+list[i].carnumber;
				}
				if(list[i].userbak!="")
				{
					temp+='<br>备注：'+list[i].userbak;
				}
				temp+='</td>'
				
				temp+='<td>'+list[i].discount_fee+'</td>';
				temp+='<td>'+list[i].total_fee+'</td>';
				
				/*手续费*/
				temp+='<td>'+list[i].servermoney+'</td>';
				
				temp+='<td>'+list[i].cash_fee+'</td>';
				temp+='<td><small>'+list[i].time+'</small><br><span class="label label-info">'+userlist[list[i].userid]+'</span></td>';
				temp+='<td>';
				if(paytype==0){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_0.png" width="21"/>';
				}else if(paytype==1){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_1.png" width="21"/>';
				}else {
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_4.png" width="21"/>';
				}
				temp+=' ';
				if(status==0){
					temp+='<span class="label label-danger"><i class="fa fa-times"/></i></span>';
				}else if(status==1){
					temp+='<span class="label label-success"><i class="fa fa-check"/></i></span>';
				}else {
					temp+='<span class="label label-danger"><i class="fa fa-recycle"/></i></span>';
				}
				temp+='</td>';
				temp+='<td>'+list[i].isprint+'</td>';
				temp+='<td style="text-align:right"><a href="javascript:recheckpay('+list[i].out_trade_no+')" class="btn btn-danger"><i class="fa fa-refresh"></i></a> <a href="javascript:reprint('+list[i].out_trade_no+')" class="btn btn-info"><i class="fa fa-print"></i></a> ';
				temp+='</td></tr>';
				$("#history_listbox").append(temp);
			}
			var pindex=parseInt(result.pindex);
			var pageall=parseInt(result.allpage);
			temp='';
			if(pindex==1){
				temp+='<button type="button" class="btn btn-default" disabled>上一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="history_page('+(pindex-1)+')">上一页</button >';
			}
			temp+=' <button type="button" class="btn btn-default">'+pindex+' / '+ pageall +'</button> ';
			if(pindex>=pageall){
				temp+='<button type="button" class="btn btn-default" disabled>下一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="history_page('+(pindex+1)+')">下一页</button>';
			}
			$("#history_page").html(temp);
		}
	}});
}
function history_page(num){
	var _keyword=$('#keyword').val();
	var _ds=$('#datestart').val();
	var _de=$('#dateend').val();
	var _page=num;
	jetsumpay.getOrder({"keyword":_keyword,'ds':_ds,'de':_de,'page':_page,'success':function(data){
		var result=eval("("+data+")");
		if(result.success){
			var list=result.list;
			var userlist=result.userlist;
			$("#history_listbox").empty();
			for(i in list){
				var status=parseInt(list[i].status);
				var paytype=parseInt(list[i].paytype);
				var temp='<tr><td><span class="label label-info">'+list[i].out_trade_no+'</span></td>'
				temp+='</td>';
				/*temp+='<td>'+list[i].order_fee+'</td>';*/
				
				temp+='<td>'+list[i].order_fee;
				/*添加服务类型*/
				if(list[i].servertype!="")
				{
					temp+='<br>'+list[i].servertype;
				}
				if(list[i].carnumber!="")
				{
					temp+='<br>车牌号：'+list[i].carnumber;
				}
				if(list[i].userbak!="")
				{
					temp+='<br>备注：'+list[i].userbak;
				}
				temp+='</td>'
				
				
				temp+='<td>'+list[i].discount_fee+'</td>';
				temp+='<td>'+list[i].total_fee+'</td>';
				
				/*手续费*/
				temp+='<td>'+list[i].servermoney+'</td>';
				
				temp+='<td>'+list[i].cash_fee+'</td>';
				temp+='<td><small>'+list[i].time+'</small><br><span class="label label-info">'+userlist[list[i].userid]+'</span></td>';
				temp+='<td>';
				if(paytype==0){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_0.png" width="21"/>';
				}else if(paytype==1){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_1.png" width="21"/>';
				}else {
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_4.png" width="21"/>';
				}
				temp+=' ';
				if(status==0){
					temp+='<span class="label label-danger"><i class="fa fa-times"/></i></span>';
				}else if(status==1){
					temp+='<span class="label label-success"><i class="fa fa-check"/></i></span>';
				}else {
					temp+='<span class="label label-danger"><i class="fa fa-recycle"/></i></span>';
				}
				temp+='</td>';
				temp+='<td>'+list[i].isprint+'</td>';
				temp+='<td style="text-align:right"><a href="javascript:recheckpay('+list[i].out_trade_no+')" class="btn btn-danger"><i class="fa fa-refresh"></i></a> <a href="javascript:reprint('+list[i].out_trade_no+')" class="btn btn-info"><i class="fa fa-print"></i></a> ';
				temp+='</td></tr>';
				$("#history_listbox").append(temp);
			}
			var pindex=parseInt(result.pindex);
			var pageall=parseInt(result.allpage);
			temp='';
			if(pindex==1){
				temp+='<button type="button" class="btn btn-default" disabled>上一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="history_page('+(pindex-1)+')">上一页</button>';
			}
			temp+=' <button type="button" class="btn btn-default">'+pindex+' / '+ pageall +'</button> ';
			if(pindex>=pageall){
				temp+='<button type="button" class="btn btn-default" disabled>下一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="history_page('+(pindex+1)+')">下一页</button>';
			}
			$("#history_page").html(temp);
		}
	}});
}
function history_explort(){
	var _keyword=$('#keyword').val();
	var _ds=parseInt($('#datestart').val().split("-").join(""));
	var _de=parseInt($('#dateend').val().split("-").join(""));
	if(_de<_ds){swal("结束时间不能小于开始时间");return;}
	_ds=$('#datestart').val();
	_de=$('#dateend').val();
	jetsumpay.orderExplode({"keyword":_keyword,'ds':_ds,'de':_de});
}
function recheckpay(ordersn){
	jetsumpay.reCheckPay({"out_trade_no":ordersn,"success":function(result){
		swal("支付成功");
		if(result.isnew){
			jetsumpay.paySuccess({"out_trade_no":result.out_trade_no});
		}
	}});
}
//---//
function member_search(){
	
	var _keyword=$('#mkeyword').val();
	jetsumpay.getMember({"keyword":_keyword,'success':function(data){
		var result=eval("("+data+")");
		if(result.success){
			var list=result.list;
			var userlist=result.userlist;
			$("#member_listbox").empty();
			for(i in list){
				var temp='';
				temp+='<tr><td>'+list[i].wxcardno+'</td>';
				temp+='<td><img src="'+list[i].headimgurl+'" height="40" onerror="this.src=\'<?php echo MODULE_URL;?>template/img/heading.jpg\'"/></td>';
				temp+='<td><p>'+list[i].realname+'</p><span class="label label-info">'+list[i].mobile+'</span></td>';
				temp+='<td>'+(parseFloat(list[i].cash)*0.01).toFixed(2)+'</td>';
				temp+='<td>'+list[i].creadit+'</td>';
				temp+='<td>'+(parseInt(list[i].status) ? '<span class="label label-success"><i class="fa fa-check"/></i></span>' : '<span class="label label-danger">未启用</span>')+'</td>';
				temp+='<td style="text-align:right">';
				temp+='</td></tr>';
				$("#member_listbox").append(temp);
			}
			var pindex=parseInt(result.pindex);
			var pageall=parseInt(result.allpage);
			temp='';
			if(pindex==1){
				temp+='<button type="button" class="btn btn-default" disabled>上一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="member_page('+(pindex-1)+')">上一页</button >';
			}
			temp+=' <button type="button" class="btn btn-default">'+pindex+' / '+ pageall +'</button> ';
			if(pindex>=pageall){
				temp+='<button type="button" class="btn btn-default" disabled>下一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="member_page('+(pindex+1)+')">下一页</button>';
			}
			$("#member_page").html(temp);
		}
	}});
}
function member_page(num){
	var _keyword=$('#keyword').val();
	var _page=num;
	jetsumpay.getMember({"keyword":_keyword,'page':_page,'success':function(data){
		var result=eval("("+data+")");
		if(result.success){
			var list=result.list;
			var userlist=result.userlist;
			$("#member_listbox").empty();
			for(i in list){
				var temp='';
				temp+='<tr><td>'+list[i].wxcardno+'</td>';
				temp+='<td><img src="'+list[i].headimgurl+'" height="40" onerror="this.src=\'<?php echo MODULE_URL;?>template/img/heading.jpg\'"/></td>';
				temp+='<td><p>'+list[i].realname+'</p><span class="label label-info">'+list[i].mobile+'</span></td>';
				temp+='<td>'+(parseFloat(list[i].cash)*0.01).toFixed(2)+'</td>';
				temp+='<td>'+list[i].creadit+'</td>';
				temp+='<td>'+(parseInt(list[i].status) ? '<span class="label label-success"><i class="fa fa-check"/></i></span>' : '<span class="label label-danger">未启用</span>')+'</td>';
				temp+='<td style="text-align:right">';
				
				temp+='</td></tr>';
				$("#member_listbox").append(temp);
			}
			var pindex=parseInt(result.pindex);
			var pageall=parseInt(result.allpage);
			temp='';
			if(pindex==1){
				temp+='<button type="button" class="btn btn-default" disabled>上一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="member_page('+(pindex-1)+')">上一页</button>';
			}
			temp+=' <button type="button" class="btn btn-default">'+pindex+' / '+ pageall +'</button> ';
			if(pindex>=pageall){
				temp+='<button type="button" class="btn btn-default" disabled>下一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="member_page('+(pindex+1)+')">下一页</button>';
			}
			$("#member_page").html(temp);
		}
	}});
}
//---//
function membercharge(){
	$('#modal_memberrecharge').modal("show").on('shown.bs.modal', function (e) {
	$("#recharge_other").hide();
	$("#form_memberrecharge .radio li").bind('click',function(){
		if($(this).hasClass('checked'))return;
		$(this).siblings().removeClass('checked').end().addClass('checked');
		switch($(this).index()){
			case 0:
				$("#recharge_other label").text("");
				$("#recharge_other").hide();
			break;
			case 1:
				$("#recharge_other label").text("银行卡后四位数字");
				$("#recharge_other").show();
				$("#recharge_code").focus();
			break;
			case 2:
				$("#recharge_other label").text("微信付款码");
				$("#recharge_other").show();
				$("#recharge_code").focus();
			break;
			case 3:
				$("#recharge_other label").text("支付宝付款码");
				$("#recharge_other").show();
				$("#recharge_code").focus();
			break;
		}
		$('#recharge_code').val('');
		$('#recharge_paytype').val($(this).index());
	})
  }).on('hide.bs.modal', function (e) {
	$("#recharge_other").hide();
	$("#form_memberrecharge .radio li").unbind('click');
	$('#recharge_cardno,#recharge_totalfee,#recharge_code').val('');
	$("#form_memberrecharge .radio li").removeClass("checked").eq(0).addClass("checked");
	$('#recharge_paytype').val('0');
  });
}
function recharge_submit(){
	var _cardno=$("#recharge_cardno").val();
	var _fee=$("#recharge_totalfee").val();
	var _paytype=parseInt($("#recharge_paytype").val());
	var _code=$("#recharge_code").val();
	if(_cardno.length<5){
		swal('请填写卡号');
		return false;
	}
	if(parseInt(_fee)<1){
		swal('充值金额必须为大于1的整数');
		return false;
	}
	if(_paytype>0 && _code.length<1){
		swal("请输入相关内容");
		return false;
	}
	jetsumpay.rechargeCard({"cardno":_cardno,"fee":_fee,"paytype":_paytype,"code":_code,
		'success':function(data){
			var result=eval("("+data+")");
			jetsumpay.printOrder({"printtype":2,"out_trade_no":result.ordersn});
			$('#modal_memberrecharge').modal("hide");
			swal({
				title:"充值成功￥"+_fee+"元",
				text:"账户余额：￥<b class='red'>"+(parseInt(result.item.cash)*0.01).toFixed(2)+"</b>元",
				html:true,
			});
		}
	});
	return false;
}


var jf_p=1;
var jf_status=0;
function jfgetdata(p)
{
	jf_p=parseInt(p)+jf_p;
	jf_p=isNaN(jf_p)?1:jf_p;
	var _ds=parseInt($('#datestart4').val().split("-").join(""));
	var _de=parseInt($('#dateend4').val().split("-").join(""));
	if(_de<_ds){
		swal("结束时间不能小于开始时间");
		return;
	}
	_ds=$('#datestart4').val();
	_de=$('#dateend4').val();
	$.post("<?php  echo $this->createMobileUrl('cexchange',array('op'=>'list'))?>",{'shopid':<?php  echo $shop['id'];?>,'ds':_ds,'de':_de,'page':jf_p},function(result){
	
		if(result.success){
			var list=result.list;
			var userlist=result.userlist;
			var temp="";
			var status=0;
			$("#jf_listbox").empty();
			for(i in list){
				status=parseInt(list[i].status);
				temp+='<tr><td><span >'+list[i].id+'</span></td>'
				temp+='</td>';
				temp+='<td>'+list[i].user+'</td>';
				temp+='<td>'+list[i].bumen+'</td>';
				temp+='<td><span >'+list[i].cardId+'</span></td>';
				
				temp+='<td><span >'+list[i].num+'</span></td>';
				
				temp+='<td><span >'+list[i].credit+'</span></td>';
				
				temp+='<td><small>'+list[i].time+'</small></td>';
				temp+='<td>';
				if(status==0){
					temp+='<span class="label label-danger">兑换失败</span><br><span class="label label-danger">'+list[i].mes+' </span>';
				}else if(status==1){
					temp+='<span class="label label-success">兑换成功</span>';
				}
				temp+='</td></tr>';
			}
			$("#jf_listbox").html(temp);
			jf_status++;
			var pindex=parseInt(result.pindex);
			var pageall=parseInt(result.allpage);
		
			if( pageall>1)
			{
				temp='';
				if(pindex==1){
					temp+='<button type="button" class="btn btn-default" disabled>上一页</button>';
				}else{
					temp+='<button type="button" class="btn btn-default" onClick="jfgetdata(-1)">上一页</button >';
				}
				temp+=' <button type="button" class="btn btn-default">'+pindex+' / '+ pageall +'</button> ';
				if(pindex>=pageall){
					temp+='<button type="button" class="btn btn-default" disabled>下一页</button>';
				}else{
					temp+='<button type="button" class="btn btn-default" onClick="jfgetdata(+1)">下一页</button>';
				}
				
				$("#jfgetdata").html(temp);
			}
		 } },"json");

}


function  jf_explort()
{
	var _ds=parseInt($('#datestart4').val().split("-").join(""));
	var _de=parseInt($('#dateend4').val().split("-").join(""));
	if(_de<_ds)
	{	swal("结束时间不能小于开始时间");
		return ;
	}
	_ds=$('#datestart4').val();
	_de=$('#dateend4').val();
	
	window.open("<?php  echo $this->createMobileUrl('cexchange_daochu');?>&ds="+_ds+"&de="+_de);
}



function charge_search(){
	var _keyword=$('#charge_keyword').val();
	var _ds=parseInt($('#datestart2').val().split("-").join(""));
	var _de=parseInt($('#dateend2').val().split("-").join(""));
	if(_de<_ds){
		swal("结束时间不能小于开始时间");
		return;
	}
	_ds=$('#datestart2').val();
	_de=$('#dateend2').val();
	jetsumpay.getChargeOrder({"keyword":_keyword,'ds':_ds,'de':_de,'success':function(data){
		var result=eval("("+data+")");
		if(result.success){
			var list=result.list;
			var userlist=result.userlist;
			$("#charge_listbox").empty();
			for(i in list){
				var status=parseInt(list[i].status);
				var paytype=parseInt(list[i].paytype);
				var temp='<tr><td><span class="label label-info">'+list[i].out_trade_no+'</span></td>'
				temp+='</td>';
				temp+='<td>'+list[i].fee+'</td>';
				temp+='<td>';
				if(paytype==0){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_2.png" width="21"/>';
				}else if(paytype==1){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_3.png" width="21"/>';
				}else if(paytype==2){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_0.png" width="21"/>';
				}else {
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_1.png" width="21"/>';
				}
				temp+='</td>';
				temp+='<td><span class="label label-info">'+list[i].cardno+'</span></td>';
				temp+='<td><small>'+list[i].time+'</small><br><span class="label label-primary">'+list[i].username+'</span></td>';
				temp+='<td>';
				if(status==0){
					temp+='<span class="label label-danger"><i class="fa fa-times"/></i></span>';
				}else if(status==1){
					temp+='<span class="label label-success"><i class="fa fa-check"/></i></span>';
				}
				temp+='</td>';
				temp+='<td>'+list[i].isprint+'</td>';
				
				temp+='<td style="text-align:right">';
				if(paytype>1)temp+='<a href="javascript:recheckchargepay('+list[i].out_trade_no+')" class="btn btn-danger"><i class="fa fa-refresh"></i></a> ';
				temp+='<a href="javascript:reprintcharge('+list[i].out_trade_no+')" class="btn btn-info"><i class="fa fa-print"></i></a> ';
				temp+='</td></tr>';
				$("#charge_listbox").append(temp);
			}
			var pindex=parseInt(result.pindex);
			var pageall=parseInt(result.allpage);
			temp='';
			if(pindex==1){
				temp+='<button type="button" class="btn btn-default" disabled>上一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="charge_page('+(pindex-1)+')">上一页</button >';
			}
			temp+=' <button type="button" class="btn btn-default">'+pindex+' / '+ pageall +'</button> ';
			if(pindex>=pageall){
				temp+='<button type="button" class="btn btn-default" disabled>下一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="charge_page('+(pindex+1)+')">下一页</button>';
			}
			$("#charge_page").html(temp);
		}
	}});
}
function charge_page(num){
	var _keyword=$('#charge_keyword').val();
	var _ds=$('#datestart2').val();
	var _de=$('#dateend2').val();
	var _page=num;
	jetsumpay.getChargeOrder({"keyword":_keyword,'ds':_ds,'de':_de,'page':_page,'success':function(data){
		var result=eval("("+data+")");
		if(result.success){
			var list=result.list;
			var userlist=result.userlist;
			$("#charge_listbox").empty();
			for(i in list){
				var status=parseInt(list[i].status);
				var paytype=parseInt(list[i].paytype);
				var temp='<tr><td><span class="label label-info">'+list[i].out_trade_no+'</span></td>'
				temp+='</td>';
				temp+='<td>'+list[i].fee+'</td>';
				temp+='<td><small>'+list[i].time+'</small><br><span class="label label-info">'+list[i].username+'</span></td>';
				temp+='<td>';
				if(paytype==0){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_2.png" width="21"/>';
				}else if(paytype==1){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_3.png" width="21"/>';
				}else if(paytype==2){
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_0.png" width="21"/>';
				}else {
					temp+='<img src="<?php echo MODULE_URL;?>template/img/pay_1.png" width="21"/>';
				}
				temp+=' ';
				if(status==0){
					temp+='<span class="label label-danger"><i class="fa fa-times"/></i></span>';
				}else if(status==1){
					temp+='<span class="label label-success"><i class="fa fa-check"/></i></span>';
				}
				temp+='</td>';
				temp+='<td style="text-align:right"><a href="javascript:recheckchargepay('+list[i].out_trade_no+')" class="btn btn-danger"><i class="fa fa-refresh"></i></a> <a href="javascript:reprintcharge('+list[i].out_trade_no+')" class="btn btn-info"><i class="fa fa-print"></i></a> ';
				temp+='</td></tr>';
				$("#charge_listbox").append(temp);
			}
			var pindex=parseInt(result.pindex);
			var pageall=parseInt(result.allpage);
			temp='';
			if(pindex==1){
				temp+='<button type="button" class="btn btn-default" disabled>上一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="charge_page('+(pindex-1)+')">上一页</button>';
			}
			temp+=' <button type="button" class="btn btn-default">'+pindex+' / '+ pageall +'</button> ';
			if(pindex>=pageall){
				temp+='<button type="button" class="btn btn-default" disabled>下一页</button>';
			}else{
				temp+='<button type="button" class="btn btn-default" onClick="charge_page('+(pindex+1)+')">下一页</button>';
			}
			$("#charge_page").html(temp);
		}
	}});
}
function charge_explort(){
	var _keyword=$('#charge_keyword').val();
	var _ds=parseInt($('#datestart2').val().split("-").join(""));
	var _de=parseInt($('#dateend2').val().split("-").join(""));
	if(_de<_ds){swal("结束时间不能小于开始时间");return;}
	_ds=$('#datestart2').val();
	_de=$('#dateend2').val();
	jetsumpay.orderExplode({"keyword":_keyword,'ds':_ds,'de':_de,'op':1});
}
function reCheckCharge(ordersn){
	jetsumpay.reCheckCharge({"out_trade_no":ordersn,"success":function(result){
		swal("支付成功");
	}});
}
</script>
<?php  } ?> 

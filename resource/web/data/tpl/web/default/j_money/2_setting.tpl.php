<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?> 
<script>
require(['bootstrap.switch', 'util'], function($, u){
	$(function(){
		$('.make-switch').bootstrapSwitch();
	});
});
</script>
<div class="main">
  <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
    <div class="panel panel-default">
      <div class="panel-heading">参数设置</div>
      <div class="panel-body" >
        <ul class="nav nav-tabs" role="tablist">
          <li><a href="#tab0" data-toggle="tab">系统设置</a></li>
          <li class="active"><a href="#tab1" data-toggle="tab">基本内容</a></li>
          <li><a href="#tab2" data-toggle="tab">退款</a></li>
          <li><a href="#tab3" data-toggle="tab">微支付参数</a></li>
          <li><a href="#tab4" data-toggle="tab">支付宝参数</a></li>
          <!-- <li><a href="#tab10" data-toggle="tab">刷卡配置</a></li> -->
          <li><a href="#tab5" data-toggle="tab">积分会员设置</a></li>
          <li><a href="#tab6" data-toggle="tab">其他</a></li>
          <li><a href="#tab7" data-toggle="tab">系统对接</a></li>
          <li><a href="#tab8" data-toggle="tab">软件更新</a></li>
		      <li><a href="#tab9" data-toggle="tab">会员接口</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane" id="tab0">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">调试开关</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="debug" value="0" <?php  if($item['debug'] == 0) { ?> checked<?php  } ?> />
                  关闭</label>
                <label class="radio-inline">
                  <input type="radio" name="debug" value="1" <?php  if($item['debug'] == 1) { ?> checked<?php  } ?> />
                  开启</label>
                <div class="help-block">用于调试各项内容。请勿自行开启。</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">最大店铺</label>
              <div class="col-sm-9 form-inline">
                <input type="number" name="groupnum" value="<?php  echo intval($settings['groupnum'])?>" class="form-control"/>
                <div class="help-block">限制该账户最多的店铺数量。0为不限制。本内容仅网主可见</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">最大人员数</label>
              <div class="col-sm-9 form-inline">
                <input type="number" name="usernum" value="<?php  echo intval($settings['usernum'])?>" class="form-control"/>
                <div class="help-block">限制该账户最多的收银员数量。0为不限制。本内容仅网主可见</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">手机端版权</label>
              <div class="col-sm-9">
                <input type="text" name="copyright" value="<?php  echo $settings['copyright'];?>" class="form-control"/>
              </div>
            </div>
          </div>
          <div class="tab-pane active" id="tab1">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">登录页背景图</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('bg', $settings['bg']);?>
                <div class="help-block">收银登陆页背景1980*1280px</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">LOGO</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('logo', $settings['logo']);?>
                <div class="help-block">收银界面LOGO139*46px</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号二维码</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('qrcode', $settings['qrcode']);?>
                <div class="help-block">大小300*300px。用于关注使用</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">电脑登陆方式</label>
              <div class="col-sm-9 form-inline">
                <label class="radio-inline">
                  <input type="radio" name="login_pc_type" value="0" <?php  if($settings['login_pc_type'] == 0 || empty($settings['login_pc_type'])) { ?>checked<?php  } ?> />
                  账号密码</label>
                <label class="radio-inline">
                  <input type="radio" name="login_pc_type" value="1" <?php  if($settings['login_pc_type'] == 1) { ?>checked<?php  } ?> />
                  扫描二维码</label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">登陆有效期</label>
              <div class="col-sm-9 form-inline">
                <div class="input-group">
                  <input type="number" class='form-control' style="width:80px" name='cookiehold' value='<?php echo intval($settings["cookiehold"]) ? intval($settings["cookiehold"]) : 8?>'/>
                  <span class="input-group-addon">小时</span></div>
                <div class="help-block">收银员登陆后，多长时间内有效。建议按实际情况修改</div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab2">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">退款模板ID</label>
              <div class="col-sm-9">
                <input type="text" name="tempid2" value="<?php  echo $settings['tempid2'];?>" class="form-control"/>
                <div class="help-block">编号:【TM00431】，名称【退款申请通知】，行业【IT科技-互联网|电子商务】 </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">退款管理员</label>
              <div class="col-sm-9">
                <input type="text" name="refunder" value="<?php  echo $settings['refunder'];?>" style=" width:250px;" class="form-control"/>
                <div class="help-block">请在粉丝列表中，填写OPENID。仅1人。退款信息及操作将发送给此人确认。</div>
              </div>
            </div>
			
			 <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">订单退款有效期</label>
              <div class="col-sm-6">
                <div class="input-group">
                	<span class="input-group-addon">多少</span>
                 	 <input type="text" class='form-control' name='refunderlongtime' value="<?php  echo $settings['refunderlongtime'];?>"/>
                 	 <span class="input-group-addon">小时</span>
				  </div>
                <div class="help-block">订单再多少个小时内允许退款（默认不限制）</div>
              </div>
            </div>
			
			
			
			
          </div>
          <div class="tab-pane" id="tab3">
            <div class="form-group" >
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId</label>
              <div class="col-sm-9">
                <input type="text" name="appid" value="<?php  echo $settings['appid'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">子商户AppId</label>
              <div class="col-sm-9">
                <input type="text" name="sub_appid" value="<?php  echo $settings['sub_appid'];?>" class="form-control"/>
                <div class="help-block">如果您是服务商，请在这里填写子商户的appid。如果不是服务商，请勿填写！</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
              <div class="col-sm-9">
                <input type="text" name="appsecret" value="<?php  echo $settings['appsecret'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户名称</label>
              <div class="col-sm-9 ">
                <input type="text" value="<?php  echo $settings['pay_name'];?>" class="form-control" name="pay_name">
                <div class="help-block">商户名称,不能多于6个中文字</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户号</label>
              <div class="col-sm-9">
                <input type="text" value="<?php  echo $settings['pay_mchid'];?>" class="form-control" name="pay_mchid">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">子商户商户号</label>
              <div class="col-sm-9">
                <input type="text" name="sub_mch_id" value="<?php  echo $settings['sub_mch_id'];?>" class="form-control"/>
                <div class="help-block">如果您是服务商，请在这里填写子商户的商户号。如果不是服务商，请勿填写！</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户密钥</label>
              <div class="col-sm-9">
                <input type="text" value="<?php  echo $settings['pay_signkey'];?>" class="form-control" name="pay_signkey">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">IP</label>
              <div class="col-sm-9">
                <input type="text" value="<?php  echo $settings['pay_ip'];?>" class="form-control" name="pay_ip">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">扫码回调地址</label>
              <div class="col-sm-9">
                <input type="text" value="<?php  echo $settings['notify_url'];?>" class="form-control" name="notify_url">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户证书</label>
              <div class="col-sm-9">
                <button type="button" class="btn btn-default" onClick="$('#apiclient_cert').click()"><?php  if($settings['apiclient_cert']) { ?>已上传-点击修改<?php  } else { ?>请上传apiclient_cert.pem<?php  } ?></button>
                <input type="hidden" name="apiclient_cert2" value="<?php  echo $settings['apiclient_cert'];?>"/>
                apiclient_cert.pem
                <input type="file" name="apiclient_cert" value="<?php  echo $settings['apiclient_cert'];?>" id="apiclient_cert" style="display:none;">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户证书</label>
              <div class="col-sm-9">
                <button type="button" class="btn btn-default" onClick="$('#apiclient_key').click()"><?php  if($settings['apiclient_key']) { ?>已上传-点击修改<?php  } else { ?>请上传apiclient_key.pem<?php  } ?></button>
                <input type="hidden" name="apiclient_key2" value="<?php  echo $settings['apiclient_key'];?>"/>
                apiclient_key.pem
                <input type="file" name="apiclient_key" id="apiclient_key" style="display:none;">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab4">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">app_id</label>
              <div class="col-sm-9">
                <input type="text" name="app_id" value="<?php  echo $settings['app_id'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">sys_service_provider_id</label>
              <div class="col-sm-9">
                <input type="text" name="sys_service_provider_id" value="<?php  echo $settings['sys_service_provider_id'];?>" class="form-control"/>
              </div>
            </div>
             <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">app_auth_token</label>
              <div class="col-sm-9">
                <input type="text" name="app_auth_token" value="<?php  echo $settings['app_auth_token'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付宝网关</label>
              <div class="col-sm-9">
                <input type="text" name="gatewayUrl" value="<?php echo $settings['gatewayUrl'] ? $settings['gatewayUrl'] : ''?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">appAuthToken</label>
              <div class="col-sm-9">
                <input type="text" name="appauthtoken" value="<?php  echo $settings['appauthtoken'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付宝公匙</label>
              <div class="col-sm-9">
                <textarea name="alipay_key" class="form-control" id="alipay_key"><?php  echo $settings['alipay_key'];?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">服务器私匙</label>
              <div class="col-sm-9">
                <textarea name="alipay_cert" class="form-control" id="alipay_cert"><?php  echo $settings['alipay_cert'];?></textarea>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab5">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分类型</label>
              <div class="col-sm-9 form-inline">
                <div class="input-group"> <span class="input-group-addon">人民币1分钱</span> <span class="input-group-addon">获得</span>
                  <input type="text" class='form-control' name='creadit' value='<?php echo $settings["creadit"] ? $settings["creadit"] : 0?>'/>
                  <span class="input-group-addon">积分</span> </div>
                <div class="help-block">客户付款后，获得收银小票，小票。</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分加密</label>
              <div class="col-sm-9 form-inline">
                <input type="text" class='form-control' name='encryptcode' maxlength="8" value='<?php  echo $settings["encryptcode"];?>'/>
                <div class="help-block">请填写不多于8位数字/英文/符号，必须填写！</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">全局会员卡</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' name='wxcardid' value='<?php  echo $settings["wxcardid"];?>'/>
                <div class="help-block">全局会员卡，即店铺的会员卡不填写的前提下，此会员卡将能在全部店铺中使用。包括余额、充值等</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费记录地址</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' readonly="readonly" value='<?php  echo $_W["siteroot"];?>app/index.php?i=<?php  echo $_W["uniacid"];?>&c=entry&do=memberhistory&m=j_money'/>
                <div class="help-block">会员消费记录查看地址，客户使用</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡支付码</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' name='paycodetempmsg' value='<?php  echo $settings["paycodetempmsg"];?>'/>
                <div class="help-block">会员卡支付码，使用模板消息【验证码下发通知】</div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分获得后按钮</label>
              <div class="col-sm-9 form-inline">
                <input type="text" class='form-control' name='creditbtn' value='<?php  echo $settings["creditbtn"];?>'/>
                <div class="help-block">客户扫码获得积分后，按钮连接的地址</div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab6">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">微信卡券</label>
              <div class="col-sm-9 col-xs-12">
                <div id="wxcard"> <?php  $wxcard=json_decode($settings['wxcard'],true)?>
                  <?php  $i=0?>
                  <?php  if(count($wxcard)) { ?>
                  <?php  if(is_array($wxcard)) { foreach($wxcard as $index => $row) { ?>
                  <div>
                    <label wxold='<?php  echo $i?>' class='form-inline' >
                      <input class='form-control' name='wxcard-key[<?php  echo $i?>]' required value='<?php  echo $index;?>' placeholder='字段名'/>
                      :
                      <input class='form-control' name='wxcard-val[<?php  echo $i?>]' required value='<?php  echo $row;?>' placeholder='卡券ID'/>
                      <a href="javascript:delwxo('<?php  echo $i?>')"><i class='glyphicon glyphicon-remove-circle'></i></a></label>
                  </div>
                  <?php  $i++?>
                  <?php  } } ?>
                  <?php  } ?> </div>
                <a href="javascript:addwxcard()"><i class="icon-plus-sign-alt"></i> 添加</a>
                <div class="help-block">请先到【粉丝营销】-【微信卡券】中生成微信卡券，然后填写卡券中的【卡券id】。<a href="./index.php?c=wechat&a=account" target="_blank">添加卡券</a></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">模板消息ID</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="tempid" class="form-control" value="<?php  echo $settings['tempid'];?>" />
                <div class="help-block">建议OPENTM200444326【订单付款成功通知】，用于针对公众号老粉丝交互超48小时时，通知客户</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">模板消息详情</label>
              <div class="col-sm-9 col-xs-12">
                <textarea name="tempcontent" id="tempcontent" class="form-control" rows="6"><?php  echo $settings['tempcontent'];?></textarea>
                <button type="button" class="btn btn-primary" onClick="resolve(1)">解析模板内容</button>
                <div class="help-block">可用标签|#单号#|,|#时间#|,|#总金额#|,|#优惠金额#|,|#实付金额#|,|#支付方式#|,|#优惠#|</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>参数</label>
              <div class="col-sm-9 col-xs-12">
                <div id="parama"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">模板消息链接</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="tempurl" class="form-control" value="<?php  echo $settings['tempurl'];?>" />
                <div class="help-block">客户点击模板消息后，跳转的链接。</div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab7">
          	<div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">码上点餐</label>
              <div class="col-sm-9 form-inline">
              <?php  $weisrc_dish= pdo_fetchcolumn("SELECT count(*) FROM ".tablename("modules")." WHERE `name`='weisrc_dish' ")?>
              <?php  if($weisrc_dish>0) { ?>
              <?php  $alist=pdo_fetchall("SELECT id,title FROM ".tablename("weisrc_dish_stores")." WHERE weid=:a order by id asc ", array(':a' => $_W['uniacid']));?>
                <?php  $moduleshop=json_decode($settings['moduleshop'],true)?>
                
                <?php  if(is_array($alist)) { foreach($alist as $row) { ?>
                <input value="<?php  echo $row['title'];?>" class="form-control" readonly />
                对应
                <select name="module_b[<?php  echo $row['id'];?>]" class="form-control">
                	<option value="0">选择店铺</option>
                    <?php  if(is_array($blist)) { foreach($blist as $row2) { ?>
                    <option value="<?php  echo $row2['id'];?>" <?php  if($moduleshop['weisrc_dish'][$row['id']==$row2['id']]) { ?> selected<?php  } ?>><?php  echo $row2['companyname'];?></option>
                    <?php  } } ?>
                </select>
                <?php  } } ?>
                <?php  } else { ?>
                没有可以对接的模块
                <?php  } ?>
                
                <div class="help-block"></div>
              </div>
            </div>
            
          </div>
          <div class="tab-pane" id="tab8">
          	<div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">收银软件</label>
              <div class="col-sm-9">
                <button type="button" class="btn btn-default" onClick="$('#soft_update').click()"><?php  if($settings['soft_update']) { ?><?php  echo $settings['soft_update'];?><?php  } else { ?>上传文件<?php  } ?></button>
                <input type="hidden" name="soft_update2" value="<?php  echo $settings['soft_update'];?>"/>
                <input type="file" name="soft_update" value="<?php  echo $settings['soft_update'];?>" id="soft_update" style="display:none;">
                <div class="help-block">必须是zip格式的压缩包！</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印控件</label>
              <div class="col-sm-9">
                <button type="button" class="btn btn-default" onClick="$('#print_update').click()"><?php  if($settings['print_update']) { ?><?php  echo $settings['print_update'];?><?php  } else { ?>上传文件<?php  } ?></button>
                <input type="hidden" name="print_update2" value="<?php  echo $settings['print_update'];?>"/>
                <input type="file" name="print_update" value="<?php  echo $settings['print_update'];?>" id="print_update" style="display:none;">
                <div class="help-block">必须是zip格式的压缩包！</div>
              </div>
            </div>
          </div>
		  
		   <!---->
		    <div class="tab-pane" id="tab9">
		    	  <div class="form-group">
	              <label class="col-xs-12 col-sm-3 col-md-2 control-label">接口访问地址</label>
	              <div class="col-sm-9 col-xs-12">
	                <input type="text" name="memberApi[url]" class="form-control" value="<?php  echo $settings['memberApi']['url'];?>" />
	                <div class="help-block">接口访问的基础地址</div>
	              </div>
	            </div>
				
				 <div class="form-group">
	              <label class="col-xs-12 col-sm-3 col-md-2 control-label">账户名称</label>
	              <div class="col-sm-9 col-xs-12">
	                <input type="text" name="memberApi[username]" class="form-control" value="<?php  echo $settings['memberApi']['username'];?>" />
	                <div class="help-block">接口的账户名称</div>
	              </div>
	            </div>
				
				 <div class="form-group">
	              <label class="col-xs-12 col-sm-3 col-md-2 control-label">账户密码</label>
	              <div class="col-sm-9 col-xs-12">
	                <input type="text" name="memberApi[password]" class="form-control" value="<?php  echo $settings['memberApi']['password'];?>" />
	                <div class="help-block">接口的账户密码</div>
	              </div>
	            </div>
				
				
				
			</div>	
		  <!---->

		  <div class="tab-pane" id="tab10">
      		   <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启POS机刷卡功能</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="card_pay_switch" value="0" <?php  if($settings['card_pay_switch'] == 0) { ?> checked<?php  } ?> />
                  关闭</label>
                <label class="radio-inline">
                  <input type="radio" name="card_pay_switch" value="1" <?php  if($settings['card_pay_switch'] == 1) { ?> checked<?php  } ?> />
                  开启</label>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启POS机会员功能</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="pos_member_switch" value="0" <?php  if($settings['pos_member_switch'] == 0) { ?> checked<?php  } ?> />
                  关闭</label>
                <label class="radio-inline">
                  <input type="radio" name="pos_member_switch" value="1" <?php  if($settings['pos_member_switch'] == 1) { ?> checked<?php  } ?> />
                  开启</label>
              </div>
            </div>
		  </div>
        </div>
        
       </div>
      </div>
    </div>
    <div class="form-group col-sm-12">
      <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
  </form>
</div>
<script>
var j=0;
function addwxcard(){
	var temp="<div><label wx='"+j+"' class='form-inline'><input class='form-control' name='wxcard-key-new["+j+"]' required placeholder='字段名'/>:<input class='form-control' name='wxcard-val-new["+j+"]' required placeholder='卡券ID'/> <a href='javascript:delwx("+j+")'><i class='glyphicon glyphicon-remove-circle'></i></a></label></div>";
	$("#wxcard").append(temp);
	j++;
}
function delwx(obj){
	$("label[wx='"+obj+"']").remove();
}
function delwxo(obj){
	$("label[wxold='"+obj+"']").remove();
}
//----
i=0;
resolve();
function resolve(){
	var isnew=0;
	if(arguments.length>0){
		isnew=1;
	}
	msg=$("#tempcontent").val() ? $("#tempcontent").val():$("#tempcontent").html();
	if(msg=='undefined' || msg=="" || msg.length<10)return;
	var test = /\{\{.*?\.(DATA)\}\}/gi;
	var result = [];
	var img ;
	$("#parama").empty();
	while(img = test.exec(msg)){
		temp=img[0].replace(" ","").replace("{{","").replace(".DATA}}","");
		addparama(temp,isnew);
	}
}
function addparama(){
	var tempstr='<?php  echo $settings["tempparama"]?>';
	var odata;
	var hh;
	if(tempstr.length>10 && arguments[1]==0){
		odata=eval("("+tempstr+")");
	}
	key=arguments[0]!=""?arguments[0]:"";
	val=typeof(odata)!="undefined" ? odata[key]['value'] : "";
	color=typeof(odata)!="undefined" ? odata[key]['color'] : "";
	var temp="<div><label class='form-inline'><input class='form-control' readonly name='parama-key["+i+"]' value='"+key+"' placeholder='键'/> : <input class='form-control' name='parama-val["+i+"]' value='"+val+"' placeholder='值'/>  : <input class='form-control' class='tcolor' name='parama-color["+i+"]' placeholder='颜色' value='"+color+"'/> </label></div>";
	$("#parama").append(temp);
	setcolor($('input[name="parama-color['+i+']"]'));
	i++;
}
function setcolor(elm){
	require(['jquery', 'util'], function($, util){
		$(function(){
			util.colorpicker(elm, function(color){
				elm.val(color);
			});
		});
	});
}
</script> 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
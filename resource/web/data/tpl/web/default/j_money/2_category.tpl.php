<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('group', array('op' => 'post'))?>">添加店铺</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('group', array('op' => 'display'))?>">管理店铺</a></li>
</ul>
<script>
require(['bootstrap'],function($){
	$('.btn').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script> 
<?php  if($operation == 'post') { ?>
<div class="main">
  <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $id?>" />
    <div class="panel panel-default">
      <div class="panel-heading"> 店铺管理 </div>
      <div class="panel-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#tab1" data-toggle="tab">基本内容</a></li>
          <li><a href="#tab2" data-toggle="tab">退款</a></li>
          <li><a href="#tab3" data-toggle="tab">微支付参数</a></li>
          <li><a href="#tab4" data-toggle="tab">支付宝参数</a></li>
          <li><a href="#tab5" data-toggle="tab">打印参数</a></li>
          <li><a href="#tab6" data-toggle="tab">积分会员设置</a></li>
          <li><a href="#tab8" data-toggle="tab">POS机设置</a></li>
          <li><a href="#tab7" data-toggle="tab">其他</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab1">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">店铺名称</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="companyname" class="form-control" value="<?php  echo $category['companyname'];?>" />
                <div class="help-block"></div>
              </div>
            </div>


            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">转账支付地址</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="transferUrl" class="form-control" value="<?php  echo $category['transferUrl'];?>" />
                <div class="help-block"></div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付成功后跳转地址</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="successUrl" class="form-control" value="<?php  echo $category['successUrl'];?>" />
                <div class="help-block"></div>
              </div>
            </div>


            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费额度</label>
              <div class="col-sm-6 col-xs-12">
                <div class="input-group"> 
                  <span class="input-group-addon">单日消费</span>
                  <input type="text" name="freelimit" class="form-control" value="<?php  echo $category['freelimit'];?>" />
                  <span class="input-group-addon">元，以下免服务费</span>
                </div> 	
                <div class="help-block">单日消费多少元以下免服务费</div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">服务费</label>
              <div class="col-sm-6 col-xs-12">
                <div class="input-group"> 
                  <span class="input-group-addon">超出部分按照</span>
                  <input type="text" name="servermoney" class="form-control" value="<?php  echo $category['servermoney'];?>" />
                  <span class="input-group-addon">千分之几，收取服务费</span>
                </div> 	
                <div class="help-block"></div>
              </div>
            </div>


            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">服务类型配置</label>
              <div class="col-sm-6 col-xs-12">
                <div class="input-group"> 
                  <span class="input-group-addon">保养维修</span>

                  <span class="input-group-addon"><input type="radio" name="serverTypes[0]"  <?php  if(empty($serverTypes['0'])) { ?>checked<?php  } ?>    value="0">可选</span>
                  <span class="input-group-addon"><input type="radio" name="serverTypes[0]" <?php  if(!empty($serverTypes['0'])) { ?>checked<?php  } ?> value="1">必填</span>
                </div> 
                <br>
                <div class="input-group"> 
                  <span class="input-group-addon">新车定金</span>

                  <span class="input-group-addon"><input type="radio" name="serverTypes[1]" <?php  if(empty($serverTypes['1'])) { ?>checked<?php  } ?> value="0">可选</span>
                  <span class="input-group-addon"><input type="radio" name="serverTypes[1]" <?php  if(!empty($serverTypes['1'])) { ?>checked<?php  } ?> value="1">必填</span>
                </div> 	
                <br>
                <div class="input-group"> 
                  <span class="input-group-addon">保险续保</span>

                  <span class="input-group-addon"><input type="radio" name="serverTypes[2]" <?php  if(empty($serverTypes['2'])) { ?>checked<?php  } ?> value="0">可选</span>
                  <span class="input-group-addon"><input type="radio" name="serverTypes[2]" <?php  if(!empty($serverTypes['2'])) { ?>checked<?php  } ?> value="1">必填</span>
                </div> 	
                <br>
                <div class="input-group"> 
                  <span class="input-group-addon">其他服务</span>

                  <span class="input-group-addon"><input type="radio" name="serverTypes[3]" <?php  if(empty($serverTypes['3'])) { ?>checked<?php  } ?> value="0">可选</span>
                  <span class="input-group-addon"><input type="radio" name="serverTypes[3]" <?php  if(!empty($serverTypes['3'])) { ?>checked<?php  } ?> value="1">必填</span>
                </div> 	

                <div class="help-block"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="description" class="form-control" value="<?php  echo $category['description'];?>" />
                <div class="help-block"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">登录页背景图</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('bg', $category['bg']);?>
                <div class="help-block">收银登陆页背景1980*1280px</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">LOGO</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('logo', $category['logo']);?>
                <div class="help-block">收银界面LOGO139*46px</div>
              </div>
            </div>
          </div>




          <div class="tab-pane" id="tab2">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">退款管理员</label>
              <div class="col-sm-9">
                <input type="text" name="refunder" value="<?php  echo $category['refunder'];?>" style=" width:250px;" class="form-control"/>
                <div class="help-block">当收款员是财务时，则自动退款成功。请在粉丝列表中，填写OPENID。仅1人。退款信息及操作将发送给此人确认。</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">退款模板消息</label>
              <div class="col-sm-9">
                <input type="text" name="tempid2" value="<?php  echo $category['tempid2'];?>" class="form-control"/>
                <div class="help-block">退款模板消息，编号:【TM00431】，名称【退款申请通知】，行业【IT科技-互联网|电子商务】</div>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="tab3">
            <div class="form-group" >
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId</label>
              <div class="col-sm-9">
                <input type="text" name="appid" value="<?php  echo $category['appid'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">子商户AppId</label>
              <div class="col-sm-9">
                <input type="text" name="sub_appid" value="<?php  echo $category['sub_appid'];?>" class="form-control"/>
                <div class="help-block">如果您是服务商，请在这里填写子商户的appid。如果不是服务商，请勿填写！</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
              <div class="col-sm-9">
                <input type="text" name="appsecret" value="<?php  echo $category['appsecret'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户名称</label>
              <div class="col-sm-9 ">
                <input type="text" value="<?php  echo $category['pay_name'];?>" class="form-control" name="pay_name">
                <div class="help-block">商户名称,不能多于6个中文字</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户号</label>
              <div class="col-sm-9">
                <input type="text" value="<?php  echo $category['pay_mchid'];?>" class="form-control" name="pay_mchid">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">子商户商户号</label>
              <div class="col-sm-9">
                <input type="text" name="sub_mch_id" value="<?php  echo $category['sub_mch_id'];?>" class="form-control"/>
                <div class="help-block">如果您是服务商，请在这里填写子商户的商户号。如果不是服务商，请勿填写！</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户密钥</label>
              <div class="col-sm-9">
                <input type="text" value="<?php  echo $category['pay_signkey'];?>" class="form-control" name="pay_signkey">
              </div>
            </div>
            
           <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号支付</label>
              <div class="col-sm-9">
                <input type="checkbox" <?php  if($category['apipay']==1) { ?> checked='checked' <?php  } ?>  name="apipay" />
                 <div class="help-block">如果不勾选，则使用扫码付</div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户证书</label>
              <div class="col-sm-9 form-inline">
                <input type="file" name="apiclient_cert" id="apiclient_cert" class="form-control" <?php  if($category['apiclient_cert']) { ?> style="display:none"<?php  } ?>/>
                <?php  if($category['apiclient_cert']) { ?>
                <button type="button" class="btn btn-default" onClick="$('#apiclient_cert').click()"><?php  echo $category['apiclient_cert'];?>——点击修改</button>
                <?php  } else { ?>请上传apiclient_cert.pem<?php  } ?>
                <input type="hidden" name="apiclient_cert2" value="<?php  echo $category['apiclient_cert'];?>"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">商户证书</label>
              <div class="col-sm-9 form-inline">
                <input type="file" name="apiclient_key" id="apiclient_key" class="form-control" <?php  if($category['apiclient_key']) { ?> style="display:none"<?php  } ?>/>
                <?php  if($category['apiclient_key']) { ?>
                <button type="button" class="btn btn-default" onClick="$('#apiclient_key').click()"><?php  echo $category['apiclient_key'];?>——点击修改</button>
                <?php  } else { ?>请上传apiclient_key.pem<?php  } ?>
                <input type="hidden" name="apiclient_key2" value="<?php  echo $category['apiclient_key'];?>"/>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="tab4">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">app_id</label>
              <div class="col-sm-9">
                <input type="text" name="app_id" value="<?php  echo $category['app_id'];?>" class="form-control"/>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">sys_service_provider_id</label>
              <div class="col-sm-9">
                <input type="text" name="sys_service_provider_id" value="<?php  echo $category['sys_service_provider_id'];?>" class="form-control"/>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">app_auth_token</label>
              <div class="col-sm-9">
                <input type="text" name="app_auth_token" value="<?php  echo $settings['app_auth_token'];?>" class="form-control"/>
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">appAuthToken</label>
              <div class="col-sm-9">
                <input type="text" name="appauthtoken" value="<?php  echo $category['appauthtoken'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">口碑门店ID</label>
              <div class="col-sm-9">
                <input type="text" name="alipay_store_id" value="<?php  echo $category['alipay_store_id'];?>" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付宝公匙</label>
              <div class="col-sm-9">
                <textarea name="alipay_key" class="form-control" id="alipay_key"><?php  echo $category['alipay_key'];?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">服务器私匙</label>
              <div class="col-sm-9">
              	<textarea name="alipay_cert" class="form-control" id="alipay_cert"><?php  echo $category['alipay_cert'];?></textarea>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="tab5">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">小票打印数量</label>
              <div class="col-sm-9 form-inline">
                <input type="number" class='form-control' name='printnum' value='<?php  echo $category["printnum"];?>'/>
                <div class="help-block">收款成功后，收款小票打印数量.最大数量9</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号二维码</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('qrcode', $category['qrcode']);?>
                <div class="help-block">大小300*300px。用于关注使用</div>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="tab6">
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分类型</label>
              <div class="col-sm-9 form-inline">
                <div class="input-group"> <span class="input-group-addon">人民币1分钱</span> <span class="input-group-addon">获得</span>
                  <input type="text" class='form-control' name='creadit' value='<?php echo $category["creadit"] ? $category["creadit"] : 0?>'/>
                  <span class="input-group-addon">积分</span> </div>
                <div class="help-block">支持0.01。</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">积分获得后按钮</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' name='creditbtn' value='<?php  echo $category["creditbtn"];?>'/>
                <div class="help-block">客户扫码获得积分后，按钮连接的地址</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' name='wxcardid' value='<?php  echo $category["wxcardid"];?>'/>
                <div class="help-block"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">转为刷卡</label>
              <div class="col-sm-9">
                <button class="btn btn-info" type="button" onClick="location.href='<?php  echo $this->createWebUrl('group',array('op' => 'updatecard', 'id' => $id))?>'">将会员卡转为刷卡支付</button>
                <div class="help-block"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">余额显示</label>
              <div class="col-sm-9">
                <button class="btn btn-info" type="button" onClick="location.href='<?php  echo $this->createWebUrl('group',array('op' => 'updatecard2', 'id' => $id))?>'">支持余额显示</button>
                <div class="help-block">开通后，不可关闭</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员折扣</label>
              <div class="col-sm-9 form-inline">
                <?php  if(is_array($grouplist)) { foreach($grouplist as $index => $row) { ?>
                  <div class="input-group"> 
                    <span class="input-group-addon"><?php  echo $row['title'];?></span>
                    <input type="text" class='form-control' style="width:60px" name='gid[<?php  echo $index;?>]' value='<?php echo $groupdiscount[$index] ? $groupdiscount[$index] : 1?>'/>
                  <span class="input-group-addon">折</span> 
                  </div>
                <?php  } } ?>
                <div class="help-block">1为不打折，9折0.9</div>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="tab7">
          	

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">消息通知</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' name='infoshow' value='<?php  echo $category["infoshow"];?>'/>
                <div class="help-block"></div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">baner一</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('zfbbaner1', $category['zfbbaner1']);?>
                <div class="help-block">支付宝扫二维码进入页面 banenr图   </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">baner二</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('zfbbaner2', $category['zfbbaner2']);?>
                <div class="help-block">支付宝扫二维码进入页面 banenr图   </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">baner三</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('zfbbaner3', $category['zfbbaner3']);?>
                <div class="help-block">支付宝扫二维码进入页面 banenr图   </div>
              </div>
            </div>




            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">logo图</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('zfblogo', $category['zfblogo']);?>
                <div class="help-block">支付宝扫二维码进入页面 logo图   </div>
              </div>
            </div>


            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' name='logotitle' value='<?php  echo $category["logotitle"];?>'/>
                <div class="help-block">支付宝扫二维码进入页面 logo图 旁边的标题</div>
              </div>
            </div>



            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">小图</label>
              <div class="col-sm-9"> <?php  echo tpl_form_field_image('zfblogox', $category['zfblogox']);?>
                <div class="help-block">支付宝扫二维码进入页面 logo图  右边的小图 </div>
              </div>
            </div>	


            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">说明</label>
              <div class="col-sm-9">
                <input type="text" class='form-control' name='logomes' value='<?php  echo $category["logomes"];?>'/>
                <div class="help-block">支付宝扫二维码进入页面 logo图 旁边的说明</div>
              </div>
            </div>




            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">开启输入台号/单号</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="needtable" value="0" <?php  if($category['needtable'] == 0) { ?> checked<?php  } ?> />
                关闭</label>
                <label class="radio-inline">
                  <input type="radio" name="needtable" value="1" <?php  if($category['needtable'] == 1) { ?> checked<?php  } ?> />
                开启</label>
                <div class="help-block">在收款时，要求输入台号/单号，方便原收银系统或者其他平台在数据上对接</div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
              <div class="col-sm-9 col-xs-12"> <?php  echo tpl_ueditor('info', $category['info']);?>
                <div class="help-block">此内容将显示在网页版的右侧；注意：不要直接从word文档，微信公众号后台及文章中，其他网站网页中直接复制内容。如需要复制，请复制到记事本中，再复制到编辑器中。</div>
              </div>
            </div>
          </div>
          
          <div class="tab-pane" id="tab8">

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">开启POS机刷卡功能</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="serverTypes[4]" value="0" <?php  if(empty($serverTypes['4'])) { ?> checked<?php  } ?> />
                  关闭</label>
                <label class="radio-inline">
                  <input type="radio" name="serverTypes[4]" value="1" <?php  if(!empty($serverTypes['4'])) { ?> checked<?php  } ?> />
                  开启</label>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">开启POS机会员功能</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="serverTypes[5]" value="0" <?php  if(empty($serverTypes['5'])) { ?> checked<?php  } ?> />
                  关闭</label>
                <label class="radio-inline">
                  <input type="radio" name="serverTypes[5]" value="1" <?php  if(!empty($serverTypes['5'])) { ?> checked<?php  } ?> />
                  开启</label>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="form-group col-xs-12">
      <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return checkform();return false" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
  </form>
</div>
<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" method="post" onsubmit="return formcheck(this)">
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>店铺名称</th>
                <th>付款码</th>
				
				
				
                <th>备注</th>
                <th>人员数量</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <?php $url=$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=ayard&m=j_money&shopid=".$row['id']?>
            <tr>
              <td></td>
              <td><?php  echo $row['companyname'];?></td>
              <td>
              <a href="http://qr.liantu.com/api.php?text=<?php  echo urlencode($url)?>" target="_blank"><img src="http://qr.liantu.com/api.php?text=<?php  echo urlencode($url)?>" width="80"/></a>
              
              </td>
			 
			  
              <td><?php  echo $url?></td>
              <td><?php  echo intval($userList[$row['id']])?> 人</td>
              <td style="text-align:right;overflow:visible">
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  功能 <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" style="right:0; left:auto">
                  <li><a href="<?php  echo $this->createWebUrl('group',array('op' => 'post', 'id' => $row['id']))?>" ><i class="fa fa-edit"> </i> 编辑</a></li>
                  <li><a href="<?php  echo $this->createWebUrl('membercard',array('shopid' => $row['id']))?>" ><i class="fa fa-user"> </i> 会员管理</a></li>
                  <li><a href="<?php  echo $this->createWebUrl('history',array('shopid' => $row['id']))?>"><i class="fa fa-file-text-o"></i> 收银记录</a></li>
                  <li><a href="<?php  echo $this->createWebUrl('charge',array('shopid' => $row['id']))?>"><i class="fa fa-file-text-o"></i> 充值记录</a></li>
                  <li><a href="<?php  echo $this->createWebUrl('group',array('op'=>'download','id' => $row['id']))?>"><i class="fa fa-bar-chart-o"></i> 下载对账单</a></li>
                  <li><a href="<?php  echo $this->createWebUrl('group',array('op'=>'printer','shopid' => $row['id']))?>"><i class="fa fa-print"></i> 设置打印机</a></li>
                   <li><a href="<?php  echo $this->createWebUrl('group',array('op'=>'cexchange','shopid' => $row['id']))?>"><i class="glyphicon glyphicon-retweet"></i> 设置积分兑换</a></li>
				  <li class="divider"></li>
                  <li><a href="<?php  echo $this->createWebUrl('group',array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"><i class="fa fa-times"></i> 删除</a></li>
                </ul>
              </div>
              
              </td>
            </tr>
            <?php  } } ?>
            <tr>
              </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<style>
	.ui_tab_contents , .main{ overflow:visible !important;}
	
</style>
<script>
	$(function(){
		$(body).height($(document).height());
	});
</script>

<?php  } else if($operation == 'download') { ?>
<div class="main">
  <div class="category">
    <form action="" method="post" onsubmit="return formcheck(this)">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">&nbsp;</label>
            <div class="col-sm-9 form-inline">
              <?php  echo tpl_form_field_daterange('gametime', array('start' => date('Y-m-d'),'end'=>date('Y-m-d')),false)?>
              <input type="button" name="submit" value="下载" class="btn btn-primary" onclick="downLoad()" />
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="increate" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">下载对账单</h4>
      </div>
      <div class="modal-body">
        <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:0"> <span class="sr-only">0</span> </div>
        </div>
        <div id="icounter" style="text-align:center"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="stratbtn" onclick="dowork()">马上开始</button>
      </div>
    </div>
  </div>
</div>
<script>
function downLoad(){
	var start=parseInt($("input[name='gametime[start]']").val());
	var end=parseInt($("input[name='gametime[end]']").val());
	var startDate = Date.parse(start);
	startDate = startDate / 1000;
	var endDate = Date.parse(end);
	endDate = endDate / 1000;
	var datediff=parseInt((endDate-startDate)/86400);
	if(datediff>30){
		alert("下载账单不能大于30天");
	}
	$("#increate").modal({backdrop:'static',keyboard:false,show:true,})
	//location.href="<?php  echo $this->createWebUrl('group',array('op'=>'dodownload','id'=>$id))?>&date="+$("input[name='date']").val();
}
function dowork(){
	var num;
	var start=$("input[name='gametime[start]']").val();
	var end=$("input[name='gametime[end]']").val();
	var startDate = Date.parse(start);
	startDate = startDate / 1000;
	var endDate = Date.parse(end);
	endDate = endDate / 1000;
	var datediff=parseInt((endDate-startDate)/86400);
	if(arguments.length>0){
		num=arguments[0];
	}else{
		num=0;
	}
	progress=parseInt((num+1)/(datediff+1)*100);
	$(".progress-bar").attr('aria-valuenow',progress);
	$(".progress-bar").css('width',progress+"%");
	if(num>datediff){
		location.href="<?php  echo $this->createWebUrl('group',array('op'=>'dotrade','id'=>$id))?>";
		return;
	}
	target=startDate+86400*num;
	var newDate = new Date();
	newDate.setTime(target * 1000);
	var targetDate=newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate();
	$.getJSON("<?php  echo $this->createWebUrl('group',array('op'=>'dodownload','id'=>$id))?>",{date:targetDate},function(result){
		if(result.success){
			num++;
			dowork(num);
		}
	});
	
}
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li  class="active"><a href="<?php  echo $this->createWebUrl('payapi', array('op' => 'list'));?>">基本设置</a></li>
    <li><a href="<?php  echo $this->createWebUrl('payapi', array('op' => 'alipay'));?>">支付宝设置</a></li>
    <li><a href="<?php  echo $this->createWebUrl('payapi', array('op' => 'wechat'));?>">借用微信支付</a></li>
    <li><a href="<?php  echo $this->createWebUrl('payapi', array('op' => 'service'));?>">微信支付(子商户版)</a></li>
    <!--<li><a href="<?php  echo $this->createWebUrl('payapi', array('op' => 'cmbc'));?>">民生银行</a></li>-->
</ul>
<form action="" method="post" class="form-horizontal form">
    <input type="hidden" value="<?php  echo $settings['id'];?>" name="sid" />
    <div class="main">
        <div class="panel panel-default">
            <div class="panel-heading">
                基本设置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="xq_alipay" class="col-sm-2 control-label">支付宝支付</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="payapi[f2]" value="1" <?php  if($set['f2']['value']==1 ) { ?> checked<?php  } ?> />开启</label>
                        <label class="radio-inline">
                            <input type="radio" name="payapi[f2]" value="0" <?php  if(empty($set['f2']['value']) || $set['f2']['value']==0 ) { ?> checked<?php  } ?> /> 关闭</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <!--<div class="form-group">-->
                    <!--<label for="xq_alipay" class="col-sm-2 control-label">民生银行支付</label>-->
                    <!--<div class="col-sm-10">-->
                        <!--<label class="radio-inline">-->
                            <!--<input type="radio" name="xq_cmbc" value="1" <?php  if($settings['xq_cmbc']==1 ) { ?> checked<?php  } ?> />开启</label>-->
                        <!--<label class="radio-inline">-->
                            <!--<input type="radio" name="xq_cmbc" value="0" <?php  if(empty($settings['xq_cmbc']) || $settings['xq_cmbc']==0 ) { ?> checked<?php  } ?> /> 关闭</label>-->
                        <!--<span class="help-block"></span>-->
                    <!--</div>-->
                <!--</div>-->
                <div class="form-group">
                    <label for="xq_wechat" class="col-sm-2 control-label">借用微信支付</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="payapi[f3]" value="1" id="xq_wechat" <?php  if($set['f3']['value']==1 ) { ?> checked<?php  } ?> />开启</label>
                        <label class="radio-inline">
                            <input type="radio" name="payapi[f3]" value="0" id="xq_wechat" <?php  if(empty($set['f3']['value']) || $set['f3']['value']==0 ) { ?> checked<?php  } ?> /> 关闭</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group" id="xq_wechat_sub">
                    <label for="xq_wechat_sub" class="col-sm-2 control-label">微信支付(子商户版)</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="payapi[f4]" value="1" <?php  if($set['f4']['value']==1 ) { ?> checked<?php  } ?> />开启</label>
                        <label class="radio-inline">
                            <input type="radio" name="payapi[f4]" value="0" <?php  if(empty($set['f4']['value']) || $set['f4']['value']==0 ) { ?> checked<?php  } ?> /> 关闭</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12 help-block">
                        <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
                    </div>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
        </div>
    </div>
    </div>
</form>
<script>
    $(function () {
        $(":input[name='xq_wechat']").click(function () {
            var xq_wechat = $('input[name="xq_wechat"]:checked ').val()
            if (xq_wechat == 1) {
                $("#xq_wechat_sub").hide();
            }
            else {
                $("#xq_wechat_sub").show();
            }
        });
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
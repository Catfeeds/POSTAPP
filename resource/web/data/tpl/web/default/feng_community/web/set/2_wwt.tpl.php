<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>乐信通接口</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">
    <input type="hidden" name="id" value="<?php  echo $settings['id'];?>" />

                <div class="form-group">
                    <label for="account" class="col-sm-2 control-label">用户账户</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s14]" id='account' class="form-control" value="<?php  echo $set['s14']['value'];?>" />
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="pwd" class="col-sm-2 control-label">用户密码</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s15]" id='pwd' class="form-control" value="<?php  echo $set['s15']['value'];?>" />
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="sign" class="col-sm-2 control-label">用户签名</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s16]" id='sign' class="form-control" value="<?php  echo $set['s16']['value'];?>" />
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-w-m btn-primary" name="submit" value="提交">提交</button>
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>

</form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

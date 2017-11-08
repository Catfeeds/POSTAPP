<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>云联接口</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">
    <input type="hidden" name="id" value="<?php  echo $settings['id'];?>" />

                <div class="form-group">
                    <label for="key" class="col-sm-2 control-label">API密钥</label>
                    <div class="col-sm-10">
                        <input type="text" name="print[d8]" id='key' class="form-control" value="<?php  echo $set['d8']['value'];?>" />
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="deviceno" class="col-sm-2 control-label">终端编号</label>
                    <div class="col-sm-10">
                        <input type="text" name="print[d9]" id='deviceno' class="form-control" value="<?php  echo $set['d9']['value'];?>" />
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

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分享设置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">分享标题</label>
                <div class="col-sm-5">
                    <input type="text" name="set[p70]" value="<?php  echo $set['p70']['value'];?>" class="form-control"
                           placeholder="">
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">分享简介</label>
                <div class="col-sm-5">
                    <textarea name="set[p71]" class="form-control" rows="5"><?php  echo $set['p71']['value'];?></textarea>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">分享图标</label>
                <div class="col-sm-5">
                    <?php  echo tpl_form_field_image('set[p72]',$set['p72']['value'])?>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">分享外链</label>
                <div class="col-sm-5">
                    <?php  echo tpl_form_field_link('set[p73]',$set['p73']['value'])?>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-5">
                    <input name="submit" type="submit" value="提交" class="btn btn-w-m btn-primary"/>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                </div>
            </div>

</form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
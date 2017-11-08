<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('system',array('op' => 'display'));?>">数据修复</a></li>
</ul>

<div class="main">
    <form action="" method="post" class="form-horizontal form" id="form">
        <div class="panel panel-default">
            <div class="panel-heading">v8.0版升级v9.0版数据转化(新安装的请勿操作)</div>
            <div class="panel-body">
                <p style="color: red">修复数据主要用于v8升级到v9的时候数据异常，会先清空数据后，重新转化v8数据。可能会一些问题，例如已经发布新的幻灯的话，那就需要重新勾选，已经配置的配置需要重新配置。此操作适合第一次升级的数据出错执行。已经增加新数据不建议执行.一段时间过渡后，会删除此操作。</p>

                <p style="color: blue">修复字段：会修复数据表缺失，数据字段缺失。不影响数据。</p>

            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
                        <!--<input name="update_data" type="submit" value="修复数据" class="btn btn-primary" />&nbsp;&nbsp;-->
                        <input name="update_field" type="submit" value="修复字段" class="btn btn-primary" />
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">菜单修复</div>
            <div class="panel-body">
                <p style="color: red">后台菜单菜单重置，清空后台菜单，重新生成，此操作会影响设置的权限权限。此操作要谨慎执行。</p>
                <p style="color: #00a2d4">前台菜单重置，清空已设置的前台菜单，还原到初始状态，此操作要谨慎执行。</p>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
                        <input name="update_menu" type="submit" value="后台菜单重置" class="btn btn-primary" />&nbsp;&nbsp;
                        <input name="update_nav" type="submit" value="前台菜单重置" class="btn btn-primary" />
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
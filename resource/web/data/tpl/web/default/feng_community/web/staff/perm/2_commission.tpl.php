<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'list'));?>">管理管理员</a>
    </li>
    <li class="active"><a href="#">用户信息</a></li>
    </li>
</ul>
<form action="" class="form-horizontal form" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
    <input type="hidden" name="id" value="<?php  echo $user['id'];?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">用户信息</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-xs-3">
                    <input type='text' name='username' id='username' class="form-control" value="<?php  echo $user['username'];?>" disabled/>
                </div>
            </div>
            <div class="form-group">
                <label for="commission" class="col-sm-2 control-label">平台分成</label>
                <div class="col-xs-3">
                    <input type='text' name='commission' id='commission' class="form-control" value="<?php  echo $user['commission'];?>"/>
                    <span class="help-block">(请输入0到1之间的数字,例如设置0.2 ,平台获取20%的提成)</span>
                </div>
            </div>

            <div class="form-group">
                <label for="commission" class="col-sm-2 control-label">小区分成</label>
                <div class="col-xs-3">
                    <input type='text' name='xqcommission' id='xqcommission' class="form-control" value="<?php  echo $user['xqcommission'];?>"/>
                    <span class="help-block">(请输入0到1之间的数字,例如设置0.1,业主所在的小区获得10%的提成)</span>
                </div>
            </div>
            <div class="form-group">

                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function check(form) {
        if (form['commission'].value >= 1) {
            alert('平台分成最大只能设置1');
            return false;
        }
        if (form['xqcommission'].value >= 1) {
            alert('小区分成最大只能设置1');
            return false;
        }
        var xq = Number(form['commission'].value) + Number(form['xqcommission'].value);
        if (xq >= 1) {
            alert('小区分成和平台分成总和不能超过1');
            return false;
        }

    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
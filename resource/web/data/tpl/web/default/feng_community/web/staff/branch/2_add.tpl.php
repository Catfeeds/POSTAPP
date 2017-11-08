<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'branch','p' => 'list'));?>">部门管理</a>
    </li>
    <li class="active">
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'branch','p' => 'list'));?>">添加部门</a>
    </li>
</ul>
<form action="" class="form-horizontal form" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加部门</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">选择物业</label>
                <div class="col-xs-4">
                    <select name="pid" class="form-control">
                        <option value="">选择物业</option>
                        <?php  if(is_array($properties)) { foreach($properties as $property) { ?>
                        <option value="<?php  echo $property['id'];?>" <?php  if($item['pid'] == $property['id']) { ?>selected='selected'<?php  } ?>><?php  echo $property['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">部门名称</label>
                <div class="col-xs-4">
                    <input type='text' name='title' class="form-control" value="<?php  echo $item['title'];?>" placeHolder="输入部门名称" />
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function check(form) {
        if (!form['pid'].value) {
            alert('请选择物业。');
            return false;
        }
        if (!form['title'].value) {
            alert('请输入部门名称。');
            return false;
        }
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

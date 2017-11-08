<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<script>
    var regionids = "<?php  echo $regionid;?>";
</script>
<script src="<?php echo MODULE_URL;?>template/web/static/js/public.js"></script>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('sysnotice', array('op' => 'list'));?>">管理</a></li>
    <li class="active" ><a href="<?php  echo $this->createWebUrl('sysnotice', array('op' => 'add'));?>">添加公告</a></li>

</ul>
<form action="" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
    <input type="hidden" name="regionid" value="" />
    <div class="panel panel-default">

        <div class="panel-body">


            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-6">
                    <input type="text" name="title" id='title' value="<?php  echo $item['title'];?>" class="form-control" placeHolder="尽量简短，15个字以内" />
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">内容</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('reason',$item['reason']);?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">省市区</label>
                <div class="col-sm-5">
                    <?php  echo tpl_form_field_district('birth',array('province' => $item['province'],'city' => $item['city'],'dist' => $item['dist']))?>
                </div>
            </div>
            <div class="form-group region" <?php  if(!$regs) { ?>style="display: none"<?php  } ?>>
            <label for="" class="col-sm-2 control-label">小区</label>
            <div class="col-sm-10 content">

            </div>
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
<script>
    function check(form){
        if (!form['title'].value) {
            alert('请输入公告标题。');
            return false;
        }
        if (status != 1) {
            if (!form['reason'].value) {
                alert('请输入通知原因。');
                return false;
            }
        };

    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'mail','p' => 'list'));?>">员工管理</a>
    </li>
    <li class="active">
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'mail','p' => 'add'));?>">添加员工</a>
    </li>
</ul>
<form action="" class="form-horizontal form" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加员工</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">姓名<span style="color: red">*</span></label>
                    <div class="col-xs-4">
                        <input type='text' name='realname' class="form-control" value="<?php  echo $item['realname'];?>"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">昵称</label>
                    <div class="col-xs-4">
                        <input type='text' name='nickname' class="form-control" value="<?php  echo $item['nickname'];?>"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">手机号<span style="color: red">*</span></label>
                    <div class="col-xs-4">
                        <input type='text' name='mobile' class="form-control" value="<?php  echo $item['mobile'];?>"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">微信号</label>
                    <div class="col-xs-4">
                        <input type='text' name='wechat' class="form-control" value="<?php  echo $item['wechat'];?>"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">粉丝openid</label>
                    <div class="col-xs-4">
                        <input type='text' name='openid' class="form-control" value="<?php  echo $item['openid'];?>"/>
                        <span class="help-block" style="color:red">需要作为管理接收员，就必须填写openid</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-xs-4">
                        <input type='text' name='mail' class="form-control" value="<?php  echo $item['mail'];?>"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">选择物业<span style="color: red">*</span></label>
                    <div class="col-xs-4">
                        <select name="pid" class="form-control" id="pid">
                            <option value="">选择物业</option>
                            <?php  if(is_array($properties)) { foreach($properties as $property) { ?>
                            <option value="<?php  echo $property['id'];?>" <?php  if($item['pid'] == $property['id']) { ?>selected='selected'<?php  } ?>><?php  echo $property['title'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">选择部门<span style="color: red">*</span></label>
                    <div class="col-xs-4">
                        <select name="departmentid" class="form-control" id="departmentid">
                            <option value="">选择部门</option>
                            <?php  if($departments) { ?>
                            <?php  if(is_array($departments)) { foreach($departments as $department) { ?>
                            <option value="<?php  echo $department['id'];?>" <?php  if($department['id'] == $item['departmentid']) { ?>selected='selected'<?php  } ?>><?php  echo $department['title'];?></option>
                            <?php  } } ?>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">职位</label>
                    <div class="col-xs-4">
                        <input type='text' name='position' class="form-control" value="<?php  echo $item['position'];?>"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">备注</label>
                    <div class="col-xs-4">
                        <textarea name="remark" class="form-control"><?php  echo $item['remark'];?></textarea>
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
    </div>
</form>
<script type="text/javascript">
    function check(form) {
        if (!form['realname'].value) {
            alert('请输入姓名。');
            return false;
        }
        if (!form['mobile'].value) {
            alert('请输入电话。');
            return false;
        }
        if (!form['pid'].value) {
            alert('选择物业。');
            return false;
        }
        if (!form['staffid'].value) {
            alert('选择部门。');
            return false;
        }

    }
    $(function () {
        $("#pid").change(function () {
            var pid = $("#pid option:selected").val();
            $.getJSON("<?php  echo $this->createWebUrl('staff',array('op'=>'mail','p'=> 'change'))?>",{pid:pid},function(data){
                var content ="<option>选择部门</option>";
                for (var o in data) {
                    var departmentid = "<?php  echo $item['departmentid'];?>";
                    if(departmentid == data[o].id){
                        var check = checked;
                    }
                    content +="<option value='"+data[o].id+"'+check+>"+data[o].title+"</option>";
                }
                $('#departmentid').html(content);

            })
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

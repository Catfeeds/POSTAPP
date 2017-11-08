<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<script>
    var regionids = "<?php  echo $regionid;?>";
</script>
<script src="<?php echo MODULE_URL;?>template/web/static/js/public.js"></script>
<ul class="nav nav-tabs">
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'list','uuid' =>$_GPC['uuid']));?>">管理管理员</a>
    </li>
    <li class="active">
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'add','uuid' => $_GPC['uuid']));?>">添加管理员</a>
    </li>
</ul>
<div class="alert alert-warning" role="alert">
    &nbsp;&nbsp;<span style="font-size: 18px;">权限说明</span><br>
    <span><span style="color:red">《超级管理员》</span>：等同于总管理员，拥有所有管理所有小区的权限。设置权限后和总管理员的权限一致</span><br>
    <span><span style="color:red">《普通管理员》</span>：适用于周边商家管理，还有给其他角色发布通知。拥有所有的小区操作权限，但只限于管理自己发布的信息</span><br>
    <span><span style="color:red">《小区管理员》</span>：选择小区管理员后，需绑定小区。管理绑定小区的信息，适合报修，建议等等</span>
</div>
<form action="" class="form-horizontal form" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加管理员</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php  if(empty($id)) { ?>
                <?php  if(empty($user) || $user['xqtype'] == 1) { ?>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">人员类型<span style="color: red">*</span></label>
                    <div class="col-xs-4">

                        <label class="radio-inline">

                            <input type="radio" name="xqtype" id="xqtype1" value="1" <?php  if($item['xqtype'] == 1 || empty($item['xqtype'])) { ?>checked="checked"<?php  } ?>> 物业员工
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="xqtype" id="xqtype2" value="2" <?php  if($item['xqtype'] == 2) { ?>checked="checked"<?php  } ?>> 外部人员
                        </label>

                    </div>
                </div>
                <?php  } ?>
                <div class="form-group"  <?php  if($user['xqtype']==2) { ?>style='display:block'<?php  } else { ?>style="display: none" <?php  } ?>id="company">
                    <label for="" class="col-sm-2 control-label">选择公司<span style="color: red">*</span></label>
                    <div class="col-xs-4">
                        <select name="companyid" class="form-control" id="companyid">
                            <option value="">选择公司</option>
                            <?php  if(is_array($companies)) { foreach($companies as $company) { ?>
                            <option value="<?php  echo $company['id'];?>" <?php  if($item['pid'] == $company['id']) { ?>selected='selected'<?php  } ?>><?php  echo $company['title'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="property" <?php  if($user['xqtype']==1 || empty($user)) { ?>style='display:block'<?php  } else { ?>style="display: none" <?php  } ?>>
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
                <div class="form-group" id="department" <?php  if($user['xqtype']==1 || empty($user)) { ?>style='display:block'<?php  } else { ?>style="display: none" <?php  } ?>>
                    <label for="" class="col-sm-2 control-label">选择部门<span style="color: red">*</span></label>
                    <div class="col-xs-4">
                        <select name="departmentid" class="form-control" id="departmentid">
                            <option>选择部门</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">选择员工<span style="color: red">*</span></label>
                    <div class="col-xs-4">
                        <select name="userid" class="form-control" id="userid">
                            <option value="">选择员工</option>
                        </select>
                    </div>
                </div>
                <?php  } ?>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">登录账号</label>
                    <div class="col-xs-4">
                        <input type='text' class="form-control" disabled id="username" value="<?php  echo $item['username'];?>"/>
                        <input type='hidden' name='username' class="form-control"  value=""  id="_username"/>
                        <input type='hidden' name='staffid' class="form-control"  value=""  id="staffid"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">姓名</label>
                    <div class="col-xs-4">
                        <input type='text' name='realname' class="form-control" disabled id="realname" value="<?php  echo $item['realname'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">登录密码</label>
                    <div class="col-xs-4">
                        <input id="password" name="password" type="password" class="form-control" value="" autocomplete="off" />
                        <span class="help-block">请填写密码，最小长度为 8 个字符</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">确认密码</label>
                    <div class="col-xs-4">
                        <input id="repassword" name="repassword" type="password" class="form-control" value="" autocomplete="off" />
                        <span class="help-block">重复输入密码，确认正确输入</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">状态</label>
                    <div class="col-sm-10 col-lg-9 col-xs-12">
                        <label for="jhstatus" class="radio-inline">
                            <input name="status" type="radio" value="1" id="jhstatus" />禁用
                        </label>
                        <label for="qystatus" class="radio-inline">
                            <input name="status" type="radio" value="2" id="qystatus" checked>启用
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">权限</label>
                    <div class="col-sm-10 col-lg-9 col-xs-12">
                        <?php  if(empty($user) || $user['type'] == 1 ) { ?>
                        <label for="cjtype" class="radio-inline">
                            <input name="type" type="radio" value="1" id="cjtype" <?php  if($item['type'] == 1 || empty($item['type'])) { ?>checked<?php  } ?>/>超级管理员
                        </label>
                        <?php  } ?>
                        <?php  if(empty($user) || $user['type'] == 1 || $user['type'] == 2) { ?>
                        <label for="pytype" class="radio-inline">
                            <input name="type" type="radio" value="2"  id="pytype" <?php  if($item['type'] == 2 || $user['type'] == 2) { ?>checked<?php  } ?>>普通管理员
                        </label>
                        <?php  } ?>

                        <label for="xxqtype" class="radio-inline">
                            <input name="type" type="radio" value="3" id="xxqtype" <?php  if($item['type'] == 3 ) { ?>checked<?php  } ?>>小区管理员
                        </label>

                    </div>
                </div>

                <div class="form-group birth" <?php  if($item['type'] == 3 || $user['type'] == 3) { ?>style="display: block"<?php  } else { ?>style="display: none"<?php  } ?>>
                        <label for="" class="col-sm-2 control-label">省市区</label>
                        <div class="col-sm-5">
                            <?php  echo tpl_form_field_district('birth',array('province' => $province,'city' =>$city,'dist' => $dist))?>
                        </div>
                    </div>
                <div class="form-group region" <?php  if($item['type'] == 3) { ?>style="display: block"<?php  } else { ?>style="display: none"<?php  } ?>>
                    <label for="" class="col-sm-2 control-label">小区</label>
                    <div class="col-sm-10 content">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
                        <input type="hidden" value="<?php  echo $id;?>" name="id">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                    </div>
                </div>
            </div>
        </div>
</form>
<script type="text/javascript">
    function check(form) {

        if (!form['userid'].value) {
            alert('请选择员工。');
            return false;
        }

        if(!form['password'].value){
            alert('请输入密码。');
            return false;
        }

        if(!form['repassword'].value){
            alert('请输入重复密码。');
            return false;
        }
        if(form['repassword'].value != form['password'].value){
            alert('两次密码不正确,请重新输入。');
            return false;
        }

    }
    $(function () {
        $("input[name='type']").click(function(){
            var type = $("input[name='type']:checked").val();
            if(type == 3){
                $(".birth").show();
            }
            if(type ==1 || type == 2){
                $(".birth").hide();
                $(".region").hide();
            }
        })
        $("input[name='xqtype']").click(function(){
            var type = $("input[name='xqtype']:checked").val();
            if(type == 1){
                $("#company").hide();
                $("#property").show();
                $("#department").show();
            }
            if(type == 2){
                $("#property").hide();
                $("#department").hide();
                $("#company").show();
            }
        })
        $("#pid").change(function () {
            var pid = $("#pid option:selected").val();
            $.getJSON("<?php  echo $this->createWebUrl('staff',array('op'=>'mail','p'=> 'change'))?>",{pid:pid},function(data){
                var content ="<option>选择部门</option>";
                for (var o in data) {
                    content +="<option value='"+data[o].id+"'>"+data[o].title+"</option>";
                }
                $('#departmentid').html(content);

            })
        })
        $("#departmentid").change(function () {
            var departmentid = $("#departmentid option:selected").val();
            $.getJSON("<?php  echo $this->createWebUrl('staff',array('op'=>'perm','p'=> 'change','type'=>1))?>",{departmentid:departmentid},function(data){
                var content ="<option>选择员工</option>";
                for (var o in data) {
                    content +="<option value='"+data[o].id+"'>"+data[o].realname+"</option>";
                }
                $('#userid').html(content);

            })
        })
        $("#userid").change(function () {
            var userid = $("#userid option:selected").val();
            $.getJSON("<?php  echo $this->createWebUrl('staff',array('op'=>'perm','p'=> 'user'))?>",{userid:userid},function(data){
                $("#realname").val(data.realname);
                $("#username").val(data.mobile);
                $("#_username").attr("value",data.mobile);
                $("#staffid").attr("value",data.id)

            })
        })
        $("#companyid").change(function () {
            var departmentid = $("#companyid option:selected").val();
            $.getJSON("<?php  echo $this->createWebUrl('staff',array('op'=>'perm','p'=> 'change','type'=>2))?>",{departmentid:departmentid},function(data){
                var content ="<option>选择员工</option>";
                for (var o in data) {
                    content +="<option value='"+data[o].id+"'>"+data[o].realname+"</option>";
                }
                $('#userid').html(content);

            })
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<script>
    var regionids = <?php  echo $regionids;?>;
</script>
<script src="<?php echo MODULE_URL;?>static/js/lib/public.js"></script>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><a class="glyphicon glyphicon-arrow-left" href="<?php  echo $this->createWebUrl('homemaking', array('op' => 'manage'))?>"></a>&nbsp;&nbsp;&nbsp;设置管理</h5>
                </div>
                <div class="ibox-content">
<form action="" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
            <div class="form-group" id="company">
                <label for="" class="col-sm-2 control-label">选择公司<span style="color: red">*</span></label>
                <div class="col-sm-5">
                    <select name="companyid" class="form-control" id="companyid">
                        <option value="">选择公司</option>
                        <?php  if(is_array($companies)) { foreach($companies as $company) { ?>
                        <option value="<?php  echo $company['id'];?>" <?php  if($item['pid'] == $company['id']) { ?>selected='selected'<?php  } ?>><?php  echo $company['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">选择员工<span style="color: red">*</span></label>
                <div class="col-sm-5">
                    <select name="userid" class="form-control" id="userid">
                        <option value="">选择员工</option>
                    </select>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-5">
                    <input type='text' name='realname' class="form-control" disabled id="realname" value="<?php  echo $item['realname'];?>"/>
                    <input type='hidden' name='staffid' class="form-control"  value=""  id="staffid" value="<?php  echo $item['staffid'];?>"/>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">通知方式</label>
                <div class="col-sm-5">
                    <div class="radio radio-success radio-inline">
                        <input type="radio" name="type"  id="type0" value="0" <?php  if(empty($item['type'])) { ?>checked="true" <?php  } ?> />
                        <label for="type0">暂不启用</label>
                    </div>
                    <div class="radio radio-success radio-inline">
                        <input type="radio" name="type"  id="type1" value="1" <?php  if($item['type']==1 ) { ?>checked="true" <?php  } ?> />
                        <label for="type1">模板消息通知</label>
                    </div>
                    <div class="radio radio-success radio-inline">
                        <input type="radio" name="type"  id="type2" value="2" <?php  if($item['type']==2) { ?>checked="true" <?php  } ?> />
                        <label for="type2">短信通知</label>
                    </div>
                    <div class="radio radio-success radio-inline">
                        <input type="radio" name="type"  id="type3" value="3" <?php  if($item['type']==3) { ?>checked="true" <?php  } ?> />
                        <label for="type3">全部通知</label>
                    </div>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="cid" class="col-sm-2 control-label">通知类型</label>
                <div class="col-sm-5">
                    <?php  if(is_array($categories)) { foreach($categories as $k => $category) { ?>
                    <div class="checkbox checkbox-success checkbox-inline">
                        <input type="checkbox" type="checkbox" value="<?php  echo $category['id'];?>" name="cid[]" id="cid_<?php  echo $k;?>" <?php  if(@strstr($cid,$category['id'])) { ?>checked='checked' <?php  } ?>>
                        <label for="cid_<?php  echo $k;?>"> <?php  echo $category['name'];?> </label>
                    </div>
                    <?php  } } ?>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
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
                <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-w-m" name="submit" value="提交">提交</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>

</form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(function () {
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

    })
    $(function () {
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
    $(function () {
        $("#userid").change(function () {
            var userid = $("#userid option:selected").val();
            $.getJSON("<?php  echo $this->createWebUrl('staff',array('op'=>'perm','p'=> 'user'))?>",{userid:userid},function(data){
                $("#realname").val(data.realname);
                $("#staffid").attr("value",data.id)

            })
        })
    })

</script>



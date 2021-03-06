<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>

<ul class="nav nav-tabs">
    <li>
        <a href="<?php  echo $this->createWebUrl('guard', array('op' => 'list','regionid' => $regionid));?>">设备管理</a>
    </li>

    <li <?php  if($op == 'add') { ?>class="active" <?php  } ?>>
    <a href="<?php  echo $this->createWebUrl('guard', array('op' => 'add','regionid' => $regionid));?>"><?php  if($_GPC['id']) { ?>修改设备<?php  } else { ?>新增设备<?php  } ?></a>
    </li>


</ul>
<form action="" class="form-horizontal form" method="post" role="form" enctype="multipart/form-data" onsubmit="return check(this);">
    <input type="hidden" name="id" value="<?php  echo $item['id'];?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">设备信息</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">选择小区</label>
                <div class="col-sm-4">
                    <select name='regionid' class="form-control" id="regionid">
                        <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                        <option value='<?php  echo $region['id'];?>' <?php  if($region['id'] == $item['regionid']) { ?>selected <?php  } ?> > <?php  echo $region['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">区域</label>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input type="radio" name="type" value="2" <?php  if($item['type'] == 2 || empty($item['type'])) { ?>checked<?php  } ?>> 大门
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="type" value="1" <?php  if($item['type'] == 1 ) { ?>checked<?php  } ?>> 单元门
                    </label>
                </div>
            </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">区域名称</label>
                    <div class="col-sm-4">
                        <input type='text' name='title' id='title1' class="form-control" value="<?php  echo $item['title'];?>" placeHolder="请输入区域名称"/>
                        <span class="help-block">例如15栋，南大门等</span>
                    </div>
                </div>
            <div id="s1" <?php  if($item['type'] == 1 ) { ?>style="display: block<?php  } else { ?>style='display:none'<?php  } ?>>
                <div class="form-group">
                    <label for="unit" class="col-sm-2 control-label">单元号</label>
                    <div class="col-sm-5">
                        <input type='text' name='unit' id='unit' class="form-control" value="<?php  echo $item['unit'];?>" placeHolder="请输入单号"/>
                        <span class="help-block">例如1单元</span>
                    </div>
                </div>
            </div>
        <div class="form-group">
            <label for="linkway" class="col-sm-2 control-label">坐标</label>
            <div class="col-sm-5">
                <?php  echo tpl_form_field_coordinate('baidumap', $item)?>
            </div>
        </div>
            <!--<div class="form-group">-->
                <!--<label for="api_key" class="col-sm-2 control-label">api_key</label>-->
                <!--<div class="col-sm-5">-->
                    <!--<input type='text' name='api_key' id='api_key' class="form-control" value="<?php  echo $item['api_key'];?>" placeHolder="请输入api_key"/>-->
                <!--</div>-->
            <!--</div>-->
            <div class="form-group">
                <label for="device_code" class="col-sm-2 control-label">设备编号</label>
                <div class="col-sm-5">
                    <input type='text' name='device_code' id='device_code' class="form-control" value="<?php  echo $item['device_code'];?>" placeHolder="请输入面板上的设备编号"/>
                </div>
            </div>
        <div class="form-group">
            <label for="device_code" class="col-sm-2 control-label">gprs卡号</label>
            <div class="col-sm-5">
                <input type='text' name='device_gprs' id='device_gprs' class="form-control" value="<?php  echo $item['device_gprs'];?>" placeHolder="请输入gprs卡号"/>
            </div>
        </div>
        <div class="form-group">
            <label for="device_code" class="col-sm-2 control-label">外部链接</label>
            <div class="col-sm-5">
                <?php  echo tpl_form_field_link('openurl',$item['openurl'])?>
                <span class="help-block" style="color: red">微信开门后跳转的外部链接</span>
            </div>
        </div>
            <!--<div class="form-group">-->
                <!--<label for="lock_code" class="col-sm-2 control-label">锁编号</label>-->
                <!--<div class="col-sm-5">-->
                    <!--<input type='text' name='lock_code' id='lock_code' class="form-control" value="<?php  echo $item['lock_code'];?>" placeHolder="请输入lock_code"/>-->
                <!--</div>-->
            <!--</div>-->
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </div>
    </div>

</form>
<script type="text/javascript">
    function check(form){
        if (!form['title'].value) {
            alert('请输入区域名称。');
            return false;
        }
//        if (!form['unit'].value) {
//            alert('请输入单元号！');
//            return false;
//        }
//        if (!form['api_key'].value) {
//            alert('请输入api_key！');
//            return false;
//        }
        if (!form['device_code'].value) {
            alert('请输入设备编号！');
            return false;
        }
//        if (!form['lock_code'].value) {
//            alert('请输入锁编号！');
//            return false;
//        }
        return true;
    }
    $(function(){
        $("input[name='type']").click(function(){
            var type = $('input[name="type"]:checked').val();
            if(type == 2){
                $("#s2").show();
                $("#s1").hide();
            }
            if(type == 1){
                $("#s1").show();
                $("#s2").hide();
            }
        })
    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
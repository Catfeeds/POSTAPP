<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('cost', array('op' => 'list'))?>">费用列表</a></li>
    <li class="active"><a href="<?php  echo $this->createWebUrl('cost', array('op' => 'add'))?>">费用导入</a></li>
    <li><a href="<?php  echo $this->createWebUrl('cost', array('op' => 'category'))?>">费用类型</a></li>
</ul>
<div class="panel panel-default">
    <div class="alert alert-info" role="alert">
        导入费用格式案例。费用类型是可变的，模板格式仅供参考。
        <p>(<a href="<?php echo MODULE_URL;?>template/upFile/wuyefei-weixiaoqu.wang.zip" target="_blank" style="font-size:16px;color:red">点击下载上传物业费格式示例</a>)</p>
        <p style="color: red;font-size:16px">注意：姓名、地址、费用总计必须有才能导入成功</p>
    </div>
  <div class="panel-heading">导入费用</div>
  <div class="panel-body">
    <div class="alert alert-info" role="alert">
        默认导入格式:当前小区费用,请按照此格式导入：姓名|手机号码|房号|房屋面积|时间|<span style="color: red">此处自定义费用类型,用|分开</span>|总计|是否缴费,用是代表缴费，否或者默认空代表未缴费。查询已房号为准。。

    </div>
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" onsubmit="return check(this);">

      <div class="form-group">
        <label for="" class="col-sm-2 control-label">小区</label>
        <div class="col-sm-4">
          <select name='regionid' class="form-control" id='regionid'>
            <option value='0'> 请选择小区</option>
            <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
            <option value='<?php  echo $region['id'];?>' ><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>

            <?php  } } ?>

          </select>

        </div>
      </div>

    <div class="form-group" style="display:none" id='cc'>
        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
        <div class="col-sm-9 col-xs-12 help-block" id = 'content'>

      

        </div>
    </div>
      <div class="form-group">
          <label for="" class="col-sm-2 control-label">时间</label>
          <div class="col-xs-4">
              <?php  echo tpl_form_field_daterange('costtime', array('starttime' => $starttime,'endtime' => $endtime));?>

              <!--<input type='text' name='costtime' id='costtime' class="form-control" value="<?php  echo $item['costtime'];?>" placeholder="例如：2016年1月1日-2016年3月30日"/>-->
          </div>
      </div>
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">数据</label>
        <div class="col-sm-4">
          <input type="file" name="cost" class="form-control" id="cost">
        </div>
      </div>
      <div class="form-group">
            <label for="" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <!--<button type="button" id="myButton" data-loading-text="正在导入中，请勿关闭和刷新浏览器......" class="btn btn-primary" autocomplete="off">-->
                    <!--提交-->
                <!--</button>-->
               <button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
 $(function() {
            $("#regionid").change(function() {
                var regionid = $("#regionid option:selected").val();
                 if (regionid != '0') {
                    $.getJSON("<?php  echo $this->createWebUrl('cost',array('op' => 'ajax'))?>", {regionid:regionid}, function (data) { 
                      if (data) {
                          var content = '当前小区费用,请按照此格式导入：姓名|手机号码|房号|房屋面积|时间|';
                          content += "<span style='color: red'>"+data.name+"</span>";
                          content +="|总价|是否缴费,用是代表缴费，否或者默认空代表未缴费。查询已房号为准。";
                           $("#content").html(content);
                          $("#cc").show();


                      }else{
                        alert('请先添加小区费用类型');
                        window.location="<?php  echo $this->createWebUrl('cost',array('op' => 'category'))?>";
                      }
                        
                       
                    });
                } else {

                }
            });
  })
  function check(form){
            if (!form['cost'].value) {
                alert('请上传物业费用表格');
                return false;
            }
            return true;
  }
</script>

<script>
    $('#myButton').on('click', function () {
        var $btn = $(this).button('loading');
        var regionid = $("#regionid option:selected").val();
        if(regionid == 0){
            alert('请选择小区');
            location.reload();
            return false;
        }
        var costtime = $("#costtime").val();
        var formData = new FormData();
        formData.append('cost', $('#cost')[0].files[0]);
        formData.append('regionid', regionid);
        formData.append('costtime', costtime);
        $.ajax({
            url : "<?php  echo $this->createWebUrl('cost',array('op'=> 'add'))?>",
            type : "POST",
            cache: false,
            data : formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success : function(data) {
                if(data.result){
                    alert(data.content);
                    setTimeout(function(){
                        window.location.href="<?php  echo $this->createWebUrl('cost')?>";
                    },1000);
                }
            },
            error : function(data) {

            }
        });
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
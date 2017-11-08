<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('member', array('op' => 'list'));?>">业主管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('member', array('op' => 'bind'));?>">房号管理</a></li>
    <li  class="active"><a href="<?php  echo $this->createWebUrl('room');?>">房号导入</a></li>
</ul>

<div class="panel panel-default">
  <div class="panel-heading">导入房号数据</div>
  <div class="panel-body">
    <div class="alert alert-info" role="alert">
        默认导入格式:姓名/手机号码/房号。具体请下载模板格式。
        <p>(<a href="<?php echo MODULE_URL;?>template/upFile/room.xlsx.zip" target="_blank" style="font-size:16px;color:red">点击下载上传房号格式示例</a>)</p>
    </div>
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" onsubmit="return check(this);" >
     <div class="form-group">
        <label for="" class="col-sm-2 control-label">选择小区</label>
        <div class="col-sm-4">
          <select name='regionid' class="form-control" id="regionid">
            <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
            <option value='<?php  echo $region['id'];?>' > <?php  echo $region['title'];?></option>
            <?php  } } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="" class="col-sm-2 control-label">房号数据</label>
        <div class="col-sm-4">
          <input type="file" name="room" class="form-control" id="room">
        </div>
      </div>
      <div class="form-group">
            <label for="" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
               <!--<button type="submit" class="btn btn-primary span3" name="submit" value="提交" id="submit">提交</button>-->
                <button type="button" id="myButton" data-loading-text="正在导入中，请勿关闭和刷新浏览器......" class="btn btn-primary" autocomplete="off">
                    提交
                </button>
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function check(form){
            if (!form['room'].value) {
                alert('请上传房号表格');
                return false;
            }
            return true;
        }
</script>
<script>
    $('#myButton').on('click', function () {
        var $btn = $(this).button('loading');
        var regionid = $("#regionid option:selected").val();

        var formData = new FormData();
        formData.append('room', $('#room')[0].files[0]);
        formData.append('regionid', regionid);
        $.ajax({
            url : "<?php  echo $this->createWebUrl('member',array('op'=> 'room'))?>",
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
                        window.location.href="<?php  echo $this->createWebUrl('member')?>";
                    },000);
                }
            },
            error : function(data) {

            }
        });
    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

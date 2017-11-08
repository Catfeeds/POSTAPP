<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?> 
<div style="padding:10px;">
  <ul class="nav nav-tabs">
    <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('print', array('op' => 'post','shopid' =>$shopid))?>">添加打印模板</a></li>
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('print', array('op' => 'display','shopid' =>$shopid))?>">管理打印模板</a></li>
  </ul>
  <div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php  echo $id?>" />
      <div class="panel panel-default">
        <div class="panel-heading"> 打印模板 
        
        </div>
        <div class="panel-body" id="editbox">
        	<div class="form-group">
            	<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
                <div class="col-sm-9 form-inline">
                  <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" placeholder="请填写模板标题" />
                </div>
            </div>
            <div class="form-group">
            	<label class="col-xs-12 col-sm-3 col-md-2 control-label">小票类别</label>
                <div class="col-sm-9 form-inline">
                  <select class="form-control" name="pcate">
                    <option value="0" <?php  if($item['pcate']==0) { ?>selected<?php  } ?>>收银小票</option>
                    <option value="1" <?php  if($item['pcate']==1) { ?>selected<?php  } ?>>卡券小票</option>
                    <option value="2" <?php  if($item['pcate']==2) { ?>selected<?php  } ?>>充值小票</option>
                    <option value="3" <?php  if($item['pcate']==3) { ?>selected<?php  } ?>>交班小票</option>
                    <option value="4" <?php  if($item['pcate']==4) { ?>selected<?php  } ?>>退款小票</option>
					<option value="5" <?php  if($item['pcate']==5) { ?>selected<?php  } ?>>积分兑换小票</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
            	<label class="col-xs-12 col-sm-3 col-md-2 control-label">所属店铺</label>
                <div class="col-sm-9 form-inline">
                  <select class="form-control" name="groupid">
                    <option value="0" <?php  if($item['groupid']==0) { ?>selected<?php  } ?>>选择店铺</option>
                    <?php  if(is_array($shoplist)) { foreach($shoplist as $row) { ?>
                    <option value="<?php  echo $row['id'];?>" <?php  if($item['groupid']==$row['id']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                    <?php  } } ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
            	<label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码</label>
                <div class="col-sm-9 form-inline">
                  <input type="text" name="qrcode" class="form-control" value="<?php  echo $item['qrcode'];?>" placeholder="" />
                  <div class="help-block">【不打印收银小票，请输入0】</div>
                </div>
                
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">模板</label>
              <div class="col-sm-9 form-inline">
                <textarea name="content" id="content" rows="10" onkeyup="changeHeigth()" style="width:250px;overflow-y:visible;resize:none; min-height:300px;"><?php  echo $item['content'];?></textarea>
                <div class="help-block">一行中文字最多15个；数字英文30个</div>
              </div>
            </div>
        </div>
      </div>
      <div class="form-group col-xs-12">
        <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  onclick="return updateForm();return false" />
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
    changeHeigth();
});
function perview(){
	
}
</script>
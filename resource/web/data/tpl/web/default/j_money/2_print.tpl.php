<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('print', array('op' => 'post'))?>">添加打印模板</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('print', array('op' => 'display'))?>">管理打印模板</a></li>
</ul>
<script>
require(['bootstrap'],function($){
	$('.btn').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script> 
<?php  if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" id="myform" method="post" enctype="multipart/form-data">
    <input type="file" style="display:none;" name="printtxt" id="txt" onchange="submitForm()" />
    <input type="hidden" name="id" id="id" />
    <input type="submit" id="submit" style="display:none;" name="submit" value="提交" />
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
      <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>所属店铺</th>
                <th>模板标题</th>
                <th>类型</th>
                <th>是否默认</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td></td>
              <td><a href="<?php  echo $this->createWebUrl('print', array('op' => 'display','shopid'=>$row['groupid']))?>"><?php  echo $shopAry[$row['groupid']]?></a></td>
              <td><?php  echo $row['title'];?></td>
              <td>
              <?php  if($row['pcate']==0) { ?>
              <span class="label label-info">支付</span>
              <?php  } else if($row['pcate']==1) { ?>
              <span class="label label-primary">卡券核销</span>
              <?php  } else if($row['pcate']==2) { ?>
              <span class="label label-success">充值</span>
              <?php  } else if($row['pcate']==3) { ?>
              <span class="label label-warning">交班</span>
              <?php  } else if($row['pcate']==4) { ?>
              <span class="label label-danger">退款</span>
              <?php  } else if($row['pcate']==5) { ?>
              <span class="label label-danger">积分兑换</span>
              <?php  } ?>
              </td>
              <td><?php  if($row['isdefault']) { ?><span class="label label-success"><i class="fa fa-check"></i></span><?php  } ?></td>
              <td style="text-align:right">
              <?php  if(!$row['isdefault']) { ?>
              <a href="<?php  echo $this->createWebUrl('print', array('op' => 'isdefault', 'id' => $row['id']))?>" onclick="return confirm('将本模板设置为打印默认模板吗？');return false;"  class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="设为默认"><i class="fa fa-asterisk"></i></a>&nbsp;&nbsp;
              <?php  } ?>
              <a href="javascript:inputfile(<?php  echo $row['id'];?>)" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="导入模板"><i class="fa fa-sign-in"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('print', array('op' => 'output', 'id' => $row['id']))?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="导出模板"><i class="fa fa-sign-out"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('print', array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('print', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php  } } ?>
              </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<script language="javascript">
function inputfile(id){
	$("#id").val(id);
	$("#txt").click();
}
function submitForm(){
	if(!$("#txt").val())return;
	if(!confirm("确认替换该模板内容？")){
		return;
	}
	$("#submit").click();
}
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
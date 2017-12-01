<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($domore == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('group', array('op' => 'printer', 'shopid' => $shopid))?>">管理打印机</a></li>
  <li <?php  if($domore == 'add') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('group', array('op' => 'printer', 'shopid' => $shopid, 'domore' => 'add'))?>">添加打印机</a></li>
  <li><a href="<?php  echo $this->createWebUrl('group', array('op' => 'display'))?>">管理店铺</a></li>
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
<?php  if($domore == 'add' || $domore == 'edit') { ?>
<div class="main">
  <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $id?>" />
    <div class="panel panel-default">
      <div class="panel-heading"> 打印机管理 </div>
      <div class="panel-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tab1">
		  
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机类型</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="ptype" value="1" <?php  if($printerItem['ptype'] == 1) { ?> checked<?php  } ?> />
                  飞鹅</label>
                   <label class="radio-inline">
                  <input type="radio" name="ptype" value="2" <?php  if($printerItem['ptype'] == 2) { ?> checked<?php  } ?> />
                  POS机</label>
                <div class="help-block"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机名称</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="title" class="form-control" value="<?php  echo $printerItem['title'];?>" />
                <div class="help-block"></div>
              </div>
            </div>
			<?php  if(empty($printerItem) || $printerItem['ptype'] == 1 ) { ?>
			 <div class="form-group type-hide">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">飞鹅账号</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="account" class="form-control" value="<?php  echo $printerItem['apiaccount'];?>" />
                <div class="help-block"></div>
              </div>
            </div>
			
			 <div class="form-group type-hide">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">飞鹅Ukey</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="ukey" class="form-control" value="<?php  echo $printerItem['apiukey'];?>" />
                <div class="help-block"></div>
              </div>
            </div>
			<?php  } ?>
			 <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机编号</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="printsn" class="form-control" value="<?php  echo $printerItem['printsn'];?>" />
                <div class="help-block"></div>
              </div>
            </div>
			<?php  if(empty($printerItem) || $printerItem['ptype'] == 1 ) { ?>
			 <div class="form-group type-hide">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">流量卡号码</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="mobile" class="form-control" value="<?php  echo $printerItem['mobile'];?>" />
                <div class="help-block"></div>
              </div>
            </div>
			<?php  } ?>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否默认打印机</label>
              <div class="col-sm-9">
                <label class="radio-inline">
                  <input type="radio" name="isdef" value="1" <?php  if($printerItem['isdef'] == 1) { ?> checked<?php  } ?> />
                  是</label>
                <label class="radio-inline">
                  <input type="radio" name="isdef" value="0" <?php  if($printerItem['isdef'] == 0) { ?> checked<?php  } ?> />
                  否</label>
                <div class="help-block"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
              <div class="col-sm-9 col-xs-12">
                <input type="text" name="remark" class="form-control" value="<?php  echo $printerItem['remark'];?>" />
                <div class="help-block"></div>
              </div>
            </div>
          
        </div>
      </div>
    </div>
    <div class="form-group col-xs-12">
      <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return checkform();return false" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
  </form>
</div>
<script>
  $(function(){
    $("input[name='ptype']").on('click',function(){
      var type = $(this).val();
      console.log(type);
      if(type == 1){
        $(".type-hide").show();
      }else if(type == 2){
        $(".type-hide").hide()
      }
    });
  })
</script>
<?php  } else if($domore == 'list') { ?>
<div class="main">
  <div class="category">
    <form action="" method="post" onsubmit="return formcheck(this)">
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>打印机名称</th>
                <th>类型</th>
                <th>账号</th>
                <th>打印机编号</th>
                <th>是否默认</th>
                <th>添加时间</th>
                
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <?php $url=$_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&do=printer&domore=edit&m=j_money&pid=".$row['id']."&shopid=".$row['id']?>
            <tr>
              <td></td>
              <td><?php  echo $row['title'];?></td>
              <td><?php  if($row['ptype'] == 1) { ?>飞鹅云<?php  } else if($row['ptype'] == 2) { ?>POS机<?php  } ?></td>
              <td><?php  echo $row['apiaccount'];?></td>
              <td><?php  echo $row['printsn'];?></td>
              <td><?php  if($row['isdef'] == 1) { ?>是<?php  } else { ?>否<?php  } ?></td>
              <td><?php  echo date('Y-m-d', $row['addtime'])?></td>
              <td style="text-align:right;overflow:visible">
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  功能 <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" style="right:0; left:auto">
                  <li><a href="<?php  echo $this->createWebUrl('group',array('op' => 'printer', 'pid' => $row['id'], 'domore' => 'edit', 'shopid' => $shopid))?>" ><i class="fa fa-edit"> </i> 编辑</a></li>
                  <li><a href="<?php  echo $this->createWebUrl('group',array('op' => 'printer', 'pid' => $row['id'], 'domore'	=> 'delete', 'shopid' => $shopid))?>" onclick="return confirm('确实删除吗？');return false;"><i class="fa fa-times"></i> 删除</a></li>
                </ul>
              </div>
              
              </td>
            </tr>
            <?php  } } ?>
            <tr>
              </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
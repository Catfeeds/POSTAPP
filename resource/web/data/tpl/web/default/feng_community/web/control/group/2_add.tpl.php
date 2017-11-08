<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
<li ><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'list'))?>">用户列表</a></li>
	<li <?php  if($p == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p' => 'list'))?>">用户组列表</a></li>
	<li <?php  if($p == 'add' && empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p' => 'add'))?>">添加用户组</a></li>
	<?php  if(!empty($id)) { ?>
	<li <?php  if($p == 'add' && !empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p' => 'add'))?>">编辑用户组</a></li>
	<?php  } ?>
</ul>
<div class="clearfix">
	<form action="" method="post"  class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
		<input type="hidden" name="id" value="<?php  echo $id;?>" />
		<div class="panel panel-default">
			<div class="panel-heading">基本信息</div>
			<div class="panel-body table-responsive">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">名称</label>
					<div class="col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="title" id="title" value="<?php  echo $group['title'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">小区数量</label>
					<div class="col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="maxaccount" value="<?php  echo $group['maxaccount'];?>" />
						<span class="help-block">限制小区的数量，为0则不允许添加。</span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class=" col-xs-12 col-sm-10 col-md-10 col-lg-11">
				<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
				<input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
			</div>
		</div>
	</form>
</div>
<script>
	$(function(){
		$('#form1').submit(function(){
			if(!$.trim($('#form1 :text[name="title"]').val())) {
				util.message('请填写用户组名称');
				return false;
			}
			return true;
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
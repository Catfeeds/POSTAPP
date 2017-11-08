<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
	var u ={};
	u.deny = function(uid){
		var uid = parseInt(uid);
		if(isNaN(uid)) {
			return;
		}
		if(!confirm('确认要禁用/解禁此用户吗? ')) {
			return;
		}
		$.post('<?php  echo url('user/permission');?>', {'do': 'deny', uid: uid}, function(dat){
			if(dat == 'success') {
				location.href = location.href;
			} else {
				util.message('操作失败, 请稍后重试. ' + dat);
			}
		});
	};
	u.del = function(uid){
		var uid = parseInt(uid);
		if(isNaN(uid)) {
			return;
		}
		if(!confirm('确认要删除此用户吗? ')) {
			return;
		}
		$.post('<?php  echo url('user/edit');?>', {'do': 'delete', uid: uid}, function(dat){
			if(dat == 'success') {
				location.href = location.href;
			} else {
				util.message('操作失败, 请稍后重试. ' + dat);
			}
		});
	};
</script>
<ul class="nav nav-tabs">
	<li <?php  if(intval($_GPC['status']) != 1) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'list'))?>">用户列表</a></li>
	<li <?php  if($p == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p'=> 'list'))?>">用户组列表</a></li>
	<li <?php  if($p == 'add' && empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p'=> 'add'))?>">添加用户组</a></li>
	<?php  if(!empty($id)) { ?>
	<li <?php  if($p == 'add' && !empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p'=> 'add','id' => $id))?>">编辑用户组</a></li>
	<?php  } ?>
<!-- 	<?php  if(!empty($settings['verify'])) { ?>
	<li <?php  if(intval($_GPC['status']) == 1) { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/display', array('status' => 1));?>">审核用户</a></li>
	<?php  } ?>
	<li><a href="<?php  echo url('user/create');?>">添加用户</a></li> -->
</ul>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="" method="post" class="form-horizontal" role="form">
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">用户名</label>
				<div class="col-sm-8 col-lg-9 col-xs-12">
					<input class="form-control" name="username" id="" type="text" value="<?php  echo $_GPC['username'];?>">
				</div>
				<div class="pull-right col-xs-12 col-sm-2 col-lg-2">
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="rule panel panel-default">
	<div class="table-responsive panel-body">
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:150px;">用户名</th>
				<th style="width:200px;">小区用户组</th>
				<th style="width:100px;">状态</th>
				<th style="min-width:180px;">注册时间</th>
				<th style="width:250px;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($users)) { foreach($users as $user) { ?>
			<tr>
				<td><?php  if(!$user['founder']) { ?><a href="<?php  echo url('user/edit', array('uid' => $user['uid']))?>"><?php  echo $user['username'];?></a><?php  } else { ?><?php  echo $user['username'];?><?php  } ?></td>
				<td>
				<?php  if($user['title']) { ?>
					<span class="label label-success"><?php  echo $user['title'];?></span>
				<?php  } else { ?>
					<span class="label label-primary">不限制</span>
				<?php  } ?>
				</td>
				<td>
					<?php  if(intval($user['status']) != 2) { ?>
						<span class="label label-danger">被禁止</span>
					<?php  } else { ?>
						<span class="label label-success">正常状态</span>
					<?php  } ?>
				</td>
				<td><?php  echo date('Y-m-d H:i:s', $user['joindate'])?></td>
				<td>
					<div>
						<a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'edit','uid' => $user['uid']))?>" class="btn btn-default btn-sm">设置小区用户组</a>
					</div>
				</td>
				<!-- <?php  if(empty($user['founder'])) { ?>
				<td>
					<div>
						<a href="<?php  echo url('user/permission', array('uid' => $user['uid']))?>">查看操作权限</a>
					</div>
				</td>
				<td>
					<div>
						<a href="javascript:;" onclick="u.deny('<?php  echo $user['uid'];?>');"><?php  if(intval($user['status']) == 2) { ?>禁止<?php  } else { ?>启用<?php  } ?>用户</a>&nbsp;&nbsp;
					</div>
				</td>
				<td>
					<div>
						<a href="javascript:;" onclick="u.del('<?php  echo $user['uid'];?>');">删除用户</a>
					</div>
				</td>
				<?php  } ?> -->
			</tr>
			<?php  } } ?>
		</tbody>
	</table>
	</div>
</div>
<?php  echo $pager;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

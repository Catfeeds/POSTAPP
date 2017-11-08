<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
<li ><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'list'))?>">用户列表</a></li>
	<li <?php  if($p == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p' => 'list'))?>">用户组列表</a></li>
	<li <?php  if($p == 'add' && empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p' => 'add'))?>">添加用户组</a></li>
	<?php  if(!empty($id)) { ?>
	<li <?php  if($p == 'add' && !empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system',array('op' => 'group','operation' => 'group','p' => 'add','id' => $id))?>">编辑用户组</a></li>
	<?php  } ?>
</ul>
<form action="" method="post">
<div class="panel panel-default">
	<div class="panel-body table-responsive">
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:30px;">删？</th>
				<th style="width:150px;">名称</th>
				<th>小区数量</th>
				<th style="min-width:60px;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<tr>
				<td><input type="checkbox" name="delete[]" value="<?php  echo $item['id'];?>" /></td>
				<td><?php  echo $item['title'];?></td>
				<td><?php  if(empty($item['maxaccount'])) { ?>无权限<?php  } else { ?><?php  echo $item['maxaccount'];?><?php  } ?></td>
				<td><span><a href="<?php  echo $this->createWebUrl('control',array('op' => 'group','operation' => 'add','id' => $item['id']))?>">编辑</a></span></td>
			</tr>
			<?php  } } ?>
		</tbody>
		<tr>
			<th></th>
			<td>
				<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
				<input type="submit" class="btn btn-primary span3" name="submit" value="提交" />
			</td>
		</tr>
	</table>
	</div>
</div>
</form>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>服务项目</h5>
				</div>
				<div class="ibox-content">

	<form class="form-horizontal form" action="" method="post" onsubmit="return formcheck(this)">
		<table class="table table-bordered">
			<thead class="navbar-inner">
				<tr>
					<th  style="width:130px">服务项目</th>
					<th  style="width:130px">服务价格</th>
					<th  style="width:130px">服务工时</th>
					<th  style="width:500px">服务介绍</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody id="status-items">
			<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><input class="form-control" name="names[]" type="text" value="<?php  echo $item['name'];?>"></td>
					<td class="row-hover span1"><input class="form-control" name="prices[]" type="text" value="<?php  echo $item['price'];?>">
						<input name="ids[]" type="hidden" value="<?php  echo $item['id'];?>"></td>
					<td><input class="form-control" name="gtimes[]" type="text" value="<?php  echo $item['gtime'];?>"></td>
					<td><textarea class="form-control" name="descriptions[]"  ><?php  echo $item['description'];?></textarea> </td>
					<td><a onclick="if (confirm('删除操作不可恢复，确认吗？')){ $(this).parent().parent().next().remove(); return true;} else {return false;}" href="<?php  echo $this->createWebUrl('homemaking', array('op' => 'del', 'id' => $item['id']))?>" class="btn btn-default" title="删除">删除</a></td>
				</tr>
			<?php  } } ?>
			</tbody>
			<tr>
				<td colspan="5">
					<a href="javascript:;" onclick="addStatusItem()" class="btn btn-default btn-sm"><i class="icon-plus-sign-alt"></i> 添加新项目</a>
					<button type="submit" class="btn btn-primary btn-sm" name="submit" value="提交">提交</button>
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	function addStatusItem() {
		var html = '' +
				'<tr>' +
					'<td><input class="form-control" name="names[]" title="服务项目" placeholder="服务项目名称" type="text" value=""/></td>' +
					'<td><input class="form-control" name="prices[]" title="服务价格" placeholder="服务价格" type="text" value=""/><input name="ids[]" type="hidden" value=""/></td>' +
					'<td><input class="form-control" name="gtimes[]" title="服务工时" placeholder="例如1天/1小时" type="text" value=""/></td>' +
					'<td><textarea class="form-control" name="descriptions[]" title="服务介绍" placeholder="服务介绍" /></textarea></td>' +
					'<td><a href="javascript:;" onclick="$(this).parent().parent().remove();" class="btn btn-default" title="删除此条目">删除</a></td>' +
				'</tr>';
		$('#status-items').append(html);
	}

</script>


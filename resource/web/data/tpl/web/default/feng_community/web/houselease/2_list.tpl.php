<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>租赁管理</h5>
					<h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('houselease',array('op' => 'list'))?>"></a></h5>
				</div>
				<div class="ibox-content">
					<form action="./index.php" method="get" class="form-horizontal" role="form">
						<input type="hidden" name="c" value="site"/>
						<input type="hidden" name="a" value="entry"/>
						<input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
						<input type="hidden" name="do" value="houselease"/>
						<input type="hidden" name="op" value="list"/>
					<div class="row">
						<div class="col-sm-3 m-b-xs">
							<select name="regionid" class="form-control">
								<?php  if(is_array($regions)) { foreach($regions as $region) { ?>
								<option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?> selected<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<div class="col-sm-3 m-b-xs">
							<select name="category" class="form-control">
								<option value="0">请选择租赁分类</option>
								<option value="1" <?php  if($_GPC['category'] == 1) { ?> selected="selected"<?php  } ?>>出租</option>
								<option value="2" <?php  if($_GPC['category'] == 2) { ?> selected="selected"<?php  } ?>>求租</option>
								<option value="3" <?php  if($_GPC['category'] == 3) { ?> selected="selected"<?php  } ?>>出售</option>
								<option value="4" <?php  if($_GPC['category'] == 4) { ?> selected="selected"<?php  } ?>>求购</option>
							</select>
						</div>
						<div class="col-sm-2 m-b-xs">
							<?php echo tpl_form_field_daterange('birth', array('starttime' => date('Y-m-d',empty($starttime) ? TIMESTAMP : $starttime),'endtime' => date('Y-m-d',empty($endtime) ? TIMESTAMP : $endtime)));?>
						</div>
						<div class="col-sm-2 m-b-xs">
							<div class="input-group">
								<div class="radio radio-success radio-inline">
									<input type="radio" name="status" id="ipt_status1" value="0" <?php  if(empty($_GPC['status'])) { ?>checked='checked'<?php  } ?> />
									<label for="ipt_status1">未成交</label>
								</div>
								<div class="radio radio-success radio-inline">
									<input type="radio" name="status"  id="ipt_status2" value="1" <?php  if($_GPC['status'] == 1) { ?>checked='checked'<?php  } ?> />
									<label for="ipt_status2">已成交</label>
								</div>
							</div>
						</div>
						<div class="col-sm-2 m-b-xs">
							<span class="input-group-btn" >
								<button type="submit" class="btn btn-primary" style="margin-right: 3px">搜索</button>
								<button type="submit" name="export" value="1" class="btn btn-primary">导出数据</button>
								<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
							</span>
						</div>
					</div>
					</form>
		<form class="form-horizontal form" method="post" >
		<table class="table table-bordered">
			<thead >
				<tr>
					<th width="3%">
						<div class="checkbox checkbox-success checkbox-inline">
							<input type="checkbox" id="checkids"
								   onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
							<label for="checkids"> </label>
						</div>
					</th>
					<th style="width:130px;">标题</th>
					<th style="width:80px;">姓名</th>
					<th style="width:100px;">手机</th>
					<th style="width:100px;">时间</th>
					<th style="width:100px">状态</th>
					<th style="width:60px">审核</th>
					<th style="width: 250px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-success checkbox-inline">
							<input type="checkbox" type="checkbox" name="ids[]" id="ids_<?php  echo $item['id'];?>" value="<?php  echo $item['id'];?>">
							<label for="ids_<?php  echo $item['id'];?>"></label>
						</div>
					</td>
					<td><?php  echo $item['title'];?></td>
					<td><?php  if($item['realname']) { ?><?php  echo $item['realname'];?><?php  } else { ?><?php  echo $item['t_realname'];?><?php  } ?></td>
					<td><?php  if($item['mobile']) { ?><?php  echo $item['mobile'];?><?php  } else { ?><?php  echo $item['t_mobile'];?><?php  } ?></td>
					<td><?php  echo date('Y-m-d H:i', $item['createtime']);?></td>
					<td><?php  if($item['status'] ==1 ) { ?><span class="label label-success">已成交</span><?php  } ?><?php  if($item['status'] == 0 ) { ?><span class="label label-info">未成交</span><?php  } ?><?php  if($item['status'] == 2 ) { ?><span class="label label-danger">已取消</span><?php  } ?></td>
					<td>
						<label data="<?php  echo $item['enable'];?>" class='label  label-default <?php  if($item['enable']==0) { ?>label-info<?php  } ?>' onclick="verify(this,<?php  echo $item['id'];?>,'enable')"><?php  if($item['enable']==0) { ?>通过<?php  } else { ?>禁止<?php  } ?></label>
					</td>
					<td>
						<span>
							<a  class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('houselease',array('op'=>'add','id'=>$item['id']));?>">查看</a>
						</span>
						<span>
							<a  class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('houselease',array('op'=>'edit','id'=>$item['id']));?>">编辑</a>
						</span>
						<span>
							<a  class="btn btn-default btn-sm" onclick="return confirm('删除操作不可恢复，确认吗？')" href="<?php  echo $this->createWebUrl('houselease',array('op'=>'delete','id'=>$item['id']));?>">删除</a>
						</span>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
			<table class="footable table table-stripped toggle-arrow-tiny footable-loaded tablet breakpoint">
				<thead>
				<?php  if($list) { ?>
				<tr>
					<td class="text-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-danger btn-sm" name="delete" value="批量删除" /> &nbsp;
						<button type="submit" name="plverity" value="1" class="btn btn-warning btn-sm">一键全部审核</button>
					</td>
					<td class="footable-visible"><ul class="pagination pull-right"><?php  echo $pager;?></ul></td>
				</tr>
				<?php  } else { ?>
				<tr style="text-align: center"><td >没有找到对应的记录</td></tr>
				<?php  } ?>
				</thead>
			</table>
		</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function verify(obj, id, type) {
		$(obj).html($(obj).html() + "...");
		$.post("<?php  echo $this->createWebUrl('houselease',array('op' => 'verify'))?>", {
			id: id,
			type: type,
			data: obj.getAttribute("data")
		}, function(d) {
			$(obj).html($(obj).html().replace("...", ""));
			if (type == 'enable') {
				$(obj).html(d.data == '0' ? '通过' : '禁止');
			}
			$(obj).attr("data", d.data);
			if (d.result == 1) {
				$(obj).toggleClass("label-info");
			}
		}, "json");
	}
</script>

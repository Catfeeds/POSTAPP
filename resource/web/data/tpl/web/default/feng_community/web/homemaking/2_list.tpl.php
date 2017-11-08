<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>信息管理</h5>
					<h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('homemaking',array('op' => 'list'))?>"></a></h5>
				</div>
				<div class="ibox-content">
					<form action="./index.php" method="get" class="form-horizontal" role="form">
						<input type="hidden" name="c" value="site"/>
						<input type="hidden" name="a" value="entry"/>
						<input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
						<input type="hidden" name="do" value="homemaking"/>
						<input type="hidden" name="op" value="list"/>
					<div class="row">
						<div class="col-sm-3 m-b-xs">
							<select name="regionid" class="form-control">
								<option value="0">全部小区</option>
								<?php  if(is_array($regions)) { foreach($regions as $region) { ?>
								<option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?> selected<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<div class="col-sm-3 m-b-xs">
							<select name="category" class="form-control">
								<option value="0">请选择家政分类</option>
								<?php  if(is_array($categories)) { foreach($categories as $key => $category) { ?>
								<option value="<?php  echo $category['id'];?>" <?php  if($category['id'] == $_GPC['category']) { ?> selected="selected"<?php  } ?>><?php  echo $category['name'];?><?php  echo $category['price'];?>/<?php  echo $category['gtime'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<div class="col-sm-2 m-b-xs">
							<?php echo tpl_form_field_daterange('birth', array('starttime' => date('Y-m-d',empty($starttime) ? TIMESTAMP : $starttime),'endtime' => date('Y-m-d',empty($endtime) ? TIMESTAMP : $endtime)));?>
						</div>
						<div class="col-sm-2 m-b-xs">
							<span class="input-group">
					<div class="radio radio-success radio-inline">
					<input type="radio" name="status" id="status_0" value="0" <?php  if(empty($_GPC['status'])) { ?>checked='checked'<?php  } ?> />
					<label for="status_0">未完成</label>
					</div>
					<div class="radio radio-success radio-inline">
					<input type="radio" name="status"  id="status_2" value="2" <?php  if($set['p66']['value']==2 ) { ?> checked<?php  } ?> />
					<label for="status_2">已取消</label>
					</div>
					<div class="radio radio-success radio-inline">
					<input type="radio" name="status"  id="status_1" value="1" <?php  if($set['p66']['value']==1 ) { ?> checked<?php  } ?> />
					<label for="status_1">已完成</label>
					</div>
						</span>
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
			<thead>
				<tr>
					<th style="width:30px;">
						<div class="checkbox checkbox-success checkbox-inline">
							<input type="checkbox" id="checkids"
								   onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
							<label for="checkids"> </label>
						</div>
					</th>
					<th style="width:60px;">姓名</th>
					<th style="width:80px;">手机</th>
					<th style="width:250px;">地址</th>
					<th style="width:120px;">服务时间</th>
					<th style="width:120px;">发布时间</th>
					<th style="width:100px;">状态</th>
					<th style="width:120px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-success checkbox-inline">
							<input type="checkbox" type="checkbox" name="ids[]" id="ids_<?php  echo $item['id'];?>"
								   value="<?php  echo $item['id'];?>">
							<label for="ids_<?php  echo $item['id'];?>"></label>
						</div>
					</td>
					<td><?php  echo $item['realname'];?></td>
					<td><?php  echo $item['mobile'];?></td>
					<td><?php  echo $item['title'];?><?php  if($item['area']) { ?><?php  echo $item['area'];?>区<?php  } ?><?php  if($item['build']) { ?><?php  echo $item['build'];?>栋<?php  } ?><?php  if($item['unit']) { ?><?php  echo $item['unit'];?>单元<?php  } ?><?php  if($item['room']) { ?><?php  echo $item['room'];?>室<?php  } ?></td>
					<td><?php  echo $item['servicetime'];?></td>
					<td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
					<td><?php  if($item['status'] ==1 ) { ?><span class="label label-success">已完成</span><?php  } ?><?php  if($item['status'] == 0 ) { ?><span class="label label-info">未完成</span><?php  } ?><?php  if($item['status'] == 2 ) { ?><span class="label label-danger">已取消</span><?php  } ?></td>
					<td>
						<span>
							<a  class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('homemaking',array('op'=>'add','id'=>$item['id']));?>">查看</a>
						</span>
						<span>
							<a  class="btn btn-default btn-sm" onclick="return confirm('删除操作不可恢复，确认吗？')" href="<?php  echo $this->createWebUrl('homemaking',array('op'=>'delete','id'=>$item['id']));?>">删除</a>
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

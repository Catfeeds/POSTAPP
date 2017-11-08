<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo $this->createWebUrl('report', array('op' => 'list'));?>">意见管理</a>
	</li>

	<li><a href="<?php  echo $this->createWebUrl('category', array('op'=>'list','type' => 3));?>">服务分类</a></li>

	<li><a href="<?php  echo $this->createWebUrl('report', array('op'=>'manage','operation' => 'add'));?>">管理接收员</a></li>
</ul>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site"/>
			<input type="hidden" name="a" value="entry"/>
			<input type="hidden" name="m" value="feng_community"/>
			<input type="hidden" name="do" value="report"/>
			<input type="hidden" name="op" value="list"/>

			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 control-label">选择小区</label>
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
					<select name="regionid" class="form-control">
						<?php  if(is_array($regions)) { foreach($regions as $region) { ?>
						<option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?>selected<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 control-label">意见类型</label>
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
					<select name="category" class="form-control">
						<option value="">选择类型</option>
						<?php  if(is_array($categories)) { foreach($categories as $category) { ?>
						<option value="<?php  echo $category['name'];?>" <?php  if($category['name']==$_GPC['category']) { ?> selected<?php  } ?>><?php  echo $category['name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 control-label">报修日期</label>
				<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
					<?php echo tpl_form_field_daterange('birth', array('starttime' => date('Y-m-d',empty($starttime) ? TIMESTAMP : $starttime),'endtime' => date('Y-m-d',empty($endtime) ? TIMESTAMP : $endtime)));?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 control-label">状态</label>
				<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
					<label for="ipt_status1" class="radio-inline">
						<input class="" name="status" id="" type="radio" value="0" <?php  if(empty($status)) { ?>checked='checked' <?php  } ?>/>全部
					</label>
					<label for="ipt_status1" class="radio-inline">
						<input class="" name="status" id="ipt_status1" type="radio" value="2" <?php  if($status== 2 ) { ?>checked='checked' <?php  } ?>/>未处理
					</label>
					<label for="ipt_status2" class="radio-inline">
						<input class="" name="status" id="ipt_status2" type="radio" value="3" <?php  if($status== 3) { ?>checked='checked' <?php  } ?> />处理中
					</label>
					<label for="ipt_status3" class="radio-inline">
						<input class="" name="status" id="ipt_status3" type="radio" value="1" <?php  if($status== 1) { ?>checked='checked' <?php  } ?> />已处理
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 control-label">用户信息</label>
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
					<input class="form-control" name="keyword1" type="text" value="<?php  echo $_GPC['keyword1'];?>" placeholder="可查询手机号 /姓名 /房号">
				</div>
				<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
				<button type="submit" name="export" value="1" class="btn btn-primary">导出数据</button>
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="table-responsive">
		<form class="form-horizontal form" method="post">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th style="width: 20px;">删?</th>
					<th style="width: 90px;">类型</th>
					<th style="width: 100px;">姓名</th>
					<th style="width: 110px;">手机</th>
					<th style="width: 190px;">地址</th>
					<th style="width: 130px;">日期</th>
					<th style="width: 70px">状态</th>
					<th style="width: 60px">审核</th>
					<th style="width: 60px">评价</th>
					<th style="width: 220px">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td>
						<input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>">
					</td>
					<td><?php  if($item['category']) { ?><?php  echo $item['category'];?><?php  } else { ?><?php  echo $item['cate'];?><?php  } ?></td>
					<td><?php  echo $item['realname'];?></td>
					<td><?php  echo $item['mobile'];?></td>
					<td>
						<?php  echo $item['title'];?><?php  echo $item['address'];?>
					</td>
					<td><?php  echo date('Y-m-d H:i', $item['createtime']);?></td>
					<td><?php  if($item['status'] ==1 ) { ?><span class="label label-success">已处理</span><?php  } ?><?php  if($item['status'] == 3 ) { ?><span
							class="label label-info">受理中</span><?php  } ?><?php  if($item['status'] == 2 ) { ?><span
							class="label label-default">未处理</span><?php  } ?>
					</td>
					<td>
						<label data="<?php  echo $item['enable'];?>" class='label label-default <?php  if($item['enable']==0) { ?>label-info<?php  } ?>'
						onclick="verify(this,<?php  echo $item['id'];?>,'enable')"><?php  if($item['enable']==0) { ?>通过<?php  } else { ?>禁止<?php  } ?></label>
					</td>
					<td><span class="label label-success"><?php  if($item['rank'] == 1) { ?>满意<?php  } else if($item['rank'] == 2) { ?>一般<?php  } else if($item['rank']) { ?>不满意<?php  } ?></span>
					</td>
					<td>
                        <span>
							<a href="<?php  echo $this->createWebUrl('report',array('op'=>'add','id'=>$item['id']));?>"
							   class="btn btn-default btn-sm">
                                <i class='glyphicon glyphicon-edit'></i>
                            处理意见</a>
						</span>
						&nbsp;&nbsp;
						<span>
							<a class="btn btn-default btn-sm" onclick="return confirm('删除操作不可恢复，确认吗？')"
							   href="<?php  echo $this->createWebUrl('report',array('op'=>'delete','id'=>$item['id']));?>">
                             <i class='glyphicon glyphicon-remove-circle'></i>
                            删除</a>
						</span>
						<?php  if($item['status']==2) { ?>
						<span>
							<a href="<?php  echo $this->createWebUrl('report',array('op'=>'send','id'=>$item['id']));?>" class="btn btn-default btn-sm" style="color: red">
                                <i class='glyphicon glyphicon-bullhorn'></i>
                            推送
                            </a>
						</span>
						<?php  } ?>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>

			<table class="table table-hover">
				<tr>
					<td width="30">
						<input type="checkbox"
							   onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"/>
					</td>
					<td class="text-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>"/>
						<input type="submit" class="btn btn-primary btn-sm" name="delete" value="批量删除"/> &nbsp;
						<button type="submit" name="plverity" value="1" class="btn btn-warning btn-sm">一键全部审核</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php  echo $pager;?>
<script>
    function verify(obj, id, type) {
        $(obj).html($(obj).html() + "...");
        $.post("<?php  echo $this->createWebUrl('report',array('op' => 'verify'))?>", {
            id: id,
            type: type,
            data: obj.getAttribute("data")
        }, function (d) {
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
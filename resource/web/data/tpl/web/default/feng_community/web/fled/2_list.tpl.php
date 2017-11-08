<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#" >二手交易管理</a>
		</li>

		 <li><a href="<?php  echo $this->createWebUrl('fled', array('op'=>'category'));?>">服务分类</a></li>

	</ul>
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="" method="post" class="form-horizontal" role="form">
				<div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 control-label">选择小区</label>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                        <select name="regionid" class="form-control">
                                <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                <option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC[ 'regionid']) { ?> selected<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>
                                <?php  } } ?>
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label">二手分类</label>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
						<select class="form-control" id="cate_2" name="category">
							<option value="0">请选择二手分类</option>
							<?php  if(is_array($categories)) { foreach($categories as $key => $category) { ?>
							<option value="<?php  echo $category['id'];?>" <?php  if($category['id'] == $_GPC['category']) { ?> selected="selected"<?php  } ?>><?php  echo $category['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label">状态</label>
					<div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
						<label for="ipt_status1" class="radio-inline">
							<input name="status" id="ipt_status1" type="radio" value="0" <?php  if(empty($_GPC['status'])) { ?>checked='checked'<?php  } ?> />未成交
						</label>
						<label for="ipt_status2" class="radio-inline">
							<input name="status" id="ipt_status2" type="radio" value="1" <?php  if($_GPC['status'] == 1) { ?>checked='checked'<?php  } ?> />已成交
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label"></label>
					<div>
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<div class="panel panel-default">
	<div class="table-responsive">
		<form class="form-horizontal form" method="post" >
		<table class="table table-hover table-striped">
			<thead class="navbar-inner">
				<tr>
					<th style="width: 40px;">删?</th>
					<th class="col-sm-2">名称</th>
					<th style="width: 80px;">价格</th>
					<th style="width: 120px;">联系人</th>
					<th style="width: 160px;">联系电话</th>
					<th style="width: 100px;">发布时间</th>
					<th>状态</th>
					<th style="width: 250px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $good) { ?>
				<tr>
					<td>
						<input type="checkbox" name="ids[]" value="<?php  echo $good['id'];?>">
					</td>
					<td><?php  echo $good['title'];?></td>
					<td><?php  if(empty($good['zprice'])) { ?>面议<?php  } else { ?><?php  echo $good['zprice'];?>元<?php  } ?></td>
					<td><?php  echo $good['realname'];?></td>
					<td><?php  echo $good['mobile'];?></td>
					<td><?php  echo date('Y-m-d h:i',$good['createtime'])?></td>
					<td>
						<label data="<?php  echo $good['enable'];?>" class='label  label-default <?php  if($good['enable']==0) { ?>label-info<?php  } ?>' onclick="verify(this,<?php  echo $good['id'];?>,'enable')"><?php  if($good['enable']==0) { ?>通过<?php  } else { ?>禁止<?php  } ?></label>
					</td>
					<td>
						<a href="<?php  echo $this->createWebUrl('fled',array('op' => 'detail','id'=>$good['id']))?>" class="btn btn-primary btn-sm" ><i class="glyphicon glyphicon-search"></i>查看
						</a>&nbsp;
						<a  title="删除" class="btn btn-primary btn-sm" onclick="del('<?php  echo $good['id'];?>')"><i class="fa fa-times"></i>删除
						</a>&nbsp;
						<a onclick="toblack('<?php  echo $good['id'];?>')" href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye-slash"></i>加入黑名单</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
			</table>
			<table class="table table-hover">
				<tr>
					<td width="30">
						<input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
					</td>
					<td class="text-left">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-primary btn-sm" name="delete" value="批量删除" /> &nbsp;
						<button type="submit" name="plverity" value="1" class="btn btn-warning btn-sm">一键全部审核</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
	<?php  echo $pager;?>
	<script type="text/javascript">

		function del(id){
			var id=id;
		        var url = "<?php  echo $this->createWebUrl('fled',array('op' => 'delete'),true)?>";
		            $.post(url,
		            {
		                id:id
		            },
		            function(msg){
		                    if (msg.status == 1) {
		                    	setTimeout(function(){
		                        	window.location.reload();
		                   		 },100);
		                    };
		                    
		            },
		            'json');
		}
    	function toblack(id){
	    	var id = id;
	            if(!id) return false;
	            $.post("<?php  echo $this->createWebUrl('fled')?>", {"op":"toblack","id":id}, function(msg){
	                var _obj = JSON.parse(msg);
	                if(_obj.state==1){
	                   location.reload();
	                }
	            });
	    }
		function verify(obj, id, type) {
			$(obj).html($(obj).html() + "...");
			$.post("<?php  echo $this->createWebUrl('fled',array('op' => 'verify'))?>", {
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
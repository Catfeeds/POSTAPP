<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>拼车管理</h5>
					<h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('car',array('op' => 'list'))?>"></a></h5>
				</div>
				<div class="ibox-content">
					<form action="./index.php" method="get" class="form-horizontal" role="form">
						<input type="hidden" name="c" value="site"/>
						<input type="hidden" name="a" value="entry"/>
						<input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
						<input type="hidden" name="do" value="car"/>
						<input type="hidden" name="op" value="list"/>
					<div class="row">
						<div class="col-sm-6 m-b-xs">
							<select name="regionid" class="form-control">
								<option value="0">全部小区</option>
								<?php  if(is_array($regions)) { foreach($regions as $region) { ?>
								<option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?> selected<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>
								<?php  } } ?>
							</select>
						</div>
						<div class="col-sm-3 m-b-xs">
							<div class="input-group">
								<div class="radio radio-success radio-inline">
									<input type="radio" name="type" id="ipt_status1" value="1" <?php  if($_GPC['type'] == 1 || empty($_GPC['type'])) { ?>checked='checked'<?php  } ?> />
									<label for="ipt_status1">司机</label>
								</div>
								<div class="radio radio-success radio-inline">
									<input type="radio" name="type"  id="ipt_status2" value="2" <?php  if($_GPC['type'] == 2) { ?>checked='checked'<?php  } ?>/>
									<label for="ipt_status2">乘客</label>
								</div>
							</div>
						</div>
						<div class="col-sm-3 m-b-xs">
							<button type="submit" class="btn btn-primary"> 搜索</button>
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
						</div>
					</div>
					</form>
		<form class="form-horizontal form" method="post" >
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="width: 3%;">
						<div class="checkbox checkbox-success checkbox-inline">
							<input type="checkbox" id="checkids"
								   onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
							<label for="checkids"> </label>
						</div>
					</th>
					<th style="width: 100px;">标题</th>
					<th style="width: 50px;">类型</th>
					<th style="width: 120px;">出发地->目的地</th>
					<th style="width: 140px;">出发时间->返回时间</th>
					<th style="width: 80px;">可载人数</th>
					<th style="width: 80px;">价格(元/人)</th>
					<th style="width: 60px">状态</th>
					<th style="width: 180px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $cars) { ?>
				<tr>
					<td>
						<div class="checkbox checkbox-success checkbox-inline">
							<input type="checkbox" type="checkbox" name="ids[]" id="ids_<?php  echo $cars['id'];?>"
								   value="<?php  echo $cars['id'];?>">
							<label for="ids_<?php  echo $cars['id'];?>"></label>
						</div>
					</td>
					<td><?php  echo $cars['title'];?></td>
					<td><?php  if($cars['type'] == 1) { ?> 司机<?php  } else { ?>乘客 <?php  } ?></td>
					<td><?php  echo $cars['start_position'];?>-><?php  echo $cars['end_position'];?></td>
					<td><?php  echo $cars['gotime'];?>-><?php  echo $cars['backtime'];?></td>
					<td><?php  echo $cars['seat'];?>座</td>
					<td><?php  if($cars['sprice']) { ?><?php  echo $cars['sprice'];?>元<?php  } else { ?>按实分摊<?php  } ?></td>
					<td>
						<label data="<?php  echo $cars['enable'];?>" class='label  label-default <?php  if($cars['enable']==0) { ?>label-info<?php  } ?>' onclick="verify(this,<?php  echo $cars['id'];?>,'enable')"><?php  if($cars['enable']==0) { ?>通过<?php  } else { ?>禁止<?php  } ?></label>
					</td>
					<td>
						<a onclick="toblack(<?php  echo $cars['id'];?>)" href="#" class="btn btn-primary btn-sm">加入黑名单</a>
						&nbsp;
						<a onclick="del(<?php  echo $cars['id'];?>)" title="删除" class="btn btn-default btn-sm" >删除
						</a>&nbsp;
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
						<input type="submit" class="btn btn-danger span2" name="delete" value="批量删除" /> &nbsp;
						<button type="submit" name="plverity" value="1" class="btn btn-warning">一键全部审核</button>
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
	<script type="text/javascript">
	

		function del(id){
			var id=id;
		        var url = "<?php  echo $this->createWebUrl('car',array('op' => 'delete'),true)?>";
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
	            $.post("<?php  echo $this->createWebUrl('car')?>", {"op":"toblack","id":id}, function(msg){
	                var _obj = JSON.parse(msg);
	                if(_obj.state==1){
	                   location.reload();
	                }
	            });
	    }
		function verify(obj, id, type) {
			$(obj).html($(obj).html() + "...");
			$.post("<?php  echo $this->createWebUrl('car',array('op' => 'verify'))?>", {
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

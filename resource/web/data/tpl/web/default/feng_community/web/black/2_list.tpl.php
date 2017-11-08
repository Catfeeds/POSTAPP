<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>黑名单管理</h5>
					<h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('black',array('op' => 'list'))?>"></a></h5>
				</div>
				<div class="ibox-content">
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p>黑名单说明</p>
						<p>在二手交易和拼车信息管理中可以屏蔽信息，屏蔽后可以在这里进行管理。</p>
					</div>
					<div class="row">
						<div class="col-sm-10 m-b-xs">

						</div>
						<div class="col-sm-1 m-b-xs">
							<a style="display:block;" href="<?php  echo $this->createWebUrl('black',array('type' => 1))?>" class="btn btn-s-sm text-sm btn-info navbar-right m-r-sm"> 拼车信息黑名</a>
						</div>
						<div class="col-sm-1 m-b-xs">
							<a style="display:block;" href="<?php  echo $this->createWebUrl('black',array('type' => 2))?>" class="btn btn-s-sm text-sm btn-success navbar-right m-r-sm">二手交易黑名单</a>
						</div>
					</div>

  <table class="table table-bordered">
    <thead>
				<tr>
					<th class="col-sm-1"></th>
					<th class="col-sm-2">标题</th>
					<th class="col-sm-1">类别</th>
					<th class="col-sm-2">来自</th>
					<th class="col-sm-2">发布时间</th>

					<th class="col-sm-3">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td></td>
					<td><?php  echo $item['title'];?></td>
					<td><?php  if($type == 2) { ?>二手交易<?php  } else { ?>小区拼车<?php  } ?></td>
					<td><?php  echo $item['mobile'];?></td>
					<td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
					<td>
						<a onclick="toblack(<?php  echo $item['id'];?>,<?php  echo $type;?>)" href="#" class="btn btn-primary btn-sm" id='toblack'> 解除屏蔽 </a>&nbsp;
						<a onclick="del(<?php  echo $item['id'];?>,<?php  echo $type;?>)" href="#" class="btn btn-default btn-sm" > 删除 </a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
  </table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    	function del(id,type){
	    	var id = id;
	            $.post("<?php  echo $this->createWebUrl('black')?>", {"op":"delete","id":id,"type":type}, function(msg){
	                if (msg.status == 1) {
		                    	setTimeout(function(){
		                        	window.location.reload();
		                   		 },100);
		                    };
	            },'json');
	    }
    	function toblack(id,type){
	    	var id = id;
	            $.post("<?php  echo $this->createWebUrl('black')?>", {"op":"toblack","id":id,"type":type}, function(msg){
	                if (msg.status == 1) {
		                    	setTimeout(function(){
		                        	window.location.reload();
		                   		 },100);
		                    };
	            },'json');
	    }
</script>

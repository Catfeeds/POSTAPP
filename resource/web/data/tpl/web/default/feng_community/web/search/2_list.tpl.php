<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>便民查询</h5>
					<h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('search')?>"></a></h5>
				</div>
				<div class="ibox-content">
					<form action="./index.php" method="get" class="form-horizontal" role="form">
						<input type="hidden" name="c" value="site"/>
						<input type="hidden" name="a" value="entry"/>
						<input type="hidden" name="m" value="feng_community"/>
						<input type="hidden" name="do" value="search"/>
					<div class="row">
						<div class="col-sm-2 m-b-xs">
							<a class="btn btn-primary" href="<?php  echo $this->createWebUrl('search',array('op' => 'add'))?>"><i class="fa fa-plus"></i> 添加便民查询</a>
							</span>
						</div>
					</div>
					</form>
<table class="table table-bordered">
	<thead class="navbar-inner">
		<tr>
			<th class="col-md-2">
				名称 <i></i>
			</th>
			<th>
				第三方网址
				<i></i>
			</th>
			<th style="width:200px;">
				状态(点击可修改)
				<i></i>
			</th>
			<th class="row-hover" style="min-width:370px;">操作</th>
			<th class="row-hover span1" style="text-align:right;width:100px;"></th>
		</tr>
	</thead>
	<tbody id="status-items">
		<?php  if(is_array($list)) { foreach($list as $item) { ?>
		<tr>
			<td><?php  echo $item['sname'];?></td>
			<td><?php  echo $item['surl'];?></td>
			<td>
				<label data='<?php  echo $item['status'];?>' class='label label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'status')"><?php  if($item['status'] == 1) { ?>开启<?php  } else { ?>关闭<?php  } ?></label>
			</td>
			<td>
				<a href="<?php  echo $this->createWebUrl('search',array('op' => 'add','id' => $item['id']))?>" title="编辑" class="btn btn-primary btn-sm" >编辑</a>
                        
                 <a onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('search',array('op' => 'delete','id' => $item['id']))?>" title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
			</td>
		</tr>
		<?php  } } ?>

	</tbody>
</table>
					<table class="footable table table-stripped toggle-arrow-tiny footable-loaded tablet breakpoint">
						<thead>
						<?php  if($list) { ?>
						<tr>
							<td class="footable-visible"><ul class="pagination pull-right"><?php  echo $pager;?></ul></td>
						</tr>
						<?php  } else { ?>
						<tr style="text-align: center"><td >没有找到对应的记录</td></tr>
						<?php  } ?>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function setProperty(obj,id,type){
		$(obj).html($(obj).html() + "...");
		$.post("<?php  echo $this->createWebUrl('search',array('op' => 'set'))?>"
			,{id:id,type:type, data: obj.getAttribute("data")}
			,function(d){
				$(obj).html($(obj).html().replace("...",""));
				if(type=='status'){
				 $(obj).html( d.data=='1'?'开启':'关闭');
				}
				$(obj).attr("data",d.data);
				if(d.result==1){
					$(obj).toggleClass("label-info");
				}
			}
			,"json"
		);
	}
</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
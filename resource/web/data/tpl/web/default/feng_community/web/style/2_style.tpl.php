<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<form action="" method="post" class="form-horizontal form" id="form1">
	<div class="panel panel-default">
		<div class="panel-heading">模板设置</div>
		<div class="panel-body">

			<div class="form-group clearfix">
				<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">选择风格</label>
				<div class="clearfix">
					<div class="col-sm-4 col-lg-4 col-xs-12">
						<select name="styleid" class="form-control">
							<?php  if(is_array($template)) { foreach($template as $path) { ?>
							<!--<option value="<?php  echo $path;?>" <?php  if($item['styleid'] == $path) { ?> selected<?php  } ?>><?php  echo $path;?></option>-->
							<option value="<?php  echo $path;?>" <?php  if($style == $path) { ?> selected<?php  } ?>><?php  echo $path;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12" style="margin-left:70px;">
					<input name="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</div>
	</div>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
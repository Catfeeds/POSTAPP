<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('op' => 'list','type' => $_GPC['type']))?>">管理分类</a></li>
	<li <?php  if($op == 'add') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('op' => 'add','type' => $_GPC['type']))?>">添加分类</a></li>
</ul>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return check(this);">
	<input type="hidden" name="parentid" value="<?php  echo $parentid;?>" />
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">分类详细设置</h3>
	  </div>
	  <div class="panel-body">
	  		<?php  if(!empty($parentid)) { ?>
	    	<div class="form-group">
			    <label for="" class="col-sm-2 control-label">上级分类</label>
			    <div class="col-xs-2">
			      <?php  echo $parent['name'];?>
			    </div>
			</div>
			<?php  } ?>
			<div class="form-group">
			    <label for="displayorder" class="col-sm-2 control-label">排序</label>
			    <div class="col-xs-2">
			      <input type="text" name="displayorder" id='displayorder' class="form-control" value="<?php  echo $category['displayorder'];?>" placeholder="排序"/>
			    </div>
			</div>
			<div class="form-group">
			    <label for="catename" class="col-sm-2 control-label">分类名称</label>
			    <div class="col-xs-2">
			      <input type="text" name="catename" class="form-control" value="<?php  echo $category['name'];?>" id='catename' placeholder="分类名称"/>
			    </div>
			</div>
		  <div class="form-group">
			  <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类图片</label>
			  <div class="col-sm-4 col-xs-6">
				  <?php  echo tpl_form_field_image('thumb', $category['thumb'])?>(比例1:1)
			  </div>
		  </div>
		  <div class="form-group">
			  <label for="" class="col-sm-2 control-label">外部链接</label>
			  <div class="col-xs-5">
				  <?php  echo tpl_form_field_link('url',$item['url'])?>
			  </div>
			  <span class="help-block">默认链接请勿修改。</span>
		  </div>
			<div class="form-group">
			    <label for="description" class="col-sm-2 control-label">分类描述</label>
			    <div class="col-xs-4">
			      <textarea name="description" class="form-control" rows='3' id='description' placeholder="分类描述"><?php  echo $category['description'];?></textarea>
			    </div>
			</div>
			<div class="form-group">
			    <label for="" class="col-sm-2 control-label"></label>
			    <div class="col-sm-10">
			      <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			    </div>
			</div>
	  </div>
	</div>
	</form>
</div>
<script type="text/javascript">
        function check(form){
            if (!form['catename'].value) {
                alert('请输入分类名称。');
                return false;
            }
            if (!form['description'].value) {
                alert('请输入分类描述！');
                return false;
            }
            return true;
        }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
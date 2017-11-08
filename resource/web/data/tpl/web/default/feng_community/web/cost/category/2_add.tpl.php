<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('cost', array('op' => 'add'))?>">费用导入</a></li>
	<li <?php  if($operation == 'add') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('cost', array('op' => 'category','operation' => 'add'))?>">添加费用类型</a></li>
	<li <?php  if($operation == 'list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('cost', array('op' => 'category','operation' => 'list'))?>">管理费用类型</a></li>
</ul>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit="return check(this);">
	<input type="hidden" name="parentid" value="<?php  echo $parentid;?>" />
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">费用类型</h3>
	  </div>
	  <div class="panel-body">
		      <div class="form-group">
		        <label for="uploadExcel" class="col-sm-2 control-label">小区</label>
		        <div class="col-sm-4">
		          <select name='regionid' class="form-control">
		          	<option value='' > 请选择小区</option>
		            <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
		            <option value='<?php  echo $region['id'];?>' <?php  if($item['regionid'] == $region['id']) { ?>selected = 'selected'<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>

		            <?php  } } ?>

		          </select>

		        </div>
		      </div>
			<div class="form-group">
			    <label for="name" class="col-sm-2 control-label">费用类型</label>
			    <div class="col-xs-5">
			      <!-- <input type="text" name="name" class="form-control" value="<?php  echo $item['name'];?>" id='name' placeholder="水费|电费|垃圾费|停车费|公摊费"/> -->
			      <textarea name='name' class="form-control" style="height:120px;" placeholder="水费|电费|垃圾费|停车费|公摊费"><?php  echo $item['name'];?></textarea>
			       <!-- <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="1"> 代收水费
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="1"> 代收电费
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="1"> 公摊电费
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="1"> 公摊水费
                        </label> -->
			    </div>
			</div>
			<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12 help-block">请输入费用类型，如有多个收费项目用|分割，如水费|电费|垃圾费|停车费。</div>
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
            if (!form['regionid'].value) {
                alert('请选择小区！');
                return false;
            }
            if (!form['name'].value) {
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
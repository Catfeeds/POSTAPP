<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active">
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'branch','p' => 'list'));?>">部门管理</a>
    </li>
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'branch','p' => 'add'));?>">添加部门</a>
    </li>
</ul>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 control-label"></label>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                    <select name="pid" class="form-control">
                        <?php  if(is_array($properties)) { foreach($properties as $property) { ?>
                        <option value="<?php  echo $property['id'];?>"><?php  echo $property['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="table-responsive">
        <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th class="col-lg-2">物业名称</th>
                    <th class="col-lg-3">部门名称</th>
                    <th class="col-lg-5">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['ptitle'];?></td>
                    <td><?php  echo $item['title'];?></td>
                    <td>
                        <span>
                            <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'branch','p'=> 'add','id' => $item['id']))?>" title="编辑" class="btn btn-default btn-sm" >编辑</a>
                            <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'branch','p'=> 'delete','id' => $item['id']))?>" title="删除" class="btn btn-default btn-sm" >删除</a>
						</span>
                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $pager;?>

        </form>
    </div>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
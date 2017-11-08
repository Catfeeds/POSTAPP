<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($op == 'list') { ?>class="active" <?php  } ?>>
    <a href="<?php  echo $this->createWebUrl('guard', array('op' => 'list','regionid' => $regionid));?>">设备管理</a>
    </li>
    <li>
        <a href="<?php  echo $this->createWebUrl('guard', array('op' => 'add','regionid' => $regionid));?>">新增设备</a>
    </li>

</ul>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">设备编号</label>
                <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                    <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                </div>
            </div>
            <div class="form-group">
                <div class="pull-right col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="table-responsive">
        <form action="" method="post">
    <table class="table table-hover table-condensed">
        <thead class="navbar-inner">
        <tr>
            <th style="width:6%">排序</th>
            <th>小区名称</th>
            <th class="col-md-1">区域</th>
            <th class='col-md-1'>楼宇名称</th>
            <th class='col-md-1'>单元号</th>
            <th class='col-md-1'>设备编号</th>
            <th class='col-md-1'>卡状态</th>
            <th class='col-md-1'>设备状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr>
            <td><input type="text" class="form-control" name="displayorder[<?php  echo $item['id'];?>]" value="<?php  echo $item['displayorder'];?>" /></td>
            <td><?php  echo $item['rtitle'];?></td>
            <td><?php  if($item['type'] == 1) { ?>单元门<?php  } else { ?>大门<?php  } ?></td>
            <td><?php  echo $item['title'];?></td>
            <td><?php  if($item['unit']) { ?><?php  echo $item['unit'];?><?php  } else { ?>空<?php  } ?></td>
            <td><?php  echo $item['device_code'];?></td>
            <td><span class="label label-success"><?php  echo $item['status'];?></span></td>
            <td><span class="label label-primary"><?php  echo $item['doorstatus'];?></span></td>
            <td>
                <!-- <a  href="<?php  echo $this->createWebUrl('region',array('op' => 'room','id' => $item['id']))?>" title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" ><i class="glyphicon glyphicon-plus"></i>导入房号</a> -->

                <a href="<?php  echo $this->createWebUrl('guard',array('op' => 'add','id' => $item['id'],'regionid' => $regionid))?>" title="编辑" class="btn btn-default btn-sm" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>编辑</a>

                <a href="<?php  echo $this->createWebUrl('guard',array('op' => 'delete','id' => $item['id'],'regionid' => $regionid))?>" title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除"><i class="fa fa-times"></i>删除</a>
                <a href="<?php  echo $this->createWebUrl('guard',array('op' => 'qrcreate','id' => $item['id']))?>" title="生成二维码" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" data-original-title="生成二维码"><i class="glyphicon glyphicon-plus-sign"></i>生成二维码</a>
            </td>
        </tr>
        <?php  } } ?>
        <tr>
            <td></td>
            <td colspan="6">
                <input name="submit" type="submit" class="btn btn-primary" value="提交">
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </td>
        </tr>
        </tbody>
        <?php  echo $pager;?>
    </table>
        </form>
</div>
</div>
<?php  echo $pager;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
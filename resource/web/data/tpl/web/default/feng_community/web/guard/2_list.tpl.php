<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>设备管理</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('guard')?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site"/>
                        <input type="hidden" name="a" value="entry"/>
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
                        <input type="hidden" name="do" value="guard"/>
                    <div class="row">
                        <div class="col-sm-6 m-b-xs">
                            <a class="btn  btn-primary" href="<?php  echo $this->createWebUrl('guard', array('op' => 'add','regionid' => $regionid));?>"><i class="fa fa-plus"></i> 添加设备</a>
                        </div>
                        <div class="col-sm-6 m-b-xs">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="输入设备编号">
                                <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">搜索</button>
                             <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </span>
                            </div>
                        </div>
                    </div>
                    </form>
        <form action="" method="post">
    <table class="table table-bordered table-condensed">
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
                <a href="<?php  echo $this->createWebUrl('guard',array('op' => 'add','id' => $item['id'],'regionid' => $regionid))?>" title="编辑" class="btn btn-primary btn-sm" >编辑</a>
                <a href="<?php  echo $this->createWebUrl('guard',array('op' => 'qrcreate','id' => $item['id']))?>" title="生成二维码" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" data-original-title="生成二维码">生成二维码</a>
                <a href="<?php  echo $this->createWebUrl('guard',array('op' => 'delete','id' => $item['id'],'regionid' => $regionid))?>" title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
            </td>
        </tr>
        <?php  } } ?>
        <tr>
            <td></td>
            <td colspan="8">
                <input name="submit" type="submit" class="btn btn-sm btn-primary" value="提交">
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </td>
        </tr>
        </tbody>
    </table>
        </form>
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
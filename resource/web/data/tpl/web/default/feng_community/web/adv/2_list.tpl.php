<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>广告管理</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('adv')?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site"/>
                        <input type="hidden" name="a" value="entry"/>
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
                        <input type="hidden" name="do" value="adv"/>
                    <div class="row">
                        <div class="col-sm-6 m-b-xs">
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('adv',array('op' => 'add'))?>"><i class="fa fa-plus"></i> 添加广告</a>
                        </div>
                        <div class="col-sm-2 m-b-xs">
                            <select name="regionid" class="form-control">
                                <option value="0">全部小区</option>
                                <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                <option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?> selected<?php  } ?>><?php  echo $region['title'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="输入关键字">
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">搜索</button>
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            </span>
                            </div>
                        </div>
                    </div>
                    </form>


        <form action="" method="post">
            <table class="table table-bordered table-striped">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:6%">排序</th>
                    <th class="col-md-1">图片</th>
                    <th class="col-md-3">类别</th>
                    <th class="col-md-3">标题</th>
                    <th class="col-md-2">状态</th>
                    <th style="width:60%">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><input type="text" class="form-control" name="displayorder[<?php  echo $item['id'];?>]"
                               value="<?php  echo $item['displayorder'];?>"/></td>
                    <td>
                        <a href="#" class="thumbnail" style="margin-bottom: 0px;">
                            <img src="<?php  echo tomedia($item['thumb'])?>" alt="...">
                        </a>
                    </td>
                    <td><?php  if($item['type'] ==1 ) { ?>首页头部广告<?php  } else if($item['type'] == 2) { ?>智能门禁广告 <?php  } else if($item['type'] == 3) { ?>便民查询广告
                        <?php  } else { ?>小区拼车广告<?php  } ?>
                    </td>
                    <td>
                        <?php  echo $item['title'];?>
                    </td>
                    <td><?php  if($item['status'] == 1) { ?><span class="label label-success">启用</span> <?php  } else { ?><span
                            class="label label-default">禁用</span> <?php  } ?>
                    </td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('adv',array('op' => 'add','id' => $item['id']))?>"
                           title="编辑" class="btn btn-primary btn-sm">编辑</a>

                        <a onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('adv',array('op' => 'delete','id' => $item['id']))?>" title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
                    </td>
                </tr>
                <?php  } } ?>
                <tr>
                    <td></td>
                    <td colspan="5">
                        <input name="submit" type="submit" class="btn btn-primary" value="提交">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
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
<script type="text/javascript">
    $(function () {
        $("#checkAll").click(function () {

            var checked = $(this).get(0).checked;
            var group = $(this).data('group');
            $("#regionid[data-group='" + group + "']").each(function () {
                $(this).get(0).checked = checked;
            })

        });
    });
</script>
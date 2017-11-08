<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>小区活动</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('activity')?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site"/>
                        <input type="hidden" name="a" value="entry"/>
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
                        <input type="hidden" name="do" value="activity"/>
                    <div class="row">
                        <div class="col-sm-6 m-b-xs">
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('activity', array('op' => 'add'));?>"><i class="fa fa-plus"></i> 添加活动</a>
                        </div>
                        <div class="col-sm-6 m-b-xs">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="输入关键字">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">搜索</button>
                                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                                </span>
                            </div>
                        </div>
                    </div>
                    </form>

        <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <thead class="navbar-inner">
                <tr>
                    <th class="col-lg-2">活动标题</th>
                    <th>活动时间</th>
                    <th>发布时间</th>
                    <th class="col-lg-1">预付定金</th>
                    <th>是否置顶</th>
                    <th class="col-lg-3">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $k => $item) { ?>
                <?php  $k = $k+1?>
                <tr>
                    <td><?php  echo $item['title'];?></td>
                    <td><?php  echo date('Y-m-d', $item['starttime']);?>至<?php  echo date('Y-m-d', $item['endtime']);?></td>
                    <td><?php  echo date('Y-m-d H:i:s', $item['createtime']);?></td>
                    <td><?php  if($item['price']) { ?><?php  echo $item['price'];?><?php  } else { ?>0<?php  } ?>元</td>
                    <td>
                        <input type="checkbox" value="1" <?php  if(intval($item['status'])==1) { ?> checked="checked" <?php  } ?>
                        data="<?php  echo $item['id'];?>" class="js-switch_<?php  echo $k;?>"/>

                    </td>
                    <td>
                        <span>
                            <a href="<?php  echo $this->createWebUrl('activity',array('op' => 'add','id' => $item['id']))?>" title="编辑" class="btn btn-primary btn-sm">编辑</a>
                            <a href="<?php  echo $this->createWebUrl('activity',array('op' => 'order','id' => $item['id']))?>" title="" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-sm" data-original-title="订单管理">订单管理</a>
                            <a onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('activity',array('op' => 'delete','id' => $item['id']))?>" title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
						</span>
                    </td>
                </tr>
                <?php  } } ?>
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
        $(':checkbox').on('change', function (e, state) {
            $this = $(this);
            var id = $this.attr('data');
            var status = this.checked ? 1 : 0;
            $this.val(status);
            $.post(location.href, {status: status, id: id}, function () {

            })
        });
        $('.btn').hover(function () {
            $(this).tooltip('show');
        }, function () {
            $(this).tooltip('hide');
        });
    });

</script>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>月租车管理</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('zhpark',array('op' => 'manage'))?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>" />
                        <input type="hidden" name="do" value="zhpark" />
                        <input type="hidden" name="op" value="manage" />
                    <div class="row">
                        <div class="col-sm-12 m-b-xs">
                            <div class="input-group">
                                <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="输入关键字">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"> 搜索</button>
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('zhpark',array('op' => 'manage','p' => 'cloud'))?>"> 同步月租车</a>
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
                    <th style="width:30px;">ID</th>
                    <th >卡号</th>
                    <th>到期时间</th>
                    <th>车牌号</th>
                    <th>车主</th>
                    <th>状态</th>
                    <th>月费标准</th>
                    <th>同步时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['id'];?></td>
                    <td><?php  echo $item['card_no'];?></td>
                    <td><?php  echo date('Y-m-d',$item['valid_date'])?></td>
                    <td><?php  echo $item['car_no'];?></td>
                    <td><?php  echo $item['realname'];?></td>
                    <td><?php  if($item['uid']) { ?><span class="label label-warning">已绑定微信</span><?php  } else { ?><span class="label label-primary">未绑定微信</span><?php  } ?></td>
                    <td><?php  echo $item['month_fee'];?></td>
                    <td><?php  echo date('Y-m-d H:i:s', $item['createtime']);?></td>
                    <td>

                        <span>
                            <a href="<?php  echo $this->createWebUrl('zhpark',array('op' => 'manage','p' => 'update','id' => $item['id']))?>" title="手动延期" class="btn btn-primary btn-sm" >手动延期</a>
						</span>

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
        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
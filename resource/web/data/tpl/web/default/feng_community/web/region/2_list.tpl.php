<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site"/>
            <input type="hidden" name="a" value="entry"/>
            <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
            <input type="hidden" name="do" value="region"/>
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>小区管理</h5>
                        <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('region')?>"></a></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-2 m-b-xs">
                                <a href="<?php  echo $this->createWebUrl('region',array('op' => 'add'))?>" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>添加小区</a>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <?php  echo tpl_form_field_district('reside',array('province' => $reside['province'],'city' => $reside['city'],'district' => $reside['district']));?>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="输入关键字" value="<?php  echo $_GPC['keyword'];?>">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"> 搜索</button>
                                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div id="editable_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>小区名称</th>
                                    <th>物业</th>
                                    <th>姓名</th>
                                    <th>电话</th>
                                    <th>地址</th>
                                    <th>佣金</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                <tr>
                                    <td><?php  echo $item['rtitle'];?></td>
                                    <td><?php  echo $item['ptitle'];?></td>
                                    <td><?php  echo $item['linkmen'];?></td>
                                    <td><?php  echo $item['linkway'];?></td>
                                    <td><div style="overflow:hidden;width:110px;white-space: nowrap;text-overflow: ellipsis;"><?php  echo $item['address'];?></div></td>
                                    <td><?php  if($item['commission']) { ?><?php  echo $item['commission'];?><?php  } else { ?>0<?php  } ?>元</td>
                                    <td><label class="label <?php  if($item['status'] == 1) { ?>label-primary<?php  } else { ?>label-default <?php  } ?>" onclick="show(<?php  echo $item['id'];?>,<?php  echo $item['status'];?>)"><?php  if($item['status'] == 1) { ?>显示<?php  } else { ?>隐藏<?php  } ?></label></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('region',array('op' => 'add','id' => $item['id']))?>" title="编辑"  >编辑</a>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('region',array('op' => 'open','regionid' => $item['id']))?>" title="开门记录"  >开门记录</a>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('region',array('op' => 'set','regionid' => $item['id']))?>" title="小区设置" >小区设置</a>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('region', array('op' => 'fields','regionid' => $item['id']));?>" title="注册字段配置"  >注册字段配置</a>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('region', array('op' => 'sms','regionid' => $item['id']));?>" title="短信配置"  >短信配置</a>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('region', array('op' => 'xqprint','regionid' => $item['id']));?>" title="打印机配置" >打印机配置</a>
                                        <a class="btn btn-primary btn-sm" href="<?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('home',array('regionid' => $item['id']))?>" title="" target="_blank">查看链接</a>
                                        <a  class="btn btn-default btn-sm"onclick="return confirm('删除小区，将要删除该小区下所有的小区用户，此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('region',array('op' => 'delete','id' => $item['id']))?>" title="删除" data-toggle="tooltip" data-placement="top"  data-original-title="删除">删除</a>
                                    </td>
                                </tr>
                                <?php  } } ?>
                                </tbody>
                            </table>
                        </div>
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
        </form>

    </div>
</div>

<script>
    function show(id,status) {
        var id=id;
        var status=status;
        $.post("<?php  echo $this->createWebUrl('region',array('op'=> 'change'))?>",{id:id,status:status},function (data) {
            if(data.status){

                window.location.reload();
            }

        },'json')
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
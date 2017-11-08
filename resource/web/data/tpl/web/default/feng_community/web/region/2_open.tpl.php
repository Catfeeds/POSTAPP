<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><a class="glyphicon glyphicon-arrow-left" href="<?php  echo $this->createWebUrl('region')?>"></a>&nbsp;&nbsp;&nbsp;开门记录</h5>
                        <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('region',array('op' => 'open','regionid' => $regionid))?>"></a></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <form action="./index.php" method="get" class="form-horizontal" role="form">
                                <input type="hidden" name="c" value="site"/>
                                <input type="hidden" name="a" value="entry"/>
                                <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
                                <input type="hidden" name="do" value="region"/>
                                <input type="hidden" name="op" value="open"/>
                                <input type="hidden" name="regionid" value="<?php  echo $regionid;?>"/>
                            <div class="col-sm-3 m-b-xs">
                                <input type="text" placeholder="请输入业主姓名" class="form-control" name="realname" value="<?php  echo $_GPC['realname'];?>">
                            </div>
                            <div class="col-sm-3 m-b-xs">
                                <input type="text" placeholder="请输入业主手机" class="form-control" name="mobile" value="<?php  echo $_GPC['mobile'];?>">
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入身份证" class="form-control" name="idcard" value="<?php  echo $_GPC['idcard'];?>">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn  btn-primary"> 搜索</button>
                                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                                    </span>
                                </div>
                            </div>
                        </form>
                        </div>
                            <form action="" method="post" class="form-horizontal" role="form">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox checkbox-success checkbox-inline">
                                            <input type="checkbox" id="checkids"
                                                   onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
                                            <label for="checkids"> </label>
                                        </div>
                                    </th>
                                    <th>小区名称</th>
                                    <th>姓名</th>
                                    <th>手机</th>
                                    <th>开门地址</th>
                                    <th>区域</th>
                                    <th>开门时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                <tr>
                                    <td>
                                        <div class="checkbox checkbox-success checkbox-inline">
                                            <input type="checkbox" type="checkbox" name="ids[]" id="ids"
                                                   value="<?php  echo $item['id'];?>">
                                            <label for="ids"> </label>
                                        </div>

                                    </td>
                                    <td><?php  echo $item['title'];?></td>
                                    <td>
                                        <?php  echo $item['realname'];?>
                                    </td>
                                    <td><?php  echo $item['mobile'];?></td>
                                    <td><?php  if($item['area']) { ?><?php  echo $item['area'];?>区<?php  } ?><?php  if($item['build']) { ?><?php  echo $item['build'];?>栋<?php  } ?><?php  if($item['unit']) { ?><?php  echo $item['unit'];?>单元<?php  } ?><?php  if($item['room']) { ?><?php  echo $item['room'];?>室<?php  } ?>
                                    </td>
                                    <td><?php  echo $item['type'];?></td>
                                    <td><?php  echo date('Y-m-d H:i:s',$item['createtime'])?></td>

                                </tr>
                                <?php  } } ?>
                                </tbody>
                            </table>
                            <table class="footable table table-stripped toggle-arrow-tiny footable-loaded tablet breakpoint">
                                <thead>
                                <?php  if($list) { ?>
                                <tr>
                                    <td >
                                        <input type="submit" class="btn btn-primary btn-sm" name="export" value="批量导出"/>
                                        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>"/>
                                    </td>
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
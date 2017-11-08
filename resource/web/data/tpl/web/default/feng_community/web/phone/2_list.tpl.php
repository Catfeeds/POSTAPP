<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>便民号码</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('phone')?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site"/>
                        <input type="hidden" name="a" value="entry"/>
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
                        <input type="hidden" name="do" value="phone"/>
                    <div class="row">
                        <div class="col-sm-1 m-b-xs">
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('phone',array('op' => 'add'))?>"><i class="fa fa-plus"></i> 添加号码</a></span>
                        </div>
                        <div class="col-sm-5 m-b-xs">
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('phone',array('op' => 'post'))?>">导入号码</a>
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
        <form action="" method="post">
        <table class="table table-bordered">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:30px;">
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="checkids"
                                   onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
                            <label for="checkids"> </label>
                        </div>
                    </th>
                    <th style="width:5%;">排序</th>
                    <th style="width:8%">图片</th>
                    <th style="width:12%;">号码</th>
                    <th>号码描述</th>
                    <th style="width:60%;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td>
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" type="checkbox" name="ids[]" id="ids_<?php  echo $item['id'];?>"
                                   value="<?php  echo $item['id'];?>">
                            <label for="ids_<?php  echo $item['id'];?>"></label>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="displayorder[<?php  echo $item['id'];?>]" value="<?php  echo $item['displayorder'];?>">
                    </td>
                    <td>
                        <img src="<?php  echo tomedia($item['thumb'])?>" class="img-rounded" style="width:40px;height:40px;">
                    </td>
                    <td><?php  echo $item['phone'];?></td>
                    <td><?php  echo $item['content'];?></td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('phone',array('op' => 'add','id' => $item['id']))?>" title="编辑" class="btn btn-primary btn-sm" >编辑</a>
                        
                        <a onclick="return confirm('删除号码，此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('phone',array('op' => 'delete','id' => $item['id']))?>" title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
            <table class="footable table table-stripped toggle-arrow-tiny footable-loaded tablet breakpoint">
                <thead>
                <?php  if($list) { ?>
                <tr>
                    <td class="text-left">
                        <input name="submit" type="submit" class="btn btn-primary btn-sm" value="提交">
                        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                        <input type="submit" class="btn btn-danger btn-sm" name="delete" value="批量删除" /> &nbsp;
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
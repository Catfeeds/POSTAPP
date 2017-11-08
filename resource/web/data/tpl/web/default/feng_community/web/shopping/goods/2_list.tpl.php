<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>商品管理</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('shopping',array('op' => 'goods','operation' => 'list'))?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>" />
                        <input type="hidden" name="do" value="shopping" />
                        <input type="hidden" name="op" value="goods" />
                        <input type="hidden" name="operation" value="list" />
                    <div class="row">
                        <div class="col-sm-6 m-b-xs">
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('shopping', array('op' => 'goods','operation' =>'add'))?>"><i class="fa fa-plus"></i> 添加商品</a>
                        </div>
                        <div class="col-sm-2 m-b-xs">
                            <select name="status" class="form-control">
                                <option value="3" <?php  if($_GPC['status'] == 3) { ?>selected<?php  } ?>>请选择商品状态</option>
                                <option value="1" <?php  if($_GPC['status'] == 1) { ?>selected<?php  } ?>>上架</option>
                                <option value="0" <?php  if(empty($_GPC['status'])) { ?>selected<?php  } ?>>下架</option>
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


            <form class="form-horizontal form" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:30px;">
                            <div class="checkbox checkbox-success checkbox-inline">
                                <input type="checkbox" id="checkids"
                                       onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
                                <label for="checkids"> </label>
                            </div>
                        </th>
                        <th style="width:5%;">ID</th>
                        <th style="width:25%;">商品标题</th>
                        <th style="width:10%;">库存</th>
                        <th style="width:10%;">销售价</th>
                        <th style="width:10%;">市场价</th>
                        <th style="width:15%;">状态(点击可修改)</th>
                        <th style="width:30%;">操作</th>
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
                        <td><?php  echo $item['id'];?></td>
                        <td><span class="text-error">[<?php  echo $category[$item['pcate']]['name'];?>]-> [<?php  echo $category[$item['child']]['name'];?>]</span><?php  echo $item['title'];?></td>
                        <td><?php  echo $item['total'];?><?php  echo $item['unit'];?></td>
                        <td><?php  echo $item['marketprice'];?></td>
                        <td><?php  echo $item['productprice'];?></td>
                        <td>
                            <label data='<?php  echo $item['status'];?>' class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' onclick="setProperty(this,<?php  echo $item['id'];?>,'status')">
                            <?php  if($item['status']==1) { ?>上架<?php  } else { ?>下架<?php  } ?>
                            </label>
                        </td>
                        <td>
                            <a href="<?php  echo $this->createWebUrl('shopping', array('id' => $item['id'], 'op' => 'goods','operation' => 'add'))?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="编辑">编辑</a>&nbsp;&nbsp;
                            <a href="<?php  echo $this->createWebUrl('shopping', array('id' => $item['id'], 'op' => 'goods','operation' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除">删除</a>
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
                            <input name="token" type="hidden" value="<?php  echo $_W['token'];?>"/>
                            <input type="submit" class="btn btn-danger btn-sm" name="delete" value="批量删除"/> &nbsp;
                            <button type="submit" name="plsj" value="1" class="btn btn-warning btn-sm">批量上架</button>
                            <button type="submit" name="plxj" value="1" class="btn btn-warning btn-sm">批量下架</button>
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
<script type="text/javascript">
function setProperty(obj, id, type) {
    $(obj).html($(obj).html() + "...");
    $.post("<?php  echo $this->createWebUrl('shopping',array('op' => 'setgoodsproperty'))?>", {
        id: id,
        type: type,
        data: obj.getAttribute("data")
    }, function(d) {
        $(obj).html($(obj).html().replace("...", ""));
        if (type == 'isrecommand') {
            $(obj).html(d.data == '1' ? '首页' : '普通');
        }
        if (type == 'status') {
            $(obj).html(d.data == '1' ? '上架' : '下架');
        }
        $(obj).attr("data", d.data);
        if (d.result == 1) {
            $(obj).toggleClass("label-info");
        }
    }, "json");
}
</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
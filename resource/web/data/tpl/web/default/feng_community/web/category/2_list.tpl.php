<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>分类管理</h5>
                </div>
                <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-2 m-b-xs">
                                <a href="<?php  echo $this->createWebUrl('category', array('op' => 'add','type' => $_GPC['type']))?>" class="btn btn-primary"><i class="fa fa-plus"></i>添加分类</a>
                            </div>
                        </div>
        <form action="" method="post" onsubmit="return formcheck(this)">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width:10px;"></th>
                        <th style="width:80px;">显示顺序</th>
                        <th>分类名称</th>
                        <th style="width:50%;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($category)) { foreach($category as $key => $row) { ?>
                    <tr>
                        <td>
                            <a href="javascript:;">
                                <i class="icon-chevron-down"></i>
                            </a>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>">
                        </td>
                        <td>
                            <?php  if($row['thumb']) { ?> <img src="<?php  echo tomedia($row['thumb'])?>" width='30' height="30" onerror="$(this).remove()" style='padding:1px;border: 1px solid #ccc;float:left;' /><?php  } ?>
                            <div class="type-parent"><?php  echo $row['name'];?>&nbsp;&nbsp;
                                <?php  if(empty($row['parentid'])) { ?>
                                <?php  if($_GPC['type'] == 5 || $_GPC['type'] == 6) { ?>
                                <a href="<?php  echo $this->createWebUrl('category', array('parentid' => $row['id'], 'op' => 'add','type' => $_GPC['type']))?>">
                                    <i class="glyphicon glyphicon-plus-sign"></i> 添加子分类</a>
                                <?php  } ?>
                                <?php  } ?>
                            </div>
                        </td>

                        <td>
                            <a href="<?php  echo $this->createWebUrl('category', array('op' => 'add','id' => $row['id'],'type' => $_GPC['type']))?>" title="编辑" class="btn btn-primary btn-sm">编辑</a>&nbsp;&nbsp;
                            <a href="<?php  echo $this->createWebUrl('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
                        </td>
                   </tr>
                        <?php  if(is_array($children[$row['id']])) { foreach($children[$row['id']] as $row) { ?>
                        <tr>
                            <td></td>
                            <td>
                                <hr>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>" style="width: 80px;display: block;float:left">
                                &nbsp;&nbsp;
                               <?php  if($row['thumb']) { ?>
                                <img src="<?php  echo $row['thumb'];?>" width='30' height="30" onerror="$(this).remove()" style='margin-left: 4px;padding:1px;border: 1px solid #ccc;float:left;display: block;float: left;' /><?php  } ?>
                                <div style="line-height:-20px;"><?php  echo $row['name'];?>&nbsp;&nbsp;</div>

                            </td>
                            <td>
                            <a href="<?php  echo $this->createWebUrl('category', array('op' => 'add', 'parentid'=>$row['parentid'],'id' => $row['id'],'type' => $_GPC['type']))?>" title="编辑" class="btn btn-primary btn-sm">编辑</a>&nbsp;&nbsp;
                            <a href="<?php  echo $this->createWebUrl('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
                            </td>
                        </tr>
                        <?php  } } ?> 

                        <?php  } } ?>
                        <tr>
                            <td></td>
                            <td colspan="3">
                                <input name="submit" type="submit" class="btn btn-primary" value="提交">
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            </td>
                        </tr>
                </tbody>
            </table>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function setProperty(obj,id,type){
        $(obj).html($(obj).html() + "...");
        $.post("<?php  echo $this->createWebUrl('shopping',array('op' => 'set'))?>"
            ,{id:id,type:type, data: obj.getAttribute("data")}
            ,function(d){
                $(obj).html($(obj).html().replace("...",""));
                if(type=='isshow'){
                    $(obj).html( d.data=='1'?'首页推荐':'首页关闭');
                }
                $(obj).attr("data",d.data);
                if(d.result==1){
                    $(obj).toggleClass("label-info");
                }
            }
            ,"json"
        );
    }
</script>


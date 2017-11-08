<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($operation=='list') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('system', array('op'=> 'menu','operation' => 'list'))?>">管理菜单</a></li>


</ul>

<div class="panel panel-default" >
    <div class="table-responsive">
        <form action="" method="post" onsubmit="return formcheck(this)">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="col-sm-1">显示顺序</th>
                    <th class="col-sm-2">菜单名称</th>
                    <th class="col-sm-2">显示</th>
                    <th class="col-sm-10">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>

                <tr>

                    <td>
                        <div class="pad-bottom "><?php  echo $row['displayorder'];?></div>
                    </td>
                    <td>
                        <div class="type-parent"><?php  echo $row['title'];?>&nbsp;&nbsp;

                        </div>
                    </td>
                    <th>
                        <input type="checkbox" name="status" data="<?php  echo $row['status'];?>" data-id="<?php  echo $row['id'];?>" <?php  if($row['status'] == 1 ) { ?>checked="checked"<?php  } ?>>
                    </th>
                    <td>

                        <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('menu',array('op'=> 'add','id'=> $row['id']))?>" >
                            <i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>编辑</a>

                    </td>
                </tr>

                <?php  if(is_array($children[$row['id']])) { foreach($children[$row['id']] as $k => $item) { ?>
                <tr>

                    <td> <div class="pad-bottom "><?php  echo $item['displayorder'];?></div></td>
                    <td>
                        <div style="float:left;line-height:60px;"><?php  echo $item['title'];?>&nbsp;&nbsp;
                        </div>
                    </td>
                    <td>
                        <input type="checkbox" data="<?php  echo $item['status'];?>" data-id="<?php  echo $item['id'];?>" <?php  if($item['status'] == 1 ) { ?>checked="checked"<?php  } ?>></span>
                    </td>
                    <td>
                        <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('system',array('op'=> 'menu','operation'=> 'add','id'=> $item['id']))?>" >
                            <i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>编辑</a>
                    </td>
                </tr>
                <?php  } } ?>
                <?php  } } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

<script>

    require(['bootstrap.switch', 'util'], function ($, u) {
        $(function () {
            $(':checkbox').bootstrapSwitch();
            $(':checkbox').on('switchChange.bootstrapSwitch', function (e, state) {
                $this = $(this);
                var id = $this.attr('data-id');
                var status = this.checked ? 1 : 0;
                $this.val(status);
                $.post("<?php  echo $this->createWebUrl('menu')?>",{id:id,status:status},function () {

                })
            });
            $('.btn').hover(function () {
                $(this).tooltip('显示');
            }, function () {
                $(this).tooltip('隐藏');
            });
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
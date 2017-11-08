<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<style>
    .table>thead>tr>th {
        border-bottom: 0;
    }

    .table>thead>tr>th .checkbox label {
        font-weight: bold;
    }

    .table>tbody>tr>td {
        border-top: 0;
    }

    .table .checkbox {
        padding-top: 4px;
    }
</style>
<ul class="nav nav-tabs">
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'list'));?>">管理管理员</a>
    </li>
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'add'));?>">添加管理员</a>
    </li>
    <li class="active">
        <a href="#">设置权限</a>
    </li>
</ul>
<form class="form-horizontal form" action="" method="post">
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table">
                <?php  if(is_array($menus)) { foreach($menus as $sections) { ?>
                <thead>
                <tr class="info">
                    <th colspan="6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="menus[]" class='perm-all' data-group="<?php  echo $sections['method'];?>" value="<?php  echo $sections['id'];?>"
                                       <?php  if(in_array($sections['id'],$mmenus)) { ?>checked<?php  } ?>><?php  echo $sections['title'];?></label>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody class="system_platform">
                <?php  $i = 1;?>
                <?php  if(is_array($sections['items'])) { foreach($sections['items'] as $menu) { ?>
                <?php  if($i%6 == 1 || $i == 1) { ?><tr><?php  } ?>
                    <td>
                        <div class="checkbox">
                            <label><input type="checkbox" class="perm-item" value="<?php  echo $menu['id'];?>" name="menus[]" data-group="<?php  echo $menu['method'];?>" value="<?php  echo $menu['id'];?>" <?php  if(in_array($menu['id'],$mmenus)) { ?>checked<?php  } ?>><?php  echo $menu['title'];?></label>
                        </div>
                    </td>
                    <?php  if($i%6 == 0) { ?></tr><?php  } ?>
                <?php  $i++;?>
                <?php  } } ?>
                <?php  if($i%6 != 1) { ?></tr><?php  } ?>
                </tbody>
                <?php  } } ?>
                <?php  if($plugins) { ?>
                <thead>
                <tr class="info">
                    <th colspan="6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class='perm-all' data-group="plugin">插件</label>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody class="system_platform">

                    <tr>
                        <?php  if(is_array($plugins)) { foreach($plugins as $plugin) { ?>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="perm-item"  name="plugin[]" data-group="plugin" value="<?php  echo $plugin['id'];?>" <?php  if(in_array($plugin['id'],$xqplugin)) { ?>checked<?php  } ?>><?php  echo $plugin['title'];?>
                            </label>
                        </div>
                    </td>
                        <?php  } } ?>
                    </tr>

                </tbody>
                <?php  } ?>
            </table>
        </div>
    </div>
    <button type="submit" class="btn btn-primary span3" name="submit" value="提交" onclick="if ($('input:checkbox:checked').size() == 0) {return confirm('您未勾选任何菜单权限，意味着允许用户使用所有功能。确定吗？')}">提交</button>
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</form>
<script>
    $(function(){
        $('.perm-all').click(function(){
            var checked = $(this).get(0).checked;
            var group = $(this).data('group');
            $(".perm-item[data-group='" +group + "']").each(function(){
                $(this).get(0).checked = checked;
            })
        })
        $('.perm-item').click(function(){
            var group = $(this).data('group');
            var child = $(this).data('child');
            var check = false;
            $(".perm-item[data-group='" +group + "']").each(function(){
                if($(this).get(0).checked){
                    check =true;
                    return false;
                }
            });
            $(".perm-all[data-group=" + group + "]").get(0).checked = check;

        });
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

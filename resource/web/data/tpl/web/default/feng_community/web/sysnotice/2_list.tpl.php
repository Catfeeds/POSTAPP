<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('sysnotice', array('op' => 'list'));?>">管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('sysnotice', array('op' => 'add'));?>">添加公告</a></li>
</ul>
<div class="panel panel-default">
    <div class="table-responsive">
        <form class="form-horizontal form" method="post" >
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th class="col-sm-1">id</th>
                    <th>公告标题</th>
                    <th>发布日期</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td>
                        <?php  echo $item['id'];?>
                    </td>
                    <td><?php  echo $item['title'];?></td>
                    <td><?php  echo date('Y-m-d H:i:s', $item['createtime']);?></td>
                    <td>
                        <span>
							<a href="<?php  echo $this->createWebUrl('sysnotice', array('op' => 'add', 'id'=>$item['id']))?>" title="编辑" class="btn btn-default btn-sm"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>编辑</a>
								<a onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('sysnotice',array('op'=>'delete','id'=>$item['id']))?>" title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-times"></i>删除</a>

                        </span>
                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $pager;?>

        </form>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
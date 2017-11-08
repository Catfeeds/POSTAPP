<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">操作日志</a></li>
</ul>
<div class="panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
            <thead class="navbar-inner">
            <tr>
                <th class="col-sm-1">ID</th>
                <th class="col-sm-1">操作员</th>
                <th class="col-sm-2">类型</th>
                <th class="col-sm-2">操作内容</th>
                <th class="col-sm-2">操作IP</th>
                <th class="col-sm-2">操作时间</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td><?php  echo $item['id'];?></td>
                <td><?php  echo $item['username'];?></td>
                <td><?php  echo $item['name'];?></td>
                <td><?php  echo $item['op'];?></td>
                <td><?php  echo $item['ip'];?></td>
                <td>
                    <?php  echo date('Y-m-d H:i',$item['createtime'])?>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<?php  echo $pager;?>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li  class="active"><a href="<?php  echo $this->createWebUrl('staff', array('op' => 'print','p' => 'list'));?>">管理打印机</a></li>
    <li><a href="<?php  echo $this->createWebUrl('staff', array('op' => 'print','p' => 'add'));?>">添加打印机</a></li>
</ul>
<div class="panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
            <thead class="navbar-inner">
            <tr>
                <th class="col-lg-2">终端编号</th>

                <th class="col-lg-8">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td><?php  echo $item['deviceNo'];?></td>

                <td>
                    <a class="btn btn-primary btn-sm"  href="<?php  echo $this->createWebUrl('staff',array('op' => 'print','id' => $item['id'],'p' => 'add'))?>"><i class="fa fa-edit"></i> 编辑</a>
                    <a title="删除" class="btn btn-primary btn-sm" onclick="del(<?php  echo $item['id'];?>)" ><i class="fa fa-trash-o text-sg"></i> 删除</a>

                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>

<script type="text/javascript">

    function del(id){
        var id=id;
        var url = "<?php  echo $this->createWebUrl('staff',array('op' => 'print','p' => 'delete'),true)?>";
        $.post(url,
            {
                id:id
            },
            function(msg){
                if (msg.status == 1) {
                    setTimeout(function(){
                        window.location.reload();
                    },100);
                };

            },
            'json');
    }

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
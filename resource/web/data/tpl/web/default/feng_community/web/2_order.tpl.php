<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('cash', array('op' => 'list'));?>">提现申请</a></li>
</ul>
<div class="panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
            <thead class="navbar-inner">
            <tr>
                <th class="col-sm-3">提现单号</th>
                <th class="col-sm-1">提现金额</th>
                <th class="col-sm-2">打款账号</th>
                <th class="col-sm-2">提现账号</th>
                <th class="col-sm-2">提现时间</th>
                <th class="col-sm-1">状态</th>
                <th class="col-sm-2">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td><?php  echo $item['ordersn'];?></td>
                <td><?php  echo $item['price'];?>元</td>
                <td><?php  echo $item['pay'];?></td>
                <td>
                    <?php 
                                    load()->model('user');
                    $result = user_single($item['uid']);
                    echo $result['username'];



                    ?>

                </td>
                <td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
                <td><label  class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' ><?php  if($item['status']==1) { ?>已处理<?php  } else { ?>未处理<?php  } ?></label></td>
                <td>
                    <!--<a class="btn btn-danger btn-sm" onclick="del(<?php  echo $item['id'];?>)" title="删除"><i class='glyphicon glyphicon-remove-circle'></i>删除</a>-->
                    <?php  if(empty($user) || $user['type'] == 1) { ?>
                    <?php  if(empty($item['status'])) { ?>
                    <a href="javascript:;" class="btn btn-info btn-sm" title="处理提现" onclick="tx(<?php  echo $item['id'];?>)"><i class="glyphicon glyphicon-ok-circle"></i> 处理提现</a>
                    <?php  } ?>
                    <?php  } ?>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<?php  echo $pager;?>
<script type="text/javascript">
    function tx(id) {
        var id = id;
        var url = "<?php  echo $this->createWebUrl('cash',array('op' => 'tx'))?>";
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
    function del(id) {
        var id = id;
        var url = "<?php  echo $this->createWebUrl('cash',array('op' => 'del'))?>";
        $.post(url, {
                id: id
            },
            function(msg) {
                if (msg.status == 1) {
                    setTimeout(function() {
                        window.location.reload();
                    }, 100);
                };

            },
            'json');
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active">
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'notice','p' => 'list'));?>">管理接收员</a>
    </li>
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'notice','p' => 'add'));?>">添加接收员</a>
    </li>
</ul>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 control-label"></label>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                    <input type="text" name="keyword" placeholder="输入手机号搜索" class="form-control">
                </div>
                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="table-responsive">
        <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th class="col-lg-1">姓名</th>
                    <th class="col-lg-2">通知方式</th>
                    <th class="col-lg-1">报修通知</th>
                    <th class="col-lg-1">投诉通知</th>
                    <th class="col-lg-1">超市通知</th>
                    <th class="col-lg-1">商家通知</th>
                    <th class="col-lg-1">家政通知</th>
                    <th class="col-lg-1">缴费通知</th>
                    <th class="col-lg-5">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['realname'];?></td>
                    <td><?php  if($item['type'] == 1) { ?>微信通知 <?php  } else if($item['type'] == 2) { ?> 短信通知<?php  } else { ?> 全部通知<?php  } ?></td>
                    <td>

                            <input type="checkbox" onclick="verity('repair',<?php  echo $item['id'];?>,this)" data="<?php  echo $item['repair'];?>" <?php  if($item['repair'] == 1) { ?>checked="checked"<?php  } ?>>

                    </td>
                    <td>

                        <input type="checkbox" onclick="verity('report',<?php  echo $item['id'];?>,this)" data="<?php  echo $item['report'];?>" <?php  if($item['report'] == 1) { ?>checked="checked"<?php  } ?> >

                    </td>
                    <td>

                        <input type="checkbox" onclick="verity('shopping',<?php  echo $item['id'];?>,this)" data="<?php  echo $item['shopping'];?>" <?php  if($item['shopping'] == 1 ) { ?>checked="checked"<?php  } ?> >

                    </td>
                    <td>

                        <input type="checkbox" onclick="verity('business',<?php  echo $item['id'];?>,this)" data="<?php  echo $item['business'];?>" <?php  if($item['business'] == 1 ) { ?>checked="checked"<?php  } ?> >

                    </td>
                    <td>

                        <input type="checkbox" onclick="verity('homemaking',<?php  echo $item['id'];?>,this)" data="<?php  echo $item['homemaking'];?>" <?php  if($item['homemaking'] == 1 ) { ?>checked="checked"<?php  } ?> >

                    </td>
                    <td>

                        <input type="checkbox" onclick="verity('cost',<?php  echo $item['id'];?>,this)" <?php  if($item['cost'] == 1 ) { ?>checked="checked"<?php  } ?> >

                    </td>
                    <td>
                        <a title="编辑" href="<?php  echo $this->createWebUrl('staff',array('op'=> 'notice','p'=>'add','id' => $item['id']))?>">编辑</a>&nbsp;&nbsp;

                        <a title="删除" onclick="del('<?php  echo $item['id'];?>')">删除</a>

                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
            <?php  echo $pager;?>

        </form>
    </div>
</div>
<script>
    function del(id) {
        var id = id;
        var url = "<?php  echo $this->createWebUrl('staff',array('op' => 'notice','p'=> 'delete'),true)?>";
        $.post(url,
            {
                id: id
            },
            function (msg) {
                if (msg.status == 1) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 100);
                }
                ;

            },
            'json');
    }
    function verity(type,id,obj) {

        $.post("<?php  echo $this->createWebUrl('staff',array('op'=>'notice','p'=> 'verify'))?>",{id:id,type:type,status:obj.getAttribute("data")},function () {

        })
    }
//    require(['bootstrap.switch', 'util'], function ($, u) {
//        $(function () {
//            $(':checkbox').bootstrapSwitch();
//            $(':checkbox').on('switchChange.bootstrapSwitch', function (e, state) {
//                $this = $(this);
//                var id = $this.attr('id');
//                var status = this.checked ? 1 : 0;
//                $this.val(status)
//                var data = $this.attr('data-id');
//                $.post("<?php  echo $this->createWebUrl('staff',array('op'=>'notice','p'=> 'verify'))?>",{id:id,data:data,status:status},function () {
//
//                })
//            });
//        });
//    });
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
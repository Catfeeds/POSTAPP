<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>接收员管理</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-2 m-b-xs">
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('homemaking', array('op'=>'manage','operation' => 'add'));?>"><i class="fa fa-plus"></i> 添加接收员</a>
                        </div>
                    </div>
    <table class="table table-bordered table-bordered" >
        <thead class="navbar-inner">
        <tr>
            <th style="width:40px;">姓名</th>
            <th style="width:40px;">通知方式</th>
            <th style="width:60px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr>
            <td><?php  echo $item['realname'];?></td>
            <td><?php  if($item['type'] == 1) { ?>模板消息通知<?php  } else if($item['type'] == 2) { ?>短信通知<?php  } else if($item['type'] == 3) { ?> 全部通知<?php  } else { ?>暂不通知<?php  } ?></td>
            <td>
                <a class="btn btn-primary btn-sm"  href="<?php  echo $this->createWebUrl('homemaking',array('op' => 'manage','operation' => 'add','id' => $item['id']))?>"> 编辑</a>
                <a title="删除" class="btn btn-default btn-sm" onclick="del('<?php  echo $item['id'];?>')" > 删除</a>

            </td>
        </tr>
        <?php  } } ?>
        </tbody>
    </table>
                    <table class="footable table table-stripped toggle-arrow-tiny footable-loaded tablet breakpoint">
                        <thead>
                        <?php  if($list) { ?>
                        <tr>
                            <td class="footable-visible"><ul class="pagination pull-right"><?php  echo $pager;?></ul></td>
                        </tr>
                        <?php  } else { ?>
                        <tr style="text-align: center"><td >没有找到对应的记录</td></tr>
                        <?php  } ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function del(id){
        var id=id;
        var url = "<?php  echo $this->createWebUrl('homemaking',array('op' => 'manage','operation' => 'del'),true)?>";
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

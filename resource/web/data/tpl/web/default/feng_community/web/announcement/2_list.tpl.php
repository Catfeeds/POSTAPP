<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('announcement', array('op' => 'list'));?>">管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('announcement', array('op' => 'add'));?>">创建公告</a></li>
</ul>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">公告标题</label>
                <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                    <input class="form-control" name="title" id="" type="text" value="<?php  echo $_GPC['title'];?>">
                </div>
            </div>
            <div class="form-group">
                <div class="pull-right col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
            </div>
        </form>
    </div>
</div>
<form class="form-horizontal form" method="post">
    <div class="panel panel-default">
        <div class="panel-body table-responsive">

            <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
                <thead class="navbar-inner">
                <tr>
                    <th class="col-sm-1">删?</th>
                    <th>公告标题</th>
                    <th>发布日期</th>
                    <th style="width:70px">状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td>
                        <input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>">
                    </td>
                    <td><?php  echo $item['title'];?></td>
                    <td><?php  echo date('Y-m-d H:i:s', $item['createtime']);?></td>
                    <td><label class="label <?php  if($item['enable'] == 1) { ?>label-primary<?php  } else { ?>label-default <?php  } ?>"
                               onclick="show(<?php  echo $item['id'];?>,<?php  echo $item['enable'];?>)"><?php  if($item['enable'] ==1) { ?>显示<?php  } else { ?>隐藏<?php  } ?></label></td>
                    <td>
                        <span>
                            <a href="<?php  echo $this->createWebUrl('announcement', array('op' => 'sms', 'id'=>$item['id']))?>"
                               title="短信发送" class="btn btn-info btn-sm"><i class="fa fa-comments" data-toggle="tooltip"
                                                                           data-placement="top"></i>短信发送</a>

                            <a href="<?php  echo $this->createWebUrl('announcement', array('op' => 'send', 'id'=>$item['id']))?>"
                               title="微信发送" class="btn btn-warning btn-sm"><i class="fa fa-comments"
                                                                              data-toggle="tooltip"
                                                                              data-placement="top"></i>微信发送</a>
							<a href="<?php  echo $this->createWebUrl('announcement', array('op' => 'add', 'id'=>$item['id']))?>"
                               title="编辑" class="btn btn-default btn-sm"><i class="fa fa-edit" data-toggle="tooltip"
                                                                            data-placement="top"></i>编辑</a>
								<a onclick="return confirm('此操作不可恢复，确认吗？'); return false;"
                                   href="<?php  echo $this->createWebUrl('announcement',array('op'=>'delete','id'=>$item['id']))?>"
                                   title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i
                                        class="fa fa-times"></i>删除</a>

                        </span>
                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>

            <table class="table table-hover">
                <tr>
                    <td width="30">
                        <input type="checkbox"
                               onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"/>
                    </td>
                    <td class="text-left">
                        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>"/>
                        <button class="btn btn-danger btn-sm" type="submit" name="delete" value="1"><i
                                class="glyphicon glyphicon-remove-circle"></i>批量删除
                        </button>
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <?php  echo $pager;?>
</form>

<script>
    function show(id, enable) {
        var id = id;
        var enable = enable;
        $.post("<?php  echo $this->createWebUrl('announcement',array('op'=> 'change'))?>", {
            id: id,
            enable: enable
        }, function (data) {
            if (data.status) {

                window.location.reload();
            }

        }, 'json')
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
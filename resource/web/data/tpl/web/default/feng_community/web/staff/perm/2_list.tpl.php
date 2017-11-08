<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active">
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'list','uuid' => $_GPC['uuid']));?>">管理管理员</a>
    </li>
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'add','uuid' => $_GPC['uuid']));?>">添加管理员</a>
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
                    <th class="col-lg-1">管理员账号</th>
                    <th class="col-lg-1">姓名</th>
                    <th class="col-lg-1">手机号</th>
                    <th style="width: 120px;">添加时间</th>
                    <th class="col-lg-7">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['username'];?></td>
                    <td><?php  echo $item['realname'];?></td>
                    <td><?php  echo $item['mobile'];?></td>
                    <td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
                    <td>

                            <span>
                                    <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'perm','p'=> 'menu','id' => $item['id']));?>"
                                       title="" data-toggle="tooltip" data-placement="top"
                                       data-original-title="设置权限" class="btn btn-default btn-sm">
                                        <i class='glyphicon glyphicon-plus'></i>
                                    设置后台权限</a>
                                </span>
                        <span>
                                    <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'perm','p' => 'commission','id' => $item['id']));?>"
                                       title="" data-toggle="tooltip" data-placement="top"
                                       data-original-title="设置分成" class="btn btn-default btn-sm">
                                        <i class='glyphicon glyphicon-plus'></i>
                                    设置分成</a>
                                    <span>
                                    <a href="<?php  echo $this->createWebUrl('staff',array('op'=> 'perm','p' => 'm','id' => $item['id']));?>"
                                       title="" data-toggle="tooltip" data-placement="top"
                                       data-original-title="授权手机端权限" class="btn btn-default btn-sm">
                                        <i class='glyphicon glyphicon-th-list'></i>
                                    授权手机端权限</a>
                                        <span>
                                    <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'perm','p'=> 'list','uuid' => $item['uid']));?>"
                                       title="" data-toggle="tooltip" data-placement="top"
                                       class="btn btn-default btn-sm" data-original-title="子管理员">
                                        <i class='glyphicon glyphicon-th-list'></i>
                                    子管理员</a>
                                </span>
                                <span>
                                    <a onclick="reset(<?php  echo $item['uid'];?>)" href="#"
                                       data-placement="top" class="btn btn-default btn-sm" data-original-title="编辑">
                                        <i class='glyphicon glyphicon-lock'></i>
                                    重置密码</a>
                                </span>
                                    <span>
                                    <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'perm','p'=> 'add','id' => $item['id']));?>"
                                       data-placement="top" class="btn btn-default btn-sm" data-original-title="编辑">
                                        <i class='glyphicon glyphicon-edit'></i>
                                    编辑</a>
                                </span>
                        <span>
                            <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'perm','p'=> 'delete','id' => $item['id']))?>"
                               title="删除" class="btn btn-default btn-sm">删除</a>
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
<script>
    function reset(uid) {
        var pw = Math.floor(Math.random()*100000000);
        if(confirm("你确定重置此管理密码为:"+pw+"吗？")){
            $.post("<?php  echo $this->createWebUrl('staff',array('op' => 'reset'))?>",{pw:pw,uid:uid},function (result) {
                if(result.status){
                    alert('重置成功');
                }
            },'json')
        }
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
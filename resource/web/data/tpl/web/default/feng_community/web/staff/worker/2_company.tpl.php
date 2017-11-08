<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active">
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'worker','p' => 'company'));?>">公司管理</a>
    </li>
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'worker','p' => 'list'));?>">人员管理</a>
    </li>
</ul>
<div class="panel panel-info">

    <div class="panel-body">
        <a class="btn btn-primary" href="javascript:;" data-toggle="modal" data-target="#company"><i
                class='glyphicon glyphicon-plus'></i>添加公司</a>
    </div>
</div>
<div class="panel panel-default">
    <div class="table-responsive">
        <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data" onsubmit="return check(this);">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th class="col-lg-1">id</th>
                    <th class="col-lg-2">公司名称</th>
                    <th class="col-lg-2">公司电话</th>
                    <th class="col-lg-5">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['id'];?></td>
                    <td><?php  echo $item['title'];?></td>
                    <td><?php  echo $item['telephone'];?></td>
                    <td>
                        <span>
                            <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'worker','p'=> 'add','id' => $item['id']))?>" title="编辑" class="btn btn-default btn-sm" >编辑</a>
                            <a href="<?php  echo $this->createWebUrl('staff',array('op' => 'worker','p'=> 'delete','id' => $item['id']))?>" title="删除" class="btn btn-default btn-sm" >删除</a>
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
<div class="modal fade" id="company" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加公司</h4>
            </div>
            <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data"
                  onsubmit="return check(this);">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">公司名称</label>
                        <div class="col-xs-5">

                            <input type="text" name="title" value="" class="form-control"
                            />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">公司电话</label>
                        <div class="col-xs-5">

                            <input type="text" name="telephone" value="" class="form-control"
                            />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                            <button type="submit" class="btn btn-primary span1" name="submit" value="提交">提交</button>
                        </div>

                    </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function check(form) {
        if (!form['title'].value) {
            alert('公司名不可为空。');
            return false;
        }
    }

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
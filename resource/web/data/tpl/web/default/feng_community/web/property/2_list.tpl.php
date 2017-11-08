<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>物业管理</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('property')?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site"/>
                        <input type="hidden" name="a" value="entry"/>
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
                        <input type="hidden" name="do" value="property"/>
                        <div class="row">
                            <div class="col-sm-6 m-b-xs">
                                <a href="<?php  echo $this->createWebUrl('property',array('op' => 'add'))?>" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>添加物业</a>
                            </div>
                            <div class="col-sm-6 m-b-xs">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="输入关键字" value="<?php  echo $_GPC['keyword'];?>">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"> 搜索</button>
                                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                                </span>
                                </div>
                            </div>
                        </div>
                    </form>
        <table class="table table-bordered">
            <thead class="navbar-inner">
            <tr>
                <th style="width:5%;">id</th>
                <th>物业名称</th>
                <th>物业电话</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td><?php  echo $item['id'];?></td>
                <td><?php  echo $item['title'];?></td>
                <td>
                    <?php  echo $item['telphone'];?>
                </td>
                <td><?php  echo date('Y-m-d h:i',$item['createtime'])?></td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('property',array('op' => 'add','id' => $item['id']))?>"
                       title="编辑" class="btn btn-primary btn-sm">编辑</a>

                    <a href="JavaScript:;" data="<?php  echo $item['id'];?>" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
                    <a href="<?php  echo $this->createWebUrl('region',array('op' => 'list','pid' => $item['id']))?>"
                       class="btn btn-primary btn-sm">管理小区</a>
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
    $(function () {
        $(".btn").bind("click", function () {
            var id = $(this).attr('data');
            var url = "<?php  echo $this->createWebUrl('property',array('op' => 'delete'))?>";
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
        });
    });
</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
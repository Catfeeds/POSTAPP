<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>费用类型管理</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-2 m-b-xs">
                            <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('cost', array('op' => 'category','operation' => 'add'))?>"><i class="fa fa-plus"></i> 添加费用类型</a>
                        </div>
                    </div>
        <form action="" method="post" onsubmit="return formcheck(this)">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-lg-5">费用类型</th>
                        <th class="col-lg-5">所属小区</th>
                        <th class="col-lg-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?> 

                    <tr>

                        <td>
                            <?php  echo $item['name'];?>
                        </td>
                        <td>
                            <?php  echo $item['city'];?><?php  echo $item['dist'];?><?php  echo $item['title'];?>
                        </td>
                        <td>
                             <a href="<?php  echo $this->createWebUrl('cost', array('op' => 'category','operation' => 'add' ,'id' => $item['id']))?>" title="编辑" class="btn btn-primary btn-sm">编辑</a>&nbsp;&nbsp;
                            <a href="<?php  echo $this->createWebUrl('cost', array('op' => 'category','operation' => 'del' ,'id' => $item['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;" title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除">删除</a>
                        </td>
                   </tr>
                    <?php  } } ?>

                </tbody>
            </table>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($op == 'list') { ?>class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('pay', array('op' => 'list'));?>">支付方式管理</a>
    </li>
    <li>
        <a href="<?php  echo $this->createWebUrl('pay', array('op' => 'add'));?>">新增支付方式</a>
    </li>
    <!--<li>-->
        <!--<a href="<?php  echo $this->createWebUrl('pay', array('op' => 'service'));?>">服务商设置</a>-->
    <!--</li>-->
    
</ul>
<div class="panel panel-default">
    <div class="table-responsive">
        <form action="" method="post">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:5%;">id</th>
                    <th style="width:8%">类型</th>
                    <th style="width:30%;">支付方式</th>
                    <th style="width:50%;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td>
                        <?php  echo $item['id'];?>
                    </td>
                    <td>
                       <?php  if($item['type']== 1) { ?>超市<?php  } else if($item['type'] == 2) { ?>物业费<?php  } else if($item['type'] == 3) { ?>商家<?php  } else if($item['type'] == 4) { ?>小区活动<?php  } ?>
                    </td>
                    <td><?php  if($item['wechat'] == 1) { ?>微信支付<?php  } ?>&nbsp;&nbsp;<?php  if($item['alipay']) { ?>支付宝支付<?php  } ?>&nbsp;&nbsp;<?php  if($item['balance']) { ?>余额支付<?php  } ?>&nbsp;&nbsp;<?php  if($item['delivery']) { ?>货到付款<?php  } ?></td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('pay',array('op' => 'add','id' => $item['id']))?>" title="编辑" class="btn btn-default btn-sm" ><i class="fa fa-edit" data-toggle="tooltip" data-placement="top"></i>编辑</a> 
                        
                        <a onclick="return confirm('删除号码，此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('pay',array('op' => 'delete','id' => $item['id']))?>" title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm" data-original-title="删除"><i class="fa fa-times"></i>删除</a>
                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        </form>
        <?php  echo $pager;?>
    </div>



<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
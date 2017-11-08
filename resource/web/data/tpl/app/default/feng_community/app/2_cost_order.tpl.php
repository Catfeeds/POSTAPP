<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">订单管理</h1>
    </header>
    <div class="content">
        <div class="list-block media-list" style="margin: 0">
            <ul>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li>
                    <label class="label-checkbox item-content">
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title"><?php  echo $item['transid'];?></div>
                                <div class="item-after"><?php  echo date('Y-m-d H:i:s',$item['createtime'])?></div>
                            </div>
                            <div class="item-subtitle"><?php  if($item['status'] == 0) { ?><span class="label-danger">待付款</span><?php  } ?> <?php  if($item['status'] == 1) { ?><span class="label-info">已付款</span><?php  } ?></div>
                            <div class="item-text"><?php  echo $item['realname'];?>-<?php  echo $item['homenumber'];?>-<?php  echo $item['mobile'];?>-<?php  echo $item['price'];?>元</div>
                        </div>
                    </label>
                </li>
                <?php  } } ?>
            </ul>
            <?php  echo $pager;?>
        </div>
    </div>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
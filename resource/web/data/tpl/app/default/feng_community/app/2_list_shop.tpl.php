<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">订单管理</h1>
    </header>
    <div class="content">
        <div class="list-block media-list" style="margin: 0 0 60px 0">
            <ul>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li>
                    <a href="#" class="item-link item-content" onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'shop_detail','id' => $item['id']))?>'">
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title"><?php  echo $item['ordersn'];?></div>
                                <div class="item-after"><?php  echo date('Y-m-d H:i', $item['createtime'])?></div>
                            </div>
                            <div class="item-subtitle">总金额：<?php  echo $item['price'];?>元</div>
                            <div class="item-subtitle"><span class="label label-<?php  echo $item['css'];?>"><?php  echo $item['paytype'];?></span></div>
                            <div class="item-text"><?php  if(empty($item['realname'])) { ?><?php  echo $item['address_realname'];?><?php  } else { ?><?php  echo $item['realname'];?><?php  } ?>-<?php  if(empty($item['mobile'])) { ?><?php  echo $item['address_telephone'];?><?php  } else { ?><?php  echo $item['mobile'];?><?php  } ?></div>
                        </div>
                    </a>
                </li>
                <?php  } } ?>
            </ul>
            <?php  echo $pager;?>
        </div>
    </div>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
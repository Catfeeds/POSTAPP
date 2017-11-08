<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">租赁订单</h1>
    </header>
    <div class="content">
        <div class="list-block media-list" style="margin: 0 0 60px 0">
            <ul>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'houselease_detail','id'=> $item['id']))?>'">
                    <a href="#" class="item-link item-content">
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title"><?php  echo $item['title'];?></div>
                                <div class="item-after"><?php  echo date('Y-m-d H:i',$item['createtime'])?></div>
                            </div>
                            <div class="item-subtitle"><?php  if($item['status'] ==1 ) { ?><span class="label label-success">已成交</span><?php  } ?><?php  if($item['status'] == 0 ) { ?><span class="label label-info">未成交</span><?php  } ?><?php  if($item['status'] == 2 ) { ?><span class="label label-danger">已取消</span><?php  } ?></div>
                            <div class="item-text"><?php  echo $item['realname'];?>-<?php  echo $item['mobile'];?></div>
                        </div>
                    </a>
                </li>
                <?php  } } ?>
            </ul>
            <?php  echo $pager;?>
        </div>
    </div>
</div>
<script>

</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
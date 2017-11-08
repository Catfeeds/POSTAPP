<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">通知列表</h1>
        <a class="button button-link button-nav pull-right open-popup" onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'add_notice'))?>'">
            发布
            <span class="icon icon-edit"></span>
        </a>
    </header>
    <div class="content">
        <div class="list-block media-list" style="margin: 0 0 60px 0">
            <ul>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li>
                    <a href="#" class="item-link item-content" onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'add_notice','id'=> $item['id']))?>'">
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title"><?php  echo $item['title'];?></div>
                                <div class="item-after"><?php  echo date('Y-m-d',$item['createtime'])?></div>
                            </div>
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
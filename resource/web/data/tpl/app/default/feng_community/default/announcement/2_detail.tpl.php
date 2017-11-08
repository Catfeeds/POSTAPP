<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<style>
    img{
        width:100%
    }
</style>
<body class="max-width bg-f5">
<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('announcement',array('op'=> 'list'))?>'"></a>
    <h1 class="title txt-fff">公告内容</h1>
</header>
<div class="content">
    <div class="content-padded">
        <div class="notice-detail-head" style="padding-top:0">
            <h3><?php  echo $item['title'];?></h3>
            <span>发布时间:<?php  echo date('Y-m-d',$item['createtime'])?></span>
        </div>
        <div class="notice-detail-act">
            <?php  if($item['pic']) { ?>
            <img src="<?php  echo tomedia($item['pic'])?>" />

            <?php  } ?>
                <?php  echo $item['reason'];?>
        </div>
    </div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
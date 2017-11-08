<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width">
<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
    <h1 class="title txt-fff">便民电话</h1>
</header>
<div class="content">
    <?php  if(is_array($list)) { foreach($list as $item) { ?>
    <div class="card">
        <div class="card-content">
            <ul class="list-block media-list phone-list">
               <li class="item-content">
                <div class="item-media phone-item-media">
                    <?php  if($item['thumb']) { ?>
                    <img src="<?php  echo tomedia($item['thumb'])?>?imageView2/2/w/60/h/60">
                    <?php  } ?>
                </div>
                <div class="item-inner">
                    <div class="item-title-row">
                        <div class="item-title"><?php  echo $item['content'];?></div>
                    </div>
                    <div class="item-subtitle">电话:<a href="tel:<?php  echo $item['phone'];?>"><?php  echo $item['phone'];?></a></div>
                </div>
                <div class="item-after phone-item-after">
                    <div class="phone-btn">
                        <a href="tel:<?php  echo $item['phone'];?>" class="icon icon-phone" style="margin-top: 8px;"></a>
                    </div>
                </div>
            </li>
            </ul>
        </div>
    </div>
    <?php  } } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
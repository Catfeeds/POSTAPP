<?php defined('IN_IA') or exit('Access Denied');?><?php 
$tel = set('p1')['value'];
$b1 = tomedia(set('b1')['value']);
$b2 = set('b2')['value'];
$b3 = set('b3')['value'];
$b4 = set('b4')['value'];
$b5 = tomedia(set('b5')['value']);
$b6 = set('b6')['value'];
$b7 = set('b7')['value'];
$b8 = set('b8')['value'];
$b9 = tomedia(set('b9')['value']);
$b10 = set('b10')['value'];
$b11 = set('b11')['value'];
$b12 = set('b12')['value'];
$b13 = tomedia(set('b13')['value']);
$b14 = set('b14')['value'];
$b15 = set('b15')['value'];
$b16 = set('b16')['value'];
$b17 = tomedia(set('b17')['value']);
$b18 = set('b18')['value'];
$b19 = set('b19')['value'];
$b20 = set('b20')['value'];
?>
<nav class="bar bar-tab" >
<?php  if($b4) { ?>
    <a class="tab-item <?php  if(empty($b2)) { ?><?php  if($_GPC['do']=='home' || empty($_GPC['do'])) { ?>active<?php  } ?><?php  } ?>"  onclick="window.location.href='<?php  if($b2) { ?><?php  echo $b2;?><?php  } else { ?><?php  echo $this->createMobileUrl('home')?><?php  } ?>'">
        <?php  if($b1) { ?><img src="<?php  echo $b1;?>" class="icon icon-home"><?php  } else { ?><span class="icon icon-home"></span><?php  } ?>
        <span class="tab-label"><?php  if($b3) { ?><?php  echo $b3;?><?php  } else { ?>首页<?php  } ?></span>
    </a>
<?php  } ?>
    <?php  if($b8) { ?>
    <a class="tab-item <?php  if(empty($b6)) { ?><?php  if($_GPC['do']=='announcement') { ?>active<?php  } ?><?php  } ?>" onclick="window.location.href='<?php  if($b6) { ?><?php  echo $b6;?><?php  } else { ?><?php  echo $this->createMobileUrl('announcement')?><?php  } ?>'">
        <?php  if($b5) { ?><img src="<?php  echo $b5;?>" class="icon icon-message"><?php  } else { ?><span class="icon icon-message"></span><?php  } ?>
        <span class="tab-label"><?php  if($b7) { ?><?php  echo $b7;?><?php  } else { ?>通知<?php  } ?></span>
       <?php  if(empty($b7)) { ?> <?php  if($count) { ?><span class="badge"><?php  echo $count;?></span><?php  } ?><?php  } ?>
    </a>
    <?php  } ?>
    <?php  if($b12) { ?>
    <a class="tab-item <?php  if(empty($b10)) { ?><?php  if($_GPC['do']=='shopping') { ?>active<?php  } ?><?php  } ?>"  onclick="window.location.href='<?php  if($b10) { ?><?php  echo $b10;?><?php  } else { ?><?php  echo $this->createMobileUrl('shopping',array('op' => 'mycart'))?><?php  } ?>'">
        <?php  if($b9) { ?><img src="<?php  echo $b9;?>" class="icon icon-home"><?php  } else { ?><span class="icon icon-cart"></span><?php  } ?>
        <span class="tab-label"><?php  if($b11) { ?><?php  echo $b11;?><?php  } else { ?>购物车<?php  } ?></span>
        <?php  if(empty($b11)) { ?><?php  if($carttotal) { ?><span class="badge"><?php  echo $carttotal;?></span> <?php  } ?><?php  } ?>
    </a>
    <?php  } ?>
    <?php  if($b16) { ?>
    <a class="tab-item" onclick="window.location.href='<?php  if($b14) { ?><?php  echo $b14;?><?php  } else { ?>tel:<?php  echo $tel;?><?php  } ?>'">
        <?php  if($b13) { ?><img src="<?php  echo $b13;?>" class="icon icon-home"><?php  } else { ?><span class="icon icon-phone"></span><?php  } ?>

        <span class="tab-label"><?php  if($b15) { ?><?php  echo $b15;?><?php  } else { ?>平台客服<?php  } ?></span>
    </a>
    <?php  } ?>
    <?php  if($b20) { ?>
    <a class="tab-item <?php  if(empty($b18)) { ?><?php  if($_GPC['do']=='member') { ?>active<?php  } ?><?php  } ?>" onclick="window.location.href='<?php  if($b18) { ?><?php  echo $b18;?><?php  } else { ?><?php  echo $this->createMobileUrl('member')?><?php  } ?>'">
        <?php  if($b17) { ?><img src="<?php  echo $b17;?>" class="icon icon-home"><?php  } else { ?><span class="icon icon-me"></span><?php  } ?>

        <span class="tab-label"><?php  if($b19) { ?><?php  echo $b19;?><?php  } else { ?>我<?php  } ?></span>
    </a>
    <?php  } ?>
</nav>
</body>

<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7-swiper.min.js" charset="utf-8"></script>
<!--<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="UTF-8"></script>-->
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/swiper.min.js" charset="utf-8"></script>
<script type="text/javascript"  src="<?php echo MODULE_URL;?>template/mobile/default/static/js/myjs.js" charset="UTF-8"></script>
</html>
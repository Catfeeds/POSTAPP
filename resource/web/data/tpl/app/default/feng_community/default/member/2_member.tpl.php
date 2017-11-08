<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green" style="position: fixed">
        <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
        <h1 class="title txt-fff">个人中心</h1>
    </header>
    <div class="content" style="margin-bottom: 4rem">
        <div class="my-head">
            <div class="my-head-img">
                <img src="<?php  if($_W['fans']['tag']['avatar']) { ?><?php  echo $_W['fans']['tag']['avatar'];?><?php  } else { ?><?php echo MODULE_URL;?>template/mobile/default/static/images/detail-personal-img.jpg<?php  } ?>">
            </div>
            <div class="head-dsb">
                <p class="dsb-name" style="font-size: 14px;"><?php  if($_W['member']['realname']) { ?><?php  echo $_W['member']['realname'];?><?php  } else { ?><?php  echo $_W['member']['nickname'];?><?php  } ?></p>
                <?php  if($_W['member']['mobile']) { ?><p class="dsb-id" style="font-size: 14px;">手机号:<?php  echo $_W['member']['mobile'];?></p><?php  } ?>
            </div>
            <a onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('member',array('op' => 'my'))?>';" class="pull-right" style="margin-top: 30px;">
                <img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/arrow-right.png" alt="">
            </a>
        </div>
        <div class="shop-grids bg-ff">
            <a class="shop-grid" style='text-align:center'>
                <div class="grid_icon">
                    <?php  echo $_W['member']['credit2'];?>
                </div>
                <p class="grid_label" <?php  if(set('p44')['value']) { ?>style="text-align: left;padding-left: 30px;"<?php  } else { ?>style='text-align:center'<?php  } ?>>余额 </p>
                <?php  if(set('p44')['value']) { ?>
                <p class="recharge" onclick="window.location.href='<?php  echo url('entry', array('m' => 'recharge', 'do' => 'pay'));?>'">充值</p>
                <?php  } ?>
            </a>
            <a class="shop-grid">
                <div class="grid_icon " style='text-align:center'>
                    <?php  echo $_W['member']['credit1'];?>
                </div>
                <p class="grid_label">
                    积分
                </p>
            </a>
            </a>
            <a class="shop-grid" onclick="window.location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'coupon','operation' => 'mycoupon'))?>'">
                <div class="grid_icon" style='text-align:center'>
                    <?php  echo $coupon_count;?>
                </div>
                <p class="grid_label">
                    团购卷
                </p>
            </a>
        </div>

        <div class="list-block my-list-block" style="margin-top: 3px;">
            <ul>
                <li class="item-content item-link" onclick="window.location.href='<?php  echo $this->createMobileUrl('myregion')?>'">
                    <div class="item-media"><img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/myregion.png" style="width: 1.5rem;"></div>
                    <div class="item-inner">
                        <div class="item-title">我的小区</div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="list-block my-list-block" style="margin-top: -8px;">
            <ul>
                <li class="item-content item-link" onclick="window.location.href='<?php  echo $this->createMobileUrl('member',array('op'=> 'my'))?>'">
                    <div class="item-media">
                        <img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/my.png " style="width: 1.5rem;"></div>
                    <div class="item-inner">
                        <div class="item-title">
                            我的资料
                        </div>
                    </div>
                </li>
                <li class="item-content item-link" onclick="window.location.href='<?php  echo $this->createMobileUrl('member',array('op'=> 'family'))?>'">
                    <div class="item-media">
                        <img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/family.png " style="width: 1.5rem;"></div>
                    <div class="item-inner">
                        <div class="item-title">
                            我的家属
                        </div>
                    </div>
                </li>
                <?php  if(is_array($menus)) { foreach($menus as $menu) { ?>

                <li class="item-content item-link" onclick="window.location.href='<?php  echo $menu['url'];?>'">
                    <div class="item-media">
                        <img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/<?php  echo $menu['img'];?> " style="width: 1.5rem;"></div>
                    <div class="item-inner">
                        <div class="item-title">
                            <?php  echo $menu['title'];?>
                        </div>
                    </div>
                </li>

                <?php  } } ?>
            </ul>
        </div>
    </div>

</div>
<?php 
    $tel = set('p1')['value'];
    $copyright = set('p68')['value'];
    $copright_url = set('p69')['value'];
    ?>
<?php  if($copyright) { ?>
<div onclick="window.location.href='<?php  echo $copright_url;?>'" style="color:#999;font-size: 13px;z-index:9999;height: 1.5rem;line-height:1.5rem;vertical-align:middle;position: absolute;bottom: 2.5rem;margin: 0 auto;text-align: center;margin-top: 50px;background-color:#e7e7e7;width: 100% "><?php  echo $copyright;?></div>
<?php  } ?>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
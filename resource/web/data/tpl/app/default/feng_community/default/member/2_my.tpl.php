<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>

<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('member')?>'"></a>
        <h1 class="title txt-fff">个人资料</h1>
    </header>
    <div class="content">
        <div class="list-block" style="margin:0">
            <ul>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">头像</div>
                        <div class="item-after"><img src="<?php  if($_W['fans']['tag']['avatar']) { ?><?php  echo $_W['fans']['tag']['avatar'];?><?php  } else { ?><?php echo MODULE_URL;?>template/mobile/default/static/images/detail-personal-img.jpg<?php  } ?>" class="my-user-img" style="width:30px;height:30px;border-radius:100px"></div>
                    </div>
                </li>
                <?php  if(set('p50')['value']) { ?>
                <li class="item-content item-link" onclick="window.location.href='<?php  echo url('mc', array('a' => 'card', 'do' => 'mycard'));?>'">
                    <div class="item-inner">
                        <div class="item-title">我的会员卡</div>
                        <div class="item-after"></div>
                    </div>
                </li>
                <?php  } ?>
                <div class="bg-f2" style="height: 10px"></div>
                <li class="item-content item-link" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('member',array('op' => 'edit','r' => 'm'))?>';">
                    <div class="item-inner">
                        <div class="item-title">昵称</div>
                        <div class="item-after"><?php  echo $_W['member']['realname'];?></div>
                    </div>
                </li>
                <li class="item-content item-link" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('member',array('op' => 'edit','r' => 'b'))?>';">
                    <div class="item-inner">
                        <div class="item-title">手机</div>
                        <div class="item-after"><?php  echo $_W['member']['mobile'];?></div>
                    </div>
                </li>
                <li class="item-content item-link" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('member',array('op' => 'address','r' => 'a'))?>';">
                    <div class="item-inner">
                        <div class="item-title">地址</div>
                        <div class="item-after"><?php  echo $address['address'];?></div>
                    </div>
                </li>
                <li class="item-content item-link" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('member',array('op' => 'edit','r' => 'c'))?>';">
                    <div class="item-inner">
                        <div class="item-title">车牌号</div>
                        <div class="item-after"><?php  echo $address['license'];?></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
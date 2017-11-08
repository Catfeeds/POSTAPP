<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>

<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('member')?>'"></a>
        <h1 class="title txt-fff">我的家属</h1>
    </header>
    <div class="content">
        <div class="content-block-title">家庭成员</div>
        <div class="list-block media-list">
            <ul>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li onclick="window.location.href='<?php  echo $this->createMobileUrl('member',array('op'=> 'share','addressid' => $item['addressid'],'uid'=> $item['to_uid']))?>'">
                    <a href="#" class="item-link item-content">
                        <div class="item-media"><img src="<?php  if($item['avatar']) { ?><?php  echo tomedia($item['avatar'])?><?php  } else { ?><?php echo MODULE_URL;?>template/mobile/default/static/images/tx.png<?php  } ?>" style='width: 2.2rem;'></div>
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title" style="font-size: 14px;"><?php  echo $item['realname'];?></div>
                            </div>
                            <div class="item-subtitle"><label style="width: 2.2rem;height: 1.2rem" class="button button-fill button-warning"><?php  if($item['status'] == 2) { ?>家属<?php  } else if($item['status'] == 3) { ?>租户<?php  } ?></label></div>
                            <?php  if(empty($item['openid'])) { ?><div style="float: right;font-size: 14px;position: absolute;bottom: 23px;right: 24px;">未关注</div><?php  } ?>
                        </div>
                    </a>
                </li>
                <?php  } } ?>
                <li onclick="window.location.href='<?php  echo $this->createMobileUrl('member',array('op'=> 'add'))?>'">
                    <a href="#" class="item-link item-content">
                        <div class="item-media"><img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/tx.png" style='width: 2.2rem;'></div>
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title" style="font-size: 14px;">邀请家人</div>
                            </div>
                            <div class="item-subtitle"></div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
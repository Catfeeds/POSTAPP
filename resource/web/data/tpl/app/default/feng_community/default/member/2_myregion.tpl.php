<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f2">
<div>
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
        <h1 class="title txt-fff">我的小区</h1>
    </header>
    <div class="content">
        <div class="card">
            <div class="card-header">当前小区:<?php  echo $region['title'];?><a class="button button-success" style="font-size: 0.5rem" onclick="window.location.href='<?php  echo $this->createMobileUrl('register',array('op' => 'region','t' => 1))?>'">更换小区</a></div>
            <div class="card-content">
                <div class="list-block media-list xiaoqu-list-block">
                    <ul>
                        <li class="item-content">
                            <div class="item-media">
                                <img src="<?php  echo tomedia($region['thumb'])?>" style="width: 3rem;">
                            </div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title"><?php  echo $region['title'];?></div>
                                </div>
                                <div class="item-subtitle"><?php  echo $region['address'];?></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php  if($region['ptitle']) { ?>
            <div class="card-footer xiaoqu-wy">
                <span class="wuye"></span><?php  echo $region['ptitle'];?>
            </div>
            <?php  } ?>
        </div>
        <?php  if($property['title']) { ?>
        <div class="card" style="margin-bottom: 40px;">
            <div class="card-header">物业介绍：</div>
            <div class="card-content">
                <div class="card-content-inner"><?php  echo $property['content'];?></div>
            </div>
            <div class="card-footer xiaoqu-wy">
                <span class="wuye"></span><?php  echo $property['title'];?>
            </div>
        </div>
        <?php  } ?>
    </div>
    <div id="community_bottom">
        <div class="com_contact">
            <div class="btn"><a href="tel:<?php  echo $region['linkway'];?>"><span class="xqtel">小区电话</span></a></div>
            <div class="btn">
                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php  echo $region['qq'];?>&amp;site=qq&amp;menu=yes">
                        <span class="xqkf">
                            小区客服
                        </span>
                </a>
            </div>
        </div>
        <div class="com_bother">你有什么疑问可以直接联系我们</div>
    </div>
</div>
</body>
</html>
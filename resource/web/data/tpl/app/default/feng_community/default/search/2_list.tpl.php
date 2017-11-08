<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-ff">
    <div class="content">
        <header class="bar bar-nav bg-green">
            <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
            <h1 class="title txt-fff">便民查询</h1>
        </header>
        <?php  if($slides) { ?>
        <div class="banner bg-f2">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php  if(is_array($slides)) { foreach($slides as $row) { ?>
                    <div class="swiper-slide" onclick="javascript:window.location.href='<?php  echo $row['url'];?>';">
                        <img src="<?php  echo $row['thumb'];?>?imageView2/1/w/320/h/160/q/100" >
                    </div>
                    <?php  } } ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php  } ?>
        <div class="search-grids" <?php  if($slides ) { ?>style="padding-top:0"<?php  } ?>>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <a href="<?php  echo $item['surl'];?>" class="search-grid">
                <div class="search-grid-icon">
                    <img src="<?php  echo tomedia($item['icon'])?>?imageView2/2/w/45/h/45">
                </div>
                <p class="search-grid-lable"><?php  echo $item['sname'];?></p>
            </a>
            <?php  } } ?>
        </div>
    </div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
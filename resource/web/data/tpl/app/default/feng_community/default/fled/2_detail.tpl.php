<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>

<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('fled',array('op' => 'list'))?>'"></a>
    <h1 class="title txt-fff">【<?php  echo $item['title'];?>】详情</h1>
</header>
<div class="content page">
    <div class="fled-detail bg-ff">
        <?php  if($imgs) { ?>
        <div class="fled-head-img pb-popup" id="big-picture" style="border: 1px solid #d6d6d6">

            <img src="<?php  echo $imgs[0]['src'];?>?imageView2/2/w/400/h/300">

            <div class="fled-img-btn" style="font-size: 12px">共<?php  echo count($imgs)?>张图<span class="icon icon-picture"></span></div>
        </div>
        <?php  } ?>
        <p class="fled-head-tit">转卖<?php  echo $item['title'];?></p>
        <p class="fled-head-price"><span class="color-warning">¥<?php  if(empty($item['zprice'])) { ?>面议<?php  } else { ?><?php  echo $item['zprice'];?><?php  } ?></span><s></s>
        </p>
    </div>
    <div class="card facebook-card fled-detail-card">
            <div class="card-header no-border">
                <div class="facebook-avatar"><img src="<?php  if($item['avatar']) { ?><?php  echo $item['avatar'];?> <?php  } else { ?><?php echo MODULE_URL;?>template/mobile/default/static/images/detail-personal-img.jpg<?php  } ?>" width="34" height="34"></div>
                <div class="facebook-name"><?php  echo $item['realname'];?></div>
                <div class="facebook-date">发布时间：<?php  echo date('Y-m-d H:i:s',$item['createtime'])?></div>
            </div>
            <div class="card-content">
                <ul class="fled-detail-list">
                    <li><label>类别：</label><span><?php  echo $item['name'];?>类</span></li>
                    <li><label>新旧程度：</label><span><?php  echo $item['rolex'];?></span></li>
                    <li><label>是否成交：</label><span class="color-primary"><?php  if($item['status']) { ?>已成交<?php  } else { ?>还未成交<?php  } ?></span></li>
                </ul>
                <a class="fled-detail-btn" onclick="window.location.href='tel:<?php  echo $item['mobile'];?>'"><span class="icon icon-phone"></span>联系TA</a>
            </div>
    </div>
    <div class="fled-detail bg-ff">
        <div class="fled-text">
            <div class="fled-text-tit">详情描述:</div>
            <?php  echo $item['description'];?>
        </div>
    </div>


</div>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<script>
$(function(){
    <?php  if($images) { ?>
    var imgArray = [];
    var img  = <?php  echo $images;?> || [];//
    for(var o in img){
        var itemSrc = img[o].src;
        imgArray.push(itemSrc);
    }
    /*=== Popup ===*/
    var myPhotoBrowserPopup = $.photoBrowser({
        photos : imgArray,
        type: 'popup'
    });
    $(document).on('click','.pb-popup',function () {
        myPhotoBrowserPopup.open();
    });
    <?php  } ?>

})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
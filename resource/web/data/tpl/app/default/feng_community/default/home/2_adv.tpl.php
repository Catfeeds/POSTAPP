<?php defined('IN_IA') or exit('Access Denied');?>
<div class="banner bg-f2">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php  if(is_array($slides)) { foreach($slides as $row) { ?>
            <div class="swiper-slide" onclick="javascript:window.location.href='<?php  echo $row['url'];?>';">
                <img src="<?php  echo $row['thumb'];?>?imageView2/1/w/640/h/320/q/100" style="max-height: 160px;">
            </div>
            <?php  } } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>
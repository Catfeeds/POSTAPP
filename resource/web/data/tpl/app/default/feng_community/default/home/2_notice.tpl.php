<?php defined('IN_IA') or exit('Access Denied');?><div class="scrollNews" >
    <div class="yy">            <!--通知轮播-->
        <?php  if(is_array($notice)) { foreach($notice as $n) { ?>
        <div class="notice">
            <a href="<?php  echo $this->createMobileUrl('announcement',array('op'=> 'detail','id' => $n['id']))?>">
                <div class="notice_pic" >
                    <img class="notice_pic1" src="<?php echo MODULE_URL;?>template/mobile/default/static/images/icon-notice.png">
                </div>
                <div class="notice_txt" >
                    <p class="notice_h1" style="margin-top: 8px;font-size: 14px;">
                        <?php  echo $n['title'];?>
                    </p>
                </div>
            </a>
        </div>
        <?php  } } ?>
    </div>
</div>
<?php defined('IN_IA') or exit('Access Denied');?><nav class="bar bar-tab">
    <a class="tab-item active" href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'index'))?>'">
        <span class="icon icon-home"></span>
        <span class="tab-label">主页</span>
    </a>
    <a class="tab-item" href="#" onclick="window.location.href='tel:<?php  echo $tyset['phone'];?>'">
        <span class="icon icon-phone"></span>
        <span class="tab-label">平台电话</span>
    </a>
    <!--<a class="tab-item" href="#">-->
        <!--<span class="icon icon-settings"></span>-->
        <!--<span class="tab-label">设置</span>-->
    <!--</a>-->
</nav>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/app/static/js/light7.js" charset="utf-8"></script>
</body>
</html>
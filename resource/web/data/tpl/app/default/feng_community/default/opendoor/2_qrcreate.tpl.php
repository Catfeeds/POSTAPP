<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>访客二维码</title>
</head>
<body>

<div style='font-size: 48px;text-align:center;margin:0 auto '><?php  if($_GPC['t'] == 1) { ?>请识别二维码开门 <?php  } else { ?>长按二维码转发给朋友哦！<?php  } ?></div><img src='qrcode.png' style='width: 100%;margin-top: 20px'>

<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/jquery.min.js" charset="utf-8"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    // jssdk config 对象
    jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> ||{};
    // 是否启用调试
    jssdkconfig.debug = false;
    jssdkconfig.jsApiList = [
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
    ];
    $(function(){
        wx.config(jssdkconfig);
        wx.ready(function () {
            wx.onMenuShareAppMessage({
                title: "<?php  echo $_share['title'];?>", // 分享标题
                desc: "<?php  echo $_share['desc'];?>", // 分享描述
                link: "<?php  echo $_share['link'];?>", // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: "<?php  echo $_share['imgUrl'];?>", // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        });


    });

</script>
</body>
</html>
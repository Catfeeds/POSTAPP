<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>

<body class="max-width bg-ff ">
<div id="page-swiper" class="page page-current page-inited bg-ff">

    <div class="content">

        <?php  if(is_array($page)) { foreach($page as $item) { ?>

        <?php  include $this->template($this->xqtpl('home/'.$item['sort']));?>

        <?php  } } ?>



        <!--<div class=" load-more">-->
            <!--<p> <a href="#" class="open-preloader-title" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'list'))?>';">点击查看更多</a></p>-->
        <!--</div>-->
        <!--<div style="color:#999;margin: 0 auto;font-size: 13px;text-align: center"><?php  echo $this->module['config']['copyright']?></div>-->
    </div>
</div>
<?php 
    $tel = set('p1')['value'];
    $copyright = set('p68')['value'];
    $copright_url = set('p69')['value'];
    ?>
<?php  if($copyright) { ?>
<div onclick="window.location.href='<?php  echo $copright_url;?>'" style="color:#999;font-size: 13px;z-index:9999;height: 1.5rem;line-height:1.5rem;vertical-align:middle;position: absolute;bottom: 2.5rem;margin: 0 auto;text-align: center;margin-top: 50px;background-color:#e7e7e7;width: 100%;position: fixed "><?php  echo $copyright;?></div>
<?php  } ?>
<script type="text/html" id="xq_list">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
    <li style="height: 180px;">
        <a class="home-list-item" href="<?php  echo $this->createMobileUrl('shopping',array('op' => 'detail'))?>&id={{ d.list[i].id}}">
            <div class="home-item-img" style="width: 120px;height: 120px;">
                <img src="{{ d.list[i].thumb }}?imageView2/2/w/200/h/200" style="width: 120px;height: 120px;"/>
            </div>
            <h3 class="home-item-name"> {{ d.list[i].title }}  </h3>
            <div class="home-item-price">
                <span class="home-item-price-now"><b>¥{{ d.list[i].marketprice }}</b></span>
                <span class="home-item-price-cost"><del>{{ d.list[i].productprice }}</del></span>
            </div>
        </a>
        <div class="home-list-lable"></div>
        <div class="home-lable-txt">热卖</div>
    </li>
    {{# } }}

</script>
<script>
    //小区主页菜单
    var data =<?php  echo $menus;?>;
    $(function(){
        var item = '';
        item += '<div class="swiper-slide"><div class="swiper-index">';
        for(var i=0;i<data.length;i++){
            var val = data[i];
            if(i%4 == 0 && i!=0){
                item += '</div>';
                if(i%8 == 0 ){
                    item += '</div><div class="swiper-slide"><div class="swiper-index">';
                }else{
                    item += '<div class="swiper-index">';
                }
            }
            var site_url ="<?php  echo $_W['siteroot'];?>";
            if(val['do'] =='life' || val['do'] == '')
            {

                item +='<a href="'+val['url']+'"><img src="'+val['thumb']+'" /> <p>'+val['title']+'</p> </a>';

            }
            else
            {
                item +='<a href="'+site_url+val['url']+'"><img src="'+val['thumb']+'" /> <p>'+val['title']+'</p> </a>';

            }

        }
        $('.home').html(item);

    })
    //小区主页产品
    $(document).ready(function () {
        loaddata("<?php  echo $this->createMobileUrl('home')?>", $(".home-list-content"), 'xq_list', true);

    });
</script>
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
            wx.onMenuShareTimeline({
                title: "<?php  echo $_share['title'];?>", // 分享标题
                link: "<?php  echo $_share['link'];?>", // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: "<?php  echo $_share['imgUrl'];?>", // 分享图标
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
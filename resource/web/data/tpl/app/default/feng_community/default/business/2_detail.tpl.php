<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/default/static/css/fontawesome-stars-red.css">
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/default/static/css/light7-swiper.min.css">
<body class="max-width bg-f5">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'list'))?>'"></a>
        <h1 class="title txt-fff"><?php  echo $item['sjname'];?></h1>
    </header>
    <div class="content">
        <div class="buttons-tab bussiness-btn-tab">
            <a href="#tab1" class="tab-link active button">首页</a>
            <a href="#tab2" class="tab-link button" id="xqcoupon">团购</a>
            <a href="#tab3" class="tab-link button" id="xqrank">评价</a>
        </div>
        <div class="tabs">
            <div id="tab1" class="tab active">
                <div class="swiper-container" style="padding-bottom: 0">
                    <div class="swiper-wrapper">
                        <!--预留幻灯 -->
                        <div class="swiper-slide"><img src="<?php  echo $thumb;?>?imageView2/1/w/180/h/160/q/100" alt="" style="width: 100%;height: 180px;"></div>
                    </div>
                </div>
                <div class="list-block media-list mt0 businessd-list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><img src="<?php  echo $thumb;?>?imageView2/1/w/90/h/60/q/100" style="width: 90px;height: 60px;"></div>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title car-name"><?php  echo $item['sjname'];?></div>
                                    </div>
                                    <div class="item-subtitle">
                                        <ul class="show_number clearfix">
                                            <span style="font-size: 0.7rem;color: #999999;">共</span>
                                            <span class="ev color-danger"><?php  echo $count;?></span>
                                         </ul>
                                    </div>
                                    <div class="item-subtitle color-danger">
                                        人均:<?php  echo $item['price'];?>元
                                    </div>
                                </div>
                                <a class="business-detail-btn bg-danger" onclick="window.location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'rank','dpid' => $id,'operation' => 'add'))?>'" href="#">评价商家</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="list-block media-list  businessd-info">
                    <ul>
                        <li>
                            <div href="#" class="item-content">
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title">地址:<?php  echo $item['address'];?></div>
                                    </div>
                                    <div class="item-title-row">
                                        <div class="item-title">电话:<?php  echo $item['mobile'];?></div>
                                    </div>
                                </div>
                                <div class="item-inner business-item-inner">
                                   <a class="business-phone" href="#" onclick="window.location.href='tel:<?php  echo $item['mobile'];?>'">
                                       <i class="text-icon">✆</i>
                                   </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="list-block media-list business-list-block mt0">
                    <ul >
                        <div class="business-detail-tit">商家团购</div>
                        <?php  if(is_array($list)) { foreach($list as $goods) { ?>
                        <li onclick="location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'coupon','operation' => 'detail','gid' => $goods['id'],'dpid'=> $id ))?>'">
                            <div class="item-content">
                                <div class="item-media"><img src="<?php  echo tomedia($goods['thumb'])?>?imageView2/1/w/180/h/160/q/100" style='width: 4rem;height: 3rem;'></div>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title" style="font-size: 14px;"><?php  echo $goods['title'];?></div>
                                    </div>
                                    <!--<div class="item-title"><?php  echo $goods['title'];?></div>-->
                                    <div class="item-title-row">
                                        <div class="item-title"><span class="business-list-price color-warning"><?php  echo $goods['marketprice'];?></span><span class="tag">多优惠+</span>
                                        </div>
                                        <div class="item-after"><span class="color-gray" style="line-height: 25px">已售<?php  echo $goods['sold'];?></span></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php  } } ?>
                    </ul>
                    <div class="business-more"><span class="icon-more"></span></div>
                </div>
            </div>
            <div id="tab2" class="tab">
                <div class="list-block media-list business-list-block mt0">
                    <ul id="coupon_list">

                    </ul>
                </div>
            </div>
            <div id="tab3" class="tab" style="position: relative">
                <div class="list-block media-list mt0 evaluate-list-block">
                    <ul class="align-top" id="rank_list">

                    </ul>
                </div>
                <a class="group-edit color-success" onclick="window.location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'rank','dpid' => $id,'operation' => 'add'))?>'">  <span class="icon icon-edit"></span></a>
            </div>
        </div>
    </div>

</div>
<script type="text/html" id="xq_coupon">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
    <li onclick="window.location.href='{{ d.list[i].url }}'">
        <div class="item-content">
            <div class="item-media"><img src="{{ d.list[i].thumb }}?imageView2/1/w/180/h/160/q/100" style='width: 4rem;height: 3rem;'></div>
            <div class="item-inner">
                <div class="item-title-row">
                    <div class="item-title" style="font-size: 14px;">{{ d.list[i].title }}</div>
                </div>
                <!--<div class="item-title">[宿州路]单人自助中餐</div>-->
                <div class="item-title-row">
                    <div class="item-title"><span class="business-list-price color-warning">{{ d.list[i].marketprice }}</span><span class="tag">多优惠+</span>
                    </div>
                    <div class="item-after"><span class="color-gray" style="line-height: 25px">已售{{ d.list[i].sold }}</span></div>
                </div>
            </div>
        </div>
    </li>
    {{# } }}

</script>
<script type="text/html" id="xq_rank">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
    <li class="item-content ">
        <div class="item-media">
            <img src="{{# if(d.list[i].avatar){ }}{{ d.list[i].avatar }}{{# }else{ }}<?php echo MODULE_URL;?>template/mobile/default/static/images/detail-personal-img.jpg{{# } }}" style='width: 2.2rem;'>
        </div>
        <div class="item-inner">
            <div class="item-title-row">
                <div class="item-title">{{d.list[i].realname}}</div>
                <div class="item-after">{{d.list[i].createtime}}</div>
            </div>
            <div class="item-subtitle">
                <div class="br-theme-fontawesome-stars-o business-detail-stars">

                        {{# for(var $i=0;$i< d.list[i].rank;$i++){ }}
                        <img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/star-on.png" style='width:16px;height:16px;'>
                        {{# } }}

                </div>
            </div>
            <!--<div class="item-text">-->
                <!--这里是文这里是文本这里是文本这里是文本这里是文本-->
            <!--</div>-->
        </div>
    </li>
    {{# } }}

</script>
<script>$.config = {autoInit: true}</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7-swiper.min.js" charset="utf-8"></script>
<script>
    $(document).on('click','.business-more', function () {
        $.showIndicator();
        setTimeout(function () {
            $.hideIndicator();
        }, 2000);
    });
    $(function () {
        $("#xqcoupon").click(function () {
            var dpid ="<?php  echo $id;?>";
            var url = "<?php  echo $this->createMobileUrl('business',array('op' => 'coupon','operation' => 'list'))?>&dpid="+dpid;
            var obj = $("#coupon_list");
            var object= 'xq_coupon';
            $.get(url, function (data) {
                if (data.list.length > 0) {
                    var gettpl = document.getElementById(object).innerHTML;
                    laytpl(gettpl).render(data, function(html){
                        //document.getElementById(obj).innerHTML = html;
                        obj.html(html);
                    });
                }
                lock = 0;
                hideLoader();
            }, 'json');
        })
        $("#xqrank").click(function () {
            var dpid ="<?php  echo $id;?>";
            var url = "<?php  echo $this->createMobileUrl('business',array('op' => 'rank','operation' => 'list'))?>&dpid="+dpid;
            var obj = $("#rank_list");
            var object= 'xq_rank';
            $.get(url, function (data) {
                if (data.list.length > 0) {
                    var gettpl = document.getElementById(object).innerHTML;
                    laytpl(gettpl).render(data, function(html){
                        //document.getElementById(obj).innerHTML = html;
                        obj.html(html);
                    });
                }
                lock = 0;
                hideLoader();
            }, 'json');
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
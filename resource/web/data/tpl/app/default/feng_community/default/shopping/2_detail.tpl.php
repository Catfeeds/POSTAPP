<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green" style="position: fixed">
        <a class="icon icon-left pull-left txt-fff" href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'list'))?>'"></a>
        <h1 class="title txt-fff">商品详情</h1>
    </header>
    <div class="content" style="height: 100%;margin-bottom: 40px;">
        <div class="shop-detail-swiper">
            <div class="swiper-container shop-swiper-container " data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="3000">
                <div class="swiper-wrapper">
                    <?php  if(empty($piclist)) { ?>

                    <div class="swiper-slide"><img src="<?php  echo $thumb;?>?imageView2/1/w/300/h/300/q/100" alt="" class="thumb" style="max-height: 300px;"></div>
                    <?php  } else { ?>
                    <?php  if(is_array($piclist)) { foreach($piclist as $row) { ?>
                    <div class="swiper-slide"><img src="<?php  echo $row;?>?imageView2/1/w/300/h/300/q/100" alt="" class="thumb" style="max-height: 300px;"></div>
                    <?php  } } ?>
                    <?php  } ?>
                </div>
            </div>
        </div>
        <div class="shop-detail-info bg-ff">
            <div class="shop-detail-tit"><?php  echo $goods['title'];?> </div>
            <div class="shop-detail-price">
                <span class="shop-pricex"><?php  echo $marketprice;?></span><s><?php  echo $productprice;?></s>
                <span style="font-size: 12px;">&nbsp;<?php  echo $goods['unit'];?></span>
            </div>
            <div class="shop-detail-jf">赠送积分:<span class="shop-jf"><?php  echo $credit;?></span>库存<span id="stock"><?php  echo $stock;?></span></div>
        </div>
        <div class="list-block mt10" style="margin-bottom: 0px">
            <ul>
                <li class="item-content">
                    <div class="item-media">数量:</div>
                    <div class="item-inner">
                        <div class="option">
                            <label class="btn-del "></label>
                            <input id="total" type="text" value="1" class="total" />
                            <label class="btn-add" ></label>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="shopde bg-ff" style="height: 100%;">
            <div class="shopde-tit">
                商品详情
            </div>
            <div style="word-wrap : break-word"><?php  echo $goods['content'];?></div>
        </div>

    </div>
    <footer class="shop-foot" style="height: 45px;position: fixed">
        <div class="shop-foot-list bg-danger" style="height: 45px;">
            <div class="shop-foot-price">
                <div class="foot-icon-price">
                    <span class="icon icon-cart"></span>
                    <span class="badge"><?php  echo $carttotal;?></span>
                </div>
                <a onclick="addtocart(<?php  echo $goods['id'];?>)">加入购物车</a>
            </div>
        </div>
        <div class="shop-foot-list bg-success" style="height: 45px;">
            <a onclick='buy()'>立即购买</a>
        </div>
    </footer>
</div>
</body>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/jquery.fly.min.js" charset="utf-8"></script>
<script>$.config = {autoInit: true}</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="UTF-8"></script>
<script src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7-swiper.min.js"></script>
<script>
    $(function(){
        $(".btn-add").click(function(){
            var t =$(this).parent().find('input[class*=total]');
            t.val(parseInt(t.val())+1);
            setTotal();
        })

        $(".btn-del").click(function(){
            var t=$(this).parent().find('input[class*=total]');
            t.val(parseInt(t.val())-1);
            if(parseInt(t.val())<0){
                t.val(0);
            }
            setTotal();
        })
        function setTotal() {
            var s=0;
            <!--计算总额-->
            var onePrice = parseFloat($(".one_price").text().replace("元",""));
            var num = parseInt($(".result").val());
            s = onePrice * num;
            $("div").siblings(".zongprice").text(s+"元");
        }
    })
    //购买
    function buy() {
        var stock = parseInt($('#stock').text());
        if (stock == 0) {
            $.toast("库存不足，无法购买。");return false;
        }
        var total = $("#total").val();
        location.href = "<?php  echo $this->createMobileUrl('shopping',array('op' => 'confirm','id'=>$goods['id']),true)?>" + "&total=" + total;
    }
    //添加到购物车
    function addtocart(id) {
        var st = $('.icon-cart').offset();
        var offset = $('.icon-cart').offset();
        var img = $('.thumb').attr('src');
        var flyer = $('<img class="u-flyer" src="'+img+'">');
        var height = $(window).height();
        var width = $(window).width() / 2;
        flyer.fly({
            start: {
                left: st.left, //抛物体起点横坐标
                top: st.top - $(document).scrollTop()////抛物体起点纵坐标
            },
            end: {
                left: offset.left, //抛物体终点横坐标
                top: offset.top, //抛物体终点纵坐标
                //抛物线完成后留在页面上的图片大小
                width: 0,
                height: 0
            },
            onEnd: function(){ //结束回调
                var url = "<?php  echo $this->createMobileUrl('shopping',array('op' => 'mycart','operation' =>'add','type' => 1),'',true)?>&id="+id ;
                $.getJSON(url, function(s) {
                    if (s.result == 0) {
                        $.toast("库存不足，无法购买。");return false;
                    } else {
                        $('.badge').text(s.total);
                        $.toast("添加成功,在购物车等亲~");

                    }
                });
            }
        });
    }
</script>
</html>
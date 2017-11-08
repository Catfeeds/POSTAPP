<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<style>
    .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        line-height: 15px;
    }

    .bt {
        background-color: #F7F7F7;
        color: black;
        margin-top: 5px;
    }
</style>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/jquery.fly.min.js"
        charset="utf-8"></script>
<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="#"
           onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
        <div class="bar more-list-bar">
            <div class="searchbar">
                <a class="searchbar-cancel">确定</a>
                <div class="search-input">
                    <label class="icon icon-search" for="search"></label>
                    <input type="search" id='search' placeholder='找你想要的'/>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <p style="height: 40px;background-color: white;margin-bottom: 0px;overflow-x:auto; white-space:nowrap;width: 100%;margin-top: -4px;">
            <a href="#" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'list'))?>'" class="btn bt" <?php  if(empty($pcate)) { ?>style="border-left: 3px solid rgb(72, 181, 78);"<?php  } ?>>全部</a>
            <?php  if(is_array($categories)) { foreach($categories as $key => $category) { ?>
            <a href="#"  onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'list','pcate' => $category['id']))?>'" class="btn bt" <?php  if($pcate== $category['id']) { ?>style='border-left: 3px solid rgb(72, 181, 78);'<?php  } ?>><?php  echo $category['name'];?></a>
            <?php  } } ?>
        </p>
        <?php  if($childrens) { ?>
        <p style="margin-top:2px;height: 40px;background-color: white;margin-bottom: 0px;overflow-x:auto; white-space:nowrap;width: 100%">
            <a href="#" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'list'))?>'" class="btn bt" <?php  if(empty($ccate)) { ?>style="border-left: 3px solid rgb(72, 181, 78);"<?php  } ?>>全部</a>
            <?php  if(is_array($childrens)) { foreach($childrens as $children) { ?>
            <a href="#" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'list','ccate' => $children['id'],'pcate'=>$pcate))?>'" class="btn bt" <?php  if($ccate== $children['id']) { ?>style="border-left: 3px solid rgb(72, 181, 78);"<?php  } ?>><?php  echo $children['name'];?></a>
            <?php  } } ?>
        </p>
        <?php  } ?>

        <div class="content-block" style="padding: 2px;margin:0px">
            <div class="tabs">
                <div id="tab0" class="tab active">
                    <div class="list-block media-list mt0 more-list-block">
                        <ul id="data-list-0">

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <a class="shop-total-cart" href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'mycart'))?>'"><span class="icon icon-cart"></span><span class="badge"><?php  echo $carttotal;?></span></a>
    </div>

    <script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js"
            charset="utf-8"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/default/static/css/dropload.css">
    <script src="<?php echo MODULE_URL;?>template/mobile/default/static/js/dropload.min.js"></script>
    <script>
        $(document).ready(function(){
            var keywords = "<?php  echo $_GPC['keywords'];?>";
            var ccate = "<?php  echo $ccate;?>";
            var pcate = "<?php  echo $pcate;?>";
            $.ajax({
                type: 'GET',
                url: '<?php  echo $this->createMobileUrl('shopping',array('op' => 'list'))?>&page=1&keywords=' + keywords + '&pcate=' + pcate + '&ccate=' + ccate,
                dataType: 'json',
                success: function(data){
                    var result = '';
                    for(var i = 0; i < data.list.length; i++){
                        var url = "<?php  echo $this->createMobileUrl('shopping',array('op'=> 'detail'))?>&id="+data.list[i].id;
                        var thumb = data.list[i].thumb;
                        result +='<li style="border-bottom: 1px solid #F2F2F2"><a class="item-content"><div class="item-media" onclick=\'window.location.href="' + url + '"\' style="margin: 0 0;">'+
                            '<img src="'+thumb+'?imageView2/1/w/100/h/100/q/100" class="thumb_'+data.list[i].id+'" style="width: 100px;height: 100px;">'+
                            '</div>'+
                            '<div class="item-inner">'+
                            '<div class="item-title-row" onclick=\'window.location.href="' + url + '"\'>'+
                            '<div class="item-title" style="font-size: 14px;">'+data.list[i].title+'</div>'+
                            '</div><div class="item-subtitle"><span class="shop-grid-price" onclick=\'window.location.href="' + url + '"\'>'+data.list[i].marketprice+'</span>'+
                            '<s class="shop-yuanjia">'+data.list[i].productprice+'</s>'+
                            '</div></div></a><a class="shop-card"><span class="icon icon-shop-cart" id="cart_'+data.list[i].id+'" onclick="addtocart('+data.list[i].id+')"></span></a></li>';
                    }

                    $('#data-list-0').append(result);
                }
            });
            //加载分页
            load();
        });
        function load() {
            var page = 2;
            var keywords = "<?php  echo $_GPC['keywords'];?>";
            var ccate = "<?php  echo $ccate;?>";
            var pcate = "<?php  echo $pcate;?>";
            // dropload函数接口设置
            $('.content').dropload({
                scrollArea : window,
                domDown : {
                    domClass   : 'dropload-down',
                    // 滑动到底部显示内容
                    domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
                    // 内容加载过程中显示内容
                    domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                    // 没有更多内容-显示提示
                    domNoData  : '<div class="dropload-noData">暂无数据</div>'
                },
                autoLoad:false,
                distance:2000,
                // 2 . 上拉加载更多 回调函数

                loadDownFn : function(me){
                    $.ajax({
                        type: 'GET',
                        url: '<?php  echo $this->createMobileUrl('shopping',array('op' => 'list'))?>&page='+page+'&keywords=' + keywords + '&pcate=' + pcate + '&ccate=' + ccate,
                        dataType: 'json',
                        success: function(data){
                            if(data.list.length==0){
                                me.lock();
                                // 无数据
                                me.noData();
                            }
                            var result = '';
                            for(var i = 0; i < data.list.length; i++){
                                var url = "<?php  echo $this->createMobileUrl('shopping',array('op'=> 'detail'))?>&id="+data.list[i].id;
                                var thumb = data.list[i].thumb;
                                result +='<li style="border-bottom: 1px solid #F2F2F2"><a class="item-content"><div class="item-media" onclick=\'window.location.href="' + url + '"\' style="margin: 0 0;">'+
                                    '<img src="'+thumb+'?imageView2/1/w/100/h/100/q/100" class="thumb_'+data.list[i].id+'" style="width: 100px;height: 100px;">'+
                                    '</div>'+
                                    '<div class="item-inner">'+
                                    '<div class="item-title-row" onclick=\'window.location.href="' + url + '"\'>'+
                                    '<div class="item-title" style="font-size: 14px;">'+data.list[i].title+'</div>'+
                                    '</div><div class="item-subtitle"><span class="shop-grid-price" onclick=\'window.location.href="' + url + '"\'>'+data.list[i].marketprice+'</span>'+
                                    '<s class="shop-yuanjia">'+data.list[i].productprice+'</s>'+
                                    '</div></div></a><a class="shop-card"><span class="icon icon-shop-cart" id="cart_'+data.list[i].id+'" onclick="addtocart('+data.list[i].id+')"></span></a></li>';
                            }


                            // 为了测试，延迟1秒加载
                            setTimeout(function(){
                                // 加载 插入到原有 DOM 之后
                                $('#data-list-0').append(result);
                                if(data.list.length <20){
                                    // 数据加载完
                                    // 无数据
                                    me.noData();

                                }

                                // 每次数据加载完，必须重置
                                me.resetload();
                            },1000);

                        },
                        // 加载出错
                        error: function(xhr, type){
                            // 即使加载出错，也得重置
                            me.resetload();
                        }
                    });
                    page++;

                },
                threshold : 50 //
            });
        }
    </script>
    <script>
        $('.searchbar-cancel').click(function () {
            window.location.href = "<?php  echo $this->createMobileUrl('shopping',array('op' => 'list'))?>" + "&keywords=" + $("#search").val();
        });
    </script>

    <script type="text/javascript">
        //添加到购物车
        function addtocart(id) {
            var id = id;
            var st = $('#cart_' + id).offset();
            var offset = $('.icon-cart').offset();
            var img = $('.thumb_' + id).attr('src');
            var flyer = $('<img class="u-flyer" src="' + img + '">');
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
                onEnd: function () { //结束回调
                    var url = "<?php  echo $this->createMobileUrl('shopping',array('op' => 'mycart','operation' =>'add','type' => 1),'',true)?>&id=" + id;
                    $.getJSON(url, function (s) {
                        if (s.result == 0) {
                            $.toast("库存不足，无法购买。");
                            return false;
                        } else {
                            $('.badge').text(s.total);
                            $.toast("添加成功,在购物车等亲~");

                        }
                    });
                }
            });
        }
    </script>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
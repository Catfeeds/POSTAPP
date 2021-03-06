<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f5">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
        <a class="button button-link button-nav pull-right txt-fff "id="right-btn">筛选 &nbsp;</a>
        <h1 class="title txt-fff">租赁列表</h1>
    </header>
    <aside class="pc_search" style="height: 568px;z-index:9999;">
        <form action="" method="post" id="sxForm">
            <div class="close"><span>X</span></div>
            <div id="tjsx">
                <div class="sx">筛选条件</div>
                <div class="tj">
                    <dl class="block2">
                        <dt>类型：</dt>
                        <dd class="cattsel">不限
                            <input name="category" type="radio" value="0" checked="">
                        </dd>
                        <dd>出租
                            <input name="category" type="radio" value="1">
                        </dd>
                        <dd>求租
                            <input name="category" type="radio" value="2">
                        </dd>
                        <dd>出售
                            <input name="category" type="radio" value="3">
                        </dd>
                        <dd>求购
                            <input name="category" type="radio" value="4">
                        </dd>
                    </dl>

                    <dl class="block2">
                        <dt>费用：</dt>
                        <dd class="cattsel">不限
                            <input name="price" type="radio" value="1000000" checked="">
                        </dd>
                        <dd>0-1000元
                            <input name="price" type="radio" value="1000">
                        </dd>
                        <dd>1000-2000元
                            <input name="price" type="radio" value="2000">
                        </dd>
                        <dd>2000-4000元
                            <input name="price" type="radio" value="4000">
                        </dd>
                        <dd>≥4000元
                            <input name="price" type="radio" value="6000">
                        </dd>
                    </dl>

                    <dl class="block2">
                        <dt>关键字：</dt>
                        <input type="text" name="destination" placeholder="请填写关键字   选填" class="mdd">
                    </dl>
                </div>
                <a href="javascript:void(0)" onclick="$('#sxForm').submit();" class="btn-tj"><span>提交信息</span></a>
            </div>
        </form>
    </aside>
    <div class="content">
        <div class="buttons-row repair-buttons-row houselease-buttons-row">
            <a href="#tab5" class="tab-link  button <?php  if($_GPC['category'] ==5) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease',array('op'=> 'list','category' =>5))?>'">全部</a>
            <a href="#tab1" class="tab-link  button <?php  if($_GPC['category'] ==1) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease',array('op'=> 'list','category' =>1))?>'">出租</a>
            <a href="#tab2" class="tab-link button <?php  if($_GPC['category'] ==2) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease',array('op'=> 'list','category' =>2))?>'">求租</a>
            <a href="#tab3" class="tab-link button <?php  if($_GPC['category'] ==3) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease',array('op'=> 'list','category' =>3))?>'">出售</a>
            <a href="#tab4" class="tab-link button <?php  if($_GPC['category'] ==4) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease',array('op'=> 'list','category' =>4))?>'">求购</a>
        </div>
        <div class="tabs repair-tabs">
            <div id="tab5" class="tab active">
                <div class="list-block media-list houselease-list-block">
                    <ul id="data-list-5">

                    </ul>
                </div>
            </div>
            <div id="tab1" class="tab">
                    <div class="list-block media-list houselease-list-block">
                        <ul id="data-list-1">

                        </ul>
                    </div>
            </div>
            <div id="tab2" class="tab">
                <div class="list-block media-list houselease-list-block">
                    <ul id="data-list-2">

                    </ul>
                </div>
            </div>
            <div id="tab3" class="tab">
                <div class="list-block media-list houselease-list-block">
                    <ul id="data-list-3">

                    </ul>
                </div>
            </div>
            <div id="tab4" class="tab">
                <div class="list-block media-list houselease-list-block">
                    <ul id="data-list-4">

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="btn_div">
        <div id="btn_dj">
            <span id="btn_input" class="btn_img hide_b"></span>
        </div>
        <div id="menu_b" class="menu_btn hide_m" style="width: 170px">
            <a href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease',array('op' => 'add'))?>'">发布信息</a>
            <a href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease',array('op' => 'my'))?>'">我的发布</a>
        </div>
    </div>
</div>

</body>

<script>
    $(function() {
        $("#btn_dj").click(function() {
            var input_btn = $("#btn_input")
            if (input_btn.attr("class") == "btn_img hide_b") {
                input_btn.removeClass();
                input_btn.addClass("btn_img show_b");
            } else {
                input_btn.removeClass();
                input_btn.addClass("btn_img hide_b");
            }
            var menu_b = $("#menu_b")
            if (menu_b.attr("class") == "menu_btn hide_m") {
                menu_b.removeClass();
                menu_b.addClass("menu_btn show_m");
            } else {
                menu_b.removeClass();
                menu_b.addClass("menu_btn hide_m");
            }
        })
    })
</script>
<script>
    $(function() {
        $(".pc_search").height($("#page").height())
        $("#right-btn").click(function() {
            $(".pc_search").addClass("ok_search");
        })
        $(".close").click(function() {
            $(".pc_search").removeClass("ok_search");
        })
        $(".tj dl dd").click(function() {
            $(this).attr("class", "cattsel");
            $(this).siblings("dd").removeAttr("class");
            changeAtt(this)
        })

    })

    function changeAtt(t) {
        t.lastChild.checked = 'checked';
    }
</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="UTF-8"></script>
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/default/static/css/dropload.css">
<script src="<?php echo MODULE_URL;?>template/mobile/default/static/js/dropload.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: '<?php  echo $this->createMobileUrl('houselease',array('op' => 'list'))?>&page=1',
            dataType: 'json',
            success: function(data){
                var result = '';
                for(var i = 0; i < data.list.length; i++){
                    var url = "<?php  echo $this->createMobileUrl('houselease',array('op' => 'detail'))?>&id="+data.list[i].id;
                    result +='<li onclick=\'window.location.href="' + url + '"\'><a href="#" class="item-link item-content">' ;
                    result +='<div class="item-media" style="padding-top:0.75rem">' ;
                    if(data.list[i].src){
                        result +='<img src="'+data.list[i].src+'?imageView2/2/w/120/h/82" style="width: 120px;height: 82px;"></div>';
                    }
                    else
                    {
                        result +='<img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/house.jpg" style="width: 120px;height: 82px;">';
                    }
                    result +='</div>';
                        result +='<div class="item-inner" style="height: 80px;border-bottom:0"><div class="item-title">['+data.list[i].way+']'+data.list[i].title+'</div><div class="item-title-row"><div class="item-subtitle">['+data.list[i].regionname+']</div> <div class="item-after color-danger">'+data.list[i].price;
                    if(data.list[i].category == 1 || data.list[i].category == 2){
                        result +='/月';
                    }
                    else
                    {
                        result +='/套';
                    }
                    result +='</div></div><div class="item-subtitle">发布时间:'+data.list[i].datetime+'</div><div class="item-text"><span>'+data.list[i].model_room+'室'+data.list[i].model_hall+'厅'+data.list[i].model_toilet +'卫</span><span>'+data.list[i].floor_layer+'/'+data.list[i].floor_number+'层</span><span>'+data.list[i].fitment +'</span></div></div></a></li>';
                }
                $('#data-list-5').append(result);
            }
        });
        //加载分页
        load();
    });
    function load() {
        var page = 2;
        var category ="<?php  echo $_GPC['category'];?>";
        var cate = category;
        if(category =' '){
            cate = 5;
        }
        var obj = $("#data-list-"+cate);
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
                    url: '<?php  echo $this->createMobileUrl('houselease',array('op' => 'list'))?>&page='+page+'&category='+category,
                    dataType: 'json',
                    success: function(data){
                        if(data.list.length==0){
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        var result = '';
                        for(var i = 0; i < data.list.length; i++){
                            var url = "<?php  echo $this->createMobileUrl('houselease',array('op' => 'detail'))?>&id="+data.list[i].id;
                            result += '<li onclick=\'window.location.href="' + url + '"\'><a href="#" class="item-link item-content"><div class="item-media" style="padding-top:0.75rem">';
                            if(data.list[i].src){
                                result +='<img src="'+data.list[i].src+'?imageView2/2/w/120/h/82" style="width: 120px;height: 82px;">';
                            }
                            else
                            {
                                result +='<img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/house.jpg" style="width: 120px;height: 82px;">';
                            }
                            result +='</div><div class="item-inner" style="height: 80px;border-bottom:0"> <div class="item-title">['+data.list[i].way+']'+data.list[i].title+'</div><div class="item-title-row"><div class="item-subtitle">['+data.list[i].regionname+']</div><div class="item-after color-danger">'+data.list[i].price;
                            if(data.list[i].category == 1 || data.list[i].category == 2){
                                result +='/月';
                            }
                            else
                            {
                                result +='/套';
                            }
                            result +='</div></div><div class="item-subtitle">发布时间:'+data.list[i].datetime+'</div><div class="item-text"><span>'+data.list[i].model_room+'室'+data.list[i].model_hall+'厅'+ data.list[i].model_toilet+'卫</span><span>'+data.list[i].floor_layer+'/'+data.list[i].floor_number+'层</span><span>'+data.list[i].fitment+'</span></div> </div></a></li>';
                        }


                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            // 加载 插入到原有 DOM 之后
                            obj.append(result);
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



<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
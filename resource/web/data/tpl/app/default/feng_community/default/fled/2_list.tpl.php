<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f5">
<header class="bar bar-nav bg-green" style="position: fixed">
    <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
    <!--<a class="icon icon-search pull-right txt-fff"></a>-->
    <h1 class="title txt-fff">二手市场</h1>
</header>
<div class="content">
    <div class="buttons-tab fled-nav">

        <a href="<?php  echo $this->createMobileUrl('fled')?>" class="tab-link active button">最新发布</a>
        <a href="#tab2" class="tab-link button" >分类<span class="icon icon-caret"></span>
            <ul class="nav-btn-list" id="category">

            </ul>
        </a>
        <a href="#tab3" class="tab-link button">筛选<span class="icon icon-caret"></span>
            <ul class="nav-btn-list">
                <li class="nav-btn-item"><div <?php  if(empty($_GPC['cate'])) { ?>class="on" <?php  } ?> onclick="window.location.href='<?php  echo $this->createMobileUrl('fled')?>'">全部</div></li>
                <li class="nav-btn-item"><div <?php  if($_GPC['cate'] == 1) { ?>class="on" <?php  } ?> onclick="window.location.href='<?php  echo $this->createMobileUrl('fled',array('cate' => 1))?>'">赠送邻居</div></li>
                <li class="nav-btn-item"><div <?php  if($_GPC['cate'] == 2) { ?>class="on" <?php  } ?> onclick="window.location.href='<?php  echo $this->createMobileUrl('fled',array('cate' => 2))?>'">转卖闲置</div></li>
                <li class="nav-btn-item"><div <?php  if($_GPC['cate'] == 3) { ?>class="on" <?php  } ?> onclick="window.location.href='<?php  echo $this->createMobileUrl('fled',array('cate' => 3))?>'">求购闲置</div></li>
            </ul>
        </a>
    </div>
    <div class="list-block media-list  fled-list-block mt0">
        <ul id="xqlist">


        </ul>
    </div>
</div>

<div id="btn_div">
    <div id="btn_dj"><span id="btn_input" class="btn_img hide_b"></span></div>
    <div id="menu_b" class="menu_btn hide_m" style="width: 167px"><a href="<?php  echo $this->createMobileUrl('fled',array('op' => 'add'))?>">发布信息</a><a href="<?php  echo $this->createMobileUrl('fled',array('op' => 'my'))?>">我的发布</a></div>
</div>

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
    $(document).ready(function(){

            $('.fled-nav a').click(function(){
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                    $(this).find('.nav-btn-list').fadeOut();
                    return;
                }

                $('.fled-nav a').each(function(index,value){
                if($(this).hasClass('active')){
                    //移除选中
                    $(this).removeClass('active');
                    $(this).find('.nav-btn-list').fadeOut();
                }
            })
            //添加选中
            if(!$(this).hasClass('active')){
                $(this).addClass('active');
                $(this).find('.nav-btn-list').slideToggle("");
            }
        });
    })
    var data = <?php  echo $data;?> || [];//菜单
    $(function(){
        var item = '';
        item += '<li class="nav-btn-item">';
        for(var i=0;i<data.length;i++){
            var val = data[i];
            if(i%3 == 0 && i!=0){
                item += '</li><li>';
            }
            var url = "<?php  echo $this->createMobileUrl('fled')?>&category="+val['value'];
            var category = "<?php  echo $_GPC['category'];?>";
            if(val['value'] == category){
               item += '<div style="width: 33%"><a class="on" href="'+url+'" >'+val['title']+'</a></div>';
            }else{
                item += '<div style="width: 33%"><a href="'+url+'" >'+val['title']+'</a></div>';
            }


        }
        $('#category').html(item);

    })
</script>

<script>
    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: '<?php  echo $this->createMobileUrl('fled',array('op' => 'list'))?>&page=1',
            dataType: 'json',
            success: function(data){
                var result = '';
                for(var i = 0; i < data.list.length; i++){
                    var url = "<?php  echo $this->createMobileUrl('fled',array('op' => 'detail'))?>&id="+data.list[i].id;
                    result += '<li onclick=\'window.location.href="' + url + '"\'><div class="item-content"><div class="item-media">';
                    if(data.list[i].src){
                        result +='<img src="'+data.list[i].src+'?imageView2/1/w/90/h/90/q/100" style="width: 90px;height: 90px;">';
                    }
                    else{
                        result +='<img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/fled.jpg" style="width: 90px;height: 90px;">';
                    }
                    result +='</div> <div class="item-inner"><div class="item-title-row"><div class="item-title"><span class="color-warning">【'+data.list[i].name+'】</span>'+data.list[i].title+'('+data.list[i].regionname+')</div></div><div class="item-subtitle"><span class="fled-lable">'+data.list[i].rolex+'</span><span class="fled-price color-warning">';
                    if(data.list[i].zprice == 0){
                        result +='面议';
                    }
                    else{
                        result +=data.list[i].zprice;
                    }
               result +='</span></div><div class="item-subtitle item-subtitle-time">发布时间：'+data.list[i].datetime+'</div></div></div></li>';
                }
                $('#xqlist').append(result);
            }
        });
        //加载分页
        load();
    });
    function load() {
        var page = 2;
        var cate ="<?php  echo $_GPC['cate'];?>";
        var category ="<?php  echo $_GPC['category'];?>";
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
                    url: '<?php  echo $this->createMobileUrl('fled',array('op' => 'list'))?>&page='+page+'&cate'+cate+'&category='+category,
                    dataType: 'json',
                    success: function(data){
                        if(data.list.length==0){
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        var result = '';
                        for(var i = 0; i < data.list.length; i++){
                            var url = "<?php  echo $this->createMobileUrl('fled',array('op' => 'detail'))?>&id="+data.list[i].id;
                            result += '<li onclick=\'window.location.href="' + url + '"\'><div class="item-content"><div class="item-media">';
                            if(data.list[i].src){
                                result +='<img src="'+data.list[i].src+'?imageView2/1/w/90/h/90/q/100" style="width: 90px;height: 90px;">';
                            }
                            else{
                                result +='<img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/fled.jpg" style="width: 90px;height: 90px;">';
                            }
                            result +='</div> <div class="item-inner"><div class="item-title-row"><div class="item-title"><span class="color-warning">【'+data.list[i].name+'】</span>'+data.list[i].title+'('+data.list[i].regionname+')</div></div><div class="item-subtitle"><span class="fled-lable">'+data.list[i].rolex+'</span><span class="fled-price color-warning">';
                            if(data.list[i].zprice == 0){
                                result +='面议';
                            }
                            else{
                                result +=data.list[i].zprice;
                            }
                            result +='</span></div><div class="item-subtitle item-subtitle-time">发布时间：'+data.list[i].datetime+'</div></div></div></li>';
                        }


                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            // 加载 插入到原有 DOM 之后
                            $('#xqlist').append(result);
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
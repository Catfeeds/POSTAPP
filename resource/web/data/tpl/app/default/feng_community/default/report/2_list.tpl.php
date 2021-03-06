<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
        <h1 class="title txt-fff">意见列表</h1>
    </header>
    <div class="content">
        <div class="buttons-row repair-buttons-row" >
            <a href="#tab0" class="tab-link  button <?php  if(empty($_GPC['status'])) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('report',array('op'=> 'list'))?>'">全部建议</a>
            <a href="#tab1" class="tab-link button <?php  if($_GPC['status'] ==1) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('report',array('op'=> 'list','status' => 1))?>'">已处理</a>
            <a href="#tab2" class="tab-link button <?php  if($_GPC['status'] ==2) { ?>active<?php  } ?>" onclick="window.location.href='<?php  echo $this->createMobileUrl('report',array('op'=> 'list','status' => 2))?>'">未处理</a>
        </div>
        <div class="tabs repair-tabs">
            <div id="tab0" class="tab active">
                <div class="list-block media-list houselease-list-block">
                    <ul id="data-list-0">

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
        </div>

    </div>
    <div id="btn_div">
        <div id="btn_dj">
            <span id="btn_input" class="btn_img hide_b"></span>
        </div>
        <div id="menu_b" class="menu_btn hide_m">
            <a href="" onclick="window.location.href='tel:<?php  echo $region['linkway'];?>'">电话建议</a>
            <a href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('report',array('op' => 'add'))?>'">在线建议</a>
            <a href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('report',array('op' => 'my'))?>'">我的意见</a>
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
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<script>
    $(document).ready(function(){
        var status ="<?php  echo $_GPC['status'];?>";
        $.ajax({
            type: 'GET',
            url: '<?php  echo $this->createMobileUrl('report',array('op' => 'list'))?>&page=1&status='+status,
            dataType: 'json',
            success: function(data){
                var result = '';
                for(var i = 0; i < data.list.length; i++){
                    result += '<li onclick=\'window.location.href="' + data.list[i].url + '"\'><a href="#" class="item-link item-content"><div class="item-inner"><div class="item-title-row"><div class="item-title"> <span class="repair-lable '+data.list[i].css5+'">'+data.list[i].s+'</span>';
                    if(data.list[i].category){
                        result += data.list[i].category
                    }
                    if(data.list[i].xqcategory){
                        result += data.list[i].xqcategory
                    }
                    result +='</div></div><div class="item-subtitle">建议日期：'+data.list[i].datetime+'</div></div></a> </li>';
                }
                $('#data-list-0').append(result);
            }
        });
        //加载分页
        load();
    });
    function load() {
        var page = 2;
        var status ="<?php  echo $_GPC['status'];?>";

        var obj = $("#data-list-"+status);
        // dropload函数接口设置
        $('.tab').dropload({
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

            // 2 . 上拉加载更多 回调函数

            loadDownFn : function(me){
                $.ajax({
                    type: 'GET',
                    url: '<?php  echo $this->createMobileUrl('report',array('op' => 'list'))?>&page='+page+'&status='+status,
                    dataType: 'json',
                    success: function(data){
                        if(data.list.length==0){
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        var result = '';
                        for(var i = 0; i < data.list.length; i++){
                            result += '<li onclick=\'window.location.href="' + data.list[i].url + '"\'><a href="#" class="item-link item-content"><div class="item-inner"><div class="item-title-row"><div class="item-title"> <span class="repair-lable '+data.list[i].css5+'">'+data.list[i].s+'</span>';
                            if(data.list[i].category){
                                result += data.list[i].category
                            }
                            if(data.list[i].xqcategory){
                                result += data.list[i].xqcategory
                            }
                            result +='</div></div><div class="item-subtitle">建议日期：'+data.list[i].datetime+'</div></div></a> </li>';
                        }


                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            // 加载 插入到原有 DOM 之后
                            $("#data-list-0").append(result);
                            page++;
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


            },
            threshold : 50 //
        });
    }
</script>
<script>$.config = {autoInit: true}</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f5">
<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
    <h1 class="title txt-fff">活动列表</h1>
</header>
<div class="content">
    <div class="data-content">

    </div>


</div>

<script>
    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: '<?php  echo $this->createMobileUrl('activity',array('op' => 'list'))?>&page=1',
            dataType: 'json',
            success: function(data){
                var result = '';
                for(var i = 0; i < data.list.length; i++){
                    var url = "<?php  echo $this->createMobileUrl('activity',array('op'=> 'detail'))?>&id="+data.list[i].id;       var title = "<?php  echo $region['title'];?>";
                    result += '<div class="list-block media-list activity-list-block" onclick=\'window.location.href="' + url + '"\' style="margin: 0 0;"><ul><li><a href="#" class="item-link item-content">';
                       if(data.list[i].picurl){
                result +='<div class="item-media" style="padding-bottom: 1.5rem;"><img src="'+data.list[i].picurl+'?imageView2/1/w/140/h/105/q/100" style="width: 140px;height: 105px;"></div>';
                        }
               result +='<div class="item-inner"><div class="item-title-row"><div class="item-title">'+data.list[i].title+'</div></div><div class="item-subtitle color-gray">累计<span class="color-warning">'+data.list[i].total+'</span>人报名</div><div class="item-subtitle color-gray">报名时间：'+data.list[i].enddate+'</div><div class="item-text color-gray">报名地点: '+title+'</div></div></a></li></ul></div>';
                }

                $('.data-content').append(result);
            }
        });
        //加载分页
        load();
    });
    function load() {
        var page = 2;

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
                    url: '<?php  echo $this->createMobileUrl('activity',array('op' => 'list'))?>&page='+page,
                    dataType: 'json',
                    success: function(data){
                        if(data.list.length==0){
                            me.lock();
                            // 无数据
                            me.noData();
                        }
                        var result = '';
                        for(var i = 0; i < data.list.length; i++){
                            var url = "<?php  echo $this->createMobileUrl('activity',array('op'=> 'detail'))?>&id="+data.list[i].id;       var title = "<?php  echo $region['title'];?>";
                            result += '<div class="list-block media-list activity-list-block" onclick=\'window.location.href="' + url + '"\' style="margin: 0 0;"><ul><li><a href="#" class="item-link item-content">';
                            if(data.list[i].picurl){
                                result +='<div class="item-media" style="padding-bottom: 1.5rem;"><img src="'+data.list[i].picurl+'?imageView2/1/w/140/h/105/q/100" style="width: 140px;height: 105px;"></div>';
                            }
                            result +='<div class="item-inner"><div class="item-title-row"><div class="item-title">'+data.list[i].title+'</div></div><div class="item-subtitle color-gray">累计<span class="color-warning">'+data.list[i].total+'</span>人报名</div><div class="item-subtitle color-gray">报名时间：'+data.list[i].enddate+'</div><div class="item-text color-gray">报名地点: '+title+'</div></div></a></li></ul></div>';
                        }


                        // 为了测试，延迟1秒加载
                        setTimeout(function(){
                            // 加载 插入到原有 DOM 之后
                            $('.data-content').append(result);
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
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<style>
    .xqactive{
        color:green;
        background: #FFFFff;
    }
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=77E9802d7cfbcde01b5ea17f1388f35d"></script>
<body class="max-width bg-f5">
<div>
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
        <!--<a class="icon icon-search pull-right txt-fff" href=""></a>-->
        <h1 class="title txt-fff">周边商家</h1>
    </header>
    <div class="screening">
        <ul>
            <li class="Brand <?php  if(empty($_GPC['type'])) { ?>xqactive<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'list'))?>'" style="height: 40px;font-size: 14px;line-height: 40px;">推荐</li>
            <li class="Regional <?php  if($_GPC['type'] == 2 ) { ?>xqactive<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'list','type' => 2))?>'" style="height: 40px;font-size: 14px;line-height: 40px;">距离近</li>
            <li class="Sort <?php  if($_GPC['type'] == 1 ) { ?>xqactive<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('business',array('op' => 'list','type' => 1))?>'" style="height: 40px;font-size: 14px;line-height: 40px;">价格低</li>
        </ul>
    </div>
    <div class="Category-eject">
        <ul class="Category-w" id="Categorytw">
            <li onclick="Categorytw(this)">全部分类</li>
            <li onclick="Categorytw(this)">炒菜米饭</li>
            <li onclick="Categorytw(this)">盖浇饭</li>
            <li onclick="Categorytw(this)">大碗面</li>
            <li onclick="Categorytw(this)">米线</li>
            <li onclick="Categorytw(this)">馄饨</li>
            <li onclick="Categorytw(this)">汤包</li>
        </ul>
        <ul class="Category-t" id="Categoryt">
            <li onclick="Categoryt(this)">1</li>
            <li onclick="Categoryt(this)">2</li>
            <li onclick="Categoryt(this)">3</li>
            <li onclick="Categoryt(this)">4</li>
            <li onclick="Categoryt(this)">5</li>
            <li onclick="Categoryt(this)">6</li>
            <li onclick="Categoryt(this)">7</li>
        </ul>
        <ul class="Category-s" id="Categorys">
            <li onclick="Categorys(this)">11</li>
            <li onclick="Categorys(this)">22</li>
            <li onclick="Categorys(this)">33</li>
            <li onclick="Categorys(this)">44</li>
            <li onclick="Categorys(this)">55</li>
            <li onclick="Categorys(this)">66</li>
            <li onclick="Categorys(this)">77</li>
        </ul>

    </div>
    <div class="grade-eject ">
        <ul class="grade-w" id="gradew">
            <li onclick="grade1(this)">江苏</li>
            <li onclick="grade1(this)">北京</li>
            <li onclick="grade1(this)">河北</li>
        </ul>
        <ul class="grade-t" id="gradet">
            <li onclick="gradet(this)">南京</li>
            <li onclick="gradet(this)">扬州</li>
            <li onclick="gradet(this)">盐城</li>
        </ul>
        <ul class="grade-" id="gradets">
            <li onclick="grades(this)">新街口</li>
            <li onclick="grades(this)">建邺区</li>
            <li onclick="grades(this)">雨花区</li>
        </ul>
    </div>
    <div class="Sort-eject Sort-height ">
        <ul class="Sort-Sort" id="Sort-Sort">
            <li onclick="Sorts(this)" style="">智能排序</li>
            <li onclick="Sorts(this)" style="">离我最近</li>
            <li onclick="Sorts(this)" style="">好评优先</li>
            <li onclick="Sorts(this)">最新发布</li>
            <li onclick="Sorts(this)">人气优先</li>
            <li onclick="Sorts(this)">价格最低</li>
            <li onclick="Sorts(this)">价格最高</li>
        </ul>
    </div>
    <div class="content">
        <div class="list-block media-list business-list-block">
            <ul id="data-list">


            </ul>
        </div>
        <p><a href="#" class="button button-success" style="width: 50%;margin: 0 auto" id="gdregion">加载更多..</a></p>
    </div>

</div>
<script type="text/html" id="xq_list">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
    <li onclick="window.location.href='{{ d.list[i].businessurl }}';" style="    border-bottom: 1px solid #e7e7e7;">
        <div class="item-content">
            <div class="item-media"><img src="{{ d.list[i].picurl }}?imageView2/1/w/90/h/60/q/100" style="width: 90px;height: 60px;"></div>
            <div class="item-inner" style="border-bottom:0">
                <div class="item-title-row">
                    <div class="item-title" style="font-size: 14px;">{{ d.list[i].sjname }}</div>
                </div>
                <div class="item-title-row">
                    <div class="item-title">
                        <span style="font-size: 12px;">{{# if(d.list[i].area){ }}商圈:{{ d.list[i].area }}{{# } }} {{# if(d.list[i].price){ }}&nbsp;&nbsp;人均:{{ d.list[i].price }}元{{#  } }}</span>
                        <!--<span class="business-list-price color-warning"></span>-->
                        <!--<a href="tel:{{ d.list[i].mobile }}">-->
                            <!--<span class="icon icon-phone" style="font-size: 16px;color: rgb(72, 181, 78)"></span>-->
                        <!--</a>-->
                    </div>
                    {{# if(d.list[i].juli){ }}
                    <div class="item-after"><span class="color-warning" style="font-size: 14px;">{{ d.list[i].juli }}km</span></div>
                    {{# } }}
                </div>

                <div class="item-title" style="font-size: 12px;">{{ d.list[i].address }}</div>
            </div>
        </div>
    </li>
    {{# } }}

</script>
<script>
    $(document).ready(function() {
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                var mk = new BMap.Marker(r.point);
                var lng = r.point.lng;
                var lat = r.point.lat;
                var type ="<?php  echo $_GPC['type'];?>";
                loaddata("<?php  echo $this->createMobileUrl('business',array('op' => 'list','parent' => $parent,'keyword' => $keyword))?>&lng="+lng+"&lat="+lat+"&type="+type, $("#data-list"),'xq_list' ,true);
                var page = 1;
                $("#gdregion").click(function () {
                    page++;
                    link = "<?php  echo $this->createMobileUrl('business',array('op' => 'list','parent' => $parent,'keyword' => $keyword))?>&lng="+lng+"&lat="+lat+"&page="+page+"&type="+type;
                    $.get(link, function (data) {
                            if (data.list.length > 0) {
                                var gettpl = document.getElementById('xq_list').innerHTML;
                                laytpl(gettpl).render(data, function(html){
                                    $("#data-list").append(html);
                                });
                            }else{
                                $("#gdregion").html('全部数据加载完毕');
                            }
                    }, 'json');
                })
            }else {
                alert('获取当前位置失败,请确认是否开启定位服务');
            }
        },{enableHighAccuracy: true})

    });
</script>
<script>$.config = {autoInit: true}</script>


<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<?php  if(set('p86')['value']) { ?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=77E9802d7cfbcde01b5ea17f1388f35d"></script>
<?php  } ?>

<style>
    .button{
        height:40px;
        line-height: 40px;
    }
</style>
<body class="max-width">
<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
    <h1 class="title txt-fff">手机开门</h1>
</header>
<div class="content page">

    <div class="content-block">
        <div class="buttons-row theme-green">
            <a href="#tab1" class="tab-link active button" >大门</a>
            <a href="#tab2" class="tab-link button" onclick="opendoor()">单元门</a>
            <a href="#tab3" class="tab-link button" >访客二维码</a>
        </div>
    </div>
    <div class="tabs theme-green">
        <div id="tab1" class="tab active">
            <div class="content-block">

                <div class="list-block">
                    <ul id="content">

                    </ul>
                </div>

            </div>
        </div>

        <div id="tab3" class="tab">
            <form role="form" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="list-block">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label width80">
                                    类别
                                </div>
                                <div class="item-input">
                                    <select name="type" id="type">
                                        <option value="0">开门位置</option>
                                        <option value="2">大门</option>
                                        <option value="1">单元门</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label width80">
                                    位置
                                </div>
                                <div class="item-input">
                                    <select name="door" id="door">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label width80">时间</div>
                                <div class="item-input">
                                    <input type="text" placeholder="如果10分钟，就填写10" type="number" pattern="[0-9]*" id="opentime">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            </form>
            <div class="content-block">
                <p><a href="javascript:;" class="button button-success button-fill" id="showToast" style="line-height: 40px;">生成二维码</a></p>
            </div>
        </div>

    </div>
</div>
<script type="text/html" id="xq_list">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
    <li class="item-content item-link" onclick="xqopen({{ d.list[i].id }})">
        <div class="item-inner">
            <div class="item-title">{{ d.list[i].title }}{{ d.list[i].unit }}</div>
            <div class="item-after"></div>
        </div>
    </li>
    {{# } }}

</script>

<style>
    .xqbar-tab {
        bottom: 0;
        z-index: 9000;
        width: 100%;
        height: 80px;
        padding: 0;
        table-layout: fixed;
        border-top: 1px solid #e7e7e7;
        border-bottom: 0;
        border-left: 0;
        -webkit-transition-duration: 400ms;
        -o-transition-duration: 400ms;
        transition-duration: 400ms;
    }
    .xqbar {
        position: absolute;
        right: 0;
        left: 0;
        z-index: 10;
        height: 80px;
        background-color: #f7f7f8;
        border-bottom: 1px solid #e7e7e7;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
</style>
<?php  if($slides) { ?>
<div class="xqbar xqbar-tab" style="margin-top: 30px;">
    <div class="swiper-container" >
        <div class="swiper-wrapper">
            <?php  if(is_array($slides)) { foreach($slides as $row) { ?>
            <div class="swiper-slide" onclick="javascript:window.location.href='<?php  echo $row['url'];?>';">
                <img src="<?php  echo $row['thumb'];?>?imageView2/1/w/640/h/320/q/100" style="max-height: 80px;">
            </div>
            <?php  } } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>
<?php  } ?>
<script type="text/javascript">
    function xqopen(id){
        var id = id;
        window.location.href = "<?php  echo $this->createMobileUrl('lock')?>&id="+id;
    }
    $(function(){
        var mySwiper = $('.swiper-container').swiper({
            pagination:'.swiper-pagination',
            observer: true, //修改swiper自己或子元素时，自动初始化swiper
            observeParents: true, //修改swiper的父元素时，自动初始化swiper
            autoplay : 3000
        });

        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            observer: true, //修改swiper自己或子元素时，自动初始化swiper
            observeParents: true, //修改swiper的父元素时，自动初始化swiper
//            autoplay : 3000
        });
    })
</script>
<script>
    function opendoor(){
        $.post("<?php  echo $this->createMobileUrl('opendoor',array('op' => 'ajax'))?>",{},function(s){
            if(s.status == 1){
                window.location.href = "<?php  echo $this->createMobileUrl('lock')?>&id="+ s.id;
            }
        },'json')
    }
</script>
<script>
    $(document).ready(function() {
        <?php  if(set('p86')['value']) { ?>
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                var mk = new BMap.Marker(r.point);
                var lng = r.point.lng;
                var lat = r.point.lat;
                var url = "<?php  echo $this->createMobileUrl('opendoor')?>&lng="+lng+"&lat="+lat;
                $.get(url,function (data) {
                    if (data.list.length > 0) {
                        var gettpl = document.getElementById('xq_list').innerHTML;
                        laytpl(gettpl).render(data, function(html){
                            $("#content").append(html);
                        });
                    }
                },'json')
            }else {
                alert('获取当前位置失败,请确认是否开启定位服务');
            }
        },{enableHighAccuracy: true})
        <?php  } ?>
        <?php  if(!set('p86')['value']) { ?>
        var url = "<?php  echo $this->createMobileUrl('opendoor')?>";
        $.get(url,function (data) {
            if (data.list.length > 0) {
                var gettpl = document.getElementById('xq_list').innerHTML;
                laytpl(gettpl).render(data, function(html){
                    $("#content").append(html);
                });
            }
        },'json')
        <?php  } ?>

    });
</script>
<script type="text/javascript">

    $(function() {
        $("#type").change(function(){
            var type = $("#type option:selected").val();
            if(type == 2){
                $.post("<?php  echo $this->createMobileUrl('opendoor',array('op' => 'door'))?>",{},function(s){
                    var op =" <option value='0'>选择大门</option>";
                    $.each(s,function(name,val) {
                        op +="<option value='"+val.id+"' >"+val.title+"</option>";
                    });
                    $("#door").html(op);

                },'json')
            }
        })
        $("#showToast").click(function(event) {
            var opentime = $("#opentime").val();
            if (opentime == '') {
                alert('使用时间不能为空！');
                return false;
            };
            if(opentime > 2000){
                alert('临时二维码最高只能设置2000分钟！');
                return false;
            }
            var type = $("#type option:selected").val();
            if(type == 0 ){
                alert('请选择类别哦！');
                return false;
            }
            var door = $("#door option:selected").val();
            $.ajax({
                url: "<?php  echo $this->createMobileUrl('opendoor',array('op' => 'visit'))?>",
                dataType: 'json',
                data: {
                    type: type,
                    opentime: opentime,
                    door : door
                },
                success: function(s) {
                    if (s.status == 1) {
                        $.toast('成功生成');
                        setTimeout(function() {
                            window.location.href=s.url;
                        }, 2000);
                    };
                }
            })


        });
    })
</script>
<script>$.config = {autoInit: true}</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7-swiper.min.js" charset="utf-8"></script>
</body>

<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7-swiper.min.js" charset="utf-8"></script>
<!--<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="UTF-8"></script>-->
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/swiper.min.js" charset="utf-8"></script>
</html>
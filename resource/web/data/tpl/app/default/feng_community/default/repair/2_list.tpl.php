<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>

<body class="max-width">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
        <h1 class="title txt-fff">报修列表</h1>
    </header>
    <div class="content ">
        <div class="buttons-row repair-buttons-row">
            <a href="#tab0" class="tab-link  button active" onclick="xqrepair(0)">全部报修</a>
            <a href="#tab1" class="tab-link button" onclick="xqrepair(1)">已处理</a>
            <a href="#tab2" class="tab-link button" onclick="xqrepair(2)">未处理</a>
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
        <p><a href="#" class="button button-success" style="width: 50%;margin: 0 auto" id="gdregion">加载更多..</a></p>
    </div>
    <div id="btn_div">
        <div id="btn_dj">
            <span id="btn_input" class="btn_img hide_b"></span>
        </div>
        <div id="menu_b" class="menu_btn hide_m">
            <a href="" onclick="window.location.href='tel:<?php  echo $region['linkway'];?>'">电话报修</a>
            <a href="" onclick="window.location.href='<?php  echo $this->createMobileUrl('repair',array('op' => 'add'))?>'">在线报修</a>
            <a href="" onclick="window.location.href='<?php  echo $this->createMobileUrl('repair',array('op' => 'my'))?>'">我的报修</a>
        </div>
    </div>
</div>

</body>
<script type="text/html" id="xq_list">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
    <li onclick="window.location.href='{{ d.list[i].url }}'">
        <a href="#" class="item-link item-content">
            <div class="item-inner">
                <div class="item-title-row">
                    <div class="item-title">
                        <span class="repair-lable {{ d.list[i].css5 }}">{{ d.list[i].s}}</span>
                        {{# if(d.list[i].category){ }}
                        {{ d.list[i].category}}
                        {{# } }}
                        {{# if(d.list[i].xqcategory){ }}
                        {{ d.list[i].xqcategory }}
                        {{# } }}
                    </div>
                </div>
                <div class="item-subtitle">
                    建议日期：{{ d.list[i].datetime}}
                </div>
            </div>
        </a>
    </li>
    {{# } }}

</script>
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
    $(document).ready(function() {
        var status ="<?php  echo $_GPC['status'];?>";
        loaddata("<?php  echo $this->createMobileUrl('repair',array('op' => 'list'))?>&status="+status, $("#data-list-0"),'xq_list' ,true);
        $("#gdregion").click(function () {
            page++;
            link = "<?php  echo $this->createMobileUrl('repair',array('op' => 'list'))?>&status=" + status +"&page="+page;
            $.get(link, function (data) {
                if (data.list.length > 0) {
                    var gettpl = document.getElementById('xq_list').innerHTML;
                    laytpl(gettpl).render(data, function(html){
                        $("#data-list-0").append(html);
                    });
                }else{
                    $("#gdregion").html('全部数据加载完毕');
                }
            }, 'json');
        })
    });
</script>
<script>
    function xqrepair(status) {
        var status =status;
        var url = "<?php  echo $this->createMobileUrl('repair',array('op'=>'list'))?>&status="+status;
        var obj = $("#data-list-"+status);
        var object= 'xq_list';
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
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
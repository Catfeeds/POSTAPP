<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f5">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
        <h1 class="title txt-fff">家政服务</h1>
    </header>
<div class="content" style="    top: 1.7rem;">
    <input type="hidden" value="<?php  echo $item['id'];?>" id="hid" />
    <div class="list-block  mt10 ma0">
        <ul>
            <li>
                <div class="item-content item-link">
                    <div class="item-inner">
                        <div class="item-title label ">选择服务:</div>
                        <div class="item-input">
                            <select id='category'>
                                <option value="0">选择服务</option>
                                <?php  if(is_array($categories)) { foreach($categories as $category) { ?>
                                <option value="<?php  echo $category['id'];?>" <?php  if($category['id'] == $item['category']) { ?>selected='selected' <?php  } ?>>

                                    <?php  echo $category['name'];?>&nbsp;&nbsp;
                                    <p style='font-size:10px;'>
                                        <?php  echo $category['price'];?>/<?php  echo $category['gtime'];?>
                                    </p>

                                </option>
                                <?php  } } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">服务时间:</div>
                        <div class="item-input">
                            <input type="text" id="servicetime" value="<?php  if($item['servicetime']) { ?><?php  echo $item['servicetime'];?> <?php  } else { ?><?php  echo date('Y-m-d H:i',TIMESTAMP)?><?php  } ?>">
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="list-block mt10 ma0" id="description" style="display: none">
        <ul>
            <li class="item-content">
                <div class="item-inner">
                    <div class="item-input">
                        <textarea  placeholder="问题描述，长度5-200个字之间" rows="3" readonly="readonly" ></textarea>

                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="list-block mt10 ma0">
        <ul>
            <li class="item-content">
                <div class="item-inner">
                    <div class="item-input">
                        <textarea  placeholder="问题描述，长度5-200个字之间" rows="3" id="content"><?php  echo $item['content'];?></textarea>
                        <div class="textarea-counter">
                            <span>0</span>/200
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="content-block mt10">
        <a href="#" class="button button-big button-fill button-success" id="showToast">申请预约</a>
    </div>
    <div id="btn_div">
        <div id="btn_dj">
            <span id="btn_input" class="btn_img hide_b"></span>
        </div>
        <div id="menu_b" class="menu_btn hide_m" style="width: 170px">
            <a href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('homemaking',array('op' => 'my'))?>'">我的发布</a>
        </div>
    </div>
</div>
</div>
<script>
    $.config = {
        autoInit: true //no recommend
    }
</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7-swiper.min.js" charset="utf-8"></script>
<script>
    $("#servicetime").datetimePicker({
        toolbarTemplate: '<header class="bar bar-nav">\
    <button class="button button-link pull-right close-picker">确定</button>\
    <h1 class="title">选择服务时间</h1>\
    </header>'
    });
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
<script type="text/javascript">


    $(function() {
        $("#category").change(function() {
            var cid = $("#category option:selected").val();
            if (cid != '0') {
                $.getJSON("<?php  echo $this->createMobileUrl('homemaking',array('op' => 'ajax'))?>", {cid:cid}, function (data) {
                    var content = '服务介绍：';
                    content += data.description;
                    $("#description textarea").html(content);
                    $("#description").show();
                });
            } else {

            }
        });
        $("#showToast").click(function(event) {
            var content = $("#content").val();
            if (content == '') {
                alert('描述不能为空！');
                return false
            };
            if (content.length <= 5 || content.length >= 200) {
                alert('描述必须大于5个小于200个字');
                return false
            };
            var category = $("#category").val();
            if (category == '0') {
                alert('请选择分类，如没有分类联系管理员增加本类服务');return false;
            };
            var servicetime = $("#servicetime").val();
            if (servicetime == '') {
                alert('请选择时间');return false;
            };
            var realname = $("#realname").val();
            var mobile = $("#mobile").val();
            var address = $("#address").val();
            var hid = $("#hid").val();
            $.ajax({
                url: "<?php  echo $this->createMobileUrl('homemaking',array('op' => 'add'))?>",
                dataType: 'json',
                data: {
                    content: content,
                    category: category,
                    servicetime: servicetime,
                    realname: realname,
                    mobile: mobile,
                    address: address,
                    id:hid
                },
                success: function(s) {
                    if (s.status == 1) {
                        $.toast("预约已提交");
                        setTimeout(function() {
                            window.location.href="<?php  echo $this->createMobileUrl('home')?>";
                        }, 3000);
                    };
                }
            })


        });
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
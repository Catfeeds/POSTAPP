<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f2">
<div class="page">
    <!-- 标题栏 -->
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
        <h1 class="title txt-fff">新增地址</h1>
    </header>

    <!-- 这里是页面内容区 -->
    <div class="content">
        <div class="list-block" style="margin:0">
            <ul>
                <?php  if(set('p19')['value'] || set('x2',array('regionid'=>$regionid))['value']) { ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-phone"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="tel" placeholder="手机号码" id='mobile' value="">
                            </div>
                            <?php  if(set('s4')['value'] || set('x22',array('regionid' => $regionid))['value']) { ?>
                            <div class="item-after">
                                <button class="register-code" onclick="sendVerifyCode();" id="verifyCodeBtn">获取验证码
                                </button>
                            </div>
                            <?php  } ?>
                        </div>

                    </div>
                </li>
                <?php  if(set('s4')['value'] || set('x22',array('regionid' => $regionid))['value']) { ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-gift"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="number" placeholder="短信验证码" id="verifycode">
                                <input type="hidden" id="_code">
                            </div>
                        </div>
                    </div>
                </li>
                <?php  } ?>

                <?php  } ?>
                <?php  if(set('p20')['value'] || set('x3',array('regionid' => $regionid))['value']) { ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-star"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="注册码" id="code">
                            </div>
                        </div>
                    </div>
                </li>
                <?php  } ?>
                <?php  if(set('x2',array('regionid' =>$regionid))['value'] || set('p19')['value'] || set('p20')['value'] || set('x3',array('regionid' => $regionid))['value']) { ?>

                <?php  } else { ?>
                <?php  if(set('p36')['value'] || set('x17',array('regionid' => $regionid))['value'] || set('p38')['value'] || set('x18',array('regionid' => $regionid))['value'] || set('p40')['value'] || set('x19',array('regionid' => $regionid))['value'] || set('p42')['value'] || set('x20',array('regionid' => $regionid))['value']) { ?>

                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-settings"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  if(set('p36')['value'] || set('x17',array('regionid' => $regionid))['value']) { ?>
                                <div class=" register-form " style="width: 25%">
                                    <input id='area' style="width: calc(100% - 39px);"/><label><?php  echo $area;?></label>
                                </div>
                                <?php  } ?>
                                <?php  if(set('p38')['value'] || set('x18',array('regionid' => $regionid))['value']) { ?>
                                <div class=" register-form " style="width: 25%">
                                    <input id='build' style="width: calc(100% - 39px);"/><label><?php  echo $build;?></label>
                                </div>
                                <?php  } ?>
                                <?php  if(set('p40')['value'] || set('x19',array('regionid' => $regionid))['value']) { ?>
                                <div class=" register-form " style="width: 20%">
                                    <input id='unit' style="width: calc(100% - 39px);" value="1"/><label><?php  echo $unit;?></label>
                                </div>
                                <?php  } ?>
                                <?php  if(set('p42')['value'] || set('x20',array('regionid' => $regionid))['value']) { ?>
                                <div class=" register-form " style="width: 30%">
                                    <input id='room' style="width: calc(100% - 39px);"/><label><?php  echo $room;?></label>

                                </div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php  } ?>
                <?php  } ?>
                <li>
            </ul>
        </div>
        <div class="content-block">
            <div class="row" style="width: 40%;margin: 0 auto">
                <a href="#" class="button button-big button-fill button-success" id="showToast">提交</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#showToast").click(function(event) {
            var build = $("#build").val();
            if (build == '') {
                alert('请填写楼栋');
                return false
            };
            var unit = $("#unit").val();
            if (unit == '') {
                alert('请填写单元');
                return false
            };
            var room = $("#room").val();
            if (room == '') {
                alert('请填写房号');
                return false
            };
            var area = $("#area").val();
            var memberid = "<?php  echo $memberid;?>";
            var verifycode = $("#verifycode").val();
            var _code = $("#_code").val();
            if(_code == ''){
                $.toast('点击获取验证码');return false;
            }
            if(verifycode == ''){
                $.toast('输入验证码');return false;
            }
            if (_code) {
                if (_code != verifycode) {
                    $.toast('验证码错误');
                    return false;
                }
            }
            var code = $("#code").val();
            <?php  if($code) { ?>


            if (code == '') {
                alert('注册码必填');
                return false;
            }
            ;
            <?php  } ?>
            $.ajax({
                url: "<?php  echo $this->createMobileUrl('member',array('op' => 'addr'))?>",
                dataType: 'json',
                data: {
                    build:build,
                    unit:unit,
                    room:room,
                    area:area,
                    memberid:memberid,
                    code:code
                },
                success: function(s) {
                    if (s.status == 1) {
                        $.toast(s.content);
                        setTimeout(function () {
                            window.location.href = "<?php  echo $this->createMobileUrl('home')?>";
                        }, 2000);
                    }
                    if (s.status == 2) {
                        $.toast(s.content);
                    }
                }
            })


        });

    })

</script>
<script type="text/javascript">
    function sendVerifyCode() {
        var mobile = $('#mobile').val();
        if (!mobile) {
            alert('请输入您的手机号码！');
            return false;
        }
        if (mobile.search(/^1[3|5|7|4|5|8|][0-9]\d{4,8}$/) == -1) {
            alert('请输入正确的手机号码！');
            return false;
        }
        $('#verifyCodeBtn').addClass('active');
        $('#verifyCodeBtn').attr('disabled', true);
        var countdown = 60;
        timer = setInterval(function () {
            $('#verifyCodeBtn').html(countdown--);
            if (countdown == 0) {
                $('#verifyCodeBtn').removeClass('active');
                $('#verifyCodeBtn').html('重新发送');
                clearInterval(timer);
                $('#verifyCodeBtn').attr('disabled', false);
            }
        }, 1000);
        var regionid = "<?php  echo $regionid;?>";
        $.post("<?php  echo $this->createMobileUrl('api',array('op' => 'verity'))?>&mobile=" + mobile + "&regionid=" + regionid,
            function (data) {
                $("#_code").val(data);
            }, 'json');
    }
</script>

<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
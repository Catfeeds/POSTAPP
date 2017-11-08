<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>

<body class="max-width">
<div class="page" >
        <div class="register-hd">
            <div class="register-img">
                <img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/register-1.png">
            </div>
            成为认证业主，获得更多实用功能
        </div>
        <div class="content-block-title">申请业主认证</div>
        <div class="list-block">
            <ul>

                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-phone"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="tel" placeholder="手机号码" id='mobile' value="">
                            </div>
                            <?php  if(set('s4')['value'] || set('x23',array('regionid' => $_GPC['regionid']))['value']) { ?>
                            <div class="item-after">
                                <button class="register-code" onclick="sendVerifyCode();" id="verifyCodeBtn">获取验证码
                                </button>
                            </div>
                            <?php  } ?>
                        </div>

                    </div>
                </li>
                <?php  if(set('s4')['value'] || set('x22',array('regionid' => $_GPC['regionid']))['value']) { ?>
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
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-me"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="姓名" id='realname' value="<?php  echo $_W['member']['realname'];?>">
                            </div>
                        </div>
                    </div>
                </li>
                <?php  if(set('p20')['value'] || set('x3',array('regionid' => $_GPC['regionid']))['value']) { ?>
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
                <?php  if(set('x2',array('regionid' => $_GPC['regionid']))['value'] || set('p19')['value'] || set('p20')['value'] || set('x3',array('regionid' => $_GPC['regionid']))['value']) { ?>
                <!--<li>-->
                    <!--<div class="item-content">-->
                        <!--<div class="item-media"><i class="icon icon-home"></i></div>-->
                        <!--<div class="item-inner">-->
                            <!--<div class="item-input">-->
                                <!--<select id="address">-->
                                    <!--<option value="0">选择房号</option>-->

                                <!--</select>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</li>-->
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
                <?php  if(set('p81')['value'] || set('x52',array('regionid' => $regionid))['value']) { ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-share"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="车牌号" id='license' value="">
                            </div>
                        </div>
                    </div>
                </li>
                <?php  } ?>
                <?php  if(set('p83')['value'] || set('x55',array('regionid' => $regionid))['value']) { ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-card"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="身份证" id='idcard' value="">
                            </div>
                        </div>
                    </div>
                </li>
                <?php  } ?>
                <?php  if(set('p84')['value'] || set('x56',array('regionid' => $regionid))['value']) { ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-emoji"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <label class="radio-inline">
                                <input type="radio" name="gender" value="1">男
                                </label>
                                &nbsp;&nbsp;
                                <label class="radio-inline">
                                <input type="radio" name="gender" value="2">女
                                </label>
                            </div>
                        </div>
                    </div>
                </li>
                <?php  } ?>
                <?php  if(set('p80')['value']) { ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-message"></i></div>
                        <div class="item-inner">
                            <div class="item-input alert-text" style="color: #4cd964;" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('register',array('op' =>'xy'))?>'">
                                同意用户协议
                            </div>

                            <div class="item-after">
                                <label class="label-switch">
                                    <input type="checkbox" id="xqxy" >
                                    <div class="checkbox"></div>
                                </label>
                            </div>

                        </div>

                    </div>
                </li>
                <?php  } ?>
            </ul>
        </div>
        <div class="content-block">
            <a href="#" class="button button-big button-fill button-success" id="showToast">确认注册</a>
        </div>
</div>

<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="UTF-8"></script>
<script type="text/javascript">
    $(function () {
        $(document).on('click','.alert-text',function () {
            $(".back").show();
        });
        $("#showToast").click(function (event) {
//            var xy = $("#xqxy").val();
            <?php  if(set('p80')['value']) { ?>
            var xycheck = $("input:checkbox:checked").val();
//            alert(xycheck);return false;
            if (xycheck != 'on') {
                alert('请同意用户协议');
                return false
            };
            <?php  } ?>
            var realname = $("#realname").val();
            <?php  if(empty($_W['member']['realname'])) { ?>
            if (realname == '') {
                alert('请填写真实姓名');
                return false
            };
            <?php  } ?>
            var mobile = $("#mobile").val();
            <?php  if(empty($_W['member']['mobile'])) { ?>
            if (mobile == '') {
                alert('请填写真实手机号码');
                return false
            }
            ;
            if (!(/^1[3|5|7|4|5|8|][0-9]\d{4,8}$/.test(mobile))) {
                alert("不是完整的11位手机号或者正确的手机号前七位");
                return false;
            }
            <?php  } ?>

            var verifycode = $("#verifycode").val();
            var _code = $("#_code").val();
            if(verifycode == ''){
                $.toast('输入验证码');return false;
            }
            if(_code == ''){
                $.toast('点击获取验证码');return false;
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

            var area = $("#area").val();

            if (area == '') {
                alert('请填写正确的区');
                return false;
            }
            ;

            var build = $("#build").val();

            if (build == '') {
                alert('请填写正确的楼栋号');
                return false;
            }
            ;

            var unit = $("#unit").val();

            if (unit == '') {
                alert('请填写正确的单元');
                return false;
            }
            ;

            var room = $("#room").val();

            if (room == '') {
                alert('请填写正确的房间号');
                return false;
            }
            ;

            var regionid = "<?php  echo $_GPC['regionid'];?>";
            var memberid = "<?php  echo $memberid;?>";
            var license = $("#license").val();
            var idcard = $("#idcard").val();
            var gender = $('input[name="gender"]:checked').val();
            $.ajax({
                url: "<?php  echo $this->createMobileUrl('register',array('op' => 'add'))?>",
                dataType: 'json',
                data: {
                    realname: realname,
                    mobile: mobile,
                    build: build,
                    room: room,
                    unit: unit,
                    regionid: regionid,
                    area: area,
                    memberid:memberid,
                    code:code,
                    license:license,
                    idcard : idcard,
                    gender:gender
                },
                success: function (s) {
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
        var regionid = "<?php  echo $_GPC['regionid'];?>";
        $.post("<?php  echo $this->createMobileUrl('api',array('op' => 'verity'))?>&mobile=" + mobile + "&regionid=" + regionid,
            function (data) {
                $("#_code").val(data);
            }, 'json');
    }
</script>
</body>
</html>
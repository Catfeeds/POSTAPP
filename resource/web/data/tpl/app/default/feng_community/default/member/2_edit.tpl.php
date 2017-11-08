<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
        <h1 class="title txt-fff">用户资料</h1>

        <a class="button button-link button-nav pull-right open-popup" data-popup=".popup-about" style="color:white" id="showToast">
            确定
        </a>

    </header>
    <div class="content">
        <div class="list-block" style="margin:0">
            <ul>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-input">
                            <input type="text" name="<?php  if($r == 'm') { ?>realname<?php  } else if($r == 'b') { ?>mobile<?php  } else { ?>license<?php  } ?>" value="<?php  if($r == 'm') { ?><?php  echo $_W['member']['realname'];?><?php  } else if($r == 'b') { ?><?php  echo $_W['member']['mobile'];?><?php  } else if($r == 'c') { ?><?php  echo $address['license'];?><?php  } ?>" id="<?php  if($r == 'm') { ?>realname<?php  } else if($r == 'b') { ?>mobile<?php  } else if($r == 'c') { ?>license<?php  } ?>">
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(function() {
            $("#showToast").click(function(event) {
                var r = "<?php  echo $_GPC['r'];?>";
                if (r == 'm') {
                    var realname = $("#realname").val();
                    if (realname == '') {
                        alert('请填写真实姓名');
                        return false
                    };
                };
                var mobile = $("#mobile").val();
                if (r == 'b') {
                    if (mobile == '') {
                        alert('请填写真实手机号码');
                        return false
                    };
                    if (!(/^1[3|5|7|4|5|8|][0-9]\d{4,8}$/.test(mobile))) {
                        alert("不是完整的11位手机号或者正确的手机号前七位");
                        return false;
                    }
                };
                var license = $("#license").val();
                $.ajax({
                    url: "<?php  echo $this->createMobileUrl('member',array('op' => 'edit'))?>",
                    dataType: 'json',
                    data: {
                        realname: realname,
                        mobile: mobile,
                        license:license
                    },
                    success: function(s) {
                        if (s.status == 1) {
                            $.toast('提交成功');
                            setTimeout(function() {
                                window.location.href = "<?php  echo $this->createMobileUrl('member')?>";
                            }, 30);
                        }
                    }
                })
            });
        })
    </script>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
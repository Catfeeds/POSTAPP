<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>
        <?php  if($_W['page']['title']) { ?><?php  echo $_W['page']['title'];?><?php  } else { ?>微小区<?php  } ?>
        -
        国内领先的新一代微信物业管理系统,轻松打造小区微信运营平台
    </title>

    <meta name="keywords" content="<?php  if(empty($_W['page']['copyright']['keywords'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>微擎,微信,微信公众平台,we7.cc<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['keywords'];?><?php  } ?>">
    <meta name="description" content="<?php  if(empty($_W['page']['copyright']['description'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>公众平台自助引擎（www.we7.cc），简称微擎，微擎是一款免费开源的微信公众平台管理系统，是国内最完善移动网站及移动互联网技术解决方案。<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['description'];?><?php  } ?>">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo COMMUNITY_PATH;?>static/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo COMMUNITY_PATH;?>static/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo COMMUNITY_PATH;?>static/css/animate.css" rel="stylesheet">
    <link href="<?php echo COMMUNITY_PATH;?>static/css/style.css" rel="stylesheet">
    <link href="<?php echo COMMUNITY_PATH;?>static/js/lib/switchery/switchery.css" rel="stylesheet">
    <link href="<?php echo COMMUNITY_PATH;?>static/js/lib/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <script type="text/javascript">
        if(navigator.appName == 'Microsoft Internet Explorer'){
            if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
        window.sysinfo = {
        <?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
        <?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
        <?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
        <?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
        'siteroot': '<?php  echo $_W['siteroot'];?>',
            'siteurl': '<?php  echo $_W['siteurl'];?>',
            'attachurl': '<?php  echo $_W['attachurl'];?>',
            'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
            'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
            <?php  if(defined('MODULE_URL')) { ?>'MODULE_URL': '<?php echo MODULE_URL;?>',<?php  } ?>
        'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
        'account' : <?php  echo json_encode($_W['account'])?>
        };
    </script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/jquery.min.js?v=2.1.4"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/bootstrap.min.js?v=3.3.6"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/layer/layer.min.js"></script>

    <script src="<?php echo MODULE_URL;?>static/js/lib/hplus.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/contabs.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/switchery/switchery.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/clockpicker/clockpicker.js"></script>

    <script src="<?php echo MODULE_URL;?>static/js/lib/cropper/cropper.min.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/form-advanced-demo.js"></script>

    <script src="<?php echo MODULE_URL;?>static/js/lib/pace/pace.min.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/echarts/echarts.min.js"></script>
    <script src="<?php echo MODULE_URL;?>static/js/lib/echarts/macarons.js"></script>

    <script type="text/javascript" src="./resource/js/app/util.js?v=20161011"></script>
    <script type="text/javascript" src="./resource/js/app/common.min.js?v=20161011"></script>
    <script type="text/javascript" src="./resource/js/require.js?v=20161011"></script>
    <link href="<?php echo COMMUNITY_PATH;?>static/css/common.css" rel="stylesheet">
</head>
<body class="fixed-sidebar full-height-layout gray-bg" >
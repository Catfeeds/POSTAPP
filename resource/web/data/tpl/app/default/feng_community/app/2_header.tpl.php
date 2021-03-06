<?php defined('IN_IA') or exit('Access Denied');?><html class="pixel-ratio-1"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>小区管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/app/static/css/light7.css">
    <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/js/lib/jquery-1.11.1.min.js"></script>
    <style>
        .search-grids{position: relative;overflow: hidden;}
        .search-grids:before{content:'';position: absolute;box-sizing: border-box;width: 200%;height: 200%;left: 0;top: 0;border: 1px solid #D9D9D9;-webkit-transform-origin:0 0;transform-origin:0 0;-webkit-transform:scale(.5);transform:scale(.5);}
        .search-grid{position: relative;float: left;padding: 20px 10px;width: 33.33333333%;box-sizing: border-box}
        .search-grid:before{content: '';position: absolute;box-sizing: border-box;width: 200%;height: 200%;left: 0;top: 0;border-bottom: 1px solid #D9D9D9;border-right:1px solid #D9D9D9;-webkit-transform-origin:0 0;transform-origin:0 0;-webkit-transform:scale(.5);transform:scale(.5);}
        .search-grid:nth-child(3n):before{border-right-width:0;}
        .search-grid-icon{width: 35px;height: 35px;margin: 0 auto;}
        .search-grid-icon img{display: block;width: 100%;height: 100%}
        .search-grid-icon+.search-grid-lable{margin-top: 5px;}
        .search-grid-lable{display: block;text-align: center;color: #000000;font-size: 14px;}
        .bar-tab .tab-item.active, .bar-tab .tab-item:active{color:#0894ec}
        .label-success{
            background-color: red;
            color: white;
            width:60px;
            display: block;
            border-radius:2px;
            text-align: center;
        }
        .label-default {
            background-color: #0894ec;
            color: white;
            width:60px;
            display: block;
            border-radius:2px;
            text-align: center;
        }
        .label-info{
            background-color: #f60;
            color: white;
            width:60px;
            display: block;
            border-radius:2px;
            text-align: center;
        }
        .label-warning{
            background-color: #f0ad4e;
            color: white;
            width:60px;
            display: block;
            border-radius:2px;
            text-align: center;
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            border-radius: 4px;
        }
        .pagination>li {
            display: inline;
        }
        li {
            list-style: none;
            padding-left: 0;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        a, a:hover, a:focus {
            cursor: pointer;
        }
        .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
    </style>
</head>
<body>
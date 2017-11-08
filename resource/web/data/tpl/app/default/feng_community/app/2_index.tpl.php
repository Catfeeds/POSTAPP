<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <!-- 标题栏 -->
    <header class="bar bar-nav">
        <!--<a class="icon icon-me pull-left open-panel"></a>-->
        <h1 class="title">管理系统</h1>
    </header>
    <!-- 工具栏 -->


    <!-- 这里是页面内容区 -->
    <div class="content">
        <?php  if($menus) { ?>
        <div class="search-grids" style="margin-bottom: 30px">

            <?php  if(is_array($menus)) { foreach($menus as $item) { ?>
            <a href="<?php  echo $this->createMobileUrl('xqsys',array('op' => 'list','type' => $item))?>" class="search-grid">
                <div class="search-grid-icon">
                    <img src="<?php  echo $data[$item]['icon'];?>">
                </div>
                <p class="search-grid-lable"><?php  echo $data[$item][$item];?></p>
            </a>
            <?php  } } ?>

            <?php  if(empty($_SESSION['sysopenid'])) { ?>
            <a href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'logout'))?>'" class="search-grid">
                <div class="search-grid-icon">
                    <img src="<?php  echo $_W['siteroot'];?>addons/feng_community/template/mobile/app/static/img/tc.png">
                </div>
                <p class="search-grid-lable">退出系统</p>
            </a>
            <?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>
<script>
    function show(id) {
        $.post("<?php  echo $this->createMobileUrl('xqsys',array('op' => 'list'))?>",{id:id},function (data) {
                if(data){
                    $("#content").html(data.content);
                    $("#xqtitle").html(data.xqtitle);
                }
        },'json');
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
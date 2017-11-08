<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" class="img-circle" src="<?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" style="width: 58px;
    height: 58px;"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php  echo $_W['username'];?></strong></span>
                                <span class="text-muted text-xs block" >
                                    <?php  if($_W['role'] == 'founder') { ?>超级管理员<?php  } else if($_W['role'] == 'manager') { ?>管理员 <?php  } else { ?>操作员 <?php  } ?>
                                    <b class="caret"></b>
                                </span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="J_menuItem" href="<?php  echo $this->createWebUrl('cash',array('op'=> 'cash'))?>">我要提现</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php  echo url('user/logout');?>">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <img alt="image" class="img-circle" src="<?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" style="width: 38px;
    height: 38px;"/>
                    </div>
                </li>
                <?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; _calc_current_frames($frames);?>
                <?php  if(!empty($frames)) { ?>
                <?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>
                <li>
                    <a href="#">
                        <i class="<?php  echo $frame['icon'];?>"></i>
                        <span class="nav-label"><?php  echo $frame['title'];?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?>

                        <li>
                            <a class="J_menuItem" <?php  if(empty($link['m'])) { ?>href="<?php  echo $link['url'];?>"<?php  } ?> >
                                <?php  if($link['m']) { ?><span class="fa arrow"></span><?php  } ?>
                                <?php  echo $link['title'];?>
                            </a>
                            <?php  if($link['m']) { ?>
                            <ul class="nav nav-third-level">
                                <?php  if(is_array($link['m'])) { foreach($link['m'] as $m) { ?>
                                <li><a class="J_menuItem" href="<?php  echo $m['url'];?>"><?php  echo $m['title'];?></a>
                                </li>
                                <?php  } } ?>
                            </ul>
                            <?php  } ?>
                        </li>

                        <?php  } } ?>
                    </ul>

                </li>
                <?php  } } ?>
                <?php  } ?>


            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="">
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="<?php  echo $this->createWebUrl('home')?>">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="<?php  echo url('user/logout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php  echo $this->createWebUrl('home')?>" frameborder="0" data-id="<?php  echo $this->createWebUrl('home')?>" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right"><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.we7.cc"><b>南京智慧社区</b></a> v<?php echo IMS_VERSION;?> &copy; 2014-2015 <a href="http://www.njzhsq.com"></a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?>
            </div>
        </div>
    </div>

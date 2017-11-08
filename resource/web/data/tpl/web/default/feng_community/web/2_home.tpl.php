<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<style>
    .dash-head ~ .row .card {
        margin-bottom: 0px;
        overflow: hidden;
    }

    .dash-fws, .dash-data {
        padding: 20px;
        border-radius: 4px;
    }

    .card {
        position: relative;
        background: #fff;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
        margin-bottom: 30px;
    }

    .dash-item-title {
        font-size: 14px;
        font-weight: 700;
        color: #8f9297;
        line-height: 1.1;
    }

    .dash-data-list {
        margin-top: 20px;
        list-style: none;
        padding: 0;
        overflow: hidden;
    }

    .dash-data-list > li {
        float: left;
        width: 20%;
        padding: 5px 5px 0 0;
    }

    .dash-data-list > li .data-item {
        display: block;
        height: 93px;
        padding: 20px;
        font-size: 14px;
        background: #F8F8F8;
        overflow: hidden;
    }

    .dash-data-list > li:nth-of-type(5n+1) .data-icon {
        background: #11cd6e;
    }

    .dash-data-list > li:nth-of-type(5n+2) .data-icon {
        background: #009afe;
    }

    .dash-data-list > li:nth-of-type(5n+3) .data-icon {
        background: #ff5d5d;
    }

    .dash-data-list > li:nth-of-type(5n+4) .data-icon {
        background: #ff6600;
    }

    .dash-data-list > li:nth-of-type(5n+5) .data-icon {
        background: #feb822;
    }

    .dash-data-list > li .data-icon {
        float: left;
        width: 50px;
        height: 50px;
        color: #fff;
        border-radius: 4px;
        text-align: center;
        line-height: 50px;
    }

    .dash-data-list > li .data-icon i.fa {
        font-size: 30px;
        margin-top: 8px;
    }

    .dash-data-list > li .data-inner p.data-title {
        margin-bottom: 0;
    }

    .dash-data-list > li .data-inner {
        padding-left: 70px;
    }

    .dash-data-list > li p {
        color: #74777c;

    }

    .dash-data-list > li p b {
        font-size: 20px;
        color: #2ecc71;
        font-weight: 400;
    }

    .m-r-10 {
        margin-right: 10px !important;
    }
</style>

<div class="wrapper wrapper-content">
    <div class="row white-bg dashboard-header" style="margin: 0px 0px 15px 0px;">
        <div class="col-sm-12">
            <blockquote class="text-warning" style="font-size:14px">
                <h4 class="text-danger">欢迎使用智慧小区物业管理系统</h4>
                <br>物业公司：<?php  echo $count_property;?>个 , 小区数量：<?php  echo $count_region;?>个
                <!--<br>…………-->
                <!--<h4 class="text-danger">那么，现在H+来了</h4>-->
            </blockquote>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">今天</span>
                    <h5>访客</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  if($count_log) { ?><?php  echo $count_log;?><?php  } else { ?>0<?php  } ?>名</h1>
                    <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i>-->
                    <!--</div>-->
                    <!--<small>新访客</small>-->
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">今天</span>
                    <h5>新注册</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  echo $count_user;?>名</h1>
                    <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i>-->
                    <!--</div>-->
                    <!--<small>新业主</small>-->
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">今天</span>
                    <h5>已缴订单</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  if($count_cost) { ?><?php  echo $count_cost;?><?php  } else { ?>0<?php  } ?>单</h1>
                    <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i>-->
                    <!--</div>-->
                    <!--<small>当日</small>-->
                </div>
            </div>
        </div>
        <!--<div class="col-sm-3">-->
        <!--<div class="ibox float-e-margins">-->
        <!--<div class="ibox-title">-->
        <!--<span class="label label-success pull-right">月</span>-->
        <!--<h5>收入</h5>-->
        <!--</div>-->
        <!--<div class="ibox-content">-->
        <!--<h1 class="no-margins">40 886,200</h1>-->
        <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i>-->
        <!--</div>-->
        <!--<small>总收入</small>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="col-sm-3">-->
        <!--<div class="ibox float-e-margins">-->
        <!--<div class="ibox-title">-->
        <!--<span class="label label-info pull-right">全年</span>-->
        <!--<h5>订单</h5>-->
        <!--</div>-->
        <!--<div class="ibox-content">-->
        <!--<h1 class="no-margins">275,800</h1>-->
        <!--<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i>-->
        <!--</div>-->
        <!--<small>新订单</small>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->

        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">今天</span>
                    <h5>开门</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php  if($count_open) { ?><?php  echo $count_open;?><?php  } else { ?>0<?php  } ?>次</h1>
                    <!--<div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>-->
                    <!--</div>-->
                    <!--<small>12月</small>-->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card dash-data">
                <div class="dash-item-title">
                    所有服务

                </div>
                <ul class="dash-data-list">
                    <li><a href="<?php  echo $this->createWebUrl('room')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-building"></i></div>
                        <div class="data-inner">
                            <p class="data-title">
                                楼宇
                            </p>
                            <p><b class="m-r-10"><?php  if($count_build) { ?><?php  echo $count_build;?><?php  } else { ?>0<?php  } ?></b><span>栋</span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('room')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-home"></i></div>
                        <div class="data-inner"><p class="data-title">
                            房屋
                        </p>
                            <p><b class="m-r-10"><?php  if($count_room) { ?><?php  echo $count_room;?><?php  } else { ?>0<?php  } ?></b><span>个</span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('member')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-user"></i></div>
                        <div class="data-inner"><p class="data-title">
                            住户
                        </p>
                            <p><b class="m-r-10"><?php  if($count_member) { ?><?php  echo $count_member;?><?php  } else { ?>0<?php  } ?></b><span>个</span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('park')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-send"></i></div>
                        <div class="data-inner"><p class="data-title">
                            车位
                        </p>
                            <p><b class="m-r-10"><?php  if($count_park) { ?><?php  echo $count_park;?><?php  } else { ?>0<?php  } ?></b><span>个</span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('parkcar')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-car"></i></div>
                        <div class="data-inner"><p class="data-title">
                            车辆
                        </p>
                            <p><b class="m-r-10"><?php  if($count_car) { ?><?php  echo $count_car;?><?php  } else { ?>0<?php  } ?></b><span>辆</span></p></div>
                    </a></li>
                    <li>
                        <div class="data-item">
                            <div class="data-icon"><i class="fa fa-list"></i></div>
                            <div class="data-inner"><p class="data-title">
                                账单
                            </p>
                                <p class="m-t-10"><a href="<?php  echo $this->createWebUrl('cost')?>" class="a-link">
                                    已缴(<?php  if($count_cost_y) { ?><?php  echo $count_cost_y;?><?php  } else { ?>0<?php  } ?>)
                                </a><a href="/cost/unpay_house.html" class="a-link m-l-10">
                                    未缴(<?php  if($count_cost_w) { ?><?php  echo $count_cost_w;?><?php  } else { ?>0<?php  } ?>)
                                </a></p></div>
                        </div>
                    </li>
                    <li><a href="<?php  echo $this->createWebUrl('repair')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-wrench"></i></div>
                        <div class="data-inner"><p class="data-title">
                            报修
                        </p>
                            <p><span><b class="m-r-10"><?php  if($count_repair_total) { ?><?php  echo $count_repair_total;?><?php  } else { ?>0<?php  } ?></b><span>条</span></span><span class="a-link"
                                                                                       style="color:#2196f3;">
                                                        未处理(<?php  if($count_repair_w) { ?><?php  echo $count_repair_w;?><?php  } else { ?>0<?php  } ?>)
                                                    </span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('announcement')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-bullhorn"></i></div>
                        <div class="data-inner"><p class="data-title">
                            公告
                        </p>
                            <p><b class="m-r-10"><?php  if($count_notice) { ?><?php  echo $count_notice;?><?php  } else { ?>0<?php  } ?></b><span>条</span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('homemaking')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-calendar-check-o"></i></div>
                        <div class="data-inner"><p class="data-title">
                            服务预定
                        </p>
                            <p><b class="m-r-10"><?php  if($count_home) { ?><?php  echo $count_home;?><?php  } else { ?>0<?php  } ?></b><span>条</span></p></div>
                    </a></li>
                    <li>
                        <div href="<?php  echo $this->createWebUrl('business')?>" class="data-item" style="cursor: pointer">
                            <div class="data-icon"
                                 onclick="javascript:window.location.href = '<?php  echo $this->createWebUrl('business')?>'"><i
                                    class="fa fa-shopping-cart"></i></div>
                            <div class="data-inner"><p class="data-title"
                                                       onclick="javascript:window.location.href = '<?php  echo $this->createWebUrl('business')?>'">
                                小区商家
                            </p>
                                <p><b class="m-r-10"><?php  if($count_business) { ?><?php  echo $count_business;?><?php  } else { ?>0<?php  } ?></b><span>条</span></p>
                                </div>
                        </div>
                    </li>
                    <li><a href="<?php  echo $this->createWebUrl('guard')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-lock"></i></div>
                        <div class="data-inner"><p class="data-title">
                            门禁
                        </p>
                            <p><b class="m-r-10"><?php  if($count_guard) { ?><?php  echo $count_guard;?><?php  } else { ?>0<?php  } ?></b><span>个</span></p></div>
                    </a></li>
                    <li>
                        <div class="data-item">
                            <div class="data-icon"><i class="fa fa-cube"></i></div>
                            <div class="data-inner"><p class="data-title">
                                二手
                            </p>
                                <p><b class="m-r-10"><?php  if($count_fled) { ?><?php  echo $count_fled;?><?php  } else { ?>0<?php  } ?></b><span>条</span></p>
                            </div>
                        </div>
                    </li>
                    <li><a href="<?php  echo $this->createWebUrl('houselease')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-institution"></i></div>
                        <div class="data-inner"><p class="data-title">
                            房屋租赁
                        </p>
                            <p><b class="m-r-10"><?php  if($count_houselease) { ?><?php  echo $count_houselease;?><?php  } else { ?>0<?php  } ?></b><span>条</span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('adv')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-newspaper-o"></i></div>
                        <div class="data-inner"><p class="data-title">
                            广告
                        </p>
                            <p><b class="m-r-10"><?php  if($count_adv) { ?><?php  echo $count_adv;?><?php  } else { ?>0<?php  } ?></b><span>条</span></p></div>
                    </a></li>
                    <li><a href="<?php  echo $this->createWebUrl('activity')?>" class="data-item">
                        <div class="data-icon"><i class="fa fa-gift"></i></div>
                        <div class="data-inner"><p class="data-title">
                            小区活动
                        </p>
                            <p><b class="m-r-10"><?php  if($count_activity) { ?><?php  echo $count_activity;?><?php  } else { ?>0<?php  } ?></b><span>条</span></p></div>
                    </a></li>
                </ul>
            </div>
        </div>
    </div>

</div>
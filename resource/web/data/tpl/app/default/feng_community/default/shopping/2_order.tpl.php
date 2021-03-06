<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('member')?>'"></a>
        <h1 class="title txt-fff">我的订单</h1>
    </header>
    <div class="content">
        <div class="buttons-tab">
            <a href="#tab1" class="tab-link button <?php  if(empty($status)) { ?>active <?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('shopping',array('op'=>'myorder','status'=>0))?>'">待支付</a>
            <a href="#tab2" class="tab-link button <?php  if($status==1 || $status==2) { ?>active  <?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('shopping',array('op' => 'myorder','status'=>2))?>'">待收货</a>
            <a href="#tab3" class="tab-link button <?php  if($status==3) { ?>active <?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('shopping',array('op' =>'myorder','status'=>3))?>'">已完成</a>
        </div>
        <div class="tabs">
            <div id="tab1" class="tab active" >
                <div id="data-list-1">
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <div class="list-block shopcart-list-block media-list shopping-list-block">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title shopping-dingdan">订单编号：<?php  echo $item['ordersn'];?></div>
                                </div>
                            </li>
                        </ul>
                        <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
                        <ul class="shopcart-list-info">
                            <li>
                                <a href="#" class="item-content">
                                    <div class="item-media">
                                        <img src="<?php  echo tomedia($goods['thumb']);?>" style='width: 3rem;height: 4rem;'>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title-row">
                                            <div class="item-title"><?php  echo $goods['title'];?></div>
                                        </div>
                                        <div class="item-title-row">
                                            <div class="item-title"></div>
                                            <div class="item-after" style="color: #000000;font-size: 0.7rem">¥<?php  echo $goods['marketprice'];?></div>
                                        </div>
                                        <div class="item-title-row">
                                            <div class="item-title"></div>
                                            <div class="item-after">x<?php  echo $goods['total'];?></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <?php  } } ?>
                        <ul>
                            <li class="shopping-hj">
                                <span class="shopping-hj-item1">共<?php  echo $item['count'];?>件商品</span>
                                <span class="shopping-hj-item2">合计:&nbsp;&nbsp;<span class="color-danger">￥<?php  echo $item['price'];?></span>
                    <span class="shopping-hj-item3">(含运费￥ 0.00 )</span>
                            </li>
                        </ul>
                        <ul>
                            <li class="shopping-btn">
                                <div class="row">
                                    <!--<div class="col-33">-->
                                    <!--<a class="button button-success">取消订单</a>-->
                                    <!--</div>-->
                                    <div class="col-33">
                                        <?php  if($item['paytype'] != 3 && $item['status'] == 0 ) { ?>
                                        <a class="button button-danger" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping', array('op' => 'pay','orderid'=> $item['id']))?>'">立即支付</a>
                                        <?php  } else { ?>
                                        <?php  if($item['status'] == 3) { ?>
                                        <a class="button" >已完成</a>
                                        <?php  } ?>
                                        <?php  if($item['status'] == 2) { ?>
                                        <a class="button button-warning" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping', array('operation' => 'confirm','op' => 'myorder','orderid'=> $item['id'] ))?>'">确认收货</a>
                                        <?php  } ?>
                                        <?php  if($item['status'] == 1) { ?>
                                        <a class="button button-dark" >等待发货</a>
                                        <?php  } ?>
                                        <?php  } ?>
                                    </div>
                                    <!--<div class="col-33">-->
                                    <!--更多-->
                                    <!--</div>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php  } } ?>
                </div>
            </div>
            <div id="tab2" class="tab">
                <div id="data-list-2">
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <div class="list-block shopcart-list-block media-list shopping-list-block">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title shopping-dingdan">订单编号：<?php  echo $item['ordersn'];?></div>
                                </div>
                            </li>
                        </ul>
                        <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
                        <ul class="shopcart-list-info">
                            <li>
                                <a href="#" class="item-content">
                                    <div class="item-media">
                                        <img src="<?php  echo tomedia($goods['thumb']);?>" style='width: 3rem;height: 4rem;'>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title-row">
                                            <div class="item-title"><?php  echo $goods['title'];?></div>
                                        </div>
                                        <div class="item-title-row">
                                            <div class="item-title"></div>
                                            <div class="item-after" style="color: #000000;font-size: 0.7rem">¥<?php  echo $goods['marketprice'];?></div>
                                        </div>
                                        <div class="item-title-row">
                                            <div class="item-title"></div>
                                            <div class="item-after">x1</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <?php  } } ?>
                        <ul>
                            <li class="shopping-hj">
                                <span class="shopping-hj-item1">共<?php  echo $item['count'];?>件商品</span>
                                <span class="shopping-hj-item2">合计:&nbsp;&nbsp;<span class="color-danger">￥<?php  echo $item['price'];?></span>
                    <span class="shopping-hj-item3">(含运费￥ 0.00 )</span>
                            </li>
                        </ul>
                        <ul>
                            <li class="shopping-btn">
                                <div class="row">
                                    <!--<div class="col-33">-->
                                    <!--<a class="button button-success">取消订单</a>-->
                                    <!--</div>-->
                                    <div class="col-33">
                                        <?php  if($item['paytype'] != 3 && $item['status'] == 0 ) { ?>
                                        <a class="button button-danger" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping', array('op' => 'pay'))?>&orderid={{ d.list[i].id }}'">立即支付</a>
                                        <?php  } else { ?>
                                        <?php  if($item['status'] == 3) { ?>
                                        <a class="button" >已完成</a>
                                        <?php  } ?>
                                        <?php  if($item['status'] == 2) { ?>
                                        <a class="button button-warning" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping', array('operation' => 'confirm','op' => 'myorder'))?>&orderid={{ d.list[i].id }}'">确认收货</a>
                                        <?php  } ?>
                                        <?php  if($item['status'] == 1) { ?>
                                        <a class="button button-dark" >等待发货</a>
                                        <?php  } ?>
                                        <?php  } ?>
                                    </div>
                                    <!--<div class="col-33">-->
                                    <!--更多-->
                                    <!--</div>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php  } } ?>
                </div>
            </div>
            <div id="tab3" class="tab">
                <div id="data-list-3">
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <div class="list-block shopcart-list-block media-list shopping-list-block">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title shopping-dingdan">订单编号：<?php  echo $item['ordersn'];?></div>
                                </div>
                            </li>
                        </ul>
                        <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
                        <ul class="shopcart-list-info">
                            <li>
                                <a href="#" class="item-content">
                                    <div class="item-media">
                                        <img src="<?php  echo tomedia($goods['thumb']);?>" style='width: 3rem;height: 4rem;'>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-title-row">
                                            <div class="item-title"><?php  echo $goods['title'];?></div>
                                        </div>
                                        <div class="item-title-row">
                                            <div class="item-title"></div>
                                            <div class="item-after" style="color: #000000;font-size: 0.7rem">¥<?php  echo $goods['marketprice'];?></div>
                                        </div>
                                        <div class="item-title-row">
                                            <div class="item-title"></div>
                                            <div class="item-after">x1</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <?php  } } ?>
                        <ul>
                            <li class="shopping-hj">
                                <span class="shopping-hj-item1">共<?php  echo $item['count'];?>件商品</span>
                                <span class="shopping-hj-item2">合计:&nbsp;&nbsp;<span class="color-danger">￥<?php  echo $item['price'];?></span>
                    <span class="shopping-hj-item3">(含运费￥ 0.00 )</span>
                            </li>
                        </ul>
                        <ul>
                            <li class="shopping-btn">
                                <div class="row">
                                    <!--<div class="col-33">-->
                                    <!--<a class="button button-success">取消订单</a>-->
                                    <!--</div>-->
                                    <div class="col-33">
                                        <?php  if($item['paytype'] != 3 && $item['status'] == 0 ) { ?>
                                        <a class="button button-danger" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping', array('op' => 'pay'))?>&orderid={{ d.list[i].id }}'">立即支付</a>
                                        <?php  } else { ?>
                                        <?php  if($item['status'] == 3) { ?>
                                        <a class="button" >已完成</a>
                                        <?php  } ?>
                                        <?php  if($item['status'] == 2) { ?>
                                        <a class="button button-warning" onclick="window.location.href='<?php  echo $this->createMobileUrl('shopping', array('operation' => 'confirm','op' => 'myorder'))?>&orderid={{ d.list[i].id }}'">确认收货</a>
                                        <?php  } ?>
                                        <?php  if($item['status'] == 1) { ?>
                                        <a class="button button-dark" >等待发货</a>
                                        <?php  } ?>
                                        <?php  } ?>
                                    </div>
                                    <!--<div class="col-33">-->
                                    <!--更多-->
                                    <!--</div>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php  } } ?>
                </div>
            </div>
        </div>
    </div>
    <script>$.config = {autoInit: true}</script>
    <script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="UTF-8"></script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
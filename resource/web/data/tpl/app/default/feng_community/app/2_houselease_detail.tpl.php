<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">租赁订单</h1>
    </header>
    <div class="content">
        <div class="list-block" style="margin: 0">
            <ul>
                <!-- Text inputs -->
                <li>
                    <div class="item-content">
                        <div class="item-media">标题：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['title'];?>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">姓名：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['realname'];?>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">电话：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['mobile'];?>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Date -->
                <li>
                    <div class="item-content">
                        <div class="item-media">面积:</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['model_area'];?>m<sup>2</sup>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Switch (Checkbox) -->
                <li>
                    <div class="item-content">
                        <div class="item-media">楼层：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['floor_layer'];?>/<?php  echo $item['floor_number'];?>层
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">租金：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['price'];?>元
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">户型：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['model_room'];?>室<?php  echo $item['model_hall'];?>厅<?php  echo $item['model_toilet'];?>卫
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">装修：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['fitment'];?>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">类型：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['house'];?>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">押金：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  echo $item['price_way'];?>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">状态：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <?php  if($item['status'] ==1 ) { ?><span class="label label-success">已成交</span><?php  } ?><?php  if($item['status'] == 0 ) { ?><span class="label label-info">未成交</span><?php  } ?><?php  if($item['status'] == 2 ) { ?><span class="label label-danger">已取消</span><?php  } ?>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f5">

<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('activity')?>'"></a>
        <h1 class="title txt-fff">活动详情</h1>
    </header>
    <div class="content">
        <div class="card demo-card-header-pic">
            <div valign="bottom" class="card-header color-white no-border ">
                <div class="activity-detail-img">
                    <img src="<?php  echo $picurl;?>" alt="">
                </div>
            </div>
            <div class="card-content activity-detail-card">
                <div class="card-content-inner">
                    <div class="list-block">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title"><?php  echo $detail['title'];?></div>
                                    <div class="item-after">
                                        <?php  if(TIMESTAMP < $enddate) { ?>
                                        <a class="button button-success button-fill">火热报名中...</a>
                                        <?php  } else { ?>
                                        <a class="button button-warning button-fill">报名已结束...</a>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="list-group">
                            <ul>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title"><span>活动开始时间:</span><?php  echo $starttime;?></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title"><span>活动结束时间:</span><?php  echo $endtime;?></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title color-success"><span>预约人数:</span><?php  echo $total;?></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="item-content">
                                        <div class="item-inner">
                                            <div class="item-title color-success"><span>定金:</span><?php  echo $detail['price'];?>元</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                </div>

            </div>
            <!--<div class="card-footer">-->
                <!--<a href="#" class="link">赞</a>-->
                <!--<a href="#" class="link">更多</a>-->
            <!--</div>-->
        </div>
    </div>
        <div class="card">
            <div class="card-header"><div><span class="icon icon-app"></span>活动描述</div></div>
            <div class="card-content">
                <div class="card-content-inner">
                    <?php  echo $detail['content'];?>
                </div>
            </div>
        </div>
        <?php  if(TIMESTAMP < $enddate && empty($order['status'])) { ?>
        <div class="card" id="enroll">
            <div class="card-header">我要报名</div>
            <div class="card-content">
                <div class="card-content-inner">
                    <div class="list-block">
                        <ul>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label width50">姓名:</div>
                                        <div class="item-input">
                                            <input class="weui_input" type="text" value="<?php  echo $_W['member']['realname'];?>" id="truename" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label width50">电话:</div>
                                        <div class="item-input">
                                            <input class="weui_input" type="text" value="<?php  echo $_W['member']['mobile'];?>" id="mobile" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content item-link">
                                    <div class="item-inner">
                                        <div class="item-title label">人数:</div>
                                        <div class="item-input">
                                            <select class="weui_select" name="num" id="num">
                                                <?php 
                                                    for ($i=1; $i <=$detail['number'] ; $i++) {
                                                       echo "<option value='$i'>$i</option>";
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        </div>
                </div>
            </div>
            <div class="card-footer">
              <a href="#" class="button button-fill button-success" id="showToast">提交</a>
            </div>
        </div>
        <?php  } ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<script type="text/javascript">
    $(function() {
        $("#showToast").click(function(event) {
            var num = $("#num").val();
            var aid = "<?php  echo $detail['id'];?>";
            $.ajax({
                url: "<?php  echo $this->createMobileUrl('activity',array('op' => 'res'))?>",
                dataType: 'json',
                data: {
                    num: num,
                    aid : aid
                },
                success: function(s) {
                    if (s.status == 1) {
                        $.toast("预约成功");
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    };
                    if (s.status == 2) {
                        window.location.href="<?php  echo $this->createMobileUrl('activity',array('op' => 'pay'))?>&orderid="+s.orderid;
                    };
                }
            })


        });
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
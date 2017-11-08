<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基础设置</h5>
                </div>
                <div class="ibox-content">
                <form action="" method="post" role="form">


                        <table class="footable table table-stripped toggle-arrow-tiny footable-loaded phone breakpoint">
                                <thead>
                                <tr>
                                    <th class="col-sm-2">小区设置</th>
                                    <th class="col-sm-3">说明</td>
                                    <th class="col-sm-4"></th>
                                    <th class="col-sm-3">是否启用</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="title">平台电话</td>
                                    <td>用于移动端管理系统和业主端底部电话显示</td>
                                    <td>
                                        <input type="text" name="set[p1]" id='' class="form-control" value="<?php  echo $set['p1']['value'];?>"/>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">商家提成</td>
                                    <td>
                                        开启商家提成后，粉丝购买商家商品，平台将获取对应的提成。
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <input type="checkbox" class="js-switch_1" id="p2" <?php  if($set['p2']['value']) { ?>checked<?php  } ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">超市提成</td>
                                    <td>
                                        开启超市提成后，粉丝购买超市商品，平台将获取对应的提成。
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <input type="checkbox" name="" id="p3" class="js-switch_2" <?php  if($set['p3']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>

                                <tr>
                                    <td class="title">小区提成</td>
                                    <td>
                                        开启小区提成后，粉丝购买超市商品，小区将获取对应的提成。
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <input type="checkbox" name="" id="p54" class="js-switch_3" <?php  if($set['p54']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">二手全部小区显示</td>
                                    <td>
                                        开启后，二手信息会在所有小区显示
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p4" class="js-switch_4" <?php  if($set['p4']['value']) { ?>checked<?php  } ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">租赁全部小区显示</td>
                                    <td>
                                        开启后，租赁信息会在所有小区显示
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p5" class="js-switch_5" <?php  if($set['p5']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">拼车全部小区显示</td>
                                    <td>
                                        开启后，拼车信息会在所有小区显示
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p6" class="js-switch_6" <?php  if($set['p6']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">切换小区是否审核</td>
                                    <td>
                                        开启后，粉丝切换小区需要审核后，才能使用
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p7" class="js-switch_7" <?php  if($set['p7']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">业主余额充值</td>
                                    <td>
                                        开启后，业主端有充值入口
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p44" class="js-switch_8" <?php  if($set['p44']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">商家独立支付</td>
                                    <td>
                                        开启后，启用独立支付，直接支付到商家账户，平台和小区将没有提成
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p45" class="js-switch_9" <?php  if($set['p45']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">超市独立支付</td>
                                    <td>
                                        开启后，启用独立支付，直接支付到超市账户，平台和小区将没有提成
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p46" class="js-switch_10" <?php  if($set['p46']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">业主卡开启</td>
                                    <td>
                                        开启后，需要先到平台设置对应的会员卡，业主卡使用的是会员卡
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p50" class="js-switch_11" <?php  if($set['p50']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">小区定位</td>
                                    <td>
                                        开启后，小区通过通过定位显示，默认不开定位
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="tel" name="set[p9]" value="<?php  echo $set['p9']['value'];?>" class="form-control"
                                                   placeholder="输入定位范围"/>
                                            <span class="input-group-addon">千米（KM）</span>
                                        </div>
                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p8" class="js-switch_12" <?php  if($set['p8']['value']) { ?>checked<?php  } ?> />

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">商家定位</td>
                                    <td>
                                        开启后，商家通过通过定位显示，默认不开定位
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="tel" name="set[p11]" value="<?php  echo $set['p11']['value'];?>" class="form-control"
                                                   placeholder="输入定位范围"/>
                                            <span class="input-group-addon">千米（KM）</span>
                                        </div>
                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p10" class="js-switch_13" <?php  if($set['p10']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">开门定位</td>
                                    <td>
                                        开启后，业主通过通过定位显示附近能开的门，默认不开定位
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="tel" name="set[p87]" value="<?php  echo $set['p87']['value'];?>" class="form-control"
                                                   placeholder="输入定位范围"/>
                                            <span class="input-group-addon">千米（KM）</span>
                                        </div>
                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p86" class="js-switch_14" <?php  if($set['p86']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">超市积分比例</td>
                                    <td>
                                        开启后，业主购买商品后，会返还对应的积分
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" name="set[p13]" class="form-control" value="<?php  echo $set['p13']['value'];?>"/>
                                            <span class="input-group-addon">积分/元</span>
                                        </div>
                                    </td>
                                    <td>

                                        <input type="checkbox" name="" id="p12" class="js-switch_15" <?php  if($set['p12']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">商家积分比例</td>
                                    <td>
                                        开启后，业主购买商品后，会返还对应的积分
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" name="set[p15]" class="form-control" value="<?php  echo $set['p15']['value'];?>"/>
                                            <span class="input-group-addon">积分/元</span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="" id="p14" class="js-switch_16" <?php  if($set['p14']['value']) { ?>checked<?php  } ?>/>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">积分抵扣物业费比例</td>
                                    <td>
                                        开启后，业主可通过积分抵扣部分物业费
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" name="set[p17]" class="form-control" value="<?php  echo $set['p17']['value'];?>"/>
                                            <span class="input-group-addon">元/积分</span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="" id="p16" class="js-switch_17" <?php  if($set['p16']['value']) { ?>checked<?php  } ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">超市配送费</td>
                                    <td>
                                        开启后，购买超市商品设有配送费，可设置满多少元减配送费
                                    </td>
                                    <td>
                                        <div class="input-group" style="width: 50%;float: left">
                                            <input type="text" name="set[p79]" class="form-control" value="<?php  echo $set['p79']['value'];?>" placeholder="包邮金额"/>
                                            <span class="input-group-addon">元</span>
                                        </div>
                                        <div class="input-group" style="width: 50%;float: left">
                                            <input type="text" name="set[p78]" class="form-control" value="<?php  echo $set['p78']['value'];?>" placeholder="配送费"/>
                                            <span class="input-group-addon">配送费</span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="" id="p77" class="js-switch_18" <?php  if($set['p77']['value']) { ?>checked<?php  } ?>/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title">超市送货时间</td>
                                    <td>请用|分割填写的时间</td>
                                    <td>
                                        <input type="text" name="set[p85]" class="form-control" value="<?php  echo $set['p85']['value'];?>" placeholder="例如：9:00~10:00|11:00~12:00|14:00~15:00"/>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="" id="p88" class="js-switch_19" <?php  if($set['p88']['value']) { ?>checked<?php  } ?>/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                    <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-w-m btn-primary" name="submit" value="提交">提交</button>
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                            </div>
                        </div>




        </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(function () {
    $(':checkbox').on('change', function (e, state) {
        $this = $(this);
        var xqkey = $this.attr('id');
        var status = this.checked ? 1 : 0;
        $this.val(status);
        var regionid = '<?php  echo $regionid;?>';
        $.post("<?php  echo $this->createWebUrl('updatekey')?>",{xqkey:xqkey,status:status,regionid:regionid},function () {

        })
    });
    $('.btn').hover(function () {
        $(this).tooltip('show');
    }, function () {
        $(this).tooltip('hide');
    });
});

</script>


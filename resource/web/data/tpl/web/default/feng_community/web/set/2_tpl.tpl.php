<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>公众平台模板消息所在行业选择为： IT科技/互联网|电子商务，房地产/物业</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">

            <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <td class="col-md-2">消息提醒设置</td>
                    <td class="col-md-3">公众平台模板库编号</td>
                    <td class="col-md-4">模板消息</td>
                    <td class="col-md-3">是否启用</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">物业管理通知</td>
                    <td>OPENTM204594069</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t2]" value="<?php  echo $set['t2']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t1" class="js-switch_1" <?php  if($set['t1']['value']) { ?>checked='checked'<?php  } ?> />
                    </td>
                </tr>
                <tr>
                    <td class="title">新报修通知</td>
                    <td>OPENTM202109939</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t4]" value="<?php  echo $set['t4']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t3" class="js-switch_2" <?php  if($set['t3']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">报修完成通知</td>
                    <td>OPENTM400221028</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t8]" value="<?php  echo $set['t8']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t7" class="js-switch_3" <?php  if($set['t7']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">新投诉通知</td>
                    <td>OPENTM202374445</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t6]" value="<?php  echo $set['t6']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t5" class="js-switch_4" <?php  if($set['t5']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">意见处理通知</td>
                    <td>OPENTM403082610</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t10]" value="<?php  echo $set['t10']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t9" class="js-switch_5" <?php  if($set['t9']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>

                <tr>
                    <td class="title">物业费缴费提醒</td>
                    <td>TM00131</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t12]" value="<?php  echo $set['t12']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t11" class="js-switch_6" <?php  if($set['t11']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">新订单通知</td>
                    <td>OPENTM275292323</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t14]" value="<?php  echo $set['t14']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t13" class="js-switch_7" <?php  if($set['t13']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">商品发货通知</td>
                    <td>OPENTM405539727</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t16]" value="<?php  echo $set['t16']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t15" class="js-switch_8" <?php  if($set['t15']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">客户预约通知</td>
                    <td>OPENTM206305152</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t18]" value="<?php  echo $set['t18']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t17" class="js-switch_9" <?php  if($set['t17']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">审核结果通知</td>
                    <td>OPENTM201136105</td>
                    <td>
                        <input type="text" class="form-control" name="tpl[t20]" value="<?php  echo $set['t20']['value'];?>"/>
                    </td>
                    <td>
                        <input type="checkbox" id="t19" class="js-switch_10" <?php  if($set['t19']['value']) { ?>checked='checked'<?php  } ?>/>
                    </td>
                </tr>
                </tbody>
            </table>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-7">
            <button type="submit" class="btn btn-w-m btn-primary" name="submit" value="提交">提交</button>
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
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

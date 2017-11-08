<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>

<style>
    .title{
        color:red
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><a class="glyphicon glyphicon-arrow-left" href="<?php  echo $this->createWebUrl('region')?>"></a>&nbsp;&nbsp;&nbsp;小区设置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">
    <input type="hidden" value="<?php  echo $regionid;?>" name="regionid">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-2">小区设置</td>
                    <td class="col-md-3">说明</td>
                    <td class="col-md-2"></td>
                    <td class="col-md-4">
                        是否启用
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">人工审核</td>
                    <td>
                        开启人工审核后，用户绑定需要管理人员审核方可使用物业相关功能，默认不开启审核
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x1]" id="x1" class="js-switch_1" <?php  if($set['x1']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">手机号验证</td>
                    <td>
                        开启手机号验证后，移动端粉丝注册的时候，通过输入手机号码后，进行验证手机号是否已导入系统，建议配合短信验证码来验证当前录入的手机号业主是否为真正的业主
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x2]" id="x2" class="js-switch_2" <?php  if($set['x2']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">注册码验证</td>
                    <td>
                        开启发放的注册码来给业主完成注册，减少业主需要输入的资料。如同时开启手机号验证，将同时验证手机号和注册码是否在系统中同时存在
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x3]" id="x3" class="js-switch_3" <?php  if($set['x3']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">游客权限</td>
                    <td>
                        开启游客浏览权限后，进入微小区，无需注册，但是需到菜单设置中设置每个菜单权限.
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x4]" id="x4" class="js-switch_4" <?php  if($set['x4']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">报修审核</td>
                    <td>
                        开启报修审核后，粉丝发布的报修，需要后台审核后，才可显示
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x5]" id="x5" class="js-switch_5" <?php  if($set['x5']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">建议审核</td>
                    <td>
                        开启建议审核后，粉丝发布的建议，需要后台审核后，才可显示
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x6]" id="x6" class="js-switch_6" <?php  if($set['x6']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">二手审核</td>
                    <td>
                        开启二手审核后，粉丝发布的二手信息，需要后台审核后，才可显示
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x7]" id="x7" class="js-switch_7" <?php  if($set['x7']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">租赁审核</td>
                    <td>
                        开启租赁审核后，粉丝发布的租赁信息，需要后台审核后，才可显示
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x8]" id="x8" class="js-switch_8" <?php  if($set['x8']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">拼车审核</td>
                    <td>
                        开启拼车审核后，粉丝发布的拼车信息，需要后台审核后，才可显示
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x9]" id="x9" class="js-switch_9" <?php  if($set['x9']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">报修手机端抢单</td>
                    <td>
                        开启抢单模式，手机端报修接收人将启用抢单，第一个点击，就是抢单成功。
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="" id="x50" class="js-switch_10" <?php  if($set['x50']['value']) { ?>checked<?php  } ?>/>

                    </td>
                </tr>
                <tr>
                    <td class="title">建议手机端抢单</td>
                    <td>
                        开启抢单模式，手机端建议接收人将启用抢单，第一个点击，就是抢单成功。
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="" id="x51" class="js-switch_11" <?php  if($set['x51']['value']) { ?>checked<?php  } ?>/>

                    </td>
                </tr>
                <tr>
                    <td class="title">报修全部显示</td>
                    <td>
                        开启报修全部显示后，粉丝发布的报修信息在微信端就在当前小区全部显示
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x10]" id="x10" class="js-switch_12" <?php  if($set['x10']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">建议全部显示</td>
                    <td>
                        开启建议全部显示后，粉丝发布的建议信息在微信端就在当前小区全部显示
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x11]" id="x11" class="js-switch_13" <?php  if($set['x11']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">房屋托管</td>
                    <td>
                        开启房屋托管后，移动端粉丝发布的手机号码不在显示，会显示托管电话
                    </td>
                    <td>
                        <input type="tel" name="house" value="<?php  echo $set['x12']['value'];?>" class="form-control" placeholder="输入托管电话"/>
                    </td>
                    <td>
                        <input type="checkbox" name="set[x13]" id="x13" class="js-switch_14" <?php  if($set['x13']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">微信开门</td>
                    <td>
                        开启的话，业主注册默认就有微信开门权限
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x14]" id="x14" class="js-switch_15" <?php  if($set['x14']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">授权验证开门</td>
                    <td>
                        默认微信开门采用的业主注册的楼栋单元匹配，进行开门。开启授权验证开门后，需要先在后台设置业主授权开门
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x15]" id="x15" class="js-switch_16" <?php  if($set['x15']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">微信开门关联物业费</td>
                    <td>
                        此设置与微信开门硬件有关，开启此设置后，会关联业主的物业费
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x16]" id="x16" class="js-switch_17" <?php  if($set['x16']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">物业费独立支付</td>
                    <td>
                        开启后，物业费将不在缴纳到平台，直接缴纳到小区账户
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x44]" id="x44" class="js-switch_18" <?php  if($set['x44']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">小区活动独立支付</td>
                    <td>
                        开启后，小区活动将不在缴纳到平台，直接缴纳到小区账户
                    </td>
                    <td>

                    </td>
                    <td>
                        <input type="checkbox" name="set[x45]" id="x45" class="js-switch_19" <?php  if($set['x45']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                </tbody>
            </table>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-5">
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

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
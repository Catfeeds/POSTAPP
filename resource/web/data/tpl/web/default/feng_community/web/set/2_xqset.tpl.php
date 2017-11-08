<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">

    <li  class="active"><a href="<?php  echo $this->createWebUrl('set',array('op' => 'xqset'))?>">小区设置</a></li>

</ul>
<style>
    .title{
        color:red
    }
</style>
<form action="" method="post" class="form-horizontal form">
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table table-hover" ng-controller="advAPI" style="width:100%;" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <td class="col-md-2">小区设置</td>
                    <td class="col-md-7">说明</td>
                    <td class="col-md-2"></td>
                    <td class="col-md-2">

                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">人工审核</td>
                    <td>开启住户审核后，用户绑定需要管理人员审核方可使用物业相关功能，默认不开启审核</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <div>
                            <input type="checkbox" id="p18" <?php  if($set['p18']['value']) { ?>checked<?php  } ?>/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title">手机号验证</td>
                    <td>开启手机号验证后，移动端粉丝注册的时候，通过输入手机号码后，进行验证手机号是否已导入系统，建议配合短信验证码来验证当前录入的手机号业主是否为真正的业主</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p19" <?php  if($set['p19']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">注册码验证</td>
                    <td>开启发放的注册码来给业主完成注册，减少业主需要输入的资料。如同时开启手机号验证，将同时验证手机号和注册码是否在系统中同时存在</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p20" <?php  if($set['p20']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">游客浏览</td>
                    <td>开启游客浏览权限后，粉丝可直接进入小区主页，无需注册，需到菜单设置中设置每个菜单权限。</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p22" <?php  if($set['p22']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">房屋托管</td>
                    <td>
                        开启房屋托管后，移动端粉丝发布的手机号码不在显示，会显示托管电话
                    </td>
                    <td>
                        <input type="text" name="set[p23]" value="<?php  echo $tel;?>" class="form-control" placeholder="输入托管电话"/>
                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p21" <?php  if($set['p21']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">报修审核</td>
                    <td>开启报修审核后，粉丝发布的报修，需要后台审核后，才可显示</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p24" <?php  if($set['p24']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">建议审核</td>
                    <td>开启建议审核后，粉丝发布的建议，需要后台审核后，才可显示</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p25" <?php  if($set['p25']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">二手审核</td>
                    <td>开启二手审核后，粉丝发布的二手，需要后台审核后，才可显示</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p27" <?php  if($set['p27']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">租赁审核</td>
                    <td>开启租赁审核后，粉丝发布的房屋租赁，需要后台审核后，才可显示</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p28" <?php  if($set['p28']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">拼车审核</td>
                    <td>开启拼车审核后，粉丝发布的拼车信息，需要后台审核后，才可显示</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p29" <?php  if($set['p29']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">报修手机端抢单</td>
                    <td>
                        开启抢单模式，手机端报修接收人将启用抢单，第一个点击，就是抢单成功。
                    </td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" name="" id="p75" <?php  if($set['p75']['value']) { ?>checked<?php  } ?>/>

                    </td>
                </tr>
                <tr>
                    <td class="title">建议手机端抢单</td>
                    <td>
                        开启抢单模式，手机端建议接收人将启用抢单，第一个点击，就是抢单成功。
                    </td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" name="" id="p76" <?php  if($set['p76']['value']) { ?>checked<?php  } ?>/>

                    </td>
                </tr>
                <tr>
                    <td class="title">报修全部显示</td>
                    <td>开启报修全部显示后，粉丝发布的报修信息在微信端就在当前小区全部显示</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p30" <?php  if($set['p30']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">建议全部显示</td>
                    <td>开启建议全部显示后，粉丝发布的建议信息在微信端就在当前小区全部显示</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p31" <?php  if($set['p31']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">微信开门</td>
                    <td>
                        开启的话，业主注册默认就有微信开门权限
                    </td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p32" <?php  if($set['p32']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">授权验证开门</td>
                    <td>
                        默认微信开门采用的业主注册的楼栋单元匹配，进行开门。开启授权验证开门后，需要先在后台设置业主授权开门
                    </td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p33" <?php  if($set['p33']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">微信开门关联物业费</td>
                    <td>此设置与微信开门硬件有关，开启此设置后，会关联业主的物业费</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p34" <?php  if($set['p34']['value']) { ?>checked='checked'<?php  } ?> />
                    </td>
                </tr>
                <tr>
                    <td class="title">注册码支持多次注册</td>
                    <td>注意：启用注册码多次注册后,我的家属属性和相关家属功能即将失效</td>
                    <td>

                    </td>
                    <td style="text-align: right;">
                        <input type="checkbox" id="p82" <?php  if($set['p82']['value']) { ?>checked='checked'<?php  } ?> />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-success" name="submit" value="提交">提交</button>
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </div>
</form>
<script>
    require(['bootstrap.switch', 'util'], function ($, u) {
        $(function () {
            $(':checkbox').bootstrapSwitch();
            $(':checkbox').on('switchChange.bootstrapSwitch', function (e, state) {
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
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

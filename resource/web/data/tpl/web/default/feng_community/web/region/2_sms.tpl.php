<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><a class="glyphicon glyphicon-arrow-left" href="<?php  echo $this->createWebUrl('region')?>"></a>&nbsp;&nbsp;&nbsp;短信设置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">短信接口</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x21]" id="x21_0" value="1" <?php  if(empty($set['x21']['value']) || $set['x21']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x21_0">乐信通(开户网站<a href="http://cn.mikecrm.com/0Z3k25z">http://cn.mikecrm.com/0Z3k25z</a>)</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x21]" id="x21_1" value="2" <?php  if($set['x21']['value']==2 ) { ?> checked<?php  } ?> />
                            <label for="x21_1">聚合(开户网站<a href="https://www.juhe.cn/docs/api/id/54">https://www.juhe.cn/docs/api/id/54</a> )</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">房号短信提醒</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x22]" id="x22_0" value="1" <?php  if($set['x22']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x22_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x22]" id="x22_1" value="0" <?php  if(empty($set['x22']['value'])) { ?> checked<?php  } ?> />
                            <label for="x22_1">不开启</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">注册短信提醒</label>
                    <div class="col-sm-10">
                            <div class="radio radio-success radio-inline">
                                <input type="radio" name="sms[x23]" id="x23_0" value="1" <?php  if($set['x23']['value']==1) { ?> checked<?php  } ?> />
                                <label for="x23_0">开启</label>
                            </div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" name="sms[x23]" id="x23_1" value="0" <?php  if(empty($set['x23']['value'])) { ?> checked<?php  } ?> />
                                <label for="x23_1">不开启</label>
                            </div>
                        <span class="help-block">开启短信验证后，用户注册微小区信息时自动验证其手机号的真实性（发送验证码）。</span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">意见报修短信提醒</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x24]" id="x24_0" value="1" <?php  if($set['x24']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x24_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x24]" id="x24_1" value="0" <?php  if(empty($set['x24']['value'])) { ?> checked<?php  } ?> />
                            <label for="x24_1">不开启</label>
                        </div>
                        <span class="help-block">开启报修投诉后，用户报修投诉信息会自动发给小区接收员。</span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">物业缴费短信提醒</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x25]" id="x25_0" value="1" <?php  if($set['x25']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x25_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x25]" id="x25_1" value="0" <?php  if(empty($set['x25']['value'])) { ?> checked<?php  } ?> />
                            <label for="x25_1">不开启</label>
                        </div>
                        <span class="help-block">开启短信提醒后，可通过短信通知小区用户催缴物业费。</span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">小区公告短信提醒</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x54]" id="x54_0" value="1" <?php  if($set['x54']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x54_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[x54]" id="x54_1" value="0" <?php  if(empty($set['x54']['value'])) { ?> checked<?php  } ?> />
                            <label for="x54_1">不开启</label>
                        </div>
                        <span class="help-block">开启短信提醒后，可通过短信通知小区用户催缴物业费。</span>
                    </div>
                </div>
                <div class="panel panel-default" id="wwt" <?php  if($set['x21']['value']==2) { ?>style="display: none"<?php  } ?>>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="account" class="col-sm-2 control-label">用户账户</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x30]" id='account' class="form-control" value="<?php  echo $set['x30']['value'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="col-sm-2 control-label">用户密码</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x31]" id='pwd' class="form-control" value="<?php  echo $set['x31']['value'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sign" class="col-sm-2 control-label">用户签名</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x32]" id='sign' class="form-control" value="<?php  echo $set['x32']['value'];?>" />
                        </div>
                    </div>
                </div>
                </div>
                <div class="panel panel-default" id="juhe" <?php  if($set['x21']['value']==2) { ?>style="display: block" <?php  } else { ?>style="display: none"<?php  } ?>>
                    <div class="panel-body">
                    <div class="form-group">
                        <label for="reportid" class="col-sm-2 control-label">报修投诉模板ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x33]" id='reportid' class="form-control" value="<?php  echo $set['x33']['value'];?>" />
                            <span class='help-block'>
                            注意：先去申请如下的模板：【微小区】报修信息#content#,报修人电话#mobile#。
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="resgisterid" class="col-sm-2 control-label">注册微小区模板ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x34]" id='resgisterid' class="form-control" value="<?php  echo $set['x34']['value'];?>" />
                            <span class='help-block'>
                            注意：先去聚合，申请如下的模板：【微小区】您的验证码是#code#。如非本人操作，请忽略本短信
                          </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="shopping_id" class="col-sm-2 control-label">超市发货模板ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x35]" id='shopping_id' class="form-control" value="<?php  echo $set['x35']['value'];?>" />
                            <span class='help-block'>
                          注意：先去申请如下的模板：【微小区】您的快递是#express_name#,快递单号#express_code#。有任何问题请随时与我们联系，谢谢。
                       </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="property_id" class="col-sm-2 control-label">物业费催缴模板ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x36]" id='property_id' class="form-control" value="<?php  echo $set['x36']['value'];?>" />
                            <span class='help-block'>
                            注意：先去申请如下的模板：【微小区】您好,您本月物业费已出。物业费金额#price#。请尽快缴纳，如有疑问，请咨询#phone#。
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room_id" class="col-sm-2 control-label">房号通知模板ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x37]" id='room_id' class="form-control" value="<?php  echo $set['x37']['value'];?>" />
                            <span class='help-block'>
                            注意：先去申请如下的模板：【微小区】您好,您在本小区注册码#code#，请尽快到我们的公众号#account#上注册使用在线功能哦。
                        </span>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="room_id" class="col-sm-2 control-label">小区公告通知模板ID</label>
                            <div class="col-sm-10">
                                <input type="text" name="sms[x55]" id='' class="form-control" value="<?php  echo $set['x55']['value'];?>" />
                                <span class='help-block'>
                            <!--注意：先去申请如下的模板：【微小区】您好,您在本小区注册码#code#，请尽快到我们的公众号#account#上注册使用在线功能哦。-->
                        </span>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="sms_account" class="col-sm-2 control-label">短信接口Key</label>
                        <div class="col-sm-10">
                            <input type="text" name="sms[x38]" id='sms_account' class="form-control" value="<?php  echo $set['x38']['value'];?>" />
                            <p class="help-block">目前暂时1个短信平台</p>
                        </div>
                    </div>
                </div>
                    </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-w-m" name="submit" value="提交">提交</button>
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
    $("input:radio[name='sms[x21]']").click(function () {
        var api= $('input:radio[name="sms[x21]"]:checked').val();
        if(api == 1){
            $("#wwt").show();
            $("#juhe").hide();
        }
        if(api == 2){
            $("#juhe").show();
            $("#wwt").hide();
        }
    })
})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

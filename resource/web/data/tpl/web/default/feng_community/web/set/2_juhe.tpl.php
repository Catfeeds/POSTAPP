<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>聚合接口</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">
    <input type="hidden" name="id" value="<?php  echo $settings['id'];?>" />

                <div class="form-group">
                    <label for="reportid" class="col-sm-2 control-label">报修投诉模板ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s8]" id='reportid' class="form-control" value="<?php  echo $set['s8']['value'];?>" />
                        <span class='help-block'>
                            注意：先去申请如下的模板：【微小区】报修信息#content#,报修人电话#mobile#。
                        </span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="resgisterid" class="col-sm-2 control-label">注册微小区模板ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s9]" id='resgisterid' class="form-control" value="<?php  echo $set['s9']['value'];?>" />
                        <span class='help-block'>
                            注意：先去聚合，申请如下的模板：【微小区】您的验证码是#code#。如非本人操作，请忽略本短信
                          </span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="shopping_id" class="col-sm-2 control-label">超市发货模板ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s10]" id='shopping_id' class="form-control" value="<?php  echo $set['s10']['value'];?>" />
                        <span class='help-block'>
                          注意：先去申请如下的模板：【微小区】您的快递是#express_name#,快递单号#express_code#。有任何问题请随时与我们联系，谢谢。
                       </span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="property_id" class="col-sm-2 control-label">物业费催缴模板ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s11]" id='property_id' class="form-control" value="<?php  echo $set['s11']['value'];?>" />
                        <span class='help-block'>
                            注意：先去申请如下的模板：【微小区】您好,您本月物业费已出。物业费金额#price#。请尽快缴纳，如有疑问，请咨询#phone#。
                        </span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="room_id" class="col-sm-2 control-label">房号通知模板ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s12]" id='room_id' class="form-control" value="<?php  echo $set['s12']['value'];?>" />
                        <span class='help-block'>
                            注意：先去申请如下的模板：【微小区】您好,您在本小区注册码#code#，请尽快到我们的公众号#account#上注册使用在线功能哦。
                        </span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="room_id" class="col-sm-2 control-label">公告通知模板ID</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s18]" id='' class="form-control" value="<?php  echo $set['s18']['value'];?>" />
                        <span class='help-block'>
                            <!--注意：先去申请如下的模板：【微小区】您好,您在本小区注册码#code#，请尽快到我们的公众号#account#上注册使用在线功能哦。-->
                        </span>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="sms_account" class="col-sm-2 control-label">短信接口Key</label>
                    <div class="col-sm-10">
                        <input type="text" name="sms[s13]" id='sms_account' class="form-control" value="<?php  echo $set['s13']['value'];?>" />
                        <p class="help-block">目前暂时1个短信平台</p>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

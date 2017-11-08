<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>短信配置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">短信接口</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s1]" id="s1_1" value="1" <?php  if(@empty($set['s1']['value']) || $set['s1']['value']==1) { ?> checked<?php  } ?> />
                            <label for="s1_1">乐信通(开户网站<a href="http://cn.mikecrm.com/0Z3k25z">http://cn.mikecrm.com/0Z3k25z</a>)</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s1]" id="s1_2" value="2" <?php  if(@$set['s1']['value']==2 ) { ?>
                            checked<?php  } ?> />
                            <label for="s1_2">聚合(开户网站<a href="https://www.juhe.cn/docs/api/id/54">https://www.juhe.cn/docs/api/id/54</a>
                                )</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">统一短信接口</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s2]" id="s2_1" value="1" <?php  if(@$set['s2']['value']==1) { ?>
                            checked<?php  } ?> />
                            <label for="s2_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s2]" id="s2_2" value="0" <?php  if(@empty($set['s2']['value'])) { ?>
                            checked<?php  } ?> />
                            <label for="s2_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">房号短信</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s3]" id="s3_1" value="1" <?php  if(@$set['s3']['value']==1) { ?>
                            checked<?php  } ?> />
                            <label for="s3_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s3]" id="s3_2" value="0" <?php  if(@empty($set['s3']['value'])) { ?>
                            checked<?php  } ?> />
                            <label for="s3_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">注册短信</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s4]" id="s4_1" value="1" <?php  if(@$set['s4']['value']==1) { ?>
                            checked<?php  } ?> />
                            <label for="s4_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s4]" id="s4_2" value="0" <?php  if(@empty($set['s4']['value'])) { ?>
                            checked<?php  } ?> />
                            <label for="s4_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">意见报修短信</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s5]" id="s5_1" value="1" <?php  if(@$set['s5']['value']==1) { ?>
                            checked<?php  } ?> />
                            <label for="s5_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s5]" id="s5_2" value="0" <?php  if(@empty($set['s5']['value'])) { ?>
                            checked<?php  } ?> />
                            <label for="s5_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">超市发货短信</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s6]" id="s6_1" value="1" <?php  if(@$set['s6']['value']==1) { ?>
                            checked<?php  } ?> />
                            <label for="s6_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s6]" id="s6_2" value="0" <?php  if(@empty($set['s6']['value'])) { ?>
                            checked<?php  } ?> />
                            <label for="s6_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">物业缴费短信</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s7]" id="s7_1" value="1" <?php  if(@$set['s7']['value']==1) { ?>
                            checked<?php  } ?> />
                            <label for="s7_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s7]" id="s7_2" value="0" <?php  if(@empty($set['s7']['value'])) { ?>
                            checked<?php  } ?> />
                            <label for="s7_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">小区公告短信</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s17]" id="s17_1" value="1" <?php  if(@$set['s17']['value']==1) { ?>
                            checked<?php  } ?> />
                            <label for="s17_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="sms[s17]" id="s17_2" value="0" <?php  if(@empty($set['s17']['value'])) { ?>
                            checked<?php  } ?> />
                            <label for="s17_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
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
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

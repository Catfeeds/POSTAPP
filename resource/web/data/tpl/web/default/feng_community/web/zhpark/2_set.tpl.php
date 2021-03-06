<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基本配置</h5>
                </div>
                <div class="ibox-content">

    <form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">自动推送缴费</label>
                    <div class="col-sm-10">
                            <div class="radio radio-success radio-inline">
                                <input type="radio" name="status" id="status1" value="1"  <?php  if($settings['status'] == 1) { ?>checked<?php  } ?>/>
                                <label for="status1">开启</label>
                            </div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" name="status"  id="status2" value="0"  <?php  if(empty($settings['status'])) { ?>checked<?php  } ?>/>
                                <label for="status2">关闭</label>
                            </div>
                    </div>
                </div>
        <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">到期日之前</label>
                    <div class="col-sm-9 col-xs-5 col-md-5">
                        <div class="input-group">
                            <input type="number" class="form-control" value="<?php  echo $settings['expire_num'];?>" name="expire_num"/>
                            <span class="input-group-addon">日</span>
                        </div>
                        <span class="help-block">例如：在月租即将到期之前2日内推送缴费提醒</span>
                    </div>
                </div>
        <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">欠费后日期</label>
                    <div class="col-sm-9 col-xs-5 col-md-5">
                        <div class="input-group">
                            <input type="number" class="form-control" value="<?php  echo $settings['arrears_num'];?>" name="arrears_num"/>
                            <span class="input-group-addon">日</span>
                        </div>
                        <span class="help-block">例如：在月租到期之后5日内推送缴费</span>
                    </div>
                </div>
        <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">推送间隔时间</label>
                    <div class="col-sm-9 col-xs-5 col-md-5">
                        <div class="input-group">
                            <input type="number" class="form-control" value="<?php  echo $settings['tjtime'];?>" name="tjtime"/>
                            <span class="input-group-addon">小时</span>
                        </div>
                        <span class="help-block">例如：间隔多长时间推送缴费</span>
                    </div>
                </div>
        <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">最多提醒次数</label>
                    <div class="col-sm-9 col-xs-5 col-md-5">
                        <div class="input-group">
                            <input type="number" class="form-control" value="<?php  echo $settings['remind_num'];?>" name="remind_num"/>
                            <span class="input-group-addon">次</span>
                        </div>
                        <span class="help-block">例如：最多给业主推送的次数，防止过度推送，业主反感</span>
                    </div>
                </div>
        <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">欠费通知模板id</label>
                    <div class="col-sm-9 col-xs-5 col-md-5">

                            <input type="text" class="form-control" value="<?php  echo $settings['car_tpl'];?>" name="car_tpl"/>


                        <span class="help-block">编号：OPENTM411367299 欠费通知</span>
                    </div>
                </div>
        <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-1 col-xs-12 col-sm-10 col-md-10 col-lg-11">
                        <input name="submit" type="submit" value="提交" class="btn btn-primary btn-w-m"/>
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

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基本配置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">打印接口</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d1]" id="d1_1" value="1" <?php  if(empty($set['d1']['value'])|| $set['d1']['value']==1) { ?> checked<?php  } ?> />
                            <label for="d1_1">云联打印机</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d1]" id="d1_2" value="2" <?php  if($set['d1']['value']==2 ) { ?> checked<?php  } ?> />
                            <label for="d1_2">飞印打印机</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">统一打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d2]" id="d2_1" value="1" <?php  if($set['d1']['value']==1) { ?> checked<?php  } ?> />
                            <label for="d2_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d2]" id="d2_2" value="0" <?php  if(empty($set['d2']['value']) ) { ?> checked<?php  } ?> />
                            <label for="d2_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">报修打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d3]" id="d3_1" value="1" <?php  if($set['d3']['value']==1) { ?> checked<?php  } ?> />
                            <label for="d3_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d3]" id="d3_2" value="0" <?php  if(empty($set['d3']['value']) ) { ?> checked<?php  } ?> />
                            <label for="d3_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">意见打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d4]" id="d4_1" value="1" <?php  if($set['d4']['value']==1) { ?> checked<?php  } ?> />
                            <label for="d4_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d4]" id="d4_2" value="0" <?php  if(empty($set['d4']['value']) ) { ?> checked<?php  } ?> />
                            <label for="d4_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">缴费打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d5]" id="d5_1" value="1" <?php  if($set['d5']['value']==1) { ?> checked<?php  } ?> />
                            <label for="d5_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d5]" id="d5_2" value="0" <?php  if(empty($set['d5']['value']) ) { ?> checked<?php  } ?> />
                            <label for="d5_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">超市打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d6]" id="d6_1" value="1" <?php  if($set['d6']['value']==1) { ?> checked<?php  } ?> />
                            <label for="d6_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d6]" id="d6_2" value="0" <?php  if(empty($set['d6']['value']) ) { ?> checked<?php  } ?> />
                            <label for="d6_2">关闭</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">商家打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d7]" id="d7_1" value="1" <?php  if($set['d7']['value']==1) { ?> checked<?php  } ?> />
                            <label for="d7_1">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[d7]" id="d7_2" value="0" <?php  if(empty($set['d7']['value']) ) { ?> checked<?php  } ?> />
                            <label for="d7_2">关闭</label>
                        </div>
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

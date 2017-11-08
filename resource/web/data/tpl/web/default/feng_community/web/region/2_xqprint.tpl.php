<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><a class="glyphicon glyphicon-arrow-left" href="<?php  echo $this->createWebUrl('region')?>"></a>&nbsp;&nbsp;&nbsp;打印机设置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">打印接口</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x26]" id="x26_0" value="1" <?php  if(empty($set['x26']['value']) || $set['x26']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x26_0">云联打印机</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x26]" id="x26_1" value="2" <?php  if($set['x26']['value']==2 ) { ?> checked<?php  } ?> />
                            <label for="x26_1">飞印打印机</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">报修打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x27]" id="x27_0" value="1" <?php  if($set['x27']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x27_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x27]" id="x27_1" value="0" <?php  if(empty($set['x27']['value'])) { ?> checked<?php  } ?> />
                            <label for="x27_1">不开启</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">意见打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x28]" id="x28_0" value="1" <?php  if($set['x28']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x28_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x28]" id="x28_1" value="0" <?php  if(empty($set['x28']['value'])) { ?> checked<?php  } ?> />
                            <label for="x28_1">不开启</label>
                        </div>
                    </div>
                </div>
    <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">缴费打印</label>
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x29]" id="x29_0" value="1" <?php  if($set['x29']['value']==1) { ?> checked<?php  } ?> />
                            <label for="x29_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="print[x29]" id="x29_1" value="0" <?php  if(empty($set['x29']['value'])) { ?> checked<?php  } ?> />
                            <label for="x29_1">不开启</label>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="yl" <?php  if($set['x26']['value'] == 2) { ?>style='display:none'<?php  } ?>>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="ylkey" class="col-sm-2 control-label">API密钥</label>
                            <div class="col-sm-10">
                                <input type="text" name="print[x39]" id='ylkey' class="form-control" value="<?php  echo $set['x39']['value'];?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yldeviceno" class="col-sm-2 control-label">终端编号</label>
                            <div class="col-sm-10">
                                <input type="text" name="print[x40]" id='yldeviceno' class="form-control" value="<?php  echo $set['x40']['value'];?>" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default" id="fy" <?php  if($set['x26']['value'] == 2) { ?>style='display:block'<?php  } else { ?>style='display:none'<?php  } ?>>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="fycode" class="col-sm-2 control-label">商户编码</label>
                            <div class="col-sm-10">
                                <input type="text" name="print[x41]" id='fycode' class="form-control" value="<?php  echo $set['x41']['value'];?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fykey" class="col-sm-2 control-label">API密钥</label>
                            <div class="col-sm-10">
                                <input type="text" name="print[x42]" id='fykey' class="form-control" value="<?php  echo $set['x42']['value'];?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fydeviceno" class="col-sm-2 control-label">终端编号</label>
                            <div class="col-sm-10">
                                <input type="text" name="print[x43]" id='fydeviceno' class="form-control" value="<?php  echo $set['x43']['value'];?>" />
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
        $("input:radio[name='print[x26]']").click(function () {
            var api= $('input:radio[name="print[x26]"]:checked').val();
            if(api == 1){
                $("#yl").show();
                $("#fy").hide();
            }
            if(api == 2){
                $("#fy").show();
                $("#yl").hide();
            }
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

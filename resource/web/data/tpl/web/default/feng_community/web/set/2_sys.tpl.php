<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>平台设置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">系统状态</label>
                <div class="col-sm-10">

                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="set[p66]" id="p66_0" value="0" <?php  if(empty($set['p66']['value'])) { ?> checked<?php  } ?> />
                            <label for="p66_0">开启</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="set[p66]"  id="p66_1" value="1" <?php  if($set['p66']['value']==1 ) { ?> checked<?php  } ?> />
                            <label for="p66_1">关闭</label>
                        </div>

                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">系统关闭提醒</label>
                <div class="col-sm-10">
                    <textarea name="set[p67]" class="form-control" placeholder="例如：系统正在升级中，请稍后在试"/><?php  echo $set['p67']['value'];?></textarea>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">品牌名称</label>
                <div class="col-sm-10">
                    <input name="set[p74]" class="form-control" value="<?php  echo $set['p74']['value'];?>"/>
                    <span class="help-block">显示在网站的顶部名称</span>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">底部版权</label>
                <div class="col-sm-10">
                    <textarea name="set[p68]" class="form-control"/><?php  echo $set['p68']['value'];?></textarea>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">版权外链</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_link('set[p69]',$set['p69']['value'])?>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">报修回复模板</label>
                <div class="col-sm-10">
                    <textarea name="set[p47]" class="form-control" placeholder="例如：我们已收到您的报修，请等待我们的维修员联系您！  "/><?php  echo $set['p47']['value'];?></textarea>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">建议回复模板</label>
                <div class="col-sm-10">
                    <textarea name="set[p48]" class="form-control" placeholder="例如：我们已收到您的建议，请等待我们的管理员联系您！  "/><?php  echo $set['p48']['value'];?></textarea>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">家政回复模板</label>
                <div class="col-sm-10">
                    <textarea name="set[p50]" class="form-control" placeholder="例如：我们已收到您的家政服务需求，请等待我们的管理员联系您！  "/><?php  echo $set['p50']['value'];?></textarea>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">缴费回复模板</label>
                <div class="col-sm-10">
                    <textarea name="set[p51]" class="form-control" placeholder="例如：您已成功缴费，可登陆我-我的账单查看"/><?php  echo $set['p51']['value'];?></textarea>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">注册协议开关</label>
                <div class="col-sm-10">
                    <div class="col-sm-10">
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="set[p80]" id="p80_0" value="0" <?php  if(empty($set['p80']['value'])) { ?> checked<?php  } ?> />
                            <label for="p80_0">关闭</label>
                        </div>
                        <div class="radio radio-success radio-inline">
                            <input type="radio" name="set[p80]"  id="p80_1" value="1" <?php  if($set['p80']['value']==1 ) { ?> checked<?php  } ?> />
                            <label for="p80_1">开启</label>
                        </div>
                    </div>
                </div>
            </div>
    <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">平台协议</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('set[p49]', $set['p49']['value']);?>
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
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li>
        <a href="<?php  echo $this->createWebUrl('staff', array('op' => 'perm','p' => 'list'));?>">管理管理员</a>
    </li>
    <li class="active"><a href="#">手机端权限</a></li>
    </li>
</ul>
<form action="" class="form-horizontal form" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="userid" value="<?php  echo $_GPC['id'];?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">移动端权限</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">手机端菜单</label>
                <div class="col-sm-10 col-lg-9 col-xs-12">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" value="1" name="data[]" <?php  if(strstr($user['xqmenus'],'1')) { ?>checked='checked'<?php  } ?>> 报修管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox2" value="2" name="data[]" <?php  if(strstr($user['xqmenus'],'2')) { ?>checked='checked'<?php  } ?>> 建议管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox3" value="3" name="data[]" <?php  if(strstr($user['xqmenus'],'3')) { ?>checked='checked'<?php  } ?>> 公告管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox4" value="4" name="data[]" <?php  if(strstr($user['xqmenus'],'4')) { ?>checked='checked'<?php  } ?>> 超市管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox5" value="5" name="data[]" <?php  if(strstr($user['xqmenus'],'5')) { ?>checked='checked'<?php  } ?>> 商家管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox6" value="6" name="data[]" <?php  if(strstr($user['xqmenus'],'6')) { ?>checked='checked'<?php  } ?>> 费用查询
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox7" value="7" name="data[]" <?php  if(strstr($user['xqmenus'],'7')) { ?>checked='checked'<?php  } ?>> 小区活动
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox8" value="8" name="data[]" <?php  if(strstr($user['xqmenus'],'8')) { ?>checked='checked'<?php  } ?>> 家政管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox9" value="9" name="data[]" <?php  if(strstr($user['xqmenus'],'9')) { ?>checked='checked'<?php  } ?>> 租赁管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox10" value="10" name="data[]" <?php  if(strstr($user['xqmenus'],'10')) { ?>checked='checked'<?php  } ?>> 二手管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox11" value="11" name="data[]" <?php  if(strstr($user['xqmenus'],'11')) { ?>checked='checked'<?php  } ?>> 拼车管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox12" value="12" name="data[]" <?php  if(strstr($user['xqmenus'],'12')) { ?>checked='checked'<?php  } ?>> 住户管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox13" value="13" name="data[]" <?php  if(strstr($user['xqmenus'],'13')) { ?>checked='checked'<?php  } ?>> 门禁管理
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox14" value="14" name="data[]" <?php  if(strstr($user['xqmenus'],'14')) { ?>checked='checked'<?php  } ?>> 内部通知
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </div>
    </div>
</form>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
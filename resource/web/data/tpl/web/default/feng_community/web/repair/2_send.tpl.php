<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#">通知推送</a>
    </li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">推送</h3>
    </div>
    <div class="panel-body">
        <form action="" class="form-horizontal form" method="post" onsubmit="return check(this);">
            <input type="hidden" value="<?php  echo $id;?>" name="reportid">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">维修员:</label>
                <div class="col-sm-3">
                    <select name="openid" class="form-control" id="openid">
                        <option value="">选择维修员</option>
                        <?php  if(is_array($notices)) { foreach($notices as $notice) { ?>
                        <!--<?php  load()->model('mc');$member = mc_fetch($notice['fansopenid'], array('mobile', 'credit1','credit2', 'nickname', 'address')); ?>-->
                        <!--<option value="<?php  echo $notice['id'];?>"><?php  if($notice['realname']) { ?><?php  echo $notice['realname'];?><?php  } else { ?><?php  echo $member['nickname'];?><?php  } ?></option>-->
                        <?php  } } ?>
                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                        <option value="<?php  echo $item['openid'];?>"><?php  echo $item['realname'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-block" name="submit" value="提交">提交</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>

    </div>
</div>
<script type="text/javascript">
    function check(form) {
        if (!form['openid'].value) {
            alert('请选择维修员');
            return false;
        }
    }

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
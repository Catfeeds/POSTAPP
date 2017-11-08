<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">

    <li  class="active"><a href="<?php  echo $this->createWebUrl('set',array('op' => 'field'));?>">注册字段配置</a></li>

</ul>
<style>
    .title{
        color:red
    }
</style>
<form action="" method="post" class="form-horizontal form">
    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <td class="col-md-3">标题</td>
                    <td class="col-md-8">是否启用</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">
                        独立接口(开启后，以平台设置为准)
                    </td>
                    <td>
                        <input type="checkbox" id="p55" <?php  if($set['p55']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <td class="col-md-1">字段</td>
                    <td class="col-md-2">标题</td>
                    <td class="col-md-8">是否启用</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">area</td>
                    <td>
                        <input type="text" name="set[p37]" class="form-control" value="<?php  echo $set['p37']['value'];?>" placeholder="例如区"/>
                    </td>
                    <td>
                        <input type="checkbox" id="p36" <?php  if($set['p36']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">build</td>
                    <td>
                        <input type="text" name="set[p39]" class="form-control" value="<?php  echo $set['p39']['value'];?>" placeholder="例如栋"/>
                    </td>
                    <td>
                        <input type="checkbox" id="p38" <?php  if($set['p38']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">unit</td>
                    <td>
                        <input type="text" name="set[p41]" class="form-control" value="<?php  echo $set['p41']['value'];?>" placeholder="例如单元"/>
                    </td>
                    <td>
                        <input type="checkbox" id="p40" <?php  if($set['p40']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">room</td>
                    <td>
                        <input type="text" name="set[p43]" class="form-control" value="<?php  echo $set['p43']['value'];?>" placeholder="例如室"/>

                    </td>
                    <td>
                        <input type="checkbox" id="p42" <?php  if($set['p42']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">license</td>
                    <td>
                        <span>车牌号</span>

                    </td>
                    <td>
                        <input type="checkbox" id="p81" <?php  if($set['p81']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">idcard</td>
                    <td>
                        <span>身份证</span>

                    </td>
                    <td>
                        <input type="checkbox" id="p83" <?php  if($set['p83']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">gender</td>
                    <td>
                        <span>性别</span>

                    </td>
                    <td>
                        <input type="checkbox" id="p84" <?php  if($set['p84']['value']) { ?>checked<?php  } ?>/>
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
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs" >

    <li class="active"><a href="<?php  echo $this->createWebUrl('set',array('op' => 'qwt'))?>">全网通设置</a></li>
</ul>
<style>
    .title {
        color: red
    }
</style>
<form action="" method="post" class="form-horizontal form">
    <div class="panel panel-default">
        <div class="table-responsive">
            <div class="alert alert-info" role="alert">
                说明:
                1. 不开启WAP只能在微信环境打开，开启WAP后可以从非微信浏览器打开(任何浏览器)，可用手机号码作为登录凭证
                2. 使用app,需要开启推送开关
                3. 请认真配置下面的参数
            </div>
            <table class="table">
                <thead>
                <tr>
                    <td class="col-md-2">全网通</td>
                    <td class="col-md-7">说明</td>
                    <td class="col-md-3"></td>
                    <td class="col-md-2">
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">wap访问</td>
                    <td>开启后，在非微信也可以使用</td>
                    <td>
                        <input type="checkbox" name="" id="p52" <?php  if($set['p52']['value']) { ?>checked<?php  } ?>/>
                    </td>
                    <td style="text-align: right;">
                    </td>
                </tr>
                <tr>
                    <td class="title">app推送</td>
                    <td>
                        使用app时，需要开启app推送开关
                    </td>
                    <td>
                        <input type="checkbox" name="" id="p53" <?php  if($set['p53']['value']) { ?>checked<?php  } ?>/>
                    </td>

                </tr>


                </tbody>
            </table>
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
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>

<style>
    .title{
        color:red
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><a class="glyphicon glyphicon-arrow-left" href="<?php  echo $this->createWebUrl('region')?>"></a>&nbsp;&nbsp;&nbsp;注册字段配置</h5>
                </div>
                <div class="ibox-content">
<form action="" method="post" class="form-horizontal form">
    <input type="hidden" value="<?php  echo $regionid;?>" name="regionid" />
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-1">字段</td>
                    <td class="col-md-1">标题</td>
                    <td class="col-md-8">是否启用</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">area</td>
                    <td>
                        <input type="text" name="set[x46]" class="form-control" value="<?php  echo $set['x46']['value'];?>" placeholder="例如区"/>
                    </td>
                    <td>
                        <input type="checkbox" id="x17" <?php  if($set['x17']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">build</td>
                    <td>
                        <input type="text" name="set[x47]" class="form-control" value="<?php  echo $set['x47']['value'];?>" placeholder="例如栋"/>
                    </td>
                    <td>
                        <input type="checkbox" id="x18" <?php  if($set['x18']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">unit</td>
                    <td>
                        <input type="text" name="set[x48]" class="form-control" value="<?php  echo $set['x48']['value'];?>" placeholder="例如单元"/>
                    </td>
                    <td>
                        <input type="checkbox" id="x19" <?php  if($set['x19']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">room</td>
                    <td>
                        <input type="text" name="set[x49]" class="form-control" value="<?php  echo $set['x49']['value'];?>" placeholder="例如室"/>
                    </td>
                    <td>
                        <input type="checkbox" id="x20" <?php  if($set['x20']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">license</td>
                    <td>
                        <span>车牌号</span>

                    </td>
                    <td>
                        <input type="checkbox" id="x52" <?php  if($set['x52']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">idcard</td>
                    <td>
                        <span>身份证</span>

                    </td>
                    <td>
                        <input type="checkbox" id="x55" <?php  if($set['x55']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                <tr>
                    <td class="title">gender</td>
                    <td>
                        <span>性别</span>

                    </td>
                    <td>
                        <input type="checkbox" id="x56" <?php  if($set['x56']['value']) { ?>checked<?php  } ?>/>
                    </td>
                </tr>
                </tbody>
            </table>

    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary btn-w-m" name="submit" value="提交">提交</button>
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </div>
</form>
                </div></div></div></div></div>
<script>
    require(['bootstrap.switch', 'util'], function($, u){
        $(function(){
            $(':checkbox').bootstrapSwitch();
            $(':checkbox').on('switchChange.bootstrapSwitch', function(e, state){
                $this = $(this);
                var xqkey = $this.attr('id');
                var status = this.checked ? 1 : 0;
                $this.val(status);
                var regionid = '<?php  echo $regionid;?>';
                $.post("<?php  echo $this->createWebUrl('updatekey')?>",{xqkey:xqkey,status:status,regionid:regionid},function () {

                })
            });
            $('.btn').hover(function(){
                $(this).tooltip('show');
            },function(){
                $(this).tooltip('hide');
            });
        });
    });
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

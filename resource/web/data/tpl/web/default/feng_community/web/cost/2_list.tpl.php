<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>费用管理</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('cost')?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            <p>《物业费》：
                            <p style="color: red">1.开启是否显示，开启后，微信端才会显示</p>
                            <p style="color: black"> 2.注意：是在关闭缴费订单的时候才能生效，开启是否已支付显示，为了方便一次性导入费用。已缴费过的用户，可查看之前缴费的记录。因为已过期的缴费订单，一般都是关闭的。</p>
                            </p>
                            <P style="color: blue">《注意》：2条不适合按月和按季度导入 </P>
                        </div>
                    </div>
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site"/>
                        <input type="hidden" name="a" value="entry"/>
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
                        <input type="hidden" name="do" value="cost"/>
                    <div class="row">
                        <div class="col-sm-6 m-b-xs">
                            <a class="btn btn-sm btn-primary" href="<?php  echo $this->createWebUrl('cost', array('op' => 'add'))?>"><i class="fa fa-plus"></i> 导入费用</a>
                        </div>
                        <div class="col-sm-6 m-b-xs">
                            <div class="input-group">
                                <select name="regionid" class="form-control" >
                                    <option value="0">全部小区</option>
                                    <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                    <option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?> selected<?php  } ?>><?php  echo $region['title'];?></option>
                                    <?php  } } ?>
                                </select>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">搜索</button>
                                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                                </span>
                            </div>

                        </div>
                    </div>
                    </form>

            <table class="table table-bordered" style="width:100%;z-index:-10;" cellspacing="0" cellpadding="0">
                <thead class="navbar-inner">
                <tr>
                    <th class="col-lg-2">小区名称</th>
                    <th class="col-lg-2">费用时间</th>
                    <th class="col-lg-1">导入时间</th>
                    <th class="col-lg-4">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $k => $item) { ?>
                <?php  $k = $k+1?>
                <tr>
                    <td><?php  echo $item['city'];?><?php  echo $item['dist'];?><?php  echo $item['title'];?></td>
                    <td><?php  echo $item['costtime'];?></td>
                    <td><?php  echo date('Y-m-d',$item['createtime'])?></td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('cost',array('op' => 'detail','id' => $item['id'],'regionid' => $item['regionid']))?>" title="详情" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-sm">查看</a>

                        <a href="<?php  echo $this->createWebUrl('cost',array('op' => 'order','id' => $item['id']))?>" title="订单管理" data-toggle="tooltip" data-placement="top" class="btn btn-primary btn-sm">订单管理</a>
                        <input type="checkbox" value="1"<?php  if(intval($item['enable'])==1) { ?> checked="checked"<?php  } ?> data="<?php  echo $item['id'];?>" class="js-switch_<?php  echo $k;?>"/>
                        <a onclick="return confirm('此操作不可恢复，确认吗？'); return false;" href="<?php  echo $this->createWebUrl('cost',array('op' => 'delete','id' => $item['id']))?>" title="删除" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm">删除</a>


                    </td>
                </tr>
                <?php  } } ?>
            </tbody>
            </table>
                    <table class="footable table table-stripped toggle-arrow-tiny footable-loaded tablet breakpoint">
                        <thead>
                        <?php  if($list) { ?>
                        <tr>
                            <td class="footable-visible"><ul class="pagination pull-right"><?php  echo $pager;?></ul></td>
                        </tr>
                        <?php  } else { ?>
                        <tr style="text-align: center"><td >没有找到对应的记录</td></tr>
                        <?php  } ?>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
     require(['bootstrap.switch', 'util'], function($, u){
            $(function(){
                $(':checkbox').on('change', function (e, state) {
                    $this = $(this);
                    var id = $this.attr('data');
                    var enable = this.checked ? 1 : 0;

                    $.post(location.href,{enable: enable, id: id},function () {

                    })
                });

        });
     function verify(obj, id, type) {
         $(obj).html($(obj).html() + "...");
         $.post("<?php  echo $this->createWebUrl('cost',array('op' => 'verify'))?>", {
             id: id,
             type: type,
             data: obj.getAttribute("data")
         }, function(d) {
             $(obj).html($(obj).html().replace("...", ""));
             if (type == 'status') {
                 $(obj).html(d.data == '1' ? '开启已支付' : '关闭已支付');
             }
             if (type == 'open_status') {
                 $(obj).html(d.data == '1' ? '开启' : '关闭');
             }
             $(obj).attr("data", d.data);
             if (d.result == 1) {
                 $(obj).toggleClass("label-info");
             }
         }, "json");
     }
</script>

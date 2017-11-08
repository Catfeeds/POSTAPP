<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>房号管理</h5>
                    <h5 style="float: right"><a class="glyphicon glyphicon-refresh" href="<?php  echo $this->createWebUrl('room')?>"></a></h5>
                </div>
                <div class="ibox-content">
                    <form action="./index.php" method="get" class="form-horizontal" role="form">
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="<?php  echo $this->module['name']?>" />
                        <input type="hidden" name="do" value="room" />
                        <input type="hidden" name="op" value="list" />
                        <div class="row">
                            <div class="col-sm-4 m-b-xs">
                                <a href="<?php  echo $this->createWebUrl('room',array('op' => 'add'))?>" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>添加房号</a>
                                <a class="btn btn-primary" href="<?php  echo $this->createWebUrl('room', array('op' => 'import'))?>"> 导入房号</a>
                            </div>

                            <div class="col-sm-4 m-b-xs">
                                <select name="regionid" class="form-control" >
                                    <option value="" >全部小区</option>
                                    <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                    <option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?> selected<?php  } ?>><?php  echo $region['title'];?></option>
                                    <?php  } } ?>
                                </select>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="输入关键字" value="<?php  echo $_GPC['keyword'];?>">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"> 搜索</button>
                                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                                </span>
                                </div>
                            </div>
                        </div>
                    </form>
<form action="" class="form-horizontal form" method="post">
            <table class="table table-bordered">
                <thead >
                <tr>
                    <td style="width: 3%;">
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" id="checkids"
                                   onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
                            <label for="checkids"> </label>
                        </div>
                    </td>
                    <th style="width: 80px;">ID</th>
                    <th style="width: 180px;">所属小区</th>
                    <th style="width: 80px;">楼宇</th>
                    <th style="width: 80px;">单元号</th>
                    <th style="width: 80px;">房号</th>
                    <th style="width: 100px;">建筑面积</th>
                    <th style="width: 80px;">状态</th>
                    <th style="width: 80px;">注册码</th>
                    <th style="width: 480px;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td>
                        <div class="checkbox checkbox-success checkbox-inline">
                            <input type="checkbox" type="checkbox" name="ids[]" id="ids_<?php  echo $item['id'];?>" value="<?php  echo $item['id'];?>">
                            <label for="ids_<?php  echo $item['id'];?>"></label>
                        </div>
                    </td>
                    <td><?php  echo $item['id'];?></td>
                    <td><?php  echo $item['title'];?></td>
                    <td><?php  echo $item['build'];?></td>
                    <td><?php  echo $item['unit'];?></td>
                    <td><?php  echo $item['room'];?></td>
                    <td><?php  if($item['square']) { ?><?php  echo $item['square'];?><?php  } else { ?>0<?php  } ?></td>
                    <td></td>
                    <td>
                        <?php  echo $item['code'];?>
                    </td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('room', array('op'=>'add', 'id' => $item['id']));?>" class="btn btn-primary btn-sm">编辑</a>

                        <a href="<?php  echo $this->createWebUrl('room', array('op'=>'qr', 'id' => $item['id']));?>" class="btn btn-primary btn-sm">二维码</a>
                        <a href="<?php  echo $this->createWebUrl('room', array('op'=>'del', 'id' => $item['id']));?>" class="btn btn-default btn-sm" onClick="return confirm('确定删除?');">删除</a>
                    </td>
                </tr>
                <?php  } } ?>
                </tbody>
            </table>
    <table class="footable table table-stripped toggle-arrow-tiny footable-loaded tablet breakpoint">
        <thead>
        <?php  if($list) { ?>
        <tr>
            <td id="pager_list_1_left" align="left">
                <input type="submit" name="del" value="批量删除房号" class="btn btn-danger btn-sm">
                <input type="submit" name="plsms" value="批量发送注册码" class="btn btn-primary btn-sm">
                <input type="submit" name="plcode" value="批量重置注册码" class="btn btn-primary btn-sm">
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                <?php  if($total) { ?>
                <span style="color: red">总人数:<?php  echo $total;?>人</span>
                <?php  } ?>
            </td>
            <td class="footable-visible"><ul class="pagination pull-right"><?php  echo $pager;?></ul></td>
        </tr>
        <?php  } else { ?>
        <tr style="text-align: center"><td >没有找到对应的记录</td></tr>
        <?php  } ?>
        </thead>
    </table>

</form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="room" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加房号</h4>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <p>小区注册字段(楼栋,单元,室),根据选择的小区配置</p>
            </div>
            <form action="<?php  echo $this->createWebUrl('room',array('op'=> 'add'))?>" class="form-horizontal form" method="post" enctype="multipart/form-data"
                  onsubmit="return check(this);">

                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">小区</label>
                        <div class="col-sm-5">
                            <select id="xqregionid" name="regionid" class='form-control'>
                                <option value="0">选择小区</option>
                                <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                <option value="<?php  echo $region['id'];?>" <?php  if($item['regionid']==$region['id']) { ?>selected='selected'<?php  } ?>><?php  echo $region['title'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room" class="col-sm-2 control-label">姓名</label>
                        <div class="col-xs-5">

                            <input type="text" name="realname" value="" class="form-control"
                            />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room" class="col-sm-2 control-label">电话</label>
                        <div class="col-xs-5">

                            <input type="text" name="mobile" value="" class="form-control"
                            />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room" class="col-sm-2 control-label">车牌号</label>
                        <div class="col-xs-5">

                            <input type="text" name="license" value="" class="form-control"
                            />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="room" class="col-sm-2 control-label">面积</label>
                        <div class="col-xs-5">

                            <input type="text" name="square" value="" class="form-control"
                            />

                        </div>
                    </div>
                    <div id="content"></div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                            <button type="submit" class="btn btn-w-m btn-primary" name="submit" value="提交">提交</button>
                        </div>

                    </div>

            </form>
        </div>
    </div>
</div>
                </div>
            </div>

<script>
    $("#xqregionid").change(function () {
        var regionid = $("#xqregionid option:selected").val();
        if (regionid != '0') {
            $.post("<?php  echo $this->createWebUrl('room',array('op' => 'region'))?>", {regionid:regionid}, function (data) {
                var content='';
                if(data.a){
                    content += "<div class=\"form-group\"><label for=\"room\" class=\"col-sm-2 control-label\">区</label><div class=\"col-xs-5\"><div class=\"input-group\"><input type=\"text\" name=\"area\" class=\"form-control\" /><span class=\"input-group-addon\">区</span></div> </div></div>";

                }
                if(data.b){
                    content += "<div class=\"form-group\"><label for=\"room\" class=\"col-sm-2 control-label\">栋</label><div class=\"col-xs-5\"><div class=\"input-group\"><input type=\"text\" name=\"build\" class=\"form-control\" /><span class=\"input-group-addon\">栋</span></div> </div></div>";

                }
                if(data.c){
                    content += "<div class=\"form-group\"><label for=\"room\" class=\"col-sm-2 control-label\">单元</label><div class=\"col-xs-5\"><div class=\"input-group\"><input type=\"text\" name=\"unit\" class=\"form-control\" /><span class=\"input-group-addon\">单元</span></div> </div></div>";

                }
                if(data.d){
                    content += "<div class=\"form-group\"><label for=\"room\" class=\"col-sm-2 control-label\">室</label><div class=\"col-xs-5\"><div class=\"input-group\"><input type=\"text\" name=\"room\" class=\"form-control\" /><span class=\"input-group-addon\">室</span></div> </div></div>";

                }
                $("#content").html(content);


            },'json');
        }
    })

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

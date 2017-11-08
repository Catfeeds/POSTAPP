<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('member', array('op' => 'list'));?>">用户管理</a></li>
    <li class="active"><a href="<?php  echo $this->createWebUrl('member', array('op' => 'bind'));?>">房号管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('member',array('op'=> 'room'));?>">房号导入</a></li>
</ul>
<div class="panel panel-info">
    <div class="panel-body">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <p>业主绑定的房号信息</p>
        </div>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="status" value="<?php  echo $status;?>">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="feng_community" />
            <input type="hidden" name="do" value="member" />
            <input type="hidden" name="op" value="bind" />
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
                <div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
                    <a class="btn btn-default <?php  if(empty($status)) { ?>btn-primary<?php  } ?>"
                       href="<?php  echo $this->createWebUrl('member',array('op' => 'bind'))?>">不限</a>
                    <a class="btn btn-default <?php  if($status == '1') { ?>btn-primary<?php  } ?>"
                       href="<?php  echo $this->createWebUrl('member',array('op' => 'bind','status' => 1))?>">户主</a>
                    <a class="btn btn-default <?php  if($status == '2') { ?>btn-primary<?php  } ?>"
                       href="<?php  echo $this->createWebUrl('member',array('op' => 'bind','status' => 2))?>">家属</a>
                    <a class="btn btn-default <?php  if($status == '3') { ?>btn-primary<?php  } ?>"
                       href="<?php  echo $this->createWebUrl('member',array('op' => 'bind','status' => 3))?>">租户</a>
                    <a class="btn btn-default <?php  if($status == '4') { ?>btn-primary<?php  } ?>"
                       href="<?php  echo $this->createWebUrl('member',array('op' => 'bind','status' => 4))?>">未绑定</a>
                </div>

            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">选择小区</label>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                    <select name="regionid" class="form-control" id="regionid">
                        <option value="0">请选择小区</option>
                        <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                        <option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?>selected<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名/手机号/地址</label>
                <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
                    <input class="form-control" name="keyword" type="text" value="<?php  echo $_GPC['keyword'];?>">
                </div>
                <div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
                    <button type="submit" name="export" value="1" class="btn btn-default"><i
                            class="glyphicon glyphicon-download-alt"></i>导出房号</button>
                </div>
            </div>
        </form>
    </div>
</div>
<form action="" class="form-horizontal form" method="post">
<div class="panel panel-default">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
            <tr>
                <td style="width:50px"></td>
                <th style="width:50px">ID</th>
                <th style="width:150px">小区名称</th>
                <th style="width:60px">姓名</th>
                <th style="width:100px">手机</th>
                <th style="width:120px">车牌号</th>
                <th style="width:200px">地址</th>
                <th style="width:180px">注册时间</th>
                <th style="width:60px">状态</th>
                <th style="width:80px">注册码</th>
                <th style="width:230px">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td>
                    <input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>">
                </td>
                <td><?php  echo $item['id'];?></td>
                <td><?php  echo $item['title'];?></td>
                <td><?php  echo $item['realname'];?></td>
                <td><?php  echo substr_replace($item['mobile'],'****',3,4)?></td>
                <td><?php  echo $item['license'];?></td>
                <td><?php  echo $item['address'];?></td>
                <td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
                <td>
                    <label data="<?php  echo $item['status'];?>" class='label  label-default label-info'>
                        <?php  if($item['status'] == 1) { ?>户主 <?php  } else if($item['status'] == 2) { ?> 家属<?php  } else if($item['status'] == 3) { ?>租户<?php  } else { ?>未绑定<?php  } ?>
                    </label>
                    <?php  if($item['umobile']) { ?>
                    (户主手机:<?php  echo $item['umobile'];?>)
                    <?php  } ?>
                </td>
                <td><?php  echo $item['code'];?></td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('member', array('op'=>'add', 'id' => $item['id']));?>"
                       class="btn btn-default btn-sm"><i class="fa fa-edit" data-toggle="tooltip"
                                                         data-placement="top"></i>编辑</a>
                    <a href="<?php  echo $this->createWebUrl('member', array('op'=>'del', 'id' => $item['id']));?>"
                       class="btn btn-default btn-sm" onClick="return confirm('确定删除?');"><i class="fa fa-times"></i>删除</a>
                    <a href="<?php  echo $this->createWebUrl('member', array('op'=>'qr', 'id' => $item['id']));?>"
                       class="btn btn-default btn-sm">二维码</a>
                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>

        <table class="table table-hover">
            <tr>
                <td width="30">
                    <input type="checkbox"
                           onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"/>
                </td>
                <td class="text-left">
                    <input name="token" type="hidden" value="<?php  echo $_W['token'];?>"/>
                  &nbsp;
                    <input type="submit" name="plsms" value="批量发送注册码" class="btn btn-primary btn-sm">
                    <input type="submit" name="plcode" value="批量重置注册码" class="btn btn-primary btn-sm">
                    <a class="btn btn-default btn-sm" href="javascript:;" data-toggle="modal" data-target="#room"><i
                            class='glyphicon glyphicon-plus'></i>添加房号</a>

                    </button>
                    <span style="color: red">总人数:<?php  echo $total;?>人</span>
                </td>
            </tr>
        </table>

    </div>
</div>
    <?php  echo $pager;?>
</form>

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
            <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data"
                  onsubmit="return check(this);">
                <div class="panel panel-default" >
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
                    <div id="content"></div>



                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                            <button type="submit" class="btn btn-primary span1" name="submit" value="提交">提交</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $("#xqregionid").change(function () {
        var regionid = $("#xqregionid option:selected").val();
        if (regionid != '0') {
            $.post("<?php  echo $this->createWebUrl('member',array('op' => 'region'))?>", {regionid:regionid}, function (data) {
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

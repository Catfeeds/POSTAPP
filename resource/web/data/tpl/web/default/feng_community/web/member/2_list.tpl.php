<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('member', array('op' => 'list'));?>">用户管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('member', array('op' => 'bind'));?>">房号管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('member',array('op'=> 'room'));?>">房号导入</a></li>
    <li><a href="<?php  echo $this->createWebUrl('member',array('op'=> 'visit'));?>">游客</a></li>

    <li><a href="<?php  echo $this->createWebUrl('member',array('op'=> 'lsroom'));?>">v8历史房号</a></li>
</ul>

<div class="panel panel-info">
    <div class="panel-body">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>微信开门说明</p>
            <p>如需授权业主使用微信开门权限，请点击下方是否开门状态开启。</p>
        </div>
    </div>
    <div class="panel-heading">筛选</div>

    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="feng_community" />
            <input type="hidden" name="do" value="member" />
            <input type="hidden" name="op" value="list" />
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">业主姓名</label>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                    <input type="text" name="realname" value="<?php  echo $_GPC['realname'];?>" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 control-label">业主手机</label>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-3">
                    <input type="text" name="mobile" value="<?php  echo $_GPC['mobile'];?>" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">选择小区</label>
                <div class="col-sm-10">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="checkAll" name="checkAll" data-group="regionid">全部
                    </label>
                    <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="regionid" value="<?php  echo $region['id'];?>" name='regionid[]' data-group="regionid" <?php  if(@in_array($region['id'], $_GPC['regionid'])) { ?>checked='checked' <?php  } ?>><?php  echo $region['title'];?>
                    </label>
                    <?php  } } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                <div class="col-sm-7 col-lg-9 col-xs-12">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    <button type="submit" name="export" value="1" class="btn btn-primary">导出 Excel</button>
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
                <th style="width: 20px;"></th>
                <th class="col-md-1">小区</th>
                <th class="col-md-1">粉丝编号</th>
                <th class="col-md-1">姓名</th>
                <th class="col-md-1">手机</th>
                <th class="col-md-2">注册时间</th>
                <th class="col-md-1">状态</th>
                <th class="col-md-1">开门</th>
                <th class="col-md-1">备注</th>
                <th class="col-sm-6">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <tr>
                <td><input type="checkbox" id="ids" name="ids[]" value="<?php  echo $item['id'];?>"></td>
                <td><?php  echo $item['title'];?></td>
                <td><?php  echo $item['openid'];?></td>
                <td><?php  echo $item['realname'];?></td>
                <td><?php  echo substr_replace($item['mobile'],'****',3,4)?></td>
                <td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
                <td>
                    <label data="<?php  echo $item['status'];?>" class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' onclick="verify(this,<?php  echo $item['id'];?>,'status')"><?php  if($item['status']==1) { ?>通过<?php  } else { ?>禁止<?php  } ?></label>
                </td>
                <td>
                    <label data="<?php  echo $item['open_status'];?>" class='label  label-default <?php  if($item['open_status']==1) { ?>label-info<?php  } ?>' onclick="verify(this,<?php  echo $item['id'];?>,'open_status')"><?php  if($item['open_status']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></label>
                </td>
                <td><?php  echo cutstr(htmlspecialchars_decode($item['remark']), 10, true)?></td>
                <td>
                    <a href="<?php  echo $this->createWebUrl('member', array('op'=>'bind', 'regionid' => $item['regionid'],'memberid' => $item['id']));?>" class="btn btn-info btn-sm">查看房号</a>
                    <a class="btn btn-success btn-sm" data-id= "<?php  echo $item['uid'];?>" onclick="xqverify(this)" href="#">授权开门</a>
                    <a href="<?php  echo $this->createWebUrl('member', array('op'=>'delete', 'id' => $item['id']));?>" class="btn btn-default btn-sm" onClick="return confirm('确定删除?');"><i class="fa fa-times"></i>删除</a>

                </td>
            </tr>
            <?php  } } ?>
            </tbody>
        </table>

        <table class="table table-hover">
            <tr>
                <td width="30">
                    <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
                </td>
                <td class="text-left">
                    <a class="btn btn-primary btn-sm"href="javascript:;" data-toggle="modal" data-target="#notice" >批量微信推送</a>
                    <button type="submit" name="plmember" value="1" class="btn btn-info btn-sm">一键审核用户状态</button>
                    <button type="submit" name="plopen" value="1" class="btn btn-warning btn-sm">一键审核用户开门</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />

                    <span style="color: red">总人数:<?php  echo $total;?>人</span>
                </td>
            </tr>
        </table>
    </div>
</div>
    <?php  echo $pager;?>

<div class="modal fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close xq1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>
                    <h4 class="modal-title">
                        发布通知
                    </h4>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" class="form-control" placeHolder="尽量简短，15个字以内" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">内容</label>
                            <div class="col-sm-10">
                                <?php  echo tpl_ueditor('reason');?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary span3" name="plwechat" value="提交">提交</button>
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
</form>
    <div style="position: fixed;
    top: -500px;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    display: none;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    outline: 0;" id="show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close xq1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" id="xqh">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        授权绑定开门
                    </h4>
                    <div>
                        <span style="color:red">注意：1.如果需要绑定多个门,需要去选择多次小区绑定</span>
                        <span style="color:blue">2.采用授权绑定开门，需要在《小区管理》->《小区设置》启用授权验证开门</span>
                    </div>
                </div>
                <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
                    <input type='hidden' name='uid' id='uid' class="form-control"  />
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="regionid" class="col-sm-2 control-label">选择小区</label>
                                <div class="col-xs-10">
                                    <select class="form-control" name="regionid" id="xqregionid">
                                        <option value="0">请选择绑定小区</option>
                                        <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                        <option value="<?php  echo $region['id'];?>" ><?php  echo $region['title'];?></option>
                                        <?php  } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="display: none" id="device">
                                <label for="regionid" class="col-sm-2 control-label">绑定门禁</label>
                                <div class="col-xs-10" id="deviceid">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary span3" name="update" value="提交">提交</button>
                                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function verify(obj, id, type) {
        $(obj).html($(obj).html() + "...");
        $.post("<?php  echo $this->createWebUrl('member',array('op' => 'verify'))?>", {
            id: id,
            type: type,
            data: obj.getAttribute("data")
        }, function(d) {
            $(obj).html($(obj).html().replace("...", ""));
            if (type == 'status') {
                $(obj).html(d.data == '1' ? '通过' : '禁止');
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
    $(function() {
        $("#checkAll").click(function() {

            var checked = $(this).get(0).checked;
            var group = $(this).data('group');
            $("#regionid[data-group='" + group + "']").each(function() {
                $(this).get(0).checked = checked;
            })


    });
    $("#xqh").click(function () {
        $("#show").hide();
    })
    $("#xqregionid").change(function () {
        var regionid = $("#xqregionid option:selected").val();
        var uid = $("#uid").val();
        if (regionid != '0') {
            $.post("<?php  echo $this->createWebUrl('member',array('op' => 'binddoor'))?>", {regionid:regionid,uid:uid}, function (data) {
                if(data.status == 1 || data.status == 3){
                    alert(data.content);
                    $("#device").hide();
                    return false;
                }
                if(data.status == 2){
                    var result = data.result;
                    var content ="<label class='checkbox-inline'><input type='checkbox' id='xqcheckAll' name='xqcheckAll' data-group='deviceid'>全部 </label>";
                    $.each(data.content,function(name,val) {
                        content +="<label class='checkbox-inline'>";
                        content +="<input type='checkbox' value='"+val.id+"' name='deviceid[]' data-group ='deviceid' id='deviceid' "+val.check+">"+val.title+val.unit;
                        content +="</label>";
                    });


                        $("#deviceid").html(content);
                        $("#xqcheckAll").click(function() {
                            var checked = $(this).get(0).checked;
                            var group = $(this).data('group');
                            $("#deviceid[data-group='" +group + "']").each(function(){
                                $(this).get(0).checked = checked;
                            })
                        });
                        $("#device").show();
                    }

                },'json');
            }
        })

    });
    function xqverify(obj){
        $("#uid").val(obj.getAttribute("data-id"));
        $("#show").show();
    }

</script>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<style>
    td .rowspan:first-child {
        border-top: 0;
    }

    td .rowspan {
        padding: 10px;
        border-top: 1px solid #f0f0f0;
        min-height: 41px;
        white-space: nowrap;
    }
</style>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>车辆管理</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="">
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-primary">
                                <i class="fa fa-plus"></i>添加车辆</a>
                            <input type="submit" name="del" class="btn btn-danger" value="批量删除车辆">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                        </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="30px;">
                                        <div class="checkbox checkbox-success checkbox-inline">
                                            <input type="checkbox" id="checkids" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});">
                                            <label for="checkids"> </label>
                                        </div>
                                    </th>
                                    <th>车辆编号</th>
                                    <th>所属小区</th>
                                    <th>车位号</th>
                                    <th>车主姓名</th>
                                    <th>车主手机</th>
                                    <th>车牌号码</th>
                                    <th>操作</th>
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
                                        <td><?php  echo $item['place_num'];?></td>
                                        <td><?php  echo $item['realname'];?></td>
                                        <td>
                                            <?php  echo $item['mobile'];?>
                                        </td>
                                        <td><?php  echo $item['car_num'];?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('xqcar',array('op' => 'bind','id' => $item['id']))?>">绑定住户</a>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('xqcar',array('op' => 'add','id' => $item['id']))?>">修改信息</a>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('xqcar',array('op' => 'del','id' => $item['id']))?>">删除信息</a>
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
        </form>

    </div>
</div>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">关闭</span>
                </button>

                <h4 class="modal-title">添加车辆</h4>

            </div>
            <form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">小区:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="regionid" id="regionid">
                                <option>全部小区</option>
                                <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                <option value="<?php  echo $region['id'];?>" ><?php  echo $region['title'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">车位号:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="parkingid" id="parkingid">
                                <option>全部车位</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">车主姓名:</label>
                        <div class="col-sm-10">
                            <input type="text" name="realname" class="form-control"  />
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">车主手机:</label>
                        <div class="col-sm-10">
                            <input type="text" name="mobile" class="form-control"  />
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">车牌号码:</label>
                        <div class="col-sm-10">
                            <input type="text" name="car_num" class="form-control"  />
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <input type="submit" class="btn btn-primary"  name="add" value="保存">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        $("#regionid").change(function () {
            var regionid = $("#regionid option:selected").val();
            if (regionid != '0') {
                $.post("<?php  echo $this->createWebUrl('xqcar',array('op' => 'park'))?>", {
                    regionid: regionid,
                }, function (data) {
                    if(data){
                       var content;
                        $.each(data, function (name, val) {
                            content += "<option value='"+val.id+"'>"+val.place_num+"</option>";
                        });
                        $("#parkingid").html(content);
                    }

                }, 'json');
            }
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

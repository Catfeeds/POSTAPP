<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('member', array('op' => 'list'));?>">业主管理</a></li>
    <li class="active"><a href="<?php  echo $this->createWebUrl('member',array('op'=> 'visit'));?>">游客</a></li>
    <li><a href="<?php  echo $this->createWebUrl('member', array('op' => 'bind'));?>">房号管理</a></li>
    <li><a href="<?php  echo $this->createWebUrl('member',array('op'=> 'room'));?>">房号导入</a></li>
</ul>

<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="feng_community" />
            <input type="hidden" name="do" value="member" />
            <input type="hidden" name="op" value="visit" />
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
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="navbar-inner">
        <tr>
            <th class="col-sm-1">ID</th>
            <th class="col-sm-2">小区名称</th>
            <th>昵称</th>
            <th class="col-sm-2">注册时间</th>
            <th >状态</th>
            <th class="col-sm-2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr>
            <td><?php  echo $item['id'];?></td>
            <td><?php  echo $item['title'];?></td>
            <td><?php  echo $item['nickname'];?></td>
            <td><?php  echo date('Y-m-d H:i',$item['createtime'])?></td>
            <td>
                <label data="<?php  echo $item['status'];?>" class='label  label-default <?php  if($item['status']==1) { ?>label-info<?php  } ?>' onclick="verify(this,<?php  echo $item['id'];?>,'status')"><?php  if($item['status']==1) { ?>通过<?php  } else { ?>禁止<?php  } ?></label>
            </td>
            <td>
                <a href="<?php  echo $this->createWebUrl('member', array('op'=>'delete', 'id' => $item['id']));?>" class="btn btn-default btn-sm"><i class="fa fa-times"></i>删除</a>
            </td>
        </tr>
        <?php  } } ?>
        </tbody>
    </table>
    <?php  echo $pager;?>
    <table class="table table-hover">
        <tr>
            <td width="60">
                总数：
            </td>
            <td class="text-left" style="color: red">
                <?php  echo $total;?>
            </td>
        </tr>
    </table>
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
    });
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($operation=='list' && $status=='' ) { ?>class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order','operation' => 'list'))?>">全部订单</a></li>
    <li <?php  if($operation=='list' && $status=='1') { ?> class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order','operation' => 'list', 'status' => 1))?>">待发货</a></li>
    <li <?php  if($operation=='list' && $status=='0' ) { ?>class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order', 'operation' => 'list','status' => 0))?>">待付款</a></li>
    <li <?php  if($operation=='list' && $status=='2' ) { ?>class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order', 'operation' => 'list','status' => 2))?>">待收货</a></li>
    <li <?php  if($operation=='list' && $status=='3' ) { ?>class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order', 'operation' => 'list','status' => 3))?>">已完成</a></li>
    <li <?php  if($operation=='list' && $status=='-1' ) { ?>class="active" <?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order','operation' => 'list', 'status' => -1))?>">已关闭</a></li>
    <?php  if($operation == 'detail') { ?>
    <li class="active"><a href="#">订单详情</a></li> <?php  } ?>
</ul>
<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="" method="post" class="form-horizontal" role="form" id="form1">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">订单号</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="可查询订单号">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-2 control-label">用户信息</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <input class="form-control" name="member" id="" type="text" value="<?php  echo $_GPC['member'];?>" placeholder="可查询手机号 / 姓名">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">支付方式</label>
                    <div class="col-sm-8 col-lg-9 col-xs-12">
                        <select name="paytype" class="form-control">
                            <option value="">不限</option>
                            <?php  if(is_array($paytype)) { foreach($paytype as $key => $type) { ?>
                            <option value="<?php  echo $key;?>" <?php  if($_GPC['paytype']==$key) { ?> selected="selected" <?php  } ?>><?php  echo $type['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">下单时间</label>
                    <div class="col-sm-7 col-lg-9 col-xs-12">
                        <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d', $starttime),'endtime'=>date('Y-m-d', $endtime)));?>
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
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <form class="form-horizontal form" method="post" >
            <table class="table table-hover">
                <thead class="navbar-inner">
                    <tr>
                        <th>删?</th>
                        <th class="col-sm-2">订单号</th>
                        <th>收货姓名</th>
                        <th>电话</th>
                        <th>支付方式</th>
                        <th>总价</th>
                        <th>状态</th>
                        <th  class="col-sm-2">下单时间</th>
                        <th class="col-sm-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" value="<?php  echo $item['id'];?>">
                        </td>
                        <td><?php  echo $item['ordersn'];?></td>
                        <td><?php  if(empty($item['realname'])) { ?><?php  echo $item['address_realname'];?><?php  } else { ?><?php  echo $item['realname'];?><?php  } ?></td>
                        <td><?php  if(empty($item['mobile'])) { ?><?php  echo $item['address_telephone'];?><?php  } else { ?><?php  echo $item['mobile'];?><?php  } ?></td>
                        <td><span class="label label-<?php  echo $item['css'];?>"><?php  echo $item['paytype'];?></span></td>
                        <td><?php  echo $item['price'];?> 元</td>
                        <td>
                            <span class="label label-<?php  echo $item['statuscss'];?>"><?php  echo $item['status'];?></span></td>
                        <td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
                        <td style="text-align:right;">
                            <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order','operation' => 'detail', 'id' => $item['id']))?>" class="btn btn-success btn-sm">查看订单</a>
                            <?php  if(!$user) { ?>
                            <a href="<?php  echo $this->createWebUrl('shopping', array('op' => 'order','id' => $item['id'], 'operation' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times">删除</i>
							</a>
                            <?php  } ?>
                        </td>
                    </tr>
                    <?php  } } ?>
                </tbody>
                <!--tr>
					<td></td>
					<td colspan="3">
						<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
						<input type="submit" class="btn btn-primary" name="submit" value="提交" />
					</td>
				</tr-->
            </table>
            <table class="table table-hover">
                <tr>
                    <td width="30">
                        <input type="checkbox" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" />
                    </td>
                    <td class="text-left">
                        <input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
                        <input type="submit" class="btn btn-primary span2" name="delete" value="批量删除" /> &nbsp;
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php  echo $pager;?>
<script type="text/javascript">
require(['daterangepicker'], function($) {
    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
        $('#form1')[0].submit();
    });
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

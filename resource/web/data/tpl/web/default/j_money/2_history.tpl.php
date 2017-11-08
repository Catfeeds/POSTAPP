<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?> 
<script language="javascript" src="../addons/j_money/template/js/highcharts.js"></script> 
<script language="javascript" src="../addons/j_money/template/js/bootstrap-tooltip.js"></script> 
<script language="javascript" src="../addons/j_money/template/js/bootstrap-popover.js"></script> 
<script>
$(function () {
  $('[data-toggle="popover"]').popover();
})
</script>
<ul class="nav nav-tabs">
  <li><a href="./index.php?c=home&a=welcome&do=ext&m=j_money">返回收银台</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('history', array('op'=>'display','shopid'=>$shopid))?>">收银记录</a></li>
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('history', array('op'=>'post','shopid'=>$shopid))?>">核对账目</a></li>
  <li><a href="<?php  echo $this->createWebUrl('history', array('op' => 'update'))?>">同步旧数据</a></li>
</ul>
<script>
require(['bootstrap'],function($){
	$('.btn,.tips').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script> 
<?php  if($operation == 'post') { ?>
<div class="main">
  <div class="category">
    <form action="" class="form-horizontal form">
      <input type="hidden" name="c" value="site" />
      <input type="hidden" name="a" value="entry" />
      <input type="hidden" name="m" value="j_money" />
      <input type="hidden" name="do" value="history" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
      <div class="panel panel-info">
      <div class="panel-heading"><?php  echo $shop['companyname'];?>总记录</div>
      <div class="panel-body table-responsive">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
          <div class="col-sm-9 form-inline">
            <div class="input-group"> 
              <span class="input-group-addon">筛选</span> <span class="input-group-btn">
              <select name="shopid" id="shopid"  class="form-control" onChange="changeGroup(1)">
                <option value="0">全部团队</option>
                  <?php  if(is_array($grouplist)) { foreach($grouplist as $row) { ?>
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$_GPC['shopid']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                  <?php  } } ?>
              </select>
              </span>
              <span class="input-group-btn">
              <input type="text" name="date" value="2016-12-28" placeholder="请选择日期时间" readonly="readonly" class="datetimepicker form-control" style="padding-left:12px;">
              </span>
            </div>
          </div>
           </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9 form-inline">
              <input type="submit" class="btn btn-danger" onClick="$('#isexplode').val(1)" name="explode" value="导出数据"/>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:140px;">单号</th>
                <th>订单金额</th>
                <th>实际支付</th>
                <th>扣点</th>
                <th>结算</th>
                <th>状态</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td>
                <p><span class="label label-success"><?php  echo $row['out_trade_no'];?></span></p>
                <span class="label label-info"><?php  echo date("m-d H:i",$row['createtime'])?></span>
                </td>
              <td>￥<?php  echo sprintf('%.2f',($row['total_fee']/100))?></td>
              <td>￥<?php  echo sprintf('%.2f',($row['cash_fee']/100))?></td>
              <td><p><span class="label label-success"><?php  echo sprintf('%.2f',($row['rate']))?>%</span> </p>
              <span class="label label-danger">￥<?php  echo sprintf('%.2f',($row['poundage']))?></span></td>
              <td><span class="label label-danger">￥<?php  echo sprintf('%.2f',($row['cash_fee']-$row['poundage'*100])*0.01)?></span></td>
              <td>
              <img src="<?php echo MODULE_URL;?>template/img/wechart.gif" width="21"/> 
              <?php  if($row['status']==1) { ?> <span class="label label-success"><i class="fa fa-check"/></i></span>
              <?php  } else if($row['status']==2) { ?><span class="label label-danger" data-toggle="popover" data-placement="top" data-content="已退款"><i class="fa fa-recycle"/></i></span>
              <?php  } else { ?><span class="label label-danger" data-toggle="popover" data-placement="top" data-content="<?php  echo $row['log'];?>"><i class="fa fa-times"/></i></span><?php  } ?> </td>
            </tr>
            <?php  } } ?>
            <tr>
            <tr>
              <td colspan="6" style="text-align:center"><?php  echo $pager;?></td>
            </tr>
           </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
require(["datetimepicker"], function(){
	$(function(){
			var option = {
				lang : "zh",
				format: 'yyyy-mm',
				autoclose: true,
				todayBtn: true,
				startView: 'year',
				minView:'year',
				maxView:'decade'
			};
		$(".datetimepicker[name='date']").datetimepicker(option);
	});
});
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" class="form-horizontal form">
      <input type="hidden" name="c" value="site" />
      <input type="hidden" name="a" value="entry" />
      <input type="hidden" name="m" value="j_money" />
      <input type="hidden" name="do" value="history" />
      <input type="hidden" name="isexplode" id="isexplode" value="0" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
      <div class="panel panel-info">
      <div class="panel-heading"><?php  if($_GPC['userid']) { ?>收银员：<b><?php  echo $userList[$_GPC['userid']]?></b>的收银记录<?php  } else { ?>总记录<?php  } ?></div>
      <div class="panel-body table-responsive">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
          <div class="col-sm-9 form-inline">
            <div class="input-group"> <span class="input-group-addon">关键字</span>
              <input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>" />
              </div>
          </div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9 form-inline">
              <div class="input-group"> 
                <span class="input-group-addon">筛选</span> <span class="input-group-btn">
                <select name="shopid" id="shopid"  class="form-control" onChange="changeGroup(1)">
                  <option value="0">全部团队</option>
                    <?php  if(is_array($grouplist)) { foreach($grouplist as $row) { ?>
                  <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$_GPC['shopid']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                    <?php  } } ?>
                </select>
                </span>
                <span class="input-group-btn">
                <select name="userid" id="userid" class="form-control" onChange="changeGroup(2)">
                  <option value="0">全部人员</option>
                    <?php  if(is_array($userList)) { foreach($userList as $id => $val) { ?>
                  <option value="<?php  echo $id;?>" <?php  if($id==$_GPC['userid']) { ?>selected<?php  } ?>><?php  echo $val;?></option>
                    <?php  } } ?>
                </select>
                </span> 
                <span class="input-group-btn">
                
                <?php  echo tpl_form_field_daterange('gametime', array('start' =>$starttime,'end'=>$endtime),true)?>
                </span>
              </div>
              
            </div>
            </div>
             <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
              <div class="col-sm-9 form-inline">
                <div class="input-group"> 
                <span class="input-group-addon">筛选</span> <span class="input-group-btn">
                <select name="paytype" class="form-control">
                  <option value="-1">支付方式</option>
                  <option value="1" <?php  if(1==$_GPC['paytype']) { ?>selected<?php  } ?>>微信</option>
                  <option value="2" <?php  if(2==$_GPC['paytype']) { ?>selected<?php  } ?>>支付宝</option>
                  <option value="3" <?php  if(3==$_GPC['paytype']) { ?>selected<?php  } ?>>现金</option>
                  <option value="4" <?php  if(4==$_GPC['paytype']) { ?>selected<?php  } ?>>银行卡</option>
                  <option value="5" <?php  if(5==$_GPC['paytype']) { ?>selected<?php  } ?>>会员卡</option>
                  
                </select>
                </span>
                <span class="input-group-btn">
                <select name="status" class="form-control">
                  <option value="-1">状态</option>
                  <option value="2" <?php  if(2==$_GPC['status']) { ?>selected<?php  } ?>>成功</option>
                  <option value="1" <?php  if(1==$_GPC['status']) { ?>selected<?php  } ?>>失败</option>
                  <option value="3" <?php  if(3==$_GPC['status']) { ?>selected<?php  } ?>>退款</option>
                </select>
                </span> 
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
              <div class="col-sm-9 form-inline">
                <input type="submit" class="btn btn-danger" onClick="$('#isexplode').val(1)" name="explode" value="导出数据"/>
                <input type="submit" class="btn btn-info" value="搜索记录"/>
              </div>
            </div>
          
          <table class="table table-hover">
            <thead>
              <tr>
                <th>类型</th>
                <th>总金额</th>
                <th>优惠金额</th>
                <th>实收金额</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>微信</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['wechart']['all']/100))?>元 | <?php  echo $payAry['wechart']['all-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['wechart']['coupon']/100))?>元 | <?php  echo $payAry['wechart']['coupon-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['wechart']['cash_fee']/100))?>元 | <?php  echo $payAry['wechart']['cash_fee-count']?>笔</td>
              </tr>
              <tr>
                <td>支付宝</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['alipay']['all']/100))?>元 | <?php  echo $payAry['alipay']['all-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['alipay']['coupon']/100))?>元 | <?php  echo $payAry['alipay']['coupon-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['alipay']['cash_fee']/100))?>元 | <?php  echo $payAry['alipay']['cash_fee-count']?>笔</td>
              </tr>
              <tr>
                <td><strong>合计</strong></td>
                <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['all']+$payAry['wechart']['all'])/100))?>元 | <?php  echo $payAry['alipay']['all-count']+$payAry['wechart']['all-count']?>笔</td>
                <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['coupon']+$payAry['wechart']['coupon'])/100))?>元 | <?php  echo $payAry['alipay']['coupon-count']+$payAry['wechart']['coupon-count']?>笔</td>
                <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['cash_fee']+$payAry['wechart']['cash_fee'])/100))?>元 | <?php  echo $payAry['alipay']['cash_fee-count']+$payAry['wechart']['cash_fee-count']?>笔</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:140px;">单号</th>
				 <th>店铺</th>
                <th>收银员</th>
                <th>订单金额</th>
                <th>优惠金额</th>
                <th>需付金额</th>
				
				<th>手续费 </th>
                
				<th>实际支付</th>
                <th>支付方式</th>
                <th>优惠方案</th>
                <th>状态|打印</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td><?php  if($row['old_trade_no']) { ?><p><span class="label label-info" style="margin-bottom:2px;">原:<?php  echo $row['old_trade_no'];?></span></p><?php  } ?> 
                <p><span class="label label-success"><?php  echo $row['out_trade_no'];?></span></p>
                <span class="label label-info"><?php  echo date("m-d H:i",$row['createtime'])?></span>
                </td>
			  <td>
			  	<?php  echo $groupids[$row['groupid']];?>
			  </td>	
				
              <td><?php echo $userList[$row['userid']] ? $userList[$row['userid']] : $row["attach"]?></td>
              <td>￥<?php  echo sprintf('%.2f',($row['order_fee']/100))?>
						<?php  if(!empty($row['servertype'])) { ?>
					<br><?php  echo $row['servertype'];?>
				<?php  } ?>
				<?php  if(!empty($row['carnumber'])) { ?>
					<br>车牌号：<?php  echo $row['carnumber'];?>
				<?php  } ?>
				<?php  if(!empty($row['userbak'])) { ?>
					<br>备注：<?php  echo $row['userbak'];?>
				<?php  } ?>
				<?php  if($row['servermoney']>0) { ?>
					<br>服务费：￥<?php  echo $row['servermoney']/100?>
				<?php  } ?>

			  
			  </td>
              <td>￥<?php  echo sprintf('%.2f',($row['coupon_fee']/100))?></td>
              <td><span class="label label-success">￥<?php  echo sprintf('%.2f',($row['total_fee']/100))?></span></td>
			
				<td><span class="label label-success">￥<?php  echo sprintf('%.2f',($row['servermoney']/100))?></span></td>
              
			  
              <td><span class="label label-danger">￥<?php  echo sprintf('%.2f',($row['cash_fee']/100))?></span></td>
              <td><?php  if($row['attach']=='-' || $row['attach']=='PC') { ?><span class="label label-info"><i class="fa fa-desktop"/></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-mobile"/></i></span><?php  } ?>
              
              <?php  if($row['paytype']==0) { ?><img src="<?php echo MODULE_URL;?>template/img/wechart.gif" width="21"/> <?php  echo $data[$row['bank_type']]?><?php  } else if($row['paytype']==1) { ?> <img src="<?php echo MODULE_URL;?>template/img/alipay.gif" width="21"/><?php  echo $data[$row['bank_type']]?><?php  } else if($row['paytype']==2) { ?><img src="<?php echo MODULE_URL;?>template/img/pay_2.png" width="21"/><?php  } else if($row['paytype']==3) { ?><img src="<?php echo MODULE_URL;?>template/img/pay_3.png" width="21"/><?php  } else if($row['paytype']==4) { ?><img src="<?php echo MODULE_URL;?>template/img/menbercard.gif" width="21"/><?php  } ?></td>
              <td><?php  echo $row['marketing_log'];?></td>
              <td>
              <?php  if($row['status']==1) { ?> <span class="label label-success"><i class="fa fa-check"/></i></span> <?php  if($row['isprint']>0) { ?><a class="tips" href="javascript:" data-toggle="tooltip" data-placement="bottom" title="已打印<?php  echo $row['isprint'];?>份"><i class="fa fa-print"/></i></a><?php  } else { ?><a class="tips" href="javascript:" data-toggle="tooltip" data-placement="bottom" title="未打印" style="color:#F00"><i class="fa fa-print"/></i></a><?php  } ?>
              <?php  } else if($row['status']==2) { ?><span class="label label-danger" data-toggle="popover" data-placement="top" data-content="已退款"><i class="fa fa-recycle"/></i></span>
              <?php  } else { ?><span class="label label-danger" data-toggle="popover" data-placement="top" data-content="<?php  echo $row['log'];?>"><i class="fa fa-times"/></i></span><?php  } ?> </td>
              <td style="text-align:right"> <?php  if($row['log']) { ?><span class="label label-danger" data-toggle="popover" data-placement="left" data-content="<?php  echo $row['log'];?>"><i class="fa fa-exclamation-circle"/></i></span><?php  } ?>
                <a href="javascript:recheckpay(<?php  echo $row['paytype'];?>,<?php  echo $row['id'];?>)"  class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="重新获取订单"><i class="fa fa-refresh"></i></a>
                <?php  if($row['status']==0) { ?><a href="javascript:checkpay(<?php  echo $row['paytype'];?>,<?php  echo $row['id'];?>)"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a> <?php  } ?></td>
            </tr>
            <?php  } } ?>
            <tr>
            <tr>
              <td colspan="9" style="text-align:center"><?php  echo $pager;?></td>
            </tr>
           </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } ?> 
<script language="javascript">
function changeGroup(id){
	if(id==1){
		$("#userid").find("option[value='0']").prop("selected",true);
	}else{
		$("#shopid").find("option[value='0']").prop("selected",true);
	}
}
function recheckpay(paytype,id){
	if(paytype>1){
		alert("只有微信/支付宝的订单需要二次查询");
		return;
	}
	var url="<?php  echo $this->createWebUrl('wajax',array('op'=>'cheackwechatpay'))?>";
	if(paytype)url="<?php  echo $this->createWebUrl('wajax',array('op'=>'cheackalipay'))?>";
	$.post(url,{"id":id},function(datas){
		console.log(datas);
		var data=eval("("+datas+")");
		if(data.success){
			alert("收款成功");
			location.reload();
		}else{
			alert(data.msg);
		}
	});
}
function checkpay(paytype,id){
	if(paytype>1){
		alert("只有微信/支付宝的订单需要二次查询");
		return;
	}
	var url="<?php  echo $this->createWebUrl('wajax',array('op'=>'cheackwechatpay'))?>";
	if(paytype)url="<?php  echo $this->createWebUrl('wajax',array('op'=>'cheackalipay'))?>";
	$.post(url,{"id":id},function(data){
		if(data.success){
			location.reload();
		}else{
			location.href="<?php  echo $this->createWebUrl('history', array('op' => 'delete'))?>&id="+id;
		}
	},'json');
}
</script> 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('function', array('op' => 'post'))?>">添加活动</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('function', array('op' => 'display'))?>">管理活动</a></li>
  <?php  if($operation == 'statistical') { ?><li class="active"><a href="#">营销统计</a></li><?php  } ?>
</ul>
<script>
require(['bootstrap'],function($){
	$('.btn').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script> 
<?php  if($operation == 'post') { ?>
<style>
#showConditionbox{ display:block; margin-top:15px;}
</style>
<div class="main">
  <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $id?>" />
    <div class="panel panel-default">
      <div class="panel-heading"> 管理 </div>
      <div class="panel-body">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">营销活动名称</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" />
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">优先级别</label>
          <div class="col-sm-9 col-xs-12 form-inline">
            <input type="text" name="displayorder" class="form-control" value="<?php  echo intval($item['displayorder'])?>" />
            <div class="help-block">数字越小，拍得越前。0为最高级别。如果优先级别相同，则后添加的优先</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
          <div class="col-sm-9">
            <label class="radio-inline">
              <input type="radio" name="status" value="0" <?php  if($item['status'] == 0) { ?> checked<?php  } ?> />
              关闭</label>
            <label class="radio-inline">
              <input type="radio" name="status" value="1"  <?php  if($item['status'] == 1) { ?> checked<?php  } ?> />
              开启</label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属店铺</label>
          <div class="col-sm-9 form-inline">
            <select name="groupid" required class="form-control">
              <option value="0" >请选择店铺</option>
              <?php  if(is_array($group)) { foreach($group as $row) { ?>
              <option value="<?php  echo $row['id'];?>" <?php  if($item['groupid']==$row['id']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
              <?php  } } ?>
            </select>
            <div class="help-block">提交后不可修改</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动类型</label>
          <div class="col-sm-9 col-xs-12 form-inline">
            <div class="input-group"> <span class="input-group-addon">消费满</span>
              <input type="text" class="form-control" name="condition_fee" placeholder="输入金额" value="<?php  echo sprintf('%.2f',($item['condition_fee']/100))?>">
              <span class="input-group-addon">元时，</span>
              <div class="input-group-btn">
                <select name="favorabletype" class="form-control" onchange="showGamebox(this)" <?php  if($id) { ?>disabled<?php  } ?>>
                  <option value="1" <?php  if($item['favorabletype']==1) { ?>selected<?php  } ?>>减少</option>
                  <option value="2" <?php  if($item['favorabletype']==2) { ?>selected<?php  } ?>>返红包(微)</option>
                  <option value="3" <?php  if($item['favorabletype']==3) { ?>selected<?php  } ?>>返卡券(微)</option>
                  <option value="4" <?php  if($item['favorabletype']==4) { ?>selected<?php  } ?>>获得抽奖(微)</option>
                </select>
              </div>
              <input type="text" class="form-control" name="favorable" value="<?php  echo $item['favorable']?>">
            </div>
            <label class="radio-inline"><input type="checkbox" name="isint" value="1" <?php  if($item['isint'] == 1) { ?> checked<?php  } ?> />
              金额抹零</label>
            <div class="help-block">提交后不可更改。优惠方式，请查看下面的【优惠标签说明】</div>
            <div class="help-block">
            【金额抹零】是用于满减时，随机得出的金额如1.22，变化成1。四舍五入。
            </div>
            <div class="help-block wxcard"> <?php  $wxcard=json_decode($cfg['wxcard'],true)?>
              <?php  if(count($wxcard)) { ?>
              可用卡券：
              <?php  if(is_array($wxcard)) { foreach($wxcard as $index => $row) { ?>
              <?php  echo $index;?>,
              <?php  } } ?>
              <?php  } else { ?>
              暂无卡券哦，请到【参数设置】中添加卡券
              <?php  } ?> </div>
          </div>
        </div>
        <div class="form-group" id="gamebox" <?php  if($item['favorabletype']!=4) { ?>style="display:none;"<?php  } ?>>
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">绑定游戏</label>
            <div class="col-sm-9 form-inline">
              <select name="gid" class="form-control">
              	<?php  if(is_array($gamelist)) { foreach($gamelist as $row) { ?>
              	<option value="<?php  echo $row['id'];?>" <?php  if($item['gid']==$row['id']) { ?>selected<?php  } ?>><?php  echo $row['title'];?></option>
                <?php  } } ?>
              </select>
              <div class="help-block">设置0为不限制人数</div>
            </div>
          </div>
          
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动时间段</label>
          <div class="col-sm-9"> <?php  echo tpl_form_field_daterange('gametime', array('start' => date('Y-m-d H:i', $item['starttime']),'end'=>date('Y-m-d H:i', $item['endtime'])),true)?> </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">优惠时段</label>
          <div class="col-sm-9">
            <label class="radio-inline">
              <input type="checkbox" name="allhour" onclick="hourSelect(this)" value="0" <?php  if(!$reply['hour']) { ?>checked<?php  } ?> />
              全天</label>
            <?php  $hour=explode(',',$item['hour']);?>
            <?php  if(is_array($hourlist)) { foreach($hourlist as $row) { ?>
            <label class="radio-inline">
              <input type="checkbox" name="hour[]" onclick="hourSelect(this)" value="<?php  echo $row;?>"  <?php  if(in_array($row,$hour)) { ?>checked<?php  } ?> />
              <?php  echo $row;?>时</label>
            <?php  } } ?>
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">参与条件</label>
          <div class="col-sm-9 form-inline">
            <select name="condition" class="form-control" onchange="selectVal(this)">
              <option value="1" <?php  if($item['condition']==1) { ?>selected<?php  } ?>>所有人均可参与</option>
              <option value="2" <?php  if($item['condition']==2) { ?>selected<?php  } ?>>指定级别会员(微)</option>
              <option value="3" <?php  if($item['condition']==3) { ?>selected<?php  } ?>>首次使用微支付(微)</option>
              <option value="4" <?php  if($item['condition']==4) { ?>selected<?php  } ?>>首次关注有礼(微-与支付无关)</option>
              <option value="5" <?php  if($item['condition']==5) { ?>selected<?php  } ?>>关注公众号时长(微)</option>
            </select>
            <div id="showConditionbox">
              <div id="condition_2" <?php  if($item['condition']!=2) { ?>style="display:none;"<?php  } ?>> 选择会员级别：
                <?php  if($item['condition']==2) { ?>
                <?php $condition_groupAry=strpos($item[condition_member],',') ? explode(',',$item[condition_member]) : array($item[condition_member])?>
                <?php  } ?>
                <?php  foreach($groupary as $index=>$row){?>
                <label class="radio-inline">
                  <input type="checkbox" name="condition_member[]" value="<?php  echo $index;?>" <?php  if(in_array($index,$condition_groupAry)) { ?>checked<?php  } ?>/>
                  <?php  echo $row;?> </label>
                <?php  }?> </div>
              <div id="condition_5" <?php  if($item['condition']!=5) { ?>style="display:none;"<?php  } ?>>
                <div class="input-group"> <span class="input-group-addon">关注满</span>
                  <input type="text" class="form-control" name="condition_attendtime" value="<?php  echo intval($item['condition_attendtime'])?>">
                  <span class="input-group-addon">天</span> </div>
              </div>
            </div>
            <div class="help-block">【指定级别会员】是微擎的会员，并非是微信的会员；【首次使用微支付】即第一次使用本系统支付；【首次关注有礼】本项是作为延伸性内容，当条件为首次关注时，上方消费金额必须为0方能生效；【关注公众号时长】已关注本公众号多长时间；</div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">人数限制</label>
            <div class="col-sm-9 form-inline">
              <div class="input-group"> <span class="input-group-addon">活动时间内</span>
                <div class="input-group-btn">
                  <select name="isallnum" class="form-control" <?php  if($id) { ?>disabled<?php  } ?>>
                    <option value="0" <?php  if($item['isallnum']==0) { ?>selected<?php  } ?>>每天前</option>
                    <option value="1" <?php  if($item['isallnum']==1) { ?>selected<?php  } ?>>一共</option>
                  </select>
                </div>
                <input type="text" class="form-control" name="num" value="<?php  echo intval($item['num'])?>">
                <span class="input-group-addon">人</span> </div>
              <div class="help-block">设置0为不限制人数</div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">优惠描述</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="description" value="<?php  echo $item['description'];?>">
              <div class="help-block">用于前台显示给收银员查看，方便收银员对客户描述优惠事宜</div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="panel-heading"> 优惠标签说明 </div>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>标签符号</th>
              <th>例子</th>
              <th>作用说明</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td rowspan="4">[|#满减#|A-B-C]</td>
              <td>例1：[|#满减#|1-2]</td>
              <td>随机减1-2元</td>
            </tr>
            <tr>
              <td>例2：[|#满减#|0-9]</td>
              <td>随机减0-9元，0即是没有优惠</td>
            </tr>
            <tr>
              <td>例3：[|#满减#|1%-2%]</td>
              <td>随机减订单金额的1%-2%</td>
            </tr>
            <tr>
              <td>例4：[|#满减#|1%-2%-30]</td>
              <td>随机减订单金额的1%-2%，上限为30元</td>
            </tr>
            <tr>
              <td rowspan="4">[|#红包#|A-B]</td>
              <td>例1：[|#红包#|1-2]</td>
              <td>返红包，随机1-2元。</td>
            </tr>
            <tr>
              <td>例2：[|#红包#|1.1-2.9]</td>
              <td>返红包，随机1.1-2.9元。</td>
            </tr>
            <tr>
              <td>例3：[|#红包#|1-1]</td>
              <td>返红包，固定1元。</td>
            </tr>
            <tr>
              <td>例4：[|#红包#|0-1]</td>
              <td>返红包，随机红包。当0时，则没有红包。</td>
            </tr>
            <tr>
              <td rowspan="2">[|#卡券#|A,B,C]</td>
              <td>例1：[|#卡券#|卡券1]</td>
              <td>返卡券，返回卡券1（参数设置中设置）</td>
            </tr>
            <tr>
              <td>例2：[|#卡券#|卡券1,卡券2]</td>
              <td>返卡券，随机返回卡券1或卡券2（参数设置中设置）</td>
            </tr>
            <tr>
              <td rowspan="2">[|#抽奖#|A]</td>
              <td>例1：[|#抽奖#|1]</td>
              <td>获得抽奖1次机会</td>
            </tr>
            <tr>
              <td>例2：[|#抽奖#|5]</td>
              <td>获得抽奖5次机会</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="form-group col-xs-12">
      <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return checkform();return false" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
  </form>
</div>
<script language="javascript">
function hourSelect(obj){
	if($(obj).val()>0){
		if(obj.checked==true)$("input[name^='allhour']").prop("checked",false);
	}else{
		if(obj.checked==true){
		   $("input[name^='hour']").prop("checked",false);
		}else{
			$("input[name^='hour']").prop("checked",true);
		}
	}	
}
function showGamebox(obj){
	var val=parseInt($(obj).val());
	if(val==4){
		$("#gamebox").show();
	}else{
		$("#gamebox").hide();
	}
}
function selectVal(obj){
	var val=parseInt($(obj).val());
	$("div[id^='condition_']").hide();
	if($("div[id='condition_"+val+"']").size())$("div[id='condition_"+val+"']").show();
}
</script> 
<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" class="form-horizontal form">
      <input type="hidden" name="c" value="site" />
      <input type="hidden" name="a" value="entry" />
      <input type="hidden" name="m" value="j_money" />
      <input type="hidden" name="do" value="function" />
      <div class="panel panel-default">
      	<div class="panel-body">
          <div class="col-sm-12 form-inline">
          	<div class="input-group">
              <span class="input-group-addon">请选择店铺</span>
              <div class="input-group-btn">
                <select name="groupid" class="form-control" <?php  if($item['groupid']) { ?>disabled<?php  } ?>>
                  <option value="0" >选择店铺</option>
                  <?php  if(is_array($grouplist)) { foreach($grouplist as $row) { ?>
                  <option value="<?php  echo $row['id'];?>" <?php  if($_GPC['groupid']==$row['id']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                  <?php  } } ?>
                </select>
              </div>
              <div class="input-group-btn"><input type="submit" class="btn btn-info" value="搜索"/></div>
          </div>
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>活动名称</th>
                <th>优惠描述</th>
                <th>活动时间</th>
                <th>人数</th>
                <th>状态</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  $i=1+$start;?>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            
            <tr>
              <td><?php  echo $i?></td>
              <td><?php  echo $row['title'];?></td>
              <td><span class="label label-info">
              <?php  if($row['favorabletype']==1) { ?>
              满减
              <?php  } else if($row['favorabletype']==2) { ?>
              红包
              <?php  } else if($row['favorabletype']==3) { ?>
              卡券
              <?php  } else if($row['favorabletype']==4) { ?>
              抽奖
              <?php  } ?>
              </span><br/><?php  echo $row['description'];?></td>
              <td><span class="label label-info"><?php  echo date("y-m-d H:i",$row['starttime'])?></span><br /><span class="label label-info"><?php  echo date("y-m-d H:i",$row['endtime'])?></span></td>
              <td><?php  echo pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE marketing=:a and status=1",array(':a'=>$row['id']))?></td>
              <td><?php  if($row['status']) { ?>
              <?php  if($row['starttime']>TIMESTAMP) { ?>
              <span class="label label-default">未生效</span>
              <?php  } else if(TIMESTAMP>$row['endtime']) { ?>
              <span class="label label-danger">已过期</span>
              <?php  } else { ?>
              <span class="label label-success">正常</span>
              <?php  } ?>
              <?php  } else { ?><span class="label label-default">关闭</span><?php  } ?></td>
              <td style="text-align:right"><a href="<?php  echo $this->createWebUrl('function',array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; <a href="<?php  echo $this->createWebUrl('function',array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a></td>
            </tr>
            <?php  $i++?>
            <?php  } } ?>
            <tr>
                </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } else if($operation == 'statistical') { ?>
<div class="main">
  <div class="category">
    <form action="" method="post" onsubmit="return formcheck(this)">
      <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>活动名称</th>
                <th>优惠描述</th>
                <th>活动时间</th>
                <th>人数</th>
                <th>状态</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
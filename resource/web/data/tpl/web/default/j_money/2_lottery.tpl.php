<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('lottery', array('op' => 'post'))?>">添加游戏</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('lottery', array('op' => 'display'))?>">管理游戏</a></li>
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
  <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $id?>" />
    <div class="panel panel-default">
      <div class="panel-heading"> 游戏管理 </div>
      <div class="panel-body"> 
       <?php  if($id) { ?>
       	<div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">游戏地址</label>
          <div class="col-sm-9">
            <p class="form-control-static"> <?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&id=<?php  echo $id?>&do=game&m=j_money</p>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">查看内容</label>
          <div class="col-sm-9">
            <p class="form-control-static"> <a href="<?php  echo $this->createWebUrl('joiner', array('id' => $id))?>" target="_blank">查看参与情况</a></p>
          </div>
        </div>
        <?php  } ?>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动标题</label>
          <div class="col-sm-9">
            <input type="text" value="<?php  echo $reply['title'];?>" class="form-control" name="title" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动状态</label>
          <div class="col-sm-9">
            <label class="radio-inline">
              <input type="radio" name="status" value="1" <?php  if($reply['status']==1) { ?> checked<?php  } ?> />
              开启</label>
            <label class="radio-inline">
              <input type="radio" name="status" value="0" <?php  if($reply['status']==0) { ?> checked<?php  } ?> />
              关闭</label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动图片</label>
          <div class="col-sm-9"> <?php  echo tpl_form_field_image('thumb', $reply['thumb']);?>
            <div class="help-block">用于单图文回复的显示</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">转发时小图</label>
          <div class="col-sm-9"><?php  echo tpl_form_field_image('clientpic', $reply['clientpic']);?>
            <div class="help-block">转发到朋友圈或者朋友时的图标</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动简介</label>
          <div class="col-sm-9">
            <textarea style="height:150px;" name="description" class="form-control" cols="60"><?php  echo $reply['description'];?></textarea>
            <div class="help-block">用于图文显示的简介和转发到朋友圈</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">转盘图片</label>
          <div class="col-sm-9"> <?php  echo tpl_form_field_image('zppic', $reply['zppic'])?>
            <div class="help-block">转盘文件，请使用PNG图片,481*482px</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">转盘指针</label>
          <div class="col-sm-9"> <?php echo tpl_form_field_image('thumb_pointer', $reply['thumb_pointer'] ? $reply['thumb_pointer'] : '../addons/j_turntable/template/image/pointer.gif')?>
            <div class="help-block">转盘指针，请使用PNG图片,481*482px</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">背景图片</label>
          <div class="col-sm-9"> <?php  echo tpl_form_field_image('thumb_bg', $reply['thumb_bg'])?>
            <div class="help-block">640*1080px</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">背景颜色</label>
          <div class="col-sm-9 form-inline"><?php  echo tpl_form_field_color("bgcolor", $reply['bgcolor'])?>
            <div class="help-block">背景颜色</div>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动时段</label>
          <div class="col-sm-9"> <?php  echo tpl_form_field_daterange('acttime', array('start' => date('Y-m-d', $reply['starttime']),'end'=> date('Y-m-d', $reply['endtime'])))?>
            <div class="help-block">新添加活动，先选“今天”，再选时间会方便选择。</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动规则</label>
          <div class="col-sm-9">
            <?php  echo tpl_ueditor('rule', $reply['rule']);?>
            <div class="help-block">活动的相关说明和活动奖品介绍。</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">引导关注链接</label>
          <div class="col-sm-9">
            <input type="text" value="<?php  echo $reply['gzurl'];?>" class="form-control" name="gzurl" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享描述</label>
          <div class="col-sm-9">
            <input type="text" value="<?php  echo $reply['sharedes'];?>" class="form-control" name="sharedes" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">抽奖项目数</label>
          <div class="col-sm-9 form-inline">
            <select onchange="SetCr()" id="selectprogress" class="form-control" <?php  if(!empty($rid)) { ?>disabled<?php  } ?>>
              <option value="0">选择抽奖项目数</option>
              <option value="6" <?php  if(count($list)==6) { ?>selected<?php  } ?>>6项</option>
              <option value="8" <?php  if(count($list)==8) { ?>selected<?php  } ?>>8项</option>
              <option value="10" <?php  if(count($list)==10) { ?>selected<?php  } ?>>10项</option>
              <option value="12" <?php  if(count($list)==12) { ?>selected<?php  } ?>>12项</option>
            </select>
            <div style="margin-top:10px">
             <table class="table table-hover">
              <thead>
                <tr>
                  <th style="width:80px"><a href="#" title="打钩的就是中奖奖品，否则就不是" data-toggle="tooltip" data-placement="bottom" class="tips">是否奖品</a></th>
                  <th><a href="#" title="填写奖品名称" data-toggle="tooltip" data-placement="bottom" class="tips">奖品名称</a></th>
                  <th>总数量/剩余数量</th>
                  <th>奖品内容</th>
                  <th><a href="#" title="累加最好等于100" data-toggle="tooltip" data-placement="bottom" class="tips">中奖几率%</a></th>
                  <th><a href="#" title="一定要达到X后才能出现中奖" data-toggle="tooltip" data-placement="bottom" class="tips">中奖绝对值</a></th>
                </tr>
              </thead>
              <tbody id="award">
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr class="awardrow">
                  <td><input type="checkbox" name="award-isprize[<?php  echo $row['id'];?>]"  value="1" <?php  if($row['isprize']) { ?> checked="checked"<?php  } ?> /></td>
                  <td><input type="text" name="award-level[<?php  echo $row['id'];?>]" placeholder='如一等奖' class="form-control"  value="<?php  echo $row['level'];?>" /></td>
                  <td><input type="text" name="award-total[<?php  echo $row['id'];?>]" class="form-control" style="width:50px"  value="<?php  echo $row['total'];?>" />/<input type="text" name="award-renum[<?php  echo $row['id'];?>]" class="form-control"  value="<?php  echo $row['renum'];?>" style="width:50px"/></td>
                  <td><input type="hidden" name="award-deg[<?php  echo $row['id'];?>]"  value="<?php  echo $row['deg'];?>" /><input type='text' name="award-description[<?php  echo $row['id'];?>]" value="<?php  echo $row['description'];?>" class='form-control'/></td>
                  <td><input type="text" name="award-probalilty[<?php  echo $row['id'];?>]" class="form-control mtxt"  value="<?php  echo $row['probalilty'];?>" /></td>
                  <td><input type="text" name="award-leavel[<?php  echo $row['id'];?>]" class="form-control mtxt"  value="<?php  echo $row['leavel'];?>" /></td>
                </tr>
                <?php  } } ?>
              </tbody>
            </table>
            <div class="help-block">1、必须要有一个不是奖品的项目！不能全部为奖品，否则会出错！<br />2、转盘和奖品的顺序是顺时针计算。<br />3、奖品内容设置说明：请参考营销活动中的【红包】和【卡券】标签说明，如为空则是采用系统SN码；</div>
            </div>
          </div>
    
        </div>
      </div>
      </div>
    </div>
    <div class="form-group col-xs-12">
      <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return checkform();return false" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
  </form>
</div>
<style>
.awardrow input{ width:90px;}
.awardrow input.mtxt {width:60px;}
</style>
<script>
function SetCr(){
	num=parseInt($("#selectprogress option:selected").val());
	$("#award").html('');
	for(i=0;i<num;i++){
		var step=parseInt(360/num)*(num-i);
		var temp="<tr class='awardrow'><td><input type='checkbox' name='award-isprize-new["+i+"]' value='1' /></td>";
		temp+="<td><input type='text' name='award-level-new["+i+"]' placeholder='如一等奖' class='form-control' /></td>";
		
		temp+="<td><input type='text' name='award-total-new["+i+"]' class='form-control ' style='width:50px'/>";
		temp+="<input type='text' name='award-renum-new["+i+"]' class='form-control ' style='width:50px' disabled/></td>";
		
		temp+="<td><input type='hidden' name='award-deg-new["+i+"]' value='"+step+"'/><input type='text' name='award-content-new["+i+"]' placeholder='请参考标签' class='form-control ' /></td>";
		
		temp+="<td><input type='text' name='award-probalilty-new["+i+"]' class='form-control mtxt'/></td>";
		temp+="<td><input type='text' name='award-leavel-new["+i+"]' class='form-control mtxt' value='0'/></td></tr>";
		$("#award").append(temp);
	}
}
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" method="post" onsubmit="return formcheck(this)">
      <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>游戏名称</th>
                <th>时间设置</th>
                <th>状态</th>
                <th>奖品</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td></td>
              <td><?php  echo $row['title'];?></td>
              <td><span class="label label-default"><?php  echo date("y-m-d H:i",$row['starttime'])?></span><br /><span class="label label-default"><?php  echo date("y-m-d H:i",$row['endtime'])?></span></td>
              <td><?php  if($row['status']) { ?><span class="label label-success">开启</span><?php  } else { ?><span class="label label-default">关闭</span><?php  } ?></td>
              
              <td>
              <?php  if(is_array($prizelist[$row['id']])) { foreach($prizelist[$row['id']] as $prize) { ?>
              <div><span class="label label-default"><?php  echo $prize['level'];?></span> <span class="label label-default"><?php  echo $prize['renum'];?> | <?php  echo $prize['total'];?></span></div>
              <?php  } } ?>
              </td>
              <td style="text-align:right">
              <a href="<?php  echo $this->createWebUrl('lottery',array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('lottery',array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php  } } ?>
            <tr>
              </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
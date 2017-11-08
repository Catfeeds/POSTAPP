<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('member', array('op' => 'post'))?>">添加收银员</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('member', array('op' => 'display'))?>">管理收银员</a></li>
  <li><a href="<?php  echo $this->createWebUrl('group', array('op' => 'display'))?>">店铺设置</a></li>
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
<div class="main">
  <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $id?>" />
    <div class="panel panel-default">
      <div class="panel-heading"> 收银员管理 </div>
      <div class="panel-body"> 
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
          <div class="col-sm-9 form-inline">
             <label class="radio-inline">
              <input type="radio" name="status" value="0" <?php  if($item['status'] == 0 || empty($item['status'])) { ?>checked<?php  } ?> />
              关闭</label>
            <label class="radio-inline">
              <input type="radio" name="status" value="1" <?php  if($item['status'] == 1) { ?>checked<?php  } ?> />
              开启</label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">工号</label>
          <div class="col-sm-9 col-xs-12 form-inline">
            <input type="text" name="useracount" maxlength="10" class="form-control" value="<?php  echo $item['useracount'];?>" <?php  if($id) { ?>disabled<?php  } ?>/>
            <div class="help-block">【提交后不可更改】工号的作用是用于登录使用，不能以0开头。如果工号前面有是0，请在前面加上字母如“A01”</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属店铺</label>
          <div class="col-sm-9 col-xs-12 form-inline">
            <select name="pcate" class="form-control">
            	<option value="0">请选择</option>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$item['pcate']) { ?> selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                <?php  } } ?>
            </select>
            <div class="help-block">此内容可用于多门店，或者是不同地区收款时，作为统计时使用</div>
          </div>
        </div>
		
		
		<div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">打印机</label>
          <div class="col-sm-9 col-xs-12 form-inline">
            <select name="printerid" id="printerid" class="form-control">
            	<option value="0">请选择</option>
                
            </select>
            <div class="help-block">不选择，则默认使用当前店铺默认打印机</div>
          </div>
        </div>
		
<script>
	var printerid="<?php  echo $item['printerid'];?>";
	function getPrinterList(shopid)
	{
		var obj=$("#printerid");
		if(shopid==""||shopid==0){
			obj.html("<option value='0'>请选择使用的打印机</option>");
			return false;
		} 
		$.post("<?php  echo $this->createWebUrl('member_select_print')?>",{
			"shopid":shopid,
		},function(data){
			if(data.type=="success")
			{
				var printList=data.message;
				var str="<option value='0'>请选择使用的打印机</option>";
				for(i in printList)
				{
					str+="<option value='"+printList[i]['id']+"'>"+printList[i]['title']+"("+printList[i]['printsn']+")</option>";
				}
				obj.html(str);
				obj.val(printerid);
			}else{
				obj.html("<option>未配置打印机，请先配置</option>");		
			}
		},"json");
	}
	$("select[name='pcate']").change(function(){
			var v=$(this).val();
			getPrinterList(v);
	});
	$("select[name='pcate']").change();
	
</script>
		
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">角色权限</label>
          <div class="col-sm-9 form-inline">
             <label class="radio-inline">
              <input type="radio" name="permission" value="1" <?php  if($item['permission'] == 1 || empty($item['permission'])) { ?>checked<?php  } ?> />
              收银员</label>
            <label class="radio-inline">
              <input type="radio" name="permission" value="2" <?php  if($item['permission'] == 2) { ?>checked<?php  } ?> />
              财务</label>
            <label class="radio-inline">
              <input type="radio" name="permission" value="3" <?php  if($item['permission'] == 3) { ?>checked<?php  } ?> />
              店长</label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">openid</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="openid" class="form-control" value="<?php  echo $item['openid'];?>" />
            <div class="help-block">请在粉丝列表中查找-<a href="./index.php?c=mc&a=fans">粉丝列表</a></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="realname" class="form-control" value="<?php  echo $item['realname'];?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" autocomplete="off" />
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">权限设置</label>
          <div class="col-sm-9 form-inline">
             <label class="radio-inline">
              <input type="checkbox" name="login_pc" value="1" <?php  if($item['login_pc'] == 1) { ?>checked<?php  } ?> />
              电脑端登录</label>
            <label class="radio-inline">
              <input type="checkbox" name="login_m" value="1" <?php  if($item['login_m'] == 1) { ?>checked<?php  } ?> />
              手机登陆</label>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">输入密码</label>
          <div class="col-sm-9 col-xs-12">
            <input type="password" name="password" class="form-control" autocomplete="off"/>
            <div class="help-block">不少于6位英文、数字、符号</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认密码</label>
          <div class="col-sm-9 col-xs-12">
            <input type="password" name="password2" class="form-control" autocomplete="off"/>
            <div class="help-block"></div>
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
<script type="text/javascript">
function checkform(){
	var temp=$("input[name='useracount']").val();
	if(!temp){
		alert("请填写工号，且不能是0");
		return false;
	}
	temp=$("input[name='password']").val();
	if(temp.length<6 && temp.length>0){
		alert("密码不能少于6位");
		return false;
	}
	var temp2=$("input[name='password2']").val();
	if(temp2=="")
	{
	  <?php  if(empty($item)) { ?>	  
	  if(temp!=temp2 && temp.length>0){
		alert("两次输入的密码不一样");
		return false;
	  }
	  <?php  } ?>
	}
	return true;
}
</script> 

<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" class="form-horizontal form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="j_money" />
    <input type="hidden" name="do" value="member" />
    <input type="hidden" name="op" value="display" />
    <div class="panel panel-info">
      <div class="panel-body table-responsive">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
          <div class="col-sm-9 form-inline"> 
            <select name="groupid" id="groupid"  class="form-control" onChange="changeGroup(1)">
              <option value="0">全部团队</option>  
                  <?php  if(is_array($grouplist)) { foreach($grouplist as $row) { ?>
              <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$_GPC['groupid']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                  <?php  } } ?>
            </select>
            <input type="text" class="form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="姓名/电话"/>
            <input type="submit" class="btn btn-info" value="搜索"/>
          </div>
        </div>
      </div>
    </div>
      <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>工号</th>
                <th>姓名</th>
                <th>电话</th>
                <th>权限</th>
                <th>状态</th>
                <th>最后登录</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td></td>
              <td>
              
              <span class="label label-info"><?php  echo $groupary[$row['pcate']]?></span><br />
              <?php  echo $row['useracount'];?></td>
              <td><?php  echo $row['realname'];?></td>
              <td><?php  echo $row['mobile'];?></td>
              <td>
              <?php  if($row['permission']==1) { ?><span class="label label-info">收银员</span><?php  } else if($row['permission']==2) { ?><span class="label label-warning">财务</span><?php  } else if($row['permission']==3) { ?><span class="label label-success">店长</span><?php  } ?>
              <?php  if($row['login_pc']) { ?><span class="label label-info">电脑端</span><?php  } ?> <?php  if($row['login_m']) { ?><br /><span class="label label-info">手机端</span><?php  } ?>
              </td>
              <td><?php  if($row['status']) { ?><span class="label label-info">正常</span><?php  } else { ?><span class="label label-default">未开通</span><?php  } ?></td>
              <td><?php  if($row['lasttime']) { ?><?php  echo date("Y-m-d H:i",$row["lasttime"])?><?php  } ?></td>
              <td style="text-align:right">
              <a href="<?php  echo $this->createWebUrl('history',array('userid' => $row['id']))?>" class="btn btn-info btn-sm" title="收款记录"><i class="fa fa-bar-chart-o"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('member', array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('member', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php  } } ?>
            <tr>
            <tr>
              <td></td>
              <td colspan="4"><a href="<?php  echo $this->createWebUrl('member', array('op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加人员</a></td>
            </tr>
              </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
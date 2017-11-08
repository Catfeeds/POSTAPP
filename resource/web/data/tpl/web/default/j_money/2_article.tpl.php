<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('artcle', array('op' => 'post'))?>">添加</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('artcle', array('op' => 'display'))?>">管理文章</a></li>
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
      <div class="panel-heading"> 文章管理 </div>
      <div class="panel-body">
         <?php  if($id) { ?>
         <div class="form-group">
         	<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
            <div class="col-sm-9"><?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=share&m=j_money&id=<?php  echo $id;?></div>
         </div>
         <?php  } ?>
         <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
          <div class="col-sm-9">
            <label class="radio-inline">
              <input type="radio" name="status" value="0" <?php  if($item['status'] == 0) { ?> checked<?php  } ?> />
              关闭</label>
            <label class="radio-inline">
              <input type="radio" name="status" value="1" <?php  if($item['status'] == 1) { ?> checked<?php  } ?> />
              开启</label>
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">活动时间段</label>
          <div class="col-sm-9"> <?php  echo tpl_form_field_daterange('gametime', array('start' => date('Y-m-d H:i', $item['starttime']),'end'=>date('Y-m-d H:i', $item['endtime'])),true)?> </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" />
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享图标</label>
          <div class="col-sm-9"> <?php  echo tpl_form_field_image('thumb', $item['thumb']);?>
            <div class="help-block">120*120px</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享描述</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="description" class="form-control" value="<?php  echo $item['description'];?>" />
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">分享奖励</label>
          <div class="col-sm-9 form-inline">
            <div class="input-group">
              <div class="input-group-btn">
                <select name="prizetype" class="form-control">
                  <option value="1">卡券</option>
                </select>
              </div>
              <input type="text" class="form-control" style="width:260px" name="favorable" value="<?php  echo $item['favorable']?>">
            </div>
            <div class="help-block">目前仅支持分享后获得卡券。由于微信规定中，如出现积分、红包等的内容将会封号，因此目前仅限卡券。</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">详情</label>
          <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_ueditor('content', $item['content']);?>
            <div class="help-block">不要直接从word文档，微信公众号后台及文章中，其他网站网页中直接复制内容。如需要复制，请复制到记事本中，再复制到编辑器中。</div>
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
                <th>图标</th>
                <th>标题</th>
                <th>奖励方式</th>
                <th>情况</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td></td>
              <td><img src="<?php  echo tomedia($row['thumb'])?>" width="80"/></td>
              <td><?php  echo $row['title'];?></td>
              <td>
              <?php  if($row['prizetype']==1) { ?>
              <span class="label label-info">卡券</span>
              <?php  } else if($row['prizetype']==2) { ?>
              <span class="label label-danger">红包</span>
              <?php  } else if($row['prizetype']==3) { ?>
              <span class="label label-warning">积分</span>
              <?php  } ?><br/>
              <?php  echo $row['favorable'];?></td>
              <td>
              <span class="label label-primary">浏览：<?php  echo $row['viewcount'];?></span><br />
              <span class="label label-primary">分享：<?php  echo $row['sharecount'];?></span>
              </td>
              <td style="text-align:right">
              <a href="<?php  echo $this->createWebUrl('artcle',array('op'=>'statistics','id'=>$row['id']))?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="统计"><i class="fa fa-asterisk"></i></a>&nbsp;&nbsp; 
              <a href="<?php  echo $this->createWebUrl('artcle',array('op'=>'post','id'=>$row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; 
              <a href="<?php  echo $this->createWebUrl('artcle',array('op'=>'delete','id'=>$row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a></td>
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
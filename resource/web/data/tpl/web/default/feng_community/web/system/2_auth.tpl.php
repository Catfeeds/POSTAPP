<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>


<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>系统授权</h5>
				</div>
				<div class="ibox-content">

	<form action="" method="post" class="form-horizontal form" id="form">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">域名</label>
					<div class="col-xs-12 col-sm-8">
						<input type="text" name="domain" class="form-control" value="<?php  echo $domain;?>" readonly/>
					</div>
				</div>
		<div class="hr-line-dashed"></div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">IP地址</label>
					<div class="col-xs-12 col-sm-8">
						<input type="text" name="ip" class="form-control" value="<?php  echo $ip;?>" readonly/>
					</div>
				</div>
		<div class="hr-line-dashed"></div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">站点ID</label>
					<div class="col-xs-12 col-sm-8">
						<input type="text" name="siteid" class="form-control" value="<?php  echo $siteid;?>" readonly />
						<span class="help-block">站点ID,如果为空，请到 <a href='<?php  echo url('cloud/profile')?>'>站点注册</a> 绑定您的服务器</span>
					</div>
				</div>
					<?php  if($result['status']==1) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">授权码</label>
					<div class="col-xs-12 col-sm-8">
						<input type="text" name="code" class="form-control" value="<?php  echo $auth['code'];?>" placeholder='请填写授权码' />
						<span class="help-block">
						<span>系统未授权，暂无法更新，如需授权码 请联系QQ</span>
							<a target="_blank" href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4001166156&aty=0&a=0&curl=&ty=1">
								<img border="0" src="http://wpa.qq.com/pa?p=2:4001166156:51" alt="点击这里给我发消息" title="点击这里给我发消息"/>
							</a>
						</span>
					</div>
				</div>
					<?php  } ?>
		<div class="hr-line-dashed"></div>
				<div class="form-group">
                    <label class="col-sm-2 control-label">授权状态</label>
                    <div class="col-sm-8 col-xs-12">
                        <div class='form-control-static'>
                           	<?php  if($result['status'] == 3 || $result['status'] == 4 || $result['status'] == 5) { ?>
                            <span class='label label-primary'>已授权</span>
                            <?php  } else if($result['status'] == 2) { ?>
							<span class='label label-primary'>已过期</span>
							<?php  } else { ?>
                            <span class='label label-danger'>未授权</span>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
		<div class="hr-line-dashed"></div>
                <?php  if($_W['isfounder']) { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">官方网站</label>
                    <div class="col-sm-8 col-xs-12">
                        <div class='form-control-static'><a href='http://www.njzhsq.com' target='_blank'>http://www.njzhsq.com</a></div>
                        <?php  if($result['status'] == 1) { ?>
                        <span class='help-block'>如果您正在使用非正版授权，请您尊重我们的劳动成果，谢谢您~</span>
                        <span class='help-block'>盗版有风险，请谨慎使用!</span>
                        <?php  } ?>
                    </div>
                </div>
		<div class="hr-line-dashed"></div>
                <?php  } ?>

				<div class="form-group">
					<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
						<input name="submit" type="submit" value="提交授权" class="btn btn-primary" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</div>
				</div>

	</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
require(['jquery', 'util'], function($, util){
	$(function(){
		$('#form').submit(function(){
			if($('input[name="code"]').val() == ''){
				util.itoast('请输入授权码.');
				return false;
			}
			if($('input[name="domain"]').val() == ''){
				util.itoast('未获取到域名.');
				return false;
			}
			if($('input[name="siteid"]').val() == ''){
				util.itoast('站点ID为空，请先注册站点.');
				return false;
			}
			return true;
		});
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
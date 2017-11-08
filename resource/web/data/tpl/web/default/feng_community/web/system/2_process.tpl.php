<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo $this->createWebUrl('system',array('op' => 'upgrade'));?>">自动更新</a></li>
</ul>

<div class="panel">
	<div class="alert alert-warning">
		正在更新系统文件, 请不要关闭窗口.
	</div>
	<div class="alert alert-warning">
		如果下载文件失败，可能造成的原因：写入失败，请仔细检查写入权限是否正确。
	</div>
	<div class="alert alert-info form-horizontal ng-cloak" ng-controller="processor">
		<dl class="dl-horizontal">
			<dt>整体进度</dt>
			<dd>{{pragress}}</dd>
			<dt>正在下载文件</dt>
			<dd>{{file}}</dd>
		</dl>
	</div>
	<script>
		require(['angular'], function(angular){
			angular.module('app', []).controller('processor', function($scope, $http){
				var total = 0;
				var i = 0;
				var proc = function() {
					if(i == total && i != 0){
						location.href = "<?php  echo $this->createWebUrl('system',array('op' => 'download'));?>";
						return;
					}
					$http.post("<?php  echo $this->createWebUrl('system',array('op' => 'download'));?>").success(function(dat){
						if(dat.result == 1){
							i = dat.success;
							total = dat.total;
							$scope.file = dat.path;
							$scope.pragress = i + '/' + total;
						}
						proc();
					}).error(function(){
						proc();
					});
				}
				proc();
			});
			angular.bootstrap(document, ['app']);
		});
	</script>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>

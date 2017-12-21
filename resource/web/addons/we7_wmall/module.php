<?php
//dezend by http://www.yunlu99.com/ QQ:270656184
defined('IN_IA') || exit('Access Denied');
include 'version.php';
include 'defines.php';
include 'model.php';
class We7_wmallModule extends WeModule
{
	public function welcomeDisplay()
	{
		header('location: ' . iurl('dashboard/index'));
		exit();
	}
}

?>

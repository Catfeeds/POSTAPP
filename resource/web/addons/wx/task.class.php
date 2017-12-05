<?php
//decode by QQ:270656184 http://www.yunlu99.com/
defined('IN_IA') or exit('Access Denied');

abstract class SupermanCreditmallTask
{
	public function apply_before($task)
	{
		return true;
	}

	public function apply_after($task)
	{
		return;
	}

	public function progress($task)
	{
		return;
	}

	public function complete($task)
	{
		return;
	}
}
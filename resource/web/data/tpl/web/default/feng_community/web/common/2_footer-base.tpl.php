<?php defined('IN_IA') or exit('Access Denied');?>	<script type="text/javascript">
		require(['bootstrap']);
		$('.js-clip').each(function(){
			util.clip(this, $(this).attr('data-url'));
		});
	</script>
	<style>
		.ft.links{margin-bottom: 0px;}
		.ft .links_item{border-left-color:#f1f1f1;*line-height:15px}
		.ft .links_item a{color:#f1f1f1}
		.foot{padding:24px 0;color:#f1f1f1;text-align:center;background-color:#b8b9b9;bottom: 0px;position: inherit;width: 100%;}
		.foot ul {list-style-type: none;}
		.copyright{display:inline}
	</style>
	<script>
        require(['bootstrap']);
	</script>
	<!--<div class="foot" id="footer" style="position: fixed">-->
		<!--<ul class="links ft" >-->
			<!--<li class="links_item"><p class="copyright">Copyright © 2015-2016 <?php  echo $_W['account']['name'];?>. All Rights Reserved.</p> </li>-->
		<!--</ul>-->
	<!--</div>-->
</html>

<?php
global $_GPC, $_W;
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$shopid = !empty($_GPC['shopid']) ? $_GPC['shopid'] : message("缺少店铺id参数");
$printList=pdo_fetchall("select * from ".tablename("j_money_printer")." where weid=:weid and shopid=:shopid order by isdef desc",array(
":weid"=>$_W["uniacid"],
":shopid"=>$shopid,
));
empty($printList)&&message("没有配置打印机");
message($printList,"","success");
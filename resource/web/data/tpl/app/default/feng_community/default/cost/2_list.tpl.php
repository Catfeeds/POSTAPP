<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f5">
<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
    <h1 class="title txt-fff">我的账单</h1>
</header>
<div class="list-block cost-list-block" >
    <ul id="data-list">
    </ul>
</div>
<script type="text/html" id="xq_list">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}

        <li class="item-content item-link" onclick="javascript:window.location.href='<?php  echo $this->createMobileUrl('cost',array('op' => 'detail'))?>&id={{ d.list[i].id }}'">
            <div class="item-inner">
                <div class="item-title" style="font-size: 15px;">{{ d.list[i].costtime }}账单合计{{ d.list[i].total }}元</div>
                <div class="item-after">

                    {{# if(d.list[i].status == '否' || d.list[i].status == 0 || d.list[i].status == 2){ }}
                    <span class="cost-btn bg-warning" href="{{ d.list[i].url }}" style="font-size: 14px;"><?php  if(empty($set)&&empty($cost_pay)) { ?>查看物业费<?php  } else { ?>我要缴费<?php  } ?></span>
                    {{# }else{ }}
                    <span class="cost-btn bg-primary" href="{{ d.list[i].url }}" style="font-size: 14px;">已支付</span>
                    {{# } }}
                </div>
            </div>
        </li>

    {{# } }}

</script>
<script>
    $(document).ready(function() {
        loaddata("<?php  echo $this->createMobileUrl('cost',array('op'=>'list'))?>", $("#data-list"), 'xq_list', true);
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
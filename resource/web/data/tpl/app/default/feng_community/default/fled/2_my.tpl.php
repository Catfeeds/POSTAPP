<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f5 ">
<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('fled',array('op'=> 'list'))?>'"></a>
    <h1 class="title txt-fff">我的跳骚市场</h1>
</header>
<div class="content page">
    <div class="list-block media-list repair-list-block repair-my-block mt0" id="data-list">
    </div>
</div>
<script type="text/html" id="xq_list">
    {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
    <ul>
        <li>
            <a href="#" class="item-content">
                <div class="item-inner">
                    <div class="item-title-row">
                        <div class="item-title">
                            <span class="repair-lable bg-success">【{{ d.list[i].name }}】</span> <span class="fled-my-tit">{{ d.list[i].title}}</span><span class="fled-my-tit">{{ d.list[i].rolex}}</span>
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li class="item-content">
            <div class="item-inner">
                <div class="item-title-row">
                    <div class="item-subtitle">发布日期：{{ d.list[i].datetime }}</div>
                    <div class="item-after">
                        {{# if(d.list[i].status == 0){ }}
                        <div class="fled-success-btn" onclick="editeFun({{ d.list[i].id }})" style="width: 40px;">编辑</div>&nbsp;&nbsp;
                        <div class="repair-del fled-del-btn" onclick="delectFun({{ d.list[i].id }})" style="width: 40px;">删除</div>&nbsp;&nbsp;
                        {{# } }}
                        {{# if(d.list[i].status == 0){ }}
                        <div class="fled-success-btn" onclick="confirmFun({{ d.list[i].id }})">确认成交</div>
                        {{# } }}
                    </div>
                </div>
            </div>
        </li>
    </ul>
    {{# } }}
</script>
<script>$.config = {autoInit: true}</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<script>
    $(document).ready(function() {
        loaddata("<?php  echo $this->createMobileUrl('fled',array('op'=>'my'))?>", $("#data-list"),'xq_list', true);
    });
</script>
<script>
    function confirmFun(id) { //确认成交
        if (window.confirm('你确定要确认成交吗？')) {
            $.ajax({
                async: true,
                url: "<?php  echo $this->createMobileUrl('fled',array('op' => 'finish'))?>",
                dataType: "json",
                type: "POST",
                data: {
                    id: id
                },
                success: function() {
                    window.location.href="<?php  echo $this->createMobileUrl('home')?>";
                },
                error: function() {
                    alert("请求错误！")
                }
            })
        } else {
            //alert("取消");
            return false;
        }
    }
    function editeFun(id) {
        window.location.href="<?php  echo $this->createMobileUrl('fled',array('op' => 'add'))?>&id="+id;
    }
    function delectFun(id) { //删除对象
        if (window.confirm('你确定要删除对象吗？')) {
            $.ajax({
                async: true,
                url: "<?php  echo $this->createMobileUrl('fled',array('op' => 'delete'))?>",
                dataType: "json",
                type: "POST",
                data: {
                    id: id
                },
                success: function() {
                    window.location.href="<?php  echo $this->createMobileUrl('home')?>";
                },
                error: function() {
                    alert("请求错误！")
                }
            })
        } else {
            //alert("取消");
            return false;
        }
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
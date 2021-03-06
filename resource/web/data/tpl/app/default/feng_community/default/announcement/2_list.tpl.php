<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width">
    <header class="bar bar-nav bg-green" style="position: fixed">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('home')?>'"></a>
        <h1 class="title txt-fff">公告列表</h1>
    </header>
    <div class="content">
        <ul class="notice-list" id="notice-list">
        </ul>
    </div>
    <script type="text/html" id="xq_list">
        {{# for(var i = 0, len = d.list.length; i < len; i++){ }}
        <li onclick="window.location.href='{{ d.list[i].url }}'">
            <div class="list-item">
                <div class="list-item-time">
                    <div class="day">
                        <span class="day_b">{{ d.list[i].da }}</span>
                        <span class="day_s">日</span>
                    </div>
                    <div class="year">{{ d.list[i].dat }}</div>
                </div>
                <div class="list-item-title">
                    <a href="#"><p>{{ d.list[i].title }}</p></a>
                </div>
            </div>
            <div class="list-item">
                <div class="list-item-bl">
                    <span class="{{ d.list[i].css }}">{{ d.list[i].p }}</span>
                    <a href="{{ d.list[i].url }}">
                        <span class="read_all">阅读详情</span>
                    </a>
                </div>
                <div class="list-item-br">
                    <span class="{{ d.list[i].pcss }}"></span>
                </div>
            </div>
        </li>
        {{# } }}

    </script>
    <script>
        $(document).ready(function () {
            loaddata("<?php  echo $this->createMobileUrl('announcement',array('op' => 'list'))?>", $("#notice-list"), 'xq_list', true);
        });
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
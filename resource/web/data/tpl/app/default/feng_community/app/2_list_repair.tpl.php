<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title"><?php  if($xqtype == 1) { ?>报修列表<?php  } else if($xqtype == 2) { ?>建议列表<?php  } ?></h1>
    </header>
    <div class="content">
        <div class="list-block media-list" style="margin: 0 0 50px 0">
            <ul>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li>
                    <a href="#" class="item-link item-content" onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'detail','id' => $item['id'],'type' => $type))?>'">
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title"><?php  echo $item['category'];?></div>
                                <div class="item-after"><?php  echo date('Y-m-d H:i',$item['createtime'])?></div>
                            </div>
                            <div class="item-subtitle">
                                <?php  if($item['status'] == 1 ) { ?>
                                <span class="label-success">已处理</span>
                                <?php  } ?>
                                <?php  if($item['status'] == 3 ) { ?>
                                <span class="label-info">受理中</span>
                                <?php  } ?>
                                <?php  if($item['status'] == 2 ) { ?>
                                <span class="label-default">未处理</span>
                                <?php  } ?>
                            </div>
                        </div>
                    </a>
                </li>

            <?php  } } ?>
            </ul>
            <?php  echo $pager;?>
        </div>
    </div>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
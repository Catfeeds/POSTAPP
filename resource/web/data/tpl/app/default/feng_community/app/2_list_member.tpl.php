<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">住户列表</h1>
    </header>
    <div class="content">
        <div class="list-block media-list" style="margin: 0 0 60px 0">
            <ul>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li onclick="window.location.href='<?php  echo $this->createMobileUrl('xqsys',array('op' => 'member_detail','id'=> $item['id']))?>'">
                    <a href="#" class="item-link item-content">
                        <div class="item-inner">
                            <div class="item-title-row">
                                <div class="item-title">姓名:<?php  echo $item['realname'];?></div>
                                <div class="item-after"><?php  echo date('Y-m-d H:i',$item['createtime'])?></div>
                            </div>
                            <div class="item-subtitle">电话:<?php  echo $item['mobile'];?></div>
                            <div class="item-text">
                                地址:<?php  echo $item['title'];?>
                                <?php  if($item['area']) { ?><?php  echo $item['area'];?>区<?php  } ?>
                                <?php  if($item['build']) { ?><?php  echo $item['build'];?>栋<?php  } ?>
                                <?php  if($item['unit']) { ?><?php  echo $item['unit'];?>单元<?php  } ?>
                                <?php  if($item['room']) { ?><?php  echo $item['room'];?>室<?php  } ?>
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
<script>

</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
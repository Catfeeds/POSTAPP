<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<body class="max-width bg-f2">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" href="javascript:history.go(-1);"></a>
        <h1 class="title txt-fff">用户资料</h1>

        <a class="button button-link button-nav pull-right open-popup" data-popup=".popup-about" style="color:white" onclick="window.location.href='<?php  echo $this->createMobileUrl('member',array('op' => 'addr'))?>'">
            新增地址
        </a>

    </header>
    <div class="content">
        <div class="list-block" style="margin:0">
            <ul>

                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">
                            <input type="radio" class="weui_check" name="addressid"  value="<?php  echo $item['id'];?>" id="address_<?php  echo $item['id'];?>" <?php  if($item['enable']) { ?>checked="checked"<?php  } ?>>
                            <label for="address_<?php  echo $item['id'];?>"> <?php  if($item['area']) { ?><?php  echo $item['area'];?>区<?php  } ?><?php  if($item['build']) { ?><?php  echo $item['build'];?>栋<?php  } ?><?php  if($item['unit']) { ?><?php  echo $item['unit'];?>单元<?php  } ?><?php  echo $item['room'];?>室</label>

                        </div>
                    </div>
                </li>
                <?php  } } ?>


            </ul>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(function(){
            $("input[name='addressid']").click(function(){
                var addressid = $('input[name="addressid"]:checked').val();
                $.post("<?php  echo $this->createMobileUrl('member',array('op'=> 'change'))?>",{addressid:addressid},function(s){
                    if(s.status == 1){
                        window.location.reload();
                    }
                },'json')
            })
        })

    </script>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
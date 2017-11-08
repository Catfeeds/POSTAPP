<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <!-- 标题栏 -->
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">详细内容</h1>
    </header>
    <!-- 这里是页面内容区 -->
    <div class="content">
        <div class="card" style="margin:0">
            <div class="card-content">
                <div class="card-content-inner">
                    <p>姓名：<?php  echo $item['realname'];?></p>
                    <p>电话：<a href="tel:<?php  echo $item['mobile'];?>" style="color: red"><?php  echo $item['mobile'];?></a></p>
                    <p>地址：<?php  echo $addr;?></p>
                    <p>状态：<?php  if($item['status'] ==1 ) { ?><span class="label-success" style="display: inline;">已处理</span><?php  } ?><?php  if($item['status'] == 3 ) { ?><span class="label-info" style="display: inline;">受理中</span><?php  } ?><?php  if($item['status'] == 2 ) { ?><span class="label-default" style="display: inline;">未处理</span><?php  } ?>
                    </p>
                    <p>内容：<?php  echo $item['content'];?></p>
                    <div id="previewImage" onclick="showImg()">
                        <?php  if($imgs) { ?>
                        <?php  if(is_array($imgs)) { foreach($imgs as $img) { ?>
                        <img src="<?php  echo tomedia($img['src'])?>" class="img-thumbnail" width="90" height="90">
                        <?php  } } ?>
                        <?php  } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-block ">
                <ul style="margin-top: -30px;">
                    <li class="item-content item-link">
                        <div class="item-inner">
                            <div class="item-media">状态：</div>
                            <div class="item-input">
                                <select id="status">
                                    <option value="2" <?php  if(intval($item['status'])==2) { ?> selected<?php  } ?>>未处理</option>
                                    <option value="3" <?php  if(intval($item['status'])==3) { ?> selected<?php  } ?>>处理中</option>
                                    <option value="1" <?php  if(intval($item['status'])==1) { ?> selected<?php  } ?>>已处理</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-input">
                                <textarea  placeholder="请输入处理结果" id="content" ></textarea>
                                <div class="textarea-counter">
                                    <span>0</span>/200
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            <div class="content-block">
                <a href="#" class="button button-big button-fill button-success" id="fb">提交信息</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#fb").click(function(event) {
            var status = $('#status option:selected').val();
            var content = $('#content').val();
            var type ="<?php  echo $_GPC['type'];?>";
            if(content == ''){
                alert('请填写处理结果');return false;
            }

            var reportid = "<?php  echo $_GPC['id'];?>";
            $.ajax({
                url: "<?php  echo $this->createMobileUrl('xqsys',array('op' => 'detail'))?>",
                dataType: 'json',
                data: {
                    status: status,
                    content: content,
                    id:reportid,
                    type:type
                },
                success: function(s) {
                    if (s.result == 1) {
                        $.toast('处理成功');
                        setTimeout(function() {
                            window.location.href="<?php  echo $this->createMobileUrl('xqsys',array('op' => 'index'))?>";
                        }, 30);
                    }
                }
            })
        });
    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
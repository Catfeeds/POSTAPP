<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/header', TEMPLATE_INCLUDEPATH)) : (include template('app/header', TEMPLATE_INCLUDEPATH));?>
<div class="page">
    <header class="bar bar-nav">
        <a class="icon icon-left pull-left open-panel" onclick="javascript:history.back(-1);"></a>
        <h1 class="title">添加门禁</h1>
    </header>
    <div class="content">
        <div class="list-block" style="margin: 0">
            <ul>
                <!-- Text inputs -->
                <li>
                    <div class="item-content">
                        <div class="item-media">选择小区：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <select name='regionid' class="form-control" id="regionid">
                                    <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                                    <option value='<?php  echo $region['id'];?>' > <?php  echo $region['title'];?></option>
                                    <?php  } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-media" style="float:left;margin-left:15px;">小区现状：</div>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-input">

                                <label class="radio-inline">
                                    <input type="radio" name="status" value="2" <?php  if($item['status'] == 2 || empty($item['status'])) { ?>checked<?php  } ?>> 老楼盘
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" <?php  if($item['status'] == 1 ) { ?>checked<?php  } ?>> 新楼盘
                                </label>

                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-media" style="float:left;margin-left:15px;">小区区域：</div>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-input">

                                <label class="radio-inline">
                                    <input type="radio" name="type" value="2" <?php  if($item['type'] == 2 || empty($item['type'])) { ?>checked<?php  } ?>> 大门
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="1" <?php  if($item['type'] == 1 ) { ?>checked<?php  } ?>> 单元门
                                </label>

                            </div>
                        </div>
                    </div>
                </li>
                <li <?php  if($item['type'] == 1 ) { ?>style="display: block<?php  } else { ?>style='display:none'<?php  } ?> id="s1">
                    <div class="item-content" >
                        <div class="item-media">单元号：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="请输入单元号" id="unit" value="<?php  echo $item['unit'];?>">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">区域名称：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="输入区域名称,例如：15栋，南大门等" id="title" value="<?php  echo $item['title'];?>">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">设备编号：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="输入设备编号" id="device_code" value="<?php  echo $item['device_code'];?>">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-media">开门网址：</div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input type="text" placeholder="请输入\开门后跳转网址" id="openurl" value="<?php  echo $item['openurl'];?>">
                            </div>
                        </div>
                    </div>
                </li>
                <input type="hidden" value="<?php  echo $item['id'];?>" id="gid" />
                <div class="content-block">
                    <div class="row">
                        <div class="col-50"><a href="#" class="button button-big button-fill button-danger" id="qx">取消</a></div>
                        <div class="col-50"><a href="#" class="button button-big button-fill button-success" id="fb">发布</a></div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("input[name='type']").click(function(){
            var type = $('input[name="type"]:checked').val();
            if(type == 2){
                $("#s2").show();
                $("#s1").hide();
            }
            if(type == 1){
                $("#s1").show();
                $("#s2").hide();
            }
        })
    })
    $(function () {
        $("#qx").click(function () {
            $("#device_code").val('');
            $("#unit").val('');
            $("#title").val('');
        })
        $("#fb").click(function () {
            var title = $("#title").val();
            var device_code = $("#device_code").val();
            var unit = $("#unit").val();
            var openurl = $("#openurl").val();
            var type = $('input:radio[name="type"]:checked').val();
            var status = $('input:radio[name="status"]:checked').val();;
            var regionid = $('#regionid option:selected').val();
            var id = $("#gid").val();
            $.post("<?php  echo $this->createMobileUrl('xqsys',array('op' => 'add_guard'))?>",{title:title,device_code:device_code,regionid:regionid,id:id,openurl:openurl,unit:unit,type:type,status:status},function (data) {
                if(data.status){
                    $.toast('添加成功');
                    window.location.href="<?php  echo $this->createMobileUrl('xqsys',array('op' => 'index'))?>";
                }
            },'json')
        })
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('app/footer', TEMPLATE_INCLUDEPATH)) : (include template('app/footer', TEMPLATE_INCLUDEPATH));?>
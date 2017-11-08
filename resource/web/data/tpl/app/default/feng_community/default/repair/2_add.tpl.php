<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
    var myurl = "<?php  echo $this->createMobileUrl('imgupload')?>";
</script>
<!--图片上传js-->
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/default/static/css/comm.css">
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/global.js">
</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/seajs-0.1.5.js">
</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/newthread.js">
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/jpegmeta.js">
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/jpeg.encoder.basic.js">
</script>
<script type="text/javascript" charset="utf-8" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/image_compress.js">
</script>
<body class="max-width">
<header class="bar bar-nav bg-green">
    <a class="icon icon-left pull-left txt-fff" href="#" onclick="window.location.href='<?php  echo $this->createMobileUrl('repair',array('op'=>'list'))?>'"></a>
    <h1 class="title txt-fff">我要报修</h1>
</header>

    <div class="content repair-content page">
        <div class="list-block ">
            <form role="form" method="post" enctype="multipart/form-data" name="newthread" id="newthread" class="form-horizontal">
            <ul style="margin-top: -30px;">
                <li class="item-content item-link">
                    <div class="item-inner">
                            <div class="item-input">
                                <select id="cid">
                                    <option value="0">请选择报修类型</option>
                                    <?php  if(is_array($categories)) { foreach($categories as $category) { ?>
                                    <option value="<?php  echo $category['id'];?>" <?php  if($category['id']==$item['cid']) { ?> selected<?php  } ?>><?php  echo $category['name'];?></option>
                                    <?php  } } ?>
                                </select>
                            </div>
                        </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title label width3">地址：</div>
                        <div class="item-input">
                            <input type="text" value="<?php  echo $region['title'];?><?php  echo $address['address'];?>" id="address" disabled/>
                        </div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-input">
                           <textarea  placeholder="长度5-200个字之间.写下详细的报修内容,有助于我们的工作人员快速帮你解决问题" id="content"></textarea>
                            <div class="textarea-counter">
                                <span>0</span>/200
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="tipLayer">
                            <div class="photoList">
                                <ul style="padding-left: 0px">
                                    <li class="on" id="addPic">
                                        <input type="file" class="on needsclick" style="z-index:200;opacity:0;filter:alpha(opacity=0);-ms-filter:'alpha(opacity=0)';" id="uploadFile" accept="image/*" single>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>
            </form>
        </div>
        <div  class="content-block" >
            <input class="button button-big button-fill button-success" type="submit" value="提交信息" id="showToast" />
        </div>
    </div>

<script type="text/javascript">
    $(function() {
        $("#showToast").click(function(event) {
            var content = $("#content").val();
            if (content == '') {
                alert('描述不能为空！');
                return false
            };
            if (content.length <= 5 || content.length >= 200) {
                alert('描述必须大于5个小于200个字');
                return false
            };
            var cid = $("#cid").val();
            if (cid == '0') {
                alert('请选择报修类型');
                return false
            };
            if (cid == '') {
                alert('请选择报修类型');
                return false
            };
            var picIds ='';
            $('input[name="picIds[]"]').each(function(){
                var t1 = $(this).val();
                picIds += t1+',';
            });
            $("#showToast").attr('disabled','true');
            $("#showToast").val("正在提交，请稍等");

            $.ajax({
                url: "<?php  echo $this->createMobileUrl('repair',array('op' => 'add'))?>",
                dataType: 'json',
                data: {
                    content: content,
                    cid: cid,
                    picIds :picIds
                },
                success: function(s) {
                    if (s.status == 1) {
                        $.toast('提交成功');
                        setTimeout(function() {
                            window.location.href="<?php  echo $this->createMobileUrl('repair',array('op' => 'list'))?>";
                        }, 200);

                    };
                }
            })


        });
    })
</script>
<script>$.config = {autoInit: true}</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
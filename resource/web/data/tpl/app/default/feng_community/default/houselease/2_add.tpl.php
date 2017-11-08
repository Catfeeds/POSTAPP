<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/header', TEMPLATE_INCLUDEPATH)) : (include template('default/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/default/static/css/comm.css">
<script type="text/javascript">
    var myurl = "<?php  echo $this->createMobileUrl('imgupload')?>";
</script>
<!--图片上传js-->
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
<body class="max-width bg-f5">
<div class="page">
    <header class="bar bar-nav bg-green">
        <a class="icon icon-left pull-left txt-fff" onclick="window.location.href='<?php  echo $this->createMobileUrl('houselease')?>'"></a>
        <h1 class="title txt-fff">发布信息</h1>
    </header>
    <div class="content" >
        <div class="buttons-row  houselease-publish" >
            <a href="#" class="tab-link  button <?php  if($category == 1 || empty($category)) { ?>active<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('houselease',array('op' => 'add' ,'category' => 1))?>'">出租</a>
            <a href="#" class="tab-link button <?php  if($category == 2) { ?>active<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('houselease',array('op' => 'add' ,'category' => 2))?>'">求租</a>
            <a href="#" class="tab-link button <?php  if($category == 3) { ?>active<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('houselease',array('op' => 'add' ,'category' => 3))?>'">出售</a>
            <a href="#" class="tab-link button <?php  if($category == 4) { ?>active<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileUrl('houselease',array('op' => 'add' ,'category' => 4))?>'">求购</a>
        </div>
        <form role="form" method="post" enctype="multipart/form-data" name="newthread" id="newthread" class="form-horizontal">
            <div class="tabs " style="margin-top:-35px;">
                <div class="tab active">
                    <div class="list-block houselease-pu-block">
                        <ul>
                            <li>
                                <div class="item-content item-link">
                                    <div class="item-inner">
                                        <div class="item-title label"><?php  if($category == 1 || empty($category)) { ?>出租方式:<?php  } else if($category == 2) { ?>求租方式:<?php  } else if($category == 3) { ?>出售方式：<?php  } else if($category == 4) { ?>求购方式：<?php  } ?></div>
                                        <div class="item-input">
                                            <select id="way">
                                                <?php  if($category == 1 || empty($category)) { ?>
                                                <option value='0'>请选择出租方式</option>
                                                <option value="整套出租" <?php  if($item['way'] == '整套出租') { ?> selected='selected'<?php  } ?>>整套出租</option>
                                                <option value="单间出租" <?php  if($item['way'] == '单间出租') { ?> selected='selected'<?php  } ?>>单间出租</option>
                                                <option value="床位出租" <?php  if($item['way'] == '床位出租') { ?> selected='selected'<?php  } ?>>床位出租</option>
                                                <?php  } else if($category == 2) { ?>
                                                <option value='0'>请选择求租方式</option>
                                                <option value="整套求租" <?php  if($item['way'] == '整套求租') { ?> selected='selected'<?php  } ?>>整套求租</option>
                                                <option value="单间求租" <?php  if($item['way'] == '单间求租') { ?> selected='selected'<?php  } ?>>单间求租</option>
                                                <option value="床位求租" <?php  if($item['way'] == '床位求租') { ?> selected='selected'<?php  } ?>>床位求租</option>
                                                <?php  } else if($category == 3) { ?>
                                                <option value='0'>请选择出售方式</option>
                                                <option value="整套出售" <?php  if($item['way'] == '整套出售') { ?> selected='selected'<?php  } ?>>整套出售</option>
                                                <?php  } else if($category == 4) { ?>
                                                <option value='0'>请选择整套求购</option>
                                                <option value="整套求购" <?php  if($item['way'] == '整套求购') { ?> selected='selected'<?php  } ?>>整套求购</option>
                                                <?php  } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content ">
                                    <div class="item-inner">
                                        <div class="item-title" style="width: 5em">房屋类型:</div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <select id="model_room">
                                                <option value="1" <?php  if($item['model_room'] == '1') { ?>selected='selected' <?php  } ?>>1室</option>
                                                <option value="2" <?php  if($item['model_room'] == '2') { ?>selected='selected' <?php  } ?>>2室</option>
                                                <option value="3" <?php  if($item['model_room'] == '3') { ?>selected='selected' <?php  } ?>>3室</option>
                                                <option value="4" <?php  if($item['model_room'] == '4') { ?>selected='selected' <?php  } ?>>4室</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <select id="model_hall">
                                                <option value="0" <?php  if($item['model_hall'] == '0') { ?>selected='selected' <?php  } ?>>0厅</option>
                                                <option value="1" <?php  if($item['model_hall'] == '1') { ?>selected='selected' <?php  } ?>>1厅</option>
                                                <option value="2" <?php  if($item['model_hall'] == '2') { ?>selected='selected' <?php  } ?>>2厅</option>
                                                <option value="3" <?php  if($item['model_hall'] == '3') { ?>selected='selected' <?php  } ?>>3厅</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <select id="model_toilet">
                                                <option value="0" <?php  if($item['model_toilet'] == '0') { ?>selected='selected' <?php  } ?>>0卫</option>
                                                <option value="1" <?php  if($item['model_toilet'] == '1') { ?>selected='selected' <?php  } ?>>1卫</option>
                                                <option value="2" <?php  if($item['model_toilet'] == '2') { ?>selected='selected' <?php  } ?>>2卫</option>
                                                <option value="3" <?php  if($item['model_toilet'] == '3') { ?>selected='selected' <?php  } ?>>3卫</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">面积：</div>
                                        <div class="item-input">
                                            <input type="number" id="model_area" placeholder="面积（单位平方米）" value="<?php  echo $item['model_area'];?>">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content ">
                                    <div class="item-inner"style="width: 50%">
                                        <div class="item-title " >楼层:</div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="text" placeholder="第多少层" id="floor_layer" value="<?php  echo $item['floor_layer'];?>">
                                        </div>
                                    </div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="text" placeholder="共多少层" id="floor_number" value="<?php  echo $item['floor_number'];?>">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content item-link">
                                    <div class="item-inner">
                                        <div class="item-title label">装修情况:</div>
                                        <div class="item-input">
                                            <select id="fitment">
                                                <option value="">请选择装修</option>
                                                <option value="毛坯" <?php  if($item['fitment'] == '毛坯') { ?>selected='selected' <?php  } ?>>毛坯</option>
                                                <option value="简单装修" <?php  if($item['fitment'] == '简单装修') { ?>selected='selected' <?php  } ?>>简单装修</option>
                                                <option value="中等装修" <?php  if($item['fitment'] == '中等装修') { ?>selected='selected' <?php  } ?>>中等装修</option>
                                                <option value="精装修" <?php  if($item['fitment'] == '精装修') { ?>selected='selected' <?php  } ?>>精装修</option>
                                                <option value="豪华装修" <?php  if($item['fitment'] == '豪华装修') { ?>selected='selected' <?php  } ?>>豪华装修</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content item-link">
                                    <div class="item-inner">
                                        <div class="item-title label">住宅类别:</div>
                                        <div class="item-input">
                                            <select id="house">
                                                <option value="">请选择住宅类别</option>
                                                <option value="普通住宅" <?php  if($item['house'] == '普通住宅') { ?>selected='selected' <?php  } ?>>普通住宅</option>
                                                <option value="平房/四合院" <?php  if($item['house'] == '平房/四合院') { ?>selected='selected' <?php  } ?>>平房/四合院</option>
                                                <option value="公寓" <?php  if($item['house'] == '公寓') { ?>selected='selected' <?php  } ?>>公寓</option>
                                                <option value="别墅" <?php  if($item['house'] == '别墅') { ?>selected='selected' <?php  } ?>>别墅</option>
                                                <option value="商住两用" <?php  if($item['house'] == '商住两用') { ?>selected='selected' <?php  } ?>>商住两用</option>
                                                <option value="其他" <?php  if($item['house'] == '其他') { ?>selected='selected' <?php  } ?>>其他</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content ">
                                    <div class="item-inner">
                                        <div class="item-title label">房屋配置:</div>
                                        <div class="item-input">
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="床铺" <?php  if(strstr($item['allocation'],'床铺') || empty($item['allocation'])) { ?>checked <?php  } ?>>
                                                <div class="item-media"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>床铺</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="暖气" <?php  if(strstr($item['allocation'],'暖气')) { ?>checked <?php  } ?>>
                                                <div class="item-media"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>暖气</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="电视" <?php  if(strstr($item['allocation'],'电视')) { ?>checked <?php  } ?>>
                                                <div class="item-media"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>电视</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="空调" <?php  if(strstr($item['allocation'],'空调')) { ?>checked <?php  } ?>>
                                                <div class="item-media"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>空调</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="冰箱" <?php  if(strstr($item['allocation'],'冰箱')) { ?>checked <?php  } ?>>
                                                <div class="item-media"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>冰箱</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="家具" <?php  if(strstr($item['allocation'],'家具')) { ?>checked <?php  } ?>>
                                                <div class="item-media"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>家具</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="煤气" <?php  if(strstr($item['allocation'],'煤气')) { ?>checked <?php  } ?>>
                                                <div class="item-media"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>煤气</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="洗衣机" <?php  if(strstr($item['allocation'],'洗衣机')) { ?>checked <?php  } ?>>
                                                <div class="item-media" style="width: 33%"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>洗衣机</span></div>
                                            </label>
                                            <label class="label-checkbox">
                                                <input type="checkbox" name="allocation" value="热水器" <?php  if(strstr($item['allocation'],'热水器')) { ?>checked <?php  } ?>>
                                                <div class="item-media"style="width: 33%"><i class="icon icon-form-checkbox icon-houselease-checkbox"></i> <span>热水器</span></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php  if($category == 1 || $category == 2) { ?>
                            <li>
                                <div class="item-content item-link">
                                    <div class="item-inner">
                                        <div class="item-title label">押金方式:</div>
                                        <div class="item-input">
                                            <select id="price_way">
                                                <option value="">请选择押金方式</option>
                                                <option value="押一付一" <?php  if($item['price_way'] == '押一付一') { ?>selected='selected' <?php  } ?>>押一付一</option>
                                                <option value="押一付二" <?php  if($item['price_way'] == '押一付二') { ?>selected='selected' <?php  } ?>>押一付二</option>
                                                <option value="押一付三" <?php  if($item['price_way'] == '押一付三') { ?>selected='selected' <?php  } ?>>押一付三</option>
                                                <option value="押二付一" <?php  if($item['price_way'] == '押二付一') { ?>selected='selected' <?php  } ?>>押二付一</option>
                                                <option value="押二付二" <?php  if($item['price_way'] == '押二付二') { ?>selected='selected' <?php  } ?>>押二付二</option>
                                                <option value="押二付三" <?php  if($item['price_way'] == '押二付三') { ?>selected='selected' <?php  } ?>>押二付三</option>
                                                <option value="面议" <?php  if($item['price_way'] == '面议') { ?>selected='selected' <?php  } ?>>面议</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php  } ?>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label"><?php  if($category == 3 || $category == 4) { ?>总金额<?php  } else { ?>租金<?php  } ?>：</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="<?php  if($category == 3 || $category == 4) { ?>万元/套<?php  } else { ?>元/月<?php  } ?>" id="price" value="<?php  echo $item['price'];?>">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php  if($category == 1 || $category == 2) { ?>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">入住时间：</div>
                                        <div class="item-input">
                                            <input type="date" placeholder="年/月/日" id="checktime" value="<?php  if($item['checktime']) { ?><?php  echo $item['checktime'];?><?php  } else { ?>今天/随时<?php  } ?>">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php  } ?>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">标题：</div>
                                        <div class="item-input">
                                            <input type="text" placeholder="必填项" id="tit" value="<?php  echo $item['title'];?>">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <textarea placeholder="其他说明,长度5-200个字之间。" id="content"><?php  echo $item['content'];?></textarea>
                                            <div class="textarea-counter">
                                                <span>0</span>/200
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="photoList">
                                            <ul style="padding-left: 0px">
                                                <?php  if(is_array($imgs)) { foreach($imgs as $img) { ?>
                                                <li id="li<?php  echo $img['id'];?>">
                                                    <div class="photoCut">
                                                        <img src="<?php  echo tomedia($img['src'])?>" class="attchImg" alt="photo">
                                                    </div>
                                                    <a href="javascript:;" class="cBtn spr db " onclick="del(<?php  echo $img['id'];?>)" title="" _id="<?php  echo $img['id'];?>" style="width: 0;height: 0;background: 0;text-indent: 0;left: 50px;"><img src="<?php echo MODULE_URL;?>template/mobile/default/static/images/del.png" style="width: 25px;height: 25px;"></a>
                                                    <input type="hidden" id="inputnull" name="picIds[]" value="<?php  echo $img['id'];?>">
                                                </li>
                                                <?php  } } ?>
                                                <li class="on" id="addPic">
                                                    <input type="file" class="on needsclick" id="uploadFile">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="content-block">
                            <a href="#" class="button button-big button-fill button-success" id="showToast">提交信息</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#showToast").click(function(event) {
            var title = $("#tit").val();
            if (title == '') {
                alert('标题不能为空！');
                return false
            };
            var model_area = $("#model_area").val();
            var floor_layer = $("#floor_layer").val();
            var price = $("#price").val();
            if (price == '') {
                alert('租金必填！');
                return false
            };
            var allocation = " ";
            if ($('input[name="allocation"]:checked').length >1) {
                $('input[name="allocation"]:checked').each(function(){
                    var t2 = $(this).val();
                    allocation += t2+',';
                });
            }else{
                allocation =$('input[name="allocation"]:checked').val();
            }
            if (allocation == '') {
                alert('房屋配置必须选择！');
                return false
            };
            var category = "<?php  echo $category;?>";
            var way = $("#way").val();
            if (way == '0') {
                alert('请选择租赁方式');
                return false
            };
            var model_room = $("#model_room").val();
            var model_hall = $("#model_hall").val();
            var model_toilet = $("#model_toilet").val();
            var floor_number = $("#floor_number").val();
            var fitment = $("#fitment").val();
            if (fitment == '1') {
                alert('请选择装修情况');
                return false;
            };
            var house = $("#house").val();
            var price_way = $("#price_way").val();
            var checktime = $("#checktime").val();
            var content = $("#content").val();
            var picIds ='';
            $('input[name="picIds[]"]').each(function(){
                var t1 = $(this).val();
                picIds += t1+',';
            });
            var id ='<?php  echo $_GPC['id'];?>';
            $.ajax({
                url: "<?php  echo $this->createMobileUrl('houselease',array('op' => 'add'))?>",
                dataType: 'json',
                data: {
                    title: title,
                    category: category,
                    model_area: model_area,
                    floor_layer: floor_layer,
                    price: price,
                    way: way,
                    model_room: model_room,
                    model_hall: model_hall,
                    model_toilet: model_toilet,
                    floor_number: floor_number,
                    fitment:fitment,
                    house:house,
                    allocation:allocation,
                    price_way:price_way,
                    checktime:checktime,
                    content:content,
                    picIds :picIds,
                    id:id
                },
                success: function(s) {
                    if (s.status == 1) {
                        $.toast('提交成功');
                        setTimeout(function() {

                            window.location.href="<?php  echo $this->createMobileUrl('houselease',array('op' => 'list'))?>";
                        }, 3000);
                    };
                }
            })
        });
    })
</script>
<script>$.config = {autoInit: true}</script>
<script type="text/javascript" src="<?php echo MODULE_URL;?>template/mobile/default/static/js/light7.js" charset="utf-8"></script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('default/footer', TEMPLATE_INCLUDEPATH)) : (include template('default/footer', TEMPLATE_INCLUDEPATH));?>
<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><a class="glyphicon glyphicon-arrow-left" href="<?php  echo $this->createWebUrl('region')?>"></a>&nbsp;&nbsp;&nbsp;添加小区</h5>
                </div>
                <div class="ibox-content">
    <form action="" class="form-horizontal form" method="post" role="form" enctype="multipart/form-data" onsubmit="return check(this);">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>">

            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">小区名称</label>
                <div class="col-sm-5">
                  <input type='text' name='title' id='title' class="form-control" value="<?php  echo $item['title'];?>" placeHolder="请输入小区名称"/>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
              <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">选择物业</label>
                  <div class="col-sm-5">
                      <select name='pid' class="form-control" id="pid">
                          <option value="0">选择物业</option>
                            <?php  if(is_array($propertys)) { foreach($propertys as $property) { ?>
                          <option value="<?php  echo $property['id'];?>" <?php  if($property['id'] == $item['pid']) { ?>selected <?php  } ?> > <?php  echo $property['title'];?></option>
                            <?php  } } ?>
                      </select>
                  </div>
              </div>
        <div class="hr-line-dashed"></div>
              <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">触发关键字</label>
                  <div class="col-sm-5">
                      <input type='text' name='keyword' id='keyword' class="form-control" value="<?php  echo $item['keyword'];?>" placeHolder="请输入触发关键字"/>
                      <span class="help-block" style="color:red">主要用于关联小区二维码,后期会拓展其他功能,尽量填写小区名称，不能和其他小区有重复</span>
                  </div>

              </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="linkmen" class="col-sm-2 control-label">联系人</label>
                <div class="col-sm-5">
                  <input type='text' name='linkmen' id='linkmen' class="form-control" value="<?php  echo $item['linkmen'];?>" placeHolder="请输入联系人"/>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="linkway" class="col-sm-2 control-label">联系电话</label>
                <div class="col-sm-5">
                  <input type='text' name='linkway' class="form-control" id='linkway' value="<?php  echo $item['linkway'];?>" placeHolder="请输入联系电话"/>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="qq" class="col-sm-2 control-label">联系QQ</label>
                <div class="col-sm-5">
                  <input type='text' name='qq' class="form-control" id='qq' value="<?php  echo $item['qq'];?>" placeHolder="此处QQ为我的小区里面的客服QQ"/>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="linkway" class="col-sm-2 control-label">小区图片</label>
                <div class="col-sm-5">
                  <?php  echo tpl_form_field_image('thumb', $item['thumb'])?>
                    <span class="help-block">建议比例:60px*60px</span>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
              <div class="form-group">
                  <label for="linkway" class="col-sm-2 control-label">图文图片</label>
                  <div class="col-sm-5">
                      <?php  echo tpl_form_field_image('pic', $item['pic'])?>
                      <span class="help-block">建议比例:360像素 * 200像素<span style="color: red">(独立小区二维码图片)</span></span>
                  </div>
              </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="text-danger">*</span> 地址</label>
                <div class="col-sm-5">
                    <?php  echo tpl_form_field_district('reside',array('province' => $item['province'],'city' => $item['city'],'district' => $item['dist']));?>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="linkway" class="col-sm-2 control-label">详细地址</label>
                <div class="col-sm-5">
                  <input type='text' name='address' class="form-control" id='address' value="<?php  echo $item['address'];?>" placeHolder="请输入小区地址"/>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="linkway" class="col-sm-2 control-label">坐标</label>
                <div class="col-sm-5">
                  <?php  echo tpl_form_field_coordinate('baidumap', $item)?>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="linkway" class="col-sm-2 control-label">外部链接</label>
                <div class="col-sm-5">
                  <?php  echo tpl_form_field_link('url',$item['url'])?>
                </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12 help-block">如需要链接到外部网站,请在此设置网址。                  </div>
            </div>
        <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-5">
                   <button type="submit" class="btn btn-w-m btn-primary" name="submit" value="提交">提交</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        function check(form){
                if (!form['title'].value) {
                    alert('请输入小区名称。');
                    return false;
                }
                if (!form['linkway'].value) {
                    alert('请输入正确的电话号码！');
                    return false;
                }
                if (!form['linkmen'].value) {
                    alert('请输入联系人姓名。');
                    return false;
                }
                if (!form['address'].value) {
                    alert('请输入小区地址。');
                    return false;
                }
                return true;
        }
    </script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
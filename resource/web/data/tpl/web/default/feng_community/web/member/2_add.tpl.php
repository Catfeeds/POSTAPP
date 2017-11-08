<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li><a href="<?php  echo $this->createWebUrl('member', array('op' => 'list'));?>">业主管理</a></li>
    <li class="active"><a href="<?php  echo $this->createWebUrl('member', array('op' => 'add','id'=>$_GPC['id']));?>">编辑</a></li>
</ul>
<form action="" class="form-horizontal form" method="post">
    <input name="id" type="hidden" value="<?php  echo $item['id'];?>" class='form-control'/>
    <input name="memberid" type="hidden" value="<?php  echo $item['memberid'];?>" class='form-control'/>
    <input name="uid" type="hidden" value="<?php  echo $item['uid'];?>" class='form-control'/>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">修改信息</h3>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">小区</label>
                <div class="col-sm-5">
                    <select id="regionid" name="regionid" class='form-control'>
                        <option value="0">选择小区</option>
                        <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                        <option value="<?php  echo $region['id'];?>" <?php  if($item['regionid']==$region['id']) { ?>selected='selected'<?php  } ?>><?php  echo $region['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">姓名</label>
                <div class="col-xs-5">

                        <input type="text" name="realname" value="<?php  if($item['realname']) { ?><?php  echo $item['realname'];?><?php  } ?>" class="form-control"
                        />

                </div>
            </div>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">电话</label>
                <div class="col-xs-5">

                    <input type="text" name="mobile" value="<?php  if($item['mobile']) { ?><?php  echo $item['mobile'];?><?php  } ?>" class="form-control"
                    />

                </div>
            </div>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">车牌号</label>
                <div class="col-xs-5">

                    <input type="text" name="license" value="<?php  if($item['license']) { ?><?php  echo $item['license'];?><?php  } ?>" class="form-control"
                    />

                </div>
            </div>
            <?php  if($arr['a']) { ?>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">区</label>
                <div class="col-xs-5">
                    <div class="input-group">
                        <input type="text" name="area" value="<?php  if($item['area']) { ?><?php  echo $item['area'];?><?php  } ?>" class="form-control"
                        />
                        <span class="input-group-addon">区</span>
                    </div>
                </div>
            </div>
            <?php  } ?>
            <?php  if($arr['b']) { ?>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">楼栋</label>
                <div class="col-xs-5">
                    <div class="input-group">
                        <input type="text" name="build" value="<?php  if($item['build']) { ?><?php  echo $item['build'];?><?php  } ?>" class="form-control"
                        />
                        <span class="input-group-addon">栋</span>
                    </div>
                </div>
            </div>
            <?php  } ?>
            <?php  if($arr['c']) { ?>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">单元</label>
                <div class="col-xs-5">
                    <div class="input-group">
                        <input type="text" name="unit" value="<?php  if($item['unit']) { ?><?php  echo $item['unit'];?><?php  } ?>" class="form-control"
                        />
                        <span class="input-group-addon">单元</span>
                    </div>
                </div>
            </div>
            <?php  } ?>
            <?php  if($arr['d']) { ?>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">室</label>
                <div class="col-xs-5">
                    <div class="input-group">
                        <input type="text" name="room" value="<?php  if($item['room']) { ?><?php  echo $item['room'];?><?php  } ?>" class="form-control"
                        />
                        <span class="input-group-addon">室</span>
                    </div>
                </div>
            </div>
            <?php  } ?>
            <div class="form-group">
                <label for="room" class="col-sm-2 control-label">地址</label>
                <div class="col-xs-5">

                        <input type="text" name="address" value="<?php  if($item['address']) { ?><?php  echo $item['address'];?><?php  } ?>" class="form-control"
                        />

                        <span style="color: red">修改区，栋，单元，室时，请同步修改地址</span>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                    <button type="submit" class="btn btn-primary span1" name="submit" value="提交">提交</button>
                </div>

            </div>
        </div>
    </div>
</form>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/footer', TEMPLATE_INCLUDEPATH)) : (include template('web/common/footer', TEMPLATE_INCLUDEPATH));?>
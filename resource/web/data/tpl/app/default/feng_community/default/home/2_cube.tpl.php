<?php defined('IN_IA') or exit('Access Denied');?><style>
    .sui-cube {height: 0; width: 100%; margin: 0rem 0; padding-bottom: 50%; position: relative;}
    .sui-cube .sui-cube-left {width: 50%; height: 100%; position: absolute; top: 0; left: 0;}
    .sui-cube .sui-cube-right {width: 50%; height: 100%; position: absolute; top: 0; left: 50%;}
    .sui-cube .sui-cube-right1 {width: 100%; height: 50%; position: absolute; top: 0; left: 0;}
    .sui-cube .sui-cube-right1 .left {width: 50%; height: 100%; position: absolute; top: 0; left: 0;}
    .sui-cube .sui-cube-right1 .right {width: 50%; height: 100%; position: absolute; top: 0; left: 50%;}
    .sui-cube .sui-cube-right2 {width: 100%; height: 50%; position: absolute; top: 50%; left: 0;}
    .sui-cube .sui-cube-right2 .left {width: 50%; height: 100%; position: absolute; top: 0; left: 0;}
    .sui-cube .sui-cube-right2 .right {width: 50%; height: 100%; position: absolute; top: 0; left: 50%;}
    .sui-cube img {width: 100%; height: 100%;}
    .sui-cube1 img {width: 100%; height: 100%;}
    .sui-cube1 {height: 0; width: 100%; margin: 0rem 0; padding-bottom: 25%; position: relative;}
    .sui-cube1 .left1 {width: 50%; height: 100%; position: absolute; top: 0; left: 0;}
    .sui-cube1 .right1 {width: 50%; height: 100%; position: absolute; top: 0; left: 50%;}
</style>
<?php  if(!empty($cubes) && count($cubes)<6) { ?>

<div class="sui-cube">
    <?php  if(count($cubes)==1) { ?>
    <img src="<?php  echo tomedia($cubes[0]['thumb'])?>" <?php  if(!empty($cubes[0]['url'])) { ?>onclick="location.href='<?php  echo $cubes[0]['url'];?>'"<?php  } ?> style='width: 100%; height: 100%; position: absolute; top: 0; left: 0;'/>
    <?php  } ?>
    <?php  if(count($cubes)>1) { ?>
    <div class="sui-cube-left">
        <img src="<?php  echo tomedia($cubes[0]['thumb'])?>" <?php  if(!empty($cubes[0]['url'])) { ?>onclick="location.href='<?php  echo $cubes[0]['url'];?>'"<?php  } ?> />
    </div>
    <div class="sui-cube-right">
        <?php  if(count($cubes)==2) { ?>
        <img src="<?php  echo tomedia($cubes[1]['thumb'])?>" <?php  if(!empty($cubes[1]['url'])) { ?>onclick="location.href='<?php  echo $cubes[1]['url'];?>'"<?php  } ?> />
        <?php  } ?>
        <?php  if(count($cubes)>2) { ?>
        <div class="sui-cube-right1">
            <?php  if(count($cubes)<5) { ?>
            <img src="<?php  echo tomedia($cubes[1]['thumb'])?>" <?php  if(!empty($cubes[1]['url'])) { ?>onclick="location.href='<?php  echo $cubes[1]['url'];?>'"<?php  } ?> />
            <?php  } ?>
            <?php  if(count($cubes)==5) { ?>
            <div class="left">
                <img src="<?php  echo tomedia($cubes[1]['thumb'])?>" <?php  if(!empty($cubes[1]['url'])) { ?>onclick="location.href='<?php  echo $cubes[1]['url'];?>'"<?php  } ?> />
            </div>
            <div class="right">
                <img src="<?php  echo tomedia($cubes[2]['thumb'])?>" <?php  if(!empty($cubes[2]['url'])) { ?>onclick="location.href='<?php  echo $cubes[2]['url'];?>'"<?php  } ?> />
            </div>
            <?php  } ?>
        </div>
        <div class="sui-cube-right2">
            <?php  if(count($cubes)==3) { ?>
            <img src="<?php  echo tomedia($cubes[2]['thumb'])?>" <?php  if(!empty($cubes[2]['url'])) { ?>onclick="location.href='<?php  echo $cubes[2]['url'];?>'"<?php  } ?> />
            <?php  } ?>
            <?php  if(count($cubes)==4) { ?>
            <div class="left">
                <img src="<?php  echo tomedia($cubes[2]['thumb'])?>" <?php  if(!empty($cubes[2]['url'])) { ?>onclick="location.href='<?php  echo $cubes[2]['url'];?>'"<?php  } ?> />
            </div>
            <div class="right">
                <img src="<?php  echo tomedia($cubes[3]['thumb'])?>" <?php  if(!empty($cubes[3]['url'])) { ?>onclick="location.href='<?php  echo $cubes[3]['url'];?>'"<?php  } ?> />
            </div>
            <?php  } ?>
            <?php  if(count($cubes)==5) { ?>
            <div class="left">
                <img src="<?php  echo tomedia($cubes[3]['thumb'])?>" <?php  if(!empty($cubes[3]['url'])) { ?>onclick="location.href='<?php  echo $cubes[3]['url'];?>'"<?php  } ?> />
            </div>
            <div class="right">
                <img src="<?php  echo tomedia($cubes[4]['thumb'])?>" <?php  if(!empty($cubes[4]['url'])) { ?>onclick="location.href='<?php  echo $cubes[4]['url'];?>'"<?php  } ?> />
            </div>
            <?php  } ?>
        </div>
        <?php  } ?>
    </div>
    <?php  } ?>
</div>
<?php  } ?>
<?php  if(count($cubes)==6) { ?>
<div class="sui-cube1">
    <div class="left1">
        <img src="<?php  echo tomedia($cubes[0]['thumb'])?>" <?php  if(!empty($cubes[0]['url'])) { ?>onclick="location.href='<?php  echo $cubes[0]['url'];?>'"<?php  } ?> />
    </div>
    <div class="right1">
        <img src="<?php  echo tomedia($cubes[1]['thumb'])?>" <?php  if(!empty($cubes[1]['url'])) { ?>onclick="location.href='<?php  echo $cubes[1]['url'];?>'"<?php  } ?> />
    </div>
</div>
<div class="sui-cube1">
    <div class="left1">
        <img src="<?php  echo tomedia($cubes[2]['thumb'])?>" <?php  if(!empty($cubes[2]['url'])) { ?>onclick="location.href='<?php  echo $cubes[2]['url'];?>'"<?php  } ?> />
    </div>
    <div class="right1">
        <img src="<?php  echo tomedia($cubes[3]['thumb'])?>" <?php  if(!empty($cubes[3]['url'])) { ?>onclick="location.href='<?php  echo $cubes[3]['url'];?>'"<?php  } ?> />
    </div>
</div>
<div class="sui-cube1">
    <div class="left1">
        <img src="<?php  echo tomedia($cubes[4]['thumb'])?>" <?php  if(!empty($cubes[4]['url'])) { ?>onclick="location.href='<?php  echo $cubes[4]['url'];?>'"<?php  } ?> />
    </div>
    <div class="right1">
        <img src="<?php  echo tomedia($cubes[5]['thumb'])?>" <?php  if(!empty($cubes[5]['url'])) { ?>onclick="location.href='<?php  echo $cubes[5]['url'];?>'"<?php  } ?> />
    </div>
</div>
<?php  } ?>

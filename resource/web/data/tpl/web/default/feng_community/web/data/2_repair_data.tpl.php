<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>报修统计</h5>
                </div>
                <div class="ibox-content">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site"/>
            <input type="hidden" name="a" value="entry"/>
            <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
            <input type="hidden" name="do" value="data"/>
            <input type="hidden" name="op" value="repair"/>

            <div class="form-group">
                <label for="" class="col-sm-1 control-label">小区:</label>
                <div class="col-sm-3">
                    <select name="regionid" class="form-control">
                        <option value="">全部</option>
                        <?php  if(is_array($regions)) { foreach($regions as $region) { ?>
                        <option value="<?php  echo $region['id'];?>" <?php  if($region['id']==$_GPC['regionid']) { ?>selected<?php  } ?>><?php  echo $region['city'];?><?php  echo $region['dist'];?><?php  echo $region['title'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <label for="" class="col-sm-2 control-label">周期选择:</label>
                <div class="col-sm-3">
                    <select name="xqday" class="form-control">
                        <option value="1" <?php  if($xqday == 1) { ?>selected="selected" <?php  } ?>>过去7天</option>
                        <option value="2" <?php  if($xqday == 2) { ?>selected="selected" <?php  } ?>>过去一月</option>
                        <option value="3" <?php  if($xqday == 3) { ?>selected="selected" <?php  } ?>>过去三月</option>
                        <option value="4" <?php  if($xqday == 4) { ?>selected="selected" <?php  } ?>>过去半年</option>
                        <option value="5" <?php  if($xqday == 5) { ?>selected="selected" <?php  } ?>>过去一年</option>
                    </select>
                </div>
                <button class="btn btn-primary ">查询</button>
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
            </div>
        </form>

    <div class="panel-body">
        <div class="clearfix" id="clear" style="margin-left: 50px;">
            <div class="panel-default" style="padding:1em;border-radius: 0px;">
                <div class="row m-t-20">
                    <div class="col-sm-6" id="repair-1" style="height: 500px; " >

                    </div>
                    <div class="col-sm-6" id="repair-2" style="height: 500px;" >

                    </div>
                </div>
            </div>
        </div>
    </div>
                </div></div></div></div></div>
</body>


<script type="text/javascript">
    var myChart1 = echarts.init(document.getElementById('repair-1'), 'macarons');
    myChart1.setOption(
        option = {
            title: {
                text: '总计：<?php  echo $total;?>',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: ['未处理', '处理中', '已解决',]
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
                    magicType : {show: true, type: []},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable: true,
            series: [
                {
                    name: '处理状态',
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', 225],
                    data: [
                        {value: <?php  echo $total2;?>, name: '未处理'}, {value: <?php  echo $total3;?>, name: '处理中'}, {value: <?php  echo $total1;?>, name: '已解决'},]
                }
            ]
        });
    var myChart2 = echarts.init(document.getElementById('repair-2'), 'macarons');
    option2 = {
        title: {
            text: '总计：<?php  echo $ranktotal;?>',
            x: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: []},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data: [

                 '不满意', '一般', '满意',]
        },
        calculable: true,
        series: [
            {
                name: '用户评分',
                type: 'pie',
                radius: '55%',
                center: ['50%', 225],
                data: [
                    {value: <?php  echo $ranktotal3;?>, name: '不满意'}, {value:  <?php  echo $ranktotal2;?>, name: '一般'}, {
                        value:  <?php  echo $ranktotal1;?>,
                        name: '满意'
                    },]
            }
        ]
    };
    myChart2.setOption(option2);
    setTimeout(function () {
        window.onresize = function () {
            myChart1.resize();
            myChart2.resize();
        }
    }, 200)

</script>




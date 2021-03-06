<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('web/common/header-base', TEMPLATE_INCLUDEPATH));?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>商家订单管理</h5>
                </div>
                <div class="ibox-content">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site"/>
            <input type="hidden" name="a" value="entry"/>
            <input type="hidden" name="m" value="<?php  echo $this->module['name']?>"/>
            <input type="hidden" name="do" value="data"/>
            <input type="hidden" name="op" value="business"/>

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

                <button class="btn btn-primary ">查询</button>
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
            </div>
        </form>
    <div class="panel-body">
        <div class="clearfix" id="clear" style="margin-left: 50px;">
            <div class="panel-default" style="padding:1em;border-radius: 0px;">
                <div class="row m-t-20">

                    <div class="col-sm-12" id="member-2" style="height: 500px;" >

                    </div>
                </div>
            </div>
        </div>
    </div>
                </div></div></div></div></div>
</body>




<script type="text/javascript">

    var myChart2 = echarts.init(document.getElementById('member-2'), 'macarons');
    var label = <?php  echo json_encode($day)?>;
    var datasets =  <?php  echo json_encode($hit)?>;
    option2 = {
        title : {
            text: '最近7天商家订单数据统计',
            subtext: ''
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['商家订单']
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                data : label
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'商家订单',
                type:'bar',
                data:datasets,
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            }
        ]
    };

    myChart2.setOption(option2);
    setTimeout(function () {
        window.onresize = function () {
            myChart2.resize();
        }
    }, 200)

</script>




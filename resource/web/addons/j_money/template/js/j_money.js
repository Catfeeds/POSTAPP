/*
第一步：必须在页面加载sweetalert插件；
<script src="../addons/j_money/template/js/sweetalert.min.js" language="javascript"></script>
<link type="text/css" rel="stylesheet" href="../addons/j_money/template/js/sweetalert.css"/>
第二步：必须加载jquery1.11以上；
第三步：必须是基于微擎；

调用例子：
jetsumpay.checkModal({"uniacid":8});
jetsumpay.scanpay({"uniacid":8,"shopid":"2","oldtradeno":"123123","fee":"0.1","success":function(){xxxxxxx}});
jetsumpay.checkWechatPay({"uniacid":8,"ordersn":"123123"});
*/
var jetsumpay ={
	/*
	检查是否已经购买了【捷*讯*收银台】
	*/
	checkModal:function(param){
		var $default={
			'uniacid':param.uniacid ? param.uniacid : getUrlParam('i'),
		}
		$.ajax({
			type: "POST",
			url: "/app/index.php?i="+$default.uniacid+"&c=entry&do=cloudapi&m=j_money&op=api_checkmodal",
			data: "name=John&location=Boston",
			success: function(data){
				console.log(data);
				var feedback=eval("("+data+")");
				if(feedback.success){
					if(typeof(param.success)=='function'){param.success();}
				}else{
					if(typeof(param.falsed)=='function'){param.falsed();}
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				return false;
			}
		});
	},
	scanpay:function(param) {
		var $default={
			'shopid':param.shopid ? param.shopid : 0,
			'oldtradeno':param.oldtradeno ? param.oldtradeno : 0,
			'fee':param.fee ? param.fee : 0,//金额为0.01元格式
			'uniacid':param.uniacid ? param.uniacid : getUrlParam('i'),
		}
		if(typeof(param.success)=='function'){$default.success=param.success;}
		
		if(!$default.shopid){swal("店铺ID不能为空");return false;}
		if(!$default.oldtradeno){swal("订单号不能为空");return false;}
		if(!$default.fee){swal("金额不能为空");return false;}
		
		swal({ 
			title: "刷卡支付",   
			text: "收款金额为<span style='color:#F00'>￥"+$default.fee+"元</span>",
			type: "input",
			html:true,
			showLoaderOnConfirm: true,
			showCancelButton: true,   
			closeOnConfirm: false,
			confirmButtonText: "确认收款",
			cancelButtonText: "关闭",  
			inputPlaceholder: "请扫描客户的付款二维码" 
			}, function(inputValue){
			if (inputValue === false) return false;
			if (inputValue === "") {
				swal.showInputError("请扫描客户的付款二维码");     
				return false
			}
			swal({title:"请稍后",showConfirmButton:false});
			$default.qrcode=inputValue;
			if(inputValue.substr(0,1)=="1"){
				console.log("使用【微信】刷卡支付");
				jetsumpay._scanWechatPay($default);
			}else{
				console.log("使用【支付宝】刷卡支付");
				jetsumpay._scanAliPay($default);
			}
		});
	},
	_scanWechatPay:function(param) {
		var $default={
			'shopid':param.shopid ? param.shopid : 0,
			'oldtradeno':param.oldtradeno ? param.oldtradeno : 0,
			'fee':param.fee ? param.fee : 0,
			'qrcode':param.qrcode ? param.qrcode : 0,
			'uniacid':param.uniacid ? param.uniacid : getUrlParam('i'),
		}
		if(typeof(param.success)=='function'){$default.success=param.success;}
		if(!$default.shopid){swal("店铺ID不能为空");return false;}
		if(!$default.oldtradeno){swal("订单号不能为空");return false;}
		if(!$default.fee){swal("金额不能为空");return false;}
		if(!$default.qrcode){swal("付款码不能为空");return false;}
		
		$.post("/app/index.php?i="+$default.uniacid+"&c=entry&do=cloudapi&m=j_money&op=api_wechatqr",{
			"qrcode":$default.qrcode,
			"shopid":$default.shopid,
			"fee":$default.fee,
			"oldtradeno":$default.oldtradeno
		},function(data){			
			console.log(data);
			var feedback=eval("("+data+")");
			if(feedback.success){
				var temp=feedback.item;
				$default.ordersn=feedback.orderid;
				if(temp['result_code']=="SUCCESS"){
					if(typeof(param.success)=='function'){
						swal({
								title: "支付成功", 
							},
						    function(isConfirm){
								if (isConfirm) {
									param.success($default.ordersn);
								} 
							}
						);
					}else{
						swal({title:"支付成功",timer:3000});
					}
				}else{
					if(temp['err_code']=="USERPAYING"){
						setTimeout(function(){
							jetsumpay.checkWechatPay($default);
						},4000);
						swal({
							title: "温馨提示",   
							text: "等待客户输入支付密码",
							confirmButtonText: "关闭订单",
							}, function(isConfirm){
								if (isConfirm) {
									deleteOrder(temp['out_trade_no']);
								}
							}
						);
					}else{
						swal(temp['err_code_des']);
					}
				}
			}else{
				swal(feedback.msg);
			}
		})
	},
	checkWechatPay:function(param){
		var $default={
			'uniacid':param.uniacid ? param.uniacid : getUrlParam('i'),
			'ordersn':param.ordersn ? param.ordersn : 0,
		}
		if(typeof(param.success)=='function'){$default.success=param.success;}
		if(!$default.uniacid){swal("UNIACID不能为空");return false;}
		if(!$default.ordersn){swal("订单编号不能为空");return false;}
		$.post("/app/index.php?i="+$default.uniacid+"&c=entry&do=cloudapi&m=j_money&op=api_checwechat",{"orderid":$default.ordersn},function(data){
			console.log(data);
			var feedback=eval("("+data+")");
			if(feedback.success){
				var temp=feedback.items;
				if(feedback.paystatus){
					if(typeof(param.success)=='function'){
						swal({
								title: "支付成功", 
							},
						    function(isConfirm){
								if (isConfirm) {
									param.success(ordersn);
								} 
							}
						);
					}else{
						swal({title:"支付成功",timer:3000});
					}
				}else if(temp['trade_state']=="NOTPAY"){
					swal("用户自动取消支付");
				}else if(temp['trade_state']=="USERPAYING"){
					setTimeout(function(){
						jetsumpay.checkWechatPay($default);
					},4000);
				}else{
					swal("支付失败，未知错误!");
				}
			}else{
				swal(feedback.msg);
			}
		});
	},
	/*
	订单查询
	ordersn：订单编号，编号是自己模块的单号；
	*/
	checkOrderPay:function(param){
		var $default={
			'uniacid':param.uniacid ? param.uniacid : getUrlParam('i'),
			'ordersn':param.ordersn ? param.ordersn : 0,
		}
		if(typeof(param.success)=='function'){$default.success=param.success;}
		if(!$default.uniacid){swal("UNIACID不能为空");return false;}
		if(!$default.ordersn){swal("订单编号不能为空");return false;}
		$.post("/app/index.php?i="+$default.uniacid+"&c=entry&do=cloudapi&m=j_money&op=api_checorderpay",{"orderid":$default.ordersn},function(data){
			console.log(data);
			var feedback=eval("("+data+")");
			if(feedback.success){
				var temp=feedback.item;
				return temp;
			}else{
				swal(feedback.msg);
			}
		});
	},
	/*****
	打印参数：
	uniacid：就是uniacid，
	ordersn：订单编号，编号是自己模块的单号，或者是收银台订单号，注意：当printtype=1时必填
	printid：收银台打印模块的ID号；
	printtype：打印类型，1是打印订单小票，2是打印卡券小票，3是自定打印。
	printdoc:需要打印的内容；
	当printtype=3时，不存入printdoc内容，系统则返回printid的打印模块内容。你可以通过处理返回的打印的内容，再次POST数据到该接口进行打印。
	*****/
	printDoc:function(param){
		var $default={
			'uniacid':param.uniacid ? param.uniacid : getUrlParam('i'),
			'ordersn':param.ordersn ? param.ordersn : 0,
			'printid':param.printid ? param.printid : 0,
			'printtype':param.printtype ? param.printtype : 0,
			'printdoc':param.printdoc ? param.printdoc : 0,
		}
		if(typeof(param.success)=='function'){$default.success=param.success;}
		if(!$default.uniacid){swal("UNIACID不能为空");return false;}
		if(!$default.printid){swal("打印编号不能为空");return false;}
		$.post("/app/index.php?i="+$default.uniacid+"&c=entry&do=cloudapi&m=j_money&op=api_printdoc",{
			"ordersn":$default.ordersn,
			"printid":$default.printid,
			"printtype":$default.printtype,
			"printdoc":$default.printdoc,
		},function(data){
			if(data.indexOf("success")){
				var feedback=eval("("+data+")");
				return feedback['content'];
			}
		});
	},
}

function getUrlParam(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}
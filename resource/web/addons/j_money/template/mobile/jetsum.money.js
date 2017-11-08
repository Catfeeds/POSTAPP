$(function () {
	var r = parent.location.search.substr(1).match(new RegExp("(^|&)storeid=([^&]*)(&|$)"));
	var uniacid=unescape(r[2]);
	
	if(typeof(swal)!="function"){
		$("<link>").attr({ rel: "stylesheet",type: "text/css",href: "../addons/j_money/template/js/sweetalert.css"}).appendTo("head");
		$("<link>").attr({ rel: "stylesheet",type: "text/css",href: "../addons/j_money/template/mobile/css/jetsum.money.css"}).appendTo("head");
		//$("<scri"+"pt>"+"</scr"+"ipt>").attr({src:'../addons/j_money/template/js/sweetalert.min2.js',type:'text/javascript'}).appendTo("head");
		$.getScript("../addons/j_money/template/js/sweetalert.min2.js");
	}
	
	$("input[name='btn_payall'").unbind("click").bind("click",function(){
		if(!$("input[name='check']:checked").size()){
			alert("请选择要付款的订单");
			return;
		}
		var tempid=[];
		$("input[name='check']:checked").each(function(index, element) {
            tempid.push($(this).val());
        });
		$.post("./index.php?c=site&a=entry&op=getprice&do=weisrc_dish&m=j_money",{"orderid":tempid.join(",")},function(data){
			console.log(data);
			var result=eval("("+data+")");
			if(result.success){
				if(parseFloat(result.total)*100==0){
					alert("没有需要支付的订单");
					return;
				}
				jsf_showAcount(result.total,result.idary);
			}
		});
	});
	$(document).keydown(function(event){ 
		if($(".jetsum_masker").size() && $(".jetsum_masker").is(":visible")){
			if(event.keyCode>=96 && event.keyCode<=109){
				var num=event.keyCode-96;
				jsf_num(num);
			}else if(event.keyCode==110){
				jsf_num(".");
			}else if(event.keyCode==27){
				if(parseFloat($("#jetsum_cashfee").val())*100>0){
					jsf_num("清除");
				}else{
					jsf_close();
				}
			}
		}
	})
	function jsf_showAcount(fee,id){
		var boxHtml='<div class="jetsum_masker"><input type="hidden" id="jetsum_id" /><div class="jetsum_box"><div class="panel panel-warning"><div class="panel-heading"><div class="text-right"><i class="fa fa-times" onclick="jsf_close(this)"></i></div><div class="input-group"><span class="input-group-addon" id="sizing-addon2">应收金额：</span> <input type="text" id="jetsum_totalfee" value="0" maxlength="8" class="form-control jetsum_feeinput" style="" readonly> <span class="input-group-addon" id="sizing-addon2">元</span></div><div class="input-group" style="padding:10px 0"><span class="input-group-addon" id="sizing-addon2">实收金额：</span> <input type="text" id="jetsum_cashfee" value="0" maxlength="8" class="form-control jetsum_feeinput" style="color:#F00" readonly/> <span class="input-group-addon" id="sizing-addon2">元</span></div><div class="input-group"><span class="input-group-addon" id="sizing-addon2">找零金额：</span> <input type="text" id="jetsum_charge" value="0" maxlength="8" class="form-control jetsum_feeinput" style="color:#00F" readonly> <span class="input-group-addon" id="sizing-addon2">元</span></div></div><div class="panel-body jetsum_btngroups"><div class="row"><div class="col-md-4"><input type="button" value="7" onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="8" onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="9" onclick="jsf_num(this)" class="btn btn-default btn-block"></div></div><div class="row"><div class="col-md-4"><input type="button" value="4" onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="5" onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="6" onclick="jsf_num(this)" class="btn btn-default btn-block"></div></div><div class="row"><div class="col-md-4"><input type="button" value="1" onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="2" onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="3" onclick="jsf_num(this)" class="btn btn-default btn-block"></div></div><div class="row"><div class="col-md-4"><input type="button" value="0" onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="." onclick="jsf_num(this)" class="btn btn-default btn-block"></div><div class="col-md-4"><input type="button" value="清除" onclick="jsf_num(this)" class="btn btn-block btn-danger"></div></div></div><div class="panel-footer jetsum_footer"><div class="row"><div class="col-md-3"><button type="button" class="btn btn-danger btn-block" onclick="jsf_payall(0)">现金</button></div><div class="col-md-3"><button type="button" class="btn btn-info btn-block" onclick="jsf_payall(1)">银行卡</button></div><div class="col-md-3"><button type="button" class="btn btn-warning btn-block" onclick="jsf_payall(2)">会员卡</button></div><div class="col-md-3"><button type="button" class="btn btn-success btn-block" onclick="jsf_payall(3)">电子支付</button></div></div></div></div></div></div>';
		if(!$(".jetsum_masker").size()){
			$("body").append(boxHtml);
		}
		fee=fee.toFixed(2);
		$("#jetsum_totalfee").val(fee);
		$("#jetsum_id").val(id);
		
		$(".jetsum_masker").css("height",$(document).height()).show();
		$(".jetsum_box").show(function(){
			var w=($(document).width()-$(this).width())*0.5;
			var h=($(document).height()-$(this).height())*0.5;
			$(this).css({"top":"100px","left":w});
		});
	}
	
});
function jsf_num(obj){
	var vTecla=obj;
	if(typeof(obj)=="object")vTecla=$(obj).val();
	var salida=$("#jetsum_cashfee");
	if(salida.val().length>8 && vTecla!='清除'){
		return false;	
	}
	if(vTecla=='.'){
		if(salida.val().indexOf('.')>-1){
			salida.val(salida.val());
		}else{
			salida.val(salida.val()+vTecla);
		}
	}else if(vTecla=='清除'){
		salida.val(0);
	}else if(vTecla=='0'){
		if(salida.val()==0 && salida.val().length==1){
			salida.val(0);
		}else{
			salida.val(salida.val()+vTecla);
		}
	}else{
		if((salida.val()==0 && salida.val().length==1)){
			salida.val(vTecla);
		}else{
			salida.val(salida.val()+vTecla);
		} 
	}
	var temp=salida.val();
	if(temp.indexOf('.')>-1){
		var float=temp.split('.');
		if(float[1].length>2){
			salida.val(float[0]+'.'+float[1].substr(0,2));
		}
	}
	jsf_chargecount();
}
function jsf_close(){
	if(confirm("取消收款？")){
		$(".jetsum_masker").remove();
	}
}
function jsf_chargecount(){
	var total=parseFloat($("#jetsum_totalfee").val());
	var cash=parseFloat($("#jetsum_cashfee").val());
	var fee=0;
	if(cash>total)fee=(cash-total).toFixed(2);
	$("#jetsum_charge").val(fee);
}
function jsf_payall(paytype){
	var total=parseFloat($("#jetsum_totalfee").val());
	if(total<=0){
		alert("没有要收款的订单");
		return;
		
	}
	if(paytype==0){
		var cash=parseFloat($("#jetsum_cashfee").val());
		if(cash<total){
			alert("收款金额不足");
			return;
		}
		jconfirm({"title":"确认使用现金支付？","text":"确认使用现金支付？","success":function(){
			jsf_payexcute({"paytype":paytype});
		}});
		return;
	}else if(paytype==1){
		$("#jetsum_cashfee").val($("#jetsum_totalfee").val());
		jsf_inputfun({"title":"请输入银行卡后4位数字","text":"请输入银行卡后4位数字","success":function(inputval){
			jsf_payexcute({"paytype":paytype,"code":inputval});
		}});
	}else if(paytype==2){
		$("#jetsum_cashfee").val($("#jetsum_totalfee").val());
		jsf_inputfun({"title":"请输入会员卡号","text":"请输入会员卡号","success":function(inputval){
			jsf_payexcute({"paytype":paytype,"cardno":inputval,"success":function(data){
				jsf_inputfun({"title":"请输入验证码","text":"请输入验证码","success":function(inputval2){
					jsf_payexcute({"paytype":data.paytype,"cardno":data.cardno,"code":inputval2});	
				}});
			}});
		}});
	}else if(paytype==3){
		$("#jetsum_cashfee").val($("#jetsum_totalfee").val());
		jsf_inputfun({"title":"请扫描客户的付款码","text":"请扫描客户的付款码","success":function(inputval){
			jsf_payexcute({"paytype":paytype,"code":inputval});
		}});
	}
	
	//1余额支付,2微信支付,3现金支付,4支付宝,5银行卡
	
}
function jsf_payexcute(param){
	var paytype=param.paytype;
	var code=param.code;
	var cardno=param.cardno;
	var success;
	if(typeof(param.success)=='function'){success=param.success}
	swal({title:"处理中",showConfirmButton:false});
	var total=parseFloat($("#jetsum_totalfee").val());
	var idary=$("#jetsum_id").val();
	$.ajax({
		type: "POST",
		url: "./index.php?c=site&a=entry&op=payall&do=weisrc_dish&m=j_money",
		data: {"fee":total,"idary":idary,"paytype":paytype,"code":code,"cardno":cardno},
		success:function(data){
			console.log(data);
			var result=eval("("+data+")");
			if(result.success){
				if(result.waitcode){
					success(param);
					return;
				}
				if(result.paywait){
					swal({title:"等待客户输入支付密码",showConfirmButton:false});
					setTimeout(function(){
						jsf_recheckpay(result.out_trade_no);
					},4000);
					return;
				}
				alert("收款成功");
				location.reload();
			}else{
				swal(result.msg);
			}
		},
		error:function (XMLHttpRequest, textStatus, errorThrown) {
			swal("数据读取失败");
		}
	});
}
function jsf_recheckpay(ordersn){
	$.ajax({
		type: "POST",
		url: "./index.php?c=site&a=entry&op=paywaitpassword&do=weisrc_dish&m=j_money",
		data: {'out_trade_no':ordersn},
		success: function(result){
			console.log(result);
			var feedback=eval("("+result+")");
			if(feedback.success){
				if(feedback.paywait){
					swal({title:"等待客户输入支付密码",showConfirmButton:false});
					setTimeout(function(){jsf_recheckpay(ordersn);},4000);
					return;
				}
				if(feedback.ok){
					alert("收款成功");
					location.reload();
				}
			}else{
				swal(feedback.msg);
			}
		},
		error:function (XMLHttpRequest, textStatus, errorThrown) {
			swal("数据读取失败");
		}
	});
}
function jconfirm(param){
	var $default = {
		"title":param.title,
		"text":typeof(param.text)!='undefined' ? param.text :"",
	};
	if(typeof(param.success)=='function'){$default.success=param.success}
	swal({   
		title: $default.title,
		text: $default.text,
		html:true,
		showCancelButton: true,
		confirmButtonText: "确定",
		cancelButtonText: "取消",
		}, function(isConfirm){
			if (isConfirm){
				if(typeof($default.success)=='function'){$default.success();}
			}
		}
	);
}
function jsf_inputfun(param){
	var $default = {
		"title":param.title,
		"text":typeof(param.text)!='undefined' ? param.text :"",
	};
	if(typeof(param.success)=='function'){$default.success=param.success}
	swal({   
		title: $default.title,
		text: $default.text,
		type: "input",
		html:true,
		showCancelButton: true,
		closeOnConfirm: false,
		confirmButtonText: "确认",
		cancelButtonText: "关闭",  
		inputPlaceholder: $default.title
		}, function(inputValue){
			if (inputValue === false)return false;
			if (inputValue === "") {
				swal.showInputError($default.title);     
				return false
			}
			swal({title:"处理中",showConfirmButton:false});
			if(typeof($default.success)=='function'){$default.success(inputValue);}
		}
	);
}
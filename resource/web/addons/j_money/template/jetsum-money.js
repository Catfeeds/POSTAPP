var JetsumMain={
	init:function(){
		if($("#jetsum_meney_pay").size()==0){
			var temp='<div id="jetsum_meney_pay" class="modal" style="display:block;background:rgba(0,0,0,.5)" tabindex="-1" role="dialog" aria-hidden="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" onclick="JetsumMain.hide()">×</button>收款</div><div class="modal-body"><div style="display:table;width:100%;margin:0 0 10px 0"><div style="display:table-row"><div style="display:table-cell;vertical-align:top;width:32%;padding:10px;border:1px solid #CCC;border-radius:4px"><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_membercardno"><b>卡号</b>：<span style="font-size:16px;float:right"></span></div><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_membercardgroup"><b>等级</b>：<span style="font-size:16px;float:right"></span></div><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_membercardcredit"><b>积分</b>：<span style="font-size:16px;float:right"></span></div><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_membercardcash"><b>余额</b>：<span style="font-size:16px;float:right;color:#F00"></span></div><div style="line-height:30px;font-size:16px;" id="txt_membercarddiscount"><b>折扣率</b>：<span style="font-size:16px;float:right"></span></div><div style="line-height:30px;text-align:right" id="txt_remark"></div></div><div style="display:table-cell;width:1%"></div><div style="display:table-cell;vertical-align:top;width:32%;padding:10px;border:1px solid #CCC;border-radius:4px"><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_orderfee"><b>订单金额</b>：<span style="font-size:16px;float:right">0.00</span></div><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_discount"><b>折扣</b>：<span style="font-size:16px;float:right">1.00</span></div><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_coupon"><b>优惠</b>：<span style="font-size:16px;float:right;color:#F00">0</span></div><div style="line-height:30px;font-size:16px;" id="txt_sumfee"><b>合计</b>：<span style="font-size:16px;float:right">0</span></div><div style="line-height:30px;text-align:right" id="txt_remark"></div></div><div style="display:table-cell;width:1%"></div><div style="display:table-cell;vertical-align:top;width:32%;padding:10px;border:1px solid #CCC;border-radius:4px"><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;;font-size:16px;text-align:center" id="txt_paytitle"><strong>选择支付方式</strong></div><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_sumfee2"><b>应收金额</b>：<span style="font-size:16px;float:right">0.00</span></div><div style="border-bottom:1px solid #CCC;line-height:30px;font-size:16px;" id="txt_paidfee"><b>实收</b>：<span style="font-size:16px;float:right;color:#F00">0.00</span></div><div style="line-height:30px;font-size:16px;" id="txt_change"><b>找零</b>：<span style="font-size:16px;float:right">0.00</span></div></div></div></div><input type="hidden" id="inp_ordersn" value=""><input type="hidden" id="inp_paytype" value=""><input type="hidden" id="inp_coupontype" value="0"><input type="hidden" id="inp_cardno" value=""><input type="hidden" id="inp_cardid" value="0"><input type="hidden" id="inp_code" value=""><input type="hidden" id="inp_ispass" value="0"><input type="hidden" id="inp_password" value=""><input type="hidden" id="inp_funname" value=""><div class="row" style="margin-bottom:10px"><div class="col-sm-4"><button id="jsbtn_membercard" type="button" class="btn btn-info btn-block" style="line-height:40px">会员卡</button></div><div class="col-sm-4"><button id="jsbtn_card" type="button" class="btn btn-info btn-block" style="line-height:40px">卡券</button></div><div class="col-sm-4"><button id="jsbtn_clear" type="button" class="btn btn-danger btn-block" style="line-height:40px">清空优惠信息</button></div></div><div class="row" style="margin-bottom:10px"><div class="col-sm-4"><button id="jsbtn_cash" type="button" class="btn btn-warning btn-block" style="line-height:40px">现金</button></div><div class="col-sm-4"><button id="jsbtn_creditcard" type="button" class="btn btn-warning btn-block" style="line-height:40px">银行卡</button></div><div class="col-sm-4"><button id="jsbtn_sure" type="button" class="btn btn-success" style="line-height:90px;position:absolute;height:120px;width:160px">确认付款</button></div></div><div class="row" style="margin-bottom:10px"><div class="col-sm-4"><button id="jsbtn_membercash" type="button" class="btn btn-warning btn-block" style="line-height:40px">余额</button></div><div class="col-sm-4"><button id="jsbtn_paywa" type="button" class="btn btn-warning btn-block" style="line-height:40px">微信/支付宝</button></div></div></div></div></div></div>';
			$("body").append(temp);
		}
		
	},
	show:function(param){
		swal("收银台启动中...");
		$default = $.extend({}, param);
		jetsumPayFun.seachOrder({"ordersn":$default.ordersn,"failed":function(){
			return false;
		},"success":function(){
			JetsumMain.check($default);
		}});
	},
	check:function(param){
		$default = $.extend({}, param);
		JetsumMain.init();
		if($default.ordersn){$("#inp_ordersn").val($default.ordersn);}
		if($default.fee){$("#inp_orderfee").val($default.fee);$("#txt_orderfee span").text($default.fee);}
		if($default.fun)$("#inp_funname").val($default.fun);
		$("#jetsum_meney_pay").show();
		JetsumMain.sum();
		$("#jsbtn_membercard").bind("click",function(e){
			payInputBox({"paytype":0,"success":function(data){
				jetsumPayFun.seachMembercard({"keyword":data,"success":function(info){
					$("#txt_membercardno span").text(info['no']);
					$("#txt_membercardcredit span").text(info['credit']);
					$("#txt_membercardcash span").text(info['cash']);
					$("#txt_membercarddiscount span").text(info['discount']);
					$("#txt_membercardgroup span").text(info['leveltxt']);
					//alert(info['password']);
					if(info['password']){
						$("#inp_ispass").val("1");
					}else{
						$("#inp_ispass").val("0");
					}
					$("#inp_password").val("");
					var total=parseFloat($("#txt_orderfee span").text());
					var c_fee=parseFloat($("#txt_coupon span").text());
					var discount=parseFloat($("#txt_discount span").text());
					if(total*(1-parseFloat(info['discount']))>c_fee){
						$("#txt_discount span").text(info['discount']);
						$("#txt_coupon span").text((total*(1-parseFloat(info['discount']))).toFixed(2));
						$("#inp_coupontype").val("2");
						$("#inp_cardid").val("");
						$("#inp_cardno").val(info['id']);
					}
					JetsumMain.sum();
					swal.close();
				}});
			}});
		});
		$("#jsbtn_card").bind("click",function(e){
			payInputBox({"paytype":1,"success":function(data){
				jetsumPayFun.checkCard({"code":data,"success":function(cardinfo){
					if(cardinfo["type"]=="discount" || cardinfo["type"]=="cash"){
						if(parseFloat($("#txt_orderfee span").text())==0){
							swal("使用代金券/折扣券时，请先输入应收金额");
							return false;
						}
						var _totalfee=parseFloat($("#txt_orderfee span").text());
						var _least_cost=parseInt(cardinfo['least_cost']) ? parseInt(cardinfo['least_cost']) : 0;
						var _discount=parseInt(cardinfo['discount']);
						var _discountfee=0;
						if(cardinfo["type"]=="cash" && _totalfee<(_least_cost*0.01)){
							swal("本折扣券必须满￥"+(_least_cost*0.01).toFixed(2)+"元才能使用");
							return false;
						}
						var flag=true;
						var _txt_coupon=parseFloat($("#txt_coupon span").text());
						if(parseInt($("#inp_coupontype").val())){
							if(cardinfo["type"]=="cash"){
								if(_txt_coupon>_discount*0.01){
									_discountfee=(_discount*0.01).toFixed(2);
									flag=false;
								}
							}else{
								if(_txt_coupon>(_totalfee*(1-_discount*0.01))){
									_discountfee=(_totalfee*(1-_discount*0.01)).toFixed(2);
									flag=false;
								}
							}
						}
						if(!flag){
							swal({   
								title: "此券优惠小于目前的优惠，是否继续使用？",
								text: "当前订单优惠"+_txt_coupon+"，此优惠券优惠"+_discountfee,
								html: true,
								type: "warning",
								showCancelButton: true,
								confirmButtonText: "确定使用",
								cancelButtonText: "取消",
								}, function(isConfirm){
									if (!isConfirm){
										return false;
									}
								}
							);
						}
						
						var _til=cardinfo["type"]=="discount" ? "折扣券" : "代金券";
						var _txt=cardinfo["type"]=="discount" ? "应付金额打<b class='red'>"+(_discount*0.1)+"</b>折" :"满￥<b class='red'>"+(_least_cost*0.01).toFixed(2)+"</b>元减￥<b class='red'>"+(_discount*0.01).toFixed(2)+"</b>元";
						_txt+="<br>是否使用此卡券？";
						swal({   
							title: _til,
							text: _txt,
							html: true,
							showCancelButton: true,
							confirmButtonText: "确定使用",
							cancelButtonText: "取消",
							}, function(isConfirm){
								if (isConfirm){
									if(cardinfo["type"]=="discount"){
										$("#txt_discount span").text((_discount*0.01).toFixed(2));
										$("#txt_coupon span").text((_totalfee*(1-_discount*0.01)).toFixed(2));
									}else{
										$("#txt_discount span").text('1.00');
										$("#txt_coupon span").text((_discount*0.01).toFixed(2));
									}
									$("#inp_coupontype").val(3);
									$("#inp_cardid").val(cardinfo['code']);
									JetsumMain.sum();
								}
							}
						);
					}else{
						swal("付款只支持折扣/代金券");
					}
				}});
			}});
		});
		$("#jsbtn_clear").bind("click",function(e){
			swal({   
				title: "确认清除所有优惠？",
				showCancelButton: true,
				confirmButtonText: "确定",
				cancelButtonText: "取消",
				}, function(isConfirm){
					if (isConfirm){
						$("#inp_coupontype").val(0);
						$("#inp_cardid").val('');
						$("#inp_paytype").val('');
						$("#txt_discount span").text('1.00');
						$("#txt_coupon span").text("0.00");
						$("#inp_ispass").val(0);
						JetsumMain.sum();
					}
				}
			);
		});
		$("#jsbtn_cash").bind("click",function(e){
			payInputBox({"paytype":2,"fee":parseFloat($("#txt_sumfee span").text()),"success":function(num){
				$("#txt_paidfee span").text(parseFloat(num).toFixed(2));
				$("#txt_paytitle strong").text("现金");
				$("#inp_paytype").val(2);
				$("#inp_password").val("");
				JetsumMain.sum();
				$("#jsbtn_sure").click();
			}});
		});
		$("#jsbtn_creditcard").bind("click",function(e){
			payInputBox({"paytype":3,"fee":parseFloat($("#txt_sumfee span").text()),"success":function(num){
				$("#txt_paidfee span").text($("#txt_sumfee span").text());
				$("#txt_paytitle strong").text("银行卡"+num);
				$("#inp_paytype").val(3);
				$("#inp_code").val(num);
				$("#inp_password").val("");
				
				JetsumMain.sum();
				$("#jsbtn_sure").click();
			}});
		});
		$("#jsbtn_membercash").bind("click",function(e){
			if(!$("#inp_cardno").val()){
				$("#jsbtn_membercard").click();
				return false;
			}
			if(parseFloat($("#txt_membercardcash span").text())<parseFloat($("#txt_sumfee span").text())){
				swal("余额不足");
				return false;
			}
			if(parseInt($("#inp_ispass").val())==1){
				payInputBox({"paytype":4,"fee":parseFloat($("#txt_sumfee span").text()),"pass":1,"success":function(num){
					jetsumPayFun.seachMembercard({"id":$("#inp_cardno").val(),"password":num,"success":function(info){
						$("#inp_password").val(num);
						$("#jsbtn_sure").click();
					}});
				}});
			}else{
				$("#jsbtn_sure").click();
			}
		});
		$("#jsbtn_paywa").bind("click",function(e){
			payInputBox({"paytype":5,"fee":parseFloat($("#txt_sumfee span").text()),"success":function(num){
				$("#txt_paidfee span").text($("#txt_sumfee span").text());
				$("#inp_code").val(num);
				$("#inp_password").val("");
				if(num.substr(0,1)=="1"){
					$("#inp_paytype").val(0);
					$("#txt_paytitle strong").text("微信支付");
				}else{
					$("#inp_paytype").val(1);
					$("#txt_paytitle strong").text("支付宝支付");
				}
				JetsumMain.sum();
				$("#jsbtn_sure").click();
			}});
		});
		$("#jsbtn_sure").bind("click",function(e){
			JetsumMain.sum();
			if(parseFloat($("#txt_orderfee span").text())*100==0){
				swal("金额不能为0");
				return;
			}
			if($("#inp_paytype").val().length==0){
				swal("请选择支付方式");
				return;
			}
			if(parseFloat($("#txt_sumfee span").text())>parseFloat($("#txt_paidfee span").text())){
				swal("付款金额不足");
				return;
			}
			swal({
				title: "确认收款￥<b class='red'>"+$("#txt_sumfee span").text()+"元？",
				text: "确认收款？",
				html:true,
				showLoaderOnConfirm: true,
				closeOnConfirm: false,
				showCancelButton: true,
				confirmButtonText: "确认",
				cancelButtonText: "关闭",
				}, function(isConfirm){    
				if (isConfirm) {
					swal("请稍后，数据处理中...");
					jetsumPayFun.pay({
						"ordersn":$("#inp_ordersn").val(),
						"orderfee":$("#txt_orderfee span").text(),
						"couponfee":$("#txt_coupon span").text(),
						"discount":$("#txt_discount span").text(),
						"coupontype":$("#inp_coupontype").val(),
						"totalfee":$("#txt_sumfee span").text(),
						"paidfee":$("#txt_paidfee span").text(),
						"change":$("#txt_change span").text(),
						"cardno":$("#inp_cardno").val(),
						"password":$("#inp_password").val(),
						"code":$("#inp_code").val(),
						"cardid":$("#inp_cardid").val(),
						"password":$("#inp_password").val(),
						"paytype":$("#inp_paytype").val(),
						'success':function(data){
							swal({   
								title:"收款成功",
								confirmButtonText: "确定",
								}, function(isConfirm){
									if (isConfirm){
										var successFun=$("#inp_funname").val();
										if(successFun){
											var items=JSON.stringify(data);
											eval(successFun+"("+items+")");
										}
									}
									swal.close();
								}
							);
							
						}
					});
				}
			})
		});
	},
	sum:function(){
		var inp_orderfee=parseFloat($("#txt_orderfee span").text());
		var inp_coupon=parseFloat($("#txt_coupon span").text());
		var inp_sumfee=inp_orderfee-inp_coupon;
		$("#txt_sumfee span,#txt_sumfee2 span").text(inp_sumfee.toFixed(2));
		var txt_paidfee=parseFloat($("#txt_paidfee span").text());
		if(txt_paidfee*100>0){
			$("#txt_change span").text((txt_paidfee-inp_sumfee).toFixed(2));
		}else{
			$("#txt_change span").text("0.00");
		}
	},
	hide: function() {
		$("#jetsum_meney_pay").remove();
		$("#jsbtn_sure").unbind('click');
		$("#jsbtn_paywa").unbind('click');
		$("#jsbtn_membercash").unbind('click');
		$("#jsbtn_creditcard").unbind('click');
		$("#jsbtn_cash").unbind('click');
		$("#jsbtn_clear").unbind('click');
		$("#jsbtn_card").unbind('click');
		$("#jsbtn_membercard").unbind('click');
	},
};
var jetsumPayFun={
	seachMembercard:function(param){
		$default = $.extend({}, param);
		$default.id=typeof(param.id)!="undefined" ? param.id :0;
		$default.keyword=typeof(param.keyword)!="undefined" ? param.keyword :'';
		$default.password=typeof(param.password)!="undefined" ? param.password :'';
		var Urldefault=getDefaultQueryStr();
		$.ajax({
			type: "POST",
			url: Urldefault.siteroot+"app/index.php?i="+Urldefault.uniacid+"&shopid="+Urldefault.shopid+"&c=entry&m=j_money&do=cloudapi&op=api_seachmembercard",
			data:{"keyword":$default.keyword,"id":$default.id,"password":$default.password},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback.item);}
				}else{
					swal(feedback.msg);
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	seachOrder:function(param){
		$default = $.extend({}, param);
		$default.ordersn=typeof(param.ordersn)!="undefined" ? param.ordersn :'';
		var Urldefault=getDefaultQueryStr();
		$.ajax({
			type: "POST",
			url: Urldefault.siteroot+"app/index.php?i="+Urldefault.uniacid+"&shopid="+Urldefault.shopid+"&c=entry&m=j_money&do=cloudapi&op=api_searchorder",
			data:{"ordersn":$default.ordersn},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback.item);}
				}else{
					swal(feedback.msg);
					if(typeof($default.failed)=='function'){$default.failed();}
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	checkCard:function(param){
		$default = $.extend({}, param);
		var Urldefault=getDefaultQueryStr();
		$.ajax({
			type: "POST",
			url: Urldefault.siteroot+"app/index.php?i="+Urldefault.uniacid+"&shopid="+Urldefault.shopid+"&c=entry&m=j_money&do=cloudapi&op=api_checkcard",
			data: {'code':$default.code},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback.item);}
				}else{
					swal({
						title: feedback.msg,
						}, function(){
							if(typeof($default.falsed)=='function'){$default.falsed(feedback.msg);}
						}
					)
				}
				
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	pay:function(param){
		var Urldefault=getDefaultQueryStr();
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: Urldefault.siteroot+"app/index.php?i="+Urldefault.uniacid+"&shopid="+Urldefault.shopid+"&c=entry&m=j_money&do=cloudapi&op=api_pay",
			data: {
				'paytype':$default.paytype,
				'orderfee':$default.orderfee,
				'couponfee':$default.couponfee,
				'discount':$default.discount,
				'totalfee':$default.totalfee,
				'paidfee':$default.paidfee,
				'change':$default.change,
				'cardid':$default.cardid,
				'cardno':$default.cardno,
				'password':$default.password,
				'code':$default.code,
				'ordersn':$default.ordersn,
				'discounttype':$default.discounttype,
				'remark':$default.remark,
			},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					var out_trade_no=feedback.out_trade_no;
					if(feedback.paywait){
						swal({title:"等待客户输入支付密码",showConfirmButton:false});
						setTimeout(function(){
							jetsumPayFun.reCheckPay({"out_trade_no":out_trade_no,"success":$default.success});
						},3000);
					}else{
						if(typeof($default.success)=='function'){$default.success(feedback.item);}
					}
				}else{
					swal(feedback.msg);
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	reCheckPay:function(param){
		var Urldefault=getDefaultQueryStr();
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: Urldefault.siteroot+"app/index.php?i="+Urldefault.uniacid+"&shopid="+Urldefault.shopid+"&c=entry&m=j_money&do=cloudapi&op=api_paywaitpassword",
			data: {'out_trade_no':$default.out_trade_no},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					var out_trade_no=feedback.out_trade_no;
					if(feedback.paywait){
						swal({title:"等待客户输入支付密码",showConfirmButton:false});
						setTimeout(function(){
							jetsumPayFun.reCheckPay({"out_trade_no":out_trade_no,"success":$default.success});
						},3000);
					}else{
						if(typeof($default.success)=='function'){$default.success(out_trade_no);}
					}
				}else{
					swal(feedback.msg);
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
}
function payInputBox(param){
	var title_Ary=["请输入会员卡号/电话号码","请输入卡券号码","现金收款","银行卡收款","余额支付","使用电子支付"];
	var text_Ary=["请输入会员卡号/电话号码","请输入卡券号码","请输入收到的金额","客户付款后请输入银行卡后4位数字","请输入密码","请扫码客户的付款码"];
	$default={
		"paytype":param.paytype,
		"fee":typeof(param.fee)!='undefined' ? parseFloat(param.fee):0,
		"pass":typeof(param.pass)!='undefined' ? 1:0,
	}
	if(typeof(param.success)=='function'){$default.success=param.success;}
	var fun="showCounter()";
	if($default.pass){
		fun="changeinputpassword()";
	}
	var paytype=parseInt($default.paytype);
	var temp=$default.fee ? "￥<b class='red'>"+$default.fee+"</b>元":"";
	var temp2=$default.pass ? "<img src='../addons/j_money/template/img/bank.png' onload='"+fun+"'/>":"";
	swal({
		title: title_Ary[paytype]+temp,
		text: text_Ary[paytype]+temp2,
		type: "input",
		html:true,
		showLoaderOnConfirm: true,
		showNumberForm: true,
		closeOnConfirm: false,
		showCancelButton: true,
		confirmButtonText: "确认",
		cancelButtonText: "关闭",
		inputPlaceholder: text_Ary[paytype] 
		}, function(inputValue){
			$('.sweet-counter-box').addClass("hide");
			if (inputValue === false) {
				return false;
			}
			if (inputValue === "") {
				swal.showInputError(text_Ary[paytype]);
				$('.sweet-counter-box').removeClass("hide");
				return false
			}
			if(typeof($default.success)=='function'){
				$default.success(inputValue);
			}
		}
	)
}
function jconfirm(param){
	$default = $.extend({}, param);
	swal({   
		title: $default.title,
		text: typeof($default.text)!='undefined' ? $default.text : '',
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
function getDefaultQueryStr(){
	var defaults=[];
	defaults['siteroot']=getQueryString('siteroot');
	defaults['uniacid']=getQueryString('uniacid');
	defaults['shopid']=getQueryString('shopid');
	return defaults;
}
function getQueryString(name){
	var str=$("#jetsumfunjs").attr("src").split("?")[1];
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");  
	var r = str.match(reg);
	if (r != null)return unescape(r[2]);
	return null;  
}
function showCounter(){
	if(!$('.sweet-counter-box').size()){
		var temp='<div class="sweet-counter-box"><ul><li>7</li><li>8</li><li>9</li><li class="sweet-counter-b">&larr;</li></ul><ul><li>4</li><li>5</li><li>6</li><li class="sweet-counter-c">C</li></ul><ul><li>1</li><li>2</li><li>3</li></ul><ul><li class="sweet-counter-0">0</li><li>.</li></ul></div>';
		$(".showSweetAlert fieldset").append(temp);
		$(".sweet-counter-box li").on('click',function(){
			var txt=$(this).text();
			if($(this).hasClass("sweet-counter-b"))txt="B";
			Counter(txt,".showSweetAlert input[type='text']");
		});
	}
	if(!$(".showSweetAlert input[type='text']").is(':hidden')){
		$('.sweet-counter-box').removeClass("hide");
		
		var _h=$(".showSweetAlert").css("margin-top");
		$(".showSweetAlert").css("margin-top",-250);
	}else{
		$('.sweet-counter-box').addClass("hide");
	}
}
function changeinputpassword(){
	$(".showSweetAlert input").attr("type","password").focus();
}
function Counter(num,obj){
	var vTecla=num;
	var salida=$(obj);
	if(vTecla=='C'){
		salida.val('');
		return false;
	}
	if(vTecla=='B'){
		var temp1=salida.val();
		salida.val(temp1.substr(0,temp1.length-1));
		return false;
	}
	if(salida.val().length>8){
		return false;	
	}
	if(vTecla=='.'){
		if(salida.val().indexOf('.')>-1){
			salida.val(salida.val());
		}else{
			salida.val(salida.val()+vTecla);
		}
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
}

$(document).ready(function(e) {
	dynamicLoading.css('../addons/j_money/template/js/sweetalert.css');
	dynamicLoading.js('../addons/j_money/template/js/sweetalert.min2.js');
});
var dynamicLoading = {
    css: function(path){
		if(!path || path.length === 0){
			throw new Error('argument "path" is required !');
		}
		var head = document.getElementsByTagName('head')[0];
        var link = document.createElement('link');
        link.href = path;
        link.rel = 'stylesheet';
        link.type = 'text/css';
        head.appendChild(link);
    },
    js: function(path){
		if(!path || path.length === 0){
			throw new Error('argument "path" is required !');
		}
		var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('script');
        script.src = path;
        script.type = 'text/javascript';
        head.appendChild(script);
    }
}
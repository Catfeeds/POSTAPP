var jetsumpay={
	printOrder:function(param){
		var $default={
			'uniacid':param.uniacid,
			'siteroot':param.siteroot,
			'ordersn':param.out_trade_no,
			'printtype':param.printtype ? param.printtype  : 0,
			'second':param.second ? param.second  : 0,
		}
		$("#print_iframe").removeAttr("src").attr("src",$default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&printtype="+$default.printtype+"&m=j_money&do=printnew&ordersn="+$default.ordersn+"&second="+$default.second);
	},
	getGoods:function(param){
		$default = $.extend({}, param);
		if(isNaN(parseInt($default.page)))$default.page=0;
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=getgoods",
			data: {'pcate':$default.pcate,'page':$default.page,'ismobile':1,'keyword':$default.keyword},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(result);}
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	handUp:function(param){
		$default = $.extend({}, param);
		var tempAry={
			"parama":$default.parama,
		};
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=handupordersave",
			data:tempAry,
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback);}
				}else{
					swal(feedback.msg);
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	getBack:function(param){
		$defaults = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $defaults.siteroot+"app/index.php?i="+$defaults.uniacid+"&c=entry&m=j_money&do=ajax&op=getbackordersave",
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($defaults.success)=='function'){
						if(typeof($defaults.key)!="undefined"){
							var keynum=0;
							for(i in feedback.item){
								if(keynum==parseInt($defaults.key)){
									$defaults.success(feedback.item[i].parama);
									break;
								}
							}
						}else{
							$defaults.success(feedback.item);
						}
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
	submitOrder:function(param){
		$default = $.extend({}, param);
		var tempAry={
			"parama":$default.parama,
		};
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=submitorder",
			data:tempAry,
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback);}
				}else{
					swal(feedback.msg);
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	seachMembercard:function(param){
		$default = $.extend({}, param);
		$default.id=typeof(param.id)!="undefined" ? param.id :0;
		$default.keyword=typeof(param.keyword)!="undefined" ? param.keyword :'';
		$default.password=typeof(param.password)!="undefined" ? param.password :'';
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=seachmembercard",
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
	checkCard:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=checkcard",
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
	cardConsume:function(param){
		var $default={
			'uniacid':param.uniacid,
			'siteroot':param.siteroot,
			'cardid':param.cardid,
		}
		if(typeof(param.success)=='function'){$default.success=param.success;}
		if(typeof(param.falsed)=='function'){$default.falsed=param.falsed;}
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=cardcheck",
			data: {'code':$default.cardid},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback.item);}
				}else{
					swal({
						title: feedback.msg,
						}, function(){
							swal.close();
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
	payAll:function(param){
		var $default={
			"card_consume":param.card_consume==true ? true : false,
			"password_consume":param.password_consume==true ? true : false,
		}
		$default = $.extend({}, param);
		if($default.cardid && !$default.card_consume){
			jetsumpay.cardConsume({"uniacid":$default.uniacid,"siteroot":$default.siteroot,"cardid":$default.cardid,'success':function(){
				$default.card_consume=true;
				jetsumpay.payAll($default);
			}});
			return;
		}
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=orderpay_all",
			data: {
				'goods':$default.goods,
				'paytype':$default.paytype,
				'orderfee':$default.orderfee,
				'couponfee':$default.couponfee,
				'discount':$default.discount,
				'totalfee':$default.totalfee,
				'paidfee':$default.paidfee,
				'change':$default.change,
				'cardid':$default.cardid,
				'memberno':$default.memberno,
				'password':$default.password,
				'code':$default.code,
				'discounttype':$default.discounttype,
				'remark':$default.remark,
				'marketing':$default.marketing,
			},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					var out_trade_no=feedback.out_trade_no;
					if(feedback.paywait){
						swal({title:"等待客户输入支付密码",showConfirmButton:false});
						setTimeout(function(){
							jetsumpay.reCheckPay({"uniacid":$default.uniacid,"siteroot":$default.siteroot,"out_trade_no":out_trade_no,"success":$default.success});
						},4000);
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
	reCheckPay:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=orderpay_waitpassword",
			data: {'out_trade_no':$default.out_trade_no},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					var out_trade_no=feedback.out_trade_no;
					if(feedback.paywait){
						swal({title:"等待客户输入支付密码",showConfirmButton:false});
						setInterval(function(){
							jetsumpay.reCheckPay({"uniacid":$default.uniacid,"siteroot":$default.siteroot,"out_trade_no":out_trade_no,"success":$default.success});
						},1000);
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
	paySuccess:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=orderpay_success",
			data: {'out_trade_no':$default.out_trade_no},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback.ordernum);}
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	getOrder:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=getorderlist",
			data:{"ismobile":1,"keyword":$default.keyword,"psize":20,"ds":$default.ds,"de":$default.de,"page":parseInt($default.page)},
			success: function(result){
				console.log(result);
				if(typeof($default.success)=='function'){$default.success(result);}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	getOrderView:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=getorderview",
			data:{"keyword":$default.keyword,"ismobile":1},
			success: function(result){
				//console.log(result);
				if(typeof($default.success)=='function'){$default.success(result);}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	getRefund:function(param){
		$default = $.extend({}, param);
		$default.account = typeof($default.account)!='undefined' ? 1 : 0;
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=order_refund",
			data:{"ordersn":$default.ordersn,"refund_fee":typeof($default.fee)!='undefined' ? $default.fee : 0,"goods":typeof($default.goods)!='undefined' ? $default.goods : ''},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(feedback.repay){
						$default.account=1;
						jetsumpay.getRefund($default);
						return;
					}
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
	getrefundView:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=getorderveiw2refund",
			data:{"keyword":$default.keyword,"ismobile":1},
			success: function(result){
				//console.log(result);
				if(typeof($default.success)=='function'){$default.success(result);}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	newCard:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=newmembercard",
			data:{"cardno":$default.cardno,"realname":$default.realname,"mobile":$default.mobile,"password":$default.password},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					swal.close();
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
	rechargeCard:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=rechargecard",
			data:{"cardno":$default.cardno,"fee":$default.fee,"paytype":$default.paytype,"code":$default.code},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(feedback.paywait){
						swal({title:"等待客户输入支付密码",showConfirmButton:false});
						var _ordersn=feedback.out_trade_no;
						setTimeout(function(){
							jetsumpay.reCheckPay({"uniacid":$default.uniacid,"siteroot":$default.siteroot,"out_trade_no":_ordersn,"success":$default.success});
						},4000);
					}else{
						if(typeof($default.success)=='function'){$default.success(result);}
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
	reCheckCharge:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=ordercharge_waitpassword",
			data: {'out_trade_no':$default.out_trade_no},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					var out_trade_no=feedback.out_trade_no;
					if(feedback.paywait){
						swal({title:"等待客户输入支付密码",showConfirmButton:false});
						setTimeout(function(){
							jetsumpay.reCheckPay({"uniacid":$default.uniacid,"siteroot":$default.siteroot,"out_trade_no":out_trade_no,"success":$default.success});
						},4000);
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
	tieCard:function(param){
		$default = $.extend({}, param);
		$default.password=typeof(param.password)!="undefined" ? param.password :'';
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=tiecard",
			data:{"cardno":$default.cardno,"code":$default.code,"password":$default.password},
			success: function(result){
				console.log(result);
				var feedback=eval("("+result+")");
				if(feedback.success){
					if(typeof($default.success)=='function'){$default.success(feedback.item);}
				}else{
					if(feedback.pass){
						$('#modal_tiecard').modal("hide").on('hidden.bs.modal',function (e) {
							swal({
								title:"请输入密码",
								text: "请输入密码<img src='../addons/j_money/template/img/bank.png' onload='changeinputpassword()'/>",
								type: "input",
								html:true,
								showLoaderOnConfirm: true,
								showCancelButton: true,
								confirmButtonText: "确认",
								cancelButtonText: "关闭",
								inputPlaceholder: "请输入密码"
								}, function(inputValue){
									$('.sweet-counter-box').addClass("hide");
									if (inputValue === false) {
										return false;
									}
									if (inputValue === "") {
										swal.showInputError("请输入密码");
										return false
									}
									$default.password=inputValue;
									jetsumpay.tieCard($default);
								}
							)
						});
					}else{
						swal(feedback.msg);
					}
				}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	doExchange:function(param){
		$defaults = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $defaults.siteroot+"app/index.php?i="+$defaults.uniacid+"&c=entry&m=j_money&do=ajax&op=rotation",
			data:{},
			success: function(result){
				console.log(result);
				if(typeof($defaults.success)=='function'){$defaults.success(result);}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	getExchargeOrder:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=getexchargeorder",
			data:{"keyword":$default.keyword,"ds":$default.ds,"de":$default.de,"page":parseInt($default.page)},
			success: function(result){
				console.log(result);
				if(typeof($default.success)=='function'){$default.success(result);}
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
	setdefaultprinter:function(param){
		$default = $.extend({}, param);
		$.ajax({
			type: "POST",
			url: $default.siteroot+"app/index.php?i="+$default.uniacid+"&c=entry&m=j_money&do=ajax&op=choseprint",
			data:{"printername":$default.printername,"printerindex":$default.printerindex},
			success: function(result){
				
			},
			error:function (XMLHttpRequest, textStatus, errorThrown) {
				swal("数据读取失败");
			}
		});
	},
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
function showMasker(param){
	$default = $.extend({}, param);
	var temphtml='<div id="loadingToast" class="weui_loading_toast"><div class="weui_mask"></div><div class="weui_toast"><div class="weui_loading"><div class="weui_loading_leaf weui_loading_leaf_0"></div><div class="weui_loading_leaf weui_loading_leaf_1"></div><div class="weui_loading_leaf weui_loading_leaf_2"></div><div class="weui_loading_leaf weui_loading_leaf_3"></div><div class="weui_loading_leaf weui_loading_leaf_4"></div><div class="weui_loading_leaf weui_loading_leaf_5"></div><div class="weui_loading_leaf weui_loading_leaf_6"></div><div class="weui_loading_leaf weui_loading_leaf_7"></div><div class="weui_loading_leaf weui_loading_leaf_8"></div><div class="weui_loading_leaf weui_loading_leaf_9"></div><div class="weui_loading_leaf weui_loading_leaf_10"></div><div class="weui_loading_leaf weui_loading_leaf_11"></div></div><p class="weui_toast_content" style="color:#FFF">Loading</p></div></div>';
	if($("#loadingToast").size()==0){
		$("body").append(temphtml);
	}
	if($default.timer){
		$("#loadingToast").show();
		setTimeout(function(){
			$("#loadingToast").hide();
			if(typeof($default.success)=='function'){$default.success();}
		},$default.timer);
		return ;
	}
	if($("#loadingToast").is(":visible")){
		setTimeout(function(){$("#loadingToast").hide();},300);
	}else{
		$("#loadingToast").show();
	}
}
function payInputBox(param){
	$default = $.extend({}, param);
	var fun="showCounter()";
	swal({
		title:$default.title,
		text: $default.text+"<img src='../addons/j_money/template/img/bank.png' onload='"+fun+"'/>",
		type: "input",
		html:true,
		showLoaderOnConfirm: true,
		showNumberForm: true,
		closeOnConfirm: false,
		showCancelButton: true,
		confirmButtonText: "确认",
		cancelButtonText: "关闭",
		inputPlaceholder: $default.text
		}, function(inputValue){
			$('.sweet-counter-box').addClass("hide");
			if (inputValue === false) {
				return false;
			}
			if (inputValue === "") {
				swal.showInputError($default.text);
				$('.sweet-counter-box').removeClass("hide");
				return false
			}
			$default.success(inputValue);
	})
}
function showCounter(){
	$(".sweet-counter-box li").unbind('click');
	if(!$('.sweet-counter-box').size()){
		var temp='<div class="sweet-counter-box"><ul><li>7</li><li>8</li><li>9</li><li class="sweet-counter-b">&larr;</li></ul><ul><li>4</li><li>5</li><li>6</li><li class="sweet-counter-c">C</li></ul><ul><li>1</li><li>2</li><li>3</li></ul><ul><li class="sweet-counter-0">0</li><li>.</li></ul></div>';
		$(".showSweetAlert fieldset").append(temp);
		$(".sweet-counter-box li").bind('click',function(){
			var txt=$(this).text();
			if($(this).hasClass("sweet-counter-b"))txt="B";
			if($(this).hasClass("sweet-counter-c"))txt="C";
			Counter(txt,".showSweetAlert input");
		});
		$(".showSweetAlert input").attr("type","password").focus();
	}
	if(!$(".showSweetAlert input").is(':hidden')){
		$('.sweet-counter-box').removeClass("hide");
		var _h=$(".showSweetAlert").css("margin-top");
		$(".showSweetAlert").css("margin-top",-250);
	}else{
		$('.sweet-counter-box').addClass("hide");
	}
}
function Counter(num,obj){
	var vTecla=num;
	var salida=$(obj);
	var type=salida.prop("tagName");
	if(type=="INPUT"){
		if(vTecla=='B'){
			var temp1=salida.val();
			salida.val(temp1.substr(0,temp1.length-1));
			return false;
		}
		if(vTecla=='C'){
			salida.val("");
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
		}else if(vTecla=='0' || vTecla=='00'){
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
	}else{
		if(vTecla=='B'){
			var temp1=salida.text();
			salida.text(temp1.substr(0,temp1.length-1));
			return false;
		}
		if(salida.text().length>8){
			return false;	
		}
		if(vTecla=='.'){
			if(salida.text().indexOf('.')>-1){
				salida.text(salida.text());
			}else{
				salida.text(salida.text()+vTecla);
			}
		}else if(vTecla=='0' || vTecla=='00'){
			if(salida.text()==0 && salida.text().length==1){
				salida.text(0);
			}else{
				salida.text(salida.text()+vTecla);
			}
		}else{
			if((salida.text()==0 && salida.text().length==1)){
				salida.text(vTecla);
			}else{
				salida.text(salida.text()+vTecla);
			} 
		}
		var temp=salida.text();
		if(temp.indexOf('.')>-1){
			var float=temp.split('.');
			if(float[1].length>2){
				salida.text(float[0]+'.'+float[1].substr(0,2));
			}
		}
	}
}
function checkBrowser(){
    var userAgent = navigator.userAgent;
    if (userAgent.indexOf("Chrome") == -1){
		alert("请使用360极速浏览器才能正常");
		return false;
	}
}


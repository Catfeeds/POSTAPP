function printOrder(out_trade_no){
  console.log(out_trade_no);
  var baseUrl = plus.storage.getItem("baseUrl");
  var postUrl = baseUrl + "&c=entry&m=j_money&do=ajax&op=getPrintTemplate";
  var main = null;
  var Intent = plus.android.importClass("android.content.Intent");
  var ComponentName = plus.android.importClass("android.content.ComponentName");
  var intent = new Intent();
  intent.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.CustomPrinterActivity"));
  // intent.putExtra("data", JSON.stringify(data));
  console.log(postUrl);
  intent.putExtra("isPrintTicket", "true");
  mui.ajax({
    type: "post",
    url: postUrl,
    data:{out_trade_no:out_trade_no},
    async: true,
    dataType: "text",
    success: function(data) {
//  	console.log(data);
//	    console.log(JSON.stringify(data));
	    if(data == -1){
				plus.nativeUI.toast("请设置默认打印模板");
	    }else if(data == -2){
	    	plus.nativeUI.toast("请先登录");
	    	clicked('login.html',false,false);
	    }else{
	      	console.log(data);
	        var str = data;
	        intent.putExtra("data", str);
	        main = plus.android.runtimeMainActivity();
	        main.onActivityResult = function(requestCode, resultCode, data) {
	           	plus.android.importClass(data);
	           	var bundle = data.getExtras();
	           	plus.android.importClass(bundle);
	           	var reason = bundle.getString("reason");
	          	plus.nativeUI.toast(reason);
	        };
	        main.startActivityForResult(intent, 0);
	      }
    },
    error:function(err){
//  	console.log(JSON.stringify(err));
    }

  })
}

(function($, doc) {

	$.plusReady(function() {
//		checkPrintOrder();
		function checkPrintOrder(){
			var baseUrl = plus.storage.getItem("baseUrl");
			var versionUrl = baseUrl + "&c=entry&m=j_money&do=ajax&op=checkVersion";
			mui.ajax({
				type: "post",
				url: versionUrl,
				async: true,
				dataType: "json",
				success: function(data) {
					console.log(JSON.stringify(data));
					var interval = window.setTimeout(function(){
						checkPrintOrder();
					},2000);
				}
			})
		}
	})
}(mui, document));
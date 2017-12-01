function cardPay(total,out_trade_no){
	var main = null;
	var Intent = plus.android.importClass("android.content.Intent");
	var ComponentName = plus.android.importClass("android.content.ComponentName");
	var intent = new Intent();
	intent.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));
	intent.putExtra("transName", "消费");
	intent.putExtra("amount", total);
	intent.putExtra("orderNumber", out_trade_no);
	intent.putExtra("version", "1.0.7");
	main = plus.android.runtimeMainActivity();
	main.onActivityResult = function(requestCode, resultCode, data) {
		if(flag){
			return false;
		}
		flag = true;
		console.log(flag);
		plus.android.importClass(data);
		var bundle       = data.getExtras();
		plus.android.importClass(bundle);
		var amount       = bundle.getString("amount");
		var traceNo      = bundle.getString("traceNo");
		var batchNo      = bundle.getString("batchNo");
		var referenceNo  = bundle.getString("referenceNo");
		var cardNo       = bundle.getString("cardNo");
		var type         = bundle.getString("type");
		var issue        = bundle.getString("issue");
		var date         = bundle.getString("date");
		var time         = bundle.getString("time");
		var orderNumber  = bundle.getString("orderNumber");
		var terminalId   = bundle.getString("terminalId");
		var merchantId   = bundle.getString("merchantId");
		var merchantName = bundle.getString("merchantName");
		console.log("traceNo = "+traceNo);	
	};
	main.startActivityForResult(intent, 0);
}
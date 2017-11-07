package com.example.test2222;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.ComponentName;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class PrintActivity extends Activity {
	
	private EditText et2 ;
	private EditText et3 ;
	private EditText etBack;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.print);
		et2 = (EditText) findViewById(R.id.editText2);
		et3 = (EditText) findViewById(R.id.editText3);
		etBack = (EditText) findViewById(R.id.transData);
		Button bt = (Button) findViewById(R.id.buttonSure);
		
		et3.setVisibility(View.GONE);
		
		bt.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View arg0) {
				if(!TextUtils.isEmpty(et2.getText().toString().trim())/* && 
						!TextUtils.isEmpty(et3.getText().toString().trim())*/){
					Intent intent8 = new Intent();
					intent8.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));

					//包名     包名+类名（全路径）  
					intent8.putExtra("transName", "打印任意一笔");
					intent8.putExtra("oldTrace", et2.getText().toString().trim());
//					intent8.putExtra("orderNumber", et3.getText().toString().trim());
					startActivityForResult(intent8, 0);
//					finish();
				}else{
					Toast.makeText(PrintActivity.this, "请输入凭证号或订单号", Toast.LENGTH_SHORT).show();
				}
			}
		});
	}
	
	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
		super.onActivityResult(requestCode, resultCode, data);
		Log.i("Fuiou", "resultCode--返回值："+resultCode);
		Log.i("TAG", "resultCode--返回值："+resultCode);
		switch (resultCode) {
		case Activity.RESULT_CANCELED:
			String reason = "";
			String traceNo = "";
			String batchNo = "";
			if (data != null) {
				Bundle b = data.getExtras();
				if (b != null) {
					reason = (String) b.get("reason");
					traceNo = (String)b.getString("traceNo");
					batchNo = (String)b.getString("batchNo");
				}
			}
			if (reason != null) {
				Log.d("reason", reason);
				Toast.makeText(this, reason, 0).show();
			}
			Log.w("TAG", "失败返回值--reason--返回值："+reason+"/n 凭证号："+traceNo+"/n 批次号："+batchNo);
			
			etBack.setText("失败："+reason+"/n 凭证号："+traceNo+"/n 批次号："+batchNo);
			break;
		case Activity.RESULT_OK:
			String print = data.getStringExtra("reason");//打印成功返回数据
			Log.w("TAG", "成功返回值--reason--返回值："+print);
			
			String b = data.getStringExtra("batchNo");//批次号
			String c = data.getStringExtra("traceNo");//流水号
			String d = data.getStringExtra("cardNo");//卡号
			
			String e = data.getStringExtra("merchantId");//商户号
			String f = data.getStringExtra("terminalId");//终端号
			
			String g = data.getStringExtra("referenceNo");//参考号
			String h = data.getStringExtra("issue");//发卡行
			String i = data.getStringExtra("type");//卡类型
			String j = data.getStringExtra("date");//日期
			String k = data.getStringExtra("time");//时间
			
			String l = data.getStringExtra("wireless.apn");//apn
			String m = data.getStringExtra("wireless.username");//用户名
			String n = data.getStringExtra("wireless.password");//密码
			String o = data.getStringExtra("wireless.apnEnabled");//Apn是否开启
			String p = data.getStringExtra("merchantName");//商户名
			
			String r = data.getStringExtra("oldReferenceNo");//原参考号
			
			String t = data.getStringExtra("orderNumber");
			String tzfb = data.getStringExtra("zfbOrderNumber");
			String twx = data.getStringExtra("wxOrderNumber");
			
			String u = data.getStringExtra("oldOrderNumber");
			String sWx = data.getStringExtra("wxOldOrderNumber");
			String sZfb = data.getStringExtra("zfbOldOrderNumber");
			
			String wMb = data.getStringExtra("zfbMbOldOrderNumber");
			String zMb = data.getStringExtra("wxMbOldOrderNumber");
			
			String tui = data.getStringExtra("tuiOldOrderNumber");
			
			String settleData = data.getStringExtra("settleJson");
			String json = data.getStringExtra("json");
			
			String return_Code = data.getStringExtra("return_txt");//扫码返回数据
			
			String authorizationCode = data.getStringExtra("authorizationCode");//预授权 授权码
			
			String backOldReferenceNo = data.getStringExtra("backOldReferenceNo");//退货的原参考号
			
			String anyTransOrderNo =data.getStringExtra("anyTransOrderNo");//打印任意一笔的订单号

			JSONObject jsO = new JSONObject();
			try {
				jsO.put("batchNo", b);//批次号
				jsO.put("traceNo", c);//流水号
				jsO.put("cardNo", d);//卡号
				jsO.put("merchantId", e);//商户号
				jsO.put("terminalId", f);//终端号
				jsO.put("referenceNo", g);//参考号
				jsO.put("issue", h);//发卡行
				jsO.put("type", i);//卡类型
				jsO.put("date", j);//日期
				jsO.put("time", k);//时间
				jsO.put("wireless.apn", l);//apn
				jsO.put("wireless.username", m);//用户名
				jsO.put("wireless.password", n);//密码
				jsO.put("wireless.apnEnabled", o);//Apn是否开启
				jsO.put("merchantName", p);//商户名
				jsO.put("oldReferenceNo", r);//原参考号
				jsO.put("backOldReferenceNo", backOldReferenceNo);//退货原参考号
				jsO.put("orderNumber", t);//消费订单号
				jsO.put("zfbOrderNumber", tzfb);//支付宝消费订单号
				jsO.put("wxOrderNumber", twx);//微信消费订单号
				jsO.put("oldOrderNumber", u);//原消费订单号
				jsO.put("wxOldOrderNumber", sWx);//原支付宝消费订单号
				jsO.put("zfbOldOrderNumber", sZfb);//原微信消费订单号
				jsO.put("zfbMbOldOrderNumber",wMb);//原支付宝末笔订单号
				jsO.put("wxMbOldOrderNumber", zMb);//原微信末笔订单号
				jsO.put("tuiOldOrderNumber", tui);//退款订单号
				jsO.put("return_txt", return_Code);//扫码返回数据
				jsO.put("authorizationCode", authorizationCode);//授权码
				jsO.put("anyTransOrderNo", anyTransOrderNo);
				jsO.put("settleJson", settleData);
				jsO.put("json", json);
				
			} catch (JSONException e1) {
				e1.printStackTrace();
			}
			
			etBack.setText(jsO.toString());
			break;
		}
	}
}

package com.example.test2222;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;

import org.json.JSONException;
import org.json.JSONObject;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.ServiceConnection;
import android.content.res.AssetManager;
import android.os.Bundle;
import android.os.IBinder;
import android.os.RemoteException;
import android.text.TextUtils;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.fuyousf.android.fuious.service.MOneSupportService;

@SuppressLint("ShowToast")
public class MainActivity extends Activity implements OnClickListener{

	private MOneSupportService stuService = null;
	private RFReceiver rfReceiver ;
	private EditText etBack;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.activity_main);
		
		etBack = (EditText) findViewById(R.id.transData);//返回数据
		//进入就初始化数据
		Button b = (Button) findViewById(R.id.button222);
		Button b1 = (Button)findViewById(R.id.button1);//自定义打印
		Button b2 = (Button)findViewById(R.id.button2);//结算 
		Button b3 = (Button)findViewById(R.id.button3);//签退
		Button b4 = (Button)findViewById(R.id.button4);//消费   1
		Button b5 = (Button)findViewById(R.id.button5);//支付宝支付 1
		Button b6 = (Button)findViewById(R.id.button6);//支付宝退款 1
		Button b7 = (Button)findViewById(R.id.button7);//支付宝末笔查询 1
		Button b8 = (Button)findViewById(R.id.button8);//消费撤销  1
		Button b9 = (Button)findViewById(R.id.button9);//退货  1
		Button b10 = (Button)findViewById(R.id.button10);//微信消费 1
		Button b11 = (Button)findViewById(R.id.button11);//微信退款
		Button b12 = (Button)findViewById(R.id.button12);//微信末笔查询
		Button b13 = (Button)findViewById(R.id.button13);//余额查询
		Button b14 = (Button)findViewById(R.id.button14);//交易查询
		Button b15 = (Button)findViewById(R.id.button15);//打印
		Button b16 = (Button)findViewById(R.id.button16);//打印任意一笔
		Button b17 = (Button)findViewById(R.id.button17);//系统管理
		Button b18 = (Button)findViewById(R.id.button18);//终端参数
		Button b19 = (Button)findViewById(R.id.button19);//预授权
		Button b20 = (Button)findViewById(R.id.button20);//预授权撤销
		Button b21 = (Button)findViewById(R.id.button21);//预授权完成
		Button b22 = (Button)findViewById(R.id.button22);//预授权完成撤销
		Button b23 = (Button) findViewById(R.id.button23);//打印任意一笔
		Button b24 = (Button) findViewById(R.id.button24);//M1底层调用测试
		Button b25 = (Button) findViewById(R.id.button25);//扫码(二维码，一维码)
		Button b26 = (Button) findViewById(R.id.button26);//订单号查询
		Button b27 = (Button) findViewById(R.id.button27);//单笔查询（联机查询）
		
		b.setOnClickListener(this);
		b1.setOnClickListener(this);
		b2.setOnClickListener(this);
		b3.setOnClickListener(this);
		b4.setOnClickListener(this);
		b5.setOnClickListener(this);
		b6.setOnClickListener(this);
		b7.setOnClickListener(this);
		b8.setOnClickListener(this);
		b9.setOnClickListener(this);
		b10.setOnClickListener(this);
		b11.setOnClickListener(this);
		b12.setOnClickListener(this);
		b13.setOnClickListener(this);
		b14.setOnClickListener(this);
		b15.setOnClickListener(this);
		b16.setOnClickListener(this);
		b17.setOnClickListener(this);
		b18.setOnClickListener(this);
		b19.setOnClickListener(this);
		b20.setOnClickListener(this);
		b21.setOnClickListener(this);
		b22.setOnClickListener(this);
		b23.setOnClickListener(this);
		b24.setOnClickListener(this);
		b25.setOnClickListener(this);
		b26.setOnClickListener(this);
		b27.setOnClickListener(this);
        initService();

	}
	
	@Override
	public void onClick(View v) {
		if(!TextUtils.isEmpty(etBack.getText().toString())){
			etBack.setText("");
		}
		switch (v.getId()) {
		case R.id.button222:
			Intent intent222=new Intent();  
			intent222.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));
			//包名     包名+类名（全路径）  
			intent222.putExtra("transName", "签到");
			startActivityForResult(intent222, 0);
			break;
		case R.id.button1:
			
			//copyFile("pay.bmp");

			Intent intent=new Intent();  
			intent.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.CustomPrinterActivity"));
			//包名     包名+类名（全路径）  
			String str = getFromAssets("json.txt");
			intent.putExtra("data", str);
			intent.putExtra("isPrintTicket", "true");
			startActivityForResult(intent, 99);
			break;
			
		case R.id.button2:
			//copyFile("pay.bmp");

			Intent intent2=new Intent();  
			intent2.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));
			//包名     包名+类名（全路径）  
			intent2.putExtra("transName", "微信银行卡结算");
			intent2.putExtra("isPrintSettleTicket", "false");
			startActivityForResult(intent2, 0);
			break;
			
		case R.id.button3:

			Intent intent3=new Intent();  
			intent3.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));
			//包名     包名+类名（全路径）  
			intent3.putExtra("isPrintTicket", "true");
			intent3.putExtra("transName", "签退");
			startActivityForResult(intent3, 0);
			break;
			
		case R.id.button4:
			Intent intent4 = new Intent();
			intent4.setClass(this, SaleBackActivity.class);
			intent4.putExtra("flag", "消费");
			intent4.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			intent4.putExtra("oldNo", "false");//是否传原凭证号  true-传  false-不传
			startActivity(intent4);
			break;
		case R.id.button5:
			Intent intent5 = new Intent();
			intent5.setClass(this, SaleBackActivity.class);
			intent5.putExtra("flag", "支付宝消费");
			intent5.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			intent5.putExtra("oldNo", "false");//是否传原凭证号  true-传  false-不传
			startActivity(intent5);
			
			break;
		case R.id.button6:
			//支付宝退款
			Intent intent6 = new Intent();
			intent6.setClass(this, SaleBackActivity.class);
			intent6.putExtra("flag", "支付宝退款");
			intent6.putExtra("oldNo", "false");//是否传原证号  true-传  false-不传
			intent6.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			startActivity(intent6);
			break;
		case R.id.button7:
			
			Intent intent7 = new Intent();
			intent7.setClass(this, SaleBackActivity.class);
			intent7.putExtra("flag", "支付宝末笔查询");
			intent7.putExtra("oldNo", "false");//是否传原证号  true-传  false-不传
			intent7.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			startActivity(intent7);
			break;
		case R.id.button8:
			//消费撤销
			Intent intent8 = new Intent();
			intent8.setClass(this, SaleBackActivity.class);
			intent8.putExtra("flag", "消费撤销");
			intent8.putExtra("orderNo", "false");//是否传订单号  true-传  false-不传
			intent8.putExtra("oldNo", "true");//是否传原凭证号  true-传  false-不传
			startActivity(intent8);
			break;
		case R.id.button9:
			Intent intent9 = new Intent();
			intent9.setClass(this, SaleBackActivity.class);
			intent9.putExtra("flag", "退货");
			intent9.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			intent9.putExtra("oldNo", "false");//是否传原凭证号  true-传  false-不传
			startActivity(intent9);
			break;
		case R.id.button10:
			Intent intent10 = new Intent();
			intent10.setClass(this, SaleBackActivity.class);
			intent10.putExtra("flag", "微信消费");
			intent10.putExtra("oldNo", "false");//是否传原证号  true-传  false-不传
			intent10.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			startActivity(intent10);
			break;
		case R.id.button11:
			//微信退款
			Intent intent11 = new Intent();
			intent11.setClass(this, SaleBackActivity.class);
			intent11.putExtra("flag", "微信退款");
			intent11.putExtra("oldNo", "true");//是否传原证号  true-传  false-不传
			intent11.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			startActivity(intent11);
			break;
		case R.id.button12:
			
			Intent intent12 = new Intent();
			intent12.setClass(this, SaleBackActivity.class);
			intent12.putExtra("flag", "微信末笔查询");
			intent12.putExtra("oldNo", "false");//是否传原证号  true-传  false-不传
			intent12.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			startActivity(intent12);
			break;
		case R.id.button13:
			Intent intent13 = new Intent();
			intent13.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));

			//包名     包名+类名（全路径）  
			intent13.putExtra("transName", "余额查询");
			startActivityForResult(intent13, 0);
			break;
		case R.id.button14:
			Intent intent14 = new Intent();
			intent14.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));

			//包名     包名+类名（全路径）  
			intent14.putExtra("transName", "查询数据");
			startActivityForResult(intent14, 0);
			break;
		case R.id.button16:
			Intent intent16 = new Intent();
			intent16.setClass(this, PrintActivity.class);
			startActivity(intent16);
			break;
		case R.id.button23:
			Intent intent23 = new Intent();
			intent23.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));

			//包名     包名+类名（全路径）  
			intent23.putExtra("transName", "打印最后一笔");
			startActivityForResult(intent23, 0);
			break;
		case R.id.button17:
			Intent intent17 = new Intent();
			intent17.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));

			//包名     包名+类名（全路径）  
			intent17.putExtra("transName", "系统管理");
			startActivityForResult(intent17, 0);
			break;
		case R.id.button18:
			Intent intent18 = new Intent();
			intent18.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));

			//包名     包名+类名（全路径）  
			intent18.putExtra("transName", "终端参数");
			startActivityForResult(intent18, 0);
			break;
		case R.id.button19:
			Intent intent19 = new Intent();
			intent19.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));

			//包名     包名+类名（全路径）  
			Bundle bundle = new Bundle();
			intent19.putExtra("transName", "预授权");
			startActivityForResult(intent19, 0);
			break;

		
		case R.id.button20:
			Intent intent20 = new Intent();
			intent20.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));
	
			//包名     包名+类名（全路径）  
			intent20.putExtra("transName", "预授权撤销");
			startActivityForResult(intent20, 0);
			break;
			
		case R.id.button21:
			Intent intent21 = new Intent();
			intent21.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));
	
			//包名     包名+类名（全路径）  
			intent21.putExtra("transName", "预授权完成（请求）");
			startActivityForResult(intent21, 0);
			break;
			
		case R.id.button22:
			Intent intent22 = new Intent();
			intent22.setComponent(new ComponentName("com.fuyousf.android.fuious","com.fuyousf.android.fuious.MainActivity"));
	
			//包名     包名+类名（全路径）  
			intent22.putExtra("transName", "预授权完成撤销");
			startActivityForResult(intent22, 0);
			break;
		case R.id.button24:
			//底层调用传入值，开始读取卡
			
	         if(null != stuService){
	        	 byte[] keyA = hexString2Bytes("FFFFFFFFFFFF");
	        	 try {
					stuService.readBlock(1, 2, keyA);
				} catch (RemoteException e) {
					e.printStackTrace();
				}
	         }
			break;
		case R.id.button25:
			Intent intent25 = new Intent();
			intent25.setComponent(new ComponentName("com.fuyousf.android.fuious",
					"com.fuyousf.android.fuious.NewSetScanCodeActivity"));
			intent25.putExtra("flag", "true");
			startActivityForResult(intent25, 0);
			break;
		case R.id.button26:
			Intent intent26 = new Intent();
			intent26.setClass(this, SaleBackActivity.class);
			intent26.putExtra("flag", "订单号查询");
			intent26.putExtra("oldNo", "false");//是否传原证号  true-传  false-不传
			intent26.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			startActivity(intent26);
			break;
		case R.id.button27:
			Intent button27 = new Intent();
			button27.setClass(this, SaleBackActivity.class);
			button27.putExtra("flag", "联机查询");
			button27.putExtra("oldNo", "true");//是否传原证号  true-传  false-不传
			button27.putExtra("orderNo", "true");//是否传订单号  true-传  false-不传
			startActivity(button27);
			break;
		}
	}
	

	/**
	 * 下面是从assets中将图片复制到SD卡目录的参考方法 图片是黑白单色图
	 * */
	private void copyFile(String filename) {
		AssetManager assetManager = this.getAssets();

		InputStream in = null;
		OutputStream out = null;
		try {
			in = assetManager.open(filename);
			makeRootDirectory("/sdcard/tmp");
			String newFileName = "/sdcard/tmp/" + filename;
			out = new FileOutputStream(newFileName);

			byte[] buffer = new byte[1024];
			int read;
			while ((read = in.read(buffer)) != -1) {
				out.write(buffer, 0, read);
			}
			in.close();
			in = null;
			out.flush();
			out.close();
			out = null;
		} catch (Exception e) {
			Log.d("Fuiou", e.getMessage());
		}

	}

	public static void makeRootDirectory(String filePath) {
		File file = null;
		try {
			file = new File(filePath);
			if (!file.exists()) {
				Log.d("Login", "new filePath:" + filePath);
				file.mkdir();
			}
		} catch (Exception e) {

		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
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
			String ordernumber = "";
			if (data != null) {
				Bundle b = data.getExtras();
				if (b != null) {
					reason = (String) b.get("reason");
					traceNo = (String)b.getString("traceNo");
					batchNo = (String)b.getString("batchNo");
					ordernumber = (String)b.getString("ordernumber");
				}
			}
			if (reason != null) {
				Log.d("reason", reason);
				Toast.makeText(this, reason, 0).show();
			}
			Log.w("TAG", "失败返回值--reason--返回值："+reason+"/n 凭证号："+traceNo+"/n 批次号："+batchNo+"/n 订单号："+ordernumber);
			
			etBack.setText("失败："+reason+"/n 凭证号："+traceNo+"/n 批次号："+batchNo+"/n 订单号："+ordernumber);
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
			
			String referenceNoSuccess = data.getStringExtra("referenceNoSuccess");//订单查询返回参考号
			
			String oldReferenceNoSuccess = data.getStringExtra("oldReferenceNoSuccess");//订单查询返回原参考号
			
			String amount = data.getStringExtra("amount");//金额
			
			String acqId = data.getStringExtra("acqId");//收单行
			
			String expiredDate = data.getStringExtra("expiredDate");//卡有效期

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
				jsO.put("referenceNoSuccess", referenceNoSuccess);//订单查询参考号
				jsO.put("oldReferenceNoSuccess", oldReferenceNoSuccess);//订单查询原参考号
				jsO.put("amount", amount);
				jsO.put("acqId", acqId);
				jsO.put("expiredDate", expiredDate);
				jsO.put("settleJson", settleData);
				jsO.put("json", json);
				
			} catch (JSONException e1) {
				e1.printStackTrace();
			}
			
			etBack.setText(jsO.toString());
			break;
		}
	}

	public String getFromAssets(String fileName) {
		try {
			InputStreamReader inputReader = new InputStreamReader(
					getResources().getAssets().open(fileName));
			BufferedReader bufReader = new BufferedReader(inputReader);
			String line = "";
			String Result = "";
			while ((line = bufReader.readLine()) != null)
				Result += line;
			return Result;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return "";
	}
	
	//绑定服务，注册广播
	private void initService(){
		registerReceiver();
		
		Intent terminalIntent = new Intent("com.fuyousf.android.fuious.service.MOneSupportService");
        bindService(terminalIntent, serviceConnection, Context.BIND_AUTO_CREATE);
	}
	
	//服务的链接
	private ServiceConnection serviceConnection = new ServiceConnection() {
         
	        @Override
	        public void onServiceDisconnected(ComponentName name) {
	        	
	        }
	         
	        @Override
	        public void onServiceConnected(ComponentName name, IBinder service) {
	        	Log.w("TAG", "--绑定service--");
	            stuService = MOneSupportService.Stub.asInterface(service);
	        }
    };
    
    //广播祖册
    private void registerReceiver(){
    	 IntentFilter intentFilter = new IntentFilter();
         intentFilter.addAction("com.fuyousf.android.fuious.service");
         rfReceiver = new RFReceiver();
    	 registerReceiver(rfReceiver, intentFilter);
    }
    
    @Override
    protected void onDestroy() {
    	super.onDestroy();
    	if(null != rfReceiver){
    		unregisterReceiver(rfReceiver);
    	}
    	unbindService(serviceConnection);
    }
	     
    class RFReceiver extends BroadcastReceiver {

		@Override
        public void onReceive(Context context, Intent intent) {
            String status = intent.getStringExtra("status");
            String result = intent.getStringExtra("result");
            etBack.setText("状态："+status+"--|结果："+result);
        }
    }

    public static byte[] hexString2Bytes(String data)
    {
      byte[] result = new byte[(data.length() + 1) / 2];
      if ((data.length() & 0x1) == 1) {
        data = data + "0";
      }
      for (int i = 0; i < result.length; ++i) {
        result[i] = (byte)(hex2byte(data.charAt(i * 2 + 1)) | hex2byte(data.charAt(i * 2)) << 4);
      }
      return result;
    }
    

    public static byte hex2byte(char hex)
    {
      if ((hex <= 'f') && (hex >= 'a')) {
        return (byte)(hex - 'a' + 10);
      }

      if ((hex <= 'F') && (hex >= 'A')) {
        return (byte)(hex - 'A' + 10);
      }

      if ((hex <= '9') && (hex >= '0')) {
        return (byte)(hex - '0');
      }

      return 0;
    }

}

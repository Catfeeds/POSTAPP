package com.example.test2222;

import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.Map;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;


public class PrintClient {
	
	private Map<String,String> printMap = new LinkedHashMap<String,String>();
	
	public void setText(String value,String type){
		printMap.put(value, type);
	}
	
	public String save(){
		
		JSONArray array = new JSONArray();

		Iterator<Map.Entry<String, String>> iter = printMap.entrySet().iterator();
		while (iter.hasNext()) {
			Map.Entry<String,String> entry = (Map.Entry<String,String>) iter.next();
			String key = entry.getKey();
			String val = entry.getValue();

			
			if(val.equals("正文居左")){

				try {
					
					JSONObject obj2 = new JSONObject();
					obj2.put("name", "HzSize");
					obj2.put("HzSize", "HZ_SC1x1");
					array.put(obj2);
					
					JSONObject obj3 = new JSONObject();
					obj3.put("name", "setFormat");
					obj3.put("setFormat", "true");
					array.put(obj3);
					
					JSONObject obj4 = new JSONObject();
					obj4.put("name", "printText");
					obj4.put("printText", key);
					array.put(obj4);
					
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				

			}
			
			if(val.equals("正文居中")){
				try {
					JSONObject obj2 = new JSONObject();
					obj2.put("name", "HzSize");
					obj2.put("HzSize", "HZ_SC1x1");
					array.put(obj2);
					
					JSONObject obj6 = new JSONObject();
					obj6.put("name", "setFormat");
					obj6.put("setFormat", "true");
					array.put(obj6);
					
					JSONObject obj8 = new JSONObject();
					obj8.put("name", "printText|CENTER");
					obj8.put("printText|CENTER", key);
					array.put(obj8);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				

			}
			
			if(val.equals("标题居中")){
				try {
					
					JSONObject obj10 = new JSONObject();
					obj10.put("name", "HzSize");
					obj10.put("HzSize", "HZ_SC2x2");
					array.put(obj10);
					
					JSONObject obj016 = new JSONObject();
					obj016.put("name", "setFormat");
					obj016.put("setFormat", "true");
					array.put(obj016);
					
					JSONObject obj11 = new JSONObject();
					obj11.put("name", "printText|CENTER");
					obj11.put("printText|CENTER", key);
					array.put(obj11);
				
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			if(val.equals("一维码")){
				try {
					JSONObject obj12 = new JSONObject();
					obj12.put("name", "printBarCode");
					obj12.put("printBarCode", key);
					array.put(obj12);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			if(val.equals("二维码")){
				try {
					JSONObject obj13 = new JSONObject();
					obj13.put("name", "printQrCode");
					obj13.put("printQrCode", key);
					array.put(obj13);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			if(val.equals("文字居中")){
				try {
					JSONObject obj14 = new JSONObject();
					obj14.put("name", "printText|CENTER");
					obj14.put("printText|CENTER", "------landicorp------\n");
					array.put(obj14);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			
			if(val.equals("图片居中")){
				try {
					JSONObject obj15 = new JSONObject();
					obj15.put("name", "printImage|CENTER");
					obj15.put("printImage|CENTER", key);
					array.put(obj15);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			if(val.equals("正文居右")){
				try {
					
					JSONObject obj2 = new JSONObject();
					obj2.put("name", "HzSize");
					obj2.put("HzSize", "HZ_SC1x1");
					array.put(obj2);
					
					JSONObject obj6 = new JSONObject();
					obj6.put("name", "setFormat");
					obj6.put("setFormat", "true");
					array.put(obj6);
					
					JSONObject obj17 = new JSONObject();
					obj17.put("name", "printText|RIGHT");
					obj17.put("printText|RIGHT", key);
					array.put(obj17);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			if(val.equals("金额")){
				try {
					JSONObject obj018 = new JSONObject();
					obj018.put("name", "AscScale");
					obj018.put("AscScale", "ASC_SC1x2");
					array.put(obj018);


					JSONObject obj019 = new JSONObject();
					obj019.put("name", "setFormat");
					obj019.put("setFormat", "true");
					array.put(obj019);


					JSONObject obj020 = new JSONObject();
					obj020.put("name", "printText");
					obj020.put("printText", key);
					array.put(obj020);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			if(val.equals("空行")){
				try {
					JSONObject obj16 = new JSONObject();
					obj16.put("name", "feedLine");
					obj16.put("feedLine", key);
					array.put(obj16);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			if(val.equals("小字体")){
				//中文标题字体 
				try {
					JSONObject obj018 = new JSONObject();
					obj018.put("name", "HzSize");
					obj018.put("HzSize", "HZ_SC2x2");
					array.put(obj018);


					JSONObject obj019 = new JSONObject();
					obj019.put("name", "setFormat");
					obj019.put("setFormat", "true");
					array.put(obj019);

					JSONObject obj020 = new JSONObject();
					obj020.put("name", "printText");
					obj020.put("printText", key);
					array.put(obj020);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			
			if(val.equals("英文正文")){
				try {
					JSONObject obj021 = new JSONObject();
					obj021.put("name", "AscScale");
					obj021.put("AscScale", "ASC_SC1x1");
					array.put(obj021);


					JSONObject obj022 = new JSONObject();
					obj022.put("name", "setFormat");
					obj022.put("setFormat", "true");
					array.put(obj022);


					JSONObject obj023 = new JSONObject();
					obj023.put("name", "printText");
					obj023.put("printText", key);
					array.put(obj023);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
		}
		
		return array.toString();
		
	}
	
	
	
	
	
	
	
	

	
	
		
	

	
	
	
	
	
	
	
	
	

}

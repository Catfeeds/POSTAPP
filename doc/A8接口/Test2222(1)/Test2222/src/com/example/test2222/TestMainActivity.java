package com.example.test2222;


import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;



import android.app.Activity;
import android.content.res.Resources;
import android.os.Bundle;
import android.view.Window;
import android.widget.ListView;

public class TestMainActivity extends Activity{
	private List<String> transNameListHasData = new ArrayList<String>();
	private List<String> transNameList = new ArrayList<String>();

	private ListView transListView;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		this.requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.main);
	}
	
	private void init(){
		transListView = (ListView) findViewById(R.id.transList);
		

	}
	
	private void getTransNameList() {
		Resources res = getResources();
		transNameListHasData = Arrays.asList(res
				.getStringArray(R.array.transListHasData));
		transNameList.addAll(transNameListHasData);
		return;
	}
}

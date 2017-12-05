<!--#include file="topwap.asp"-->
<!--#include file="../flying_func/md5.asp"-->
<%
if request.QueryString("action")="addok" then
'提取表单数据
	yz=cutsql(trim(Request("yz"))) '验证码
	'if Session("Admin_GetCode")="" then
	'	call back("你登录时间过长，请重新返回登录页面进行登录。\n\n")
	'end if
	'if yz<>CStr(Session("Admin_GetCode")) then
	'	call back("您输入的确认码和系统产生的不一致，请重新输入。\n\n")
	'end if
	fyly=2 '房源来源
	if fyly<>1 and fyly<>2 then call show_go("非法参数","wwdj4.asp") end if
	fzxm=cutsql(trim(request.Form("fzxm"))) '房主姓名
	fzxb=request.Form("fzxb") '房主性别
	'if fzxb<>"男" and fzxb<>"女" then call show_go("非法参数","wwdj4.asp") end if
	fzsj=request.Form("fzsj") '房主手机"
	if not isint(fzsj) then call show_go("非法参数","wwdj4.asp") end if
	fzdh1=cutsql(trim(request.Form("fzdh1"))) '房主电话
	fzdh2=cutsql(trim(request.Form("fzdh2")))
	if fzdh1<>"" then
		fzdh=fzdh1&"-"&fzdh2
	else
		fzdh=fzdh2
	end if
	fzyx=cutsql(request.Form("fzyx")) '房主电子邮箱
	
	wzcs=request.Form("wzcs") '房源城市
	if (not isint(wzcs)) or wzcs<0 then call show_go("非法参数","wwdj4.asp") end if
	wzpq=request.Form("wzpq") '房源片区
	wzpqa=request.Form("wzpqa") '房源片区
	if not isint(wzpq) then call show_go("非法参数","wwdj4.asp") end if
	wzxq=cutsql(trim(request.Form("wzxq"))) '房源小区
	wzxq1=cutsql(trim(request.Form("wzxq1"))) '手工房源小区
	if wzxq="0" then wzxq=wzxq1 end if
	csyt=request.Form("csyt") '房源用途
	if (not isint(csyt)) or csyt<0 then call show_go("非法参数","wwdj4.asp") end if
	cshxt=cutsql(trim(request.Form("cshxt")))  '房源户型
	cshxs=cutsql(trim(request.Form("cshxs")))
	cshxw=cutsql(trim(request.Form("cshxw")))
	cshxy=cutsql(trim(request.Form("cshxy")))
	cshxc=cutsql(trim(request.Form("cshxc")))
	zj1=cutsql(trim(request.Form("zj1"))) '租金
	zj2=cutsql(trim(request.Form("zj2"))) '租金
	csmj1=cutsql(trim(request.Form("csmj1"))) '面积
	csmj2=cutsql(trim(request.Form("csmj2"))) '面积
	cslc1=cutsql(trim(request.Form("cslc1"))) '楼层
	cslc2=cutsql(trim(request.Form("cslc2"))) 
	zdzq=cutsql(trim(request.Form("zdzq"))) '最短租期
	cszx=cutsql(trim(request.Form("cszx"))) '装修程度
	cspt=cutsql(request.Form("cspt")) '配套设施
	csbz=left(cutsql(trim(request.Form("csbz"))),200) '备注信息
'写入数据库	
	'判断是否相同房源
	set tyrs=server.CreateObject("adodb.recordset")
	tysql="select * from housexx_qz where fzxm='"&fzxm&"' and fzsj='"&fzsj&"' and wzcs="&wzcs&" and wzpq="&wzpq&" and csyt="&csyt
	tyrs.open tysql,conn,1,3
	tynum=0
	if not tyrs.eof then
		tynum=tyrs.recordcount
		tyid=tyrs("bh")
		if tynum=1 then 
			tyrs("tyid")=tyrs("bh") 
			tyrs.update
		end if 
	else
		tyid=0
	end if
	tyrs.close
	set tyrs=nothing
	'写入数据库
	if tynum=0 then '没有同源
		set rs=server.CreateObject("adodb.recordset")
	sql="select top 1 * from housexx_qz"
	rs.open sql,conn,1,3
	rs.addnew
	rs("fzxm")=fzxm '房主姓名，字符型,*
	rs("fzsj")=fzsj	'房主手机，字符型,*
	rs("fzdh")=fzdh	'房主电话，字符型
	rs("fzyx")=fzyx	'房主电邮，字符型
	rs("fzxb")=fzxb '房主性别，字符型
	rs("sjfb")=now()	'发布时间，日期型
	rs("sjyxq")=30 '有效期，数值型
	if fyly=2  then
		if grsh="false" then '如果不用审核
			rs("sjzx")=now()
			rs("sjxx")=now()+30
			rs("zt")=1
		else
			rs("zt")=2
		end if
	end if
	if fyly=1 then
		rs("zt")=3 
	end if
	rs("wzcs")=cint(wzcs)   '城市id，数值型,*
	rs("wzpq")=cint(wzpq)   '片区id，数值型,*
	rs("wzpqa")=cint(wzpqa)   '片区id，数值型,*
	rs("wzxq")=wzxq   '小区名称，字符型,*
	rs("csyt")=cint(csyt) 	'房源用途id，数值型
	rs("cshxs")=cint(cshxs)  '户型几室，数值型
	rs("cshxt")=cint(cshxt)   '户型几厅，数值型
	rs("cshxw")=cint(cshxw)  '户型几卫，数值型
	rs("cshxy")=cint(cshxy)   '户型几阳台，数值型
	rs("cshxc")=cint(cshxc)   '户型几阳台，数值型
	rs("cslc1")=cint(cslc1)  '楼层，数值型
	rs("cslc2")=cint(cslc2)   '楼层，数值型
	rs("csmj1")=cdbl(csmj1)   '面积，数值型,*
	rs("csmj2")=cdbl(csmj2)   '面积，数值型,*
	rs("zj1")=cdbl(zj1)    '租金，数值型,*
	rs("zj2")=cdbl(zj2)    '租金，数值型,*
	rs("zdzq")=cint(zdzq)    '最短租期，数值型
	rs("cszx")=cint(cszx)	 '装修程度，数值型
	rs("cspt")=cspt  '配套设施
	rs("csbz")=csbz    '特色介绍，备注型
	rs("fyly")=fyly  '房源来源，数值型
	if tynum<>0 then rs("tyid")=tyid end if '同源房源
	if fyly=2 then rs("modipass")=md5(yz) end if
	bh=cstr(rs("id"))
	lenbh=8-len(bh)
	for x=1 to lenbh
		bh="0"&bh
	next
	rs("bh")=bh
	rs.update
	rs.close
	set rs=nothing
	call connclose()
	if fyly=2 then
		call show_go("发布成功\n\n牢记你的房源编号："&bh&"\n\n专业经纪人将尽快和你联系","wwdj4.asp")
	else
		call show_go("发布成功\n\n牢记你的房源编号："&bh&"\n\n专业经纪人将尽快和你联系","wwdj4.asp")
	end if
	else
		call show_go("系统中已有此房源\n\n同源编号为"&tyid,"wwdj4.asp")
	end if
end if
%>
<script language="javascript">
function OpenWindowAndSetValue(Url,Width,Height,WindowObj,SetObj)
{
	var ReturnStr=showModalDialog(Url,WindowObj,'dialogWidth:'+Width+'pt;dialogHeight:'+Height+'pt;status:no;help:no;scroll:no;');
	SetObj.value=ReturnStr;
	return ReturnStr;
}
function checkfabuqz(obj)
{
	if (trimstr(obj.fzxm.value)==""){
		alert("请填写姓名");
		obj.fzxm.focus();
		return false;
	}
	if (obj.fzsj.value==""){
		alert("请填写手机");
		obj.fzsj.focus();
		return false;
	}
	if (obj.wzcs.value=="0"){
		alert("请选择房源所在城市");
		obj.wzcs.focus();
		return false;
	}
	if (obj.csyt.value=="0"){
		alert("请选择房源类型");
		obj.csyt.focus();
		return false;
	}
	//if (trimstr(obj.zj1.value)==""){
	//	alert("请填写最低租金预算");
	//	obj.zj1.focus();
	//	return false;
	//}
	//if (trimstr(obj.zj2.value)==""){
	//	alert("请填写最高租金预算");
	//	obj.zj2.focus();
	//	return false;
	//}
	//if (parseFloat(trimstr(obj.zj1.value))>parseFloat(trimstr(obj.zj2.value))){
	//	alert("请从低到高填写租金");
	//	obj.zj1.focus();
	//	return false;
	//}
	//if (trimstr(obj.csmj1.value)==""){
	//	alert("请填写最低预租面积");
	//	obj.csmj1.focus();
	//	return false;
	//}
		if (obj.tyqbox.value=="1"){
		alert("请阅读说明");
		obj.tyqbox.focus();
		return false;
	}
	//if (trimstr(obj.csmj2.value)==""){
	//	alert("请填写最高预租面积");
	//	obj.csmj2.focus();
	//	return false;
	//}
	//if (parseFloat(trimstr(obj.csmj1.value))>parseFloat(trimstr(obj.csmj2.value))){
	//	alert("请从低到高填写预租面积");
	//	obj.csmj1.focus();
	//	return false;
	//}
	//if (obj.yz.value==""){
	//	alert("请填写验证码");
	//	obj.yz.focus();
	//	return false;
	//}
	return true;
}
</script>

		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">登记租房信息[加*为必填项]</h1>
		</header>
		<div class="mui-content">
			<div id="slider" class="mui-slider">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item" href="wwdj1.asp">
						出售
					</a>
					<a class="mui-control-item" href="wwdj2.asp">
						出租
					</a>
					<a class="mui-control-item" href="wwdj3.asp">
						求购
					</a>
					<a class="mui-control-item" style="border-bottom:2px solid #007aff;color:#007aff;" href="wwdj4.asp">
						求租
					</a>
				</div>
			</div>
		</div>

			<form class="mui-input-group" id="fabucs" name="fabucs" method="post" action="?action=addok" onsubmit="return checkfabuqz(this);">
				<input name="fyly" type="hidden" value="2" />
				<div class="mui-content-padded" style="margin: 5px;margin-top:-10px;">
					<h5 class="mui-content-padded">联系方式</h5>
					<div class="mui-card">
						<div class="mui-input-row">
							<label>您的姓名：<span class="star">*</span></label>
							<input type="text" name="fzxm" id="fzxm" maxlength="4" class="mui-input-clear" placeholder="请输入">
						</div>
						<div class="mui-input-row">
							<label>您的手机：<span class="star">*</span></label>
							<input type="text" name="fzsj" id="fzsj" onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" maxlength="12" class="mui-input-clear" placeholder="请输入">
						</div>
						<!--<div class="mui-input-row mui-radio">
							<label style="padding: 11px 15px;width: 35%;">性别：</label>

							<input name="fzxb" style="position: initial;float: initial;" value="男" checked="checked" type="radio">男
							<input name="fzxb" style="position: initial;float: initial;" value="女" type="radio" checked>女
						</div>
						
						<div class="mui-input-row">
							<label>验证码：</label>
							<div style="width: 30%;float: right;height: 40px;"><img src="../flying_func/Code.asp" width="60" height="30"></div>
							<input type="text" name="yz" id="yz" size="8" maxlength="4" style="width: 35%;" class="mui-input-clear" placeholder="">
						</div>-->
					</div>
				</div>

				<div class="mui-content-padded" style="margin: 5px;">
					<h5 class="mui-content-padded">基本要求</h5>
					<div class="mui-card">
						<div class="mui-input-row">
							<label>预租城市：<span class="star">*</span></label>
							<select name="wzcs" id="wzcs"  onChange="changepq(document.fabuqg.wzpq,document.fabuqg.wzcs.options[document.fabuqg.wzcs.selectedIndex].value)">
								<option value="2">简阳市</option>
								<%
								for i=0 to csnum-1
										response.Write "<option value='" & trim(csarr(0,i)) & "'>" & trim(csarr(1,i)) & "</option>"
								next
								%>
							</select>
						</div>
						<div class="mui-input-row">
							<label style="width:38%">预租片区：</label>
							<select style="width:27%;float:left;" name="wzpq" id="wzpq" onChange="changexq(document.fabuqg.wzxq,document.fabuqg.wzpq.options[document.fabuqg.wzpq.selectedIndex].value)">
								<option value="0">请选择</option>
                                <option value="0">片区不限</option>
								<option value="3">城中片区</option>
								<option value="4">城东片区</option>
								<option value="5">城北片区</option>
								<option value="6">城西片区</option>
								<option value="7">城南片区</option>
								<option value="8">河东新区</option>
								<option value="9">其他地区</option>
								<option value="11">东溪镇</option>
							</select>
							<div style="width:7%;float:left;height:40px;line-height:40px;">或</div>
						
							<select style="width:28%;float:left;" name="wzpqa" id="wzpqa" onChange="changexq(document.fabuqg.wzxqa,document.fabuqg.wzpqa.options[document.fabuqg.wzpqa.selectedIndex].value)">
								<option value="0">请选择</option>
                                <option value="0">片区不限</option>
								<option value="3">城中片区</option>
								<option value="4">城东片区</option>
								<option value="5">城北片区</option>
								<option value="6">城西片区</option>
								<option value="7">城南片区</option>
								<option value="8">河东新区</option>
								<option value="9">其他地区</option>
								<option value="11">东溪镇</option>
							</select>
						</div>

						<!--<div class="mui-input-row">
							<label>小区：</label>
							<select style="width:55%;float:left;" name="wzxq" id="wzxq">
							  <option value="0">小区不限</option>
							</select>
							<div style="width:10%;float:left;height:40px;line-height:40px;">或</div>
						</div>
						<div class="mui-input-row">
							<input type="text" name="wzxq1" id="wzxq1" class="mui-input-clear" placeholder="手动输入小区名称">
						</div>
						
						<div class="mui-input-row">
							<label>租金预算<span class="star">*</span>：</label>
							<div style="width:7%;height:40px;line-height:40px;float:left;">从</div>
							<input name="zj1" style="width:19%;float:left;" type="text" id="zj1" size="8" maxlength="12" onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57)&amp;&amp;(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:7%;height:40px;line-height:40px;float:left;">到</div>
							<input name="zj2" style="width:19%;float:left;" type="text" id="zj2" size="8" maxlength="12" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57)&&(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:12%;height:40px;line-height:40px;float:left;">元/月</div>
						</div>
						
						<div class="mui-input-row">
							<label>面积<span class="star">*</span>：</label>
							<div style="width:7%;height:40px;line-height:40px;float:left;">从</div>
							<input name="csmj1" type="text" style="width:19%;float:left;" id="csmj1" size="8" maxlength="16" onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )&amp;&amp;(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:7%;height:40px;line-height:40px;float:left;">到</div>
							<input name="csmj2" type="text" style="width:19%;float:left;" id="csmj2" size="8" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:12%;height:40px;line-height:40px;float:left;">平米</div>
						</div>
						
						<div class="mui-input-row">
							<label>楼层：</label>
							<div style="width:8%;height:40px;line-height:40px;float:left;">从</div>
							<input name="cslc1" type="text" id="cslc1" size="6" style="width:19%;float:left;"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
							<div style="width:8%;height:40px;line-height:40px;float:left;">到</div>
							<input name="cslc2" type="text" id="cslc2" size="6" style="width:19%;float:left;"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
							<div style="width:8%;height:40px;line-height:40px;float:left;">层</div>
						</div>-->
						
						<div class="mui-input-row">
							<label>预租类型：<span class="star">*</span></label>
							<select name="csyt" id="csyt">
								<option value="0">请选择</option>
								<%
								'读房源类型记录
								set ytrs=server.CreateObject("adodb.recordset")
								ytsql="select * from housecs_yt order by xh"
								ytrs.open ytsql,conn,1,1
								while not ytrs.eof
									response.Write("<option value="""&ytrs("id")&""">"&ytrs("yt")&"</option>")
									ytrs.movenext
								wend
								ytrs.close
								set ytrs=nothing
								%>
							</select>
						</div>
						
						<div class="mui-input-row">
							<label>预租户型：</label>
							<select name="cshxs" id="cshxs" style="width: 20%;float: left;">
								<option value="0">请选择</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
							<div style="width: 17%;float: left;height: 40px;line-height: 40px;">室</div>
							<!--
							<select name="cshxt" id="cshxt" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">厅</div>

							<select name="cshxw" id="cshxw" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">卫</div>

							<select name="cshxc" id="cshxc" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">厨</div>

							<select name="cshxy" id="cshxy" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">阳台</div>
							-->
						</div>
						<!--
						<div class="mui-input-row">
							<label>装修程度：</label>
							<select name="cszx"  id="cszx">
								<option value="0">请选择装修程度</option>
							<%
								'读装修程度记录
								set zxrs=server.CreateObject("adodb.recordset")
								zxsql="select * from housecs_zx order by xh"
								zxrs.open zxsql,conn,1,1
								while not zxrs.eof
									response.Write("<option value="""&zxrs("id")&""">"&zxrs("zx")&"</option>")
									zxrs.movenext
								wend
								zxrs.close
								set zxrs=nothing
								%>
							</select>
						</div>-->
						<div class="mui-input-row" style="height:125px;">
							<label>租房要求：</label>
							<textarea id="textarea" rows="5" name="csbz" placeholder="请填写"></textarea>
						</div>
						
						<div class="mui-input-row  mui-checkbox">
							<label style="padding-right:0;width:35%;">委 托 书：</label>
							<div style="width: 40%;float: right;height: 40px;line-height: 40px;font-size: 12px"><a onclick="javascript:window.open('/wts-qz.asp', 'newwindow', 'height=440, width=400, toolbar=no, menubar=no, scrollbars=auto, resizable=no, location=no, status=no')" >《房屋承租委托书》</a></div>
							<!--<select size="1" name="tyqbox" style="width: 25%;">
								<option value="1">未阅读</option>
								<option tyqbox value="2" >已阅读</option>
							</select>-->
							<div  style="float: right;height: 40px;line-height: 40px;font-size: 12px">已阅读</div>
							<input name="tyqbox" value="1" type="checkbox" style="right:initial;">
						</div>
						
					</div>

					<input name="Submit" style="background: #007aff;margin-top: 20px;width: 40%;margin-left: 30%;" type="submit" value="提交信息">
					<div class="mui-input-row">
					</div>
				</div>
			</form>
			<script>
	$(".mui-checkbox").on("change",'input',function(){
		var value = this.checked?true:false;
		if(value == true){
			this.value = 2;
		}else{
			this.value = 1;
		}
	});
</script>
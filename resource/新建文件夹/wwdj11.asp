<!--#include file="topwap.asp"-->
<!--#include file="../flying_func/md5.asp"-->
<!--#include file="../flying_func/config.asp"-->
<%
if request.QueryString("action")="addok" then
'提取表单数据
	yz=cutsql(trim(Request("yz"))) '验证码
	if Session("Admin_GetCode")="" then
		call back("你登录时间过长，请重新返回登录页面进行登录。\n\n")
	end if
	if yz<>CStr(Session("Admin_GetCode")) then
		call back("您输入的确认码和系统产生的不一致，请重新输入。\n\n")
	end if
	fyly=request.Form("fyly") '房源来源
	if fyly<>1 and fyly<>2 then call show_go("非法参数","index.asp") end if
	fzxm=cutsql(trim(request.Form("fzxm"))) '房主姓名
	fzxb=request.Form("fzxb") '房主性别
	if fzxb<>"男" and fzxb<>"女" then call show_go("非法参数","index.asp") end if
	fzsj=request.Form("fzsj") '房主手机"
	if not isint(fzsj) then call show_go("非法参数","index.asp") end if
	fzdh1=cutsql(trim(request.Form("fzdh1"))) '房主电话
	fzdh2=cutsql(trim(request.Form("fzdh2")))
	if fzdh1<>"" then
		fzdh=fzdh1&"-"&fzdh2
	else
	fzdh=fzdh2
end if
	fzyx=cutsql(request.Form("fzyx")) '房主电子邮箱
	wzcs=request.Form("wzcs") '房源城市
	'if (not isint(wzcs)) or wzcs<0 then call show_go("非法参数","index.asp") end if
	wzpq=request.Form("wzpq") '房源片区
	'if (not isint(wzpq)) or wzpq<0 then call show_go("非法参数","index.asp") end if
	wzxq=cutsql(trim(request.Form("wzxq"))) '房源小区
	wzxq1=cutsql(trim(request.Form("wzxq1"))) '手工房源小区
	'if wzxq="" and wzxq1=""  then call show_go("非法参数","index.asp") end if
	'if wzxq="0" then wzxq=wzxq1 end if
	wzdz=cutsql(trim(request.Form("wzdz"))) '详细地址
	if wzdz="" then call show_go("非法参数","index.asp") end if
	csyt=request.Form("csyt") '房源用途
	if (not isint(csyt)) or csyt<0 then call show_go("非法参数","index.asp") end if
		cshxt=cutsql(trim(request.Form("cshxt")))
		cshxs=cutsql(trim(request.Form("cshxs")))
		cshxw=cutsql(trim(request.Form("cshxw")))
		cshxy=cutsql(trim(request.Form("cshxy")))
		cshxc=cutsql(trim(request.Form("cshxc")))
	cssj=cutsql(trim(request.Form("cssj"))) '售价
	csmjj=cutsql(trim(request.Form("csmjj"))) '面积
	cslcz=cutsql(trim(request.Form("cslcz"))) '楼层
	cslcj=cutsql(trim(request.Form("cslcj"))) 
	csnd=cutsql(trim(request.Form("csnd"))) '建筑年代
	csqs=cutsql(trim(request.Form("csqs"))) '权属
	cszx=cutsql(trim(request.Form("cszx"))) '装修程度
	csjg=cutsql(trim(request.Form("csjg"))) '建筑结构
	cspt=cutsql(trim(request.Form("cspt"))) '配套设施
	csbz=left(cutsql(trim(request.Form("csbz"))),200) '备注信息
	ditux=request.Form("ezmarker.x")
	dituy=request.Form("ezmarker.y")
	dituz=request.Form("ezmarker.z")
'写入数据库	
	'判断是否相同房源
	set tyrs=server.CreateObject("adodb.recordset")
	tysql="select * from housexx_cs where fzxm='"&fzxm&"' and fzsj='"&fzsj&"' and csmjj="&csmjj&" and cssj="&cssj&" and wzcs="&wzcs&" and wzpq="&wzpq&" and csyt="&csyt
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
	if tynum=0 then '没有同源
	set rs=server.CreateObject("adodb.recordset")
	sql="select top 1 * from housexx_cs"
	rs.open sql,conn,1,3
	rs.addnew
		rs("fzxm")=fzxm '房主姓名，字符型,*
		rs("fzsj")=fzsj	'房主手机，字符型,*
		rs("fzdh")=fzdh	'房主电话，字符型
		rs("fzyx")=fzyx	'房主电邮，字符型
		rs("fzxb")=fzxb '房主性别，字符型
		rs("sjfb")=now()	'发布时间，日期型
		rs("sjyxq")=90 '有效期，数值型
		if fyly=2  then
			if grsh="false" then '如果不用审核
			rs("sjzx")=now()
			rs("sjxx")=now()+90
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
		rs("wzxq")=wzxq   '小区名称，字符型,*
		rs("wzdz")=wzdz	'详细地址，字符型,*
		rs("csyt")=cint(csyt) 	'房源用途id，数值型
		rs("cshxs")=cint(cshxs)  '户型几室，数值型
		rs("cshxt")=cint(cshxt)   '户型几厅，数值型
		rs("cshxw")=cint(cshxw)  '户型几卫，数值型
		rs("cshxy")=cint(cshxy)   '户型几阳台，数值型
		rs("cshxc")=cint(cshxc)   '户型几阳台，数值型
		rs("cslcz")=cint(cslcz)  '总几层，数值型
		rs("cslcj")=cint(cslcj)   '第几层，数值型
		rs("csmjj")=cdbl(csmjj)   '建筑面积，数值型,*
		rs("cssj")=cdbl(cssj)    '售价，数值型,*
		rs("csnd")=cint(csnd)    '建筑年代，数值型
		rs("csqs")=cint(csqs)    '权属，数值型
		rs("cszx")=cint(cszx)	 '装修程度，数值型
		rs("csjg")=cint(csjg) 	 '建筑结构，数值型
		rs("cspt")=cspt	 '配套设施，字符型
		rs("csbz")=csbz    '特色介绍，备注型
		rs("fyly")=fyly  '房源来源，数值型
		if tynum<>0 then rs("tyid")=tyid end if '同源房源
		if fyly=2 then rs("modipass")=md5(yz) end if
			rs("ditux")=ditux
			rs("dituy")=dituy
			rs("dituz")=dituz
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
				call show_go("成功发布\n\n牢记你的房源编号："&bh&"\n\n你的维护密码："&yz,"index.asp")
			else
			call show_go("发布成功\n\n专业经纪人将尽快和你联系","index.asp")
		end if
	else
	call show_go("系统中已有此房源\n\n同源编号为"&tyid,"index.asp")
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
	function checkfabucs(obj)
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

		if (obj.tyqbox.value=="1"){
			alert("请阅读说明");
			obj.tyqbox.focus();
			return false;
		}


		if (trimstr(obj.wzdz.value)==""){
			alert("请填写房源所在详细地址");
			obj.wzdz.focus();
			return false;
		}
		if (obj.csyt.value=="0"){
			alert("请选择房源类型");
			obj.csyt.focus();
			return false;
		}
		if (trimstr(obj.cssj.value)==""){
			alert("请填写售价");
			obj.cssj.focus();
			return false;
		}
		if (trimstr(obj.csmjj.value)==""){
			alert("请填写面积");
			obj.csmjj.focus();
			return false;
		}
		if (obj.yz.value==""){
			alert("请填写验证码");
			obj.yz.focus();
			return false;
		}
		return true;
	}
</script>
<table width="904" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#F3F3F3" class="table_huise">
	<form id="fabucs" name="fabucs" method="post" action="?action=addok" onsubmit="return checkfabucs(this);">
		<tr class="toptd1">
			<td height="26" colspan="4" background="../images/tit_bg2.gif">&nbsp;&nbsp;<span class="wenzi_baise12c">&#22996;&#25176;出售信息[加*为必填项]</span></td>
		</tr>
		<tr class="table_lanse_tit">
			<td height="26" colspan="4" >&nbsp;&nbsp;<span class="wenzi_heise12c">&#22996;&#25176;&#31867;&#22411;</span></td>
		</tr>
		<tr>
			<td height="26" bgcolor="#FFFFFF" >　
				<a href="">
					<input name="fyly" type="radio" value="2" checked="checked" />
				</a>
				<span class="wenzi_hongse12">&#20986;售</span></td>
				
					<td height="26" bgcolor="#FFFFFF" >
						<a href="wwdj2.asp">
						<span class="yellow12c">
						
						<input name="fyly" type="radio" value="2" />

					</span>出租</a>
					</td>
				
				<td height="26" bgcolor="#FFFFFF" >　<span class="yellow12c">
					<input name="fyly" type="radio" value="2" />
				</span>&#27714;&#36141;</td>
				<td height="26" bgcolor="#FFFFFF" ><span class="yellow12c">
					<input name="fyly" type="radio" value="2" />
				</span>求租</td>
			</tr>
			<tr class="table_lanse_tit">
				<td height="26" colspan="4" >&nbsp;&nbsp;<span class="wenzi_heise12c">联系方式</span></td>
			</tr>
			<tr class="td_gray">
				<td width="9%" height="26" align="right" bgcolor="#FFFFFF">姓&nbsp;名：</td>
				<td width="40%" height="26" bgcolor="#FFFFFF"><input name="fzxm" type="text" class="button_huise" id="fzxm" maxlength="4" />
					<span class="wenzi_hongse12">*</span></td>
					<td width="11%" height="26" align="right" bgcolor="#FFFFFF">性&nbsp;别：</td>
					<td width="40%" height="26" bgcolor="#FFFFFF"><input name="fzxb" type="radio" value="男" checked="checked" />
						男
						<input type="radio" name="fzxb" value="女" />
					女</td>
				</tr>
				<tr class="td_gray">
					<td height="26" align="right" bgcolor="#FFFFFF">手&nbsp;机：</td>
					<td height="26" bgcolor="#FFFFFF"><input name="fzsj" type="text" class="button_huise" id="fzsj" onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" maxlength="12"/>
						<span class="wenzi_hongse12"> *</span></td>
						<td height="26" align="right" bgcolor="#FFFFFF">&#39564;&#35777;&#30721;：</td>
						<td height="26" bgcolor="#FFFFFF"><input name="yz" type="text" class="search_label" id="yz" size="8" maxlength="4" />
							&nbsp;&nbsp;<img src="../flying_func/Code.asp" width="40" height="10"></td>
						</tr>
						<tr class="table_lanse_tit">
							<td height="26" colspan="4">&nbsp;&nbsp;<span class="wenzi_heise12c">房屋基本情况</span></td>
						</tr>

						<tr class="td_white">

							<td height="26" align="right" bgcolor="#FFFFFF">详细地址：</td>
							<td height="26" colspan="3" bgcolor="#FFFFFF"><input name="wzdz" type="text" width="320"  />      <span class="wenzi_hongse12">*</span><span class="yellow12c">（对外保密）</span></td>
						</tr>
						<tr class="td_gray">
							<td height="26" align="right" bgcolor="#FFFFFF">房源类型：</td>
							<td height="26" bgcolor="#FFFFFF"><select name="csyt" class="button_huise" id="csyt">
								<option value="0">请选择房源类型</option>
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
	<span class="wenzi_hongse12">*</span></td>
	<td height="26" align="right" bgcolor="#FFFFFF">户型：</td>
	<td height="26" bgcolor="#FFFFFF">
		<select name="cshxs" class="button_huise" id="cshxs">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
		</select>
		室
		<select name="cshxt" class="button_huise" id="cshxt">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
		厅
		<select name="cshxw" class="button_huise" id="cshxw">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
		卫
		<select name="cshxc" class="button_huise" id="cshxc">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
		厨
		<select name="cshxy" class="button_huise" id="cshxy">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	阳台</td>
</tr>
<tr class="td_gray">
	<td height="26" align="right" bgcolor="#FFFFFF">售价：</td>
	<td height="26" bgcolor="#FFFFFF">
		<input name="cssj" type="text" class="button_huise" id="cssj" size="8" maxlength="12" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57)&&(event.keyCode!=46)) event.returnValue = false;"/>
		万元人民币<span class="wenzi_hongse12">*</span></td>
		<td height="26" align="right" bgcolor="#FFFFFF">面积(M2)：</td>
		<td height="26" bgcolor="#FFFFFF"><input name="csmjj" type="text" class="button_huise" id="csmjj" size="8" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;"/>
			<span class="wenzi_hongse12">*</span></td>
		</tr>
		<tr class="td_gray">
			<td height="26" align="right" bgcolor="#FFFFFF">楼层：</td>
			<td height="26" bgcolor="#FFFFFF">第
				<input name="cslcj" type="text" id="cslcj" size="6"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
				层,总
				<input name="cslcz" type="text" id="cslcz" size="6"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
			层</td>
			<td height="26" align="right" bgcolor="#FFFFFF">建筑年代：</td>
			<td height="26" bgcolor="#FFFFFF">
				<select name="csnd" class="button_huise" id="csnd">
					<option value="0">请选择建筑年代</option>
					<%
					nd=year(now())
					for ndid=nd to 1980 step -1
						%>
						<option value="<%=ndid%>"><%=ndid%></option>
						<%next%>
					</select>
				年	</td>
			</tr>
			<tr class="td_gray">
				<td height="26" align="right" bgcolor="#FFFFFF">装修程度：</td>
				<td height="26" bgcolor="#FFFFFF">
					<select name="cszx" class="button_huise" id="cszx">
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
	</select></td>
	<td height="26" align="right" bgcolor="#FFFFFF">重要说明：</td>
	<td height="26" bgcolor="#FFFFFF"><select size="1" name="tyqbox">
		<option selected value="1">未阅读</option>
		<option value="2">已阅读</option>
	</select>
	<a onclick="javascript:window.open('/wts-cs.asp', 'newwindow', 'height=440, width=400, toolbar=no, menubar=no, scrollbars=auto, resizable=no, location=no, status=no')" >《房屋出售委托书》</a></td>
</tr>
<tr class="td_white">
	<td height="40" colspan="4" align="center" valign="middle" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="search_label" value="提交信息" /></td>
</tr>
</form>
</table>

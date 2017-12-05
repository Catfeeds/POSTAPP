<!--#include file="topwap.asp"-->
<!--#include file="../flying_func/md5.asp"-->
<!--#include file="../flying_func/config.asp"-->
<%
if request.QueryString("action")="addok" then
'提取表单数据
	yz=cutsql(trim(Request("yz"))) '验证码
	'if Session("Admin_GetCode")="" then
	'	call back("你登录时间过长，请重新返回登录页面进行登录。\n\n")
	'end if
	'if yz<>CStr(Session("Admin_GetCode")) then
		'call back("您输入的确认码和系统产生的不一致，请重新输入。\n\n")
	'end if
	fyly=2 '房源来源
	if fyly<>1 and fyly<>2 then call show_go("非法参数","wwdj1.asp") end if
	fzxm=cutsql(trim(request.Form("fzxm"))) '房主姓名
	fzxb=request.Form("fzxb") '房主性别
	'if fzxb<>"男" and fzxb<>"女" then call show_go("非法参数","wwdj1.asp") end if
	fzsj=request.Form("fzsj") '房主手机"
	if not isint(fzsj) then call show_go("非法参数","wwdj1.asp") end if
	fzdh1=cutsql(trim(request.Form("fzdh1"))) '房主电话
	fzdh2=cutsql(trim(request.Form("fzdh2")))
	if fzdh1<>"" then
		fzdh=fzdh1&"-"&fzdh2
	else
		fzdh=fzdh2
	end if
	fzyx=cutsql(request.Form("fzyx")) '房主电子邮箱
	wzcs=request.Form("wzcs") '房源城市
	'if (not isint(wzcs)) or wzcs<0 then call show_go("非法参数","wwdj1.asp") end if
	wzpq=request.Form("wzpq") '房源片区
	'if (not isint(wzpq)) or wzpq<0 then call show_go("非法参数","wwdj1.asp") end if
	wzxq=cutsql(trim(request.Form("wzxq"))) '房源小区
	wzxq1=cutsql(trim(request.Form("wzxq1"))) '手工房源小区
	'if wzxq="" and wzxq1=""  then call show_go("非法参数","wwdj1.asp") end if
	'if wzxq="0" then wzxq=wzxq1 end if
	wzdz=cutsql(trim(request.Form("wzdz"))) '详细地址
	if wzdz="" then call show_go("非法参数","wwdj1.asp") end if
	csyt=request.Form("csyt") '房源用途
	if (not isint(csyt)) or csyt<0 then call show_go("非法参数","wwdj1.asp") end if
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
			call show_go("发布成功\n\n牢记你的房源编号："&bh&"\n\n专业经纪人将尽快和你联系","wwdj1.asp")
		else
			call show_go("发布成功\n\n牢记你的房源编号："&bh&"\n\n专业经纪人将尽快和你联系","wwdj1.asp")
		end if
	else
		call show_go("系统中已有此房源\n\n同源编号为"&tyid,"wwdj1.asp")
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

		if (obj.tyqbox.value != "2"){
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
	//if (obj.yz.value==""){
		//alert("请填写验证码");
		//obj.yz.focus();
		//return false;
	//}
	return true;
}
</script>

		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">登记出售房源[加*为必填项]</h1>
		</header>
		<div class="mui-content">
			<div id="slider" class="mui-slider">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item" style="border-bottom:2px solid #007aff;color:#007aff;" href="wwdj1.asp">
						出售
					</a>
					<a class="mui-control-item" href="wwdj2.asp">
						出租
					</a>
					<a class="mui-control-item" href="wwdj3.asp">
						求购
					</a>
					<a class="mui-control-item" href="wwdj4.asp">
						求租
					</a>
				</div>
			</div>
			
		</div>
		<form class="mui-input-group" id="fabucs" name="fabucs" method="post" action="?action=addok" onsubmit="return checkfabucs(this);">
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
					<h5 class="mui-content-padded">房屋基本情况</h5>
					<div class="mui-card">
						<div class="mui-input-row">
							<label>详细地址：<span class="star">*</span></label>
							<input type="text" name="wzdz" id="wzdz" width="320" class="mui-input-clear" placeholder="请输入">
						</div>
						<div class="mui-input-row">
							<label>房屋类型：<span class="star">*</span></label>
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
							<label>房屋售价：<span class="star">*</span></label>
							<div style="width: 30%;float: right;height: 40px;line-height: 40px;">万元</div>
							<input placeholder="请输入" type="text" name="cssj" id="cssj" size="8" maxlength="12" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57)&&(event.keyCode!=46)) event.returnValue = false;" style="width: 30%;" class="mui-input-clear" placeholder="">
						</div>
						<div class="mui-input-row">
							<label>房屋面积：<span class="star">*</span></label>
							<div style="width: 30%;float: right;height: 40px;line-height: 40px;">平方米</div>
							<input type="text" placeholder="请输入" name="csmjj" id="csmjj" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;" style="width: 30%;" class="mui-input-clear" placeholder="">
						</div>
						<div class="mui-input-row">
							<label>房屋户型：<span class="star"></span></label>
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

						<div class="mui-input-row">
							<label>所在楼层：<span class="star"></span></label>
							<div style="width: 30%;float: right;height: 40px;line-height: 40px;">层</div>
							<input type="text" placeholder="请输入" name="cslcj" id="cslcj" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;" style="width: 28%;" class="mui-input-clear" placeholder="">
						</div>
						<!--
						<div class="mui-input-row">
							<label>总楼层：</label>
							<div style="width: 15%;float: right;height: 40px;line-height: 40px;">层</div>
							<input placeholder="请输入总楼层" name="cslcz" type="text" id="cslcz" size="6"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;" style="width: 35%;" class="mui-input-clear" placeholder="">
							<div style="width: 15%;float: right;height: 40px;line-height: 40px;">总共</div>
						</div>
						-->
						<div class="mui-input-row">
							<label>装修程度：<span class="star"></span></label>
							<select name="cszx"  id="cszx">
								<option value="0">请选择</option>
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
							</div>
						<!--
						<div class="mui-input-row">
							<label>建筑年代：</label>
							<select name="csnd"  id="csnd">
								<option value="0">请选择建筑年代</option>
								<%
								nd=year(now())
								for ndid=nd to 1980 step -1
									%>
									<option value="<%=ndid%>"><%=ndid%></option>
									<%next%>
							</select>
						</div>
						-->
						<div class="mui-input-row mui-checkbox">
							<label style="padding-right:0;width:35%;">委 托 书：<span class="star">*</span></label>
							<div style="width: 40%;float: right;height: 40px;line-height: 40px;font-size: 12px"><a onclick="javascript:window.open('/wts-cs.asp', 'newwindow', 'height=440, width=400, toolbar=no, menubar=no, scrollbars=auto, resizable=no, location=no, status=no')" >《房屋出售委托书》</a></div>
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

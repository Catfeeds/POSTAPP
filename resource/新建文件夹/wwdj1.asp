<!--#include file="topwap.asp"-->
<!--#include file="../flying_func/md5.asp"-->
<!--#include file="../flying_func/config.asp"-->
<%
if request.QueryString("action")="addok" then
'��ȡ������
	yz=cutsql(trim(Request("yz"))) '��֤��
	'if Session("Admin_GetCode")="" then
	'	call back("���¼ʱ������������·��ص�¼ҳ����е�¼��\n\n")
	'end if
	'if yz<>CStr(Session("Admin_GetCode")) then
		'call back("�������ȷ�����ϵͳ�����Ĳ�һ�£����������롣\n\n")
	'end if
	fyly=2 '��Դ��Դ
	if fyly<>1 and fyly<>2 then call show_go("�Ƿ�����","wwdj1.asp") end if
	fzxm=cutsql(trim(request.Form("fzxm"))) '��������
	fzxb=request.Form("fzxb") '�����Ա�
	'if fzxb<>"��" and fzxb<>"Ů" then call show_go("�Ƿ�����","wwdj1.asp") end if
	fzsj=request.Form("fzsj") '�����ֻ�"
	if not isint(fzsj) then call show_go("�Ƿ�����","wwdj1.asp") end if
	fzdh1=cutsql(trim(request.Form("fzdh1"))) '�����绰
	fzdh2=cutsql(trim(request.Form("fzdh2")))
	if fzdh1<>"" then
		fzdh=fzdh1&"-"&fzdh2
	else
		fzdh=fzdh2
	end if
	fzyx=cutsql(request.Form("fzyx")) '������������
	wzcs=request.Form("wzcs") '��Դ����
	'if (not isint(wzcs)) or wzcs<0 then call show_go("�Ƿ�����","wwdj1.asp") end if
	wzpq=request.Form("wzpq") '��ԴƬ��
	'if (not isint(wzpq)) or wzpq<0 then call show_go("�Ƿ�����","wwdj1.asp") end if
	wzxq=cutsql(trim(request.Form("wzxq"))) '��ԴС��
	wzxq1=cutsql(trim(request.Form("wzxq1"))) '�ֹ���ԴС��
	'if wzxq="" and wzxq1=""  then call show_go("�Ƿ�����","wwdj1.asp") end if
	'if wzxq="0" then wzxq=wzxq1 end if
	wzdz=cutsql(trim(request.Form("wzdz"))) '��ϸ��ַ
	if wzdz="" then call show_go("�Ƿ�����","wwdj1.asp") end if
	csyt=request.Form("csyt") '��Դ��;
	if (not isint(csyt)) or csyt<0 then call show_go("�Ƿ�����","wwdj1.asp") end if
	cshxt=cutsql(trim(request.Form("cshxt")))
	cshxs=cutsql(trim(request.Form("cshxs")))
	cshxw=cutsql(trim(request.Form("cshxw")))
	cshxy=cutsql(trim(request.Form("cshxy")))
	cshxc=cutsql(trim(request.Form("cshxc")))
	cssj=cutsql(trim(request.Form("cssj"))) '�ۼ�
	csmjj=cutsql(trim(request.Form("csmjj"))) '���
	cslcz=cutsql(trim(request.Form("cslcz"))) '¥��
	cslcj=cutsql(trim(request.Form("cslcj"))) 
	csnd=cutsql(trim(request.Form("csnd"))) '�������
	csqs=cutsql(trim(request.Form("csqs"))) 'Ȩ��
	cszx=cutsql(trim(request.Form("cszx"))) 'װ�޳̶�
	csjg=cutsql(trim(request.Form("csjg"))) '�����ṹ
	cspt=cutsql(trim(request.Form("cspt"))) '������ʩ
	csbz=left(cutsql(trim(request.Form("csbz"))),200) '��ע��Ϣ
	ditux=request.Form("ezmarker.x")
	dituy=request.Form("ezmarker.y")
	dituz=request.Form("ezmarker.z")
'д�����ݿ�	
	'�ж��Ƿ���ͬ��Դ
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
	if tynum=0 then 'û��ͬԴ
		set rs=server.CreateObject("adodb.recordset")
		sql="select top 1 * from housexx_cs"
		rs.open sql,conn,1,3
		rs.addnew
		rs("fzxm")=fzxm '�����������ַ���,*
		rs("fzsj")=fzsj	'�����ֻ����ַ���,*
		rs("fzdh")=fzdh	'�����绰���ַ���
		rs("fzyx")=fzyx	'�������ʣ��ַ���
		rs("fzxb")=fzxb '�����Ա��ַ���
		rs("sjfb")=now()	'����ʱ�䣬������
		rs("sjyxq")=90 '��Ч�ڣ���ֵ��
		if fyly=2  then
			if grsh="false" then '����������
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
		rs("wzcs")=cint(wzcs)   '����id����ֵ��,*
		rs("wzpq")=cint(wzpq)   'Ƭ��id����ֵ��,*
		rs("wzxq")=wzxq   'С�����ƣ��ַ���,*
		rs("wzdz")=wzdz	'��ϸ��ַ���ַ���,*
		rs("csyt")=cint(csyt) 	'��Դ��;id����ֵ��
		rs("cshxs")=cint(cshxs)  '���ͼ��ң���ֵ��
		rs("cshxt")=cint(cshxt)   '���ͼ�������ֵ��
		rs("cshxw")=cint(cshxw)  '���ͼ�������ֵ��
		rs("cshxy")=cint(cshxy)   '���ͼ���̨����ֵ��
		rs("cshxc")=cint(cshxc)   '���ͼ���̨����ֵ��
		rs("cslcz")=cint(cslcz)  '�ܼ��㣬��ֵ��
		rs("cslcj")=cint(cslcj)   '�ڼ��㣬��ֵ��
		rs("csmjj")=cdbl(csmjj)   '�����������ֵ��,*
		rs("cssj")=cdbl(cssj)    '�ۼۣ���ֵ��,*
		rs("csnd")=cint(csnd)    '�����������ֵ��
		rs("csqs")=cint(csqs)    'Ȩ������ֵ��
		rs("cszx")=cint(cszx)	 'װ�޳̶ȣ���ֵ��
		rs("csjg")=cint(csjg) 	 '�����ṹ����ֵ��
		rs("cspt")=cspt	 '������ʩ���ַ���
		rs("csbz")=csbz    '��ɫ���ܣ���ע��
		rs("fyly")=fyly  '��Դ��Դ����ֵ��
		if tynum<>0 then rs("tyid")=tyid end if 'ͬԴ��Դ
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
			call show_go("�����ɹ�\n\n�μ���ķ�Դ��ţ�"&bh&"\n\nרҵ�����˽����������ϵ","wwdj1.asp")
		else
			call show_go("�����ɹ�\n\n�μ���ķ�Դ��ţ�"&bh&"\n\nרҵ�����˽����������ϵ","wwdj1.asp")
		end if
	else
		call show_go("ϵͳ�����д˷�Դ\n\nͬԴ���Ϊ"&tyid,"wwdj1.asp")
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
		alert("����д����");
		obj.fzxm.focus();
		return false;
	}
	if (obj.fzsj.value==""){
		alert("����д�ֻ�");
		obj.fzsj.focus();
		return false;
	}

		if (obj.tyqbox.value != "2"){
		alert("���Ķ�˵��");
		obj.tyqbox.focus();
		return false;
	}


	if (trimstr(obj.wzdz.value)==""){
		alert("����д��Դ������ϸ��ַ");
		obj.wzdz.focus();
		return false;
	}
	if (obj.csyt.value=="0"){
		alert("��ѡ��Դ����");
		obj.csyt.focus();
		return false;
	}
	if (trimstr(obj.cssj.value)==""){
		alert("����д�ۼ�");
		obj.cssj.focus();
		return false;
	}
	if (trimstr(obj.csmjj.value)==""){
		alert("����д���");
		obj.csmjj.focus();
		return false;
	}
	//if (obj.yz.value==""){
		//alert("����д��֤��");
		//obj.yz.focus();
		//return false;
	//}
	return true;
}
</script>

		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">�Ǽǳ��۷�Դ[��*Ϊ������]</h1>
		</header>
		<div class="mui-content">
			<div id="slider" class="mui-slider">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item" style="border-bottom:2px solid #007aff;color:#007aff;" href="wwdj1.asp">
						����
					</a>
					<a class="mui-control-item" href="wwdj2.asp">
						����
					</a>
					<a class="mui-control-item" href="wwdj3.asp">
						��
					</a>
					<a class="mui-control-item" href="wwdj4.asp">
						����
					</a>
				</div>
			</div>
			
		</div>
		<form class="mui-input-group" id="fabucs" name="fabucs" method="post" action="?action=addok" onsubmit="return checkfabucs(this);">
				<input name="fyly" type="hidden" value="2" />
				<div class="mui-content-padded" style="margin: 5px;margin-top:-10px;">
					<h5 class="mui-content-padded">��ϵ��ʽ</h5>
					<div class="mui-card">
						<div class="mui-input-row">
							<label>����������<span class="star">*</span></label>
							<input type="text" name="fzxm" id="fzxm" maxlength="4" class="mui-input-clear" placeholder="������">
						</div>
						<div class="mui-input-row">
							<label>�����ֻ���<span class="star">*</span></label>
							<input type="text" name="fzsj" id="fzsj" onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" maxlength="12" class="mui-input-clear" placeholder="������">
						</div>
						<!--<div class="mui-input-row mui-radio">
							<label style="padding: 11px 15px;width: 35%;">�Ա�</label>

							<input name="fzxb" style="position: initial;float: initial;" value="��" checked="checked" type="radio">��
							<input name="fzxb" style="position: initial;float: initial;" value="Ů" type="radio" checked>Ů
						</div>
						
						<div class="mui-input-row">
							<label>��֤�룺</label>
							<div style="width: 30%;float: right;height: 40px;"><img src="../flying_func/Code.asp" width="60" height="30"></div>
							<input type="text" name="yz" id="yz" size="8" maxlength="4" style="width: 35%;" class="mui-input-clear" placeholder="">
						</div>-->
					</div>
				</div>

				<div class="mui-content-padded" style="margin: 5px;">
					<h5 class="mui-content-padded">���ݻ������</h5>
					<div class="mui-card">
						<div class="mui-input-row">
							<label>��ϸ��ַ��<span class="star">*</span></label>
							<input type="text" name="wzdz" id="wzdz" width="320" class="mui-input-clear" placeholder="������">
						</div>
						<div class="mui-input-row">
							<label>�������ͣ�<span class="star">*</span></label>
							<select name="csyt" id="csyt">
								<option value="0">��ѡ��</option>
														<%
								'����Դ���ͼ�¼
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
							<label>�����ۼۣ�<span class="star">*</span></label>
							<div style="width: 30%;float: right;height: 40px;line-height: 40px;">��Ԫ</div>
							<input placeholder="������" type="text" name="cssj" id="cssj" size="8" maxlength="12" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57)&&(event.keyCode!=46)) event.returnValue = false;" style="width: 30%;" class="mui-input-clear" placeholder="">
						</div>
						<div class="mui-input-row">
							<label>���������<span class="star">*</span></label>
							<div style="width: 30%;float: right;height: 40px;line-height: 40px;">ƽ����</div>
							<input type="text" placeholder="������" name="csmjj" id="csmjj" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;" style="width: 30%;" class="mui-input-clear" placeholder="">
						</div>
						<div class="mui-input-row">
							<label>���ݻ��ͣ�<span class="star"></span></label>
							<select name="cshxs" id="cshxs" style="width: 20%;float: left;">
								<option value="0">��ѡ��</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
							<div style="width: 17%;float: left;height: 40px;line-height: 40px;">��</div>
							<!--
							<select name="cshxt" id="cshxt" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">��</div>

							<select name="cshxw" id="cshxw" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">��</div>

							<select name="cshxc" id="cshxc" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">��</div>

							<select name="cshxy" id="cshxy" style="width: 7%;float: left;">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<div style="width: 7%;float: left;height: 40px;line-height: 40px;">��̨</div>
							-->
						</div>

						<div class="mui-input-row">
							<label>����¥�㣺<span class="star"></span></label>
							<div style="width: 30%;float: right;height: 40px;line-height: 40px;">��</div>
							<input type="text" placeholder="������" name="cslcj" id="cslcj" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;" style="width: 28%;" class="mui-input-clear" placeholder="">
						</div>
						<!--
						<div class="mui-input-row">
							<label>��¥�㣺</label>
							<div style="width: 15%;float: right;height: 40px;line-height: 40px;">��</div>
							<input placeholder="��������¥��" name="cslcz" type="text" id="cslcz" size="6"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;" style="width: 35%;" class="mui-input-clear" placeholder="">
							<div style="width: 15%;float: right;height: 40px;line-height: 40px;">�ܹ�</div>
						</div>
						-->
						<div class="mui-input-row">
							<label>װ�޳̶ȣ�<span class="star"></span></label>
							<select name="cszx"  id="cszx">
								<option value="0">��ѡ��</option>
											<%
								'��װ�޳̶ȼ�¼
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
							<label>���������</label>
							<select name="csnd"  id="csnd">
								<option value="0">��ѡ�������</option>
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
							<label style="padding-right:0;width:35%;">ί �� �飺<span class="star">*</span></label>
							<div style="width: 40%;float: right;height: 40px;line-height: 40px;font-size: 12px"><a onclick="javascript:window.open('/wts-cs.asp', 'newwindow', 'height=440, width=400, toolbar=no, menubar=no, scrollbars=auto, resizable=no, location=no, status=no')" >�����ݳ���ί���顷</a></div>
							<!--<select size="1" name="tyqbox" style="width: 25%;">
								<option value="1">δ�Ķ�</option>
								<option tyqbox value="2" >���Ķ�</option>
							</select>-->
							<div  style="float: right;height: 40px;line-height: 40px;font-size: 12px">���Ķ�</div>
							<input name="tyqbox" value="1" type="checkbox" style="right:initial;">
						</div>
						
					</div>

					<input name="Submit" style="background: #007aff;margin-top: 20px;width: 40%;margin-left: 30%;" type="submit" value="�ύ��Ϣ">
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

<!--#include file="topwap.asp"-->
<!--#include file="../flying_func/md5.asp"-->
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
	fzxm=cutsql(trim(request.Form("fzxm"))) '��������
	if fzxm="" then call show_go("�Ƿ�����","wwdj3.asp") end if
	fzsj=request.Form("fzsj") '�����ֻ�"
	if not isint(fzsj) then call show_go("�Ƿ�����","wwdj3.asp") end if

	
	wzcs=request.Form("wzcs") '��Դ����
	wzpq=request.Form("wzpq") '��ԴƬ��
	wzpqa=request.Form("wzpqa") '��ԴƬ��
	wzxq=cutsql(trim(request.Form("wzxq"))) '��ԴС��
	wzxq1=cutsql(trim(request.Form("wzxq1"))) '�ֹ���ԴС��
	if wzxq="0" then wzxq=wzxq1 end if
	csyt=request.Form("csyt") '��Դ��;
	if (not isint(csyt)) or csyt<0 then call show_go("�Ƿ�����","wwdj3.asp") end if
	cshxt=cutsql(trim(request.Form("cshxt")))  '��Դ����
	cshxs=cutsql(trim(request.Form("cshxs")))
	cshxw=cutsql(trim(request.Form("cshxw")))
	cshxy=cutsql(trim(request.Form("cshxy")))
	cshxc=cutsql(trim(request.Form("cshxc")))
	cssj1=cutsql(trim(request.Form("cssj1"))) '�󹺼�
	cssj2=cutsql(trim(request.Form("cssj2"))) '�󹺼�
	csmj1=cutsql(trim(request.Form("csmj1"))) '�����
	csmj2=cutsql(trim(request.Form("csmj2"))) '�����
	cslc1=cutsql(trim(request.Form("cslc1"))) '¥��
	cslc2=cutsql(trim(request.Form("cslc2"))) 
	csnd=cutsql(trim(request.Form("csnd"))) '�������
	csqs=cutsql(trim(request.Form("csqs"))) 'Ȩ��
	cszx=cutsql(trim(request.Form("cszx"))) 'װ�޳̶�
	csbz=left(cutsql(trim(request.Form("csbz"))),200) '��ע��Ϣ
'д�����ݿ�	
	'�ж��Ƿ���ͬ��Դ
	set tyrs=server.CreateObject("adodb.recordset")
	tysql="select * from housexx_qg where fzxm='"&fzxm&"' and fzsj='"&fzsj&"' and csmj1="&csmj1&" and csmj2="&csmj2&" and cssj1="&cssj1&" and cssj2="&cssj2&" and wzcs="&wzcs&" and wzpq="&wzpq
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
	sql="select top 1 * from housexx_qg"
	rs.open sql,conn,1,3
	rs.addnew
	rs("fzxm")=fzxm '�����������ַ���,*
	rs("fzsj")=fzsj	'�����ֻ����ַ���,*
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
	rs("wzpqa")=cint(wzpqa)   'Ƭ��id����ֵ��,*
	rs("wzxq")=wzxq   'С�����ƣ��ַ���,*
	rs("csyt")=cint(csyt) 	'��Դ��;id����ֵ��
	rs("cshxs")=cint(cshxs)  '���ͼ��ң���ֵ��
	rs("cshxt")=cint(cshxt)   '���ͼ�������ֵ��
	rs("cshxw")=cint(cshxw)  '���ͼ�������ֵ��
	rs("cshxy")=cint(cshxy)   '���ͼ���̨����ֵ��
	rs("cshxc")=cint(cshxc)   '���ͼ���̨����ֵ��
	rs("cslc1")=cint(cslc1)  '¥�㣬��ֵ��
	rs("cslc2")=cint(cslc2)   '¥�㣬��ֵ��
	rs("csmj1")=cdbl(csmj1)   '���������ֵ��,*
	rs("csmj2")=cdbl(csmj2)   '���������ֵ��,*
	rs("cssj1")=cdbl(cssj1)    '�󹺼ۣ���ֵ��,*
	rs("cssj2")=cdbl(cssj2)    '�󹺼ۣ���ֵ��,*
	rs("csnd")=cint(csnd)    '�����������ֵ��
	rs("csqs")=cint(csqs)    'Ȩ������ֵ��
	rs("cszx")=cint(cszx)	 'װ�޳̶ȣ���ֵ��
	rs("csbz")=csbz    '��ɫ���ܣ���ע��
	rs("fyly")=fyly  '��Դ��Դ����ֵ��
	if tynum<>0 then rs("tyid")=tyid end if 'ͬԴ��Դ
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
		call show_go("�����ɹ�\n\n�μ���ķ�Դ��ţ�"&bh&"\n\nרҵ�����˽����������ϵ","wwdj3.asp")
	else
		call show_go("�����ɹ�\n\n�μ���ķ�Դ��ţ�"&bh&"\n\nרҵ�����˽����������ϵ","wwdj3.asp")
	end if
	else
		call show_go("ϵͳ�����д˷�Դ\n\nͬԴ���Ϊ"&tyid,"wwdj3.asp")
	end if
end if
%>
<script language="javascript">
function checkfabuqg(obj)
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
	if (obj.wzcs.value=="0"){
		alert("��ѡ��Դ���ڳ���");
		obj.wzcs.focus();
		return false;
	}
	//if (trimstr(obj.cssj1.value)==""){
	//	alert("����д����󹺼۸�");
	//	obj.cssj1.focus();
	//	return false;
	//}
	
		if (obj.tyqbox.value=="1"){
		alert("���Ķ�˵��");
		obj.tyqbox.focus();
		return false;
	}
	//if (trimstr(obj.cssj2.value)==""){
	//	alert("����д����󹺼۸�");
	//	obj.cssj2.focus();
	//	return false;
	//}
	//if (parseFloat(trimstr(obj.cssj1.value))>parseFloat(trimstr(obj.cssj2.value))){
	//	alert("��ӵ͵�����д�󹺼۸�");
	//	obj.cssj1.focus();
	//	return false;
	//}
	//if (trimstr(obj.csmj1.value)==""){
	//	alert("����д��������");
	//	obj.csmj1.focus();
	//	return false;
	//}
	//if (trimstr(obj.csmj2.value)==""){
	//	alert("����д��������");
	//	obj.csmj2.focus();
	//	return false;
	//}
	//if (parseFloat(trimstr(obj.csmj1.value))>parseFloat(trimstr(obj.csmj2.value))){
	//	alert("��ӵ͵�����д���");
	//	obj.csmj1.focus();
	//	return false;
	//}
	if (obj.csyt.value=="0"){
		alert("��ѡ��Դ����");
		obj.csyt.focus();
		return false;
	}
	//if (obj.yz.value==""){
	//	alert("����д��֤��");
	//	obj.yz.focus();
	//	return false;
	//}
	return true;
}
</script>
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">�Ǽǹ�����Ϣ[��*Ϊ������]</h1>
		</header>
		<div class="mui-content">
			<div id="slider" class="mui-slider">
				<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
					<a class="mui-control-item" href="wwdj1.asp">
						����
					</a>
					<a class="mui-control-item" href="wwdj2.asp">
						����
					</a>
					<a class="mui-control-item" style="border-bottom:2px solid #007aff;color:#007aff;" href="wwdj3.asp">
						��
					</a>
					<a class="mui-control-item" href="wwdj4.asp">
						����
					</a>
				</div>
			</div>
		</div>

			<form class="mui-input-group" id="fabucs" name="fabucs" method="post" action="?action=addok" onsubmit="return checkfabuqg(this);">
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
					<h5 class="mui-content-padded">����Ҫ��</h5>
					<div class="mui-card">
						<div class="mui-input-row">
							<label>Ԥ�����У�<span class="star"></span></label>
							<select name="wzcs" id="wzcs"  onChange="changepq(document.fabuqg.wzpq,document.fabuqg.wzcs.options[document.fabuqg.wzcs.selectedIndex].value)">
								<option value="2">������</option>
								
								<%
								for i=0 to csnum-1
										response.Write "<option value='" & trim(csarr(0,i)) & "'>" & trim(csarr(1,i)) & "</option>"
								next
								%>
							</select>
						</div>
						<div class="mui-input-row">
							<label style="width:38%">Ԥ��Ƭ����</label>
							<select style="width:27%;float:left;" name="wzpq" id="wzpq" onChange="changexq(document.fabuqg.wzxq,document.fabuqg.wzpq.options[document.fabuqg.wzpq.selectedIndex].value)">
								<option value="0">��ѡ��</option>
                                <option value="0">Ƭ������</option>
								<option value="3">����Ƭ��</option>
								<option value="4">�Ƕ�Ƭ��</option>
								<option value="5">�Ǳ�Ƭ��</option>
								<option value="6">����Ƭ��</option>
								<option value="7">����Ƭ��</option>
								<option value="8">�Ӷ�����</option>
								<option value="9">��������</option>
								<option value="11">��Ϫ��</option>
							</select>
							<div style="width:7%;float:left;height:40px;line-height:40px;">��</div>
						
							<select style="width:28%;float:left;" name="wzpqa" id="wzpqa" onChange="changexq(document.fabuqg.wzxqa,document.fabuqg.wzpqa.options[document.fabuqg.wzpqa.selectedIndex].value)">
								<option value="0">��ѡ��</option>
                                <option value="0">Ƭ������</option>
								<option value="3">����Ƭ��</option>
								<option value="4">�Ƕ�Ƭ��</option>
								<option value="5">�Ǳ�Ƭ��</option>
								<option value="6">����Ƭ��</option>
								<option value="7">����Ƭ��</option>
								<option value="8">�Ӷ�����</option>
								<option value="9">��������</option>
								<option value="11">��Ϫ��</option>
							</select>
						</div>

						<!--<div class="mui-input-row">
							<label>С����</label>
							<select style="width:55%;float:left;" name="wzxq" id="wzxq">
							  <option value="0">С������</option>
							</select>
							<div style="width:10%;float:left;height:40px;line-height:40px;">��</div>
						</div>
						<div class="mui-input-row">
							<input type="text" name="wzxq1" id="wzxq1" class="mui-input-clear" placeholder="�ֶ�����С������">
						</div>
						
						<div class="mui-input-row">
							<label>�۸�<span class="star">*</span>��</label>
							<div style="width:7%;height:40px;line-height:40px;float:left;">��</div>
							<input name="cssj1" style="width:19%;float:left;" type="text" id="cssj1" size="8" maxlength="12" onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57)&amp;&amp;(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:7%;height:40px;line-height:40px;float:left;">��</div>
							<input name="cssj2" style="width:19%;float:left;" type="text" id="cssj2" size="8" maxlength="12" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57)&&(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:12%;height:40px;line-height:40px;float:left;">��Ԫ</div>
						</div>
						
						<div class="mui-input-row">
							<label>���<span class="star">*</span>��</label>
							<div style="width:7%;height:40px;line-height:40px;float:left;">��</div>
							<input name="csmj1" type="text" style="width:19%;float:left;" id="csmj1" size="8" maxlength="16" onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )&amp;&amp;(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:7%;height:40px;line-height:40px;float:left;">��</div>
							<input name="csmj2" type="text" style="width:19%;float:left;" id="csmj2" size="8" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;"/>
							<div style="width:12%;height:40px;line-height:40px;float:left;">ƽ��</div>
						</div>
						
						<div class="mui-input-row">
							<label>¥�㣺</label>
							<div style="width:8%;height:40px;line-height:40px;float:left;">��</div>
							<input name="cslc1" type="text" id="cslc1" size="6" style="width:20%;float:left;"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
							<div style="width:8%;height:40px;line-height:40px;float:left;">��</div>
							<input name="cslc2" type="text" id="cslc2" size="6" style="width:20%;float:left;"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
							<div style="width:8%;height:40px;line-height:40px;float:left;">��</div>
						</div>-->
						
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
							<label>�����ͣ�</label>
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
							
						</div>
						
						<div class="mui-input-row">
							<label>װ�޳̶ȣ�</label>
							<select name="cszx"  id="cszx">
								<option value="0">��ѡ��װ�޳̶�</option>
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
						
						<div class="mui-input-row">
							<label>Ȩ����</label>
							<select name="csqs" class="button_huise" id="csqs">
								<option value="0">��ѡ��Ȩ��</option>
								<%
									'��Ȩ����¼
									set qsrs=server.CreateObject("adodb.recordset")
									qssql="select * from housecs_qs order by xh"
									qsrs.open qssql,conn,1,1
									while not qsrs.eof
										response.Write("<option value="""&qsrs("id")&""">"&qsrs("qs")&"</option>")
										qsrs.movenext
									wend
									qsrs.close
									set qsrs=nothing
								%>
									</select>-->
						</div>
						
						<div class="mui-input-row" style="height:125px;">
							<label>����Ҫ��</label>
							<textarea id="textarea" rows="5" name="csbz" placeholder="����д"></textarea>
						</div>

						<div class="mui-input-row  mui-checkbox">
							<label style="padding-right:0;width:35%;">ί �� �飺</label>
							<div style="width: 40%;float: right;height: 40px;line-height: 40px;font-size: 12px"><a onclick="javascript:window.open('/wts-qg.asp', 'newwindow', 'height=440, width=400, toolbar=no, menubar=no, scrollbars=auto, resizable=no, location=no, status=no')" >��������ί���顷</a></div>
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
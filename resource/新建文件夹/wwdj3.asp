<!--#include file="top.asp"-->
<!--#include file="flying_func/md5.asp"-->
<%
if request.QueryString("action")="addok" then
'��ȡ������
	yz=cutsql(trim(Request("yz"))) '��֤��
	if Session("Admin_GetCode")="" then
		call back("���¼ʱ������������·��ص�¼ҳ����е�¼��\n\n")
	end if
	if yz<>CStr(Session("Admin_GetCode")) then
		call back("�������ȷ�����ϵͳ�����Ĳ�һ�£����������롣\n\n")
	end if
	fyly=request.Form("fyly") '��Դ��Դ
	if fyly<>1 and fyly<>2 then call show_go("�Ƿ�����","index.asp") end if
	fzxm=cutsql(trim(request.Form("fzxm"))) '��������
	fzxb=request.Form("fzxb") '�����Ա�
	if fzxb<>"��" and fzxb<>"Ů" then call show_go("�Ƿ�����","index.asp") end if
	fzsj=request.Form("fzsj") '�����ֻ�"
	if not isint(fzsj) then call show_go("�Ƿ�����","index.asp") end if
	fzdh1=cutsql(trim(request.Form("fzdh1"))) '�����绰
	fzdh2=cutsql(trim(request.Form("fzdh2")))
	if fzdh1<>"" then
		fzdh=fzdh1&"-"&fzdh2
	else
		fzdh=fzdh2
	end if
	fzyx=cutsql(request.Form("fzyx")) '������������
	
	wzcs=request.Form("wzcs") '��Դ����
	if (not isint(wzcs)) or wzcs<0 then call show_go("�Ƿ�����","index.asp") end if
	wzpq=request.Form("wzpq") '��ԴƬ��
	if not isint(wzpq) then call show_go("�Ƿ�����","index.asp") end if
	wzxq=cutsql(trim(request.Form("wzxq"))) '��ԴС��
	wzxq1=cutsql(trim(request.Form("wzxq1"))) '�ֹ���ԴС��
	if wzxq="0" then wzxq=wzxq1 end if
	csyt=request.Form("csyt") '��Դ��;
	if (not isint(csyt)) or csyt<0 then call show_go("�Ƿ�����","index.asp") end if
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
		call show_go("�����ɹ�\n\n�μ���ķ�Դ��ţ�"&bh&"\n\nרҵ�����˽����������ϵ","index.asp")
	else
		call show_go("�����ɹ�\n\n�μ���ķ�Դ��ţ�"&bh&"\n\nרҵ�����˽����������ϵ","index.asp")
	end if
	else
		call show_go("ϵͳ�����д˷�Դ\n\nͬԴ���Ϊ"&tyid,"index.asp")
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
	if (trimstr(obj.cssj1.value)==""){
		alert("����д����󹺼۸�");
		obj.cssj1.focus();
		return false;
	}
	
		if (obj.tyqbox.value=="1"){
		alert("���Ķ�˵��");
		obj.tyqbox.focus();
		return false;
	}
	if (trimstr(obj.cssj2.value)==""){
		alert("����д����󹺼۸�");
		obj.cssj2.focus();
		return false;
	}
	if (parseFloat(trimstr(obj.cssj1.value))>parseFloat(trimstr(obj.cssj2.value))){
		alert("��ӵ͵�����д�󹺼۸�");
		obj.cssj1.focus();
		return false;
	}
	if (trimstr(obj.csmj1.value)==""){
		alert("����д��������");
		obj.csmj1.focus();
		return false;
	}
	if (trimstr(obj.csmj2.value)==""){
		alert("����д��������");
		obj.csmj2.focus();
		return false;
	}
	if (parseFloat(trimstr(obj.csmj1.value))>parseFloat(trimstr(obj.csmj2.value))){
		alert("��ӵ͵�����д���");
		obj.csmj1.focus();
		return false;
	}
	if (obj.csyt.value=="0"){
		alert("��ѡ��Դ����");
		obj.csyt.focus();
		return false;
	}
	if (obj.yz.value==""){
		alert("����д��֤��");
		obj.yz.focus();
		return false;
	}
	return true;
}
</script>
<table width="904" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#F3F3F3" class="table_huise">
<form id="fabuqg" name="fabuqg" method="post" action="?action=addok" onsubmit="return checkfabuqg(this);">
  <tr class="toptd1">
    <td height="26" colspan="4" background="images/tit_bg2.gif">&nbsp;&nbsp;<span class="wenzi_baise12c">��������Ϣ[��*Ϊ������]</span></td>
    </tr>
  <tr class="table_lanse_tit">
    <td height="26" colspan="4" >&nbsp;&nbsp;&#22996;&#25176;&#31867;&#22411;</td>
  </tr>
  <tr>
    <td height="26" bgcolor="#FFFFFF" >��<span class="yellow12c">
      <input name="fyly" type="radio" value="2" />
    </span>&#20986;&#21806;</td>
    <td height="26" bgcolor="#FFFFFF" ><span class="yellow12c">
      <input name="fyly" type="radio" value="2" />
    </span>&#20986;&#31199;</td>
    <td height="26" bgcolor="#FFFFFF" >��
      <input name="fyly" type="radio" value="2" checked="checked" />
      <span class="wenzi_hongse12">&#27714;&#36141;</span></td>
    <td height="26" bgcolor="#FFFFFF" ><span class="yellow12c">
      <input name="fyly" type="radio" value="2" />
    </span><span class="wenzi_hongse12">&#27714;&#31199;</span></td>
  </tr>
  <tr class="table_lanse_tit">
    <td height="26" colspan="4" >&nbsp;&nbsp;<span class="wenzi_heise12c">��ϵ��ʽ</span></td>
  </tr>
  <tr class="td_gray">
    <td width="9%" height="26" align="right" bgcolor="#FFFFFF">����������</td>
    <td width="40%" height="26" bgcolor="#FFFFFF"><input name="fzxm" type="text" class="button_huise" id="fzxm" maxlength="4" />
      <span class="wenzi_hongse12">*</span></td>
    <td width="11%" height="26" align="right" bgcolor="#FFFFFF">�����Ա�</td>
    <td width="40%" height="26" bgcolor="#FFFFFF"><input name="fzxb" type="radio" value="��" checked="checked" />
      ��
        <input type="radio" name="fzxb" value="Ů" />
    Ů</td>
  </tr>
  <tr class="td_gray">
    <td height="26" align="right" bgcolor="#FFFFFF">��&nbsp;����</td>
    <td height="26" bgcolor="#FFFFFF"><input name="fzsj" type="text" class="button_huise" id="fzsj" onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" maxlength="12"/>
      <span class="wenzi_hongse12"> *</span></td>
    <td height="26" align="right" bgcolor="#FFFFFF">&#39564;&#35777;&#30721;��</td>
    <td height="26" bgcolor="#FFFFFF"><input name="yz" type="text" class="search_label" id="yz" size="8" maxlength="4" />
&nbsp;&nbsp;<img src="flying_func/Code.asp" width="40" height="10"></td>
  </tr>
  <tr class="table_lanse_tit">
    <td height="26" colspan="4">&nbsp;&nbsp;<span class="wenzi_heise12c">���ݻ������</span></td>
  </tr>
  <tr class="td_white">
    <td height="26" align="right" bgcolor="#FFFFFF">Ԥ�����У�</td>
	<td height="26" bgcolor="#FFFFFF"><select name="wzcs" class="button_huise" id="wzcs"  onChange="changepq(document.fabuqg.wzpq,document.fabuqg.wzcs.options[document.fabuqg.wzcs.selectedIndex].value)">
	<option value="0">��ѡ�����</option>
	<%
	for i=0 to csnum-1
			response.Write "<option value='" & trim(csarr(0,i)) & "'>" & trim(csarr(1,i)) & "</option>"
	next
	%>
    </select>
	  <span class="wenzi_hongse12">*</span> </td>
    <td height="26" align="right" bgcolor="#FFFFFF">Ԥ��Ƭ����</td>
    <td height="26" bgcolor="#FFFFFF"><select name="wzpq" class="button_huise" id="wzpq" onChange="changexq(document.fabuqg.wzxq,document.fabuqg.wzpq.options[document.fabuqg.wzpq.selectedIndex].value)">
      <option value="0">Ƭ������</option>
        </select></td>
  </tr>
<tr class="td_gray">
    <td height="26" align="right" bgcolor="#FFFFFF">Ԥ���۸�</td>
    <td height="26" bgcolor="#FFFFFF">��
      <input name="cssj1" type="text" class="button_huise" id="cssj1" size="8" maxlength="12" onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57)&amp;&amp;(event.keyCode!=46)) event.returnValue = false;"/>
       ��
        <input name="cssj2" type="text" class="button_huise" id="cssj2" size="8" maxlength="12" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57)&&(event.keyCode!=46)) event.returnValue = false;"/>
��Ԫ<span class="wenzi_hongse12">*</span></td>
    <td height="26" align="right" bgcolor="#FFFFFF">Ԥ�������</td>
    <td height="26" bgcolor="#FFFFFF">��
      <input name="csmj1" type="text" class="button_huise" id="csmj1" size="8" maxlength="16" onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )&amp;&amp;(event.keyCode!=46)) event.returnValue = false;"/>
    ��
    <input name="csmj2" type="text" class="button_huise" id="csmj2" size="8" maxlength="16" onKeyPress="if ((event.keyCode < 48 || event.keyCode > 57 )&&(event.keyCode!=46)) event.returnValue = false;"/>
      ƽ��<span class="wenzi_hongse12">*</span></td>
  </tr>
    <tr class="td_white">
    <td height="26" align="right" bgcolor="#FFFFFF">��Դ���ͣ�</td>
    <td height="26" bgcolor="#FFFFFF"><select name="csyt" class="button_huise" id="csyt">
      <option value="0">��ѡ��Դ����</option>
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
    <span class="wenzi_hongse12">*</span></td>
    <td height="26" align="right" bgcolor="#FFFFFF" class="td_gray">���ͣ�</td>
    <td height="26" bgcolor="#FFFFFF" class="td_gray">
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
��
  <select name="cshxt" class="button_huise" id="cshxt">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
��
  <select name="cshxw" class="button_huise" id="cshxw">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
��
  <select name="cshxc" class="button_huise" id="cshxc">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
��
  <select name="cshxy" class="button_huise" id="cshxy">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
��̨</td>
    </tr>
  <tr class="td_gray">
    <td height="26" align="right" bgcolor="#FFFFFF">��С����</td>
    <td height="26" bgcolor="#FFFFFF"><select name="wzxq" class="button_huise" id="wzxq">
      <option value="0">С������</option>
    </select>
��
<input name="wzxq1" type="text" class="button_huise" id="wzxq1" /></td>
    <td height="26" align="right" bgcolor="#FFFFFF">���������</td>
    <td height="26" bgcolor="#FFFFFF">
      <select name="csnd" class="button_huise" id="csnd">
        <option value="0">��ѡ�������</option>
        <%
	nd=year(now())
	for ndid=nd to 1980 step -1
	%>
        <option value="<%=ndid%>"><%=ndid%></option>
        <%next%>
      </select>
�� </td>
  </tr>
  
  <tr class="td_gray">
    <td height="26" align="right" bgcolor="#FFFFFF">¥�㣺</td>
    <td height="26" bgcolor="#FFFFFF">��
      <input name="cslc1" type="text" id="cslc1" size="6"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
�㵽
<input name="cslc2" type="text" id="cslc2" size="6"  onkeypress="if ((event.keyCode &lt; 48 || event.keyCode &gt; 57 )) event.returnValue = false;"/>
��</td>
    <td height="26" align="right" bgcolor="#FFFFFF">װ�޳̶ȣ�</td>
    <td height="26" bgcolor="#FFFFFF"><select name="cszx" class="button_huise" id="cszx">
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
    </select></td>
  </tr>
  <tr class="td_gray">
    <td height="26" align="right" bgcolor="#FFFFFF">Ȩ����</td>
    <td height="26" bgcolor="#FFFFFF"><select name="csqs" class="button_huise" id="csqs">
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
        </select></td>
    <td height="26" align="right" bgcolor="#FFFFFF">��Ҫ˵����</td>
    <td height="26" bgcolor="#FFFFFF"><select size="1" name="tyqbox">
      <option selected value="1">δ�Ķ�</option>
      <option value="2">���Ķ�</option>
    </select>
      <a onclick="javascript:window.open('/wts-qg.asp', 'newwindow', 'height=440, width=400, toolbar=no, menubar=no, scrollbars=auto, resizable=no, location=no, status=no')" >�����ݳй�ί���顷</a></td>
  </tr>
  <tr class="td_white">
    <td height="40" colspan="4" align="center" valign="middle" bgcolor="#FFFFFF"><input name="Submit" type="submit" class="search_label" value="�ύ��Ϣ" /></td>
  </tr>
</form>
</table>

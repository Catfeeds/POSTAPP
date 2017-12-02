<%@LANGUAGE="VBSCRIPT" CODEPAGE="936"%>
<!--#include file="../flying_func/dbconn2.asp"-->
<!--#include file="../flying_func/session_ct.asp"-->
<!--#include file="../flying_func/jjrsession_ct.asp"-->
<!--#include file="../flying_func/function2.asp"-->
<%
id=request.QueryString("id")
	if isint(id)=false then
		call show_go("非法参数","exit.asp")
	end if
'处理修改--------------------------------------------------------------------------------------------------------------------------------------------------
'处理修改
if request.QueryString("act")="modok" then	
	set rs=server.CreateObject("adodb.recordset")
	sql="select  * from housexx_cs where id="&id
	rs.open sql,conn,1,3
	csfyt2=trim(request.Form("csfyt2"))  '房源图片，字符型
	csfyt=trim(request.Form("csfyt"))  '房源图片，字符型
	csfyt1=trim(request.Form("csfyt1"))  '房源图片，字符型
	bh = rs("bh")
	'call show_go(csfyt,"chuantu.asp?action=search")
	'response.write(csfyt)
	
	If rs("csfyt")<>csfyt Then
		Call rizhi(rs("id"),bh,"csfy","3","Wap图片：—>"&csfyt)
	End If
	If rs("csfyt1")<>csfyt1 Then
		Call rizhi(rs("id"),bh,"csfy","3","Wap户型：—>"&csfyt1)
	End If
	If rs("csfyt2")<>csfyt2 Then
		Call rizhi(rs("id"),bh,"csfy","3","Wap产权：—>"&csfyt2)
	End If
	
	rs("csfyt")=csfyt  '房源图片，字符型
	rs("csfyt1")=csfyt1  '房源图片，字符型
	rs("csfyt2")=csfyt2  '房源图片，字符型
	
	rs.update
	rs.close
	session("mod")=false
	set rs=nothing
	call connclose()
	response.Redirect("chuantu.asp?action=search")
	response.End()
else
	id=clng(id)
	set rs=server.CreateObject("adodb.recordset")
	sql="select * from housexx_cs where id="&id
	rs.open sql,conn,1,1
	if rs.eof and rs.bof then
		call show_go("无此记录","chuantu.asp?action=search")
	end If
	
end if
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>修改出售房源</title>

<script language="javascript" src="http://api.51ditu.com/js/maps.js"></script>
<script language="javascript" src="http://api.51ditu.com/js/ezmarker.js"></script>
<link href="../flying_func/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">


</style>
</head>

<body>
<table width="96%" border="0" cellpadding="0" cellspacing="1" class="table_blue">
  <tr class="table_tr_bg_bule">
    <td><span class="redtext_12b">请使用图片工具修改像素尺寸为宽度650*高度480-488后再上传图片</span></td>
  </tr>
</table>
<table width="96%" border="0" cellpadding="0" cellspacing="1" class="table_blue" style="height:1000px;font-size:18px;">
<form id="form1" name="form1" method="post" action="?act=modok&id=<%=id%>&currentpage=<%=request("currentpage")%><%=fy1()%>">

 <tr class="table_tr_bg_white">
    <td width="11%" align="right">室内外</td>
    <td width="108%">
		<iframe id="uploadhxt" src="fyt_sc.asp?fnlist=<%=rs("csfyt")%>" frameborder="0" marginheight="0" marginwidth="0" width="700"  scrolling="No"></iframe>
		<input name="csfyt" id="csfyt" type="hidden" value="<%=rs("csfyt")%>" size="255" /></td>
  </tr>
  <!--添加室内上传图-->
 <tr class="table_tr_bg_white">
    <td align="right">户型图</td>
    <td>
		<iframe id="uploadhxt1" src="fyt_sc1.asp?fnlist=<%=rs("csfyt1")%>" frameborder="0" marginheight="0" marginwidth="0" width="800"  scrolling="No"></iframe>
		<input maxlength="255" name="csfyt1" id="csfyt1" type="hidden"  value="<%=rs("csfyt1")%>"/>
	</td>
  </tr>

  <!--添加产权上传图-->
 <tr class="table_tr_bg_white">
    <td align="right">产权图片</td>
    <td>
		<iframe id="uploadhxt2" src="fyt_sc2.asp?fnlist=<%=rs("csfyt2")%>" frameborder="0" marginheight="0" marginwidth="0" width="800"  scrolling="No"></iframe>
		<input maxlength="255" name="csfyt2" id="csfyt2" type="hidden"  value="<%=rs("csfyt2")%>"/>
	</td>
  </tr>
  <tr class="table_tr_bg_white">
    <td colspan="2" align="center">
	<input name="add" type="submit" src="../flying_images/operation/apply.gif" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<img style="cursor:hand;"  onclick="window.document.location.href='chuantu.asp';" src="../flying_images/operation/cancel.gif" width="24" height="24" border="0" />
	</td>
  </tr>
</form>
</table>
<br />
</body>
</html>
<% 
rs.close
set rs=nothing
call connclose()
%>
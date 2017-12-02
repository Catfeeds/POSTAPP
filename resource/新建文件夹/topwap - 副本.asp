<%@LANGUAGE="VBSCRIPT" CODEPAGE="936"%>
<!-- #include file="../flying_func/dbconn2.asp" -->
<!-- #include file="../flying_func/function.asp" -->
<!-- #include file="../flying_func/config.asp" -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?708f74f52be0fdf95239d8c8b6c9b0b7";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="专业房产中介,简阳二手房,商品房,购房,租房,买房,出租,出售,求租,求购房屋中介"></meta>
<title><%=sitename%>—专业房产中介,简阳二手房 商品房 购房 租房 买房 出租 出售 求租 求购房屋中介 房地产经纪公司</title>
<link href="../flying_func/css1.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../ajax/js.js" type="text/javascript"></script>
<script language="javascript">
function OpenWindowAndSetValue(Url,Width,Height,WindowObj,SetObj)
{
	var ReturnStr=showModalDialog(Url,WindowObj,'dialogWidth:'+Width+'pt;dialogHeight:'+Height+'pt;status:no;help:no;scroll:no;');
	SetObj.value=ReturnStr;
	return ReturnStr;
}
if (top.location!=self.location){
	top.location=self.location;
}
function showsubmenu(sid)
{
	for (var i=1;i<=9;i++){
		which = eval("s" + i);
		which1=eval("m"+i);
		if (i!=sid){
		eval("s"+i+".style.display=\"none\";");
		which1.className="";
		}
		else{
			which.style.display="block";
			which1.className="search_label";
 		}
	}
}
function checkes(obj){
	if (obj.esyt.value=="0"){
		alert("请选择房源类型");
		return false;}
	if (obj.escs.value=="0"){
		alert("请选择城市");
		return false;}
	SetOldCookie();
	return true;
}
function checkzf(obj){
	if (obj.zfyt.value=="0"){
		alert("请选择房源类型");
		return false;}
	if (obj.zfcs.value=="0"){
		alert("请选择城市");
		return false;}
	SetOldCookie("zf");
	return true;
}
function checkjjrmd(obj){
	if (obj.cs.value=="0"){
		alert("请选择城市");
		return false;}
	return true;
}
function checknews(obj){
	if (trimstr(obj.keywords.value)==""){
		alert("请输入关键字");
		obj.keywords.focus();
		return false;}
	return true;
}
function checkbianhao(obj){
	if (trimstr(obj.bhid.value)==""){
		alert("请输入编号");
		obj.bhid.focus();
		return false;}
	return true;
}
function trimstr(sstring){
var sstr,i,j,k,ostr;
ostr="";
sstr=sstring.split("");
for (i=0;i<sstr.length;i++)
{
	if (sstr[i]!=" ") break;
}
for (j=sstr.length-1;j>=0;j--)
{
	if (sstr[j]!=" ") break;
}
for (k=i;k<=j;k++){ostr=ostr+sstr[k];}
return ostr;
}
function getlen(sstring){
var sstr,icount,i,strtemp;
icount=0;
sstr=sstring.split("");
for (i=0;i<sstr.length;i++)
{
	strtemp=escape(sstr[i]);
	if (strtemp.indexOf("%u",0)==-1){
		icount=icount+1;}
	else{
		icount=icount+2;}
}
return icount;
}
</script>
</head>

<body>
<br />
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["weixin","qzone","sqq","mshare","tsina","tqq","tqf","tieba","copy","mail","ty"],"bdPic":"","bdStyle":"1","bdSize":"16"},"slide":{"type":"slide","bdImg":"0","bdPos":"right","bdTop":"0"},"image":{"viewList":["weixin","sqq","qzone","tqq","tsina","renren","mshare"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["weixin","sqq","qzone","tqq","tsina","renren","mshare"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<style> 
#nav { width:100px; height: 20px; border: 0px solid #D4CD49; position:fixed;right:0;top:95% } 
</style> 

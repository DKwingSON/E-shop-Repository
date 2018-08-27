 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
 <center>
后台订单管理系统<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
if(!$_COOKIE["login"])
{
?>
<script language="javascript">
function check(f)
{
	if(f.name.value == "")
	{
		alert("请输入登录用户名称！");
		f.name.focus();
		return (false);
	}
	if (f.pass.value == "")
	{
		alert("请输入登录用户密码！");
		f.pass.focus();
		return (false);
	}
}
 </script>
<form method=post action="login.php"  onsubmit="return check(this)">
<tr><td align="right">
尚未登录，用户名<input type=text name="name" size=6>密码<input type=password name="pass" size=6>
有效期
<select name=c_l size=1>
<option value=<?php echo 3600*24*7?>>一周</option>
<option value=<?php echo 3600*24*30?>>一月</option>
<option value=<?php echo 3600*24*365?>>一年</option>
</select><input type="submit" value="登录">
</td></tr>
</form>
<?php
}
else
{
	echo "<tr><td align=\"right\">";
	echo "欢迎您：";
	echo "<a href=userinfo.php>".$_COOKIE["login"]."</a>";
	echo "&nbsp;&nbsp;<a href=quit.php>退出登录</a>";
	echo "</td></tr>";
}
?>
</table>
<?php
if(!$_POST["name"])
{
	echo "<center>";
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
 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
后台订单管理系统<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">登录用户信息</td>
</tr>
<tr>
<td>用户名称</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>用户密码</td>
<td><input type=password name="pass" size=21></td>
</tr>
<tr>
<td>登录有效期</td>
<td>
<select name=c_l size=1>
<option value=<?php echo 3600*24*7?>>一周</option>
<option value=<?php echo 3600*24*30?>>一月</option>
<option value=<?php echo 3600*24*365?>>一年</option>
</select>
</td>
</tr>
<tr>
<td colspan=2 align="center"><input type="submit" value="登录"></td>
</tr>
</form>
</table>
<?php
}
else
{
	$name=$_POST["name"];				//获取管理员名称
	$pass=md5($_POST["pass"]);				//获取管理员密码
	$c_l=$_POST["c_l"];
	include "config.php";				//加载配置文件
	$sql="SELECT count(*) FROM $my_user WHERE name='$name' AND password='$pass'";
	$re=mysql_query($sql,$my_conn) or die(mysql_error());	//发送查询用户SQL请求
	$count=mysql_fetch_row($re);							//获取结果集
	if($count[0]>0)
	{
		setcookie("login",$name,time()+$c_l);						//写入cookie
		echo "<meta http-equiv=\"refresh\" content=\"2; url=e_sale.php\">";
		echo "<center>";
		echo "成功登录后台订单系统！<p>";
		echo "两秒后进入后台订单管理页面";
	}
	else
	{
		echo "<center>";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=login.php\">";
		echo "输入的用户名或者密码错误！<p>";
		echo "两秒后返回重新输入";
	}
}
echo "</center>";
?>
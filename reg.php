<?php
echo "<center>";
if(!$_POST["name"])
{
?>
 <script language="javascript">
function check(f)
{
	if(f.name.value == "")
	{
		alert("请输入注册用户名称！");
		f.name.focus();
		return (false);
	}
	if (f.pass.value == "")
	{
		alert("请输入注册用户密码！");
		f.pass.focus();
		return (false);
	}
	if (f.re_pass.value != f.pass.value)
	{
		alert("重复密码与密码不一致！");
		f.re_pass.focus();
		f.re_pass.select();
		return (false);
	}
	if (f.mail.value == "")
	{
		alert("请输入注册用户邮箱！");
		f.mail.focus();
		return (false);
	}
}
 </script>
 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
mini商城系统注册程序<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">注册用户信息</td>
</tr>
<tr>
<td>注册用户名称</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>注册用户密码</td>
<td><input type=password name="pass" size=21></td>
</tr>
<tr>
<td>确认密码</td>
<td><input type=password name="re_pass" size=21></td>
</tr>
<tr>
<td>注册用户邮箱</td>
<td><input type=text name="mail"></td>
</tr>
<tr>
<td colspan=2 align="center"><input type="submit" value="注册"></td>
</tr>
</form>
</table>
<?php
}
else
{
	$name=$_POST["name"];				//获取注册用户名称
	$pass=md5($_POST["pass"]);				//获取注册用户密码
	$mail=$_POST["mail"];				//获取注册用户邮箱
	$time=date("Y年m月d日");			//获取当前时间
	include "config.php";				//加载配置文件
	$sql="SELECT count(*) FROM $my_user WHERE name='$name'";
	$re=mysql_query($sql,$my_conn) or die(mysql_error());
	$count=mysql_fetch_row($re);
	if($count[0]>0)
	{
		echo "已经存在同名用户<p>";
		echo "点<a href=reg.php>这里</a>注册新用户&nbsp; 点<a href=login.php>这里</a>登录";
	}
	else
	{
		$sql="INSERT INTO $my_user(name,password,email,reg_date)values('$name','$pass','$mail','$time')";
		$re=mysql_query($sql,$my_conn) or die(mysql_error());
		if($re)
		{
			echo "成功注册用户：".$name."<p>";
			echo "点<a href=login.php>这里</a>登录";
		}
	}
}
echo "</center>";
?>
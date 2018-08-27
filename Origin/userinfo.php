 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
 <center>
用户信息查看页面<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
if(!$_COOKIE["login"])
{
?>
<tr><td align="center">
尚未登录，点<a href="login.php">这里</a>登录
</td></tr>
<?php
}
else
{
	echo "<tr><td align=\"center\" bgcolor=\"#ccccff\" colspan=2>";
	echo "<a href=show.php>首页</a>";
	echo "&nbsp;&nbsp;<a href=e_pass.php>修改密码</a>";
	echo "&nbsp;&nbsp;<a href=show_sale.php>查看历史订单</a>";
	echo "&nbsp;&nbsp;<a href=quit.php>退出登录</a>";
	echo "</td></tr>";
	include "config.php";
	$sql="SELECT * FROM $my_user WHERE name='$_COOKIE[login]'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	echo "<tr>";
	echo "<td>用户名称：</td>";
	echo "<td>".$row["name"]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>用户邮箱：</td>";
	echo "<td>".$row["email"]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>注册日期：</td>";
	echo "<td>".$row["reg_date"]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>是否为管理员：</td>";
	echo "<td>";
	if($row["admin"]==1)
	{
		echo "管理员";
		echo "&nbsp;&nbsp;<a href=e_sale.php>处理订单</a>";
	}
	else echo "非管理员";
	echo "</td>";
	echo "</tr>";
}
?>
</table>
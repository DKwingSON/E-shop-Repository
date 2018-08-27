 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
 <center>
查看用户历史订单<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
if(!$_COOKIE["login"])
{
?>
<tr><td align="center">
尚未登录，点<a href="login.php">这里</a>登录
</td></tr>
</form>
<?php
}
else
{
	echo "<tr><td align=\"center\" bgcolor=\"#ccccff\" colspan=5>";
	echo "<a href=show.php>首页</a>";
	echo "&nbsp;&nbsp;<a href=userinfo.php>查看用户".$_COOKIE["login"]."注册信息</a>";
	echo "&nbsp;&nbsp;<a href=quit.php>退出登录</a>";
	echo "</td></tr>";
	include "config.php";
	$sql="SELECT * FROM $my_sales WHERE sale_user_name='$_COOKIE[login]'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num==0)
	{
		echo "<tr><td colsapn=5>尚没有用户".$_COOKIE[login]."的订单</td></tr>";
	}
	else
	{
		echo "<tr><td>商品名称</td><td>购买数量</td><td>总价格</td><td>订单状态</td><td>购买时间</td></tr>";
		while($row=mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>";
			$sql="SELECT name FROM $my_goods WHERE id='$row[sale_goods_id]'";
			$temp=mysql_fetch_row(mysql_query($sql));
			echo $temp[0];
			echo "</td>";
			echo "<td>".$row[sale_goods_num]."</td>";
			echo "<td>".$row[sale_cost]."</td>";
			echo "<td>";
			if($row[sale_state]==0) echo "未处理";
			else echo "已处理";
			echo "</td>";
			echo "<td>".$row[sale_date]."</td>";
			echo "</tr>";
		}
	}
}
?>
</table>
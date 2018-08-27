<?php
echo "<center>";
echo " <style type=\"text/css\">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>";
if(!$_COOKIE["login"])
{
	echo "您还没有登录！<p>";
	echo "请以管理员身份<a href=login.php>登录</a>，再执行该页面！";
}
else
{
	$name=$_COOKIE["login"];
	//echo $name;
	include "config.php";
	$sql="SELECT authority FROM $_supplier WHERE supplier_id='$name'";
	$result=mysql_query($sql);
	$row=mysql_fetch_row($result);
	if($row[0]==0)
	{
		echo "您没有权限执行该页面！<p>";
		echo "请以管理员身份<a href=login.php>登录</a>，再执行该页面！";
	}
	else
	{
		if(!$_GET["id"])
		{
			echo "管理所有未处理历史订单<p>";
			include "config.php";
			$sql="SELECT * FROM $_orders WHERE accept='no' AND supplier_id='$name'";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "没有尚未处理的订单！<p>点<a href=show.php>这里</a>返回首页<p>";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>订单号</td><td>购买人ID</td><td>供货商ID</td><td>购买物品</td><td>购买数量</td><td>地址</td><td>购买时间</td><td>处理</td></tr>";
				while($row=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row[order_id]."</td>";
					echo "<td>".$row[user_id]."</td>";
					echo "<td>".$row[supplier_id]."</td>";
					echo "<td>";
					$sql="SELECT goods_name FROM $_goods WHERE id='$row[goods_id]'";
					$temp=mysql_fetch_row(mysql_query($sql));
					echo $temp[0];
					echo "</td>";
					echo "<td>".$row[number]."</td>";
					echo "<td>".$row[address]."</td>";
					echo "<td>".$row[order_time]."</td>";
					echo "<td><a href=e_sale.php?id=".$row[order_id].">处理</a></td>";
					echo "</tr>";
				}
			}
			echo "已处理订单<p>";
			$sql_yes="SELECT * FROM $_orders WHERE accept='yes' AND supplier_id='$name'";
			$result_yes=mysql_query($sql_yes);
			$num=mysql_num_rows($result_yes);
			if($num==0) echo "没有已接收订单！<p>点<a href=show.php>这里</a>返回首页";
			else{
				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>订单号</td><td>购买人ID</td><td>供货商ID</td><td>购买物品</td><td>购买数量</td><td>地址</td><td>购买时间</td></tr>";
				while($row_yes=mysql_fetch_array($result_yes))
				{
					echo "<tr>";
					echo "<td>".$row_yes[order_id]."</td>";
					echo "<td>".$row_yes[user_id]."</td>";
					echo "<td>".$row_yes[supplier_id]."</td>";
					echo "<td>";
					$sql="SELECT goods_name FROM $_goods WHERE goods_id='$row_yes[goods_id]'";
					//$temp=mysql_fetch_row(mysql_query($sql));
					echo mysql_fetch_array(mysql_query("SELECT goods_name FROM $_goods WHERE goods_id='$row_yes[goods_id]'"))[0];
					//echo '9'+$temp[0];
					echo "</td>";
					echo "<td>".$row_yes[number]."</td>";
					echo "<td>".$row_yes[address]."</td>";
					echo "<td>".$row_yes[order_time]."</td>";
					echo "</tr>";
				}
			}
		}
		else
		{
			$id=$_GET["id"];
			$sql="UPDATE $_orders SET accept='yes' WHERE order_id='$id'";
			$re=mysql_query($sql,$my_conn) or die(mysql_error());				//更新类别数量
			if($re)
			{
				echo "<meta http-equiv=\"refresh\" content=\"2; url=e_sale.php\">";
				echo "成功处理订单：".$id."<p>";
				echo "两秒后返回";
			}
			else
			{
				echo "<meta http-equiv=\"refresh\" content=\"2; url=e_sale.php\">";
				echo "处理订单：".$id."失败<p>";
				echo "两秒后返回";
			}
		}
	}
}
echo "</center>";
?>
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
	include "config.php";
	$sql="SELECT admin FROM $my_user WHERE name='$name'";
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
			$sql="SELECT * FROM $my_sales WHERE sale_state='0'";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "没有尚未处理的订单！<p>点<a href=show.php>这里</a>返回首页";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>编号</td><td>购买人</td><td>商品名称</td><td>购买数量</td><td>地址</td><td>购买时间</td><td>处理</td></tr>";
				while($row=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row[id]."</td>";
					echo "<td>".$row[sale_user_name]."</td>";
					echo "<td>";
					$sql="SELECT name FROM $my_goods WHERE id='$row[sale_goods_id]'";
					$temp=mysql_fetch_row(mysql_query($sql));
					echo $temp[0];
					echo "</td>";
					echo "<td>".$row[sale_good_num]."</td>";
					echo "<td>".$row[sale_user_address]."</td>";
					echo "<td>".$row[sale_date]."</td>";
					echo "<td><a href=e_sale.php?id=".$row[id].">处理</a></td>";
					echo "</tr>";
				}
			}
		}
		else
		{
			$id=$_GET["id"];
			$sql="UPDATE $my_sales SET sale_state='1' WHERE id='$id'";
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
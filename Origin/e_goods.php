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
			echo "管理所有商品<p>";
			include "config.php";
			$sql="SELECT * FROM $my_goods";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "尚没有任何商品！<p>点<a href=show.php>这里</a>返回首页";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>编号</td><td>商品名称</td><td>所属类别</td><td>售价</td><td>商品介绍</td><td>存货量</td><td>修改</td></tr>";
				while($row=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row[id]."</td>";
					echo "<td>".$row[name]."</td>";
					echo "<td>".$row[type]."</td>";
					echo "<td>".$row[cost]."</td>";
					echo "<td>".$row[description]."</td>";
					echo "<td>".$row[num]."</td>";
					echo "<td><a href=e_goods.php?id=".$row[id].">修改</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}
		else
		{
			$id=$_GET["id"];
			include "config.php";
			if(!$_POST[name])
			{
				echo " <script language=\"javascript\">
function check(f)
{
	if(f.name.value == \"\")
	{
		alert(\"请输入商品名称！\");
		f.name.focus();
		return (false);
	}
	if(f.cost.value == \"\")
	{
		alert(\"请输入商品售价！\");
		f.cost.focus();
		return (false);
	}
	if(f.num.value == \"\")
	{
		alert(\"请输入商品存量！\");
		f.num.focus();
		return (false);
	}
	if(f.description.value == \"\")
	{
		alert(\"请输入商品介绍！\");
		f.description.focus();
		return (false);
	}
}
 </script>";
				$sql="SELECT * FROM $my_goods WHERE id='$id'";
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<form method=post action=e_goods.php?id=".$id."  onsubmit=\"return check(this)\">";
				echo "<tr><td colspan=\"2\" align=\"center\">商品：<font color=\"#ff0000\">".$row[name]."</font>的内容</td></tr>";
				echo "<tr>";
				echo "<td>商品编号：</td><td>".$row[id]."</td>";
				echo "</tr>";
				echo "<input type=hidden name=type value=".$row[type].">";
				echo "<input type=hidden name=old_num value=".$row[num].">";
				echo "<tr>";
				echo "<td>商品名称：</td><td><input type=text name=name value=".$row[name]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>商品售价：</td><td><input type=text name=cost value=".$row[cost]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>商品数量：</td><td><input type=text name=num value=".$row[num]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>商品介绍：</td><td><input type=text name=description value=".$row[description]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan=\"2\" align=\"center\"><input type=submit value=\"提交修改\"><input type=button value=\"放弃修改\" onclick=history.go(-1)></td>";
				echo "</tr>";
				echo "</form>";
				echo "</table>";
			}
			else
			{
				$name=$_POST["name"];
				$cost=$_POST["cost"];
				$num=$_POST["num"];
				$type=$_POST["type"];
				$old_num=$_POST["old_num"];
				$description=$_POST["description"];
				$a_num=($num-$old_num);
				$sql="UPDATE $my_goods SET name='$name',cost='$cost',num='$num',description='$description' WHERE id='$id'";
				$re=mysql_query($sql,$my_conn) or die(mysql_error());				//更新商品相关信息
				$sql2="UPDATE $my_type SET num=num+$a_num WHERE id='$type'";
				$re2=mysql_query($sql2,$my_conn) or die(mysql_error());				//更新商品类别数量
				if($re and $re2)
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_goods.php\">";
					echo "成功更新商品信息：".$id."<p>";
					echo "两秒后返回";
				}
				else
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_goods.php\">";
					echo "更新商品信息：".$id."失败<p>";
					echo "两秒后返回";
				}
			}
		}
	}
}
echo "</center>";
?>
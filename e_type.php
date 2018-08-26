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
			echo "管理所有类别<p>";
			include "config.php";
			$sql="SELECT * FROM $my_type";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "尚没有任何类别！<p>点<a href=show.php>这里</a>返回首页";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>编号</td><td>类别名称</td><td>类别介绍</td><td>修改</td></tr>";
				while($row=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row[id]."</td>";
					echo "<td>".$row[name]."</td>";
					echo "<td>".$row[description]."</td>";
					echo "<td><a href=e_type.php?id=".$row[id].">修改</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		}
		else
		{
			$id=$_GET["id"];
			include "config.php";
			if(!$_POST[description])
			{
				echo " <script language=\"javascript\">
function check(f)
{
	if(f.name.value == \"\")
	{
		alert(\"请输入类别名称！\");
		f.name.focus();
		return (false);
	}
	if(f.description.value == \"\")
	{
		alert(\"请输入类别介绍！\");
		f.description.focus();
		return (false);
	}
}
 </script>";
				$sql="SELECT * FROM $my_type WHERE id='$id'";
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<form method=post action=e_type.php?id=".$id."  onsubmit=\"return check(this)\">";
				echo "<tr><td colspan=\"2\" align=\"center\">类别：<font color=\"#ff0000\">".$row[name]."</font>的内容</td></tr>";
				echo "<tr>";
				echo "<td>类别编号：</td><td>".$row[id]."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>类别名称：</td><td><input type=text name=name value=".$row[name]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>类别介绍：</td><td><input type=text name=description value=".$row[description]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan=\"2\" align=\"center\"><input type=submit value=\"提交修改\"><input type=button value=\"放弃修改\" onclick=history.go(-1)></td>";
				echo "</tr>";
				echo "</form>";
				echo "</table>";
			}
			else
			{
				$description=$_POST["description"];
				$sql="UPDATE $my_type SET description='$description' WHERE id='$id'";
				$re=mysql_query($sql,$my_conn) or die(mysql_error());				//更新类别介绍
				if($re)
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_type.php\">";
					echo "成功更新类别介绍信息：".$id."<p>";
					echo "两秒后返回";
				}
				else
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_type.php\">";
					echo "更新类别信息：".$id."失败<p>";
					echo "两秒后返回";
				}
			}
		}
	}
}
echo "</center>";
?>
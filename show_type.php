<?php
include "header.php";
?>
<p>
<?php
if(!$_GET["id"])
{
	echo "<meta http-equiv=\"refresh\" content=\"2; url=show.php\">";
	echo "没有提供类别ID<p>";
	echo "两秒后返回查看主页面";
}
else
{
?>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
include "config.php";
$sql="SELECT name FROM $my_type WHERE id='$_GET[id]'";
$result=mysql_query($sql);
$name=mysql_fetch_row($result);
echo "<tr><td bgcolor=\"#ccccff\" colspan=3>";
echo "<a href=show.php>首页</a>&nbsp;&nbsp;查看所有".$name[0]."记录";
echo "&nbsp;&nbsp;";
$sql="SELECT * FROM $my_goods WHERE type='$_GET[id]'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
if($num==0)
{
	echo "<center>该类别中尚没有任何商品</center>";
	echo "</td></tr>";
}
else
{
	echo "共有".$num."种商品";
	echo "</td></tr>";
	for($i=0;$i<ceil($num/3);$i++)
	{
		echo "<tr>";
		for($j=0;$j<3;$j++)
		{
			echo "<td>";
			$row=mysql_fetch_array($result);
			if($row)
			{
				echo "<a href=show_goods.php?id=".$row["id"].">".$row["name"]."</a>(".$row["num"].")";
				echo "<br>";
				echo $row["description"];
			}
			else
			{
				echo "尚无商品";
			}
			echo "</td>";
		}
		echo "</tr>";
		
	}
}
echo "</table>";
}
?>
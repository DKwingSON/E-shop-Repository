<?php
include "header.php";
?>
<p>
<?php
if(!$_GET["id"])
{
	echo "<meta http-equiv=\"refresh\" content=\"2; url=show.php\">";
	echo "没有提供商品ID<p>";
	echo "两秒后返回查看主页面";
}
else
{
?>
<script language="javascript" src="mycat.js"></script>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
include "config.php";
$sql="SELECT * FROM $my_goods WHERE id='$_GET[id]'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$sql="SELECT id,name FROM $my_type WHERE id='$row[type]'";
$result=mysql_query($sql);
$type_info=mysql_fetch_array($result);
echo "<tr>";
echo "<td bgcolor=\"#ccccff\" colspan=2>";
echo "<a href=show.php>首页</a>&nbsp;&nbsp;";
echo "<a href=show_type.php?id=".$type_info["id"].">".$type_info["name"]."</a>&nbsp;&nbsp;";
echo "查看".$row["name"]."的详细信息";
echo "</td></tr>";
echo "<tr>";
echo "<td>商品名称：</td>";
echo "<td>".$row["name"]."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>商品售价：</td>";
echo "<td>".$row["cost"]."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>现有存货：</td>";
echo "<td>".$row["num"]."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>商品介绍：</td>";
echo "<td>".$row["description"]."</td>";
echo "</tr>";
if($_COOKIE["login"])
{
	echo "<tr>";
	echo "<td colspan=\"2\" align=\"center\"><input type=\"button\" value=\"把该商品加入购物车\" onclick=SetCookie(\"cat".$row[id]."\",\"1\")></td>\n";
	echo "</tr>";
}
echo "</table>";
}
?>
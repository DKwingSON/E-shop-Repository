<?php
include "header.php";
?>
<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
include "config.php";
$sql="SELECT * FROM $my_type";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
if($num==0)
{
	echo "<tr><td bgcolor=\"#ccccff\" colspan=3>";
	echo "<center>尚没有任何商品种类</center>";
	echo "</td></tr>";
}
else
{
	echo "<tr><td bgcolor=\"#ccccff\" colspan=3><center>";
	echo "共有".$num."种商品";
	echo "</center></td></tr>";
	for($i=0;$i<ceil($num/3);$i++)
	{
		echo "<tr>";
		for($j=0;$j<3;$j++)
		{
			echo "<td>";
			$row=mysql_fetch_array($result);
			if($row)
			{
				echo "<a href=show_type.php?id=".$row["id"].">".$row["name"]."</a>(".$row["num"].")";
				echo "<br>";
				echo $row["description"];
			}
			else
			{
				echo "尚无类别";
			}
			echo "</td>";
		}
		echo "</tr>";
		
	}
}
echo "</table>";
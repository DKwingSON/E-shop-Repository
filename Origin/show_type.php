<?php
include "header.php";
?>
<p>
<?php
if(!$_GET["id"])
{
	echo "<meta http-equiv=\"refresh\" content=\"2; url=show.php\">";
	echo "û���ṩ���ID<p>";
	echo "����󷵻ز鿴��ҳ��";
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
echo "<a href=show.php>��ҳ</a>&nbsp;&nbsp;�鿴����".$name[0]."��¼";
echo "&nbsp;&nbsp;";
$sql="SELECT * FROM $my_goods WHERE type='$_GET[id]'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
if($num==0)
{
	echo "<center>���������û���κ���Ʒ</center>";
	echo "</td></tr>";
}
else
{
	echo "����".$num."����Ʒ";
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
				echo "������Ʒ";
			}
			echo "</td>";
		}
		echo "</tr>";
		
	}
}
echo "</table>";
}
?>
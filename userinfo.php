 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
 <center>
�û���Ϣ�鿴ҳ��<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
if(!$_COOKIE["login"])
{
?>
<tr><td align="center">
��δ��¼����<a href="login.php">����</a>��¼
</td></tr>
<?php
}
else
{
	echo "<tr><td align=\"center\" bgcolor=\"#ccccff\" colspan=2>";
	echo "<a href=show.php>��ҳ</a>";
	echo "&nbsp;&nbsp;<a href=e_pass.php>�޸�����</a>";
	echo "&nbsp;&nbsp;<a href=show_sale.php>�鿴��ʷ����</a>";
	echo "&nbsp;&nbsp;<a href=quit.php>�˳���¼</a>";
	echo "</td></tr>";
	include "config.php";
	$sql="SELECT * FROM $my_user WHERE name='$_COOKIE[login]'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	echo "<tr>";
	echo "<td>�û����ƣ�</td>";
	echo "<td>".$row["name"]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>�û����䣺</td>";
	echo "<td>".$row["email"]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>ע�����ڣ�</td>";
	echo "<td>".$row["reg_date"]."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>�Ƿ�Ϊ����Ա��</td>";
	echo "<td>";
	if($row["admin"]==1)
	{
		echo "����Ա";
		echo "&nbsp;&nbsp;<a href=e_sale.php>������</a>";
	}
	else echo "�ǹ���Ա";
	echo "</td>";
	echo "</tr>";
}
?>
</table>
 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
 <center>
�鿴�û���ʷ����<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
if(!$_COOKIE["login"])
{
?>
<tr><td align="center">
��δ��¼����<a href="login.php">����</a>��¼
</td></tr>
</form>
<?php
}
else
{
	echo "<tr><td align=\"center\" bgcolor=\"#ccccff\" colspan=5>";
	echo "<a href=show.php>��ҳ</a>";
	echo "&nbsp;&nbsp;<a href=userinfo.php>�鿴�û�".$_COOKIE["login"]."ע����Ϣ</a>";
	echo "&nbsp;&nbsp;<a href=quit.php>�˳���¼</a>";
	echo "</td></tr>";
	include "config.php";
	$sql="SELECT * FROM $my_sales WHERE sale_user_name='$_COOKIE[login]'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
	if($num==0)
	{
		echo "<tr><td colsapn=5>��û���û�".$_COOKIE[login]."�Ķ���</td></tr>";
	}
	else
	{
		echo "<tr><td>��Ʒ����</td><td>��������</td><td>�ܼ۸�</td><td>����״̬</td><td>����ʱ��</td></tr>";
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
			if($row[sale_state]==0) echo "δ����";
			else echo "�Ѵ���";
			echo "</td>";
			echo "<td>".$row[sale_date]."</td>";
			echo "</tr>";
		}
	}
}
?>
</table>
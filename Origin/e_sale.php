<?php
echo "<center>";
echo " <style type=\"text/css\">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>";
if(!$_COOKIE["login"])
{
	echo "����û�е�¼��<p>";
	echo "���Թ���Ա���<a href=login.php>��¼</a>����ִ�и�ҳ�棡";
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
		echo "��û��Ȩ��ִ�и�ҳ�棡<p>";
		echo "���Թ���Ա���<a href=login.php>��¼</a>����ִ�и�ҳ�棡";
	}
	else
	{
		if(!$_GET["id"])
		{
			echo "��������δ������ʷ����<p>";
			include "config.php";
			$sql="SELECT * FROM $my_sales WHERE sale_state='0'";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "û����δ����Ķ�����<p>��<a href=show.php>����</a>������ҳ";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>���</td><td>������</td><td>��Ʒ����</td><td>��������</td><td>��ַ</td><td>����ʱ��</td><td>����</td></tr>";
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
					echo "<td><a href=e_sale.php?id=".$row[id].">����</a></td>";
					echo "</tr>";
				}
			}
		}
		else
		{
			$id=$_GET["id"];
			$sql="UPDATE $my_sales SET sale_state='1' WHERE id='$id'";
			$re=mysql_query($sql,$my_conn) or die(mysql_error());				//�����������
			if($re)
			{
				echo "<meta http-equiv=\"refresh\" content=\"2; url=e_sale.php\">";
				echo "�ɹ���������".$id."<p>";
				echo "����󷵻�";
			}
			else
			{
				echo "<meta http-equiv=\"refresh\" content=\"2; url=e_sale.php\">";
				echo "��������".$id."ʧ��<p>";
				echo "����󷵻�";
			}
		}
	}
}
echo "</center>";
?>
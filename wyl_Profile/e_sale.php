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
	//echo $name;
	include "config.php";
	$sql="SELECT authority FROM $_supplier WHERE supplier_id='$name'";
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
			$sql="SELECT * FROM $_orders WHERE accept='no' AND supplier_id='$name'";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "û����δ����Ķ�����<p>��<a href=show.php>����</a>������ҳ<p>";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>������</td><td>������ID</td><td>������ID</td><td>������Ʒ</td><td>��������</td><td>��ַ</td><td>����ʱ��</td><td>����</td></tr>";
				while($row=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row[order_id]."</td>";
					echo "<td>".$row[user_id]."</td>";
					echo "<td>".$row[supplier_id]."</td>";
					echo "<td>";
					$sql="SELECT goods_name FROM $_goods WHERE id='$row[goods_id]'";
					$temp=mysql_fetch_row(mysql_query($sql));
					echo $temp[0];
					echo "</td>";
					echo "<td>".$row[number]."</td>";
					echo "<td>".$row[address]."</td>";
					echo "<td>".$row[order_time]."</td>";
					echo "<td><a href=e_sale.php?id=".$row[order_id].">����</a></td>";
					echo "</tr>";
				}
			}
			echo "�Ѵ�����<p>";
			$sql_yes="SELECT * FROM $_orders WHERE accept='yes' AND supplier_id='$name'";
			$result_yes=mysql_query($sql_yes);
			$num=mysql_num_rows($result_yes);
			if($num==0) echo "û���ѽ��ն�����<p>��<a href=show.php>����</a>������ҳ";
			else{
				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>������</td><td>������ID</td><td>������ID</td><td>������Ʒ</td><td>��������</td><td>��ַ</td><td>����ʱ��</td></tr>";
				while($row_yes=mysql_fetch_array($result_yes))
				{
					echo "<tr>";
					echo "<td>".$row_yes[order_id]."</td>";
					echo "<td>".$row_yes[user_id]."</td>";
					echo "<td>".$row_yes[supplier_id]."</td>";
					echo "<td>";
					$sql="SELECT goods_name FROM $_goods WHERE goods_id='$row_yes[goods_id]'";
					//$temp=mysql_fetch_row(mysql_query($sql));
					echo mysql_fetch_array(mysql_query("SELECT goods_name FROM $_goods WHERE goods_id='$row_yes[goods_id]'"))[0];
					//echo '9'+$temp[0];
					echo "</td>";
					echo "<td>".$row_yes[number]."</td>";
					echo "<td>".$row_yes[address]."</td>";
					echo "<td>".$row_yes[order_time]."</td>";
					echo "</tr>";
				}
			}
		}
		else
		{
			$id=$_GET["id"];
			$sql="UPDATE $_orders SET accept='yes' WHERE order_id='$id'";
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
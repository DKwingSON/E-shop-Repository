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
			echo "����������Ʒ<p>";
			include "config.php";
			$sql="SELECT * FROM $my_goods";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "��û���κ���Ʒ��<p>��<a href=show.php>����</a>������ҳ";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>���</td><td>��Ʒ����</td><td>�������</td><td>�ۼ�</td><td>��Ʒ����</td><td>�����</td><td>�޸�</td></tr>";
				while($row=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row[id]."</td>";
					echo "<td>".$row[name]."</td>";
					echo "<td>".$row[type]."</td>";
					echo "<td>".$row[cost]."</td>";
					echo "<td>".$row[description]."</td>";
					echo "<td>".$row[num]."</td>";
					echo "<td><a href=e_goods.php?id=".$row[id].">�޸�</a></td>";
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
		alert(\"��������Ʒ���ƣ�\");
		f.name.focus();
		return (false);
	}
	if(f.cost.value == \"\")
	{
		alert(\"��������Ʒ�ۼۣ�\");
		f.cost.focus();
		return (false);
	}
	if(f.num.value == \"\")
	{
		alert(\"��������Ʒ������\");
		f.num.focus();
		return (false);
	}
	if(f.description.value == \"\")
	{
		alert(\"��������Ʒ���ܣ�\");
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
				echo "<tr><td colspan=\"2\" align=\"center\">��Ʒ��<font color=\"#ff0000\">".$row[name]."</font>������</td></tr>";
				echo "<tr>";
				echo "<td>��Ʒ��ţ�</td><td>".$row[id]."</td>";
				echo "</tr>";
				echo "<input type=hidden name=type value=".$row[type].">";
				echo "<input type=hidden name=old_num value=".$row[num].">";
				echo "<tr>";
				echo "<td>��Ʒ���ƣ�</td><td><input type=text name=name value=".$row[name]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>��Ʒ�ۼۣ�</td><td><input type=text name=cost value=".$row[cost]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>��Ʒ������</td><td><input type=text name=num value=".$row[num]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>��Ʒ���ܣ�</td><td><input type=text name=description value=".$row[description]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan=\"2\" align=\"center\"><input type=submit value=\"�ύ�޸�\"><input type=button value=\"�����޸�\" onclick=history.go(-1)></td>";
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
				$re=mysql_query($sql,$my_conn) or die(mysql_error());				//������Ʒ�����Ϣ
				$sql2="UPDATE $my_type SET num=num+$a_num WHERE id='$type'";
				$re2=mysql_query($sql2,$my_conn) or die(mysql_error());				//������Ʒ�������
				if($re and $re2)
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_goods.php\">";
					echo "�ɹ�������Ʒ��Ϣ��".$id."<p>";
					echo "����󷵻�";
				}
				else
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_goods.php\">";
					echo "������Ʒ��Ϣ��".$id."ʧ��<p>";
					echo "����󷵻�";
				}
			}
		}
	}
}
echo "</center>";
?>
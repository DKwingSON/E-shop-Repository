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
			echo "�����������<p>";
			include "config.php";
			$sql="SELECT * FROM $my_type";
			$result=mysql_query($sql);
			$num=mysql_num_rows($result);
			if($num==0) echo "��û���κ����<p>��<a href=show.php>����</a>������ҳ";
			else
			{

				echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">";
				echo "<tr><td>���</td><td>�������</td><td>������</td><td>�޸�</td></tr>";
				while($row=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>".$row[id]."</td>";
					echo "<td>".$row[name]."</td>";
					echo "<td>".$row[description]."</td>";
					echo "<td><a href=e_type.php?id=".$row[id].">�޸�</a></td>";
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
		alert(\"������������ƣ�\");
		f.name.focus();
		return (false);
	}
	if(f.description.value == \"\")
	{
		alert(\"�����������ܣ�\");
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
				echo "<tr><td colspan=\"2\" align=\"center\">���<font color=\"#ff0000\">".$row[name]."</font>������</td></tr>";
				echo "<tr>";
				echo "<td>����ţ�</td><td>".$row[id]."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>������ƣ�</td><td><input type=text name=name value=".$row[name]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>�����ܣ�</td><td><input type=text name=description value=".$row[description]."></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td colspan=\"2\" align=\"center\"><input type=submit value=\"�ύ�޸�\"><input type=button value=\"�����޸�\" onclick=history.go(-1)></td>";
				echo "</tr>";
				echo "</form>";
				echo "</table>";
			}
			else
			{
				$description=$_POST["description"];
				$sql="UPDATE $my_type SET description='$description' WHERE id='$id'";
				$re=mysql_query($sql,$my_conn) or die(mysql_error());				//����������
				if($re)
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_type.php\">";
					echo "�ɹ�������������Ϣ��".$id."<p>";
					echo "����󷵻�";
				}
				else
				{
					echo "<meta http-equiv=\"refresh\" content=\"2; url=e_type.php\">";
					echo "���������Ϣ��".$id."ʧ��<p>";
					echo "����󷵻�";
				}
			}
		}
	}
}
echo "</center>";
?>
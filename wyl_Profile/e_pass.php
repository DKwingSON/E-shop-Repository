 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
 <center>
�޸��û�����ҳ��<p>
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
	echo "<tr><td align=\"center\" bgcolor=\"#ccccff\" colspan=2>";
	echo "<a href=show.php>��ҳ</a>";
	echo "&nbsp;&nbsp;<a href=userinfo.php>�鿴�û�".$_COOKIE["login"]."ע����Ϣ</a>";
	echo "&nbsp;&nbsp;<a href=quit.php>�˳���¼</a>";
	echo "</td></tr>";
	if(!$_POST["pass"])
	{
		echo "<tr>";
		?>
		<script language="javascript">
function check(f)
{
	if (f.pass.value == "")
	{
		alert("������ԭʼ���룡");
		f.pass.focus();
		return (false);
	}
	if (f.new_pass.value == "")
	{
		alert("�����������룡");
		f.new_pass.focus();
		return (false);
	}
	if (f.new_pass.value == f.pass.value)
	{
		alert("��������ԭʼ����һ�£����������������룡");
		f.new_pass.focus();
		return (false);
	}
	if (f.new_pass.value != f.re_pass.value)
	{
		alert("�ظ������������벻һ�£�");
		f.re_pass.focus();
		return (false);
	}
}
 </script>
 <form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
		<?php
		echo "<td>ԭʼ���룺</td>";
		echo "<td><input type=password name=pass></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>�µ����룺</td>";
		echo "<td><input type=password name=new_pass></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>�ظ��µ����룺</td>";
		echo "<td><input type=password name=re_pass></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td colspan=2 align=center>";
		echo "<input type=\"submit\" value=\"ȷ���޸�\">";
		echo "</td>";
		echo "</tr>";
	}
	else
	{
		$password=md5($_POST['pass']);
		$new_pass=md5($_POST['new_pass']);
		include "config.php";
		$sql="SELECT COUNT(*) FROM $my_user WHERE name='$_COOKIE[login]' AND password='$password'";
		$result=mysql_query($sql);
		$row=mysql_fetch_row($result);
		if($row[0]==0)
		{
			echo "<meta http-equiv=\"refresh\" content=\"2; url=e_pass.php\">";
			echo "<tr><td align=\"center\">����ԭʼ�������<p>����󷵻���������</td></tr>";
		}
		else
		{
			$sql="UPDATE $my_user SET password='$new_pass' WHERE name='$_COOKIE[login]' AND password='$password'";
			$re=mysql_query($sql);
			if($re)
			{
				echo "<meta http-equiv=\"refresh\" content=\"2; url=userinfo.php\">";
				echo "<tr><td align=\"center\">�ɹ��޸��û�����<p>�����ת����Ϣ�鿴ҳ��</td></tr>";
			}
			else
			{
				echo "<meta http-equiv=\"refresh\" content=\"2; url=e_pass.php\">";
				echo "<tr><td align=\"center\">�޸��û��������<p>����󷵻���������</td></tr>";
			}
		}
	}
}
?>
</table>
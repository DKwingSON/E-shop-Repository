<?php
echo "<center>";
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
		if(!$_POST["name"])
		{
?>
 <script language="javascript">
function check(f)
{
	if(f.name.value == "")
	{
		alert("������������ƣ�");
		f.name.focus();
		return (false);
	}
}
 </script>
 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
mini�̳�ϵͳ������<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">��������Ϣ</td>
</tr>
<tr>
<td>����������</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>���������</td>
<td><input type=text name="description"></td>
</tr>
<tr>
<td colspan=2 align="center"><input type="submit" value="���"></td>
</tr>
</form>
</table>
<?php
		}
		else
		{
			$name=$_POST["name"];				//��ȡ�������
			if($_POST["description"]!="")
			{
				$description=$_POST["description"];	//��ȡ������
			}
			else
			{
				$description="���޽���";
			}
			$sql="SELECT count(*) FROM $my_type WHERE name='$name'";
			$re=mysql_query($sql,$my_conn) or die(mysql_error());
			$count=mysql_fetch_row($re);
			if($count[0]>0)
			{
				echo "�Ѿ�����ͬ�����<p>";
				echo "��<a href=add_type.php>����</a>����������";
			}
			else
			{
				$sql="INSERT INTO $my_type(name,description)values('$name','$description')";
				$re=mysql_query($sql,$my_conn) or die(mysql_error());
				if($re)
				{
					echo "�ɹ�������".$name."<p>";
					echo "��<a href=show.php>����</a>�鿴";
				}
			}

		}
	}
}
echo "</center>";
?>
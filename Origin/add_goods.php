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
		alert("��������Ʒ���ƣ�");
		f.name.focus();
		return (false);
	}
	if(f.cost.value == "")
	{
		alert("��������Ʒ�۸�");
		f.cost.focus();
		return (false);
	}
	if(f.num.value == "")
	{
		alert("��������Ʒ������");
		f.num.focus();
		return (false);
	}
}
 </script>
 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
mini�̳�ϵͳ�����Ʒ<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">�����Ʒ��Ϣ</td>
</tr>
<tr>
<td>�����Ʒ����</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>��Ʒ�������</td>
<td>
<select name="type" size=1>
<?php
	include "config.php";
	$sql="SELECT id,name FROM $my_type";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result))
	{
		echo "<option value=".$row[0].">";
		echo $row[1];
		echo "</option>";
	}
?>
</select>
</td>
</tr>
<tr>
<td>�����Ʒ�۸�</td>
<td><input type=text name="cost"></td>
</tr>
<tr>
<td>�����Ʒ����</td>
<td><input type=text name="num"></td>
</tr>
<tr>
<td>�����Ʒ����</td>
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
			$type=$_POST["type"];
			$cost=$_POST["cost"];
			$num=$_POST["num"];
			if($_POST["description"]!="")
			{
				$description=$_POST["description"];	//��ȡ������
			}
			else
			{
				$description="���޽���";
			}
			$sql="UPDATE $my_type SET num=num+'$num' WHERE id='$type'";
			mysql_query($sql,$my_conn) or die(mysql_error());				//�����������
			$sql="INSERT INTO $my_goods(name,type,cost,num,description)values('$name','$type','$cost','$num','$description')";
			$re=mysql_query($sql,$my_conn) or die(mysql_error());
			if($re)
			{
				echo "�ɹ������Ʒ��".$name."<p>";
				echo "��<a href=show.php>����</a>�鿴<p>";
				echo "��<a href=add_goods.php>����</a>�������";
			}
		}
	}
}
echo "</center>";
?>
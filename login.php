<?php
if(!$_POST["name"])
{
	echo "<center>";
?>
<script language="javascript">
function check(f)
{
	if(f.name.value == "")
	{
		alert("�������¼�û����ƣ�");
		f.name.focus();
		return (false);
	}
	if (f.pass.value == "")
	{
		alert("�������¼�û����룡");
		f.pass.focus();
		return (false);
	}
}
 </script>
 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
��̨��������ϵͳ<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">��¼�û���Ϣ</td>
</tr>
<tr>
<td>�û�����</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>�û�����</td>
<td><input type=password name="pass" size=21></td>
</tr>
<tr>
<td>��¼��Ч��</td>
<td>
<select name=c_l size=1>
<option value=<?php echo 3600*24*7?>>һ��</option>
<option value=<?php echo 3600*24*30?>>һ��</option>
<option value=<?php echo 3600*24*365?>>һ��</option>
</select>
</td>
</tr>
<tr>
<td colspan=2 align="center"><input type="submit" value="��¼"></td>
</tr>
</form>
</table>
<?php
}
else
{
	$name=$_POST["name"];				//��ȡ����Ա����
	$pass=md5($_POST["pass"]);				//��ȡ����Ա����
	$c_l=$_POST["c_l"];
	include "config.php";				//���������ļ�
	$sql="SELECT count(*) FROM $my_user WHERE name='$name' AND password='$pass'";
	$re=mysql_query($sql,$my_conn) or die(mysql_error());	//���Ͳ�ѯ�û�SQL����
	$count=mysql_fetch_row($re);							//��ȡ�����
	if($count[0]>0)
	{
		setcookie("login",$name,time()+$c_l);						//д��cookie
		echo "<meta http-equiv=\"refresh\" content=\"2; url=e_sale.php\">";
		echo "<center>";
		echo "�ɹ���¼��̨����ϵͳ��<p>";
		echo "���������̨��������ҳ��";
	}
	else
	{
		echo "<center>";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=login.php\">";
		echo "������û��������������<p>";
		echo "����󷵻���������";
	}
}
echo "</center>";
?>
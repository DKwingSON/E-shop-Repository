<?php
echo "<center>";
if(!$_POST["name"])
{
?>
 <script language="javascript">
function check(f)
{
	if(f.name.value == "")
	{
		alert("������ע���û����ƣ�");
		f.name.focus();
		return (false);
	}
	if (f.pass.value == "")
	{
		alert("������ע���û����룡");
		f.pass.focus();
		return (false);
	}
	if (f.re_pass.value != f.pass.value)
	{
		alert("�ظ����������벻һ�£�");
		f.re_pass.focus();
		f.re_pass.select();
		return (false);
	}
	if (f.mail.value == "")
	{
		alert("������ע���û����䣡");
		f.mail.focus();
		return (false);
	}
}
 </script>
 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
mini�̳�ϵͳע�����<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">ע���û���Ϣ</td>
</tr>
<tr>
<td>ע���û�����</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>ע���û�����</td>
<td><input type=password name="pass" size=21></td>
</tr>
<tr>
<td>ȷ������</td>
<td><input type=password name="re_pass" size=21></td>
</tr>
<tr>
<td>ע���û�����</td>
<td><input type=text name="mail"></td>
</tr>
<tr>
<td colspan=2 align="center"><input type="submit" value="ע��"></td>
</tr>
</form>
</table>
<?php
}
else
{
	$name=$_POST["name"];				//��ȡע���û�����
	$pass=md5($_POST["pass"]);				//��ȡע���û�����
	$mail=$_POST["mail"];				//��ȡע���û�����
	$time=date("Y��m��d��");			//��ȡ��ǰʱ��
	include "config.php";				//���������ļ�
	$sql="SELECT count(*) FROM $my_user WHERE name='$name'";
	$re=mysql_query($sql,$my_conn) or die(mysql_error());
	$count=mysql_fetch_row($re);
	if($count[0]>0)
	{
		echo "�Ѿ�����ͬ���û�<p>";
		echo "��<a href=reg.php>����</a>ע�����û�&nbsp; ��<a href=login.php>����</a>��¼";
	}
	else
	{
		$sql="INSERT INTO $my_user(name,password,email,reg_date)values('$name','$pass','$mail','$time')";
		$re=mysql_query($sql,$my_conn) or die(mysql_error());
		if($re)
		{
			echo "�ɹ�ע���û���".$name."<p>";
			echo "��<a href=login.php>����</a>��¼";
		}
	}
}
echo "</center>";
?>
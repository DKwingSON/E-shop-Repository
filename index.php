 <style type="text/css">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>
 <center>
��̨��������ϵͳ<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="80%">
<?php
if(!$_COOKIE["login"])
{
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
<form method=post action="login.php"  onsubmit="return check(this)">
<tr><td align="right">
��δ��¼���û���<input type=text name="name" size=6>����<input type=password name="pass" size=6>
��Ч��
<select name=c_l size=1>
<option value=<?php echo 3600*24*7?>>һ��</option>
<option value=<?php echo 3600*24*30?>>һ��</option>
<option value=<?php echo 3600*24*365?>>һ��</option>
</select><input type="submit" value="��¼">
</td></tr>
</form>
<?php
}
else
{
	echo "<tr><td align=\"right\">";
	echo "��ӭ����";
	echo "<a href=userinfo.php>".$_COOKIE["login"]."</a>";
	echo "&nbsp;&nbsp;<a href=quit.php>�˳���¼</a>";
	echo "</td></tr>";
}
?>
</table>
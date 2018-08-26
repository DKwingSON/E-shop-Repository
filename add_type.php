<?php
echo "<center>";
if(!$_COOKIE["login"])
{
	echo "您还没有登录！<p>";
	echo "请以管理员身份<a href=login.php>登录</a>，再执行该页面！";
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
		echo "您没有权限执行该页面！<p>";
		echo "请以管理员身份<a href=login.php>登录</a>，再执行该页面！";
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
		alert("请输入类别名称！");
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
mini商城系统添加类别<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">添加类别信息</td>
</tr>
<tr>
<td>添加类别名称</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>添加类别介绍</td>
<td><input type=text name="description"></td>
</tr>
<tr>
<td colspan=2 align="center"><input type="submit" value="添加"></td>
</tr>
</form>
</table>
<?php
		}
		else
		{
			$name=$_POST["name"];				//获取类别名称
			if($_POST["description"]!="")
			{
				$description=$_POST["description"];	//获取类别介绍
			}
			else
			{
				$description="暂无介绍";
			}
			$sql="SELECT count(*) FROM $my_type WHERE name='$name'";
			$re=mysql_query($sql,$my_conn) or die(mysql_error());
			$count=mysql_fetch_row($re);
			if($count[0]>0)
			{
				echo "已经存在同名类别<p>";
				echo "点<a href=add_type.php>这里</a>重新添加类别";
			}
			else
			{
				$sql="INSERT INTO $my_type(name,description)values('$name','$description')";
				$re=mysql_query($sql,$my_conn) or die(mysql_error());
				if($re)
				{
					echo "成功添加类别：".$name."<p>";
					echo "点<a href=show.php>这里</a>查看";
				}
			}

		}
	}
}
echo "</center>";
?>
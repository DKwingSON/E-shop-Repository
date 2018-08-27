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
		alert("请输入商品名称！");
		f.name.focus();
		return (false);
	}
	if(f.cost.value == "")
	{
		alert("请输入商品价格！");
		f.cost.focus();
		return (false);
	}
	if(f.num.value == "")
	{
		alert("请输入商品数量！");
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
mini商城系统添加商品<p>
<table  border="1" cellspacing="0" cellpadding="1" bordercolordark="#ffffff" bordercolorlight="#0000ff" width="300">
<form method=post action="<?php $_SERVER["PHP_SELF"]?>"  onsubmit="return check(this)">
<tr>
<td colspan=2 bgcolor="#ccccff" align="center">添加商品信息</td>
</tr>
<tr>
<td>添加商品名称</td>
<td><input type=text name="name"></td>
</tr>
<tr>
<td>商品所属类别</td>
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
<td>添加商品价格</td>
<td><input type=text name="cost"></td>
</tr>
<tr>
<td>添加商品数量</td>
<td><input type=text name="num"></td>
</tr>
<tr>
<td>添加商品介绍</td>
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
			$type=$_POST["type"];
			$cost=$_POST["cost"];
			$num=$_POST["num"];
			if($_POST["description"]!="")
			{
				$description=$_POST["description"];	//获取类别介绍
			}
			else
			{
				$description="暂无介绍";
			}
			$sql="UPDATE $my_type SET num=num+'$num' WHERE id='$type'";
			mysql_query($sql,$my_conn) or die(mysql_error());				//更新类别数量
			$sql="INSERT INTO $my_goods(name,type,cost,num,description)values('$name','$type','$cost','$num','$description')";
			$re=mysql_query($sql,$my_conn) or die(mysql_error());
			if($re)
			{
				echo "成功添加商品：".$name."<p>";
				echo "点<a href=show.php>这里</a>查看<p>";
				echo "点<a href=add_goods.php>这里</a>继续添加";
			}
		}
	}
}
echo "</center>";
?>
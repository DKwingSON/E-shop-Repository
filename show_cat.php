<?php
echo " <style type=\"text/css\">
 <!--
 tr,td{font-size:10pt}
 -->
 </style>";
echo "<center>\n";
if(!$_POST[mycat])
{
	include "config.php";
	echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">\n";
	echo "<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\" >\n";
	echo "<input type=\"hidden\" name=\"mycat\" value=\"post\">";
	echo "<tr>\n";
	echo "<td colspan=\"4\"><center><h2>您的购物车信息</h2></center></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>选择</td>\n";
	echo "<td>名称</td>\n";
	echo "<td>单价</td>\n";
	echo "<td>数量</td>\n";
	echo "</tr>\n";
	$temp=array_keys($_COOKIE);
	$j=0;
	for($i=0;$i<count($temp);$i++)
	{
		if(ereg("cat",$temp[$i]))
		{
			$catid=ereg_replace("cat","",$temp[$i]);
			$sql="select * from $my_goods where id='$catid'";
			$result=mysql_query($sql,$my_conn);
			$rows=mysql_fetch_array($result);
			echo "<input type=\"hidden\" name=\"id[]\" value=\"".$rows[id]."\">\n";
			echo "<input type=\"hidden\" name=\"type[]\" value=\"".$rows[type]."\">\n";
			echo "<tr>\n";
			echo "<td><input type=\"checkbox\" name=\"c[".$j."]\" value=\"".$rows[name]."\"></td>\n";
			echo "<td>".$rows[name]."</td>\n";
			echo "<td><input type=\"text\" value=\"".$rows[cost]."\" name=\"m[]\" readonly enable=false size=\"5\"></td>\n";
			echo "<td>";
			echo "<select name= \"t[]\" size=\"1\">";
			for($cc=1;$cc<($rows["num"]+1);$cc++)
			{
				echo "<option value=".$cc.">".$cc."</option>";
			}
			echo "</select>";
			echo "</td>\n";
			echo "</tr>\n";
			$j++;
		}
	}
	echo "<tr>\n";
	echo "<td colspan=\"4\"><center>";
	echo "<input type=\"submit\" value=\"生成订单\">";
	echo "<input type=\"button\" value=\"继续购物\" onclick=window.close()>";
	echo "</center></td>\n";
	echo "</tr>\n";
	echo "</form>";
	echo "</table>";
}
else
{
	$id=$_POST[id];
	$m=$_POST[m];
	$t=$_POST[t];
	$c=$_POST[c];
	$type=$_POST[type];
	$time=date("Y年m月d日");
	if(count($c)==0)
	{
		echo "你没有选择任何商品！<p>";
		echo "<input type=button value=重新选择 onclick=history.go(-1)>";
	}
	else
	{
		require "config.php";
		$sql="insert into $my_sales(sale_goods_id,sale_goods_num,sale_user_name,sale_cost,sale_date) values";
		echo "<table  border=\"1\" cellspacing=\"0\" cellpadding=\"1\" bordercolordark=\"#ffffff\" bordercolorlight=\"#0000ff\" width=\"80%\">\n";
		echo "<tr><td colspan=\"4\"><center>您选购了以下商品:</center></td></tr>";
		echo "<tr>";
		echo "<td>名称</td>";
		echo "<td>单价</td>";
		echo "<td>数量</td>";
		echo "<td>小计</td>";
		echo "</tr>";
		$i=0;
		foreach($c as $key=>$value)
		{
			$temp=$id[$key];
			$temp2=$m[$key];
			$temp3=$t[$key];
			$temp4=$type[$key];
			$update="UPDATE $my_goods,$my_type set $my_goods.num=$my_goods.num-$temp3,$my_type.num=$my_type.num-$temp3 WHERE $my_goods.id=$temp and $my_type.id=$temp4";
			mysql_query($update) or die(mysql_error());
			echo "<tr>";
			echo "<td>".$value."</td>";
			echo "<td>".$temp2."</td>";
			echo "<td>".$temp3."</td>";
			$z[$i]=($temp2*$temp3);
			$sql=$sql."('$temp','$temp3','$_COOKIE[login]','$z[$i]','$time')";
			if($i<count($c)-1)
			{
				$sql=$sql.",";
			}
			echo "<td>".$z[$i]."</td>";
			echo "</tr>";
			$i++;
		}
		$s=array_sum($z);
		echo "<tr><td colspan=\"4\"><center>总计:".$s."</center></td></tr>";
		$re=mysql_query($sql);
		if($re)
		{
			echo "<tr><td colspan=\"4\"><center>已经生成订单,点<input type=\"button\" value=\"这里结束操作\" onclick=window.close()></center></td></tr>";
		}
		else
		{
			echo "<tr><td colspan=\"4\"><center>生成订单错误,点<input type=\"button\" value=\"这里结束操作\" onclick=window.close()></center></td></tr>";
		}
		echo "</table>";
	}
}
?>
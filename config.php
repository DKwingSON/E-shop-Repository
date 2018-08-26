<?php
$host_name="localhost";									//服务器名
$host_user="root";										//连接服务器的用户名
$host_pass="qwe7989199@asd";					        //连接服务器的密码


//WXH的库
$db_name="eshop";										//服务器上的可用数据库
$my_user="users";									//用户表名称
//$my_type="mini_type";									//商品类型表名称
//$my_goods="mini_goods";									//商品内容表名称
$my_sales="mini_sales";									//订单表名称
$my_conn=mysql_connect($host_name,$host_user,$host_pass);	//连接服务器

//WYL的库
$_dbName="eshop";//服务器数据空间
$_supplier="SUPPLIER_TABLE";//供货商用户名与密码
$_supply="SUPPLY_TABLE";//供货表
$_goods="GOODS_TABLE";//货物信息表
$_orders="ORDERS_TABLE";//订单表
$_address="ADDRESS_TABLE";//地址表
mysql_select_db($db_name,$my_conn);						//选择操作的数据库
mysql_query("SET NAMES GB2312");						//设置编码
?>

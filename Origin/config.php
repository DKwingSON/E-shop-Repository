<?php
$host_name="localhost";									//��������
$host_user="root";										//���ӷ��������û���
$host_pass="qwe7989199@asd";					        //���ӷ�����������


//WXH�Ŀ�
$db_name="eshop";										//�������ϵĿ������ݿ�
$my_user="users";									//�û�������
//$my_type="mini_type";									//��Ʒ���ͱ�����
//$my_goods="mini_goods";									//��Ʒ���ݱ�����
$my_sales="mini_sales";									//����������
$my_conn=mysql_connect($host_name,$host_user,$host_pass);	//���ӷ�����

//WYL�Ŀ�
$_dbName="eshop";//���������ݿռ�
$_supplier="SUPPLIER_TABLE";//�������û���������
$_supply="SUPPLY_TABLE";//������
$_goods="GOODS_TABLE";//������Ϣ��
$_orders="ORDERS_TABLE";//������
$_address="ADDRESS_TABLE";//��ַ��
mysql_select_db($db_name,$my_conn);						//ѡ����������ݿ�
mysql_query("SET NAMES GB2312");						//���ñ���
?>

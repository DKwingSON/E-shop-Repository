<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>王予亮的测试页面</title>
</head>
<body>

<?php
echo "Entering in ";
date_default_timezone_get("PRC");
// 打印当前时间  PHP_EOL 换行符，兼容不同系统
echo date("Y-m-d H:i:s")  . PHP_EOL;
// echo date("Y 年 m 月 d 日 H 点 i 分 s 秒")  . PHP_EOL;
// 指定时间
$time = strtotime("2018-01-18 08:08:08");  // 将指定日期转成时间戳 
#echo date("Y-m-d H:i:s", $time)  . PHP_EOL;
?>

</body>
</html>
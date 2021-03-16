<?php
header("Content-type:text/html;charset=utf-8");  
$ip = $_GET['ip'];
$host = '';
$port = '3306';
$user = '';
$password = '';
$database = '';
$con = mysql_connect($host.':'.$port,$user,$password);
mysql_query("SET NAMES 'UTF8'");
mysql_select_db($database,$con);
$query = "truncate ip";
$result = mysql_query($query,$con);
$query = "insert into ip(addr) values(\"".$ip."\")";
$result = mysql_query($query,$con);
if ($result)
echo "ddns: IP:".$ip.", Update succeed";
else
echo "ddns: IP:".$ip." Update failed";
mysql_free_result($result);
mysql_close($con);
?>
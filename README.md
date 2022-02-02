---

## 到github

把python文件放到crontab -e中定时运行，注意是绝对路径


## 路由器上，at router

/etc/storage/ddns.sh

<!-- more -->

``` bash
#!/bin/bash
newip=$(ifconfig ppp0|grep inet|awk '{print $2}'|awk -F ':' '{print $2}')
oldip=$(cat /tmp/lastIP)
if [ $oldip == $newip ];then
        logger "ddns: IP:"$oldip",IP has not changed"
        echo "ddns: IP:"$oldip",IP has not changed"
else
        info=$(curl http://andi.press/ebook/ddns.php?ip=$newip:10090 -s)
        echo $newip > /tmp/lastIP
        logger $info
        echo $info
fi
```

运行命令
``` bash
chmod +x /etc/storage/ddns.sh
crontab -e
0 * * * * /etc/storage/ddns.sh
```

## 服务器上，at server

ddns.php

``` php
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
```

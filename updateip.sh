#!/bin/bash

curl ifconfig.me > /andy/github/myddns/ip
oldip=$(cat /andy/github/myddns/oldip)
ip=$(cat /andy/github/myddns/ip)
#echo $ip
#echo $oldip
if [ "$oldip" = "$ip" ];then
	echo "ip not changed"
else
	echo "ip changed"
	git commit -m "changed ip" ip
	git push origin master
fi
cp /andy/github/myddns/ip /andy/github/myddns/oldip

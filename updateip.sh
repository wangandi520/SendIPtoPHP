#!/bin/bash
myip=$(cat /andy/github/myddns/ip)
echo $myip
git add /andy/github/myddns/ip
git commit -m "changed ip"
git push origin master

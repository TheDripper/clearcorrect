#!/bin/sh
# exec 3>&1 4>&2
# trap 'exec 2>&4 1>&3' 0 1 2 3
# sudo exec 1>log.out 2>&1
echo "SEARCH AND REPLACE"
# echo $1
# echo `ls $1_remote_local` | tr " " "\n"
# gunzip "./$1_remote_local/wp_cbxmarketing.sql"
find . -name '*.sql' -print0 | xargs -0 sed -i "" "s/http:\/\/localhost:9009/http:\/\/ec2-18-144-32-142\.us-west-1\.compute\.amazonaws\.com/g"
find . -name '*.sql' -print0 | xargs -0 sed -i "" "s/http:\/\/localhost:4000/http:\/\/ec2-18-144-32-142\.us-west-1\.compute\.amazonaws\.com/g"
# docker exec -i cbx_db_1 /usr/bin/mysql -u root -pasdf $1 < $1_remote_local/wp_cbxmarketing.sql
echo "SUCCESS"
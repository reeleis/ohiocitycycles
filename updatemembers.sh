#!/bin/sh

# do stuff here
echo "Memberships that expired today:"
mysql -u ocbc_mysql_root -p'f^&f,9asd*' -h mysql.ocbc.dreamhosters.com ohiocity_joomla < /home/ohiocity/www/ohiocitycycles.org/update_member_status.sql

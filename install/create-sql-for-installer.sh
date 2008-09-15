#!/bin/bash

# create sql files for installer
cd `dirname $0`

cd ../setup/sql/MySQL4.1/install
cat install-mynets-create-mysql41.sql install-mynets-insert_data.sql \
 > ../../../../install/sql/v41.sql

cd ../../MySQL4.0/install
cat install-mynets-create-mysql40.sql install-mynets-insert_data.sql \
 > ../../../../install/sql/v40.sql


# copy convert scripts
cd ../../../..
cp setup/sql/MySQL4.1/convert/OpenPNE2Usagi_Upgrade4ashiato_count.php \
   setup/sql/MySQL4.0/convert/OpenPNE2Usagi_Upgrade4ashiato_count.php
cp setup/sql/MySQL4.1/convert/OpenPNE2Usagi_Upgrade4diary_comment_count.php \
   setup/sql/MySQL4.0/convert/OpenPNE2Usagi_Upgrade4diary_comment_count.php
cp setup/sql/MySQL4.1/convert/diary_comment_no_convert.php \
   setup/sql/MySQL4.0/convert/diary_comment_no_convert.php
cp setup/sql/MySQL4.1/convert/topic_update_convert.php \
   setup/sql/MySQL4.0/convert/topic_update_convert.php

cp setup/sql/MySQL4.1/convert/diary_comment_no_convert.php \
   setup/sql/MySQL4.0/upgrade/diary_comment_no_convert.php
cp setup/sql/MySQL4.1/convert/topic_update_convert.php \
   setup/sql/MySQL4.0/upgrade/topic_update_convert.php

cp setup/sql/MySQL4.1/convert/diary_comment_no_convert.php \
   setup/sql/MySQL4.1/upgrade/diary_comment_no_convert.php
cp setup/sql/MySQL4.1/convert/topic_update_convert.php \
   setup/sql/MySQL4.1/upgrade/topic_update_convert.php
 

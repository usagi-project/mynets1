#!/bin/bash

# create sql files for installer

cd ./setup/sql/MySQL4.1/install
cat install-mynets-create-mysql41.sql install-mynets-insert_data.sql \
 > ./../../../../install/sql/v41.sql

cd ./../../MySQL4.0/install
cat install-mynets-create-mysql40.sql install-mynets-insert_data.sql \
 > ./../../../../install/sql/v40.sql


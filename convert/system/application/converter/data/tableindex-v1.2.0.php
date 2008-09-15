<?php
//カラムの修正、追加テーブルの一覧と、そのSQL
//実行はCREATEの前に行うこと。
$tableindexlist = array(
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_commu_topic",
                'column' => "e_datetime",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_commu_topic` ADD INDEX `e_datetime` (`e_datetime`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_image",
                'column' => "r_datetime",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_image` ADD INDEX `r_datetime` (`r_datetime`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_diary",
                'column' => "e_datetime",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_diary` ADD INDEX `e_datetime` (`c_member_id`,`e_datetime`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_access_log",
                'column' => "target_c_commu",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_access_log` ADD INDEX `target_commu` (`target_c_commu_id`,`r_datetime`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_access_log",
                'column' => "target_commu_topic",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_access_log` ADD INDEX `target_commu_topic` (`target_c_commu_topic_id`,`r_datetime`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_access_log",
                'column' => "page_name",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_access_log` ADD INDEX `pagename` (`page_name`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_image",
                'column' => "c_member_id",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_image` ADD INDEX `c_member_id` (`c_member_id`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_one_word",
                'column' => "c_one_word_id_to",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_one_word` ADD INDEX `c_one_word_id_to` (`c_one_word_id_to`);",
                        ),
             ),
            array('action' => 'ADD INDEX',
            'data' => array(
                'name' => "c_admin_information",
                'column' => "r_datetime",
                'sql' => "ALTER TABLE `".MYNETS_PREFIX_NAME."c_admin_information` ADD INDEX `r_datetime_view_date` (`r_datetime`,`view_date`);",
                        ),
             ),
);

?>

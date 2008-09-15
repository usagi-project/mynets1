<?php
//削除されたテーブルの一覧と、そのSQL
//実行はCREATEの前に行うこと。
$tabledroplist = array(
    //'c_admin_information' => array(
    //            'sql' => "DROP TABLE IF EXISTS `" .MYNETS_PREFIX_NAME. "c_admin_information`;",
    //        ),

    'c_diary_tag' => array(
                'sql' => "DROP TABLE IF EXISTS `" .MYNETS_PREFIX_NAME. "c_diary_tag`;",
            ),
    'c_review_category' => array(
                'sql' => "DROP TABLE IF EXISTS `" .MYNETS_PREFIX_NAME. "c_review_category`;"
            ),
    'c_applause_point' => array(
                'sql' => "DROP TABLE IF EXISTS `" .MYNETS_PREFIX_NAME. "c_applause_point`;"
            ),
);

?>

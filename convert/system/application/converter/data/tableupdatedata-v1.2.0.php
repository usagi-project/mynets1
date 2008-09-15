<?php
//データを追加するテーブルの一覧と、そのSQL
//実行はカラムがあるかどうかを判定してから行う
$tableupdatedatalist = array(
            array('action' => 'UPDATE',
            'data' => array(
                "name" => "c_review_category",
                "columnname" => "category_disp",
                "columndata" => "キッチン",
                "wherecolumn" => "c_review_category_id",
                "wheredata" => 9,
                "sql" => "UPDATE `".MYNETS_PREFIX_NAME."c_review_category` SET `category_disp` = 'キッチン',`category` = 'Kitchen' WHERE `c_review_category_id` = 9;",
                ),
            ),
);

?>

<?php
/**
 * Usagi Project 1.2.0から1.2.1への絵文字コンバート処理
 *
 *
 */

set_time_limit(0);
ini_set('memory_limit', '128M');
echo "Begin converter.\n";

require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

function convert_emoji_format_120_to_121($table, $field)
{
    $primary_key = $table . '_id';
    $sql = 'SELECT ' . $primary_key . ',' . $field . ' FROM ' . $table;
    $result = db_get_all($sql);

    foreach ($result as $value) {
        $old_field_value = mb_convert_encoding($value[$field], 'SJIS-win', 'UTF-8');
        $new_field_value = $old_field_value;

        // すべての絵文字を展開する
        $new_field_value = emoji_unescape($new_field_value, false);

        // 先にSoftBank絵文字のコンバート処理
        $GLOBALS['__Framework']['carrier'] = 's';
        $new_field_value = emoji_escape($new_field_value);
        $GLOBALS['__Framework']['carrier'] = '';

        // 他キャリア絵文字のコンバート処理
        $new_field_value = emoji_escape($new_field_value);

        // 絵文字をコンバートした場合
        if ($old_field_value !== $new_field_value) {
            $new_field_value = mb_convert_encoding($new_field_value, 'UTF-8', 'SJIS-win');
            $data = array($field => $new_field_value);
            $where = array($primary_key => $value[$primary_key]);
            db_update($table, $data, $where);
        }
    }
}

$target = array(
    'c_commu' => array('name', 'info',),
    'c_commu_admin_confirm' => array('message',),
    'c_commu_member_confirm' => array('message',),
    'c_commu_sub_admin_confirm' => array('message',),
    'c_commu_topic' => array('name', 'open_date_comment', 'open_pref_comment',),
    'c_commu_topic_comment' => array('body',),
    'c_diary' => array('subject', 'body',),
    'c_diary_comment' => array('body',),
    'c_friend' => array('intro',),
    'c_friend_confirm' => array('message',),
    'c_member' => array('nickname',),
    'c_member_pre' => array('nickname', 'c_password_query_answer',),
    'c_member_pre_profile' => array('value',),
    'c_member_profile' => array('value',),
    'c_message' => array('body', 'subject',),
    'c_searchlog' => array('searchword',),
    'c_one_word' => array('comment',),
    'c_tags' => array('c_tags_name',),
);

foreach ($target as $tablename => $fields) {
    foreach ($fields as $fieldname) {
        echo "Converting {$tablename}.{$fieldname}...";
        convert_emoji_format_120_to_121($tablename, $fieldname);
        echo "done.\n";
    }
}

echo "Finish converter.\n";

?>
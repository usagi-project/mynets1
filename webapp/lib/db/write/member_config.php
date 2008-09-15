<?php
/*
* PHP versions 4 and 5
*
* LICENSE: This source file is subject to version 3.0 of the PHP license
* that is available through the world-wide-web at the following URI:
* http://www.php.net/license/3_0.txt. If you did not receive a copy of
* the PHP License and are unable to obtain it through the web, please
* send a note to license@php.net so we can mail you a copy immediately.
*
* @package MEMBER
* @author shinji hyodo ＜shinji@hey-to.net＞
* @copyright 2006-2007 USAGI Project
* @license http://www.php.net/license/3_0.txt PHP License 3.0
* @link http://usagi.mynets.jp/
* @since usagi 1.0.0Nighty

*/

/**
 * メンバーの設定情報を保存
 *
 * @param int c_member_id
 * @param string tag
 * @param string value
 */
if (! function_exists('MEMBER_setMemberConfig'))
{
    function MEMBER_setMemberConfig($c_member_id, $tag, $value)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'tag' => $tag,
            'value' => ''
        );

        //エラーを無視してインサート
        db_insert('c_member_config', $data);

        //データの設定
        $data = array(
            'value' => $value
        );
        $where = array(
            'c_member_id' => intval($c_member_id),
            'tag' => $tag
        );
        return db_update('c_member_config', $data, $where);
    }
}
?>
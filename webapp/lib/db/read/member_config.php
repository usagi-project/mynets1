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
 * メンバーの設定情報を取得
 *
 * @param int c_member_id
 * @param string tag
 *
 * @return 設定情報
 */
if (! function_exists('MEMBER_getMemberConfig'))
{
    function MEMBER_getMemberConfig($c_member_id, $tag)
    {
        $sql = 'SELECT value FROM c_member_config WHERE c_member_id = ? AND tag = ?';
        $params = array(intval($c_member_id),$tag);
        $result = db_get_one($sql, $params);
        return $result;
    }
}

?>
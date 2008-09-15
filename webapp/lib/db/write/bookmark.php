<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

/**
 * お気に入り追加
 */
if (! function_exists('db_bookmark_insert_c_bookmark'))
{
    function db_bookmark_insert_c_bookmark($c_member_id_from, $c_member_id_to)
    {
        $data = array(
            'c_member_id_from' => intval($c_member_id_from),
            'c_member_id_to' => intval($c_member_id_to),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_bookmark', $data);
    }
}

/**
 * お気に入り削除
 */
if (! function_exists('db_bookmark_delete_c_bookmark'))
{
    function db_bookmark_delete_c_bookmark($c_member_id_from, $c_member_id_to)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_bookmark' .
                ' WHERE c_member_id_from = ? AND c_member_id_to = ?';
        $params = array(intval($c_member_id_from), intval($c_member_id_to));
        db_query($sql, $params);
    }
}

?>

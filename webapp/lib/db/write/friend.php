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

//--- c_friend

/**
 * フレンドリンクを追加
 */
if (! function_exists('db_friend_insert_c_friend'))
{
    function db_friend_insert_c_friend($c_member_id_from, $c_member_id_to)
    {
        if (($c_member_id_from < 1) || ($c_member_id_to < 1))
            return false;

        if (db_friend_is_friend($c_member_id_from, $c_member_id_to))
            return false;

        $data = array(
            'c_member_id_from' => intval($c_member_id_from),
            'c_member_id_to' => intval($c_member_id_to),
            'r_datetime' => db_now(),
        );
        db_insert(MYNETS_PREFIX_NAME . 'c_friend', $data);

        $data = array(
            'c_member_id_from' => intval($c_member_id_to),
            'c_member_id_to' => intval($c_member_id_from),
            'r_datetime' => db_now(),
        );
        db_insert(MYNETS_PREFIX_NAME . 'c_friend', $data);
    }
}

/**
 * リンク申請からフレンドリンクを追加
 *
 * @param   int $c_friend_confirm_id
 * @param   int $u  自分のc_member_id
 */
if (! function_exists('db_friend_insert_c_friend4confirm'))
{
    function db_friend_insert_c_friend4confirm($c_friend_confirm_id, $u)
    {
        $confirm = _do_c_friend_confirm4c_friend_confirm_id($c_friend_confirm_id);
        if ($confirm['c_member_id_to'] != $u) {
            return false;
        }
        $c_member_id_from = $confirm['c_member_id_from'];
        $c_member_id_to   = $confirm['c_member_id_to'];

        // フレンドリンクを追加
        db_friend_insert_c_friend($c_member_id_from, $c_member_id_to);

        // フレンド申請を削除
        db_friend_delete_c_friend_confirm($c_friend_confirm_id, $u);
        return true;
    }
}

/**
 * フレンドリンクを削除
 */
if (! function_exists('db_friend_delete_c_friend'))
{
    function db_friend_delete_c_friend($c_member_id_from, $c_member_id_to)
    {

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_friend' .
                ' WHERE (c_member_id_from = ? AND c_member_id_to = ?)' .
                   ' OR (c_member_id_to = ? AND c_member_id_from = ?)';
        $params = array(
            intval($c_member_id_from), intval($c_member_id_to),
            intval($c_member_id_from), intval($c_member_id_to));
        db_query($sql, $params);
    }
}

/**
 * フレンド紹介文入力・編集
 */
if (! function_exists('db_friend_update_c_friend_intro'))
{
    function db_friend_update_c_friend_intro($c_member_id_from, $c_member_id_to, $intro)
    {
        $data = array(
            'intro' => $intro,
            'r_datetime_intro' => db_now(),
        );
        $where = array(
            'c_member_id_from' => intval($c_member_id_from),
            'c_member_id_to' => intval($c_member_id_to),
        );
        db_update(MYNETS_PREFIX_NAME . 'c_friend', $data, $where);
    }
}

//--- c_friend_confirm

/**
 * フレンド申請を追加
 *
 * @param  int    $c_member_id_from
 * @param  int    $c_member_id_to
 * @param  string $message
 * @return int insert_id
 */
if (! function_exists('db_friend_insert_c_friend_confirm'))
{
    function db_friend_insert_c_friend_confirm($c_member_id_from, $c_member_id_to, $message)
    {
        $data = array(
            'c_member_id_from' => intval($c_member_id_from),
            'c_member_id_to'   => intval($c_member_id_to),
            'message'          => $message,
            'r_datetime'       => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_friend_confirm', $data);
    }
}

/**
 * フレンド申請を削除
 *
 * @param  int  $c_friend_confirm_id
 * @param  int  $u 自分のc_member_id
 */
if (! function_exists('db_friend_delete_c_friend_confirm'))
{
    function db_friend_delete_c_friend_confirm($c_friend_confirm_id, $u)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_friend_confirm WHERE c_friend_confirm_id = ?' .
                ' AND (c_member_id_from = ? OR c_member_id_to = ?)';
        $params = array(intval($c_friend_confirm_id), intval($u), intval($u));
        db_query($sql, $params);
    }
}

?>

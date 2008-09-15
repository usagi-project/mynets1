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

if (! function_exists('do_h_schedule_add_insert_c_schedule'))
{
    function do_h_schedule_add_insert_c_schedule(
        $c_member_id, $title, $body,
        $start_date, $start_time,
        $end_date, $end_time,
        $is_receive_mail)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'title' => $title,
            'body' => $body,
            'start_date' => $start_date,
            'start_time' => $start_time,
            'end_date' => $end_date,
            'end_time' => $end_time,
            'is_receive_mail' => (bool)$is_receive_mail,
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_schedule', $data);
    }
}

if (! function_exists('do_h_schedule_edit_update_c_schedule'))
{
    function do_h_schedule_edit_update_c_schedule(
        $c_member_id, $title, $body,
        $start_date, $start_time,
        $end_date, $end_time,
        $is_receive_mail,
        $c_schedule_id)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'title' => $title,
            'body' => $body,
            'start_date' => $start_date,
            'start_time' => $start_time,
            'end_date' => $end_date,
            'end_time' => $end_time,
            'is_receive_mail' => (bool)$is_receive_mail,
        );
        $where = array('c_schedule_id' => intval($c_schedule_id));
        return db_update(MYNETS_PREFIX_NAME . 'c_schedule', $data, $where);
    }
}

if (! function_exists('do_h_schedule_delte_delete_c_schedule4c_schedule_id'))
{
    function do_h_schedule_delte_delete_c_schedule4c_schedule_id($c_schedule_id)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_schedule WHERE c_schedule_id = ?';
        $params = array(intval($c_schedule_id));
        return db_query($sql, $params);
    }
}

?>

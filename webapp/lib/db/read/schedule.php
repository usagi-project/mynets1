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

if (! function_exists('p_h_calendar_c_schedule_list4date'))
{
    function p_h_calendar_c_schedule_list4date($year, $month, $day, $c_member_id)
    {
        $date = sprintf('%04d-%02d-%02d', $year, $month, $day);

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_schedule WHERE c_member_id = ?' .
                ' AND start_date <= ? AND end_date >= ?';
        $params = array(intval($c_member_id), $date, $date);
        return db_get_all($sql, $params);
    }
}

if (! function_exists('p_common_c_schedule4c_schedule_id'))
{
    function p_common_c_schedule4c_schedule_id($c_schedule_id)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_schedule WHERE c_schedule_id = ?';
        return db_get_row($sql, array(intval($c_schedule_id)));
    }
}

if (! function_exists('p_h_calendar_birth4c_member_id'))
{
    function p_h_calendar_birth4c_member_id($month, $c_member_id)
    {
        $ids = db_friend_c_member_id_list($c_member_id);
        $ids[] = $c_member_id;
        $ids = implode(', ', $ids);

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_member' .
            ' WHERE c_member_id IN ('. $ids . ')' .
            ' AND birth_month = ?';
        $params = array(intval($month));
        $list = db_get_all($sql, $params);

        $res = array();
        foreach ($list as $item) {
            $day = intval($item['birth_day']);
            $res[$day][] = $item;
        }
        return $res;
    }
}

if (! function_exists('p_h_calendar_event4c_member_id'))
{
    function p_h_calendar_event4c_member_id($year, $month, $c_member_id)
    {
        $sql = 'SELECT c_commu_id FROM ' . MYNETS_PREFIX_NAME . 'c_commu_member WHERE c_member_id = ?';
        $params = array(intval($c_member_id));
        $ids = db_get_col($sql, $params);
        $ids = implode(', ', $ids);
        if (!$ids) {
            return array();
        }

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic WHERE c_commu_id IN ('.$ids.')' .
                ' AND event_flag = 1 AND open_date > ? AND open_date <= ?';
        $params = array(
            sprintf('%04d-%02d', intval($year), intval($month)) . '-00',
            sprintf('%04d-%02d', intval($year), intval($month)) . '-31'
        );
        $list = db_get_all($sql, $params);

        $res = array();
        foreach ($list as $item) {
            $item['is_join'] = p_common_is_c_event_member($item['c_commu_topic_id'], $c_member_id);

            $day = date('j', strtotime($item['open_date']));
            $res[$day][] = $item;
        }
        return $res;
    }
}

if (! function_exists('db_schedule_c_member_list4mail'))
{
    function db_schedule_c_member_list4mail()
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_schedule WHERE start_date = ? AND is_receive_mail = 1';
        $params = array(date('Y-m-d'));
        return db_get_all($sql, $params);
    }
}

//KTAIƒJƒŒƒ“ƒ_[
if (! function_exists('p_h_calendar_c_schedule_list_count4date'))
{
    function p_h_calendar_c_schedule_list_count4date($year, $month, $day, $c_member_id)
    {
        $date = sprintf('%04d-%02d-%02d', $year, $month, $day);

        $sql = 'SELECT COUNT(*) AS count FROM ' . MYNETS_PREFIX_NAME . 'c_schedule WHERE c_member_id = ?' .
                ' AND start_date <= ? AND end_date >= ?';
        $params = array(intval($c_member_id), $date, $date);
        return db_get_one($sql, $params);
    }
}

if (! function_exists('p_h_calendar_c_schedule_list'))
{
    function p_h_calendar_c_schedule_list($c_member_id)
    {
        $sql = 'SELECT * FROM c_schedule WHERE '
                 . MYNETS_PREFIX_NAME . 'c_member_id = ? ORDER BY start_date, start_time';
        $params = array(intval($c_member_id));
        return db_get_all($sql, $params);
    }
}

if (! function_exists('p_h_home_event_list_count4c_member_id'))
{
    function p_h_home_event_list_count4c_member_id($year, $month, $day, $c_member_id)
    {
        $sql = 'SELECT c_commu_id FROM ' . MYNETS_PREFIX_NAME . 'c_commu_member WHERE c_member_id = ?';
        $params = array(intval($c_member_id));
        $ids = db_get_col($sql, $params);
        $ids = implode(", ", $ids);
        if (!$ids) {
            return array();
        }
        $today = sprintf("%04d-%02d-%02d", $year, $month, $day);
        $sql = "SELECT count(*) as count FROM " . MYNETS_PREFIX_NAME . "c_commu_topic" .
            " WHERE c_commu_id IN ($ids)" .
            " AND event_flag = 1" .
            " AND open_date = ?";
        $params = array($today);
        $list = db_get_one($sql, $params);

        return $list;
    }
}
?>

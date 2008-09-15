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


if (! function_exists('p_h_home_h_blog_list_friend4c_member_id'))
{
    function p_h_home_h_blog_list_friend4c_member_id($c_member_id, $page_size = 5)
    {
        $sql = "SELECT " . MYNETS_PREFIX_NAME . "c_rss_cache.*, "
                         . MYNETS_PREFIX_NAME . "c_member.nickname" .
            " FROM " . MYNETS_PREFIX_NAME . "c_rss_cache, "
                     . MYNETS_PREFIX_NAME . "c_member" .
            " WHERE " . MYNETS_PREFIX_NAME . "c_member.c_member_id = "
                     . MYNETS_PREFIX_NAME . "c_rss_cache.c_member_id" .
               " AND " . MYNETS_PREFIX_NAME . "c_rss_cache.c_member_id = ?" .
            " ORDER BY " . MYNETS_PREFIX_NAME . "c_rss_cache.r_datetime DESC";
        $params = array(intval($c_member_id));
        return db_get_all_limit($sql, 0, $page_size, $params);
    }
}

if (! function_exists('p_h_diary_list_all_c_rss_cache_list'))
{
    function p_h_diary_list_all_c_rss_cache_list($limit)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache ORDER BY r_datetime DESC';
        $lst = db_get_all_limit($sql, 0, $limit);

        foreach ($lst as $key => $value) {
            $lst[$key]['c_member'] = db_common_c_member4c_member_id($value['c_member_id']);
        }
        return $lst;
    }
}

if (! function_exists('p_h_diary_list_friend_c_rss_cache_list'))
{
    function p_h_diary_list_friend_c_rss_cache_list($c_member_id, $limit)
    {
        $friends = db_friend_c_member_id_list($c_member_id, true);
        $ids = implode(',', array_map('intval', $friends));

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache' .
                ' WHERE c_member_id IN (' . $ids . ')' .
                ' ORDER BY r_datetime DESC';
        $list = db_get_all_limit($sql, 0, $limit);

        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        }
        return $list;
    }
}

if (! function_exists('p_fh_diary_list_c_rss_cache_list'))
{
    function p_fh_diary_list_c_rss_cache_list($c_member_id,$page_size, $page)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache '
               . 'WHERE c_member_id = ? ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id));
        $lst = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($lst as $key => $value) {
            $lst[$key]['c_member'] = db_common_c_member4c_member_id($value['c_member_id']);
        }
        return $lst;
    }
}

if (! function_exists('p_fh_diary_list_c_rss_cache_list_date'))
{
    function p_fh_diary_list_c_rss_cache_list_date($c_member_id, $year, $month, $day=0)
    {
        if ($day) {
            $s_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year));
            $e_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day+1, $year));
        } else {
            $s_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, 1, $year));
            $e_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month+1, 1, $year));
        }
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache WHERE c_member_id = ?' .
                ' AND r_datetime >= ? AND r_datetime < ?' .
                ' ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id), $s_date, $e_date);
        $lst = db_get_all($sql, $params);

        foreach ($lst as $key => $value) {
            $lst[$key]['c_member'] = db_common_c_member4c_member_id($value['c_member_id']);
        }
        return $lst;
    }
}

if (! function_exists('p_f_home_c_rss_cache_list4c_member_id'))
{
    function p_f_home_c_rss_cache_list4c_member_id($c_member_id, $limit = 5)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache '
              . 'WHERE c_member_id = ? ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id));
        return db_get_all_limit($sql, 0, $limit, $params);
    }
}

if (! function_exists('db_is_duplicated_rss_cache'))
{
    function db_is_duplicated_rss_cache($c_member_id, $date, $link)
    {
        $sql = 'SELECT c_rss_cache_id FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache' .
                ' WHERE c_member_id = ? AND r_datetime = ? AND link = ?';
        $params = array(intval($c_member_id), $date, $link);
        return (bool)db_get_one($sql, $params);
    }
}

if (! function_exists('db_is_updated_rss_cache'))
{
    function db_is_updated_rss_cache($c_member_id, $link)
    {
        $sql = 'SELECT c_rss_cache_id FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache' .
                ' WHERE c_member_id = ? AND link = ?';
        $params = array(intval($c_member_id), $link);
        return db_get_one($sql, $params);
    }
}

if (! function_exists('db_is_future_rss_item'))
{
    function db_is_future_rss_item($date)
    {
        $item_timestamp = strtotime($date);
        return (bool)($item_timestamp > time());
    }
}

?>

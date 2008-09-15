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


// 前日のアクセスランキング
if (! function_exists('p_h_ranking_c_ashiato_ranking'))
{
    function p_h_ranking_c_ashiato_ranking($limit = 10)
    {
        $today = date('Y-m-d 00:00:00');
        $yesterday = date('Y-m-d 00:00:00', strtotime('-1 day'));

        $sql = 'SELECT c_member_id_to AS c_member_id, COUNT(*) AS count' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_ashiato' .
            ' WHERE r_datetime >= ? AND r_datetime < ?' .
            ' GROUP BY c_member_id_to' .
            ' ORDER BY count DESC';
        $params = array($yesterday, $today);
        return db_get_all_limit($sql, 0, $limit, $params);
    }
}

if (! function_exists('p_h_ranking_c_friend_ranking'))
{
    function p_h_ranking_c_friend_ranking($limit = 10)
    {
        $sql = 'SELECT c_member_id_to as c_member_id, count(*) as count' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_friend' .
            ' GROUP BY c_member_id_to' .
            ' ORDER BY count DESC';
        return db_get_all_limit($sql, 0, $limit);
    }
}

if (! function_exists('p_h_ranking_c_commu_member_ranking'))
{
    function p_h_ranking_c_commu_member_ranking($limit = 10)
    {
        $sql = 'SELECT c_commu_id, count(*) as count' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_member' .
            ' GROUP BY c_commu_id' .
            ' ORDER BY count DESC';
        return db_get_all_limit($sql, 0, $limit);
    }
}

// 前日のランキング
if (! function_exists('p_h_ranking_c_commu_topic_comment_ranking'))
{
    function p_h_ranking_c_commu_topic_comment_ranking($limit = 10)
    {
        $today = date('Y-m-d 00:00:00');
        $yesterday = date('Y-m-d 00:00:00', strtotime('-1 day'));

        $sql = 'SELECT c_commu_id, count(*) as count' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment' .
            ' WHERE r_datetime >= ? AND r_datetime < ?' .
            ' GROUP BY c_commu_id' .
            ' ORDER BY count DESC';
        $params = array($yesterday, $today);
        return db_get_all_limit($sql, 0, $limit, $params);
    }
}

?>

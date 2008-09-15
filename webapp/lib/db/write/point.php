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

if (! function_exists('db_point_insert_log'))
{
    function db_point_insert_log($c_member_id, $point, $memo)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'point' => intval($point),
            'memo' => strval($memo),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_point_log', $data);
    }
}

if (! function_exists('db_point_insert_tags'))
{
    function db_point_insert_tags($c_point_log_id, $tags)
    {
        $data = array(
            'c_point_log_id' => intval($c_point_log_id),
        );
        foreach ((array)$tags as $tag) {
            if ($tag) {
                $data['tag'] = strval($tag);
                db_insert(MYNETS_PREFIX_NAME . 'c_point_log_tag', $data);
            }
        }
    }
}

if (! function_exists('db_point_add_point'))
{
    function db_point_add_point($c_member_id, $point)
    {
        $sql = 'SELECT c_profile_id, public_flag_default FROM ' . MYNETS_PREFIX_NAME . 'c_profile WHERE name = \'PNE_POINT\'';
        if (!$c_profile = db_get_row($sql)) {
            return false;
        }
        $c_profile_id = $c_profile['c_profile_id'];
        $public_flag  = $c_profile['public_flag_default'];

        $sql = 'SELECT value FROM ' . MYNETS_PREFIX_NAME . 'c_member_profile WHERE c_member_id = ? AND c_profile_id = ?';
        $params = array(intval($c_member_id), intval($c_profile_id));
        $p = db_get_one($sql, $params);

        // ポイント加算
        $p = intval($p) + intval($point);

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_member_profile WHERE c_member_id = ? AND c_profile_id = ?';
        db_query($sql, $params);
        do_config_prof_insert_c_member_profile($c_member_id, $c_profile_id, 0, $p, $public_flag);

        return $p;
    }
}

?>

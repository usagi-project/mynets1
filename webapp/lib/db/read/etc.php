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
 * 管理画面用アカウントが存在するかどうか
 * setup が完了しているかどうかの判定に使う
 *
 * @return bool 存在するかどうか
 */
if (! function_exists('db_admin_user_exists'))
{
    function db_admin_user_exists()
    {
        $sql = 'SELECT c_admin_user_id FROM ' . MYNETS_PREFIX_NAME . 'c_admin_user';
        return (bool)db_get_one($sql);
    }
}

/**
 * 配色設定を取得
 */
if (! function_exists('db_select_c_sns_config'))
{
    function db_select_c_sns_config($target_id = 1)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_sns_config WHERE c_sns_config_id = ?';
        $params = array(intval($target_id));
        return db_get_row($sql, $params);
    }
}

/**
 * 配色設定を全て取得
 */
if (! function_exists('db_select_c_sns_config_all'))
{
    function db_select_c_sns_config_all()
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_sns_config';
        return db_get_all($sql);
    }
}

/**
 * siteadminを取得
 */
if (! function_exists('p_common_c_siteadmin4target_pagename'))
{
    function p_common_c_siteadmin4target_pagename($target_pagename)
    {
        $sql = 'SELECT body FROM ' . MYNETS_PREFIX_NAME . 'c_siteadmin WHERE target = ?';
        $params = array($target_pagename);
        return db_get_one($sql, $params);
    }
}

/**
 * 都道府県リストを取得
 */
if (! function_exists('p_regist_prof_c_profile_pref_list4null'))
{
    function p_regist_prof_c_profile_pref_list4null()
    {
        $sql = 'SELECT c_profile_pref_id, pref FROM ' . MYNETS_PREFIX_NAME . 'c_profile_pref' .
               ' ORDER BY sort_order';
        return db_get_assoc($sql);
    }
}

/**
 * 都道府県リスト(全データ)を取得
 */
if (! function_exists('db_etc_c_profile_pref_list'))
{
    function db_etc_c_profile_pref_list()
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_profile_pref ORDER BY sort_order';
        return db_get_all($sql);
    }
}

/**
 * IDから都道府県リスト(全データ)を取得
 */
if (! function_exists('db_etc_c_profile_pref4id'))
{
    function db_etc_c_profile_pref4id($c_profile_pref_id)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_profile_pref WHERE c_profile_pref_id = ?';
        $params = array(intval($c_profile_pref_id));
        return db_get_row($sql, $params);
    }
}

/**
 * 特定の緯度経度の都道府県を取得
 */
if (! function_exists('db_etc_c_profile_pref_id4latlng'))
{
    function db_etc_c_profile_pref_id4latlng($lat, $lng, $zoom)
    {
        if (!$lat || !$lng) {
            return false;
        }
        $sql = 'SELECT c_profile_pref_id FROM ' . MYNETS_PREFIX_NAME . 'c_profile_pref' .
            ' WHERE map_latitude = ? AND map_longitude = ? AND map_zoom = ?';
        $params = array($lat, $lng, intval($zoom));
        return db_get_one($sql, $params);
    }
}

/**
 * 秘密の質問を取得
 */
if (! function_exists('p_common_c_password_query4null'))
{
    function p_common_c_password_query4null()
    {
        $sql = 'SELECT c_password_query_id, c_password_query_question '
             . 'FROM ' . MYNETS_PREFIX_NAME . 'c_password_query';
        return db_get_assoc($sql);
    }
}


if (! function_exists('check_search_word'))
{
    function check_search_word($search_word)
    {
        $search_word = str_replace("_", "\_", $search_word);
        $search_word = str_replace("%", "\%", $search_word);
        return $search_word;
    }
}

//---

if (! function_exists('do_common_c_pc_address_pre4pc_address'))
{
    function do_common_c_pc_address_pre4pc_address($pc_address)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_pc_address_pre WHERE pc_address = ?';
        $params = array($pc_address);
        return db_get_row($sql, $params);
    }
}

if (! function_exists('do_common_c_pc_address_pre4sid'))
{
    function do_common_c_pc_address_pre4sid($sid)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_pc_address_pre WHERE session = ?';
        $params = array($sid);
        return db_get_row($sql, $params);
    }
}

/**
 * パスワードが正しいかどうか認証する
 *
 * @param int $c_member_id
 * @param string $password 平文のパスワード
 * @return bool パスワードが正しいかどうか
 */
if (! function_exists('db_common_authenticate_password'))
{
    function db_common_authenticate_password($c_member_id, $password)
    {
        $sql = 'SELECT c_member_secure_id FROM ' . MYNETS_PREFIX_NAME . 'c_member_secure' .
                ' WHERE c_member_id = ? AND hashed_password = ?';
        return (bool)db_get_one($sql, array(intval($c_member_id), md5($password)));;
    }
}

/**
 * 日記ページのカレンダー生成
 */
if (! function_exists('db_common_diary_monthly_calendar'))
{
    function db_common_diary_monthly_calendar($year, $month, $c_member_id, $u = null)
    {
        include_once 'Calendar/Month/Weekdays.php';
        $Month = new Calendar_Month_Weekdays($year, $month, 0);
        $Month->build();

        $is_diary_list = p_h_diary_is_diary_written_list4date($year, $month, $c_member_id, $u);

        $calendar = array();
        $week = 0;
        while ($Day = $Month->fetch()) {
            if ($Day->isFirst()) $week++;

            if ($Day->isEmpty()) {
                $calendar['days'][$week][] = array();
            } else {
                $day = $Day->thisDay();
                $item = array(
                    'day' => $day,
                    'is_diary' => in_array($day, $is_diary_list),
                );
                $calendar['days'][$week][] = $item;
            }
        }
        // 最初に日記を書いた日
        $sql = 'SELECT r_datetime FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ? ORDER BY r_datetime';
        $first_datetime = db_get_one($sql, array(intval($c_member_id)));

        // 前の月、次の月
        $prev_month = $Month->prevMonth('timestamp');
        $this_month = $Month->thisMonth('timestamp');
        $next_month = $Month->nextMonth('timestamp');

        $ym = array(
            'disp_year'  => $year,
            'disp_month' => $month,
            'prev_year'  => null,
            'prev_month' => null,
            'next_year'  => null,
            'next_month' => null,
        );
        if ($first_datetime && strtotime($first_datetime) < $this_month) {
            $ym['prev_year'] = date('Y', $prev_month);
            $ym['prev_month'] = date('n', $prev_month);
        }
        if ($next_month < time()) {
            $ym['next_year'] = date('Y', $next_month);
            $ym['next_month'] = date('n', $next_month);
        }
        $calendar['ym'] = $ym;

        return $calendar;
    }
}

//---

/**
 * スキン画像のfilenameを取得
 */
if (! function_exists('db_get_c_skin_filename_list'))
{
    function db_get_c_skin_filename_list()
    {
        $sql = 'SELECT skinname, filename FROM ' . MYNETS_PREFIX_NAME . 'c_skin_filename';
        return db_get_assoc($sql);
    }
}

if (! function_exists('db_get_c_skin_filename4skinname'))
{
    function db_get_c_skin_filename4skinname($skinname)
    {
        static $table;
        if (!isset($table)) {
            $table = (array)db_get_c_skin_filename_list();
        }

        if (empty($table[$skinname])) {
            return '';
        } else {
            return $table[$skinname];
        }
    }
}

//---

/**
 * DBテンプレートを読み込み
 */
if (! function_exists('db_get_c_template_source'))
{
    function db_get_c_template_source($name)
    {
        $sql = 'SELECT source FROM ' . MYNETS_PREFIX_NAME . 'c_template WHERE name = ?';
        $params = array(strval($name));
        return db_get_one($sql, $params);
    }
}

/**
 * ナビゲーション項目を取得
 */
if (! function_exists('db_get_c_navi'))
{
    function db_get_c_navi($navi_type = 'h')
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_navi WHERE navi_type = ? ORDER BY sort_order';
        $params = array(strval($navi_type));
        return db_get_all($sql, $params);
    }
}

?>

<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 *
 * @copyright 2007 Kei Kubo
 */


function db_diary_get_c_public_diary_list()
{
    $sql = "SELECT c_diary_id, subject FROM ".MYNETS_PREFIX_NAME."c_diary WHERE public_flag = 'open' ORDER BY r_datetime DESC LIMIT 0, 10";
    $arr = db_get_all($sql);

    return $arr;
}

function db_public_diary_get_c_public_diary_detail($target_c_diary_id)
{
    $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_diary WHERE c_diary_id = ? AND public_flag = 'open'";
    $params = array(intval($target_c_diary_id));
    $arr = db_get_row($sql, $params);

    return $arr;
}

/**
 * あるメンバーの日記リストを取得
 *
 * @param int $c_member_id target c_member_id
 * @param int $page_size
 * @param int $page
 * @return array 日記リスト
 */
function p_public_diary_list_diary_list4c_member_id($c_member_id = null, $page_size, $page)
{
    if(!$c_member_id){
    $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_diary WHERE public_flag = 'open' ORDER BY r_datetime DESC";
    $list = db_get_all_page($sql, $page, $page_size);
    $sql = "SELECT COUNT(*) FROM ".MYNETS_PREFIX_NAME."c_diary WHERE public_flag = 'open'";
    $total_num = db_get_one($sql, $params);
    }else{
    $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_diary WHERE c_member_id = ? AND public_flag = 'open' ORDER BY r_datetime DESC";
    $params = array(intval($c_member_id));
    $list = db_get_all_page($sql, $page, $page_size, $params);


    $sql = "SELECT COUNT(*) FROM ".MYNETS_PREFIX_NAME."c_diary WHERE c_member_id = ? AND public_flag = 'open'";
    $total_num = db_get_one($sql, $params);
    }

    if ($list) {
        foreach ($list as $key=>$value) {
            $c_member = db_common_c_member4c_member_id($value['c_member_id']);
            $list[$key]['nickname'] = $c_member['nickname'];
        }
    }


    if ($total_num != 0) {
        $total_page_num =  ceil($total_num / $page_size);
        if ($page >= $total_page_num) {
            $next = false;
        } else {
            $next = true;
        }

        if ($page <= 1) {
            $prev = false;
        } else {
            $prev = true;
        }
    }
    return array($list, $prev, $next);
}

/**
 * あるメンバーの指定された年月日の公開日記のリストを得る
 */
function p_public_diary_list_diary_list_date4c_member_id($c_member_id = null, $year, $month, $day=0)
{
    if ($day) {
        $s_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year));
        $e_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day+1, $year));
    } else {
        $s_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, 1, $year));
        $e_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month+1, 1, $year));
    }
    if(!$c_member_id){
    $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_diary" .
            " WHERE r_datetime >= ? AND r_datetime < ? AND public_flag = 'open' ORDER BY r_datetime DESC";
    $params = array($s_date, $e_date);
    $list = db_get_all($sql, $params);
    }else{
    $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_diary" .
            " WHERE c_member_id = ? AND r_datetime >= ? AND r_datetime < ? AND public_flag = 'open' ORDER BY r_datetime DESC";
    $params = array(intval($c_member_id), $s_date, $e_date);
    $list = db_get_all($sql, $params);
    }

    return array($list, false, false);
}

/**
 * 日記ページのカレンダー生成
 */
function db_common_public_diary_monthly_calendar($year, $month, $c_member_id = null)
{
    include_once 'Calendar/Month/Weekdays.php';
    $Month = new Calendar_Month_Weekdays($year, $month, 0);
    $Month->build();

    $is_diary_list = p_public_diary_is_diary_written_list4date($year, $month, $c_member_id);

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
    if (!$c_member_id){
    $sql = "SELECT r_datetime FROM ".MYNETS_PREFIX_NAME."c_diary WHERE public_flag = 'open' ORDER BY r_datetime";
    $first_datetime = db_get_one($sql);
    }else{
    $sql = "SELECT r_datetime FROM ".MYNETS_PREFIX_NAME."c_diary WHERE c_member_id = ? AND public_flag = 'open' ORDER BY r_datetime";
    $first_datetime = db_get_one($sql, array(intval($c_member_id)));
    }

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

/**
 * 公開日記ページの「各月の日記」用
 *
 * 公開日記を最初に書いた月からスタートしてみる
 */
function p_public_diary_list_date_list4c_member_id($c_member_id = null)
{
    if(!$c_member_id){
    $sql = "SELECT r_datetime FROM ".MYNETS_PREFIX_NAME."c_diary WHERE public_flag = 'open' ORDER BY r_datetime";
    }else{
    $sql = "SELECT r_datetime FROM ".MYNETS_PREFIX_NAME."c_diary" .
        " WHERE c_member_id = ? AND public_flag = 'open'" .
        " ORDER BY r_datetime";
    $params = array(intval($c_member_id));
    }
    if (!$first_datetime = db_get_one($sql, $params)) {
        return array();
    }

    $start_date = getdate(strtotime($first_datetime));
    $end_date =  getdate();

    $date = array();
    $year = $start_date['year'];
    $month = $start_date['mon'];
    while (1) {
        $date[] =  array(
            'year' => $year,
            'month' => $month,
        );

        if ($end_date['year'] <= $year
            && $end_date['mon'] <= $month) {
            break;
        }

        $month++;
        if ($month > 12) {
            $month = 1;
            $year++;
        }
    }
    return array_reverse($date);
}

/*
 *　スポンサーリンク。編集厳禁
 */

function p_public_diary_get_sponsered_links()
{
    require_once openpne_ext_search('/diary/lib/RSS.php');

    $rdf = 'http://nx2.jp/?m=blog&a=page_sponser&url=' . OPENPNE_URL;
    $rss =& new XML_RSS($rdf);
    if (PEAR::isError($rss)) continue;
        $rss->parse();
    if ($rss->getChannelInfo()) $channel = $rss->getChannelInfo();
        $channel['items'] = $rss->getItems();
    foreach ($channel['items'] as $key => $value) {
        $ad_list[$key]['title'] = $value['title'];
        $ad_list[$key]['link'] = $value['link'];
    }
    return $ad_list;
}

/**
 * 指定された年月に日記を書いている日のリストを返す
 */
function p_public_diary_is_diary_written_list4date($year, $month, $c_member_id = null)
{
    include_once 'Date/Calc.php';

    $date_format = '%Y-%m-%d 00:00:00';
    $thismonth = Date_Calc::beginOfMonth($month, $year, $date_format);
    $nextmonth = Date_Calc::beginOfNextMonth(0, $month, $year, $date_format);

    if (!$c_member_id){
    $sql = "SELECT DISTINCT DAYOFMONTH(r_datetime) FROM ".MYNETS_PREFIX_NAME."c_diary" .
           " WHERE r_datetime >= ? AND r_datetime < ? AND public_flag = 'open'";
    $params = array($thismonth, $nextmonth);
    }else{
    $sql = "SELECT DISTINCT DAYOFMONTH(r_datetime) FROM ".MYNETS_PREFIX_NAME."c_diary" .
           " WHERE c_member_id = ? AND r_datetime >= ? AND r_datetime < ? AND public_flag = 'open'";
    $params = array(intval($c_member_id), $thismonth, $nextmonth);
    }

    return db_get_col($sql, $params);
}

/**
 * inc_html_header.tpl
 */
function fetch_inc_html_header4public_diary($title, $member = null)
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'diary/templates';

    if (SNS_TITLE) {
        $inc_smarty->assign('INC_HEADER_title', SNS_TITLE);
    } else {
        $inc_smarty->assign('INC_HEADER_title', SNS_NAME);
    }

    $inc_smarty->assign('member', $member);
    $inc_smarty->assign('title', $title);

    $inc_smarty->assign('inc_html_head', p_common_c_siteadmin4target_pagename('inc_html_head'));
    $inc_smarty->assign('inc_custom_css', p_common_c_siteadmin4target_pagename('inc_custom_css'));

    $c_sns_config = db_select_c_sns_config();
    $inc_smarty->assign('border_00', $c_sns_config['border_00']);
    $inc_smarty->assign('border_01', $c_sns_config['border_01']);
    $inc_smarty->assign('border_02', $c_sns_config['border_02']);
    $inc_smarty->assign('border_03', $c_sns_config['border_03']);
    $inc_smarty->assign('border_04', $c_sns_config['border_04']);
    $inc_smarty->assign('border_05', $c_sns_config['border_05']);
    $inc_smarty->assign('border_06', $c_sns_config['border_06']);
    $inc_smarty->assign('border_07', $c_sns_config['border_07']);
    $inc_smarty->assign('border_08', $c_sns_config['border_08']);
    $inc_smarty->assign('border_09', $c_sns_config['border_09']);
    $inc_smarty->assign('border_10', $c_sns_config['border_10']);

    $inc_smarty->assign('bg_00', $c_sns_config['bg_00']);
    $inc_smarty->assign('bg_01', $c_sns_config['bg_01']);
    $inc_smarty->assign('bg_02', $c_sns_config['bg_02']);
    $inc_smarty->assign('bg_03', $c_sns_config['bg_03']);
    $inc_smarty->assign('bg_04', $c_sns_config['bg_04']);
    $inc_smarty->assign('bg_05', $c_sns_config['bg_05']);
    $inc_smarty->assign('bg_06', $c_sns_config['bg_06']);
    $inc_smarty->assign('bg_07', $c_sns_config['bg_07']);
    $inc_smarty->assign('bg_08', $c_sns_config['bg_08']);
    $inc_smarty->assign('bg_09', $c_sns_config['bg_09']);
    $inc_smarty->assign('bg_10', $c_sns_config['bg_10']);
    $inc_smarty->assign('bg_11', $c_sns_config['bg_11']);
    $inc_smarty->assign('bg_12', $c_sns_config['bg_12']);
    $inc_smarty->assign('bg_13', $c_sns_config['bg_13']);

    return $inc_smarty->ext_fetch('inc_html_header.tpl');
}

/**
 * sitemap.xml用
 * 公開日記を書いているすべてのメンバーIDの取得
 */
function db_public_diary_get_c_member_id4sitemap()
{
    $sql = "SELECT DISTINCT c_member_id FROM ".MYNETS_PREFIX_NAME."c_diary WHERE public_flag = 'open' GROUP BY c_member_id";
    return db_get_all($sql);
}

/**
 * sitemap.xml用
 * すべての公開日記IDの取得
 */
function db_public_diary_get_c_diary_id4sitemap()
{
    $sql = "SELECT c_diary_id, r_datetime FROM ".MYNETS_PREFIX_NAME."c_diary WHERE public_flag = 'open' ORDER BY r_datetime DESC";
    return db_get_all($sql);
}

/**
 * 該当メンバーの利用タグ一覧
 * Openの日記の分だけを抽出する
 */
function getUseOpenTag($c_member_id = '')
{
    $params = array();
    $sql = 'SELECT t.* FROM ' . MYNETS_PREFIX_NAME . 'c_entry_tag as t inner join '.MYNETS_PREFIX_NAME.'c_diary as d ';
    $sql .= ' on t.c_entry_id = d.c_diary_id ' ;
    if ($c_member_id !== '') {
        $params = intval($c_member_id);
        $sql .= ' WHERE t.c_entry_flag = 0 AND d.public_flag = \'open\' ';
    } else {
        $sql .= ' WHERE d.c_member_id = ? AND t.c_entry_flag = 0 AND d.public_flag = \'open\' ';
    }
    $sql .= " GROUP BY c_entry_tags_id";


    $list = db_get_all($sql,$params);
    foreach($list as $key => $value) {
        $list[$key]['c_tags_name'] = getTagName($value['c_entry_tags_id']);
    }
    return $list;
}


?>

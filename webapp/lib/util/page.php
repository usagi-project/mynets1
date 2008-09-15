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

//----- インクルードテンプレートの出力をfetch

/**
 * inc_navi.tpl の出力を返す
 *
 * $type が f または c の場合には、$target_id を指定する必要があります。
 *
 * @param   enum('h', 'f', 'c')  $type : ナビゲーションのタイプ
 * @param  int  $target_id : 友達のメンバーID もしくは コミュニティID
 * @return html
 */
function fetch_inc_navi($type, $target_id = null)
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'pc/templates';
    $inc_smarty->assign('PHPSESSID', md5(session_id()));

    switch ($type) {
    case 'h':
    default:
        $type = 'h';
        break;
    case 'f':
        $inc_smarty->assign('INC_NAVI_c_member_id_friend', $target_id);
        break;
    case 'c':
        $inc_smarty->assign('INC_NAVI_c_commu_id', $target_id);
        break;
    }
    $inc_smarty->assign('INC_NAVI_type', $type);
    $inc_smarty->assign('navi', util_get_c_navi($type));

    $inc_smarty->assign('WORD_FRIEND', WORD_FRIEND);
    $inc_smarty->assign('WORD_MY_FRIEND', WORD_MY_FRIEND);
    $inc_smarty->assign('WORD_FRIEND_HALF', WORD_FRIEND_HALF);
    $inc_smarty->assign('WORD_MY_FRIEND_HALF', WORD_MY_FRIEND_HALF);

    return $inc_smarty->ext_fetch('inc_navi.tpl');
}

/**
 * inc_html_header.tpl
 */
function fetch_inc_html_header()
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'pc/templates';

    if (SNS_TITLE) {
        $inc_smarty->assign('title', SNS_TITLE);
    } else {
        $inc_smarty->assign('title', SNS_NAME);
    }

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
 * inc_page_header.tpl
 */
function fetch_inc_page_header($type = null)
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'pc/templates';

    $v['PHPSESSID'] = md5(session_id());
    $v['INC_PAGE_HEADER_type'] = $type;
    if ($type == 'public' || $type == 'regist') {
        $v['before_after'] = 'before';
        $v['INC_PAGE_HEADER'] = db_banner_get_top_banner(false);
    } else {
        $v['before_after'] = 'after';
        $v['INC_PAGE_HEADER'] = db_banner_get_top_banner(true);
    }
    $v['top_banner_html_before'] = p_common_c_siteadmin4target_pagename('top_banner_html_before');
    $v['top_banner_html_after'] = p_common_c_siteadmin4target_pagename('top_banner_html_after');
    $inc_smarty->assign('navi', util_get_c_navi('global'));

    $inc_smarty->assign($v);
    return $inc_smarty->ext_fetch('inc_page_header.tpl');
}

/**
 * inc_page_footer.tpl
 */
function fetch_inc_page_footer($is_secure = false)
{
    $inc_smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $inc_smarty->templates_dir = 'pc/templates';

    $inc_smarty->assign('PHPSESSID', md5(session_id()));
    if ($is_secure) {
        $inc_smarty->assign('inc_page_footer',
            p_common_c_siteadmin4target_pagename('inc_page_footer_after'));
    } else {
        $inc_smarty->assign('inc_page_footer',
            p_common_c_siteadmin4target_pagename('inc_page_footer_before'));
    }

    return $inc_smarty->ext_fetch('inc_page_footer.tpl');
}

function fetch_from_db($tpl_name, &$smarty)
{
    $content = '';
    if ($smarty->template_exists($tpl_name)) {
        $security = $smarty->security;
        $smarty->security = true;
        $content = $smarty->fetch($tpl_name);
        $smarty->security = $security;
    }
    return $content;
}

function fetch_inc_entry_point_h_home(&$smarty)
{
    $target = 'h_home';

    $contents = array();
    for ($i = 1; $i <= 12; $i++) {
        $tpl = sprintf('db:inc_entry_point_%s_%d', $target, $i);
        $contents[$i] = fetch_from_db($tpl, $smarty);
    }
    return $contents;
}

function fetch_inc_entry_point_f_home(&$smarty)
{
    $target = 'f_home';

    $contents = array();
    for ($i = 1; $i <= 9; $i++) {
        $tpl = sprintf('db:inc_entry_point_%s_%d', $target, $i);
        $contents[$i] = fetch_from_db($tpl, $smarty);
    }
    return $contents;
}

function fetch_inc_entry_point_c_home(&$smarty)
{
    $target = 'c_home';

    $contents = array();
    for ($i = 1; $i <= 7; $i++) {
        $tpl = sprintf('db:inc_entry_point_%s_%d', $target, $i);
        $contents[$i] = fetch_from_db($tpl, $smarty);
    }
    return $contents;
}

//------------

function get_int_assoc($from, $to)
{
    $from = intval($from);
    $to = intval($to);
    if ($from > $to) return array();

    for ($i = $from; $i <= $to; $i++) {
        $assoc[$i] = $i;
    }
    return $assoc;
}

/** 月リスト */
function p_regist_prof_c_profile_month_list4null()
{
    return get_int_assoc(1, 12);
}

/** 日リスト */
function p_regist_prof_c_profile_day_list4null()
{
    return get_int_assoc(1, 31);
}

//------------

function p_c_event_add_confirm_event4request()
{
    $rule = array(
        'target_c_commu_id' => array(
            'type' => 'int',
            'default' => '',
        ),
        'title' => array(
            'type' => 'string',
            'default' => '',
        ),
        'open_date_year' => array(
            'type' => 'int',
            'default' => '',
        ),
        'open_date_month' => array(
            'type' => 'int',
            'default' => '',
        ),
        'open_date_day' => array(
            'type' => 'int',
            'default' => '',
        ),
        'open_date_comment' => array(
            'type' => 'string',
            'default' => '',
        ),
        'open_pref_id' => array(
            'type' => 'int',
            'default' => '',
        ),
        'open_pref_comment' => array(
            'type' => 'string',
            'default' => '',
        ),
        'body' => array(
            'type' => 'string',
            'default' => '',
        ),
        'invite_period_year' => array(
            'type' => 'int',
            'default' => '',
        ),
        'invite_period_month' => array(
            'type' => 'int',
            'default' => '',
        ),
        'invite_period_day' => array(
            'type' => 'int',
            'default' => '',
        ),
        'image_filename1' => array(
            'type' => 'string',
            'default' => '',
        ),
        'image_filename2' => array(
            'type' => 'string',
            'default' => '',
        ),
        'image_filename3' => array(
            'type' => 'string',
            'default' => '',
        ),
    );
    $validator = new OpenPNE_Validator($rule, $_REQUEST);
    $validator->validate();

    $result = $validator->getParams();
    $result['c_commu_id'] = $result['target_c_commu_id'];
    return $result;
}
if( !defined('LASTLOGIN_DAYS') )
    define('LASTLOGIN_DAYS', 3);

function p_f_home_last_login4access_date($access_date)
{
    if (!$access_date || $access_date == '0000-00-00 00:00:00') {
        return '未ログイン';
    }

    $diff = time() - strtotime($access_date);

    $m_diff = ceil($diff / 60);         //時間差:分
    $h_diff = ceil($diff / (60*60));    //時間差:時
    $d_diff = ceil($diff / (60*60*24)); //時間差:日

    if ($m_diff <= 60) {  // 1時間以内
        if ($m_diff<= 3) {
            $last_login = '3分以内';
        } elseif ($m_diff <= 5) {
            $last_login = '5分以内';
        } elseif ($m_diff <= 10) {
            $last_login = '10分以内';
        } elseif ($m_diff <= 15) {
            $last_login = '15分以内';
        } elseif ($m_diff <= 30) {
            $last_login = '30分以内';
        } elseif ($m_diff <= 45) {
            $last_login = '45分以内';
        } else {
            $last_login = '60分以内';
        }
    } elseif ($h_diff <= 24) {
        $last_login = $h_diff . '時間以内';
    } elseif ($d_diff <= LASTLOGIN_DAYS) {
        $last_login = $d_diff . '日以内';
    } else {
        $last_login = LASTLOGIN_DAYS . '日以上';
    }

    return $last_login;
}

/**
 * ある日まであと何日かを計算する
 *
 * @param int $month
 * @param int $day
 * @return int 日数
 */
function getCountdownDays($month, $day)
{
    $year = date('Y');

    // 今日の00:00:00
    $today = mktime(0, 0, 0);

    $theday_thisyear = mktime(0, 0, 0, $month, $day, $year);
    $theday_nextyear = mktime(0, 0, 0, $month, $day, $year + 1);

    if ($theday_thisyear < $today) {
        $theday_next = $theday_nextyear;
    } else {
        $theday_next = $theday_thisyear;
    }

    // 24 * 60 * 60 = 86400
    return ($theday_next - $today) / 86400;
}

/**
 * 生年月日から年齢を計算する
 */
function getAge($year, $month, $day)
{
    $this_year = intval(date('Y'));
    $today = intval(date('nd'));

    $age = $this_year - $year;
    if ($today < $month * 100 + $day) $age--;

    return $age;
}

/**
 * 引用符を付ける
 */
function message_body2inyou($string)
{
    if (!empty($string)) {
        //返信用に引用符をつける
        $string = '> '.$string;
        $string = str_replace("\r\n", "\n", $string);
        $string = str_replace("\r", "\n", $string);
        $string = str_replace("\n", "\n> ", $string);
    }
    return $string;
}

?>

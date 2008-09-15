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

class pc_page_h_calendar extends OpenPNE_Action
{
    function handleError()
    {
        openpne_redirect('pc', 'page_h_calendar');
    }

    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $year = intval($requests['year']);
        $month = intval($requests['month']);
        // ----------

        if (!$year) $year = date('Y');
        if (!$month) $month = date('n');
                
                $is_curr = false;
        if ($year == date('Y') && $month == date('n')) {
            $is_curr = true;
            $curr_day = date('d');
        }

        if ($year < date('Y') || ($year > intval(date('Y')) + 1)) {
            $this->set('add_schedule', false);
        } else {
            $this->set('add_schedule', true);
        }

        $this->set('inc_navi', fetch_inc_navi('h'));
        // イベント
        $event_list = p_h_calendar_event4c_member_id($year, $month, $u);
        // 誕生日
        $birth_list = p_h_calendar_birth4c_member_id($month, $u);

        include_once 'Calendar/Month/Weekdays.php';
        $Month = new Calendar_Month_Weekdays($year, $month, 0);
        $Month->build();
                $day = null;
        $calendar = array();
        $i = 0;
        while ($Day = $Month->fetch()) {
            if ($Day->isFirst()) $i++;

            if ($Day->isEmpty()) {
                $calendar[$i][] = array();
            } else {
                $day = $Day->thisDay();
                $item = array(
                    'day' => $day,
                    'now' => false,
                    'birth' => $birth_list[$day],
                    'event' => $event_list[$day],
                    'schedule' => p_h_calendar_c_schedule_list4date($year, $month, $day, $u),
                );
                $item['day'] = $day;
                if ($is_curr && $item['day'] == $curr_day) {
                    $item['now'] = true;
                }

                $calendar[$i][] = $item;
            }
        }

        $ym = array(
            'year_disp'  => $year,
            'month_disp' => $month,
            'year_prev'  => date('Y', $Month->prevMonth(true)),
            'month_prev' => date('n', $Month->prevMonth(true)),
            'year_next'  => date('Y', $Month->nextMonth(true)),
            'month_next' => date('n', $Month->nextMonth(true)),
        );
        $this->set("ym", $ym);

        $this->set("year", $year);
        $this->set("month", $month);
        $this->set("calendar", $calendar);

        $c_member = db_common_c_member4c_member_id($u);
        $this->set("pref_list", p_regist_prof_c_profile_pref_list4null());
        $this->set("c_member", $c_member);

        $this->set("weather_url", "http://weather.yahoo.co.jp/weather/");

        return 'success';
    }
}

?>

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

/*
This script was inspired by:
ktai_schedule By saku Ver 0.10
Thanks
*/

class ktai_page_h_calendar_week extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        //引数チェック
        $year = $requests['year'] ? $requests['year'] : date('Y');
        $month = $requests['month'] ? $requests['month'] : date('n');
        $day = $requests['day'] ? $requests['day'] : date('j');
    
        //
        //空の配列の生成
        $weekdays = array();
        //週の日付情報の生成
        for ($days = 0; $days < 7; $days++) {
            $tmp = explode('-', date('Y-n-j-D', mktime(0, 0, 0, $month, $day + $days, $year)));
            $count = p_h_calendar_c_schedule_list_count4date($tmp['0'], $tmp['1'], $tmp['2'], $u);
            $event = p_h_home_event_list_count4c_member_id($tmp['0'], $tmp['1'], $tmp['2'], $u);
            $weekdays[] = array(
                'year' => $tmp['0'],
                'month' => $tmp['1'],
                'day' => $tmp['2'],
                'week' => $tmp['3'],
                'count' => $count,
                'event' => $event,
            );  
        }
        $this->set('weekdays', $weekdays);
        //前週の日付情報の生成
        $tmp = explode('-', date('Y-n-j', mktime(0, 0, 0, $month, $day - 7, $year)));
        $lastweek = array(
            'year' => $tmp['0'],
            'month' => $tmp['1'],
            'day' => $tmp['2'],
        );
        $this->set('lastweek', $lastweek);

        //翌週の日付情報の生成
        $tmp = explode('-', date('Y-n-j', mktime(0, 0, 0, $month, $day + 7, $year)));
        $nextweek = array(
            'year' => $tmp['0'],
            'month' => $tmp['1'],
            'day' => $tmp['2'],
        );
        $this->set('nextweek', $nextweek);

        //SNSの名前
        $this->set('SNS_NAME', SNS_NAME);

        //アクセス日時を記録
        p_common_do_access($u);

        return 'success';
    }

    function get_calendar($u, $week)
    {
        include_once 'Calendar/Week.php';
        $w = intval($week);
        if (empty($w)) {
            $w = 0;
        }
        $this->set('w', $w);
        $time = strtotime($w . ' week');
        $Week = new Calendar_Week(date('Y', $time), date('m', $time), date('d', $time), 0);
        $Week->build();
        $calendar = array();
        $dayofweek = array('日','月','火','水','木','金','土');
        $i = 0;
        while ($Day = $Week->fetch()) {
            $y = $Day->thisYear();
            $m = $Day->thisMonth();
            $d = $Day->thisDay();
            $item = array(
                'year'=> $y,
                'month'=>$m,
                'day' => $d,
                'dayofweek'=>$dayofweek[$i++],
                'now' => false,
                'birth' => p_h_home_birth4c_member_id($m, $d, $u),
                'schedule' => p_h_calendar_c_schedule_list4date($y, $m, $d, $u),
                'count' => p_h_calendar_c_schedule_list_count4date($y, $m, $d, $u),
                'event' => p_h_home_event_list_count4c_member_id($y, $m, $d, $u),
            );
            if ($w == 0 && $d == date('d')) {
                $item['now'] = true;
            }
            $calendar[] = $item;
        }
        return $calendar;
    }
}

?>

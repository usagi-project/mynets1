<?php

class pc_ajax_home_calender extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];
        // 今日の日付、曜日
        $this->set('r_datetime', date('m/d'));
        $date = array('日','月','火','水','木','金','土');
        $this->set('r_datetime_date', $date[date('w')]);

        /// 週間カレンダー
        if (DISPLAY_SCHEDULE_HOME) {
            $this->set('calendar', $this->get_calendar($u, $requests['w']));
        }

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
                'event' => p_h_home_event4c_member_id($y, $m, $d, $u),
                'schedule' => p_h_calendar_c_schedule_list4date($y, $m, $d, $u),
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
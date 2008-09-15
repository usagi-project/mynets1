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

class pc_page_h_schedule_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        $this->set('inc_navi', fetch_inc_navi('h'));

        // --- リクエスト変数
        $year = $requests['year'];
        $month = $requests['month'];
        $day = $requests['day'];

        $input = $requests;
        // ----------

        if (!$year) $year = date('Y');
        if (!$month) $month = date('n');
        if (!$day) $day = date('d');

        $list = array(
            "start_year"=>$year,
            "start_month"=>$month,
            "start_day"=>$day,
            "end_year"=>$year,
            "end_month"=>$month,
            "end_day"=>$day,
        );
        foreach ($list as $key => $default) {
            if (is_null($input[$key])) {
                $input[$key] = $default;
            }
        }
        $this->set('input', $input);

        $year_list = array();
        $curr_year = date('Y');
        $year_list[$curr_year] = $curr_year;
        $year_list[$curr_year+1] = $curr_year + 1;
        $this->set('year_list', $year_list);

        $month_list = array();
        for ($i=1; $i <= 12; $i++) {
            $month_list[$i] = $i;
        }
        $this->set('month_list', $month_list);

        $day_list = array();
        for ($i=1; $i <= 31; $i++) {
            $day_list[$i] = $i;
        }
        $this->set('day_list', $day_list);

        $hour_list = array();
        for ($i=0; $i <= 23; $i++) {
            $hour_list[$i] = sprintf("%02d", $i);
        }
        $this->set('hour_list', $hour_list);

        $minute_list = array();
        for ($i=0; $i < 60; $i+=15) {
            $minute_list[$i] = sprintf("%02d", $i);
        }
        $this->set('minute_list', $minute_list);

        $this->set('is_unused_schedule', util_is_unused_mail('m_pc_schedule_mail'));

        return 'success';
    }
}

?>

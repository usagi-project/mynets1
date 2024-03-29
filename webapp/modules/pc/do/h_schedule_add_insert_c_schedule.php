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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
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

class pc_do_h_schedule_add_insert_c_schedule extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $title = $requests['title'];
        $body = $requests['body'];
        $start_year = $requests['start_year'];
        $start_month = $requests['start_month'];
        $start_day = $requests['start_day'];
        $start_hour = $requests['start_hour'];
        $start_minute = $requests['start_minute'];
        $end_year = $requests['end_year'];
        $end_month = $requests['end_month'];
        $end_day = $requests['end_day'];
        $end_hour = $requests['end_hour'];
        $end_minute = $requests['end_minute'];
        $is_receive_mail = $requests['is_receive_mail'];
        // ----------

        $list = array(
            'title' => '',
            'body' => '',
            'start_year' => null,
            'start_month' => null,
            'start_day' => null,
            'start_hour' => null,
            'start_minute' => null,
            'end_year' => null,
            'end_month' => null,
            'end_day' => null,
            'end_hour' => null,
            'end_minute' => null,
            'is_receive_mail' => 0,
        );
        foreach ($list as $key=>$value) {
            $input[$key] = $requests[$key];
        }

        $title = trim($input['title']);

        if (is_null($input['end_year'])) {
            $input['end_year'] = $input['start_year'];
        }
        if (is_null($input['end_month'])) {
            $input['end_month'] = $input['start_month'];
        }
        if (is_null($input['end_day'])) {
            $input['end_day'] = $input['start_day'];
        }

        $start_date = sprintf('%04d-%02d-%02d', $input['start_year'], $input['start_month'], $input['start_day']);
        $end_date = sprintf('%04d-%02d-%02d', $input['end_year'], $input['end_month'], $input['end_day']);

        if (($input['start_hour'] || $input['start_hour'] == 0) && ($input['start_minute'] || $input['start_minute'] == 0)) {
            $start_time = sprintf('%02d:%02d:00', $input['start_hour'], $input['start_minute']);
        } else {
            $start_time = null;
        }

        if (($input['end_hour'] || $input['end_hour'] == 0) && ($input['end_minute'] || $input['end_minute'] == 0)) {
            $end_time = sprintf('%02d:%02d:00', $input['end_hour'], $input['end_minute']);
        } else {
            $end_time = null;
        }

        do_h_schedule_add_insert_c_schedule($u, $title, $input['body'],
            $start_date, $start_time, $end_date, $end_time,
            $input['is_receive_mail']);
        $p = array(
            'year' => $start_year,
            'month' => $start_month,
        );
        openpne_redirect('pc', 'page_h_calendar', $p);
    }
}

?>

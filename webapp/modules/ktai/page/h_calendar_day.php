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

class ktai_page_h_calendar_day extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        //引数チェック
        $year = $requests['year'] ? $requests['year'] : date('Y');
        $month = $requests['month'] ? $requests['month'] : date('n');
        $day = $requests['day'] ? $requests['day'] : date('j');

        //メンバ情報
        $c_member = db_common_c_member4c_member_id($u);
        $this->set('c_member', $c_member);

        //スケジュール情報
        $schedule = p_h_calendar_c_schedule_list4date($year, $month, $day, $u);
        $this->set('schedule', $schedule);

        //イベント情報
        $event = p_h_home_event4c_member_id($year, $month, $day, $u);
        $this->set('event',$event);
        //誕生日の情報
        $birth = p_h_home_birth4c_member_id($month, $day, $u);
        $this->set('birth',$birth);
        //年月日の情報
        //今日の日付情報
        $tmp = explode('-', date('Y-n-j-D', mktime(0, 0, 0, $month, $day, $year)));
        $today = array(
            'year' => $tmp['0'],
            'month' => $tmp['1'],
            'day' => $tmp['2'],
            'week' => $tmp['3'],
        );  
        $this->set('today', $today);

        //昨日の日付情報
        $tmp = explode('-', date('Y-n-j-D', mktime(0, 0, 0, $month, $day - 1, $year)));
        $yesterday = array(
            'year' => $tmp['0'],
            'month' => $tmp['1'],
            'day' => $tmp['2'],
            'week' => $tmp['3'],
        );  
        $this->set('yesterday', $yesterday);

        //明日の日付情報
        $tmp = explode('-', date('Y-n-j-D', mktime(0, 0, 0, $month, $day + 1, $year)));
        $tomorrow = array(
            'year' => $tmp['0'],
            'month' => $tmp['1'],
            'day' => $tmp['2'],
            'week' => $tmp['3'],
        );  
        $this->set('tomorrow', $tomorrow);

        //SNSの名前
        $this->set('SNS_NAME', SNS_NAME);

        //アクセス日時を記録
        p_common_do_access($u);

        return 'success';
    }
}

?>

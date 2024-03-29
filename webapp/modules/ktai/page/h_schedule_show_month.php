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

/*
This script was inspired by:
ktai_schedule By saku Ver 0.10
Thanks
*/

class ktai_page_h_schedule_show_month extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        //引数チェック
        $year = $requests['year'] ? $requests['year'] : date('Y');
        $month = $requests['month'] ? $requests['month'] : date('n');
        $day = $requests['day'] ? $requests['day'] : date('j');

        $month_schedule = array();
        $today = 1;
        $yesterday = 0;

        //週の日付情報の生成
        while(true) {
            $tmp = explode('-', date('Y-n-j-D', mktime(0, 0, 0, $month, $today, $year)));

            //月がまたいだらbreakする
            if($yesterday > $tmp['2']) {
                break;
            }
            $schedule = p_h_calendar_c_schedule_list4date($tmp['0'], $tmp['1'], $tmp['2'], $u);
            if($schedule) {
                $monthly_schedule[] = array(
                    'year' => $tmp['0'],
                    'month' => $tmp['1'],
                    'day' => $tmp['2'],
                    'week' => $tmp['3'],
                    'schedule' => $schedule,
                );
            }
            //条件変数を更新
            $yesterday = $tmp['2'];
            $today++;
        }
        $this->set('monthly_schedule', $monthly_schedule);

        //今月の日付情報の生成
        $this->set('year', $year);
        $this->set('month', $month);
        $this->set('day', $day);

        //前月の日付情報の生成
        $tmp = explode('-', date('Y-n-j', mktime(0, 0, 0, $month - 1, $day, $year)));
        $lastmonth = array(
            'year' => $tmp['0'],
            'month' => $tmp['1'],
            'day' => $tmp['2'],
        );
        $this->set('lastmonth', $lastmonth);

        //翌月の日付情報の生成
        $tmp = explode('-', date('Y-n-j', mktime(0, 0, 0, $month + 1, $day, $year)));
        $nextmonth = array(
            'year' => $tmp['0'],
            'month' => $tmp['1'],
            'day' => $tmp['2'],
        );
        $this->set('nextmonth', $nextmonth);

        //SNSの名前
        $this->set('SNS_NAME', SNS_NAME);

        //アクセス日時を記録
        p_common_do_access($u);

        return 'success';
    }
}

?>

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

class ktai_page_h_schedule_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        //引数チェック
        $year = $requests['year'] ? $requests['year'] : date('Y');
        $month = $requests['month'] ? $requests['month'] : date('n');
        $day = $requests['day'] ? $requests['day'] : date('j');
    
        //引数の変数を登録
        $this->set('year', $year);
        $this->set('month', $month);
        $this->set('day', $day);

        $this->set('start_date', date('Ymd', mktime(0, 0, 0, $month, $day, $year)));
        $this->set('start_hour', date('H'));
        $this->set('end_hour', (intval(date('H')) + 1) % 24);

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

        //SNSの名前
        $this->set('SNS_NAME', SNS_NAME);

        //アクセス日時を記録
        p_common_do_access($u);

        return 'success';
    }
}

?>

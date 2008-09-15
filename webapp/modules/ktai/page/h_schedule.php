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

class ktai_page_h_schedule extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $schedule_id = $requests['schedule_id'];
        // ----------

        $schedule = p_common_c_schedule4c_schedule_id($schedule_id);
        if ($schedule['c_member_id'] != $u) {
            exit("データはありません。");
        }

        $this->set('schedule', $schedule);

        //SNSの名前
        $this->set('SNS_NAME', SNS_NAME);

        //アクセス日時を記録
        p_common_do_access($u);

        return 'success';
    }
}

?>

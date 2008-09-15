<?php

class ktai_do_h_schedule_delete extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        if( is_null($_POST['delete']) ){
            openpne_redirect('ktai', 'page_h_schedule', array(
              'schedule_id' => $_POST['schedule_id'],
            ));
            exit();
        }

        // --- リクエスト変数
        $schedule_id = $_POST['schedule_id'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        // ----------

        //--- 権限チェック
        //スケジュール作成者

        $schedule = p_common_c_schedule4c_schedule_id($schedule_id);
        if ($schedule['c_member_id'] != $u) {
            exit("データはありません。");
        }
        //---


        do_h_schedule_delte_delete_c_schedule4c_schedule_id($schedule_id);

        openpne_redirect('ktai', 'page_h_calendar_day', array(
         'year'  => $start_year,
         'month' => $start_month,
         'day'   => $start_day,$tail
        ));
    }
}
?>

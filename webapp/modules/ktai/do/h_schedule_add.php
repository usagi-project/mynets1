<?php

class ktai_do_h_schedule_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        //$input = $requests;
        $input = $_POST;

        //タイトルの編集
        $title = trim($input['title']);

        //年月日の編集
        if( strlen( $input['start_date'] ) == 8 ){
            $start_year = substr( $input['start_date'], 0, 4 );
            $start_month = substr( $input['start_date'], 4, 2 );
            $start_day = substr( $input['start_date'], 6, 2 );
        } else {
            $start_year = 0;
            $start_month = 0;
            $start_day = 0;
        }

        $end_year = $start_year;
        $end_month = $start_month;
        $end_day = $start_day;

        $start_date = sprintf("%04d-%02d-%02d", $start_year, $start_month, $start_day);
        $end_date = sprintf("%04d-%02d-%02d", $end_year, $end_month, $end_day);

        // validation
        $errors = array();

        if( ! $title ) {
            $errors[] = "タイトルがありません";
        }

        //日付入力チェック
        require_once 'Calendar/Day.php';
        require_once 'Calendar/Validator.php';
        $valid_day = new Calendar_Day($start_year, $start_month, $start_day);
        $validator = new Calendar_Validator($valid_day);
        if ( ! $validator->isValidDay() ){
            $errors[] = "年月日が正しくありません";
        }

        if ( is_null( $input['start_hour'] ) || is_null( $input['start_minute'] ) ) {
            $errors[] = "開始時刻が正しくありません";
        }
        if ( is_null( $input['end_hour'] ) || is_null( $input['end_minute'] ) ) {
            $errors[] = "終了時刻が正しくありません";
        }

        $start_time = $input['start_hour'] * 100 + $input['start_minute'];
        $end_time = $input['end_hour'] * 100 + $input['end_minute'];

        if ( $end_time < $start_time ) {
            $errors[] = "終了時刻は開始時刻より前に設定できません";
        }

        if ($errors) {
            $_REQUEST['year'] = $input['year'];
            $_REQUEST['month'] = $input['month'];
            $_REQUEST['day'] = $input['day'];
            $i = 1;
            while ($msg = array_shift($errors)) {
                $_REQUEST["msg{$i}"] = $msg;
                $i++;
            }
            openpne_forward('ktai', 'page', "h_schedule_add");
            exit;
        }

        //開始時刻と終了時刻をセット
        if ( $input['start_hour'] &&  $input['start_minute'] ) {
            $start_time = "{$input['start_hour']}:{$input['start_minute']}:00";
        } else {
            $start_time = "00:00:00";
        }

        if ( $input['end_hour'] &&  $input['end_minute'] ) {
            $end_time = "{$input['end_hour']}:{$input['end_minute']}:00";
        } else {
            $end_time = "00:00:00";
        }

        do_h_schedule_add_insert_c_schedule($u, $title, $input['body'],
                    $start_date, $start_time, $end_date, $end_time,
                    $input['is_receive_mail']);

        openpne_redirect('ktai', 'page_h_calendar_day', array(
          'year'  => $start_year,
          'month' => $start_month,
          'day'   => $start_day,$tail
          ));
    }
}
?>

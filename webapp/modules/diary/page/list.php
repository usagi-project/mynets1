<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 *
 * @copyright 2007 Kei Kubo
 */

class diary_page_list extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function handleError()
    {
        openpne_redirect('diary', 'page_home');
    }

    function execute($requests)
    {
        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $year = $requests['year'];
        $month = $requests['month'];
        $day = $requests['day'];
        // ----------

        $page += $direc;
        $page_size = 30;

        $target_member = db_common_c_member4c_member_id($target_c_member_id);
        $this->set('target_member', $target_member);
        //年月日で一覧表示、日記数に制限なし
        if ($year && $month) {
            $list_set = p_public_diary_list_diary_list_date4c_member_id($target_c_member_id, $year, $month, $day);
        } else {
            $year = date('Y');
            $month = date('n');
            $this->set('all', 1);

            $list_set = p_public_diary_list_diary_list4c_member_id($target_c_member_id, $page_size, $page, $u);
        }

        $this->set('target_diary_list', $list_set[0]);
        $this->set('page', $page);
        $this->set('page_size', $page_size);
        $this->set('is_prev', $list_set[1]);
        $this->set('is_next', $list_set[2]);

        $this->set('diary_list_count', count($list_set[0]));

        //日記一覧、カレンダー用変数
        $date_val = array(
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
        );
        $this->set('date_val', $date_val);

        //日記のカレンダー
        $calendar = db_common_public_diary_monthly_calendar($year, $month, $target_c_member_id);

        $this->set('calendar', $calendar['days']);
        $this->set('ym', $calendar['ym']);

        //最新日記
        $this->set('new_diary_list', db_diary_get_c_public_diary_list($target_c_member_id));

        //各月の日記
        $this->set('date_list', p_public_diary_list_date_list4c_member_id($target_c_member_id));

        //---- inc_ テンプレート用 変数 ----//
        $title = $target_member['nickname'].'さんの日記';
        $member = $target_c_member_id;
        $this->set('inc_html_header', fetch_inc_html_header4public_diary($title, $member));
        $this->set('inc_page_header', fetch_inc_page_header('public'));

        return 'success';
    }
}

?>

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

class pc_page_h_dengon_rireki extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        //$target_c_diary_id = $requests['target_c_diary_id'];
        //日記のIDを指定しているので、変更する
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $page_size = 15;
        $page += $direc;

        //ページ
        $this->set("page", $page);
        // ----------

        //dengon保有者のニックネームを取得
        $c_member = db_common_c_member4c_member_id_LIGHT($u);
        //自分しか開かない
        $type = 'h';
    $this->set("type",$type);
        //コメント
        list ($c_dengon_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_dengon_c_dengon_comment_list4c_member_id_from($u, $page_size, $page);
    $this->set("my_id",$u);
        $this->set("c_dengon_comment", array_reverse($c_dengon_comment_list));
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("total_num", $total_num);
        $this->set("total_page_num", $total_page_num);
        $this->set("page_size", $page_size);
    $this->set("c_member", $c_member);
        $pager = array();
        $pager['end'] = $total_num - ($page_size * ($page - 1));
        $pager['start'] = $pager['end'] - count($c_dengon_comment_list) + 1;
        $this->set('pager', $pager);
    $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id));
        //最近の日記を取得
        $list_set = p_fh_diary_list_diary_list4c_member_id($target_c_member_id, 7, 1);
        $this->set("new_diary_list", $list_set[0]);

        //カレンダー関係
        //カレンダー開始用変数
        $time = strtotime($target_c_diary['r_datetime']);
        $year = date('Y', $time);
        $month= date('n', $time);
        //日記一覧、カレンダー用変数
        $date_val = array(
            'year' => $year,
            'month' => $month,
            'day' => null,
        );
        $this->set("date_val", $date_val);

        //日記のカレンダー
        $calendar = db_common_diary_monthly_calendar($year, $month, $target_c_member_id);

        $this->set("calendar", $calendar['days']);
        $this->set("ym", $calendar['ym']);

        //各月の日記
        $this->set("date_list",p_fh_diary_list_date_list4c_member_id($target_c_member_id));

        return 'success';
    }
}

?>

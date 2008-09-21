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

class pc_page_fh_diary_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $year = $requests['year'];
        $month = $requests['month'];
        $day = $requests['day'];
        $c_tags_id = $requests['c_tags_id'];
        $strYearmonth = "";
        if ($year && $month) {
            $strYearmonth = "&year=".$year."&month=".$month;
        }
        // ----------

        if (!$target_c_member_id) {
            $target_c_member_id = $u;
        }

        if ($target_c_member_id == $u) {
            $type = 'h';
            $is_diary_admin = true;
        } else {
            $type = 'f';
            $is_diary_admin = false;
            $target_c_member = db_common_c_member4c_member_id($target_c_member_id);
            $is_friend = db_friend_is_friend($u, $target_c_member_id);

            // アクセスブロック
            if (p_common_is_access_block($u, $target_c_member_id)) {
                openpne_redirect('pc', 'page_h_access_block');
            }

            //あしあとをつける
            db_ashiato_insert_c_ashiato($target_c_member_id, $u);
        }
        $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id));
        $this->set('type', $type);

        $page += $direc;
        $page_size = 20;

        $target_member = db_common_c_member4c_member_id($target_c_member_id);
        $this->set('target_member', $target_member);
        //年月日で一覧表示、日記数に制限なし
        if ($year && $month) {
            $list_set = p_fh_diary_list_diary_list_date4c_member_id($target_c_member_id, $page, $page_size, $year, $month, $day, $u);
            $rss_list = p_fh_diary_list_c_rss_cache_list_date($target_c_member_id, $year, $month, $day);

        } elseif($c_tags_id) {
            $year = date('Y');
            $month = date('n');
            $list_set = getDiaryList4Tags($target_c_member_id, $c_tags_id, $page, $page_size, '0', $u);
            $this->set('c_tags_name', getTagName($c_tags_id));
            //変数にタグIDを埋め込む　タグの場合年月日がないので、これを流用
            $strYearmonth = "&c_tags_id=".$c_tags_id;
        } else {
            $year = date('Y');
            $month = date('n');
            $this->set('all', 1);

            $list_set = p_fh_diary_list_diary_list4c_member_id($target_c_member_id, $page_size, $page, $u);
            $rss_list = p_fh_diary_list_c_rss_cache_list($target_c_member_id, $page_size, $page);

        }

        $this->set('c_rss_cache_list', $rss_list);

        $this->set('target_diary_list', $list_set[0]);
        $this->set('page', $page);
        $this->set('page_size', $page_size);
        $this->set('is_prev', $list_set[1]);
        $this->set('is_next', $list_set[2]);
        $diary_list_count = count($list_set[0]);
        $this->set('diary_list_count', $diary_list_count);
        $total_num = $list_set[3];
        $this->set('total_num',$total_num);
        include_once OPENPNE_LIB_DIR . '/include/Pager/Pager.php';
        $options = array(
        // 全アイテム数の設定
        "totalItems" => $total_num,
        // 1ページに表示するインデックス数の設定
        "delta"      => 10,
        // 1ページのアイテム数の設定(全アイテム数からこの数字を割った数がページ数になります)
        "perPage"    => $page_size,
        // Pager動作モードの設定
        "mode"       => "Jumping",
        // 現在のページ数の設定
        "altFirst"   => "最初",
        "altPrev"    => "前へ",
        "altNext"    => "次へ",
        "altLast"    => "最後",
        "altPage"    => "ページ",
        "prevImg"    => "[前へ]",
        "nextImg"    => "[次へ]",
        // ページ番号ごとにはさむ文字列の設定
        "separator"  => "|",

        // 使用するGET引数の設定
        "urlVar"     => "page",

        // <a>タグのスタイルシートのクラスの設定
        "linkClass"  => "link",
        "curPageLinkClassName"=> "clink",

        // appendを0にすることでfileNameが有効になる
         "append"     => 0,
         "fileName"   => "?m=pc&a=page_fh_diary_list&target_c_member_id=".
                            $target_c_member_id.
                            "&page=%d&page_size=".
                            $page_size.$strYearmonth,
    );

    // Pagerインスタンスの作成
    if (version_compare(phpversion(), '5.0.0') == -1) {
        $pager = new Pager($options);
    } else {
        $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
    }
    $this->set('page_link',$pager->links);

        //日記一覧、カレンダー用変数
        $date_val = array(
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
        );
        $this->set('date_val', $date_val);

        //日記のカレンダー
        $calendar = db_common_diary_monthly_calendar($year, $month, $target_c_member_id, $u);

        $this->set('calendar', $calendar['days']);
        $this->set('ym', $calendar['ym']);

        //各月の日記
        $this->set('date_list', p_fh_diary_list_date_list4c_member_id($target_c_member_id));

        //メンバーのタグリスト
        $this->set("member_tag_list", getUseTag($target_c_member_id, '0'));

        return 'success';
    }
}

?>

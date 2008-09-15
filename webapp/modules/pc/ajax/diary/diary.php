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


class pc_ajax_diary_diary extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        $body = $requests['body'];
        $page_size = $requests['page_size'];
        $page = $requests['page'];
        $direc = $requests['direc'];

        $page += $direc;
        // ----------
        //ページ
        $this->set("page", $page);
        //$page_size = 5;
        // ----------

        // target が指定されていない
        if (!$target_c_diary_id) {
            openpne_redirect('pc', 'page_h_err_fh_diary');
        }
        // target の日記が存在しない
        if (!p_common_is_active_c_diary_id($target_c_diary_id)) {
            openpne_redirect('pc', 'page_h_err_fh_diary');
        }


        $target_c_diary = db_diary_get_c_diary4id_with_prev_next($target_c_diary_id,$u);
        $target_c_member_id = $target_c_diary['c_member_id'];

        if ($target_c_member_id == $u) {
            $type = 'h';

            //日記を閲覧済みにする
            db_diary_update_c_diary_is_checked($target_c_diary_id, 1);

        } else {
            $type = 'f';
            $target_c_member = db_common_c_member4c_member_id($target_c_member_id);
            $is_friend = db_friend_is_friend($u, $target_c_member_id);

            // check public_flag
            if (!pne_check_diary_public_flag($target_c_diary_id, $u)) {
                openpne_redirect('pc', 'page_h_err_diary_access');
            }
            // アクセスブロック
            if (p_common_is_access_block($u, $target_c_member_id)) {
                openpne_redirect('pc', 'page_h_access_block');
            }

            // あしあとをつける
            db_ashiato_insert_c_ashiato($target_c_member_id, $u,'pc');
                    db_etsuran_insert_c_etsuran($target_c_diary_id, $u, $target_c_member_id);
        }
        $this->set("type", $type);

        $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id));

        $this->set("member", db_common_c_member4c_member_id($u));

        $this->set("target_member", db_common_c_member4c_member_id($target_c_member_id));
        $this->set("target_diary", $target_c_diary);
        //Pagerを仕込むために修正
        //$this->set("target_diary_comment_list", db_diary_get_c_diary_comment_list4c_diary_id($target_c_diary_id));

                
       //コメント
        list ($target_diary_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_diary_c_diary_comment_list4c_diary_id($target_c_diary_id, $page_size, $page);
        $this->set("target_diary_comment_list", array_reverse($target_diary_comment_list));
    
        //$this->set("c_diary_comment", array_reverse($c_diary_comment_list));
        //$this->set("target_diary_comment_list", ($c_diary_comment_list));
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("total_num", $total_num);
        $this->set("total_page_num", $total_page_num);
        $this->set("page_size", $page_size);
    
        //$pager = array();
        //$pager['end'] = $total_num - ($page_size * ($page - 1));
        //$pager['start'] = $pager['end'] - count($target_diary_comment_list) + 1;
        //$this->set('pager', $pager);
        //ここにPEARのページャーを仕込みます。
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
         "fileName"   => "?m=pc&a=page_fh_diary&target_c_diary_id=".$target_c_diary_id."&page=%d&page_size=".$page_size,
        );

        // Pagerインスタンスの作成
        if (version_compare(phpversion(), '5.0.0') == -1) {
            $pager = new Pager($options);
        } else {
            $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
        }
        $this->set('page_link',$pager->links);
        //ページャーここまで

        $this->set("body", $body);

        //最近の日記を取得
        $list_set = p_fh_diary_list_diary_list4c_member_id($target_c_member_id, 7, 1, $u);
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
        $calendar = db_common_diary_monthly_calendar($year, $month, $target_c_member_id, $u);

        $this->set("calendar", $calendar['days']);
        $this->set("ym", $calendar['ym']);

        //各月の日記
        $this->set("date_list", p_fh_diary_list_date_list4c_member_id($target_c_member_id));

        return 'success';
    }
}

?>

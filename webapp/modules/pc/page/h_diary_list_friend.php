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
require_once OPENPNE_WEBAPP_DIR . "/components/diary/diary.class.php";

class pc_page_h_diary_list_friend extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $this->set('inc_navi', fetch_inc_navi("h"));


        //日記一覧
        $page = $page + $direc;
        $page_size = 50;
        $this->set("page_size", $page_size);

        $lst = p_h_diary_list_friend_h_diary_list_friend4c_member_id($u, $page_size, $page);
        //2008-01-29 Kuniharu Tsujioka
        $comment_data = $lst[0];
        $comment_flag = new UsagiComponentsDiary();
        foreach ($comment_data as $key=>$value) {
            $comment_data[$key]['edit_flag'] = $comment_flag->chkCommentEditFlag($u, $value['c_diary_id']);
            $comment_data[$key]['view_flag'] = $comment_flag->chkCommentViewFlag($u, $value['c_diary_id']);
        }
        //--------------------------------//
        $this->set("h_diary_list_friend", $comment_data);
        $this->set("is_prev", $lst[1]);
        $this->set("is_next", $lst[2]);
        $this->set("total_num", $lst[3]);

        include_once OPENPNE_LIB_DIR . '/include/Pager/Pager.php';
        $options = array(
        // 全アイテム数の設定
        "totalItems" => $lst[3],
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
         "fileName"   => "?m=pc&a=page_h_diary_list_friend&page=%d&page_size=".$page_size,
        );

        // Pagerインスタンスの作成
        if (version_compare(phpversion(), '5.0.0') == -1) {
            $pager = new Pager($options);
        } else {
            $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
        }
        $this->set('page_link',$pager->links);

        if ($page == 1) {
            // rss_cache
            $limit = 20;
            $this->set('c_rss_cache_list', p_h_diary_list_friend_c_rss_cache_list($u, $limit));
        }

        return 'success';
    }
}

?>

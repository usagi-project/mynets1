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

class pc_page_h_message_box extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $box = $requests['box'];
        $page = $requests['page'];
        $ru_page = $requests['ru_page'];
        $s_page = $requests['s_page'];
        $save_page = $requests['save_page'];
        $trash_page = $requests['trash_page'];
        $keyword = $requests['keyword'];
        // ----------

        $this->set('inc_navi', fetch_inc_navi("h"));

        $this->set('u', $u);

        // 1ページ当たりに表示するメッセージ数
        $page_size = 20;
        $this->set("page_size", $page_size);

        //ボックス判定
        $this->set("box", $box);

        switch ($box) {

        //受信リスト
        case 'inbox':
        default:
            if ($keyword) {
                list($ru_list,$is_ru_prev,$is_ru_next, $total_num) = db_message_search_c_message($u, $page, $page_size, $keyword, $box);
            } else {
                list($ru_list,$is_ru_prev,$is_ru_next, $total_num) = p_h_message_box_c_message_received_list4c_member_id4range($u, $page, $page_size);
            }
            //list($ru_list,$is_ru_prev,$is_ru_next,$total_num) = p_h_message_box_c_message_received_list4c_member_id4range($u, $page, $page_size);
            $this->set("c_message_ru_list", $ru_list);
            $this->set("count_c_message_ru_list", count($ru_list));
            $this->set("keyword", $keyword);
            break;

        //送信済みリスト
        case 'outbox':
            if ($keyword) {
                list($s_list,$is_s_prev,$is_s_next, $total_num) = db_message_search_c_message($u, $page, $page_size, $keyword, $box);
            } else {
                list($s_list,$is_s_prev,$is_s_next, $total_num) = p_h_message_box_c_message_sent_list4c_member_id4range($u, $page, $page_size);
            }
            //list($s_list,$is_s_prev,$is_s_next,$total_num) = p_h_message_box_c_message_sent_list4c_member_id4range($u, $page, $page_size);
            $this->set("c_message_s_list", $s_list);
            $this->set("count_c_message_s_list", count($s_list));
            $this->set("keyword", $keyword);
            break;
        //下書き保存リスト
        case 'savebox':
            list($save_list,$is_save_prev,$is_save_next,$total_num) = p_h_message_box_c_message_save_list4c_member_id4range($u, $page, $page_size);
            $this->set("c_message_save_list", $save_list);
            $this->set("count_c_message_save_list", count($save_list));
            break;
        //ごみ箱リスト
        case 'trash':
            list($trash_list,$is_trash_prev,$is_trash_next,$total_num) = p_h_message_box_c_message_trash_list4c_member_id4range($u, $page, $page_size);
            $this->set("c_message_trash_list", $trash_list);
            $this->set("count_c_message_trash_list", count($trash_list));

            $this->set("trash_data", $trash_data);
            break;
        }
        $this->set('total_num',$total_num);
        //共通でページャを仕込みます。
        include_once 'Pager/Pager.php';
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
         "fileName"   => "?m=pc&a=page_h_message_box&box=".$box."&page=%d&keyword=".urlencode($keyword),
    );

    // Pagerインスタンスの作成
    if (version_compare(phpversion(), '5.0.0') == -1) {
        $pager = new Pager($options);
    } else {
        $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
    }
    $this->set('page_link',$pager->links);



        return 'success';
    }
}

?>

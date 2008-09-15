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

class pc_page_h_com_find_all extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_category_parent_id = $requests['target_c_commu_category_parent_id'];
        $keyword = $requests['keyword'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $val_order = $requests['val_order'];
        $category_id = $requests['category_id'];
        // ----------

        //バグ回避のため半角空白を全角に統一
        $keyword = str_replace(" ", "　", $keyword);

        do_common_insert_search_log($u, $keyword);

        $this->set('inc_navi', fetch_inc_navi('h'));

        $page_size = 20;
        $page = $page + $direc;
        $this->set('page', $page);

        //検索結果
        list($result, $is_prev, $is_next, $total_num, $start_num, $end_num)
            = p_h_com_find_all_search_c_commu4c_commu_category(
                $keyword,
                $target_c_commu_category_parent_id,
                $page_size,
                $page,
                $val_order,
                $category_id);

        $this->set('c_commu_search_list', $result);
        $this->set('is_prev', $is_prev);
        $this->set('is_next', $is_next);
        $this->set('total_num', $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        $this->set('keyword', $keyword);
        $search_val_list = array(
            'val_order' => $val_order,
            'category_id' => $category_id,
        );
        $this->set('search_val_list', $search_val_list);

        $this->set('c_commu_category_list', p_h_com_find_all_c_commu_category_list4null());
        $this->set('c_commu_category_parent_list', _db_c_commu_category_parent_list4null());

                //Pager追加
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
         "fileName"   => "?m=pc&a=page_h_com_find_all&page=%d&keyword=".urlencode($keyword)."&val_order=".$val_order."&category_id=".$category_id,
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

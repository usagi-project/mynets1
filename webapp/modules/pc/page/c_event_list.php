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

class pc_page_c_event_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------


        $page_size = 20;
        $c_commu = _db_c_commu4c_commu_id($c_commu_id);

        //コミュニティの存在の有無
        if (!$c_commu) {
            openpne_redirect('pc', 'page_h_err_c_home');
        }

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));

        $page += $direc;

        $this->set("c_commu", $c_commu);
        list($result, $is_prev, $is_next, $total_num, $start_num, $end_num)
            = p_c_topic_list_c_topic_list4target_c_commu_id($c_commu_id, $u, $page, $page_size, 1, 1);
        $this->set("c_topic_list", $result);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("page", $page);
        $this->set("total_num", $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

                //Pager追加
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
         "fileName"   => "?m=pc&a=page_c_event_list&target_c_commu_id=".$c_commu_id."&page=%d&page_size=".$page_size,
    );

    // Pagerインスタンスの作成
    if (version_compare(phpversion(), '5.0.0') == -1) {
        $pager = new Pager($options);
    } else {
        $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
    }
    $this->set('page_link',$pager->links);


        //--- 権限チェック
        $is_c_commu_member = _db_is_c_commu_member($c_commu_id, $u);

        if (!$is_c_commu_member && $c_commu['public_flag'] == "auth_commu_member") {
            $is_warning = true;
        } else {
            $is_warning = false;
        }
        $this->set("is_warning", $is_warning);
        //---

        $this->set("is_c_commu_admin", _db_is_c_commu_admin($c_commu_id, $u));
        $this->set("is_c_commu_member", $is_c_commu_member);

        return 'success';
    }
}

?>

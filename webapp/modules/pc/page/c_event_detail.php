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

class pc_page_c_event_detail extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $all = $requests['all'];
        $err_msg = $requests['err_msg'];
        $body = $requests['body'];
        // ----------

        $c_topic = c_event_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];

        //--- 権限チェック
        if (!p_common_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        $c_commu = _db_c_commu4c_commu_id($c_commu_id);
        if (!$c_commu) {
            openpne_redirect('pc', 'page_h_err_c_home');
        }
        if (!$c_topic['event_flag']) {
            $p = array('target_c_commu_topic_id' => $c_topic['c_commu_topic_id']);
            openpne_redirect('pc', 'page_c_topic_detail', $p);
        }

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));

        //詳細部分
        $this->set("c_commu", $c_commu);
        $c_topic = c_event_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $this->set("c_topic", $c_topic);

        //書き込み一覧部分
        $page += $direc;
        if ($all==1) {
            $page_size = 1000;
        } else {
            $page_size = 10;
        }

        $lst = c_event_detail_c_topic_write4c_commu_topic_id($c_commu_topic_id, $page, $page_size);
        $this->set("c_topic_write", $lst[0]);
        $this->set("is_prev", $lst[1]);
        $this->set("is_next", $lst[2]);
        $this->set("total_num", $lst[3]);
        $this->set("page", $page);
        $this->set("all", $all);

        $this->set("start_num", $lst[4]);
        $this->set("end_num", $lst[5]);

        //Pager追加
        include_once 'Pager/Pager.php';
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
         "fileName"   => "?m=pc&a=page_c_event_detail&target_c_commu_topic_id=".$c_commu_topic_id."&page=%d&page_size=".$page_size."&all=".$all,
    );

    // Pagerインスタンスの作成
    if (version_compare(phpversion(), '5.0.0') == -1) {
        $pager = new Pager($options);
    } else {
        $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
    }
    $this->set('page_link',$pager->links);
    //ここまでページャ

        $this->set("is_c_commu_admin", _db_is_c_commu_admin($c_commu_id, $u));
        $this->set("is_c_commu_member", _db_is_c_commu_member($c_commu_id, $u));
        $this->set("is_c_event_member", _db_is_c_event_member($c_commu_topic_id, $u));
        $this->set("is_c_event_admin", _db_is_c_event_admin($c_commu_topic_id, $u));

        $this->set('err_msg', $err_msg);
        $this->set('body', $body);

        $this->set('c_member_id', $u);

        return 'success';
    }
}
?>

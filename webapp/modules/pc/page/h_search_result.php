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

class pc_page_h_search_result extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $page = $requests['page'];
        $birth_year = $requests['birth_year'];
        $birth_month = $requests['birth_month'];
        $birth_day = $requests['birth_day'];
        $image = $requests['image'];
        $nickname = $requests['nickname'];
    $loginnow = $requests['loginnow'];
        // ----------

        $profiles = array();
        if ($_REQUEST['profile']) {
            $profiles = p_h_search_result_check_profile($_REQUEST['profile']);
        }

        $limit = 20;
        $this->set("page", $page);

        $cond = array(
            'birth_year' => $birth_year,
            'birth_month' => $birth_month,
            'birth_day' => $birth_day,
            'image' => $image,
        );
        $cond_like = array(
            'nickname' => $nickname,
        );

        $result = p_h_search_result_search($cond, $cond_like, $limit, $page, $u, $profiles,$loginnow);
        $this->set("target_friend_list", $result[0]);
        //$pager = array(
        //    "page_prev" => $result[1],
        //    "page_next" => $result[2],
        //    "total_num" => $result[3],
        //);
        $total_num = $result[3];
        $this->set('total_num',$total_num);
        //$pager["disp_start"] = $limit * ($page - 1) + 1;
        //if (($disp_end  = $limit * $page) > $pager['total_num']) {
        //    $pager['disp_end'] = $pager['total_num'];
        //} else {
        //    $pager['disp_end'] = $disp_end;
        // }

        //$this->set("pager", $pager);

        $tmp = array();
        foreach ($cond as $key => $value) {
            if ($value) {
                $tmp[] = "$key=".urlencode($value);
            }
        }
    if ($loginnow) {
        $tmp[] = "loginnow=" . $loginnow;
    }
        foreach ($cond_like as $key => $value) {
            if ($value) {
                $tmp[] = "$key=".urlencode($value);
            }
        }
        foreach ($profiles as $key => $value) {
            if ($value['c_profile_option_id']) {
                $v = $value['c_profile_option_id'];
            } else {
                $v = urlencode($value['value']);
            }
            $tmp[] = urlencode("profile[{$key}]")."={$v}";
        }
        $search_condition = implode("&", $tmp);
        $this->set("search_condition", $search_condition);

        $this->set('inc_navi', fetch_inc_navi("h"));

                //Pager追加
        include_once OPENPNE_LIB_DIR . '/include/Pager/Pager.php';
        $options = array(
        // 全アイテム数の設定
        "totalItems" => $total_num,
        // 1ページに表示するインデックス数の設定
        "delta"      => 10,
        // 1ページのアイテム数の設定(全アイテム数からこの数字を割った数がページ数になります)
        "perPage"    => $limit,
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
         "fileName"   => "?m=pc&a=page_h_search_result&page=%d&page_size=".$page_size."&".$search_condition,
        //"fileName"   => "?m=pc&a=page_h_search_result&birth_year=".$birth_year."&page=%d&page_size=".$page_size."&birth_month=".$birth_month."&birth_day=".$birth_day."&image=".$image."&loginnow=".$loginnow,
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

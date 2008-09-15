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
require_once OPENPNE_WEBAPP_DIR .'/components/one_word.class.php';

class ktai_page_fh_diary extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $page_size = $requests['page_size'];
        $page_sort = $requests['page_sort'];
        // ----------

        //$page_size = 5;
        $page += $direc;

        //ページ
        $this->set("page", $page);
        $this->set("page_sort",$page_sort);

        $c_diary = db_diary_get_c_diary4id_with_prev_next($target_c_diary_id, $u);

        $target_c_member = k_p_fh_diary_c_member4c_diary_id($target_c_diary_id);
        $target_c_member_id = $target_c_member['c_member_id'];

        if ($u != $target_c_member_id) {

            // check public_flag
            if (!pne_check_diary_public_flag($target_c_diary_id, $u)) {
                ktai_display_error('この日記にはアクセスできません');
            }
            //アクセスブロック設定
            if (p_common_is_access_block($u, $target_c_member_id)) {
                openpne_redirect('ktai', 'page_h_access_block');
            }
        }
        //管理画面HTML
        $this->set('c_siteadmin', p_common_c_siteadmin4target_pagename('k_fh_diary'));

        //日記の作者情報
        $this->set("target_diary_writer", $target_c_member);

        //日記
        $this->set("target_c_diary", $c_diary);
        //自分で日記を見たとき
        if ($c_diary['c_member_id'] == $u) {
            //日記を閲覧済みにする
            db_diary_update_c_diary_is_checked($target_c_diary_id, 1);
            $this->set("type", 'h');

        }

        //画面切り替えのために自分の情報を取得する
        $c_member = db_common_c_member4c_member_id($u);
        $this->set('c_member',$c_member);
        //自分のディスプレイを判定する
        $MyDisplayTemplate = getMyDisplay($c_member['mobile_view']);
        $this->set('MyDisplayTemplate',$MyDisplayTemplate['template_foldername']);
        //コメント
        list ($c_diary_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_diary_c_diary_comment_list4c_diary_id($target_c_diary_id, $page_size, $page, $page_sort);

        $this->set("c_diary_comment", ($c_diary_comment_list));
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("total_num", $total_num);
        $this->set("total_page_num", $total_page_num);
        $this->set("page_size", $page_size);
        $this->set("page_sort", $page_sort);

        include_once OPENPNE_LIB_DIR . '/include/Pager/Pager.php';

        $options = array(
        // 全アイテム数の設定
        "totalItems" => $total_num,
        // 1ページに表示するインデックス数の設定
        "delta"      => 5,
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
        "prevImg"    => "<前",
        "nextImg"    => "次>",
        // ページ番号ごとにはさむ文字列の設定
        "separator"  => "|",

        // 使用するGET引数の設定
        "urlVar"     => "page",

        // <a>タグのスタイルシートのクラスの設定
        "linkClass"  => "link",
        "curPageLinkClassName"=> "clink",

        // appendを0にすることでfileNameが有効になる
         "append"     => 0,
         "fileName"   => "?m=ktai&a=page_fh_diary&target_c_diary_id=".$target_c_diary_id."&page=%d&page_size=".$page_size."&page_sort=".$page_sort."&".$GLOBALS['KTAI_URL_TAIL']."#1",
        );

        // Pagerインスタンスの作成
        if (version_compare(phpversion(), '5.0.0') == -1) {
            $pager = new Pager($options);
        } else {
            $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
        }
        $this->set('page_link',$pager->links);
        //ページャーここまで

        // f or h
        $this->set("INC_NAVI_type", k_p_fh_common_get_type($target_c_member['c_member_id'], $u));

        //あしあとをつける
        db_ashiato_insert_c_ashiato($target_c_member_id, $u,'mobile');
        db_etsuran_insert_c_etsuran($target_c_diary_id, $u, $target_c_member_id);
        //2006/11/02 日記コメントでの画像投稿用で追加処理 KT
        if (MAIL_ADDRESS_HASHED) {
            $mail_address = "c{$target_c_diary_id}-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address = "c{$target_c_diary_id}"."@".MAIL_SERVER_DOMAIN;
        }
        $mail_address = urlencode(MAIL_ADDRESS_PREFIX) . $mail_address;
        if($GLOBALS['__Framework']['ktai_carrier'] == 'docomo') {
            $gps_address = OPENPNE_URL.'gmaps/gpsdocomo.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address;
            $gps_type = 'docomo';
        } elseif($GLOBALS['__Framework']['ktai_carrier'] == 'au') {
            $gps_address = 'device:gpsone?url='.OPENPNE_URL.'gmaps/gpsau.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address.'&ver=1&datum=0&unit=1&acry=0&number=0';
            $gps_type = 'au';
        } elseif($GLOBALS['__Framework']['ktai_carrier'] == 'softbank') {
            $gps_address = 'location:auto?url='.OPENPNE_URL.'gmaps/gpssoftbank.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address;
            $gps_type = 'softbank';
        }
        $this->set("mail_address", $mail_address);
        $this->set('gps_address', $gps_address);
        $this->set('gps_type', $gps_type);

        //今日の一言を取り出す。その人の分
        $oneword     = new OneWord();
        $oneword->setUid($target_c_member_id);
        $oneword    = $oneword->get();
        $this->set('oneword', $oneword);
        return 'success';
    }
}

?>

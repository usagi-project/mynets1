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

//伝言板用追加修正 KT

/**
 * dengonコメント追加
 */
class ktai_do_fh_dengon_insert_c_dengon_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_member_id_to = $requests['target_c_member_id_to'];
        $body = $requests['body'];
        // ----------

        if (is_null($body) || $body === ''){
            $p = array('target_c_member_id_to' => $target_c_member_id_to, 'msg' => 1);
            openpne_redirect('ktai', 'page_fh_dengon', $p);
        }

        //--- 権限チェック

        $c_dengon = db_dengon_get_c_dengon_comment_list4c_member_id_to($target_c_member_id_to);
        $target_c_member_id_from = $c_dengon['c_member_id_from'];
        //$target_c_member = db_common_c_member4c_member_id($target_c_member_id_from);


        //アクセスブロック設定
        if (p_common_is_access_block($u, $target_c_member_id_to)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }
        //---
    //echo($target_c_member_id_to);
    //exit();
        db_dengon_insert_c_dengon_comment($u, $target_c_member_id_to, $body);
        //日記コメントが書き込まれたので日記自体を未読扱いにする
        //db_diary_update_c_diary_is_checked($target_c_diary_id, 0);

        $p = array('target_c_member_id_to' => $target_c_member_id_to);
        openpne_redirect('ktai', 'page_fh_dengon', $p);
    }
}

/**
 * 日記コメント追加

class ktai_do_fh_diary_insert_c_diary_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        $body = $requests['body'];
        // ----------

        if (is_null($body) || $body === ''){
            $p = array('target_c_diary_id' => $target_c_diary_id, 'msg' => 1);
            openpne_redirect('ktai', 'page_fh_diary', $p);
        }

        //--- 権限チェック

        $c_diary = db_diary_get_c_diary4id($target_c_diary_id);
        $target_c_member_id = $c_diary['c_member_id'];
        $target_c_member = db_common_c_member4c_member_id($target_c_member_id);

        //日記の公開範囲設定
        if ($target_c_member['public_flag_diary'] == "friend" &&
            !db_friend_is_friend($u, $target_c_member_id) && $target_c_member_id != $u) {
            openpne_redirect('ktai', 'page_h_access_block');
        }

        //アクセスブロック設定
        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }
        //---

        db_diary_insert_c_diary_comment($u, $target_c_diary_id, $body);
        //日記コメントが書き込まれたので日記自体を未読扱いにする
        db_diary_update_c_diary_is_checked($target_c_diary_id, 0);

        $p = array('target_c_diary_id' => $target_c_diary_id);
        openpne_redirect('ktai', 'page_fh_diary', $p);
    }
}
 */
?>

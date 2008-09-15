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

/**
 * フレンドリクエストを送る
 */
class ktai_do_f_link_request_insert_c_friend_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $body = $requests['body'];
        // ----------

        $c_member_id_from = $u;

        //--- 権限チェック
        //フレンドでない and フレンド承認待ちでない

        $status = db_common_friend_status($u, $target_c_member_id);
        if ($status['is_friend']) {
            ktai_display_error('このメンバーは既に'.WORD_MY_FRIEND_HALF.'に登録されています。');
        } elseif ($status['is_friend_confirm']) {
            ktai_display_error('このメンバーは既に'.WORD_MY_FRIEND_HALF.'リンク承認待ち中です。');
        }

        // アクセスブロック
        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }
        // -----

        if ($body == null) {
            $p = array('target_c_member_id' => $target_c_member_id, 'msg' => 1);
            openpne_redirect('ktai', 'page_f_link_request', $p);
        }

        db_friend_insert_c_friend_confirm($c_member_id_from, $target_c_member_id, $body);


        //メッセージ
        $c_member_to   = db_common_c_member4c_member_id($target_c_member_id);
        $c_member_from = db_common_c_member4c_member_id($c_member_id_from);

        $subject =WORD_FRIEND."リンク要請メッセージ";
        $body_disp =
            $c_member_from['nickname']." さんから".WORD_FRIEND."リンク要請のメッセージが届いています。\n".
            "\n".
            "メッセージ：\n".
            $body."\n".
            "\n".
            "この要請について、承認待ちリストから承認または拒否を選択してください。";

        do_common_send_message_syoudaku($c_member_id_from, $target_c_member_id, $subject, $body_disp);

        $p = array('target_c_member_id' => $target_c_member_id);
        openpne_redirect('ktai', 'page_f_home', $p);
    }
}

?>

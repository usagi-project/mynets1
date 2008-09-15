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
 * メッセージ送信
 */
require_once OPENPNE_WEBAPP_DIR . "/components/count/message/count_message_count.class.php";

class pc_do_f_message_send_insert_c_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_member_id_to = $requests['c_member_id_to'];
        $subject = $requests['subject'];
        $body = $requests['body'];
        $tmpfile_1 = $requests['tmpfile_1'];
        $tmpfile_2 = $requests['tmpfile_2'];
        $tmpfile_3 = $requests['tmpfile_3'];
        // ----------

        $msg1 = "";
        $msg2 = "";

        if (null == $subject) {
            $msg1 = "件名を入力してください";
        }
        if (null == $body) {
            $msg2 = "メッセージを入力してください";
        }

        if ($msg1 || $msg2) {
            $p = array(
                'target_c_member_id' => $c_member_id_to,
                'target_c_message_id' => $requests['target_c_message_id'],
                'jyusin_c_message_id' => $requests['jyusin_c_message_id'],
                'body' => $requests['body'],
                'subject' => $requests['subject'],
                'msg1' => $msg1,
                'msg2' => $msg2,
            );
            openpne_redirect('pc', 'page_f_message_send', $p);
        }

        //修正
        if ($requests['no']) {
            $p = array(
                'target_c_member_id' => $c_member_id_to,
                'target_c_message_id' => $requests['target_c_message_id'],
                'jyusin_c_message_id' => $requests['jyusin_c_message_id'],
                'body' => $requests['body'],
                'subject' => $requests['subject'],
            );
            openpne_redirect('pc', 'page_f_message_send', $p);
        }
        if (is_continual_entry($body, $u, $c_member_id_to, "5")) {
            $p = array(
                'target_c_message_id' => $requests['target_c_message_id'],
                'msg' => "同じ人に同じ内容で連続投稿はできません"
            );
            openpne_redirect('pc', 'page_f_message_send', $p);
        }

        //--- 権限チェック
        //送信先が自分以外

        if ($c_member_id_to == $u) {
            handle_kengen_error();
        }

        //アクセスブロック設定
        if (p_common_is_access_block($u, $c_member_id_to)) {
            openpne_redirect('pc', 'page_h_access_block');
        }

        if ($requests['jyusin_c_message_id']) {
            $c_message = _db_c_message4c_message_id($requests['jyusin_c_message_id']);
            if ($c_message['c_member_id_to'] != $u || !$c_message['is_send']) {
                handle_kengen_error();
            }
        }
        if ($requests['target_c_message_id'] != $requests['jyusin_c_message_id']) {
            $c_message = _db_c_message4c_message_id($requests['target_c_message_id']);
            if ($c_message['c_member_id_from'] != $u || $c_message['is_send']) {
                handle_kengen_error();
            }
        }
        //---

        //返信済みにする
        if ($requests['jyusin_c_message_id']) {
            do_update_is_hensin($requests['jyusin_c_message_id']);
        }

        $is_image_exist = ($tmpfile_1 || $tmpfile_2 || $tmpfile_3);
        //下書き保存が存在しない
        if ($requests['target_c_message_id'] == $requests['jyusin_c_message_id']) {
            $c_message_id = do_common_send_message($u, $c_member_id_to, $subject, $body, $is_image_exist);
        } else {
            $c_message_id = $requests['target_c_message_id'];
            update_message_to_is_save($requests['target_c_message_id'], $subject, $body, 1);
        }
        //画像挿入
        $sessid = session_id();
        $filename_1 = image_insert_c_image4tmp("ms_{$c_message_id}_1", $tmpfile_1, $u);
        $filename_2 = image_insert_c_image4tmp("ms_{$c_message_id}_2", $tmpfile_2, $u);
        $filename_3 = image_insert_c_image4tmp("ms_{$c_message_id}_3", $tmpfile_3, $u);
        t_image_clear_tmp($sessid);
        db_update_c_message($c_message_id, $subject, $body, $filename_1, $filename_2, $filename_3);

        //2008-08-08 MessageCount処理を追加 KUNIHARU Tsujioka
        $datacount = new Message_Count($u, $c_member_id_to);
        $datacount->addCount();
        //**************************************************

        $p = array('msg' => 1);
        openpne_redirect('pc', 'page_h_reply_message', $p);
    }
}

?>

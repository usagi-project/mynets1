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

class ktai_do_f_message_send_insert_c_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $c_member_id_to = $requests['c_member_id_to'];
        $subject = $requests['subject'];
        $body = $requests['body'];
        // ----------

        //--- 権限チェック
        //自分以外

        if ($c_member_id_to == $u) {
            handle_kengen_error();
        }

        // アクセスブロック
        if (p_common_is_access_block($u, $c_member_id_to)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }
        //---

        if (is_null($subject) || $subject === '') {
            $p = array('target_c_member_id' => $c_member_id_to, 'msg' => 2);
            openpne_redirect('ktai', 'page_f_message_send', $p);
        }

        if (is_null($body) || $body === '') {
            $p = array('target_c_member_id' => $c_member_id_to, 'msg' => 1);
            openpne_redirect('ktai', 'page_f_message_send', $p);
        }

        do_common_send_message($u, $c_member_id_to, $subject, $body);
        //2008-08-08 MessageCount処理を追加 KUNIHARU Tsujioka
        $datacount = new Message_Count($u, $c_member_id_to);
        $datacount->addCount();
        //**************************************************

        $p = array('target_c_member_id' => $c_member_id_to);
        openpne_redirect('ktai', 'page_f_home', $p);
    }
}

?>

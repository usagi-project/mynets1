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
 * メッセージを送る(返信用)
 */
class ktai_do_h_message_insert_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $subject = $requests['subject'];
        $body = $requests['body'];
        $target_c_member_id = $requests['target_c_member_id'];
        $target_c_message_id = $requests['c_message_id'];
        // ----------

        if (is_null($subject) || $subject === '') {
            $p = array('target_c_message_id' => $target_c_message_id, 'msg' => 2);
            openpne_redirect('ktai', 'page_h_message', $p);
        }

        if (is_null($body) || $body === '') {
            $p = array('target_c_message_id' => $target_c_message_id, 'msg' => 1);
            openpne_redirect('ktai', 'page_h_message', $p);
        }

        //--- 権限チェック
        //自分以外
        if ($target_c_member_id == $u) {
            handle_kengen_error();
        }

        //target_c_messageが自分宛
        $target_c_message = _db_c_message4c_message_id($target_c_message_id);
        if ($target_c_message['c_member_id_to'] != $u) {
            handle_kengen_error();
        }

        // アクセスブロック
        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }
        //---

        //返信済みにする
        do_update_is_hensin($target_c_message_id);

        do_common_send_message($u, $target_c_member_id, $subject, $body);

        openpne_redirect('ktai', 'page_h_message_box');
    }
}

?>

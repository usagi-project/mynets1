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
 * リンク承認
 */
class pc_do_h_confirm_list_insert_c_friend extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_friend_confirm_id = $requests['target_c_friend_confirm_id'];
        // ----------

        //--- 権限チェック
        //リンク承認を受けているメンバー

        $cfc = _do_c_friend_confirm4c_friend_confirm_id($target_c_friend_confirm_id);

        if ($cfc['c_member_id_to'] != $u) {
            handle_kengen_error();
        }
        // -----

        if (!db_friend_insert_c_friend4confirm($target_c_friend_confirm_id, $u)) {
            handle_kengen_error();
        }

        do_h_confirm_list_insert_c_friend_mail_send($cfc['c_member_id_from'], $u);

        $msg = WORD_FRIEND.'登録が完了しました';
        $p = array(
            'target_c_member_id' => $cfc['c_member_id_from'],
            'msg' => $msg,
        );
        openpne_redirect('pc', 'page_f_message_send', $p);
    }
}

?>

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

class pc_do_o_password_query extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        // --- リクエスト変数
        $pc_address = $requests['pc_address'];
        $q_id = $requests['c_password_query_id'];
        $q_answer = $requests['c_password_query_answer'];
        // ----------

        //--- 権限チェック
        //パスワード確認の質問と答えがあっている

        if (!$pc_address || !$q_id || !$q_answer ||
            !$c_member_id = do_password_query_is_password_query_complete($pc_address, $q_id, $q_answer)
           ) {
            $msg = '正しい値を入力してください';
            $p = array('msg' => $msg);
            openpne_redirect('pc', 'page_o_password_query', $p);
        }
        //---

        // パスワード再発行
        $new_password = do_common_create_password();
        do_common_update_password($c_member_id, $new_password);
        do_password_query_mail_send($c_member_id, $pc_address, $new_password);

        $p = array('msg_code' => 'password_query');
        openpne_redirect('pc', 'page_o_tologin', $p);
    }
}

?>

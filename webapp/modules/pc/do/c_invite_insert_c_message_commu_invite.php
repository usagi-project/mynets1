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

class pc_do_c_invite_insert_c_message_commu_invite extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $body = $requests['body'];
        $c_member_id_list = $requests['c_member_id_list'];
        // ----------

        if (!$c_member_id_list) {
            $p = array(
                'target_c_commu_id' => $target_c_commu_id,
                'msg' => '紹介先の'.WORD_MY_FRIEND.'を選択してださい',
            );
            openpne_redirect('pc', 'page_c_invite', $p);
        }

        if (is_null($body) || $body === '') {
            $p = array(
                'target_c_commu_id' => $target_c_commu_id,
                'msg' => 'メッセージを入力してください',
            );
            openpne_redirect('pc', 'page_c_invite', $p);
        }

        //--- 権限チェック
        //フレンド

        foreach ($c_member_id_list as $c_member_id) {
            if (!db_friend_is_friend($c_member_id, $u)) {
                handle_kengen_error();
            }
        }
        //---

        list($msg_subject, $msg_body) =
            create_message_commu_invite($u, $body, $target_c_commu_id);

        $commu = _db_c_commu4c_commu_id($target_c_commu_id);
        $c_member_id_admin = $commu['c_member_id_admin'];
        $public_flag = $commu['public_flag'];

        foreach ($c_member_id_list as $c_member_id) {
            do_common_send_message_syoukai_commu($u, $c_member_id, $msg_subject, $msg_body);
            // 招待者がコミュニティ管理者で、かつ非公開コミュニティの場合
            if (($c_member_id_admin == $u) && ($public_flag != 'public')) {
                db_commu_insert_c_commu_admin_invite($target_c_commu_id, $c_member_id);
            }
        }

        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('pc', 'page_c_home', $p);
    }
}

?>

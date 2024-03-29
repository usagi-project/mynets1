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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
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
 * コミュニティ管理者交代依頼メッセージ送信
 */
class pc_do_c_admin_request_insert_c_commu_admin_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $target_c_commu_id = $requests['target_c_commu_id'];
        // ----------

        //--- 権限チェック
        //自分がコミュニティ管理者
        //targetがコミュニティメンバー

        $status = db_common_commu_status($u, $target_c_commu_id);
        if (!$status['is_commu_admin']) {
            handle_kengen_error();
        }

        $status = db_common_commu_status($target_c_member_id, $target_c_commu_id);
        if (!$status['is_commu_member']) {
            handle_kengen_error();
        }
        //---

        $target_c_commu_admin_confirm_id =
            db_commu_insert_c_commu_admin_confirm($target_c_commu_id, $target_c_member_id);

        //メッセージ
        $c_member_id_from = $u;
        $c_member_from    = db_common_c_member4c_member_id_LIGHT($c_member_id_from);
        $c_member_to      = $target_c_member_id;
        $c_commu          = _db_c_commu4c_commu_id($target_c_commu_id);

        $subject ="コミュニティ管理者交代要請メッセージ";
        $body_disp =
            $c_member_from['nickname']." さんから".$c_commu['name']." コミュニティの管理者交代希望メッセージが届いています。\n".
            "\n".
            "この要請について、承認待ちリストから承認または拒否を選択してください。\n";

        do_common_send_message_syoudaku($c_member_id_from, $target_c_member_id, $subject, $body_disp);

        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('pc', 'page_c_edit_member', $p);
    }
}
?>

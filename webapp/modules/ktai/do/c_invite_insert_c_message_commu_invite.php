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
 * コミュニティをマイフレンドに教える
 */
class ktai_do_c_invite_insert_c_message_commu_invite extends OpenPNE_Action
{
    function handleError($errors)
    {
        if (!empty($errors['target_c_commu_id'])) {
            parent::handleError($errors);
        }

        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $c_commu_id = $this->requests['target_c_commu_id'];
        if (!empty($errors['target_c_member_id'])) {
            $p = array('target_c_commu_id' => $c_commu_id, 'msg' => 7);
            openpne_redirect('ktai', 'page_c_invite', $p);
        } elseif (!empty($errors['body'])) {
            $p = array('target_c_commu_id' => $c_commu_id, 'msg' => 8);
            openpne_redirect('ktai', 'page_c_invite', $p);
        } else {
            parent::handleError($errors);
        }
    }

    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $body = $requests['body'];
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        //--- 権限チェック
        //フレンド

        $status = db_common_friend_status($u, $target_c_member_id);
        if (!$status['is_friend']) {
            handle_kengen_error();
        }
        //---

        list($msg_subject, $msg_body) =
            create_message_commu_invite($u, $body, $target_c_commu_id);

        do_common_send_message_syoukai_commu($u, $target_c_member_id, $msg_subject, $msg_body);

        $commu = _db_c_commu4c_commu_id($target_c_commu_id);
        $c_member_id_admin = $commu['c_member_id_admin'];
        $public_flag = $commu['public_flag'];
        if (($c_member_id_admin == $u) && ($public_flag != 'public')) {
            db_commu_insert_c_commu_admin_invite($target_c_commu_id, $target_c_member_id);
        }

        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('ktai', 'page_c_home', $p);
    }
}

?>

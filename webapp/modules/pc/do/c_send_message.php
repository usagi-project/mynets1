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

class pc_do_c_send_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $subject = $requests['subject'];
        $body = $requests['body'];
        // ----------

        if (is_null($subject) || $subject === '') {
            $p = array(
                'target_c_commu_id' => $target_c_commu_id,
                'msg' => 'タイトルを入力してください',
            );
            openpne_redirect('pc', 'page_c_send_message', $p);
        }
        if (is_null($body) || $body === '') {
            $p = array(
                'target_c_commu_id' => $target_c_commu_id,
                'msg' => 'メッセージを入力してください',
            );
            openpne_redirect('pc', 'page_c_send_message', $p);
        }

        //--- 権限チェック
        //コミュニティ管理者
        if (!_db_is_c_commu_admin($target_c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---
        $c_member_id_list = p_c_commu_member_id_list4c_commu_id($target_c_commu_id);

        foreach ($c_member_id_list as $c_member_id) {
            if ($c_member_id == $u)continue;
            do_common_send_message_sankasya_commu($u, $c_member_id, $subject, $body);
        }
        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('pc', 'page_c_home', $p);
    }
}

?>

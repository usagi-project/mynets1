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

class pc_do_c_event_invite extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $c_member_ids = $requests['c_member_id'];
        $body = $requests['body'];
        // ----------
        $c_topic = c_event_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];

        if (!$c_member_ids) {
            $p = array(
                'target_c_commu_topic_id' => $c_commu_topic_id,
                'msg' => "紹介先の".WORD_MY_FRIEND."を選択してださい",
            );
            openpne_redirect('pc', 'page_c_event_invite', $p);
        }

        //--- 権限チェック

        //イベント参加者でないと送信できない
        if (!_db_is_c_event_member($c_commu_topic_id, $u)) {
            handle_kengen_error();
        }
        //---

        list($msg_subject, $msg_body) =
            create_message_event_invite($u, $body, $c_commu_topic_id);

        foreach ($c_member_ids as $key => $value) {
            do_common_send_message_event_invite($u, $value, $msg_subject, $msg_body);
        }

        $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
        openpne_redirect('pc', 'page_c_event_invite_end', $p);
    }
}
?>

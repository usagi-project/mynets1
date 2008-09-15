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

require_once OPENPNE_WEBAPP_DIR . "/components/count/commu/count_commu_count.class.php";

/**
 * コメント削除
 */
class pc_do_c_bbs_delete_c_commu_topic_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        $target_c_commu_topic_comment_id = $requests['target_c_commu_topic_comment_id'];

        //--- 権限チェック
        //コミュニティ管理者 or コミュニティ参加者

        $c_commu_topic_comment = do_c_bbs_c_commu_topic_comment4c_commu_topic_comment_id($target_c_commu_topic_comment_id);

        $c_commu_topic = _do_c_bbs_c_commu_topic4c_commu_topic_id($c_commu_topic_comment['c_commu_topic_id']);
        $c_commu_id = $c_commu_topic['c_commu_id'];

        $status = db_common_commu_status($u, $c_commu_id);
        if ($c_commu_topic_comment['number']=="0") {
            handle_kengen_error();
        }
        if (!$status['is_commu_admin']
            && $c_commu_topic_comment['c_member_id'] != $u) {
            handle_kengen_error();
        }
        //---

        do_c_bbs_delete_c_commu_topic_comment($target_c_commu_topic_comment_id);

        if ($c_commu_topic['event_flag']) {
            $datacount = new Commu_Count('event_comment_count', $u);
            $datacount->addCount(-1);
            $action = 'page_c_event_detail';
        } else {
            $datacount = new Commu_Count('topic_comment_count', $u);
            $datacount->addCount(-1);
            $action = 'page_c_topic_detail';
        }
        $p = array('target_c_commu_topic_id' => $c_commu_topic_comment['c_commu_topic_id']);
        openpne_redirect('pc', $action, $p);
    }
}

?>

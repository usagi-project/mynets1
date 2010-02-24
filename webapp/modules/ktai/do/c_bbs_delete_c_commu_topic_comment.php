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
 * トピックコメントを削除
 */
class ktai_do_c_bbs_delete_c_commu_topic_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];


        // --- リクエスト変数
        $target_c_commu_topic_comment_id = $requests['target_c_commu_topic_comment_id'];
        // ----------
        $c_commu_topic_comment = do_c_bbs_c_commu_topic_comment4c_commu_topic_comment_id($target_c_commu_topic_comment_id);

        //--- 権限チェック
        //コミュニティ管理者 or コメント作成者

        $c_commu_topic = _do_c_bbs_c_commu_topic4c_commu_topic_id($c_commu_topic_comment['c_commu_topic_id']);
        $c_commu_id = $c_commu_topic['c_commu_id'];

        $status = db_common_commu_status($u, $c_commu_id);
        if (!$status['is_commu_admin']
            && $c_commu_topic_comment['c_member_id'] != $u) {
            handle_kengen_error();
        }
        //---

        do_c_bbs_delete_c_commu_topic_comment($target_c_commu_topic_comment_id);

        $p = array('target_c_commu_topic_id' => $c_commu_topic_comment['c_commu_topic_id']);
        openpne_redirect('ktai', 'page_c_bbs', $p);
    }
}

?>

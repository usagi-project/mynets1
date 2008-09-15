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

class ktai_do_c_topic_edit_update_c_commu_topic extends OpenPNE_Action
{
    function handleError($errors)
    {
        ktai_display_error($errors);
    }

    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $tail = $GLOBALS['KTAI_URL_TAIL'];

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $body = $requests['body'];
        $title = $requests['title'];
        // ----------

        //--- 権限チェック
        //トピック作成者 or コミュニティ管理者

        $c_topic = c_topic_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];

        if (!_db_is_c_topic_admin($c_commu_topic_id, $u) &&
            !_db_is_c_commu_admin($c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        $update_c_commu_topic = array(
            'name'       => $title,
            'event_flag' => 0,
        );
        do_c_event_edit_update_c_commu_topic($c_commu_topic_id, $update_c_commu_topic);

        $update_c_commu_topic_comment = array(
            'body' => $body,
        );
        do_c_event_edit_update_c_commu_topic_comment($c_commu_topic_id, $update_c_commu_topic_comment);

        $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
        openpne_redirect('ktai', 'page_c_bbs', $p);
    }
}

?>

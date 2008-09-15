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

class pc_page_c_topic_write_delete_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_topic_comment_id = $requests['target_c_commu_topic_comment_id'];
        // ----------

        $c_commu_topic_comment = c_event_write_delete_confirm_c_commu_topic_comment4c_commu_topic_comment_id($c_commu_topic_comment_id);
        $c_commu_id = $c_commu_topic_comment['c_commu_id'];
        $c_commu_topic_id = $c_commu_topic_comment['c_commu_topic_id'];
        $c_commu = _db_c_commu4c_commu_id($c_commu_id);

        //--- 権限チェック
        if ($c_commu_topic_comment['c_member_id']!=$u&&$c_commu['c_member_id_admin']!=$u) {
            handle_kengen_error();
        }
        //---

        $this->set('inc_navi', fetch_inc_navi("c", $c_commu_id));
        $this->set('c_commu_id', $c_commu_id);
        $this->set('c_commu_topic_id', $c_commu_topic_id);
        $this->set('c_commu_topic_comment', $c_commu_topic_comment);
        $this->set("c_member", db_common_c_member4c_member_id($c_commu_topic_comment['c_member_id']));
        return 'success';
    }
}

?>

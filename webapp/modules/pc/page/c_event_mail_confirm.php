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

class pc_page_c_event_mail_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $c_member_ids = $requests['c_member_id'];
        $body = $requests['body'];
        // ----------

        if (!$c_member_ids) {
            $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
            openpne_redirect('pc', 'page_c_event_mail', $p);
        }

        $c_topic = c_event_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];


        //--- 権限チェック
        if (!p_common_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }
        if (!_db_is_c_event_admin($c_commu_topic_id, $u)) {
            handle_kengen_error();
        }
        //---


        $this->set('c_commu', _db_c_commu4c_commu_id($c_commu_id));

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));
        $this->set('c_mail_member', p_c_event_mail_confirm_list4c_member_ids($c_member_ids));

        $this->set('body', $body);
        $this->set('c_member_ids', implode(',', $c_member_ids));
        $this->set("c_commu_id", $c_commu_id);
        $this->set("c_commu_topic_id", $c_commu_topic_id);
        return 'success';
    }
}

?>

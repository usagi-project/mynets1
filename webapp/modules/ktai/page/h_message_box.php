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

class ktai_page_h_message_box extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $direc_r = $requests['direc_r'];
        $page_r = $requests['page_r'];
        $direc_s = $requests['direc_s'];
        $page_s = $requests['page_s'];
        // ----------

        if (!$target_c_member_id) $target_c_member_id = $u;

        // 1ページ当たりに表示するメッセージ数
        $page_size = 5;

        $page_r += $direc_r;
        $page_s += $direc_s;

        $list_r = k_p_h_message_box_c_message_received_list4c_member_id4range($u, $page_size, $page_r);
        $this->set("c_message_received_list", $list_r[0]);
        $this->set("page_r", $page_r);
        $this->set("is_prev_r", $list_r[1]);
        $this->set("is_next_r", $list_r[2]);
        $this->set("count_messages_received", $list_r[3]);

        $list_s = k_p_h_message_box_c_message_sent_list4c_member_id4range($u, $page_size, $page_s);
        $this->set("c_message_sent_list", $list_s[0]);
        $this->set("page_s", $page_s);
        $this->set("is_prev_s", $list_s[1]);
        $this->set("is_next_s", $list_s[2]);
        $this->set("count_messages_sent", $list_s[3]);

        return 'success';
    }
}

?>

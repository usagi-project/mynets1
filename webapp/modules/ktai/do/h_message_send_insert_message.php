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

class ktai_do_h_message_send_insert_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $subject = $requests['subject'];
        $body = $requests['body'];
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        if (is_null($subject) || $subject === '') {
            $p = array('msg' => 2);
            openpne_redirect('ktai', 'page_h_message_send', $p);
        }

        if (is_null($body) || $body === '') {
            $p = array('msg' => 1);
            openpne_redirect('ktai', 'page_h_message_send', $p);
        }

        //--- 権限チェック
        //自分以外

        if ($target_c_member_id == $u) {
            handle_kengen_error();
        }
        //---


        $c_member_id_from = $u;

        do_common_send_message($c_member_id_from, $target_c_member_id, $subject, $body);

        openpne_redirect('ktai', 'page_h_message_box');
    }
}

?>

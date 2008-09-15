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
 * フレンドリクエストを送る
 */
class pc_do_f_link_request extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();


        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        $c_member_id_from = $u;
        $c_member_id_to   = $target_c_member_id;

        $status = do_common_get_f_link_status($c_member_id_from, $c_member_id_to);
        $p = array('target_c_member_id' => $target_c_member_id);

        switch($status) {
        //リクエスト(承認送信画面)
        case STATUS_F_LINK_FLAT;
            openpne_redirect('pc', 'page_f_link_request', $p);
            break;
        //リクエスト(リンク承認待ち)
        case STATUS_F_LINK_WAIT;
            openpne_redirect('pc', 'page_f_link_request_err_wait', $p);
            break;
        //リクエスト(フレンドリンク済)
        case STATUS_F_LINK_ALREADY;
            openpne_redirect('pc', 'page_f_link_request_err_already', $p);
            break;
        }
    }
}

?>

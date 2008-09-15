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

class pc_page_f_link_request extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $body = $requests['body'];
        // ----------

        $c_member = db_common_c_member4c_member_id($target_c_member_id);
        if (!$c_member) {
            openpne_redirect('pc', 'page_h_err_f_home');
        }

        $frined_status=db_common_friend_status($u, $target_c_member_id);

        if ($target_c_member_id == $u) {
            openpne_redirect('pc', 'page_h_home');
        }

        if ($frined_status['is_friend']) {
            $p = array('target_c_member_id' => $target_c_member_id);
            openpne_redirect('pc', 'page_f_link_request_err_already', $p);
        }

        if ($frined_status['is_friend_confirm']) {
            $p = array('target_c_member_id' => $target_c_member_id);
            openpne_redirect('pc', 'page_f_link_request_err_wait', $p);
        }

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('pc', 'page_h_access_block');
        }

        $this->set('inc_navi', fetch_inc_navi("f", $target_c_member_id));


        //ターゲット情報
        $this->set("target_member", $c_member);

        //ターゲットのid
        $this->set("target_c_member_id", $target_c_member_id);


        $form_val=array(
           'target_c_member_id' => $target_c_member_id,
           'body' => $body,
        );
        //$this->set("form_val" ,$form_val);
        $this->set("form", $form_val);

        return 'success';
    }
}

?>

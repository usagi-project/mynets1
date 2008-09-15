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

class pc_page_o_regist_prof_confirm extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        //<PCKTAI
        if (defined('OPENPNE_REGIST_FROM') &&
                !(OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_PC)) {
            client_redirect_login();
        }
        //>

        // --- リクエスト変数
        $sid = $requests['sid'];
        // ----------

        if (!n_regist_intro_is_active_sid($sid)) {
            $p = array('msg_code' => 'invalid_url');
            openpne_redirect('pc', 'page_o_tologin', $p);
        }

        $pre = do_common_c_member_pre4sid($sid);

        $this->set('inc_page_header', fetch_inc_page_header('regist'));

        $this->set('sid', $sid);
        session_name('OpenPNEpcregist');
        @session_start();
        $this->set('prof', $_REQUEST['prof']);
        $this->set('pc_address', $pre['pc_address']);
        $query_list = p_common_c_password_query4null();
        $query_id = $_REQUEST['c_password_query_id'];
        $this->set('password_query_name', $query_list[$query_id]);

        $this->set('profile_list', db_common_c_profile_list4null());

        return 'success';
    }
}

?>

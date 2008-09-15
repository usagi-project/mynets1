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

class pc_page_o_regist_prof extends OpenPNE_Action
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
        $err_msg = $requests['err_msg'];
                $profs = $requests['profs'];
        // ----------

        if (!n_regist_intro_is_active_sid($sid)) {
            $p = array('msg_code' => 'invalid_url');
            openpne_redirect('pc', 'page_o_tologin', $p);
        }

        $this->set('err_msg', $err_msg);

        session_name('OpenPNEpcregist');
        @session_start();
        $this->set('profs', $_SESSION['prof']);
        //$this->set('profs', $profs);
        //---- inc_ テンプレート用 変数 ----//
        $this->set('inc_page_header', fetch_inc_page_header('regist'));


        $c_member_pre = p_common_c_member_pre4c_member_pre_session($sid);

        $this->set('sid', $sid);
        $this->set('pc_address', $c_member_pre['pc_address']);

        $public_flags = array(
            'public' => '全員に公開',
            'friend' => WORD_MY_FRIEND.'まで公開',
            'private'=> '公開しない',
        );
        $this->set('public_flags', $public_flags);

        $this->set('month_list', p_regist_prof_c_profile_month_list4null());
        $this->set('day_list', p_regist_prof_c_profile_day_list4null());
        $this->set('query_list', p_common_c_password_query4null());

        $this->set('c_profile_list', db_common_c_profile_list());

        return 'success';
    }
}

?>

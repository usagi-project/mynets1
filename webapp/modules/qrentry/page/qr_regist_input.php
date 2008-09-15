<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable 
 *              to obtain it through the world-wide-web, please send a note to 
 *              license@php.net so we can mail you a copy immediately.  
 *
 * @author     Kuniharu Tsujioka
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 *             [2007/09/12]
 * ======================================================================== 
 */


class qrentry_page_qr_regist_input extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }
    function isRegistProgress()
    {
        return true;
    }

    function execute($requests)
    {
        //<PCKTAI
        if (defined('OPENPNE_REGIST_FROM') &&
                !((OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1)) {
            openpne_redirect('ktai', 'page_o_login');
        }
        //>

        // --- リクエスト変数
        $ses = $requests['ses'];
        $c_commu_id = $requests['c_commu_id'] ;
        // ----------

        // セッションが有効かどうか
        if (!$pre = c_member_ktai_pre4session($ses)) {
            // 無効の場合、login へリダイレクト
            openpne_redirect('ktai', 'page_o_login');
        }

        $this->set('SNS_NAME', SNS_NAME);
        $this->set('ses', $ses);
        $this->set('c_profile_pref_list', p_regist_prof_c_profile_pref_list4null());

        $v['month_list'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $v['day_list'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
            21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
            31);
        $public_flags = array(
        'public' => '全員に公開',
        'friend' => WORD_MY_FRIEND_HALF.'まで公開',
        'private'=> '公開しない',
        );
        $this->set('public_flags', $public_flags);

        $this->set('password_query_list', p_common_c_password_query4null());
        //$this->set('profile_list', db_common_c_profile_list());
        $this->set('c_commu_id', $c_commu_id);
        $this->set($v);
        // 入力中の情報保持用セッション変数関係
        $this->set('ses_vars', $_SESSION);
        $this->set('regist_ksid', session_id());

        return 'success';
    }
}

?>

<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable 
 *              to obtain it through the world-wide-web, please send a note to 
 *              license@php.net so we can mail you a copy immediately.  
 *
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     KuniTsuji UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/06/19] Ver1.1.0Nighty package
 * ======================================================================== 
 */

class ktai_do_admin_login extends OpenPNE_Action
{
    /*
    function isSecure()
    {
        return false;
    }
    */
    function handleError($errors)
    {
        ktai_display_error($errors);
    }

    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $p = array();
        // ----------
        $username = $requests['username'];
        $password = $requests['password'];
        $mobileadmin = checkAuthMobileAdminLogin($username, $password);
        if ($mobileadmin !== true) {
            //アカウントパス不正
            $p = array('msg' => "アカウント又はパスワードが不正です");
            openpne_redirect('ktai', 'page_h_admin_login', $p);
        }
        //アクセス日時を記録
        p_common_do_access($u);
        openpne_redirect('ktai', 'page_h_admin_menu', $p);
    }
}

?>

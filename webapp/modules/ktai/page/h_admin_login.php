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
 * @author     Kunitsuji UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/06/19] Ver1.1.0Nighty package
 * ======================================================================== 
 */


class ktai_page_h_admin_login extends OpenPNE_Action
{
    function execute($requests)
    {
        $login_msg = "";
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        //携帯用管理画面ログイン処理
        if (checkAuthMobileAdmin($u)) {
            $login_msg = "管理用のアカウントとパスワードを入力してください。";
            $this->set('login_msg',$login_msg);
        }
        return 'success';
    }
}

?>

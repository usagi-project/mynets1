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

class admin_do_login extends OpenPNE_Action
{
    var $_auth;

    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        $options = array(
            'dsn'         => db_get_dsn(),
            'table'       => MYNETS_PREFIX_NAME . 'c_admin_user',
            'usernamecol' => 'username',
            'passwordcol' => 'password',
            'cryptType'   => 'md5',
        );
        $auth = new OpenPNE_Auth('DB', $options);
        $this->_auth =& $auth;
        $auth->setExpire($GLOBALS['OpenPNE']['admin']['session_lifetime']);
        $auth->setIdle($GLOBALS['OpenPNE']['admin']['session_idletime']);

        // 現在のセッションを削除
        $auth->logout();

        if (!$auth->login($requests['is_save'])) {
            $this->_fail_login();
        }

        admin_client_redirect('top');
    }

    function _fail_login()
    {
        $this->_auth->logout();
        admin_client_redirect('login', 'ログインに失敗しました');
    }
}

?>

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


require_once 'OpenPNE/Auth.php';

$auth = new OpenPNE_Auth();
$auth->setExpire($GLOBALS['OpenPNE']['common']['session_lifetime']);
$auth->setIdle($GLOBALS['OpenPNE']['common']['session_idletime']);

if (   !$auth->auth()
    || !($u = _db_c_member_id4pc_address_encrypted($auth->getUsername()))
    || db_member_is_login_rejected($u)) {
    $auth->logout();

    if (LOGIN_URL_PC) {
        client_redirect_absolute(get_login_url());
    } else {
        $_REQUEST['login_params'] = $_SERVER['QUERY_STRING'];
        openpne_forward('pc', 'page', "o_login");
        exit;
    }
}

$auth->uid($u);
$GLOBALS['AUTH'] = $auth;

if(!isset($_COOKIE["USAGISESSION"])) {
    setcookie("USAGISESSION", "1",time()+180);
    p_common_do_access($u);
}

?>

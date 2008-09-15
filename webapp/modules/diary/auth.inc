<?php
/**
 * @copyright 2007 Kei Kubo
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

?>

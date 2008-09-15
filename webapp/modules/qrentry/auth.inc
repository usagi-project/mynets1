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

if (empty($_REQUEST['ksid'])) {
    __logout();
}

session_name('OpenPNEktai');
session_id($_REQUEST['ksid']);
session_start();

if (OPENPNE_SESSION_CHECK_URL) {
    if (@$_SESSION['OPENPNE_URL'] != OPENPNE_URL) {
        __logout(15);
    }
}

if (   empty($_SESSION['c_member_id'])
    || !k_auth($_SESSION['c_member_id'])
    || db_member_is_login_rejected($_SESSION['c_member_id'])) {
    __logout(15);
}

/*
//2008-04-18 KUNIHARU Tsujioka Secureの観点から削除
// 携帯アドレスのチェック
$c_member_id = _db_c_member_id4ktai_address_encrypted($_SESSION['ktai_address']);
if ($c_member_id != $_SESSION['c_member_id']) {
    __logout(15);
}
*/

// セッションの有効期限
$lifetime = $GLOBALS['OpenPNE']['ktai']['session_lifetime'];
$idletime = $GLOBALS['OpenPNE']['ktai']['session_idletime'];
if (!isset($_SESSION['timestamp']) ||
    ($lifetime && ($_SESSION['timestamp'] + $lifetime) < time())
   ) {
    __logout(15, $_SESSION['c_member_id']);
}
if (!isset($_SESSION['idle']) ||
    ($idletime && ($_SESSION['idle'] + $idletime) < time())
   ) {
    __logout(15, $_SESSION['c_member_id']);
}

$_SESSION['idle'] = time();

$GLOBALS['KTAI_C_MEMBER_ID'] = $_SESSION['c_member_id'];
$GLOBALS['KTAI_URL_TAIL'] = "ksid=" . session_id();


function __logout($msg = 0, $c_member_id = 0)
{
    @session_destroy();

    if ($msg) {
        $_REQUEST['msg'] = $msg;
    }
    if ($c_member_id) {
        $c_member_secure = db_common_c_member_secure4c_member_id($c_member_id);
        $_REQUEST['kad'] = t_encrypt($c_member_secure['ktai_address']);
    }
    $_REQUEST['login_params'] = $_SERVER['QUERY_STRING'];
    openpne_forward('ktai', 'page', 'o_login');
    exit;
}

?>

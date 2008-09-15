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

class pc_do_o_login extends OpenPNE_Action
{
    var $_auth;
    var $_lc;
    var $_login_params;

    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {

        $this->_login_params = $requests['login_params'];
        if (is_ktai_mail_address($requests['username']) === false) {
            $options = array(
                'dsn'         => db_get_dsn(),
                'table'       => MYNETS_PREFIX_NAME . 'c_member_secure',
                'usernamecol' => 'pc_address',
                'passwordcol' => 'hashed_password',
                'cryptType'   => 'md5',
            );
        } else {
            $options = array(
                'dsn'         => db_get_dsn(),
                'table'       => MYNETS_PREFIX_NAME . 'c_member_secure',
                'usernamecol' => 'ktai_address',
                'passwordcol' => 'hashed_password',
                'cryptType'   => 'md5',
            );
        }
        $auth = new OpenPNE_Auth('DB', $options);
        $this->_auth =& $auth;
        $auth->setExpire($GLOBALS['OpenPNE']['common']['session_lifetime']);
        $auth->setIdle($GLOBALS['OpenPNE']['common']['session_idletime']);

        if ($auth->auth()){
            openpne_redirect('pc', 'page_h_home');
        }

        //すでにログイン中かどうかを判定（PHPSESSIDでチェック）
        //上記のauth()へ移動した。
        //if (!empty($_REQUEST['PHPSESSID'])) {
            //openpne_redirect('pc', 'page_h_home');
        //}
        // 現在のセッションを削除
        $auth->logout();
        if (LOGIN_CHECK_ENABLE) {
            include_once 'OpenPNE/LoginChecker.php';
            $options = array(
                'check_num'   => LOGIN_CHECK_NUM,
                'check_time'  => LOGIN_CHECK_TIME,
                'reject_time' => LOGIN_REJECT_TIME,
            );
            $this->_lc =& new OpenPNE_LoginChecker($options);
        }

        if (!$auth->login($requests['is_save'], true)) {
            $this->_fail_login();
        }

        if (LOGIN_CHECK_ENABLE && $this->_lc->is_rejected()) {
            $this->_fail_login();
        }

        db_api_update_token($auth->uid());
        $url = OPENPNE_URL;
        if ($this->_login_params) {
            $url .= '?' . $this->_login_params;
        }
        $u = _db_c_member_id4pc_address_encrypted($auth->getUsername());
        reset_se_myinfo($u);
        client_redirect_absolute($url);
    }

    function _fail_login()
    {
        if (LOGIN_CHECK_ENABLE) {
            $this->_lc->fail_login();
        }
        $this->_auth->logout();
        $p = array('msg_code' => 'login_failed', 'login_params' => $this->_login_params);
        openpne_redirect('pc', 'page_o_tologin', $p);
    }
}

?>

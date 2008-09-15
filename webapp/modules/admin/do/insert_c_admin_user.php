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

// プロフィール項目追加
class admin_do_insert_c_admin_user extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('insert_c_admin_user', array_shift($errors));
    }

    function execute($requests)
    {
        $errors = array();
        if (db_admin_exists_c_admin_username($requests['username'])) {
            $errors[] = 'そのメンバー名は既に登録されています';
        }
        if ($requests['password'] != $requests['password2']) {
            $errors[] = 'パスワードが一致していません';
        }
        if ($errors) {
            $this->handleError($errors);
        }

        db_admin_insert_c_admin_user(
            $requests['username'],
            $requests['password'],
            $requests['auth_type']
        );
        admin_client_redirect('list_c_admin_user', 'アカウントを追加しました');
    }
}

?>

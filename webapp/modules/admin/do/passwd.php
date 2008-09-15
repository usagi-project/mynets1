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

// パスワード再発行
class admin_do_passwd extends OpenPNE_Action
{
    function execute($requests)
    {
        $c_member_id = $requests['target_c_member_id'];
        $password = $requests['password'];

        if (!ctype_alnum($password) ||
            strlen($password) < 6 ||
            strlen($password) > 12) {
            admin_client_redirect('passwd',
                'パスワードは6～12文字の半角英数で入力してください',
                'target_c_member_id='.$c_member_id);
        }

        if ($requests['password'] !== $requests['password2']) {
            admin_client_redirect('passwd',
                'パスワードが一致していません',
                'target_c_member_id='.$c_member_id);
        }

        //パスワード変更
        do_common_update_password($c_member_id, $password);

        //メール送信
        $c_member_secure = db_common_c_member_secure4c_member_id($c_member_id);
        if ($c_member_secure['pc_address']) {
            do_password_query_mail_send($c_member_id, $c_member_secure['pc_address'], $password);
        } else {
            db_mail_send_m_ktai_password_query($c_member_id, $password);
        }

        admin_client_redirect('top', 'メンバーのパスワードを変更し、メールを送信しました');
    }
}

?>

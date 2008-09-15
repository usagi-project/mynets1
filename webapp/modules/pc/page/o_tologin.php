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

class pc_page_o_tologin extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        $url = get_login_url();
        if ($requests['login_params']) {
            if (strrpos($url, '?') !== false) {
                $url .= '&';
            } else {
                $url .= '?';
            }
            $url .= 'login_params=' . urlencode($requests['login_params']);
        }
        // リダイレクト
        header('Refresh: 3; URL=' . $url);


        //---- inc_ テンプレート用 変数 ----//
        $this->set('inc_page_header', fetch_inc_page_header('public'));

        $msg = '';
        switch ($requests['msg_code']) {
        case 'login_failed':
            $msg = 'ログインに失敗しました。再度、ログイン操作を行ってください。';
            break;
        case 'logout':
            $msg = 'ログアウトしました。';
            break;
        case 'password_query':
            $msg = '新しいパスワードをメールで送信しました。';
            break;
        case 'change_mailaddress':
            $msg = 'メールアドレスが変更されました。';
            break;
        case 'change_password':
            $msg = 'パスワードを変更しました。新しいパスワードで再ログインしてください。';
            break;
        case 'taikai':
            $msg = '退会完了しました。ご利用ありがとうございました。';
            break;
        case 'invalid_url':
            $msg = 'このURLは既に無効になっています。';
            break;
        }
        $this->set('msg', $msg);

        $this->set('login_url', $url);
        return 'success';
    }
}

?>

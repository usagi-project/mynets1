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

/**
 * 招待メール送信
 */
class pc_do_h_invite_insert_c_invite extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        if (!IS_USER_INVITE) {
            openpne_forward('pc', 'page', 'h_err_invite');
            exit;
        }

        // --- リクエスト変数
        $mail = $requests['mail'];
        $message = $requests['message'];
        // ----------

        if (MYNETS_USE_CAPTCHA && empty($_SESSION['captcha_confirm']) || $requests['captcha_confirm'] != md5($_SESSION['captcha_confirm'])) {
            unset($_SESSION['captcha_confirm']);
            $msg = "確認キーワードが誤っています";
            $p = array('msg' => $msg);
            openpne_redirect('pc', 'page_h_invite', $p);
        }
        unset($_SESSION['captcha_confirm']);

        if (!db_common_is_mailaddress($mail)) {
            $msg = "メールアドレスを入力してください";
            $p = array('msg' => $msg);
            openpne_redirect('pc', 'page_h_invite', $p);
        }

        if (p_is_sns_join4mail_address($mail)) {
            $msg = "そのアドレスは既に登録済みです";
            $p = array('msg' => $msg);
            openpne_redirect('pc', 'page_h_invite', $p);
        }

        $session = create_hash();
        $c_member_id_invite = $u;

        if (is_ktai_mail_address($mail)) {
            //<PCKTAI
            if (defined('OPENPNE_REGIST_FROM') &&
                    !((OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1)) {
                $msg = '携帯アドレスには招待を送ることができません';
                $p = array('msg' => $msg);
                openpne_redirect('pc', 'page_h_invite', $p);
            }
            //>

            // c_member_ktai_pre に追加
            if (do_common_c_member_ktai_pre4ktai_address($mail)) {
                do_update_c_member_ktai_pre($session, $mail, $c_member_id_invite);
            } else {
                do_insert_c_member_ktai_pre($session, $mail, $c_member_id_invite);
            }

            h_invite_insert_c_invite_mail_send($session, $c_member_id_invite, $mail, $message);

        } else {
            //<PCKTAI
            if (defined('OPENPNE_REGIST_FROM') &&
                    !(OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_PC)) {
                $msg = 'PCアドレスには招待を送ることができません';
                $p = array('msg' => $msg);
                openpne_redirect('pc', 'page_h_invite', $p);
            }
            //>

            // c_member_pre に追加
            if (do_common_c_member_pre4pc_address($mail)) {
                do_h_invite_update_c_invite($c_member_id_invite, $mail, $message, $session);
            } else {
                do_h_invite_insert_c_invite($c_member_id_invite, $mail, $message, $session);
            }

            do_h_invite_insert_c_invite_mail_send($c_member_id_invite, $session, $message, $mail);
        }

        openpne_redirect('pc', 'page_h_invite_end');
    }
}

?>

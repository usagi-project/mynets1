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
class ktai_do_h_invite_insert_c_invite extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        if (!IS_USER_INVITE) {
            ktai_display_error(SNS_NAME . 'では、メンバーによる招待は行えません');
        }

        // --- リクエスト変数
        $mail = $requests['mail_address'];
        $body = $requests['body'];
        // ----------

        if (!$mail) {
            $p = array('msg' => 12);
            openpne_redirect('ktai', 'page_h_invite', $p);
        }
        if (!db_common_is_mailaddress($mail)) {
            $p = array('msg' => 31);
            openpne_redirect('ktai', 'page_h_invite', $p);
        }
        if (p_is_sns_join4mail_address($mail)) {
            $p = array('msg' => 9);
            openpne_redirect('ktai', 'page_h_invite', $p);
        }

        $session = create_hash();

        if (is_ktai_mail_address($mail)) {
            //<PCKTAI
            if (defined('OPENPNE_REGIST_FROM') &&
                    !((OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1)) {
                $p = array('msg' => 13);
                openpne_redirect('ktai', 'page_h_invite', $p);
            }
            //>

            // c_member_ktai_pre に追加
            if (do_common_c_member_ktai_pre4ktai_address($mail)) {
                do_update_c_member_ktai_pre($session, $mail, $u);
            } else {
                do_insert_c_member_ktai_pre($session, $mail, $u);
            }

            h_invite_insert_c_invite_mail_send($session, $u, $mail, $body);

        } else {
            //<PCKTAI
            if (defined('OPENPNE_REGIST_FROM') &&
                    !(OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_PC)) {
                $p = array('msg' => 16);
                openpne_redirect('ktai', 'page_h_invite', $p);
            }
            //>

            // c_member_pre に追加
            if (do_common_c_member_pre4pc_address($mail)) {
                do_h_invite_update_c_invite($u, $mail, $body, $session);
            } else {
                do_h_invite_insert_c_invite($u, $mail, $body, $session);
            }

            do_h_invite_insert_c_invite_mail_send($u, $session, $body, $mail);
        }

        $p = array('msg' => 30);
        openpne_redirect('ktai', 'page_h_invite', $p);
    }
}

?>

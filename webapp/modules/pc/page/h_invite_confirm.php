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

class pc_page_h_invite_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        if (!IS_USER_INVITE) {
            openpne_forward('pc', 'page', 'h_err_invite');
            exit;
        }

        // --- リクエスト変数
        $form_val = $requests;
        // ----------

        $msg = "";
        if (MYNETS_USE_CAPTCHA && empty($_SESSION['captcha_keystring']) || $_SESSION['captcha_keystring'] !=  $requests['captcha']) {
            unset($_SESSION['captcha_keystring']);
            $msg = "確認キーワードが誤っています";
        } else {
            unset($_SESSION['captcha_keystring']);
            if (!db_common_is_mailaddress($form_val['mail'])) {
                $msg = "メールアドレスを正しく入力してください";
            } elseif (p_is_sns_join4mail_address($form_val['mail'])) {
                $msg = "そのアドレスは既に登録済みです";
            } else {
                if (is_ktai_mail_address($form_val['mail'])) {
                    //<PCKTAI
                    if (defined('OPENPNE_REGIST_FROM') &&
                            !((OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1)) {
                        $msg = "携帯アドレスには招待を送ることができません";
                    }
                    //>
                } else {
                    //<PCKTAI
                    if (defined('OPENPNE_REGIST_FROM') &&
                            !(OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_PC)) {
                        $msg = "PCアドレスには招待を送ることができません";
                    }
                    //>
                }
            }
        }

        if ($msg) {
            $_REQUEST['msg'] = $msg;
            openpne_forward('pc', 'page', "h_invite");
            exit;
        }

        $this->set('inc_navi', fetch_inc_navi("h"));

        $this->set('form_val', $form_val);
        $this->set('SNS_NAME', SNS_NAME);

        $random_string = do_common_create_password();
        $_SESSION['captcha_confirm'] = $random_string;
        $this->set('captcha_confirm', md5($random_string));

        return 'success';
    }
}

?>

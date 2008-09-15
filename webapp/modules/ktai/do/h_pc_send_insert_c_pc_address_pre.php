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

class ktai_do_h_pc_send_insert_c_pc_address_pre extends OpenPNE_Action
{
    function execute($requests)
    {
        //<PCKTAI
        if (!OPENPNE_ENABLE_PC) {
            openpne_redirect('ktai', 'page_h_home');
        }
        //>

        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $pc_address = $requests['pc_address'];
        // ----------

        $errors = array();
        if (!db_common_is_mailaddress($pc_address)) {
            $errors[] = 'メールアドレスを正しく入力してください';
        } elseif (is_ktai_mail_address($pc_address)) {
            $errors[] = '携帯アドレスは入力できません';
        } elseif (do_common_c_member4pc_address($pc_address)) {
            $errors[] = '入力したメールアドレスは既に登録されています';
        }

        if ($errors) {
            ktai_display_error($errors);
        }

        do_h_config_1($u, $pc_address);

        openpne_redirect('ktai', 'page_h_pc_send_confirm');
    }
}

?>

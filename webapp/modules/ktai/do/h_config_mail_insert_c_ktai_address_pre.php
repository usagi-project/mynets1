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

class ktai_do_h_config_mail_insert_c_ktai_address_pre extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $ktai_address = $requests['ktai_address'];
        // ----------

        //--- 権限チェック
        //必要なし

        //---

        if (!db_common_is_mailaddress($ktai_address)) {
            // メールアドレスを入力してください
            $p = array('msg' => 12);
            openpne_redirect('ktai', 'page_h_config_mail', $p);
        }

        if (!is_ktai_mail_address($ktai_address)) {
            // 携帯アドレス以外は指定できません
            $p = array('msg' => 16);
            openpne_redirect('ktai', 'page_h_config_mail', $p);
        }

        if (p_is_sns_join4mail_address($ktai_address)) {
            // このアドレスはすでに登録されています
            $p = array('msg' => 17);
            openpne_redirect('ktai', 'page_h_config_mail', $p);
        }

        k_do_delete_c_member_ktai_pre4ktai_address($ktai_address);
        k_do_delete_c_ktai_address_pre4ktai_address($ktai_address);

        $session = create_hash();
        k_do_insert_c_ktai_address_pre($u, $session, $ktai_address);

        do_mail_sns_change_ktai_mail_send($u, $session, $ktai_address);

        openpne_redirect('ktai', 'page_o_send_mail_end');
    }
}

?>

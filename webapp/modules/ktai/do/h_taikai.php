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
 * SNSを退会する
 */
class ktai_do_h_taikai extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        if ($u == 1) {
            openpne_redirect('ktai', 'page_h_config');
        }

        $password = $requests['password'];
        if (!db_common_authenticate_password($u, $password)) {
            $p = array('msg' => 18);
            openpne_redirect('ktai', 'page_h_taikai_confirm', $p);
        }

        //退会完了メール送信
        do_common_send_mail_taikai_end_ktai($u);

        //退会処理
        //退会者データの保存
        $delete_comment = $requests['comment'];
        setDeleteMemberData($u,$delete_comment);
        //退会処理
        db_common_delete_c_member($u);

        @session_destroy();
        openpne_redirect('ktai', 'page_o_taikai_end');
    }
}
?>

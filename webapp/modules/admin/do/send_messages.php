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

// メッセージ一括送信
class admin_do_send_messages extends OpenPNE_Action
{
    function execute($requests)
    {
        $module_name = ADMIN_MODULE_NAME;
        $send_type = $requests['send_type'];

        if (empty($requests['c_member_ids'])) {
            admin_client_redirect('list_c_member');
        }

        if (empty($requests['subject'])) {
            openpne_forward($module_name, 'page', 'send_messages');
        }
        if (empty($requests['body'])) {
            openpne_forward($module_name, 'page', 'send_messages');
        }

        // 送信者はとりあえず1番で固定
        $c_member_id_from = 1;

        foreach ($requests['c_member_ids'] as $c_member_id) {
            if ($c_member_id_from == $c_member_id) continue;
            switch ($send_type) {
                case "mail":
                    do_admin_send_mail($c_member_id, $requests['subject'], $requests['body']);
                break;
                case "message":
                    do_admin_send_message($c_member_id_from, $c_member_id, $requests['subject'], $requests['body']);
                break;
                default:
                    openpne_forward($module_name, 'page', 'send_messages');
                break;
            }
        }

        switch ($send_type) {
            case "mail":
                $sended_name = "メール";
            break;
            case "message":
                $sended_name = "メッセージ";
            break;
        }

        admin_client_redirect('top', $sended_name.'を送信しました');
    }
}

?>

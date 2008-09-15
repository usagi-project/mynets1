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

// 一括招待メール送信 確認画面
class admin_page_send_invites_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $v = array();

        $v['SNS_NAME'] = SNS_NAME;

        $v['cannot_send'] = true;
        $c_member_id_invite = 1;

        if ($requests['pc_mails'] &&
            (!defined('OPENPNE_REGIST_FROM') || (OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_PC))
            ) {
            $params = array(
                'c_member'       => db_common_c_member4c_member_id($c_member_id_invite),
                'sid'            => 'xxxxxxxxxx',
                'invite_message' => $requests['message'],
            );
            list($subject, $body) = fetch_mail_m_tpl('m_pc_syoutai_mail', $params);
            $v['pc_subject'] = $subject;
            $v['pc_body'] = $body;
            $v['cannot_send'] = false;
        }

        if ($requests['ktai_mails'] &&
            (!defined('OPENPNE_REGIST_FROM') || ((OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1))
            ) {
            $params['SNS_NAME'] = SNS_NAME;
            $params['url'] = openpne_gen_url('ktai', 'page_o_regist_pre') . '&ses=xxxxxxxxxx';
            $params['c_member'] = db_common_c_member4c_member_id($c_member_id_invite);
            $params['message'] = $requests['message'];
            list($subject, $body) = fetch_mail_m_tpl('m_ktai_regist_invite', $params);
            $v['ktai_subject'] = $subject;
            $v['ktai_body'] = $body;
            $v['cannot_send'] = false;
        }

        $this->set($v);
        return 'success';
    }
}

?>

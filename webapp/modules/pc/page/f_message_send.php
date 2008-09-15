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

class pc_page_f_message_send extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $form_val['subject'] = $requests['subject'];
        $form_val['body'] = $requests['body'];
        $box = $requests['box'];
        $is_syusei = $requests['is_syusei'];
        $form_val['target_c_message_id'] = $requests['target_c_message_id'];
        $form_val['jyusin_c_message_id'] = $requests['jyusin_c_message_id'];
        // ----------

        // 権限チェック
        if ($form_val['target_c_message_id']) {
            $c_message = _db_c_message4c_message_id($form_val['target_c_message_id']);
            if ($c_message['c_member_id_from'] != $u) {
                if ($c_message['c_member_id_to'] != $u || !$c_message['is_send']) {
                    handle_kengen_error();
                }
            }
        }

        $syusei = 0;
        if ($form_val['subject'] && $form_val['body'])
            $syusei = 1;

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('pc', 'page_h_access_block');
        }

        //メッセージIDから情報を取り出す
        if ($box == "savebox" && $form_val['target_c_message_id']) {
            $tmplist = _db_c_message4c_message_id($form_val['target_c_message_id']);
            $form_val['body'] = $tmplist['body'];
            $form_val['subject'] = $tmplist['subject'];
            $form_val['target_c_message_id'] = $form_val['target_c_message_id'];
            if (!$target_c_member_id) {
                $target_c_member_id = $tmplist['c_member_id_to'];
            }
        } elseif (!$syusei && $form_val['target_c_message_id']) {
            $tmplist = _db_c_message4c_message_id($form_val['target_c_message_id']);
            $form_val['body'] = message_body2inyou($tmplist['body']);
            if (!strstr($tmplist['subject'],"Re:")) {
                $form_val['subject'] = "Re:".$tmplist['subject'];
            } else {
                $form_val['subject'] = $tmplist['subject'];
            }
            $form_val['target_c_message_id'] = $form_val['target_c_message_id'];
            if (!$target_c_member_id) {
                $target_c_member_id = $tmplist['c_member_id_from'];
            }
        }

        $this->set('inc_navi', fetch_inc_navi("f", $target_c_member_id));

        //ターゲット情報
        $this->set("target_member", db_common_c_member4c_member_id($target_c_member_id));

        //ターゲットのid
        $this->set("target_c_member_id", $target_c_member_id);
        //ターゲットのid
        $this->set("target_c_message_id", $form_val['target_c_message_id']);

        $this->set("form_val", $form_val);
        $this->set("box", $box);

        /////AA local var samples AA//////////////////////////
        return 'success';
    }
}
?>

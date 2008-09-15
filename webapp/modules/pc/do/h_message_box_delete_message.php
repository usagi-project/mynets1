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
 * メッセージを削除
 */
class pc_do_h_message_box_delete_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_message_id = $requests['c_message_id'];
        $box = $requests['box'];
        // ----------

        //--- 権限チェック
        //TODO: if / foreachの中に入っている
        //---

        //削除するメッセージを選択してない
        if (count($c_message_id) == 0) {
            $p = array('box' => $box);
            openpne_redirect('pc', 'page_h_message_box', $p);
        }

        if ($box == "trash") {
            //ごみ箱から
            if (!empty($requests['move']) ) {
                //ごみ箱から移動
                foreach ($c_message_id as $val) {
                    $c_message = _db_c_message4c_message_id($val);
                    if ($c_message['c_member_id_from'] != $u
                        && $c_message['c_member_id_to'] != $u) {
                        handle_kengen_error();
                    }
                    do_h_message_box_move_message($val, $u);
                }
                $p = array('box' => $box);
                openpne_redirect('pc', 'page_h_message_box', $p);
            } else {
                //ごみ箱から完全削除　復元方法なし
                foreach ($c_message_id as $val) {
                    $c_message = _db_c_message4c_message_id($val);
                    if ($c_message['c_member_id_from'] == $u) {
                        do_delete_c_message_from_trash($val);
                    } elseif ($c_message['c_member_id_to'] == $u) {
                        do_delete_c_message_to_trash($val);
                    } else {
                        handle_kengen_error();
                    }
                }
                $p = array('box' => $box);
                openpne_redirect('pc', 'page_h_message_box', $p);
            }
        } else {
            // メッセージをごみ箱へ移動
            foreach ($c_message_id as $val) {
                $c_message = _db_c_message4c_message_id($val);
                if ($c_message['c_member_id_from'] != $u) {
                    if ($c_message['c_member_id_to'] != $u || !$c_message['is_send']) {
                        handle_kengen_error();
                    }
                }
                _do_delete_c_message4c_message_id($val, $u);
            }
        }

        $p = array('box' => $box);
        openpne_redirect('pc', 'page_h_message_box', $p);
    }
}

?>

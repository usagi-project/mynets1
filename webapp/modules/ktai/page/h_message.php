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

class ktai_page_h_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $tail = $GLOBALS['KTAI_URL_TAIL'];

        // --- リクエスト変数
        $target_c_message_id = $requests['target_c_message_id'];
        $from_h_home = $requests['from_h_home'];
        // ----------

        // メッセージデータ取得
        $c_message = _db_c_message4c_message_id($target_c_message_id);

        //--- 権限チェック
        if ($c_message['c_member_id_from'] != $u) {
            if ($c_message['c_member_id_to'] != $u || !$c_message['is_send']) {
                handle_kengen_error();
            }
        }
        //---

        // 既読にする
        p_h_message_update_c_message_is_read4c_message_id($target_c_message_id, $u);

        // メッセージデータ
        //コミュニティおすすめメッセージのURLを置換
        list($c_message['body'], $com_url, $friend_url) = k_p_h_message_ktai_url4url($c_message['body'], $tail);

        $this->set("c_message", $c_message);
        $recheck = true;
        if (!strstr($c_message['subject'],"Re:")) {
            $recheck = false;
        }
        $this->set("recheck",$recheck);
        $this->set("com_url", $com_url);
        $this->set("friend_url", $friend_url);

        return 'success';
    }
}

?>

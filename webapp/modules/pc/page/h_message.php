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

class pc_page_h_message extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_message_id = $requests['target_c_message_id'];
        $from_h_home = $requests['from_h_home'];
        $form_val['subject'] = $requests['subject'];
        $form_val['body'] = $requests['body'];
        $box = $requests['box'];
        $jyusin_c_message_id = $requests['jyusin_c_message_id'];
        $page = $requests['page'];
        // ----------

        $form_val['target_c_message_id'] = $target_c_message_id;

        $this->set('inc_navi', fetch_inc_navi("h"));

        // 既読にする
        p_h_message_update_c_message_is_read4c_message_id($target_c_message_id, $u);

        //---- 受信・送信、閲覧権限のチェック ----//
        // メッセージデータ取得
        $c_message = p_h_message_c_message4c_message_id($target_c_message_id, $u);

        if (!$form_val['subject'])
            $form_val['subject'] = "Re:".$c_message['subject'];

        //--- 権限チェック
        if ($c_message['c_member_id_from'] != $u) {
            if ($c_message['c_member_id_to'] != $u || !$c_message['is_send']) {
                handle_kengen_error();
            }
        }
        //---

        // is_syoudakuがあれば承認待ちリストへリダイレクト
        if ($c_message['is_syoudaku'] && $from_h_home == 1) {
            openpne_redirect('pc', 'page_h_confirm_list');
        }

        //---- ページ本体表示用 変数 ----//

        // メッセージデータ
        $this->set("c_message", $c_message);
        $this->set("form_val", $form_val);
        $this->set("jyusin_c_message_id", $jyusin_c_message_id);

        //ボックス判定
        $this->set("box", $box);

        /*
         * 対象者とのメッセージ送受信一覧のためのデータ抽出
         * 自分と対象者のやり取り一覧を抽出。
         * 画面上は最大10件のリスト。
         * 残りはページングで処理
         */
        $page_size = 5;
        $list = getMessagaList2Member4Me($c_message['c_member_id_to'], $c_message['c_member_id_from'], $page, $page_size);
        
        $this->set('message_list', $list[0]);
        $this->set('is_prev', $list[1]);
        $this->set('is_next', $list[2]);
        //メッセージの数
        $total_num = count($list[0]);
        $this->set('total_num', $total_num);

        $pager = array();
        $pager['start'] = $page_size * ($page - 1) + 1;
        if (($pager['end'] = $page_size * $page) > $total_num) {
            $pager['end'] = $total_num;
        }
        $this->set('page', $page);
        $this->set('pager', $pager);
        if ($c_message['c_member_id_from'] == $u) {
            //自分が送信
            $this->set('tomember', $c_message['c_member_nickname_to']);
        } else {
            //自分が受信
            $this->set('tomember', $c_message['c_member_nickname_from']);
        }
        $this->set('u',$u);
        //---- ページ表示 ----//
        return 'success';
    }
}

?>

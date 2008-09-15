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

require_once OPENPNE_WEBAPP_DIR . "/components/one_word.class.php";

class pc_page_fh_friend_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $order = $requests['order'];
        // ----------

        if (!$target_c_member_id) {
            $target_c_member_id = $u;
        }

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('pc', 'page_h_access_block');
        }

        // navi 振り分け用
        if ($target_c_member_id == $u) {
            $type = "h";
        } else {
            $type = "f";
        }
        $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id));
        $this->set("type", $type);

        //----------PC CONTENT#LEFT
        //メンバー情報
        $this->set("member", db_common_c_member4c_member_id($u));

        //ターゲット情報
        $this->set("target_member", db_common_c_member4c_member_id($target_c_member_id));

        //ターゲットの友達数
        $friend_num = db_friend_count_friends($target_c_member_id);

        $this->set("target_friend_num", $friend_num);

        //----------PC CONTENT#CENTER

        // 1ページ当たりに表示するフレンドの数
        $page_size = 50;
        $page += $direc;

        //ターゲットの詳細な友達リスト
        $list = p_fh_friend_list_friend_list4c_member_id2($target_c_member_id, $page_size, $page, $order);
        $word = new OneWord();
        //友達のひとこと抽出
        foreach ($list[0] as $key => $value) {
            $word->setUid($value['c_member_id']);
            $oneword = $word->get();
            if (!$oneword) {
                $oneword = "";
            }
            $list[0][$key]['friend_oneword'] = $oneword;
        }
        $this->set("order", $order);

        $this->set("target_friend_list_disp", $list[0]);
        $this->set("page", $page);
        $this->set("is_prev", $list[1]);
        $this->set("is_next", $list[2]);

        $this->set("start_num", ($page-1) * $page_size + 1);

        if (($page * $page_size) < $friend_num) {
            $end_num = $page * $page_size;
        } else {
            $end_num = $friend_num;
        }
        $this->set("end_num", $end_num);

        for ($i=1; $i <= $list[3]; $i++) {
            $page_num[] = $i;
        }
        $this->set("page_num", $page_num);

        //あしあとをつける
        if ($target_c_member_id != $u) {
            db_ashiato_insert_c_ashiato($target_c_member_id, $u);
        }

        return 'success';
    }
}

?>

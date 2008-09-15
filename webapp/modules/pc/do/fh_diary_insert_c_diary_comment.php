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

require_once OPENPNE_WEBAPP_DIR . "/components/count/diary/count_diary_count.class.php";

class pc_do_fh_diary_insert_c_diary_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        $tmpfile_1 = $requests['tmpfile_1'];
        $tmpfile_2 = $requests['tmpfile_2'];
        $tmpfile_3 = $requests['tmpfile_3'];
        $body = $requests['body'];
        // ----------

        if (is_null($body) || $body === '') {
            $p = array(
                'target_c_diary_id' => $target_c_diary_id,
                'msg' => "コメントを入力してださい"
            );
            openpne_redirect('pc', 'page_fh_diary', $p);
        }
        if (is_continual_entry($body, $u, $target_c_diary_id, "2")) {
            $p = array(
                'target_c_diary_id' => $target_c_diary_id,
                'msg' => "同じ内容ですでに投稿があります"
            );
            openpne_redirect('pc', 'page_fh_diary', $p);
        }

        //--- 権限チェック

        $c_diary = db_diary_get_c_diary4id($target_c_diary_id);
        $target_c_member_id = $c_diary['c_member_id'];
        $target_c_member = db_common_c_member4c_member_id($target_c_member_id);

        if ($u != $target_c_member_id) {
            // check public_flag
            if (!pne_check_diary_public_flag($target_c_diary_id, $u)) {
                openpne_redirect('pc', 'page_h_err_diary_access');
            }
            //アクセスブロック設定
            if (p_common_is_access_block($u, $target_c_member_id)) {
                openpne_redirect('pc', 'page_h_access_block');
            }
        }
        //---

        //日記コメント書き込み
        $c_diary_comment_id = db_diary_insert_c_diary_comment($u, $target_c_diary_id, $body);
        $sessid = session_id();
        $filename_1 = image_insert_c_image4tmp("dc_{$c_diary_comment_id}_1", $tmpfile_1, $u);
        $filename_2 = image_insert_c_image4tmp("dc_{$c_diary_comment_id}_2", $tmpfile_2, $u);
        $filename_3 = image_insert_c_image4tmp("dc_{$c_diary_comment_id}_3", $tmpfile_3, $u);
        t_image_clear_tmp($sessid);

        db_diary_insert_c_diary_comment_images($c_diary_comment_id, $filename_1, $filename_2, $filename_3);

        //日記コメントが書き込まれたので日記自体を未読扱いにする
        db_diary_update_c_diary_is_checked($target_c_diary_id, 0);

        //2008-03-11 DiaryCount処理を追加 kuniharu Tsujioka
        $datacount = new Diary_Count('diary_comment_count', $u);
        $datacount->addCount();
        //**************************************************

        $p = array(
            'target_c_diary_id' => $target_c_diary_id,
            'comment_count' => db_diary_count_c_diary_comment4c_diary_id($target_c_diary_id)
        );
        openpne_redirect('pc', 'page_fh_diary', $p);
    }
}

?>

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
 * 日記を書く
 */
require_once OPENPNE_WEBAPP_DIR . "/components/count/diary/count_diary_count.class.php";

class ktai_do_h_diary_edit_insert_c_diary extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $subject = $requests['subject'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $target_c_diary_id = $requests['target_c_diary_id'];
        // ----------

        if (is_null($subject) || $subject === '') {
            $p = array('target_c_diary_id' => $target_c_diary_id, 'msg' => 2);
            openpne_redirect('ktai', 'page_h_diary_edit', $p);
        }

        if (is_null($body) || $body === '') {
            $p = array('target_c_diary_id' => $target_c_diary_id, 'msg' => 1);
            openpne_redirect('ktai', 'page_h_diary_edit', $p);
        }


        if (!$target_c_diary_id) {
            if (is_continual_entry($body, $u, "", "1")) {
                $p = array(
                    'target_c_diary_id' => $target_c_diary_id,
                    'msg' => "同じ内容ですでに投稿があります"
                );
                openpne_redirect('ktai', 'page_h_diary_edit', $p);
            }
            $update_c_diary_id = db_diary_insert_c_diary($u, $subject, $body, $public_flag);
        } else {
            $update_c_diary_id = $target_c_diary_id;

            $c_diary = db_diary_get_c_diary4id($target_c_diary_id);
            if ($c_diary['c_member_id'] != $u) {
                handle_kengen_error();
            }
        }

        /*
         * 携帯はWEBでは画像UPLOADなし
         */
        db_diary_update_c_diary($update_c_diary_id, $subject, $body, $public_flag);
        //2008-08-08 DiaryCount処理を追加 kuniharu Tsujioka
        $datacount = new Diary_Count('diary_count', $u);
        $datacount->addCount();
        //**************************************************

        if (!$target_c_diary_id) {
            $p = array('target_c_diary_id' => $update_c_diary_id);
            openpne_redirect('ktai', 'page_h_diary_added', $p);
        } else {
            $p = array('target_c_member_id' => $u);
            openpne_redirect('ktai', 'page_fh_diary_list', $p);
        }
    }
}

?>

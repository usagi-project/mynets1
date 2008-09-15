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

/**
 * 日記コメント削除
 */
class pc_do_fh_diary_delete_c_diary_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        $target_c_diary_comment_id =  $_REQUEST['target_c_diary_comment_id'];

        foreach ($target_c_diary_comment_id as $val) {

            //--- 権限チェック
            //日記作成者 or コメント作成者

            $target_c_diary_comment = _do_c_diary_comment4c_diary_comment_id($val);
            $target_c_diary_id = $target_c_diary_comment['c_diary_id'];

            $c_diary = db_diary_get_c_diary4id($target_c_diary_id);
            if ($c_diary['c_member_id'] != $u
                && $target_c_diary_comment['c_member_id'] != $u) {

                handle_kengen_error();
            }
            //---

            //コメント削除実行
            db_diary_delete_c_diary_comment($val, $u);
        }

        //2008-03-11 DiaryCount処理を追加 kuniharu Tsujioka
        $datacount = new Diary_Count('diary_comment_count', $u);
        $datacount->addCount(-1);
        //**************************************************

        $p = array('target_c_diary_id' => $target_c_diary_id);
        openpne_redirect('pc', 'page_fh_diary', $p);
    }
}

?>

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
 * 日記を修正
 */
class pc_do_h_diary_edit_insert_c_diary extends OpenPNE_Action
{
    function handleError()
    {
        $_REQUEST['msg1'] = $errors['subject'];
        $_REQUEST['msg2'] = $errors['body'];
        $_REQUEST['msg3'] = $errors['public_flag'];
        openpne_forward('pc', 'page', 'h_diary_edit', $errors);
        exit;
    }

    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        $subject = $requests['subject'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $tmpfile_1 = $requests['tmpfile_1'];
        $tmpfile_2 = $requests['tmpfile_2'];
        $tmpfile_3 = $requests['tmpfile_3'];
        $tagsname = explode(' ', trim($requests['tagsname']));
        // ----------

        //--- 権限チェック
        //日記作成者

        $c_diary = db_diary_get_c_diary4id($target_c_diary_id);
        if ($c_diary['c_member_id'] != $u) {
            handle_kengen_error();
        }
        //---

        $sessid = session_id();

        $filename_1 = $filename_2 = $filename_3 = '';

        //タグの登録
        //一度登録されているタグを削除
        delEntryIDTag($target_c_diary_id,'0');
        foreach($tagsname as $value) {
            if (empty($value)) {
                break;
            }
            //入力されたタグが登録されているかどうかを判定
            $c_tags_id = getTagID($value);
            if (is_null($c_tags_id)) {
                //タグが登録されていない場合は、新規で登録
                $c_tags_id = setTagName($c_member_id, $value);
            }

            //日記とタグを関連付ける
            //日記のID、フラグは０で日記、タグID、登録者のID
            setEntryTag($target_c_diary_id, '0', $c_tags_id, $u);

        }

        if ($tmpfile_1) {
            image_data_delete($c_diary['image_filename_1']);
            $filename_1 = image_insert_c_image4tmp("d_{$target_c_diary_id}_1", $tmpfile_1, $u);
        }
        if ($tmpfile_2) {
            image_data_delete($c_diary['image_filename_2']);
            $filename_2 = image_insert_c_image4tmp("d_{$target_c_diary_id}_2", $tmpfile_2, $u);
        }
        if ($tmpfile_3) {
            image_data_delete($c_diary['image_filename_3']);
            $filename_3 = image_insert_c_image4tmp("d_{$target_c_diary_id}_3", $tmpfile_3, $u);
        }

        t_image_clear_tmp($sessid);
        db_diary_update_c_diary($target_c_diary_id, $subject, $body, $public_flag, $filename_1, $filename_2, $filename_3);

        $p = array('target_c_diary_id' => $target_c_diary_id);
        openpne_redirect('pc', 'page_fh_diary', $p);
    }
}

?>

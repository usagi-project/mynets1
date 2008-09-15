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
require_once OPENPNE_WEBAPP_DIR . "/components/count/image/count_image_count.class.php";

/**
 * 日記を書く
 */
class pc_do_h_diary_add_insert_c_diary extends OpenPNE_Action
{
    function handleError($errors)
    {
        $_REQUEST['msg1'] = $errors['subject'];
        $_REQUEST['msg2'] = $errors['body'];
        $_REQUEST['msg3'] = $errors['public_flag'];
        openpne_forward('pc', 'page', 'h_diary_add', $errors);
        exit;
    }

    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $subject = $requests['subject'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $tmpfile_1 = $requests['tmpfile_1'];
        $tmpfile_2 = $requests['tmpfile_2'];
        $tmpfile_3 = $requests['tmpfile_3'];
        $tagsname = explode(' ', trim($requests['tagsname']));
        // ----------

        $sessid = session_id();
        $c_member_id = $u;
        if (is_continual_entry($body, $u, "", "1")) {
            $p = array(
                'target_c_diary_id' => $target_c_diary_id,
                'msg' => "同じ内容ですでに投稿があります"
            );
            openpne_redirect('pc', 'page_fh_diary_list', $p);
        }
        $c_diary_id = db_diary_insert_c_diary($c_member_id, $subject, $body, $public_flag);

        //タグの登録
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
            setEntryTag($c_diary_id, '0', $c_tags_id, $c_member_id);

        }

        //イメージのカウントを実行
        $imgcnt  = 0;
        $imgsize = 0;
        $img_tmp_dir_path = OPENPNE_VAR_DIR . '/tmp/';

        if ($tmpfile_1)
        {
            $filepath = $img_tmp_dir_path . $tmpfile_1;
            $imgsize = $imgsize + filesize($filepath);
            $imgcnt ++;
        }
        if ($tmpfile_2)
        {
            $filepath = $img_tmp_dir_path . $tmpfile_2;
            $imgsize = $imgsize + filesize($filepath );
            $imgsize = $imgsize + filesize($tmpfile_2);
            $imgcnt ++;
        }
        if ($tmpfile_3)
        {
            $filepath = $img_tmp_dir_path . $tmpfile_3;
            $imgsize = $imgsize + filesize($filepath );
            $imgsize = $imgsize + filesize($tmpfile_3);
            $imgcnt ++;
        }
        $filename_1 = image_insert_c_image4tmp("d_{$c_diary_id}_1", $tmpfile_1, $u);
        $filename_2 = image_insert_c_image4tmp("d_{$c_diary_id}_2", $tmpfile_2, $u);
        $filename_3 = image_insert_c_image4tmp("d_{$c_diary_id}_3", $tmpfile_3, $u);
        t_image_clear_tmp($sessid);

        db_diary_update_c_diary($c_diary_id, $subject, $body, $public_flag,
                                $filename_1, $filename_2, $filename_3);

        //2008-03-11 DiaryCount処理を追加 kuniharu Tsujioka
        $datacount = new Diary_Count('diary_count', $u);
        $datacount->addCount();
        //2008-08-08 ImageCount処理を追加 KUNIHARU Tsujioka
        $imagecount = new Image_Count('image_count', $u);
        //画像数をカウント
        $imagecount->addCount($imgcnt);
        //画像のファイルサイズを保存
        $imagecount->addFileSize($imgsize);
        //**************************************************

        $p = array('target_c_diary_id' => $c_diary_id);
        openpne_redirect('pc', 'page_fh_diary', $p);
    }
}

?>

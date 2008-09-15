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

class pc_page_c_event_add_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $open_flag         = $requests['open_flag'];
        // ----------

        //--- 権限チェック
        //コミュニティメンバー
        if (!_db_is_c_commu_member($target_c_commu_id, $u)) {
            $_REQUEST['target_c_commu_id'] = $target_c_commu_id;
            $_REQUEST['msg'] = "イベント作成をおこなうにはコミュニティに参加する必要があります";
            openpne_forward('pc', 'page', "c_home");
            exit;
        }
        //---

        $event = p_c_event_add_confirm_event4request();
        $upfile_obj1 = $_FILES['image_filename1'];
        $upfile_obj2 = $_FILES['image_filename2'];
        $upfile_obj3 = $_FILES['image_filename3'];

        // エラーチェック
        $err_msg = array();
        if (trim($event['title']) == '') {
            $err_msg[] = "タイトルを入力してください";
        }
        if (trim($event['body']) == '') {
            $err_msg[] = "詳細を入力してください";
        }

        if (!$event['open_date_month'] || !$event['open_date_day'] || !$event['open_date_year']) {
            $err_msg[] = "開催日時を入力してください";
        } elseif (!t_checkdate($event['open_date_month'], $event['open_date_day'], $event['open_date_year'])) {
            $err_msg[] = "開催日時は存在しません";
        } elseif (mktime(0, 0, 0, $event['open_date_month'], $event['open_date_day'], $event['open_date_year']) < mktime(0, 0, 0)) {
            $err_msg[] = "開催日時は過去に指定できません";
        }

        if ($event['invite_period_month'].$event['invite_period_day'].$event['invite_period_year'] != "") {
            if (!$event['invite_period_month'] || !$event['invite_period_day'] || !$event['invite_period_year']) {
                $err_msg[] = "募集期限は存在しません";
            } elseif (!t_checkdate($event['invite_period_month'], $event['invite_period_day'], $event['invite_period_year'])) {
                $err_msg[] = "募集期限は存在しません";
            } elseif (mktime(0, 0, 0, $event['invite_period_month'], $event['invite_period_day'], $event['invite_period_year']) < mktime(0, 0, 0)) {
                $err_msg[] = "募集期限は過去に指定できません";
            } elseif (mktime(0, 0, 0, $event['open_date_month'], $event['open_date_day'], $event['open_date_year'])
                    < mktime(0, 0, 0, $event['invite_period_month'], $event['invite_period_day'], $event['invite_period_year'])) {
                $err_msg[] = "募集期限は開催日時より未来に指定できません";
            }
        }

        if ($upfile_obj1['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj1))) {
                $err_msg[] = '画像1は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }
        if ($upfile_obj2['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj2))) {
                $err_msg[] = '画像2は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }
        if ($upfile_obj3['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj3))) {
                $err_msg[] = '画像3は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }

        if ($err_msg) {
            $_REQUEST = $event;
            $_REQUEST['target_c_commu_id'] = $event['c_commu_id'];
            $_REQUEST['open_flag'] = $open_flag;
            $_REQUEST['err_msg'] = $err_msg;
            openpne_forward('pc', 'page', "c_event_add");
            exit;
        }

        //画像をvar/tmpフォルダにコピー
        $sessid = session_id();
        t_image_clear_tmp($sessid);
        $tmpfile1 = t_image_save2tmp($upfile_obj1, $sessid, "t_1");
        $tmpfile2 = t_image_save2tmp($upfile_obj2, $sessid, "t_2");
        $tmpfile3 = t_image_save2tmp($upfile_obj3, $sessid, "t_3");

        $this->set('inc_navi', fetch_inc_navi("c", $target_c_commu_id));

        $pref_list = p_regist_prof_c_profile_pref_list4null();
        $event = p_c_event_add_confirm_event4request();
        $event['open_pref_value'] = $pref_list[$event['open_pref_id']];
        $event['image_filename1_tmpfile'] = $tmpfile1;
        $event['image_filename2_tmpfile'] = $tmpfile2;
        $event['image_filename3_tmpfile'] = $tmpfile3;
        $event['image_filename1'] = $upfile_obj1['name'];
        $event['image_filename2'] = $upfile_obj2['name'];
        $event['image_filename3'] = $upfile_obj3['name'];
        $this->set('event', $event);
        $this->set('open_flag', $open_flag);
        $this->set("c_commu", p_c_home_c_commu4c_commu_id($target_c_commu_id));

        return 'success';
    }
}

?>

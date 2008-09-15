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
 * コミュニティ情報の更新
 */
class pc_do_c_edit_update_c_commu extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();


        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $name = $requests['name'];
        $c_commu_category_id = $requests['c_commu_category_id'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $open_flag = $requests['open_flag'];
        $topic_authority_list = $requests['topic_authority_list'];
        $is_send_join_mail = $requests['is_send_join_mail'];
        // ----------
        $upfile_obj = $_FILES['image_filename'];
        //--- 権限チェック
        //コミュニティ管理者

        $status = db_common_commu_status($u, $target_c_commu_id);
        if (!$status['is_commu_admin']) {
            handle_kengen_error();
        }
        //---

        $err_msg = array();
        if (!$name) $err_msg[] = "コミュニティ名を入力してください";
        if (!$body) $err_msg[] = "コミュニティの説明を入力してください";

        if ($upfile_obj['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj))) {
                $err_msg[] = '画像は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }

        ////GoogleMAP
        if (OPENPNE_USE_COMMU_MAP) {
            $is_display_map = $requests['is_display_map'];
            if ($is_display_map) {
                $pref = null;
                if ($requests['map_pref_id'] > 0) {
                    $pref = db_etc_c_profile_pref4id($requests['map_pref_id']);
                }

                if (!empty($pref['map_latitude']) && !empty($pref['map_longitude'])) {
                    $map_latitude = $pref['map_latitude'];
                    $map_longitude = $pref['map_longitude'];
                    $map_zoom = $pref['map_zoom'];
                } else {
                    // cast input parameters
                    $map_latitude  = doubleval($requests['map_latitude']);
                    $map_longitude = doubleval($requests['map_longitude']);
                    $map_zoom = intval($requests['map_zoom']);
                }
            } else {
                $map_latitude = 0;
                $map_longitude = 0;
                $map_zoom = 0;
            }
        } else {
            $is_display_map = null;
            $map_latitude = null;
            $map_longitude = null;
            $map_zoom = null;
        }

        if ($err_msg) {
            $_REQUEST['err_msg'] = $err_msg;
            $_REQUEST['target_c_commu_id'] = $target_c_commu_id;
            $_REQUEST['name'] = $name;
            $_REQUEST['body'] = $body;
            openpne_forward('pc', 'page', "c_edit");
            exit;
        }

        //画像アップデート
        $sessid = session_id();
        t_image_clear_tmp($sessid);
        if (file_exists($upfile_obj["tmp_name"])) {
            $tmpfile = t_image_save2tmp($upfile_obj, $sessid, "c");
        }
        if ($tmpfile) {
            $image_filename = image_insert_c_image4tmp("c_{$target_c_commu_id}", $tmpfile, $u);
        }
        t_image_clear_tmp(session_id());

        if ($image_filename) {
            //画像削除
            $c_commu = _db_c_commu4c_commu_id($target_c_commu_id);
            image_data_delete($c_commu['image_filename']);
        }

        db_commu_update_c_commu(
            $target_c_commu_id,
            $name,
            $c_commu_category_id,
            $body,
            $public_flag,
            $image_filename,
            $is_send_join_mail,
            $is_display_map,
            $map_latitude,
            $map_longitude,
            $map_zoom,
            $open_flag,
            $topic_authority_list
            );

        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('pc', 'page_c_home', $p);
    }
}

?>

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
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

class pc_page_f_message_send_confirm extends OpenPNE_Action
{
    function handleError($errors)
    {
        $_REQUEST['msg1'] = $errors['subject'];
        $_REQUEST['msg2'] = $errors['body'];
        openpne_forward('pc', 'page', 'f_message_send', $errors);
        exit;
    }

    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $form_val['target_c_member_id'] = $requests['target_c_member_id'];
        $form_val['subject'] = $requests['subject'];
        $form_val['body'] = $requests['body'];
        $form_val['target_c_message_id'] = $requests['target_c_message_id'];
        $form_val['jyusin_c_message_id'] = $requests['jyusin_c_message_id'];
        $save = $requests['save'];
        // ----------
        $sessid = session_id();
        t_image_clear_tmp($sessid);

        $upfiles = array(
            1 => $_FILES['upfile_1'],
            $_FILES['upfile_2'],
            $_FILES['upfile_3'],
        );
        $tmpfiles = array(
            1 => '',
            '',
            '',
        );

        foreach ($upfiles as $key => $upfile) {
            if ($upfile['error'] !== UPLOAD_ERR_NO_FILE) {
                if (empty($upfile)) continue;
                if (!($image = t_check_image($upfile))) {
                    $_REQUEST['msg'] = '画像は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
                    openpne_forward('pc', 'page', 'f_message_send');
                    exit;
                } else {
                    $tmpfiles[$key] = t_image_save2tmp($upfile, $sessid, "d_{$key}", $image['format']);
                }
            }
        }
        $form_val['upfile_1'] = $_FILES['upfile_1'];
        $form_val['upfile_2'] = $_FILES['upfile_2'];
        $form_val['upfile_3'] = $_FILES['upfile_3'];
        $form_val['tmpfile_1'] = $tmpfiles[1];
        $form_val['tmpfile_2'] = $tmpfiles[2];
        $form_val['tmpfile_3'] = $tmpfiles[3];


        $target_c_member_id = $form_val['target_c_member_id'];

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('pc', 'page_h_access_block');
        }

        $this->set('inc_navi', fetch_inc_navi("f", $target_c_member_id));

        //ターゲット情報
        $this->set("target_member", db_common_c_member4c_member_id($target_c_member_id));

        //ターゲットのid
        $this->set("target_c_member_id", $form_val['target_c_member_id']);

        $this->set("form_val", $form_val);

        //下書き保存
        if (!empty ($save)) {
            //下書き保存が存在しない
            if ($form_val['target_c_message_id'] == $form_val['jyusin_c_message_id']) {
                insert_message_to_is_save($form_val['target_c_member_id'], $u, $form_val['subject'], $form_val['body'], $_REQUEST['jyusin_c_message_id']);
            } else { //下書き保存が存在する
                update_message_to_is_save($form_val['target_c_message_id'], $form_val['subject'], $form_val['body']);
            }

            $p = array('msg' => 2);
            openpne_redirect('pc', 'page_h_reply_message', $p);
        }

        return 'success';
    }
}

?>

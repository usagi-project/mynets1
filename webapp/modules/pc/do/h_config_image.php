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
 * プロフィール画像の変更
 */
class pc_do_h_config_image extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        $upfile_obj = $_FILES['upfile'];

        if ($upfile_obj['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj))) {
                $p = array('msg' => '画像は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください');
                openpne_redirect('pc', 'page_h_config_image', $p);
            }
        }

        $c_member = db_common_c_member4c_member_id($u);

        if (!$c_member['image_filename_1']) {
            $img_num = 1;
        } elseif (!$c_member['image_filename_2']) {
            $img_num = 2;
        } elseif (!$c_member['image_filename_3']) {
            $img_num = 3;
        } else {
            $p = array('msg' => '画像は3枚までアップロードできます');
            openpne_redirect('pc', 'page_h_config_image', $p);
        }

        //画像をDBに格納
        $image_filename = image_insert_c_image($upfile_obj, "m_{$u}", $u);

        //c_memberのフィールドに登録
        do_h_config_image_new($u, $image_filename, $img_num);

        //画像1の時（最初の画像）メイン画像に
        if ($img_num == 1) {
            do_h_config_image_change_c_member_main_image($u, 1);
            reset_se_myinfo($u);
        }

        openpne_redirect('pc', 'page_h_config_image');
    }
}
?>

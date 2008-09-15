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

class pc_page_h_com_add_confirm extends OpenPNE_Action
{
    function handleError($errors)
    {
        $_REQUEST['err_msg'] = $errors;
        openpne_forward('pc', 'page', 'h_com_add');
        exit;
    }

    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $name = $requests['name'];
        $c_commu_category_id = $requests['c_commu_category_id'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $open_flag = $requests['open_flag'];
        // ----------
        $upfile_obj = $_FILES['image_filename'];

        //TODO:
        $err_msg = array();
        if (p_c_com_add_is_commu4c_commu_name($name))
            $err_msg[] = "そのコミュニティはすでに存在します";

        if ($upfile_obj['error'] !== UPLOAD_ERR_NO_FILE) {
            if (!($image = t_check_image($upfile_obj))) {
                $err_msg[] = '画像は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください';
            }
        }

        if ($err_msg) {
            $_REQUEST['err_msg'] = $err_msg;
            openpne_forward('pc', 'page', "h_com_add");
            exit;
        }
        //-----

        $this->set('inc_navi', fetch_inc_navi('h'));

        $c_commu_category_list = _db_c_commu_category4null();

        $public_flag_list=
        array(
            'public' =>'参加：誰でも参加可能、掲示板：全員に公開',
            'auth_sns' =>'参加：管理者の承認が必要、掲示板：全員に公開',
            'auth_commu_member' =>'参加：管理者の承認が必要、掲示板：コミュニティ参加者にのみ公開',
        );

        foreach ($c_commu_category_list as $each_c_commu_categfory) {
            if ($each_c_commu_categfory['c_commu_category_id']==$c_commu_category_id)$c_commu_category_value=$each_c_commu_categfory['name'];
        }
        $public_flag_value=$public_flag_list[$public_flag];

        $this->set("c_commu_category_value", $c_commu_category_value);
        $this->set("public_flag_value", $public_flag_value);

        //画像をvar/tmpフォルダにコピー
        $sessid = session_id();
        t_image_clear_tmp($sessid);
        if (file_exists($upfile_obj["tmp_name"])) {
            $tmpfile = t_image_save2tmp($upfile_obj, $sessid, "c");
        }

        $form_val = array(
            'name'=>$name,
            'c_commu_category_id'=>$c_commu_category_id,
            'body'=>$body,
            'public_flag'=>$public_flag,
            'open_flag' => $open_flag,
            'tmpfile'=>$tmpfile,
            'image_filename' => $upfile_obj['name']
        );
        $this->set("form_val", $form_val);

        return 'success';
    }
}

?>

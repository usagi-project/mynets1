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
require_once 'OpenPNE/KtaiID.php';
require_once OPENPNE_WEBAPP_DIR .'/components/mobile_get_id.class.php';

class ktai_do_o_insert_c_member extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function isRegistProgress()
    {
        return true;
    }

    function execute($requests)
    {
        $_SESSION = array();

        //<PCKTAI
        if (defined('OPENPNE_REGIST_FROM') &&
                !((OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1)) {
            @session_destroy();
            openpne_redirect('ktai', 'page_o_login');
        }
        //>

        // --- リクエスト変数
        $ses = $requests['ses'];
        // ----------

        //--- 権限チェック
        //セッションが有効

        // セッションが有効かどうか
        if (!$pre = c_member_ktai_pre4session($ses)) {
            // 無効の場合、login へリダイレクト
            @session_destroy();
            openpne_redirect('ktai', 'page_o_login');
        }
        //---

        $errors = array();

        $validator = new OpenPNE_Validator();
        $validator->addRequests($_REQUEST);
        $validator->addRules($this->_getValidateRules());
        if (!$validator->validate()) {
            $errors = $validator->getErrors();
        }

        $prof = $validator->getParams();

        //--- c_profile の項目をチェック
        $validator = new OpenPNE_Validator();
        $validator->addRequests($_REQUEST['profile']);
        $validator->addRules($this->_getValidateRulesProfile());
        if (!$validator->validate()) {
            $errors = array_merge($errors, $validator->getErrors());
        }

        // 値の整合性をチェック(DB)
        $c_member_profile_list = do_config_prof_check_profile($validator->getParams(), $_REQUEST['public_flag']);

        // 必須項目チェック
        $profile_list = db_common_c_profile_list4null();
        foreach ($profile_list as $profile) {
            if ($profile['disp_regist'] &&
                $profile['is_required'] &&
                !$c_member_profile_list[$profile['name']]['value']
            ) {
                $errors[$profile['name']] = "{$profile['caption']}を入力してください";
                break;
            }
        }

        // 生年月日のチェック
        if (!t_checkdate($prof['birth_month'], $prof['birth_day'], $prof['birth_year'])) {
            $errors[] = '生年月日を正しく入力してください';
        }
        if (t_isFutureDate($prof['birth_day'], $prof['birth_month'], $prof['birth_year'])) {
            $errors[] = '生年月日を未来に設定することはできません';
        }

        //簡単ログインを判定
        //i-modeIDを取得する
        $mobileid = new Usagi_Get_Mobile_Id();
        $mid      = $mobileid->getId();
        $access_id_chk = FALSE;
        if ($_REQUEST['easy_access']) {
            /*
            2008-05-14 KUNIHARU Tsujioka update
            $easy_access_id = OpenPNE_KtaiID::getID();
            if (!$easy_access_id) {
                $errors[] = '携帯の個体識別番号を取得できませんでした<br>簡単ログインのチェックを外して登録してください。';
            }
            */
            if (!$mid)
            {
                $errors[] = '携帯のIDを取得できませんでした<br>簡単ログインのチェックを外して登録してください。';
            }
            $access_id_chk = TRUE;
        }
        //禁止ワードのチェック
        $ngcheck = CheckNGWord($prof['nickname']) ;

        if ($ngcheck !== true) {
            $errors['nickname'] = 'ニックネームに禁止ワードが含まれています';
        }
        // 入力エラー
        if ($errors) {
            $_SESSION['easy_access'] = $_REQUEST['easy_access'];
            $_SESSION['prof'] = $prof;
            $_SESSION['profile_list'] = $c_member_profile_list;
            $_SESSION['errors'] = $errors;
            $p = array('regist_ksid' => session_id(),'ses' => $ses);
            openpne_redirect('ktai', 'page_o_regist_input', $p);
        }

        // insert c_member
        $prof['ktai_address'] = $pre['ktai_address'];
        $prof['c_member_id_invite'] = $pre['c_member_id_invite'];

        switch ($prof['public_flag_birth_year']) {
        case "public":
        default:
            $prof['public_flag_birth_year'] = "public";
            break;
        case "friend":
            $prof['public_flag_birth_year'] = "friend";
            break;
        case "private":
            $prof['public_flag_birth_year'] = "private";
            break;
        }

        if (!$c_member_id = k_do_insert_c_member($prof)) {
            openpne_redirect('ktai', 'page_o_login');
        }
        // insert c_member_profile
        do_config_prof_update_c_member_profile($c_member_id, $c_member_profile_list);

        // insert c_friend(紹介者)
        db_friend_insert_c_friend($c_member_id, $pre['c_member_id_invite']);

        //管理画面で指定したコミュニティに強制参加
        $c_commu_id_list = db_commu_regist_join_list();
        foreach ($c_commu_id_list as $c_commu_id) {
            do_inc_join_c_commu($c_commu_id, $c_member_id);
        }

        // delete c_member_ktai_pre
        k_do_delete_c_member_ktai_pre($pre['c_member_ktai_pre_id']);

        //簡単ログインIDのセット
        db_ktai_update_easy_access_id($c_member_id, $mid, $access_id_chk);

        do_insert_c_member_mail_send($c_member_id, $prof['password'], $pre['ktai_address']);

        @session_destroy();
        openpne_redirect('ktai', 'page_o_regist_end');
    }

    function _getValidateRules()
    {
        return array(
            'nickname' => array(
                'type' => 'string',
                'required' => '1',
                'caption' => 'ニックネーム',
                'max' => '40',
            ),
            'birth_year' => array(
                'type' => 'int',
                'required' => '1',
                'caption' => '生まれた年',
                'min' => '1901',
                'max' => date('Y'),
            ),
            'birth_month' => array(
                'type' => 'int',
                'required' => '1',
                'caption' => '誕生月',
                'min' => '1',
                'max' => '12',
            ),
            'birth_day' => array(
                'type' => 'int',
                'required' => '1',
                'caption' => '誕生日',
                'min' => '1',
                'max' => '31',
            ),
            'public_flag_birth_year' => array(
                'type' => 'string',
            ),
            'password' => array(
                'type' => 'regexp',
                'regexp' => '/^[a-z0-9]+$/i',
                'required' => '1',
                'caption' => 'パスワード',
                'min' => '6',
                'max' => '12',
            ),
            'c_password_query_id' => array(
                'type' => 'int',
                'required' => '1',
                'caption' => '秘密の質問',
                'required_error' => '秘密の質問を選択してください',
            ),
            'password_query_answer' => array(
                'type' => 'string',
                'required' => '1',
                'caption' => '秘密の質問の答え',
            ),
        );
    }

    function _getValidateRulesProfile()
    {
        $rules = array();
        $profile_list = db_common_c_profile_list4null();
        foreach ($profile_list as $profile) {
            if ($profile['disp_regist']) {
                $rule = array(
                    'type' => 'int',
                    'required' => $profile['is_required'],
                    'caption' => $profile['caption'],
                );
                switch ($profile['form_type']) {
                case 'text':
                case 'textarea':
                    $rule['type'] = $profile['val_type'];
                    $rule['regexp'] = $profile['val_regexp'];
                    $rule['min'] = $profile['val_min'];
                    ($profile['val_max']) and $rule['max'] = $profile['val_max'];
                    break;
                case 'checkbox':
                    $rule['is_array'] = '1';
                    break;
                }
                $rules[$profile['name']] = $rule;
            }
        }
        return $rules;
    }
}

?>

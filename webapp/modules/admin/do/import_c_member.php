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
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/04/22] Ver1.1.0Nighty package
 * @chengelog  [2007/05/04] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メンバー情報一括登録
class admin_do_import_c_member extends OpenPNE_Action
{
    function handleError($msg)
    {
        admin_client_redirect('ext_import_c_member', $msg);
    }

    function execute($requests)
    {
        //件数制限つき
        $limit = 1000;

        //項目数
        $column_num = 3;

        $errors = array();

        $member_file = $_FILES['member_file'];
        $member_data = file($member_file['tmp_name']);

        // --- エラーチェック1 ここから

        $name_data = explode(".", $member_file['name']);
        if ($name_data[count($name_data)-1] != 'csv') {
            $this->handleError("ファイルタイプはcsv形式にして下さい");
        }

        if (count($member_data) > $limit) {
            $this->handleError("一度に登録できるのは{$limit}件までです");
        }
        // --- エラーチェック1 ここまで


        foreach ($member_data as $key => $value) {
            $data = explode(",", $value);

            //改行コードを除去
            $data = str_replace("\r\n", "\n", $data);
            $data = str_replace("\r", "\n", $data);
            $data = str_replace("\n", "", $data);

            $nickname     = $data[0];
            $mail_address = $data[1];
            $password     = $data[2];

            // --- エラーチェック2 ここから

            //入力項目が多い
            if (count($data) > $column_num) {
                $this->handleError(($key+1)."行目：項目数が多すぎます");
            }

            //空の項目が存在する
            if (!$data[0] || !$data[1] || !$data[2]) {
                $this->handleError(($key+1)."行目：空の項目が存在します");
            }



            //ニックネームの形式チェック
            if (strlen($nickname) > 40) {
                $this->handleError(($key+1)."行目：ニックネームは40文字以内で入力してください");
            }

            //メールアドレスの形式チェック

            // メールアドレスとして正しくない
            if (!db_common_is_mailaddress($mail_address)) {
                $this->handleError(($key+1)."行目：アドレス [".$mail_address."] はメールアドレスとして正しくありません");
            }
            //対象のアドレスが、登録されてるか否か
            if (p_is_sns_join4mail_address($mail_address)) {
                $this->handleError(($key+1)."行目：そのアドレス [".$mail_address."] は既に登録済みです");
            }
/*
            //対象のアドレスが、ドメイン制限に合致しているかどうか
            if (!db_member_is_limit_domain4mail_address($mail_address)) {
                $this->handleError(($key+1)."行目：そのアドレス [".$mail_address."] では登録できません");
            }
*/
            //パスワードの形式チェック
            if (!ctype_alnum($password) ||
                strlen($password) < 6 ||
                strlen($password) > 12) {
                $this->handleError(($key+1)."行目：パスワードは6～12文字の半角英数で入力してください");
            }

            // --- エラーチェック2 ここまで

            // --- データのインポート ここから

            // 携帯アドレスか否か
            if (is_ktai_mail_address($mail_address)) {
                $ktai_address = $mail_address;
                $pc_address   = '';
            } else {
                $ktai_address = '';
                $pc_address   = $mail_address;
            }

            $c_member['nickname'] = $nickname;
            $c_member['birth_year'] = 1700;
            $c_member['birth_month'] = 1;
            $c_member['birth_day'] = 1;
            $c_member['c_password_query_id'] = 0;
            $c_member['c_member_id_invite'] = 1;
            $c_member['is_receive_mail'] = 1;
            $c_member['is_receive_ktai_mail'] = 1;
            $c_member['is_receive_daily_news'] = 1;
            $c_member['public_flag_birth_year'] = 'public';
            $c_member_secure = array(
                'password' => $password,
                'pc_address' => $pc_address,
                'ktai_address' => $ktai_address,
                'regist_address' => $mail_address,
            );

            $u = db_member_insert_c_member($c_member, $c_member_secure);
            // 招待者とフレンドリンク
            db_friend_insert_c_friend($u, 1);

            //管理画面で指定したコミュニティに強制参加
            $c_commu_id_list = db_commu_regist_join_list();
            foreach ($c_commu_id_list as $c_commu_id) {
                do_inc_join_c_commu($c_commu_id, $u);
            }

            // --- データのインポート ここまで

        }

        admin_client_redirect('ext_import_c_member', count($member_data)."　件のインポートが完了しました");
    }
}

?>

<?php

class QREntry
{
    var $c_member_id_new ;

    function getID($ses)
    {
        $sql = "SELECT c_member_pre_id FROM ".MYNETS_PREFIX_NAME."c_member_pre ";
        $sql .= " WHERE session = ? ";
        $params = array(strval($ses));
        $result = db_get_one($sql, $params);
        return $result;
    }

    function addMemberPre($profs, $ses)
    {
        $data = array(
            'session' => $ses,
            'nickname' => $profs['nickname'],
            'birth_year' => intval($profs['birth_year']),
            'birth_month' => intval($profs['birth_month']),
            'birth_day' => intval($profs['birth_day']),
            'public_flag_birth_year' => $profs['public_flag_birth_year'],
            'r_date' => db_now(),
            'is_receive_ktai_mail' => 1,
            'c_member_id_invite' => intval($profs['c_member_id_invite']),
            'password' => $profs['password'],
            'easy_access_id' => $profs['easy_access_id'],
            'c_password_query_answer' =>$profs['password_query_answer'],
            'c_password_query_id' =>$profs['c_password_query_id'],
        );
        /*
        header("Content-type: text/html; charset=utf-8");
            echo '<html><body>';
            print_r($data);
            echo '</body></html>';
            exit;
        */
        if (db_insert(MYNETS_PREFIX_NAME . 'c_member_pre', $data)) {
            // insert c_member_profile
            //$this->addMemberProf($new_id, $profs);
            return true;
        } else {
            /*
            header("Content-type: text/html; charset=utf-8");
            echo '<html><body>';
            print_r($data);
            echo '</body></html>';
            exit;
            */
            return false;
        }
    }

    function delMemberPre($ses)
    {
        $sql = "DELETE FROM " . MYNETS_PREFIX_NAME . "c_member_pre WHERE session = ? ";
        $params = array(strval($ses));

        return db_query($sql, $params);
    }

    function addMemberAddress($c_member_id)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'hashed_password' => md5($profs['password']),
            'hashed_password_query_answer' => md5($profs['password_query_answer']),
            'ktai_address'     => t_encrypt($profs['ktai_address']),
            'regist_address' => t_encrypt($profs['ktai_address']),
        );

        if (db_insert(MYNETS_PREFIX_NAME . 'c_member_secure', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function addMemberProf($c_member_pre_id, $prof_list)
    {
        foreach ($prof_list as $item) {
        //$sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_member_profile' .
        //        ' WHERE c_member_id = ? AND c_profile_id = ?';
        //$params = array(intval($c_member_id), intval($item['c_profile_id']));
        //db_query($sql, $params);

        if ($item['value']) {
            if (is_array($item['value'])) {
                foreach ($item['value'] as $key => $value) {
                    $this->addPreProf($c_member_pre_id, $item['c_profile_id'], $key, $value, $item['public_flag']);
                }
            } else {
                $this->addPreProf($c_member_pre_id, $item['c_profile_id'], $item['c_profile_option_id'], $item['value'], $item['public_flag']);
            }
        }
        }
    }
    function addPreProf($c_member_pre_id, $c_profile_id, $c_profile_option_id, $value, $public_flag)
    {
        $data = array(
            'c_member_pre_id' => intval($c_member_pre_id),
            'c_profile_id' => intval($c_profile_id),
            'c_profile_option_id' => intval($c_profile_option_id),
            'value' => $value,
            'public_flag' => $public_flag,
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_member_pre_profile', $data);
    }

    //携帯のPRE登録があるかを判定
    function chkKtaiPreMember($ses)
    {
        $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_member_ktai_pre WHERE session = ? ";
        $params = array(strval($ses));
        $result = db_get_row($sql, $params);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function chkPreMember($ses)
    {
        $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_member_pre WHERE session = ? ";
        $params = array(strval($ses));
        $result = db_get_row($sql, $params);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    //KtaiMailAddessの登録
    function addKtaiMail($address, $c_member_pre_id, $c_commu_id_new = "")
    {

        $data = array(
            'ktai_address'     => $address,
            'regist_address'   => $address,
        );
        $where = array('c_member_pre_id', intval($c_member_pre_id));
        db_update(MYNETS_PREFIX_NAME . 'c_member_pre', $data, $where);
        //preから本番へ移動する

        $sql = "SELECT session FROM ".MYNETS_PREFIX_NAME."c_member_pre WHERE c_member_pre_id = ? ";
        $params = array(intval($c_member_pre_id));
        $ses = db_get_one($sql, $params);
        $data = array(
            'ktai_address'     => $address,
        );
        $where = array('session' => strval($ses));

        db_update(MYNETS_PREFIX_NAME . 'c_member_ktai_pre', $data, $where);
        $sql = "SELECT c_member_ktai_pre_id FROM ".MYNETS_PREFIX_NAME."c_member_ktai_pre WHERE session = ? ";
        $params = array(strval($ses));
        $ktai_pre_id = db_get_one($sql, $params);

        $sql = "SELECT * FROM ".MYNETS_PREFIX_NAME."c_member_pre WHERE c_member_pre_id = ? ";
        $params = array(intval($c_member_pre_id));
        $result = db_get_row($sql, $params);
        $prof = array(
            'nickname' => $result['nickname'],
            'birth_year' => intval($result['birth_year']),
            'birth_month' => intval($result['birth_month']),
            'birth_day' => intval($result['birth_day']),
            'public_flag_birth_year' => $result['public_flag_birth_year'],
            'r_date' => db_now(),
            'is_receive_ktai_mail' => 1,
            'c_member_id_invite' => intval($result['c_member_id_invite']),
            'c_password_query_id' => intval($result['c_password_query_id']),
        );
        if (!$c_member_id_new = db_insert(MYNETS_PREFIX_NAME . 'c_member', $prof)) {
            return false;
        }
        if (isset($result['easy_access_id'])) {
            $easy_id = $result['easy_access_id'];
        } else {
            $easy_id = "";
        }
        $data = array(
            'c_member_id' => intval($c_member_id_new),
            'hashed_password' => md5($result['password']),
            'hashed_password_query_answer' => md5($result['password_query_answer']),
            'ktai_address'     => t_encrypt($address),
            'regist_address' => t_encrypt($address),
            'easy_access_id' => t_encrypt($result['easy_access_id']),
        );
        if (!$chk = db_insert(MYNETS_PREFIX_NAME . 'c_member_secure', $data)) {
            return false ;
        }
        // insert c_friend(紹介者)
        db_friend_insert_c_friend($c_member_id_new, $result['c_member_id_invite']);     //OK
        //管理画面で指定したコミュニティに強制参加
        $c_commu_id_list = db_commu_regist_join_list();
        foreach ($c_commu_id_list as $c_commu_id) {
            do_inc_join_c_commu($c_commu_id, $c_member_id_new);     //OK
        }
        //コミュニティID付きで渡ってきた場合の処理
        if ($c_commu_id_new !== '') {
            do_inc_join_c_commu($c_commu_id_new, $c_member_id_new);
        }
        // delete c_member_ktai_pre
        k_do_delete_c_member_ktai_pre($ktai_pre_id);
        do_common_delete_c_member_pre4sid($ses);
        do_insert_c_member_mail_send($c_member_id_new, $result['password'], $address);
        return true;
    }


}



?>
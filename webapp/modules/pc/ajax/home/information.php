<?php

class pc_ajax_home_information extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];
        // 運営者からのおしらせ
        $this->set('site_info', p_common_c_siteadmin4target_pagename('h_home'));

        //未読メッセージの数をお知らせ
        $this->set('num_message_not_is_read', p_h_message_count_c_message_not_is_read4c_member_to_id($u));
        //日記コメントの未読の数をお知らせ
        $this->set('num_diary_not_is_read', p_h_diary_count_c_diary_not_is_read4c_member_id($u));
        //日記コメントの未読の中で、読ませるものを送る
        $this->set('first_diary_read', p_h_diary_c_diary_first_diary_read4c_member_id($u));

        //あなたにフレンド承認を求めているメンバーリスト
        $f_confirm_list = p_h_confirm_list_anatani_c_friend_confirm_list4c_member_id($u);
        $this->set('f_confirm_list', $f_confirm_list);
        $this->set('num_f_confirm_list', count($f_confirm_list));
        //あなたにコミュニティ参加承認を求めているメンバーリスト
        $h_confirm_list = p_h_confirm_list_anatani_c_commu_member_confirm_list4c_member_id($u);
        $this->set('h_confirm_list', $h_confirm_list);
        $this->set('num_h_confirm_list', count($h_confirm_list));
        // あなたにコミュニティ管理者交代を希望しているメンバー
        $anatani_c_commu_admin_confirm_list = p_h_confirm_list_anatani_c_commu_admin_confirm_list4c_member_id($u);
        $this->set('anatani_c_commu_admin_confirm_list', $anatani_c_commu_admin_confirm_list);
        $this->set('num_anatani_c_commu_admin_confirm_list', count($anatani_c_commu_admin_confirm_list));

        // 誕生日かどうか
        $this->set('birthday_flag', p_h_home_birthday_flag4c_member_id($u));

        return 'success';
    }
}
?>

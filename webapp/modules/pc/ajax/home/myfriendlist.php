<?php

class pc_ajax_home_myfriendlist extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];
        // フレンドリスト
        $this->set('c_friend_list', p_f_home_c_friend_list4c_member_id($u, 9));
        $this->set('c_friend_count', db_friend_count_friends($u));
        return 'success';
    }
}
?>
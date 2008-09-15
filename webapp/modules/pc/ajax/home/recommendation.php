<?php

class pc_ajax_home_recommendation extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];

        // 紹介文
        $w = p_h_home_c_friend_intro_list4c_member_id($u, 5);
        if ( empty($w) )
            return "none";
        $this->set('c_friend_intro_list', $w);
        return 'success';
    }
}
?>
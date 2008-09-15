<?php

class pc_ajax_home_communitylist extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];
        // 参加コミュニティ
        $this->set('c_commu_user_list', p_h_home_c_commu_list4c_member_id($u, 9));
        $this->set('fh_com_count_user', p_common_count_c_commu4c_member_id($u));
        $this->set('c_member', $_SESSION['GVAL']['c_member']);
        return 'success';
    }
}
?>

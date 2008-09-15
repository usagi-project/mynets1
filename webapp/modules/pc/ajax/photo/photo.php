<?php

class pc_ajax_photo_photo extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];
        // メンバ情報
        $this->set('c_member',$_SESSION['GVAL']['c_member']);
        $this->set('c_friend_count', db_friend_count_friends($u));
        return 'success';
    }
}
?>

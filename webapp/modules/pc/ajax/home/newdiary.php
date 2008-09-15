<?php

class pc_ajax_home_newdiary extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];
        /// 自分の情報 ///

        // 日記
        $this->set('c_diary_list', db_diary_get_c_diary_list4c_member_id($u, 5));
        // 外部blog
        $this->set('c_blog_list', p_h_home_h_blog_list_friend4c_member_id($u, 5, 1));
        // レビュー
        $this->set('c_review_list', db_review_c_review_list4member($u, 5));
        return 'success';
    }
}
?>
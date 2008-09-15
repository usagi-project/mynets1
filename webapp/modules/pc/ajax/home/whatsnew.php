<?php

class pc_ajax_home_whatsnew extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];

        /// 最新情報 ///

        // フレンド最新日記
        $this->set('c_diary_friend_list', p_h_home_c_diary_friend_list4c_member_id($u, 5));
        // フレンド最新blog
        $this->set('c_rss_cache_list', p_h_diary_list_friend_c_rss_cache_list($u, 5));
        // 日記コメント記入履歴
        $this->set('c_diary_my_comment_list', p_h_home_c_diary_my_comment_list4c_member_id($u, 5));
        // 参加コミュニティの新着書き込み
        $this->set('c_commu_topic_comment_list', p_h_home_c_commu_topic_comment_list4c_member_id($u, 5));
        // レビュー
        $this->set('c_friend_review_list', p_h_home_c_friend_review_list4c_member_id($u, 5));

        return 'success';
    }
}
?>
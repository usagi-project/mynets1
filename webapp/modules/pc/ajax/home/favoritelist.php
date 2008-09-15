<?php

class pc_ajax_home_favoritelist extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];
        //お気に入りフィード
        if (USE_BOOKMARK_FEED) {
            //お気に入りの最新日記
            $this->set('bookmark_diary_list', db_bookmark_diary_list($u, 5));

            //お気に入りの最新ブログ
            $this->set('bookmark_blog_list', db_bookmark_blog_list($u, 5));

            //お気に入りのメンバ
            $this->set('bookmark_member_list', db_bookmark_member_list($u, 9));
            $this->set('bookmark_count', db_bookmark_count($u));
        return 'success';
        }
        return 'none';
    }
}
?>
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
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

require_once OPENPNE_WEBAPP_DIR . "/components/one_word.class.php";
require_once OPENPNE_WEBAPP_DIR . "/components/diary/diary.class.php";
require_once OPENPNE_WEBAPP_DIR . "/components/information/information.class.php";
require_once OPENPNE_WEBAPP_DIR . "/components/Pager.class.php";

class pc_page_h_home extends OpenPNE_Action
{
    function handleError()
    {
        openpne_redirect('pc', 'page_h_home');
    }

    function execute($requests)
    {

        $u = $GLOBALS['AUTH']->uid();

        $this->set('inc_navi', fetch_inc_navi('h'));
        /// infomation ///
        // 運営者からのおしらせ

        // --- 初期は１ページ目
        $page = 1;
        // ----------

        $pagesize = ADMIN_INFO_NUM;

        $information = new Information($u);
        $info = $information->getList($page, $pagesize);
        $num = $information->getTotalNum();

        $pager = new Usagi_Pager();
        $link = $pager->set($num, $pagesize, 'javascript:void(0)" onclick="nextinfo(%d);return false;');
        $Pager_Common = new Pager_Common();
        if($Pager_Common->_path != "/") {
            $page_link = str_replace($Pager_Common->_path,'', $link);
        } else {
            $page_link = $link;
        }
        $page_link = str_replace('&quot;','"', $page_link);

        $this->set('info', $info);
        $this->set('total_num', $num);
        $this->set('page_link', $page_link);
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

        /// 左側 ///
        // サイドメニュー
        $this->set('inc_side_menu', p_common_c_siteadmin4target_pagename('inc_side_menu'));
////////////////////////////////////
//ワンワードを入れる
        $word = new OneWord();
        $word->setUid($u);
        $oneword = $word->gettwo();
        if (!$oneword[0]['comment']) {
            $oneword[0]['comment'] = "";
        }
        $this->set('oneword', $oneword[0]['comment']);
        $this->set('max_oneword_id', $oneword[0]['c_one_word_id']);
        $this->set('oneword2', $oneword[1]['comment']);

        $oneword_pagesize = 6;

        // --- 初期は１ページ目
        $all_page = 1;
        $this->set('all_page', $all_page);

        $oneword_list_all = $word->getList($oneword_pagesize, $all_page);
        $this->set('oneword_list_all', $oneword_list_all);

        $all_num = $word->getTotalNum();
        $this->set('all_total_num', $all_num);

        $link = $pager->set($all_num, $oneword_pagesize, 'javascript:void(0)" onclick="nextall(%d);return false;');
        if($Pager_Common->_path != "/") {
            $all_link = str_replace($Pager_Common->_path,'', $link);
        } else {
            $all_link = $link;
        }
        $all_link = str_replace('&quot;','"', $all_link);
        $this->set('all_link', $all_link);

        // --- 初期は１ページ目
        $fri_page = 1;
        $this->set('fri_page', $fri_page);

        $oneword_list_friend = $word->getListFriend($u, $oneword_pagesize, $fri_page);
        $this->set('oneword_list_friend', $oneword_list_friend);

        $fri_num = $word->getTotalNum();
        $this->set('fri_total_num', $fri_num);

        $link = $pager->set($fri_num, $oneword_pagesize, 'javascript:void(0)" onclick="nextfri(%d);return false;');
        if($Pager_Common->_path != "/") {
            $fri_link = str_replace($Pager_Common->_path,'', $link);
        } else {
            $fri_link = $link;
        }
        $fri_link = str_replace('&quot;','"', $fri_link);
        $this->set('fri_link', $fri_link);

        //$oneword_list_member = $word->getListMember($u, 7);
        //$this->set('oneword_list_member', $oneword_list_member);

//2008-08-14 kunitsuji update
/////////////////////////////////////
        /// 最新情報 ///
        // メンバ情報
        $member_data = db_common_c_member4c_member_id($u, TRUE);
        $this->set('c_member', $member_data);
        //携帯アドレスがあるかないかを判定
        $mobile_qrdata = FALSE;
        if (! $member_data['secure']['ktai_address'])
        {
            $mobile_qrdata = TRUE;
        }
        $this->set('mobile_qrdata', $mobile_qrdata);
        // フレンドリスト
        $my_friend_list = p_f_home_c_friend_list4c_member_id($u, 9);
        //フレンドのひとことを取得
        foreach ($my_friend_list as $key => $value) {
            $word->setUid($value['c_member_id']);
            $oneword = $word->get();
            if (!$oneword) {
                $oneword = "";
            }
            $my_friend_list[$key]['friend_oneword'] = $oneword;
        }
        $this->set('c_friend_list', $my_friend_list);
        $this->set('c_friend_count', db_friend_count_friends($u));
        $this->set('c_friend_list_access',getFriendListAccesstime($u, 6));
        // 参加コミュニティ
        $this->set('c_commu_user_list', p_h_home_c_commu_list4c_member_id($u, 9));
        $this->set('fh_com_count_user', p_common_count_c_commu4c_member_id($u));
        $comment_flag = new UsagiComponentsDiary();
        // フレンド最新日記
        $friend_diary = p_h_home_c_diary_friend_list4c_member_id($u, 5);
        foreach ($friend_diary as $key=>$value) {
            $friend_diary[$key]['view_flag'] = $comment_flag->chkCommentViewFlag($u, $value['c_diary_id']);
        }
        $this->set('c_diary_friend_list', $friend_diary);
        // フレンド最新blog
        $this->set('c_rss_cache_list', p_h_diary_list_friend_c_rss_cache_list($u, 5));
        // 日記コメント記入履歴
/////////////////////////////////////
//2008-01-12 kunitsuji
/////////////////////////////////////
        $comment_data = p_h_home_c_diary_my_comment_list4c_member_id($u, 5);
        //2008-01-29 Kuniharu Tsujioka

        foreach ($comment_data as $key=>$value) {
            $comment_data[$key]['edit_flag'] = $comment_flag->chkCommentEditFlag($u, $value['c_diary_id']);
            $comment_data[$key]['view_flag'] = $comment_flag->chkCommentViewFlag($u, $value['c_diary_id']);
        }
        //--------------------------------//
        $this->set('c_diary_my_comment_list', $comment_data);

        // 参加コミュニティの新着書き込み
        $this->set('c_commu_topic_comment_list', p_h_home_c_commu_topic_comment_list4c_member_id($u, 5));
        // レビュー
        $this->set('c_friend_review_list', p_h_home_c_friend_review_list4c_member_id($u, 5));

        /// 自分の情報 ///

        // 日記
        $this->set('c_diary_list', db_diary_get_c_diary_list4c_member_id($u, 5));
        // 外部blog
        $this->set('c_blog_list', p_h_home_h_blog_list_friend4c_member_id($u, 5, 1));
        // レビュー
        $this->set('c_review_list', db_review_c_review_list4member($u, 5));
        //自分の情報を開いている
        $this->set('is_h_prof', 1);
        /// その他 ///
        //伝言板
        list ($c_dengon_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_dengon_c_dengon_comment_list4c_member_id_to($u, 5,1);

        $this->set("c_dengon_comment", array_reverse($c_dengon_comment_list));
        $this->set("target_c_member_id",$u);
        // 紹介文
        $this->set('c_friend_intro_list', p_h_home_c_friend_intro_list4c_member_id($u, 5));

        // 今日の日付、曜日
        $this->set('r_datetime', date('m/d'));
        $date = array('日','月','火','水','木','金','土');
        $this->set('r_datetime_date', $date[date('w')]);

        /// 週間カレンダー
        if (DISPLAY_SCHEDULE_HOME) {
            if (DISPLAY_SCHEDULE_WEEK) {
                $start_w = date('w', time());
            } else {
                $start_w = 0;
            }
            $w = $requests['w'];
            if (empty($w)) {
                $w = 0;
            }
            $this->set('w', $w);
            $this->set('calendar', $this->get_calendar($u, $w, $start_w));
        }

        // inc_entry_point
        $this->set('inc_entry_point', fetch_inc_entry_point_h_home($this->getView()));

        //お気に入りフィード
        if (USE_BOOKMARK_FEED) {
            //お気に入りの最新日記
            $this->set('bookmark_diary_list', db_bookmark_diary_list($u, 5));

            //お気に入りの最新ブログ
            $this->set('bookmark_blog_list', db_bookmark_blog_list($u, 5));

            //お気に入りのメンバ
            $bookmark_member_list = db_bookmark_member_list($u, 9);
            //フレンドのひとことを取得
            foreach ($bookmark_member_list as $key => $value) {
                $word->setUid($value['c_member_id']);
                $oneword = $word->get();
                if (!$oneword) {
                    $oneword = "";
                }
                $bookmark_member_list[$key]['friend_oneword'] = $oneword;
            }
            $this->set('bookmark_member_list', $bookmark_member_list);
            $this->set('bookmark_count', db_bookmark_count($u));
        }

        // アクセス日時を記録
        p_common_do_access($u);

        return 'success';
    }

    function get_calendar($u, $week, $start_w)
    {
        include_once 'Calendar/Week.php';
        $time = strtotime($week . ' week');
        $Week = new Calendar_Week(date('Y', $time), date('m', $time), date('d', $time), $start_w);
        $Week->build();
        $calendar = array();

        $dayofweek = array('日','月','火','水','木','金','土');
        $i = $start_w;
        $dayofweek = array_merge($dayofweek,array_slice($dayofweek, 0, ($start_w + 1)));
        while ($Day = $Week->fetch()) {
            $y = $Day->thisYear();
            $m = $Day->thisMonth();
            $d = $Day->thisDay();
            $item = array(
                'year'=> $y,
                'month'=>$m,
                'day' => $d,
                'dayofweek'=>$dayofweek[$i++],
                'now' => false,
                'birth' => p_h_home_birth4c_member_id($m, $d, $u),
                'event' => p_h_home_event4c_member_id($y, $m, $d, $u),
                'schedule' => p_h_calendar_c_schedule_list4date($y, $m, $d, $u),
            );
            if ($w == 0 && $d == date('d')) {
                $item['now'] = true;
            }
            $calendar[] = $item;
        }
        return $calendar;
    }
}

?>

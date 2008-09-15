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

class ktai_page_h_home extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        $c_member_secure = db_common_c_member_secure4c_member_id($u);

        //管理画面HTML
        $this->set('c_siteadmin', p_common_c_siteadmin4target_pagename('k_h_home'));

        $c_member = db_common_c_member4c_member_id($u);
        //メンバ情報
        $this->set('c_member', $c_member);
        //新着メッセージ数
        $this->set('c_message_unread_count', k_p_h_home_c_message_received_unread_all_count4c_member_id($u));
        //フレンドの最新日記
        /////////////////////////////////////
        //2008-01-12 kunitsuji
        /////////////////////////////////////
        $comment_data = k_p_h_home_c_diary_friend_list4c_member_id($u, 5);
        $comment_flag = new UsagiComponentsDiary();
        foreach ($comment_data as $key=>$value) {
            $comment_data[$key]['edit_flag'] = $comment_flag->chkCommentEditFlag($u, $value['c_diary_id']);
            $comment_data[$key]['view_flag'] = $comment_flag->chkCommentViewFlag($u, $value['c_diary_id']);
        }
        //--------------------------------//
        $this->set('c_diary_friend_list', $comment_data);
        //参加コミュニティリスト
        $this->set('c_commu_list', k_p_h_home_c_commu_list_lastupdate4c_member_id($u, 5));
        //フレンドリスト
        $this->set('c_friend_list', k_p_h_home_c_friend_list_random4c_member_id($u, 5));

        //参加コミュニティの新着書き込み
        $this->set('c_commu_topic_list', p_h_home_c_commu_topic_comment_list4c_member_id($u, 5));

        $this->set('SNS_NAME', SNS_NAME);

        //アクセス日時を記録
        p_common_do_access($u);

        //未読メッセージの数をお知らせ
        $this->set("num_message_not_is_read", p_h_message_count_c_message_not_is_read4c_member_to_id($u));
        //日記コメントの未読の数をお知らせ
        $this->set("num_diary_not_is_read", p_h_diary_count_c_diary_not_is_read4c_member_id($u));
        //日記コメントの未読の中で、読ませるものを送る
        $this->set("first_diary_read", p_h_diary_c_diary_first_diary_read4c_member_id($u));

        //コミュニティ承認を求めているメンバーリスト
        $h_confirm_list = p_h_confirm_list_anatani_c_commu_member_confirm_list4c_member_id($u);
        $this->set("h_confirm_list", $h_confirm_list);
        //そのメンバーの人数
        $this->set("num_h_confirm_list", count($h_confirm_list));

        //あなたにフレンド認証を求めているメンバーリスト
        $f_confirm_list = p_h_confirm_list_anatani_c_friend_confirm_list4c_member_id($u);
        $this->set("f_confirm_list", $f_confirm_list);
        //そのメンバーの人数
        $this->set("num_f_confirm_list", count($f_confirm_list));

        // あなたにコミュニティ管理者交代を希望しているメンバー
        $anatani_c_commu_admin_confirm_list = p_h_confirm_list_anatani_c_commu_admin_confirm_list4c_member_id($u);
        $this->set("anatani_c_commu_admin_confirm_list", $anatani_c_commu_admin_confirm_list);
        //そのメンバーの人数
        $this->set("num_anatani_c_commu_admin_confirm_list", count($anatani_c_commu_admin_confirm_list));

        //日記コメント記入履歴
        $list = p_h_home_c_diary_my_comment_list4c_member_id($u, 5);
        foreach ($list as $key=>$value) {
            $list[$key]['edit_flag'] = $comment_flag->chkCommentEditFlag($u, $value['c_diary_id']);
            $list[$key]['view_flag'] = $comment_flag->chkCommentViewFlag($u, $value['c_diary_id']);
        }

        $this->set("c_diary_my_comment_list", $list);

        // 誕生日かどうか
        $this->set('birthday_flag', p_h_home_birthday_flag4c_member_id($u));

        //自分のディスプレイを判定する
        $MyDisplayTemplate = getMyDisplay($c_member['mobile_view']);
        $this->set('MyDisplayTemplate',$MyDisplayTemplate['template_foldername']);

        //管理画面に登録されているユーザかどうかを判定
        $mbchk = checkAuthMobileAdmin($u);
        if ($mbchk !== false) {
            $this->set('mobileadmin','test');
        }
        //今日のひとことを取得
        $oneword = new OneWord();
        $oneword->setUid($u);
        $this->set('oneword', $oneword->get());

        return 'success';
    }
}

?>

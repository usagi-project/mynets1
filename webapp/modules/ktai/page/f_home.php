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
class ktai_page_f_home extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $page_size = 5;
        $page += $direc;

        $page_flag = false;     //自分のページではない
        if ($target_c_member_id == $u) {
            //openpne_redirect('ktai', 'page_h_home');
            $page_flag = true;      //自分のページである
        }
        $this->set('page_flag',$page_flag);
        if (!p_common_is_active_c_member_id($target_c_member_id)) {
            ktai_display_error('該当するメンバーが見つかりません。');
        }

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }
        $this->set('u',$u);
        //管理画面HTML
        $this->set('c_siteadmin', p_common_c_siteadmin4target_pagename('k_f_home'));

        //ターゲットのc_member

        $is_friend = db_friend_is_friend($u, $target_c_member_id);
        if ($is_friend) {
            $target_c_member = db_common_c_member_with_profile($target_c_member_id, 'friend');
        } else {
            $target_c_member = db_common_c_member_with_profile($target_c_member_id, 'public');
        }
        $target_c_member['last_login'] = p_f_home_last_login4access_date($target_c_member['access_date']);
        if (isset($target_c_member['birth_year'])) {
            $target_c_member['age'] = getAge($target_c_member['birth_year'], $target_c_member['birth_month'], $target_c_member['birth_day']);
        }
        $this->set("target_c_member", $target_c_member);

        //ターゲットの最新日記５件
        $this->set("c_diary_list", db_diary_get_c_diary_list4c_member_id($target_c_member_id, 5, $u));

        //フレンドランダム５人
        $this->set("c_friend_list", k_p_h_home_c_friend_list_random4c_member_id($target_c_member_id, 5));

        //参加コミュニティ最新書き込み５件
        $this->set("c_commu_list", k_p_h_home_c_commu_list_lastupdate4c_member_id($target_c_member_id, 5));
        //画面切り替えのために自分の情報を取得する
        $c_member = db_common_c_member4c_member_id($u);
        $this->set('c_member',$c_member);
        //自分のディスプレイを判定する
        $MyDisplayTemplate = getMyDisplay($c_member['mobile_view']);
        $this->set('MyDisplayTemplate',$MyDisplayTemplate['template_foldername']);
        //伝言コメント
        list ($c_dengon_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_dengon_c_dengon_comment_list4c_member_id_to($target_c_member_id, $page_size, $page);

        $this->set("c_dengon_comment", array_reverse($c_dengon_comment_list));
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("total_num", $total_num);
        $this->set("total_page_num", $total_page_num);
        $this->set("page_size", $page_size);

        //ターゲットと自分との関係
        $this->set("relation", k_p_f_home_relationship4two_members($u, $target_c_member_id));

        $this->set('profile_list', db_common_c_profile_list());

        // 誕生日まであと何日？
        $this->set('days_birthday', db_common_count_days_birthday4c_member_id($target_c_member_id));

        //あしあとをつける
        db_ashiato_insert_c_ashiato($target_c_member_id, $u,'mobile');

        //今日のひとことを取得
        $oneword = new OneWord();
        if ($page_flag)
        {
            $oneword->setUid($u);
        }
        else
        {
            $oneword->setUid($target_c_member_id);
        }
        $this->set('oneword', $oneword->get());
        return 'success';
    }
}

?>

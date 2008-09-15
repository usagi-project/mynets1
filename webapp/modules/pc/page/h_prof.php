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
require_once OPENPNE_WEBAPP_DIR . "/components/Pager.class.php";

class pc_page_h_prof extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        $target_c_member_id = $u;

        $this->set('is_h_prof', 1);
        $this->set('inc_navi', fetch_inc_navi('h'));
        $target_c_member = db_common_c_member_with_profile($u, 'friend');
        $this->set('is_friend', 0);
        $this->set('c_diary_list', db_diary_get_c_diary_list4c_member_id($target_c_member_id, 5, null, 'friend'));

        // --- f_home, h_prof 共通処理

        $this->set('target_c_member_id', $target_c_member_id);
        $target_c_member['last_login'] = p_f_home_last_login4access_date($target_c_member['access_date']);
        if ($target_c_member['birth_year']) {
            $target_c_member['age'] = getAge($target_c_member['birth_year'], $target_c_member['birth_month'], $target_c_member['birth_day']);
        }
        $this->set('target_c_member', $target_c_member);

        $this->set('c_rss_cache_list', p_f_home_c_rss_cache_list4c_member_id($target_c_member_id, 5));

        $this->set('c_friend_comment_list', p_f_home_c_friend_comment4c_member_id($target_c_member_id));
        // フレンドリスト
        $friend_list = p_f_home_c_friend_list4c_member_id($target_c_member_id, 9);
        //フレンドのひとことを取得
        $word = new OneWord();
        foreach ($friend_list as $key => $value) {
            $word->setUid($value['c_member_id']);
            $oneword = $word->get();
            if (!$oneword) {
                $oneword = "";
            }
            $friend_list[$key]['friend_oneword'] = $oneword;
        }
        
        $this->set('c_friend_list', $friend_list);
        $this->set('c_friend_count', db_friend_count_friends($target_c_member_id));
        $this->set('user_count', p_common_count_c_commu4c_member_id($target_c_member_id));
        $this->set('c_commu_list', p_f_home_c_commu_list4c_member_id($target_c_member_id, 9));
        $this->set('c_review_list', db_review_c_review_list4member($target_c_member_id, 5));

        $this->set('profile_list', db_common_c_profile_list());

        // 誕生日まであと何日？
        $this->set('days_birthday', db_common_count_days_birthday4c_member_id($target_c_member_id));

        // inc_entry_point
        $this->set('inc_entry_point', fetch_inc_entry_point_f_home($this->getView()));
    //伝言板
        list ($c_dengon_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_dengon_c_dengon_comment_list4c_member_id_to($u, 5,1);
        $this->set("c_dengon_comment", array_reverse($c_dengon_comment_list));

////////////////////////////////////
////////////////////////////////////
//ワンワードを入れる
        $oneword_pagesize = 6;
        $other_page = 1;//初期は1ページ

        $word->setUid($target_c_member_id);
        $this->set('oneword', $word->get());

        $oneword_list_other = $word->getListMember($target_c_member_id, $oneword_pagesize, $other_page);
        $this->set('oneword_list_other', $oneword_list_other);

        $other_num = $word->getTotalNum();
        $this->set('other_total_num', $other_num);

        $pager = new Usagi_Pager();
        $link = $pager->set($other_num, $oneword_pagesize, 'javascript:void(0)" onclick="nextother(%d, ' .$target_c_member_id. ');return false;');
        $Pager_Common = new Pager_Common();
        if($Pager_Common->_path != "/") {
            $other_link = str_replace($Pager_Common->_path,'', $link);
        } else {
            $other_link = $link;
        }
        $other_link = str_replace('&quot;','"', $other_link);
        $this->set('other_link', $other_link);

        return 'success';
    }
}

?>

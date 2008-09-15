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

class pc_page_h_confirm_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        $this->set('inc_navi', fetch_inc_navi('h'));


        // あなたにフレンドリンクを要請しているメンバー
        $this->set("anatani_c_friend_confirm_list",
                p_h_confirm_list_anatani_c_friend_confirm_list4c_member_id($u));

        // あなたに(の)管理コミュニティに参加を希望しているメンバー
        $this->set("anatani_c_commu_member_confirm_list",
                p_h_confirm_list_anatani_c_commu_member_confirm_list4c_member_id($u));

        // あなたにコミュニティ管理者交代を希望しているメンバー
        $this->set("anatani_c_commu_admin_confirm_list",
                p_h_confirm_list_anatani_c_commu_admin_confirm_list4c_member_id($u));


        // あなたがフレンドリンクを要請しているメンバー
        $this->set("anataga_c_friend_confirm_list",
                p_h_confirm_list_anataga_c_friend_confirm_list4c_member_id($u));

        // あなたがコミュニティ参加要請しているコミュニティ
        $this->set("anataga_c_commu_member_confirm_list",
                p_h_confirm_list_anataga_c_commu_member_confirm_list4c_member_id($u));

        // あなたがコミュニティ管理者交代を要請しているメンバー
        $this->set("anataga_c_commu_admin_confirm_list",
                p_h_confirm_list_anataga_c_commu_admin_confirm_list4c_member_id($u));


        //---- ページ表示 ----//
        return 'success';
    }
}

?>

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

class ktai_page_c_home extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        // ----------

        $c_commu = _db_c_commu4c_commu_id($target_c_commu_id);

        //コミュニティの存在の有無
        if (!$c_commu) {
            openpne_redirect('ktai', 'page_h_home');
        }


        //--- 権限チェック
        //未処理
        //掲示板の閲覧権限チェック tplでやっている
        $this->set("is_c_commu_view", p_common_is_c_commu_view4c_commu_idAc_member_id($target_c_commu_id, $u));
        $this->set("is_c_commu_member", _db_is_c_commu_member($target_c_commu_id, $u));
        //---

        //管理画面HTML
        $this->set('c_siteadmin', p_common_c_siteadmin4target_pagename('k_c_home'));

        //コミュニティ情報
        $this->set("c_commu", k_p_c_home_c_commu4c_commu_id($target_c_commu_id));

        //コミュニティメンバリスト
        $this->set("c_commu_member_list",
            k_p_c_home_c_commu_member_list_random4c_commu_id($target_c_commu_id, 5));

        //参加コミュニティの新着トピック書き込み
        $this->set("new_topic_comment", p_c_home_new_topic_comment4c_commu_id($target_c_commu_id, 5));
        //参加コミュニティの新着イベント書き込み
        $this->set("new_topic_comment_event", p_c_home_new_topic_comment4c_commu_id($target_c_commu_id, 5, 1));

        //自分($u)とこのコミュとの関係
        $this->set("relation_c_member_and_c_commu",
            k_p_c_home_relationship_between_member_commu($target_c_commu_id, $u));

        //コミュニティメール(ktai)受信設定
        $this->set("is_receive_mail", db_commu_is_receive_mail_ktai($target_c_commu_id, $u));
        //コミュニティメール(pc)受信設定
        $this->set("is_receive_mail_pc", db_commu_is_receive_mail_pc($target_c_commu_id, $u));
        //管理者からのメッセージ受信設定
        $this->set("is_receive_message", db_commu_is_receive_message($target_c_commu_id, $u));

        $this->set('is_unused_pc_bbs', util_is_unused_mail('m_pc_bbs_info'));
        $this->set('is_unused_ktai_bbs', util_is_unused_mail('m_ktai_bbs_info'));

        return 'success';
    }
}

?>

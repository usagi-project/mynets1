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

class pc_page_c_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $name = $requests['name'];
        $c_commu_category_id = $requests['c_commu_category_id'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $err_msg = $requests['err_msg'];
        // ----------

        //--- 権限チェック
        //コミュニティ管理者
        if (!_db_is_c_commu_admin($target_c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        $this->set('inc_navi', fetch_inc_navi('c', $target_c_commu_id));

        //コミュニティデータ取得
        $c_commu = _db_c_commu4c_commu_id($target_c_commu_id);

        if ($name) {
            $c_commu['name'] = $name;
        }
        if ($c_commu_category_id) {
            $c_commu['c_commu_category_id'] = $c_commu_category_id;
        }
        if ($body) {
            $c_commu['body'] = $body;
            $c_commu['info'] = $c_commu['body'];
        } else {
            $c_commu['body'] = $c_commu['info'];
        }
        if ($public_flag) {
            $c_commu['public_flag'] = $public_flag;
        }

        $this->set('target_c_commu_id', $target_c_commu_id);

        if ($err_msg) {
            $c_commu['name'] = $name;
            $c_commu['body'] = $body;
        }

        $this->set('c_commu', $c_commu);
        $this->set('c_commu_category_list', _db_c_commu_category4null());
        $public_flag_list=
        array(
            'public' =>'参加：誰でも参加可能、掲示板：全員に公開',
            'auth_sns' =>'参加：管理者の承認が必要、掲示板：全員に公開',
            'auth_commu_member' =>'参加：管理者の承認が必要、掲示板：コミュニティ参加者にのみ公開',
        );
        $this->set('public_flag_list', $public_flag_list);
        //2008-08-01 OpenPNEよりマージ（一部権限内容を数値化）
        $topic_authority_list=
        array(
            '0' => '参加者全員が作成可能',
            '1' => '管理者から指定されたメンバーのみ作成可能（管理者含む）',
            '99' => '管理者のみ作成可能',
        );
        $this->set('topic_authority_list', $topic_authority_list);

        $this->set('is_topic', p_c_edit_is_topic4c_commu_id($target_c_commu_id));
        $this->set('err_msg', $err_msg);

        $this->set('is_unused_join_commu', util_is_unused_mail('m_pc_join_commu'));

        //-- Google MAPs
        if (OPENPNE_USE_COMMU_MAP) {
            $pref_list = db_etc_c_profile_pref_list();

            // get pref_id selected
            $pref_id = db_etc_c_profile_pref_id4latlng($c_commu['map_latitude'], $c_commu['map_longitude'], $c_commu['map_zoom']);

            $this->set('pref_list', $pref_list);
            $this->set('pref_id', $pref_id);
        }

        return 'success';
    }
}
?>

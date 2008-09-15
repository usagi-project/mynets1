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

class pc_page_c_event_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();


        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $open_flag  = $requests['open_flag'];
        $err_msg = $requests['err_msg'];
        // ----------

        //--- 権限チェック
        //コミュニティメンバー
        if (!_db_is_c_commu_member($c_commu_id, $u)) {
            $_REQUEST['target_c_commu_id'] = $c_commu_id;
            $_REQUEST['msg'] = "イベント作成をおこなうにはコミュニティに参加する必要があります";
            openpne_forward('pc', 'page', "c_home");
            exit();
        }
        //---

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));

        $this->set("c_commu", p_c_home_c_commu4c_commu_id($c_commu_id));
        $this->set("year", p_c_event_add_year4null());
        $this->set('month', p_regist_prof_c_profile_month_list4null());
        $this->set('day', p_regist_prof_c_profile_day_list4null());
        $this->set('pref', p_regist_prof_c_profile_pref_list4null());

        $this->set('event', p_c_event_add_confirm_event4request());
        $this->set('err_msg', $err_msg);
        $this->set('open_flag', $open_flag);
        return 'success';
    }
}
?>

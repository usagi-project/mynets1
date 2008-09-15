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

class ktai_page_c_event_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $tail = $GLOBALS['KTAI_URL_TAIL'];

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $err_msg = $requests['err_msg'];
        // ----------

        $c_topic = c_event_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];

        //--- 権限チェック
        if (!p_common_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }
        if (!_db_is_c_topic_admin($c_commu_topic_id, $u) && !_db_is_c_commu_admin($c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        if (!$c_topic['event_flag']) {
            openpne_redirect('ktai', 'page_c_topic_edit',
                array('target_c_commu_topic_id'=>$c_topic['c_commu_topic_id']));
        }

        $this->set("year", p_c_event_add_year4null());
        $this->set('month', p_regist_prof_c_profile_month_list4null());
        $this->set('day', p_regist_prof_c_profile_day_list4null());
        $this->set('pref', p_regist_prof_c_profile_pref_list4null());
        $this->set('err_msg', $err_msg);

        //編集確認画面でエラーがでたときここに戻ってくる。そのときのためにrequestから取得
        //保留
        if ($err_msg) {
            $c_topic_temp = p_c_event_add_confirm_event4request();
            $c_topic['name'] = $c_topic_temp['title'];
            $c_topic['body'] = $c_topic_temp['body'];
            $c_topic['open_date_comment'] = $c_topic_temp['open_date_comment'];
            $c_topic['open_pref_id'] = $c_topic_temp['open_pref_id'];
            $c_topic['open_pref_comment'] = $c_topic_temp['open_pref_comment'];
            $c_topic['open_date_year'] = $c_topic_temp['open_date_year'];
            $c_topic['open_date_month'] = $c_topic_temp['open_date_month'];
            $c_topic['open_date_day'] = $c_topic_temp['open_date_day'];
            $c_topic['invite_period_year'] = $c_topic_temp['invite_period_year'];
            $c_topic['invite_period_month'] = $c_topic_temp['invite_period_month'];
            $c_topic['invite_period_day'] = $c_topic_temp['invite_period_day'];
        } else {
            $open_date_arr = explode("-", $c_topic['open_date']);
            $invite_period_arr = explode("-", $c_topic['invite_period']);
            $c_topic['open_date_year'] = $open_date_arr[0];
            $c_topic['open_date_month'] = $open_date_arr[1];
            $c_topic['open_date_day'] = $open_date_arr[2];
            $c_topic['invite_period_year'] = $invite_period_arr[0];
            $c_topic['invite_period_month'] = $invite_period_arr[1];
            $c_topic['invite_period_day'] = $invite_period_arr[2];
        }

        $this->set('event', $c_topic);
        return 'success';
    }
}

?>

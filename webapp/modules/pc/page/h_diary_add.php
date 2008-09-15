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

class pc_page_h_diary_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $form_val['subject'] = $requests['subject'];
        $form_val['body'] = $requests['body'];
        $form_val['public_flag'] = $requests['public_flag'];
        $form_val['tagsname'] = $requests['tagsname'];
        // ----------

        $sessid = session_id();
        t_image_clear_tmp($sessid);

        $this->set('inc_navi', fetch_inc_navi("h"));

        //プロフィール
        $c_member = db_common_c_member4c_member_id($u);
        if (empty($form_val['public_flag'])) {
            $form_val['public_flag'] = $c_member['public_flag_diary'];
        }
        $this->set("target_member", $c_member);
        $this->set("form_val", $form_val);

        //カレンダー関係
        //カレンダー開始用変数
        $year = date("Y");
        $month= date("n");
        //日記一覧、カレンダー用変数
        $date_val = array(
            'year' => $year,
            'month' => $month,
            'day' => null,
        );
        $this->set("date_val", $date_val);

        //日記のカレンダー
        $calendar = db_common_diary_monthly_calendar($year, $month, $u);

        $this->set("calendar", $calendar['days']);
        $this->set("ym", $calendar['ym']);

        //各月の日記
        $this->set("date_list", p_fh_diary_list_date_list4c_member_id($u));
        //検索用タグの取得
        $tags = getTagList();
        $this->set('tag_list', $tags);
        /*if (MYNETS_OPEN_DIARY === true) {
            $opendiary_flag = true;
        } else {
            $opendiary_flag = false;
        }
        $this->set('opendiary_flag',$opendiary_flag);
        */
        //Smarty.constを利用するのでカット2007-11-26Kunitsuji

        return 'success';
    }
}

?>

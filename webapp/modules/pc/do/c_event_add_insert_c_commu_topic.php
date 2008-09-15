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

require_once OPENPNE_WEBAPP_DIR . "/components/count/commu/count_commu_count.class.php";

class pc_do_c_event_add_insert_c_commu_topic extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $tmpfile1 = $requests['image_filename1_tmpfile'];
        $tmpfile2 = $requests['image_filename2_tmpfile'];
        $tmpfile3 = $requests['image_filename3_tmpfile'];
        $open_flag         = $requests['open_flag'];
        // ----------

        //--- 権限チェック
        //コミュニティ参加者

        $event = p_c_event_add_confirm_event4request();

        $status = db_common_commu_status($u, $event['c_commu_id']);
        if (!$status['is_commu_member']) {
            handle_kengen_error();
        }
        //---


        if ($event['invite_period_year'].$event['invite_period_month'].$event['invite_period_day']!="") {
            $invite_period = $event['invite_period_year']."-".$event['invite_period_month']."-".$event['invite_period_day'];
        } else {
            $invite_period = "";
        }

        $insert_c_commu_topic = array(
            "name"              => $event['title'],
            "c_commu_id"        => $event['c_commu_id'],
            "c_member_id"       => $u,
            "open_date"         => $event['open_date_year']."-".$event['open_date_month']."-".$event['open_date_day'],
            "open_date_comment" => $event['open_date_comment'],
            "open_pref_id"      => $event['open_pref_id'],
            "open_pref_comment" => $event['open_pref_comment'],
            "invite_period"     => $invite_period,
            "open_flag"   => intval($open_flag),
            "event_flag"        => 1,
        );
        $c_commu_topic_id = do_c_event_add_insert_c_commu_topic($insert_c_commu_topic);

        if ($tmpfile1) {
            $filename1 = image_insert_c_image4tmp("t_{$c_commu_topic_id}_1", $tmpfile1, $u);
        }
        if ($tmpfile2) {
            $filename2 = image_insert_c_image4tmp("t_{$c_commu_topic_id}_2", $tmpfile2, $u);
        }
        if ($tmpfile3) {
            $filename3 = image_insert_c_image4tmp("t_{$c_commu_topic_id}_3", $tmpfile3, $u);
        }
        t_image_clear_tmp(session_id());

        $insert_c_commu_topic_comment = array(
            "c_commu_id"       => $event['c_commu_id'],
            "c_member_id"      => $u,
            "body"             => $event['body'],
            "number"           => 0,
            "c_commu_topic_id" => $c_commu_topic_id,
            "image_filename1"  => !empty($filename1) ? $filename1 : '',
            "image_filename2"  => !empty($filename2) ? $filename2 : '',
            "image_filename3"  => !empty($filename3) ? $filename3 : '',
        );
        $insert_id = do_c_event_add_insert_c_commu_topic_comment($insert_c_commu_topic_comment);

        //お知らせメール送信(携帯へ)
        send_bbs_info_mail($insert_id, $u);
        //お知らせメール送信(PCへ)
        send_bbs_info_mail_pc($insert_id, $u);

        do_c_event_add_insert_c_event_member_as_admin($c_commu_topic_id, $u);

        //2008-03-11 DiaryCount処理を追加 kuniharu Tsujioka
        $datacount = new Commu_Count('event_count', $u);
        $datacount->addCount();
        //**************************************************

        $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
        openpne_redirect('pc', 'page_c_event_detail', $p);
    }
}

?>

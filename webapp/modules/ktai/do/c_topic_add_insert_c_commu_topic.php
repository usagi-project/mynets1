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

class ktai_do_c_topic_add_insert_c_commu_topic extends OpenPNE_Action
{
    function handleError($errors)
    {
        ktai_display_error($errors);
    }

    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $title  = $requests['title'];
        $body = $requests['body'];
        // ----------

        //--- 権限チェック
        //コミュニティ参加者

        $status = db_common_commu_status($u, $c_commu_id);

        if (!$status['is_commu_member']) {
            handle_kengen_error();
        }
        //---

        $insert_c_commu_topic = array(
            "name"        => $title,
            "c_commu_id"  => $c_commu_id,
            "c_member_id" => $u,
            "event_flag"  => 0
        );
        $c_commu_topic_id = do_c_event_add_insert_c_commu_topic($insert_c_commu_topic);

        $insert_c_commu_topic_comment = array(
            "c_commu_id"  => $c_commu_id,
            "c_member_id" => $u,
            "body"        => $body,
            "number"      => 0,
            "c_commu_topic_id" => $c_commu_topic_id,
            "image_filename1" =>"",
            "image_filename2" =>"",
            "image_filename3" =>"",
        );
        $insert_id = do_c_event_add_insert_c_commu_topic_comment($insert_c_commu_topic_comment);

        //お知らせメール送信(携帯へ)
        send_bbs_info_mail($insert_id, $u);
        //お知らせメール送信(PCへ)
        send_bbs_info_mail_pc($insert_id, $u);

        $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
        openpne_redirect('ktai', 'page_c_bbs', $p);
    }
}

?>

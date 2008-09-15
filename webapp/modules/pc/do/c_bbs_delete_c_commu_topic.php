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

/**
 * コミュニティトピック削除
 */
class pc_do_c_bbs_delete_c_commu_topic extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        $target_c_commu_topic_id = $requests['target_c_commu_topic_id'];

        //--- 権限チェック
        //コミュニティ管理者 or トピック作成者

        $c_commu_topic = _do_c_bbs_c_commu_topic4c_commu_topic_id($target_c_commu_topic_id);

        $c_commu_id = $c_commu_topic['c_commu_id'];

        $status = db_common_commu_status($u, $c_commu_id);
        if (!$status['is_commu_admin']
            && $c_commu_topic['c_member_id'] != $u) {
            handle_kengen_error();
        }
        //---

        db_commu_delete_c_commu_topic($target_c_commu_topic_id);

        //2008-03-11 DiaryCount処理を追加 kuniharu Tsujioka
        if ($c_commu_topic['event_flag'] == 0) {
            $datacount = new Commu_Count('topic_count', $u);
            $datacount->addCount(-1);
        } else if ($c_commu_topic['event_flag'] == 1) {
            $datacount = new Commu_Count('event_count', $u);
            $datacount->addCount(-1);
        }
        //**************************************************

        $p = array('target_c_commu_id' => $c_commu_topic['c_commu_id']);
        if ($c_commu_topic['event_flag']) {
            openpne_redirect('pc', 'page_c_event_list', $p);
        } else {
            openpne_redirect('pc', 'page_c_topic_list', $p);
        }
    }
}

?>

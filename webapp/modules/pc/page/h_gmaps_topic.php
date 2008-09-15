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

class pc_page_h_gmaps_topic extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_topic_comment_id = $requests['target_c_topic_comment_id'];
        $url = $requests['url'];

        if (!$target_c_topic_comment_id) {
            openpne_redirect('pc', 'page_h_err_c_home');
        }

        $c_topic_comment = do_c_bbs_c_commu_topic_comment4c_commu_topic_comment_id($target_c_topic_comment_id);
        $c_commu_id = $c_topic_comment['c_commu_id'];

        //--- 権限チェック
        //コミュニティ掲示板閲覧権限
        if (!p_common_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        $target_c_topic = db_one_topic_commnet_4c_topic_comment_id($target_c_topic_comment_id);

        $this->set("target_topic", $target_c_topic);
        $this->set("url", $url);

        return 'success';
    }
}

?>

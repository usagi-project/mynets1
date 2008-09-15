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

class pc_do_h_review_edit_delete_c_review_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_review_comment_id = $requests['c_review_comment_id'];
        // ----------

        //--- 権限チェック
        //レビューコメント作者

        if (!do_h_review_edit_c_review_comment4c_review_comment_id_c_member_id($c_review_comment_id, $u)) {
            handle_kengen_error();
        }
        //---

        $c_review_id = do_common_c_review_id4c_review_comment_id($c_review_comment_id);

        do_h_review_edit_delete_c_review_comment($c_review_comment_id);

        //コメント件数が0件になった場合は
        // c_review / c_review_clip / c_commu_review を削除する
        if (do_common_count_c_review_comment4c_review_id($c_review_id) === 0) {
            do_delete_c_review4c_review_id($c_review_id);
        }

        $p = array('c_member_id' => $u);
        openpne_redirect('pc', 'page_fh_review_list_member', $p);
    }
}

?>

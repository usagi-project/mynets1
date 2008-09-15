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

class pc_page_h_cmnt_diary extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_diary_id = $requests['id'];
        $comment_number = $requests['number'];

        if (!$target_c_diary_id) {
            openpne_redirect('pc', 'page_h_err_fh_diary');
        }

        $target_c_diary = db_diary_get_c_diary4id($target_c_diary_id);
        $target_c_member_id = $target_c_diary['c_member_id'];

        if ($target_c_member_id != $u) {

            // check public_flag
            if (!pne_check_diary_public_flag($target_c_diary_id, $u)) {
                openpne_redirect('pc', 'page_h_err_diary_access');
            }
            // アクセスブロック
            if (p_common_is_access_block($u, $target_c_member_id)) {
                openpne_redirect('pc', 'page_h_access_block');
            }

        }

        $target_c_diary_comment = db_diary_comment4comment_number($target_c_diary_id,$comment_number);
        $member = db_common_c_member4c_member_id_LIGHT($target_c_diary_comment['c_member_id']);
        $target_c_diary_comment['nickname'] = $member['nickname'];
        $this->set("target_diary_comment", $target_c_diary_comment);

        return 'success';
    }
}

?>

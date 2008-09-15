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
require_once OPENPNE_WEBAPP_DIR . "/components/diary/diary.class.php";
class ktai_page_h_diary_comment_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $page = $page + $direc;
        $page_size = 10;
        $this->set('page', $page);
        $this->set('page_size', $page_size);

        $lst = p_h_diary_comment_list_c_diary_my_comment_list4c_member_id($u, $page, $page_size);
        $comment_data = $lst[0];
        $comment_flag = new UsagiComponentsDiary();
        foreach ($comment_data as $key=>$value) {
            $comment_data[$key]['edit_flag'] = $comment_flag->chkCommentEditFlag($u, $value['c_diary_id']);
            $comment_data[$key]['view_flag'] = $comment_flag->chkCommentViewFlag($u, $value['c_diary_id']);
        }

        $this->set("c_diary_my_comment_list", $comment_data);
        $this->set('is_prev', $lst[1]);
        $this->set('is_next', $lst[2]);

        return 'success';
    }
}

?>

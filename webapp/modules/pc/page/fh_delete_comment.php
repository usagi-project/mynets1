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

class pc_page_fh_delete_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        $target_c_diary_comment_id = $requests['target_c_diary_comment_id'];
        // ----------

        // target が指定されていない
        if (!$target_c_diary_id) {
            openpne_redirect('pc', 'page_h_err_fh_diary');
        }
        // target の日記が存在しない
        if (!p_common_is_active_c_diary_id($target_c_diary_id)) {
            openpne_redirect('pc', 'page_h_err_fh_diary');
        }

        $target_diary = db_diary_get_c_diary4id($target_c_diary_id);

        // 削除するコメントがが指定されていない
        if (!$target_c_diary_comment_id) {
            $p = array('target_c_diary_id' => $target_c_diary_id);
            openpne_redirect('pc', 'page_fh_diary', $p);
        }
        // コメントIDが不正
        foreach ($target_c_diary_comment_id as $item) {
            $comment = _do_c_diary_comment4c_diary_comment_id($item);
            if ($comment['c_diary_id'] != $target_c_diary_id
                || ($comment['c_member_id'] != $u &&
                    $target_diary['c_member_id'] != $u) ) {
                $p = array('target_c_diary_id' => $target_c_diary_id);
                openpne_redirect('pc', 'page_fh_diary', $p);
            }
        }

        // オブジェクトの振り分け用
        $target_c_member_id = $target_diary['c_member_id'];

        // inc_navi.tpl
        if ($target_c_member_id == $u) {
            $type = 'h';
            $is_diary_admin = true;
        } else {
            $type = 'f';
            $is_diary_admin = false;
        }

        $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id));
        $this->set('is_diary_admin', $is_diary_admin);

        $this->set('member', db_common_c_member4c_member_id($u));
        $this->set('target_member', db_common_c_member4c_member_id($target_c_member_id));
        $this->set('target_diary', $target_diary);

        //削除するコメント一覧
        $list = db_diary_get_c_diary_comment_list4id_list($target_c_diary_comment_id);
        $this->set('target_diary_comment_list', array_shift($list));

        //削除するコメントID
        $this->set('target_c_diary_comment_id', $target_c_diary_comment_id);

        return 'success';
    }
}

?>

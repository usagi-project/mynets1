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

class pc_page_fh_comment_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------
        $page = $page+$direc;

        if (empty($target_c_member_id)) {
            $target_c_member_id = $u;
        }

        $target_c_member = db_common_c_member4c_member_id($target_c_member_id);
        $this->set("target_member", $target_c_member);
                $is_friend = false;
        if ($target_c_member_id == $u) {
            $type = "h";
        } else {
            $type = "f";

            $is_friend = db_friend_is_friend($u, $target_c_member_id);

            // アクセスブロック
            if (p_common_is_access_block($u, $target_c_member_id)) {
                openpne_redirect('pc', 'page_h_access_block');
            }
        }
        $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id));

        //c_member_id から自分の日記についてるコメントIDリストを取得
        $target_c_diary_comment_id = $this->_p_fh_diary_c_diary_comment_id_list4c_member_id($target_c_member_id, $is_friend, $type);

        $page_size = 50;
        list($c_diary_comment_list, $is_prev, $is_next, $total_num) =
            db_diary_get_c_diary_comment_list4id_list($target_c_diary_comment_id, $page, $page_size, true);

        //最近のコメント一覧用配列(50個まで)
        $this->set("new_comment_list", $c_diary_comment_list);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $pager = array();
        $pager['start'] = $page_size * ($page - 1) + 1;
        if (($pager['end'] = $page_size * $page) > $total_num) {
            $pager['end'] = $total_num;
        }
        $this->set('page', $page);
        $this->set('pager', $pager);

        return 'success';
    }


    //c_member_id から自分の日記についてるコメントID(複数)を取得
    //日記公開範囲を考慮
    function _p_fh_diary_c_diary_comment_id_list4c_member_id($c_member_id, $is_friend, $type)
    {
        if ($type == 'h') {
            return p_fh_diary_c_diary_comment_id_list4c_member_id($c_member_id);
        }

        $sql = "SELECT cdc.c_diary_comment_id FROM ".MYNETS_PREFIX_NAME."c_diary as cd,".MYNETS_PREFIX_NAME."c_diary_comment as cdc, ".MYNETS_PREFIX_NAME."c_member as cm" .
            " WHERE cd.c_member_id = ?".
            " AND cd.c_diary_id = cdc.c_diary_id".
            " AND cd.c_member_id = cm.c_member_id";

        if ($is_friend) {
            $sql .= ' AND ((cd.public_flag = \'public\') OR (cd.public_flag = \'default\' AND cm.public_flag_diary = \'public\') OR (cd.public_flag = \'friend\') OR (cd.public_flag = \'default\' AND cm.public_flag_diary = \'friend\'))';
        } else {
            $sql .= ' AND ((cd.public_flag = \'public\') OR (cd.public_flag = \'default\' AND cm.public_flag_diary = \'public\'))';
        }

        $params = array(intval($c_member_id));
        return db_get_col($sql, $params);
    }


}

?>

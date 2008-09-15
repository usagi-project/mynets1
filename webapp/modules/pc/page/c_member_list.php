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

class pc_page_c_member_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $this->set('inc_navi', fetch_inc_navi("c", $target_c_commu_id));

        //メンバー情報
        $this->set("member", db_common_c_member4c_member_id($u));

        //コミュニティID
        $this->set("c_commu_id", $target_c_commu_id);
        $this->set("c_commu", _db_c_commu4c_commu_id($target_c_commu_id));
        $this->set("c_commu_num", _db_count_c_commu_member_list4c_commu_id($target_c_commu_id));

        $page_size = 50;

        //次ページへのインクリメント
        $page += $direc;

        //コミュニティメンバリスト
        list($c_member_list, $is_prev, $is_next, $total_num, $start_num, $end_num)
            = p_c_member_list_c_members4c_commu_id($target_c_commu_id, $page_size, $page);

        $this->set("c_member_list", $c_member_list);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("page", $page);
        $this->set("total_num", $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        for ($i=1; $i <= ceil($total_num / $page_size); $i++) {
            $page_num[] = $i;
        }
        $this->set("page_num", $page_num);

        return 'success';
    }
}

?>

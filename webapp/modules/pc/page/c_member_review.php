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

class pc_page_c_member_review extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $page = $requests['page'];
        $direc = $requests['direc'];
        // ----------
        $page_size=20;
        $page += $direc;

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));
        list($c_member_review, $is_prev, $is_next, $total_num, $start_num, $end_num)
             = p_c_member_review_c_member_review4c_commu_id($c_commu_id, $page, $page_size);
        $this->set('c_member_review', $c_member_review);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("page", $page);
        $this->set("total_num", $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        $c_commu = _db_c_commu4c_commu_id($c_commu_id);
        $this->set('c_commu', $c_commu);
        $this->set("is_c_commu_member", _db_is_c_commu_member($c_commu_id, $u));

        return 'success';
    }
}

?>

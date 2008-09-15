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

/**
 * コミュニティから退会
 */
class ktai_do_inc_leave_c_commu extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        // ----------

        //--- 権限チェック
        //コミュニティメンバー and 管理者でない

        $is_admin  = _db_is_c_commu_admin($target_c_commu_id, $u);
        $is_member = _db_is_c_commu_member($target_c_commu_id, $u);

        if ($is_admin) {
            $p = array('target_c_commu_id' => $target_c_commu_id, 'msg' => 10);
            openpne_redirect('ktai', 'page_c_taikai_err_admin', $p);
        }
        if (!$is_member) {
            $p = array('target_c_commu_id' => $target_c_commu_id, 'msg' => 11);
            openpne_redirect('ktai', 'page_c_taikai_err_no_member', $p);
        }
        //---

        db_commu_delete_c_commu_member($target_c_commu_id, $u);

        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('ktai', 'page_c_home', $p);
    }
}

?>

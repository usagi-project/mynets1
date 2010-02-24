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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
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

class pc_page_c_member_review_add_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $c_review_id = $requests['c_review_id'];
        // ----------

        //--- 権限チェック
        //コミュニティメンバ
        if (!_db_is_c_commu_member($c_commu_id, $u)) {
            handle_kengen_error();
        }
        //---

        if (!$c_review_id) {
            $_REQUEST['target_c_commu_id'] = $c_commu_id;
            openpne_forward('pc', 'page', "c_member_review_add");
            exit();
        }

        $c_member_review = c_member_review_add_confirm_c_member_review4c_review_id($c_review_id, $u);
        $this->set('c_member_review', $c_member_review);
        $this->set('c_commu', _db_c_commu4c_commu_id($c_commu_id));
        $this->set('c_review_id', $c_review_id);

        $this->set('inc_navi', fetch_inc_navi('c', $c_commu_id));
        return 'success';
    }
}

?>

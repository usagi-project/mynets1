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

/**
 * コミュ管理者交代承認
 */
class pc_do_h_confirm_list_update_c_commu_admin_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();


        // --- リクエスト変数
        $target_c_commu_admin_confirm_id = $requests['target_c_commu_admin_confirm_id'];
        // ----------

        //--- 権限チェック
        //コミュニティ管理者交代を受けているメンバー

        $admin_confirm = _db_c_commu_admin_confirm4c_commu_admin_confirm_id($target_c_commu_admin_confirm_id);

        if ($admin_confirm['c_member_id_to'] != $u) {
            handle_kengen_error();
        }
        // -----


        db_commu_update_c_commu_c_member_id_admin($admin_confirm['c_commu_id'], $u);

        $msg = '承認が完了しました';
        $p = array('msg' => $msg);
        openpne_redirect('pc', 'page_h_confirm_list', $p);
    }
}

?>

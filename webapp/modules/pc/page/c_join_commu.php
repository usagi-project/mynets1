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

class pc_page_c_join_commu extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        // ----------

        $status = do_common_get_c_join_status($u, $target_c_commu_id);

        //非公開コミュニティに管理者から招待されている場合は強制的に承認を回避
        $admin_invite = db_c_commu4c_admin_invite_id($target_c_commu_id, $u);
        if ($admin_invite) {
            $status = STATUS_C_JOIN_REQUEST_FREE;
        }

        switch($status) {
        //承認必要なし
        case STATUS_C_JOIN_REQUEST_FREE:
            break;
        //管理者承認必要
        case STATUS_C_JOIN_REQUEST_NEED:
            $p = array('target_c_commu_id' => $target_c_commu_id);
            openpne_redirect('pc', 'page_c_join_request', $p);
            break;
        //承認待ち
        case STATUS_C_JOIN_WAIT:
            $p = array('target_c_commu_id' => $target_c_commu_id);
            openpne_redirect('pc', 'page_c_join_err_wait', $p);
            break;
        //既に参加
        case STATUS_C_JOIN_ALREADY:
            $p = array('target_c_commu_id' => $target_c_commu_id);
            openpne_redirect('pc', 'page_c_join_err_already', $p);
            break;
        }

        $this->set('inc_navi', fetch_inc_navi('c', $target_c_commu_id));

        $this->set('c_commu', _db_c_commu4c_commu_id($target_c_commu_id));

        return 'success';
    }
}

?>

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
 * コミュニティに参加
 */
class ktai_do_inc_join_c_commu extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        // ----------

        $status = do_common_get_c_join_status($u, $target_c_commu_id);
        $p = array('target_c_commu_id' => $target_c_commu_id);

        //非公開コミュニティに管理者から招待されている場合は強制的に承認を回避
        $admin_invite = db_c_commu4c_admin_invite_id($target_c_commu_id, $u);
        if ($admin_invite) {
            $status = STATUS_C_JOIN_REQUEST_FREE;
            db_commu_delete_c_commu_admin_invite($admin_invite);
        }

        switch ($status) {
        //承認必要なし
        case STATUS_C_JOIN_REQUEST_FREE:
            do_inc_join_c_commu($target_c_commu_id, $u);
            do_inc_join_c_commu_send_mail($target_c_commu_id, $u);
            openpne_redirect('ktai', 'page_c_home', $p);
            break;

        //管理者承認必要
        case STATUS_C_JOIN_REQUEST_NEED:
            openpne_redirect('ktai', 'page_c_join_request', $p);
            break;

        //承認待ち
        case STATUS_C_JOIN_WAIT:
            openpne_redirect('ktai', 'page_c_home', $p);
            break;

        //既に参加
        case STATUS_C_JOIN_ALREADY:
            openpne_redirect('ktai', 'page_c_home', $p);
            break;
        }
    }
}
?>

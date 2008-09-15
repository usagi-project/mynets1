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

// 管理者の強制変更
class admin_do_commu_admin_chenge extends OpenPNE_Action
{
    function execute($requests)
    {
        $target_c_member_id = $requests['target_c_member_id'];
        $target_c_commu_id  = $requests['target_c_commu_id'];
        if (! $target_c_commu_id)
        {
            admin_client_redirect('ext_commu_check', 'エラーが発生しました。');
        }
        $tail = 'target_c_commu_id=' . $target_c_commu_id;
        if (! $target_c_member_id)
        {
            admin_client_redirect('view_commu_data', '変更するIDが未入力です', $tail);
        }
        $member = db_common_c_member4c_member_id_LIGHT($target_c_member_id);
        if (! $member)
        {
            admin_client_redirect('view_commu_data', '指定した会員は存在しません', $tail);
        }
        //コミュニティのメンバー以外の場合はコミュメンバーにする必要がある
        if (! _db_is_c_commu_member($target_c_commu_id, $target_c_member_id))
        {
            do_inc_join_c_commu($target_c_commu_id, $target_c_member_id);
        }
        //管理者を強制変更する
        db_admin_update_c_commu_admin($target_c_member_id, $target_c_commu_id);
        admin_client_redirect('view_commu_data', '管理者を変更しました。', $tail);
    }
}

?>

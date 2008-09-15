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

class pc_page_fh_friend_list_delete_c_friend_confilm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        //2008-06-30 Kuniharu Tsujioka
        //フレンドが一人の場合及び紹介者を外そうとした場合ははずせないようにする。
        $error = array();
        if (db_friend_count_friends($u) <= 1)
        {
            $error[] = "フレンドをすべて外すことはできません。";
        }
        $invite_member = db_common_c_member4c_member_id($u, false, false);
        if ($invite_member['c_member_id_invite'] == $target_c_member_id)
        {
            $error[] = "紹介者をフレンドから外すことはできません。";
        }
        if (! db_friend_is_friend($u, $target_c_member_id))
        {
            $error[] = "指定のユーザーはフレンドではありません。";
        }
        $this->set('error', $error);
        $this->set("target_c_member_id", $target_c_member_id);
        $this->set('inc_navi', fetch_inc_navi('h'));

        return 'success';
    }
}

?>

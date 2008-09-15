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
 * フレンドリンクを削除
 */
class pc_do_fh_friend_list_delete_c_friend extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        //--- 権限チェック
        //フレンド
        //フレンドでなくても特に影響はないのでチェックしない
        //---

        db_friend_delete_c_friend($u, $target_c_member_id);
        //相手のフレンドが1件未満になっている場合（０）
        if (! db_friend_count_friends($target_c_member_id) >= 1)
        {
            //相手のフレンドを管理者にするID=1
            db_friend_insert_c_friend($target_c_member_id, 1);
        }


        openpne_redirect('pc', 'page_h_manage_friend');
    }
}

?>

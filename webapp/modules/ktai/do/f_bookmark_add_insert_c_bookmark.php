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
 * お気に入りに追加
 */
class ktai_do_f_bookmark_add_insert_c_bookmark extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------
        $c_member_id_to   = $target_c_member_id;

        //--- 権限チェック
        //自分以外 and ブックマーク登録されていない

        if ($c_member_id_to == $u) {
            handle_kengen_error();
        }

        if (db_bookmark_is_bookmark($u, $c_member_id_to)) {
            openpne_redirect('ktai', 'page_h_bookmark_list');
        }
        //---

        db_bookmark_insert_c_bookmark($u, $c_member_id_to);
        openpne_redirect('ktai', 'page_h_bookmark_list');
    }
}

?>

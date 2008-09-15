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

class ktai_page_f_intro_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $tail = $GLOBALS['KTAI_URL_TAIL'];

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        //is_friend
        $is_friend = db_friend_is_friend($u, $target_c_member_id);

        //--- 権限チェック
        //フレンド
        if ($target_c_member_id == $u) {
            handle_kengen_error();
        }
        if (!$is_friend) {
            $p = array('target_c_member_id' => $target_c_member_id);
            openpne_redirect('ktai', 'page_f_honme', $p);
        }
        //---

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }

        $this->set("target_member", db_common_c_member4c_member_id($target_c_member_id));
        $this->set("intro_body", p_f_intro_edit_intro_body4c_member_id($u, $target_c_member_id));
        $this->set("target_c_member_id", $target_c_member_id);
        return 'success';
    }
}

?>

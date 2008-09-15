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

class pc_page_fh_intro extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        if (is_null($target_c_member_id)) {
            $target_c_member_id = $u;
        }

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('pc', 'page_h_access_block');
        }

        // navi 振り分け用
        if ($target_c_member_id == $u) {
            $type = "h";
        } else {
            $type = "f";
        }
        $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id));

        //自分情報
        $this->set("member", db_common_c_member4c_member_id($u));

        //ターゲット情報
        $this->set("target_member", db_common_c_member4c_member_id($target_c_member_id));

        if ($target_c_member_id == $u) {
            $raw_c_friend_comment_list = p_fh_intro_intro_list_with_my_intro4c_member_id($target_c_member_id);
        } else {
            $raw_c_friend_comment_list=p_fh_intro_intro_list4c_member_id($target_c_member_id);
        }
        $c_friend_comment_list = $raw_c_friend_comment_list;

        //紹介文達
        $this->set("intro_list", $c_friend_comment_list);

        //---- ページ表示 ----//
        return 'success';
    }
}

?>

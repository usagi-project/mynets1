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

class ktai_page_fh_diary_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        if (!$target_c_member_id) $target_c_member_id = $u;

        $is_friend = db_friend_is_friend($u, $target_c_member_id);

        if ($target_c_member_id == $u) {
            $type = 'h';
            $this->set("type", $type);
        }

        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }

        $target_c_member = db_common_c_member4c_member_id($target_c_member_id);

        //ターゲット情報
        $this->set("target_c_member", db_common_c_member4c_member_id($target_c_member_id));

        // 1ページ当たりに表示する日記の数
        $page_size = 10;
        $page += $direc;
        //ターゲットの詳細な日記リスト
        $list = p_fh_diary_list_diary_list4c_member_id($target_c_member_id, $page_size, $page, $u);

        $this->set("target_diary_list", $list[0]);
        $this->set("page", $page);
        $this->set("is_prev", $list[1]);
        $this->set("is_next", $list[2]);

        //f or h
        $this->set("INC_NAVI_type", k_p_fh_common_get_type($target_c_member_id, $u));

        //あしあとをつける
        db_ashiato_insert_c_ashiato($target_c_member_id, $u, 'mobile');

        return 'success';
    }
}

?>

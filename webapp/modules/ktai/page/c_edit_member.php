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

class ktai_page_c_edit_member extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $c_commu = _db_c_commu4c_commu_id($target_c_commu_id);

        //--- 権限チェック
        if ($c_commu['c_member_id_admin'] != $u) {
            ktai_display_error('閲覧権限がありません');
        }
        //---

        $page_size = 20;
        $page += $direc;

        //ページ
        $this->set("page", $page);

        //メンバのリスト
        $list = k_p_c_member_list_c_members_disp4c_commu_id($target_c_commu_id, $page_size, $page);
        $this->set("c_member_list", $list[0]);
        $this->set("is_prev", $list[1]);
        $this->set("is_next", $list[2]);

        //コミュニティのメンバ数
        $this->set("count_member", _db_count_c_commu_member_list4c_commu_id($target_c_commu_id));

        $this->set("c_commu", $c_commu);
        return 'success';
    }
}

?>

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

class ktai_page_h_com_category extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_category_id = $requests['target_c_commu_category_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        $search_word = $requests['search_word'];
        // ----------

        $page_size = 10;
        $page += $direc;

        //ページ
        $this->set("page", $page);

        $this->set("search_word", $search_word);

        //カテゴリ内のコミュニティリスト
        $list= k_p_h_com_category_c_commu_list4c_commu_category_id_search($target_c_commu_category_id, $page_size, $page, $search_word);
        $this->set("c_commu_list", $list[0]);
        $this->set("is_prev", $list[1]);
        $this->set("is_next", $list[2]);
        $this->set("count_total", $list[3]);

        //カテゴリ名
        $this->set("c_commu_category_name", k_p_h_com_category_c_commu_category_name4c_commu_category_id($target_c_commu_category_id));
        //カテゴリID
        $this->set("c_commu_category_id", $target_c_commu_category_id);

        //parent
        $this->set("c_commu_category_parent_id", k_p_h_com_category_c_commu_category_parent_id4c_commu_category_id($target_c_commu_category_id));

        return 'success';
    }
}

?>

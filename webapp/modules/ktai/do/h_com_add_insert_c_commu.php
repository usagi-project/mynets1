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

class ktai_do_h_com_add_insert_c_commu extends OpenPNE_Action
{
    function handleError($errors)
    {
        ktai_display_error($errors);
    }

    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $c_commu_category_id = $requests['c_commu_category_id'];
        $name = $requests['name'];
        $info = $requests['info'];
        $public_flag = $requests['public_flag'];
        // ----------

        $c_member_id = $u;

        $c_commu_id = db_commu_insert_c_commu($c_member_id, $name, $c_commu_category_id, $info, $public_flag);

        //作成者をコミュメンバーにする
        do_inc_join_c_commu($c_commu_id, $c_member_id);

        $p = array('target_c_commu_id' => $c_commu_id);
        openpne_redirect('ktai', 'page_c_home', $p);
    }
}

?>

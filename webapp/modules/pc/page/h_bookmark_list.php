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

class pc_page_h_bookmark_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $page_size = 20;
        $page += $direc;

        $this->set('inc_navi', fetch_inc_navi('h'));
        $list = p_h_bookmark_list($u, $page, $page_size);
        $this->set('c_members', $list[0]);
        $this->set("is_prev", $list[1]);
        $this->set("is_next", $list[2]);
        $this->set('c_members_num', $list[3]);
        $this->set("page", $page);
        $pager_index = array(
            'displaying_first' => ($page - 1) * $page_size + 1,
            'displaying_last' => ($page - 1) * $page_size + count($list[0]),
        );
        $this->set("pager_index", $pager_index);

        return 'success';
    }
}

?>

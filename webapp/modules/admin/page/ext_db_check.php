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
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/06/28] Ver1.1.0Nighty package
 * ======================================================================== 
 */

// delete_member_chk

class admin_page_ext_db_check extends OpenPNE_Action
{
    function getTitle()
    {
        return "退会者データのCSV出力";
    }

    function execute($requests)
    {
        $v = array();
        $pager = array();
        $sort_no = $requests['sort_no'];
        $page = $requests['page'];
        $page_size = $requests['page_size'];
        $keyword = $requests['keyword'];
        $page_size = 20;
        $member_data = getDeleteMemberList($sort_no, $keyword, $page, $page_size, $pager);
        $v['pager'] = $pager;
        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        $this->set("member_data",$member_data);
        $this->set($v);
        return 'success';
    }
}

?>

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
 * @version    MyNETS,v 1.1.1
 * @since      File available since Release 1.1.1 Nighty
 * @chengelog  [2007/09/01] Ver1.1.1 Nighty package
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

require_once OPENPNE_WEBAPP_DIR . "/components/information/information.class.php";
require_once OPENPNE_WEBAPP_DIR . "/components/Pager.class.php";

class pc_page_h_admin_info extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        
        // --- リクエスト変数
        $page = $requests['page'];
        // ----------

        $pagesize = ADMIN_INFO_NUM;

        $information = new Information($u);
        $info = $information->getList($page, $pagesize);
        $num = $information->getTotalNum();

        $pager = new Usagi_Pager();
        $link = $pager->set($num, $pagesize, 'javascript:void(0)" onclick="nextinfo(%d);return false;');
        $Pager_Common = new Pager_Common();
        if($Pager_Common->_path != "/") {
            $page_link = str_replace($Pager_Common->_path,'', $link);
        } else {
            $page_link = $link;
        }
        $page_link = str_replace('&quot;','"', $page_link);

        $this->set('info', $info);
        $this->set('total_num', $num);
        $this->set('page_link', $page_link);

        return 'success';
    }
}

?>

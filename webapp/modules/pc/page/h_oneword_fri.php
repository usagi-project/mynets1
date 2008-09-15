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

require_once OPENPNE_WEBAPP_DIR . "/components/one_word.class.php";
require_once OPENPNE_WEBAPP_DIR . "/components/Pager.class.php";

class pc_page_h_oneword_fri extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        $this->set('c_member_id', $u);

        // --- リクエスト変数
        $fri_page = $requests['page'];
        // ----------

        $word = new OneWord();

        $oneword_pagesize = 6;

        $oneword_list_friend = $word->getListFriend($u, $oneword_pagesize, $fri_page);
        if(empty($oneword_list_friend)) {
            $oneword_list_friend = $word->getListFriend($u, $oneword_pagesize, $fri_page-1);
            $this->set('fri_page', $fri_page-1);
        } else {
            $this->set('fri_page', $fri_page);
        }
        $this->set('oneword_list_friend', $oneword_list_friend);

        $fri_num = $word->getTotalNum();
        $this->set('fri_total_num', $fri_num);
        
        $pager = new Usagi_Pager();
        $link = $pager->set($fri_num, $oneword_pagesize, 'javascript:void(0)" onclick="nextfri(%d);return false;');
        if($Pager_Common->_path != "/") {
            $fri_link = str_replace($Pager_Common->_path,'', $link);
        } else {
            $fri_link = $link;
        }
        $fri_link = str_replace('&quot;','"', $fri_link);
        $this->set('fri_link', $fri_link);

        return 'success';
    }
}

?>

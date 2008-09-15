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

class pc_page_h_oneword_other extends OpenPNE_Action
{
    function execute($requests)
    {
        // --- リクエスト変数
        $other_page = $requests['page'];
        $target_c_member_id = $requests['target_c_member_id'];
        // ----------

        $word = new OneWord();
        $oneword_pagesize = 6;

        $oneword_list_other = $word->getListMember($target_c_member_id, $oneword_pagesize, $other_page);
        if(empty($oneword_list_other)) {
            $oneword_list_other = $word->getListMember($target_c_member_id, $oneword_pagesize, $other_page-1);
        }
        $this->set('oneword_list_other', $oneword_list_other);

        $other_num = $word->getTotalNum();
        $this->set('other_total_num', $other_num);

        $pager = new Usagi_Pager();
        $link = $pager->set($other_num, $oneword_pagesize, 'javascript:void(0)" onclick="nextother(%d ,' .$target_c_member_id. ');return false;');
        if($Pager_Common->_path != "/") {
            $other_link = str_replace($Pager_Common->_path,'', $link);
        } else {
            $other_link = $link;
        }
        $other_link = str_replace('&quot;','"', $other_link);
        $this->set('other_link', $other_link);

        return 'success';
    }
}

?>

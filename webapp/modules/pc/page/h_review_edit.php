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

class pc_page_h_review_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $asin = $requests['asin'];
        $err_msg = $requests['err_msg'];
        // ----------

        $this->set('inc_navi', fetch_inc_navi('h'));
        $this->set('err_msg', $err_msg);
        $satisfaction = array(
            "5" => "★★★★★ 5",
            "4" => "★★★★ 4",
            "3" => "★★★ 3",
            "2" => "★★ 2",
            "1" => "★ 1",
        );
        $this->set('satisfaction', $satisfaction);

        $c_review_comment = p_h_review_add_write_c_review_comment4asin_c_member_id($asin, $u);
        $this->set('c_review_comment', $c_review_comment);

        return 'success';
    }
}

?>

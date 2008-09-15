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

class pc_do_h_home_search extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        if (!is_null($requests['community_x'])) {
            $p = array('keyword' => $requests['q']);
            openpne_redirect('pc', 'page_h_com_find_all', $p);
        } elseif (!is_null($requests['web_x'])) {
            $q = urlencode($requests['q']);
            client_redirect_absolute('http://www.google.com/search?hl=ja&q='.$q);
        } else { // default
            $p = array('keyword' => $requests['q']);
            openpne_redirect('pc', 'page_h_diary_list_all', $p);
        }
    }
}

?>

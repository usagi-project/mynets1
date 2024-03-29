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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
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

class pc_do_o_click_banner extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function handleError($errors)
    {
        openpne_redirect('pc');
    }

    function execute($requests)
    {
        $u = '0';

        $target_c_banner_id = $requests['target_c_banner_id'];
        $referer = $_SERVER['HTTP_REFERER'];

        db_banner_insert_c_banner_log($target_c_banner_id, $u, $referer);

        $c_banner = db_banner_get_c_banner4id($target_c_banner_id);
        if (empty($c_banner['a_href'])) {
            openpne_redirect('pc');
        } else {
            client_redirect_absolute($c_banner['a_href']);
        }
    }
}

?>

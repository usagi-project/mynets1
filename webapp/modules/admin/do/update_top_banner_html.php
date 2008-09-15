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

// トップバナー用の任意HTML変更
class admin_do_update_top_banner_html extends OpenPNE_Action
{
    function execute($requests)
    {
        if ($requests['disp_type'] === 'html') {
            if (db_admin_c_siteadmin('top_banner_html_before')) {
                db_admin_update_c_siteadmin('top_banner_html_before', $requests['top_banner_html_before']);
            } else {
                db_admin_insert_c_siteadmin('top_banner_html_before', $requests['top_banner_html_before']);
            }
            if (db_admin_c_siteadmin('top_banner_html_after')) {
                db_admin_update_c_siteadmin('top_banner_html_after', $requests['top_banner_html_after']);
            } else {
                db_admin_insert_c_siteadmin('top_banner_html_after', $requests['top_banner_html_after']);
            }
        } else {
            if (db_admin_c_siteadmin('top_banner_html_before')) {
                db_admin_update_c_siteadmin('top_banner_html_before', '');
            }
            if (db_admin_c_siteadmin('top_banner_html_after')) {
                db_admin_update_c_siteadmin('top_banner_html_after', '');
            }
        }

        admin_client_redirect('edit_c_banner', 'トップバナーを変更しました');
    }
}

?>

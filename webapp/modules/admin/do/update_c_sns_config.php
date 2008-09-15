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

// c_sns_config 更新
class admin_do_update_c_sns_config extends OpenPNE_Action
{
    function execute($requests)
    {
        $sets = array();
        for ($i = 0; $i <= 10; $i++) {
            $name = sprintf('border_%02d', $i);
            if ($requests[$name]) {
                $sets[$name] = $requests[$name];
            }
        }
        for ($i = 0; $i <= 13; $i++) {
            $name = sprintf('bg_%02d', $i);
            if ($requests[$name]) {
                $sets[$name] = $requests[$name];
            }
        }
        if (!$sets) {
            admin_client_redirect('edit_c_sns_config');
        }
        
        db_admin_update_c_sns_config($sets);
        //genHeaderCss($sets);
        admin_client_redirect('edit_c_sns_config', '色を変更しました');
    }
}

?>

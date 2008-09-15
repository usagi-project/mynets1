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

class admin_do_update_skin_version extends OpenPNE_Action
{
    function execute($requests)
    {
        $name = 'SKIN_VERSION';
        $value = $requests['version'];

        if (is_null(db_admin_c_admin_config4name($name))) {
            db_admin_insert_c_admin_config($name, $value);
        } else {
            db_admin_update_c_admin_config($name, $value);
        }

        admin_client_redirect('edit_skin_image', 'スキン画像設定を変更しました');
    }
}

?>

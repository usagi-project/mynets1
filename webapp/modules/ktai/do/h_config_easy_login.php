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

require_once 'OpenPNE/KtaiID.php';
require_once OPENPNE_WEBAPP_DIR . "/components/mobile_get_id.class.php";
class ktai_do_h_config_easy_login extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];
        $guid = $_REQUEST['guid'];
        //if (!$easy_access_id = OpenPNE_KtaiID::getID()) {
        $mobileid = new Usagi_Get_Mobile_Id();
        if (!$easy_access_id = $mobileid->getId()) {
            $p = array('msg' => 27);
            openpne_redirect('ktai', 'page_h_config_easy_login', $p);
        }

        if (! $requests['delete']) {
            // update
            db_ktai_update_easy_access_id($u, $easy_access_id);
            $p = array('msg' => 28);
            openpne_redirect('ktai', 'page_h_config', $p);
        } else {
            // delete
            db_ktai_update_easy_access_id($u, '');
            $p = array('msg' => 29);
            openpne_redirect('ktai', 'page_h_config', $p);
        }
    }

}

?>

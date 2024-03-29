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

class pc_page_h_config_ktai extends OpenPNE_Action
{
    function execute($requests)
    {
        //<PCKTAI
        if (!OPENPNE_ENABLE_KTAI) {
            openpne_redirect('pc', 'page_h_home');
        }
        //>

        $u = $GLOBALS['AUTH']->uid();
        $c_member_secure=db_common_c_member_secure4c_member_id($u);
        $kad  = $c_member_secure['ktai_address'];
        $pcad = $c_member_secure['pc_address'];

        $this->set('ktai',$kad);
        $this->set('pcad', $pcad);

        $this->set('inc_navi', fetch_inc_navi("h"));

        $this->set('mail_server_domain', MAIL_SERVER_DOMAIN);
        $this->set('SNS_NAME', SNS_NAME);

        return 'success';
    }
}

?>

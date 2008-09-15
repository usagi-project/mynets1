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

class ktai_page_o_login_id_chk extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        $login_params = $requests['login_params'];
        $msg          = $requests['msg'];

        $mobile_banner = '';
        if (is_readable(OPENPNE_DIR . '/skin/default/img/mobilebanner.gif')) {
            $mobile_banner = OPENPNE_URL . 'skin/default/img/mobilebanner.gif';
        }
        $this->set('mobile_banner', $mobile_banner);
        $this->set('msg', $msg);
        return 'success';
    }
}

?>

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


class qrentry_page_qr_regist_confirm extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }
    function isRegistProgress()
    {
        return true;
    }

    function execute($requests)
    {
        //<PCKTAI
        if (defined('OPENPNE_REGIST_FROM') &&
                !((OPENPNE_REGIST_FROM & OPENPNE_REGIST_FROM_KTAI) >> 1)) {
            openpne_redirect('ktai', 'page_o_login');
        }
        //>
        $qr_obj = new QREntry();

        $ses = $requests['ses'];
        //ses‚©‚çTable‚ÌID‚ð’Šo‚·‚é
        $c_member_pre_id = $qr_obj->getID($ses);
        $c_commu_id      = $requests['c_commu_id'];
        //2007/09/12 QR‚É‚æ‚éŒg‘Ñ“o˜^‚Å‚ÌÅIƒ[ƒ‹Šm”Fˆ—
        if (MAIL_ADDRESS_HASHED) {
            if (isset($c_commu_id)) {
                $mail_address = "qrc".$c_commu_id."-{$c_member_pre_id}@".MAIL_SERVER_DOMAIN;
            } else {
                $mail_address = "qrm-{$c_member_pre_id}@".MAIL_SERVER_DOMAIN;
            }
        } else {
            if (isset($c_commu_id)) {
                $mail_address = "qrc".$c_commu_id."-{$c_member_pre_id}@".MAIL_SERVER_DOMAIN;
            } else {
                $mail_address = "qrm-{$c_member_pre_id}@".MAIL_SERVER_DOMAIN;
            }
        }
        $mail_address = MAIL_ADDRESS_PREFIX . $mail_address;
        if($GLOBALS['__Framework']['ktai_carrier'] == 'au') {
            $mail_address = urlencode($mail_address);
        }
        $this->set('c_member_pre_id', $c_member_pre_id);
        $this->set('ses', $ses);
        $this->set("mail_address", $mail_address);
        return 'success';
    }
}

?>

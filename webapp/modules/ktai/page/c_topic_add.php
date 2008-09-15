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

class ktai_page_c_topic_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $title = $requests['title'];
        $body = $requests['body'];
        $event_flag = $requests['event_flag'];
        $err_msg = $requests['err_msg'];
        // ----------

        //--- 権限チェック
        //コミュニティメンバー
        if (!_db_is_c_commu_member($c_commu_id, $u)) {
            handle_kengen_error();
        }

        $this->set('c_commu', _db_c_commu4c_commu_id($c_commu_id));
                if (MAIL_ADDRESS_HASHED) {
            $mail_address = "e{$c_commu_id}-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address = "e{$c_commu_id}"."@".MAIL_SERVER_DOMAIN;
        }
        $mail_address = urlencode(MAIL_ADDRESS_PREFIX) . $mail_address;
        if($GLOBALS['__Framework']['ktai_carrier'] == 'docomo') {
            $gps_address = OPENPNE_URL.'gmaps/gpsdocomo.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address;
            $gps_type = 'docomo';
        } elseif($GLOBALS['__Framework']['ktai_carrier'] == 'au') {
            $gps_address = 'device:gpsone?url='.OPENPNE_URL.'gmaps/gpsau.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address.'&ver=1&datum=0&unit=1&acry=0&number=0';
            $gps_type = 'au';
        } elseif($GLOBALS['__Framework']['ktai_carrier'] == 'softbank') {
            $gps_address = 'location:auto?url='.OPENPNE_URL.'gmaps/gpssoftbank.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address;
            $gps_type = 'softbank';
        }
        $this->set("mail_address", $mail_address);
        $this->set('gps_address', $gps_address);
        $this->set('gps_type', $gps_type);
        return 'success';
    }
}
?>

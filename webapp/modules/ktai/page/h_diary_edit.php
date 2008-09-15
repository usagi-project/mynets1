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

class ktai_page_h_diary_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_diary_id = $requests['target_c_diary_id'];
        // ----------

        $c_member = db_common_c_member4c_member_id($u);
        if ($target_c_diary_id) {
            $c_diary = db_diary_get_c_diary4id($target_c_diary_id);
            $this->set('target_c_diary', $c_diary);

            if ($c_diary['c_member_id'] != $u) {
                handle_kengen_error();
            }
        } else {
            $c_diary['public_flag'] = $c_member['public_flag_diary'];
            $this->set('target_c_diary', $c_diary);
        }

        if (MAIL_ADDRESS_HASHED) {
            $mail_address = "b{$u}-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address = "blog"."@".MAIL_SERVER_DOMAIN;
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

        $this->set('blog_address', $mail_address);
        $this->set('gps_address', $gps_address);
        $this->set('gps_type', $gps_type);

        //メンバ情報
        $this->set('member', $c_member);


        return 'success';
    }
}

?>

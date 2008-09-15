<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    UsagiProject 2006-2007
 * @author     Kunitsuji <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2008/04/01]
 * ========================================================================
 */

class Usagi_Get_Mobile_Id
{
    var $_ua;

    var $_header;

    var $_mobileid;

    var $_carrier;

    var $_userid;

    function Usagi_Get_Mobile_Id()
    {
        $this->setUa();
    }

    function setUa()
    {
        $this->_ua     = $_SERVER['HTTP_USER_AGENT'];
    }

    function getUa()
    {
        return $this->_ua;
    }

    function getId()
    {
        $this->setMobileId();

        return $this->_mobileid;
    }

    function getCarrier()
    {
        $this->setCarrier();
        return $this->_carrier;
    }

    function getUserId()
    {
        return $this->_userid;
    }

    function setMobileId()
    {
        $id = '';
        // DoCoMo
        if (!strncmp($this->_ua, 'DoCoMo', 6)) {
            if (isset($_SERVER['HTTP_X_DCMGUID'])) {
                $id = $_SERVER['HTTP_X_DCMGUID'];

            } else {
                // mova
                if (substr($this->_ua, 7, 3) === '1.0') {
                    // 『/』区切りで最後のものを取る
                    $pieces = explode('/', $this->_ua);
                    $ser = array_pop($pieces);

                    if (!strncmp($ser, 'ser', 3)) {
                        $id = $ser;
                    }
                }
                // FOMA
                elseif (substr($this->_ua, 7, 3) === '2.0') {
                    $icc = substr($this->_ua, -24, -1);

                    if (!strncmp($icc, 'icc', 3)) {
                        $id = $icc;
                    }
                }
            }
        }
        else if (isset($_SERVER["x-jphone-uid"]))
        {
            $id = $_SERVER["x-jphone-uid"];

        }
        else if (isset($_SERVER['HTTP_X_JPHONE_UID']))
        {
            $id = $_SERVER['HTTP_X_JPHONE_UID'];

        }

        // Vodafone(PDC)
        elseif (!strncmp($this->_ua, 'J-PHONE', 7)) {
            $pieces = explode('/', $this->_ua);
            $piece_sn = explode(' ', $pieces[3]);
            $sn = array_shift($piece_sn);

            if (!strncmp($sn, 'SN', 2)) {
                $id = $sn;
            }
        }
        // Vodafone(3G)
        //* Up.Browser を搭載しているものがある(auより先に評価)
        //* MOTは製造番号を取得できない
        elseif (!strncmp($this->_ua, 'Vodafone', 8)) {
            $pieces = explode('/', $this->_ua);
            $piece_sn = explode(' ', $pieces[4]);
            $sn = array_shift($piece_sn);

            if (!strncmp($sn, 'SN', 2)) {
                $id = $sn;
            }
        }
        // SoftBank
        elseif (!strncmp($this->_ua, 'SoftBank', 8)) {
            $pieces = explode('/', $this->_ua);
            $piece_sn = explode(' ', $pieces[4]);
            $sn = array_shift($piece_sn);

            if (!strncmp($sn, 'SN', 2)) {
                $id = $sn;
            }
        }

        // au
        elseif (!strncmp($this->_ua, 'KDDI', 4)
              || !strncasecmp($this->_ua, 'up.browser', 10)
            ) {
            //サブスクラバID(au)
            if ($_SERVER['HTTP_X_UP_SUBNO']) {
                $id = $_SERVER['HTTP_X_UP_SUBNO'];
            }
        }

        // emobile
        elseif (stristr($this->_ua, 'emobile') != false
                || stristr($this->_ua, 'Huawei') != false) {
            //サブスクラバID(au)
            if ($_SERVER['HTTP_X_EM_UID']) {
                $id = $_SERVER['HTTP_X_EM_UID'];
            }
        }
        elseif (isset($_SERVER['HTTP_X_EM_UID'])) {
            $id = $_SERVER['HTTP_X_EM_UID'];
        }

        $this->_mobileid = $id;
    }

    function setCarrier()
    {
        require_once OPENPNE_WEBAPP_DIR .'/lib/OpenPNE/KtaiUA.php';
        $agent = new OpenPNE_KtaiUA();
        if($agent->is_docomo()){
            $carrier = 'docomo';
        }elseif($agent->is_au()){
            $carrier = 'au';
        }elseif($agent->is_vodafone()){
            $carrier = 'softbank';
        }elseif($agent->is_willcom()){
            $carrier = 'willcom';
        }elseif($agent->is_emobile()){
            $carrier = 'emobile';
        } else {
            $carrier = 'other';
        }
        $this->_carrier = $carrier;
    }

    function chkUser()
    {
        if (!$c_member_id = db_ktai_c_member_id4easy_access_id($this->_mobileid)) {
            return false;
        } else {
            $this->_userid = $c_member_id;
            return true;
        }
    }
}
?>

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

/**
 * OpenPNE_KtaiID
 * 端末IDを取得する
 */
class OpenPNE_KtaiID
{
    /**
     * constructor
     *
     * @access public
     */
    function OpenPNE_KtaiID()
    {
    }

    /**
     * IDを取得する (static)
     *
     * @access public
     * @return string 端末ID(取得できなかった場合は空文字列)
     */
    function getID()
    {
        $id = '';
        $ua = $_SERVER['HTTP_USER_AGENT'];

        // DoCoMo
        if (!strncmp($ua, 'DoCoMo', 6)) {
            // mova
            if (substr($ua, 7, 3) === '1.0') {
                // 『/』区切りで最後のものを取る
                $pieces = explode('/', $ua);
                $ser = array_pop($pieces);

                if (!strncmp($ser, 'ser', 3)) {
                    $id = $ser;
                }
            }
            // FOMA
            elseif (substr($ua, 7, 3) === '2.0') {
                $icc = substr($ua, -24, -1);

                if (!strncmp($icc, 'icc', 3)) {
                    $id = $icc;
                }
            }
        }

        // Vodafone(PDC)
        elseif (!strncmp($ua, 'J-PHONE', 7)) {
            $pieces = explode('/', $ua);
            $piece_sn = explode(' ', $pieces[3]);
            $sn = array_shift($piece_sn);

            if (!strncmp($sn, 'SN', 2)) {
                $id = $sn;
            }
        }
        // Vodafone(3G)
        //* Up.Browser を搭載しているものがある(auより先に評価)
        //* MOTは製造番号を取得できない
        elseif (!strncmp($ua, 'Vodafone', 8)) {
            $pieces = explode('/', $ua);
            $piece_sn = explode(' ', $pieces[4]);
            $sn = array_shift($piece_sn);

            if (!strncmp($sn, 'SN', 2)) {
                $id = $sn;
            }
        }
        // SoftBank
        elseif (!strncmp($ua, 'SoftBank', 8)) {
            $pieces = explode('/', $ua);
            $piece_sn = explode(' ', $pieces[4]);
            $sn = array_shift($piece_sn);

            if (!strncmp($sn, 'SN', 2)) {
                $id = $sn;
            }
        }

        // au
        elseif (!strncmp($ua, 'KDDI', 4)
              || !strncasecmp($ua, 'up.browser', 10)
            ) {
            //サブスクラバID(au)
            if ($_SERVER['HTTP_X_UP_SUBNO']) {
                $id = $_SERVER['HTTP_X_UP_SUBNO'];
            }
        }

        // emobile
        elseif (strpos($ua, 'emobile') !== false
                || stristr($this->_ua, 'Huawei') != false
                || isset($_SERVER['HTTP_X_EM_UID'])
                ) {
                $id = $_SERVER['HTTP_X_EM_UID'];
        }

        return $id;
    }
}

?>

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

require_once 'OpenPNE/Validator.php';

/**
 * OpenPNE_Validator_Common
 *
 * 共通iniファイルの読み込みを省略化するためのサブクラス
 */
class OpenPNE_Validator_Common
{
    /**
     * @var OpenPNE_Validator
     * @access public
     */
    var $validator;

    /**
     * common_validate
     * 
     * <ul>
     * <li>共通のiniファイル(validate/common/*.ini)の読み込み</li>
     * <li>$resultの取得</li>
     * <li>$requestsの取得</li>
     * </ul>
     * をまとめて行う。
     *
     * @access public
     * @param array *.ini file names. full path. array('/hogehoge/example.ini',,,)
     * @return array(boolean,array(name=>value, name=>value,,,))
     */
    function common_validate($ini_files = array())
    {
        $this->validator =& new OpenPNE_Validator();

        // 全アクション共通のiniファイル
        $v_dir = OPENPNE_WEBAPP_DIR . '/validate/';
        $common_ini_files = array();
        $common_ini_files[] = $v_dir . 'msg.ini'; // エラーメッセージ系
        $common_ini_files[] = $v_dir . 'sessid.ini'; // はまちちゃん対策セッションID
        foreach ($common_ini_files as $ini) {
            $this->validator->addIniSetting($ini);
        }

        // 任意のiniファイル
        foreach ($ini_files as $ini) {
            $this->validator->addIniSetting($ini);
        }

        // 値チェック実行
        $result = $this->validator->validate();
        $requests = $this->validator->getParams();

        return array($result, $requests);
    }

    function getErrors()
    {
        return $this->validator->getErrors();
    }
}

?>

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

class OpenPNE_Action
{
    /**
     * @var OpenPNE_Smarty
     */
    var $view;

    var $requests;

    function OpenPNE_Action()
    {
    }

    function execute()
    {
        return 'success';
    }

    function getTitle()
    {
        return 'getTitle()なし';
    }

    function handleError($errors)
    {
        openpne_display_error($errors);
    }

    function isSecure()
    {
        return true;
    }

    /**
     * 認証を必要としない場合の処理。
     * isSecureだと一切認証を無視してしまうので、
     * ログインしている人かどうかを判定できるように追加
     * 2008/07/28 KUNIHARU Tsujioka update
     */
    function isAuth()
    {
        return false;
    }

    function isRegistProgress() {
        return false;
    }

    function set($key, $value = null)
    {
        $this->view->assign($key, $value);
    }

    function get($key)
    {
        return $this->view->get_template_vars($key);
    }

    function &getView()
    {
        return $this->view;
    }
}

?>

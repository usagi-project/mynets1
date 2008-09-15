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
 * @project    OpenPNE UsagiProject 2006-2008
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2008 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.2.0
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

function smarty_modifier_t_cmntlink_delete($string)
{
    $pattern = '/&gt;&gt;(\d+)_(\d+_[c|d])/i';
    return preg_replace_callback($pattern, 'smarty_modifier_t_cmntlink_delete_callback', $string);
}

function smarty_modifier_t_cmntlink_delete_callback($matches)
{
    return '&gt;&gt;' . $matches[1];
}

?>

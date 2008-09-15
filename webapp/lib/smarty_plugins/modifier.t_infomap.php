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

function smarty_modifier_t_infomap($string)
{
    if (!OPENPNE_USE_CMD_TAG) {
        return $string;
    }
    $regexp = '/&lt;cmd\s+src="gmaps"(?:\s+args="([^,&]+(,[\w\-\+%]+)*)?")?\s*&gt;/i';
    $string = preg_replace_callback($regexp, '_smarty_modifier_t_cmd_make_js', $string);
    return $string;

}

function _smarty_modifier_t_cmd_make_js($matches)
{

    $args = $matches[1];
    $code = rand() . "_" . strtr($args,",","_");

    $result = <<<EOD
<a href="javascript:showinfomap('{$code}')"><img src="gmaps/mapon2.gif" id='btn_{$code}' alt="マップ表示" align="absmiddle"></a>
<span id='mapbox_{$code}'></span>
EOD;
    return $result;
}


?>

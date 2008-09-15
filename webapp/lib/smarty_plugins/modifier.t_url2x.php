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
 * @author     Naoya Shimada <info@usagi.mynets.jp>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  Naoya Shimada <author member ad http://usagi.mynets.jp/member.html>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2007/12/15] Ver1.1.1Nighty package
 * ========================================================================
 */

/*
 * replace http:// or https:// to http_:// or http_s:// because of automatic linking
 *
 */
function smarty_modifier_t_url2x($string)
{
    $url_pattern = "/\bhttp(s?):\/\/\b/";
    return preg_replace_callback($url_pattern, 'smarty_modifier_t_url2x_callback', $string);
}

function smarty_modifier_t_url2x_callback($matches)
{
    return 'http_' . $matches[1] . '://';
}

?>

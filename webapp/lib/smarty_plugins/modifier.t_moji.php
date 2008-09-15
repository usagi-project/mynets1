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

/*
 * Using Pattern public_html/img/moji/x_(unicode).gif
 *
*/
function smarty_modifier_t_moji($string)
{

    $moji_pattern = '/&(?:amp;|)#x([0-9A-F][0-9A-F][0-9A-F][0-9A-F]);/i';
    $str = preg_replace_callback($moji_pattern, 'smarty_modifier_t_moji_callback', $string);
    $moji_pattern = '/\x1b\x24(\C\C)\x0f/';
    return preg_replace_callback($moji_pattern, 'smarty_modifier_t_moji_callback_softbank', $str);

}

function smarty_modifier_t_moji_callback($matches)
{
    $moji_file = sprintf('/moji/x_%s.gif',strtolower($matches[1]));
    if( is_readable("./img" . $moji_file) )
      return sprintf("<img src=\"img%s\" alt=\"絵文字\">",$moji_file);
    else
      return $matches[0];
}
function smarty_modifier_t_moji_callback_softbank($matches)
{
    $moji_file = sprintf('/moji/sb_%02x%02x.gif', ord($matches[1][0]), ord($matches[1][1]));
    if( is_readable("./img" . $moji_file) )
        return sprintf("<img src=\"img%s\" alt=\"絵文字\">",$moji_file);
    else
        return $matches[0];
}

?>

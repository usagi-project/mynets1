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

function smarty_modifier_t_image($string)
{
    $search = array('&quot;', '&#039;');
    $replace = array('"', "'");
    $string = str_replace($search, $replace, $string);

$url_pattern = '/(https?:\/\/.+\.(?:gif|jpeg|png|jpg))(?:\,((?:width|height)="?\d+%?"?))?(?:\,((?:width|height)="?\d+%?"?))?/i';

return preg_replace_callback($url_pattern, 'smarty_modifier_t_image_back', $string);

}

function smarty_modifier_t_image_back($matches)
{
    $html='<img src="'.preg_replace("/\bhttp(s?):\/\/\b/","http_\\1://",$matches[1]).'" ';
    for($i=2;$i<count($matches);$i++) {
       $html .= ' '.$matches[$i];
    }
    return $html.'>';
}

?>


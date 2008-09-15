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
 * @author     Kazuo Ide [K&X inc.]
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/* 
 * @param  string $string
 * @return string
 * Write By xyllis
 */
function smarty_modifier_t_geocode($string)
{
    if (!OPENPNE_USE_CMD_TAG) {
        return $string;
    }
    $regexp = '/\#\#([^<>]+)\#\#/i';
    return preg_replace_callback($regexp, '_smarty_modifier_t_geocode_make_js', $string);
}

function _smarty_modifier_t_geocode_make_js($matches)
{
    $src  = $matches[1];
    $res=file_get_contents('http://maps.google.co.jp/maps/geo?q='.urlencode($src).'&key=ABQIAAAAVrdpRBWknsgJGrYOjdmC6xTtqm9F4nxAvb0_1vlXOyOyK6P1AxQPUi2KrKbh_uDQEA3gq--_VQKewg&output=csv');
    $_args = explode(',', $res);
    if($_args[0] == '602') return '##'.$matches[1].'##';
    else {
        $_args2 = explode('.', $_args[2]);
        $_args3 = explode('.', $_args[3]);
        $arg_str = "'17','$_args2[0]','$_args2[1]','$_args3[0]','$_args3[1]'";

    $result = <<<EOD
    <script type="text/javascript" src="cmd/gmaps.js"></script>
{$matches[1]}<script type="text/javascript">
<!--
main({$arg_str});
//-->
</script>
EOD;
    return $result;
    }
}

?>

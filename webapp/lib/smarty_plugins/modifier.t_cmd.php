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
 * @chengelog  [2007/06/09] Ver1.1.0Nighty package
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

function smarty_modifier_t_cmd($string)
{
    if (!OPENPNE_USE_CMD_TAG) {
        return $string;
    }
//    $regexp = '/&lt;cmd\s+src="(\w+)"(?:\s+args="([\w-\+%]+(,[\w-\+%]+)*)?")?\s*&gt;/i';
    $regexp = '/&lt;cmd\s+src="(\w+)"(?:\s+args="([^,&]+(,[\w\-\+%]+)*)?")?\s*&gt;/i';
    $string = preg_replace_callback($regexp, '_smarty_modifier_t_cmd_make_js', $string);
    return $string;

}

function _smarty_modifier_t_cmd_make_js($matches)
{

    $src  = $matches[1];
    $args = $matches[2];

    $_args = explode(',', $args);
    $arg_str = "'" . implode("','", $_args) . "'";

    $result = <<<EOD
<script type="text/javascript" src="cmd/{$src}.js"></script>
<script type="text/javascript">
<!--
main({$arg_str});
//-->
</script>
EOD;
    return $result;
}


?>

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
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 * @chengelog  [2007/04/19] Ver1.0.1+ package by Yamanoi
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

function smarty_modifier_t_url2cmd($string)
{
    // "(&quot;) と '(&#039;) を元に戻す
    $search = array('&quot;', '&#039;');
    $replace = array('"', "'");
    $string = str_replace($search, $replace, $string);

    $url_pattern = "/https?:\/\/([a-zA-Z0-9\-.]+)\/?(?:[\w\-.,:;~^\/?@=+\$%#!()*]|&amp;)*/";
    return preg_replace_callback($url_pattern, '_smarty_modifier_t_cmd_make_url_js', $string);
}

function _smarty_modifier_t_cmd_make_url_js($matches)
{
    $url = $matches[0];
    $file = $matches[1] . '.js';
    $path = './cmd/' . $file;

    if (!OPENPNE_USE_CMD_TAG || !is_readable($path)) {
        // t_url2a
        return pne_url2a($url);
    }

    $result = <<<EOD
<script type="text/javascript" src="cmd/{$file}"></script>
<script type="text/javascript">
<!--
url2cmd('{$url}');
//-->
</script>
EOD;
    return $result;
}

?>

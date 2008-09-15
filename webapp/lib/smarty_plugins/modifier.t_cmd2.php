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
 * ========================================================================
*/

function smarty_modifier_t_cmd2($string)
{
    if (!OPENPNE_USE_CMD_TAG) {
        return $string;
    }
    $search = array("\r\n", "\r","&quot;");
    $replace = array("\n", "\n",'"');
    $string = str_replace($search, $replace, $string);
    $regexp = '/&lt;cmd\s+(?i:src)="([\w\.]+)"\s*([\s\w=",\/:&_;\-\'()%$#!.~^?@+*&]+)?\n?(.*)\n&gt;\n?/s';
//    $fp=fopen("e:\\debug.txt","w"); fwrite($fp,$string);fclose($fp);
    return preg_replace_callback($regexp, 'smarty_modifier_t_cmd2_callback', $string);
}

function smarty_modifier_t_cmd2_callback($matches)
{
    $param = array();
    $module=$matches[1];
    $tmp=split('[ ,]',$matches[2]);
    for($i=0;$i<count($tmp);$i++) {
        $ttmp =split("=",$tmp[$i]);
        if(count($ttmp)==2)
            $param[trim($ttmp[0])] = preg_replace('/"(.+)"/','$1',$ttmp[1]);
    }
    $body = trim($matches[3],"\n\t ");
/*
 * $module
 * $param
 * $body
 *
**/
    $file = dirname(__FILE__) . '/../cmd_plugins/cmd_'.$module.'.php';
    if(is_readable($file)) {
      require_once $file;
      $cmdmain = 'cmd_'.$module.'_main';
      return $cmdmain($param,$body);
    }

    $result="module=$matches[1]\n";
    foreach($param as $key => $value)
      $result .= "$key = $value\n";
    $result .= "/$body/\n";
    return '<font color="red">' . $result . '</font>';

}

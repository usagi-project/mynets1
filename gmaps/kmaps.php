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
 * @authoe     Kazuo Ide [K&X inc.] UsagiProject
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

$lat = htmlspecialchars($_GET["lat"], ENT_QUOTES, 'Shift_JIS');
$lon = htmlspecialchars($_GET["lon"], ENT_QUOTES, 'Shift_JIS');
header('Content-Type: text/html; charset=Shift_JIS');
$glocal = "http://www.google.co.jp/m/search?output=chtml&amp;site=maps&amp;hl=ja&amp;q={$lat},{$lon}&amp;zp=III";
$gtransit = "http://www.google.co.jp/transit?uipref=3&amp;hl=ja&amp;saddr={$lat},{$lon}&amp;output=mobile";
$string = "<a href='{$glocal}'>Googleマップで見る</a><br><a href='{$gtransit}'>ここを出発点として乗換検索をする</a>";;
$html = "<html>\n"
."<head>\n"
."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\">"
."</head>\n"
."<body><br><br>ココから先はSNS外となります。<br><br>" . $string . "\n"
."</body></html>";
print($html);
?> 
<?php
header('Content-Type: text/html; charset=Shift_JIS');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
</head>
<body>
<center><font color="orange">GPS�v���I��</font></center><hr>
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

require_once '../config.inc.php';

if ((!$_SERVER['PATH_INFO']) && (isset($_SERVER['ORIG_PATH_INFO']))) {
    $_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
}
list($dummy,$ksid,$mail) = explode("/",$_SERVER['PATH_INFO']);
$ksid = htmlspecialchars($ksid, ENT_QUOTES, 'Shift_JIS');
$mail = htmlspecialchars($mail, ENT_QUOTES, 'Shift_JIS');
$lat = htmlspecialchars($_GET["lat"], ENT_QUOTES, 'Shift_JIS');
$lon = htmlspecialchars($_GET["lon"], ENT_QUOTES, 'Shift_JIS');
$smaj = htmlspecialchars($_GET["x-acc"], ENT_QUOTES, 'Shift_JIS');
if($lat == "" || $lon == "" || $smaj == "")
    echo "�v���ł��܂���<br><a href='../../../?m=ktai&amp;a=page_h_home&amp;".$ksid."' accesskey='0'>0.ΰ�</a>";
else {
    $latn = str_replace("+","",strval($lat));
    $la = explode('.',$latn);
    $laa = floatval($la[0]) + (floatval($la[1])/60) + (floatval($la[2]+$la[3]/1000)/3600);
    $laaa = str_replace(".",",",$laa);
    $lonn = str_replace("+","",strval($lon));
    $lo = explode('.',$lonn);
    $loo = floatval($lo[0]) + (floatval($lo[1])/60) + (floatval($lo[2]+$lo[3]/1000)/3600);
    $looo = str_replace(".",",",$loo);
    $mail = str_replace('+','%2B',$mail);
    echo "�v�����I�����܂���<br>";
    echo "GPS�덷���x��(DoCoMo):{$smaj}�i3���������߂��܂��j<br>";
    echo "<div align='center'><a href='mailto:{$mail}?body=GPS�덷���x��(DoCoMo):{$smaj}%0D%0A&#60;cmd src=\"gmaps\" args=\"17,{$laaa},{$looo}\"&#62;'>���L�}�b�v�Ń��[���쐬</a><br>";
    echo "<img src='http://maps.google.com/staticmap?center={$laa},{$loo}&amp;zoom=17&amp;size=180x220&amp;markers={$laa},{$loo}&amp;maptype=mobile&amp;key=" .GOOGLE_MAPS_API_KEY. "'><br>";
    echo "<a href='../../kmaps.php?lat={$laa}&amp;lon={$loo}'>���ӂ��ڂ�������</a></div>";
    echo "<br><a href='" .OPENPNE_URL. "gmaps/gpsdocomo.php/{$ksid}/{$mail}' lcs>�Čv��</a><br>";
    echo "<a href='../../../?m=ktai&amp;a=page_h_home&amp;{$ksid}' accesskey='0'>0.ΰ�</a>";
}
?>
</body>
</html>

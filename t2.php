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
 * @version    MyNETS,v 1.0.1
 * @since      File available since Release 1.0.1 Nighty
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 * ========================================================================
 */

//2008-10-31 KUNIHARU Tsujioka update

$lat = htmlspecialchars($_GET["lat"], ENT_QUOTES, 'Shift_JIS');
$lon = htmlspecialchars($_GET["lon"], ENT_QUOTES, 'Shift_JIS');
$zoom = htmlspecialchars($_GET["zoom"], ENT_QUOTES, 'Shift_JIS');
$gkey = htmlspecialchars($_GET["gkey"], ENT_QUOTES, 'Shift_JIS');

$zp = zconvert($_GET["zoom"]);

$ezlat = rconvert($lat);
$ezlon = rconvert($lon);

if($zoom == 19) {
    $zoom = 18;
}
$mapimg = "http://maps.google.com/staticmap?center={$lat},{$lon}&amp;zoom={$zoom}&amp;size=180x220&amp;markers={$lat},{$lon}&amp;maptype=mobile&amp;key={$gkey}";
$eznavi = "http://walk.eznavi.jp/map/?datum=0&amp;unit=0&amp;lat=%2b{$ezlat}&amp;lon=%2b{$ezlon}&amp;fm=0";
$glocal = "http://www.google.co.jp/m/search?output=chtml&amp;site=maps&amp;hl=ja&amp;q={$lat},{$lon}&amp;zp={$zp}";

$string = "<div align='center'><img src='$mapimg'><br><a href='{$eznavi}'>eznaviで詳しく見る</a><br><a href='{$glocal}'>Googleマップで詳しく見る</a><br><br>ココから先はSNS外となります。</div>";

header('Content-Type: text/html; charset=Shift_JIS');

$html = "<html>\n"
."<head>\n"
."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\"/>"
."</head>\n"
."<body>" . $string . "\n"
."</body></html>";
print($html);

function rconvert($id)
{
    $nd1 = intval($id); $id=($id-$nd1)*60.0;
    $nd2 = intval($id); $id=($id-$nd2)*60.0;
    $nd3 = intval($id); $id=($id-$nd3)*100.0;
    $nd4 = intval($id);
    return sprintf("%d.%02d.%02d.%02d",$nd1,$nd2,$nd3,$nd4);
}

function zconvert($p)
{
    switch($p) {
        case '19' :
        case '18' :
        case '17' :
            $zp = 'III';
            break;
        case '16' :
            $zp = 'II';
            break;
        case '15' :
            $zp = 'I';
            break;
        case '14' :
            $zp = '';
            break;
        case '13' :
            $zp = 'O';
            break;
        case '12' :
            $zp = 'OO';
            break;
        case '11' :
            $zp = 'OOO';
            break;
        case '10' :
            $zp = 'OOOO';
            break;
        case '9' :
        case '8' :
        case '7' :
        case '6' :
        case '5' :
        case '4' :
        case '3' :
        case '2' :
        case '1' :
        case '0' :
            $zp = 'OOOOO';
            break;
    }
    return $zp;
}
?>

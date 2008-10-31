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
 *             [2008/07/18] Google GWT 対応
 * ========================================================================
 */


$url = htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES, 'Shift_JIS');

header('Content-Type: text/html; charset=Shift_JIS');

$html = "<html>\n"
."<head>\n"
."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\">"
."</head>\n"
."<body>ここからは外部のページを開きます。<br>サイトによっては正常に表示されない可能性があります。<br><br>"
."<br>直接URLを開く場合は下をクリック<br><a href=\"".$url."\">".$url."</a><br>"
."<br>モバイル用のページに変換して表示する(Google)<br>"
."<a href=\"http://www.google.co.jp/gwt/n?u=".urlencode($url)."&_gwt_noimg=0\">".$url."</a><br>"
."画像を非表示にする<br>"
."<a href=\"http://www.google.co.jp/gwt/n?u=".urlencode($url)."&_gwt_noimg=1\">".$url."</a><br>"
."<hr>"
."</body></html>";
print($html);
?>

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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @version    MyNETS,v 1.0.1
 * @since      File available since Release 1.0.1 Nighty
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 *             [2008/07/18] Google GWT �Ή�
 * ========================================================================
 */


$url = htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES, 'Shift_JIS');
$url_pattern = '/https?:\/\/(?:[\w\-.,:;~^\/?@=+$%#!()*]|&amp;)+/';

header('Content-Type: text/html; charset=Shift_JIS');

if ( ! preg_match($url_pattern, $url))
{
    $html = "<html>\n"
    ."<head>\n"
    ."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\">"
    ."</head>\n"
    ."<body>URL�𐳂����F�����邱�Ƃ��ł��܂���ł����B<br><br>"
    ."</body></html>";
}
else
{
    $html = "<html>\n"
    ."<head>\n"
    ."<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\">"
    ."</head>\n"
    ."<body>��������͊O���̃y�[�W���J���܂��B<br>�T�C�g�ɂ���Ă͐���ɕ\������Ȃ��\��������܂��B<br><br>"
    ."<br>����URL���J���ꍇ�͉����N���b�N<br><a href=\"".$url."\">".$url."</a><br>"
    ."<br>���o�C���p�̃y�[�W�ɕϊ����ĕ\������(Google)<br>"
    ."<a href=\"http://www.google.co.jp/gwt/n?u=".urlencode($url)."&_gwt_noimg=0\">".$url."</a><br>"
    ."�摜���\���ɂ���<br>"
    ."<a href=\"http://www.google.co.jp/gwt/n?u=".urlencode($url)."&_gwt_noimg=1\">".$url."</a><br>"
    ."<hr>"
    ."</body></html>";
}
print($html);
?>

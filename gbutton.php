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
 * @chengelog  [2007/12/26] Ver1.1.2Nighty package
 * ======================================================================== 
 */

require_once './config.inc.php';

if(function_exists("domxml_new_doc"))
  $url= OPENPNE_URL . "gbutton4xml.php";
else if(class_exists("DOMDocument"))
  $url= OPENPNE_URL . "gbutton5xml.php";
else 
  $url="";

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Google ツールバー ボタン Gallery</title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
</head>
<body>
<?php
if(empty($url)) {
?>
<p>php-xml-?.?.?-?.xxxx.rpmがインストールされていません。</p>
<?php
} else {
?>
<a href="http://toolbar.google.com/buttons/add?url=<?php echo $url ?>">GoogleToolbarに日記を追加する</a>
<?php
}
?>
</body>
</html>

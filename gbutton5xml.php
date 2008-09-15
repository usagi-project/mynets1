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
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

class Favicon {

var $img;

function Favicon($filename)
{
    $fp = fopen($filename,"rb");
    $da = fread($fp,4096);
    fclose($fp);
    $this->img = base64_encode($da);
}
function getxml($url_name,$title_name,$description_name)
{
    if(empty($description_name))
      $description_name = $title_name;
    $dom=new DOMDocument('1.0');
      $custombuttons = $dom->createElement("custombuttons");
      $custombuttons->setAttribute("xmlns","http://toolbar.google.com/custombuttons/");
    $root = $dom->appendChild($custombuttons);
//
    $button = $dom->createElement("button");
      $site = $dom->createElement("site");
        $siteText = $dom->createTextNode($url_name
          ."?m=pc&a=page_h_diary_add&subject=&"
          ."body=".urlencode("参考:")."%0A {url}");
        $site->appendChild($siteText);
    $button->appendChild($site);
      $title = $dom->createElement("title");
        $titleText = $dom->createTextNode($title_name);
      $title->appendChild($titleText);
    $button->appendChild($title);
      $description = $dom->createElement("description");
        $descriptionText = $dom->createTextNode($description_name);
      $description->appendChild($descriptionText);
    $button->appendChild($description);
      $update = $dom->createElement("update");
        $updateText = $dom->createTextNode($url_name);
      $update->appendChild($updateText);
    $button->appendChild($update);
      $icon = $dom->createElement("icon");
      $icon->setAttribute("mode","base64");
      $icon->setAttribute("type","image/x-icon");
        $iconText = $dom->createTextNode($this->img);
      $icon->appendChild($iconText);
    $button->appendChild($icon);
//
    $custombuttons->appendChild($button);
    return $dom->saveXML();
}
}

header("Content-Type: application/xml");
$f = new Favicon("favicon.ico");
echo $f->getxml(OPENPNE_URL, SNS_NAME, SNS_TITLE);

?>
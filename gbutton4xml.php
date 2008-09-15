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
    $dom=domxml_new_doc('1.0');
      $custombuttons = $dom->create_element("custombuttons");
      $custombuttons->set_attribute("xmlns","http://toolbar.google.com/custombuttons/");
    $root = $dom->append_child($custombuttons);
//
    $button = $dom->create_element("button");
      $site = $dom->create_element("site");
        $siteText = $dom->create_text_node($url_name
          ."?m=pc&a=page_h_diary_add&subject=&"
          ."body=".urlencode("参考:")."%0A {url}");
        $site->append_child($siteText);
    $button->append_child($site);
      $title = $dom->create_element("title");
        $titleText = $dom->create_text_node($title_name);
      $title->append_child($titleText);
    $button->append_child($title);
      $description = $dom->create_element("description");
        $descriptionText = $dom->create_text_node($description_name);
      $description->append_child($descriptionText);
    $button->append_child($description);
      $update = $dom->create_element("update");
        $updateText = $dom->create_text_node($url_name);
      $update->append_child($updateText);
    $button->append_child($update);
      $icon = $dom->create_element("icon");
      $icon->set_attribute("mode","base64");
      $icon->set_attribute("type","image/x-icon");
        $iconText = $dom->create_text_node($this->img);
      $icon->append_child($iconText);
    $button->append_child($icon);
//
    $custombuttons->append_child($button);
    return $dom->dump_mem();
}
}

header("Content-Type: application/xml");
$f = new Favicon("favicon.ico");
echo $f->getxml(OPENPNE_URL, SNS_NAME, SNS_TITLE);

?>
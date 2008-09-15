<?php
/**
 *
 * @category   Application of SNS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/menber.html>
 * @version    MyNETS,v 1.0.0 Nighty 2007/02/14
 * @since      File available since Release 1.0.0 Nighty
 *
 */

require_once './config.inc.php';

header('Content-Type: text/javascript; charset=UTF-8');

 $html = "document.writeln('<script src=\"http://www.google.com/uds/api?file=uds.js&amp;v=1.0&amp;key="
. GOOGLE_MAPS_API_KEY
. "\" type=\"text/javascript\"></script>');";

  print($html);
?>

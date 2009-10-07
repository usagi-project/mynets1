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
 *             [2008/12/17] chg api version
 * ========================================================================
 */


require_once './config.inc.php';

header('Content-Type: text/javascript; charset=UTF-8');

 $html = "document.writeln('<script type=\"text/javascript\" charset=\"utf-8\" src=\"http://maps.google.co.jp/maps?file=api&amp;v=2.175&amp;key="
. GOOGLE_MAPS_API_KEY
. "\"></script>');";

  print($html);
?>

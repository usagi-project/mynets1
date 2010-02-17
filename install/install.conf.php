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
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2008/04/30] Ver1.2.0Nighty-20080506 package
 * ========================================================================
 */

error_reporting(E_ALL ^ E_NOTICE ^ 8192);
ini_set('display_errors', true);

//install configurationファイル

//define setting
require_once "../webapp/version.php";
define('MYNETS_VERSION_NO', MyNETS_VERSION) ;

//install module
define('INSTALLER_MODULE','install');

//upgrade module
define('UPGRADE_MODULE','versionup');

//converter module
define('CONVERTER_MODULE','converter');

//parameter setting

//install template directry
$templates_dir = "templates/" ;

//install lib directry
$lib_dir = "lib/" ;

//install sql directry
$sql_dir = "sql/" ;

//install javascript directry
$js_dir = "js/" ;

//install css directry
$css_dir = "css/" ;

//header template
$header_template = $templates_dir."header.php" ;

//footer template
$footer_template = $templates_dir."footer.php" ;

//config path
$config_path_relative = "../conf/config.php";
$chk_path = '../conf/';

//file include
require_once $lib_dir."dirPermChk.class.php";
require_once $lib_dir."myFunction.php";

?>

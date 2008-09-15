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
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

if (defined('MYNETS_DB_MODULE') && MYNETS_DB_MODULE=='mysql') {
    require_once 'OpenPNE/DB/MyNETS_DB_mysql.php';
    require_once 'OpenPNE/DB/MyNETS_DB_Writer_mysql.php';
} else {
    require_once 'OpenPNE/DB.php';
    require_once 'OpenPNE/DB/Writer.php';
}

// OpenPNE/db 以下のすべてのPHPファイルを include
//最初にwebapp_extを読み込む
if (USE_EXT_DIR)
{
    define('OPENPNE_LIB_EXT_DIR', OPENPNE_WEBAPP_EXT_DIR . '/lib');
    $ext_dir = OPENPNE_LIB_EXT_DIR . '/db';
    _include_dir($ext_dir);
}

$dir = dirname(__FILE__) . '/db';
_include_dir($dir);

function _include_dir($dir)
{
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $path = realpath("$dir/$file");
                if ($file != '.' && $file != '..' && is_dir($path)) {
                    _include_dir($path);
                }
                if (substr($file, -4, 4) != '.php') continue;
                include_once $path;
            }
            closedir($dh);
        }
    }
}
?>

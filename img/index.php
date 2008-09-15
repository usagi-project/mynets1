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

/*
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 */

$request_uri = $_SERVER['REQUEST_URI'];

chdir('../');
require_once './config.inc.php';

$regexp = '/img\/(jpg|gif|png)\/w(\d+)?_h(\d+)?\/' .
             OPENPNE_IMG_CACHE_PREFIX.'(\w+)\.(?:jpe?g|gif|png)$/';
if (preg_match($regexp, $request_uri, $matches)) {
    $f = $matches[1];
    $w = $matches[2];
    $h = $matches[3];
    $filename = preg_replace('/_(jpe?g|gif|png)$/', '.\\1', $matches[4]);

    $_GET['filename'] = $filename;
    $_GET['w'] = $w;
    $_GET['h'] = $h;
    $_GET['f'] = $f;
    require_once './img.php';
    exit;
} else {
    display_error_404();
}

function display_error_404()
{
    header('HTTP/1.0 404 Not Found');
    echo <<<EOD
<html><head><title>404 Not Found</title></head>
<body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
</body></html>
EOD;
    exit;
}

?>

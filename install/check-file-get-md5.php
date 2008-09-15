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
 * @since      File available since Release 1.1.0 Nighty
 *             2008-09-10 KUNIHARU Tsujioka update パッケージ作成ファイル更新
 * ========================================================================
 */

$check_dir['usagi'] = "..";
#$check_dir['html'] = "..";


$md5_file['usagi'] = "./md5-data-usagi.php";
#$md5_file['html'] = "./md5-data-html.php";

$cwd = dirname(__FILE__);

foreach($md5_file as $dir => $file) {
    chdir($cwd);
    @unlink ($file);
    $handle = fopen($file, "a");

    chdir($check_dir[$dir]);
    check("./", "*", $dir);
    check("./", ".*", $dir);

    fclose($handle);
}



function check($path, $match, $check_dir){
    global $handle;

    $dirs = glob($path. "*");
    $files = glob($path. $match);

    foreach($files as $file){
        if (preg_match('/md5-data-.+.php$/', $file)) {
            echo "skip: $file\n";
            continue;
        }
        if (preg_match('/\/check_file\//', $file)) {
            echo "skip: $file\n";
            continue;
        }
        if ($check_dir === "usagi") {
            if (preg_match('/\.\/public_html\//', $file)) {
                echo "skip: $file\n";
                continue;
            }
        }

        if (is_file($file)) {
            $md5 = md5_file($file);
            $sha1 = sha1_file($file);
            $filesize = filesize($file);
            fwrite($handle, "$file $md5 $sha1 $filesize\n");

        }
    }

    foreach($dirs as $dir){
        if (is_dir($dir)) {
            $dir = basename($dir) . "/";
            check($path.$dir, $match, $check_dir);
        }
    }

    return;
}

?>


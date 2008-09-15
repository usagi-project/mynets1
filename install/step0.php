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
 * ========================================================================
 */

require_once "install.conf.php";

$my_post = cnv_formstr($_POST);
$set_language = isset($my_post["set_language"]) ? $my_post["set_language"] : "";
$task = isset($my_post["task"]) ? $my_post["task"] : "";

if ($task !== 'index1' && $task !== 'step0') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}


# file check
$check_dir['usagi'] = realpath(dirname(__FILE__) . '/../');

$md5_file['usagi'] = "./md5-data-usagi.php";

$cwd = dirname(__FILE__);

$msg = "";
$parm_err['flag'] = true; # true is no error
$count = 0;               # file counter


foreach($md5_file as $dir => $file) {
    chdir($cwd);
    $lines = file($md5_file[$dir]);

    $msg .= "$check_dir[$dir] 以下をチェックします<br /><br />\n";
    chdir($check_dir[$dir]);

    foreach ($lines as $line_num => $line) {
      list($file, $md5, $sha1, $filesize) = split(' ', $line);
      $filesize = trim($filesize);
      #echo "$md5\n";
      $msg .= check($file, $md5, $sha1, $filesize);
      $count++;
    }

    $msg .= "<br />\n";
}

$msg .= $count . "ファイルをチェックしました\n";


function check($file, $md5, $sha1, $filesize){
    global $parm_err;

    if (preg_match('/md5-data-.+.php$/', $file)) {
        continue;
    }

    #echo "check: $file $md5\n";

    if (!file_exists($file)) {
        $msg = "$file が存在しません<br />\n";
        $parm_err['flag'] = false;
    }
    elseif ($md5 === md5_file($file)) {
        #echo "OK\n";
    }
    else {
        $file_md5 = md5_file($file);
        $file_size = filesize($file);
        $msg = "$file ... NG 配布ファイルと異なります<br />\n";
        $msg .= "<!- md5 server:$file_md5 package:$md5 ->\n";
        $msg .= "<!- filesize server:$file_size package:$filesize ->\n";
        $parm_err['flag'] = false;
    }

    return $msg;
}



include_once $header_template;
include_once $templates_dir."step0.php";
include_once $footer_template;
?>

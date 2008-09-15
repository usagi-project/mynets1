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
 * @chengelog  [2007/05/24] Ver1.1.0Nighty package
 * ========================================================================
 */

require_once "install.conf.php";

$my_post = cnv_formstr($_POST);
$set_language = isset($my_post["set_language"]) ? $my_post["set_language"] : "";
$task = isset($my_post["task"]) ? $my_post["task"] : "";
$check_config = isset($my_post["check_config"]) ? $my_post["check_config"] : "";
$image_max_size = "300";
$image_err = "";
if ($image_max_size == "") {
    $image_max_size = "300";
} else {
    if (intval($image_max_size >= 800)) {
        //$image_err = "画像サイズが大きいです！ご注意ください。<br />";
    }
}

if ($task !== 'step2' && $task !== 'step3') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}
if ($check_config == '1') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}

include_once $header_template;
include_once $templates_dir."step3.php";
include_once $footer_template;
?>

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

if ($task !== 'step1' && $task !== 'step2') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}
$parm_err['dir']['flag'] = true;
$parm_err['dir']['msg'] = "";
$parm_err['config']['msg'] = "";
$parm_err['config']['flag'] = true;

//parmissioncheck
$config_path_absolute = realpath($config_path_relative);
$dirPermChk = new dirPermChk();
if ($dirPermChk->chekPerm($chk_path)) {
    $parm_err['dir']['msg'] .= "<span class=\"style1 fsxl\">&raquo; $chk_path configファイルを作成できます<br /></span>";
    $parm_err['dir']['flag'] = true;
} else {
    $parm_err['dir']['msg'] .= "<span class=\"style2 fsxl\">&raquo; $chk_path 書き込み権限がありません<br /></span>";
    $parm_err['dir']['flag'] = false;
}
if (file_exists($config_path_absolute)){
    $parm_err['config']['msg'] = "<span class=\"style2 fsxl\">&raquo;サーバー上に config.php が存在します。<br /></span>";
    $parm_err['config']['flag'] = false;
} else {
    $parm_err['config']['msg'] = "<span class=\"style1 fsxl\">&raquo;サーバー上に config.php を作成します。<br />手動で作成したい場合は、インストーラーを中止してください。<br /></span>";
    $parm_err['config']['flag'] = true;
}



include_once $header_template;
include_once $templates_dir."step2.php";
include_once $footer_template;
?>


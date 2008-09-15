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

if ($task !== 'step0' && $task !== 'step1') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}

//modulechkeck
$parm_err['GD']['flag'] = true;
$parm_err['mb_string']['flag'] = true;
$parm_err['GD']['msg'] = "";
$parm_err['mb_string']['msg'] = "";
$parm_err['dir']['msg'] = "";
$parm_err['mysql']['msg'] = "";
$parm_err['mysql']['flag'] = true;
$parm_err['flag'] = true;

if (!extension_loaded("gd")) {
    $parm_err['GD']['flag'] = false;
    $parm_err['GD']['msg'] = "<span class=\"style2 fsxl\">&raquo; 画像処理モジュール[ GD ]がインストールされていません</span>";
} else {
    $parm_err['GD']['msg'] = "<span class=\"GREEN fsxl\">&raquo; 画像処理モジュール[ GD ]がインストール済みです</span>";
}
if (!extension_loaded("mbstring")) {
    $parm_err['mb_string']['flag'] = false;
    $parm_err['mb_string']['msg'] = "<span class=\"style2 fsxl\">&raquo; 文字コード処理[ mbstring ]がインストールされていません</span>";
} else {
    $parm_err['mb_string']['msg'] = "<span class=\"GREEN fsxl\">&raquo; 文字コード処理[ mbstring ]がインストール済みです</span>";
}
if (!extension_loaded("mysql")) {
    $parm_err['mysql']['flag'] = false;
    $parm_err['mysql']['msg'] = "<span class=\"style2 fsxl\">&raquo; データベース接続ライブラリ[ MySQL ]がインストールされていません</span>";
} else {
    $parm_err['mysql']['msg'] = "<span class=\"GREEN fsxl\">&raquo; データベース接続ライブラリ[ MySQL ]がインストール済みです</span>";
}



//parmissioncheck
$chk_path = array(
        '../conf/',        
        '../var/log/',
        '../var/function_cache/',
        '../var/img_cache/',
        '../var/rss_cache/',
        '../var/session/',
        '../var/templates_c/',
        '../var/tmp/',
        '../var/img_cache/jpg/',
        '../var/img_cache/gif/',
        '../var/img_cache/png/',
        '../var/img_cache/jpg/w120_h120/',
        '../var/img_cache/jpg/w180_h180/',
        '../var/img_cache/jpg/w360_h360/',
        '../var/img_cache/jpg/w36_h36/',
        '../var/img_cache/jpg/w76_h76/',
        '../var/img_cache/jpg/w_h/',
        '../var/img_cache/jpg/w_h_raw/',
        '../var/img_cache/gif/w120_h120/',
        '../var/img_cache/gif/w180_h180/',
        '../var/img_cache/gif/w360_h360/',
        '../var/img_cache/gif/',
        '../var/img_cache/gif/',
        '../var/img_cache/gif/w_h/',
        '../var/img_cache/gif/w_h_raw/',
        '../var/img_cache/png/w120_h120/',
        '../var/img_cache/png/w180_h180/',
        '../var/img_cache/png/w360_h360/',
        '../var/img_cache/png/w36_h36/',
        '../var/img_cache/png/w76_h76/',
        '../var/img_cache/png/w_h/',
        '../var/img_cache/png/w_h_raw/',
        '../skin/default/img/',
        '../img/jpg/',
        '../img/jpg/w120_h120/',
        '../img/jpg/w180_h180/',
        '../img/jpg/w360_h360/',
        '../img/jpg/w36_h36/',
        '../img/jpg/w76_h76/',
        '../img/jpg/w_h/',
        '../img/jpg/w_h_raw/',
        '../img/gif/',
        '../img/gif/w120_h120/',
        '../img/gif/w180_h180/',
        '../img/gif/w360_h360/',
        '../img/gif/w36_h36/',
        '../img/gif/w76_h76/',
        '../img/gif/w_h/',
        '../img/gif/w_h_raw/',
        '../img/png/',
        '../img/png/w120_h120/',
        '../img/png/w180_h180/',
        '../img/png/w360_h360/',
        '../img/png/w36_h36/',
        '../img/png/w76_h76/',
        '../img/png/w_h/',
        '../img/png/w_h_raw/',
    );

foreach($chk_path as $value){
    $dirPermChk = new dirPermChk();
    if ($dirPermChk->chekPerm($value)) {
        $parm_err['dir']['msg'] .= "<span class=\"GREEN fsxl\">&raquo; $value OK</span><br />";
    } else {
        $parm_err['dir']['msg'] .= "<span class=\"style2 fsxl\">&raquo; $value <br />※書き込み権限がありません。変更しないとインストールできません。</span><br />";
        $parm_err['flag'] = false;
    }
}


include_once $header_template;
include_once $templates_dir."step1.php";
include_once $footer_template;
?>

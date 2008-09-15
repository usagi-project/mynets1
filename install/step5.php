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

//step5
require_once "install.conf.php";

$act = "";
$my_post = cnv_formstr($_POST);
    $act = isset($my_post["act"]) ? $my_post["act"] : "";
    $set_language = isset($my_post["set_language"]) ? $my_post["set_language"] : "";
    $task = isset($my_post["task"]) ? $my_post["task"] : "";
    $db_server = isset($my_post["db_server"]) ? $my_post["db_server"] : "";
    $db_user = isset($my_post["db_user"]) ? $my_post["db_user"] : "";
    $db_pass = isset($my_post["db_pass"]) ? $my_post["db_pass"] : "";
    $db_name = isset($my_post["db_name"]) ? $my_post["db_name"] : "";
    $image_max_size = isset($my_post["image_max_size"]) ? $my_post["image_max_size"] : "";


if ($task !== 'step4' && $task !== 'step5') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}

$conn = @mysql_connect($db_server, $db_user, $db_pass);
$dbs = @mysql_list_dbs($conn);
if (!$dbs) {
    //接続ができない
    header("location: step4.php?act=error&set_language=ja");
    exit;
}
    
//DBがあるかないかをチェック。グレードアップでも使います。
$cnt = mysql_num_rows($dbs);
$dbcheck = false;

if ($cnt < 1) {
    //テーブルは存在しません
    //新規インストールと判断する
    
    $dbcheck = false;
} else {
    //DBが存在します。
    //新しくDBを作成するか、グレードアップか
    //DBリストを作成
    //$db_list = "<select name=\"db\">";
    
    
    for ($i = 0; $i < $cnt; $i++) {
        if ($db_name == mysql_db_name($dbs, $i)) {
            $dbcheck = true;
            break;
        }
    }
    
}

include_once $header_template;
include_once $templates_dir."step5.php";
include_once $footer_template;
?>

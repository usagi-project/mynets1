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
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/05/24] Ver1.1.0Nighty package
 * ========================================================================
 */

//step7
require_once "install.conf.php";

$act = $_REQUEST['act'];
$my_post = cnv_formstr($_POST);
    $set_language = isset($my_post["set_language"]) ? $my_post["set_language"] : "";
    $task = isset($my_post["task"]) ? $my_post["task"] : "";
    $db_server = isset($my_post["db_server"]) ? $my_post["db_server"] : "";
    $db_user = isset($my_post["db_user"]) ? $my_post["db_user"] : "";
    $db_pass = isset($my_post["db_pass"]) ? $my_post["db_pass"] : "";
    $db_name = isset($my_post["db_name"]) ? $my_post["db_name"] : "";
    //$db_version = isset($my_post["db_version"]) ? $my_post["db_version"] : "";
    $db_prefix = isset($my_post["db_prefix"]) ? $my_post["db_prefix"] : "";
    $current_url = isset($my_post["current_url"]) ? $my_post["current_url"] : "";
    $db_crypt_key = isset($my_post["db_crypt_key"]) ? $my_post["db_crypt_key"] : "";
    $mail_domain = isset($my_post["mail_domain"]) ? $my_post["mail_domain"] : "";
    $map_api_key = isset($my_post["map_api_key"]) ? $my_post["map_api_key"] : "";
    $image_max_size = isset($my_post["image_max_size"]) ? $my_post["image_max_size"] : "";

if ($task !== 'step6' && $task !== 'step7') {
    //header ("location: index.php");
}
//echo(CheckVersion($db_server, $db_user, $db_pass));
//    exit;
//generate config.php
//すでにconfigが作成されている場合はどうする？
//すでにSQLがあったらどうする？
//テーブル存在チェック
$config_exists_err = false;
$install_sql_err = false;
$conn = mysql_connect($db_server, $db_user, $db_pass);
if (!$conn) {
    print("DBへ接続ができません。");
    exit();
}
$cnt = 0;
if ($tables = @mysql_query('SHOW TABLES FROM '.$db_name)) {
    $cnt = @mysql_num_rows($tables);
    $check_msg = "";
}
if ($cnt < 1) {
    //テーブルは存在しません
    //新規インストールと判断する
} else {
    //テーブルが存在します。
    for ($i = 0; $i < $cnt; $i++) {
        $check_tablename = mysql_tablename($tables, $i);
        if ($db_prefix !== '') {
            if ($check_tablename == $db_prefix.'c_member') {
                $check_msg = "すでにテーブルが作成されています";
                $install_sql_err = true;
            }
        }
    }
}
if ($install_sql_err) {

} else {
    ExecSQL($db_server, $db_user, $db_pass, $db_name, $db_prefix);
}
//CONFIG存在チェック
if (file_exists("../conf/config.php")){
    $config_exists_err = true;      //エラー表示を行う
} else {
    config_generate();
}

include_once $header_template;
include_once $templates_dir."step7.php";
include_once $footer_template;


?>

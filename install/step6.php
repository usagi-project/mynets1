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

//step6
require_once "install.conf.php";

$act = "";
$errmsg = "";
$my_post = cnv_formstr($_POST);
    $act = isset($my_post["act"]) ? $my_post["act"] : "";
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
    $update_check = isset($my_post["update_check"]) ? $my_post["update_check"] : "";
    $image_max_size = isset($my_post["image_max_size"]) ? $my_post["image_max_size"] : "";

if ($task !== 'step6' && $task !== 'step5') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}

if ($update_check == '9') {
    $install_path = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF'])) . "/";
    header("Location: " . $install_path);
}
if ($act == 'check') {
    //入力内容のチェック
    $errmsg = "";
    if ($db_user == '') {
        $errmsg .= "DBユーザー名が未入力です<br />";
    }
    if ($db_pass == '') {
        $errmsg .= "DBパスワードが未入力です<br />";
    }
    if ($db_server == '') {
        $errmsg .= "DBサーバー名が未入力です<br />";
    }
    if ($db_name == '') {
        $errmsg .= "MyNETSで利用するDB名が未入力です<br />";
    }
    /*
    if ($db_version == '') {
        $errmsg .= "MySQLのバージョンが不明です<br />";
    }
    */
    if ($current_url == '') {
        $errmsg .= "URLが未入力です<br />";
    }
    if ($db_crypt_key == '') {
        $errmsg .= "DB暗号化キーが未入力です<br />";
    }
    if ($mail_domain == '') {
        $errmsg .= "送信メールドメインが未入力です<br />";
    }
    if ($map_api_key == '') {
        $errmsg .= "GoogleMapAPIのKEYが未入力です<br />";
    }
}
    
//インストール数サーバーのURLを自動取得
$current_url = "http://" . $_SERVER['HTTP_HOST'] . dirname(htmlspecialchars($_SERVER['PHP_SELF']));
$current_url = preg_replace("/install$/", '', $current_url);
    
//新規で作成できるかどうかをチェック
$conn = mysql_connect($db_server, $db_user, $db_pass);
if (!$conn) {
    print("conn_error");
    exit();
}
$install_flag = true;
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
    //新しくテーブルを作成するか、グレードアップか
    //テーブルリストを作成
    $table_list =  "<select name=\"table\">";
    for ($i = 0; $i < $cnt; $i++) {
        $check_tablename = mysql_tablename($tables, $i);
        if ($db_prefix !== '') {
            if ($check_tablename == $db_prefix.'c_member') {
                $check_msg = "同じプレフィックスでテーブルがあります";
                $install_flag = false;
            }
        }
        $table_list .=  "<option>". $check_tablename;
    }
    $table_list .= "</select>";
    
}

include_once $header_template;
include_once $templates_dir."step6.php";
include_once $footer_template;
?>

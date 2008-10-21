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


// 配列を一括変換（エスケープ解除／HTML無効化）
function cnv_formstr($array) {
    foreach($array as $k => $v){
        if (is_array($v)) {
            break;
        }
        if (get_magic_quotes_gpc()) {
            $v = stripslashes($v);
        }
        $v = htmlspecialchars($v);
        $array[$k] = $v;
    }

    return $array;
}


//config.phpを生成
function config_generate(){
    global $_POST;

    $config_lines = file("config.php.sample");

    $file = @fopen("../conf/config.php", "w");
    @flock($file, LOCK_EX);

    foreach ($config_lines as $line_num => $line) {
        if (preg_match("/%%(.+)%%/", $line, $config)) {
            $line = preg_replace("/%%(.+)%%/", $_POST[$config[1]] , $line);
        }
        $result = @fputs($file, $line);
    }

    @flock($file, LOCK_UN);
    @fclose($file);

    //2008-10-21 KUNIHARU Tsujioka
    //chmod config.php > 777
    chmod('../conf/config.php', 0777);

    if (empty($result)){
        error("Error: generating config.php",$_POST);
    }
}


function ExecSQL($db_server, $db_user, $db_pass, $db_name, $db_prefix) {
    //global $_POST;
    $db['host']        = $db_server;
    $db['user']        = $db_user;
    $db['passwd']      = $db_pass;
    $db['db']     = $db_name;
    //$db['version']     = $db_version;
    $db['prefix']     = $db_prefix;

    //prefixのみSQLインジェクション対策
    $db['prefix'] = preg_replace(array('/[~;\'\"]/','/--/'),'',$db['prefix']);

    $filename = "./sql/v41.sql";
    $db['version'] = "41";


    /* 自動判定を入れたため、コメントアウト
    if ($db['version'] == '41') {
        $filename = "./sql/v41.sql";
    }
    if ($db['version'] == '40') {
        $filename = "./sql/v40.sql";
    }
    */
    $link = @mysql_connect ( $db['host'], $db['user'], $db['passwd'] );
    //MySQLのバージョン判定
    $check_version = mysql_get_server_info();
    $chk = strpos($check_version,"4.0");
    if ($chk === false) {
        $chk = strpos($check_version,"3.2");
        if ($chk === false){
            $db['version'] = "41";
            @mysql_query("SET NAMES utf8", $link);
        } else {
            $db['version'] = "40";
            $filename = "./sql/v40.sql";
        }
    } else {
        $db['version'] = "40";
        $filename = "./sql/v40.sql";
    }

    if (!$link) {
         error("", $_POST, "<p><font color=red>データベースに接続できませんでした。設定を見直してください。</font></p>");
    }

    if (!@mysql_select_db ($db['db'], $link)) {
         error("", $_POST, "<p><font color=red>データベースのテーブルに接続できませんでした。設定を見直してください。</font></p>");
    }

    $file = @fopen ( $filename, "r" );
    @flock($file, LOCK_EX);
    while ( $sql_files = @fgets( $file, 10240) ) {
        $sql_files = trim ($sql_files);
        if ( $sql_files[0] == '#' ) {
            continue;
        }
        if ( strpos($sql_files, '--') === 0) {
            continue;
        }
        if ( $sql_files[0] == '' ) {
            continue;
        }

        //str_replaceでprefix対応
        if ( $sql_files[strlen($sql_files)-1] == ';' ) {
            $s_sql .= str_replace('INSERT INTO `', 'INSERT INTO `'.$db['prefix'],(str_replace('CREATE TABLE IF NOT EXISTS `', 'CREATE TABLE IF NOT EXISTS `'.$db['prefix'],$sql_files)));
        } else {
            $s_sql .= str_replace('INSERT INTO `', 'INSERT INTO `'.$db['prefix'],(str_replace('CREATE TABLE IF NOT EXISTS `', 'CREATE TABLE IF NOT EXISTS `'.$db['prefix'],$sql_files)));
            continue;
        }

        $res = @mysql_query ( $s_sql, $link );
        if (!$res ) {
             error("", $_POST, "<p><font color=red>データベースの設定に失敗しました。設定を見直して再度実行してください。</font>".$s_sql."</p>");
        }
        $s_sql = "";
    }
    @flock($file, LOCK_UN);
    @fclose($file);
    @mysql_close($link);
}


function error($error_msg,$post,$error_msg_sql = ''){
include_once("templates/header.php");
echo <<<EOM
    <form method="post" action="./">
    <div class="main">
      <p>エラーが発生しました。</p>
        $error_msg_sql<br>
        処理を中断します。確認してください。
    </div>
EOM;
include_once("templates/footer.php");
exit();
}
?>

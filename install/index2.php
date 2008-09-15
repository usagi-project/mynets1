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
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', true);

require_once '../config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';
header("Content-type: text/html; charset=utf-8");


// メイン処理
switch($_POST['mode']):
    case 'finish':
        check_input();
        //SQL実行
        //ExecSQL();
        $data = array(
            'name' => 'SNS_NAME',
            'value' => $_POST['usagi_site_name'],
        );
        if (!db_insert(MYNETS_PREFIX_NAME.'c_admin_config', $data)){
            echo("すでに登録されているか、もしくはエラーが発生しました。<br />");
            echo("・<a href='../?m=admin'>管理画面</a><br />・<a href='../'>TOP</a>");
            exit;
            }
        // c_member_secure
        $data = array(
            'c_member_id' => 1,
            'hashed_password' => md5($_POST['usagi_user_pass1']),
            'pc_address' => t_encrypt($_POST['usagi_user_mail']),
            'regist_address' => t_encrypt($_POST['usagi_user_mail']),
        );
        db_insert(MYNETS_PREFIX_NAME.'c_member_secure', $data);

        // c_admin_user
        $data = array(
            'username' => $_POST['usagi_admin_mail'],
            'password' => md5($_POST['usagi_admin_pass1']),
        );
        db_insert(MYNETS_PREFIX_NAME.'c_admin_user', $data);
        finish();
        $_POST = NULL;
        $error_msg = NULL;
        //$error_msg_sql = NULL;
        break;
    default:
        first();
        break;
endswitch;
exit();

//入力チェック
function check_input() {
    global $_POST;

    //変数の初期化
    $error_msg = NULL;

    //フォーム内容をチェック
    if(empty($_POST['usagi_user_mail'])){ 
        $error_msg[0] = "<p><font color=red>初期ユーザのメールアドレスが入力されていません。</font></p>"; 
    }
    if ($_POST['usagi_user_mail'] and !preg_match( '/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/' ,$_POST['usagi_user_mail'])) {
        $error_msg[0] = "<p><font color=red>初期ユーザのメールアドレスの書式に誤りがあります。</font></p>"; 
    }
    if(empty($_POST['usagi_user_pass1'])){ 
        $error_msg[1] = "<p><font color=red>初期ユーザのパスワードが入力されていません。</font></p>"; 
    }
    if(empty($_POST['usagi_user_pass2'])){ 
        $error_msg[2] = "<p><font color=red>初期ユーザのパスワード（確認）が入力されていません。</font></p>"; 
    }
    if($_POST['usagi_user_pass1'] and $_POST['usagi_user_pass2'] and ($_POST['usagi_user_pass1'] != $_POST['usagi_user_pass2'])){ 
        $error_msg[3] = "<p><font color=red>初期ユーザのパスワードが確認と一致しません。</font></p>"; 
    }
    if(empty($_POST['usagi_admin_mail'])){ 
        $error_msg[4] = "<p><font color=red>管理画面へのログイン用のアカウント名が入力されていません。</font></p>"; 
    }
    if(empty($_POST['usagi_admin_pass1'])){ 
        $error_msg[5] = "<p><font color=red>管理画面へのログイン用のパスワードが入力されていません。</font></p>"; 
    }
    if(empty($_POST['usagi_admin_pass2'])){ 
        $error_msg[6] = "<p><font color=red>管理画面へのログイン用のパスワード（確認）が入力されていません。</font></p>"; 
    }
    if($_POST['usagi_admin_pass1'] and $_POST['usagi_admin_pass2'] and ($_POST['usagi_admin_pass1'] != $_POST['usagi_admin_pass2'])){ 
        $error_msg[7] = "<p><font color=red>管理画面へのログイン用のパスワードが確認と一致しません。</font></p>"; 
    }
    if(empty($_POST['usagi_site_name'])){ 
        $error_msg[8] = "<p><font color=red>サイト名が入力されていません。</font></p>"; 
    }

    if($error_msg){
         error2($error_msg,$_POST); 
    }
}

function first(){
    include_once "templates/header.php";
    include_once "templates/index2.php";
    include_once "templates/footer.php";
    exit();
}

function error2($error_msg,$post){
    global $_POST;

include_once "templates/header.php";
echo <<<EOM
<form method="post" action="./index2.php">
<div class="main">
  <p>以下のフォームに、Usagi を使う上で必要な情報を入力してください。</p>
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">サイト名：
      <input type="text" name="usagi_site_name" value="$post[usagi_site_name]" style="ime-mode:disabled;">$error_msg[8]
    </div>
      <blockquote><p>SNSサイト名の設定をします</p></blockquote>
    <hr size="1">
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">初期ユーザのメールアドレス：
      <input type="text" name="usagi_user_mail" value="$post[usagi_user_mail]" style="ime-mode:disabled;">$error_msg[0]
    </div>
      <blockquote><p>初期ユーザのログイン情報（メールアドレス）の設定をします</p></blockquote>
      <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">初期ユーザのパスワード：
        <input type="password" name="usagi_user_pass1" value="$post[usagi_user_pass1]" style="ime-mode:disabled;">$error_msg[1]$error_msg[3]
  </div>
      <blockquote><p>初期ユーザのログイン情報（パスワード）の設定をします</p></blockquote>
      <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">初期ユーザのパスワード（確認）：
        <input type="password" name="usagi_user_pass2" value="$post[usagi_user_pass2]">$error_msg[2]$error_msg[3]
  </div>
    <blockquote><p>初期ユーザのログイン情報（パスワード/確認）の設定をします</p></blockquote>
    <hr size="1">
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">管理用アカウントのアカウント名：
        <input name="usagi_admin_mail" type="text" value="$post[usagi_admin_mail]" style="ime-mode:disabled;">$error_msg[4]
  </div>
    <blockquote><p>管理画面へのログイン用アカウント（アカウント名）の設定をします</p></blockquote>
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">管理用アカウントのパスワード：
        <input name="usagi_admin_pass1" type="password" value="$post[usagi_admin_pass1]" style="ime-mode:disabled;">$error_msg[5]$error_msg[7]
  </div>
    <blockquote><p>管理画面へのログイン用アカウント（パスワード）の設定をします</p></blockquote>
    <div style="padding:3px 5px;border-color:#cccccc;border-width:1px 1px 1px 7px;border-style:solid; width:500;">管理用アカウントのパスワード（確認）：
        <input type="password" name="usagi_admin_pass2" value="$post[usagi_admin_pass2]" style="ime-mode:disabled;">$error_msg[6]$error_msg[7]
  </div>
      <blockquote><p>管理画面へのログイン用アカウント（パスワード/確認）の設定をします</p></blockquote>
      <div class="home">
        <input type=hidden name="mode" value="finish">
        <input type="submit" name="Submit" value="セットアップ開始">
      <a href="#"></a></div>
</div>
</form>
EOM;
include_once "templates/footer.php";
exit();
}

function finish(){
include_once "templates/header.php";
echo <<<EOM
<div class="main">
  <p class="style2 fsxl">インストール作業がすべて無事に完了しました！<br /></p>
    <p>管理ページの初期設定「SNS設定変更」からより詳しい設定ができます。</p>

    <ul>
    <!--<li><a href="../">ログインページへ</a></li>-->
    <li><a href="../?m=admin">管理ページへ</a></li>
    </ul>
    <br>
    <p class="style2">※インストールフォルダーは、インストールが成功した場合は確実に削除するか<br>フォルダー名を変更してください!!</p>
  <div class="home">
  <a href="#"></a></div>
</div>
EOM;
include_once "templates/footer.php";
}
?>

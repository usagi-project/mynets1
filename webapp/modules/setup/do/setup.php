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
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

class setup_do_setup extends OpenPNE_Action
{
    function handleError($errors)
    {
        openpne_forward('setup', 'page', 'setup', $errors);
        exit;
    }

    function execute($requests)
    {
        $errors = array();
        if ($requests['password'] != $requests['password2']) {
            $errors[] = 'パスワードが一致していません';
        }
        if ($requests['admin_password'] != $requests['admin_password2']) {
            $errors[] = '管理者パスワードが一致していません';
        }
        if ($errors) {
            $this->handleError($errors);
        }

        // c_admin_config: SNS_NAME
        $data = array(
            'name' => 'SNS_NAME',
            'value' => $requests['SNS_NAME'],
        );
        $result = db_insert(MYNETS_PREFIX_NAME . 'c_admin_config', $data);
    if( $result == false ) {
            $errors[] = 'SNS_NAMEをデータベースに書き込めません。';
    }

        // c_member_secure
        $data = array(
            'c_member_id' => 1,
            'hashed_password' => md5($requests['password']),
            'pc_address' => t_encrypt($requests['pc_address']),
            'regist_address' => t_encrypt($requests['pc_address']),
        );
        $result = db_insert(MYNETS_PREFIX_NAME . 'c_member_secure', $data);
    if( $result == false ) {
            $errors[] = '利用者のＩＤとパスワードをデータベースに書き込めません。';
    }

        // c_admin_user
        $data = array(
            'username' => $requests['admin_username'],
            'password' => md5($requests['admin_password']),
        );
        $result = db_insert(MYNETS_PREFIX_NAME . 'c_admin_user', $data);
    if( $result == false ) {
            $errors[] = '管理者のＩＤとパスワードをデータベースに書き込めません。';
    }
        if ($errors) {
            $errors[] = 'データベースの設定がなされていないか、初期化がされていない可能性があります。';
            _displayError($errors);
            exit;
    }

        openpne_redirect('setup', 'page_setup_done');
    }
}

    /**
     * Smartyを使わずにエラー表示
     * @access private
     */
    function _displayError($errors)
    {
        header('Content-Type: text/html; charset=UTF-8');
        $MyNETS_VERSION = MyNETS_VERSION;

echo <<<EOT
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>OpenPNE Usagiセットアップ</title>
<link rel="stylesheet" href="modules/setup/default.css" type="text/css">
</head>

<body>
<h1>OpenPNE Usagiセットアップ</h1>

<div>動作環境チェック
<ul class="caution">

EOT;

foreach ((array)$errors as $error) {
    echo '<li>' . $error . '</li>' . "\n";
}

echo <<<EOT
</ul>
</div>

<form action="./" method="get">
<input type="hidden" name="m" value="setup">
<input type="submit" class="submit" value=" 再試行 ">
</form>

<p style="font-size:10pt">Powered by OpenPNE Usagi v{$MyNETS_VERSION}</p>

</body>
</html>
EOT;
    }

?>

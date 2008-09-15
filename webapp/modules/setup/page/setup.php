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

class setup_page_setup extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->_checkEnv();
        return 'success';
    }

    /**
     * 動作環境チェック
     * @access private
     */
    function _checkEnv()
    {
        $errors = array();

        // ENCRYPT_KEY のチェック
        if (!(defined('ENCRYPT_KEY') && ENCRYPT_KEY) ||
            strlen(ENCRYPT_KEY) > 56)
        {
            $errors[] = 'ENCRYPT_KEYが適切に設定されていません。config.phpの設定を確認してください。';
        }

        // ディレクトリの書き込み権限のチェック
        $dirs = array(
            OPENPNE_IMG_CACHE_DIR . '/jpg',
            OPENPNE_IMG_CACHE_DIR . '/jpg/w120_h120',
            OPENPNE_IMG_CACHE_DIR . '/jpg/w180_h180',
            OPENPNE_IMG_CACHE_DIR . '/jpg/w76_h76',
            OPENPNE_IMG_CACHE_DIR . '/jpg/w36_h36',
            OPENPNE_IMG_CACHE_DIR . '/jpg/w_h',
            OPENPNE_IMG_CACHE_DIR . '/jpg/w_h_raw',
            OPENPNE_IMG_CACHE_DIR . '/gif',
            OPENPNE_IMG_CACHE_DIR . '/gif/w120_h120',
            OPENPNE_IMG_CACHE_DIR . '/gif/w180_h180',
            OPENPNE_IMG_CACHE_DIR . '/gif/w76_h76',
            OPENPNE_IMG_CACHE_DIR . '/gif/w36_h36',
            OPENPNE_IMG_CACHE_DIR . '/gif/w_h',
            OPENPNE_IMG_CACHE_DIR . '/gif/w_h_raw',
            OPENPNE_IMG_CACHE_DIR . '/png',
            OPENPNE_IMG_CACHE_DIR . '/png/w120_h120',
            OPENPNE_IMG_CACHE_DIR . '/png/w180_h180',
            OPENPNE_IMG_CACHE_DIR . '/png/w76_h76',
            OPENPNE_IMG_CACHE_DIR . '/png/w36_h36',
            OPENPNE_IMG_CACHE_DIR . '/png/w_h',
            OPENPNE_IMG_CACHE_DIR . '/png/w_h_raw',
            OPENPNE_VAR_DIR . '/function_cache',
            OPENPNE_VAR_DIR . '/log',
            OPENPNE_VAR_DIR . '/rss_cache',
            OPENPNE_VAR_DIR . '/templates_c',
            OPENPNE_VAR_DIR . '/tmp',
        );
        foreach ($dirs as $dir) {
            if (!is_writable($dir)) {
                $errors[] = 'ディレクトリの書き込み権限がありません: ' . $dir;
            }
        }

        if ($errors) {
            $this->_displayError($errors);
            exit;
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
}

?>

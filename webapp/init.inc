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
 *             [2008/02/15] 携帯メールアドレスにディズニーモバイルを追加
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

// 画像サーバの場合は強制リダイレクト
if (defined('OPENPNE_IS_IMG_SERVER') && OPENPNE_IS_IMG_SERVER) {
    header('Location: ' . OPENPNE_URL);
    exit;
}

/**
 *  共通の初期化処理
 */
// バージョン番号の取得
include_once OPENPNE_WEBAPP_DIR . '/version.php';

// include_path の設定
include_once OPENPNE_LIB_DIR . '/include/PHP/Compat/Constant/PATH_SEPARATOR.php';
$include_paths = array(
    OPENPNE_LIB_DIR . '/include',
    OPENPNE_WEBAPP_DIR . '/lib',
    ini_get('include_path')
);
ini_set('include_path', implode(PATH_SEPARATOR, $include_paths));

// 定数定義
include_once 'PHP/Compat/Constant/UPLOAD_ERR.php';
include_once 'PHP/Compat/Function/image_type_to_mime_type.php';
include_once 'Pager/Pager.php' ;
// 新規登録フラグ用定数
define('OPENPNE_REGIST_FROM_NONE'  , 0); // 新規登録不可
define('OPENPNE_REGIST_FROM_PC'    , 1); // PCからのみ登録可
define('OPENPNE_REGIST_FROM_KTAI'  , 2); // 携帯からのみ登録可
define('OPENPNE_REGIST_FROM_PCKTAI', 3); // PC携帯から登録可

// 携帯メールのドメイン名
$GLOBALS['OpenPNE']['KTAI_DOMAINS'] = array(
    'docomo.ne.jp',
    'ezweb.ne.jp',
    'softbank.ne.jp',
    'd.vodafone.ne.jp',
    'h.vodafone.ne.jp',
    't.vodafone.ne.jp',
    'c.vodafone.ne.jp',
    'r.vodafone.ne.jp',
    'k.vodafone.ne.jp',
    'n.vodafone.ne.jp',
    'q.vodafone.ne.jp',
    's.vodafone.ne.jp',
    'disney.ne.jp',
    'pdx.ne.jp',
    'di.pdx.ne.jp',
    'dj.pdx.ne.jp',
    'dk.pdx.ne.jp',
    'wm.pdx.ne.jp',
    'emnet.ne.jp',
    'i.softbank.ne.jp',     //20080714 iPhone用携帯アドレス追加
);

// Smarty の設定
$GLOBALS['SMARTY'] = (array)$GLOBALS['SMARTY'] + array(
    'template_dir'      => OPENPNE_WEBAPP_DIR . '/templates/',
    'compile_dir'       => OPENPNE_VAR_DIR . '/templates_c/',
    'left_delimiter'    => '({',
    'right_delimiter'   => '})',
    'caching'           => false,
    'debugging'         => false,
    'debug_tpl'         => OPENPNE_WEBAPP_DIR . '/templates/debug.tpl',
    'default_modifiers' => array('@t_escape'),
    'error_reporting'   => E_ALL ^ E_NOTICE,
);
$GLOBALS['SMARTY']['plugins_dir'] = array(
    OPENPNE_WEBAPP_DIR . '/lib/smarty_plugins/',
    OPENPNE_LIB_DIR . '/smarty_plugins/',
    'plugins'
);

// ライブラリ読み込み
require_once 'util.inc.php';
require_once 'db.inc.php';
require_once 'controller.php';
require_once 'OpenPNE/Smarty.php';
require_once 'OpenPNE/Auth.php';

require_once 'OpenPNE/Config.php';
// DBから設定読み込み
$config =& OpenPNE_Config::getInstance();
$config->db_load_config();
// 設定のデフォルト値を適用
$config->bind_default();

// cookie 設定
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1');

$url = parse_url(OPENPNE_URL);
if (substr($url['path'], -1) != '/') {
    $url['path'] .= '/';
}
ini_set('session.cookie_path', $url['path']);

// セッション情報をDBに保存
OpenPNE_Auth::set_session_save_handler();

// magic_quotes_gpc = On の場合の対策
if (get_magic_quotes_gpc()) {
    function strip_magic_slashes($arr)
    {
        return is_array($arr) ?
            array_map('strip_magic_slashes', $arr) :
            stripslashes($arr);
    }

    $_GET     = strip_magic_slashes($_GET);
    $_POST    = strip_magic_slashes($_POST);
    $_REQUEST = strip_magic_slashes($_REQUEST);
}

isset($GLOBALS['OpenPNE']['common']['session_lifetime'])
    or $GLOBALS['OpenPNE']['common']['session_lifetime'] = 0;
isset($GLOBALS['OpenPNE']['common']['session_idletime'])
    or $GLOBALS['OpenPNE']['common']['session_idletime'] = 0;

ini_set('arg_separator.output', '&');

?>

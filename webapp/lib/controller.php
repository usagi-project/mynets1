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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty

 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 * ========================================================================
 */

require_once 'OpenPNE/Action.php';

// __Framework
$GLOBALS['__Framework']['current_module'] = '';
$GLOBALS['__Framework']['current_type']   = '';
$GLOBALS['__Framework']['current_action'] = '';
$GLOBALS['__Framework']['default_type']   = 'page';
$GLOBALS['__Framework']['default_page']   = '';
$GLOBALS['__Framework']['is_secure']   = true;
$GLOBALS['__Framework']['current_model'] = '';
$_SESSION['GVAL'] = array();

/**
 * 初期実行 index.php から呼ばれる
 */
function openpne_execute()
{
    $module = '';
    $type   = '';
    $action = '';

    if (!($module = get_request_var('m'))) {
        /*インストーラーで判定するために、カット必要な場合は手動で呼び出す
          2007/05/17 KT
        */

        // モジュール名の自動設定
        //if (!db_admin_user_exists()) {
        //    $module = 'setup';
        //} elseif (isKtaiUserAgent()) {
        if (isKtaiUserAgent()) {
            $module = 'ktai';
        } else {
            $module = 'pc';
        }
    }

    $types = array('page', 'do', 'ajax');
    if ($a = get_request_var('a')) {
        $arr = explode('_', $a, 2);
        if (!empty($arr[1]) && in_array($arr[0], $types)) {
            $type   = $arr[0];
            $action = $arr[1];
        }
    }

    //HOOKSクラスの読み込み
    include_once OPENPNE_WEBAPP_DIR . '/lib/Hooks.class.php';
    $EXT = new Hooks();

    $EXT->_call_hook('pre_system');

    openpne_forward($module, $type, $action);
}

/**
 * J-PHONE 旧機種対応のため GET 優先でリクエスト変数を取得
 */
function get_request_var($key)
{
    if (isset($_GET[$key])) {
        return $_GET[$key];
    } elseif (isset($_POST[$key])) {
        return $_POST[$key];
    } elseif (isset($_REQUEST[$key])) {
        return $_REQUEST[$key];
    } else {
        return '';
    }
}

/**
 * openpne_forward
 *
 * @param string $module a requested module name.
 * @param string $type request type. 'page' or 'do'
 * @param string $action requested page/command name.
 * @param array  $errors error message strings.
 */
function openpne_forward($module, $type = '', $action = '', $errors = array())
{
    //HooksClass
    $EXT = new Hooks();

    /// module ///
    if (!$module = _check_module($module)) {
        openpne_display_error('モジュールが見つかりません', true);
    }
    $GLOBALS['__Framework']['current_module'] = $module;

    // disable modules
    if (in_array($module, (array)$GLOBALS['_OPENPNE_DISABLE_MODULES'])) {
        openpne_display_error('モジュールが無効になっています', true);
    }
    // maintenace mode
    if (OPENPNE_UNDER_MAINTENANCE &&
        !in_array($module, (array)$GLOBALS['_OPENPNE_MAINTENANCE_MODULES'])) {
        openpne_display_error();
    }

    //モジュールのinit.incが読み込まれる前
    $EXT->_call_hook('pre_include_init');

    // init
    if ($init = openpne_ext_search("{$module}/init.inc")) {
        require_once $init;
    }

    //モジュールのinit.incが読み込まれた後
    $EXT->_call_hook('post_include_init');

    /// type ///
    if (!$type) {
        $type = $GLOBALS['__Framework']['default_type'];
    }
    if (!_check_type($type)) {
        openpne_display_error('リクエストの種類が正しくありません', true);
    }
    $GLOBALS['__Framework']['current_type'] = $type;

    /// action ///
    if (!$action = _check_action($action)) {
        openpne_display_error('アクションの指定が正しくありません', true);
    }

    /// MYNETS decorator
    $action2 = $action;
    if (_check_model($module,$type,$action)) {
        $type2 = "models";
        // auth
        if ($GLOBALS['__Framework']['is_secure'] = $GLOBALS['__Framework']['current_model']['secure']) {
            if ($auth = openpne_ext_search("{$module}/auth.inc")) {
                require_once $auth;
            } else {
                require_once 'auth.inc';
            }
        }
    } else {
        $type2 = $type;
        if ( $type == 'ajax' ) {
            $action2 = str_replace('_','/',$action);
            if (!$file = openpne_ext_search("{$module}/{$type}/{$action2}.php")) {
                openpne_display_error('アクションファイルが見つかりません', true);
            }
        } else {
            if (!$file = openpne_ext_search("{$module}/{$type}/{$action}.php")) {
                openpne_display_error('アクションファイルが見つかりません', true);
            }
        }
        require_once $file;
        $class_name = "{$module}_{$type}_{$action}";
        if (!class_exists($class_name)) {
            openpne_display_error('アクションが見つかりません', true);
        }
        $action_obj = new $class_name();
        $GLOBALS['__Framework']['current_action'] = $action;

        // auth
        if ($GLOBALS['__Framework']['is_secure'] = $action_obj->isSecure()) {
            if ($auth = openpne_ext_search("{$module}/auth.inc")) {
                require_once $auth;
            } else {
                require_once 'auth.inc';
            }
        }

        // regist progress
        if ($action_obj->isRegistProgress()) {
            if ($regist_file = openpne_ext_search("{$module}/regist.inc")) {
                require_once $regist_file;
            }
        }
    }
    //auth.incファイルが読み込まれた後
    $EXT->_call_hook('post_auth_inc');

    // ---------- リクエストバリデーション ----------

    require_once 'OpenPNE/Validator.php';
    require_once 'OpenPNE/Validator/Common.php';
    $validator = new OpenPNE_Validator_Common();

    $files = array();
    if ($ini = openpne_ext_search("{$module}/validate/{$type}/{$action}.ini")) {
        $files[] = $ini;
    }
    list($result, $requests) = $validator->common_validate($files);
    $action_obj->requests = $requests;

    if ($result === false) {
        $errors = $validator->getErrors();
        $action_obj->handleError($errors);
    }
    //バリデーション処理が終了した後
    $EXT->_call_hook('post_validation');

    // ----------------------------------------------
    switch ($type2) {
    case 'page':
    case 'models':
        $smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
        if ( $type2=='page' )
            $smarty->templates_dir = $module . '/templates';
        else
            $smarty->templates_dir = $module . '/models';

        $smarty->assign('requests', $requests);

        $smarty->assign('msg', $requests['msg']);
        $smarty->assign('msg1', $requests['msg1']);
        $smarty->assign('msg2', $requests['msg2']);
        $smarty->assign('msg3', $requests['msg3']);
        if ($errors) {
            $smarty->assign('errors', $errors);
        }

        if (OPENPNE_USE_PARTIAL_SSL) {
            $a = "{$type}_{$action}";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $p = $_POST;
            } else {
                $p = $_GET;
            }
            switch (openpne_ssl_type($module, $a)) {
            case 'SSL_REQUIRED':
                if (!is_ssl()) {
                    openpne_redirect($module, $a, $p);
                }
                break;
            case 'SSL_DISABLED':
                if (is_ssl()) {
                    openpne_redirect($module, $a, $p);
                }
                break;
            case 'SSL_SELECTABLE':
                if ($https = is_ssl()) {
                    $url = openpne_gen_url($module, $a, $p, true, 'nonssl');
                } else {
                    $url = openpne_gen_url($module, $a, $p, true, 'ssl');
                }
                $smarty->assign('HTTPS', $https);
                $smarty->assign('SSL_SELECT_URL', $url);
                break;
            }
        }

        $action_obj->view =& $smarty;
        break;
    case 'ajax':
        $smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
        $smarty->templates_dir = $module . '/templates';
        $smarty->assign('requests', $requests);
        $smarty->assign('msg', $requests['msg']);
        $smarty->assign('msg1', $requests['msg1']);
        $smarty->assign('msg2', $requests['msg2']);
        $smarty->assign('msg3', $requests['msg3']);
        if ($errors) {
            $smarty->assign('errors', $errors);
        }
        $action_obj->view =& $smarty;
        break;
    }

    // init function
    $init_func = "init_{$module}_{$type2}";
    if (function_exists($init_func)) {
        if (isset($smarty)) {
            $init_func($smarty);
        } else {
            $init_func();
        }
    }
    //モジュールの後のinitファンクションが実行された後
    $EXT->_call_hook('post_do_init');

    if ( $type2 == 'models')
        $result = model_execute($requests,$module,$smarty);
    else
        $result = $action_obj->execute($requests);
    if ($result == 'success') {
        send_nocache_headers();
        $smarty->ext_display("{$action2}.tpl");
    }
    // ----------------------------------------------

    //logger
    if (LOG_C_ACCESS_LOG) {
        if ($GLOBALS['__Framework']['is_secure'] && $type == 'page') {
            if ($module == 'pc') {
                p_access_log($GLOBALS['AUTH']->uid(), $action);
            } elseif ($module == 'ktai') {
                p_access_log($GLOBALS['KTAI_C_MEMBER_ID'], $action, 1);
            }
        }
    }
    //コントローラーのすべての処理が終了した時点（画像表示が終わった）
    $EXT->_call_hook('post_all_system');

    return true;
}

function model_execute($requests,$module,$smarty)
{
    $mo = $GLOBALS['__Framework']['current_model'];
    $tpl = array();
    foreach( $mo as $key => $val) {
        if (!empty($val[action])) {
            $actions = explode(",", $val[action]);
            $tpl[$key] = '';
            foreach( $actions as $action ) {
                if ($file = openpne_ext_search("{$module}/ajax/{$action}.php")) {
                    require_once $file;
                    $class_name = "{$module}_ajax_".str_replace('/', '_',$action);
                    if (class_exists($class_name)) {
                        $action_obj = new $class_name();
                        $smarty2 = new OpenPNE_Smarty($GLOBALS['SMARTY']);
                        $smarty2->templates_dir = $module . '/templates';
                        $smarty2->assign('requests', $requests);
                        $action_obj->view =& $smarty2;
                        $result = $action_obj->execute($requests);
                        if ($result == 'success') {
                            $tpl[$key] .= $smarty2->ext_fetch("{$action}.tpl");
                        }
                    }
                }
            }
        }
    }
    $smarty->assign('tpl',$tpl);
    return 'success';
}

function openpne_display_error($errors = array(), $notfound = false)
{
    $smarty = new OpenPNE_Smarty($GLOBALS['SMARTY']);
    $smarty->setOutputCharset('SJIS');
    $smarty->assign('notfound', $notfound);
    if (OPENPNE_DEBUGGING) {
        $smarty->assign('errors', (array)$errors);
    }
    $smarty->ext_display('error.tpl');
    exit;
}

function openpne_ext_search($path)
{
    $dft = OPENPNE_MODULES_DIR . '/' . $path;
    $ext = OPENPNE_MODULES_EXT_DIR . '/' . $path;

    if (USE_EXT_DIR && is_readable($ext)) {
        return $ext;
    } elseif (is_readable($dft)) {
        return $dft;
    }

    return false;
}

/**
 * モジュール名を取得
 * 空の場合はデフォルトモジュールを返す
 *
 * 間違ったモジュール名を指定した
 * デフォルトモジュールが存在しない場合は false
 *
 * @param string $module module name
 */
function _check_module($module)
{
    // 英数字とアンダーバーのみ
    // 「../」等は許さない
    if (preg_match('/\W/', $module)) {
        // モジュール名が不正です
        return false;
    }

    if (empty($module)) {
        // モジュールが指定されていません
        return false;
    }

    if ($module == ADMIN_MODULE_NAME) {
        $module = 'admin';
    } elseif ($module == 'admin') {
        return false;
    }

    if (!openpne_ext_search($module)) {
        return false;
    }

    return $module;
}

function _check_type($type)
{
    switch ($type) {
        case 'page':
        case 'do':
        case 'ajax':
            break;
        default:
            // unknown type
            return false;
    }

    return $type;
}

function _check_action($action)
{
    // 英数字とアンダーバーのみ
    // 「../」等は許さない
    if (preg_match('/\W/', $action)) {
        // アクション名が不正です
        return false;
    }

    if (empty($action)) {
        $type = $GLOBALS['__Framework']['current_type'];
        if (empty($GLOBALS['__Framework']['default_' . $type])) {
            // ページが指定されていません
            return false;
        } else {
            $action = $GLOBALS['__Framework']['default_' . $type];
        }
    }

    return $action;
}

function _check_model($module,$type,$action)
{
//    if ($module != 'pc') return false;
    if ($type != 'page') return false;
    if (!($file = openpne_ext_search("{$module}/models/{$action}.ini")))
        return false;
    $GLOBALS['__Framework']['current_model'] = parse_ini_file($file,ture);
    if (!isset($GLOBALS['__Framework']['current_model']['secure']))
        $GLOBALS['__Framework']['current_model']['secure'] = true;
    return true;
}

function send_nocache_headers()
{
    if (!headers_sent()) {
        // no-cache
        // 日付が過去
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

        // 常に修正されている
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

        // HTTP/1.1
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        // HTTP/1.0
        header('Pragma: no-cache');

        return true;
    } else {
        return false;
    }
}

function handle_kengen_error()
{
    switch ($GLOBALS['__Framework']['current_module']) {
    case 'pc':
        openpne_forward('pc', 'page', 'h_err_forbidden');
        break;
    case 'ktai':
        ktai_display_error('このページにはアクセスすることができません。');
        break;
    default:
        openpne_display_error('このページにはアクセスすることができません。');
        break;
    }
    exit;
}

?>

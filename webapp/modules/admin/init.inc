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

// admin モジュール initialize 処理

// auth関連設定
session_name('OpenPNEadmin');
isset($GLOBALS['OpenPNE']['admin']['session_lifetime'])
    or $GLOBALS['OpenPNE']['admin']['session_lifetime'] = 0;
isset($GLOBALS['OpenPNE']['admin']['session_idletime'])
    or $GLOBALS['OpenPNE']['admin']['session_idletime'] = 0;

// ライブラリ読み込み
$module_lib_dir = dirname(__FILE__) . '/lib';
require_once $module_lib_dir . '/db_admin.php';
require_once $module_lib_dir . '/etc_admin.php';
require_once $module_lib_dir . '/hash_admin.php';
require_once $module_lib_dir . '/admin_diary.class.php';
require_once $module_lib_dir . '/admin_message.class.php';
require_once $module_lib_dir . '/admin_commu.class.php';
require_once $module_lib_dir . '/admin_member.class.php';
require_once $module_lib_dir . '/admin_inquiry.class.php';
require_once $module_lib_dir . '/admin_information.class.php';

// デフォルトページ
$GLOBALS['__Framework']['default_page'] = 'top';

// ハッシュから action名を取得
$hash_tbl =& AdminHashTable::singleton();
$action = $hash_tbl->action($action, $type);

$GLOBALS['_OPENPNE_ADMIN_AUTH_ACTIONS'] = array(
'normal_type' => array(
    'page_delete_c_image_confirm',
    'page_delete_c_member_confirm',
    'page_delete_kakikomi',
    'page_edit_c_image',
    'page_insert_c_admin_user',
    'page_list_c_admin_user',
    'page_list_c_image',
    'page_list_c_member',
    'page_manage_c_commu',
    'page_passwd',
    'page_send_invites_confirm',
    'page_send_invites',
    'page_send_messages_all',
    'page_send_messages',
    'do_delete_c_admin_user',
    'do_delete_c_image',
    'do_delete_c_image4c_image_id',
    'do_delete_c_member',
    'do_delete_kakikomi_c_commu_topic',
    'do_delete_kakikomi_c_commu',
    'do_delete_kakikomi_c_diary',
    'do_insert_c_admin_user',
    'do_insert_c_image',
    'do_passwd',
    'do_send_invites',
    'do_send_messages_all',
    'do_send_messages',
    'do_update_c_commu_is_regist_join',
    'do_update_is_login_rejected',
),
'_type' => array(
    'page_delete_c_member_confirm',
    'page_insert_c_admin_user',
    'page_list_c_admin_user',
    'page_list_c_member',
    'page_passwd',
    'page_send_messages_all',
    'page_send_messages',
    'do_delete_c_admin_user',
    'do_delete_c_member',
    'do_insert_c_admin_user',
    'do_passwd',
    'do_send_messages_all',
    'do_send_messages',
    'do_update_is_login_rejected',
),
);

function init_admin_page(&$smarty)
{
    $is_secure = $GLOBALS['__Framework']['is_secure'];
    $smarty->assign('inc_header', admin_fetch_inc_header($is_secure));
    $smarty->assign('inc_footer', admin_fetch_inc_footer($is_secure));
    $v['module_name'] = ADMIN_MODULE_NAME;
    $smarty->assign($v);
    $smarty->assign_by_ref('hash_tbl', AdminHashTable::singleton());
    $install_folder_path = "./install/index.php";
    if (file_exists($install_folder_path)){
        $smarty->assign('INSTALL', true);
    } else {
        $smarty->assign('INSTALL', false);
    }
    $converter_path = "./convert/index.php";
    if (file_exists($converter_path)){
        $smarty->assign('CONVERT', true);
    } else {
        $smarty->assign('CONVERT', false);
    }
    if ($is_secure) {
        @session_start();
        $smarty->assign('PHPSESSID', md5(session_id()));

        $auth_type = admin_get_auth_type();
        $smarty->assign('auth_type', $auth_type);
        $act = sprintf('page_%s', $GLOBALS['__Framework']['current_action']);
        if ($auth_type != 'all' && in_array($act, $GLOBALS['_OPENPNE_ADMIN_AUTH_ACTIONS'][$auth_type.'_type'])) {
            admin_client_redirect('top', '指定されたページにはアクセスできません');
        }
    }
}

function init_admin_do()
{
    $is_secure = $GLOBALS['__Framework']['is_secure'];

    if ($is_secure) {
        @session_start();
        if ($_REQUEST['sessid'] !== md5(session_id())) {
            openpne_display_error('前の画面を再読み込みして、操作をやり直してください');
        }
        $auth_type = admin_get_auth_type();
        $act = sprintf('do_%s', $GLOBALS['__Framework']['current_action']);
        if ($auth_type != 'all' && in_array($act, $GLOBALS['_OPENPNE_ADMIN_AUTH_ACTIONS'][$auth_type.'_type'])) {
            admin_client_redirect('top', '指定されたページにはアクセスできません');
        }
    }
}

?>

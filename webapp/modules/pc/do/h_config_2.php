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

require_once OPENPNE_WEBAPP_DIR . "/components/count/change/count_change_count.class.php";

/**
 * パスワード変更
 */
class pc_do_h_config_2 extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $old_password = $requests['old_password'];
        $new_password = $requests['new_password'];
        $new_password2 = $requests['new_password2'];
        // ----------

        $msg_list = array();
        if (!$new_password) $msg_list[] = "パスワードを入力してください";
        if (!$new_password2) $msg_list[] = "パスワード(確認)を入力してください";

        if ($new_password != $new_password2) $msg_list[] = "パスワードが一致しません";
        if (!ctype_alnum($new_password) ||
            strlen($new_password) < 6 ||
            strlen($new_password) > 12) {
            $msg_list[] = "パスワードは6～12文字の半角英数で入力してください";
        }

        if (!$msg_list && !db_common_authenticate_password($u, $old_password)) {
            $msg_list[] = "現在のパスワードが違います";
        }

        // error
        if ($msg_list) {
            $_REQUEST['msg'] = array_shift($msg_list);
            openpne_forward('pc', 'page', "h_config");
            exit;
        }

        do_common_update_password($u, $new_password);

        //変更あり
        //2008-03-11 Count処理を追加 kuniharu Tsujioka
        $datacount = new Change_Count('chenge_password_count', $u);
        $datacount->addCount();
        //**************************************************

        $GLOBALS['AUTH']->logout();

        $p = array('msg_code' => 'change_password');
        openpne_redirect('pc', 'page_o_tologin', $p);
    }
}

?>

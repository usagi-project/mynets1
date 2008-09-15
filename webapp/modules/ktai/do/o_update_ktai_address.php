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
require_once 'OpenPNE/KtaiID.php';
class ktai_do_o_update_ktai_address extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        // --- リクエスト変数
        $ses = $requests['ses'];
        $password = $requests['password'];
        // ----------

        // セッションが有効かどうか
        if (!$pre = c_ktai_address_pre4session($ses)) {
            // 無効の場合、login へリダイレクト
            openpne_redirect('ktai', 'page_o_login');
        }

        $c_member_id = $pre['c_member_id'];
        $ktai_address = $pre['ktai_address'];

        // パスワードチェック
        if (!db_common_authenticate_password($c_member_id, $password)) {
            $p = array('msg' => 18, 'ses' => $ses);
            openpne_redirect('ktai', 'page_o_login2', $p);
        }
        
        /*簡単ログインを判定
            $easy_access_id = OpenPNE_KtaiID::getID();
            if (!$easy_access_id && (IS_GET_EASY_ACCESS_ID == 2)) {
                //$errors[] = '携帯の個体番号を取得できませんでした<br>簡単ログインのチェックを外して登録してください';
            }
        */
        k_do_update_ktai_address($c_member_id, $ktai_address);
        k_do_delete_ktai_address_pre($pre['c_ktai_address_pre_id']);

        // login ページへリダイレクト
        $p = array('msg' => 19, 'kad' => t_encrypt($ktai_address));
        openpne_redirect('ktai', 'page_o_login', $p);
    }
}

?>

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


require_once 'OpenPNE/KtaiID.php';
require_once OPENPNE_WEBAPP_DIR .'/components/mobile_get_id.class.php';

class ktai_do_o_easy_login_docomo extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        //i-modeIDを取得する
        $mobileid = new Usagi_Get_Mobile_Id();
        $mid      = $mobileid->getId();
        //以前の端末IDを取得する
        $oldid    = new OpenPNE_KtaiID();
        $oid      = $oldid->getID();

        //以前のIDで認証を実施
        if (!$c_member_id = db_ktai_c_member_id4easy_access_id($oid)) {
            // 認証エラー
            $p = array('guid' => 'ON', 'login_params' => $requests['login_params']);
            openpne_redirect('ktai', 'page_o_login', $p);
        }

        //新しいi-modeIDに変更する
        db_ktai_update_easy_access_id($c_member_id, $mid);

        //以後ログイン処理
        $c_member = db_common_c_member4c_member_id($c_member_id, true);

        @session_name('OpenPNEktai');
        @session_start();
        @session_regenerate_id();

        $_SESSION['c_member_id'] = $c_member_id;
        //2008-04-18 KUNIHARU Tsujioka Secureの観点から削除
        //$_SESSION['ktai_address'] = t_encrypt($c_member['secure']['ktai_address']);
        $_SESSION['timestamp'] = $_SESSION['idle'] = time();
        if (OPENPNE_SESSION_CHECK_URL) {
            $_SESSION['OPENPNE_URL'] = OPENPNE_URL;
        }
                $u = $c_member_id;
        //アクセス日時を記録
        p_common_do_access($u);

        $p = array();
        if ($requests['login_params']) {
            parse_str($requests['login_params'], $p);
        }
        $p['ksid'] = session_id();
        if (!empty($p['a']) && $p['a'] != 'page_o_login') {
            $a = $p['a'];
            unset($p['a']);
        } else {
            $a = 'page_h_home';
        }
        openpne_redirect('ktai', $a, $p);
    }
}

?>

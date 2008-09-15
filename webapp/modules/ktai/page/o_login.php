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

require_once OPENPNE_WEBAPP_DIR .'/components/mobile_get_id.class.php';
require_once OPENPNE_WEBAPP_DIR .'/components/one_word.class.php';

class ktai_page_o_login extends OpenPNE_Action
{

    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        $guid = $_REQUEST['guid'];
        $mobileid = new Usagi_Get_Mobile_Id();
        //ドコモの場合、GUIDをつけて改めてログインページへ移動する
        if ($mobileid->getCarrier() == 'docomo' && !isset($guid)) {
            $p = array('guid' => 'ON', 'login_params' => $requests['login_params']);
            openpne_redirect('ktai', 'page_o_login', $p);
            exit;
        }
        //オートログイン判定
        if (defined('USAGI_MOBILE_AUTO_LOGIN') && USAGI_MOBILE_AUTO_LOGIN) {
            $mid = $mobileid->getId();
            //$midが会員かどうかを判定する
            if ($c_member_id = db_ktai_c_member_id4easy_access_id($mid)) {
                // 会員であり、IDが見つかった場合
                $p = array('guid' => 'ON', 'login_params' => $requests['login_params']);
                openpne_redirect('ktai', 'do_o_easy_login', $p);
            }
        }

        // --- リクエスト変数
        $msg_id = $requests['msg'];
        $kad = $requests['kad'];
        // ----------
        $carrier = $GLOBALS['__Framework']['ktai_carrier'];
        $adminmail = MAIL_SERVER_DOMAIN;
        $mailaddress = urlencode(MAIL_ADDRESS_PREFIX) . 'get@' . MAIL_SERVER_DOMAIN;
        //メッセージ

        $mobile_banner = '';
        if (is_readable(OPENPNE_DIR . '/skin/default/img/mobilebanner.gif')) {
            $mobile_banner = OPENPNE_URL . 'skin/default/img/mobilebanner.gif';
        }
        //今日の一言を取り出す。 7件
        $oneword     = new OneWord();
        $other_word = $oneword->getList(7);


        $this->set('mobile_banner', $mobile_banner);
        $this->set('ktai_address', t_decrypt($kad));
        $this->set('IS_CLOSED_SNS', IS_CLOSED_SNS);
        $this->set('msg', k_p_common_msg4msg_id($msg_id));
        $this->set('adminmail',$adminmail);
        $this->set("mailaddress", $mailaddress);
        $this->set('carrier',$carrier);
        $this->set('other_word',$other_word);

        return 'success';
    }
}
?>

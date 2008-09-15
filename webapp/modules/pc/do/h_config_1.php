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
 * メールアドレス変更
 */
class pc_do_h_config_1 extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $pc_address = $requests['pc_address'];
        $pc_address2 = $requests['pc_address2'];
        // ----------

        $msg_list = array();
        if (!$pc_address)  $msg_list[] = "メールアドレスを入力してください";
        if (!$pc_address2)  $msg_list[] = "メールアドレス(確認)を入力してください";
        if ($pc_address != $pc_address2) $msg_list[] = "メールアドレスが一致しません";
        if (!db_common_is_mailaddress($pc_address)) $msg_list[] = "メールアドレスを正しく入力してください";

        if ($msg_list) {
            $msg = array_shift($msg_list);
            $p = array('msg' => $msg);
            openpne_redirect('pc', 'page_h_config', $p);
        }

        $c_member_id = _db_c_member_id4pc_address($pc_address);
        if ($c_member_id == $u) {
            //自分のメールアドレス
            $p = array('msg' => "入力されたメールアドレスは既に登録されています");
            openpne_redirect('pc', 'page_h_config', $p);
        } elseif ($c_member_id) {
            //既に使われている
            $p = array('msg' => "入力されたメールアドレスは既に登録されています");
            openpne_redirect('pc', 'page_h_config', $p);
        }

        if (is_ktai_mail_address($pc_address)) {
            $p = array('msg' => '携帯電話アドレスは記入できません');
            openpne_redirect('pc', 'page_h_config', $p);
        }

        do_h_config_1($u, $pc_address);

        //変更あり
        //2008-03-11 Count処理を追加 kuniharu Tsujioka
        $datacount = new Change_Count('chenge_pcmail_count', $u);
        $datacount->addCount();
        //**************************************************
        $GLOBALS['AUTH']->logout();
        openpne_redirect('pc', 'page_o_h_config_mail');
    }
}

?>

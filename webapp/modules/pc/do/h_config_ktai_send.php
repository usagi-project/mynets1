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

class pc_do_h_config_ktai_send extends OpenPNE_Action
{
    function execute($requests)
    {
        //<PCKTAI
        if (!OPENPNE_ENABLE_KTAI) {
            openpne_redirect('pc', 'page_h_home');
        }
        //>

        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $ktai_address = $requests['ktai_address'];
        // ----------

        if (!is_ktai_mail_address($ktai_address)) {
            $msg = "携帯電話アドレスを記入してください";
            $p = array('msg' => $msg);
            openpne_redirect('pc', 'page_h_config_ktai', $p);
        }

        // 登録済みアドレスかどうかチェックする
        if (($c_member_id = do_common_c_member_id4ktai_address($ktai_address)) &&
            $c_member_id != $u) {
            $msg = "入力されたアドレスは既に登録されています";
            $p = array('msg' => $msg);
            openpne_redirect('pc', 'page_h_config_ktai', $p);
        }

        k_do_delete_c_member_ktai_pre4ktai_address($ktai_address);
        k_do_delete_c_ktai_address_pre4ktai_address($ktai_address);

        $session = create_hash();
        k_do_insert_c_ktai_address_pre($u, $session, $ktai_address);

        do_mail_sns_change_ktai_mail_send($u, $session, $ktai_address);

        //変更あり
        //2008-03-11 Count処理を追加 kuniharu Tsujioka
        $datacount = new Change_Count('chenge_mobilemail_count', $u);
        $datacount->addCount();
        //**************************************************

        openpne_redirect('pc', 'page_h_config_ktai_end');
    }
}

?>

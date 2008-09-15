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

/**
 * コミュニティメール受信設定を変更
 */
class ktai_do_c_home_update_is_receive_mail extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        $is_receive_mail = $requests['is_receive_mail'];
        $is_receive_mail_pc = $requests['is_receive_mail_pc'];
        $is_receive_message = $requests['is_receive_message'];
        // ----------

        //--- 権限チェック
        //コミュニティ参加者

        $status = db_common_commu_status($u, $target_c_commu_id);
        if (!$status['is_commu_member']) {
            handle_kengen_error();
        }
        //---

        //PC&ktaiの両方を一度に更新
        do_c_home_update_is_receive_mail($target_c_commu_id, $u, $is_receive_mail, $is_receive_mail_pc, $is_receive_message);

        $p = array('target_c_commu_id' => $target_c_commu_id);
        openpne_redirect('ktai', 'page_c_home', $p);
    }
}

?>

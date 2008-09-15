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

class ktai_do_h_config_password_query_update_password_query extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $password = $requests['password'];
        // ----------

        //--- 権限チェック
        //必要なし

        //---

        // 現在のパスワードが正しいか
        if (!db_common_authenticate_password($u, $password)) {
            $p = array('msg' => 18);
            openpne_redirect('ktai', 'page_h_config_password_query', $p);
        }

        if (!$requests['c_password_query_id']) {
            $p = array('msg' => 22);
            openpne_redirect('ktai', 'page_h_config_password_query', $p);
        }
        if (!$requests['password_query_answer']) {
            $p = array('msg' => 23);
            openpne_redirect('ktai', 'page_h_config_password_query', $p);
        }

        db_ktai_update_password_query($u, $requests['c_password_query_id'], $requests['password_query_answer']);

        $p = array('msg' => 24);
        openpne_redirect('ktai', 'page_h_config', $p);
    }
}

?>

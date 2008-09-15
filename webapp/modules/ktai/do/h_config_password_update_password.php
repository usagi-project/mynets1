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

class ktai_do_h_config_password_update_password extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $old_password = $requests['old_password'];
        $new_password = $requests['new_password'];
        // ----------

        // 現在のパスワードが正しいか
        if (!db_common_authenticate_password($u, $old_password)) {
            $p = array('msg' => 18);
            openpne_redirect('ktai', 'page_h_config_password', $p);
        }

        // 新しいパスワードは有効な文字列か
        if (   !ctype_alnum($new_password)
            || (strlen($new_password) < 6)
            || (strlen($new_password) > 12)) {
            $p = array('msg' => 20);
            openpne_redirect('ktai', 'page_h_config_password', $p);
        }

        do_common_update_password($u, $new_password);

        $p = array('msg' => 21);
        openpne_redirect('ktai', 'page_h_config', $p);
    }
}

?>

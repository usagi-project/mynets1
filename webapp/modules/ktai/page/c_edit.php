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

class ktai_page_c_edit extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_commu_id = $requests['target_c_commu_id'];
        // ----------

        $c_commu = _db_c_commu4c_commu_id($target_c_commu_id);

        //--- 権限チェック
        if ($c_commu['c_member_id_admin'] != $u) {
            handle_kengen_error();
        }
        //---

        //カテゴリのリスト
        $this->set('c_commu_category_list', _db_c_commu_category4null());

        $this->set('is_topic', p_c_edit_is_topic4c_commu_id($target_c_commu_id));

        $this->set('c_commu', $c_commu);

                if (MAIL_ADDRESS_HASHED) {
            $mail_address = "copic{$target_c_commu_id}-".$u."-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address = "copic{$target_c_commu_id}-".$u."@".MAIL_SERVER_DOMAIN;
        }
        $mail_address = urlencode(MAIL_ADDRESS_PREFIX) . $mail_address;
        $this->set("mail_address", $mail_address);

        return 'success';
    }
}

?>

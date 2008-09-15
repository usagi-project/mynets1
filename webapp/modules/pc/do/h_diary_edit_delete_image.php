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

class pc_do_h_diary_edit_delete_image extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_diary_id = $requests['target_c_diary_id'];
        $del_img = $requests['del_img'];
        // ----------

        //--- 権限チェック
        //日記作成者

        $c_diary = db_diary_get_c_diary4id($c_diary_id);
        //日記を書いた人でないと消せない
        if ($c_diary['c_member_id'] != $u) {
            openpne_redirect('pc', 'page_h_home');
        }
        //---

        image_data_delete($c_diary['image_filename_'. $del_img]);
        db_diary_delete_c_diary_image($c_diary_id, $del_img);

        $p = array('target_c_diary_id' => $c_diary_id);
        openpne_redirect('pc', 'page_h_diary_edit', $p);
    }
}

?>

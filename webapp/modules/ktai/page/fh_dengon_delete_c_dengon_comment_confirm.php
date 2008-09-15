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

//dengon用修正追加 KT

class ktai_page_fh_dengon_delete_c_dengon_comment_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        //$target_c_diary_id = $requests['target_c_diary_id'];
        //日記のマスターIDを指定している
        $target_c_member_id_to = $requests['target_c_member_id_to'];
        //$target_c_diary_comment_id = $requests['target_c_diary_comment_id'];
        //コメントテーブルのIDを指定
        $target_c_dengon_comment_id = $requests['target_c_dengon_comment_id'];
        // ----------

        $this->set("target_c_member_id_to", $target_c_member_id_to);
        $this->set("target_c_dengon_comment_id", $target_c_dengon_comment_id);
        //$this->set("target_c_diary_id", $target_c_diary_id);
        //$this->set("target_c_diary_comment_id", $target_c_diary_comment_id);

        return 'success';
    }
}
/**
*class ktai_page_fh_diary_delete_c_diary_comment_confirm extends OpenPNE_Action
*{
*    function execute($requests)
*    {
*        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
*
*        // --- リクエスト変数
*        $target_c_diary_id = $requests['target_c_diary_id'];
*        $target_c_diary_comment_id = $requests['target_c_diary_comment_id'];
*        // ----------
*
*        $this->set("target_c_diary_id", $target_c_diary_id);
*        $this->set("target_c_diary_comment_id", $target_c_diary_comment_id);
*
*        return 'success';
*    }
*}
*/
?>

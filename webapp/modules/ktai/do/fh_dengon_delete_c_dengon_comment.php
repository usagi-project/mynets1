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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

//dengon用追加修正KT


/**
 * dengonコメント削除
 */
class ktai_do_fh_dengon_delete_c_dengon_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_dengon_comment_id = $requests['target_c_dengon_comment_id'];
        // ----------
        
        $target_c_member_id_to = $requests['target_c_member_id_to'];
    
    //ほんらいならここで、dengonの書込み者と持主かどうかをチェックする。
    //スキップしてる。
        $c_dengon = db_dengon_get_c_dengon_comment_list4c_member_id_to($target_c_member_id_to);
        if ($c_dengon['c_member_id_from'] != $u
            && $target_c_member_id_from != $u) {
            //handle_kengen_error();
        }
        //---


        db_dengon_delete_c_dengon_comment($target_c_dengon_comment_id, $u);

        $p = array('target_c_member_id_to' => $target_c_member_id_to);
        openpne_redirect('ktai', 'page_fh_dengon', $p);
    }
}

/**
 * 日記コメント削除

class ktai_do_fh_diary_delete_c_diary_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $target_c_diary_comment_id = $requests['target_c_diary_comment_id'];
        // ----------
        $c_diary_comment = _do_c_diary_comment4c_diary_comment_id($target_c_diary_comment_id);
        $target_c_member_id = $c_diary_comment['c_member_id'];

        //--- 権限チェック
        //日記作成者 or コメント作成者

        $c_diary = db_diary_get_c_diary4id($c_diary_comment['c_diary_id']);
        if ($c_diary['c_member_id'] != $u
            && $c_diary_comment['c_member_id'] != $u) {
            handle_kengen_error();
        }
        //---


        db_diary_delete_c_diary_comment($target_c_diary_comment_id, $u);

        $p = array('target_c_diary_id' => $c_diary['c_diary_id']);
        openpne_redirect('ktai', 'page_fh_diary', $p);
    }
}
 */
?>

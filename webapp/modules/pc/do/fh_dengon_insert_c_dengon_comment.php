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

//伝言板用追加修正 KT

/**
 * dengonコメント追加
 */
class pc_do_fh_dengon_insert_c_dengon_comment extends OpenPNE_Action
{
    function execute($requests)
    {
        
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_member_id = $requests['target_c_member_id'];
        $body = $requests['body'];
        // ----------
    
        if (is_null($body) || $body === ''){
            $p = array('target_c_member_id' => $target_c_member_id, 'msg' => 1);
            openpne_redirect('pc', 'page_fh_dengon', $p);
        }
        if (is_continual_entry($body, $u, $target_c_member_id, "4")) {
            $p = array(
                'target_c_member_id' => $target_c_member_id,
                'msg' => "同じ内容ですでに投稿があります"
            );
            openpne_redirect('pc', 'page_fh_dengon', $p);
        }
        
        //アクセスブロック設定
        if (p_common_is_access_block($u, $target_c_member_id)) {
            openpne_redirect('ktai', 'page_h_access_block');
        }
        //---
    //echo($target_c_member_id_to);
    //exit();
        db_dengon_insert_c_dengon_comment($u, $target_c_member_id, $body);
        //日記コメントが書き込まれたので日記自体を未読扱いにする
        //db_diary_update_c_diary_is_checked($target_c_diary_id, 0);

        $p = array('target_c_member_id' => $target_c_member_id);
        openpne_redirect('pc', 'page_f_home', $p);
    }
}


?>

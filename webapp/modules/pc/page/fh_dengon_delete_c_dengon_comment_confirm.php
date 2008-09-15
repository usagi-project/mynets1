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

class pc_page_fh_dengon_delete_c_dengon_comment_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

    $target_c_member_id_to = $requests['target_c_member_id_to'];
    $target_c_dengon_comment_id = $requests['target_c_dengon_comment_id'];
        // ----------

    // target が指定されていない
        if (!$target_c_member_id_to) {
            openpne_redirect('pc', 'page_h_err_fh_dengon');
        }
        // target のコメントが存在しない
        if (!do_c_dengon_comment4c_dengon_comment_id($target_c_dengon_comment_id)) {
            openpne_redirect('pc', 'page_h_err_fh_dengon');
        }

    if (!$target_c_member_id_to) {
            $target_c_member_id_to = $u;
        }

        if ($target_c_member_id_to == $u) {
            $type = 'h';

        } else {
            $type = 'f';
    }

    $target_dengon_comment_list = do_c_dengon_comment4c_dengon_comment_id($target_c_dengon_comment_id);
    $this->set('target_dengon_comment_list',$target_dengon_comment_list);
    //
        $this->set("target_c_member_id_to", $target_c_member_id_to);
        $this->set("target_c_dengon_comment_id", $target_c_dengon_comment_id);
    
    $this->set('inc_navi', fetch_inc_navi($type, $target_c_member_id_to));

        return 'success';
    }
}

?>

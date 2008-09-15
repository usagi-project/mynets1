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

//自分のつけた伝言板の履歴表示

class ktai_page_h_dengon_rireki extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------

        $page_size = 20;
        $page += $direc;

        //ページ
        $this->set("page", $page);
    
    //dengon保有者のニックネームを取得
        $c_member = db_common_c_member4c_member_id_LIGHT($u);
    
    //自分が書込みをした伝言板のリストを取得
        //$c_dengon = k_p_fh_dengon_c_dengon_comment_list4c_member_id_to($u, $page_size, $page);
        
        //$target_c_member_from = db_common_c_member4c_member_id($u);
    
        //自分の情報
    $this->set("c_member", $c_member);

        //コメント
        list ($c_dengon_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_dengon_c_dengon_comment_list4c_member_id_from($u, $page_size, $page);

        $this->set("c_dengon_comment_list", array_reverse($c_dengon_comment_list));
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("total_num", $total_num);
        $this->set("total_page_num", $total_page_num);
        $this->set("page_size", $page_size);

        $pager = array();
        $pager['end'] = $total_num - ($page_size * ($page - 1));
        $pager['start'] = $pager['end'] - count($c_dengon_comment_list) + 1;
        $this->set('pager', $pager);
        
    
        // f or h
        $this->set("INC_NAVI_type", k_p_fh_common_get_type($target_c_member['c_member_id'], $u));

        return 'success';
    }
}

?>

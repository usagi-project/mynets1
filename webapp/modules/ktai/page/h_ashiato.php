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

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

class ktai_page_h_ashiato extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        
        //画面切り替えのために自分の情報を取得する
        $c_member = db_common_c_member4c_member_id($u);
        $this->set('c_member',$c_member);
        //自分のディスプレイを判定する
        $MyDisplayTemplate = getMyDisplay($c_member['mobile_view']);
        $this->set('MyDisplayTemplate',$MyDisplayTemplate['template_foldername']);
        // あしあとリスト
        $this->set("c_ashiato_list", p_h_ashiato_c_ashiato_list4c_member_id($u, 20));

        // 総あしあと数
        $this->set("c_ashiato_num", p_h_ashiato_c_ashiato_num4c_member_id($u));

        return 'success';
    }
}

?>

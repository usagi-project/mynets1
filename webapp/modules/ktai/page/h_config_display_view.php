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
 *             [2007/03/02]
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

class ktai_page_h_config_display_view extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        $c_member = db_common_c_member4c_member_id($u);
        //メンバ情報
        $this->set('c_member', $c_member);
        //現在使用できる携帯のテンプレートを取得する
        //変数　Ktai、基本
        $ok_templates = getDisplayMobileTemplate();
        $this->set('ok_templates',$ok_templates);
        //自分が選択している画面
        //選択している携帯画面番号
        $mydisplay_id = 0;
        if ($c_member['mobile_view'] == 0){
            $mydisplay_id = 1;
        } else {
            $mydisplay_id = $c_member['mobile_view'];
        }
        $mydisplay = getMyDisplay($mydisplay_id);
        $this->set('mydisplay',$mydisplay);
        return 'success';
    }
}

?>

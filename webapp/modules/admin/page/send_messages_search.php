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

// 一括メッセージ送信
class admin_page_send_messages_search extends OpenPNE_Action
{
    function execute($requests)
    {
        $cond_list = validate_cond($_REQUEST);

        $profile_list = db_common_c_profile_list();
        $profile_value_list = array();
        foreach ($cond_list as $key=>$each_cond) {
            if (($key == "s_year") || ($key == "e_year"))continue;

            $c_profile_option = db_c_profile_option4c_profile_option_id($each_cond);
            $profile_value_list[$key]['value'] = $c_profile_option['value'];
            $profile_value_list[$key]['caption'] = $profile_list[$key]['caption'];
        }
        $v['cond_list'] = $cond_list;
        $v['profile_value_list'] = $profile_value_list;
        $this->set($v);

        return 'success';
    }
}

?>

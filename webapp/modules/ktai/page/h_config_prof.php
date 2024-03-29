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

class ktai_page_h_config_prof extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        $this->set("c_member", db_common_c_member4c_member_id($u));

        $prof = db_common_c_member_with_profile($u, 'private');
        $this->set('c_member', $prof);

        $public_flags = array(
        'public' => '全員に公開',
        'friend' => WORD_MY_FRIEND_HALF.'まで公開',
        'private'=> '公開しない',
        );
        $this->set('public_flags', $public_flags);

        $this->set('profile_list', db_common_c_profile_list());

        $this->set('month', p_regist_prof_c_profile_month_list4null());
        $this->set('day', p_regist_prof_c_profile_day_list4null());

        return 'success';
    }
}

?>

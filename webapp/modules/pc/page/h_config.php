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

class pc_page_h_config extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        $this->set('inc_navi', fetch_inc_navi('h'));

        $c_member = db_common_c_member4c_member_id($u);

        $this->set('password_query_list', p_common_c_password_query4null());
        $this->set('c_member', $c_member);
        $this->set('c_member_id_block', p_h_config_c_member_id_block4c_member_id($u));
        $this->set('daily_news_day_str', str_replace(',', '・', DAILY_NEWS_DAY));
        if (DAILY_NEWS_DAY) {
            $this->set('daily_news_day_num', count(explode(',', DAILY_NEWS_DAY)));
        } else {
            $this->set('daily_news_day_num', 0);
        }
        $this->set('OPENPNE_URL', OPENPNE_URL);
        $this->set('SNS_NAME', SNS_NAME);
        $this->set('is_shinobiashi', db_member_is_shinobiashi($u));

        $this->set('is_unused_daily_news', util_is_unused_mail('m_pc_daily_news'));
        $this->set('is_unused_ashiato', util_is_unused_mail('m_pc_ashiato'));

        return 'success';
    }
}

?>

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
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/04/22] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_access_analysis_day extends OpenPNE_Action
{
    function execute($requests)
    {
        //----------リクエスト変数-------------//
        $ktai_flag = $requests['ktai_flag'];
        $ymd = $requests['ymd'];
        //----------リクエスト変数-------------//
        
        $this->set("inc_header" ,admin_fetch_inc_header("TOP>>".SNS_NAME."管理ページ"));
        $this->set("inc_footer" ,admin_fetch_inc_footer());
        $this->set('SNS_NAME', SNS_NAME);
        
        $this->set("ktai_flag" ,$ktai_flag);
        $this->set("item_str", ($ktai_flag ? "携帯版":"PC版"));

        $access_analysis_day = p_access_analysis_day_access_analysis_day($ymd, $ktai_flag);
        $this->set("access_analysis_day", $access_analysis_day);
        $this->set("ym",substr($ymd,0,7));
        return 'success';
    }
}

?>

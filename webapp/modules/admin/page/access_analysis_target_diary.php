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

class admin_page_access_analysis_target_diary extends OpenPNE_Action
{
    function execute($requests)
    {
        //----------リクエスト変数-------------//
        $ktai_flag = $requests['ktai_flag'];
        $ymd = $requests['ymd'];
        $month_flag = $requests['month_flag'];
        $page_name = $requests['page_name'];
        $page = $requests['page'];
        $direc = $requests['direc'];
        $orderby = $requests['orderby'];
        $orderby1 = $requests['orderby1'];
        $orderby2 = $requests['orderby2'];
        //----------リクエスト変数-------------//
        $this->set("inc_header" ,admin_fetch_inc_header("TOP>>".SNS_NAME."管理ページ"));
        $this->set("inc_footer" ,admin_fetch_inc_footer());
        $this->set('SNS_NAME', SNS_NAME);

        $v = array();
        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        $this->set($v);

        $page_size = 10;
        $page += $direc;
        if ($orderby1) {
            $orderby = $orderby1;
        } elseif ($orderby2) {
            $orderby = $orderby2;
        }
        $this->set("ktai_flag" ,$ktai_flag);
        $this->set("item_str", ($ktai_flag ? "携帯版":"PC版"));
        $this->set("ymd", $ymd);
        $this->set("month_flag", $month_flag);
        $this->set("page_name", $page_name);
        if ($orderby1) {
            $orderby1 *= -1;
        } else {
            $orderby1 = -1;
        }
        if ($orderby2) {
            $orderby2 *= -1;
        } else {
            $orderby2 = 2;
        }
        $this->set("orderby", $orderby);
        $this->set("orderby1", $orderby1);
        $this->set("orderby2", $orderby2);

        list($target_diary, $sum, $is_prev, $is_next, $total_num, $start_num, $end_num)
            = p_access_analysis_target_diary_target_diary4ym_page_name($ymd, $month_flag, $page_name, $ktai_flag, $page, $page_size, $orderby);
        $this->set("target_diary", $target_diary);
        $this->set("sum", $sum);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("page", $page);
        $this->set("total_num",$total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        return 'success';
    }
}


?>

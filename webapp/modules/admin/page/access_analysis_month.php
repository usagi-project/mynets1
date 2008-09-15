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

//アクセス解析

class admin_page_access_analysis_month extends OpenPNE_Action
{
    function execute($requests)
    {
        //----------リクエスト変数-------------//
        $ktai_flag = $requests['ktai_flag'];
        //----------リクエスト変数-------------//

        $v = array();

        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        $this->set($v);
        $this->set("ktai_flag" ,$ktai_flag);
        $this->set("item_str", ($ktai_flag=='1' ? "携帯版":"PC版"));
        $access_analysis_month = p_access_analysis_month_access_analysis_month($ktai_flag);
        $this->set("access_analysis_month", $access_analysis_month);

        //アクティブメンバー数
        $s_access_date = date("Y-m-d H:i:s" , strtotime ("-1 week") );
        $list = p_member_edit_c_member_list(100,1,$s_access_date);
        $this->set("active_num", $list[3]);
        $nowtime = date("Y-m") . "-01";
        $this->set("nowtime", $nowtime);
        return 'success';
    }
}

?>

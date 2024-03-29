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
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/05/29] Ver1.1.0Nighty package
 * ========================================================================
 */


class admin_page_update_information extends OpenPNE_Action
{
    function getTitle()
    {
        return "インフォメーションの更新";
    }

    function execute($requests)
    {
        $v     = array();
        $pager = array();
        $msg   = urldecode($requests['msg']);
        $page  = $requests['page'];
        $page_size = $requests['page_size'];
        $info_id   = $requests['info_id'];

        $info = new admin_Information();
        $information_list = $info->getList($page, $page_size, $pager);
        $info->setId($info_id);
        $information_data = $info->getData();

        $this->set('month', p_regist_prof_c_profile_month_list4null());
        $this->set('day', p_regist_prof_c_profile_day_list4null());
        $this->set('to_month',date('m'));
        $this->set('to_day',date('d'));
        $this->set('to_year',date('Y'));
        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        $v['pager'] = $pager;
        $msg = $msg;
        $this->set("information_list",$information_list);
        $this->set("information_data",$information_data);
        $this->set("msg", $msg);
        $this->set($v);
        return 'success';
    }
}

?>

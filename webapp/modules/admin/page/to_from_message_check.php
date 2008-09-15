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
 * @chengelog  [2007/05/29] Ver1.1.0Nighty package
 * ========================================================================
 */


class admin_page_to_from_message_check extends OpenPNE_Action
{
    function execute($requests)
    {
        $c_member_id_from = $requests['c_member_id_from'];
        $c_member_id_to = $requests['c_member_id_to'];
        $pager = array();
        $page = $requests['page'];
        $page_size = $requests['page_size'];
        $message_list = getMessageToFromListAdmin($c_member_id_from, $c_member_id_to, $page, $page_size, $pager);
        $v = array();

        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        $v['pager'] = $pager;
        $this->set($v);
        $this->set("message_list",$message_list);
        $this->set("c_member_id_from", $c_member_id_from);
        $this->set("c_member_id_to", $c_member_id_to);
        return 'success';
    }
}

?>

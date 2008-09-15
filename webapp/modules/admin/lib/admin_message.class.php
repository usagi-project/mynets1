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
 * @chengelog  [2007/06/09] Ver1.1.0Nighty package
 * @chengelog  [2007/05/20] Ver1.1.0Nighty package
 * @chengelog  [2007/04/22] Ver1.1.0Nighty package
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ========================================================================
 */


/*メッセージをソート指定順に並べてLIMITで取得
 *@param sort_no = 0 投稿順,１＝投稿者ID順、２画像ありなし順（ありから優先）、９投稿逆順
 *@param limit
 *@return diary_list array()
 */
function getMessageDataListAdmin($keyword, $page, $page_size, &$pager)
{
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_message ";
    if ($keyword === '') {
        $wherecond = "";
    } else {
        $wherecond = " where body like '%".strval($keyword)."%' ";
    }
    $order_by = " order by r_datetime desc";
    $sql = $sql.$wherecond.$order_by ;

    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size);
    foreach($list as $key => $value) {
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
        $list[$key]['from_nickname'] = $c_member['nickname'];
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
        $list[$key]['to_nickname'] = $c_member['nickname'];
    }
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_message ';
    $sql = $sql.$wherecond;
    $total_num = db_get_one($sql);
    $pager = admin_make_pager($page, $page_size, $total_num);
    return $list;
}

/*メッセージをIDから指定して開く
 *@param target_c_message_id
 *@return message_data()
 */
function getMessageDataAdmin($c_message_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_message where c_message_id = ? ";
    $params = array(intval($c_message_id));
    $message_data = db_get_row($sql,$params);
    $c_member = db_common_c_member4c_member_id_LIGHT($message_data['c_member_id_from']);
    $message_data['from_nickname'] = $c_member['nickname'];
    $c_member = db_common_c_member4c_member_id_LIGHT($message_data['c_member_id_to']);
    $message_data['to_nickname'] = $c_member['nickname'];
    return $message_data;
}
/*メッセージを投稿者受信者でLIMITで取得
 *@param limit
 *@return diary_list array()
 */

function getMessageToFromListAdmin($c_member_id_from, $c_member_id_to, $page, $page_size, &$pager)
{
    $sql   = "select * from ".MYNETS_PREFIX_NAME."c_message ";
    $where = " where (c_member_id_from = ? and c_member_id_to = ?) or (c_member_id_to = ? and c_member_id_from = ?) ";
    $orderby = " order by r_datetime desc";
    $params = array(intval($c_member_id_from), intval($c_member_id_to), intval($c_member_id_from), intval($c_member_id_to));
    $list = db_get_all_limit($sql.$where.$orderby,($page-1)*$page_size,$page_size, $params);
    foreach($list as $key => $value) {
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
        $list[$key]['from_nickname'] = $c_member['nickname'];
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
        $list[$key]['to_nickname'] = $c_member['nickname'];
    }
    $sql = "select count(*) from ".MYNETS_PREFIX_NAME."c_message ";
    $sql = $sql . $where;
    $total_num = db_get_one($sql, $params);
    $pager = admin_make_pager($page, $page_size, $total_num);
    return $list;
}
?>
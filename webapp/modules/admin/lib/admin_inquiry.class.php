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
 *@param sort_no = 0 投稿順,１＝といあわせ、２通報
 *@param limit
 *@return diary_list array()
 */
function getInquiryDataListAdmin($keyword, $sort_no, $page, $page_size, &$pager)
{
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_inquiry ";
    if ($keyword === '') {
        $wherecond = "";
    } else {
        $wherecond = " where body like '%".strval($keyword)."%' ";
    }
    switch ($sort_no) {
        case "1":
            if ($wherecond === "") {
                $wherecond = " where category_flag = 1 ";
            } else {
                $wherecond = " and category_flag = 1 ";
            }
            break;
        case "2":       //メッセージ
            if ($wherecond === "") {
                $wherecond = " where category_flag = 2 ";
            } else {
                $wherecond = " and category_flag = 2 ";
            }
            break;
        case "3":
            if ($wherecond === "") {
                $wherecond = " where category_flag = 3 ";
            } else {
                $wherecond = " and category_flag = 3 ";
            }
            break;
    }
    $order_by = " order by r_datetime";
    $sql = $sql.$wherecond.$order_by ;
    
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size);
    foreach($list as $key => $value) {
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        $list[$key]['nickname'] = $c_member['nickname'];
    }
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_inquiry ';
    $sql = $sql.$wherecond;
    $total_num = db_get_one($sql);
    $pager = admin_make_pager($page, $page_size, $total_num);
    return $list;
}

/*メッセージをIDから指定して開く
 *@param target_c_incuiry_id
 *@return message_data()
 */
function getInquiryDataAdmin($c_message_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_inquiry where c_inquiry_id = ? ";
    $params = array(intval($c_message_id));
    $message_data = db_get_row($sql,$params);
    $c_member = db_common_c_member4c_member_id_LIGHT($message_data['c_member_id']);
    $message_data['nickname'] = $c_member['nickname'];
    return $message_data;
}
?>
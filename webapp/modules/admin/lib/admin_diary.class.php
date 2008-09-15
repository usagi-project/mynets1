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


/*日記をソート指定順に並べてLIMITで取得
 *@param sort_no = 0 投稿順,１＝投稿者ID順、２画像ありなし順（ありから優先）、９投稿逆順
 *@param limit
 *@return diary_list array()
 */
function getDiaryDataListAdmin($keyword, $sort_no, $page, $page_size, &$pager)
{
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary ";
    switch ($sort_no) {
        case 0:                 //投稿順
            $order_by = " order by r_datetime desc";
            break;
        case 1:
            $order_by = " order by c_member_id ";
            break;
        case 2:
            $order_by = " order by image_filename desc";
            break;
        case 9:
            $order_by = " order by r_datetime";
            break;
    }
    if ($keyword === '') {
        $wherecond = "";
    } else {
        $wherecond = " where body like '%".strval($keyword)."%' ";
    }
    $sql = $sql.$wherecond.$order_by ;
    
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size);
    foreach($list as $key => $value) {
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        $list[$key]['nickname'] = $c_member['nickname'];
    }
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary '.$wherecond;
    $total_num = db_get_one($sql);
    $pager = admin_make_pager($page, $page_size, $total_num);

    return $list;
}

/*日記をIDから指定して開く
 *@param target_c_diary_id
 *@return diary_data()
 */
function getDiaryDataAdmin($c_diary_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary where c_diary_id = ? ";
    $params = array(intval($c_diary_id));
    $diary_data = db_get_row($sql,$params);
    $c_member = db_common_c_member4c_member_id_LIGHT($diary_data['c_member_id']);
    $diary_data['nickname'] = $c_member['nickname'];
    $diary_data['c_member_id'] = $c_member['c_member_id'];
    return $diary_data;
}

/*日記コメントをソート指定順に並べてLIMITで取得　日記ID指定あり
 *@param sort_no = 0 投稿順,１＝投稿者ID順、２画像ありなし順（ありから優先）、９投稿逆順
 *@param limit
 *@return diary_comment_list array()
 */
function getDiaryCommentDataListAdmin($keyword, $sort_no, $page, $page_size, &$pager, $target_c_diary_id = null)
{
    $params = array();
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary_comment ";
    
    switch ($sort_no) {
        case 0:                 //投稿順
            $order_by = " order by r_datetime desc";
            break;
        case 1:
            $order_by = " order by c_member_id ";
            break;
        case 2:
            $order_by = " order by image_filename desc";
            break;
        case 9:
            $order_by = " order by r_datetime";
            break;
    }
    if ($target_c_diary_id !== null) {
        if ($keyword === '') {
            $wherecond = " where c_diary_id = ? ";
        } else {
            $wherecond = " where c_diary_id = ? and body like '%".strval($keyword)."%' ";
        }
        $params = intval($target_c_diary_id);
    } else {
        if ($keyword === '') {
            $wherecond = "";
        } else {
            $wherecond = " where body like '%".strval($keyword)."%' ";
        }
    }
    $sql = $sql . $wherecond . $order_by;
    if ($target_c_diary_id !== null) {
        $list = db_get_all_limit($sql, ($page-1)*$page_size, $page_size, $params);
    } else {
        $list = db_get_all_limit($sql, ($page-1)*$page_size, $page_size);
    }
    foreach($list as $key => $value) {
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        $list[$key]['nickname'] = $c_member['nickname'];
        $owner_diary = getDiaryDataAdmin($value['c_diary_id']);
        $list[$key]['ownernickname'] = $owner_diary['nickname'];
        $list[$key]['ownersubject'] = $owner_diary['subject'];
    }
    
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment';
    if ($target_c_diary_id !== null) {
        if ($keyword === '') {
            $wherecond = "where c_diary_id = ? ";
        } else {
            $wherecond = " where c_diary_id = ? and body like '%".strval($keyword)."%' ";
        }
        $params = intval($target_c_diary_id);
    } else {
        if ($keyword === '') {
            $wherecond = "";
        } else {
            $wherecond = " where body like '%".strval($keyword)."%' ";
        }
    }
    $sql = $sql.$wherecond;
    if ($target_c_diary_id !== null) {
        $total_num = db_get_one($sql, $params);
    } else {
        $total_num = db_get_one($sql);
    }
    $pager = admin_make_pager($page, $page_size, $total_num);
    
    return $list;
}
/*日記コメントをIDから指定して開く
 *@param target_c_diary_comment_id
 *@return diary_data()
 */
function getDiaryCommentDataAdmin($c_diary_comment_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary_comment where c_diary_comment_id = ? ";
    $params = array(intval($c_diary_comment_id));
    $diary_comment_data = db_get_row($sql,$params);
    $c_member = db_common_c_member4c_member_id_LIGHT($diary_comment_data['c_member_id']);
    $diary_comment_data['nickname'] = $c_member['nickname'];
    $owner_diary = getDiaryDataAdmin($diary_comment_data['c_diary_id']);
    $diary_comment_data['ownernickname'] = $owner_diary['nickname'];
    $diary_comment_data['ownermemberid'] = $owner_diary['c_member_id'];
    $diary_comment_data['ownersubject'] = $owner_diary['subject'];
    return $diary_comment_data;
}

?>
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


/*コミュニティをソート指定順に並べてLIMITで取得
 *@param sort_no = 0 作成順,１＝作成者ID順、９作成逆順
 *@param limit
 *@return diary_list array()
 */
function getCommuDataListAdmin($sort_no, $page, $page_size, &$pager)
{
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu ";
    switch ($sort_no) {
        case 0:                 //投稿順
            $order_by = " order by r_datetime desc";
            break;
        case 1:
            $order_by = " order by c_member_id_admin ";
            break;
        case 9:
            $order_by = " order by r_datetime";
            break;
    }
    if ($keyword === '') {
        $wherecond = "";
    } else {
        $wherecond = " where info like '%".strval($keyword)."%' ";
    }
    $sql = $sql.$wherecond.$order_by ;
    
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size);
    foreach($list as $key => $value) {
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_admin']);
        $list[$key]['nickname'] = $c_member['nickname'];
    }
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_commu'.$wherecond ;
    $total_num = db_get_one($sql);
    $pager = admin_make_pager($page, $page_size, $total_num);
    return $list;
}

/*トピックをソート指定順に並べてLIMITで取得
 *@param sort_no = 0 作成順,１＝作成者者ID順、９作成逆順
 *@param limit
 *@return diary_list array()
 */
function getTopicDataListAdmin($keyword, $sort_no, $page, $page_size, &$pager)
{
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic ";
    switch ($sort_no) {
        case 0:                 //投稿順
            $order_by = " order by r_datetime desc";
            break;
        case 1:
            $order_by = " order by c_member_id ";
            break;
        case 9:
            $order_by = " order by r_datetime";
            break;
    }
    if ($keyword === '') {
        $wherecond = "";
    } else {
        $wherecond = " where name like '%".strval($keyword)."%' ";
    }
    $sql = $sql.$wherecond.$order_by ;
    
    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size);
    foreach($list as $key => $value) {
        $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        $list[$key]['nickname'] = $c_member['nickname'];
        //$topic_comment = getTopicCommentDataAdmin($value['c_commu_topic_id']);
        //$list[$key]['body'] = $topic_comment['body'];
        $image_data = getTopic0ImageData($value['c_commu_topic_id']);
        $list[$key]['image_filename1'] = $image_data['image_filename1'];
        $list[$key]['image_filename2'] = $image_data['image_filename2'];
        $list[$key]['image_filename3'] = $image_data['image_filename3']; 
        $list[$key]['body'] = $image_data['body'];
    }
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic'.$wherecond ;
    $total_num = db_get_one($sql);
    $pager = admin_make_pager($page, $page_size, $total_num);
    return $list;
}

/*コミュをIDから指定して開く
 *@param target_c_commu_topic_id
 *@return topic_data()
 */
function getCommuDataAdmin($c_commu_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu where c_commu_id = ? ";
    $params = array(intval($c_commu_id));
    $commu_data = db_get_row($sql,$params);
    $c_member = db_common_c_member4c_member_id_LIGHT($commu_data['c_member_id_admin']);
    $commu_data['nickname'] = $c_member['nickname'];
    //参加人数を取得する。
    $commu_data['member_num'] = getCommuMemberCount($commu_data['c_commu_id']) ;
    return $commu_data;
}

function getCommuMemberCount($c_commu_id)
{
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_commu_member WHERE c_commu_id = ?';
    $params = array(intval($c_commu_id));
    return db_get_one($sql, $params);
}

/*トピックをIDから指定して開く
 *@param target_c_commu_topic_id
 *@return topic_data()
 */
function getTopicDataAdmin($c_commu_topic_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic where c_commu_topic_id = ? ";
    $params = array(intval($c_commu_topic_id));
    $topic_data = db_get_row($sql,$params);
    $c_member = db_common_c_member4c_member_id_LIGHT($topic_data['c_member_id']);
    $topic_data['nickname'] = $c_member['nickname'];
    $commu = k_p_c_home_c_commu4c_commu_id($topic_data['c_commu_id']);
    $topic_data['communame'] = $commu['name'];
    //トピックコメントのnumber0を抽出
    $topic_comment = getTopic0ImageData($c_commu_topic_id);
    $topic_data['body'] = $topic_comment['body'];
    $topic_data['image_filename1'] = $topic_comment['image_filename1'];
    $topic_data['image_filename2'] = $topic_comment['image_filename2'];
    $topic_data['image_filename3'] = $topic_comment['image_filename3'];
    return $topic_data;
}

function getTopic0ImageData($c_commu_topic_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic_comment where c_commu_topic_id = ? and number = 0";
    $params = array(intval($c_commu_topic_id));
    $data = db_get_row($sql,$params);
    return $data ;
}
function getTopicCommentDataAdmin($c_commu_topic_comment_id) {
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic_comment where c_commu_topic_comment_id = ? ";
    $params = array(intval($c_commu_topic_comment_id));
    $topic_data = db_get_row($sql,$params);
    $c_member = db_common_c_member4c_member_id_LIGHT($topic_data['c_member_id']);
    $topic_data['nickname'] = $c_member['nickname'];
    $topic = getTopicDataAdmin($topic_data['c_commu_topic_id']);
    $topic_data['topicname'] = $topic['name'];
    $commu = k_p_c_home_c_commu4c_commu_id($topic_data['c_commu_id']);
    $topic_data['communame'] = $commu['name'];
    return $topic_data;
}
/*トピックコメントをソート指定順に並べてLIMITで取得
 *@param sort_no = 0 作成順,１＝作成者者ID順、９作成逆順
 *@param limit
 *@return topic_coment_list array()
 */
function getTopicCommentDataListAdmin($keyword, $sort_no, $page, $page_size, &$pager)
{
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic_comment ";
    switch ($sort_no) {
        case 0:                 //投稿順
            $order_by = " order by r_datetime desc";
            break;
        case 1:
            $order_by = " order by c_member_id ";
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
        $commu = getTopicDataAdmin($value['c_commu_topic_id']);
        $list[$key]['topicname'] = $commu['name'];
    }
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment'.$wherecond ;
    $total_num = db_get_one($sql);
    $pager = admin_make_pager($page, $page_size, $total_num);
    return $list;
}

/*
 * コミュニティの削除処理
 * @param int c_commu_id
 * @return bool 
 */
function delCommunity($c_commu_id)
{
    $sql = "DELETE FROM ".MYNETS_PREFIX_NAME."c_commu WHERE c_commu_id = ?";
    $params = array(intval($c_commu_id));
    return db_query($sql, $params);
}
?>
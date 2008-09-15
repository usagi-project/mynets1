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


/*メンバーをソート指定順に並べてLIMITで取得
 *@param sort_no = 0 最新順,１＝ログイン順、９投稿逆順
 *@param limit
 *@return diary_list array()
 */
function getMemberListAdmin($sort_no, $keyword,$page, $page_size, &$pager)
{
    $sql = "select * from ".MYNETS_PREFIX_NAME."c_member ";
    if ($keyword !== "") {
        $wherecond = " where nickname like '%".$keyword."%' ";   //インデックスを有効にするために前方一致
    }
    switch ($sort_no) {
        case 0:                 //投稿順
            $order_by = " order by r_date desc";
            break;
        case 1:
            $order_by = " order by access_date desc";
            break;
        case 9:
            $order_by = " order by c_member_id";
            break;
    }
    $sql = $sql.$wherecond.$order_by ;

    $list = db_get_all_limit($sql,($page-1)*$page_size,$page_size);
    foreach($list as $key=>$value) {
        $c_member = db_common_c_member_secure4c_member_id($value['c_member_id']);
        $list[$key]['regist_address'] = $c_member['regist_address'];
        $owner_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_invite']);
        $list[$key]['owner_nickname'] = $owner_member['nickname'];
    }
    $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_member';
    $total_num = db_get_one($sql.$wherecond);
    $pager = admin_make_pager($page, $page_size, $total_num);
    return $list;
}

/*会員をIDから指定して開く。管理画面なのですべて。
 *@param target_c_member_id
 *@return member_data()
 */
function getMemberDataAdmin($c_member_id) {
    $member_data = db_common_c_member4c_member_id($c_member_id, true, true, 'private');
    $owner_member = db_common_c_member4c_member_id_LIGHT($member_data['c_member_id_invite']);
    $member_data['owner_nickname'] = $owner_member['nickname'];
    $display_m = getDisplayView($member_data['mobile_view']);
    $member_data['mobile_display'] = $display_m;
    $display_p = getDisplayView($member_data['pc_view']);
    $member_data['pc_display'] = $display_p;
    $member_data['message_to'] = getMemberSendMail($c_member_id, true);
    $member_data['message_from'] = getMemberSendMail($c_member_id, false);
    $member_data['diary_add'] = getMemberAddDiary($c_member_id);
    $member_data['diary_comment_add'] = getMemberAddDiaryComment($c_member_id);
    $member_data['commu_count'] = getMemberCommuCount($c_member_id);
    $member_data['friend_count'] = getMemberFriendCount($c_member_id);
    $member_data['block_count'] = getMemberBlockCount($c_member_id);
    $member_data['block_count_from'] = getMemberBlockCountFrom($c_member_id);
    $member_data['topic_comment_add'] = getMemberAddTopicComment($c_member_id);
    $member_data['event_count'] = getMemberAddEventComment($c_member_id);
    $member_data['image_count'] = getMemberImageCount($c_member_id);
    return $member_data;
}

/*
 *
 *
 */
function getDisplayView($c_display_view_id) {
    if ($c_display_view_id == 0) {
        $c_display_view_id = 1;
    }
    $sql = "select c_display_name from ". MYNETS_PREFIX_NAME ."c_display_view where c_display_view_id = ? ";
    $params = array(intval($c_display_view_id));
    $list = db_get_one($sql,$params);
    return $list;
}
/*メンバーのフレンド一覧を取得
 *@param sort_no = 0 投稿順,１＝投稿者ID順、２画像ありなし順（ありから優先）、９投稿逆順
 *@param limit
 *@return diary_comment_list array()
 */
function getFriendDataListAdmin($sort_no, $page, $page_size, &$pager, $target_c_member_id)
{

}
/*
 *メンバーのフレンドの総数を取得
 *c_menber_toで計算する
 */
function getMemberFriendCount($c_member_id) {
    $sql = "select count(*) as count from ". MYNETS_PREFIX_NAME ."c_friend " ;
    $sql .= " where c_member_id_to = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_one($sql,$params);
    return $list;
}
/*
 *メンバーのアクセスブロックの総数を取得
 *c_menber_toで計算する
 */
function getMemberBlockCount($c_member_id) {
    $sql = "select count(*) as count from ". MYNETS_PREFIX_NAME ."c_access_block " ;
    $sql .= " where c_member_id = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_one($sql,$params);
    return $list;
}
/*
 *メンバーの非アクセスブロックの総数を取得(された数)
 *c_menber_blockで計算する
 */
function getMemberBlockCountFrom($c_member_id) {
    $sql = "select count(*) as count from ". MYNETS_PREFIX_NAME ."c_access_block " ;
    $sql .= " where c_member_id_block = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_one($sql,$params);
    return $list;
}

/*
 *メンバーの送信、受信メールの総数を取得
 *trueの場合は送信、falseの場合は受信
 */
function getMemberSendMail($c_member_id,$sendto = true) {
    $sql = "select count(*) as count, max(c_message_id) as mid from ". MYNETS_PREFIX_NAME ."c_message " ;
    if ($sendto !== true) {
        $sql .= " where c_member_id_from = ? ";
    } else {
        $sql .= " where c_member_id_to = ? ";
    }
    $params = array(intval($c_member_id));
    $list = db_get_row($sql,$params);
    return $list;
}

/*
 *メンバーの投稿日記の総数を取得
 *
 */
function getMemberAddDiary($c_member_id) {
    $sql = "select count(*) as count, max(r_datetime) as r_date,max(c_diary_id) as did from ". MYNETS_PREFIX_NAME ."c_diary " ;
    $sql .= " where c_member_id = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_row($sql,$params);
    return $list;
}
/*
 *メンバーの投稿トピックコメントの総数を取得
 *
 */
function getMemberAddTopicComment($c_member_id) {
    $sql = "select count(*) as count, max(r_datetime) as r_date,max(c_commu_topic_comment_id) as tid from ". MYNETS_PREFIX_NAME ."c_commu_topic_comment " ;
    $sql .= " where c_member_id = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_row($sql,$params);
    return $list;
}
/*
 *メンバーのイベント参加の総数を取得
 *
 */
function getMemberAddEventComment($c_member_id) {
    $sql = "select count(*) as count from ". MYNETS_PREFIX_NAME ."c_commu_topic_comment " ;
    $sql .= " where c_member_id = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_one($sql,$params);
    return $list;
}

/*
 *メンバーの投稿コメントの総数を取得
 *
 */
function getMemberAddDiaryComment($c_member_id) {
    $sql = "select count(*) as count, max(r_datetime) as r_date,max(c_diary_comment_id) as did from ". MYNETS_PREFIX_NAME ."c_diary_comment " ;
    $sql .= " where c_member_id = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_row($sql,$params);
    return $list;
}
/*
 *メンバーの参加コミュニティの総数を取得
 *
 */
function getMemberCommuCount($c_member_id) {
    $sql = "select count(*) as count from ". MYNETS_PREFIX_NAME ."c_commu_member " ;
    $sql .= " where c_member_id = ? ";
    $params = array(intval($c_member_id));
    $list = db_get_one($sql,$params);
    return $list;
}

/*
 *メンバーの投稿した画像の数を取得
 *
 */
function getMemberImageCount($c_member_id) {
    $sql = "select count(*) as count from ". MYNETS_PREFIX_NAME ."c_image " ;
    $sql .= " where c_member_id = ? ";
    $params = array(intval($c_member_id));
    $db =& db_get_instance('image');
    $list = $db->get_one($sql,$params);
    return $list;
}

//退会情報を全て取得(ページャー付き)
function getDeleteMemberList($sort_no, $keyword, $page, $page_size, &$pager)
{
    $wherecond = "";
    $orderby   = "";

    $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_delete_member_data ";
    if ($keyword !== "") {
        $wherecond = " where nickname like '".$keyword."%' ";   //インデックスを有効にするために前方一致
    }
    switch ($sort_no) {
        case 0:
            $orderby = " ORDER BY delete_datetime desc ";          //退会の最新順
            break;
        case 1:
            $orderby = " ORDER BY c_member_id desc ";               //会員IDの新しい順
            break;
        case 2:
            $orderby = " ORDER BY c_member_id ";                    //会員IDの登録順
            break;
        case 3:
            $orderby = " ORDER BY c_member_id_invite ";             //紹介者IDソート
            break;
        case 4:
            $orderby = " ORDER BY delete_flag ";                    //退会の状況順（０会員、１強制）
            break;
        case 5:
            $orderby = " ORDER BY delete_flag desc ";               //退会の状況強制から
            break;
        case 6:

            break;
    }
    $sql = $sql . $wherecond . $orderby;
    $list = db_get_all_page($sql, $page, $page_size, $params);
    foreach ($list as $key=>$value) {
        $owner_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_invite']);
        $list[$key]['owner_nickname'] = $owner_member['nickname'];
    }
    $sql = 'SELECT count(*) FROM ' . MYNETS_PREFIX_NAME . 'c_delete_member_data';
    $total_num = db_get_one($sql.$wherecond, $params);
    $pager = admin_make_pager($page, $page_size, $total_num);

    return $list;
}

//退会者情報を１件取得
function getDeleteMemberDataAdmin($c_delete_member_data_id)
{
    $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_delete_member_data ";
    $sql .= " WHERE c_delete_member_data_id = ? ";
    $param = array(intval($c_delete_member_data_id));
    $result = db_get_row($sql, $param);
    return $result;
}
?>
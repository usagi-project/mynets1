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
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/03/14]
 * ========================================================================
 */

/**
 * 自分と特定の人とのメッセージの送受信履歴を時間軸を元に抽出する。
 */
if (! function_exists('getMessagaList2Member4Me'))
{
    function getMessagaList2Member4Me($c_member_id, $target_member_id, $page, $page_size = 10)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_message";

// 2010/07/25 抽出条件修正（削除済み、未送信メッセージを除外）
//        $where = " (c_member_id_from = ? or c_member_id_to = ?)" .
//                " AND  (c_member_id_from = ? or c_member_id_to = ?)" .
//                " AND is_syoudaku = 0" ;
        $where = " (" .
                 "   (" .
                 "     c_member_id_from = ?" .
                 "     AND c_member_id_to = ?" .
                 "     AND is_deleted_from = 0" .
                 "   ) OR (" .
                 "     c_member_id_from = ?" .
                 "     AND c_member_id_to = ?" .
                 "     AND is_deleted_to = 0" .
                 "   )" .
                 " )" .
                 " AND is_send = 1" .
                 " AND is_syoudaku = 0" ;

        $sql .= " WHERE $where";
        $sql .= " ORDER BY r_datetime DESC";

// 2010/07/25 抽出条件修正（削除済み、未送信メッセージを除外）
//        $params = array(
//                intval($c_member_id),
//                intval($c_member_id),
//                intval($target_member_id),
//                intval($target_member_id)
//                );
        $params = array(
                intval($c_member_id),
                intval($target_member_id),
                intval($target_member_id),
                intval($c_member_id)
                );

        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        $sql =  "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_message WHERE $where";
        $total_num = db_get_one($sql, $params);

        if ($total_num != 0) {
            $total_page_num =  ceil($total_num / $page_size);
            if ($page >= $total_page_num) {
                $next = false;
            } else {
                $next = true;
            }
            if ($page <= 1) {
                $prev = false;
            } else {
                $prev = true;
            }
        }

        return array($c_message_list , $prev , $next);
    }
}



?>
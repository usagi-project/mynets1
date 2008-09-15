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
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */


/**
 * メッセージIDからメッセージ情報取得
 */
if (! function_exists('_db_c_message4c_message_id'))
{
    function _db_c_message4c_message_id($c_message_id)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_message WHERE c_message_id = ?';
        $params = array(intval($c_message_id));
        $c_message = db_get_row($sql, $params);

        $c_member_from = db_common_c_member4c_member_id_LIGHT($c_message['c_member_id_from']);
        $c_member_to = db_common_c_member4c_member_id_LIGHT($c_message['c_member_id_to']);

        $c_message['c_member_image_filename_from'] = $c_member_from['image_filename'];
        $c_message['c_member_nickname_from'] = $c_member_from['nickname'];
        $c_message['c_member_image_filename_to'] = $c_member_to['image_filename'];
        $c_message['c_member_nickname_to'] = $c_member_to['nickname'];

        return $c_message;
    }
}

/**
 * 未読メッセージの数を数える
 *
 * @return  num_message_not_is_read
 */
if (! function_exists('p_h_message_count_c_message_not_is_read4c_member_to_id'))
{
    function p_h_message_count_c_message_not_is_read4c_member_to_id($c_member_id_to)
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_message WHERE c_member_id_to = ?' .
                ' AND is_read = 0 AND is_send = 1';
        $params = array(intval($c_member_id_to));
        return db_get_one($sql, $params);
    }
}

/**
 * メッセージ取得
 */
if (! function_exists('p_h_message_c_message4c_message_id'))
{
    function p_h_message_c_message4c_message_id($c_message_id, $u)
    {
        $c_message = _db_c_message4c_message_id($c_message_id);

        if ($c_message['c_member_id_to'] == $u) {
            // 受信メッセージ
            $c_message['is_received'] = true;
            $c_message['image_filename_disp'] = $c_message['c_member_image_filename_from'];
        } elseif ($c_message['c_member_id_from'] == $u) {
            // 送信メッセージ
            $c_message['is_received'] = false;
            $c_message['image_filename_disp'] = $c_message['c_member_image_filename_to'];
        }
        return $c_message;
    }
}

/**
 * 受信メッセージリストを取得
 */
if (! function_exists('p_h_message_box_c_message_received_list4c_member_id4range'))
{
    function p_h_message_box_c_message_received_list4c_member_id4range($c_member_id, $page, $page_size)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_message";
        $where = "c_member_id_to = ?".
                " AND is_deleted_to = 0" .
                " AND is_send = 1";
        $sql .= " WHERE $where";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id));
        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_message_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $c_message_list[$key]['nickname'] = $c_member['nickname'];
            $c_message_list[$key]['image_filename'] = $c_member['image_filename'];
        }

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_message WHERE $where";
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
        return array($c_message_list , $prev , $next, $total_num);
    }
}

/**
 * 送信メッセージリストを取得
 */
if (! function_exists('p_h_message_box_c_message_sent_list4c_member_id4range'))
{
    function p_h_message_box_c_message_sent_list4c_member_id4range($c_member_id, $page, $page_size)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_message";
        $where = "c_member_id_from = ?" .
                " AND is_deleted_from = 0" .
                " AND is_send = 1";
        $sql .= " WHERE $where";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id));
        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_message_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            $c_message_list[$key]['nickname'] = $c_member['nickname'];
            $c_message_list[$key]['image_filename'] = $c_member['image_filename'];
        }

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

        return array($c_message_list , $prev , $next, $total_num);
    }
}

/**
 * 下書き保存メッセージリストを取得
 */
if (! function_exists('p_h_message_box_c_message_save_list4c_member_id4range'))
{
    function p_h_message_box_c_message_save_list4c_member_id4range($c_member_id, $page, $page_size)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_message";
        $where = "c_member_id_from = ?".
                " AND is_send = 0" .
                " AND is_deleted_from = 0";
        $sql .= " WHERE $where";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id));
        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_message_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            $c_message_list[$key]['nickname'] = $c_member['nickname'];
            $c_message_list[$key]['image_filename'] = $c_member['image_filename'];
        }

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_message WHERE $where";
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

        return array($c_message_list, $prev, $next, $total_num);
    }
}

/**
 * ごみ箱メッセージリストを取得
 */
if (! function_exists('p_h_message_box_c_message_trash_list4c_member_id4range'))
{
    function p_h_message_box_c_message_trash_list4c_member_id4range($c_member_id, $page, $page_size)
    {
        $where = "(" .
                "c_member_id_from = ?" .
                " AND is_deleted_from = 1" .
                " AND is_kanzen_sakujo_from = 0" .
            ") OR (" .
                "c_member_id_to = ?" .
                " AND is_deleted_to = 1" .
                " AND is_kanzen_sakujo_to = 0" .
                " AND is_send = 1" .
            ")";

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_message WHERE '. $where . ' ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id), intval($c_member_id));
        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_message WHERE ' . $where;
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

        foreach ($c_message_list as $key => $value) {
            if ($value['c_member_id_to'] == $c_member_id) {
                $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            } else {
                $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            }
            $c_message_list[$key]['nickname'] = $c_member['nickname'];
            $c_message_list[$key]['image_filename'] = $c_member['image_filename'];
        }

        return array($c_message_list, $prev, $next, $total_num);
    }
}

/**
 * 未読メッセージ数を取得
 *
 * @param int $c_member_id
 * @return int 未読メッセージ数
 */
if (! function_exists('k_p_h_home_c_message_received_unread_all_count4c_member_id'))
{
    function k_p_h_home_c_message_received_unread_all_count4c_member_id($c_member_id)
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_message WHERE c_member_id_to = ?' .
                ' AND is_read = 0 AND is_send = 1';
        $params = array(intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

if (! function_exists('k_p_h_message_box_c_message_received_list4c_member_id4range'))
{
    function k_p_h_message_box_c_message_received_list4c_member_id4range($c_member_id, $page_size, $page)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_message";
        $sql .= " WHERE c_member_id_to = ?".
                " AND is_deleted_to = 0" .
                " AND is_send = 1";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id));
        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_message_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $c_message_list[$key]['nickname'] = $c_member['nickname'];
        }

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_message" .
                " WHERE c_member_id_to = ?".
                " AND is_deleted_to = 0" .
                " AND is_send = 1";
        $total_num = db_get_one($sql, $params);

        if ($total_num != 0) {
            $total_page_num = ceil($total_num / $page_size);
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

        return array($c_message_list, $prev, $next, $total_num);
    }
}

if (! function_exists('k_p_h_message_box_c_message_sent_list4c_member_id4range'))
{
    function k_p_h_message_box_c_message_sent_list4c_member_id4range($c_member_id, $page_size, $page)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_message";
        $sql .= " WHERE c_member_id_from = ?".
                " AND is_deleted_from = 0" .
                " AND is_send = 1";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id));
        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_message_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            $c_message_list[$key]['nickname'] = $c_member['nickname'];
        }

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_message" .
                " WHERE c_member_id_from = ?".
                " AND is_deleted_from = 0" .
                " AND is_send = 1";
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

        return array($c_message_list, $prev, $next, $total_num);
    }
}

/**
 * 返信側にある返信元メッセージIDを取得
 */
if (! function_exists('do_get_hensinmoto_id'))
{
    function do_get_hensinmoto_id($hensin_c_message_id)
    {
        $sql = 'SELECT hensinmoto_c_message_id FROM ' . MYNETS_PREFIX_NAME . 'c_message WHERE c_message_id = ?';
        $params = array(intval($hensin_c_message_id));
        return db_get_one($sql, $params);
    }
}

//メッセージを検索
if (! function_exists('db_message_search_c_message'))
{
    function db_message_search_c_message($c_member_id, $page, $page_size, $keyword, $box, $target_c_member_id = null)
    {
        $params = array();
        $params[] = intval($c_member_id);

        if ($box == 'inbox' || !$box) {
            $where = "c_member_id_to = ?".
                     " AND is_deleted_to = 0" .
                     " AND is_send = 1";
            if ($target_c_member_id) {
                $where .= " AND c_member_id_from = ?";
                $params[] = intval($target_c_member_id);
            }
        } elseif ($box == 'outbox') {
            $where = "c_member_id_from = ?".
                     " AND is_deleted_from = 0" .
                     " AND is_send = 1";
            if ($target_c_member_id) {
                $where .= " AND c_member_id_to = ?";
                $params[] = intval($target_c_member_id);
            }
        }

        if ($keyword) {
            //全角空白を半角に統一
            $keyword = str_replace('　', ' ', $keyword);

            $keyword_list = explode(' ', $keyword);
            foreach ($keyword_list as $word) {
                $word = check_search_word($word);

                $where .= ' AND (subject LIKE ? OR body LIKE ?)';
                $params[] = '%'.$word.'%';
                $params[] = '%'.$word.'%';
            }
        }

        $sql = "SELECT * FROM c_message";
        $sql .= " WHERE $where";
        $sql .= " ORDER BY r_datetime DESC";

        $c_message_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_message_list as $key => $value) {
            if ($box == 'inbox' || !$box) {
                $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            } else {
                $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            }
            $c_message_list[$key]['nickname'] = $c_member['nickname'];
            $c_message_list[$key]['image_filename'] = $c_member['image_filename'];
        }

        $sql = "SELECT COUNT(*) FROM c_message WHERE $where";
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
        return array($c_message_list , $prev , $next, $total_num);
    }
}

?>

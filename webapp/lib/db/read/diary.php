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
 * @chengelog  [2007/06/19] Ver1.1.0Nighty package
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
 * db_diary_public_flag_condition
 *
 * @param int $c_member_id target c_member_id
 * @param int $u viewer's c_member_id
 * @param string $force
 * @return string
 */
if (! function_exists('db_diary_public_flag_condition'))
{
    function db_diary_public_flag_condition($c_member_id, $u = null, $force = null)
    {
        $pf_cond = '';
        if ($force) {
            switch ($force) {
            case 'friend':
                $pf_cond = " AND public_flag <> 'private'";
                break;
            case 'private':
                $pf_cond = " AND (public_flag = 'public' OR public_flag='open')";
                break;
            }
        } else {
            if (!is_null($u) && $c_member_id != $u) {
                $is_friend = db_friend_is_friend($c_member_id, $u);
                if ($is_friend) {
                    $pf_cond = " AND public_flag <> 'private'";
                } else {
                    $pf_cond = " AND (public_flag = 'public' OR public_flag='open')";
                }
            }
        }
        return $pf_cond;
    }
}

//// c_diary

/**
 * 日記IDから日記を取得
 *
 * @param   int   $c_diary_id
 * @return  array
 */
if (! function_exists('db_diary_get_c_diary4id'))
{
    function db_diary_get_c_diary4id($c_diary_id)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_diary_id = ?';
        return db_get_row($sql, array(intval($c_diary_id)));
    }
}
/**
 * 日記IDから日記を取得(該当日記の前後の日記IDも取得。)
 *
 * @param   int   $c_diary_id
 * @param   int   $c_member_id(閲覧者)
 * @return  array
 * @author shinji hyodo
 */
if (! function_exists('db_diary_get_c_diary4id_with_prev_next'))
{
    function db_diary_get_c_diary4id_with_prev_next($c_diary_id,$c_member_id)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_diary_id = ?';
        $c_diary = db_get_row($sql, array(intval($c_diary_id)));
        if ($c_diary) {
            $pf_conf = '';
            if ($c_member_id != $c_diary['c_member_id']) {
                $pf_cond = db_diary_public_flag_condition($c_diary['c_member_id'], $c_member_id);
            }
            //前の日記
            $sql = 'SELECT c_diary_id FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ?' . $pf_cond .
            ' AND c_diary_id < ? ORDER BY c_diary_id DESC';
            $params = array(intval($c_diary['c_member_id']),intval($c_diary_id));
            $c_diary['c_diary_id_prev'] = db_get_one($sql,$params);
            //後の日記
            $sql = 'SELECT c_diary_id FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ?' . $pf_cond .
            ' AND c_diary_id > ? ORDER BY c_diary_id';
            $c_diary['c_diary_id_next'] = db_get_one($sql, $params);
        }
        return $c_diary;
    }
}

/**
 * メンバーIDから日記リストを最新順で取得
 *
 * @param int $c_member_id
 * @return array 日記リスト
 */
if (! function_exists('db_diary_get_c_diary_list4c_member_id'))
{
    function db_diary_get_c_diary_list4c_member_id($target_c_member_id, $count = 10, $u = null, $force = null)
    {
        $pf_cond = db_diary_public_flag_condition($target_c_member_id, $u, $force);
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ?' . $pf_cond .
               ' ORDER BY r_datetime DESC';
        $params = array(intval($target_c_member_id));
        $arr = db_get_all_limit($sql, 0, $count, $params);
        //foreach ($arr as $key => $value) {
        //    $arr[$key]['comment_count'] = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
        //}
        return $arr;
    }
}

if (! function_exists('p_common_is_active_c_diary_id'))
{
    function p_common_is_active_c_diary_id($c_diary_id)
    {
        $sql = 'SELECT c_diary_id FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_diary_id = ?';
        return (bool)db_get_one($sql, array(intval($c_diary_id)));
    }
}

//// c_diary_comment

/**
 * 日記のコメントリストを得る
 *
 * @param   int $c_diary_id
 * @param   int $limit
 * @return  array 日記コメント＋ニックネーム
 * コメント取得後配列で名前を当てはめるようにいずれ変更する
 */
if (! function_exists('db_diary_get_c_diary_comment_list4c_diary_id'))
{
    function db_diary_get_c_diary_comment_list4c_diary_id($c_diary_id)
    {
        $sql = 'SELECT cm.nickname, cm.image_filename, cd.*' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment as cd '
          . 'LEFT JOIN ' . MYNETS_PREFIX_NAME . 'c_member as cm USING (c_member_id)' .
            ' WHERE cd.c_diary_id = ?' .
            ' ORDER BY cd.r_datetime';
        return db_get_all($sql, array(intval($c_diary_id)));
    }
}

/**
 * 日記のコメントリスト（好きなID(複数)）を取得
 *
 * @param   array $id_list
 * @param   int   $page
 * @param   int   $page_size
 * @param   bool  $desc  並び順を日時の新しい順にするかどうか
 * @return  日記コメント（＋ニックネーム）リスト
 */
if (! function_exists('db_diary_get_c_diary_comment_list4id_list'))
{
    function db_diary_get_c_diary_comment_list4id_list($id_list, $page = 1, $page_size= -1, $desc = false)
    {
        if (!count($id_list)) return array();
        if ($page_size < 0) {
            $page_size = count($id_list);
        }
        $e_id_list = implode(',', array_map('intval', (array)$id_list));

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment' .
                ' WHERE c_diary_comment_id IN ('.$e_id_list.')';
        if ($desc) {
            $sql .= ' ORDER BY r_datetime DESC';
        } else {
            $sql .= ' ORDER BY r_datetime';
        }
        $c_diary_comment_list = db_get_all_page($sql, $page, $page_size);
        foreach ($c_diary_comment_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $c_diary_comment_list[$key]['nickname'] = $c_member['nickname'];
        }

        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment' .
            ' WHERE c_diary_comment_id IN ('.$e_id_list.')';
        $total_num = db_get_one($sql);

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
        return array($c_diary_comment_list, $prev , $next, $total_num);
    }
}

/**
 * 日記のコメント数を取得
 * コメント数をカウントするほうへ後ほど移動
 * @param int $c_diary_id
 * @return int コメント数
 */
if (! function_exists('db_diary_count_c_diary_comment4c_diary_id'))
{
    function db_diary_count_c_diary_comment4c_diary_id($c_diary_id)
    {
        $sql = 'SELECT comment_count FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_diary_id = ?';
        return db_get_one($sql, array(intval($c_diary_id)));
    }
}

////

/**
 * あるメンバーの日記リストを取得
 *
 * @param int $c_member_id target c_member_id
 * @param int $page_size
 * @param int $page
 * @param int $u viewer's c_member_id
 * @return array 日記リスト
 */
if (! function_exists('p_fh_diary_list_diary_list4c_member_id'))
{
    function p_fh_diary_list_diary_list4c_member_id($c_member_id, $page_size, $page, $u = null)
    {
        $pf_cond = db_diary_public_flag_condition($c_member_id, $u);
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ?' . $pf_cond .
               ' ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);

        //foreach ($list as $key=>$value) {
        //    $list[$key]['num_comment'] = $value['comment_count'];
        //}
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ?' . $pf_cond;
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
        return array($list, $prev, $next, $total_num);
    }
}

/**
 * フレンドの最新日記リスト
 */
if (! function_exists('p_h_diary_list_friend_h_diary_list_friend4c_member_id'))
{
    function p_h_diary_list_friend_h_diary_list_friend4c_member_id($c_member_id, $page_size, $page)
    {
        $friends = db_friend_c_member_id_list($c_member_id, true);
        $ids = implode(',', array_map('intval', $friends));

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
                ' WHERE c_member_id IN (' . $ids . ')' .
                ' AND public_flag <> \'private\'' .
                ' ORDER BY r_datetime DESC';

        $lst = db_get_all_page($sql, $page, $page_size);

        foreach ($lst as $key=>$value) {
            $lst[$key]['c_member'] = db_common_c_member4c_member_id($value['c_member_id']);
        }

        $sql = 'SELECT count(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
               ' WHERE c_member_id IN (' . $ids . ')' .
               ' AND public_flag <> \'private\'';
        $total_num = db_get_one($sql);              //不要のparamsを削除

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
        return array($lst, $prev, $next, $total_num);
    }
}

/**
 * 未読コメントのある日記の数を数える
 *
 * @param int $c_member_id
 * @return int 未読日記数
 */
if (! function_exists('p_h_diary_count_c_diary_not_is_read4c_member_id'))
{
    function p_h_diary_count_c_diary_not_is_read4c_member_id($c_member_id)
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ? AND is_checked = 0';
        $params = array(intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

/**
 * 未読コメントのある日記のうちもっとも古い日記IDを返す
 *
 * @param int $c_member_id
 * @return int c_diary_id
 */
if (! function_exists('p_h_diary_c_diary_first_diary_read4c_member_id'))
{
    function p_h_diary_c_diary_first_diary_read4c_member_id($c_member_id)
    {
        $sql = 'SELECT c_diary_id FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ?'
             . ' AND is_checked = 0 ORDER BY r_datetime';
        $params = array(intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

/**
 * フレンド最新日記リスト取得
 * 日記公開範囲を考慮
 *
 * @param   int $c_member_id
 * @param   int $limit
 * @return  array_of_array  (c_diary.*, nickname)
 */
if (! function_exists('p_h_home_c_diary_friend_list4c_member_id'))
{
    function p_h_home_c_diary_friend_list4c_member_id($c_member_id, $limit)
    {
        if (DIARY_DISTINCT_LIST !== true) {
            $c_diary_friend_list = p_h_home_c_diary_friend_list4c_member_id_old($c_member_id, $limit);
            return $c_diary_friend_list;
        } else {
            $friends = db_friend_c_member_id_list($c_member_id, true);
            $ids = implode(',', array_map('intval', $friends));
            $sql = 'SELECT max(c_diary_id) AS id,max(r_datetime) as dd FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
                ' WHERE c_member_id IN (' . $ids . ')' .
                ' AND public_flag <> \'private\'' .
                ' GROUP BY c_member_id ' .
                ' ORDER BY dd DESC';

            $result = db_get_all_limit($sql, 0, $limit);
            $ids = array();
            foreach($result as $value) {
                $ids[] = $value['id'];
            }
            $ids = implode(',', $ids);
            $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
               ' WHERE c_diary_id IN (' . $ids . ')' .
               ' ORDER BY r_datetime DESC';
            $c_diary_friend_list = db_get_all($sql);

            foreach ($c_diary_friend_list as $key => $value) {
                $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
                $c_diary_friend_list[$key]['nickname'] = $c_member['nickname'];
            }
            return $c_diary_friend_list;
        }
    }
}

/**
 * フレンド最新日記リスト取得
 * 日記公開範囲を考慮
 *
 * @param   int $c_member_id
 * @param   int $limit
 * @return  array_of_array  (c_diary.*, nickname)
 */
if (! function_exists('p_h_home_c_diary_friend_list4c_member_id_old'))
{
    function p_h_home_c_diary_friend_list4c_member_id_old($c_member_id, $limit)
    {
        $friends = db_friend_c_member_id_list($c_member_id, true);
        $ids = implode(',', array_map('intval', $friends));
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
                ' WHERE c_member_id IN (' . $ids . ')' .
                ' AND public_flag <> \'private\'' .
                ' ORDER BY r_datetime DESC';

        $c_diary_friend_list = db_get_all_limit($sql, 0, $limit);

        foreach ($c_diary_friend_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $c_diary_friend_list[$key]['nickname'] = $c_member['nickname'];
            $c_diary_friend_list[$key]['image_filename'] = $c_member['image_filename'];
        }
        return $c_diary_friend_list;
    }
}
/**
 * 日記コメント記入履歴取得
 *
 * @param   int $c_member_id
 * @param   int $limit
 * @return  array_of_array  (c_diary.*, nickname)
 */
if (! function_exists('p_h_home_c_diary_my_comment_list4c_member_id'))
{
    function p_h_home_c_diary_my_comment_list4c_member_id($c_member_id, $limit)
    {
        $date = date('Y-m-d 00:00:00', strtotime('-15 days'));

        $blocked = db_member_access_block_list4c_member_id_to($c_member_id);
        $blocked[] = $c_member_id;
        $except_ids = implode(',', $blocked);
        $sql = 'SELECT dc.c_diary_id' .
                ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment as dc INNER JOIN '
                         . MYNETS_PREFIX_NAME . 'c_diary as cd USING (c_diary_id)' .
                ' WHERE dc.c_member_id = ?' .
                ' AND dc.r_datetime > ?' .
                ' AND cd.c_member_id NOT IN (' . $except_ids . ')' .
                ' AND cd.public_flag <> \'private\'';
        $params = array(intval($c_member_id), $date);
        $c_diary_id_list = db_get_col($sql, $params);
        $c_diary_id_list = array_unique($c_diary_id_list);
        if (!$c_diary_id_list) {
            return array();
        }

        $ids = implode(',', $c_diary_id_list);
        $sql = 'SELECT c_diary_id, MAX(r_datetime) as maxdate' .
               ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment' .
               ' WHERE c_diary_id IN (' . $ids . ')' .
               ' GROUP BY c_diary_id' .
               ' ORDER BY maxdate DESC';
        $list = db_get_assoc_limit($sql, 0, $limit);

        $result = array();
        foreach ($list as $c_diary_id => $r_datetime) {
            $item = db_diary_get_c_diary4id($c_diary_id);
            if ($item['public_flag'] == 'friend' && !db_friend_is_friend($c_member_id, $item['c_member_id'])) {
                continue;
            }
            $item += db_common_c_member4c_member_id_LIGHT($item['c_member_id']);
            $item['r_datetime'] = $r_datetime;
            $result[] = $item;
        }
        return $result;
    }
}

if (! function_exists('p_h_diary_comment_list_c_diary_my_comment_list4c_member_id'))
{
    function p_h_diary_comment_list_c_diary_my_comment_list4c_member_id($c_member_id, $page, $page_size)
    {
        $blocked = db_member_access_block_list4c_member_id_to($c_member_id);
        $blocked[] = $c_member_id;
        $except_ids = implode(',', $blocked);

        $friends = db_friend_c_member_id_list($c_member_id);
        $friend_ids = implode(',', $friends);
        /*
        $sql = 'SELECT d.c_diary_id' .
                ', d.subject' .
                ', d.c_member_id' .
                ', MAX(dc.r_datetime) AS r_datetime' .
                ', d.comment_count' .
            ', d.etsuran_count' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary AS d' .
                ' INNER JOIN ' . MYNETS_PREFIX_NAME . 'c_diary_comment AS dc USING (c_diary_id)' .
                ', ' . MYNETS_PREFIX_NAME . 'c_diary_comment AS mydc' .
            ' WHERE mydc.c_member_id = ?' .
                ' AND mydc.c_diary_id = d.c_diary_id' .
                ' AND mydc.c_member_id <> d.c_member_id' .
                ' AND d.c_member_id NOT IN (' . $except_ids . ')' .
                ' AND (d.public_flag = \'public\' OR d.public_flag = \'open\' OR(d.public_flag = \'friend\' AND d.c_member_id IN (' . $friend_ids . ')))' .
            ' GROUP BY dc.c_diary_id' .
            ' ORDER BY r_datetime DESC';
               */
        //2008-05-17 KUNIHARU Tsujioka SQLチューニング PNEからのSQLでパフォーマンスが悪いため
        //SQLを見直し。4.4sec=>0.09sec

        $sql = "SELECT "
                    . "d.c_diary_id, "
                    . "d.subject, "
                    . "d.c_member_id, "
                    . "e_datetime, "
                    . "d.comment_count, "
                    . "d.etsuran_count "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_diary AS d "
             . "INNER JOIN "
                    . MYNETS_PREFIX_NAME . "c_diary_comment AS dc "
             . "USING "
                    . "(c_diary_id) "
             . "WHERE "
                    . "dc.c_member_id = ? "
             . "AND "
                    . "dc.c_diary_id = d.c_diary_id "
             . "AND "
                    . "dc.c_member_id <> d.c_member_id "
             . "AND "
                    . "d.c_member_id NOT IN (" . $except_ids . ") "
             . "AND ("
                    . "d.public_flag = 'public' "
                    . "OR "
                    . "d.public_flag = 'open' "
                    . "OR ("
                        . "d.public_flag = 'friend' "
                        . "AND "
                        . "d.c_member_id IN (" . $friend_ids . ")"
                        . ") "
                    . ") "
              . "GROUP BY "
                    . "dc.c_diary_id "
              . "ORDER BY "
                    . "e_datetime DESC ";
        $params = array(intval($c_member_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($list as $key => $value) {
            $list[$key] += db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        }
        /*
        $sql = 'SELECT COUNT(DISTINCT d.c_diary_id)' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary AS d' .
                ' INNER JOIN ' . MYNETS_PREFIX_NAME . 'c_diary_comment AS dc USING (c_diary_id)' .
                ', ' . MYNETS_PREFIX_NAME . 'c_diary_comment AS mydc' .
            ' WHERE mydc.c_member_id = ?' .
                ' AND mydc.c_diary_id = d.c_diary_id' .
                ' AND mydc.c_member_id <> d.c_member_id' .
                ' AND d.c_member_id NOT IN (' . $except_ids . ')' .
                ' AND (d.public_flag = \'public\' OR d.public_flag = \'open\' OR(d.public_flag = \'friend\' AND d.c_member_id IN (' . $friend_ids . ')))';
        */
        //2008-05-17 KUNIHARU Tsujioka SQLチューニング PNEからのSQLでパフォーマンスが悪いため
        //SQLを見直し。0.0026sec=>0.0016sec
        $sql = "SELECT "
                    . "COUNT(DISTINCT d.c_diary_id) "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_diary AS d "
             . "INNER JOIN "
                    . MYNETS_PREFIX_NAME . "c_diary_comment AS dc "
             . "USING (c_diary_id) "
             . "WHERE "
                    . "dc.c_member_id = ? "
             . "AND "
                    . "dc.c_diary_id = d.c_diary_id "
             . "AND "
                    . "dc.c_member_id <> d.c_member_id "
             . "AND "
                    . "d.c_member_id NOT IN (" . $except_ids . ") "
             . "AND ("
                    . "d.public_flag = 'public' "
                    . "OR "
                    . "d.public_flag = 'open' "
                    . "OR ("
                        . "d.public_flag = 'friend' "
                        . "AND "
                        . "d.c_member_id IN (" . $friend_ids . ")"
                        . ") "
                    . ") ";
        $total_num = db_get_one($sql, $params);
        $is_prev = false;
        $is_next = false;
        if ($total_num) {
            $is_prev = (bool)($page > 1);
            $is_next = (bool)($page < ceil($total_num / $page_size));
        }
        return array($list, $is_prev, $is_next, $total_num);
    }
}

/**
 * あるメンバーの指定された年月日の日記のリストを得る
 */
if (! function_exists('p_fh_diary_list_diary_list_date4c_member_id'))
{
    function p_fh_diary_list_diary_list_date4c_member_id($c_member_id,
                                                        $page,
                                                        $page_size,
                                                        $year,
                                                        $month,
                                                        $day=0,
                                                        $u = null)
    {
        if ($day) {
            $s_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year));
            $e_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day+1, $year));
        } else {
            $s_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, 1, $year));
            $e_date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month+1, 1, $year));
        }
        $pf_cond = db_diary_public_flag_condition($c_member_id, $u);
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
                ' WHERE c_member_id = ? AND r_datetime >= ? AND r_datetime < ?' . $pf_cond .
                ' ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id), $s_date, $e_date);
        $list = db_get_all_page($sql, $page, $page_size, $params);
        //$total_num = count($list);
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
                ' WHERE c_member_id = ? AND r_datetime >= ? AND r_datetime < ?' . $pf_cond;
        $total_num = db_get_one($sql, $params);

        /*
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
        */
        return array($list, false, false, $total_num);
    }
}

/**
 * 日記ページの「各月の日記」用
 *
 * 日記を最初に書いた月からスタートしてみる
 */
if (! function_exists('p_fh_diary_list_date_list4c_member_id'))
{
    function p_fh_diary_list_date_list4c_member_id($c_member_id)
    {
        $sql = "SELECT r_datetime FROM " . MYNETS_PREFIX_NAME . "c_diary" .
            " WHERE c_member_id = ?" .
            " ORDER BY r_datetime";
        $params = array(intval($c_member_id));
        if (!$first_datetime = db_get_one($sql, $params)) {
            return array();
        }

        $start_date = getdate(strtotime($first_datetime));
        $end_date =  getdate();

        $date = array();
        $year = $start_date['year'];
        $month = $start_date['mon'];
        while (1) {
            $date[] =  array(
                'year' => $year,
                'month' => $month,
            );

            if ($end_date['year'] <= $year
                && $end_date['mon'] <= $month) {
                break;
            }

            $month++;
            if ($month > 12) {
                $month = 1;
                $year++;
            }
        }
        return array_reverse($date);
    }
}

//c_member_id から自分の日記についてるコメントID(複数)を取得
if (! function_exists('p_fh_diary_c_diary_comment_id_list4c_member_id'))
{
    function p_fh_diary_c_diary_comment_id_list4c_member_id($c_member_id)
    {
        $sql = "SELECT cdc.c_diary_comment_id FROM "
                 . MYNETS_PREFIX_NAME . "c_diary as cd, "
                 . MYNETS_PREFIX_NAME . "c_diary_comment as cdc" .
            " WHERE cd.c_member_id = ?".
            " AND cd.c_diary_id = cdc.c_diary_id";
        $params = array(intval($c_member_id));
        return db_get_col($sql, $params);
    }
}

/**
 * 年月 から日記のある日(複数)を取得
 */
if (! function_exists('p_fh_diary_list_calendar_list4c_member_id'))
{
    function p_fh_diary_list_calendar_list4c_member_id($year, $month, $c_member_id)
    {
        $sql = "SELECT cdc.c_diary_comment_id FROM "
                     . MYNETS_PREFIX_NAME . "c_diary as cd, "
                     . MYNETS_PREFIX_NAME . "c_diary_comment as cdc" .
            " WHERE cd.c_member_id = ?".
            " AND cd.c_diary_id = cdc.c_diary_id";
        $params = array(intval($c_member_id));
        return db_get_col($sql, $params);
    }
}

/**
 * 新着日記検索
 * 検索ポイントはタイトル、本文
 * 空白（全角半角問わない）でand検索可
 * タグを入れる
 */
if (! function_exists('p_h_diary_list_all_search_c_diary4c_diary'))
{
    function p_h_diary_list_all_search_c_diary4c_diary($keyword, $page_size, $page)
    {
        $select = 'SELECT *';
        $from = ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary';
        $where = " WHERE (public_flag = 'public' or public_flag = 'open')";

        //and検索を実装
        //subject,body を検索
        $params = array();
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
        $order = " ORDER BY r_datetime DESC";

        $sql = $select . $from . $where . $order;

        $list = db_get_all_page($sql, $page, $page_size, $params);
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            $list[$key]['comment_count'] = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
            $list[$key]['tags_list'] = getEntryTag($value['c_diary_id'], '0');
        }

        $sql = 'SELECT COUNT(*)' . $from . $where;
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
        return array($list , $prev , $next, $total_num);
    }
}

/**
 * 指定された年月に日記を書いている日のリストを返す
 */
if (! function_exists('p_h_diary_is_diary_written_list4date'))
{
    function p_h_diary_is_diary_written_list4date($year, $month, $c_member_id, $u = null)
    {
        include_once 'Date/Calc.php';
        $pf_cond = db_diary_public_flag_condition($c_member_id, $u);
        $sql = 'SELECT DISTINCT DAYOFMONTH(r_datetime) FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
               ' WHERE c_member_id = ? AND r_datetime >= ? AND r_datetime < ?' . $pf_cond;

        $date_format = '%Y-%m-%d 00:00:00';
        $thismonth = Date_Calc::beginOfMonth($month, $year, $date_format);
        $nextmonth = Date_Calc::beginOfNextMonth(0, $month, $year, $date_format);

        $params = array(intval($c_member_id), $thismonth, $nextmonth);

        return db_get_col($sql, $params);
    }
}

/**
 * 日記コメント情報をIDから取得
 *
 * @param   int $c_diary_comment_id
 * @return array
 *              c_diary_comemnt.*
 *              c_diary.c_member_id AS c_member_id_author
 * 削除時にc_diary_idをチェックするため、SELECT追加
 */
if (! function_exists('_do_c_diary_comment4c_diary_comment_id'))
{
    function _do_c_diary_comment4c_diary_comment_id($c_diary_comment_id)
    {
        $sql = "SELECT dc.*, d.c_member_id AS c_member_id_author,d.c_diary_id";
        $sql .= " FROM " . MYNETS_PREFIX_NAME . "c_diary_comment AS dc, " . MYNETS_PREFIX_NAME . "c_diary AS d";
        $sql .= " WHERE dc.c_diary_comment_id = ?";
        $sql .= " AND dc.c_diary_id = d.c_diary_id";
        $params = array(intval($c_diary_comment_id));
        return db_get_row($sql, $params);
    }
}

/**
 * ターゲットメンバの最新日記のリストを返す
 */
if (! function_exists('k_p_f_home_c_diary_list4c_member_id'))
{
    function k_p_f_home_c_diary_list4c_member_id($c_member_id, $limit)
    {
        //日記リスト
        $sql = "SELECT c_diary_id, r_date, subject ,image_filename_1";
        $sql .= " FROM " . MYNETS_PREFIX_NAME . "c_diary";
        $sql .= " WHERE c_member_id = ?";
        $sql .= " ORDER BY r_date DESC";
        $params = array(intval($c_member_id));
        $c_diary_list = db_get_all_limit($sql, 0, $limit, $params);

        //コメント数
        foreach ($c_diary_list as $key => $value) {
            $c_diary_id = $value['c_diary_id'];

            $sql = "SELECT COUNT(*) ";
            $sql .= "FROM " . MYNETS_PREFIX_NAME . "c_diary_comment ";
            $sql .= "WHERE c_diary_id = ?";
            $params = array(intval($c_diary_id));
            $c_diary_list[$key]['count_comment'] = db_get_one($sql, $params);
        }
        return $c_diary_list;
    }
}

/**
 * 最新日記リストを取得。
 * 取得範囲を指定できる。
 */
if (! function_exists('k_p_fh_diary_list_c_diary_list4c_member_id'))
{
    function k_p_fh_diary_list_c_diary_list4c_member_id($c_member_id, $page_size, $page)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ? ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id));
        $c_diary_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_diary_list as $key => $value) {
            $c_diary_list[$key]['count_comment'] =
                db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
        }

        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id = ?';
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
        return array($c_diary_list , $prev , $next);
    }
}

/**
 * 日記へのコメントリストを取得
 * 表示順コントロール機能追加2008-01-28 kuniharu tsujioka
 */
if (! function_exists('k_p_fh_diary_c_diary_comment_list4c_diary_id'))
{
    function k_p_fh_diary_c_diary_comment_list4c_diary_id($c_diary_id, $page_size, $page, $page_sort = '')
    {

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment WHERE c_diary_id = ? ';
        switch ($page_sort) {
            case '':
            default:
                $orderby = " ORDER BY r_datetime DESC";
                break;
            case '1':
                $orderby = " ORDER BY r_datetime DESC";
                break;
            case '2':
                $orderby = " ORDER BY r_datetime ";
                break;
        }

        $sql = $sql . $orderby;
        $params = array(intval($c_diary_id));
        $c_diary_comment_list = db_get_all_page($sql, $page, $page_size, $params);

        ///////////////////////
        //ページ内投稿順の場合の逆順
        if ($page_sort == '1') {
            $c_diary_comment_list = array_reverse($c_diary_comment_list);
        }
        ///////////////////////

        $GLOBALS['c_diary_id'] = $c_diary_id;
        foreach ($c_diary_comment_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $c_diary_comment_list[$key]['nickname'] = $c_member['nickname'];
            $c_diary_comment_list[$key]['image_filename'] = $c_member['image_filename'];
            $c_diary_comment_list[$key]['body'] =
                            preg_replace_callback('/>>(\d+)/i','make_diary_comment_link',$value['body']);
        }

            $total_page_num = 0;
            $prev = false;
            $next = false;
        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_diary_comment WHERE c_diary_id = ?";
        $params = array(intval($c_diary_id));
        $total_num = db_get_one($sql, $params);

        if ($total_num > 0) {
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
        return array($c_diary_comment_list , $prev , $next, $total_num, $total_page_num);
    }
}

if (! function_exists('make_diary_comment_link'))
{
    function make_diary_comment_link($matches) {
        $d_comment = db_diary_comment4comment_number($GLOBALS['c_diary_id'],$matches[1]);
        if($d_comment) {
            return '>>' . $matches[1] . '_' . $GLOBALS['c_diary_id'] . '_d';
        } else {
            return '>>' . $matches[1];
        }
    }
}

if (! function_exists('db_diary_comment4comment_number'))
{
    function db_diary_comment4comment_number($c_dairy_id,$comment_number)
    {
        $sql =
        ' SELECT *' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment' .
        ' WHERE comment_number = ' . intval($comment_number) .
        ' AND c_diary_id =' . intval($c_dairy_id);
        return db_get_row($sql);
    }
}

if (! function_exists('test_k_p_fh_diary_c_diary_comment_list4c_diary_id'))
{
    function test_k_p_fh_diary_c_diary_comment_list4c_diary_id($c_diary_id, $page_size, $page)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment WHERE c_diary_id = ? ORDER BY r_datetime DESC';
        $params = array(intval($c_diary_id));
        $c_diary_comment_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_diary_comment_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $c_diary_comment_list[$key]['nickname'] = $c_member['nickname'];
        }

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_diary_comment WHERE c_diary_id = ?";
        $params = array(intval($c_diary_id));
        $total_num = db_get_one($sql, $params);

        if ($total_num > 0) {
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
        return array($c_diary_comment_list , $prev , $next, $total_num, $total_page_num);
    }
}

/**
 * 日記ＩＤからその日記を書いたメンバＩＤとニックネームと日記公開範囲を得る
 */
if (! function_exists('k_p_fh_diary_c_member4c_diary_id'))
{
    function k_p_fh_diary_c_member4c_diary_id($c_diary_id)
    {
        $sql = "SELECT cm.c_member_id, cm.nickname,cm. public_flag_diary ";
        $sql .= " FROM " . MYNETS_PREFIX_NAME . "c_member AS cm, " . MYNETS_PREFIX_NAME . "c_diary AS cd ";
        $sql .= " WHERE cd.c_diary_id = ?";
        $sql .= " AND cm.c_member_id=cd.c_member_id";
        $params = array(intval($c_diary_id));
        return db_get_row($sql, $params);
    }
}

/**
 * フレンド最新日記リスト取得
 */
if (! function_exists('k_p_h_home_c_diary_friend_list4c_member_id'))
{
    function k_p_h_home_c_diary_friend_list4c_member_id($c_member_id, $limit)
    {
        $result = p_h_home_c_diary_friend_list4c_member_id($c_member_id, $limit);
        return $result;

        $sql = "SELECT cd.*";
        $sql .= " FROM " . MYNETS_PREFIX_NAME . "c_diary as cd, " . MYNETS_PREFIX_NAME . "c_friend as cf";
        $sql .= " WHERE cf.c_member_id_from = ?";
        $sql .= " AND cd.c_member_id=cf.c_member_id_to";
        $sql .= " AND cd.public_flag <> 'private'";
        $sql .= " ORDER BY cd.r_datetime DESC";
        $params = array(intval($c_member_id));
        $c_diary_friend_list = db_get_all_limit($sql, 0, $limit, $params);

        foreach ($c_diary_friend_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $c_diary_friend_list[$key]['nickname'] = $c_member['nickname'];

        }

        return $c_diary_friend_list;
    }
}

/**
 * フレンドの最新日記リスト
 */
if (! function_exists('k_p_h_diary_list_friend_h_diary_list_friend4c_member_id'))
{
    function k_p_h_diary_list_friend_h_diary_list_friend4c_member_id($c_member_id, $page_size, $page)
    {
        $from = MYNETS_PREFIX_NAME . "c_diary as cd, " . MYNETS_PREFIX_NAME . "c_friend as cf";
        $where = "cf.c_member_id_from = ?" .
                " AND cd.c_member_id = cf.c_member_id_to";

        $sql = "SELECT cd.* FROM {$from} WHERE {$where}" .
                " ORDER BY cd.r_datetime DESC";
        $params = array(intval($c_member_id));
        $lst = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($lst as $key=>$value) {
            $lst[$key]['count_comments'] = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
            $lst[$key]['c_member'] = db_common_c_member4c_member_id($value['c_member_id']);
        }

        $sql = "SELECT count(*) FROM {$from} WHERE {$where}";
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

        return array($lst, $prev, $next, $total_num);
    }
}

?>

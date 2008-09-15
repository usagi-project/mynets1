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
 *             [2007/02/28] Tabele Prefix
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */
if (! function_exists('p_h_bookmark_list'))
{
    function p_h_bookmark_list($c_member_id, $page, $page_size)
    {
        $sql = 'SELECT c_member_id, nickname, image_filename, access_date' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_bookmark INNER JOIN ' . MYNETS_PREFIX_NAME . 'c_member' .
            ' ON ' . MYNETS_PREFIX_NAME . 'c_bookmark.c_member_id_to = ' . MYNETS_PREFIX_NAME . 'c_member.c_member_id' .
            ' WHERE ' . MYNETS_PREFIX_NAME . 'c_bookmark.c_member_id_from = ?' .
            ' ORDER BY ' . MYNETS_PREFIX_NAME . 'c_bookmark.r_datetime DESC';
        $params = array(intval($c_member_id));
        $lst = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($lst as $key => $value) {
            $lst[$key]['profile'] = db_common_c_member_profile_list4c_member_id($value['c_member_id']);
            $lst[$key]['last_login'] = p_f_home_last_login4access_date($value['access_date']);
        }

        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_bookmark INNER JOIN ' . MYNETS_PREFIX_NAME . 'c_member' .
            ' ON ' . MYNETS_PREFIX_NAME . 'c_bookmark.c_member_id_to = ' . MYNETS_PREFIX_NAME . 'c_member.c_member_id' .
            ' WHERE ' . MYNETS_PREFIX_NAME . 'c_bookmark.c_member_id_from = ?';
        $total_num = db_get_one($sql, $params);

        if ($total_num === 0) {
            $prev = $next = false;
        } else {
            $total_page_num =  ceil($total_num / $page_size);
            $next = ($page < $total_page_num) ? true : false;
            $prev = ($page > 1) ? true : false;
        }

        return array($lst, $prev, $next, $total_num);
    }
}
if (! function_exists('db_bookmark_is_bookmark'))
{
    function db_bookmark_is_bookmark($c_member_id_from, $c_member_id_to)
    {
        $sql = 'SELECT c_bookmark_id FROM ' . MYNETS_PREFIX_NAME . 'c_bookmark' .
                ' WHERE c_member_id_from = ? AND c_member_id_to = ?';
        $params = array(intval($c_member_id_from), intval($c_member_id_to));
        return (bool)db_get_one($sql, $params);
    }
}

/**
 * お気に入りのメンバーIDリスト取得
 *
 * @param  int $c_member_id
 * @param  bool $block  アクセスブロックしているメンバーを除外するかどうか
 * @return array  お気に入りのメンバーID配列
 */
if (! function_exists('db_bookmark_c_member_id_list'))
{
    function db_bookmark_c_member_id_list($c_member_id_from, $block = false)
    {
        $sql = 'SELECT c_member_id_to FROM ' . MYNETS_PREFIX_NAME . 'c_bookmark WHERE c_member_id_from = ? ORDER BY c_bookmark_id';
        $params = array(intval($c_member_id_from));
        $list = db_get_col($sql, $params);
        if ($block) {
            $block_list = db_member_access_block_list4c_member_id_to($c_member_id_from);
            $list = array_diff($list, $block_list);
        }
        return $list;
    }
}


//ここのSQLは負荷対策のために要調整

/**
 * お気に入りメンバーの日記リスト
 * 2007-12-29 chg 外部公開日記を表示させる
 */
if (! function_exists('db_bookmark_diary_list'))
{
    function db_bookmark_diary_list($c_member_id, $limit)
    {
        $bookmarks = db_bookmark_c_member_id_list($c_member_id, true);
        $ids = implode(',', array_map('intval', $bookmarks));

        $sql = 'SELECT '
             . MYNETS_PREFIX_NAME . 'c_diary.* '
          . 'FROM '
             . MYNETS_PREFIX_NAME . 'c_diary, '
             . MYNETS_PREFIX_NAME . 'c_member '
          . 'WHERE '
             . MYNETS_PREFIX_NAME . 'c_diary.c_member_id '
             . 'IN ('.$ids.') '
          . 'AND '
             . '( '
                . '(' . MYNETS_PREFIX_NAME . 'c_diary.public_flag = \'public\') '
                . 'OR (' . MYNETS_PREFIX_NAME . 'c_diary.public_flag = \'open\' '
                    //日記が公開または外部公開のデータのみを抽出へ変更
                    //2007-12-28 kunitsuji
                    //. 'AND '
                    //    . MYNETS_PREFIX_NAME . 'c_member.public_flag_diary in (\'public\',\'open\') '
                    . ') '
             . ') '
          . 'AND '
             . MYNETS_PREFIX_NAME . 'c_diary.c_member_id=' . MYNETS_PREFIX_NAME . 'c_member.c_member_id '
          . 'ORDER BY r_datetime DESC';

        $diary_list = db_get_all_limit($sql, 0, intval($limit));

        foreach ($diary_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $diary_list[$key]['nickname'] = $c_member['nickname'];
            $diary_list[$key]['count_comments'] = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
        }
        return $diary_list;
    }
}

/**
 * お気に入りメンバーのBlogリスト
 */
if (! function_exists('db_bookmark_blog_list'))
{
    function db_bookmark_blog_list($c_member_id, $limit)
    {
        $bookmarks = db_bookmark_c_member_id_list($c_member_id, true);
        $ids = implode(',', array_map('intval', $bookmarks));

        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache WHERE c_member_id IN (' . $ids . ') ORDER BY r_datetime DESC';
        $blog_list = db_get_all_limit($sql, 0, intval($limit));

        foreach ($blog_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $blog_list[$key]['nickname'] = $c_member['nickname'];
        }
        return $blog_list;
    }
}

//ここのSQLは負荷対策のために要調整

/**
 * お気に入りメンバーの日記リスト（ページャ付き）
 */
if (! function_exists('db_bookmark_diary_list_with_pager'))
{
    function db_bookmark_diary_list_with_pager($c_member_id, $page_size, $page)
    {
        $bookmarks = db_bookmark_c_member_id_list($c_member_id, true);
        $ids = implode(',', array_map('intval', $bookmarks));

        $sql = 'SELECT '
                    . MYNETS_PREFIX_NAME . 'c_diary.* '
             . 'FROM '
                    . MYNETS_PREFIX_NAME . 'c_diary, '
                    . MYNETS_PREFIX_NAME . 'c_member '
             . 'WHERE '
                    . MYNETS_PREFIX_NAME . 'c_diary.c_member_id IN ('.$ids.') '
             . 'AND ((' . MYNETS_PREFIX_NAME . 'c_diary.public_flag = \'public\') '
                    . 'OR (' . MYNETS_PREFIX_NAME . 'c_diary.public_flag = \'default\' '
                    . 'AND ' . MYNETS_PREFIX_NAME . 'c_member.public_flag_diary in (\'public\',\'open\'))) '
                    . 'AND ' . MYNETS_PREFIX_NAME . 'c_diary.c_member_id=' . MYNETS_PREFIX_NAME . 'c_member.c_member_id '
             . 'ORDER BY r_datetime DESC';

        $diary_list = db_get_all_page($sql, intval($page), intval($page_size));
        foreach ($diary_list as $key => $value) {
            $diary_list[$key]['c_member'] = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $diary_list[$key]['count_comments'] = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
        }

        $sql = 'SELECT count(*) FROM ' . MYNETS_PREFIX_NAME . 'c_diary WHERE c_member_id IN (' . $ids . ')';
        $total_num = db_get_one($sql);

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
        return array($diary_list, $prev, $next, $total_num);
    }
}

/**
 * お気に入りメンバーリスト
 */
if (! function_exists('db_bookmark_member_list'))
{
    function db_bookmark_member_list($c_member_id, $limit = 0)
    {
        $sql = 'SELECT c_member_id_to AS c_member_id FROM ' . MYNETS_PREFIX_NAME . 'c_bookmark' .
            ' WHERE c_member_id_from = ? ORDER BY RAND()';
        $params = array(intval($c_member_id));

        if ($limit) {
            $result = db_get_all_limit($sql, 0, intval($limit), $params);
        } else {
            $result = db_get_all($sql, $params);
        }

        foreach ($result as $key => $value) {
            $result[$key] = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $result[$key]['friend_count'] = db_friend_count_friends($value['c_member_id']);
        }
        return $result;
    }
}

/**
 * お気に入りのメンバー数
 */
if (! function_exists('db_bookmark_count'))
{
    function db_bookmark_count($c_member_id)
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_bookmark WHERE c_member_id_from = ?';
        $params = array(intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

?>

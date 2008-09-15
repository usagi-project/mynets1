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

//dengon用追加修正 KT

/**
 * 伝言板のコメントリストを得る
 *
 * @param   int $c_member_id_from
 * @param   int $limit
 * @return  array dengonコメント＋ニックネーム
 */
if (! function_exists('db_dengon_get_c_dengon_comment_list4c_member_id_to'))
{
    function db_dengon_get_c_dengon_comment_list4c_member_id_to($c_member_id_to)
    {
        $sql = "SELECT "
                    . MYNETS_PREFIX_NAME . "c_member.nickname, "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment.* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "LEFT JOIN "
                    . MYNETS_PREFIX_NAME . "c_member "
             . "ON "
                    . MYNETS_PREFIX_NAME . "c_member.c_member_id = "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment.c_member_id_from "
             . "WHERE "
                    . "c_member_id_to = ? "
             . "ORDER BY "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment.r_datetime DESC ";
            // ' ORDER BY c_diary_comment.r_datetime';
        return db_get_all($sql, array(intval($c_member_id_to)));
    }
}

/**
 * dengonのコメントリスト（好きなID(複数)）を取得
 *
 * @param   array $id_list
 * @param   int   $page
 * @param   int   $page_size
 * @param   bool  $desc  並び順を日時の新しい順にするかどうか
 * @return  dengonコメント（＋ニックネーム）リスト
 */
if (! function_exists('db_dengon_get_c_dengon_comment_list4id_list'))
{
    function db_dengon_get_c_dengon_comment_list4id_list($id_list, $page = 1, $page_size= -1, $desc = false)
    {
        if (!count($id_list)) return array();
        if ($page_size < 0) {
            $page_size = count($id_list);
        }
        $e_id_list = implode(',', array_map('intval', (array)$id_list));

        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "WHERE "
                    . "c_dengon_comment_id IN (" . $e_id_list . ") ";
        if ($desc) {
            $sql .= "ORDER BY r_datetime DESC ";
        } else {
            $sql .= "ORDER BY r_datetime DESC ";
        }
        $c_dengon_comment_list = db_get_all_page($sql, $page, $page_size);
        foreach ($c_dengon_comment_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $c_dengon_comment_list[$key]['image_filename'] = $c_member['image_filename'];
            $c_dengon_comment_list[$key]['nickname'] = $c_member['nickname'];
        }

        $sql = "SELECT "
                    . "COUNT(*) "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "WHERE "
                    . "c_dengon_comment_id IN (" . $e_id_list . ") ";
        $total_num = db_get_one($sql);

        if($total_num != 0){
            $total_page_num =  ceil($total_num / $page_size);
            if($page >= $total_page_num){
                $next = false;
            }else{
                $next = true;
            }

            if($page <= 1){
                $prev = false;
            }else{
                $prev = true;
            }
        }

        return array($c_dengon_comment_list, $prev , $next, $total_num);
    }
}

////


/**
 * dengonコメント情報をIDから取得
 *
 * @param   int $c_dengon_comment_id
 * @return array
 *              c_dengon_comemnt.*
 *              c_dengon.c_member_id_from AS c_member_id_author
 */
if (! function_exists('do_c_dengon_comment4c_dengon_comment_id'))
{
    function do_c_dengon_comment4c_dengon_comment_id($c_dengon_comment_id)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_dengon_comment ";
        $sql .= " WHERE c_dengon_comment_id = ?";
        $params = array(intval($c_dengon_comment_id));

        return db_get_all($sql, $params);
    }
}

/**
 * ターゲットメンバの最新dengonのリストを返す
 */

if (! function_exists('k_p_f_home_c_dengon_list4c_member_id_to'))
{
    function k_p_f_home_c_dengon_list4c_member_id_to($c_member_id_to, $limit)
    {
        $sql = "SELECT * ";
        $sql .= " FROM " . MYNETS_PREFIX_NAME . "c_dengon_comment";
        $sql .= " WHERE c_member_id_to = ?";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id_to));
        $c_diary_list = db_get_all_limit($sql, 0, $limit, $params);

        return $c_diary_list;
    }
}



/**
 * 伝言板コメントリストを取得。
 */
if (! function_exists('k_p_fh_dengon_c_dengon_comment_list4c_member_id_to'))
{
    function k_p_fh_dengon_c_dengon_comment_list4c_member_id_to($c_member_id_to, $page_size, $page)
    {
        $next = false;
        $prev = false;
        $total_page_num = 0;

        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "WHERE "
                    . "c_member_id_to = ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($c_member_id_to));
        $c_dengon_comment_list = db_get_all_page($sql, $page, $page_size, $params);

        //コメントを、新しいものを上にしてページ遷移可能とする
        $c_dengon_comment_list = array_reverse($c_dengon_comment_list);
        foreach($c_dengon_comment_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $c_dengon_comment_list[$key]['nickname'] = $c_member['nickname'];
        $c_dengon_comment_list[$key]['image_filename'] = $c_member['image_filename'];
        }

        $sql = "SELECT "
                    . "COUNT(*) "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "WHERE "
                    . "c_member_id_to = ? ";
        $params = array(intval($c_member_id_to));
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
        return array($c_dengon_comment_list , $prev , $next, $total_num, $total_page_num);
    }
}


/**
 * 自分がつけた伝言板コメントリストを取得
 */
if (! function_exists('k_p_fh_dengon_c_dengon_comment_list4c_member_id_from'))
{
    function k_p_fh_dengon_c_dengon_comment_list4c_member_id_from($c_member_id_from, $page_size, $page)
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "WHERE "
                    . "c_member_id_from = ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($c_member_id_from));
        $c_dengon_comment_list = db_get_all_page($sql, $page, $page_size, $params);

        $c_dengon_comment_list = array_reverse($c_dengon_comment_list);
        foreach($c_dengon_comment_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            $c_dengon_comment_list[$key]['nickname'] = $c_member['nickname'];
            $c_dengon_comment_list[$key]['image_filename'] = $c_member['image_filename'];
        }

        $sql = "SELECT "
                    . "COUNT(*) "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "WHERE "
                    . "c_member_id_from = ? ";
        $params = array(intval($c_member_id_from));
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
        return array($c_dengon_comment_list , $prev , $next, $total_num, $total_page_num);
    }
}


/**
 * 伝言板持主のＩＤからそのコメントを書いたメンバＩＤとニックネームを得る
 */

if (! function_exists('k_p_fh_dengon_c_member4c_member_id_to'))
{
    function k_p_fh_dengon_c_member4c_member_id_to($c_member_id_to)
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_dengon_comment "
             . "WHERE "
                    . "c_member_id_to = ? ";
        $params = array(intval($c_member_id_to));
        $item = db_get_row($sql, $params);

        foreach($item as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            $item[$key]['nickname'] = $c_member['nickname'];
            $item[$key]['c_member_id'] = $value['c_member_id_from'];
        }

        return $item;
    }
}


?>

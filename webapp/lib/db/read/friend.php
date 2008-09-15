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
 * あるメンバーの友達数を取得
 *
 * @param int $c_member_id
 * @return int 友達数
 */
if (! function_exists('db_friend_count_friends'))
{
    function db_friend_count_friends($c_member_id)
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_friend WHERE c_member_id_from = ?';
        $params = array(intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

/**
 * 友達かどうか判定
 *
 * @param  int $c_member_id1
 * @param  int $c_member_id2
 * @return bool
 */
if (! function_exists('db_friend_is_friend'))
{
    function db_friend_is_friend($c_member_id1, $c_member_id2)
    {
        $sql = 'SELECT c_friend_id FROM ' . MYNETS_PREFIX_NAME . 'c_friend' .
                ' WHERE c_member_id_from = ? AND c_member_id_to = ?';
        $params = array(intval($c_member_id1), intval($c_member_id2));
        return (bool)db_get_one($sql, $params);
    }
}

/**
 * 友達のメンバーIDリスト取得
 *
 * @param  int $c_member_id
 * @param  bool $except_blocked アクセスブロックされているメンバーを除外するか
 * @return array  友達のメンバーID配列
 */
if (! function_exists('db_friend_c_member_id_list'))
{
    function db_friend_c_member_id_list($c_member_id, $except_blocked = false)
    {
        $sql = "SELECT "
                    . "c_member_id_to "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_friend "
             . "WHERE "
                    . "c_member_id_from = ? "
             . "ORDER BY "
                    . "c_friend_id ";
        $params = array(intval($c_member_id));
        $friends = db_get_col($sql, $params);

        if ($except_blocked) {
            $blocked = db_member_access_block_list4c_member_id_to($c_member_id);
            $friends = array_diff($friends, $blocked);
        }
        return $friends;
    }
}

/**
 * 紹介文を取得
 */
if (! function_exists('p_f_home_c_friend_intro'))
{
    function p_f_home_c_friend_intro($c_member_id_from, $c_member_id_to)
    {
        $sql = "SELECT "
                    . "intro "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_friend "
             . "WHERE "
                    . "c_member_id_from = ? "
             . "AND "
                    . "c_member_id_to = ? ";
        $params = array(intval($c_member_id_from), intval($c_member_id_to));
        return db_get_one($sql, $params);
    }
}

/**
 * メンバーと自分の中間のフレンドを得る
 */
if (! function_exists('p_f_home_friend_path4c_member_ids'))
{
    function p_f_home_friend_path4c_member_ids($my_id, $target_id)
    {
        if (db_friend_is_friend($my_id, $target_id)) {
            return null;
        }

        //自分の友達リスト
        $my_list = db_friend_c_member_id_list($my_id);

        //相手の友達リスト
        $target_list = db_friend_c_member_id_list($target_id);

        //共通の友達リスト
        $result_list = array_intersect($my_list, $target_list);
        if (!$result_list) {
            return null;
        }

        $result_key = array_rand($result_list);
        $result_id  = $result_list[$result_key];

        return db_common_c_member4c_member_id($result_id);
    }
}

/**
 * 自分のフレンドのうち、対象のメンバーと
 * フレンドリンクしていないフレンドのリストを取得
 */
if (! function_exists('p_f_invite_invite_list4c_member_ids'))
{
    function p_f_invite_invite_list4c_member_ids($target_c_member_id, $u)
    {
        // 自分の友達リスト
        $my_list = db_friend_c_member_id_list($u);

        // ターゲットの友達リスト
        $target_list = db_friend_c_member_id_list($target_c_member_id);
        $target_list[] = $target_c_member_id;

        // 自分の友達リストからターゲットの友達を引く
        $result = array_diff($my_list, $target_list);

        $list = array();
        foreach ($result as $value) {
            $list[] = db_common_c_member4c_member_id_LIGHT($value);
        }
        return $list;
    }
}

//---

if (! function_exists('p_fh_friend_list_friend_list4c_member_id2'))
{
    function p_fh_friend_list_friend_list4c_member_id2($c_member_id, $page_size, $page, $orderby)
    {
        switch ($orderby) {
        case "ld":
            $orderby = "m.access_date DESC";
            break;
        case "la":
            $orderby = "m.access_date";
            break;
        case "rd":
            $orderby = "f.r_datetime DESC";
            break;
        case "ra":
            $orderby = "f.r_datetime";
            break;
        default:
            $orderby = "f.r_datetime DESC";
        }
        $sql = "SELECT" .
              " m.c_member_id, m.access_date, m.nickname, m.image_filename" .
              ", f.intro, f.r_datetime" .
              " FROM " . MYNETS_PREFIX_NAME . "c_member AS m, " . MYNETS_PREFIX_NAME . "c_friend AS f" .
              " WHERE f.c_member_id_from = ?" .
              " AND f.c_member_id_to = m.c_member_id" .
              " ORDER BY ". $orderby;
        $params = array(intval($c_member_id));
        $friend_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($friend_list as $key => $value) {
            $friend_list[$key]['friend_count'] = db_friend_count_friends($value['c_member_id']);
        }

        $total_num = db_friend_count_friends($c_member_id);
        $total_page_num =  ceil($total_num / $page_size);

        $next = ($page < $total_page_num);
        $prev = ($page > 1);

        return array($friend_list , $prev , $next, $total_page_num);
    }
}

if (! function_exists('p_fh_intro_intro_list4c_member_id'))
{
    function p_fh_intro_intro_list4c_member_id($c_member_id)
    {
        $sql = "SELECT c_member_id_from AS c_member_id, intro FROM " . MYNETS_PREFIX_NAME . "c_friend" .
                " WHERE c_member_id_to = ? AND intro <> ''" .
                " ORDER BY r_datetime_intro DESC";
        $params = array(intval($c_member_id));

        $list = db_get_all($sql, $params);
        foreach ($list as $key => $value) {
            $list[$key] += db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        }
        return $list;
    }
}

if (! function_exists('p_fh_intro_intro_list_with_my_intro4c_member_id'))
{
    function p_fh_intro_intro_list_with_my_intro4c_member_id($c_member_id)
    {
        $list = p_fh_intro_intro_list4c_member_id($c_member_id);
        $sql = "SELECT "
                    . "intro "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_friend "
             . "WHERE "
                    . "c_member_id_from = ? "
             . "AND "
                    . "c_member_id_to = ? ";
        foreach ($list as $key => $value) {
            $params = array(intval($c_member_id), intval($value['c_member_id']));
            $list[$key]['has_intro_by_me'] = (db_get_one($sql, $params) !== '');
        }
        return $list;
    }
}

/**
 * フレンドからの紹介文リスト
 */
if (! function_exists('p_f_home_c_friend_comment4c_member_id'))
{
    function p_f_home_c_friend_comment4c_member_id($c_member_id, $limit = 5)
    {
        $sql = "SELECT c_member_id_from AS c_member_id, intro FROM " . MYNETS_PREFIX_NAME . "c_friend" .
                " WHERE c_member_id_to = ? AND intro <> ''" .
                " ORDER BY r_datetime_intro DESC";
        $params = array(intval($c_member_id));

        $list = db_get_all_limit($sql, 0, $limit, $params);
        foreach ($list as $key => $value) {
            $list[$key] += db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        }
        return $list;
    }
}

/**
 * c_friend取得
 */
if (! function_exists('p_common_c_friend4c_member_id_from4c_member_id_to'))
{
    function p_common_c_friend4c_member_id_from4c_member_id_to($c_member_id_from,$c_member_id_to)
    {
        $sql =  "SELECT c_friend_id,".
                    "c_member_id_from,".
                    "c_member_id_to,".
                    "intro,".
                    "r_datetime".
                " FROM " . MYNETS_PREFIX_NAME . "c_friend".
                " WHERE c_member_id_from = ?" .
                    " AND c_member_id_to = ?" .
                    " AND intro <> ''";
        $params = array(intval($c_member_id_from), intval($c_member_id_to));
        return db_get_row($sql, $params);
    }
}

/**
 * フレンドリスト
 */
if (! function_exists('p_f_home_c_friend_list4c_member_id'))
{
    function p_f_home_c_friend_list4c_member_id($c_member_id, $limit = 0)
    {
        $sql = 'SELECT c_member_id_to AS c_member_id FROM ' . MYNETS_PREFIX_NAME . 'c_friend' .
                ' WHERE c_member_id_from = ? ORDER BY RAND()';
        $params = array(intval($c_member_id));
        if ($limit) {
            $result = db_get_all_limit($sql, 0, $limit, $params);
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
 * フレンドリストNewVersion MyNETS1.1.0 Kunitsuji 2007/05/24
 * フレンドを６件取得。ログイン時間でソートして表示
 */
if (! function_exists('getFriendListAccesstime'))
{
    function getFriendListAccesstime($c_member_id, $limit = 0)
    {
        $sql = 'SELECT a.c_member_id_to AS c_member_id,b.access_date FROM ' . MYNETS_PREFIX_NAME . 'c_friend as a' ;
        $sql .= ' INNER JOIN ' . MYNETS_PREFIX_NAME . 'c_member as b on a.c_member_id_to = b.c_member_id ';
        $sql .= ' WHERE a.c_member_id_from = ? ORDER BY b.access_date DESC';

        $params = array(intval($c_member_id));
        if ($limit) {
            $result = db_get_all_limit($sql, 0, $limit, $params);
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

if (! function_exists('p_f_intro_edit_intro_body4c_member_id'))
{
    function p_f_intro_edit_intro_body4c_member_id($u, $target_c_member_id)
    {
        $sql = "SELECT intro FROM " . MYNETS_PREFIX_NAME . "c_friend" .
                " WHERE c_member_id_to = ? AND c_member_id_from = ?";
        $params = array(intval($target_c_member_id), intval($u));
        return db_get_one($sql, $params);
    }
}

/**
 * あなたにフレンドリンクを要請しているメンバー
 *
 * @param   int $c_member_id_to : 要請されている方(あなた)
 * @return  array_of_array
 *              c_friend_confirm.*
 *              nickname        : 要請している人の名前
 *              image_filename  : 要請している人の画像
 * @see     h_confirm_list.php
 */
if (! function_exists('p_h_confirm_list_anatani_c_friend_confirm_list4c_member_id'))
{
    function p_h_confirm_list_anatani_c_friend_confirm_list4c_member_id($c_member_id_to)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_friend_confirm WHERE c_member_id_to = ?' .
                ' ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id_to));
        $c_friend_confirm_list = db_get_all($sql, $params);

        foreach ($c_friend_confirm_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $c_friend_confirm_list[$key]['nickname'] = $c_member['nickname'];
            $c_friend_confirm_list[$key]['image_filename'] = $c_member['image_filename'];
        }
        return $c_friend_confirm_list;
    }
}

/**
 * あなたがフレンドリンクを要請しているメンバー
 *
 * @param   int $c_member_id_from   : 要請している方(あなた)
 * @return  array_of_array
 *              c_friend_confirm.*
 *              nickname        : 要請されている人の名前
 *              image_filename  : 要請されている人の画像
 * @see     h_confirm_list.php
 */
if (! function_exists('p_h_confirm_list_anataga_c_friend_confirm_list4c_member_id'))
{
    function p_h_confirm_list_anataga_c_friend_confirm_list4c_member_id($c_member_id_from)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_friend_confirm WHERE c_member_id_from = ?' .
                ' ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id_from));
        $c_friend_confirm_list = db_get_all($sql, $params);

        foreach ($c_friend_confirm_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            $c_friend_confirm_list[$key]['nickname'] = $c_member['nickname'];
            $c_friend_confirm_list[$key]['image_filename'] = $c_member['image_filename'];
        }
        return $c_friend_confirm_list;
    }
}

if (! function_exists('p_h_home_c_friend_intro_list4c_member_id'))
{
    function p_h_home_c_friend_intro_list4c_member_id($c_member_id, $limit)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_friend' .
                ' WHERE c_member_id_to = ? AND intro <> \'\' ORDER BY RAND()';
        $params = array(intval($c_member_id));
        $list = db_get_all_limit($sql, 0, $limit, $params);

        foreach ($list as $key => $value) {
            $list[$key] += db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
        }
        return $list;
    }
}

if (! function_exists('p_h_manage_friend_c_friend_list_disp4c_member_id'))
{
    function p_h_manage_friend_c_friend_list_disp4c_member_id($c_member_id)
    {
        $sql =  "SELECT c_member_id,".
                    "image_filename,".
                    "nickname,".
                    "intro,".
                    "c_member_id_from,".
                    "c_member_id_to".
                " FROM " . MYNETS_PREFIX_NAME . "c_member as cm,".
                    MYNETS_PREFIX_NAME . "c_friend as cf".
                " WHERE cm.c_member_id = cf.c_member_id_from".
                    " AND cf.c_member_id_to = ?".
                " ORDER BY cf.r_datetime DESC";
        $params = array(intval($c_member_id));
        $result = db_get_all($sql, $params);

        foreach ($result as $key=>$value) {
            $c_friend = p_common_c_friend4c_member_id_from4c_member_id_to($value['c_member_id_to'], $value['c_member_id_from']);
            $result[$key]['intro'] = $c_friend['intro'];
            $result[$key]['friend_count'] = db_friend_count_friends($value['c_member_id_from']);
        }
        return $result;
    }
}

if (! function_exists('db_common_friend_status'))
{
    function db_common_friend_status($u, $target_c_member_id)
    {
        $ret = array(
            'c_member'      => db_common_c_member4c_member_id($target_c_member_id),
            'is_friend'     => false,
            'is_friend_confirm' => false,
        );

        $ret['is_friend'] = db_friend_is_friend($u, $target_c_member_id);
        $ret['is_friend_confirm'] = do_common_is_friend_link_wait($u, $target_c_member_id);

        return $ret;
    }
}

/**
 * 友達リンク要請情報をIDから取得
 *
 * @param   int $c_friend_confirm_id
 * @return  array c_friend_confirm.*
 */
if (! function_exists('_do_c_friend_confirm4c_friend_confirm_id'))
{
    function _do_c_friend_confirm4c_friend_confirm_id($c_friend_confirm_id)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_friend_confirm WHERE c_friend_confirm_id = ?';
        $params = array(intval($c_friend_confirm_id));
        return db_get_row($sql, $params);
    }
}

if (! function_exists('do_common_is_friend_link_wait'))
{
    function do_common_is_friend_link_wait($c_member_id_from, $c_member_id_to)
    {
        //from→to
        $sql = "SELECT count(*)";
        $sql .= " FROM  " . MYNETS_PREFIX_NAME . "c_friend_confirm";
        $sql .= " WHERE c_member_id_from = ?";
        $sql .= " AND c_member_id_to = ?";
        $params = array(intval($c_member_id_from), intval($c_member_id_to));
        $countA = db_get_one($sql, $params);

        //to→from
        $sql = "SELECT count(*)";
        $sql .= " FROM  " . MYNETS_PREFIX_NAME . "c_friend_confirm";
        $sql .= " WHERE c_member_id_from = ?";
        $sql .= " AND c_member_id_to = ?";
        $params = array(intval($c_member_id_to), intval($c_member_id_from));
        $countB = db_get_one($sql, $params);

        if ($countA || $countB) {
            return true;
        } else {
            return false;
        }
    }
}

//TODO:constant
if ( ! defined('STATUS_F_LINK_FLAT'))
{
    define('STATUS_F_LINK_FLAT', "1");    // フレンドリクエスト(承認送信画面)
}
if ( ! defined('STATUS_F_LINK_WAIT'))
{
    define('STATUS_F_LINK_WAIT', "2");    // フレンドリクエスト(リンク承認待ち)
}
if ( ! defined('STATUS_F_LINK_ALREADY'))
{
    define('STATUS_F_LINK_ALREADY', "3"); // フレンドリクエスト(フレンドリンク済)
}

if (! function_exists('do_common_get_f_link_status'))
{
    function do_common_get_f_link_status($c_member_id_from,$c_member_id_to)
    {
        $is_friend    = db_friend_is_friend($c_member_id_from, $c_member_id_to);
        $is_link_wait = do_common_is_friend_link_wait($c_member_id_from, $c_member_id_to);

        $ret = STATUS_F_LINK_ALREADY;
        if (($is_friend == false) && ($is_link_wait == false)) {
            // 友達でない＆リンク承認待ちでない
            $ret = STATUS_F_LINK_FLAT;
        } elseif (($is_friend == false) && ($is_link_wait == true)) {
            // 友達でない＆リンク承認待ち
            $ret = STATUS_F_LINK_WAIT;
        }

        return $ret;
    }
}

if (! function_exists('do_common_c_friend_list4c_member_id'))
{
    function do_common_c_friend_list4c_member_id($c_member_id)
    {
        $sql = "SELECT cm.* FROM " . MYNETS_PREFIX_NAME . "c_friend as cf, " . MYNETS_PREFIX_NAME . "c_member as cm" .
            " WHERE cf.c_member_id_from = ?".
            " AND cm.c_member_id=cf.c_member_id_to";
        $params = array(intval($c_member_id));
        return db_get_all($sql, $params);
    }
}

/**
 * フレンドのランダムなリストを得る
 */
if (! function_exists('k_p_h_home_c_friend_list_random4c_member_id'))
{
    function k_p_h_home_c_friend_list_random4c_member_id($c_member_id, $limit)
    {
        $sql = "SELECT cf.* , cm.nickname";
        $sql .= " FROM " . MYNETS_PREFIX_NAME . "c_friend AS cf, " . MYNETS_PREFIX_NAME . "c_member AS cm";
        $sql .= " WHERE cf.c_member_id_from = ?" .
                " AND cm.c_member_id=cf.c_member_id_to";
        $sql .= " ORDER BY RAND()";
        $params = array(intval($c_member_id));
        $c_friend_list = db_get_all_limit($sql, 0, $limit, $params);

        foreach ($c_friend_list as $key => $value) {
            $c_friend_list[$key]['count_friend'] = db_friend_count_friends($value['c_member_id_to']);
        }

        return $c_friend_list;
    }
}

/**
 * ２つのメンバＩＤからその２人の関係を返す。
 */
if (! function_exists('k_p_f_home_relationship4two_members'))
{
    function k_p_f_home_relationship4two_members($c_member_id, $target_c_member_id)
    {
        $relation = array(
            'friend' => false,
            'wait'   => false
        );
        // リンク承認待ちかどうかをチェック
        $sql = 'SELECT c_friend_confirm_id FROM ' . MYNETS_PREFIX_NAME . 'c_friend_confirm' .
                ' WHERE c_member_id_from = ? AND c_member_id_to = ?';
        $params = array(intval($c_member_id), intval($target_c_member_id));

        if (db_get_one($sql, $params)) {
            $relation['wait'] = true;
            return $relation;
        }

        // 友達かどうかチェック
        $sql = 'SELECT c_friend_id FROM ' . MYNETS_PREFIX_NAME . 'c_friend' .
                ' WHERE c_member_id_from = ? AND c_member_id_to = ?';

        if (db_get_one($sql, $params)) {
            $relation['friend'] = true;
            return $relation;
        }

        //他人
        return $relation;
    }
}

if (! function_exists('k_p_fh_friend_list_friend_list4c_member_id'))
{
    function k_p_fh_friend_list_friend_list4c_member_id($c_member_id,$page_size,$page)
    {
        $sql = "SELECT ".
                "c_friend_id,".
                "c_member_id_from,".
                "c_member_id_to,".
                "r_datetime".
            " FROM " . MYNETS_PREFIX_NAME . "c_friend".
            " WHERE c_member_id_from = ?".
            " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id));
        $c_friend_list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($c_friend_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id($value['c_member_id_to']);

            $c_friend_list[$key]['image_filename'] = $c_member['image_filename'];
            $c_friend_list[$key]['c_member_id'] = $c_member['c_member_id'];
            $c_friend_list[$key]['nickname'] = $c_member['nickname'];
            $c_friend_list[$key]['access_date'] = $c_member['access_date'];

            $c_friend_list[$key]['friend_count'] = db_friend_count_friends($c_member['c_member_id']);
        }

        $total_num = db_friend_count_friends($c_member_id);

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
        return array($c_friend_list, $prev, $next);
    }
}

/**
 * あなたにフレンドリンクを要請しているメンバー(リンク承認待ち)
 *
 * @param   int $c_member_id_to : 要請されている方(あなた)
 * @return  array_of_array
 *              c_friend_confirm.*
 *              nickname        : 要請している人の名前
 *              message_disp    : 表示用メッセージ
 */
if (! function_exists('k_p_h_confirm_list_anatani_c_friend_confirm_list4c_member_id'))
{
    function k_p_h_confirm_list_anatani_c_friend_confirm_list4c_member_id($c_member_id_to)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_friend_confirm WHERE c_member_id_to = ?";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id_to));
        $c_friend_confirm_list = db_get_all($sql, $params);

        foreach ($c_friend_confirm_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $c_friend_confirm_list[$key]['nickname'] = $c_member['nickname'];
        }
        return $c_friend_confirm_list;
    }
}

/**
 * あなたがフレンドリンクを要請しているメンバー(リンク要請中)
 *
 * @param   int $c_member_id_from   : 要請している方(あなた)
 * @return  array_of_array
 *              c_friend_confirm.*
 *              nickname        : 要請されている人の名前
 *              message_disp    : 表示用メッセージ
 */
if (! function_exists('k_p_h_confirm_list_anataga_c_friend_confirm_list4c_member_id'))
{
    function k_p_h_confirm_list_anataga_c_friend_confirm_list4c_member_id($c_member_id_from)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_friend_confirm WHERE c_member_id_from = ?";
        $sql .= " ORDER BY r_datetime DESC";
        $params = array(intval($c_member_id_from));
        $c_friend_confirm_list = db_get_all($sql, $params);

        foreach ($c_friend_confirm_list as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_to']);
            $c_friend_confirm_list[$key]['nickname'] = $c_member['nickname'];
        }
        return $c_friend_confirm_list;
    }
}

/**
 * 友達ランダム５０人
 */
if (! function_exists('k_p_h_message_send_c_friend_list_random4c_member_id'))
{
    function k_p_h_message_send_c_friend_list_random4c_member_id($c_member_id)
    {
        $sql = "SELECT cf.c_member_id_to, cm.nickname";
        $sql .= " FROM " . MYNETS_PREFIX_NAME . "c_friend AS cf, " . MYNETS_PREFIX_NAME . "c_member AS cm";
        $sql .= " WHERE cf.c_member_id_from = ?".
                " AND cf.c_member_id_to = cm.c_member_id";
        $sql .= " ORDER BY RAND()";
        $params = array(intval($c_member_id));
        return db_get_all_limit($sql, 0, 50, $params);
    }
}

if (! function_exists('p_fh_intro_list4c_friend_comment_list'))
{
    function p_fh_intro_list4c_friend_comment_list($c_friend_comment_list, $page, $page_size)
    {
        $lst = array_slice($c_friend_comment_list, ($page - 1) * $page_size, $page_size);
        $total_num = count($c_friend_comment_list);

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

?>

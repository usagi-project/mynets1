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


if (! function_exists('db_review_c_review_list4member'))
{
    function db_review_c_review_list4member($c_member_id, $count = 10)
    {
        $sql = 'SELECT rev.c_review_id, rev.title, com.r_datetime' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_review_comment AS com '
            .'LEFT JOIN ' . MYNETS_PREFIX_NAME . 'c_review AS rev USING(c_review_id)' .
            ' WHERE com.c_member_id = ? ORDER BY com.r_datetime DESC';
        $params = array(intval($c_member_id));
        return db_get_all_limit($sql, 0, $count, $params);
    }
}

if (! function_exists('p_h_home_c_friend_review_list4c_member_id'))
{
    function p_h_home_c_friend_review_list4c_member_id($c_member_id, $limit)
    {
        $friends = db_friend_c_member_id_list($c_member_id);
        $ids = implode(',', array_map('intval', $friends));
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_review '
                . 'INNER JOIN ' . MYNETS_PREFIX_NAME . 'c_review_comment USING (c_review_id)' .
                ' WHERE ' . MYNETS_PREFIX_NAME . 'c_review_comment.c_member_id IN ('.$ids.')' .
                ' ORDER BY ' . MYNETS_PREFIX_NAME . 'c_review_comment.r_datetime DESC';
        $list = db_get_all_limit($sql, 0, $limit);
        foreach ($list as $key => $value) {
            $list[$key] += db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
        }
        return $list;
    }
}

if (! function_exists('p_h_home_c_friend_review_list_more4c_member_id'))
{
    function p_h_home_c_friend_review_list_more4c_member_id($c_member_id, $page, $page_size)
    {
        $sql =  "SELECT cm.nickname, cr.c_review_id, cr.title, crc.r_datetime" .
                " FROM  " . MYNETS_PREFIX_NAME . "c_member AS cm, "
                          . MYNETS_PREFIX_NAME . "c_friend AS cf, "
                          . MYNETS_PREFIX_NAME . "c_review AS cr, "
                          . MYNETS_PREFIX_NAME . "c_review_comment AS crc" .
                " WHERE cr.c_review_id = crc.c_review_id " .
                " AND cf.c_member_id_to = crc.c_member_id " .
                " AND cf.c_member_id_to = cm.c_member_id " .
                " AND cf.c_member_id_from = ?".
                " ORDER BY crc.r_datetime DESC";
        $params = array(intval($c_member_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);

        $sql =  "SELECT COUNT(*)" .
                " FROM  " . MYNETS_PREFIX_NAME . "c_friend AS cf, " . MYNETS_PREFIX_NAME . "c_review_comment AS crc" .
                " WHERE cf.c_member_id_to = crc.c_member_id" .
                " AND cf.c_member_id_from = ?";
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

        $start_num = ($page - 1) * $page_size + 1 ;
        $end_num   = ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

        return array($list, $prev, $next, $total_num, $start_num, $end_num);
    }
}

if (! function_exists('p_c_home_new_commu_review4c_commu_id'))
{
    function p_c_home_new_commu_review4c_commu_id($c_commu_id , $limit)
    {
        $sql = "SELECT ccr.c_review_id, cr.title, ccr.r_datetime" .
                " FROM " . MYNETS_PREFIX_NAME . "c_commu_review AS ccr , "
                         . MYNETS_PREFIX_NAME . "c_review AS cr" .
                " WHERE ccr.c_review_id = cr.c_review_id" .
                " AND ccr.c_commu_id = ?".
                " ORDER BY ccr.r_datetime DESC";
        $params = array(intval($c_commu_id));
        return db_get_all_limit($sql, 0, $limit, $params);
    }
}

if (! function_exists('p_h_review_add_category_disp'))
{
    function p_h_review_add_category_disp()
    {
        $sql = 'SELECT c_review_category_id, category_disp FROM ' . MYNETS_PREFIX_NAME . 'c_review_category';
        return db_get_assoc($sql);
    }
}

if (! function_exists('p_h_review_add_search_result'))
{
    function p_h_review_add_search_result($keyword, $category_id, $page)
    {
        $sql = 'SELECT category FROM ' . MYNETS_PREFIX_NAME . 'c_review_category WHERE c_review_category_id = ?';
        $params = array(intval($category_id));
        if (!$category = db_get_one($sql, $params)) {
            return null;
        }

        include_once 'Services/AmazonECS4.php';
        $amazon =& new Services_AmazonECS4(AMAZON_TOKEN, AMAZON_AFFID);
        $amazon->setLocale(AMAZON_LOCALE);
        $amazon->setBaseUrl(AMAZON_BASEURL);
        /*
        if (OPENPNE_USE_HTTP_PROXY) {
            $amazon->setProxy(OPENPNE_HTTP_PROXY_HOST, OPENPNE_HTTP_PROXY_PORT);
        }
        */
        $options = array(
            'Keywords' => $keyword,
            'ItemPage' => $page,
            'ResponseGroup' => 'Large',
        );
        $products = $amazon->ItemSearch($category, $options);

        if (PEAR::isError($products)) {
            return null;
        }
        if (empty($products['Request']['IsValid']) || $products['Request']['IsValid'] !== 'True') {
            return null;
        }

        foreach ($products['Item'] as $key => $value) {
            if (is_array($value['ItemAttributes']['Author'])) {
                $authors = array_unique($value['ItemAttributes']['Author']);
                $products['Item'][$key]['author'] = implode(', ', $authors);
            }
            if (is_array($value['ItemAttributes']['Aritst'])) {
                $artists = array_unique($value['ItemAttributes']['Artist']);
                $products['Item'][$key]['artist'] = implode(', ', $artists);
            }
        }

        $product_page = $products['Request']['ItemSearchRequest']['ItemPage'];
        $product_pages = $products['TotalPages'];
        $total_num = $products['TotalResults'];

        return array($products['Item'], $product_page, $product_pages, $total_num);
    }
}

if (! function_exists('p_h_review_write_product4asin'))
{
    function p_h_review_write_product4asin($asin)
    {
        include_once 'Services/AmazonECS4.php';
        $amazon =& new Services_AmazonECS4(AMAZON_TOKEN, AMAZON_AFFID);
        $amazon->setLocale(AMAZON_LOCALE);
        $amazon->setBaseUrl(AMAZON_BASEURL);
        /*
        if (OPENPNE_USE_HTTP_PROXY) {
            $amazon->setProxy(OPENPNE_HTTP_PROXY_HOST, OPENPNE_HTTP_PROXY_PORT);
        }
        */
        $keyword = mb_convert_encoding($keyword, "UTF-8", "auto");

        $options = array();
        $options['ResponseGroup'] = 'Large';
        $result = $amazon->ItemLookup($asin, $options);
        if (PEAR::isError($result)) {
            return false;
        }
        if (empty($result['Request']['IsValid']) || $result['Request']['IsValid'] !== 'True') {
            return null;
        }

        $product  = $result['Item'][0];
        if (is_array($product['ItemAttributes']['Author'])) {
            $authors = array_unique($product['ItemAttributes']['Author']);
            $product['author'] = implode(', ', $authors);
        }
        if (is_array($product['ItemAttributes']['Aritst'])) {
            $artists = array_unique($product['ItemAttributes']['Artist']);
            $product['artist'] = implode(', ', $artists);
        }

        return $product;
    }
}

/**
 * orderby:
 *      r_datetime  => 作成順
 *      r_num       => 登録数順
 */
if (! function_exists('p_h_review_search_result4keyword_category'))
{
    function p_h_review_search_result4keyword_category($keyword, $category_id , $orderby, $page = 1, $page_size = 30)
    {
        $from = " FROM " . MYNETS_PREFIX_NAME . "c_review INNER JOIN "
                         . MYNETS_PREFIX_NAME . "c_review_comment USING (c_review_id)";

        $where = ' WHERE 1';
        $params = array();
        if ($keyword) {
            $where .= ' AND ' . MYNETS_PREFIX_NAME . 'c_review.title LIKE ?';
            $params[] = '%'.check_search_word($keyword).'%';
        }
        if ($category_id) {
            $where .= ' AND ' . MYNETS_PREFIX_NAME . 'c_review.c_review_category_id = ?';
            $params[] = intval($category_id);
        }

        switch ($orderby) {
        case "r_datetime":
        default:
            $order = " ORDER BY r_datetime DESC";
            break;
        case "r_num":
            $order = " ORDER BY write_num DESC, r_datetime DESC";
            break;
        }

        $sql = "SELECT " . MYNETS_PREFIX_NAME . "c_review.*" .
                ", MAX(" . MYNETS_PREFIX_NAME . "c_review_comment.r_datetime) as r_datetime" .
                ", COUNT(" . MYNETS_PREFIX_NAME . "c_review_comment.c_review_comment_id) AS write_num" .
            $from .
            $where .
            " GROUP BY " . MYNETS_PREFIX_NAME . "c_review.c_review_id" .
            $order;

        $lst = db_get_all_page($sql, $page, $page_size, $params);

        //$lstに書き込み数を追加 + レビュー書き込み内容と日付を追加
        foreach ($lst as $key => $value) {
            $sql = "SELECT body FROM " . MYNETS_PREFIX_NAME . "c_review_comment" .
                " WHERE c_review_id = ?" .
                " ORDER BY r_datetime DESC";
            $p2 = array(intval($value['c_review_id']));
            $lst[$key]['body'] = db_get_one($sql, $p2);
        }

        $sql = "SELECT COUNT(DISTINCT " . MYNETS_PREFIX_NAME . "c_review.c_review_id)" . $from . $where;
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

        $start_num = ($page - 1) * $page_size + 1 ;
        $end_num   = ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

        return array($lst, $prev, $next, $total_num, $start_num, $end_num);
    }
}

if (! function_exists('p_h_review_list_product_c_review4c_review_id'))
{
    function p_h_review_list_product_c_review4c_review_id($c_review_id)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_review AS cr, '
                                . MYNETS_PREFIX_NAME . 'c_review_category AS crc' .
               ' WHERE cr.c_review_category_id = crc.c_review_category_id' .
               ' AND c_review_id = ?';
        $params = array(intval($c_review_id));
        return db_get_row($sql, $params);
    }
}

if (! function_exists('p_h_review_list_product_c_review_list4c_review_id'))
{
    function p_h_review_list_product_c_review_list4c_review_id($c_review_id, $page, $page_size=30)
    {
        $sql = "SELECT crc.*, cm.c_member_id, cm.nickname, cm.image_filename" .
               " FROM " . MYNETS_PREFIX_NAME . "c_review_comment AS crc, " . MYNETS_PREFIX_NAME . "c_member AS cm" .
               " WHERE crc.c_member_id = cm.c_member_id" .
               " AND c_review_id = ?" .
               " ORDER BY r_datetime desc";
        $params = array(intval($c_review_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);

        $total_num = do_common_count_c_review_comment4c_review_id($c_review_id);
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

        $start_num = ($page - 1) * $page_size + 1 ;
        $end_num   = ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

        return array($list, $prev, $next, $total_num, $start_num, $end_num);
    }
}

if (! function_exists('p_fh_review_list_product_c_review_list4c_member_id'))
{
    function p_fh_review_list_product_c_review_list4c_member_id($c_member_id, $page, $page_size=30)
    {
        $sql = "SELECT crc.*, cr.*, crc2.category_disp" .
                " FROM " . MYNETS_PREFIX_NAME . "c_review_comment AS crc, "
                         . MYNETS_PREFIX_NAME . "c_review AS cr, "
                         . MYNETS_PREFIX_NAME . "c_review_category AS crc2" .
                " WHERE crc.c_review_id = cr.c_review_id" .
                " AND cr.c_review_category_id = crc2.c_review_category_id" .
                " AND crc.c_member_id = ?" .
                " ORDER BY crc.r_datetime DESC";
        $params = array(intval($c_member_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);

        foreach ($list as $key => $value) {
            $list[$key]['write_num'] = do_common_count_c_review_comment4c_review_id($value['c_review_id']);
        }

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_review_comment WHERE c_member_id = ?";
        $params = array(intval($c_member_id));
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

        $start_num = ($page - 1) * $page_size + 1 ;
        $end_num   = ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

        return array($list, $prev, $next, $total_num, $start_num, $end_num);
    }
}

if (! function_exists('p_h_review_add_write_c_review_comment4asin_c_member_id'))
{
    function p_h_review_add_write_c_review_comment4asin_c_member_id($asin, $c_member_id)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_review AS cr, "
                                . MYNETS_PREFIX_NAME . "c_review_comment AS crc" .
                " WHERE cr.c_review_id = crc.c_review_id" .
                " AND cr.asin = ?" .
                " AND crc.c_member_id = ?";
        $params = array($asin, intval($c_member_id));
        return db_get_row($sql, $params);
    }
}

if (! function_exists('p_h_review_clip_list_h_review_clip_list4c_member_id'))
{
    function p_h_review_clip_list_h_review_clip_list4c_member_id($c_member_id, $page, $page_size=30)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_review_clip AS crc, "
                                . MYNETS_PREFIX_NAME . "c_review AS cr" .
                " WHERE crc.c_review_id = cr.c_review_id" .
                " AND c_member_id = ?" .
                " ORDER BY crc.r_datetime";
        $params = array(intval($c_member_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);

        //カテゴリの表示名を取得
        $category_disp = p_h_review_add_category_disp();

        //$lstに書き込み数 + カテゴリ名　を追加
        foreach ($list as $key => $value) {
            $list[$key]['write_num'] = do_common_count_c_review_comment4c_review_id($value['c_review_id']);
            $list[$key]['category_disp'] = $category_disp[$value['c_review_category_id']];
        }

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_review_clip WHERE c_member_id = ?";
        $params = array(intval($c_member_id));
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

        $start_num = ($page - 1) * $page_size + 1 ;
        $end_num   = ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

        return array($list, $prev, $next, $total_num, $start_num, $end_num);
    }
}

if (! function_exists('p_c_member_review_c_member_review4c_commu_id'))
{
    function p_c_member_review_c_member_review4c_commu_id($c_commu_id, $page, $page_size=20)
    {
        $sql = " SELECT cr.*, ccr.*, crc.category_disp " .
                " FROM " . MYNETS_PREFIX_NAME . "c_commu_review as ccr, "
                         . MYNETS_PREFIX_NAME . "c_review as cr, "
                         . MYNETS_PREFIX_NAME . "c_review_category as crc" .
                " WHERE ccr.c_review_id = cr.c_review_id" .
                " AND cr.c_review_category_id = crc.c_review_category_id" .
                " AND ccr.c_commu_id =  ?" .
                " ORDER BY ccr.r_datetime";
        $params = array(intval($c_commu_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);

        $sql = "SELECT COUNT(*) FROM " . MYNETS_PREFIX_NAME . "c_commu_review WHERE c_commu_id = ?";
        $total_num = db_get_one($sql, $params);

        $prev = false;
        $next = false;
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

        $start_num = ($page - 1) * $page_size + 1 ;
        $end_num   = ($page - 1) * $page_size + $page_size > $total_num ? $total_num : ($page - 1) * $page_size + $page_size ;

        return array($list, $prev, $next, $total_num, $start_num, $end_num);
    }
}

if (! function_exists('c_member_review_add_confirm_c_member_review4c_review_id'))
{
    function c_member_review_add_confirm_c_member_review4c_review_id($c_review_id, $c_member_id)
    {
        $c_review_id_str = implode(',', array_map('intval', $c_review_id));
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_review as cr, "
                                . MYNETS_PREFIX_NAME . "c_review_comment as crc , "
                                . MYNETS_PREFIX_NAME . "c_review_category as crc2 " .
                " WHERE cr.c_review_id = crc.c_review_id " .
                " AND cr.c_review_category_id = crc2.c_review_category_id " .
                " AND crc.c_member_id = ?".
                " AND cr.c_review_id IN (".$c_review_id_str.")";
        $params = array(intval($c_member_id));
        return db_get_all($sql, $params);
    }
}

if (! function_exists('do_c_review_add_c_review_category_id4category'))
{
    function do_c_review_add_c_review_category_id4category($category)
    {
        $sql = "SELECT c_review_category_id FROM " . MYNETS_PREFIX_NAME . "c_review_category WHERE category = ?";
        $params = array($category);
        return db_get_one($sql, $params);
    }
}

if (! function_exists('do_h_review_edit_c_review_comment4c_review_comment_id_c_member_id'))
{
    function do_h_review_edit_c_review_comment4c_review_comment_id_c_member_id($c_review_comment_id, $c_member_id)
    {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_review_comment " .
                " WHERE c_review_comment_id = ?" .
                " AND c_member_id = ?";
        $params = array(intval($c_review_comment_id), intval($c_member_id));
        return db_get_row($sql, $params);
    }
}

if (! function_exists('do_h_review_clip_add_c_review_id4c_review_id_c_member_id'))
{
    function do_h_review_clip_add_c_review_id4c_review_id_c_member_id($c_review_id, $c_member_id)
    {
        $sql = "SELECT c_review_clip_id FROM " . MYNETS_PREFIX_NAME . "c_review_clip" .
                " WHERE c_review_id = ?" .
                " AND c_member_id = ?";
        $params = array(intval($c_review_id), intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

if (! function_exists('do_c_member_review_c_review_id4c_review_id_c_member_id'))
{
    function do_c_member_review_c_review_id4c_review_id_c_member_id($c_review_id, $c_member_id, $c_commu_id)
    {
        $sql = "SELECT c_commu_review_id FROM " . MYNETS_PREFIX_NAME . "c_commu_review" .
                " WHERE c_commu_id = ?" .
                " AND c_review_id = ?" .
                " AND c_member_id = ?";
        $params = array(intval($c_commu_id), intval($c_review_id), intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

if (! function_exists('do_h_review_edit_c_review4c_review_comment_id'))
{
    function do_h_review_edit_c_review4c_review_comment_id($c_review_comment_id)
    {
        $sql = "SELECT c_review.* FROM " . MYNETS_PREFIX_NAME . "c_review, "
                                         . MYNETS_PREFIX_NAME . "c_review_comment" .
            " WHERE " . MYNETS_PREFIX_NAME . "c_review_comment.c_review_comment_id=?".
            " AND " . MYNETS_PREFIX_NAME . "c_review_comment.c_review_id="
                    . MYNETS_PREFIX_NAME . "c_review.c_review_id";
        $params = array(intval($c_review_comment_id));
        return db_get_row($sql, $params);
    }
}

if (! function_exists('do_common_c_review_id4c_review_comment_id'))
{
    function do_common_c_review_id4c_review_comment_id($c_review_comment_id)
    {
        $sql = 'SELECT c_review_id FROM ' . MYNETS_PREFIX_NAME . 'c_review_comment WHERE c_review_comment_id = ?';
        $params = array(intval($c_review_comment_id));
        return db_get_one($sql, $params);
    }
}

if (! function_exists('do_common_count_c_review_comment4c_review_id'))
{
    function do_common_count_c_review_comment4c_review_id($c_review_id)
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_review_comment WHERE c_review_id = ?';
        $params = array(intval($c_review_id));
        return db_get_one($sql, $params);
    }
}

?>

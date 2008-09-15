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

if (! function_exists('do_c_review_add_insert_c_review'))
{
    function do_c_review_add_insert_c_review($product, $c_review_category_id)
    {
        $sql = 'SELECT c_review_id FROM ' . MYNETS_PREFIX_NAME . 'c_review WHERE asin = ?';
        $params = array($product['ASIN']);
        if ($c_review_id = db_get_one($sql, $params)) {
            return $c_review_id;
        }

        $data = array(
            'title'        => $product['ItemAttributes']['Title'],
            'release_date' => $product['ItemAttributes']['PublicationDate'],
            'manufacturer' => $product['ItemAttributes']['Manufacturer'],
            'author'       => $product['author'],
            'c_review_category_id' => intval($c_review_category_id),
            'image_small'  => $product['MediumImage']['URL'],
            'image_medium' => $product['MediumImage']['URL'],
            'image_large'  => $product['MediumImage']['URL'],
            'url'          => $product['DetailPageURL'],
            'asin'         => $product['ASIN'],
            'list_price'   => $product['ListPrice']['FormattedPrice'],
            'retail_price' => $product['OfferSummary']['LowestUsedPrice']['FormattedPrice'],
            'r_datetime'   => db_now(),
        );

        //TODO:暫定処理
        foreach ($data as $key => $value) {
            if (is_null($value)) $data[$key] = '';
        }
        return db_insert(MYNETS_PREFIX_NAME . 'c_review', $data);
    }
}

if (! function_exists('do_c_review_add_insert_c_review_comment'))
{
    function do_c_review_add_insert_c_review_comment($c_review_id , $c_member_id, $body, $satisfaction_level)
    {
        $data = array(
            'c_review_id' => intval($c_review_id),
            'c_member_id' => intval($c_member_id),
            'body' => $body,
            'satisfaction_level' => intval($satisfaction_level),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_review_comment', $data);
    }
}

if (! function_exists('do_h_review_edit_update_c_review_comment'))
{
    function do_h_review_edit_update_c_review_comment($c_review_comment_id, $body, $satisfaction_level)
    {
        $data = array(
            'body' => $body,
            'satisfaction_level' => intval($satisfaction_level),
            'r_datetime' => db_now(),
        );
        $where = array('c_review_comment_id' => intval($c_review_comment_id));
        return db_update(MYNETS_PREFIX_NAME . 'c_review_comment', $data, $where);
    }
}

if (! function_exists('do_h_review_edit_delete_c_review_comment'))
{
    function do_h_review_edit_delete_c_review_comment($c_review_comment_id)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_review_comment WHERE c_review_comment_id = ?';
        $params = array(intval($c_review_comment_id));
        db_query($sql, $params);
    }
}

if (! function_exists('do_h_review_clip_add_insert_c_review_clip'))
{
    function do_h_review_clip_add_insert_c_review_clip($c_review_id, $c_member_id)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'c_review_id' => intval($c_review_id),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_review_clip', $data);
    }
}

if (! function_exists('do_c_member_review_insert_c_commu_review'))
{
    function do_c_member_review_insert_c_commu_review($c_review_id, $c_member_id, $c_commu_id)
    {
        $data = array(
            'c_commu_id' => intval($c_commu_id),
            'c_review_id' => intval($c_review_id),
            'c_member_id' => intval($c_member_id),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_commu_review', $data);
    }
}

if (! function_exists('do_h_review_clip_list_delete_c_review_clip'))
{
    function do_h_review_clip_list_delete_c_review_clip($c_member_id , $c_review_clips)
    {
        if (!is_array($c_review_clips)) {
            return false;
        }
        $ids = implode(',', array_map('intval', $c_review_clips));

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_review_clip WHERE c_member_id = ?' .
                ' AND c_review_id IN ('.$ids.')';
        $params = array(intval($c_member_id));
        return db_query($sql, $params);
    }
}

if (! function_exists('do_delete_c_review4c_review_id'))
{
    function do_delete_c_review4c_review_id($c_review_id)
    {
        $params = array(intval($c_review_id));

        // c_review
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_review WHERE c_review_id = ?';
        db_query($sql, $params);

        // c_review_clip
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_review_clip WHERE c_review_id = ?';
        db_query($sql, $params);

        // c_commu_review
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_commu_review WHERE c_review_id = ?';
        db_query($sql, $params);
    }
}

?>

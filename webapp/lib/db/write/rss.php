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

if (! function_exists('db_insert_c_rss_cache'))
{
    function db_insert_c_rss_cache($c_member_id, $subject, $body, $date, $link)
    {
        $data = array(
            'c_member_id' => intval($c_member_id),
            'subject'     => $subject,
            'body'        => $body,
            'r_datetime'  => $date,
            'link'        => $link,
            'cache_date'  => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_rss_cache', $data);
    }
}

if (! function_exists('db_update_c_rss_cache'))
{
    function db_update_c_rss_cache($c_rss_cache_id, $subject, $body, $date, $link)
    {
        $data = array(
            'subject'     => $subject,
            'body'        => $body,
            'r_datetime'  => $date,
            'link'        => $link,
            'cache_date'  => db_now(),
        );
        $where = 'c_rss_cache_id = '.intval($c_rss_cache_id);
        return db_update(MYNETS_PREFIX_NAME . 'c_rss_cache', $data, $where);
    }
}

/**
 * メンバーのRSSを削除する
 */
if (! function_exists('delete_rss_cache'))
{
    function delete_rss_cache($c_member_id)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_rss_cache WHERE c_member_id = ?';
        $params = array(intval($c_member_id));
        return db_query($sql, $params);
    }
}

if (! function_exists('insert_rss_cache'))
{
    function insert_rss_cache($rss_url, $c_member_id)
    {
        include_once 'OpenPNE/RSS.php';
        $rss = new OpenPNE_RSS();
        if (!$items = $rss->fetch($rss_url)) {
            return false;
        }

        foreach ($items as $item) {
            // 最新のものと比較
            if (!db_is_duplicated_rss_cache($c_member_id, $item['date'], $item['link']) &&
                !db_is_future_rss_item($item['date'])) {

                if ($id = db_is_updated_rss_cache($c_member_id, $item['link'])) {
                    // update
                    db_update_c_rss_cache($id,
                        $item['title'], $item['body'], $item['date'], $item['link']);
                } else {
                    // insert
                    db_insert_c_rss_cache($c_member_id,
                        $item['title'], $item['body'], $item['date'], $item['link']);
                }
            }
        }
    }
}

?>

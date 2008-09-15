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


if (! function_exists('db_admin_c_image4c_image_id'))
{
    function db_admin_c_image4c_image_id($c_image_id)
    {
        $db =& db_get_instance('image');
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_image WHERE c_image_id = ?';
        $params = array(intval($c_image_id));
        return $db->get_row($sql, $params);
    }
}

if (! function_exists('db_admin_is_c_image4filename'))
{
    function db_admin_is_c_image4filename($filename)
    {
        if (!$filename) return false;

        $db =& db_get_instance('image');
        $sql = 'SELECT c_image_id FROM ' . MYNETS_PREFIX_NAME . 'c_image WHERE filename = ?';
        $params = array($filename);
        return (bool)$db->get_one($sql, $params);
    }
}

if (! function_exists('db_admin_c_image_list'))
{
    function db_admin_c_image_list($page, $page_size, &$pager)
    {
        /*
        $db =& db_get_instance('image');
        $sql = 'SELECT c_image_id FROM ' . MYNETS_PREFIX_NAME . 'c_image ORDER BY c_image_id DESC';
        $id_list = db_get_col_page($sql, $page, $page_size);

        $c_image_list = array();
        foreach ($id_list as $c_image_id) {
            $sql = 'SELECT c_image_id, filename, r_datetime FROM ' . MYNETS_PREFIX_NAME . 'c_image WHERE c_image_id = ?';
            $params = array(intval($c_image_id));
            $c_image_list[] = db_get_row($sql, $params);
        }
        */
        /**/
        $db =& db_get_instance('image');
        $sql = 'SELECT c_image_id,filename,r_datetime,c_member_id FROM '
                 . MYNETS_PREFIX_NAME . 'c_image ORDER BY c_image_id DESC';
        $c_image_list = $db->get_all_limit($sql, ($page-1)*$page_size, $page_size);
        foreach ($c_image_list as $key=>$value)
        {
            $member = db_common_c_member4c_member_id_LIGHT($value['c_member_id']);
            $c_image_list[$key]['nickname'] = $member['nickname'];
        }
        /**/
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_image';
        $total_num = $db->get_one($sql);
        //$total_num = $db->get_one($sql);
        $pager = admin_make_pager($page, $page_size, $total_num);
        return $c_image_list;
    }
}

/**
 * ファイル名から一時保存ファイルを取得
 */
if (! function_exists('c_tmp_image4filename'))
{
    function c_tmp_image4filename($filename)
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_tmp_image WHERE filename = ?';
        $params = array($filename);
        return db_get_row($sql, $params);
    }
}
?>

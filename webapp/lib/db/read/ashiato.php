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

/**
 * あしあとリスト取得
 * 同一人物・同一日付のアクセスは最新の日時だけ
 *
 * @param  int $c_member_id_to 訪問された人
 * @param  int $limit
 * @return array あしあとリスト
 * 20070831不具合があったので修正
*/
if (! function_exists('p_h_ashiato_c_ashiato_list4c_member_id'))
{
    function p_h_ashiato_c_ashiato_list4c_member_id($c_member_id_to, $count)
    {

        $params = array(intval($c_member_id_to));
        $sql = 'SELECT DISTINCT c_member_id_from, MAX(r_datetime) AS r_datetime,is_mobile' .
           ' FROM ' . MYNETS_PREFIX_NAME . 'c_ashiato WHERE c_member_id_to = ?' .
           ' GROUP BY c_member_id_from,is_mobile,r_date ORDER BY r_datetime DESC';
        $result = db_get_all_limit($sql, 0, $count, $params);
        //2008-05-18 KUNIHARU Tsujioka SQLチューニング r_dateでグループ化を追加
        /*
        $sql = 'SELECT DISTINCT r_date FROM ' . MYNETS_PREFIX_NAME . 'c_ashiato WHERE c_member_id_to = ? ORDER BY r_date DESC';
        echo $sql;
        exit;

        $params = array(intval($c_member_id_to));
        $days = db_get_col_limit($sql, 0, $count, $params);

        $sql = 'SELECT DISTINCT c_member_id_from, MAX(r_datetime) AS r_datetime,is_mobile' .
           ' FROM ' . MYNETS_PREFIX_NAME . 'c_ashiato WHERE r_date = ? AND c_member_id_to = ?' .
           ' GROUP BY c_member_id_from,is_mobile ORDER BY r_datetime DESC';
        $result = array();
        foreach ($days as $day) {
            $params = array(strval($day), intval($c_member_id_to));
            $day_result = db_get_all_limit($sql, 0, $count, $params);
            $result = array_merge($result, $day_result);

            $count -= count($day_result);
            if ($count <= 0) {
                break;
            }
        }
        */
        foreach ($result as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $result[$key]['nickname'] = $c_member['nickname'];
            $result[$key]['image_filename'] = $c_member['image_filename'];
        }
        return $result;
    }
}

/**
 * 総あしあと数取得
 *
 * @param  int $c_member_id 訪問された人
 * @return int あしあと数
 */
if (! function_exists('p_h_ashiato_c_ashiato_num4c_member_id'))
{
    function p_h_ashiato_c_ashiato_num4c_member_id($c_member_id)
    {
        $sql = 'SELECT ashiato_count_log FROM ' . MYNETS_PREFIX_NAME . 'c_member WHERE c_member_id = ?';
        $params = array(intval($c_member_id));
        return db_get_one($sql, $params);
    }
}
/**
 * ashiato_mail_num取得
 *
 * @param  int $c_member_id
 * @return int ashiato_mail_num
 */
if (! function_exists('p_h_ashiato_ashiato_mail_num4c_member_id'))
{
    function p_h_ashiato_ashiato_mail_num4c_member_id($c_member_id)
    {
        $sql = 'SELECT ashiato_mail_num FROM ' . MYNETS_PREFIX_NAME . 'c_member WHERE c_member_id = ?';
        $params = array(intval($c_member_id));
        return db_get_one($sql, $params);
    }
}

?>

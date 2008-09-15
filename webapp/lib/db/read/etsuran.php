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

//日記閲覧のためのカスタマイズ　2006/10/3　KT

/**
 * 閲覧リスト取得
 * 同一人物・同一日付のアクセスは最新の日時だけ
 *
 * @param  int $c_diary_id 閲覧された日記
 * @param  int $limit
 * @return array 閲覧リスト
 */
if (! function_exists('p_h_etsuran_c_etsuran_list4c_diary_id'))
{
    function p_h_etsuran_c_etsuran_list4c_diary_id($c_diary_id, $count)
    {
        $sql = 'SELECT *, MAX(r_datetime) AS r_datetime FROM ' . MYNETS_PREFIX_NAME . 'c_etsuran' .
                ' WHERE c_diary_id = ? GROUP BY c_member_id_from, r_date' .
                ' ORDER BY r_datetime DESC';
        $params = array(intval($c_diary_id));
        $arr = db_get_all_limit($sql, 0, $count, $params);

        foreach ($arr as $key => $value) {
            $c_member = db_common_c_member4c_member_id_LIGHT($value['c_member_id_from']);
            $arr[$key]['nickname'] = $c_member['nickname'];
        }
        return $arr;
    }
}

/**
 * 総閲覧数取得
 *
 * @param  int $c_diary_id 閲覧された日記
 * @return int 閲覧数
 * 使用しない。いずれは削除する？c_diaryにカウント集計を持ったため
 */
if (! function_exists('db_etsuran_c_etsuran_num4c_diary_id'))
{
    function db_etsuran_c_etsuran_num4c_diary_id($c_diary_id)
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_etsuran WHERE c_diary_id = ?';
        $params = array(intval($c_diary_id));
        return db_get_one($sql, $params);
    }
}


?>

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

//日記閲覧数を把握するためのテーブル追加処理
//2006/10/3 KT

/**
 * 日記閲覧を付ける
 *@param c_diary_id     対象となる日記のID
 *@param c_member_id_from 観た人のID
 *@param c_member_id    日記の持主のID　ここをどうするのか？
 */
///////////////////////////
//2008-01-12kunitsuji
//閲覧表示のバグを対応するために修正

if (! function_exists('db_etsuran_insert_c_etsuran'))
{
    function db_etsuran_insert_c_etsuran($c_diary_id, $c_member_id_from, $c_member_id)
    {
        // 同一人物の場合は記録しない
        if ($c_member_id == $c_member_id_from) {
            return false;
        }
        //閲覧テーブル追加用の配列準備
        $data = array(
            'c_member_id_from' => intval($c_member_id_from),
            'c_diary_id'   => intval($c_diary_id),
            'r_datetime' => db_now(),
        );

        // 一定時間以内の連続アクセスは記録しない   30分以内に変更
        $wait = date('Y-m-d H:i:s', strtotime('-30 minute'));
        $sql = 'SELECT c_etsuran_id FROM ' . MYNETS_PREFIX_NAME . 'c_etsuran WHERE r_datetime > ?' .
                ' AND c_diary_id = ? AND c_member_id_from = ?';
        $params = array($wait, intval($c_diary_id), intval($c_member_id_from));
        if (db_get_one($sql, $params)) {
            //30分以内の場合はデータだけたしてカウントはしない
            if (!db_insert(MYNETS_PREFIX_NAME . 'c_etsuran', $data)) {
                return false;
            }
            return false;
        }


        if (!db_insert(MYNETS_PREFIX_NAME . 'c_etsuran', $data)) {
            return false;
        }
        //閲覧データがカウントできたので、c_diaryをカウントアップ
        $sql = 'update ' . MYNETS_PREFIX_NAME . 'c_diary set etsuran_count = etsuran_count + 1 where c_diary_id = ?';
        $params = array(intval($c_diary_id));
        db_query($sql, $params);
        return true;
    }
}

?>

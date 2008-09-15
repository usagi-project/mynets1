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
 * あしあとを付ける
 */
if (! function_exists('db_ashiato_insert_c_ashiato'))
{
    function db_ashiato_insert_c_ashiato($c_member_id_to, $c_member_id_from,$is_mobile = 'pc')
    {
        // 同一人物の場合は記録しない
        if ($c_member_id_to == $c_member_id_from) {
            return false;
        }

        // 一定時間以内の連続アクセスは記録しない
        $wait = date('Y-m-d H:i:s', strtotime('-5 minute'));
        $sql = 'SELECT count(*) FROM ' . MYNETS_PREFIX_NAME . 'c_ashiato WHERE r_datetime > ?' .
                ' AND c_member_id_to = ? AND c_member_id_from = ? AND is_mobile = ?';
        $params = array($wait, intval($c_member_id_to), intval($c_member_id_from),$is_mobile);
        $count = db_get_one($sql, $params);
        if ($count >= 1) {
            return false;
        }

        // 忍び足
        if (USE_SHINOBIASHI) {
            if (db_member_is_shinobiashi($c_member_id_from)) {
                return false;
            }
        }

        $data = array(
            'c_member_id_from' => intval($c_member_id_from),
            'c_member_id_to'   => intval($c_member_id_to),
            'r_datetime' => db_now(),
            'r_date' => db_now(),
            'is_mobile' => $is_mobile,
        );
        if (!db_insert(MYNETS_PREFIX_NAME . 'c_ashiato', $data)) {
            return false;
        }
        //c_memberの足跡総数にカウントアップする
        $sql = "update " . MYNETS_PREFIX_NAME . "c_member "
             . "set ashiato_count_log = ashiato_count_log + 1 where c_member_id = ?" ;
        $params = intval($c_member_id_to);
        db_query($sql, $params);

        if ($ashiato_mail_num = p_h_ashiato_ashiato_mail_num4c_member_id($c_member_id_to)) {
            //総足あと数を取得
            $ashiato_num = p_h_ashiato_c_ashiato_num4c_member_id($c_member_id_to);

            //あしあとお知らせメールを送る
            if ($ashiato_num == $ashiato_mail_num) {
                do_common_send_ashiato_mail($c_member_id_to, $c_member_id_from);
            }
        }
        return true;
    }
}

/**
 * Update c_member `ashiato_count_log` and delete c_ashiato rows
 *
 * @param int $limit
 */
if (! function_exists('db_ashiato_update_log'))
{
    function db_ashiato_update_log($limit = 30)
    {
        $sql = 'SELECT c_member_id FROM ' . MYNETS_PREFIX_NAME . 'c_member';
        $c_member_id_list = db_get_col($sql);

        foreach ($c_member_id_list as $c_member_id) {
            $disp = p_h_ashiato_c_ashiato_list4c_member_id($c_member_id, $limit);
            if (!$disp) continue;
            $oldest_row = array_pop($disp);

            $yesterday = date('Y-m-d 00:00:00', strtotime('-1 day'));
            $cutline = min($oldest_row['r_datetime'], $yesterday);

            // delete c_ashiato rows
            $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_ashiato WHERE c_member_id_to = ? AND r_datetime < ?';
            $params = array(intval($c_member_id), $cutline);
            db_query($sql, $params);
            $affected_rows = db_affected_rows();

            // update c_member `ashiato_count_log`
            if ($affected_rows > 0) {
                $sql = 'UPDATE ' . MYNETS_PREFIX_NAME . 'c_member SET ashiato_count_log = ashiato_count_log + ?' .
                       ' WHERE c_member_id = ?';
                $params = array(intval($affected_rows), intval($c_member_id));
                //Usagiではc_memberにカウントアップするのではずす
            //db_query($sql, $params);
            }
        }
    }
}

?>
